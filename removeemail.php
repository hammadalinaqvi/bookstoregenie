<?php
	$table = "noemail";
	$email = $_REQUEST['email'];
	dbConnect();
	
	$query = "INSERT INTO {$table} VALUES ('{$email}')";
	mysql_query($query);
	echo mysql_error();
	
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
?>