<?php
 	session_start();
 	
 	include 'xajax/xajax_core/xajax.inc.php';
	
	$xajax = new xajax();

	$xajax->configure("javascript URI","xajax/");

	
	
	$xajax->register(XAJAX_FUNCTION, 'finalizePurchase2');
	
	$xajax->processRequest();
 	
 	function authorizePayment2($cc, $month, $year, $firstname, $lastname, $email, $address, $state, $zip)
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
 	
 	
 	
 	function storeInfo2($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2, $type2,$address3, $city3, $state3, $zip3, $orderNumber)
	{
		require_once "Book.php";
		
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
		
			$query = "insert into jteplitz_bookstore.rentedBooks (rentPrice, rentMerchant, rentLink, usedPrice, usedMerchant, usedLink, newPrice, newMerchant, newLink, rentQuantity, newQuantity, usedQuantity, isbn, title, author, image, code, email, fulfilled, purchaseDate, orderNumber) values ('".$book->getRentPrice()."','".$book->getRentMerchant()."','".$book->getRentLink()."','".$book->getUsedPrice()."','".$book->getUsedMerchant()."','".$book->getUsedLink()."','".$book->getNewPrice()."','".$book->getNewMerchant()."','".$book->getNewLink()."','".$book->getRentQuantity()."','".$book->getNewQuantity()."','".$book->getUsedQuantity()."','".$book->getISBN()."','".$title4."','".$book->getAuthor()."','".$book->getImage()."','".$_SESSION['code']."','".$email2."','0', CURDATE(),'".$orderNumber."')";
			$mysqli->query($query);
		}
		
		$couponName = $_SESSION['codeDailyDealsName'];
		$query = "delete from jteplitz_bookstore.discounts where Name = '".$couponName."'";
		$mysqli->query($query);
		
		
		//$mysqli->query($query);
		$mysqli->close();
		
		
		
	}
	
	function sendUserEmail2($firstname, $lastname, $address, $city, $state, $zip, $email,$orderNumber)
	{
		require_once "Book.php";
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
	
	
	function sendAdminEmail2($firstname, $lastname, $email,$address, $city, $state, $zip, $phone,$orderNumber)
	{
		require_once "Book.php";
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
	
 	
 	
 	
 	function finalizePurchase2($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2,$type2,$address3, $city3, $state3, $zip3)
	{
		//require_once "Book.php";
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
			$authorize = authorizePayment2($cc2, $month2, $year2, $firstname2, $lastname2, $email2, $address2, $state2, $zip2);
		}
		
		if(($authorize[0] == 1) && ($statusCode == 1))
		{
//			$html2 = "we are good";

			$orderNumber = uniqid();

			storeInfo2($firstname2, $lastname2, $email2, $phone2, $address2, $city2, $state2, $zip2, $cc2, $ccCode2, $month2, $year2, $type2,$address3, $city3, $state3, $zip3, $orderNumber);
			sendUserEmail2($firstname2, $lastname2, $address3, $city3, $state3, $zip3, $email2,$orderNumber);
			sendAdminEmail2($firstname2, $lastname2, $email2, $address3, $city3, $state3, $zip3,$phone2,$orderNumber);
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
?>

<!DOCTYPE html> 
<html> 
<head> 
<title>Bookstore genie | Rent Now</title> 
  	<meta name="csrf-param" content="authenticity_token"/> 
	<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!-- jquery script -->
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
	
	<!-- general style -->
		<link rel="shortcut icon" href="./images/favicon.png"/> 
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/filter.css"/>
<link rel="stylesheet" type="text/css" href="css/step3.css"/>
<link rel="stylesheet" type="text/css" href="css/tooltip.css"/>
<link rel="stylesheet" type="text/css" href="contact-form/css/inline.css" /><!-- Contact form styles -->
		<script src='js/navigation.js'></script>
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	
	<!-- google fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo|Questrial|Istok+Web|Quattrocento+Sans:400,700"  type="text/css" />
		
	<!-- forms -->
		<!-- Standard form layout -->
		<link rel="stylesheet" type="text/css" href="iphorm/css/pagestyles.css" /><!-- Standard form layout -->
		<script type="text/javascript" src="contact-form/js/jquery-1.5.min.js"></script><!-- If your webpage already has the jQuery library you do not need this -->
<script type="text/javascript" src="contact-form/js/plugins.js"></script>
<script type="text/javascript" src="contact-form/js/iphorm.js"></script>
<script type="text/javascript" src="contact-form/js/scripts.js"></script>
		
</head>
 
 <?php
$xajax->printJavascript();
?>
 
<body class="in" onLoad="setCookie('results','(0073527114,0,1);','10'); updateTotal();"> 
	
	<div id="wrapper">

    <div id="header">
    	<div class="container_12">
            <div class="grid_3 alpha">
                <a href="./index.html" title="Bookstore Genie" id="logo">Bookstore Genie</a>
            </div>
            
            <div class="grid_9 omega">
                <ul class="menu sf-menu">
                    <li><a href="./about.html">About Us</a></li>
                    <li class="active"><a href="./rentbook.php" class="rentBookNav">Rent Now</a></li>
                    <!--<li><a href="./sellyourbook.php">Sell Now</a></li>-->
                    <li><a href="./trustTheGenie.html">Trust the Genie</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                    <li><a href="./beAGenie.html">Be a Genie</a></li>
              </ul><!-- Main menu end -->
          </div>
			<div class="clear"></div>
      </div>
        
    </div><!--Header End -->
    
   <!--
 <div id="icon-widgets">
        <ul class="icon-menu">
            <li class="social-icons"><a href="#">Social links</a>
                <div id="social-icons">
                	<div class="inner">
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Twitter" alt="Twitter" src="./images/social_icons/twitter.png" /></a> 
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Facebook" alt="Facebook" src="./images/social_icons/facebook.png" /></a> 
                        <div class="clear"></div> 
                    </div>
                </div>
            </li>
            <li class="search-box"><a href="#">Search</a>
            	<div id="search-box">
                	<input type="text" name="search" onFocus="if(this.value=='Search ..') this.value='';" onBlur="if(this.value=='') this.value='search ..';" value="Search .." />
                </div>
            </li>
            
        </ul>
    </div>
-->
    
    <div id="slideshow"></div><!-- Slideshow End -->
    
    <div id="container">
    	<div class="forchaser"></div>
        <div class="bg-transparent"></div>
        
	    <div class="container_12">
        	<div class="grid_8 alpha">
                <div class="breadcrumb">
                   	<a href="http://bookstoregenie.com" title="Homepage">Homepage</a> &raquo Buyback
                </div>
            </div>
            <div class="grid_4 omega">
                <span id="current-date"></span>
            </div>
            
            <div class="clear"></div>
            
            <div class="main-content">
            
            	<div class="grid_12 alpha omega">
            	
						<div class="stepTwo"> 
						
							<div class="left-col">
		
				    <!-- To copy the form HTML, start here -->
				    <div class="iphorm-outer">
						<!-- <form class="iphorm" action="contact-form/process.php" method="post" enctype="multipart/form-data"> -->
				            <div class="iphorm-wrapper">
				    	        <div class="iphorm-inner">
				    	           <div class="iphorm-title">Payment</div>
				    	           
				    	           		<div class="GrandTotalTop"><h4 style="color:white;">Grand Total : $<span>
				    	           		
				    	           		<?php
				    	           		  echo $_SESSION['grandTotal'];
				    	           		?>
				    	           		</span></h4></div>
				    	           
					               <div class="iphorm-container clearfix">
				                        <!-- Begin Name element -->
				                        <div class="element-wrapper first_name-element-wrapper clearfix">
				                            <label for="first_name">First Name <span class="red">*</span></label>
				                            <div class="input-wrapper first_name-input-wrapper">
				                                <input class="first_name-element iphorm-tooltip" id="firstname2" type="text" name="first_name" title="Please enter your first name" />
				                            </div>
				                        </div>
				                        <!-- End Name element -->
				                        <!-- Begin Name element -->
				                        <div class="element-wrapper last_name-element-wrapper clearfix">
				                            <label for="last_name">Last Name <span class="red">*</span></label>
				                            <div class="input-wrapper last_name-input-wrapper">
				                                <input class="last_name-element iphorm-tooltip" id="lastname2" type="text" name="last_name" title="Please enter your last name"/>
				                            </div>
				                        </div>
				                        <!-- End Name element -->
				                        <!-- Begin Email element -->
				                        <div class="element-wrapper email-element-wrapper clearfix">
				                            <label for="email">Email <span class="red">*</span></label>
				                            <div class="input-wrapper email-input-wrapper">
				                                <input class="email-element iphorm-tooltip" id="email2" type="text" name="email" title="We promise we will never send you spam" />
				                            </div>
				                        </div>
				                        <!-- End Email element -->
				                        <!-- Begin Phone element -->
				                        <div class="element-wrapper phone-element-wrapper clearfix">
				                            <label for="phone">Phone</label>
				                            <div class="input-wrapper phone-input-wrapper">
				                                <input class="phone-element iphorm-tooltip" id="phone2" type="text" name="phone" title="We will only use your phone number to contact you regarding your enquiry" />
				                            </div>
				                        </div>
				                        <!-- End Phone element -->
				                        <div class="address-area">
				                        <!-- Begin address input element -->
				                        <div class="element-wrapper street-element-wrapper clearfix">
				                            <label for="street">Shipping Street <span class="red">*</span></label>
				                            <div class="input-wrapper street-input-wrapper">
				                                <input class="street-element iphorm-tooltip" id="address3" type="text" name="street" title="Enter your shipping street" />
				                            </div>
				                        </div>
				                        <!-- End Text input element -->
				                        <!-- Begin address input element -->
				                        <div class="element-wrapper city-element-wrapper clearfix">
				                            <label for="city">Shipping City <span class="red">*</span></label>
				                            <div class="input-wrapper city-input-wrapper">
				                                <input class="city-element iphorm-tooltip" id="city3" type="text" name="city" title="Enter your shipping city" />
				                            </div>
				                        </div>
				                        <!-- End Text input element -->
				                       	<!-- Begin Single select element -->
				                        <div class="element-wrapper state-element-wrapper clearfix">
				                            <label for="state">Select State <span class="red">*</span></label>
				                            <div class="input-wrapper state-input-wrapper clearfix">
				                                <select class="iphorm-tooltip" id="state3" name="state" title="Select your state">
				                                    <option value="AL">Alabama</option>
													<option value="AK">Alaska</option>
													<option value="AZ">Arizona</option>
													<option value="AR">Arkansas</option>
													<option value="CA">California</option>
													<option value="CO">Colorado</option>
													<option value="CT">Connecticut</option>
													<option value="DE">Delaware</option>
													<option value="DC">Dist of Columbia</option>
													<option value="FL">Florida</option>
													<option value="GA">Georgia</option>
													<option value="HI">Hawaii</option>
													<option value="ID">Idaho</option>
													<option value="IL">Illinois</option>
													<option value="IN">Indiana</option>
													<option value="IA">Iowa</option>
													<option value="KS">Kansas</option>
													<option value="KY">Kentucky</option>
													<option value="LA">Louisiana</option>
													<option value="ME">Maine</option>
													<option value="MD">Maryland</option>
													<option value="MA">Massachusetts</option>
													<option value="MI">Michigan</option>
													<option value="MN">Minnesota</option>
													<option value="MS">Mississippi</option>
													<option value="MO">Missouri</option>
													<option value="MT">Montana</option>
													<option value="NE">Nebraska</option>
													<option value="NV">Nevada</option>
													<option value="NH">New Hampshire</option>
													<option value="NJ">New Jersey</option>
													<option value="NM">New Mexico</option>
													<option value="NY">New York</option>
													<option value="NC">North Carolina</option>
													<option value="ND">North Dakota</option>
													<option value="OH">Ohio</option>
													<option value="OK">Oklahoma</option>
													<option value="OR">Oregon</option>
													<option value="PA">Pennsylvania</option>
													<option value="RI">Rhode Island</option>
													<option value="SC">South Carolina</option>
													<option value="SD">South Dakota</option>
													<option value="TN">Tennessee</option>
													<option value="TX">Texas</option>
													<option value="UT">Utah</option>
													<option value="VT">Vermont</option>
													<option value="VA">Virginia</option>
													<option value="WA">Washington</option>
													<option value="WV">West Virginia</option>
													<option value="WI">Wisconsin</option>
													<option value="WY">Wyoming</option>
				                                </select>
				                            </div>
				                        </div>
				                        <!-- End state element -->
				                        <!-- Begin zip element -->
				                        <div class="element-wrapper zip-element-wrapper clearfix">
				                            <label for="zip">Shipping Zip <span class="red">*</span></label>
				                            <div class="input-wrapper zip-input-wrapper">
				                                <input class="zip-element iphorm-tooltip" id="zip3" type="text" name="zip" title="Enter you shipping zip code" />
				                            </div>
				                        </div>
				                        <!-- End zip element -->
				                        </div> <!-- end address area -->
				                        <div class="address-area">
										<!-- Begin address input element -->
				                        <div class="element-wrapper street-element-wrapper clearfix">
				                            <label for="street">Billing Street <span class="red">*</span></label>
				                            <div class="input-wrapper street-input-wrapper">
				                                <input class="street-element iphorm-tooltip" id="address2" type="text" name="street" title="Enter your billing street" />
				                            </div>
				                        </div>
				                        <!-- End Text input element -->
				                        <!-- Begin address input element -->
				                        <div class="element-wrapper city-element-wrapper clearfix">
				                            <label for="city">Billing City <span class="red">*</span></label>
				                            <div class="input-wrapper city-input-wrapper">
				                                <input class="city-element iphorm-tooltip" id="city2" type="text" name="city" title="Enter your billing city" />
				                            </div>
				                        </div>
				                        <!-- End Text input element -->
				                       	<!-- Begin Single select element -->
				                        <div class="element-wrapper state-element-wrapper clearfix">
				                            <label for="state">Select State <span class="red">*</span></label>
				                            <div class="input-wrapper state-input-wrapper clearfix">
				                                <select class="iphorm-tooltip" id="state2" name="state" title="Select your state">
				                                    <option value="AL">Alabama</option>
													<option value="AK">Alaska</option>
													<option value="AZ">Arizona</option>
													<option value="AR">Arkansas</option>
													<option value="CA">California</option>
													<option value="CO">Colorado</option>
													<option value="CT">Connecticut</option>
													<option value="DE">Delaware</option>
													<option value="DC">Dist of Columbia</option>
													<option value="FL">Florida</option>
													<option value="GA">Georgia</option>
													<option value="HI">Hawaii</option>
													<option value="ID">Idaho</option>
													<option value="IL">Illinois</option>
													<option value="IN">Indiana</option>
													<option value="IA">Iowa</option>
													<option value="KS">Kansas</option>
													<option value="KY">Kentucky</option>
													<option value="LA">Louisiana</option>
													<option value="ME">Maine</option>
													<option value="MD">Maryland</option>
													<option value="MA">Massachusetts</option>
													<option value="MI">Michigan</option>
													<option value="MN">Minnesota</option>
													<option value="MS">Mississippi</option>
													<option value="MO">Missouri</option>
													<option value="MT">Montana</option>
													<option value="NE">Nebraska</option>
													<option value="NV">Nevada</option>
													<option value="NH">New Hampshire</option>
													<option value="NJ">New Jersey</option>
													<option value="NM">New Mexico</option>
													<option value="NY">New York</option>
													<option value="NC">North Carolina</option>
													<option value="ND">North Dakota</option>
													<option value="OH">Ohio</option>
													<option value="OK">Oklahoma</option>
													<option value="OR">Oregon</option>
													<option value="PA">Pennsylvania</option>
													<option value="RI">Rhode Island</option>
													<option value="SC">South Carolina</option>
													<option value="SD">South Dakota</option>
													<option value="TN">Tennessee</option>
													<option value="TX">Texas</option>
													<option value="UT">Utah</option>
													<option value="VT">Vermont</option>
													<option value="VA">Virginia</option>
													<option value="WA">Washington</option>
													<option value="WV">West Virginia</option>
													<option value="WI">Wisconsin</option>
													<option value="WY">Wyoming</option>
				                                </select>
				                            </div>
				                        </div>
				                        <!-- End state element -->
				                        <!-- Begin zip element -->
				                        <div class="element-wrapper zip-element-wrapper clearfix">
				                            <label for="zip">Billing Zip <span class="red">*</span></label>
				                            <div class="input-wrapper zip-input-wrapper">
				                                <input class="zip-element iphorm-tooltip" id="zip2" type="text" name="zip" title="Enter you billing zip code" />
				                            </div>
				                        </div>
				                        <!-- End zip element -->
				                        </div> <!-- end address-area -->
				                        <div class="payment-area">
				                        <!-- Begin method element -->
				                        <div class="element-wrapper method-element-wrapper clearfix">
				                            <label for="state">Method <span class="red">*</span></label>
				                            <div class="input-wrapper method-input-wrapper clearfix">
				                                <select id="ccType2" name="method">
				                                    <option value="Visa">Visa</option>
													<option value="Mastercard">Mastercard</option>
													<option value="American_Express">American Express</option>
													<option value="Discover">Discover</option>
													<option value="Diners_Club">Diners Club</option>
													
				                                </select>
				                            </div>
				                        </div>
				                        <!-- End method element -->
				                        <!-- Begin CC numer element -->
				                        <div class="element-wrapper card-element-wrapper clearfix">
				                            <label for="card">Credit Card Number <span class="red">*</span></label>
				                            <div class="input-wrapper card-input-wrapper">
				                                <input class="card-element" id="cc2" type="text" name="card" />
				                            </div>
				                        </div>
				                        <!-- End Name element -->
				                        <!-- Begin method element -->
				                        <div class="element-wrapper month-element-wrapper clearfix">
				                            <label for="month">Month <span class="red">*</span></label>
				                            <div class="input-wrapper month-input-wrapper clearfix">
				                                <select id="month2" name="month">
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
				                        <div class="element-wrapper year-element-wrapper clearfix">
				                            <label for="year">Year <span class="red">*</span></label>
				                            <div class="input-wrapper year-input-wrapper clearfix">
				                                <select id="year2" name="year">
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
				                        <!-- Begin address input element -->
				                        <div class="element-wrapper ccBack-element-wrapper clearfix">
				                            <label for="ccBack">3-digit Code<span class="red">*</span></label>
				                            <div class="input-wrapper ccBack-input-wrapper">
				                                <input class="ccBack-element iphorm-tooltip" id="ccCode2" type="text" name="ccBack" title="3-digit number on the back" />
				                            </div>
				                        </div>
				                        <!-- End Text input element -->
				                        </div> <!-- end payment area -->
				                        
				                        <!-- Begin Submit button -->
				                        <div class="button-wrapper submit-button-wrapper clearfix">
				                        <div id="purchaseStatus"></div>
				                            <div class="loading-wrapper"><span class="loading">Please wait…</span></div>
				                            <div class="button-input-wrapper submit-button-input-wrapper">
				                             <input class="submit-element" type="submit" name="contact" value="Continue Shopping" onClick="location.href='rentbook.php' " />
				                             <input class="submit-element" type="submit" name="contact" value="Complete Order" onClick="
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
	xajax_finalizePurchase2(firstname2, lastname2, email2, phone2, address2, city2, state2, zip2, cc2, ccCode2, month2, year2,type2,address3,city3,state3,zip3); return false; " />
				                            </div>
				                        </div>
				                        <!-- End Submit button -->
					               </div><!-- /.iphorm-container -->
					           </div><!-- /.iphorm-inner -->
						   </div><!-- /.iphorm-wrapper -->
						<!-- </form> -->
					</div><!-- /.iphorm-outer -->
					<!-- To copy the form HTML, end here -->
					
		</div> 
						
						<!--
<div class="summary"> 
			
							<h3>Buyback Summary</h3> 
							<p> 
								Total Books <strong id="totalBooks1">2</strong> 
							</p> 
							<p> 
								New Books <strong id="totalNewBooks1">1</strong> 
							</p> 
							<p> 
								Used Books <strong id="totalUsedBooks1">1</strong> 
							</p> 
							<div class="total">
							<p> 
								Total <strong id="totalUsedBooks1">63</strong> 
							</p> 
							</div>
			
						</div> 
-->
						
						<div style="clear:both;"></div> 
							
			  </div>
                
          </div><!-- Grid 12 end -->
                
                <div class="clear"></div>
      </div>
            
</div><!-- .container_12 End -->

        <div class="bottom">
        
        	<div class="container_12">
            	<div class="grid_3 alpha">
                	<h3 class="title">FOOTER MENU</h3>
                    <ul class="menu">
                    	<li><a href="./about.html">About Us</a></li>
                        <li><a href="./rentbook.php">Rent Now</a></li>
                        <!-- <li><a href="./sellyourbook.php">Sell Now</a></li> -->
                        <li><a href="./trustTheGenie.html">Trust the Genie</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                        <li><a href="./beAGenie.html">Be a Genie</a></li>
                    </ul>
                </div>
                
                <div class="grid_3">
                	<h3 class="title">JOIN OUR MAILING LIST</h3>
                    <form action="#" method="post" id="newsletter-form">
                    <p>
                         <label for="name">Your name</label>
                         <input type="text" name="name" id="name" value="" tabindex="1" />
                    </p>
                	<p>
                         <label for="email">Your email address</label>
                         <input type="text" name="email" id="email" value="" tabindex="2" />
                    </p>
                    <p>
                        <input type="submit" value="Join Us" />
                    </p>
                </form>
                </div>
                
                <div class="grid_3">
                	<h3 class="title">CONTACT DETAILS</h3>
                    <p>Bookstore Genie, Inc.<br>
					2200 Pennsylvania Avenue, NW <br>(Suite 4075)<br>
					Washington D.C. 20037<br>
					Email: <a href="mailto:info@bookstoregenie.com">info@bookstoregenie.com</a><br>
					<a href="#" class="map_link hasTip" title="Click me to show the Map">We on Maps</a></p>
                </div>
                
                <div class="grid_3 omega">
                	
                </div>
                <div class="clear"></div>
                
            </div>
        </div><!-- Bottom End -->
        
        <div class="footer">
        	
        
        	<div class="container_12">
            	<div class="grid_4 alpha">
                	<div class="copyright">
                		
                        <div class="copyright-text">Copyright 2012 <a href="./index.html">Bookstore Genie</a>. All rights reserved.</div>
                    </div>
                </div>
                <div class="grid_5">
                	<ul class="social-connect">
                    	<li class="tweet">
                        	<a href="http://twitter.com/share" class="twitter-share-button" data-text="" data-count="horizontal" data-via="BookstoreGenie">Tweet</a>
							<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                        </li>
                        <li class="gplus">
                        	<g:plusone size="medium"></g:plusone>
                        </li>
                        <li class="fb-like">
                        	<div id="fb-root"></div>
							<script src="http://connect.facebook.net/en_US/all.js#appId=227862407254187&amp;xfbml=1"></script>
                            <fb:like href="http://bookstoregenie.com" send="false" layout="button_count" width="120" show_faces="false" font="arial"></fb:like>
                        </li>
                    </ul>
                </div>
                <div class="grid_2 omega"></div>
                <div class="clear"></div>
            </div>
        </div><!-- Footer End -->
        
        <div class="hidden-map-wrapper">
            <div class="shadow-top"></div>
            <div class="shadow-bottom"></div>
            <div class="close-map"></div>
            <div id="hidden_map"></div><!-- Container of the hidden map -->
        </div>
        
    </div><!-- #Container End -->
    
    <a href="#" id="top-link">Scroll to top</a> 
    
    
</div>
 
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
	<script type="text/javascript">
		$('#ca-container').contentcarousel();
	</script>
	
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
	      tabColor:    "black",
	      tabPosition: "Right"
	    });
	  }
	</script>
		
	
	<!-- begin olark code -->
	<script type='text/javascript'>/*{literal}<![CDATA[*/window.olark||(function(i){var e=window,h=document,a=e.location.protocol=="https:"?"https:":"http:",g=i.name,b="load";(function(){e[g]=function(){(c.s=c.s||[]).push(arguments)};var c=e[g]._={},f=i.methods.length; while(f--){(function(j){e[g][j]=function(){e[g]("call",j,arguments)}})(i.methods[f])} c.l=i.loader;c.i=arguments.callee;c.f=setTimeout(function(){if(c.f){(new Image).src=a+"//"+c.l.replace(".js",".png")+"&"+escape(e.location.href)}c.f=null},20000);c.p={0:+new Date};c.P=function(j){c.p[j]=new Date-c.p[0]};function d(){c.P(b);e[g](b)}e.addEventListener?e.addEventListener(b,d,false):e.attachEvent("on"+b,d); (function(){function l(j){j="head";return["<",j,"></",j,"><",z,' onl'+'oad="var d=',B,";d.getElementsByTagName('head')[0].",y,"(d.",A,"('script')).",u,"='",a,"//",c.l,"'",'"',"></",z,">"].join("")}var z="body",s=h[z];if(!s){return setTimeout(arguments.callee,100)}c.P(1);var y="appendChild",A="createElement",u="src",r=h[A]("div"),G=r[y](h[A](g)),D=h[A]("iframe"),B="document",C="domain",q;r.style.display="none";s.insertBefore(r,s.firstChild).id=g;D.frameBorder="0";D.id=g+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){D.src="javascript:false"} D.allowTransparency="true";G[y](D);try{D.contentWindow[B].open()}catch(F){i[C]=h[C];q="javascript:var d="+B+".open();d.domain='"+h.domain+"';";D[u]=q+"void(0);"}try{var H=D.contentWindow[B];H.write(l());H.close()}catch(E){D[u]=q+'d.write("'+l().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}c.P(2)})()})()})({loader:(function(a){return "static.olark.com/jsclient/loader0.js?ts="+(a?a[1]:(+new Date))})(document.cookie.match(/olarkld=([0-9]+)/)),name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('1395-504-10-7822');/*]]>{/literal}*/</script>
<!-- end olark code -->

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
	
</body> 
</html> 