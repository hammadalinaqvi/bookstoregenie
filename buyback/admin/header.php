<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//session_destroy();
$lifetime=100000000;
session_start();
$_SESSION['recent_url']="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(!isset($_SESSION['admin_array']['username']) || !isset($_SESSION['admin_array']['password']) )
{
	header('location:http://'.$_SERVER['HTTP_HOST'].'/admin.php');
}	
setcookie(session_name(),session_id(),time()+$lifetime);
if(isset($_SESSION['sell_listISBN']))
{

	$listISBN = $_SESSION['sell_listISBN'];
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
$xajax->register(XAJAX_FUNCTION, 'removeBookFromList');
$xajax->register(XAJAX_FUNCTION, 'addNew');
$xajax->processRequest();
function reloadPage($isbn)
	{
		require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";	

		$response = new xajaxResponse();
		
		/*$listISBN = $_SESSION['sell_listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$tempList .= $key.",";
		}
		
		$tempList .= $isbn;
		
		//addtocart($isbn);
		$response->redirect('http://'.$_SERVER['HTTP_HOST'].'/sell/sellbook.php?isbns='.$tempList);*/
		$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
		$result_query = $mysqli->query('SELECT theme_name FROM jteplitz_bookstore.bookstore_settings WHERE status="1"');
		$row = $result_query->fetch_assoc();
		
		if($row['theme_name']=='sell')
		{
			$listISBN = $_SESSION['sell_listISBN'];
		}else if($row['theme_name']=='rent')
		{
			$listISBN = $_SESSION['listISBN'];
		}
		
		//$listISBN = $_SESSION['sell_listISBN'];
		
		//$shit = count($listISBN);
			foreach($listISBN as $key => $value)
			{
				$tempList .= $key.",";
			}
			
			$tempList .= $isbn;
			
			if($row['theme_name'] == 'sell')
			{
				$$response->redirect("http://".$_SERVER['HTTP_HOST']."/sell/sellbook.php?isbns=".$tempList);
				
			}else if($row['theme_name'] == 'rent')
			{

				$response->redirect("http://".$_SERVER['HTTP_HOST']."/rentbook.php?isbns=".$tempList);
			}else
			{
				$response->redirect("http://".$_SERVER['HTTP_HOST']."/rentbook.php?isbns=".$tempList);
			}
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
		<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/buyback/js/colorbox/example1/colorbox.css" />


		 <style>
      body {
        padding-top: 105px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      .tbl-header {
				padding: 8px 35px 8px 14px;
				margin-bottom: 20px;
				text-shadow: 0 1px 1px #000;
				background-color: #333333;
				border: 1px solid #555;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				border-radius: 4px;
				color: #eee;
			}
			.tbl-header th{
				border: 1px solid #555 !important;
			}
			td, tr{
				font-size: 12px !important;
				font-weight: bold;
			}
			td.low, tr.low{
				background: #bae0d3 !important;
			}
			td.medium, tr.medium{
				background: #75c7a4 !important;
			}
			td.high, tr.high{
				background: #38ad79 !important;
			}
			.modal {
				width: 1100px;
				margin: -250px 0 0 -556px;
			}
				
    </style>


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
          <a class="brand" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/index.php" target="_blank"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/logo.png"/></a>
            <ul class="nav">
              <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/rentbook.php" target="_blank">Rent</a></li>
              <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/sellbook.php" target="_blank">Sell</a></li>
            </ul>
            <!--<form class="form-search pull-left" onSubmit="var isbn=document.getElementById('inSearchText').value;  xajax_reloadPage(isbn); return false;">
						  <div class="input-append">
						    <input type="text" class="span4 search-query top-field" id="inSearchText"placeholder="Enter your ISBN number(s)"  onClick="if(this.value=='Add more books') this.value='';">
                            <button type="submit" class="top-field btn bsg-btn" onClick = "var isbn=document.getElementById('inSearchText').value; xajax_reloadPage(isbn); return false;">&rarr;</button>
						  </div>
						</form>
						<div class="span1 pull-left cart-area">
							<?php if((isset($_SESSION['sell_listISBN']) && $_SESSION['sell_listISBN'] )){?><span class="bsg-badge badge badge-success"><?php echo count($_SESSION['sell_listISBN']);?></span><?php }?>
							<button type="submit" class="btn btn-medium btn-block bsg-btn pull-left top-field" onClick='var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/sellbook.php"; window.location=url;' href="" title="Send money"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/shoppingcart.png"/></button>-->
                             <?php 
			$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
			$result_query = $mysqli->query('SELECT theme_name FROM jteplitz_bookstore.bookstore_settings WHERE status="1"');
			$row = $result_query->fetch_assoc();
			?>
            <!--<form class="form-search pull-left" onSubmit="var isbn=document.getElementById('inSearchText').value;  xajax_reloadPage(isbn); return false;" style="float: left;">
						  <div class="input-append" style="display: inline-block;">
						    <input type="text" class="span4 search-query top-field" id="inSearchText"placeholder="Enter your ISBN number(s)"  onClick="if(this.value=='Add more books') this.value='';">
                            <button type="submit" class="top-field btn bsg-btn" onClick ="var isbn=document.getElementById('inSearchText').value; xajax_reloadPage(isbn);return false;">&rarr;</button>
						  </div>
						</form>-->
                        <?php 
							if($row['theme_name']=='sell')
							{
							  $cart_url='https://bookstoregenie.zigron.com/sell/sellbook.php?isbns=';	
							}else if($row['theme_name']=='rent')
							{
								$cart_url='https://bookstoregenie.zigron.com/rentbook.php?isbns=';
							}
						?>
                          <form class="form-search pull-left" onsubmit='var isbns = document.getElementById("inSearchText").value;var re = new RegExp("^[0-9Xx,;: ]+$"); if(isbns.match(re)){var url = "<?php echo $cart_url;?>"+isbns; window.location = url;return false;}else{alert("Please enter only ISBN numbers in your search.  Thank you!");return false;}'>
						  <div class="input-append">
						    <input type="text" class="span4 search-query top-field" id="inSearchText"placeholder="Enter your ISBN number(s)"  onClick="if(this.value=='Add more books') this.value='';">
                            <button type="submit" class="top-field btn bsg-btn" onClick = 'var isbns = document.getElementById("inSearchText").value;var url = "<?php echo $cart_url;?>"+isbns; window.location = url;return false;'>&rarr;</button>
						  </div>
						</form>
						<div class="span1 pull-left cart-area">
                        
							<?php
							
							if($row['theme_name']=='sell')
							{
								if(isset($_SESSION['sell_listISBN']) && $_SESSION['sell_listISBN']){
									  $count_cart=count($_SESSION['sell_listISBN']);
									 }
									 
							}else if($row['theme_name']=='rent')
							{
								if(isset($_SESSION['listISBN']) && $_SESSION['listISBN']){
									  $count_cart=count($_SESSION['listISBN']);
									 }								
							}
							 ?>
                             <?php if(isset($count_cart)){?><span class="bsg-badge badge badge-success"><?php echo $count_cart;?></span><?php }?>
                             <?php 
							 if($row['theme_name']=='sell')
							{
							 ?>
							<button type="submit" class="btn btn-medium btn-block bsg-btn pull-left top-field" onClick='var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/sellbook.php"; window.location=url;' href="" title="Send money"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/shoppingcart.png"/></button>
                            <?php }else if($row['theme_name']=='rent'){?>
                            <button type="submit" class="btn btn-medium btn-block bsg-btn pull-left top-field" onClick='var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/rentbook.php"; window.location=url;' href="" title="Send money"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/shoppingcart.png"/></button>
                            <?php }
							$mysqli->close();
							?>
						</div>
						<div class="dropdown droppy">
						  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/images/dropdown.png"/></a>
						  <ul class="pull-right dropdown-menu" role="menu" aria-labelledby="dLabel">
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/rentbook.php" target="_blank">Rent now</a></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/about.php" target="_blank">About us</a></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/trustTheGenie.php" target="_blank">Trust the Genie</a></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/beAGenie.php" target="_blank">Be a Genie</a></li>
						    <li class="divider"></li>
						    <li><a tabindex="-1" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/contact.php" target="_blank">Contact us</a></li>
						  </ul>
						</div>
        </div>
      </div>
    </div>
