<?php
 	session_start();
?>
<!DOCTYPE html>
<html>
 
<head> 
 
<meta name="robots" content="index, follow" /> 
<meta name="keywords" content="" /> 
<meta name="description" content="" /> 
<title>BookstoreGenie &ndash; Ebooks</title> 

<!-- CSS Start //--> 
<link rel="shortcut icon" href="./images/favicon.png"/> 
<link rel="stylesheet" type="text/css" href="./style.css"/> 
<link rel="stylesheet" type="text/css" href="./css/ebook.css" /> 
<link rel="stylesheet" type="text/css" href="./css/colorbox.css" /> 
<link rel="stylesheet" type="text/css" href="./css/superfish.css" />
<link rel="stylesheet" type="text/css" href="./css/tipTip.css" />

<link id="google_font" href='http://fonts.googleapis.com/css?family=Maven+Pro:regular,bold&v1' rel='stylesheet' type='text/css'>
<!-- fallback if js not enabled //-->
<link href="./css/noscript.css" rel="stylesheet" type="text/css" media="screen,all" id="noscript" /> 
<!-- CSS End //-->


<!-- JS Start //-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script>window.jQuery || document.write("<script src='./js/libs/jquery-1.6.2.min.js'>\x3C/script>")</script>
<script type="text/javascript">
	var $ = jQuery.noConflict();
</script>
<script type="text/javascript" src="./js/jquery.detectbrowser.js"></script> 
<script type="text/javascript" src="./js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/jquery.infieldlabel.min.js"></script>
<script type="text/javascript" src="./js/jquery.twitter.js"></script>
<script type="text/javascript" src="./js/jquery.supersubs.js"></script>
<script type="text/javascript" src="./js/jquery.superfish.js"></script>
<script type="text/javascript" src="./js/jquery.quovolver.js"></script>
<script type="text/javascript" src="./js/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="./js/jquery.totop.js"></script>
<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="./js/redirection_mobile.min.js"></script>

<!-- Custom Functions - Main Js file -->
<script type="text/javascript" src="./js/functions.js"></script> 

<!-- Redirect if mobile device -->
<script type="text/javascript">
	SA.redirection_mobile ({
	  noredirection_param:"noredirection",
	  mobile_url : "", // put here your own link
	  mobile_prefix : "http",
	  cookie_hours : "2" 
	});

$(document).ready(function() {

	// load hidden map
	loadHiddenMap();
});
</script> 
<!-- JS End //--> 

<!-- Start Facebook Like Open Graph Tags -->
<meta property="og:title" content="" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://bookstoregenie.com" />
<meta property="og:image" content="" />
<meta property="og:site_name" content="" />
<meta property="fb:admins" content="" />
<!-- END Facebook Like Open Graph Tags -->
<meta charset="UTF-8"></head>

<body class="">

<div id="wrapper">

    <div id="header">
    	<div class="container_12">
            <div class="grid_3 alpha">
                <a href="./index.html" title="Ammon Template" id="logo">Ammon Template</a>
            </div>
            
            <div class="grid_9 omega">
                <ul class="menu sf-menu">
                    <li><a href="./about.html">About Us</a></li>
                    <li><a href="./rentbook.php" class="rentBookNav">Rent Now</a></li>
                    <!-- <li class="active"><a href="./sellyourbook.php">Sell Now</a></li> -->
                    <li><a href="./trustTheGenie.html">Trust the Genie</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                    <li><a href="./beAGenie.html">Be a Genie</a></li>
                </ul><!-- Main menu end -->
            </div>
			<div class="clear"></div>
        </div>
        
    </div><!--Header End -->
    
    <div id="icon-widgets">
        <ul class="icon-menu">
            <li class="social-icons"><a href="#">Social links</a>
                <div id="social-icons">
                	<div class="inner">
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Twitter" alt="Twitter" src="./images/social_icons/twitter.png" /></a> 
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Facebook" alt="Facebook" src="./images/social_icons/facebook.png" /></a> 
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Youtube" alt="Youtube" src="./images/social_icons/youtube.png" /></a> 
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Vimeo" alt="Vimeo" src="./images/social_icons/vimeo.png" /></a> 
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Google Plus" alt="Google" src="./images/social_icons/gplus.png" /></a> 
                        <a target="_blank" href="#" rel="nofollow"><img title="Follow us on Linkedin" alt="Linkedin" src="./images/social_icons/linkedin.png" /></a> 
                        <div class="clear"></div> 
                    </div>
                </div>
            </li>
            <li class="search-box"><a href="#">Search</a>
            	<div id="search-box">
                	<input type="text" name="search" onfocus="if(this.value=='Search ..') this.value='';" onblur="if(this.value=='') this.value='search ..';" value="Search .." />
                </div>
            </li>
            
        </ul><!-- Icon Menu End -->
    </div>
    
    <div id="slideshow"></div><!-- Slideshow End -->
    
    <div id="container">
    	<div class="forchaser"></div>
        <div class="bg-transparent"></div>
        
	    <div class="container_12">
        	<div class="grid_8">
                <div class="breadcrumb">
                    <a href="./index.html">Home</a> >> <span>Ebooks</span>
                </div>
            </div>
        </div>  
			
			<?php

$isbn = $_GET["isbn"];

$jsonurl = "http://openlibrary.org/api/volumes/brief/isbn/".$isbn.".json";
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json, true);



//var_dump($json_output['items']);


$url =  $json_output['items'][0]['itemURL'];

if(($url == "") || ($url == null))
{
	echo "This book does not exist for free viewing!";
}
else
{
	$temp = "<iframe src=\"".$url."\" width=\"100%\" height=\"800px\"></iframe>";
	echo $temp;
}

	
?>

       		<div class="twitter-wrapper">
            	<div class="container_12">
                	<div class="grid_12 alpha omega">
                    	<div id="twitter"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div><!-- Twitter Wrapper -->

        <div class="bottom">
        
        	
 
        	<div class="container_12">
            	<div class="grid_3 alpha">
                	<h3 class="title">FOOTER MENU</h3>
                    <ul class="menu">
                    	<li><a href="./about.html">About Us</a></li>
                        <li><a href="./rentbook.php">Rent Now</a></li>
                        <li><a href="./sellyourbook.php">Sell Now</a></li>
                        <li><a href="./trustTheGenie.html">Trust the Genie</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                        <li><a href="./beAGenie.html">Be a Genie</a></li>
                        <li><a href="./bsgagreement.html">Rental Agreement</a></li>
<li><a href="./genieChallengeTerms.html">Genie Challenge Terms</a></li>
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
                <div class="clear"></div>
                
            </div>
        </div><!-- Bottom End -->
        
        <div class="footer">
        	
        
        	<div class="container_12">
            	<div class="grid_6 alpha">
                	<div class="copyright">
                		
                        <div class="copyright-text">Copyright 2012 <a href="./index.html">Bookstore Genie</a>. All rights reserved.</div>
                    </div>
                </div>
                <div class="grid_6 omega">
                	
                </div>
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
    
    
</div><!-- Wrapper end -->

<!-- Start of HubSpot Tracking Code -->
<script type="text/javascript" language="javascript"> var hs_portalid=166161; var hs_salog_version = "2.00"; var hs_ppa = "bookstoregenie.app12.hubspot.com"; document.write(unescape("%3Cscript src='" + document.location.protocol + "//" + hs_ppa + "/salog.js.aspx' type='text/javascript'%3E%3C/script%3E")); </script>
<!-- End of HubSpot Tracking Code -->

</body>
</html>




