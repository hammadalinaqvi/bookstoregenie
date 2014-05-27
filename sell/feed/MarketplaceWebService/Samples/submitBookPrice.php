<html>
	<body>
	
	<?php

   /**
	 * Submit Feed  Sample
	 */
	
	include_once ('.config.inc.php'); 
	include_once ('db_connect.php');
	 

	$query = mysql_query('SELECT * FROM book_shipment WHERE transaction_status = "in_progress" && status="quantity" || status="product"');
	$item_SKUs = array();
	$i = 0;
	
	while ( $result = mysql_fetch_array($query) )
	{
		//$product_feed_ids[$i] = $result['product_feed_id '];
		$item_SKUs[$i] = $result['SKU'];
		$item_price[$i] = $result['price_used'];
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
	 
	 $book_price = $item_price[$key];

	
		
$feed = <<<EOD
<?xml version="1.0"?> 
<AmazonEnvelope xsi:noNamespaceSchemaLocation="amzn-envelope.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"> 
    <Header> 
       <DocumentVersion>1.01</DocumentVersion> 
       <MerchantIdentifier>BSG_PRICE_FEED_</MerchantIdentifier> 
    </Header>
  	<MessageType>Price</MessageType>
    <Message>
        <MessageID>1</MessageID>
        <Price>
            <SKU>$item_SKU</SKU>
            <StandardPrice currency="USD">$book_price</StandardPrice>
        </Price>
    </Message>
</AmazonEnvelope>
EOD;
					
		/********* Begin Feed Request Block *********/
		
		$feedHandle = @fopen('php://memory', 'rw+');
		fwrite($feedHandle, $feed);
		rewind($feedHandle);
		
		$request = new MarketplaceWebService_Model_SubmitFeedRequest();
		$request->setMerchant(MERCHANT_ID);
		$request->setFeedType('_POST_PRODUCT_PRICING_DATA_');
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
		
							echo "<tr> <td>Price set .</td> </tr>";
							
							echo $priceFeedSubmissionID = $feedSubmissionInfo->getFeedSubmissionId();
						}
						if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
						{
							//echo("                    FeedProcessingStatus<br />");
							//echo("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "<br />");
							echo '<tr> <td>&nbsp;&nbsp;&nbsp;Feed Status:'.  $feedSubmissionInfo->getFeedProcessingStatus(). '</td> </tr>';
		
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
		
		/********* End Feed Request Block *********/
		
		$query = mysql_query("UPDATE book_shipment SET price_feed_id='$priceFeedSubmissionID', price='$book_price', status='price' WHERE SKU='$item_SKU'"); 


	 
	}// END of foreach
	 
	 
 ?>
 
 	</body>
</html>