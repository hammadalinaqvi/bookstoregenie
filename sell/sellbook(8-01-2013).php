<?php include_once('header.php');?>
 <div class="container">
      <div class="stepTwo"> 
				<div class="bookResults span9"> 
				
						<form class="inSearch" action="results" onSubmit=" return validateISBN('inSearchText','true');"> 
							  <input  size="16" type="text" id="isbn_number" name="isbn" class="span7 pull-left" placeholder="Add more books"><button class="btn btn-success pull-right" type="button" onClick = "var isbn=document.getElementById('isbn_number').value; xajax_reloadPage(isbn);"> Add Books</button>
							<div id="div-error" style="padding-left: 10px; color: red;"></div>
						</form>
				
                	<?php
						
						
						$book_data = $_SESSION['sell_listISBN'];
//						
                 if(count($book_data )>0){
						foreach($book_data as $key => $value)
						{
							
							$tempBook = $listISBN[$key];
							$tempBook = unserialize($tempBook); ?>
                
						<div id="book-start" /> 
						<div class="book" id="book<?php echo $tempBook->getISBN();?>"> 
							
							<div class="blue_well"> 
									<a href="#-remove-this-book" class="remove" onClick="removeBook('<?php echo $tempBook->getISBN();?>'); return xajax_removeBookFromList('<?php echo $tempBook->getISBN(); ?>');" >Remove this book</a> 
								<img src="<?php echo $tempBook->getImage();?>" alt="Book Cover" /> 
								<div class="title"> 
									<strong><?php echo $tempBook->getTitle();?></strong> 
									<small><?php echo $tempBook->getAuthor();?></small> 
									<div class="isbn"> 
										ISBN <strong><?php echo $tempBook->getISBN();?></strong> 
									</div> <!-- end isbn -->
								</div> <!-- end title -->
								<div class="prices"> 
									<div class="new"> 
										<div class="counter"> 
											<input type="text" id="newpcs<?php echo $tempBook->getISBN();?>" value="0" DISABLED/> 
											<a href="#" title="+" onClick="xajax_addNew('<?php echo $tempBook->getISBN(); ?>'); increment('newpcs<?php echo $tempBook->getISBN()?>'); return false;" class="plus">+</a> 
											<a href="#" title="-" onClick="xajax_decreaseNew('<?php echo $tempBook->getISBN();?>'); decrement('newpcs<?php echo $tempBook->getISBN(); ?>'); return false;" class="minus">-</a> 
										</div> <!-- end counter -->
										<div class="price"> 
											<small>New</small> 
											<span id="newPrice<?php echo $tempBook->getISBN();?>" > 
													$<?php echo number_format($tempBook->getNewPrice(),2);?>
											</span> 
										</div> <!-- end price -->
									</div> <!-- end new -->
									<div class="used"> 
										<div class="counter"> 
											<input type="text" id="usedpcs<?php echo $tempBook->getISBN();?>" value="1" DISABLED/> 
											<a href="#" title="+" onClick="xajax_addUsed('<?php echo $tempBook->getISBN();?>'); increment('usedpcs<?php echo $tempBook->getISBN()?>'); return false;" class="plus">+</a> 
											<a href="#" title="-" onClick="xajax_decreaseUsed('<?php echo $tempBook->getISBN(); ?>'); decrement('usedpcs<?php echo $tempBook->getISBN();?>'); return false;" class="minus">-</a> 
										</div> <!-- end counter -->
										<div class="price"> 
											<small>Used</small> 
											<span id="usedPrice<?php echo $tempBook->getISBN(); ?>"> 
													$<?php echo number_format($tempBook->getUsedPrice(),2);?>
											</span> 
										</div> <!-- end price -->
									</div> <!-- end used -->
									<div class="subtotal"> 
											<small>Subtotal</small> 
											<span id="Subtotal<?php echo $tempBook->getISBN();?>"> $0.0 </span> 
									</div> <!-- subtotal -->
								</div> <!-- end prices -->
								<div class="clearfix"></div> 
							</div> <!-- end content -->
							</div> <!-- end book -->
				</div> <!-- end book-start -->
                <?php }
				 }else
				 {
				    echo "<div id=\"book-start\" /> <p>No Results</p></div>";	 
				 }
				?>
									
				</div> <!-- book results -->
				
			<div class="span3">
			
			<div class="summary"> 
				<h3>Buyback Summary</h3> 
				<p> 
					New Books <strong id="totalNewBooks1">0</strong> 
				</p> 
				<p> 
					Used Books <strong id="totalUsedBooks1">0</strong> 
				</p> 
				<p> 
					Total Books <strong id="totalBooks1">0</strong> 
				</p>
				<p> 
					Subtotal <strong id="totalPrice1">$0.0</strong> 
				</p> 
			</div> <!-- end summary -->
			<?php if(isset($_SESSION['sell_listISBN']) && (count($_SESSION['sell_listISBN']) >0) ){?>
			<button class="btn btn-medium btn-block btn-success" href="cart" title="Add to Cart" onClick="xajax_checkOut(); return false;">Show me the money</button>
           <?php }?>
			
			</div> <!-- end span -->
			
			<div class="clearfix"></div> 
			
    </div> 
    </div> 
<?php include_once('footer.php');?>