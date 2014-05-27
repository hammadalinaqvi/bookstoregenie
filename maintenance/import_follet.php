<?php
	dbConnect();
	$handle = fopen("follet.csv", "r");
	$table  = "isbnSchools";
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$query = "SELECT * FROM {$table} WHERE college = '{$data[1]}'";
		$result = mysql_query($query);
		if (mysql_num_rows($result) != 0){
			$output .= "Conflict {$data[1]} <br /> \r\n";
		}else{
			$query = "INSERT INTO {$table} VALUES ('{$data[1]}', '{$data[2]}', '{$data[0]}')";
			mysql_query($query);
		}
		/*$query = "DELETE FROM {$table} WHERE college = '{$data[1]}' AND state = '{$data[2]}' AND link = '{$data[0]}'";
		mysql_query($query);*/
	}
	echo $output;
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
?>