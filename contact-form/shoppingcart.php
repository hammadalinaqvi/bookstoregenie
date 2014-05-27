<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_destroy();
	
	//$tempSession = session_id();
	
	//session_destroy();
	$lifetime=100000000;
 	session_start();
	setcookie(session_name(),session_id(),time()+$lifetime);
	//echo "hello";
	//print_r($_SESSION['listISBN']);
	if(isset($_SESSION['listISBN']))
	{
		
		$listISBN = $_SESSION['listISBN'];
	}
	else
	{
		
		$listISBN = array();
	}
include 'xajax/xajax_core/xajax.inc.php';
$xajax = new xajax();
$xajax->configure("javascript URI","xajax/");	
$xajax->register(XAJAX_FUNCTION, 'reloadPage');
$xajax->register(XAJAX_FUNCTION, 'removeBookFromList');
$xajax->register(XAJAX_FUNCTION, 'addUsed');
$xajax->register(XAJAX_FUNCTION, 'decreaseUsed');
$xajax->register(XAJAX_FUNCTION, 'addRent');
$xajax->register(XAJAX_FUNCTION, 'decreaseRent');


$xajax->processRequest();


function addUsed($isbn)
{
require_once "Book.php";
$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['listISBN'];
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
$_SESSION['listISBN'] = $listISBN;

//$response->assign('fuckme', 'innerHTML', $price);
$response->assign('buybuy', 'innerHTML', "");
return $response;
}

function decreaseUsed($isbn)
{
require_once "Book.php";
$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['listISBN'];
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
$_SESSION['listISBN'] = $listISBN;

$response->assign('buybuy', 'innerHTML', "");
//$response->assign('fuckme', 'innerHTML', $price);
return $response;
}

function addRent($isbn)
{
require_once "Book.php";
$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['listISBN'];
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

$book->addRentQuantity();
$book->updateTotal();
$price = $book->getSubTotal();

$book = serialize($book);
$listISBN[$isbn] = $book;
$_SESSION['listISBN'] = $listISBN;

//$response->assign('fuckme', 'innerHTML', $price);
$response->assign('buybuy', 'innerHTML', "");
return $response;
}

function decreaseRent($isbn)
{
require_once "Book.php";

$response = new xajaxResponse();

//$book = "";
$listISBN = $_SESSION['listISBN'];
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

$book->decreaseRentQuantity();
$book->updateTotal();
$price = $book->getSubTotal();

$book = serialize($book);
$listISBN[$isbn] = $book;
$_SESSION['listISBN'] = $listISBN;

//$response->assign('fuckme', 'innerHTML', $price);
$response->assign('buybuy', 'innerHTML', "");
return $response;
}

function removeBookFromList($isbn)
{
//	session_start();
require_once "Book.php";
$response = new xajaxResponse();

$listISBN = $_SESSION['listISBN'];

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
$_SESSION['listISBN'] = $listISBN;

$response->assign('buybuy', 'innerHTML', "");

return $response;
}
function reloadPage($isbn)
	{
		require_once "includes/Book.php";	

		$response = new xajaxResponse();
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$tempList .= $key.",";
		}
		
		$tempList .= $isbn;
		
		//addtocart($isbn);
		$response->redirect("shoppingcart.php?isbns=".$tempList);
		return $response;
	}

