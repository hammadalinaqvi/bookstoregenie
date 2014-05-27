<?php
    $host = "localhost";
    $user = "jteplitz";
    $pass = "jtt0511";
    $table = "books";
    
    $database = "jteplitz_bookstore";
    
    mysql_connect($host, $user, $pass);
    mysql_select_db($database);
    ///////////////////////////////////////////////////////////////////////
	if(array_key_exists("terms", $_GET)){
		$departments = file_get_contents("terms.txt");
		$departments_arr = explode(";", $departments);
		//echo count($departments_arr);
		$departments = Array();
		for ($i = 0; $i < count($departments_arr); $i++){
			array_push($departments, $departments_arr[$i]);
		}
		echo json_encode($departments);			
	}else if(array_key_exists("departments", $_GET)){
		$term = $_GET['term'];
		$sql = "SELECT * FROM `index` WHERE term = '$term'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		//echo "result " . $sql;
		$departments = explode(';', $row[1]);
		echo "<departments>";
		for ($i = 0; $i < count($departments); $i++){
			if ($departments[$i] != ''){
				echo <<< EOT
				<department>
					<Name>{$departments[$i]}</Name>
				</department>
EOT;
}
		}
		echo "</departments>";
	}else if (array_key_exists("courses", $_GET)){
		$department = $_GET['department'];
		$sql = "SELECT * FROM " . $table . " WHERE department = '$department' ORDER BY course ASC";
		$result = mysql_query($sql);
		//echo "result " . $sql;
		echo "<courses>";
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			if ($row['course'] != ''){
				echo <<< EOT
				<course>
				<Name>{$row['course']}</Name>
				</course>
EOT;
			}
		}
		echo "</courses>";
	}else if (array_key_exists("sections", $_GET)){
		$course = $_GET['course'];
		$department = $_GET['department'];
		$sql = "SELECT * FROM " . $table . " WHERE course = '$course' AND department = '$department' ORDER BY section ASC";
		$result = mysql_query($sql);
		//echo $sql;
		echo "<sections>";
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		echo <<< EOT
			<section>
			<Title>{$row['section']}</Title>
			<Name>{$row['Name']}</Name>
			</section>
EOT;
		}
		echo "</sections>";
	}else if (array_key_exists("email_send", $_GET)){
		echo "email send";
		$email = $_GET[email];
		for ($i = 0; $i < $_GET[length]; $i++){
			/// get the current e-mail addresses
			$sql = "SELECT * FROM " . $table . " WHERE name = '" . $_GET[name.$i] . "'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$current_emails = $row['emails'];
			$sql = "UPDATE " . $table . " SET emails = '" . $email . "; " . $current_emails . "' WHERE name = '" . $_GET[name.$i] . "'";
			echo $sql;
			$result = mysql_query($sql);
		}
	}
	else{
		//$sql = "SELECT * from " . $table . " WHERE term='Spring 2009';";
	
		if (array_key_exists('term', $_GET)) {
			if ($_GET['term'] == "spring") {
				$where = " WHERE term='Spring 2009' ";
			} else if ($_GET['term'] == "fall") {
				$where = " WHERE term='Fall 2009' ";
			}
		} else {
			$where = "";
		}
	
		$sql = "SELECT * from " . $table . $where;
		$result = mysql_query($sql);
		//echo $sql . ", " . $result;
		
		//stores the courseinformation in varialbles for the server
		
		echo "<courses>";
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo <<< EOT
	
	<course>
		<Name>{$row['Name']}</Name>
		<term>{$row['term']}</term>
		<department>{$row['department']}</department>
		<courseNumber>{$row['course']}</courseNumber>
		<section>{$row['section']}</section>
	</course>
	
EOT;
		}
	echo "</courses>";
}
?>			