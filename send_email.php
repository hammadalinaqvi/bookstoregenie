<?php
	$to 		= $_POST['email'];
	$class 		= $_POST['class'];
	$name  		= $_POST['name'];
	$university = $_POST['university'];
	$choices    = $_POST['choices'];
	$choices    = explode(" ", $choices);
	$isbn1		= $_POST['isbn1'];
	$isbn2		= $_POST['isbn2'];
	$isbn3		= $_POST['isbn3'];
	$isbn4		= $_POST['isbn4'];
	$isbn5		= $_POST['isbn5'];
	$isbn6		= $_POST['isbn6'];
	array_push($isbn, $isbn1, $isbn2, $isbn3, $isbn4, $isbn5, $isbn6);
	$title1		= $_POST['title1'];
	$title2		= $_POST['title2'];
	$title3		= $_POST['title3'];
	$title4		= $_POST['title4'];
	$title5		= $_POST['title5'];
	$title6		= $_POST['title6'];
	array_push($title, $title1, $title2, $title3, $title4, $title5, $title6);
	$author1	= $_POST['author1'];
	$author2	= $_POST['author2'];
	$author3	= $_POST['author3'];
	$author4	= $_POST['author4'];
	$author5	= $_POST['author5'];
	$author6	= $_POST['author6'];
	array_push($author, $author1, $author2, $author3, $author4, $author5, $author6);
	$bookText   = "";
	
	// start at 1 cause Farhans annoying
	for ($i = 1; $i < 7; $i++){
		if ($i == $choices[$i]){
			$bookText .= "\n\n\n";
			$bookText .= "TITLE: " . $title[$i - 1] . "\n\n";
			$bookText .= "AUTHOR: " . $author[$i - 1] . "\n\n";
			$bookText .= "ISBN: " . $isbn[$i - 1] . "\n\n";
		}
	}
	
	//define the subject of the email
	$subject = 'Test HTML email'; 
	//create a boundary string. It must be unique 
	//so we use the MD5 algorithm to generate a random hash
	$random_hash = md5(date('r', time())); 
	//define the headers we want passed. Note that they are separated with \r\n
	$headers = "From: fdaredia@gmail.com\r\nReply-To: fdaredia@gmail.com";
	//add boundary string and mime type specification
	$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 
	//define the body of the message.
	ob_start(); //Turn on output buffering
?>
--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

Professor <?php echo $name ?>,



My name is Farhan Daredia and I'm currently starting my junior year at The George Washington University.


Over the summer, I (with the help of a couple other students) created a website that allows students to look up their textbook requirements by class, and run them through a search engine that goes through over 30 different vendors to find the lowest ebook, rental, used, and new prices for the textbooks they need.  These vendors include Amazon, Chegg, Half.com, TextbooksRus, and many more.


Below I've included a detailed price comparison between our search engine (www.BookstoreGenie.com), and the <?php echo $university ?> bookstore for the required textbook for <?php echo $class ?>:

TITLE: Managerial Economics and Business Strategy
AUTHOR: Michael R. Baye
EDITION:7th
ISBN:9780073375960


The University Bookstore is currently charging the following prices:
NEW:$187.65
USED:$140.75
E-BOOK:$89.00
RENTAL:$84.45

However, our search engine provides the same book for the following prices: 
NEW:$137.23
USED: $119.61
E-BOOK:$70.50
RENTAL:$63.71
I hope you will spread the word to your students about the savings they can get from our website before they buy their books for the semester.



At George Washington, some professors have allowed me to come in to their classes and give a quick 2 minute overview of the site, whereas others have allowed me to drop by with promotional materials, and still others have just shot off a quick e-mail to their students telling them about Bookstore Genie.



Whatever help you can provide is appreciated.


Many Thanks.

Sincerely,

Farhan Daredia
George Washington University, Class of '12
B.A. Political Communications, Secondary Field of Study in Business Administration, with a Minor in Economics
fdaredia@gwmail.gwu.edu | 404.388.8855
<?
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

Hello World!!! 
This is simple text email message. 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<h2>Hello World!</h2>
<p>This is something with <b>HTML</b> formatting.</p> 

--PHP-alt-<?php echo $random_hash; ?>--
<?
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";

?>