include("includes/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<link rel="stylesheet" href="css/style.css"  />
<link rel="stylesheet" type="text/css" href="css/tooltip.css"/>
<style type="text/css">
span{ cursor: pointer;}​

</style>
<script type="application/javascript"  src="js/jquery.min 1.4.4.js"></script>
<script type="application/javascript"  src="js/application.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".comparePrices").tooltip({ effect: 'slide'});
});
</script>
</head>
<?php
$xajax->printJavascript();

	$list = $_GET["isbns"];

	$listISBN = $_SESSION['listISBN'];
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
		$values .= "(".$isbn10.",$usedNumber,$rentNumber);";
	}
	else
	{
		$temp = getRentalPrice($isbn10);
		
		if($temp)
		{
		   
			if($temp->getNewPrice() == 0)
			{
				
				$resultStatus = "Sorry, we do not carry one or more of your books!!";
			}
			else if(($temp->getTitle() != null) && ($temp->getTitle() != ""))
			{
				
				$temp->addRentQuantity();
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
	$_SESSION['listISBN'] = $listISBN;

//echo $_SESSION['tester'];
echo "<body class=\"in\" onload=\"setCookie('results','".$values."','10'); updateTotal();\">";
?>
<form class="inSearch"  onSubmit="var isbn=document.getElementById('inSearchText').value;  xajax_reloadPage(isbn); return false;"> 
									<input type="text" id="inSearchText" name="isbn" value="Add more books" class="text" onClick="if(this.value=='Add more books') this.value='';" /> 
									<input type="submit" value="Add books" class="button" onClick = "var isbn=document.getElementById('inSearchText').value; xajax_reloadPage(isbn); return false;"/> 
									<div style="clear:both;"></div> 
                                  <div class="grid_12 alpha omega">
            	
						<div class="stepTwo"> 
						
							<div class="left-col">  
                                    <div class="bookResults"> 
								
										<div id="book-start" /> 
						
						<?php
						
						
						$book_data = $_SESSION['listISBN'];
//						

						foreach($book_data as $key => $value)
						{
							
							$tempBook = $listISBN[$key];
							$tempBook = unserialize($tempBook);
							$html = "<div class=\"book\" id=\"book".$tempBook->getISBN()."\">";
							$html .= "<div class=\"head\">";
							$html .= "<div class=\"isbn\">";
							$html .= "ISBN <strong>".$tempBook->getISBN()."</strong></div>";
							$html .= "<a href=\"#-remove-this-book\" class=\"remove\" onClick=\" removeBook('".$tempBook->getISBN()."'); return xajax_removeBookFromList('".$tempBook->getISBN()."');\" >Remove this book</a></div>";
							$html .= "<div class=\"content\"> ";
							$html .= "<img src=\"".$tempBook->getImage()."\" alt=\"Book Cover\" /> ";
							$html .= "<div class=\"title\"><small>";	
							$html .= $tempBook->getAuthor()."</small>";
							$html .= "<strong>".$tempBook->getTitle()."</strong></div>";
							$html .= "<div class=\"prices\"><div class=\"new\"><div class=\"counter\">";
							$html .= "<input type=\"text\" id=\"newpcs".$tempBook->getISBN()."\" value=\"0\" DISABLED />";				
							$html .= "<a href=\"#\" title=\"+\" onClick=\"xajax_addUsed('".$tempBook->getISBN()."'); increment('newpcs".$tempBook->getISBN()."'); return false;\" class=\"plus\">+</a>";
							$html .= "<a href=\"#\" title=\"-\" onClick=\" xajax_decreaseUsed('".$tempBook->getISBN()."'); decrement('newpcs".$tempBook->getISBN()."'); return false;\" class=\"minus\">-</a></div> ";
							$html .= "<div class=\"price\"><small>BUY IT</small> <span id=\"newPrice".$tempBook->getISBN()."\" >$".$tempBook->getUsedPrice()."</span></div></div>";
							$html .= "<div class=\"used\"><div class=\"counter\"> <input type=\"text\" id=\"usedpcs".$tempBook->getISBN()."\" value=\"0\" DISABLED />  ";
							$html .= "<a href=\"#\" title=\"+\" onClick=\"xajax_addRent('".$tempBook->getISBN()."'); increment('usedpcs".$tempBook->getISBN()."'); return false;\" class=\"plus\">+</a>";
							$html .= "<a href=\"#\" title=\"-\" onClick=\"xajax_decreaseRent('".$tempBook->getISBN()."'); decrement('usedpcs".$tempBook->getISBN()."'); return false;\" class=\"minus\">-</a></div> ";
							$html .= "<div class=\"price\"><small>RENT IT</small> <span id=\"usedPrice".$tempBook->getISBN()."\" >$".$tempBook->getRentPrice()."</span></div></div>";
							
							$html .= "<a class=\"comparePrices\"></a>
									<div class=\"tooltip makeitDark\">
										<div class=\"compare\">
											<div class=\"compareCo\">
												<a href=\"".$tempBook->getCheggLink()."\" target=\"_blank\"><img src=\"images/chegg.jpg\" alt=\"Chegg\"/></a><p>";
							
							
							if($tempBook->getChegg()  == 0)
							{
								$html .= "";
							}
							else
							{
								$html .= "$".number_format($tempBook->getChegg(),0);
							}
							
							$html .= "</p>
											</div>
											<div class=\"compareCo\">
												<a href=\"".$tempBook->getCbrLink()."\" target=\"_blank\"><img src=\"images/bookRentals.jpg\" alt=\"Campus Book Rentals\"/></a><p>";
												
							if($tempBook->getCbr()  == 0)
							{
								$html .= "";
							}
							else
							{
								$html .= "$".number_format($tempBook->getCbr(),0);
							}
												
							$html .= "</p>
											</div>
											<div class=\"compareCo\">
												<a href=\"".$tempBook->getBrLink()."\" target=\"_blank\"><img src=\"images/bn.gif\" alt=\"Book Renter\"/></a><p>";
												
							if($tempBook->getBr()  == 0)
							{
								$html .= "";
							}
							else
							{
								$html .= "$".number_format($tempBook->getBr(),0);
							}
												
							$html .= "</p>
											</div>
										</div> <!-- end compare -->
									</div><!-- end tool tip -->";
							
							$html .= "<div class=\"subtotal\"><small>Subtotal</small> <span id=\"Subtotal".$tempBook->getISBN()."\"> $0.0 </span></div></div> </div></div>  ";
							echo $html;
							
						}
						 										
											
						?>
				</div>
                </div>
                </div>
								
								<div class="footer"> 
									<p> 
										<strong>Books</strong> 
										<span id="totalBooks" > 0</span> 
									</p> 
									<p> 
										<strong>Purchased</strong> 
										<span id="totalNewBooks" > 0</span> 
									</p> 
									<p> 
										<strong>Rented</strong> 
										<span id="totalUsedBooks" > 0</span> 
									</p> 
									<p> 
										<strong>SubTotal</strong> 
										
										<span id="totalPrice"> 0.00 </span> 
									</p> 
									<a  title="Add to Cart" onClick="xajax_checkOut(); return false;">Check Out</a> 
								</div> 
								
								
								<div id="buybuy"></div>
								<br><br><br><br><br>
							</div>
									<div id="div-error" style="padding-left: 10px; color: red;"></div> 
                                    <div class="summary"> 
							<h3>Rental Summary</h3>
							<p> 
								Total Books <strong id="totalBooks1">0</strong> 
							</p>
							<p>
								Purchased Books <strong id="totalNewBooks1">0</strong> 
							</p>
							<p>
								Rented Books <strong id="totalUsedBooks1">0</strong> 
							</p>
							<div class="footerTotal"> 
								<small>SubTotal</small> 
								<strong id="totalPrice1">0.00</strong> 
								<a title="Add to Cart" onClick="xajax_checkOut(); return false;" >Check Out</a> 
							</div> 
						</div>
</form> 
								
								
</body>
</html>