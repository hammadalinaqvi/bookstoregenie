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
	 
	
	$query_book_order = mysql_query('SELECT * FROM book_order WHERE transaction_status = "in_progress"');
	
	$i = 0; // index for book order array
	$j = 0;// index for items array
	
	while ($order_data = mysql_fetch_assoc($query_book_order)){
		$book_orders[$i] = $order_data['id'];
		
		$i++; // increment the index of array
	}

	
	$item_list = new FBAInboundServiceMWS_Model_InboundShipmentItemList();

	foreach ($book_orders as $book_order_id)
	{
		$query = mysql_query('SELECT * FROM book_shipment WHERE book_order_id ='.$book_order_id.' && status="shipment_plan"'); 
		
		
		while ( $result = mysql_fetch_assoc($query) )
		{
			
			// Values to set in the rest of shipment 
			$from_name = $result['from_name'];
			$from_addressLine1 = $result['from_addressLine1'];
			$from_city = $result['from_city'];
			$from_state = $result['from_state'];
			$from_country = $result['from_country'];
			$from_postalCode = $result['from_postalCode'];
			$destination_code = $result['destination_code'];
			$shipment_id = $result['shipment_id'];
			$item_SKU = $result['SKU'];
			
			//preparing multiple items in shipment
			$total_books = $result['quantity_new'] + $result['quantity_used'];
			
			$item[$j] = new FBAInboundServiceMWS_Model_InboundShipmentItem();
			$item[$j]->setShipmentId($result['shipment_id']);
			$item[$j]->setSellerSKU($result['SKU']);
			$item[$j]->setFulfillmentNetworkSKU($result['fulfilment_network_SKU']);
			$item[$j]->setQuantityShipped($total_books);
			
			$item_list->withMember($item[$j]);
			
			$update_book_shipment = mysql_query("UPDATE book_shipment SET status='shipment', transaction_status='complete' WHERE SKU='".$item_SKU."'");	

			
			$j++;
		}// END WHILE
		
		$rand_code = mt_rand(100, 99999999);
		$shipment_name = 'FBA'.$rand_code.'BSG';

		echo '<pre>';
		//print_r($book_orders);
		
		//print_r($result);
		
		//print_r($item_list);
		
	
	
		$address = new FBAInboundServiceMWS_Model_Address();
		$address->setName($from_name);
		$address->setAddressLine1($from_addressLine1);
		//$address->setAddressLine2($result['from_addressLine2']);
		$address->setCity($from_city);
		$address->setStateOrProvinceCode($from_state);
		$address->setCountryCode($from_country);
		$address->setPostalCode($from_postalCode);
		
		/*echo '<pre> ******************* ADDRESS *********************<br /> ';
		print_r($address);
		echo '</pre><br />************************************************<br /><br />';*/
		
		$header = new FBAInboundServiceMWS_Model_InboundShipmentHeader();
		$header->setShipmentName($shipment_name);
		$header->setShipFromAddress($address);
		$header->setDestinationFulfillmentCenterId($destination_code);
		$header->setLabelPrepPreference('AMAZON_LABEL_PREFERRED');
		$header->setShipmentStatus('WORKING');
		
		
		$request = new FBAInboundServiceMWS_Model_CreateInboundShipmentRequest();
		
		$request->setSellerId(SELLER_ID);
		$request->setShipmentId($shipment_id);
		$request->setInboundShipmentHeader($header);
		$request->setInboundShipmentItems($item_list);

		//echo '<pre>';
		print_r($request);
		//echo '</pre>';


		try {
		$response = $service->createInboundShipment($request);
		
		// QUERY TO UPDATE THE TRANSACTION STATUS OF BOOK ORDER
		$update_book_order = mysql_query("UPDATE book_order SET transaction_status='complete' WHERE id=".$book_order_id."");	
		
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
		
		
		
	
		
 }// END - FOREACH
 
 ?>