<?php
session_start();
/**
 * Submit Feed  Sample
 */

include_once ('.config.inc.php'); 
include_once ('db_connect.php'); 

include_once('header.php');
include_once ('includes/Book_sell.php');


	$chk_box=isset($_POST['chk_box'])?$_POST['chk_box']:'';
	
	if($_POST['optionsRadios'][0]=='paypal')
	{
		$paypalEmail=isset($_POST['paypalEmail'])?$_POST['paypalEmail']:'';
	}
	
	else if($_POST['optionsRadios'][0]=='check')
	{
		$streetAddress_check=isset($_POST['streetAddress1'])?$_POST['streetAddress1']:'';
		$city_check=isset($_POST['city1'])?$_POST['city1']:'';
		$state_check=isset($_POST['state1'])?$_POST['state1']:'';
		$zip_check=isset($_POST['zip1'])?$_POST['zip1']:'';
	}
		
	/*echo 'Post: '; print_r($_POST);
	echo '<br /><br />Session: ';print_r($_SESSION);
	*/		

	$listISBN = $_SESSION['sell_listISBN'];
	$_SESSION['codeDailyDeals'] = 0;
	$_SESSION['codeShipping'] = 0;
	$_SESSION['code'] = 0;
	$_SESSION['codeDailyDealsName'] = 'xxx';
	
	$howMany = 0;
	$total_book_cost = 0;
	$total_books = 0;
	$cart_books = array();
	
	// VARIABLES FROM THE USER FILLED FORM IN POST
	$fromUniversity = isset($_POST['university'])?$_POST['university']:'';
	$fromName = isset($_POST['fullname'])?$_POST['fullname']:'';
	$fromPhone = isset($_POST['phone'])?$_POST['phone']:'';
	$fromStreetAddress = isset($_POST['streetAddress'])?$_POST['streetAddress']:'';
	$fromCity = isset($_POST['city'])?$_POST['city']:'';
	$fromState = isset($_POST['state'])?$_POST['state']:'';
	$fromPostCode = isset($_POST['postalCode'])?$_POST['postalCode']:'';
	$fromEmail = isset($_POST['contactEmail'])?$_POST['contactEmail']:'';
	//$fromCountry=isset($_POST['country'])?$_POST['country']:'';
	$fromCountry = 'US';
	
	/*$random = mt_rand(100, 99999999);
	$SKU = $random."-BSG";*/
		
		
		$index = 0;
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
			
			$cart_books[$index] = array(
										"ISBN" => $book->getIsbn(),
										"newQuantity" => $book->getNewQuantity(),
										"newPrice" => $book->getNewPrice(),
										"usedQuantity" => $book->getUsedQuantity(), 
										"usedPrice" => $book->getUsedPrice()
									);
			$index++;
			
			$total_books = $total_books + ($book->getUsedQuantity() + $book->getNewQuantity());
			$total_book_cost = $total_book_cost + $book->getSubtotal();
		}// END - FOREACH of all the books in Cart.
		


// --------------------- QUERY TO ADD THE ROCORD IN BOOK_ORDER --------------------------------------		 

	$query_book_order = mysql_query("INSERT INTO book_order (from_name, from_email,phone, total_books, total_order_price, email_opened_status, transaction_status, created_at, updated_at) VALUES ('".$fromName."', '".$fromEmail."','".$fromPhone."', '".$total_books."', '".$total_book_cost."', '0', 'in_progress', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')");
	//echo '<br /> Rocorded Added in DB. <br /><br />';	
	$book_order_id = mysql_insert_id();
	//echo 'Order ID: '. $book_order_id;
	
// --------------------- END - BOOK_ORDER QUERY --------------------------------------


