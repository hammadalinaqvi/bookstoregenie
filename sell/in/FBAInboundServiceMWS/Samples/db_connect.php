<?php
$con = mysql_connect("localhost","jteplitz","jtt0511");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("jteplitz_bookstore", $con);
?>