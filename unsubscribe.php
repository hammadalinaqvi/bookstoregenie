<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unsubscribe</title>
<!--<script src = "script/prototype.js" language="javascript" type="text/javascript"></script>-->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" media="all"/>
<link rel = "stylesheet" type = "text/css" href = "style/main.css" />
<script language="javascript" type="text/javascript" src="script/autocomplete.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" type="text/javascript"></script>
 <script src="script/combobox.js"></script>
<script src = "script/jquery.dropshadow.js" type = "text/javascript"></script>
<script src = "script/jquery.loading.1.6.4.js" type = "text/javascript"></script>
<link rel="SHORTCUT ICON" type = "image/x-icon" href="images/genie.ico"/>
<link rel = "stylesheet" type = "text/css" href = "style/jquery.loading.1.6.css" /><!--[if lte IE 7]>
<style>
#interfaceContainer{
	background-image: url(../images/interfacebg.png);
	width: 928px;
	height: 286px;
	text-align: left;
	font-family: Arial;
	margin-left: 50px;
	margin-top: 30px;
}
#isbnContainer{
	background-image: url(../images/isbnbg.png);
	width: 928px;
	height: 170px;
	margin-left: 50px;
	margin-top: 30px;
	float: left;
}
#search{
	font-size: 20px;
	font-family: Verdana, Geneva, sans-serif;
	background: none;
	border: none transparent;
	width: 620px;
	height: 34px;
	float: left;
	position: relative;
	z-index: 10;
	padding-left: 10px;
	position: relative;
	left: -60px;
}
</style>
<![endif]-->
<style>
	#message{
		padding-top: 60px;
		font-family: Verdana, Geneva, sans-serif;
	}
	#continue_btn{
		padding-top: 10px;
	}
</style>
<script>
function dounsubscribe(){
$.loading(true, {mask:true, img: "http://www.bookstoregenie.com/images/loading.gif", align: "center"});
	$.ajax({
		url: "removeemail.php",
		type: "POST",
		data: {"email": "<?php echo $_REQUEST['email'] ?>"},
		success: function(){
			$.loading(false);
			alert("You have been unsubscribed from the bookstoregenie mailing list");
		}
	});
}
</script>
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
			<div id = "isbnContainer" style = "display:block;" class = "">
				<div id = 'message'>This will permanantly stop you from receiving emails from bookstoregenie.com.</div>
				<img class = 'pointer' id = 'continue_btn' onclick = "dounsubscribe()" src = 'http://www.bookstoregenie.com/images/continue.png' />
			</div>
    	<div id = "footer">
    		<img src = "images/footer.png" />
   		</div>
	</div>
</body>
</html>
