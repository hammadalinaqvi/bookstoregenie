<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/buyback/admin/header.php');
session_start();
if(!isset($_SESSION['admin_array']['username']) || !isset($_SESSION['admin_array']['password']) )
{
	header('location:http://'.$_SERVER['HTTP_HOST'].'/admin.php');
}
$dir = $_SERVER['DOCUMENT_ROOT']."/sell/excel_file/";
$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511','jteplitz_bookstore');
//$mysqli = new mysqli('localhost', 'root', '','test');
if(isset($_POST['submit']))
{
	$error='';
	$file_name=$_POST['files'];
	if(!isset($file_name) || !$file_name)
	{
		$error ='Please select the files';
	}
	if(empty($error))
	{
		$csv = array();
		$count=0;
		for($i=0; $i< count($file_name); $i++)
		{
			
			$num=count(file("excel_file/".$file_name[$i]));
			
				if (($handle = fopen($_SERVER['DOCUMENT_ROOT']."/sell/excel_file/".$file_name[$i]."", "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						// $num = count($data);
				$import="INSERT INTO `buyback_prices` (`id`, `isbn`, `time_stamp`, `merchant_id`, `price`, `ship_price`, `condition`) VALUES ('".$data[0]."', '".$data[1]."','".date('Y-m-d h:m:s',strtotime($data[2]))."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."');";
				$mysqli->query($import);
				$count++;
				
			}
				fclose($handle);
				}
				if($count==$num)
				{
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/sell/excel_file/'.$file_name[$i]))
					{
						@unlink($_SERVER['DOCUMENT_ROOT'].'/sell/excel_file/'.$file_name[$i]);
						$count=0;
						
					}
				}		
				
			}
			
		  
		}
		
		

}
?>
<div class="container">
<style>
a{text-decoration:none;color:#0000FF;}
a:hover{text-decoration:underline;color:#0000FF;}
a:visited{text-decoration:none;color:#0000FF;}
a:active{text-decoration:none;position: relative;top: 1px;}
h1{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 16pt; line-height:150%; margin-top:20; margin-bottom:0 ;text-align:center;}
h2{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 12pt; font-weight: bold; text-decoration: underline; line-height:150%; margin-top:40; margin-bottom:10 }
h3{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt; line-height:150%; margin-top:20; margin-bottom:0}
ul{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt;word-spacing: 0; line-height: 150%; margin-top: 0; margin-bottom: 0}
ul li{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt;word-spacing: 0; line-height: 150%; margin-top: 0; margin-bottom: 0; list-style:none;}
p{font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 11pt }
#datacontent{margin-left:20pt}
#footer{ font-family: "Arial","Verdana","Lucida Sans Unicode"; font-size: 10pt; line-height:150%; margin-top:40; margin-bottom:0;text-align:center}
</style>

<h1>Sales Rank </h1><form method="post"  action="">
<div id="datacontent">
<!--<h2>Upload *.xlsx File:</h1>-->

<!--<input type="submit" name="select_file" value=" Select Excel Files" />
-->
</div>
	<?php if(isset($error)){  echo '<p>'.$error.'</p>';}?>
<?php 
	if ($handle = opendir($dir)) {?>
 <div id="datacontent">
<h2>List of Excel Files</h2>
<ul>   
 <?php    
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {?>
	<li> <input type="checkbox" name="files[]" value="<?php echo $entry?>" /><?php echo $entry;?></li>
 		



<?php  }
    } ?>
    </ul>
<input type="submit" name="submit" value="Submit"  />
</div>
	
 <?php    closedir($handle);
}	


?>    		
    

  


</form>
</div>
<?php $mysqli->close();
include_once($_SERVER['DOCUMENT_ROOT'].'/buyback/admin/footer.php');
?>