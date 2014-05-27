<?php 
session_start();
if(isset($_SESSION['admin_array']['username']) || isset($_SESSION['admin_array']['password']) )
{
	if(isset($_SESSION['recent_url']) && $_SESSION['recent_url'])
	{
		header('location:'.$_SESSION['recent_url']);
		
	}else
	{
		header('location:http://'.$_SERVER['HTTP_HOST'].'/buyback/admin/select_theme.php');
	}
}
if(isset($_POST['submit']))
{
	$error='';
  $username=$_POST['username'];
  $password=$_POST['password'];
 
	if(!isset($username) || !$username)
	{
		$error='Please enter username<br />';
		
	}
	if(!isset($password) || !$password)
	{
		$error .='Please enter password<br />';
	}
	if(empty($error))
	{
		if($username=='admin' && $password=='admin123')
		{
			$_SESSION['admin_array']['username']='admin';
			$_SESSION['admin_array']['password']='admin123';
		   header('location:http://'.$_SERVER['HTTP_HOST'].'/buyback/admin/select_theme.php');	
		}else
		{
		  $error .="The Username and Password is invalid";	
		}
	}
	 		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.content{
	border-radius:5px;
	border:1px solid #999;
	width:500px;
	margin:0 auto;
	background:#dcdcdc;
	height:auto;
}
.content h3{
	font-family:"Arial Black", Gadget, sans-serif;
	text-align:center;
	
	}
table{
	width:400px;
	border-collapse:collapse;
	height:100px;
	margin:0 auto;
	
}

table td{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	height:50px;
}

table td input[type=text]{
	width:150px;
	height:20px;
	border-radius:4px;
	
}

table td input[type=password]{
	width:150px;
	height:20px;
	border-radius:4px;
	
}

table td input[type=submit]{
	border-radius:4px;
	padding:5px 15px 5px 15px;
	
}
.error{
	color:#F00;
	text-align:center;
}

</style>
</head>

<body>
<div class="content">
<h3> Admin Panel</h3>
  
<form name="form1" method="post" action="">
<table>
<?php if(isset($error)){?>
	<tr>
        <td colspan="2"><p class="error"><?php echo $error;?></p></td>
    </tr>
    <?php }?>
    <tr>
        <td>Enter Username:</td>
        <td><input type="text" name="username" value="" /></td>
    </tr>
    <tr>
        <td>Enter Password:</td>
        <td><input type="password" name="password" value="" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><input type="submit" name="submit"  value="Login" /></td>
    </tr>

</table>
</form>
</div>
</body>
</html>
