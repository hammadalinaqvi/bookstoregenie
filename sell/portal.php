<?php
	$host      		 = "localhost";
	$database  		 = "jteplitz_bookstore";
	$table     		 = "classes";
	$departmentTable = "departments";
	$user	  		 = "jteplitz";
	$pass	   		 = "jtt0511";
	mysql_connect($host, $user, $pass);
	mysql_select_db($database);
	
	$request    = $_REQUEST['req'];
	$return_arr = array();
	
	switch($request){
		case "department":
			$school = $_REQUEST['school'];
			$query  = "SELECT * FROM {$departmentTable} WHERE school = '{$school}' ORDER BY department ASC";
			$result = mysql_query($query); 
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$return_arr[] = $row['department'];
			}
			echo json_encode($return_arr);
			break;
		case "course":
			$school     = $_REQUEST['school'];
			$department = $_REQUEST['department'];
			$query      = "SELECT * FROM {$table} WHERE school = '{$school}' AND department = '{$department}' ORDER BY course ASC";
			$result     = mysql_query($query); 
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$return_arr[] = $row['course'];
			}
			echo json_encode($return_arr);
			break;
		case "section":
			$school      = $_REQUEST['school'];
			$department  = $_REQUEST['department'];
			$course      = $_REQUEST['course'];
			$query  	 = "SELECT * FROM {$table} WHERE school = '{$school}' AND department = '{$department}' AND course = '{$course}' ORDER BY section ASC";
			$result 	 = mysql_query($query); 
			while ($row  = mysql_fetch_array($result, MYSQL_ASSOC)){
				$return_arr[] = array($row['section'], $row['id']);
			}
			echo json_encode($return_arr);
			break;
		case "school":
			$table = "isbnSchools";
			$query = "SELECT * FROM {$table} ORDER by college ASC";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$return_arr[] = array($row['college'], $row['link']);
			}
			echo json_encode($return_arr);
			break;
	}
?>