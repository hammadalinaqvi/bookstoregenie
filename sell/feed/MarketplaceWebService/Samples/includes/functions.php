<?php
require_once('Book_sell.php');
function add_to_cart($isbn)
{
	
	//$list = $_GET["isbns"];
	$list = $isbn;

	$listISBN = $_SESSION['listISBN'];
	$isbn_array = count($listISBN);
	if($isbn_array > 0)
	{
		$list .= ",";
	}
	$counter = 0;
	foreach($listISBN as $key => $value)
	{
		$counter++;
		$list .= $key;
		if($counter < $isbn_array)
		{
			$list.= ",";	
		}
	}
	$list = trim($list);
	$list = str_replace(" ",",",$list);
	$list = str_replace(";",",",$list);
	$list = str_replace(":",",",$list);
	$list = str_replace(",,",",",$list);
	$isbns = explode(",",$list);
	
	$isbns = array_unique($isbns);
	$count = count($isbns);

	for($i = 0; $i < $count; $i++)
	{
		//echo "isbn_array<br>";
		$isbn = trim($isbns[$i]);
		
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
	if(array_key_exists($isbn10, $listISBN))
	{
		$book = $listISBN[$isbn10];
		
		$book = unserialize($book);
		$book = (object)$book;
		$newNumber = $book->getNewQuantity();
		$usedNumber = $book->getUsedQuantity();
		$rentNumber = $book->getRentQuantity();
		//$values .= "(".$isbn10.",$usedNumber,$rentNumber);";
		$values .= $isbn10.",$usedNumber,$rentNumber";
		echo "<input type='hidden' name='cookie_value' id='cookie_value' value='".$values."'>";
	}
	else
	{
		$temp = getRentalPrice($isbn10);
		//exit;
		
		if($temp)
		{
		   
			if($temp->getNewPrice() == 0)
			{
				
				$resultStatus = "Sorry, we do not carry one or more of your books!!";
			}
			else if(($temp->getTitle() != null) && ($temp->getTitle() != ""))
			{
				
				$temp->addRentQuantity();
				$temp->updateTotal();
				$temp = serialize($temp);
				$listISBN[$isbn10]=$temp;
				//$values .= "(".$isbn10.",0,1);";
				$values .= $isbn10.",0,1";
				echo "<input type='hidden' name='cookie_value' id='cookie_value' value='".$values."'>";
			}
			else
			{
				
				$resultStatus = "Some books were not found!  Please be sure to only enter ISBN(s).";
			}
			
		}
		else
		{
			$resultStatus = "<font color='red'>Some books were not found!  Please be sure to only enter ISBN(s).</font>";
		}
		
	}
	    

	}
	$_SESSION['listISBN'] = $listISBN;
	
}
function getRentalPrice($temp)
{
	
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
	/*echo '<pre>';
	print_r($priceList);exit;
	*/
	$book = new Book($priceList['rentPrice'],$priceList['rentMerchant'],$priceList['rentLink'], $priceList['newPrice'], $priceList['newMerchant'], $priceList['usedPrice'], $priceList['usedMerchant'], $priceList['newLink'], $priceList['usedLink'], $title, $author, $isbn10, $image, 0, 0, 0, 0.0,$priceList['chegg'],$priceList['cbr'],$priceList['br'],$priceList['cheggLink'],$priceList['cbrLink'],$priceList['brLink']);
   		return $book;
}

