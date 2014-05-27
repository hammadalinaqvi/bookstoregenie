<?php include_once('rent/rent_header.php');?> 
        
	    <div class="container_12">
        	
            
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
<?php include_once('rent/rent_footer.php');?> 