<?php
	//error_reporting(E_ERROR);
	
	//$shit = getBuybackPrice("9780525950776");
	//echo $shit['price'];
	
	 function getBuybackPrice($isbn10)
	 {
	 $reqType; 
	 $apiKey = "CE0001CcX3MiEIf4zN0i"; 
	define ("IMAGE_HEIGHT", 75);
	 define ("IMAGE_WIDTH",  69);
	 define ("DATA_TYPE", "json"); 
	
		//$isbn10 = "0137033273";	
	$price = parseBuybackInfo(getData("http://api.campusbooks.com/11/rest/buybackprices?key={$apiKey}&isbn={$isbn10}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH), $isbn10); // get the data, parse it, then send it on it to the display function
				
				//echo "fuck";
		return $price;		
	 }
	 
	 function getData($url){
		//echo $url;
		$handle = fopen($url . "&format=" . DATA_TYPE, "r");
		$data   = stream_get_contents($handle);
		//echo str_replace("@", "", $data);
		//echo $data;
		return json_decode (str_replace("@", "", $data)); // obviously this line would need to be changed if we ever change the data format back to XML (I really hope that doesnt happen)
	 }
	 
	 function parseBuybackInfo($data, $isbn){
		//$title = $data->response->page->book->title;
		//$return_arr['fullTitle'] = $title;
		//if (strlen($title) > 30)
			//$title = substr($title, 0, 27) . "...";
		
		//$return_arr['title'] = $title;
		//foreach ($data->response->page->offers->condition as $i){
		//$return_arr['merchant']  = $data->response->page->offers->merchant[0]->name;
		//$return_arr['isbn']      = $isbn;
		//$return_arr['sellPrice'] = $data->response->page->offers->merchant[0]->prices->price[0];
		//$price = $data->response->page->offers->merchant[0]->prices->price[0];
		
		$price2 = $data->response->page->offers->merchant;
		if(is_array($price2))
		{
			$price = $data->response->page->offers->merchant[0]->prices->price[0];
		}
		else
		{
			$price = $data->response->page->offers->merchant->prices->price[0];
		}
		
		if ($price < 25)
			$m = .59;
		else if ($price < 55)
			$m = .62;
		else if ($price < 70)
			$m = .65;
		else
			$m = .69;
			//echo $price;
		$return_arr['price']     = floor($price * $m);
		$return_arr['original'] = $price;
		return $return_arr;
	 }

	
?>