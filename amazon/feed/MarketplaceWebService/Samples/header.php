<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//session_destroy();
$lifetime=100000000;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);
$page_title=explode('/',$_SERVER['REQUEST_URI']);	

if(isset($_SESSION['sell_listISBN']))
{

	$listISBN = $_SESSION['sell_listISBN'];
}else if(!isset($_SESSION['sell_listISBN']) && $page_title[6]=='submitBookFeed.php') 
{

	$listISBN = array();
	header("location:http://".$_SERVER['HTTP_HOST']."/sell/sellbook.php/");
}
else
{

	$listISBN = array();
}
//print_r($_SERVER);
include $_SERVER['DOCUMENT_ROOT']."/sell/xajax/xajax_core/xajax.inc.php";

$xajax = new xajax();

$xajax->configure("javascript URI","http://".$_SERVER['HTTP_HOST']."/sell/xajax/");	
$xajax->register(XAJAX_FUNCTION, 'reloadPage');


$xajax->processRequest();



function reloadPage($isbn)
	{
		require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";	

		$response = new xajaxResponse();
		
		$listISBN = $_SESSION['sell_listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$tempList .= $key.",";
		}
		
		$tempList .= $isbn;
		
		//addtocart($isbn);
		$response->redirect("http://".$_SERVER['HTTP_HOST']."/sell/sellbook.php?isbns=".$tempList);
		return $response;
	}

//include($_SERVER['DOCUMENT_ROOT']."/sell/includes/functions.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bookstoregenie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
		<meta name="csrf-param" content="authenticity_token"/> 
		<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/> 

    <!-- Le styles -->
      <link href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/css/bootstrap.css" rel="stylesheet">
      <link href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/css/all.css" rel="stylesheet"/> 
        <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/css/validation.css" type="text/css" />
			<link href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/css/filter.css" rel="stylesheet"/> 
			<link href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/css/style2.css" rel="stylesheet"/>
			<link href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/css/style.css" rel="stylesheet"/>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/ico/apple-touch-icon-57-precomposed.png">
  </head>
  
<?php
$xajax->printJavascript();
if($_SESSION['sell_listISBN']){
//echo $_SESSION['tester'];
echo "<body class=\"in\" onload=\"setCookie('results','".$values."','10'); updateTotal();\">";
}else
{
echo "<body>";	
}

?>
<!--
  <body class="in" onload="setCookie('results','(0073527114,0,1);','10'); updateTotal();">
-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/index.php"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/logo.png"/></a>
            <ul class="nav">
              <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/rentbook.php">Rent</a></li>
              <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/sellbook.php">Sell</a></li>
            </ul>
            <form class="form-search pull-left" onsubmit='var isbns = document.getElementById("inSearchText").value;var re = new RegExp("^[0-9Xx,;: ]+$"); if(isbns.match(re)){var url = "https://bookstoregenie.zigron.com/index.php?isbns="+isbns; window.location = url;return false;}else{alert("Please enter only ISBN numbers in your search.  Thank you!");return false;}'>
						  <div class="input-append">
						    <input type="text" class="span4 search-query top-field" id="inSearchText"placeholder="Enter your ISBN number(s)"  onClick="if(this.value=='Add more books') this.value='';">
                            <button type="submit" class="top-field btn bsg-btn" onClick = 'var isbns = document.getElementById("inSearchText").value;var re = new RegExp("^[0-9Xx,;: ]+$"); if(isbns.match(re)){var url = "https://bookstoregenie.zigron.com/sell/sellbook.php?isbns="+isbns; window.location = url;return false;}else{alert("Please enter only ISBN numbers in your search.  Thank you!");return false;}'>&rarr;</button>
						  </div>
						</form>
						<div class="span1 pull-left cart-area">
							<?php if((isset($_SESSION['sell_listISBN']) && $_SESSION['sell_listISBN'] )){?><span class="bsg-badge badge badge-success"><?php echo count($_SESSION['sell_listISBN']);?></span><?php }?>
							<button type="submit" class="btn btn-medium btn-block bsg-btn pull-left top-field" onClick='var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/sellbook.php"; window.location=url;' href="" title="Send money"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/shoppingcart.png"/></button>
						</div>
						<div class="dropdown droppy">
						  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/dropdown.png"/></a>
						  <ul class="pull-right dropdown-menu" role="menu" aria-labelledby="dLabel">
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/rentbook.php" >Rent now</a></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/about.php" >About us</a></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/trustTheGenie.php" >Trust the Genie</a></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/beAGenie.php" >Be a Genie</a></li>
						    <li class="divider"></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/contact.php" >Contact us</a></li>
						  </ul>
						</div>
        </div>
      </div>
    </div>
