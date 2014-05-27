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


		$listISBN = $_SESSION['listISBN'];
		$_SESSION['codeDailyDeals'] = 0;
		$_SESSION['codeShipping'] = 0;
		$_SESSION['code'] = 0;
		$_SESSION['codeDailyDealsName'] = 'xxx';
		
		$howMany = 0;
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
			
			$total = $total + $book->getSubtotal();
			$howMany = $howMany + $book->getNewQuantity() + $book->getUsedQuantity();
			$ISBN = $book->getIsbn();
		}


	$quantity = $howMany;
	$price = $total;
	$fromUniversity=isset($_POST['university'])?$_POST['university']:'';
	$fromName=isset($_POST['fullname'])?$_POST['fullname']:'';
	$fromStreetAddress=isset($_POST['streetAddress'])?$_POST['streetAddress']:'';
	$fromCity=isset($_POST['city'])?$_POST['city']:'';
	$fromState=isset($_POST['state'])?$_POST['state']:'';
	$fromPostCode=isset($_POST['postalCode'])?$_POST['postalCode']:'';
	$fromEmail=isset($_POST['contactEmail'])?$_POST['contactEmail']:'';
	//$fromCountry=isset($_POST['country'])?$_POST['country']:'';
	$fromCountry = 'US';
	
	$random = mt_rand(100, 999999);
	$SKU = $random."-BSG";


// United States:
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
	 
//echo '<pre>'; print_r($service); echo '</pre>'; exit();

// ******************************** PRODUCT LISTING FEED *******************************************************
// FEED FOR SETTING THE PRODUCT IN THE INVENTORY LISTING.
// METHOD: _POST_PRODUCT_DATA_
// THIS PRODUCT GOES WITH THE STATUS INCOMPLETE.
// WE HAVE TO SET QUANTITY AND PRICE ALSO


// ---------- TODO --------------
//Code something to make the SKU for the specific book!!

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
				}
				if ($feedSubmissionInfo->isSetFeedType()) 
				{
					//echo("                    FeedType<br />");
					//echo("                        " . $feedSubmissionInfo->getFeedType() . "<br />");
					$feedSubmissionInfo->getFeedType();
				}
				if ($feedSubmissionInfo->isSetSubmittedDate()) 
				{
				   // echo("                    SubmittedDate<br />");
				   // echo("                        " . $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT) . "<br />");

				   $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT);
				}
				if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
				{
					//echo("                    FeedProcessingStatus<br />");
					//echo("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "<br />");
                   $feed_status = $feedSubmissionInfo->getFeedProcessingStatus(). '</td> </tr>';

                    //$feedSubmissionInfo->getFeedProcessingStatus();
				}
				if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
				{
					//echo("                    StartedProcessingDate<br />");
				   // echo("                        " . $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT) . "<br />");
				   $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT);
				}
				if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
				{
					//echo("                    CompletedProcessingDate<br />");
					//echo("                        " . $feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT) . "<br />");
					$feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT);
				}
			} 
		} 
		if ($response->isSetResponseMetadata()) { 
			//echo("            ResponseMetadata<br />");
			$responseMetadata = $response->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) 
			{
				//echo("                RequestId<br />");
				//echo("                    " . $responseMetadata->getRequestId() . "<br />");
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

/********* End Feed Request Block *********/

$query = mysql_query("INSERT INTO book_shipment (ISBN, email, SKU, quantity, price, product_feed_id, university, from_name, from_addressLine1, from_addressLine2, from_city, from_state, from_country, from_postalCode, transaction_status, status, created_at) VALUES ('".$ISBN."', '".$fromEmail."', '".$SKU."', '".$quantity."', '".$price."', '".$productFeedSubmissionID."', '".$fromUniversity."', '".$fromName."', '".$fromStreetAddress."', '".$fromAdd2."', '".$fromCity."', '".$fromState."', '".$fromCountry."', '".$fromPostCode."', 'in_progress', 'product', '".date('Y-m-d H:i:s')."' )"); 


?>



 <div class="container">
      <div class="span6 offset2 white_well"> 
     	<h3>Thank You.</h3>
    	<h3>Your book has been <div class="money-green">Submitted for Shipment</div></h3>
    	<br/><br/>
				  <div class="blue_well">
				  	Please wait for an email from Bookstore Genie Team containing you "Shipment Label Slip".
                    <br>
					You will receive and email in 10 to 15 minutes.
                    <br />
					<br />
                    Feed Status: <?php echo $feed_status?>
                    <br />
					<br />
                    <!--You can go to <a href="<?php //echo $_SERVER['HTTP_HOST']?>">Bookstore Genie</a> from here. -->

				  </div>
				  
				  <br/>
      </div> 
      
      <!-- end stepTwo span7-->
    
    </div> 
<?php include_once('include/footer.php');?>

