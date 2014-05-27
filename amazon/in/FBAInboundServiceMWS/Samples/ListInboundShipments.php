<?php
include_once ('.config.inc.php');
include_once ('db_connect.php');

$query = mysql_query('SELECT * FROM book_shipment WHERE transaction_status = "complete"');

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
		
		 $shipment_id_list = new FBAInboundServiceMWS_Model_ShipmentIdList();
		 
		 $request = new FBAInboundServiceMWS_Model_ListInboundShipmentsRequest();
		 $request-> setSellerId(SELLER_ID);
		 $request-> setMarketplace('ATVPDKIKX0DER');

	while ( $row_data = mysql_fetch_array($query) )
	{ 
		 $record_id = 0;
		 $record_id = $row_data['id'];
		 $book_order_id = $row_data['book_order_id'];
		 
		 echo "<pre>";
		//print_r($service);
		//echo "***********************************************************************************************************************************<br /><br />";
		
		 $shipment_id_list-> setmember($row_data['shipment_id']);
		 //print_r($shipment_id_list);
		//echo "***********************************************************************************************************************************<br /><br />";
		 
		 
		 
		 $request-> setShipmentIdList($shipment_id_list);
		 
		 //print_r($request);
		//echo "***********************************************************************************************************************************<br /><br />";

  
      try {
              $response = $service->listInboundShipments($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

               // echo("        ListInboundShipmentsResponse\n");
                if ($response->isSetListInboundShipmentsResult()) { 
                    //echo("            ListInboundShipmentsResult\n");
                    $listInboundShipmentsResult = $response->getListInboundShipmentsResult();
                    if ($listInboundShipmentsResult->isSetShipmentData()) { 
                        //echo("                ShipmentData\n");
                        $shipmentData = $listInboundShipmentsResult->getShipmentData();
                        $memberList = $shipmentData->getmember();
                        foreach ($memberList as $member) {
                            //echo("                    member\n");
                            if ($member->isSetShipmentId()) 
                            {
                                //echo("                        <strong>ShipmentId:</strong> ");
                                //echo("" . $member->getShipmentId() . "\n");
								$member->getShipmentId();
                            }
                            if ($member->isSetShipmentName()) 
                            {
                                //echo("                        <strong>ShipmentName:</strong> ");
                                //echo("" . $member->getShipmentName() . "\n");
								$member->getShipmentName();
                            }
                            if ($member->isSetShipFromAddress()) { 
                                //echo("                        <strong>ShipFromAddress:</strong>\n ");
                                $shipFromAddress = $member->getShipFromAddress();
                                
								if ($shipFromAddress->isSetName()) 
                                {
                                    //echo("                           <strong>Name:</strong> ");
                                    //echo("" . $shipFromAddress->getName() . "\n");
									//$shipFromAddress->getName();
                                }
                                if ($shipFromAddress->isSetAddressLine1()) 
                                {
                                    //echo("                            <strong>AddressLine1:</strong> ");
                                    //echo("" . $shipFromAddress->getAddressLine1() . "\n");
                                }
                                if ($shipFromAddress->isSetAddressLine2()) 
                                {
                                    //echo("                            <strong>AddressLine2:</strong> ");
                                    //echo("" . $shipFromAddress->getAddressLine2() . "\n");
                                }
                                if ($shipFromAddress->isSetDistrictOrCounty()) 
                                {
                                    echo("                            <strong>DistrictOrCounty:</strong> ");
                                    echo("" . $shipFromAddress->getDistrictOrCounty() . "\n");
                                }
                                if ($shipFromAddress->isSetCity()) 
                                {
                                    //echo("                            <strong>City:</strong>");
                                    //echo("" . $shipFromAddress->getCity() . "\n");
                                }
                                if ($shipFromAddress->isSetStateOrProvinceCode()) 
                                {
                                    //echo("                            <strong>State Code:</strong> ");
                                    //echo("" . $shipFromAddress->getStateOrProvinceCode() . "\n");
                                }
                                if ($shipFromAddress->isSetCountryCode()) 
                                {
                                    //echo("                            <strong>Country Code:</strong> ");
                                    //echo("" . $shipFromAddress->getCountryCode() . "\n");
                                }
                                if ($shipFromAddress->isSetPostalCode()) 
                                {
                                    //echo("                            <strong>Postal Code:</strong> ");
                                    //echo("" . $shipFromAddress->getPostalCode() . "\n");
                                }
                            } 
							
                            if ($member->isSetDestinationFulfillmentCenterId()) 
                            {
                                //echo("                        <strong>Destination Fulfillment Center Id:</strong> ");
                                //echo("" . $member->getDestinationFulfillmentCenterId() . "\n");
                            }
                            if ($member->isSetShipmentStatus()) 
                            {
                                echo("                        <strong>Shipment Status:</strong> ");
                                echo("" . $member->getShipmentStatus() . "\n");
								
								//BOOK_SHIPPED CASE
								if($member->getShipmentStatus() == "SHIPPED" || $member->getShipmentStatus() == "IN_TRANSIT")
								{
									mysql_query("UPDATE book_shipment SET book_shipped='".date("Y-m-d h:i:s")."' WHERE id='$record_id'");
								}
								
								//BOOK_DELIVERED CASE
								if($member->getShipmentStatus() == "DELIVERED" || $member->getShipmentStatus() == "CHECKED_IN")
								{
									mysql_query("UPDATE book_shipment SET book_delivered='".date("Y-m-d h:i:s")."' WHERE id='$record_id'");
								}
								
								//BOOK_RECEIVED CASE
								if($member->getShipmentStatus() == "RECEIVING")
								{
									mysql_query("UPDATE book_shipment SET book_received='".date("Y-m-d h:i:s")."' WHERE id='$record_id'");
								}
								
								//SHIPMENT RECEIVED CASE
								if($member->getShipmentStatus() == "CLOSED")
								{
									mysql_query("UPDATE book_order SET shipment_received='".date("Y-m-d h:i:s")."' WHERE id='$book_order_id'");
								}
								
								
                            }
                            if ($member->isSetLabelPrepType()) 
                            {
                                //echo("                        Label Type: ");
                                //echo("                            " . $member->getLabelPrepType() . "\n");
                            }
                            if ($member->isSetAreCasesRequired()) 
                            {
                                //echo("                        AreCasesRequired\n");
                                //echo("                            " . $member->getAreCasesRequired() . "\n");
                            }
                        }
                    } 
                    if ($listInboundShipmentsResult->isSetNextToken()) 
                    {
                        //echo("                NextToken\n");
                        //echo("                    " . $listInboundShipmentsResult->getNextToken() . "\n");
                    }
                } 
                if ($response->isSetResponseMetadata()) { 
                    //echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        //echo("                RequestId\n");
                        //echo("                    " . $responseMetadata->getRequestId() . "\n");
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
 }
                        
