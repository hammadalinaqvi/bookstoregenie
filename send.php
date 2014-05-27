<?php
	$user = "jteplitz";
	$pass = "jtt0511";
	$host = "localhost";
	$database = "jteplitz_bookstore";
	$table = $_GET['table'];
	$department = $_GET['department'];
	$course = $_GET['course'];
	$section = $_GET['section'];
	$term = $_GET['term'];
	$isbns = str_replace('[', '', str_replace(']', '', $_GET['isbns']));
	$new   = str_replace('[', '', str_replace(']', '', $_GET['new']));
	$used   = str_replace('[', '', str_replace(']', '', $_GET['used']));
	$name = trim($department) . trim($course) . trim($section);
	
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
	
	$query = "INSERT INTO {$table} (Name, department, course, section, term, isbn, price_new, price_used) VALUES ('{$name}', '{$department}', '{$course}', '{$section}', '{$term}', '{$isbns}', '{$new}', '{$used}')";
	mysql_query($query) or die("Unable to execute query " . mysql_error());
?>