<?php
	//session_destroy();
	
	//$tempSession = session_id();
	
	//session_destroy();
	$lifetime=100000000;
 	session_start();
	setcookie(session_name(),session_id(),time()+$lifetime);
	//session_destroy();
	//$_SESSION['shit'] = "fuckmyass";
	//echo session_id();
	
	//$shit = "i am here motherfuckers";
	//include '../buybackPrice.php';
	//include '../checkPrices2.php';
	//require_once '../checkPrices2.php';
	
	
	//global $listISBN;
	
	if(isset($_SESSION['listISBN']))
	{
		$listISBN = $_SESSION['listISBN'];
	}
	else
	{
		$listISBN = array();
	}
	
	//$listISBN = array();
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

//$total = 1.02;

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
	
	
	function storeInfo($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2, $type2,$address3, $city3, $state3, $zip3, $orderNumber)
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
		
			$title4 = $book->getTitle();
			$title4 = str_replace("'","*",$title4);
		
			$query = "insert into jteplitz_bookstore.rentedBooks (rentPrice, rentMerchant, rentLink, usedPrice, usedMerchant, usedLink, newPrice, newMerchant, newLink, rentQuantity, newQuantity, usedQuantity, isbn, title, author, image, code, email, fulfilled, purchaseDate, orderNumber) values ('".$book->getRentPrice()."','".$book->getRentMerchant()."','".$book->getRentLink()."','".$book->getUsedPrice()."','".$book->getUsedMerchant()."','".$book->getUsedLink()."','".$book->getNewPrice()."','".$book->getNewMerchant()."','".$book->getNewLink()."','".$book->getRentQuantity()."','".$book->getNewQuantity()."','".$book->getUsedQuantity()."','".$book->getISBN()."','".$title4."','".$book->getAuthor."','".$book->getImage()."','".$_SESSION['code']."','".$email2."','0', CURDATE(),'".$orderNumber."')";
			$mysqli->query($query);
		}
		
		$couponName = $_SESSION['codeDailyDealsName'];
		$query = "delete from jteplitz_bookstore.discounts where Name = '".$couponName."'";
		$mysqli->query($query);
		
		
		//$mysqli->query($query);
		$mysqli->close();
		
		
		
	}
	
	function sendUserEmail($firstname, $lastname, $address, $city, $state, $zip, $email,$orderNumber)
	{
		require_once "../Book.php";
		//require_once "/usr/local/cpanel/3rdparty/lib/php/Mail.php";
		
		
		$body = "Thank you ".$firstname." ".$lastname." for your recent order!<br><br>";
		$body .= "Your purchase total was $".$_SESSION['grandTotal']."<br><br>";
		$body .= "Your order will be shipped within the next 24 hours to:<br>".$address."<br>".$city.", ".$state."  ".$zip."<br><br>";
		$body .= "Your order number is:  ".$orderNumber."<br><br>";
		$body .= "Here is the order summary: <br><br>";
		
//		$_SESSION['grandTotal'] = 0;
		
		$listISBN = $_SESSION['listISBN'];
		//$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
		
			
			if($book->getRentQuantity() > 0)
			{
				$body .= "ISBN: ".$book->getISBN()."<br>";
				$body .= "Title: ".$book->getTitle()."<br>";
				$body .= "Rent Quantity: ".$book->getRentQuantity()."<br>";
				$body .= "*******************************************************************************<br>";
			}
			if($book->getUsedQuantity() > 0)
			{
				$body .= "ISBN: ".$book->getISBN()."<br>";
				$body .= "Title: ".$book->getTitle()."<br>";
				$body .= "Purchase Quantity: ".$book->getUsedQuantity()."<br>";
				$body .= "*******************************************************************************<br>";
			}
			
		}
	
		//$from = "Bookstore Genie <support@bookstoregenie.com>";
		$to = "$email";
		$subject = "Order has been made for Rental";		
		//$host = "localhost";
		//$username = "jteplitz";
		//$password = "jtt0511";
		//$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
		//$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
		//$mail = $smtp->send($to, $headers, $body);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Bookstore Genie <support@bookstoregenie.com>' . "\r\n";
		
		mail($to, $subject, $body, $headers);
		
	}
	
	
	function sendAdminEmail($firstname, $lastname, $email,$address, $city, $state, $zip, $phone,$orderNumber)
	{
		require_once "../Book.php";
		//require_once "/usr/local/cpanel/3rdparty/lib/php/Mail.php";
		
		
		$body = "There was an order made by ".$firstname." ".$lastname." with email ".$email."<br>";
		$body .= "The purchase total was $".$_SESSION['grandTotal']."<br><br>Here is the order summary: <br><br>";
		
		$body .= "The code was '".$_SESSION['code']."'<br><br>";
		
		$tempName = $_SESSION['codeDailyDeals'];
		if($tempName == -1)
		{
			$body .= "They also used a special daily deals coupon.<br><br>";
		}
		
		$_SESSION['grandTotal'] = 0;
		$_SESSION['code'] = 0;
		
		$body .= "The shipping address is:<br>".$address."<br>".$city.", ".$state."  ".$zip."<br><br><br>";
		
		$body .= "The order number is:  ".$orderNumber."<br><br>";
		
		$body .= "The phone number is:<br>".$phone."<br><br><br>";
		
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
	
		
		$to = "eugenek79@gmail.com,fdaredia@gmail.com";
		$subject = "Order has been made for Rental";	
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Bookstore Genie <support@bookstoregenie.com>' . "\r\n";
			
		//$host = "localhost";
		//$username = "jteplitz";
		//$password = "jtt0511";
		//$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
		//$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
		//$mail = $smtp->send($to, $headers, $body);
		
		$_SESSION['codeDailyDeals'] = 0;
		$_SESSION['codeShipping'] = 0;
		$_SESSION['code'] = 0;
		$_SESSION['codeDailyDealsName'] = 'xxx';
		
		mail($to, $subject, $body, $headers);
		
		
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
//			$shit = $_SESSION['codeDailyDealsName'];
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

			$orderNumber = uniqid();

			storeInfo($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2, $type2,$address3, $city3, $state3, $zip3, $orderNumber);
			sendUserEmail($firstname2, $lastname2, $address3, $city3, $state3, $zip3, $email2,$orderNumber);
			sendAdminEmail($firstname2, $lastname2, $email2, $address3, $city3, $state3, $zip3,$phone2,$orderNumber);
			$status = "<font color='green'>"."Thank you for your purchase!  You will recieve an email notification shortly"."</font>";
			$finalPrice = $_SESSION['grandTotal'];
			$sharesale = '<img src="https://shareasale.com/sale.cfm?amount='.$finalPrice.'&tracking='.$orderNumber.'&transtype=SALE&merchantID=36172" width="1" height="1">';
			$response->assign('purchaseStatus', 'innerHTML', $sharesale);
			$response->redirect("http://bookstoregenie.com/confirm.html");
		}
		else if($statusCode == 2)
		{
		//$orderNumber = uniqid();
		//$sharesale = '<img src="https://shareasale.com/sale.cfm?amount='.'5.99'.'&tracking='.$orderNumber.'&transtype=SALE&merchantID=36172" width="1" height="1">';
		//	$response->assign('purchaseStatus', 'innerHTML', $sharesale);
		
		
			$status = $status;
			$response->assign('purchaseStatus', 'innerHTML', $status);
		}
		else
		{
			$status = "<font color='red'>".$authorize[3]."</font>";
			$response->assign('purchaseStatus', 'innerHTML', $status);
		}
		
		
		
		
