<?php
	// set the include path
	//set_include_path( '.' . PATH_SEPARATOR . '/home/jtep/pear/php' . PATH_SEPARATOR . get_include_path() );
	// use the Urban Airship PHP library
	require_once "ua/urbanairship.php";
	
	// set up globals
	$APP_MASTER_SECRET = "8z3zUFGCTgSQmHPob-67lQ";
	$APP_KEY = "PTqsW3bZTcqj43o9Cx2zXA";
	$DEVICE_TOKEN = "0593f262-811c-4ece-9018-55508b6bc907";
	$repId = $_REQUEST['id'];
	
	// set up the Airship object and register the device
	$airship = new Airship($APP_KEY, $APP_MASTER_SECRET);
	
	// send the message
	$message = array("aps"=>array("alert"=>"hello"), "android"=>array("alert" => "hello"));
	$airship->push($message, null, array($DEVICE_TOKEN), null, null); // the second param is for iPhone device tokens and the third is for android apids
	
?>