<html>
	<body>
	
	<?php

   /**
	 * Submit Feed  Sample
	 */
	
	include_once ('.config.inc.php'); 
	include_once ('db_connect.php');
	 

	$query = mysql_query('SELECT * FROM book_shipment WHERE transaction_status = "in_progress" && status="product" || status="price"');
	$item_SKUs = array();
	$i = 0;
	
	while ( $result = mysql_fetch_array($query) )
	{
		$item_SKUs[$i] = $result['SKU'];
		$i++;	
	}
	
	
	$serviceUrl = "https://mws.amazonservices.com";
	
	$config = array (
	'ServiceURL' => $serviceUrl,
	'ProxyHost' => null,
	'ProxyPort' => -1,
	'MaxErrorRetry' => 3,
	);
	
	 $service = new MarketplaceWebService_Client(
	 AWS_ACCESS_KEY_ID, 
	 AWS_SECRET_ACCESS_KEY, 
	 $config,
	 APPLICATION_NAME,
	 APPLICATION_VERSION);
	 
	 foreach($item_SKUs as $key => $item_SKU)
	 {
	 
	 echo 'SKU : '. $item_SKU.'<br />';

$feed_quantity = '<<<EOD
<?xml version="1.0"?> 
<AmazonEnvelope xsi:noNamespaceSchemaLocation="amzn-envelope.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"> 
<Header> 
<DocumentVersion>1.01</DocumentVersion> 
<MerchantIdentifier>BSG_QUANTITY_FEED_</MerchantIdentifier> 
</Header>
<MessageType>Inventory</MessageType>
<Message>
<MessageID>1</MessageID>
<Inventory>
<SKU>$item_SKU</SKU>
<FulfillmentCenterID>AMAZON_NA</FulfillmentCenterID>
<Lookup>FulfillmentNetwork</Lookup>
<SwitchFulfillmentTo>AFN</SwitchFulfillmentTo>
</Inventory>
</Message>
</AmazonEnvelope>
EOD';
	
		/********* Begin Feed Request Block *********/
		
		$feedHandle = @fopen('php://memory', 'rw+');
		fwrite($feedHandle, $feed_quantity);
		rewind($feedHandle);
		
		$request = new MarketplaceWebService_Model_SubmitFeedRequest();
		$request->setMerchant(MERCHANT_ID);
		$request->setFeedType('_POST_INVENTORY_AVAILABILITY_DATA_');
		$request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
		
		rewind($feedHandle);
		$request->setPurgeAndReplace(false);
		$request->setFeedContent($feedHandle);
		
		rewind($feedHandle);
		
		try {
			  $response = $service->submitFeed($request);
		
				if ($response->isSetSubmitFeedResult()) { 
					$submitFeedResult = $response->getSubmitFeedResult();
					if ($submitFeedResult->isSetFeedSubmissionInfo()) { 
						$feedSubmissionInfo = $submitFeedResult->getFeedSubmissionInfo();
						if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
						{
		
							echo "Quantity set to Fulfilled by Amazon.";
							
							$quantityFeedSubmissionID = $feedSubmissionInfo->getFeedSubmissionId();
                            echo 'Feed Submission ID: '. $quantityFeedSubmissionID;
						}
						if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
						{
							//echo("                    FeedProcessingStatus<br />");
							//echo("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "<br />");
							echo 'Feed Status:'.  $feedSubmissionInfo->getFeedProcessingStatus();
		
							//$feedSubmissionInfo->getFeedProcessingStatus();
						}
					} 
				} 
		} 
		
		catch (MarketplaceWebService_Exception $ex) {
		 echo("Caught Exception: " . $ex->getMessage() . "<br />");
		 echo("Response Status Code: " . $ex->getStatusCode() . "<br />");
		 echo("Error Code: " . $ex->getErrorCode() . "<br />");
		 echo("Error Type: " . $ex->getErrorType() . "<br />");
		 echo("Request ID: " . $ex->getRequestId() . "<br />");
		 echo("XML: " . $ex->getXML() . "<br />");
		 echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "<br />");
		}
		@fclose($feedHandle);
		
		
		$query_update = mysql_query("UPDATE book_shipment SET quantity_feed_id='$quantityFeedSubmissionID', status='quantity' WHERE SKU='$item_SKU'");
		echo 'updated';
		/*********************************** End QUANTITY Feed Block ************************************/
	 
	}// END of foreach
	 
	 
 ?>
 
 	</body>
</html>