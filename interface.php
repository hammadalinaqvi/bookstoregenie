<?php
$name	  = $_GET['name'];
$internal = $_GET['internal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "<title>{$name} Bookstore By The Bookstore Genie</title>"; ?>
<link rel = "stylesheet" type = "text/css" href = "style/main.css" />
<link rel = "stylesheet" type = "text/css" href = "style/interface.css" />
<script src = "script/prototype.js" language="javascript" type="text/javascript"></script>
<script type = "text/javascript">
var term;
<?php
	echo <<< EOT
	var internal = '{$internal}';
	var name = '{$name}';
	
EOT;
?>
window.onload = function(){
	new Ajax.Request("fetch.php", {
		method: 'get',
		parameters: 'terms',
		onSuccess: function (transport){
			term = eval(transport.responseText);
			for (var i = 0; i < term.length; i++){
				var element = document.createElement("div");
				element.innerHTML = term[i];
				element.setAttribute("id", "term" + i);
				element.setAttribute("class", "dataRow");
				element.setAttribute("onClick", "rowClicked(this, 'term'," + i + ")");
				document.getElementById("terms").appendChild(element);
			}
		},
		onFailure: function (transport){
		}
	});
}

function rowClicked(element, type, index){
	element.setAttribute("class", "dataClicked");
	
	// unhighlight the other rows
	for (var i = 0; i < type.length; i++){
		if (i != index){
			var secondElement = document.getElementById(type + i);
			secondElement.setAttribute('class', "dataRow");
		}
	}
}
</script>
</head>

<body>
<div id = "bg"><img id = "background_image" src = "images/background.png" width = "100%" height = "100%" /></div>

	<div id = "wrapper">
    	<div id = "header">
        	<a href = "../index.html"> <img id = "logo_img" src = "images/logo.png" /> </a>
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
		<ol id = "content_bottom" class = "content_list">
		<div id = "interface">
			<div id = "terms" class = "interfaceContainer">
				<div class = "interfaceTitle">Term</div>
			</div>
			<div id = "departments" class = "interfaceContainer">
				<div class = "interfaceTitle">Department</div>
			</div>
			<div id = "courses" class = "interfaceContainer">
				<div class = "interfaceTitle">Course</div>
			</div>
			<div id = "sections" class = "interfaceContainer">
				<div class = "interfaceTitle">Section</div>
			</div>
		</div>
</ol>
        </div>
    	<div id = "footer">
    		<img id = "footer_img" src = "images/footer.png" />
   		</div>
	</div>

</body>
</html>