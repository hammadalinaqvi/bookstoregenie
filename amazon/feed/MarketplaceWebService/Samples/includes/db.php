<?php
	@mysql_connect("localhost","jteplitz","jtt0511") or die("Demo is not available, please try again later");
	@mysql_select_db("jteplitz_bookstore") or die("Demo is not available, please try again later");
	session_start();
?>
