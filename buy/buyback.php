<?php
include_once "../Book.php";
session_start();
$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511','jteplitz_bookstore');
$total_amount='3500';

if(isset($_POST['submit']))
{
	//$code=isset($_POST['buyback_code'])?$_POST['buyback_code']:'';
	/*$name=isset($_POST['name'])?$_POST['name']:'';
	$email=isset($_POST['email'])?$_POST['email']:'';
	$phone=isset($_POST['phone'])?$_POST['phone']:'';*/
	$error='';
	
	if(isset($_POST['name']) && !empty($_POST['name']))
	{
	   $name=$_POST['name'];	
	}else
	{
	   $error .='Please enter the Name<br />';	
	}
	if(isset($_POST['email']) && !empty($_POST['email']))
	{
	   $email=$_POST['email'];	
	}else
	{
	   $error .='Please enter Email address<br />';	
	}
	if(isset($_POST['phone']) && !empty($_POST['phone']))
	{
	   $phone=$_POST['phone'];	
	}else
	{
	   $error .=' Please enter the Phone number<br />';	
	}
	if(isset($_POST['buyback_code']) && !empty($_POST['buyback_code']))
	{
	   $code=$_POST['buyback_code'];	
	}else
	{
	   $error .='Please enter the Coupon code<br />';	
	}
	
	
	if(empty($error))
	{
		
		 $sql='Select coupon_code from coupon_user where coupon_code="'.$code.'"';
		 $result=$mysqli->query($sql);
	
		/*if(isset($_SESSION['listISBN']))
		{
			$listISBN = $_SESSION['listISBN'];
		}else
		{
			$error='Your cart is empty please select';	
		}*/
		
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
			$total = $total + $book->getSubtotal();
			$howMany = $howMany + $book->getUsedQuantity() + $book->getRentQuantity();
		}
		 //$total = number_format($total, 2);
		
		$total=150.90;
		$result_coupon=$mysqli->query('Select * from coupon_list where starting_price <='.$total.' AND end_price >='.$total);	
		$row_coupon=$result_coupon->fetch_assoc();
		if($result_coupon->num_rows > 0)
		{
			if($result->num_rows<=0)
			{
				
					$mysqli->query('UPDATE coupon_list SET code='.$code.' WHERE gift_id='.$row_coupon['gift_id']);
					$mysqli->query('Insert into coupon_user SET name="'.$name.'", email="'.$email.'",phone="'.$phone.'",coupon_code="'.$code.'",gift_id="'.$row_coupon['gift_id'].'",created="'.date('Y-m-d').'"');
					
				$to = $email;
				$subject = "Gift Item ";		
				//$host = "localhost";
				//$username = "jteplitz";
				//$password = "jtt0511";
				//$headers = array ('From' => $from,'To' => $to,'Subject' => $subject,'Content-type' => "text/html");
				//$smtp = Mail::factory('smtp',array ('host' => $host,'auth' => true,'secure'=>"ssl",'username' => $username,'password' => $password));
				//$mail = $smtp->send($to, $headers, $body);
				$body='Dear '.$name.'<br />
				Your coupon code is valid and you recieved a gift from bookstoregenie.zigron.com';
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Bookstore Genie <support@bookstoregenie.zigron.com>' . "\r\n";
				
				mail($to, $subject, $body, $headers);		
				header('location:../sell/buy_gift.php?id='.$row_coupon['gift_id']);		
						
						
			}else
			{
				$error .= 'This Coupon Code is already used<br />';
			}
		}else
		{
		   $error .='The total amoount is not in range<br />';	
		}
	}
}

 ?>

        
<!DOCTYPE html>
<html>
<head>
<title>Bookstore genie | Buyback</title>
<meta name="csrf-param" content="authenticity_token"/>
<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- jquery script -->
<!--<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>-->
<!-- general style -->
<link href="../bsgPages/css/style.css" media="screen" rel="stylesheet" type="text/css" />

<!-- navigation style + script -->
<link rel='stylesheet' href='../bsgPages/css/navigation.css'>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="../script/autocomplete.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" type="text/javascript"></script>
<script src = "../script/browserinit.js" type = 'text/javascript'></script>
<script src='../bsgPages/js/navigation.js'></script>

<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

<!-- carousel gallery -->
<link rel="stylesheet" type="text/css" href="../bsgPages/css/demo.css" />
<link rel="stylesheet" type="text/css" href="../bsgPages/css/jquery.jscrollpane.css" media="all" />

