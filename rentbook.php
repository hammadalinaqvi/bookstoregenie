<?php include_once('rent/rent_header.php');?>   
	    <div class="container_12">
	    
               <!-- <div class="breadcrumb">
                    <a href="./index.html">Home</a> &raquo <span>Rent Now</span>
                </div>
                <span id="current-date"></span>-->
            
            <div class="clear"></div>
            
            <div class="main-content">
            
            	<div class="grid_12 alpha omega">
            	
						<div class="stepTwo"> 
						
							<div class="left-col">
								<?php	
								$isCheggLower = 0;
								foreach($fucker as $key => $value)
								{
									$tempBook = $listISBN[$key];
									$tempBook = unserialize($tempBook);
									
									$ourPrice = $tempBook->getRentPrice();
									$cheggPrice = $tempBook->getChegg();
									
									if($cheggPrice < $ourPrice)
									{
										$isCheggLower = 1;
									}
									
								}
								
								$winnerDisplay2 = "";
								$loserDisplay2 = "";
								
								$winnerDisplay = "<div id=\"YouWon\">
								
									<div class=\"YouWonTop\"></div>
									<div class=\"YouWonBottom\">
									<div class=\"bottomTweet\">
									<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=\"http://bookstoregenie.com\" data-text=\"@BookstoreGenie #3rdqtrproblems? Looking to score on textbooks? I just took the #GenieChallenge to get cheap textbooks!\">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>						
									</div>
									<div class=\"bottomFb\">
									<div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=155848384505352\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
									<div class=\"fb-like\" data-href=\"https://www.facebook.com/BookstoreGenie\" data-send=\"true\" data-layout=\"button_count\" data-width=\"150\" data-show-faces=\"false\"></div>
									</div>
									</div>
								
								</div> <!-- end won -->";
								
								
								$loserDisplay = "<div id=\"YouLost\">
								
									<div class=\"YouLostTop\"></div>
									<div class=\"YouLostBottom\">
									<div class=\"bottomTweet\">
									<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=\"http://bookstoregenie.com\" data-text=\"@BookstoreGenie #3rdqtrproblems? Looking to score on textbooks? I just took the #GenieChallenge to get cheap textbooks!\">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>						
									</div>
									<div class=\"bottomFb\">
									<div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=155848384505352\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
									<div class=\"fb-like\" data-href=\"https://www.facebook.com/BookstoreGenie\" data-send=\"false\" data-layout=\"button_count\" data-width=\"150\" data-show-faces=\"false\"></div>								
									</div>
									</div>
								
								</div> <!-- end lost -->";
							
							if($isCheggLower == 1)
							{
								echo $winnerDisplay2;
							}
							else
							{
								echo $loserDisplay2;
							}
							
							?>
							
							<img src="images/howto.jpg" style="margin-bottom:20px;">
							
							
								<form class="inSearch"  onSubmit="var shit=document.getElementById('SearchText').value;  xajax_reloadPage(shit); return false;"> 
									<input type="text" id="SearchText" name="isbn" value="Add more books" class="text" onClick="if(this.value=='Add more books') this.value='';" /> 
									<input type="submit" value="Add books" class="button" onClick = "var shit=document.getElementById('SearchText').value; xajax_reloadPage(shit); return false;"/> 
									<div style="clear:both;"></div> 
									<div id="div-error" style="padding-left: 10px; color: red;"></div> 
								</form> 
								
								
							
							<div class="bookResults"> 
								
										<div id="book-start" /> 
						
						<?php
						
						//require_once "Book.php";
						//echo "shitdamn";
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
									<div class=\"tooltip makeitDark\">
										<div class=\"compare\">
											<div class=\"compareCo\">
												<a href=\"".$tempBook->getCheggLink()."\" target=\"_blank\"><img src=\"images/chegg.jpg\" alt=\"Chegg\"/></a><p>";
							
							
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
												<a href=\"".$tempBook->getCbrLink()."\" target=\"_blank\"><img src=\"images/bookRentals.jpg\" alt=\"Campus Book Rentals\"/></a><p>";
												
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
												<a href=\"".$tempBook->getBrLink()."\" target=\"_blank\"><img src=\"images/bn.gif\" alt=\"Book Renter\"/></a><p>";
												
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
							//echo "shit";
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
							<div class="footerTotal"> 
								<small>SubTotal</small> 
								<strong id="totalPrice1">0.00</strong> 
								<a title="Add to Cart" onClick="xajax_checkOut(); return false;" >Check Out</a> 
							</div> 
						</div> 
						
						<div style="clear:both;"></div> 
							
			  </div>
                
          </div><!-- Grid 12 end -->
                
                <div class="clear"></div>
      </div>
            
</div><!-- .container_12 End -->

<?php include_once('rent/rent_footer.php');?>    