<?php
	require 'AmazonECS.class.php';

	//include 'xajax/xajax_core/xajax.inc.php';
	include 'buybackPrice.php';
	include 'checkPrices22.php';
	
	
	

	function getRentalPrice($temp)
	{
		
		//$isbn = $_GET["isbns"];
		
    		//Enter your IDs
		define("Access_Key_ID", "AKIAJXHGUJZGZSCU2PEA");
		define("Associate_tag", "gLq7IVz5MOj1W70EyKGLL60jod6s0BzQlIIrTipr");

		//Set the values for some of the parameters.
		$Operation = "ItemLookup";
		$Version = "2010-11-01";
		$ResponseGroup = "ItemAttributes,Offers,Images";
		
		
			$isbn = trim($temp);
	
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
	
			//echo $request;
	
			$xml = simplexml_load_file($request);
			
	
			$title = (string)$xml->Items->Item[0]->ItemAttributes->Title;
			$image = (string)$xml->Items->Item[0]->SmallImage->URL;
			
			if(($image == null) ||($image == ""))
    			{
    				$image = "http://www.futurefiction.com/images/book_stack.gif";
    			}
			$author = (string)$xml->Items->Item[0]->ItemAttributes->Author;
	
			$priceList = checkPrices($isbn10);
			
		
		
		$book = new Book($priceList['rentPrice'],$priceList['rentMerchant'],$priceList['rentLink'], $priceList['newPrice'], $priceList['newMerchant'], $priceList['usedPrice'], $priceList['usedMerchant'], $priceList['newLink'], $priceList['usedLink'], $title, $author, $isbn10, $image, 0, 0, 0, 0.0,$priceList['chegg'],$priceList['cbr'],$priceList['br'],$priceList['cheggLink'],$priceList['cbrLink'],$priceList['brLink']);

		/*
		echo $book->getNewPrice()."<br>";			
		echo $book->getNewMerchant()."<br>";			
		echo $book->getUsedPrice()."<br>";			
		echo $book->getUsedMerchant()."<br>";			
		echo $book->getNewLink()."<br><br>";			
		echo $book->getUsedLink()."<br><br>";			
		echo $book->getTitle()."<br>";			
		echo $book->getAuthor()."<br>";			
		echo "<img width=100 height=100 src='".$book->getImage()."' /><br>";			
		echo $book->getISBN()."<br>";			
		echo $book->getNewQuantity()."<br>";			
		echo $book->getUsedQuantity()."<br>";			
		echo $book->getSubTotal()."<br>";			
*/
		//echo "fuck";
	
		//echo $html;
    		//$response->assign('books', 'innerHTML', $html);	
   		//return $response;
   		//echo $book->getTitle();
   		
   		//echo "im here 2";
   		return $book;

	}	

//getRentalPrice("0073527114");
	
	
?>

