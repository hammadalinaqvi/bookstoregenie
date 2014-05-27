<?php

include_once ('.config.inc.php'); 
include_once ('db_connect.php');

$config = array (
  'ServiceURL' => MWS_ENDPOINT_URL,
  'ProxyHost' => null,
  'ProxyPort' => -1,
  'MaxErrorRetry' => 3
);

 $service = new FBAInboundServiceMWS_Client(
     ACCESS_KEY_ID, 
     SECRET_ACCESS_KEY, 
     $config,
     APPLICATION_NAME,
     APPLICATION_VERSION);
	 

$query = mysql_query('SELECT * FROM book_shipment WHERE transaction_status = "in_progress" && status="shipment_plan"');

	while ( $result = mysql_fetch_array($query) )
	{
 
		//echo '<pre>'; print_r($result); 
		
		$address = new FBAInboundServiceMWS_Model_Address();
		$address->setName($result['from_name']);
		$address->setAddressLine1($result['from_addressLine1']);
		//$address->setAddressLine2($result['from_addressLine2']);
		$address->setCity($result['from_city']);
		$address->setStateOrProvinceCode($result['from_state']);
		$address->setCountryCode($result['from_country']);
		$address->setPostalCode($result['from_postalCode']);
		
		/*echo '<pre> ******************* ADDRESS *********************<br /> ';
		print_r($address);
		echo '</pre><br />************************************************<br /><br />';*/
		
		$header = new FBAInboundServiceMWS_Model_InboundShipmentHeader();
		$header->setShipmentName('FBA0002BSG');
		$header->setShipFromAddress($address);
		$header->setDestinationFulfillmentCenterId($result['destination_code']);
		$header->setLabelPrepPreference('AMAZON_LABEL_PREFERRED');
		$header->setShipmentStatus('WORKING');

		/*echo '<pre> ******************* HEADER *********************<br /> ';
		print_r($header);
		echo '</pre><br />************************************************<br /><br />';*/
		
		
		$item = new FBAInboundServiceMWS_Model_InboundShipmentItem();
		$item->setShipmentId($result['shipment_id']);
		$item->setSellerSKU($result['SKU']);
		$item->setFulfillmentNetworkSKU($result['fulfilment_network_SKU']);
		$item->setQuantityShipped($result['quantity_used']);
		
		$item_list = new FBAInboundServiceMWS_Model_InboundShipmentItemList();
		$item_list->setMember($item);
		
		
		$request = new FBAInboundServiceMWS_Model_CreateInboundShipmentRequest();
		
		$request->setSellerId(SELLER_ID);
		$request->setShipmentId($result['shipment_id']);
		$request->setInboundShipmentHeader($header);
		$request->setInboundShipmentItems($item_list);
		echo '<pre>';
		print_r($request);
		echo '</pre>';

		
		try {
		$response = $service->createInboundShipment($request);
		
		echo ("Service Response\n");
		echo ("=============================================================================\n");
		
		echo("        CreateInboundShipmentResponse\n");
		if ($response->isSetCreateInboundShipmentResult()) { 
			echo("            CreateInboundShipmentResult\n");
			$createInboundShipmentResult = $response->getCreateInboundShipmentResult();
			if ($createInboundShipmentResult->isSetShipmentId()) 
			{
				echo("                ShipmentId\n");
				echo("                    " . $createInboundShipmentResult->getShipmentId() . "\n");
			}
		} 
		if ($response->isSetResponseMetadata()) { 
			echo("            ResponseMetadata\n");
			$responseMetadata = $response->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) 
			{
				echo("                RequestId\n");
				echo("                    " . $responseMetadata->getRequestId() . "\n");
			}
		} 
		
		}
		
		catch (FBAInboundServiceMWS_Exception $ex) {
		echo("Caught Exception: " . $ex->getMessage() . "\n");
		echo("Response Status Code: " . $ex->getStatusCode() . "\n");
		echo("Error Code: " . $ex->getErrorCode() . "\n");
		echo("Error Type: " . $ex->getErrorType() . "\n");
		echo("Request ID: " . $ex->getRequestId() . "\n");
		echo("XML: " . $ex->getXML() . "\n");
		}
		
		$item_SKU = $result['SKU'];
		
	$query_update = mysql_query("UPDATE book_shipment SET status='shipment', transaction_status='complete' WHERE SKU='$item_SKU'");	
		
 }
 
 ?>
            