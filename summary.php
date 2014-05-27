<?php include_once('rent/rent_header.php');?> 
        
	    <div class="container_12">
        	
            
            <div class="clear"></div>
            
            <div class="main-content">
            	<div class="grid_12 alpha omega">
                    
                    <div class="left-col stepThree">
			
			
			
			<div class="table">
				<div class="head">
					<!-- <div class="check"></div> -->
					<a href="#" title="Remove Checked" class="remove">Order Summary</a>
					<div style="clear:both;"></div>
				</div>
				<div class="books">
				
				
			<?php		
			require_once "Book.php";
			$listISBN = $_SESSION['listISBN'];
			$shit = count($listISBN);
			$divBook = "";
			$bookTotal = 0;
			$totalRent = 0;
			$totalUsed = 0;
			$countTitle = 0;
			$countBook = 0;
			foreach($listISBN as $key => $value)
			{
				$book = $listISBN[$key];
				$book = unserialize($book);
				$book = (object)$book;

				$bookTotal = ($book->getRentQuantity() * $book->getRentPrice()) + ($book->getUsedQuantity() * $book->getUsedPrice());
				
				$totalRent = $totalRent + $book->getRentQuantity();
				$totalUsed = $totalUsed + $book->getUsedQuantity();
				$count++;  ?>

				<div class="book">
						<!-- <div class=\"check\"></div> -->
						<div class="cover">
				<img src="<?php echo $book->getImage(); ?>" alt="Book Cover" />
							
						</div>
						<div class="title">
							<strong><?php echo $book->getTitle();?></strong>
							<em><?php echo $book->getAuthor();?></em>
						</div>
						<div class="new">
							<input  readonly="readonly" type="text" value="<?php echo $book->getUsedQuantity();?>" />Used
						</div>
						<div class="used">
							<input readonly="readonly" type="text" value="<?php echo $book->getRentQuantity(); ?>" />Rent
						</div>
						<div class="price">
							$ <?php echo number_format($bookTotal,2); ?>
						</div>
						<div style="clear:both;"></div>
					</div> 
		<?php 
			
			} ?>	
			<?php 
			$countBook = $totalRent + $totalUsed;	?>
			
			</div>
				<div class="footer-secondary">
					<!-- <div class=\"check\"></div> -->
					<div class="cover">
						<strong><?php echo $count;?></strong>
						Titles
					</div>
					<div class="title">
						<strong><?php echo $countBook;?></strong>
						Total Books
					</div>
					<div class="new">
						<strong><?php echo $totalUsed; ?></strong>
						Total Bought
					</div>
					<div class="used">
						<strong><?php echo $totalRent; ?></strong>
						Total Rented
					</div>
					<div class="price">
						$<?php echo number_format($_SESSION['grandTotal'],2); ?>
					</div>
					<div style="clear:both;"></div>
				</div>
				
			</div>
			
			<a href="purchase.php" title="send my check" class="action">Finalize Order</a><a href="rentbook.php" title="send my check" class="action">Continue Shopping</a> 
					
		</div> <!-- end left col -->
		
		<div class="right-col">
			
			<strong>Order Summary Page</strong>
			<p>Please note that if you have entered in a coupon code, the price reflects the coupon.</p>
			<p>If you continue shopping, please be sure to enter your coupon code again.</p>
		
		</div><!-- end right col -->
		
		<div style="clear:both;"></div>
                </div><!-- Grid 12 end -->
                
                <div class="clear"></div>
            </div>
            
        </div><!-- .container_12 End -->
<?php include_once('rent/rent_footer.php');?>    
