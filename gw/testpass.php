<title>George Washington Univeristy Bookstore</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Keywords here">
<meta name="description" content="Description here">
<meta name="Author" content="MyFreeTemplates.com">
<META NAME="robots" CONTENT="index, follow">
<!-- (Robot commands: All, None, Index, No Index, Follow, No Follow) -->
<META NAME="revisit-after" CONTENT="30 days">
<META NAME="distribution" CONTENT="global">
<META NAME="rating" CONTENT="general">
<META NAME="Content-Language" CONTENT="english">
<script language="JavaScript" type="text/JavaScript" src="http://www.jdccomputing.com/jason/images/myfreetemplates.js"></script>
<link href="http://www.jdccomputing.com/jason/images/myfreetemplates.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {
	font-size: x-large;
	font-weight: bold;
}
-->
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/btn_support_dn.gif')">
<STYLE type="text/css"><!--
A:link{color:#FFFFFF;text-decoration:underline}
A:visited{color:#FFFFFF;text-decoration:underline}
A:active{color:#FFFFFF;text-decoration:underline}
A:hover{color:#FFFFFF;text-decoration:underline}
--></STYLE> 
<table width="100%" height="92%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="61" background="http://www.jdccomputing.com/jason/images/topbg.gif"><img src="logo.jpg" width="186" height="61"></td>
    <td height="61" colspan="2" align="right" background="http://www.jdccomputing.com/jason/images/topbg.gif"><img src="http://www.jdccomputing.com/jason/images/toppic.gif" width="278" height="61"></td>
  </tr>
  <tr> 
    <td width="186" height="100%" valign="top" background="http://www.jdccomputing.com/jason/images/bg1.gif"><img src="http://www.jdccomputing.com/jason/images/bg1.gif" width="186" height="10"></td>
    <td valign="top" background="http://www.jdccomputing.com/jason/images/bg3.gif">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
     <tr>
              <td width="75" rowspan="8">&nbsp;</td>
              <td colspan="2" valign="top">&nbsp;</td>
              <td width="75" rowspan="8">&nbsp;</td>
        </tr>
          <tr>
            <td colspan="2" align="right" valign="top"><h1></h1></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2" valign="top">&nbsp;</td>
        </tr>
     <tr> 
          <td colspan="2" align="left" valign="top">
          	<h2> You can find the required textbooks for your courses below:</h2>
	   </td>
        </tr>
      </table>
<center><?php
  $host = "localhost";
    $user = "jteplitz";
    $pass = "jtt0511";
    $table = "books";
    $database = "jteplitz_bookstore";
	$rowNumber = $_GET["rowNumber"];
	mysql_connect($host, $user, $pass);
    mysql_select_db($database);
	if (array_key_exists('buyback', $_GET)){
		for ($j = 0; $j < $rowNumber; $j++){
			//echo $_GET["name$j"];
			$sql = "SELECT * from " . $table . " WHERE Name='" . $_GET["name$j"] . "'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$source_arr = explode(" ", $row['isbn']);
			echo "<center>";
			echo "<h1>BuyBack For " . $_GET["name$j"] . "</h1>";
			if (count($source_arr) == 1){
				// there are no isbns so see if there are titles
				if (count ($title_arr) == 1)
					// there are no titles so make sure that you say there are no books
					echo ("<p> <strong>WE ARE UNABLE TO DO BUYBACK FOR THIS COURSE</strong></p> <p> Sorry, we are unable to perform buyback for each course and our information for this course was insufficient for buyback </p>");
			}else{
				for ($i = 1; $i < count($source_arr); $i++){
					//echo $source_arr[$i];
					echo "<iframe src='http://bbwidgets.campusbooks.com/widget_bb.php?wuid=4a146ef22c6ae002d42d598ddd2cf4f2&isbn=$source_arr[$i]' width='860' height='250'></iframe>";
				}
			}
		}
	}else{
		for ($j = 0; $j < $rowNumber; $j++){
			//echo "Name" . $j . $_GET["name" . $j];
			$sql = "SELECT * from " . $table . " WHERE Name ='" . $_GET["name$j"] . "'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$source_arr = explode(" ", $row['isbn']);
			$title_arr = explode(";", $row['Title']);
			$author_arr = explode(";", $row['Author']);
			$edition_arr = explode(";", $row['Edition']);
			//echo count($source_arr);
			echo "<center>";
			echo "<h1>Books For " . $_GET["name$j"] . "</h1>";
			if (count($source_arr) == 1){
				// there are no isbns so see if there are titles
				if (count($title_arr) == 1){
					// there are no titles so make sure that you say there are no books
					echo ("<p> <b>WE HAVE NOT RECIEVED ANY INFORMATION FOR THIS COURSE </b></p> <p>Either this course has no required books or your teacher has not submited any. &nbsp; Please check back later for updated information. </p>");
				}
			}
			for ($i = 1; $i < count($source_arr); $i++){
				echo "<iframe src ='http://widgets.campusbooks.com/widget.php?wuid=8e4c49502f666e3fd32f9c63e7129e85&isbn=$source_arr[$i]' width='860' height='350'></iframe>";
			}
			for ($i = 0; $i < count($title_arr) - 1; $i++){
				$this_title = explode("(", $title_arr[$i]);
				echo "<iframe src ='http://widgets.campusbooks.com/widget.php?wuid=8e4c49502f666e3fd32f9c63e7129e85&author=$author_arr[$i]&title=$this_title[0]&edition=$edition_arr[$i]'  width='860' height='350'></iframe>";
			}
		}
		echo "<p><h3><b><a href='index.html'>Click here to go back and select other courses</a></b></h3></p>";
		echo"<p /> </center>";
		//echo mysql_num_rows($result);
		//$row = mysql_fetch_array($result, MYSQL_ASSOC);
		//echo $sql . $result;
	}
	
?></center>
 </td>
    <td width="186" height="100%" valign="top" background="http://www.jdccomputing.com/jason/images/bg1.gif"><img src="http://www.jdccomputing.com/jason/images/bg1.gif" width="186" height="10">
     <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0" background="images/sidenavbg2.gif">
      <tr>
        <td align="right"><a href="support.php" onMouseOver="MM_swapImage('btn_support','','http://www.jdccomputing.com/jason/images/btn_support_dn.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="http://www.jdccomputing.com/jason/images/btn_support.gif" name="btn_support" width="183" height="26" border="0" id="btn_support"></a></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  height="8%" border="0" cellspacing="0" cellpadding="0" background="http://www.jdccomputing.com/jason/images/basebg.gif">
  <tr>
    <td><font size="1">Copyright &copy; 2009 By College Essentials Inc.<br>
All rights reserved. No part of this program may be reproduced, stored in a retrieval system, or transmitted in any form or by any means, electronic, mechanical, photocopying, recording, or otherwise, without the prior written permission of College Essentials Inc. College Essentials Inc. is in no way related to George Washington Univeristy </font></td>
  </tr>
</table>
</body>
</html>