<!-- Google Fonts -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo|Questrial|Istok+Web|Quattrocento+Sans:400,700"  type="text/css" />

<!-- tweets -->
		<script type="text/javascript" src="../bsgPages/js/mylatesttweets.js"></script>
<script>
function College(name, dbName, isbn, link){
	this.name   = name;
	this.dbName = dbName;
	this.isbn   = isbn;
	this.link   = link;
}
var department = "", course = "", section = "", school, autocomplete, amazonLinks, amazonPrice, goDown = false;

var usedPrice = 0, newPrice = 0, rentPrice = 0, ebookPrice = 0, popupStatus = 0;
var usedLinks = new Array(), newLinks = new Array(), rentLinks = new Array(), ebookLinks = new Array(); amazonLinks = new Array();

var ids = new Array();
function setDepartment(value){
	department = value;
}
function setCourse(value){
	course = value;
}
function setSection(value){
	section = value;
}
var data = new Array(), colleges = new Array();
$(document).ready(function (){
	$(".ui-state-hover").css("background: none;");
	$(".ui-state-hover").css("border: none;");
	BrowserDetect.init();
	if (BrowserDetect.browser == "Firefox"){
		/*$(".ui-button-custom-icon").css("left", '-4px');
		$(".ui-button-custom-icon").css("top", '-32px');*/
		$(".ui-button").css("width", "32px");
		$(".ui-button").css("height", "54px");
		$(".ui-button").css("left", "-4px");
		$(".ui-button").css("top", "-5px");
		
	}
	$.ajax({
		url: "../portal.php",
		type: "POST",
		data: {req: "school"},
		success: function(transport){
			var transport = eval ("(" + transport + ")");
			for (var i = 0; i < colleges.length; i++){
				data.push(colleges[i].name);
			}
			for (var i = 0; i < transport.length; i++){
				colleges.push(new College(transport[i][0], "", true, transport[i][1]));
				data.push(transport[i][0]);
			}
			data.sort();
			//AutoComplete_Create('search', data);'
			autocomplete = jQuery("#search").autocomplete({
				source: data
			});
			jQuery("#search").bind("autocompleteopen", function(event, ui){
				$("<li class='ui-menu-item' role='menuitem'>Can't find your University?</li>").appendTo(autocomplete);
			});
			
		},
		faliure: function(){
			alert("Unable to retrieve school information. Check your internet connection.");
		}
	});

	colleges.push(new College("University of Wisconsin Madison", "wisc", false, ""));
	colleges.push(new College("California State Polytechnic University Pomona", "calPolyPomona", false, ""));
});




function clearUniversity(){
	if ($("#search").val() == "Type in your University")
		document.getElementById('search').value='';
}

function changeSearch(text){
	$("#search").val(text);
}		</script>
<link rel="stylesheet" type="text/css" href="../bsgPages/css/my_lat_tweets.css" />
</head>

<!--<body class="in" onload="setCookie('results','(0073527114,0,1);','10'); updateTotal();"> -->
<body>
<div class="header"> <!-- begin header -->
  
  <div class="innerHeader"> <!-- begin inner header --> 
    
    <a href="http://www.bookstoregenie.com" title="BookStoreGenie">
    <div class="topLogo"></div>
    </a>
    <div class="nav-wrap">
      <ul class="group" id="example-one">
        <li><a href="../bsgPages/about.html">About Us</a></li>
        <li><a href="../bsgPages/rent/index.php">Rent Now</a></li>
        <li class="current_page_item"><a href="sellyourbook.html">Sell Now</a></li>
        <li><a href="../bsgPages/trustTheGenie.html">Trust the Genie</a></li>
        <li><a href="../bsgPages/contact.html">Contact</a></li>
        <li><a href="../bsgPages/beAgenie.html">Be a Genie</a></li>
      </ul>
    </div>
  </div>
  <!-- end inner header --> 
  
</div>
<!-- end header -->

<div class="heading"> <!-- begin heading -->
  
  <div class="breadcrumbs"> <!-- begin breadcrumbs --> 
    <a href="http://www.bookstoregenie.com" title="Homepage">Homepage</a> &raquo Buyback </div>
  <!-- end breadcrumbs --> 
  
</div>
<!-- end heading -->