//		$response->assign('purchaseStatus', 'innerHTML', $status);
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
		
		$html2 = "<a name='paymentCenter'></a><div class=\"iphorm-outer\">
		    <div class=\"iphorm-wrapper\">
	        <div class=\"iphorm-inner\">
	            <div class=\"form-title\">Payment Center</div>
                   <div class=\"iphorm-message\"></div>
	               <div class=\"iphorm-container clearfix\">
	                    <!-- Begin Name element -->
                        <div class=\"element-wrapper name-element-wrapper clearfix\">
                            <label for=\"name\">First Name <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper name-input-wrapper\">
                                <input class=\"name-element\" id=\"firstname2\" type=\"text\" name=\"name\" />
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Name element -->
                        <div class=\"element-wrapper name-element-wrapper clearfix\">
                            <label for=\"name\">Last Name <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper name-input-wrapper\">
                                <input class=\"name-element\" id=\"lastname2\" type=\"text\" name=\"name\" />
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Email element -->
                        <div class=\"element-wrapper email-element-wrapper clearfix\">
                            <label for=\"email\">Email <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper email-input-wrapper\">
                                <input class=\"email-element iphorm-tooltip\" id=\"email2\" type=\"text\" name=\"email\" title=\"We will never send you spam, we value your privacy as much as our own\" />
                            </div>
                        </div>
                        <!-- End Email element -->
                        <!-- Begin Phone element -->
                        <div class=\"element-wrapper phone-element-wrapper clearfix\">
                            <label for=\"phone\">Phone</label>
                            <div class=\"input-wrapper phone-input-wrapper\">
                                <input class=\"phone-element iphorm-tooltip\" id=\"phone2\" type=\"text\" name=\"phone\" title=\"We will only use your phone number to contact you regarding your enquiry\" />
                            </div>
                        </div>
                        <!-- End Phone element -->

                        <!-- begin address container -->
                        <div class=\"addressContainer\">

	                        <!-- Begin Address element -->
	                        <div class=\"element-wrapper address-element-wrapper clearfix\">
	                            <label for=\"address\">Billing Street <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper name-input-wrapper\">
	                                <input class=\"address-element\" id=\"address2\" type=\"text\" name=\"address\" />
	                            </div>
	                        </div>
	                        <!-- End Address element -->
	                        <!-- Begin Address element -->
	                        <div class=\"element-wrapper city-element-wrapper clearfix\">
	                            <label for=\"city\">Billing City <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper city-input-wrapper\">
	                                <input class=\"city-element\" id=\"city2\" type=\"text\" name=\"city\" />
	                            </div>
	                        </div>
	                        <!-- End Address element -->
	                        <!-- Begin Zip element -->
	                        <div class=\"element-wrapper zipcode-element-wrapper clearfix\">
	                            <label for=\"zip\">Billing Zip Code <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper zipcode-input-wrapper\">
	                                <input class=\"zipcode-element\" id=\"zip2\" type=\"text\" name=\"zip\" />
	                            </div>
	                        </div>
	                        <!-- End Zip element -->
	                        <!-- Begin State element -->
	                        <div class=\"element-wrapper state-element-wrapper clearfix\">
	                            <label for=\"state\">Billing State <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper state-input-wrapper clearfix\">
	                                <select id=\"state2\" name=\"state\">
	                                    <option value=\"AL\">Alabama</option>
										<option value=\"AK\">Alaska</option>
										<option value=\"AZ\">Arizona</option>
										<option value=\"AR\">Arkansas</option>
										<option value=\"CA\">California</option>
										<option value=\"CO\">Colorado</option>
										<option value=\"CT\">Connecticut</option>
										<option value=\"DE\">Delaware</option>
										<option value=\"DC\">Dist of Columbia</option>
										<option value=\"FL\">Florida</option>
										<option value=\"GA\">Georgia</option>
										<option value=\"HI\">Hawaii</option>
										<option value=\"ID\">Idaho</option>
										<option value=\"IL\">Illinois</option>
										<option value=\"IN\">Indiana</option>
										<option value=\"IA\">Iowa</option>
										<option value=\"KS\">Kansas</option>
										<option value=\"KY\">Kentucky</option>
										<option value=\"LA\">Louisiana</option>
										<option value=\"ME\">Maine</option>
										<option value=\"MD\">Maryland</option>
										<option value=\"MA\">Massachusetts</option>
										<option value=\"MI\">Michigan</option>
										<option value=\"MN\">Minnesota</option>
										<option value=\"MS\">Mississippi</option>
										<option value=\"MO\">Missouri</option>
										<option value=\"MT\">Montana</option>
										<option value=\"NE\">Nebraska</option>
										<option value=\"NV\">Nevada</option>
										<option value=\"NH\">New Hampshire</option>
										<option value=\"NJ\">New Jersey</option>
										<option value=\"NM\">New Mexico</option>
										<option value=\"NY\">New York</option>
										<option value=\"NC\">North Carolina</option>
										<option value=\"ND\">North Dakota</option>
										<option value=\"OH\">Ohio</option>
										<option value=\"OK\">Oklahoma</option>
										<option value=\"OR\">Oregon</option>
										<option value=\"PA\">Pennsylvania</option>
										<option value=\"RI\">Rhode Island</option>
										<option value=\"SC\">South Carolina</option>
										<option value=\"SD\">South Dakota</option>
										<option value=\"TN\">Tennessee</option>
										<option value=\"TX\">Texas</option>
										<option value=\"UT\">Utah</option>
										<option value=\"VT\">Vermont</option>
										<option value=\"VA\">Virginia</option>
										<option value=\"WA\">Washington</option>
										<option value=\"WV\">West Virginia</option>
										<option value=\"WI\">Wisconsin</option>
										<option value=\"WY\">Wyoming</option>
	                                </select>
	                            </div>
	                        </div>
	                        <!-- End Subject element -->
                        </div>
                        <!-- end address container -->

                         <!-- begin address container -->
                        <div class=\"addressContainer\">

	                        <!-- Begin Address element -->
	                        <div class=\"element-wrapper address-element-wrapper clearfix\">
	                            <label for=\"address\">Shipping Street<span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper name-input-wrapper\">
	                                <input class=\"address-element\" id=\"address3\" type=\"text\" name=\"address\" />
	                            </div>
	                        </div>
	                        <!-- End Address element -->
	                        <!-- Begin Address element -->
	                        <div class=\"element-wrapper city-element-wrapper clearfix\">
	                            <label for=\"address\">Shipping City <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper city-input-wrapper\">
	                                <input class=\"city-element\" id=\"city3\" type=\"text\" name=\"city\" />
	                            </div>
	                        </div>
	                        <!-- End Address element -->
	                        <!-- Begin Zip element -->
	                        <div class=\"element-wrapper zipcode-element-wrapper clearfix\">
	                            <label for=\"zip\">Shipping Zip Code <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper zipcode-input-wrapper\">
	                                <input class=\"zipcode-element\" id=\"zip3\" type=\"text\" name=\"zip\" />
	                            </div>
	                        </div>
	                        <!-- End Zip element -->
	                        <!-- Begin State element -->
	                        <div class=\"element-wrapper state-element-wrapper clearfix\">
	                            <label for=\"state\">Shipping State <span class=\"red\">*</span></label>
	                            <div class=\"input-wrapper state-input-wrapper clearfix\">
	                                <select id=\"state3\" name=\"state\">
	                                    <option value=\"AL\">Alabama</option>
										<option value=\"AK\">Alaska</option>
										<option value=\"AZ\">Arizona</option>
										<option value=\"AR\">Arkansas</option>
										<option value=\"CA\">California</option>
										<option value=\"CO\">Colorado</option>
										<option value=\"CT\">Connecticut</option>
										<option value=\"DE\">Delaware</option>
										<option value=\"DC\">Dist of Columbia</option>
										<option value=\"FL\">Florida</option>
										<option value=\"GA\">Georgia</option>
										<option value=\"HI\">Hawaii</option>
										<option value=\"ID\">Idaho</option>
										<option value=\"IL\">Illinois</option>
										<option value=\"IN\">Indiana</option>
										<option value=\"IA\">Iowa</option>
										<option value=\"KS\">Kansas</option>
										<option value=\"KY\">Kentucky</option>
										<option value=\"LA\">Louisiana</option>
										<option value=\"ME\">Maine</option>
										<option value=\"MD\">Maryland</option>
										<option value=\"MA\">Massachusetts</option>
										<option value=\"MI\">Michigan</option>
										<option value=\"MN\">Minnesota</option>
										<option value=\"MS\">Mississippi</option>
										<option value=\"MO\">Missouri</option>
										<option value=\"MT\">Montana</option>
										<option value=\"NE\">Nebraska</option>
										<option value=\"NV\">Nevada</option>
										<option value=\"NH\">New Hampshire</option>
										<option value=\"NJ\">New Jersey</option>
										<option value=\"NM\">New Mexico</option>
										<option value=\"NY\">New York</option>
										<option value=\"NC\">North Carolina</option>
										<option value=\"ND\">North Dakota</option>
										<option value=\"OH\">Ohio</option>
										<option value=\"OK\">Oklahoma</option>
										<option value=\"OR\">Oregon</option>
										<option value=\"PA\">Pennsylvania</option>
										<option value=\"RI\">Rhode Island</option>
										<option value=\"SC\">South Carolina</option>
										<option value=\"SD\">South Dakota</option>
										<option value=\"TN\">Tennessee</option>
										<option value=\"TX\">Texas</option>
										<option value=\"UT\">Utah</option>
										<option value=\"VT\">Vermont</option>
										<option value=\"VA\">Virginia</option>
										<option value=\"WA\">Washington</option>
										<option value=\"WV\">West Virginia</option>
										<option value=\"WI\">Wisconsin</option>
										<option value=\"WY\">Wyoming</option>
	                                </select>
	                            </div>
	                        </div>
	                        <!-- End Subject element -->
	                    </div>
                        <!-- end address container -->

                        <!-- Begin method element -->
                        <div class=\"element-wrapper method-element-wrapper clearfix\">
                            <label for=\"state\">Method <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper method-input-wrapper clearfix\">
                                <select id=\"ccType2\" name=\"method\">
                                    <option value=\"Visa\">Visa</option>
									<option value=\"Mastercard\">Mastercard</option>
									<option value=\"American_Express\">American Express</option>
									<option value=\"Discover\">Discover</option>
									<option value=\"Diners_Club\">Diners Club</option>
									
                                </select>
                            </div>
                        </div>
                        <!-- End method element -->

	                    <!-- Begin CC numer element -->
                        <div class=\"element-wrapper name-element-wrapper clearfix\">
                            <label for=\"name\">Credit Card Number <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper name-input-wrapper\">
                                <input class=\"name-element\" id=\"cc2\" type=\"text\" name=\"name\" />
                            </div>
                        </div>
                        <!-- End Name element -->

                        <!-- Begin method element -->
                        <div class=\"element-wrapper method-element-wrapper clearfix\">
                            <label for=\"state\">Month <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper method-input-wrapper clearfix\">
                                <select id=\"month2\" name=\"method\">
                                    <option value='01'>January</option>
									<option value='02'>February</option>
									<option value='03'>March</option>
									<option value='04'>April</option>
									<option value='05'>May</option>
									<option value='06'>June</option>
									<option value='07'>July</option>
									<option value='08'>August</option>
									<option value='09'>September</option>
									<option value='10'>October</option>
									<option value='11'>November</option>
									<option value='12'>December</option>
                                </select>
                            </div>
                        </div>
                        <!-- End method element -->
                        <!-- Begin method element -->
                        <div class=\"element-wrapper method-element-wrapper clearfix\">
                            <label for=\"state\">Year <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper method-input-wrapper clearfix\">
                                <select id=\"year2\" name=\"method\">
                                    <option value='11'>11</option>
									<option value='12'>12</option>
									<option value='13'>13</option>
									<option value='14'>14</option>
									<option value='15'>15</option>
									<option value='16'>16</option>
									<option value='17'>17</option>
									<option value='18'>18</option>
									<option value='19'>19</option>
									<option value='20'>20</option>
                                </select>
                            </div>
                        </div>
                        <!-- End method element -->
                        <!-- Begin Captcha element -->
                        <div class=\"element-wrapper captcha-element-wrapper clearfix\">
                            <label for=\"type_the_word\">Security Code <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper captcha-input-wrapper clearfix\">
                                <input id=\"ccCode2\" class=\"captcha-element\" type=\"text\" name=\"type_the_word\" />
                            </div>
                        </div>
                        <!-- End Captcha element -->
                        <!-- Begin Submit button -->
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"contact\" value=\"Finalize Order\" onClick=\"
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
	xajax_finalizePurchase(firstname2, lastname2, email2, phone2, address2, city2, state2, zip2, cc2, ccCode2, month2, year2,type2,address3,city3,state3,zip3); return false; \" />
                            </div>
                        </div>
                        <!-- End Submit button -->
                        
	               </div>
	               <div id=\"purchaseStatus\" class=\"fltrt\"></div>
	           </div>
		   </div>
	</div>";
		
		
		
		$response->assign('payment', 'innerHTML', $html2);
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
		//$_SESSION['code'] = 0;
		
		$discountPrice = 20;
		
		//$code = strtolower($code);
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
			$_SESSION['codeShipping'] = $type;
			$previousCode2 = $_SESSION['codeDailyDeals'];
			
			if($previousCode2 == -1)
			{
				$shipping = "<font color='green'>FREE</font>";
				$total = number_format($total, 2);
				//$grantTotal = $total;
				//$grantTotal = number_format($grantTotal, 2);
				$grantTotal = $total - $discountPrice;
				$grantTotal = number_format($grantTotal, 2);
				$_SESSION['grandTotal'] = $grantTotal;
				$status = "<font color='green'>Your free shipping coupon code has been accepted and applied!   Your coupon has been accepted, and you just saved $20.00!</font>";
			}
			else
			{
				$shipping = "<font color='green'>FREE</font>";
				$total = number_format($total, 2);
				$grantTotal = $total;
				$grantTotal = number_format($grantTotal, 2);
				$_SESSION['grandTotal'] = $grantTotal;
				$status = "<font color='green'>Your free shipping coupon code has been accepted and applied!</font>";
			}
			
			//$response->assign('status', 'innerHTML', $status);
		}
		else if($type == -1)
		{
			$_SESSION['codeDailyDealsName'] = $code;
			$previousCode = $_SESSION['codeShipping'];
			$_SESSION['codeDailyDeals'] = $type;
			if(($previousCode >= 1) && ($previousCode <= 1000))
			{
				//$_SESSION['code'] = $type;
				$_SESSION['codeShipping'] = $type;
				$shipping = "<font color='green'>FREE</font>";
				$total = number_format($total, 2);
				//$grantTotal = $total;
				//$grantTotal = number_format($grantTotal, 2);
				$grantTotal = $total - $discountPrice;
				$grantTotal = number_format($grantTotal, 2);
				//$_SESSION['grandTotal'] = $grantTotal;
				$status = "<font color='green'>Your free shipping coupon code has been accepted and applied!   Your coupon has been accepted, and you just saved $20.00!</font>";
			}
			else
			{
				
				$shipping = "$3.99";
				$total = number_format($total, 2);
				$grantTotal = $total + 3.99 - $discountPrice;
				$grantTotal = number_format($grantTotal, 2);
				//$_SESSION['grandTotal'] = $grantTotal;
				$status = "<font color='green'>Your coupon has been accepted, and you just saved $20.00!</font>";
			}
			
			//$status .= "<font color='green'>   Your coupon has been entered, and you just saved $10.00!</font>";
			
			$_SESSION['grandTotal'] = $grantTotal;
		}
		else
		{
			//$previousCode = $_SESSION['codeShipping'];
			//$previousCode2 = $_SESSION['codeDailyDeals'];
			
			$_SESSION['codeDailyDeals'] = 0;
			$_SESSION['codeShipping'] = 0;
			$_SESSION['code'] = 0;
			$_SESSION['codeDailyDealsName'] = 'xxx';

			$shipping = "$3.99";
			$total = number_format($total, 2);
			$grantTotal = $total + 3.99;
			$grantTotal = number_format($grantTotal, 2);
			$_SESSION['grandTotal'] = $grantTotal;
			$status = "<font color='red'>Your entered an invalid coupon code!</font>";
			//$response->assign('status', 'innerHTML', $status);
		}
		
		$html2 = "<a name='checkout'></a><div class=\"iphorm-outer\">

		    <div class=\"iphorm-wrapper\">
	        <div class=\"iphorm-inner\">
	            <div class=\"form-title\">Payment Center</div>

	            	<!-- begin totals -->
	            	<div id=\"totalsContainer\">
					<ul id=\"totals\">
						<li>Subtotal:<span>$".$total."</span></li>
						<li>Shipping:<span>".$shipping."</span></li>
						<li>Grand Total:<span>$".$grantTotal."</span></li>
					</ul>
					</div>
					<!-- end totals -->

                   <div class=\"iphorm-message\"></div>
	               <div class=\"iphorm-container clearfix\">
	                    <!-- Begin Name element -->
                        <div class=\"element-wrapper coupon-element-wrapper clearfix\">
                            <label for=\"name\">Coupon Code <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper coupon-input-wrapper\">
                                <input class=\"coupon-element iphorm-tooltip\" id=\"code\" type=\"text\" title=\"Please enter your coupon code here\" name=\"coupon\" />
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Submit button -->
                        <div class=\"fltlft\">
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"contact\" value=\"Submit\" onClick=\"var shit=document.getElementById('code').value; xajax_validateCoupon(shit); return false; \"/>
                            </div>
                        </div>
                        </div>
                        <!-- End Submit button -->
                        <div id=\"status\">".$status."</div>
                        
                        <br/>

                        <!-- begin the next step -->
                        <div id=\"nextStep\" class=\"clearfix\">
                         <!-- Begin Submit button -->
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"continueShopping\" value=\"Continue Shopping\" onClick=\"xajax_continueShopping(); return false; \"/>
                            </div>
                        </div>
                        <!-- End Submit button -->
                         <!-- Begin Submit button -->
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"purchase\" value=\"Purchase\" onClick=\"xajax_proceedBuy(); return false; \"/>
                            </div>
                        </div>
                        <!-- End Submit button -->
                        </div>
                        <!-- end the next step -->
	               </div>
	           </div>
		   </div>
	</div><div id=\"payment\"></div>";
		
		
		
		
		
		$response->assign('buybuy', 'innerHTML', $html2);
		return $response;
	}
	
	function checkOut()
	{
		require_once "../Book.php";
		$response = new xajaxResponse();
		
		$listISBN = $_SESSION['listISBN'];
		
		$_SESSION['codeDailyDeals'] = 0;
		$_SESSION['codeShipping'] = 0;
		$_SESSION['code'] = 0;
		$_SESSION['codeDailyDealsName'] = 'xxx';
		
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
		
		$html2 = "<a name='checkout'></a><div class=\"iphorm-outer\">

		    <div class=\"iphorm-wrapper\">
	        <div class=\"iphorm-inner\">
	            <div class=\"form-title\">Payment Center</div>

	            	<!-- begin totals -->
	            	<div id=\"totalsContainer\">
					<ul id=\"totals\">
						<li>Subtotal:<span>$".$total."</span></li>
						<li>Shipping:<span>$3.99</span></li>
						<li>Grand Total:<span>$".$grantTotal."</span></li>
					</ul>
					</div>
					<!-- end totals -->
					
	               <div class=\"iphorm-container clearfix\">
	                    <!-- Begin Name element -->
                        <div class=\"element-wrapper coupon-element-wrapper clearfix\">
                            <label for=\"name\">Coupon Code <span class=\"red\">*</span></label>
                            <div class=\"input-wrapper coupon-input-wrapper\">
                                <input class=\"coupon-element iphorm-tooltip\" id=\"code\" type=\"text\" title=\"Please enter your coupon code here\" name=\"coupon\" />
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Submit button -->
                        <div class=\"fltlft\">
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"contact\" value=\"Submit\" onClick=\"var shit=document.getElementById('code').value; xajax_validateCoupon(shit); return false; \"/>
                            </div>
                        </div>
                        </div>
                        <!-- End Submit button -->
                        
                        <div id=\"status\"></div>
                       
                        <!-- begin the next step -->
                        <div id=\"nextStep\" class=\"clearfix\">
                         <!-- Begin Submit button -->
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"continueShopping\" value=\"Continue Shopping\" onClick=\"xajax_continueShopping(); return false; \"/>
                            </div>
                        </div>
                        <!-- End Submit button -->
                         <!-- Begin Submit button -->
                        <div class=\"button-wrapper submit-button-wrapper clearfix\">
                            <div class=\"loading-wrapper\"><span class=\"loading\">Please wait...</span></div>
                            <div class=\"button-input-wrapper submit-button-input-wrapper\">
                                <input class=\"submit-element\" type=\"submit\" name=\"purchase\" value=\"Purchase\" onClick=\"xajax_proceedBuy(); return false; \"/>
                            </div>
                        </div>
                        <!-- End Submit button -->
                        </div>
                        <!-- end the next step -->
	               </div>
	           </div>
		   </div>
	</div><div id=\"payment\"></div>";
		
		
		
		
		$response->assign('buybuy', 'innerHTML', $html2);
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

		$response->redirect("index.php?isbns=".$tempList);
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
<link href="css/tooltip.css" media="screen" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" type="text/css" href="contact-form/css/pagestyles.css" /><!-- Page styles -->
<link rel="stylesheet" type="text/css" href="contact-form/css/inline.css" /><!-- Contact form styles -->
<meta name="csrf-param" content="authenticity_token"/> 
<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/> 
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />

<meta name="robots" content="noindex, nofollow">
<META NAME="GOOGLEBOT" CONTENT="NOARCHIVE">
<META NAME="GOOGLEBOT" CONTENT="NOSNIPPET">

<script type="text/javascript" src="contact-form/js/jquery-1.5.min.js"></script><!-- If your webpage already has the jQuery library you do not need this -->
<script type="text/javascript" src="contact-form/js/plugins.js"></script>
<script type="text/javascript" src="contact-form/js/iphorm.js"></script>
<script type="text/javascript" src="contact-form/js/scripts.js"></script>
<script src="js/prototype.js" type="text/javascript"></script> 
<script src="js/effects.js" type="text/javascript"></script> 
<script src="js/dragdrop.js" type="text/javascript"></script> 
<script src="js/controls.js" type="text/javascript"></script> 
<script src="js/rails.js" type="text/javascript"></script> 
<script src="js/application.js" type="text/javascript"></script> 
<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script> 

<!-- navigation style + script -->
		<link rel='stylesheet' href='../bsgPages/css/navigation.css'>
		<script src='../bsgPages/js/navigation.js'></script>
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	


  
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
	
	
	
	$listISBN = $_SESSION['listISBN'];
	$shit = count($listISBN);
	if($shit > 0)
	{
		$list .= ",";
	}
	$counter = 0;
	foreach($listISBN as $key => $value)
	{
		$counter++;
		$list .= $key;
		if($counter < $shit){
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
	//echo $count;
	
	$count = count($isbns);
	
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
			$book = unserialize($book);
			$book = (object)$book;
			$newNumber = $book->getNewQuantity();
			
			$usedNumber = $book->getUsedQuantity();
			$rentNumber = $book->getRentQuantity();
			
			$values .= "(".$isbn10.",$usedNumber,$rentNumber);";
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
				if($temp->getNewPrice() == 0)
				{
					$resultStatus = "Sorry, we do not carry one or more of your books!!";
				}
				else if(($temp->getTitle() != null) && ($temp->getTitle() != ""))
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
 
			<div class="header"> <!-- begin header -->
	
		<div class="innerHeader"> <!-- begin inner header -->
		
		<a href="http://bookstoregenie.com" title="BookStoreGenie"><div class="topLogo"></div></a> 
			
			<div class="nav-wrap">
				<ul class="group" id="example-one">
		            <li><a href="../../bsgPages/about.html">About Us</a></li>
		            <li class="current_page_item"><a href="http://bookstoregenie.com">Rent Now</a></li>
		            <li><a href="../../bsgPages/trustTheGenie.html">Trust the Genie</a></li>
		            <li><a href="../../bsgPages/contact.html">Contact</a></li>
		            <li><a href="../../bsgPages/beAgenie.html">Be a Genie</a></li>
		        </ul>
		    </div> 
			
		</div> <!-- end inner header -->
			
	</div> <!-- end header -->
 	
		<div class="heading"> <!-- begin heading --> 
			
			<strong>Search Results</strong> 
			<h2>Here are your books!</h2>
			<h3><?php echo $resultStatus; ?></h3> 
		
			<div class="breadcrumbs">  <!-- begin breadcrumbs -->
				<a href="http://bookstoregenie.com" title="Homepage">Homepage</a> &raquo Rent Now
			</div> <!-- end breadcrumbs -->
			
			<!-- <h2><strong>Search Results</strong></h2>
			<h2>1 of your books found!</h2> -->
		
		</div> <!-- end heading --> 
		
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
							
							$html .= "<a class=\"comparePrices\"></a>
									<div class=\"tooltip\">
										<div class=\"compare\">
											<div class=\"compareCo\">
												<a href=\"http://www.chegg.com/\" target=\"_blank\"><img src=\"images/chegg.jpg\" alt=\"Chegg\"/></a><p>";
							
							
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
												<a href=\"http://www.campusbookrentals.com/\" target=\"_blank\"><img src=\"images/bookRentals.jpg\" alt=\"Campus Book Rentals\"/></a><p>";
												
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
												<a href=\"http://www.barnesandnoble.com/u/rent-textbooks-textbook-rental/379002518/\" target=\"_blank\"><img src=\"images/bn.gif\" alt=\"Book Renter\"/></a><p>";
												
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
					
					<br><br>
					<div id="buybuy"></div>
					<br><br><br><br><br>
				</div> 
			</div> 
			
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
				<div class="footer"> 
					<small>SubTotal</small> 
					<strong id="totalPrice1">0.00</strong> 
					<a  title="Add to Cart" onClick="xajax_checkOut(); return false;" >Check Out</a> 
				</div> 
			</div> 
			
			<div style="clear:both;"></div> 
				
		</div> 
			
		<div class="footer">  <!-- begin footer -->
		
		<a href="http://bookstoregenie.com" title="BookStoreGenie" id="footerLogo">BookStoreGenie</a> 
		
			
			
			<div style="clear:both;"></div> 
			
		</div> <!-- end footer -->
 
		
	</div> 
	
	
	</div>
	
	
	<script type="text/javascript" src="//asset0.zendesk.com/external/zenbox/v2.1/zenbox.js"></script>
<style type="text/css" media="screen, projection">
  @import url(//asset0.zendesk.com/external/zenbox/v2.1/zenbox.css);
</style>
<script type="text/javascript">
  if (typeof(Zenbox) !== "undefined") {
    Zenbox.init({
      dropboxID:   "20019273",
      url:         "https://bookstoregenie.zendesk.com",
      tabID:       "support",
      tabColor:    "blue",
      tabPosition: "Right"
    });
  }
</script>

	

<script type="text/javascript">
    var GoSquared={};
    GoSquared.acct = "GSN-024018-M";
    (function(w){
        function gs(){
            w._gstc_lt=+(new Date); var d=document;
            var g = d.createElement("script"); g.type = "text/javascript"; g.async = true; g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
            var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(g, s);
        }
        w.addEventListener?w.addEventListener("load",gs,false):w.attachEvent("onload",gs);
    })(window);
</script>

	<script type="text/javascript">
// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
$(document).ready(function() {

$(".comparePrices").tooltip({ effect: 'slide'});
});
</script>
	
<script>var _spinnakr_site_id="506106207";(function(d,t,a){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g[a]=a;g.src='//s5.spn.ee/js/so.js';s.parentNode.insertBefore(g,s)}(document,'script','async'))</script>
	
</body> 
 
 
</html> 