<?php
 	session_start();
?>


<!DOCTYPE html> 
<html> 
<head> 
<title>Bookstore genie | Sell your book</title> 
  	<meta name="csrf-param" content="authenticity_token"/> 
	<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!-- jquery script -->
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
	
	<!-- general style -->
		<link href="../bsgPages/css/style.css" media="screen" rel="stylesheet" type="text/css" /> 
	
	<!-- navigation style + script -->
		<link rel='stylesheet' href='../bsgPages/css/navigation.css'>
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
		<link rel="stylesheet" type="text/css" href="../bsgPages/css/my_lat_tweets.css" />
		
</head>
 
<body class="in" > 
	
	<div class="header"> <!-- begin header -->
	
		<div class="innerHeader"> <!-- begin inner header -->
		
		<a href="http://www.bookstoregenie.com" title="BookStoreGenie"><div class="topLogo"></div></a> 
			
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
			
		</div> <!-- end inner header -->
			
	</div> <!-- end header -->
 	
		<div class="heading"> <!-- begin heading --> 
		
			<div class="breadcrumbs">  <!-- begin breadcrumbs -->
				<a href="http://www.bookstoregenie.com/rent" title="Homepage">Rent</a> &raquo Order Summary
			</div> <!-- end breadcrumbs -->
			
		</div> <!-- end heading -->
			
	<div class="wrap"> <!-- begin wrap -->
	
		<div class="left-col stepThree">
			
			
			
			<div class="table">
				<div class="head">
					<div class="check">
					</div>
					<a href="#" title="Remove Checked" class="remove">Order Summary</a>
					<div style="clear:both;"></div>
				</div>
				<div class="books">
					<div class="book">
						<div class="check">
						</div>
						<div class="cover">
							<img src="images/bookCover.jpg" alt="Book Cover" />
							
						</div>
						<div class="title">
							<strong>Here goes the book title</strong>
							<em>Book Author Name</em>
						</div>
						<div class="new">
							<input  readonly="readonly" type="text" value="12" />New
						</div>
						<div class="used">
							<input readonly="readonly" type="text" value="06" />Used
						</div>
						<div class="price">
							$254
						</div>
						<div style="clear:both;"></div>
					</div> 
					
					<div class="book">
						<div class="check">
							
						</div>
						<div class="cover">
							<img src="images/bookCover.jpg" alt="Book Cover" />
							
						</div>
						<div class="title">
							<strong>Here goes the book title</strong>
							<em>Book Author Name</em>
						</div>
						<div class="new">
							<input type="text" value="12" />New
						</div>
						<div class="used">
							<input type="text" value="06" />Used
						</div>
						<div class="price">
							$254
						</div>
						<div style="clear:both;"></div>
					</div> 
				
				</div>
				<div class="footer-secondary">
					<div class="check">
					</div>
					<div class="cover">
						<strong>4</strong>
						Titles
					</div>
					<div class="title">
						<strong>56</strong>
						Total Books
					</div>
					<div class="new">
						<strong>48</strong>
						Total Bought
					</div>
					<div class="used">
						<strong>8</strong>
						Total Rented
					</div>
					<div class="price">
						$1,540
					</div>
					<div style="clear:both;"></div>
				</div>
			
			</div>
			
			<a href="#" title="send my check" class="action">Complete My Order</a>
					
		</div> <!-- end left col -->
		
		<div class="right-col">
			
			<strong>Order Summary Page</strong>
			<p>Please note that if you have entered in a coupon code, the price reflects the coupon.</p>
			<p>If you continue shopping, please be sure to enter your coupon code again.</p>
		
		</div><!-- end right col -->
		
		<div style="clear:both;"></div> 
				
	</div> <!-- end wrap -->
	
		<div class="footer">  <!-- begin footer -->
		
		<a href="http://www.bookstoregenie.com" title="BookStoreGenie" id="footerLogo">BookStoreGenie</a> 
		
			<!-- <ul> 
				<li><a href="about.html">About Us</a></li> 
				<li><a href="#" title="Sell Books">Sell Books</a></li> 
				<li><a href="#" title="Buy Books">Buy Books</a></li> 
				<li><a href="#" title="">Terms of Privacy</a></li> 
				<li><a href="#" title="">Terms and Conditions</a></li> 
			</ul> --> 
			
			<div style="clear:both;"></div> 
			
		</div> <!-- end footer -->
 
	
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