<?php
	$user = "jteplitz";
	$pass = "jtt0511";
	$host = "localhost";
	$database = "jteplitz_bookstore";
	$table = "gw_books";
	$html = $_POST['html'];
	
	$courseInfo = explode('<h5 class=\"bread floatLeft paddingLeft2em\" >', $html);
	$courseInfo = explode('&gt;', $courseInfo[1]);
	$term = trim($courseInfo[3]);
	$department = trim($courseInfo[4]);
	$course = trim($courseInfo[5]);
	$section = explode("</h5>",$courseInfo[6]);
	$section = trim($section[0]);
	
	
	$books = explode('<ul class=\"normal\">', $html);
	$isbns = Array();
	$newPrice = Array();
	$usedPrice = Array();
	for ($i = 1; $i < count($books); $i++){
		$isbn = explode("<li>ISBN:", $books[$i]);
		$isbn = explode("</li>", $isbn[1]);
		array_push($isbns, trim($isbn[0]));
		
		$isbn = explode("<li>NEW:", $books[$i]);
		$isbn = explode("</li>", $isbn[1]);
		array_push($newPrice, trim($isbn[0]));
		
		$isbn = explode("<li>USED:", $books[$i]);
		$isbn = explode("</li>", $isbn[1]);
		array_push($usedPrice, trim($isbn[0]));
	}
	
	if (count($usedPrice) != count($isbns))
		$usedPrice = Array();
	if (count($newPrice) != count($isbns))
		$newPrice  = Array();
		
	$isbnString = "";
	for ($i = 0; $i < count($isbns); $i++){
		$isbnString .= ',' . $isbns[$i];
	}
	$newPriceString = "";
	for ($i = 0; $i < count($newPrice); $i++){
		$newPriceString .= ',' . $newPrice[$i];
	}
	$usedPriceString = "";
	for ($i = 0; $i < count($usedPrice); $i++){
		$usedPriceString .= ',' . $usedPrice[$i];
	}
	
	$dbcnx = @mysql_connect($host, $user, $pass);
	if (!$dbcnx) {
		echo( "<P>Unable to connect to the database server at this time.</P>" );
		echo(mysql_error());
		exit();
	}				 
	if (! @mysql_select_db($database) ) {
		echo( "<P>Unable to find database");
		exit();
	}
	
	$name = $department . $course . $section;
	
	$query = "INSERT INTO {$table} (Name, department, course, section, term, isbn, price_new, price_used) VALUES ('{$name}', '{$department}', '{$course}', '{$section}', '{$term}', '{$isbnString}', '{$newPriceString}', '{$usedPriceString}')";
	mysql_query($query) or die("Unable to execute query " . mysql_error());
	header("Location:submit.html");
?>