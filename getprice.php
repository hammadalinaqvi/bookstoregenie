<?php
	$isbn = $_GET['isbn'];
	$isbn = str_replace("?", "", $isbn);
	
	$url  = "http://api.campusbooks.com/6/rest/prices?key=CE0001CcX3MiEIf4zN0i&isbn={$isbn}";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$xml = curl_exec($ch);
	echo $xml;
?>