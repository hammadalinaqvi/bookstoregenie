<?php
	$isbn = $_GET['isbn'];
	//$isbn='013213683X';
	
	$isbn = str_replace("?", "", $isbn);
	
	$url  = "http://api.campusbooks.com/6/rest/bookinfo?key=CE0001CcX3MiEIf4zN0i&isbn={$isbn}&format=json";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$xml = curl_exec($ch);
	echo $xml;
?>