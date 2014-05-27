<?php
	dbConnect();
	
	$query = "SELECT * FROM buyback_books ORDER BY `id` ASC";
	$result = mysql_query($query);
	$lastId = -1;
	$transactions_arr 	 = array();
	$lastTransaction_arr = array();
	$remove_arr			 = array();
	$transactionNumbers  = array();
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		if ($row['id'] != $lastId){
			$transactionNumbers[] = $row['id'];
			$lastId = $row['id'];
			$transactions_arr[] = $lastTransaction_arr;
			$lastTransaction_arr = array();
		}
		$lastTransaction_arr[] = $row['title'];
	}
	$transactions_arr[] = $lastTransaction_arr;
	
	for ($i = 0; $i < count($transactions_arr); $i++){
		if ($transactions_arr[$i] === $transactions_arr[$i + 1]){
			$remove_arr[] = $transactionNumbers[$i] - 1;
		}
	}
	
	$length = count($remove_arr);

	for ($i = 0; $i < $length; $i++){
		$query = "DELETE FROM buyback_books WHERE `id` = {$remove_arr[$i]}";
		mysql_query($query);
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