<?php
	 /*
		Desc: This is a portal script for all requests relating to Bookstoregenie book buying 'widgets'. 
		In theory it will quickly provide detailed and organized data about a book and its vendors when given an isbn.
		For right now code organization and getting the script functional soon is more important than rock solid optimization.
		Data is parsed here for simplicity and to speed up site performance on low end laptops and to speed up the request for slow internet connections, and to speed up production. (wether this actually makes things faster or slower is something I will look into when I have more time)
		
		Notes: Use _REQUEST for now as this could be either post or get
		
		Status: Fully functional for current buying widgets (using JSON, and widgets version 1.0) with ISBNs
		Next Step: Add functionaility for specific courses (IE grab ISBNs from database then do what is already written), add ',' delimination for ISBNs, add check for ISBN validness
		
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
				   0.9.5 - added prelimnary buyback support, a little messy and not fitting with the rest of the code. Will make uniform when I have more time, it does function properly however.
		Version: 0.9.5
		Author: Jason Teplitz
	 */
	 // define globals here
	 $reqType; $apiKey = "CE0001CcX3MiEIf4zN0i"; $isbns = array(); /*$return_arr = array();*/ $amazonPrice = 0; $amazon_arr = array(); $totalPrice = 0;
	 //constants
	 $BROWSERNAMES = array(
		"type"    => "type",
		"isbn"    => "isbns",
		"courses" => "courses"
	 ); // keep a single global for all inputed variables just in case we need to change them later
	 define ("IMAGE_HEIGHT", 75);
	 define ("IMAGE_WIDTH",  69);
	 define ("DATA_TYPE", "json"); // use JSON instead of XML, changing this variable will break the script as support for XML or any other data format has not been coded in yet
	 // begin program here
	 getInput();
	 main();
	 
	 function main(){ // the main switch of the script
		global $reqType, $BROWSERNAMES, $apiKey, $isbns, $amazon_arr, $amazonPrice, $totalPrice;
		$final_arr = array();
		
		switch($reqType){
			case "buyinfo":
				for ($i = 0; $i < count($isbns); $i++){
					$return_arr[] = parseBuyInfo(getData("http://api.campusbooks.com/11/rest/bookprices?key={$apiKey}&isbn={$isbns[$i]}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH)); // get the data, parse it, then send it on it to the display function
				}
				$final_arr["books"]  = $return_arr;
				$final_arr["amazon"] = array();
				if (count($amazon_arr) == count($isbns)){
					$final_arr["amazon"]["amazonLinks"] = $amazon_arr;
					$final_arr["amazon"]["amazonPrice"] = $amazonPrice;
				}
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
				for ($i = 0; $i < count($courses); $i++){
					$query = "SELECT * FROM {$table} WHERE id = {$courses[$i]}";
					$result = mysql_query($query);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$isbn = $row['isbn'];
						$return_arr[] = parseBuyInfo(getData("http://api.campusbooks.com/11/rest/bookprices?key={$apiKey}&isbn={$isbn}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH)); // get the data, parse it, then send it on it to the display function
					}
				}
				$final_arr["books"]  = $return_arr;
				if (count($amazon_arr) == count($isbns)){
					$final_arr["amazon"]["amazonLinks"] = $amazon_arr;
					$final_arr["amazon"]["amazonPrice"] = $amazonPrice;
				}
				break;
			case "buyback":
				for ($i = 0; $i < count($isbns); $i++){
					$return_arr[] = parseBuybackInfo(getData("http://api.campusbooks.com/11/rest/buybackprices?key={$apiKey}&isbn={$isbns[$i]}&image_height=" . IMAGE_HEIGHT . "&image_width=" . IMAGE_WIDTH)); // get the data, parse it, then send it on it to the display function
				}
				echo $totalPrice;
				return 2;
		}
		display($final_arr); // for now a successful script run will call the display function and then terminate
	 }
	 
	 function getData($url){
		$handle = fopen($url . "&format=" . DATA_TYPE, "r");
		$data   = stream_get_contents($handle);
		//echo str_replace("@", "", $data);
		return json_decode (str_replace("@", "", $data)); // obviously this line would need to be changed if we ever change the data format back to XML (I really hope that doesnt happen)
	 }
	 
	 function parseBuyInfo($data){ // this function will parse all of the json data from the source and display the data we need
		global $amazon_arr, $amazonPrice;
		$amazon = false;
		$return_arr = array(); $return_arr["bookInfo"] = array(); $return_arr["New"] = array(); $return_arr["used"] = array(); $return_arr['rent'] = array(); $return_arr['ebook'] = array(); $return_arr['seven'];
		$title = explode("(", $data->response->page->book->title);
		$return_arr['bookInfo']['title'] = $title[0];
		$return_arr['bookInfo']['image'] = $data->response->page->book->image;
		//foreach ($data->response->page->offers->condition as $i){
		for ($i = 0; $i < count($data->response->page->offers->condition); $i++){
			$condition = $data->response->page->offers->condition[$i];
			switch($condition->attributes->id){
				case 1:
					$offer_arr = &$return_arr['New'];
					break;
				case 2:
					$offer_arr = &$return_arr['used'];
					break;
				case 6:
					$offer_arr = &$return_arr['rent'];
					break;
				case 5:
					$offer_arr = &$return_arr['ebook'];
					break; 
				default:
					continue 2;
			} 
			//foreach ($i->offer as $j){
			for ($j = 0; $j < count ($condition->offer); $j++){
				$tempObj = new offer;
				$current = $condition->offer;
				//$current = $current[$j];
				/*if ($current->merchant_name == null)
				echo json_encode($current);*/
				if (count($condition->offer) > 1)
					$current = $current[$j];
				$tempObj->setBasic($current->merchant_name, $current->merchant_image, $current->link, round($current->total_price));
				$offer_arr[] = $tempObj;
				if (!$amazon){
					if ($current->merchant_id == 3 && $condition->attributes->id == 1){
						$amazon_arr[] = $current->link;
						$amazonPrice += $current->total_price;
						$amazon = true;
					}
				}
			}
		}
		return ($return_arr);
	 }
	 
	 function parseBuybackInfo($data){
		global $totalPrice;
		$return_arr['bookInfo']['title'] = $title[0];
		//foreach ($data->response->page->offers->condition as $i){
		$offer = $data->response->page->offers->merchant[0];
		$totalPrice += floor($offer->prices->price[0] / 2);
	 }
	 
	 function getInput(){
		global $reqType, $BROWSERNAMES, $isbns;
		$reqType = $_REQUEST[$BROWSERNAMES['type']]; 
		if ($reqType == "buyinfo"){
			$isbns = str_replace(",", " ", str_replace(", ", " ", $_REQUEST[$BROWSERNAMES['isbn']]));
			$isbns = stripExtraSpace($isbns);
			$isbns = explode(" ", trim($isbns));
		}else if ($reqType == "buycourse")
			$courses = explode(",", $_REQUEST[$BROWSERNAMES['courses']]);
		else if ($reqType == "buyback")
			$isbns = str_replace(",", " ", str_replace(", ", " ", $_REQUEST[$BROWSERNAMES['isbn']]));
			$isbns = stripExtraSpace($isbns);
			$isbns = explode(" ", trim($isbns));
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
?>