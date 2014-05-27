<?php include_once('../Book.php');
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<form method="post" action="paypal.php">
<?php 

if(isset($_SESSION['listISBN']))
	{
		$listISBN = $_SESSION['listISBN'];
	}
	else
	{
		$listISBN = array();
	}
	
$data_array = $_SESSION['listISBN'];?>
<?php 
$total=0;
foreach($data_array as $key => $value)
{
$tempBook = $listISBN[$key];
$tempBook = unserialize($tempBook);

echo "<p><strong>Book Name:</strong>&nbsp;".$tempBook->getTitle()."</p> ";
echo "<p>Rent Quantity:".$tempBook->getRentQuantity()."</p>";
echo "<p>Rent Price:".$tempBook->getRentPrice()."</p>";
echo '<input type="hidden" name="book_name_'.$tempBook->getISBN().'" value="'.$tempBook->getTitle().'" >';
echo '<input type="hidden" name="rent_quantity_'.$tempBook->getISBN().'" value="'.$tempBook->getTitle().'" >';
echo '<input type="hidden" name="rent_price_'.$tempBook->getISBN().'" value="'.$tempBook->getTitle().'" >';
$total =+ $total + ($tempBook->getRentQuantity()* $tempBook->getRentPrice());


}
echo $total;
?>

<p><strong>Sub Total:</strong>62.00</p>
<input type="hidden" name="book_name" value="Clinical Emergency Radiology"  />
<input type="hidden" name="rent_quantity" value="1"  />
<input type="hidden" name="new_quantity" value="0"  />
<input type="hidden" name="rent_price" value="62.00"  />
<input type="hidden" name="new_price" value="0"  />
<input type="submit" value="Checkout" name="submit"  />




</form>

</body>
</html>