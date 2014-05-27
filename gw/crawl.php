<?php
	//echo ('got');
	$courseData = file_get_contents("departments.txt");
	$courseData = nl2br($courseData);
	$courseData = str_replace(',;', ';', $courseData); 
	$departments = explode("<br />", $courseData);
	// each deparment is a new line starting with a department
	for ($j = 0; $j < count($departments); $j++){
		if ($j % 10 == 0)
			sleep(10);
		$usefulData = explode(";", $departments[$j]);
		/*if ($usefulData[0] == "*AH"){ 		// statment to pause script for an ip adress change
			//echo "pause";
			fwrite(STDOUT, " Script is paused press anything to continue ");
			$input = trim(fgets(STDIN));
		}*/
		//echo count($usefulData);
		for ($i = 0; $i < (count($usefulData) - 1) / 2; $i++){
			$second = 2 * $i + 1;
			$third  = 2 * $i + 2;
			$department = trim($usefulData[0]);
			$sections = explode("," , $usefulData[$third]);
			for ($b = 0; $b < count($sections); $b++){
			//echo "usefull " . $department .  " " . $usefulData[$second] . " " . $usefulData[$third];
			$url = "http://www.bkstr.com/webapp/wcs/stores/servlet/CourseMaterialsResultsView?catalogId=10001&categoryId=9604&storeId=13529&langId=-1&programId=1365&termId=100014236&divisionDisplayName=%20&departmentDisplayName=$department&courseDisplayName=$usefulData[$second]&sectionDisplayName=$sections[$b]&demoKey=d&purpose=browse";
			//$url = 'http://www.bkstr.com/webapp/wcs/stores/servlet/CourseMaterialsResultsView?catalogId=10001&categoryId=9604&storeId=10093&langId=-1&programId=665&termId=100014206&divisionDisplayName=%20&departmentDisplayName=$department&courseDisplayName=$usefullData[$second]&sectionDisplayName=$sections[$b]&demoKey=d&purpose=browse';
			//echo "URL " . $url;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			$html = curl_exec($ch);
			//echo "html" . $html . "error " . curl_errno($ch) . curl_error($ch);
			if (curl_errno($ch) != 0){
				die (curl_error($ch));
			}
			// reset titleStuff
			$titleStuff = ",,";
				 ////////////////// modify this information ///////////////////////
							$host = "localhost";
							$user = "jteplitz";
							$pass= "jtt0511";
							$table = "gw_books";
							$database = "jteplitz_bookstore";
			///////////////////////////////////////////////////////////////////////
			 $data = explode("<em>Booklist for:</em>",$html);
			//echo $data[1];
			$data1 = explode ("</h1>", $data[1]);
			$course = $data1[0];
			$book1 = explode('<img src="http://images.efollett.com/books/',$html);
			//echo $book1[0] . $book1[2] . $book1[3];
			//echo (count($book1));
			$write = "";
			for ($a = 0; $a < count($book1); $a++){
				$book2 = explode(".gif",$book1[$a]);
				if (count ($book2) == 1){
					echo "jpg";
					// they didn't use a .gif so try .jpg
					$book2 = explode(".jpg", $book1[$a]);
					//echo $book2[0];
				}
				// create the numbers for each cours
				//echo count($book2);
				//echo $book2[h];
				$book = $book2[0];
				$book3 = explode("/", $book);
				$isbn = sizeof ($book3) - 1;
				if ($book3[$isbn] == "noBookImage"){
					//echo ("no");
					// no book image was found.
					$noData="false";
					$titleStuff = findTitle($book2[1], $a, $titleStuff);
				}else if ($book3[$isbn] == ""){
					$noData = "true";
				}else{
					$noData = "false";
					// we found an isbn
					//echo ("storing". $book3[$isbn]. "<br />");
					//place the course id and the isbn in the databas			 
					//stores the courseinformation in varialbles for the server
					//echo $i;
					if ($book3[$isbn] != 122){
						$write = $write . " " . trim($book3[$isbn]);					
					}
					  // Connects to the database server		
				}// else
			}// for
				  $dbcnx = @mysql_connect($host, $user, $pass);
					  if (!$dbcnx) {
						echo( "<P>Unable to connect to the database server at this time.</P>" );
						echo(mysql_error());
						exit();
					  }
					 
					  // Selects the database
					  if (! @mysql_select_db($database) ) {
						echo( "<P>Unable to find database");
						exit();
					  }
					  // find $one
					 $department = str_replace("'", '', $department); 
					 $query = "SELECT COUNT(*) FROM {$table}";
					 $result   = mysql_query($query);
					 $row = mysql_fetch_array( $result, MYSQL_ASSOC );
					 $one = $department . $usefulData[$second] . $sections[$b];
					 
					 // break the writeStuff apart so we can send it
					 $brokenWrite = explode(",", $titleStuff);
					 $title   = $brokenWrite[0];
					 $author  = $brokenWrite[1];
					 $edition = $brokenWrite[2];
					// test and see if the course has been updated
					$query = "SELECT * FROM {$table} WHERE name = '{$one}'";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					
					//if so
					if ($row['isbn']  != $write ||
						$row['Title'] != $title){
						//delete the old course
						//$query = "DELETE FROM {$table} WHERE name = '{$one}'";
						//mysql_query($query) or die("Entry not deleted." . mysql_error() . $query);
						// replace any ' in the department name
						//put in the new one
						$query="INSERT into {$table} (Name ,isbn, Title, Author, Edition, department, course, section, term, noData) VALUES ('{$one}', '{$write}', '{$title}', '{$author}', '{$edition}', '{$department}', '{$usefulData[$second]}', '{$sections[$b]}', 'Spring', '{$noData}')";   
						 
						//executes the command
						mysql_query($query) or die("Data not written." . mysql_error() . " " . $query);
						
						// later we can do the e-mail stuff
						
						//$result = mysql_query($query);
					}else{
						//do nothing because the course wasn't updated
					}
			}
			echo $departments[$j];
		}
		sleep(2);
	}
function findTitle($titleStuff, $a, $writeStuff){
	// now prepare title edition and author
	$brokenWrite = explode(",", $writeStuff);
	$title   = $brokenWrite[0];
	$author  = $brokenWrite[1];
	$edition = $brokenWrite[2];
	
	$thisTitleBegin = explode('<span class="wrap">', $titleStuff);
	$thisTitle      = explode("</span>", $thisTitleBegin[1]);
	// store the title in the variable for later
	if ($title == ""){
		$title = trim($thisTitle[0]) . ";";
	}else{
		$title = $title . trim($thisTitle[0]) . ";";
	}
	
	// now that we have the title get the author and edition
	$detailsBegin    = explode('<div class="detail" style="padding-bottom:4px;">', $titleStuff);
	$details	     = explode('</div>' , $detailsBegin[1]);
	$thisAuthorBegin = explode('Author:', $details[0]);
	$everything	     = explode('Edition:', $thisAuthorBegin[1]);
	
	// so now everything[0] is the author and everything[1] is the edition
	if ($author == ""){
		$author = trim($everything[0]) . ";";
	}else{
		$author = $author . trim($everything[0]) . ";";
	}
	//echo $thisAuthorBegin[1];
	
	// get rid of the spaces after the edition
	$thisEdition = explode(" ", $everything[1]);
	if ($edition == ""){
		$edition = trim($thisEdition[0]) . ";";
	}else{
		$edition = trim($edition . $thisEdition[0]) . ";";
	}
	
	// now patch writeStuff back togather with the new data
	$returnData = $title . "," . $author . "," . $edition;
	return $returnData;
}
?>