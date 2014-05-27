<?php
$bookstoreName = $_GET['bookstore'];
$dbName		   = $_GET['dbname'];
$affialiate	   = $_GET['affiliate'];


$user     = "jteplitz";
$pass     = "jtt0511";
$host     = "localhost";
$table    = "bookstore_urls";
$database = "jteplitz_bookstore";
@mysql_connect($host, $user, $pass);
@mysql_select_db($database);
$query = "SELECT * FROM {$table} WHERE name = '{$dbName}'";
$result = mysql_query($query) or die ("error " . mysql_error());

$row = mysql_fetch_row($result);
$url = $row[1];
$wuid = $row[2];
$bn   = $row[3];
$title = $row[4];

if ($affialiate != ''){
	$table = "affialiates";
	$query = "SELECT * FROM {$table} WHERE name = {$affialiate}";
	$result = mysql_query($query) or die ("error " . mysql_error());

	$row = mysql_fetch_row($result);
	$wuid = $row[1];
}
$i			   = 0;
$isbns		   = json_decode(stripslashes($_GET['isbns']));
$titles  	   = json_decode(stripslashes($_GET['titles']));
$authors 	   = json_decode(stripslashes($_GET['authors']));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "<title>{$bookstoreName} Bookstore by The Bookstore Genie</title>"; ?>
<link rel = "stylesheet" type = "text/css" href = "style/main.css" />
<script src = "script/prototype.js" language="javascript" type="text/javascript"></script>
<script src = "script/browserinit.js" language="javascript" type="text/javascript"></script>
<script language="javscript" type="text/javascript">
window.onload = function(){
	BrowserDetect.init();
	<?php if ($bn == 0){ echo <<< EOT
	if (BrowserDetect.browser == "Safari"){
		var border  = document.createElement("img");
		border.setAttribute("src", 'images/carpet.png');
		border.setAttribute('id', 'iframeBorder_bn');
		var element = document.createElement("img");
		element.setAttribute('id', 'bigButton');
		element.setAttribute("src", "images/showme.png");
		element.setAttribute("onclick", "createPopup()");
		$('iframe').appendChild(border);
		$('iframe').appendChild(element);
		$('iframe_content').setAttribute("class", "hidden");
	}
EOT;
}
?>
}

function createPopup(){
	window.open('<?php echo $url ?>',"Window1", "menubar=yes,width=700,height=500,toolbar=no,scrollbars=yes");
}
 var boxes = 6;
	function addBox(){
		var element = document.createElement("div");
		element.setAttribute("class", "isbn_item");
		var container = document.createElement("div");
		container.setAttribute("class", "isbnContainer");
		element.appendChild(container);
		var input = document.createElement("input");
		input.setAttribute("name", "isbn" + boxes);
		input.setAttribute("class", "isbnInput");
		input.setAttribute("type", "text");
		container.appendChild(input);
		$('inputs').appendChild(element);
		boxes++;
	}
	function addTitleBox(){
		var container = document.createElement("div");
		container.setAttribute("class", "titleContainer");
		var titleInput = document.createElement("input");
		titleInput.setAttribute("name", "title" + boxes);
		titleInput.setAttribute("class", "titleInput");
		titleInput.setAttribute("type", "text");
		container.appendChild(titleInput);
		var authorInput = document.createElement("input");
		authorInput.setAttribute("name", "author" + boxes);
		authorInput.setAttribute("class", "authorInput");
		authorInput.setAttribute("type", "text");
		container.appendChild(authorInput);
		$('inputs').appendChild(container);
		boxes++;
	}
	function refreshIframe(){
		$('bookIframe').src = '<?php echo $url ?>';
	}
 </script>
</head>
<body>
<div id = "bg"><img id = "background_image" src = "images/background.png" width = "100%" height = "100%" /></div>

	<div id = "wrapper">
    	<div id = "header">
        	<a href = "index.html"><img border = "0" id = "logo_img" src = "images/logo.png" /></a>
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
            <ol id = "content_bottom_isbn" class = "content_list">
            	<li class = "content_list_isbn" id = "iframe"><span <?php if ($bn == 1) {echo "class = 'hidden' "; $url = '';} ?> id = "iframe_content"><?php
			echo <<< EOT
				<img id = 'another' src = "images/another_course.png" onclick = "refreshIframe()"></img><br /><img src = 'images/carpet.png' id = 'iframeBorder' /><iframe id = 'bookIframe' src = {$url} width='525px' height = '570px'></iframe></span>
EOT;
		if ($bn == 1)
			echo "<img src = 'images/carpet.png' id = 'iframeBorder_bn' /><img src = 'images/showme.png' id = 'bigButton' onclick = 'createPopup()' />";
	?></li>
				<li class = "content_list_isbn" id = "arrow"><?php if($title == 0) echo '<img  id = "arrow_img" src = "images/arrow.png">'; ?></li>
				<li class = "content_list_isbn" id = "form">
					<form id = "isbnForm" method = "post" action = "transfer.php">
						<span id = "inputs"><?php for ($i = 0; $i < 6; $i++){ 
							if ($title == 0)
								echo "<div class = 'isbn_item'><div class = 'isbnContainer'><input name = \"isbn{$i}\" class = \"isbnInput\" value = '{$isbns[$i]}' type='text'></input></div></div>";
							else if($title == 1)
								echo "<div class = 'titleContainer'><input name = 'title{$i}' value='{$titles[$i]}' class = 'titleInput' type='text'></input><br /><input value = '{$authors[$i]}' name = 'author{$i}' class = 'authorInput' type='text'></input></div>";	
							}
							?></span>
						<br />
						<input type = "Hidden" name = "dbname" value = '<?php echo $dbName ?>' />
						<input type = 'Hidden' name = 'title' value = '<?php echo $title ?>' />
						<input type = "Hidden" name = "bookstore" value = '<?php echo $bookstoreName ?>' />
						<input type = "Hidden" name = "wuid" value = '<?php echo $wuid ?>' />
						<input type = "image"  src = "images/go_isbn.png" />
						<br />
						<img class = 'pointer' src = "images/another.png" onclick = "<?php if ($title == 0) echo 'addBox()'; else echo 'addTitleBox()' ?>"></img>
					</form>
				</li></span>
            </ol>
        </div>
    	<div id = "footer">
    		<img id = "footer_img" src = "images/footer.png" />
   		</div>
	</div>

</body>
</html>
