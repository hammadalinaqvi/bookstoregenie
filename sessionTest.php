<?php
	//$lifetime=10;
 	session_start();
 	//session_destroy();
	//setcookie(session_name(),session_id(),time()+$lifetime);
	//session_destroy();
	echo "shit<br>";
print_r($_SESSION);
//session_destroy();
	if(isset($_SESSION['fuck']))
	{
		$temp = "myasshole";
	}
	else
	{
		$temp = "yourasshole";
	}

	

	$_SESSION['fuck'] = $temp;
	
	echo $_SESSION['fuck'];
	
	echo "<a href='https://bookstoregenie.com/testpass.php'>click me</a>";
	
	
	echo "<br><br><br>";
	
	require_once "Book.php";
	
	$listISBN = $_SESSION['listISBN'];
		$shit = count($listISBN);
		foreach($listISBN as $key => $value)
		{
			
				$book = $listISBN[$key];
			
		
		$book = unserialize($book);
		$book = (object)$book;
		
		echo $book->getTitle();
		echo "<br>";
		echo $book->getRentQuantity();
		echo "<br>";
		
		
		
	}
	//header("location:testpass.php");
?>
