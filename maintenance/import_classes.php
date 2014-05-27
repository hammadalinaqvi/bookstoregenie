<?php
	$handle = fopen("data.csv", "r");
	$school = 'calPolyPomona'; // find some way to automate this
	$current = '';
	$currentId = -1;
	$currentPacked = false;
	$currentCount = 0;
	$classTable = 'classes';
	$bookTable  = 'books';
	$issueTable = 'packed';
	dbConnect();
	
	while (($data = fgetcsv($readHandle, 0, ",")) !== FALSE) {
		if ($data[5] . $data[6] . $data[7] != $current){
			if ($currentCount == 1 && $currentPacked){
				$query  = "INSERT INTO {$issueTable} (id, isbn, title, edition, author) VALUES ('{$currentId}', '{$lastPacked[0]}', '{$lastPacked[1]}', '{$lastPacked[2]}', '{$lastPacked[3]}')";
				mysql_query($query);
			}
			$currentCount = 0;
			
			$query = "SELECT * FROM {$classTable} ORDRER BY `id` DESC";
			$result = mysql_query($query);
			$row = mysql_fetch_assoc($result);
			$currentId = $row['id']++;
			
			$query = "INSERT INTO {$classTable} (school, department, course, section, id, term) VALUES('{$school}', '{$data[5]}', '{$data[6]}', '{$data[7]}', '{$currentId'}, 'Q4')";
			mysql_query($query);
			$current = $data[5] . $data[6] . $data[7];
			
			if ($data[8] == "Packed")
				$currentPacked = true;
			else
				$currentPacked = false;
		}else
			$currentCount++;
		if ($data[8] != "Packed"){
			$isbn = str_replace("-", "", $data[0]);
			$query = "INSERT INTO {$bookTable} (id, isbn, title, edition, author) VALUES('{$currentId}', '{$isbn}' , '{$data[2]}', '{$data[3]}', '{$data[4]}')";
			mysql_query($query);
		}else
			$lastPacked = array($data[0], $data[2], $data[3], $data[4]);
		
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