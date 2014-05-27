<?php
	mysql_connect("localhost", "jteplitz", "jtt0511");
	mysql_select_db("jteplitz_bookstore");
	
	$query = "SELECT * FROM bookstore_urls";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$query = "INSERT INTO isbnSchools (college, link) VALUES ('{$row["name"]}', '{$row["url"]}');";
		mysql_query($query);
	}
?>