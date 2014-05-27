<?php
include_once('header.php');
session_start(); 
$_SESSION['recent_url']="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(!isset($_SESSION['admin_array']['username']) || !isset($_SESSION['admin_array']['password']) )
{
	header('location:http://'.$_SERVER['HTTP_HOST'].'/admin.php');
}
$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
if(isset($_POST['submit']))
{
  $option_name=isset($_POST['options'])?$_POST['options']:'';
  if(!$option_name)
  {
	  $error ="Please select option";
  }else{
   	  
	
	  $result=$mysqli->query('SELECT * from jteplitz_bookstore.bookstore_settings where theme_name="'.$option_name.'"');
	 
	  if( $result->num_rows >0)
	  {
		 
		  
		  	$mysqli->query('UPDATE jteplitz_bookstore.bookstore_settings set status=1 WHERE theme_name="'.$option_name.'"');
			$mysqli->query('UPDATE jteplitz_bookstore.bookstore_settings set status=0 WHERE theme_name !="'.$option_name.'"');  
			$msg= " Theme has been updated successfully";
		  
	  }else
	  {
			 $query = "insert into jteplitz_bookstore.bookstore_settings (theme_name,status) values ('$option_name','1')";
			 $mysqli->query('UPDATE jteplitz_bookstore.bookstore_settings set status=0 WHERE theme_name !="'.$option_name.'"');
			 $msg= " Theme has been updated successfully";
			$mysqli->query($query); 
		}
	  
  }
  
  
  //$_SESSION['theme_name']=$option_name;
 
		
}
if(isset($_POST['logout']))
{
	unset($_SESSION['recent_url']);
	unset($_SESSION['admin_array']);
	header('location:http://'.$_SERVER['HTTP_HOST'].'/admin.php');
}
?>
 <div class="container">
<style type="text/css">
table{
	width: 300px;
	border-collapse: collapse;
	height: 150px;
}

td, tr {
    font-size: 16px !important;
    font-weight: bold;
}

.custom
{
	 font-family: Arial, Helvetica, sans-serif;
	 font-size: 16px;
	 font-weight: bold;
	 text-decoration: none;
	 padding: 5px;
	 color: #04ADE0;
}
.success{
	color:#51a351;
}
</style>
<form name="form1" method="post" action="">

<a href="xslx/index.php" target="_blank" class="custom">BuyBack Report</a> 
<a href="buybackadmin.php" target="_blank" class="custom">BuyBack Admin</a>
<a href="rent_order.php" target="_blank" class="custom">Rental User</a>
<a href="rent_book_order.php" target="_blank" class="custom">Rental Order</a>
<a href="user_payment.php" target="_blank" class="custom">User Payment</a>
<input type="submit" name="logout" value="Logout" class="btn btn-success" style="margin-left:140px;" />

<h3> Select Theme</h3>

<?php $result_query = $mysqli->query('SELECT theme_name FROM jteplitz_bookstore.bookstore_settings WHERE status="1"');
$row = $result_query->fetch_assoc()
?>
<?php if($msg){ echo '<p class="success">'.$msg.'</p>';}?>
    <table>
        <tr>
            <td><input type="radio" name="options" <?php if($row['theme_name']=='sell'){?>  checked="checked" <?php } ?>value="sell" /> Sell Theme <br /></td>
            <td><input type="radio" name="options"  <?php if($row['theme_name']=='rent'){?>  checked="checked" <?php } ?> value="rent" /> Rent Theme</td>
        </tr>
        
        <tr>
            <td colspan="2" ><input type="submit" class="btn btn-success" name="submit"  value="Save" /></td>
        </tr>
    </table>
</form>
<?php $mysqli->close();?>

</div>
<?php include_once('footer.php');?>