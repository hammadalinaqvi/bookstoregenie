<?php

	include "Book.php";


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