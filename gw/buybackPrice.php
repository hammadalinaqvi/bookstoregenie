<?php
	$host = "mysql.algebragrader.com";
	$user = "algebragrader";
	$pass = "tennis76ers";
	$database = "gwbookstore";
	$table = "books";
	$books = array();
	$mysqli=new mysqli($host, $user, $pass, $database);
	if(mysqli_connect_errno()){
		echo('Error connecting to host. '.$mysqli->error);
	}
	$result=$mysqli->query('SELECT * FROM books WHERE term = "Summer 2010" && isbn != " "');
	$handle = fopen("buybackPrices.xml", "w");
	$data = "";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$name = $row['Name'];
		$isbn = $row['isbn'];
		/*$isbn = explode(" 041 ", $isbn); 
		$isbn = $isbn[1];*/
		$isbn = explode(" ", $isbn);
		foreach ($isbn as $val){
			//echo $url = "http://api.campusbooks.com/6/rest/buybackprices?key=GwBuuWT79gR3uLuhtTZu&isbn=$val";
			$ch = curl_init("http://api.campusbooks.com/6/rest/buybackprices?key=GwBuuWT79gR3uLuhtTZu&isbn=$val");
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$response = curl_exec($ch);
			//echo $response;
			curl_close($ch);
			$title  = gatherData("title", $response);
			$author = gatherData("author", $response);
			$merchantName = gatherData("name", $response);
			$newPrice     = gatherDataStart('price condition="new"', 'price', $response);
			$usedPrice    = gatherDataStart('price condition="used"', 'price', $response);
			$temp = new Book();
			$temp->setValues($name, $title, $author, $merchantName, $newPrice, $usedPrice);
			$books[] = $temp;
			if (count($books) % 20 == 0){
				echo count($books) . " " . $temp->getXML();
			}
		/*	$temp = <<<EOT
				<book>
					<course>$name</course>
					<title>$title</title>
					<author>$author</author>
					<merchantName>$merchantName</merchantName>
					<newPrice>$newPrice</newPrice>
					<usedPrice>$usedPrice</usedPrice>
				</book>
				
EOT;
			$data = $data . $temp;*/
		}
	}
	// close result set
	$result->close();
	// close connection
	$mysqli->close();
	
	writeData(true);
	
	fwrite($handle, $data);
	fclose($handle);
	
	
	function gatherData($tagName, $data){
		$data = explode("<{$tagName}>", $data);
		$data = explode("</{$tagName}>", $data[1]);
		return ($data[0]);
	}
	
	function gatherDataStart($tagStart, $tagEnd, $data){
		$data = explode("<{$tagStart}>", $data);
		$data = explode("</{$tagEnd}>", $data[1]);
		return ($data[0]);
	}
	
	function writeData($highest){
		global $data;
		global $books;
		
		usort($books, "cmp");
		
		foreach ($books as $val){
			$data = $data . $val->getXML();
		}
	}
	
	function cmp($a, $b){
		if ($a->getPrice() > $b->getPrice()){
			return $a;
		}else{
			return $b;
		}
	}

	class Book{
		var $course;
		var $title;
		var $author;
		var $merchantName;
		var $newPrice;
		var $usedPrice;
		
		function setValues($course, $title, $author, $merchantName, $newPrice, $usedPrice){
			$this->course 		= $course;
			$this->title  		= $title;
			$this->author 		= $author;
			$this->merchantName = $merchantName;
			$this->newPrice		= $newPrice;
			$this->usedPrice	= $usedPrice;
		}
		
		function getPrice(){
			return $this->usedPrice;
		}
		
		function getXML(){
			return <<< EOT
				<book>
					<course>$this->course</course>
					<title>$this->title</title>
					<author>$this->author</author>
					<merchantName>$this->merchantName</merchantName>
					<newPrice>$this->newPrice</newPrice>
					<usedPrice>$this->usedPrice</usedPrice>
				</book>
				
EOT;
		}
		
	}
?>