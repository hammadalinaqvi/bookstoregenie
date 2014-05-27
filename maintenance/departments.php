<?php
	$school   = $_REQUEST['school'];
	$host     = "localhost";
	$database = "jteplitz_bookstore";
	$table    = "classes";
	$user     = "jteplitz";
	$pass	  = "jtt0511";
	
	$department_table =  "departments";
	$departments_arr  = array();
	
	mysql_connect($host, $user, $pass);
	mysql_select_db($database);
	
	$query  = "SELECT * FROM {$table} WHERE school = '{$school}'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$skip = false;
		for ($i = 0; $i < count($departments_arr); $i++){
			if (strcmp($departments_arr[$i], $row['department']) == 0){
				$skip = true;
			}
		}
		echo $skip;
		if (!$skip){
			$thisDepartment = $row['department'];
			$departments_arr[] = $thisDepartment;
			$query = "INSERT INTO {$department_table} (school, department) VALUES ('{$school}', '{$thisDepartment}')";
			mysql_query($query);
		}
	}
?>