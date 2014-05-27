<?php

	

	function checkPrices($isbn10){

		$usedPrice = ''; $usedMerchant = ''; $newPrice = ''; $newMerchant = ''; $ebookPrice = ''; $ebookMerchant = ''; $rentPrice = ''; $rentMerchant = '';
		$cheggNew = ''; $cheggUsed = ''; $cheggRent = '';
		
		//$isbn               = $data[0];
		$url                = "http://api.campusbooks.com/11/rest/prices?key=CE0001CcX3MiEIf4zN0i&isbn={$isbn10}";
		$campusBooksHandle  = fopen($url . "&format=json", "r");
		$priceData		      = json_decode(str_replace("@", "", stream_get_contents($campusBooksHandle)));
		
		$xml = simplexml_load_file($url);
		
		//echo $xml;
		//echo "<br>";
		
		$conditions		      = $priceData->response->page->offers->condition;
		for ($i = 0; $i < count($conditions) - 1; $i++){
		//echo $i;
      $current = $conditions[$i]->offer;
      if (count($conditions[$i]->offer) > 1)
        $current = $current[0];
			
			if($conditions[$i]->attributes->id == 2){
				//echo "used";
				//echo "shit";
				//echo $current->link;
				//echo "<br>";
				$usedPrice 	  = $current->total_price;
				$usedMerchant = $current->merchant_name;
			}else if ($conditions[$i]->attributes->id == 1){
				//echo "new";
				//echo $current->link;
				//echo "<br>";
				$newPrice 	  = $current->total_price;
				$newMerchant = $current->merchant_name;
			}
			else if ($conditions[$i]->attributes->id == 5){
				//echo "ebook";
				//echo $current->link;
				//echo "<br>";
				$ebookPrice 	  = $current->total_price;
				$ebookMerchant 	  = $current->merchant_name;
			}
			else if ($conditions[$i]->attributes->id == 6){
				//echo "rent";
				//echo $current->link;
				//echo "<br>";
				$rentPrice 	  = $current->total_price;
				$rentMerchant = $current->merchant_name;
				
				for ($j = 0; $j < count($conditions[$i]->offer); $j++){
					$cheggCurrent = $conditions[$i]->offer;
					if (count($conditions[$i]->offer) > 1)
						$cheggCurrent = $cheggCurrent[$j];
					if ($cheggCurrent->merchant_id == 301){
						$cheggRent = $cheggCurrent->total_price;
						//echo "fucktard";
						}
				}
			}
			//echo "<br>";
		}
		
		$priceList = array('usedPrice' => $usedPrice, 'usedMerchant' => $usedMerchant, 'newPrice' => $newPrice, 'newMerchant' => $newMerchant, 'rentPrice' => $rentPrice, 'rentMerchant' => $rentMerchant, 'cheggRent' => $cheggRent );
		
		return $priceList;
		
		//echo $data."<br>";
		//echo $usedPrice."<br>";
		//echo $usedMerchant."<br>";
		//echo $newPrice."<br>";
		//echo $newMerchant."<br>";
		//echo $rentPrice."<br>";
		//echo $rentMerchant."<br>";
		//echo $cheggRent."<br>";
	}
	
	
	checkPrices("0073527114");
	
?>