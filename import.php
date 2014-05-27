<?php
$host     = "localhost";
$database = "jteplitz_bookstore";
$table    = "books";
$user     = "jteplitz";
$pass     = "jtt0511";
mysql_connect($host, $user, $pass);
mysql_select_db($database);
if (($handle = fopen($_FILES['fileupload']['tmp_name'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $id = $data[0];
		$isbn = $data[1];
		$title = $data[2];
		$author = $data[3];
		
		if ($isbn == "" && $title != "")
			$query = "INSERT INTO {$table} (id, title, author) VALUES ('{$id}', '{$title}', '{$author}')";
		else if ($isbn != "")
			$query = "INSERT INTO {$table} (id, isbn) VALUES('${id}', '{$isbn}')";
			
		mysql_query($query);
        $row++;
    }
    fclose($handle);
}
?>