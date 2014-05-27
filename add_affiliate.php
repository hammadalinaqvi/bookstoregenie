<?php
	include 'xajax/xajax_core/xajax.inc.php';
	
	$xajax = new xajax();

	$xajax->configure("javascript URI","xajax/");

	$xajax->register(XAJAX_FUNCTION, 'buy');

	$xajax->processRequest();

	function buy($college,$org,$contactPerson,$email,$number,$paypal,$code,$who)
	{
		$response = new xajaxResponse();

		//$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');

		//$query = "insert into jteplitz_bookstore.getmoney (amazon, new, used, title, isbn, weight, grouping, ourPrice, weird) values ($amazonPrice,$lowNewPrice,$lowUsedPrice,'$title','$isbn',$weight, $id, $ourPrice2, $weird)";

		//$mysqli->query($query);

		//$mysqli->close();
		
		
		$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
		
		$query = "insert into jteplitz_bookstore.organizations (name, email, phone, contactName, paypal, subdomain, code, university) values ('$org','$email','$number','$contactPerson','$paypal','$subdomain', '$code', '$college')";

		$mysqli->query($query);
	
		$query = "select Max(Type) as high from jteplitz_bookstore.discounts";

		$highest = 1;
		if ($result = $mysqli->query($query)) {
        		while($obj = $result->fetch_object()){
           		 $highest =$obj->high;
        		}
    		}
    		if($highest == null)
    		{
    			$id = -99;
    		}
	
		$highest++;
	
		$query = "insert into jteplitz_bookstore.discounts (Name, Type,CouponCreator) values ('$code',$highest,'$who')";	

		$mysqli->query($query);

		$mysqli->close();
		
		$script = "document.getElementById('collegename').value = ''; 
	document.getElementById('orgname').value = '';
	document.getElementById('contactName').value = '';
	document.getElementById('email').value = '';
	document.getElementById('contactPhone').value = '';
	document.getElementById('payPal').value = '';
	document.getElementById('code').value = '';";
		
		$status = "<font color='green'>You have successfully entered '$org' as an affiliate!!  Love, Farhan <font>";
		
		$response->script($script);
		$response->assign('books', 'innerHTML', $status);
		return $response;
	}

	
	
	$xajax->printJavascript();
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>



</head>




<body>

<div id = "page">
	<div id = "header">
		<h1>Just for Erica - Please add lots of organizations - Love, Farhan</h1>
	</div>
	<div id = "content">
	<form id = "isbnForm"  name = "form" onSubmit = "var college=document.getElementById('collegename').value; 
	var org=document.getElementById('orgname').value;
	var contactPerson=document.getElementById('contactName').value;
	var email=document.getElementById('email').value;
	var number=document.getElementById('contactPhone').value;
	var paypal=document.getElementById('payPal').value;
	var code=document.getElementById('code').value;
	var who=document.getElementById('who').value;
	return xajax_buy(college,org,contactPerson,email,number,paypal,code,who);">
			<label for = "collegename">College Name: </label><input class = "formInput" type = "text" id = "collegename" value = "" ></input><br><br>
			<label for = "orgname">Organization Name: </label><input class = "formInput" type = "text" id = "orgname" value = "" ></input><br><br>
			<label for = "email">Contact Person: </label><input type = "text" class = "formInput" id = "contactName"   value = ""></input><br><br>
			<label for = "contactPhone">Contact E-mail: </label><input type = "text" class = "formInput" id = "email"   value = ""></input><br><br>
			<label for = "contactName">Contact Phone Number: </label><input type = "text" class = "formInput" id = "contactPhone" value = ""></input><br><br>
		<label for = "payPal">Email for Paypal Payment : </label><input type = "text" id = "payPal"  class = "formInput"value = ""></input><br><br>
			<label for = "code">Coupon code : </label><input type = "text" id = "code"  class = "formInput"value = ""></input><br><br>
			<label for = "code">Who are you : </label><input type = "text" id = "who"  class = "formInput"value = ""></input><br><br>
			<input type="submit" value="Submit" onClick="var college=document.getElementById('collegename').value; 
	var org=document.getElementById('orgname').value;
	var contactPerson=document.getElementById('contactName').value;
	var email=document.getElementById('email').value;
	var number=document.getElementById('contactPhone').value;
	var paypal=document.getElementById('payPal').value;
	var code=document.getElementById('code').value;
	var who=document.getElementById('who').value;
	return xajax_buy(college,org,contactPerson,email,number,paypal,code,who);"> </input>
		</form>
	</div>

	<p>******************************************************************************************************</p>

	<div id="books">

	</div>

	<p>******************************************************************************************************</p>
	</div>