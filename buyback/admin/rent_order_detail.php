<?php 
include_once('header.php');
include_once('../db_connect/config.php');
include_once('../includes/functions.php');

$order = isset($_GET['order_number'])?$_GET['order_number']:''; 
$sql_book ="SELECT * FROM rentedBooks WHERE orderNumber ='".$order."'";
$result_book = mysql_query($sql_book) or die(mysql_error());

?>

<div class="container">

<?php if($result_book){ ?>

    <table class="table table-bordered" >
        <thead>
            <tr class="tbl-header">
                <th>OrderNumber</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>email</th>
                <th>Name</th>
                <th>Shipping address</th>
                <th>Shipping City</th>
                <th>Shipping Zip</th>
                <th>Shipping  State</th>
            </tr>
        </thead>
    
    	<tbody>
    
		<?php
        while($row = mysql_fetch_array($result_book))
        {
                $sql_book1 ="select * from rentalUser WHERE email ='".$row['email']."'";
                $result_book1 = mysql_query($sql_book1);
                $row_user = mysql_fetch_assoc($result_book1);
        ?>
            <tr >
                <td><?php echo $row['orderNumber'];?></td>
                <td><?php echo $row['isbn']?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row_user['email'];?></td>
                <td><?php echo $row_user['firstName'].$row_user['lastName'];?></td>
                <td><?php echo $row_user['shippingAddress'];?></td>
                <td><?php echo $row_user['shippingCity'];?></td>
                <td><?php echo $row_user['shippingState'];?></td>
                <td><?php echo $row_user['shippingZip'];?></td>
            </tr>
    <?php } ?>

    	</tbody>
    </table>
  <?php }?>

</div>

<?php include_once('footer.php');?>