foreach ($cart_books as $cart_book) {
	$random = mt_rand(100, 99999999);
	$SKU = $random."-BSG";
	$ISBN = $cart_book['ISBN'];	

	// ******************************** PRODUCT LISTING FEED *******************************************************
	// FEED FOR SETTING THE PRODUCT IN THE INVENTORY LISTING.
	// METHOD: _POST_PRODUCT_DATA_
	// THIS PRODUCT GOES WITH THE STATUS INCOMPLETE.
	// WE HAVE TO SET QUANTITY AND PRICE ALSO
	
	
	// United States:
	$serviceUrl = "https://mws.amazonservices.com";
	
	$config = array ('ServiceURL' => $serviceUrl, 'ProxyHost' => null, 'ProxyPort' => -1, 'MaxErrorRetry' => 3,);

	$service = new MarketplaceWebService_Client(AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, $config, APPLICATION_NAME, APPLICATION_VERSION);
	 
//echo '<pre>'; print_r($service); echo '</pre>'; exit();

$feed = <<<EOD
<?xml version="1.0" ?> 
<AmazonEnvelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="amzn-envelope.xsd"> 
<Header> 
   <DocumentVersion>1.01</DocumentVersion> 
   <MerchantIdentifier>BSG_BOOK_FEED_001</MerchantIdentifier> 
</Header> 
<MessageType>Product</MessageType>
<Message> 
   <MessageID>1</MessageID> 
   <OperationType>Update</OperationType> 
   <Product> 
      <SKU>$SKU</SKU> 
      <StandardProductID>
         <Type>ISBN</Type>
         <Value>$ISBN</Value>
      </StandardProductID>
      <ProductTaxCode>A_GEN_NOTAX</ProductTaxCode>
   </Product>
</Message>
</AmazonEnvelope>
EOD;

// ***************************** PRODUCT LISTING FEED END***********************************************************



		/********* Begin Feed Request Block *********/
		
		$feedHandle = @fopen('php://memory', 'rw+');
		fwrite($feedHandle, $feed);
		rewind($feedHandle);
		
		$request = new MarketplaceWebService_Model_SubmitFeedRequest();
		$request->setMerchant(MERCHANT_ID);
		//$request->setMarketplaceIdList($marketplaceIdArray);
		$request->setFeedType('_POST_PRODUCT_DATA_');
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
							
							$productFeedSubmissionID = $feedSubmissionInfo->getFeedSubmissionId();
							//echo "Submission Feed ID: ".$productFeedSubmissionID."<br /><br />";
						}
						if ($feedSubmissionInfo->isSetFeedType()) 
						{
							//echo("                    FeedType<br />");
							$feedSubmissionInfo->getFeedType();
						}
						if ($feedSubmissionInfo->isSetSubmittedDate()) 
						{
						   // echo("                    SubmittedDate<br />");
						   $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT);
		
						   $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT);
						}
						if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
						{
							//echo("                    FeedProcessingStatus<br />");
						   $feed_status = $feedSubmissionInfo->getFeedProcessingStatus();
		
							//$feedSubmissionInfo->getFeedProcessingStatus();
						}
						if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
						{
							//echo("                    StartedProcessingDate<br />");
						   $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT);
						}
						if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
						{
							//echo("                    CompletedProcessingDate<br />");
							$feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT);
						}
					} 
				} 
				if ($response->isSetResponseMetadata()) { 
					//echo("            ResponseMetadata<br />");
					$responseMetadata = $response->getResponseMetadata();
					if ($responseMetadata->isSetRequestId()) 
					{
						//echo("                Request Id: ");
						//echo $responseMetadata->getRequestId();
						$responseMetadata->getRequestId();
					}
				} 
				//echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "<br />");
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

/****************************************** End Feed Request Block **************************************************************/



	// --------------------- QUERY TO ADD THE ROCORD IN BOOK_SHIPMENT --------------------------------------
	
	$query_book_shipment = mysql_query("INSERT INTO book_shipment (book_order_id, email, ISBN, SKU, quantity_new, price_new, quantity_used, price_used, product_feed_id, university, from_name, from_addressLine1, from_addressLine2, from_city, from_state, from_country, from_postalCode, transaction_status, status, created_at)
	VALUES (
	'".$book_order_id."',
	'".$fromEmail."', 
	'".$cart_book['ISBN']."',
	'".$SKU."',
	'".$cart_book['newQuantity']."',
	'".$cart_book['newPrice']."',
	'".$cart_book['usedQuantity']."',
	'".$cart_book['usedPrice']."',
	'".$productFeedSubmissionID."', 
	'".$fromUniversity."', 
	'".$fromName."', 
	'".$fromStreetAddress."', 
	'".$fromAdd2."', 
	'".$fromCity."', 
	'".$fromState."', 
	'".$fromCountry."', 
	'".$fromPostCode."', 
	'in_progress', 
	'product', '".date('Y-m-d H:i:s')."' )"); 



} // END foreach
	
    
unset($_SESSION[sell_listISBN]);    	

?>

    <div class="container">
        <div class="span7 offset2 white_well"> 
            <h3>Thank You.</h3>
            <p>Your book has been Submitted for Shipment.Please wait for an email from Bookstore Genie Team containing you <strong>"Shipment Label Slip"</strong>.You will receive and email in 10 to 15 minutes.</p>
    </div> 
      
      <!-- end stepTwo span7-->
    
    </div> 
<?php include_once('footer.php');?>