function checkPrices($isbn10){

		//echo "god damn fuck";
		
		$usedPrice = ''; $usedMerchant = ''; $newPrice = ''; $newMerchant = ''; $ebookPrice = ''; $ebookMerchant = ''; $rentPrice = ''; $rentMerchant = '';
		$cheggNew = ''; $cheggUsed = ''; $cheggRent = '';
		
		//$isbn               = $data[0];
		$url                = "http://api2.campusbooks.com/12/rest/prices?key=CE0001CcX3MiEIf4zN0i&isbn={$isbn10}";
		
		$campusBooksHandle  = fopen($url . "&format=json", "r");
		$priceData		      = json_decode(str_replace("@", "", stream_get_contents($campusBooksHandle)));
		
	//echo $url;
		
		$xml = simplexml_load_file($url);
		
		$conditions		      = $priceData->response->page->offers->condition;
		
		$chegg = 0;
		$cbr = 0;
		$br = 0;
		
		$cheggLink = '';
		$cbrLink = '';
		$brLink = '';
		
		for ($i = 0; $i < count($conditions); $i++){
		//echo $i;
      $current = $conditions[$i]->offer;
      if (count($conditions[$i]->offer) > 1)
        $current = $current[0];
			
			if($conditions[$i]->attributes->id == 2){
				$usedLink = $current->link;
				$usedPrice 	  = $current->total_price;
				$usedMerchant = $current->merchant_name;
			}else if ($conditions[$i]->attributes->id == 1){
				$newLink = $current->link;
				$newPrice 	  = $current->total_price;
				$newMerchant = $current->merchant_name;
			}
			else if ($conditions[$i]->attributes->id == 6){
				$rentPrice 	  = $current->price;
				$rentMerchant = $current->merchant_name;
				$rentLink = $current->link;
				$lowestPriceID = $current->merchant_id;
				
				for ($j = 0; $j < count($conditions[$i]->offer); $j++){
					$current2 = $conditions[$i]->offer;
					if (count($conditions[$i]->offer) > 1)
					{
						$current2 = $current2[$j];
						//this is done to exclude prices if the lowest prices is from merchant book renter.com
						if($j == 0)
						{
							$next = $j + 1;
							$current3 = $conditions[$i]->offer;
							$current3 = $current3[$next];
							if($lowestPriceID == 310)
							{
								//$current3 = $current3[$next];
								$rentPrice 	  = $current3->price;
								$rentMerchant = $current3->merchant_name;
								$rentLink = $current3->link;
							}
						
						}
					}
					if ($current2->merchant_id == 301){
						$chegg = $current2->price;
						$cheggLink = $current2->link;
						
					}
					else if($current2->merchant_id == 304)
					{
						$br = $current2->price;
						$brLink = $current2->link;
						
					}
					else if($current2->merchant_id == 305)
					{
						$cbr = $current2->price;
						$cbrLink = $current2->link;
						
					}
				}
			}
		}
		
		
		$tempUsedPrice = $usedPrice;
		$tempRentPrice = $rentPrice;
		
		$tempUsedPrice = 0.45 * $tempUsedPrice;
		if($tempRentPrice < $tempUsedPrice)
		{
			$rentPrice = $tempUsedPrice;
		}
		
		
		//this is in the case that the used price may be incorrect in the search result
		if($usedPrice < $rentPrice)
		{
			$usedPrice = $rentPrice * 1.10;
		}
				
		if(($chegg != 0) && ($chegg <= $rentPrice))
		{
			$rentPrice = $chegg;
			$rentPrice = $rentPrice - .01;
		}
		else
		{		
			$rentPrice = $rentPrice - .01;
		}
		
		
		if($chegg != 0)
		{
			//this is to round up the number from 22.48 to 23 for example
			$chegg = $chegg + .50;
		}
		
		$priceList = array('usedPrice' => $usedPrice, 'usedMerchant' => $usedMerchant, 'newPrice' => $newPrice, 'newMerchant' => $newMerchant,'usedLink' => $usedLink,'newLink' => $newLink, 'rentPrice' => $rentPrice, 'rentMerchant' => $rentMerchant, 'rentLink' => $rentLink, 'chegg' => $chegg, 'cbr' => $cbr, 'br' => $br,'cheggLink' => $cheggLink, 'cbrLink' => $cbrLink, 'brLink' => $brLink );
		
		return $priceList;
		
	}

?>