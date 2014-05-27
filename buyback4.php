<?php
	require 'AmazonECS.class.php';

	include 'xajax/xajax_core/xajax.inc.php';
	include 'buybackPrice.php';

	$xajax = new xajax();

	$xajax->configure("javascript URI","xajax/");

	$xajax->register(XAJAX_FUNCTION, 'addBook');
	$xajax->register(XAJAX_FUNCTION, 'buy');
	$xajax->register(XAJAX_FUNCTION, 'noBuy');

	$xajax->processRequest();

	function buy($isbn,$amazonPrice,$lowNewPrice,$lowUsedPrice,$weight,$title, $ourPrice2, $weird)
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
			$statusquo = "<b>CHANGE CART</b>";
			$id = $id + 1;
		}
		else
		{
			$statusquo = "<b>KEEP IN SAME CART</b>";
		}
		$query = "insert into jteplitz_bookstore.getmoney (amazon, new, used, title, isbn, weight, grouping, ourPrice, weird) values ($amazonPrice,$lowNewPrice,$lowUsedPrice,'$title','$isbn',$weight, $id, $ourPrice2, $weird)";

		$mysqli->query($query);



		$mysqli->close();
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

		//$script = "alert(fuck);";
		//$response->script($script);

		//Set the values for some of the parameters.
		$Operation = "ItemLookup";
		$Version = "2010-11-01";
		$ResponseGroup = "ItemAttributes,Offers";

		$isbn = trim($isbn);

					$isbn = str_replace("-","",$isbn);

			$isbn = str_replace(" ","",$isbn);

		//$length = strlen($isbn);

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
       				 $mod = 11 - ($sum%11);
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

   		$amazonPrice = (string)$xml->Items->Item[0]->Offers->Offer->OfferListing->Price->FormattedPrice;
    		$lowNewPrice = (string)$xml->Items->Item[0]->OfferSummary->LowestNewPrice->FormattedPrice;
		$lowUsedPrice = (string)$xml->Items->Item[0]->OfferSummary->LowestUsedPrice->FormattedPrice;
		$weight = (string)$xml->Items->Item[0]->ItemAttributes->PackageDimensions->Weight;
		$title = (string)$xml->Items->Item[0]->ItemAttributes->Title;

		$weight = $weight / 100;

		if($amazonPrice == null)
		{
			//$response->alert('here');
			$amazonPrice = 0;
		}
		
//		$buybackPrice = getBuybackPrice($isbn10);

    		$html = "Amazon Price: ".$amazonPrice."<br>Lowest New Price: ".$lowNewPrice."<br>Lowest Used Price: ".
    			$lowUsedPrice."<br>Weight: ".$weight." lbs.<br>Title: ".$title."<br>OUR PRICE: ";

    		$amazonPrice = str_replace('$','', $amazonPrice);
    		$lowNewPrice = str_replace('$','', $lowNewPrice);
    		$lowUsedPrice = str_replace('$','', $lowUsedPrice);

    		if(floatval($amazonPrice) == 0)
    		{
    			//$response->alert('here2');
    			$amazonPrice2 = floatval($lowNewPrice) + 3.99;
    		}
    		else
    		{
    			$amazonPrice2 = floatval($amazonPrice);
    		}

    		$lowNewPrice2 = floatval($lowNewPrice) + 3.99;

    		//$response->alert($lowNewPrice2);

    		if(floatval($lowNewPrice2) <= floatval($amazonPrice2))
		{
			$ourPrice2 = $lowNewPrice2;
			$weird = 0;
			//$response->alert($ourPrice2);
		}
		else
		{
			$response->alert('HOLY MOTHER OF GOD, AMAZON HAS A LOWER PRICE');
			$weird = 1;
			$ourPrice2 = floatval($amazonPrice2);
			//$response->alert($ourPrice2);
		}

		//$ourPrice2 = $ourPrice + 3.99;
		if($ourPrice2 >= 25)
		{
			$ourPrice2 = ($ourPrice2 * .85) - 1.95 - (.40 * $weight) - .40;
		}
		else
		{
			$ourPrice2 = ($ourPrice2 * .85) - 1.95 - (.40 * $weight);
		}

    		$html .= $ourPrice2."<br>";

    		$html .= "<br><input type='submit' value='BUY' onclick='xajax_buy(\"$isbn\",$amazonPrice,$lowNewPrice,$lowUsedPrice,$weight,\"$title\",$ourPrice2, $weird);'>"."<br><br><input type='submit' value='DONT BUY' onclick='xajax_noBuy();'>";

		//$html .= $xml->asXML();

		//$html .= $length;

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
		<h1>Make me money</h1>
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

	<p>******************************************************************************************************</p>

	<div id = "added" >

	</div>
</div>
</body>
</html>