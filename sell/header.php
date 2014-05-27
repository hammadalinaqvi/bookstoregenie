<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//session_destroy();
$lifetime=100000000;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);
$page_title=explode('/',$_SERVER['REQUEST_URI']);

if(isset($_SESSION['sell_listISBN']))
{
	$listISBN = $_SESSION['sell_listISBN'];
}
else 
if((!isset($_SESSION['sell_listISBN']) && $page_title[2]=='bookorder.php') || (isset($_SESSION['sell_listISBN']) && !$_SESSION['sell_listISBN'] && $page_title[2]=='bookorder.php') ) 
{
	//$listISBN = array();
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
$xajax->register(XAJAX_FUNCTION, 'removeBookFromList');
$xajax->register(XAJAX_FUNCTION, 'addUsed');
$xajax->register(XAJAX_FUNCTION, 'decreaseUsed');
$xajax->register(XAJAX_FUNCTION, 'addNew');
$xajax->register(XAJAX_FUNCTION, 'decreaseNew');
$xajax->register(XAJAX_FUNCTION, 'checkOut');


$xajax->processRequest();


function addUsed($isbn)
{
require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";
$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['sell_listISBN'];
$shit = count($listISBN);
foreach($listISBN as $key => $value)
{
if($key == $isbn)
{
	$book = $listISBN[$key];
	break;

	//$found = $book->getAuthor();

}
}

$book = unserialize($book);
$book = (object)$book;

$book->addUsedQuantity();
$book->updateTotal();
$price = $book->getSubTotal();
//$html = get_declared_classes();

$book = serialize($book);
$listISBN[$isbn] = $book;
$_SESSION['sell_listISBN'] = $listISBN;

//$response->assign('fuckme', 'innerHTML', $price);
$response->assign('buybuy', 'innerHTML', "");
return $response;
}

function decreaseUsed($isbn)
{
require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";
$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['sell_listISBN'];
$shit = count($listISBN);
foreach($listISBN as $key => $value)
{
if($key == $isbn)
{
	$book = $listISBN[$key];
	break;

	//$found = $book->getAuthor();
}
}

$book = unserialize($book);
$book = (object)$book;

$book->decreaseUsedQuantity();
$book->updateTotal();
$price = $book->getSubTotal();

$book = serialize($book);
$listISBN[$isbn] = $book;
$_SESSION['sell_listISBN'] = $listISBN;

$response->assign('buybuy', 'innerHTML', "");
//$response->assign('fuckme', 'innerHTML', $price);
return $response;
}

function addNew($isbn)
{
require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";
$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['sell_listISBN'];
$shit = count($listISBN);
foreach($listISBN as $key => $value)
{
if($key == $isbn)
{
	$book = $listISBN[$key];
	break;

	//$found = $book->getAuthor();
}
}

$book = unserialize($book);
$book = (object)$book;

$book->addNewQuantity();
$book->updateTotal();
$price = $book->getSubTotal();

$book = serialize($book);
$listISBN[$isbn] = $book;
$_SESSION['sell_listISBN'] = $listISBN;

//$response->assign('fuckme', 'innerHTML', $price);
$response->assign('buybuy', 'innerHTML', "");
return $response;
}

function decreaseRent($isbn)
{
require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";

$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['sell_listISBN'];
$shit = count($listISBN);
foreach($listISBN as $key => $value)
{
if($key == $isbn)
{
	$book = $listISBN[$key];
	break;
	//$found = $book->getAuthor();
}
}
if(($book == null) || ($book == ""))
{$fucker = "bad";
}
else
{$fucker = "good";
}

$book = unserialize($book);
$book = (object)$book;

$book->decreaseNewQuantity();
$book->updateTotal();
$price = $book->getSubTotal();

$book = serialize($book);
$listISBN[$isbn] = $book;
$_SESSION['sell_listISBN'] = $listISBN;

//$response->assign('fuckme', 'innerHTML', $price);
$response->assign('buybuy', 'innerHTML', "");
return $response;
}

function removeBookFromList($isbn)
{
//	session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";
$response = new xajaxResponse();

$listISBN = $_SESSION['sell_listISBN'];

$shit = count($listISBN);
//$number = $_SESSION['tester'];

foreach($listISBN as $key => $value)
{
if($key == $isbn)
{
	$book = $listISBN[$key];
	unset($listISBN[$isbn]);
	break;

}
}

if(($book == null) || ($book == ""))
{$fucker = "bad";
}
else
{$fucker = "good";
}

//$book = unserialize($book);
//$book = (object)$book;
//$temp = new Book();
//$temp = $book();
//$book = (Book)$book;
//$author = $book->getAuthor();
$count = count($listISBN);
$_SESSION['sell_listISBN'] = $listISBN;

//$response->assign('buybuy', 'innerHTML', "");
$response->redirect("sellbook.php");
return $response;
}
function reloadPage($isbn)
	{
		require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";	

		$response = new xajaxResponse();
		$listISBN = $_SESSION['sell_listISBN'];
		//$listISBN = $_SESSION['sell_listISBN'];
		//$shit = count($listISBN);
			foreach($listISBN as $key => $value)
			{
				$tempList .= $key.",";
			}
			
			$tempList .= $isbn;
			
				//$response->redirect("http://".$_SERVER['HTTP_HOST']."/sell/sellbook.php?isbns=".$tempList);
				
			//addtocart($isbn);
			$response->redirect("http://".$_SERVER['HTTP_HOST']."/sell/sellbook.php?isbns=".$tempList);
		
		return $response;
	}
function checkOut()
	{
		$response = new xajaxResponse();
		//$response->alert("Yo that ain't in the database man!");
		require_once $_SERVER['DOCUMENT_ROOT']."/sell/includes/Book_sell.php";	
		$listISBN = $_SESSION['sell_listISBN'];
		
		$index=0;
		
		foreach($listISBN as $key => $value)
			{
				$book = $listISBN[$key];
				$book = unserialize($book);
				$book = (object)$book;
				if(($book->getNewQuantity() >0 ||  $book->getUsedQuantity() >0) )
				{ 
					$index++;
					$value=true;
					
				}else
				{
					$response->alert("The New or Used Quantity Field is empty!!");
					$index--;
					return $response;
					return false;
				}
			 	
		}
		
		/*if(true)
		{
			$response->redirect("bookorder.php");
			return $response;
		}*/
	
		if((count($listISBN)==$index && $value==true))
		 {
			 $index=0;
			 //CheckoutPage();
			$response->redirect("bookorder.php");
			//return $response;	
		 }
 

		return $response;
	}
function CheckoutPage()
{
	header('location:bookorder.php');
}			

include($_SERVER['DOCUMENT_ROOT']."/sell/includes/functions.php");

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

	$list = $_GET["isbns"];

	$listISBN = $_SESSION['sell_listISBN'];
	$isbn_array = count($listISBN);
	if($isbn_array > 0)
	{
		$list .= ",";
	}
	$counter = 0;
	foreach($listISBN as $key => $value)
	{
		$counter++;
		$list .= $key;
		if($counter < $isbn_array)
		{
			$list.= ",";	
		}
	}
	$list = trim($list);
	$list = str_replace(" ",",",$list);
	$list = str_replace(";",",",$list);
	$list = str_replace(":",",",$list);
	$list = str_replace(",,",",",$list);
	$isbns = explode(",",$list);
	
	$isbns = array_unique($isbns);
	$count = count($isbns);

	for($i = 0; $i < $count; $i++)
	{
		//echo "isbn_array<br>";
		$isbn = trim($isbns[$i]);
		
		$isbn = str_replace("-","",$isbn);
		$isbn = str_replace(" ","",$isbn);
	if(strlen($isbn)==10)
	{
		$isbn10 = $isbn;
	}
	else
	{
		if (preg_match('/^\d{3}(\d{9})\d$/', $isbn, $m)) {
				$sequence = $m[1];
				$sum = 0;
				$mul = 10;
				for ($i = 0; $i < 9; $i++) {
						$sum = $sum + ($mul * (int) $sequence{$i});
					$mul--;
				 }
				$mod = 11 - ($sum%11);
				if ($mod == 10) {
						$mod = "X";
				}
				else if ($mod == 11) {
						$mod = 0;
				}
				$isbn = $sequence.$mod;
		}		
		$isbn10 = $isbn;
		
	}
	if(array_key_exists($isbn10, $listISBN))
	{
		$book = $listISBN[$isbn10];
		
		$book = unserialize($book);
		$book = (object)$book;
		$newNumber = $book->getNewQuantity();
		$usedNumber = $book->getUsedQuantity();
		$rentNumber = $book->getRentQuantity();
		$values .= "(".$isbn10.",$newNumber,$usedNumber);";
	}
	else
	{
		$temp = getRentalPrice($isbn10);
		//exit;
		
		if($temp)
		{
		   
			if($temp->getNewPrice() == 0)
			{
				
				$resultStatus = "Sorry, we do not carry one or more of your books!!";
			}
			else if(($temp->getTitle() != null) && ($temp->getTitle() != ""))
			{
				
				$temp->addUsedQuantity();
				$temp->updateTotal();
				$temp = serialize($temp);
				$listISBN[$isbn10]=$temp;
				$values .= "(".$isbn10.",0,1);";
			}
			else
			{
				
				$resultStatus = "Some books were not found!  Please be sure to only enter ISBN(s).";
			}
			
		}
		else
		{
			$resultStatus = "<font color='red'>Some books were not found!  Please be sure to only enter ISBN(s).</font>";
		}
		
	}
	    

	}
	$_SESSION['sell_listISBN'] = $listISBN;
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
                            <?php }?>
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
