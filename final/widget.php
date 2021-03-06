<?php
	 /*
		Desc: This is a portal script for all requests relating to Bookstoregenie book buying 'widgets'. 
		In theory it will quickly provide detailed and organized data about a book and its vendors when given an isbn.
		For right now code organization and getting the script functional soon is more important than rock solid optimization.
		Data is parsed here for simplicity and to speed up site performance on low end laptops and to speed up the request for slow internet connections, and to speed up production. (wether this actually makes things faster or slower is something I will look into when I have more time)
		This is also the portal script for the bookstoregenie buyback application as that application is closely releated to the book buying widgets
		
		
		Notes: Use _REQUEST for now as this could be either post or get
		
		Status: Fully functional for both buying and selling tecxtbooks
		
		Changelog: 0.1.0 - created
				   0.2.0 - added functional data grabbing
				   0.3.0 - added functional data parsing
				   0.5.0 - fully functional data return for one isbn
				   0.6.0 - fully functional data return for multiple isbns (space delimitated)
				   0.6.1 - removed parenthtical data in book titles to optimize space
				   0.6.2 - removed condition value from each book node (was a bug, shouldnt have been there to begin with)
				   0.6.3 - rounded off prices (we may remove this later)
				   0.6.4 - changed new array to New array to fix javascript issue
				   0.6.5 - replaced foreach loops with for loops because of an issue when only 1 object is returned and is not in an array (bugfix for campusbook data)
				   0.7.0 - added full course functionality
				   0.8.0 - added comma seperation for isbns as well as ", " and any number of spaces you can imagine. In theory its ready for heavy use
				   0.8.1 - now trims whitespace from beginning and end of inputs. NOW its ready for heavy use
				   0.9.0 - added support for amazon arrays
				   0.9.1 - changed the way that the return arr works and restructred the data for better amazon buy all support
				   0.9.2 - rounded off amazon price here instead of on webpage.
				   1.0.0 - completly rehauled the buyall buttons, script run time is now longer but the data is sorted much better, officially ready for deployment
				   1.0.1 - fixed error in buy all button sorting
				   1.1.0 - full buyback support implemented
				   1.1.1 - changed buyback "algorithim"
				   1.2.0 - added support for tracking transactions
		Version: 1.1.1
		Author: Jason Teplitz
	 */
	 // define globals here
	 $reqType; $apiKey = "CE0001CcX3MiEIf4zN0i"; $isbns = array(); /*$return_arr = array();*/ $amazonPrice = 0; $amazon_arr = array(); $merchants_arr = array(); $first; $merchant_prices = array();
	 $merchants_arr['New'] = array(); $merchants_arr['used'] = array(); $merchants_arr['rent'] = array(); $merchants_arr['ebook'] = array();
	 $merchant_prices['New'] = array(); $merchant_prices['used'] = array(); $merchant_prices['rent'] = array(); $merchant_prices['ebook'] = array();
	 $info_arr = array(); $info_arr['New'] = array(); $info_arr['used'] = array(); $info_arr['rent'] = array(); $info_arr['ebook']= array();
	 $trackingName;
	 //constants
	 $BROWSERNAMES = array(
		"type"    => "type",
		"isbn"    => "isbns",
		"courses" => "courses",
		"trackingName" => "store"
	 ); // keep a single global for all inputed variables just in case we need to change them later
	 define ("IMAGE_HEIGHT", 75);
	 define ("IMAGE_WIDTH",  69);
	 define ("DATA_TYPE", "json"); // use JSON instead of XML, changing this variable will break the script as support for XML or any other data format has not been coded in yet
	 // begin program here
	 getInput();
	 main();
	 
	 function main(){ // the main switch of the script
		global $reqType, $BROWSERNAMES, $apiKey, $isbns, $amazon_arr, $amazonPrice, $first, $merchants_arr, $courses;
		$final_arr = array();
		
		switch($reqType){
			case "buyinfo":
				$first = true;
				for ($i = 0; $i < count($isbns); $i++){
					$return_arr[] = parseBuyInfo(getData("http://api.campusbooks.com/11/rest/bookprices?key={$apiKey}&isbn={$isbns[$i]}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH)); // get the data, parse it, then send it on it to the display function\
					$first = false;
				}
				$final_arr["books"]  = $return_arr;
				$final_arr["amazon"] = array();
				if (count($amazon_arr) == count($isbns)){
					$final_arr["amazon"]["amazonLinks"] = $amazon_arr;
					$final_arr["amazon"]["amazonPrice"] = round($amazonPrice);
				}
				$final_arr['buyall'] = organizeBuyAll();
				break;
			case "buycourse":
				$host      		 = "localhost";
				$database  		 = "jteplitz_bookstore";
				$table     		 = "books";
				$departmentTable = "departments";
				$user	  		 = "jteplitz";
				$pass	   		 = "jtt0511";
				mysql_connect($host, $user, $pass);
				mysql_select_db($database);
				$first = true;
				for ($i = 0; $i < count($courses); $i++){
					$query = "SELECT * FROM {$table} WHERE id = {$courses[$i]}";
					$result = mysql_query($query);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$isbn = $row['isbn'];
						$return_arr[] = parseBuyInfo(getData("http://api.campusbooks.com/11/rest/bookprices?key={$apiKey}&isbn={$isbn}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH)); // get the data, parse it, then send it on it to the display function
						$first = false;
					}
				}
				$final_arr["books"]  = $return_arr;
				$final_arr['amazon'] = array();
				if (count($amazon_arr) == count($isbns)){
					$final_arr["amazon"]["amazonLinks"] = $amazon_arr;
					$final_arr["amazon"]["amazonPrice"] = round($amazonPrice);
				}
				$final_arr['buyall'] = organizeBuyAll();
				break;
			case "buyback":
				for ($i = 0; $i < count($isbns); $i++){
					$return_arr[] = parseBuybackInfo(getData("http://api.campusbooks.com/11/rest/buybackprices?key={$apiKey}&isbn={$isbns[$i]}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH), $isbns[$i]); // get the data, parse it, then send it on it to the display function
				}
				$final_arr['books'] = $return_arr;
				break;
		}
		display($final_arr); // for now a successful script run will call the display function and then terminate
	 }
	 
	 function getData($url){
		$handle = fopen($url . "&format=" . DATA_TYPE, "r");
		$data   = stream_get_contents($handle);
		//echo str_replace("@", "", $data);
		//echo $data;
		return json_decode (str_replace("@", "", $data)); // obviously this line would need to be changed if we ever change the data format back to XML (I really hope that doesnt happen)
	 }
	 
	 function parseBuyInfo($data){ // this function will parse all of the json data from the source and display the data we need
		global $amazon_arr, $amazonPrice, $first, $merchants_arr, $merchant_prices, $info_arr, $trackingName;
		$merchant_arr = array(); $merchant_arr['New'] = array(); $merchant_arr['used'] = array(); $merchant_arr['rent'] = array(); $merchant_arr['ebook'] = array();
		$amazon = false;
		$return_arr = array(); $return_arr["bookInfo"] = array(); $return_arr["New"] = array(); $return_arr["used"] = array(); $return_arr['rent'] = array(); $return_arr['ebook'] = array(); $return_arr['seven'];
		$title = explode("(", $data->response->page->book->title);
		$return_arr['bookInfo']['title'] = $title[0];
		$return_arr['bookInfo']['image'] = $data->response->page->book->image;
		//foreach ($data->response->page->offers->condition as $i){
		$trackingId = $data->response->page->offers->attributes->id;
		$query = "INSERT INTO tracking (name, `key`, time) VALUES ('{$trackingName}', '{$trackingId}', NOW())";
		dbConnect();
		mysql_query($query);
		//echo mysql_error();
		for ($i = 0; $i < count($data->response->page->offers->condition); $i++){
			$condition = $data->response->page->offers->condition[$i];
			switch($condition->attributes->id){
				case 1:
					$offer_arr    = &$return_arr['New'];
					$merchant_ids = &$merchant_arr['New'];
					$price_arr    = &$merchant_prices['New'];
					$this_info_arr     = &$info_arr['New']; 
					break;
				case 2:
					$merchant_ids = &$merchant_arr['used'];
					$offer_arr    = &$return_arr['used'];
					$price_arr    = &$merchant_prices['used'];
					$this_info_arr     = &$info_arr['used']; 
					break;
				case 6:
					$offer_arr    = &$return_arr['rent'];
					$merchant_ids = &$merchant_arr['rent'];
					$price_arr    = &$merchant_prices['rent'];
					$this_info_arr     = &$info_arr['rent']; 
					break;
				case 5:
					$offer_arr    = &$return_arr['ebook'];
					$merchant_ids = &$merchant_arr['ebook'];
					$price_arr    = &$merchant_prices['ebook'];
					$this_info_arr     = &$info_arr['ebook']; 
					break; 
				default:
					continue 2;
			}
			for ($j = 0; $j < count ($condition->offer); $j++){
				$tempObj = new offer;
				$current = $condition->offer;
				if (count($condition->offer) > 1)
					$current = $current[$j];
				$tempObj->setBasic($current->merchant_name, $current->merchant_image, $current->link, round($current->total_price));
				$offer_arr[] = $tempObj;
				$merchant_ids[] = $current->merchant_name;
				if (count($this_info_arr[$current->merchant_name]) == 0){
					$this_info_arr[$current->merchant_name] = array();
					$this_info_arr[$current->merchant_name]["links"] = array($current->link);
					$this_info_arr[$current->merchant_name]["name"]  = $current->merchant_name;
					$this_info_arr[$current->merchant_name]["image"] = $current->merchant_image;
				}else{
					$this_info_arr[$current->merchant_name]["links"][] = $current->link;
				}
				$price_arr[$current->merchant_name] += $current->total_price;
				if (!$amazon){
					if ($current->merchant_id == 3 && $condition->attributes->id == 1){
						$amazon_arr[] = $current->link;
						$amazonPrice += $current->total_price;
						$amazon = true;
					}
				}
			}
			$merchant_ids = array_unique($merchant_ids);
		}
		if ($first){
			$merchants_arr['New']   = array_values($merchant_arr['New']);
			$merchants_arr['used']  = array_values($merchant_arr['used']);
			$merchants_arr['rent']  = array_values($merchant_arr['rent']);
			$merchants_arr['ebook'] = array_values($merchant_arr['ebook']);
		}else{
			$merchants_arr['New']     = array_values(array_intersect($merchants_arr['New'], $merchant_arr['New']));
			$merchants_arr['used']    = array_values(array_intersect($merchants_arr['used'], $merchant_arr['used']));
			$merchants_arr['rent']    = array_values(array_intersect($merchants_arr['rent'], $merchant_arr['rent']));
			$merchants_arr['ebook']   = array_values(array_intersect($merchants_arr['ebook'], $merchant_arr['ebook']));
		}
		return ($return_arr);
	 }
	 
	 function parseBuybackInfo($data, $isbn){
		$title = $data->response->page->book->title;
		$return_arr['fullTitle'] = $title;
		if (strlen($title) > 35)
			$title = substr($title, 0, 32) . "...";
		
		$return_arr['title'] = $title;
		//foreach ($data->response->page->offers->condition as $i){
		$return_arr['merchant']  = $data->response->page->offers->merchant[0]->name;
		$return_arr['isbn']      = $isbn;
		$return_arr['sellPrice'] = $data->response->page->offers->merchant[0]->prices->price[0];
		$price = $data->response->page->offers->merchant[0]->prices->price[0];
		if ($price < 25)
			$m = .65;
		else if ($price < 55)
			$m = .68;
		else if ($price < 70)
			$m = .72;
		else
			$m = .78;
		$return_arr['price']     = floor($price * $m);
		return $return_arr;
	 }

	 function organizeBuyAll(){ // this function will organize all of the buy all data that we have accumulated and store it as the final four
		global $merchants_arr, $merchant_prices, $info_arr;
		$return = array();

		$intersection = array_values(array_intersect($merchants_arr['New'], array_keys($merchant_prices['New'])));
		$newPrice     = $merchant_prices['New'][$intersection[0]];
		for ($i = 0; $i < count($intersection); $i++){
			if ($merchant_prices['New'][$intersection[$i]] <= $newPrice)
				$newPrice = $merchant_prices['New'][$intersection[$i]];
		}
		$return['New'] = array("merchant" => $intersection[0], "price" => $newPrice, "info" => $info_arr["New"][$intersection[0]]);

		$intersection = array_values(array_intersect($merchants_arr['used'], array_keys($merchant_prices['used'])));
		$usedPrice     = $merchant_prices['used'][$intersection[0]];
		for ($i = 0; $i < count($intersection); $i++){
			if ($merchant_prices['used'][$intersection[$i]] <= $usedPrice)
				$usedPrice = $merchant_prices['used'][$intersection[$i]];
		}
		$return['used'] = array("merchant" => $intersection[0], "price" => $usedPrice, "info" => $info_arr['used'][$intersection[0]]);

		$intersection = array_values(array_intersect($merchants_arr['rent'], array_keys($merchant_prices['rent'])));
		$rentPrice     = $merchant_prices['rent'][$intersection[0]];
		for ($i = 0; $i < count($intersection); $i++){
			if ($merchant_prices['rent'][$intersection[$i]] <= $rentPrice)
				$rentPrice = $merchant_prices['rent'][$intersection[$i]];
		}
		$return['rent'] = array("merchant" => $intersection[0], "price" => $rentPrice, "info" => $info_arr['rent'][$intersection[0]]);

		$intersection = array_values(array_intersect($merchants_arr['ebook'], array_keys($merchant_prices['ebook'])));
		$ebookPrice     = $merchant_prices['ebook'][$intersection[0]];
		for ($i = 0; $i < count($intersection); $i++){
			if ($merchant_prices['ebook'][$intersection[$i]] <= $ebookPrice)
				$ebookPrice = $merchant_prices['ebook'][$intersection[$i]];
		}
		$return['ebook'] = array("merchant" => $intersection[0], "price" => $ebookPrice, "info" => $info_arr['ebook'][$intersection[0]]);

		return $return;
	 }
	 
	 function getInput(){
		global $reqType, $BROWSERNAMES, $isbns, $courses, $trackingName;
		$reqType = $_REQUEST[$BROWSERNAMES['type']]; 
		if ($reqType == "buyinfo" || $reqType == "buyback"){
			$isbns 		  = str_replace(",", " ", str_replace(", ", " ", $_REQUEST[$BROWSERNAMES['isbn']]));
			$isbns 		  = stripExtraSpace($isbns);
			$isbns 		  = explode(" ", trim($isbns));
			$trackingName = ($_REQUEST[$BROWSERNAMES['trackingName']]);
		}else if ($reqType == "buycourse")
			$courses = explode(",", $_REQUEST[$BROWSERNAMES['courses']]);
	 }
	 
	 function display($out){ // for now this will encode the global return array and then display it
		echo json_encode($out);
	 }
	 /*
	 function addReturn($data){ // for now this function just appends the data to the end of the return array
		global $return_arr;
		
		$return_arr[] = $data;
	 }*/
	 
	 class offer{ // basic class to hold togather the data's information. Will probbably evolve to something more
		function setBasic($merchant, $image, $link, $price){
			$this->merchant  = $merchant;
			$this->image	 = $image;
			$this->link		 = $link;
			$this->price	 = $price;
		}
	 }
	 
	 function stripExtraSpace($s){ // nice little function to take any number of spaces down to one. Thanks terry.b for the function
		$newstr = "";

		for($i = 0; $i < strlen($s); $i++){
			$newstr = $newstr . substr($s, $i, 1);
			if(substr($s, $i, 1) == ' ')
			while(substr($s, $i + 1, 1) == ' ')
			$i++;
		}

		return $newstr;
	} 
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
?>