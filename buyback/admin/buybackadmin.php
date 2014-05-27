<?php 
include_once('header.php');
include_once('../db_connect/config.php');
include_once('../includes/functions.php');

include_once ('.config.inc.php');
?>
<div class="container">
  <table class="table table-bordered">
    <thead>
      <tr class="tbl-header">
        <th>Name</th>
        <th>E-mail Address</th>
        <th>Phone Number</th>
        <th>University</th>
        <th>Order Number</th>
        <th># of Books</th>
        <th>Order Total</th>
        <th>E-mail Opened</th>
        <th>Shipment Sent</th>
        <th>Shipment Receieved</th>
       
      </tr>
    </thead>
    <tbody>
    <?php 
		$result = mysql_query("select * from  book_order ORDER BY id DESC");
		while($row = mysql_fetch_array($result)){
	    	$result_books_query = mysql_query("select * from  book_shipment where book_order_id=".$row['id']);
			$row_book_data = mysql_fetch_assoc($result_books_query);
		
	?>
      <tr <?php 
	  		if( $row['transaction_status'] == 'in_progress') {
				echo 'class="medium"';
			}
			
			else if($row['transaction_status'] == 'complete'){
				echo 'class="high"';
			}
			
			else if($row['email_opened_status'] == 1) {
				echo 'class="low"';
			}
		 ?>
       >
        <td><a href="#buybackdetails_<?php echo $row['id']; ?>" data-toggle="modal"><?php echo $row['from_name'];?></a> 
          <!-- Modal -->
          
          <div id="buybackdetails_<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel">Buyback details</h3>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr class="tbl-header">
                    <th>Book Image</th>
                    <th>ISBN</th>
                    <th>Book Title</th>
                    <th>Quantity</th>
                    <th>Condition</th>
                    <th>Price Paid</th>
                    <th>Amazon Low</th>
                    <th>Net</th>
                    <th>Percent Profit</th>
                    <th>SalesRank</th>
                    <th>SalesRank Percentile</th>
                    <th>Book Shipped</th>
                    <th>Book Delivered</th>
                    <th>Book Received</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
				$result_books = mysql_query("select * from  book_shipment where book_order_id=".$row['id']);
				while($row_book = mysql_fetch_array($result_books)){
					$book_array = getRentalPrice($row_book['ISBN']);
					
				
					if ($row_book['quantity_new'] == 0){ ?> 
                  	<tr>
                        <td><img src="<?php echo $book_array['image']; ?>" width="52px" height="65px" /></td>
                        <td><?php echo $row_book['ISBN'];?></td>
                        <td><?php echo $book_array['title'];?></td>
                        <td height="40"><?php echo $row_book['quantity_used']; ?></td>
                        <td><?php echo 'Used';?></td>
                        <td><?php echo '$ '.$row_book['price_used'];?></td>
                        <td><?php echo '$ '.$row_book['amazon_used_low'];?></td>
                        <td> - </td>
                        <td> - </td>
                        <td> <?php echo $row_book['amazon_sales_rank'];?></td>
                        <td> - </td>
                        <td><?php if($row_book['book_shipped'] != NULL){echo date('m/d/Y',strtotime($row_book['book_shipped']));} else echo "-";?></td>
                        <td><?php if($row_book['book_delivered'] != NULL){echo date('m/d/Y',strtotime($row_book['book_delivered']));} else echo "-";?></td>
                        <td><?php if($row_book['book_received'] != NULL){echo date('m/d/Y',strtotime($row_book['book_received']));} else echo "-";?></td>
                  	</tr>
                   <?php }
				    else if ($row_book['quantity_used'] == 0){ ?>
                    
                    <tr>
                        <td><img src="<?php echo $book_array['image']; ?>" width="52px" height="65px" /></td>
                        <td><?php echo $row_book['ISBN'];?></td>
                        <td><?php echo $book_array['title'];?></td>
                        <td><?php echo $row_book['quantity_new']?></td>
                        <td><?php echo 'New';?></td>
                        <td><?php echo '$ '.$row_book['price_new'];?></td>
                        <td><?php echo '$ '.$row_book['amazon_new_low'];?></td>
                        <td> - </td>
                        <td> - </td>
                        <td> <?php echo $row_book['amazon_sales_rank'];?></td>
                        <td> - </td>
                        <td><?php if($row_book['book_shipped'] != NULL){echo date('m/d/Y',strtotime($row_book['book_shipped']));} else echo "-";?></td>
                        <td><?php if($row_book['book_delivered'] != NULL){echo date('m/d/Y',strtotime($row_book['book_delivered']));} else echo "-";?></td>
                        <td><?php if($row_book['book_received'] != NULL){echo date('m/d/Y',strtotime($row_book['book_received']));} else echo "-";?></td>
                    </tr>
					
					<?php }
					
					else { ?>
                    
					<tr>
                        <td rowspan="2"><img src="<?php echo $book_array['image']; ?>" width="52px" height="65px" /></td>
                        <td rowspan="2"><?php echo $row_book['ISBN'];?></td>
                        <td rowspan="2"><?php echo $book_array['title'];?></td>
                        <td height="40"><?php echo $row_book['quantity_new']?></td>
                        <td><?php echo 'New';?></td>
                        <td><?php echo '$ '.$row_book['price_new'];?></td>
                        <td><?php echo '$ '.$row_book['amazon_new_low'];?></td>
                        <td rowspan="2"> - </td>
                        <td rowspan="2"> - </td>
                        <td rowspan="2"> <?php echo $row_book['amazon_sales_rank'];?></td>
                        <td rowspan="2"> - </td>
                        <td rowspan="2"><?php if($row_book['book_shipped'] != NULL){echo date('m/d/Y',strtotime($row_book['book_shipped']));} else echo "-";?></td>
                        <td rowspan="2"><?php if($row_book['book_delivered'] != NULL){echo date('m/d/Y',strtotime($row_book['book_delivered']));} else echo "-";?></td>
                        <td rowspan="2"><?php if($row_book['book_received'] != NULL){echo date('m/d/Y',strtotime($row_book['book_received']));} else echo "-";?></td>
                    </tr>
                    <tr>
                        <td height="40"><?php echo $row_book['quantity_used']; ?></td>
                        <td><?php echo 'Used';?></td>
                        <td><?php echo '$ '.$row_book['price_used'];?></td>
                        <td><?php echo '$ '.$row_book['amazon_used_low'];?></td>
                    </tr>

						
					<?php	}?>
                   
                   
                 <?php }?>
                </tbody>
              </table>
            </div>
          </div></td>
        <td><?php echo $row['from_email'];?></td>
        <td style="text-align:center"><?php if($row['phone']){echo $row['phone'];}else{echo '-';} ?></td>
        <td><?php echo $row_book_data['university'];?></td>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['total_books'];?></td>
        <td><?php echo '$'.number_format($row['total_order_price'],2);?></td>
        <td><?php if($row['email_opened_status'] == 1) echo "Yes"; else echo "No";?></td>
        <td><?php echo date('m/d/Y',strtotime($row['created_at']));?></td>
        <td><?php if($row['shipment_received'] != NULL){echo date('m/d/Y',strtotime($row['shipment_received']));} else echo "-";?></td>
      </tr>
      <?php 
		}
	  ?>
    </tbody>
  </table>
</div>
<?php include_once('footer.php');?>
