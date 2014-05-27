<?php 
session_start();
$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
 $result=$mysqli->query('SELECT theme_name from jteplitz_bookstore.bookstore_settings where status="1"');
 if( $result->num_rows >0)
 {
	$row=$result->fetch_assoc();
	include_once($row['theme_name'].'.php');
	
 }else
	{
		include_once('rent.php');
	}

$mysqli->close();
?>