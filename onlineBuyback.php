<?php
	require 'AmazonECS.class.php';

	include 'xajax/xajax_core/xajax.inc.php';
	include 'buybackPrice.php';
	include 'checkPrices.php';
	
	$xajax = new xajax();

	$xajax->configure("javascript URI","xajax/");

	$xajax->register(XAJAX_FUNCTION, 'addBook');
	$xajax->register(XAJAX_FUNCTION, 'buy');
	$xajax->register(XAJAX_FUNCTION, 'noBuy');

	$xajax->processRequest();

	
	function sendUserEmail($title, $price, $email,$isbn)
	{
		
		
		$body = "Thank you for trusting the genie, and selling us your book!<br><br>";
		$body .= "We purchased '".$title."' with ISBN number:".$isbn." for $".$price."<br><br>";

		$body .= "Thank you very much!!";

	
		//$from = "Bookstore Genie <support@bookstoregenie.com>";
		$to = "$email";
		$subject = "Thank you for selling your book to Bookstoregenie!!";		
		//$host = "localhost";
		//$username = "jteplitz";
		//$password = "jtt0511";
		//$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
		//$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
		//$mail = $smtp->send($to, $headers, $body);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Bookstore Genie <support@bookstoregenie.com>' . "\r\n";
		
		mail($to, $subject, $body, $headers);
		
	}
	
	
	function sendAdminEmail($price, $title, $email, $isbn)
	{
		
		$body = "We just purchased another book!!<br>";
		$body .= "The purchase price was $".$price."<br><br>The book title was: ".$title."<br><br>";
		$body .= "The ISBN was: ".$isbn."<br><br>";
		
		
		$body .= "Student email: ".$email."<br><br>";
		
		$body .= "Great success!!";
		
		
		
		$to = "eugenek79@gmail.com,fdaredia@gmail.com";
		//$to = "eugenek79@gmail.com";
		$subject = "Book purchase for online buyback";	
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Bookstore Genie <support@bookstoregenie.com>' . "\r\n";
			
		//$host = "localhost";
		//$username = "jteplitz";
		//$password = "jtt0511";
		//$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
		//$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
		//$mail = $smtp->send($to, $headers, $body);
		
		
		mail($to, $subject, $body, $headers);
		
		
	}
	
	function buy($isbn,$weight,$title, $ourPrice2,  $address)
	{
		$response = new xajaxResponse();

		$response->alert('BOUGHT');

		

		$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');

		//$link = mysqli_connect('localhost', 'jteplitz', 'jtt0511');
		if (mysqli_connect_errno()) {
    			die('Could not connect: ' .  mysqli_connect_error());
		}
		//$status = 'Connected successfully';

		$query = "select Max(grouping) as high from jteplitz_bookstore.getmoney";

		$id = 1;
		if ($result = $mysqli->query($query)) {
        		while($obj = $result->fetch_object()){
           		 $id =$obj->high;
        		}
    		}
    		if($id == null)
    		{
    			$id = 1;
    		}

		$result->close();

		$query = "select sum(weight) as gross from jteplitz_bookstore.getmoney where grouping = $id";

		$total = 0;
		if ($result = $mysqli->query($query)) {
        		while($obj = $result->fetch_object()){
           		 $total =$obj->gross;
        		}
    		}
    		if($total == null)
    		{
    			$total = 0;
    		}


		$total = $total + $weight;
		if($total >= 50)
		{
			$id = $id + 1;
			$statusquo = "<b>CHANGE CART to ".$id."</b>";
		}
		else
		{
			$statusquo = "<b>KEEP IN SAME CART ".$id."</b>";
		}
		
		
		$code = 'ucf';
		
		$query = "insert into jteplitz_bookstore.getmoney (title, isbn, weight, grouping, ourPrice, email, code) values ('$title','$isbn',$weight, $id, $ourPrice2, '$address', '$code')";

		$mysqli->query($query);



		$mysqli->close();
		
		
		sendAdminEmail($ourPrice2, $title, $address, $isbn);
		sendUserEmail($title, $ourPrice2, $address,$isbn);
		
		$response->script('document.form.isbn_0.focus();');
		$response->assign('added', 'innerHTML', $statusquo);
		return $response;
	}

	function noBuy()
	{
		$response = new xajaxResponse();
		$response->script('document.form.isbn_0.focus();');
		$response->assign('books', 'innerHTML', '');
		$response->assign('added', 'innerHTML', '');
		return $response;
	}

	function addBook($isbn)
	{
    		$response = new xajaxResponse();

    		//Enter your IDs
		define("Access_Key_ID", "AKIAJXHGUJZGZSCU2PEA");
		define("Associate_tag", "gLq7IVz5MOj1W70EyKGLL60jod6s0BzQlIIrTipr");

		
		$Operation = "ItemLookup";
		$Version = "2010-11-01";
		$ResponseGroup = "ItemAttributes,Offers";

		$isbn = trim($isbn);

		$isbn = str_replace("-","",$isbn);

		$isbn = str_replace(" ","",$isbn);

		if(strlen($isbn)==10)
		{
			$isbn10 = $isbn;
		}
		else
		{
			
			 if (preg_match('/^\d{3}(\d{9})\d$/', $isbn, $m)) {
        			$sequence = $m[1];
        			$sum = 0;
        			$mul = 10;
        			for ($i = 0; $i < 9; $i++) {
            				$sum = $sum + ($mul * (int) $sequence{$i});
           				 $mul--;
       				 }
       				 $mod = 11 - ($sum % 11);
       				 if ($mod == 10) {
            				$mod = "X";
        			}
        			else if ($mod == 11) {
            				$mod = 0;
        			}
        			$isbn = $sequence.$mod;
   		 	}	
   		 	$isbn10 = $isbn;
		}


		//Define the request
		$url=
  		   "http://ecs.amazonaws.com/onca/xml"
		   . "?Service=AWSECommerceService"
		   . "&AssociateTag=" . Associate_tag
		   . "&AWSAccessKeyId=" . Access_Key_ID
 		  . "&Operation=" . $Operation
 		  . "&Version=" . $Version
		   . "&ItemId=" . "$isbn10"
		   . "&ResponseGroup=" . $ResponseGroup;

		$secret = "gLq7IVz5MOj1W70EyKGLL60jod6s0BzQlIIrTipr";
		$host = parse_url($url,PHP_URL_HOST);
		$timestamp = gmstrftime("%Y-%m-%dT%H:%M:%S.000Z");
		$url=$url. "&Timestamp=" . $timestamp;
		$paramstart = strpos($url,"?");
		$workurl = substr($url,$paramstart+1);
		$workurl = str_replace(",","%2C",$workurl);
		$workurl = str_replace(":","%3A",$workurl);
		$params = explode("&",$workurl);
		sort($params);
		$signstr = "GET\n" . $host . "\n/onca/xml\n" . implode("&",$params);
		$signstr = base64_encode(hash_hmac('sha256', $signstr, $secret, true));
		$signstr = urlencode($signstr);
		$signedurl = $url . "&Signature=" . $signstr;
		$request = $signedurl;


		$xml = simplexml_load_file($request);

   		//$amazonPrice = (string)$xml->Items->Item[0]->Offers->Offer->OfferListing->Price->FormattedPrice;
    		//$lowNewPrice = (string)$xml->Items->Item[0]->OfferSummary->LowestNewPrice->FormattedPrice;
		//$lowUsedPrice = (string)$xml->Items->Item[0]->OfferSummary->LowestUsedPrice->FormattedPrice;
		$weight = (string)$xml->Items->Item[0]->ItemAttributes->PackageDimensions->Weight;
		$title = (string)$xml->Items->Item[0]->ItemAttributes->Title;

		$weight = $weight / 100;

		if($amazonPrice == null)
		{
			$amazonPrice = 0;
		}
		
		$buybackPrice = getBuybackPrice($isbn10);
		$priceList = checkPrices($isbn10);
		
		
		$rent2 = $priceList['rentPrice'] * 3.29;
		$buy2 = $buybackPrice['price'] * 2.95;
		
		$bestPriceOffer = $rent2 + $buy2;
		$bestPriceOffer = $bestPriceOffer / 2;
		
		
		
		$rent2 = number_format($rent2, 2);
		$buy2 = number_format($buy2, 2);
		$bestPriceOffer = number_format($bestPriceOffer, 2);
		
		$html .= "<br>Title: ".$title;

    		$html .= "<br>ISBN: ".$isbn."<br>";
    		
    		$html .= "<br>Our Price: $".$bestPriceOffer."<br><br>";
    		;

    		
    		

		

    		$html .= "<br>email: <input type = \"text\" id = \"email_ad\" name = \"email_ad\" ></input><br><br><input type='submit' value='BUY' onclick='var address=document.getElementById(\"email_ad\").value;xajax_buy(\"$isbn\",$weight,\"$title\",$bestPriceOffer, address);'>"."<br><br><input type='submit' value='DONT BUY' onclick='xajax_noBuy();'>";

		$weird = 0;

    		$response->assign('books', 'innerHTML', $html);


    		return $response;
	}

	//$xajax->processRequest();
	$xajax->printJavascript();
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script type = "text/javascript" language = "JavaScript">document.form.isbn_0.focus()</script>

</head>




<body>
<body onload="document.form.isbn_0.focus();">

<div id = "page">
	<div id = "header">
		<h1>Buyback homepage!</h1>
	</div>
	<div id = "content">
		<form id = "isbnForm"  name = "form" onSubmit = "isbn=document.form.isbn_0.value;document.form.isbn_0.value='';document.form.isbn_0.focus();return xajax_addBook(isbn);">
			<input type = "text" id = "isbn_0" name = "isbn_0" ></input>
			<input type="submit" value="Submit">
		</form>
	</div>

	<p>******************************************************************************************************</p>

	<div id="books">

	</div>
	
	<div id="added">

	</div>

	<p>******************************************************************************************************</p>
	
	</body>