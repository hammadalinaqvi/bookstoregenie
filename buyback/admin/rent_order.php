<?php 
include_once('header.php');
//include_once('../db_connect/config.php');
include_once('../includes/functions.php');

include_once ('.config.inc.php');
include_once('ps_pagination.php');

$conn = mysql_connect('localhost', 'jteplitz', 'jtt0511');
$status = mysql_select_db('jteplitz_bookstore', $conn);?>

<style>

div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #000099;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
	
a{ text-decoration:none;color:#0000FF;}
a:hover{ text-decoration:underline;color:#0000FF;}
a:visited{ text-decoration:none;color:#0000FF;}
a:active{ text-decoration:none;position: relative;top: 1px;}

h1{
	font-family: "Arial","Verdana","Lucida Sans Unicode";
	font-size: 16pt;
	line-height:150%;
	margin-top:20;
	margin-bottom:0 ;text-align:center;
}

h2{
	font-family: "Arial","Verdana","Lucida Sans Unicode";
	font-size: 12pt;
	font-weight: bold;
	text-decoration: underline;
	line-height: 150%;
	margin-top: 40;
	margin-bottom: 10;
}

h3{
	font-family: "Arial","Verdana","Lucida Sans Unicode";
	font-size: 11pt;
	line-height: 150%;
	margin-top: 20;
	margin-bottom: 0;
}

ul{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt;word-spacing: 0; line-height: 150%; margin-top: 0; margin-bottom: 0}
p{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt }
#datacontent{margin-left:20pt}
#footer{ font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 10pt; line-height:150%; margin-top:40; margin-bottom:0;text-align:center}
#xlsxTable{font-family: "Arial","Verdana","Lucida Sans Unicode";font-size: 11pt;margin: 15px;text-align: left;border-collapse: collapse; width:95%;}
#xlsxTable th{padding: 8px;font-weight: normal;font-size: 13px;color: #039;background: #b9c9fe;}
#xlsxTable td{padding: 8px;background: #e8edff;border-top: 1px solid #fff;color: #669;}
#xlsxTable tbody tr:hover td{background: #d0dafd;}
</style>

<?php 


//$sql="";
/*function yearMonthDifference($start_date, $end_date)  
{  
    // 31556926 seconds in year  
    $years = floor(($end_date - $start_date) / 31556926);   
    // takes remaning seconds to find months  2629743.83 seconds each month  
    $months = floor((($end_date - $start_date) % 31556926) / 2629743.83);   
      
    if($years > 0){  
        if($years > 1){$year_s = 's';} // adds "s" if more than one year  
        $years_display = $years.' year'.$year_s;  
    }  
    if($months > 0){  
        if($months > 1){$month_s = 's';} // adds "s" if more than one month  
        $months_display = $months.' month'.$month_s;  
    }  
      
    return trim($years_display.' '.$months_display);  
}  
$start_date = strtotime('January 4, 2008');  
$end_date = strtotime('March 5, 2010');  
yearMonthDifference($start_date,$end_date);  */

if($_REQUEST['email'])
{
	 

	 $email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
	 /*$sql_book ="select * from rentedBooks WHERE email ='".$email."' AND purchaseDate > DATE_SUB(NOW(), INTERVAL 4 YEAR_MONTH) ";*/
	 $sql_book ="SELECT * FROM rentedBooks WHERE email ='".$email."' AND purchaseDate > DATE_SUB(NOW(), INTERVAL 6 MONTH) ";
	 $result_book = mysql_query($sql_book, $conn) or die(mysql_error());
}

else
{
	$sql = "SELECT * FROM rentalUser ORDER BY id desc";
	$result = mysql_query($sql) or die(mysql_error());
	
	// PS Pagenation variables are <connection string>, <SQL query>, <number of records to show on one page>, <number of pages to show in the pagenation bar>
	$pager = new PS_Pagination($conn, $sql, 15, 10);  
	$rs = $pager->paginate();
}
?>
<div class="container">
<form action="" method="post">
<p>Search by email address</p>
<input type="text" name="email" value="">
<input type="submit" name="submit" value="Search" >

</form>
<?php if($result_book){?>
  <table class="table table-bordered" >
    <thead>
      <tr class="tbl-header">
        <th>E-mail Address</th>
         <th>ISBN</th>
        <th>Title</th>
        <th>Purchase Date</th>
        <th>OrderNumber</th>
       
      </tr>
    </thead>
    <tbody>
    <?php 
		
		while($row = mysql_fetch_array($result_book)){
			
	?>
        <tr >
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['isbn']?></td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['purchaseDate'];?></td>
            <td><a href="rent_order_detail.php?order_number=<?php echo $row['orderNumber'];?>" > <?php echo $row['orderNumber'];?></a></td>
        </tr>
      <?php 
		}
	  ?>
    </tbody>
  </table>
  <?php }else if($result){
  ?>
   <table class="table table-bordered" >
    <thead>
      <tr class="tbl-header">
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
      
       
      </tr>
    </thead>
    <tbody>
    <?php 
		
		while($row = mysql_fetch_array($rs)){
	?>
      <tr >
        <td><?php echo $row['firstName'].$row['lastName'];?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['phone'];?></td>
        <td><?php echo $row['address'];?></td>
        <td><?php echo $row['city'];?></td>
        <td><?php echo $row['state'];?></td>
      </tr>
      <?php 
		}
	  ?>
    </tbody>
  </table>
  
  <?php echo $pager->renderFullNav(); ?>

  <?php }?>
</div>
<?php include_once('footer.php');?>
