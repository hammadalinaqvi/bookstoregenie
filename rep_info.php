<?php
	// This is a temporary script that returns selected information about a representative, it will eventually be consolidated into a more full featured rep managment script possibly using the current system built in cake
	dbConnect();
	
	$type  = $_REQUEST['type'];
	$id    = $_REQUEST['id'];
	$table = "reps";
	
	switch($type){
		case "register_device_token":
			$deviceType  = $_REQUEST['device'];
			$deviceToken = $_REQUEST['token'];
			
			$query = "UPDATE {$table} SET `device`='{$deviceType}', `token`='{$deviceToken}' WHERE `id` = '{$id}'";
			mysql_query($query);
			break;
		case "register_device_location":
			$lat 		 = $_REQUEST['lat'];
			$long 		 = $_REQUEST['long'];
			$query = "UPDATE {$table} SET `lat`='{$lat}', `long`='{$long} WHERE `id` = '{$id}'";
			mysql_query($query);
		default: 
			$query  = "SELECT * FROM {$table} WHERE `id` = {$id}";
			$result = mysql_query($query);
			$row    = mysql_fetch_row($result);
			if ($row != false)
				echo json_encode(array("exists" => true, "firstName" => $row[0]));	
			else
				echo json_encode(array("exists" => false));
			break;
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