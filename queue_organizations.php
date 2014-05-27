<?php
	dbConnect();
	$table = "pendingOrgs";
	$handle = fopen($_FILES['file']['tmp_name'], 'r');
	$name  = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		echo $data[3] . ";";
		if ($data[3] != ""){
			$officerName = $data[3];
		}else{
			echo "nothing";
			$officerName = $data[0];
		}
		$query = "INSERT INTO {$table} (orgName, orgEmail, university, name, email, phone, officerName) VALUES (\"{$data[0]}\", \"{$data[1]}\", \"{$data[2]}\", \"{$name}\", \"{$email}\", \"{$phone}\", \"{$officerName}\")";
		mysql_query($query);
		echo mysql_error();
	}
	echo "All organizations have been queued for emails.";
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
?>