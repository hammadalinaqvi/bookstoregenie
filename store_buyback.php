<?php
	
	//dbConnect();
	
	$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
	
	
	$table      = "jteplitz_bookstore.buyback_books";
	
	//$echo "fuck";
	
	$books = json_decode(stripslashes($_REQUEST['books']));
	$name  = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	
	$query  = "SELECT Max(id) as id FROM jteplitz_bookstore.buyback_books";
	
	//echo $query;
	
	//$result = $mysqli->query($query)
	//$result = mysql_query($query);
	//$row    = mysql_fetch_assoc($result);
	//$id	= $row['id'] + 1;

	$id = 0;

	if ($result = $mysqli->query($query)) {
        		while($obj = $result->fetch_object()){
           		 $id =$obj->id;
        		}
    		}
        
        $id++;
        
	for ($i = 0; $i < count($books); $i++){
		$book = $books[$i];
		
		$merchant = str_replace(","," ",$book->merchant);
		$title = str_replace(","," ",$book->name);
		$title = str_replace("'"," ",$title);
		
		$query = "INSERT INTO $table (isbn, merchantName, sellPrice, buyPrice, title, rep_id, times, conditions, email, id) VALUES ({$book->isbn}, '$merchant', $book->sellPrice, $book->price, '$title', '$name', NOW(), '$book->condition', '$email', $id)";
		
		//$query = str_replace("'","",$query);
		
		$id++;
		
		//echo "<script>alert('some_message');</script>";
		
		//sleep(15);
		
		//$fuck = "insert into jteplitz_bookstore.queries (query) values ('$query')";
		
		$mysqli->query($query);
		//echo $query;
		//header( "location: http://www.playboy.com");
		//echo $mysqli->error;
	}
	
	
	$mysqli->close();
	
	
	/*function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}*/
?>