<?php
	require_once 'System/Folders.php';
	$sf = new System_Folders();
	$home = $sf->getHome();
	echo "$home\n";
?>