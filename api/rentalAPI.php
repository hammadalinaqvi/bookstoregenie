<?php

	//include "Book.php";


	function checkPrices($isbn){


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

		//echo "god damn fuck";

		$usedPrice = ''; $usedMerchant = ''; $newPrice = ''; $newMerchant = ''; $ebookPrice = ''; $ebookMerchant = ''; $rentPrice = ''; $rentMerchant = '';
		$cheggNew = ''; $cheggUsed = ''; $cheggRent = '';
		
		//$isbn               = $data[0];
		$url                = "http://api.campusbooks.com/11/rest/prices?key=CE0001CcX3MiEIf4zN0i&isbn={$isbn10}";
		$campusBooksHandle  = fopen($url . "&format=json", "r");
		$priceData		      = json_decode(str_replace("@", "", stream_get_contents($campusBooksHandle)));
		
	//echo $url;
		
		$xml = simplexml_load_file($url);
		
		$conditions = $priceData->response->page->offers->condition;
		
		
		
		for ($i = 0; $i < count($conditions); $i++){
		//echo $i;
      $current = $conditions[$i]->offer;
      if (count($conditions[$i]->offer) > 1)
        $current = $current[0];
			
			if ($conditions[$i]->attributes->id == 6){
				$rentPrice 	  = $current->total_price;
				$rentMerchant = $current->merchant_name;
				$rentLink = $current->link;
				
				
			}
		}
				
 header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";     
		echo "<response>\n";
		echo "<isbn>$isbn10</isbn>\n";
		echo "<term>120 days</term>\n";
		echo "<cost>$rentPrice</cost>\n";
		echo "<shipping>3.99</shipping>\n";
		echo "<condition>Very Good</condition>\n";
		echo "<link>https://bookstoregenie.com/rent/index.php?isbns=$isbn10</link>\n";
		echo "</response>\n";
		
		//$priceList = array('usedPrice' => $usedPrice, 'usedMerchant' => $usedMerchant, 'newPrice' => $newPrice, 'newMerchant' => $newMerchant,'usedLink' => $usedLink,'newLink' => $newLink, 'rentPrice' => $rentPrice, 'rentMerchant' => $rentMerchant, 'rentLink' => $rentLink, 'chegg' => $chegg, 'cbr' => $cbr, 'br' => $br);
		
		//return $priceList;
		
	}
	
	
	$isbn = $_GET["isbn"];
	checkPrices($isbn);
?>