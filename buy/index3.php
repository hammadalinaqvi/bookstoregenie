<?php
	//session_destroy();
	session_start();
	session_regenerate_id(true);
	//$_SESSION['shit'] = "fuckmyass";
	//echo session_id();
	
	//$shit = "i am here motherfuckers";
	//include '../buybackPrice.php';
	//include '../checkPrices2.php';
	//require_once '../checkPrices2.php';
	
	
	//global $listISBN;
	$listISBN = array();
	//$fucker = "fucker";
	//$_SESSION['listISBN'] = $listISBN;
	
	//$_SESSION['tester'] = "fuck";
	
	include '../xajax/xajax_core/xajax.inc.php';
	
	$xajax = new xajax();

	$xajax->configure("javascript URI","../xajax/");

	$xajax->register(XAJAX_FUNCTION, 'removeBookFromList');
	$xajax->register(XAJAX_FUNCTION, 'addUsed');
	$xajax->register(XAJAX_FUNCTION, 'decreaseUsed');
	$xajax->register(XAJAX_FUNCTION, 'addRent');
	$xajax->register(XAJAX_FUNCTION, 'decreaseRent');
	$xajax->register(XAJAX_FUNCTION, 'reloadPage');
	$xajax->register(XAJAX_FUNCTION, 'checkOut');
	$xajax->register(XAJAX_FUNCTION, 'validateCoupon');
	$xajax->register(XAJAX_FUNCTION, 'continueShopping');
	$xajax->register(XAJAX_FUNCTION, 'proceedBuy');
	$xajax->register(XAJAX_FUNCTION, 'finalizePurchase');
	
	$xajax->processRequest();
	
	function authorizePayment($cc, $month, $year, $firstname, $lastname, $email, $address, $state, $zip)
	{
		// posting to: https://secure.authorize.net/gateway/transact.dll
//$post_url = "https://test.authorize.net/gateway/transact.dll";
$post_url = "https://secure.authorize.net/gateway/transact.dll";

	$expiration = $month.$year;
	$total = $_SESSION['grandTotal'];


	//$login1 = "8Sj8K8y2w";
	//$key1 = "7w3W2Hn7NcA9U8t6";

	$login2 = "8jbD9Q5YJ";
	$key2 = "8QXw64u35SByc9tg";

$post_values = array(
	
	// the API Login ID and Transaction Key must be replaced with valid values
	"x_login"			=> "$login2",
	"x_tran_key"		=> "$key2",

	"x_version"			=> "3.1",
	"x_delim_data"		=> "TRUE",
	"x_delim_char"		=> "|",
	"x_relay_response"	=> "FALSE",

	"x_type"			=> "AUTH_CAPTURE",
	"x_method"			=> "CC",
	"x_card_num"		=> "$cc",
	"x_exp_date"		=> "$expiration",

	"x_amount"			=> "$total",
	"x_description"		=> "Purchase for $firstname $lastname with email of $email",

	"x_first_name"		=> "$firstname",
	"x_last_name"		=> "$lastname",
	"x_address"			=> "$address",
	"x_state"			=> "$state",
	"x_zip"				=> "$zip"
	// Additional fields can be added here as outlined in the AIM integration
	// guide at: http://developer.authorize.net
);

// This section takes the input fields and converts them to the proper format
// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
$post_string = "";
foreach( $post_values as $key => $value )
	{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
$post_string = rtrim( $post_string, "& " );


$request = curl_init($post_url); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
	$post_response = curl_exec($request); // execute curl post and store results in $post_response
	// additional options may be required depending upon your server configuration
	// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close ($request); // close curl object

// This line takes the response and breaks it into an array using the specified delimiting character
$response_array = explode($post_values["x_delim_char"],$post_response);

// The results are output to the screen in the form of an html numbered list.


return $response_array;

// individual elements of the array could be accessed to read certain response
// fields.  For example, response_array[0] would return the Response Code,
// response_array[2] would return the Response Reason Code.
// for a list of response fields, please review the AIM Implementation Guide
	}
	
	
	function storeInfo($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2, $type2,$address3, $city3, $state3, $zip3)
	{
		require_once "../Book.php";
		
		$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
		$query = "insert into jteplitz_bookstore.rentalUser (firstName, lastName, email, phone, address, city, state, zip, cc, ccCode, month, year, type,shippingAddress, shippingCity,shippingZip, shippingState) values ('$firstname2','$lastname2','$email2','$phone2','$address2','$city2','$state2','$zip2','$cc2','$ccCode2','$month2','$year2','$type2','$address3','$city3','$zip3','$state3')";
		$mysqli->query($query);
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
		
			$query = "insert into jteplitz_bookstore.rentedBooks (rentPrice, rentMerchant, rentLink, usedPrice, usedMerchant, usedLink, newPrice, newMerchant, newLink, rentQuantity, newQuantity, usedQuantity, isbn, title, author, image, code, email, fulfilled, purchaseDate) values ('".$book->getRentPrice()."','".$book->getRentMerchant()."','".$book->getRentLink()."','".$book->getUsedPrice()."','".$book->getUsedMerchant()."','".$book->getUsedLink()."','".$book->getNewPrice()."','".$book->getNewMerchant()."','".$book->getNewLink()."','".$book->getRentQuantity()."','".$book->getNewQuantity()."','".$book->getUsedQuantity()."','".$book->getISBN()."','".$book->getTitle()."','".$book->getAuthor."','".$book->getImage()."','".$_SESSION['code']."','".$email2."','0', CURDATE())";
			$mysqli->query($query);
		}
		
		
		//$mysqli->query($query);
		$mysqli->close();
	}
	
	function sendUserEmail($firstname, $lastname, $address, $city, $state, $zip, $email)
	{
		require_once "../Book.php";
		require_once "/usr/local/cpanel/3rdparty/lib/php/Mail.php";
		
		
		$body = "Thank you ".$firstname." ".$lastname." for your recent order!<br><br>";
		$body .= "Your purchase total was $".$_SESSION['grandTotal']."<br><br>";
		$body .= "Your order will be shipped within the next 24 hours to:<br>".$address."<br>".$city.", ".$state."  ".$zip."<br><br>";
		$body .= "Here is the order summary: <br><br>";
		
//		$_SESSION['grandTotal'] = 0;
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
		
			$body .= "ISBN: ".$book->getISBN()."<br>";
			$body .= "Title: ".$book->getTitle()."<br>";
			if($book->getRentQuantity() > 0)
			{
				$body .= "Rent Quantity: ".$book->getRentQuantity()."<br>";
			}
			if($book->getUsedQuantity() > 0)
			{
				$body .= "Purchase Quantity: ".$book->getUsedQuantity()."<br>";
			}
			$body .= "*******************************************************************************<br>";
		}
	
		$from = "Bookstore Genie <support@bookstoregenie.com>";
		$to = "$email";
		$subject = "Order has been made for Rental";		
		$host = "localhost";
		$username = "jteplitz";
		$password = "jtt0511";
		$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
		$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
		$mail = $smtp->send($to, $headers, $body);
		if (PEAR::isError($mail)) {
//			echo "shit fuck, this doesnt work";
		} else{
			
		}
	}
	
	
	function sendAdminEmail($firstname, $lastname, $email)
	{
		require_once "../Book.php";
		require_once "/usr/local/cpanel/3rdparty/lib/php/Mail.php";
		
		
		$body = "There was an order made by ".$firstname." ".$lastname." with email ".$email."<br>";
		$body .= "The purchase total was $".$_SESSION['grandTotal']."<br><br>Here is the order summary: <br><br>";
		
		$_SESSION['grandTotal'] = 0;
		$_SESSION['code'] = 0;
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
		
			$body .= "ISBN: ".$book->getISBN()."<br>";
			$body .= "Title: ".$book->getTitle()."<br>";
			$body .= "Rent Quantity: ".$book->getRentQuantity()."<br>";
			$body .= "Rent Price: ".$book->getRentPrice()."<br>";
			$body .= "Rent Merchant: ".$book->getRentMerchant()."<br>";
			$body .= "Rent Link ".$book->getRentLink()."<br><br>";
			$body .= "Used Quantity: ".$book->getUsedQuantity()."<br>";
			$body .= "Used Price: ".$book->getUsedPrice()."<br>";
			$body .= "Used Merchant: ".$book->getUsedMerchant()."<br>";
			$body .= "Used Link ".$book->getUsedLink()."<br><br>";
			$body .= "*******************************************************************************<br>";
		}
	
		$from = "Bookstore Genie <support@bookstoregenie.com>";
		$to = "eugenek79@gmail.com, farhan@bookstoregenie.com";
		$subject = "Order has been made for Rental";		
		$host = "localhost";
		$username = "jteplitz";
		$password = "jtt0511";
		$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
		$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
		$mail = $smtp->send($to, $headers, $body);
		if (PEAR::isError($mail)) {
			//echo "shit fuck, this doesnt work";
		} else{
			
		}
	}
	
	function finalizePurchase($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2,$type2,$address3, $city3, $state3, $zip3)
	{
		//require_once "../Book.php";
		$response = new xajaxResponse();
		
		$status = "";
		$statusCode = 1;
		if(($firstname2 == null) || ($firstname2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your first name!</font>";
		}
		else if(($lastname2 == null) || ($lastname2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your last name!</font>";
		}
		else if(($email2 == null) || ($email2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your email!</font>";
		}
		else if (!ereg("^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$", $email2))
		{ 
			$statusCode = 2;
			$status = "<font color=\"red\">Oops! This email is not valid.</font>";
		}
		else if(($phone2 == null) || ($phone2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your phone number!</font>";
		}
		else if(($address2 == null) || ($address2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your billing address!</font>";
		}
		else if(($city2 == null) || ($city2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your billing city!</font>";
		}
		else if(($state2 == null) || ($state2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your billing state!</font>";
		}
		else if(($zip2 == null) || ($zip2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your billing zip code!</font>";
		}
		else if(($address3 == null) || ($address3 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your shipping address!</font>";
		}
		else if(($city3 == null) || ($city3 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your shipping city!</font>";
		}
		else if(($state3 == null) || ($state3 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your shipping state!</font>";
		}
		else if(($zip3 == null) || ($zip3 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your shipping zip code!</font>";
		}
		else if(($cc2 == null) || ($cc2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your credit card number!</font>";
		}
		else if(($ccCode2 == null) || ($ccCode2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your CC security code!</font>";
		}
		else if(($month2 == null) || ($month2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your expiration month!</font>";
		}
		else if(($year2 == null) || ($year2 == ""))
		{
			$statusCode = 2;
			$status = "<font color='red'>You must enter your last name</font>";
		}
		
		if($statusCode == 1)
		{
			$authorize = authorizePayment($cc2, $month2, $year2, $firstname2, $lastname2, $email2, $address2, $state2, $zip2);
		}
		
		if(($authorize[0] == 1) && ($statusCode == 1))
		{
//			$html2 = "we are good";
			storeInfo($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2, $type2,$address3, $city3, $state3, $zip3);
			sendUserEmail($firstname2, $lastname2, $address2, $city2, $state2, $zip2, $email2);
			sendAdminEmail($firstname2, $lastname2, $email2);
			$status = "<font color='green'>"."Thank you for your purchase!  You will recieve an email notification shortly"."</font>";
		}
		else if($statusCode == 2)
		{
			$status = $status;
		}
		else
		{
			$status = "<font color='red'>".$authorize[3]."</font>";
		}
		
		
		
		
		$response->assign('purchaseStatus', 'innerHTML', $status);
		return $response;
	}
	
	function continueShopping()
	{
		//require_once "../Book.php";
		$response = new xajaxResponse();
		$response->assign('buybuy', 'innerHTML', "");
		return $response;
	}
	
	function proceedBuy()
	{
		//require_once "../Book.php";
		$response = new xajaxResponse();
		
		$html = "<div class=\"left-col stepFour\">
			<a name='paymentCenter'></a>
	<h2>Payment Center:</h2>
	
	<form action=\"/home/checked\" >
	<div id=\"div-error\" class=\"error\"></div>
	<label for=\"name\">
	<strong>First Name:</strong>
	<input type=\"text\" id=\"firstname2\" name=\"name\" value=\"\"/>
	</label>
		
	<label for=\"name\">
	<strong>Last Name:</strong>
	<input type=\"text\" id=\"lastname2\" name=\"name\" value=\"\"/>
	</label>
	
	<label for=\"email\">
	<strong>Email:</strong>
	<input type=\"text\" id=\"email2\" name=\"email\" value=\"\">
	</label>
	
	<label for=\"phone number\">
	<strong>Phone Number:</strong>
	<input type=\"text\" id=\"phone2\" name=\"phone\" value=\"\">
	</label>
	
	<label for=\"address\">
	<strong>Billing Street address:</strong>
	<input type=\"text\" id=\"address2\" name=\"addressline1\" value=\"\"/>
	</label>
	
	<label for=\"name\">
	<strong>Billing City:</strong>
	<input onFocus=\"if(this.value=='City') this.value='';\" type=\"text\" id=\"city2\" name=\"city\" value=\"City\" />
	</label>

	<label for=\"name\">
	<strong>Billing State:</strong>
	<input onFocus=\"if(this.value=='State') this.value='';\" type=\"text\" id=\"state2\" name=\"state\" value=\"State\" />
	</label>

	<label for=\"name\">
	<strong>Billing Zip Code:</strong>
	<input onFocus=\"if(this.value=='Zip code') this.value='';\"type=\"text\" id=\"zip2\" name=\"zip\" value=\"Zip code\" />
	</label>
	
	<label for=\"address\">
	<strong>Shipping Street address:</strong>
	<input type=\"text\" id=\"address3\" name=\"addressline1\" value=\"\"/>
	</label>
	
	<label for=\"name\">
	<strong>Shipping City:</strong>
	<input onFocus=\"if(this.value=='City') this.value='';\" type=\"text\" id=\"city3\" name=\"city\" value=\"City\" />
	</label>

	<label for=\"name\">
	<strong>Shipping State:</strong>
	<input onFocus=\"if(this.value=='State') this.value='';\" type=\"text\" id=\"state3\" name=\"state\" value=\"State\" />
	</label>

	<label for=\"name\">
	<strong>Shipping Zip Code:</strong>
	<input onFocus=\"if(this.value=='Zip code') this.value='';\"type=\"text\" id=\"zip3\" name=\"zip\" value=\"Zip code\" />
	</label>
	
	
	<label for=\"name\">
	<strong>Credit Card Type:</strong>
	<SELECT id=\"ccType2\">
<OPTION VALUE=\"Visa\">Visa

<OPTION VALUE=\"Mastercard\">Mastercard
<OPTION VALUE=\"American Express\">American Express
<OPTION VALUE=\"Discover\">Discover
<OPTION VALUE=\"Diners Club\">Diners Club

</SELECT>
	</label>
	
	<label for=\"name\">
	<strong>Credit Card #:</strong>
	<input type=\"text\" id=\"cc2\" name=\"name\" value=\"\"/>
	</label>
	
	<label for=\"name\">
	<strong>Credit Card Security Code:</strong>
	<input type=\"text\" id=\"ccCode2\" name=\"ccCode\" value=\"\" />
	</label>
	
	
	<label for=\"name\">
	<strong>Expiration Month:</strong>
	<input onFocus=\"if(this.value=='XX') this.value='';\" type=\"text\" id=\"month2\" name=\"month\" value=\"XX\" />
	</label>
	
	<label for=\"name\">
	<strong>Expiration Year:</strong>
	<input onFocus=\"if(this.value=='XX') this.value='';\" type=\"text\" id=\"year2\" name=\"year\" value=\"XX\" />
	</label>
	<br>
	<button type='button' onClick=\"
	var firstname2=document.getElementById('firstname2').value;
	var lastname2=document.getElementById('lastname2').value;
	var email2=document.getElementById('email2').value;
	var phone2=document.getElementById('phone2').value;
	var address2=document.getElementById('address2').value;
	var city2=document.getElementById('city2').value;
	var state2=document.getElementById('state2').value;
	var zip2=document.getElementById('zip2').value;
	var address3=document.getElementById('address3').value;
	var city3=document.getElementById('city3').value;
	var state3=document.getElementById('state3').value;
	var zip3=document.getElementById('zip3').value;
	var cc2=document.getElementById('cc2').value;
	var ccCode2=document.getElementById('ccCode2').value;
	var month2=document.getElementById('month2').value;
	var year2=document.getElementById('year2').value;
	var type2=document.getElementById('ccType2').value;
	xajax_finalizePurchase(firstname2, lastname2, email2, phone2, address2, city2, state2, zip2, cc2, ccCode2, month2, year2,type2,address3,city3,state3,zip3); return false; \">Finalize Order</button>
	<div id='purchaseStatus'></div>
	</div>
	
	
	
	";
		
		$response->assign('payment', 'innerHTML', $html);
		$response->redirect('#paymentCenter');
		return $response;
	}
	
	function validateCoupon($code)
	{
		require_once "../Book.php";
		$response = new xajaxResponse();
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
			
			$total = $total + $book->getSubtotal();
			
		}
		//default coupon code
		$_SESSION['code'] = 0;
		
		$code = strtolower($code);
		$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
		$query = "select Type from jteplitz_bookstore.discounts where Name=\"".$code."\";";
		$type = 0;
		if ($result = $mysqli->query($query)) {
        		while($obj = $result->fetch_object()){
           		 $type =$obj->Type;
        		}
    		}
		
		if(($type >= 1) && ($type <= 1000))
		{
			$_SESSION['code'] = $type;
			$shipping = "<font color='green'>FREE</font>";
			$total = number_format($total, 2);
			$grantTotal = $total;
			$grantTotal = number_format($grantTotal, 2);
			$_SESSION['grandTotal'] = $grantTotal;
			
			$status = "<font color='green'>Your coupon code has been accepted and applied!</font>";
			//$response->assign('status', 'innerHTML', $status);
		}
		else
		{
			$shipping = "$3.99";
			$total = number_format($total, 2);
			$grantTotal = $total + 3.99;
			$grantTotal = number_format($grantTotal, 2);
			$_SESSION['grandTotal'] = $grantTotal;
			$status = "<font color='red'>Your entered an invalid coupon code!</font>";
			//$response->assign('status', 'innerHTML', $status);
		}
		
		$html .= "<div class='heading'><strong>Here is your order summary:</strong></div><br> ";
		$html .= "<a name='checkout'></a>";
		$html .= "<table border='0'>";
		$html .= "<tr><td>Subtotal:</td><td align='right'>  $".$total."</td></tr>";
		$html .= "<tr><td>Shipping:</td><td align='right'>".$shipping."</td></tr>";
		$html .= "<tr><td><b>Grand Total:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='right'>  $".$grantTotal."</td></tr>";
		$html .= "</table><br>";
		$html .= "Coupon Code:&nbsp;&nbsp;&nbsp; <input type='text' id='code' />
<button type='button' onClick=\"var shit=document.getElementById('code').value; xajax_validateCoupon(shit); return false; \">Submit</button><br><div id='couponResponse'><div id='status'>".$status."</div></div>";
		$html .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onClick=\"xajax_continueShopping(); return false; \">Continue Shopping</button>";
		$html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onClick=\"xajax_proceedBuy(); return false; \">Proceed to Payment</button>";
		$html .= "<div class='heading'></div><div id='payment'></div>";
		
		
		$response->assign('buybuy', 'innerHTML', $html);
		return $response;
	}
	
	function checkOut()
	{
		require_once "../Book.php";
		$response = new xajaxResponse();
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
			
			$total = $total + $book->getSubtotal();
			
		}
		
		$total = number_format($total, 2);
		
		$grantTotal = $total + 3.99;
		$grantTotal = number_format($grantTotal, 2);
		
		$_SESSION['grandTotal'] = $grantTotal;
		
		$html .= "<div class='heading'><strong>Here is your order summary:</strong></div><br> ";
		$html .= "<a name='checkout'></a>";
		$html .= "<table border='0'>";
		$html .= "<tr><td>Subtotal:</td><td align='right'>  $".$total."</td></tr>";
		$html .= "<tr><td>Shipping:</td><td align='right'>  $3.99</td></tr>";
		$html .= "<tr><td><b>Grand Total:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='right'>  $".$grantTotal."</td></tr>";
		$html .= "</table><br>";
		$html .= "Coupon Code:&nbsp;&nbsp;&nbsp; <input type='text' id='code' />
<button type='button' onClick=\"var shit=document.getElementById('code').value; xajax_validateCoupon(shit); return false; \">Submit</button><br><div id='couponResponse'><div id='status'></div></div>";
		$html .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onClick=\"xajax_continueShopping(); return false; \">Continue Shopping</button>";
		$html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onClick=\"xajax_proceedBuy(); return false; \">Proceed to Payment</button>";
		$html .= "<div class='heading'></div>";
		$html .= "<div class='heading'></div><div id='payment'></div>";
		
		$response->assign('buybuy', 'innerHTML', $html);
		$response->redirect('#checkout');
		return $response;
	}
	
	function reloadPage($shit)
	{
		require_once "../Book.php";
		$response = new xajaxResponse();
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$tempList .= $key.",";
		}
		
		$tempList .= $shit;
		
//		$response->redirect("http://www.playboy.com");
		//$response->assign('fuckme', 'innerHTML', $shit);

		$response->redirect("http://www.bookstoregenie.com/rent/index.php?isbns=".$tempList);
		return $response;
	}
	
	function addUsed($isbn)
	{
		 require_once "../Book.php";
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
		 require_once "../Book.php";
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
		 require_once "../Book.php";
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
		 require_once "../Book.php";
		 
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
		 require_once "../Book.php";
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
	
	
	
	
	include "../rentalPrices.php";
	
	

?>

<!DOCTYPE html> 
<html> 
<head> 
  <title>Bookstore Genie</title> 
  
  	<link href="css/all.css" media="screen" rel="stylesheet" type="text/css" /> 
	<link href="css/filter.css" media="screen" rel="stylesheet" type="text/css" /> 
	<link href="css/index_style.css" media="screen" rel="stylesheet" type="text/css" /> 
	<link href="css/step3.css" media="screen" rel="stylesheet" type="text/css" /> 
	<link href="css/style2.css" media="screen" rel="stylesheet" type="text/css" /> 
  	<meta name="csrf-param" content="authenticity_token"/> 
	<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/> 
  	<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" /> 
  	
  	<script src="js/prototype.js" type="text/javascript"></script> 
	<script src="js/effects.js" type="text/javascript"></script> 
	<script src="js/dragdrop.js" type="text/javascript"></script> 
	<script src="js/controls.js" type="text/javascript"></script> 
	<script src="js/rails.js" type="text/javascript"></script> 
	<script src="js/application.js" type="text/javascript"></script>
  	
</head> 
 
 
 

<?php
$xajax->printJavascript();
?>

<?php
	//session_start();
	//  echo $_SESSION['size'];
	//$_SESSION["isbns"] = "shit";
/*	if($_SESSION["isbns"] == null)
	{
		echo "aaaaaaaaaa";
		$_SESSION["isbns"] = array();
		$listISBN = array();
	}
	else
	{
		echo "bbbbbbbbb";
		$listISBN = $_SESSION["isbns"];
	}
*/	
	$list = $_GET["isbns"];
	//echo $list;
	//echo "<br>";
	$list = trim($list);
	$list = str_replace(" ",",",$list);
	$list = str_replace(";",",",$list);
	$list = str_replace(":",",",$list);
	$list = str_replace(",,",",",$list);
	
	$isbns = explode(",",$list);
	$count = count($isbns);
	
	//echo $count;
	
	//global $fucker;
	//$fucker  = "fucker";
	//echo $_SESSION['tester'];
	//echo "<br>";
	
	for($i = 0; $i < $count; $i++)
	{
		//echo "shit<br>";
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
			//$book = $listISBN[$isbn10];
			//echo $book->getTitle();
			$book = $listISBN[$isbn10];
			$newNumber = $book->getNewQuantity();
			$values .= "(".$isbn10.",0,0);";
			//echo "fuck";			
		}
		else
		{
			//echo "shit";
			//echo $isbn10;
			$temp = getRentalPrice($isbn10);
			if($temp)
			{
			//echo "why am i here? <br>";
				if(($temp->getTitle() != null) && ($temp->getTitle() != ""))
				{
					//$fucktard = $_SESSION['tester'];
					//$fucktard[$isbn10] = $temp;
					//$_SESSION['listISBN'] = $fucktard;
					//$_SESSION['tester'] = "fuckmeharder";
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
			//echo $temp->getNewPrice();
			
			//echo count($listISBN);
			
//			$values .= "(".$isbn10.",0,0);";
			//$_SESSION["isbns"] = $listISBN;
			//session_write_close();
		}
	

	}
	$_SESSION['listISBN'] = $listISBN;
	
	//echo $_SESSION['tester'];
	echo "<body class=\"in\" onload=\"setCookie('results','".$values."','10'); updateTotal();\">";
?>
 
				<div class="header"> 
			<h1><a href="http://www.bookstoregenie.com" title="BookStoreGenie">BookStoreGenie</a></h1> 
			<ul id="main-nav"> 
				<li><a href="http://www.bookstoregenie.com/searchEngine.html" title="Rent Books">BUY</a></li> 
				<li id="selected"><a href="http://www.bookstoregenie.com" title="Purchasing Search Engine">RENT</a></li> 
			</ul> 
			
			<div style="clear:both;"></div> 
		</div> 
 
 
		<div class="heading"> 
			<strong>Search Results</strong> 
			<h2>Here are your books!</h2>
			<h3><?php echo $resultStatus; ?></h3> 
		</div> 
 
		<div class="wrap"> 
			<div class="stepTwo"> 
				<div class="left-col"> 
					<form class="inSearch"  onSubmit="var shit=document.getElementById('inSearchText').value;  xajax_reloadPage(shit); return false;"> 
						<input type="text" id="inSearchText" name="isbn" value="Add more books" class="text" onClick="if(this.value=='Add more books') this.value='';" /> 
						<input type="submit" value="Add books" class="button" onClick = "var shit=document.getElementById('inSearchText').value; xajax_reloadPage(shit); return false;"/> 
						<div style="clear:both;"></div> 
						<div id="div-error" style="padding-left: 10px; color: red;"></div> 
					</form> 
				<div class="bookResults"> 
						<div id="book-start" /> 
						
						<?php
						
						$fucker = $_SESSION['listISBN'];
//						global $listISBN;
						foreach($fucker as $key => $value)
						{
							//echo "fuck<br>";
							//echo get_declared_classes();
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
							$html .= "<div class=\"subtotal\"> <span id=\"Subtotal".$tempBook->getISBN()."\"> $0.0 </span></div></div> </div></div>  ";
							echo $html;
						}
						 										
											
						?>
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
							<strong>Total</strong> 
							
							<span id="totalPrice"> 0.00 </span> 
						</p> 
						<a  title="Add to Cart" onClick="xajax_checkOut(); return false;">Check Out</a> 
					</div> 
					
					<br><br>
					<div id="buybuy"></div>
					<br><br><br><br><br>
				</div> 
			</div> 
			
			<div class="summary"> 
				<h3>Buyback Summary</h3> 
				<p> 
					Total Books <strong id="totalBooks1">0</strong> 
				</p> 
				<p> 
					Purchased Books <strong id="totalNewBooks1">0</strong> 
				</p> 
				<p> 
					Rented Books <strong id="totalUsedBooks1">0</strong> 
				</p> 
				<div class="footer"> 
					<small>Total</small> 
					<strong id="totalPrice1">0.00</strong> 
					<a  title="Add to Cart" onClick="xajax_checkOut(); return false;" >Check Out</a> 
				</div> 
			</div> 
			
			<div style="clear:both;"></div> 
				
		</div> 
			
		<!-- start footer -->
		<div class="footer"> 
		
			<!-- start breadcrumbs -->
			<div class="breadcrumbs"> 
				<a href="http://www.bookstoregenie.com" title="Homepage">Homepage</a> &raquo Rent Books
			</div> 
			<!-- end breadcrumbs -->
			
				<a href="#" title="BookStoreGenie" id="footerLogo">BookStoreGenie</a> 
		
					<div style="clear:both;"></div> 
		
		</div> 
 		<!-- end footer -->
		
	</div> 
	
	
	</div>
</body> 
 
 
</html> 