<?php include_once('header.php');?>
<?php include_once('includes/Book_sell.php');?>
 <div class="container">
      <div class="stepTwo span7"> 
    	<h3>Fill out our form &amp; <div class="money-green">you get paid.</div></h3>
    	<br/><br/>
<!--   <script type="text/javascript" src="js/livevalidation_standalone.compressed.js"></script>-->
   <script type="text/javascript" src="js/livevalidation_standalone.js"></script>
<?php /* if(isset($_POST['send_order'])){
		echo '<pre>';
		
		//print_r($_POST);
		
		
	    $university=isset($_POST['university'])?$_POST['university']:'';
		$fullname=isset($_POST['fullname'])?$_POST['fullname']:'';
		$streetAddress=isset($_POST['streetAddress'])?$_POST['streetAddress']:'';
		$city=isset($_POST['city'])?$_POST['city']:'';
		$state=isset($_POST['state'])?$_POST['state']:'';
		$postalCode=isset($_POST['postalCode'])?$_POST['postalCode']:'';
		$chk_box=isset($_POST['chk_box'])?$_POST['chk_box']:'';
		
		
		if($_POST['optionsRadios'][0]=='paypal')
		{
			$paypalEmail=isset($_POST['paypalEmail'])?$_POST['paypalEmail']:'';
		}
		
		else if($_POST['optionsRadios'][0]=='check')
		{
			$streetAddress_check=isset($_POST['streetAddress1'])?$_POST['streetAddress1']:'';
			$city_check=isset($_POST['city1'])?$_POST['city1']:'';
			$state_check=isset($_POST['state1'])?$_POST['state1']:'';
			$zip_check=isset($_POST['zip1'])?$_POST['zip1']:'';
		}
		
		print_r($_SESSION);
		$listISBN = $_SESSION['listISBN'];
		$_SESSION['codeDailyDeals'] = 0;
		$_SESSION['codeShipping'] = 0;
		$_SESSION['code'] = 0;
		$_SESSION['codeDailyDealsName'] = 'xxx';
		
		//$shit = count($listISBN);
		
		$howMany = 0;
		foreach($listISBN as $key => $value)
		{
			$book = $listISBN[$key];
			$book = unserialize($book);
			$book = (object)$book;
			//print_r($book);
			 $total = $total + $book->getSubtotal();
			 $howMany = $howMany + $book->getNewQuantity() + $book->getUsedQuantity();
			 $ISBN = $book->getIsbn();
			echo 'ISBN: '.$ISBN ;
		}
		exit;
		$grantTotal = number_format($total, 2);
		$_SESSION['grandTotal'] = $grantTotal;
 		
}*/
	?>
				
				<form name="form" method="POST" action="../amazon/feed/MarketplaceWebService/Samples/submitBookFeed.php">
				 <!-- <input class="span5" type="text" id="university" placeholder="University" data-provide="typeahead">-->
                 <!--  <input id ="search" class="span5"  placeholder="University" name="university" type = "text" title = "Search your University!" >
      			  </input>
                  
                  <script>
					var search = new LiveValidation( 'search', {onlyOnSubmit: true } );
					search.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <input class="span5" type="text" id="fullName" name="fullname" placeholder="Full name">
				<script>
					var fullName = new LiveValidation( 'fullName', {onlyOnSubmit: true } );
					fullName.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
                
                  <input class="span5" type="text" id="contactEmail" name="contactEmail" placeholder="Contact Email">
                  <script>
					var contactEmail = new LiveValidation( 'contactEmail', {onlyOnSubmit: true } );
					contactEmail.add( Validate.Presence,{ failureMessage: "Required" } );
					contactEmail.add(  Validate.Email,{ failureMessage: "Incorrect Format" } );
					
					

					
                </script>
				  <input class="span5" type="text" id="streetAddress"  name="streetAddress" placeholder="Street Address">
                  <script>
					var streetAddress = new LiveValidation( 'streetAddress', {onlyOnSubmit: true } );
					streetAddress.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <input class="span4 field-push-right" type="text" id="city" name="city" placeholder="City">
                  <script>
					var city = new LiveValidation( 'city', {onlyOnSubmit: true } );
					city.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <input class="span2 field-push-right" type="text" id="state" name="state" placeholder="State">
                  <script>
					var state = new LiveValidation( 'state', {onlyOnSubmit: true } );
					state.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <br /><input class="span1" type="text" id="postalCode" placeholder="Postal" name="postalCode">
                  <script>
					var postalCode = new LiveValidation( 'postalCode', {onlyOnSubmit: true } );
					postalCode.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>-->
                 <input class="span5" type="text"   name="university" id="search" placeholder="University" data-provide="typeahead">
                 <script>
					var search = new LiveValidation( 'search', {onlyOnSubmit: true } );
					search.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
                 
				  <input class="span5" type="text" id="fullName" name="fullname" placeholder="Full name">
                  <script>
					var fullName = new LiveValidation( 'fullName', {onlyOnSubmit: true } );
					fullName.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
                
                 <input class="span5" type="text" id="contactEmail" name="contactEmail" placeholder="Contact Email">
                  <script>
					var contactEmail = new LiveValidation( 'contactEmail', {onlyOnSubmit: true } );
					contactEmail.add( Validate.Presence,{ failureMessage: "Required" } );
					contactEmail.add(  Validate.Email,{ failureMessage: "Incorrect Format" } );
					
					

					
                </script>
                
				  <input class="span7" type="text" id="streetAddress" name="streetAddress" placeholder="Street Address">
                    <script>
					var streetAddress = new LiveValidation( 'streetAddress', {onlyOnSubmit: true } );
					streetAddress.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <input class="span4 field-push-right" type="text"id="city" name="city" placeholder="City">
                   <script>
					var city = new LiveValidation( 'city', {onlyOnSubmit: true } );
					city.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <input class="span2 field-push-right" type="text"  id="state" name="state" placeholder="State">
                   <script>
					var state = new LiveValidation( 'state', {onlyOnSubmit: true } );
					state.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
				  <input class="span1" type="text" id="postalCode" placeholder="Postal" name="postalCode">
                   <script>
					var postalCode = new LiveValidation( 'postalCode', {onlyOnSubmit: true } );
					postalCode.add( Validate.Presence,{ failureMessage: "Required" } );
                </script>
                <input  type="hidden" id="country"  name="country" value="us">
            
				  <h5>Get paid by:</h5>
				  <div class="blue_well">
				  	<label class="radio">
						  <input type="radio" name="optionsRadios[]" id="optionsRadios1" class="regular-radio" value="paypal" checked>
						  <h4 class="dark-blue">Paypal</h4> <br/>
						  <input class="span6" type="text" id="paypalEmail" name="paypalEmail" placeholder="Paypal email">
						</label>
						<label class="radio">
						  <input type="radio" name="optionsRadios[]" id="optionsRadios2" value="check">
						  <h4 class="dark-blue">Check</h4> <br/>
						  <input class="span6" type="text" id="streetAddress1" name="streeAddress1" placeholder="Street Address">
						  <input class="span3 field-push-right" type="text" id="city1" name="city1" placeholder="City">
						  <input class="span2 field-push-right" type="text" id="state1" name="state1" placeholder="State">
						  <input class="span1" type="text" id="zip1" name="zip1" placeholder="Zip">
						</label>
				  </div>
				  
				  <br/>
				  
				  <input class="span5" type="text" id="couponCode" placeholder="Buyback coupon code">
				  
				  <div class="control-group">
				    <div class="controls">
				      <label class="checkbox">
				        <input type="checkbox" name="chk_box" id="chk_box"><p class="deep-red">I have read and agree to the <a href="#">Buyback terms and conditions</a></p>
                        <script>
                          var chk_box = new LiveValidation( 'chk_box', {onlyOnSubmit: true } );
							chk_box.add( Validate.Acceptance ,{ failureMessage: "Required" } );
                        </script>
				      </label>
				      <br/>
				      <button type="submit" name="send_order" class="btn btn-medium btn-block btn-success" href="cart" title="Send money" onClick="addToCart(); check_radiobuttons();">Show me the money</button>
                      <script>
                      function check_radiobuttons()
					  {
						 if($('#optionsRadios1').is(':checked'))
						 {
						    var paypalEmail = new LiveValidation( 'paypalEmail', {onlyOnSubmit: true } );
							paypalEmail.add( Validate.Presence,{ failureMessage: "Required" } );
							paypalEmail.add( Validate.Email,{ failureMessage: "Incorrect Format" }); 
							
							
							  var streetAddress1 = new LiveValidation( 'streetAddress1', {onlyOnSubmit: true } );
							streetAddress1.remove( Validate.Presence,{ failureMessage: "Required" } );
							
							 var city1 = new LiveValidation( 'city1', {onlyOnSubmit: true } );
							city1.remove( Validate.Presence,{ failureMessage: "Required" } );
							
							 var state1 = new LiveValidation( 'state1', {onlyOnSubmit: true } );
							state1.remove( Validate.Presence,{ failureMessage: "Required" } );
							
							 var zip1 = new LiveValidation( 'zip1', {onlyOnSubmit: true } );
							zip1.remove( Validate.Presence,{ failureMessage: "Required" } );	 
								 
								 
						 }else if($('#optionsRadios2').is(':checked')) 
						 {
							 
							  var streetAddress1 = new LiveValidation( 'streetAddress1', {onlyOnSubmit: true } );
							streetAddress1.add( Validate.Presence,{ failureMessage: "Required" } );
							
							 var city1 = new LiveValidation( 'city1', {onlyOnSubmit: true } );
							city1.add( Validate.Presence,{ failureMessage: "Required" } );
							
							 var state1 = new LiveValidation( 'state1', {onlyOnSubmit: true } );
							state1.add( Validate.Presence,{ failureMessage: "Required" } );
							
							 var zip1 = new LiveValidation( 'zip1', {onlyOnSubmit: true } );
							zip1.add( Validate.Presence,{ failureMessage: "Required" } );
							 
							  var paypalEmail = new LiveValidation( 'paypalEmail', {onlyOnSubmit: true } );
							paypalEmail.remove( Validate.Presence,{ failureMessage: "Required" } );
							paypalEmail.remove( Validate.Email,{ failureMessage: "Incorrect Format" }); 	 
							 
						}
						  
					  }
                      </script>
				    </div>
				  </div>
				  
				</form>
			
      </div> <!-- end step 2 -->
      
      <div class="span5">
      	<div class="white_well">
      		<h4>Something has gone wrong</h4>
      		<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>

      		<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

	      	<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

		      <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to</p>
      	</div>
      </div>

    </div> 
<?php include_once('footer.php');?>