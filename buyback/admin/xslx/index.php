<?php 
session_start();
 
$_SESSION['recent_url'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(!isset($_SESSION['admin_array']['username']) || !isset($_SESSION['admin_array']['password']) )
{
	header('location:http://'.$_SERVER['HTTP_HOST'].'/admin.php');
}	

$error = '';

include_once('../ps_pagination.php');

//$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511','jteplitz_bookstore');
$conn = mysql_connect('localhost', 'jteplitz', 'jtt0511');
$status = mysql_select_db('jteplitz_bookstore', $conn);
$search_query='';
$cond='';
$sql='Select * from buyback_prices'.$cond.' order by time_stamp desc';
if($_REQUEST['txt_search'])
{
	$search_query=isset($_REQUEST['txt_search'])?$_REQUEST['txt_search']:'';
	if($search_query)
	{
		$test_arr  = explode('/', $search_query);
		if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
					 $cond =" Where time_stamp like '".date('Y-m-d',strtotime($search_query))."%'";

		}else
		{
			 $error ='<br />Please enter date';
		}
		
	}
}
	
	$pager = new PS_Pagination($conn, $sql, 20, 15);
	$rs = $pager->paginate();

if(isset($_POST['logout']))
{
	unset($_SESSION['admin_array']);
	unset($_SESSION['recent_url']);
	header('location:http://'.$_SERVER['HTTP_HOST'].'/admin.php');
}
?>
<html>
<head><title>Buy Back </title>
<link rel="stylesheet" href="css/jquery.datepick.css" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script type="text/javascript">
$(function() {
	$('#popupDatepicker').datepick();
});

</script>

<style>
<!---
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
	
a{text-decoration:none;color:#0000FF;}
a:hover{text-decoration:underline;color:#0000FF;}
a:visited{text-decoration:none;color:#0000FF;}
a:active{text-decoration:none;position: relative;top: 1px;}
h1{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 16pt; line-height:150%; margin-top:20; margin-bottom:0 ;text-align:center;}
h2{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 12pt; font-weight: bold; text-decoration: underline; line-height:150%; margin-top:40; margin-bottom:10 }
h3{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt; line-height:150%; margin-top:20; margin-bottom:0}
ul{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt;word-spacing: 0; line-height: 150%; margin-top: 0; margin-bottom: 0}
p{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt }
#datacontent{margin-left:20pt}
#footer{ font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 10pt; line-height:150%; margin-top:40; margin-bottom:0;text-align:center}
#xlsxTable{font-family: "Arial","Verdana","Lucida Sans Unicode";font-size: 11pt;margin: 15px;text-align: left;border-collapse: collapse; width:95%;}
#xlsxTable th{padding: 8px;font-weight: normal;font-size: 13px;color: #039;background: #b9c9fe;}
#xlsxTable td{padding: 8px;background: #e8edff;border-top: 1px solid #fff;color: #669;}
#xlsxTable tbody tr:hover td{background: #d0dafd;}
//--->
</style>

</head>
<body>
<h1>BuyBack Report</h1><form method="post" action="" >
<div id="datacontent">
<input type="submit" name="logout" value="Logout"  />
<h2>Import Csv File</h2>

<a href="import_file.php">Select Csv file to import</a>
<?php if(isset($error) && $error){ echo '<p style="color:red;">'.$error.'</p>';}?>

<p>Search by date </p>
 <input type="text" id="popupDatepicker" name="txt_search" value="<?php echo $search_query;?>">
<input type="submit" name="search" value="search">
</div></form>
<table id="xlsxTable">
	<tr>
    <th>id</th>
    <th>ISBN</th>
    <th>Time Stamp</th>
    <th>Merchant Id</th>
    <th>Price</th>
    <th>Ship Price</th>
    <th>Condition</th>
    </tr>
    
	<?php while($row = mysql_fetch_assoc($rs)) { ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['isbn'];?></td>
            <td><?php echo $row['time_stamp'];?></td>
            <td><?php echo $row['merchant_id'];?></td>
            <td><?php echo $row['price'];?></td>
            <td><?php echo $row['ship_price'];?></td>
            <td><?php echo $row['condition'];?></td>
        </tr>
	<?php } ?>

</table>

<?php echo $pager->renderFullNav(); ?>

</body>
</html>
<?php 
$mysqli->close();
?>