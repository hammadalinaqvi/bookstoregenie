<?php
$bookstoreName = $_POST['bookstore'];
$dbName		   = $_POST['dbname'];
$i			   = 0;
$isbns		   = Array();
while (($isbn = $_POST["isbn{$i}"]) != ''){
	array_push($isbns, $isbn);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "<title>{$bookstoreName} Bookstore by The Bookstore Genie</title>"; ?>
<link rel = "stylesheet" type = "text/css" href = "style/main.css" />
<!--<script src = "script/prototype.js" language="javascript" type="text"javascript"></script>
<script src = "script/autosuggest.js"  language="javascript" type="text/javascript"></script>
<script src = "script/suggestions.js" language="javascript" type="text/javascript"></script>-->
<script language="javascript" type="text/javascript" src="script/autocomplete.js"></script>
 <!--<script type="text/javascript">
            window.onload = function () {
                var oTextbox = new AutoSuggestControl(document.getElementById("search"), new StateSuggestions());
            }
        </script>
</head>-->
</head>

<body>
<div id = "bg"><img id = "background_image" src = "images/background.png" width = "100%" height = "100%" /></div>

	<div id = "wrapper">
    	<div id = "header">
        	<img id = "logo_img" src = "images/logo.png" />
           	<!--<img id = "nav_img" src = "images/nav.png" usemap = "#nav_map" border = "0" />-->
		<map name = "nav_map">
		  <area shape = "rect" coords = "0,0,57,16" href = "index.html">
		  <area shape = "rect" coords = "57,0,144,16" href = "about.html">
		</map>
        </div>
        <div id = "update"></div>
        <div id = "content">
        	<ol id = "content_top" class = "content_list">
        		<li class = "content_list_item"><img id = "genie" src = "images/genie.png" /></li>
            	<li class = "content_list_item"><img id = "bubble" src = "images/bubble.png" /></li>
            </ol>
            <ol id = "content_bottom_isbn" class = "content_list"><?php
		for ($j = 0; $j < count($isbns); $j++){
			//echo "Name" . $j . $_GET["name" . $j];
			//echo count($source_arr);
			echo "<center>";
				echo "<iframe src ='http://widgets.campusbooks.com/widget.php?wuid=8e4c49502f666e3fd32f9c63e7129e85&isbn={$isbns[$j]}' width='860' height='350'></iframe>";
		}
		echo "<p><h3><b><a href='selectbooks.php?dbname={$dbName}&bookstore={$bookstoreName}'>Click here to go back and enter in more books</a></b></h3></p>";
		echo"<p /> </center>";
		//echo mysql_num_rows($result);
		//$row = mysql_fetch_array($result, MYSQL_ASSOC);
		//echo $sql . $result;
	}
	
?> </ol>
        </div>
    	<div id = "footer">
    		<img id = "footer_img" src = "images/footer.png" />
   		</div>
	</div>

</body>
</html>