<?php include_once('header.php');?>
    <div class="container">
    
      <div class="stepTwo"> 
				
					<!-- This is the old one
					<form class="inSearch" action="results" onSubmit=" return validateISBN('inSearchText','true');"> 
						<input type="text" id="inSearchText" name="isbn" value="Add more books" class="text" onClick="if(this.value=='Add more books') this.value='';" /> 
						<input type="submit" value="Add books" class="button" onClick = "addToCart();"/> 
						<div style="clear:both;"></div> 
						<div id="div-error" style="padding-left: 10px; color: red;"></div> 
					</form> 
					-->
					
				<div class="bookResults span9"> 
				
						<form class="inSearch" action="results" onSubmit=" return validateISBN('inSearchText','true');"> 
							  <input  id="appendedInputButton" size="16" type="text" name="isbn" class="span7 text" placeholder="Add more books"><button class="btn btn-success pull-right" type="button" onClick = "addToCart();"> Add Books</button>
							<div id="div-error" style="padding-left: 10px; color: red;"></div>
						</form>
				<?php
						
						
						$book_data = $_SESSION['listISBN'];
//						

						foreach($book_data as $key => $value)
						{
							
							$tempBook = $listISBN[$key];
							$tempBook = unserialize($tempBook);
							$html ="<div id=\"book-start\"  />"; 
							$html .="<div class=\"book\" id=\"book".$tempBook->getISBN()."\">"; 
							$html .= "<div class=\"blue_well\">"; 
							$html .="<a href=\"#-remove-this-book\" class=\"remove\" onClick=\"removeBook('".$tempBook->getISBN()."'); return false;xajax_removeBookFromList('".$tempBook->getISBN()."');\" >Remove this book</a> ";
							$html .="<img src=\"".$tempBook->getImage()."\" alt=\"Book Cover\" />"; 
							$html .="<div class=\"title\">"; 
							$html .="<strong>".$tempBook->getTitle()."</strong>"; 
							$html .="<small>".$tempBook->getAuthor()."</small>"; 
							$html .="<div class=\"isbn\">"; 
							$html .="ISBN <strong>".$tempBook->getISBN()."</strong>"; 
							$html .="</div>"; 
							$html .="</div>"; 
							$hmtl .="<div class=\"prices\">"; 
							$html .="<div class=\"new\">"; 
							$html .="<div class=\"counter\">"; 
							$html .="<input type=\"text\" id=\"newpcs".$tempBook->getISBN()."\" value=\"0\" DISABLED/>"; 
							$html .="<a href=\"#\" title=\"+\"onClick=\"xajax_addUsed('".$tempBook->getISBN()."'); increment('newpcs".$tempBook->getISBN()."'); return false;\" class=\"plus\">+</a>"; 
							$html .="<a href=\"#\" title=\"-\" onClick=\" xajax_decreaseUsed('".$tempBook->getISBN()."'); decrement('newpcs".$tempBook->getISBN()."'); return false;\" class=\"minus\">-</a>"; 
							$html .="</div>";
							$html .="<div class=\"price\">"; 
							$html .="<small>New</small>"; 
							$html .="<span id=\"newPrice".$tempBook->getISBN()."\" >$".$tempBook->getNewPrice()."</span>"; 
							$html .="			</div> </div>";
							$html .="<div class=\"used\">"; 
							$html .="			<div class=\"counter\"> "; 
							$html .="				<input type=\"text\"id=\"usedpcs".$tempBook->getISBN()."\" value=\"1\" DISABLED/> "; 
							$html .="				<a href=\"#\" title=\"+\"  onClick=\"xajax_addRent('".$tempBook->getISBN()."'); increment('usedpcs".$tempBook->getISBN()."'); return false;\" class=\"plus\">+</a> "; 
							$html .="				<a href=\"#\" title=\"-\"  onClick=\"xajax_decreaseRent('".$tempBook->getISBN()."'); decrement('usedpcs".$tempBook->getISBN()."'); return false;\" class=\"minus\">-</a> "; 
							$html .="	</div> "; 
							$html .="				<div class=\"price\"> "; 
							$html .="				<small>Used</small>";  
							$html .="				<span id=\"usedPrice".$tempBook->getISBN()."\"> $".$tempBook->getUsedPrice()."</span> "; 
							$html .="			</div> "; 
							$html .="		</div>";  
							$html .="		<div class=\"subtotal\"> "; 
							$html .="				<small>Subtotal</small>";  
							$html .="				<span id=\"Subtotal".$tempBook->getISBN()."\"> $0.0 </span> "; 
							$html .="		</div> "; 
							$html .="	</div> "; 
							$html .="	<div class=\"clearfix\"></div> "; 
							$html .="</div> "; 
							$html .="</div> 				</div>"; 
							
							echo $html;
							
						}
						 										
											
						?>
						 <!-- end book-start -->
									
				</div> <!-- book results -->
				
			<div class="span3">
			
			<div class="summary"> 
				<h3>Buyback Summary</h3> 
				<p> 
					New Books <strong id="totalNewBooks1">1</strong> 
				</p> 
				<p> 
					Used Books <strong id="totalUsedBooks1">1</strong> 
				</p> 
				<p> 
					Total Books <strong id="totalBooks1">2</strong> 
				</p>
				<p> 
					Subtotal <strong id="totalPrice1">63.3</strong> 
				</p> 
			</div> <!-- end summary -->
			
			<button class="btn btn-medium btn-block btn-success" href="cart" title="Add to Cart" onClick="addToCart();">Show me the money</button>
			
			</div> <!-- end span -->
			
			<div class="clearfix"></div> 
			
    </div> <!-- end step 2 -->

    </div> <!-- /container -->
<?php include_once('footer.php');?>