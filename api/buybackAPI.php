<?php

	function amazonInfo($isbn)
	{

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
    		//$lowNewPrice = (string)$xml->Items->Item[0]->OfferSummary->LowestNewPrice->FormattedPrice;
		$lowUsedPrice = (string)$xml->Items->Item[0]->OfferSummary->LowestUsedPrice->FormattedPrice;
		$weight = (string)$xml->Items->Item[0]->ItemAttributes->PackageDimensions->Weight;
		//$title = (string)$xml->Items->Item[0]->ItemAttributes->Title;

		$weight = $weight / 100;

		if($amazonPrice == null)
		{
			$amazonPrice = 0;
		}
		
    		$amazonPrice = str_replace('$','', $amazonPrice);
    		//$lowNewPrice = str_replace('$','', $lowNewPrice);
    		$lowUsedPrice = str_replace('$','', $lowUsedPrice);

		echo "<br><br>";
		echo "Amazon price = ".$amazonPrice."<br>";
		echo "Amazon lowest used price = ".$lowUsedPrice."<br>";
    		//echo "Amazon lowest new price = ".$lowNewPrice."<br>";
    		echo "Book weight (lbs) = ".$weight."<br>";
	}

	function checkPrices($isbn10){
		$url                = "http://api.campusbooks.com/11/rest/buybackprices?key=CE0001CcX3MiEIf4zN0i&isbn={$isbn10}";
		$campusBooksHandle  = fopen($url . "&format=json", "r");
		$priceData          = json_decode(str_replace("@", "", stream_get_contents($campusBooksHandle)));
		
		$xml = simplexml_load_file($url);
		
		$conditions		      = $priceData->response->page->offers->merchant;
		
		$buybackPriceUsed = 0;
		$buybackPriceNew = 0;
		for ($i = 0; $i < count($conditions); $i++)
		{
      			
      			$tempPrice = $conditions[$i];
      			$prices = $conditions[$i]->prices->price;
			
			$tempNew = $prices[0];
      			$tempUsed = $prices[1];
      			
      			if($tempNew > $buybackPriceNew)
      			{
      				$buybackPriceNew = $tempNew;
      			}
      			if($tempUsed > $buybackPriceUsed)
      			{
      				$buybackPriceUsed = $tempUsed;
      			}
      			
      		}
      		
      		$buybackPriceNew = $buybackPriceNew * 1.01;
      		$buybackPriceUsed = $buybackPriceUsed * 1.01;
      		
      		$buybackPriceNew = number_format($buybackPriceNew, 2);
      		$buybackPriceUsed = number_format($buybackPriceUsed, 2);
      		
      		
      		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";     
		echo "<response>\n";
		echo "<isbn>$isbn10</isbn>\n";
		echo "<term>120 days</term>\n";
		echo "<cost>$buybackPriceUsed</cost>\n";
		echo "<shipping>3.99</shipping>\n";
		echo "<condition>Very Good</condition>\n";
		echo "<link>https://bookstoregenie.com/buy/index.php?isbns=$isbn10</link>\n";
		echo "</response>\n";
      		//echo "The highest new buyback price is :  $".$buybackPriceNew."<br>";
      		//echo "The highest used buyback price is : $".$buybackPriceUsed."<br>";
						
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$isbn = $_GET["isbn"];
	
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

	
	checkPrices($isbn10);
	//amazonInfo($isbn);
?>