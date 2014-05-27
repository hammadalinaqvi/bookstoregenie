<?php
	dbConnect();
	$table = "reps";
	$key = mhash(MHASH_MD5, "Bookstore Genie Rand0m encoding key string!");
	$firstName  = $_REQUEST['firstName'];
	$lastName   = $_REQUEST['lastName'];
	$email      = $_REQUEST['email'];
	$phone      = $_REQUEST['contactPhone'];
	$address    = $_REQUEST['address'];
	$city       = $_REQUEST['city'];
	$state      = $_REQUEST['state'];
	$zip        = $_REQUEST['zip'];
	$university = $_REQUEST['university'];
	//$social     = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $_REQUEST['social'], MCRYPT_MODE_ECB);
	$social = $_REQUEST['social'];
	$bank		= $_REQUEST['bank'];
	//$accountNum = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $_REQUEST['accountNum'], MCRYPT_MODE_ECB);
	//$routingNum = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $_REQUEST['routingNum'], MCRYPT_MODE_ECB);
	$accountNum = $_REQUEST['accountNum'];
	$routingNum = $_REQUEST['routingNum'];
	$license   = $_REQUEST['license'];
	$licenseState = $_REQUEST['licenseState'];
	
	$query = "INSERT INTO {$table} (firstName, lastName, email, phone, address, city, state, zip, university, social, license, licenseState, bank, accountNum, routingNum) VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$phone}', '{$address}', '{$city}', '{$state}', '{$zip}', '{$university}', '{$social}', '{$license}', '{$licenseState}', '{$bank}', '{$accountNum}', '{$routingNum}')";
	mysql_query($query);
	
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
?>