<div class="wrap"> <!-- begin wrap -->
  
  <div class="left-col stepFour">
    <h2>Payment & Address:</h2>
   <div style="color:#F00; font-family:Tahoma, Geneva, sans-serif; font-size:13px; margin-left:25px;">  <?php if(isset($error)){
		echo $error;
		}?>
	</div>

    <form name="form" method="post" action="">
      <label for="university">
      <strong>University:</strong> 
      <!--<input type="text" name="university" />-->
      <div id = "searchContainer" class = "text">
        <input id = "search" onfocus = "clearUniversity()" type = "text" title = "Search your University!" value = "Type in your University">
        </input>
    
      </div>
      </label>
      <label for="name"> <strong>Name:</strong>
        <input type="text" name="name" value="" />
      </label>
      <label for="email"> <strong>Email:</strong>
        <input type="text" name="email" value="" />
      </label>
      <label for="phone"> <strong>Phone:</strong>
        <input type="text" name="phone" value="" />
      </label>
      <label for="state"> <strong>Address</strong>
        <input type="text" name="state" value="State"  onClick="(this.value='')" class="state"/>
        <input type="text" name="city" value="City"  onClick="(this.value='')" class="city"/>
        <input type="text" name="zip" value="Zip Code"  onClick="(this.value='')" class="zip"/>
      </label>
      <div class="payment"> <strong>Get paid by:</strong>
        <div class="poption">
          <label for="paypal" class="it">
            <input type="radio" name="paypal" />
            PayPal</label>
          <label for="paypalmail" class="in"> <strong>PayPal Address:</strong>
            <input type="text" name="paypalmail" />
          </label>
        </div>
        <div class="poption">
          <label for="paypal" class="it">
            <input type="radio" name="paypal" />
            Check</label>
          <label for="cstate" class="in"> <strong>Address:</strong>
            <input type="text" name="cstate" value="State"  onClick="(this.value='')" class="state"/>
            <input type="text" name="city" value="City"  onClick="(this.value='')" class="city"/>
            <input type="text" name="zip" value="Zip Code"  onClick="(this.value='')" class="zip"/>
          </label>
        </div>
      </div>
      <?php 
	  
	     $code = "CP" . strtoupper ( dechex ( rand ( 1000000000, 9999999999) ) ) . strtoupper ( chr( rand( 65, 90 ) ) ) . chr(rand(65, 90));
		 $coupon_code=substr($code,0,10);
		echo '<label><strong>Copy this coupon code and paste it in text field :'.$coupon_code.'</strong></label>';
		$query = "SELECT code FROM coupon_list ORDER BY RAND( ) LIMIT 1";
		
	if ($result = $mysqli->query($query)) {
		$row = $result->fetch_row();
	
	}
//}
?>

      <label for="buyback"> <strong>Buyback Cupon Code:</strong>
        <input type="text" name="buyback_code" value="" />
      </label>
      <strong>Terms & Conditions:</strong>
      <label for="terms" class="terms">
        <input type="checkbox" name="terms" />
        I have read and agree to the <a href="#">Buyback Terms & Conditions</a> </label>
      <input type="submit" value="Send my check" name="submit" class="submit" />
    </form>
  </div>
  <!-- end left col -->
  
  <div class="right-col"> <strong>Help</strong>
    <p>Here could stay an info or help regarding this section of the payment process.</p>
    <p>Proin tempor sagittis sapien, ut condimentum erat consectetur quis. Maecenas vitae magna at nulla convallis lobortis rutrum eu leo.</p>
    <p>Nam sit amet porta tellus. Fusce eget justo neque. Morbi facilisis, erat nec lacinia luctus, risus lorem tincidunt libero, nec consequat leo justo vitae massa.</p>
  </div>
  <!-- end right col -->
  
  <div style="clear:both;"></div>
</div>
<!-- end wrap -->

<div class="footer"> <!-- begin footer --> 
  
  <a href="http://www.bookstoregenie.com" title="BookStoreGenie" id="footerLogo">BookStoreGenie</a> 
  
  <!-- <ul> 
				<li><a href="about.html">About Us</a></li> 
				<li><a href="#" title="Sell Books">Sell Books</a></li> 
				<li><a href="#" title="Buy Books">Buy Books</a></li> 
				<li><a href="#" title="">Terms of Privacy</a></li> 
				<li><a href="#" title="">Terms and Conditions</a></li> 
			</ul> -->
  
  <div style="clear:both;"></div>
</div>
<!-- end footer --> 

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

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
	      tabColor:    "blue",
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
<?php    $mysqli->close();
?>
