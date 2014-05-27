<?php
	// use the Urban Airship PHP library
	require_once "ua/urbanairship.php";
	require_once("Mail.php");
	require_once("Mail/mime.php");
	
	// set up globals
	$APP_MASTER_SECRET = "8z3zUFGCTgSQmHPob-67lQ";
	$APP_KEY = "PTqsW3bZTcqj43o9Cx2zXA";
	$reps    = array();
	
	$type = $_REQUEST['type'];
	
	if ($type == "create" || $type == "createMobile"){
		
		// get data
		$address = $_REQUEST['address'];
		$city    = $_REQUEST['city'];
		$state   = $_REQUEST['state'];
		$zip	 = $_REQUEST['zip'];
		$customer = $_REQUEST['name'];
		if ($type == "create")
			$time = $_REQUEST['date'];
		else
			$time = $_REQUEST['date'] . " " . $_REQUEST['time'];
		
		dbConnect();
		$repId = makeDistanceRequest();
		$rep   = getRep($repId);
		$appointmentId = createAppointment($repId);
		if ($rep['device'] != 2){
			$message = buildMessage($appointmentId);
			sendPush($message);
		}else{ // rep is using web interface so send them an email
			$email = $rep['email'];
			$encodedData = json_encode(array(urlencode($address), urlencode($city), urlencode($state), urlencode($zip), urlencode($time), urlencode($appointmentId), urlencode(strtotime($time)), urlencode($_REQUEST['contactPhone']), urlencode($customer)));
			echo $encodedData;
			$html = <<< EOT
<h1>{$rep['firstName']},</h1>
	An appointment has been created for you at {$time} at {$address}, {$city}, {$state} {$zip} <br />
	<a href = 'http://www.bookstoregenie.com/buyback.php?type=accept&appointment_id={$appointmentId}&data={$encodedData}&name={$repId}#appointment.html'>Click Here to Accept</a> <br />
	<a href = "#">Click Here to decline</a>
EOT;
		$text = <<< EOT
{$rep['firstName']}, \r\n
An appointment has been created for you at {$time} at {$address}, {$city}, {$state} {$zip} \r\n
To accept copy http://www.bookstoregenie.com/buyback.php?type=accept&appointment_id={$appointmentId}$data={$encodedData}&name={$repId} into your address bar. \r\n
Decline instructions to come...
EOT;
		$subject = "New Appointment";
		$hdrs = array(
					  'From'    => "appointments@bookstoregenie.com",
					  'Subject' => $subject,
					  );
		$crlf = "\n";
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		
		$body = $mime->get();
		$hdrs = $mime->headers($hdrs);

		$mail =& Mail::factory('mail');
		$mail->send($email, $hdrs, $body);
		}
	}else if ($type == "accept"){
		$id = $_REQUEST['id'];
		dbConnect();
		sendEmail($id);
		sendFuturePush();
	}
	
	function sendFuturePush(){
		global $row, $customer, $address, $time, $APP_KEY, $APP_MASTER_SECRET;
		$rep = getRep($row['rep_id']);
		if ($rep['device'] != 2){
			$futureMessage = "Your appointment with {$customer} at {$address} begins in 10 minutes";
			$schedule = data("c", strtotom($time) - 600);
			$message = array("aps"=>array("New Appointment"=>$message), "android"=>array("alert" => $message), "schedule_for" => array($schedule));
			// set up the Airship object
			$airship = new Airship($APP_KEY, $APP_MASTER_SECRET);
			
			// get the device token for the Rep id
			$deviceToken = $rep['token'];
			
			// send the message
			$airship->push($message, null, array($deviceToken), null, null); // the second param is for iPhone device tokens and the third is for android apids
		}		
	}
	
	function sendEmail($id){
		global $row, $customer, $address, $time;

		$query  = "SELECT * FROM pendingAppointments WHERE `id` = {$id}";
		$result = mysql_query($query);
		$row =  mysql_fetch_assoc($result);
		
		$customer	    = $row['customer'];
		$address  		= $row['address'];
		$time		    = $row['time'];
		$representative = $row['rep'];
		$email			= $row['email'];
		
		
		$subject = "Appointment Confirmation";
		$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\"";
		$date = date('F jS, Y');
		$text = <<< EOT
Hello {$customer}!

Thank You for signing up for an appointment.

I will meet you at {$address} at {$time} to pick up your books.

See you soon!

{$representative}
EOT;
		$hdrs = array(
					  'From'    => "appointments@bookstoregenie.com",
					  'Subject' => $subject,
					  );
		$crlf = "\n";
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		
		$body = $mime->get();
		$hdrs = $mime->headers($hdrs);

		$mail =& Mail::factory('mail');
		$mail->send($email, $hdrs, $body);
	}
	
	function createAppointment($repId){
		global $address, $city, $state, $zip, $customer, $time;
		$query  = "SELECT * FROM reps WHERE `id` = {$repId}";
		$result = mysql_query($query);
		$row    = mysql_fetch_assoc($result);
		$name   = $row['firstName'];
		$email	  = $_REQUEST['email'];
		
		$fullAddress = $address . ", " . $city . ", " . $state . " " . $zip;
		$query = "INSERT INTO pendingAppointments (`address`, `rep`, `customer`, `email`, `time`, `rep_id`) VALUES ('{$fullAddress}', '{$name}', '{$customer}', '{$email}', '{$time}', '{$repId}')";
		mysql_query($query);
		$query  = "SELECT * FROM pendingAppointments WHERE `address` = '{$fullAddress}' ORDER BY `id` DESC";
		$result = mysql_query($query);
		$row    = mysql_fetch_assoc($result);
		return $row['id'];
	}
	
	function makeDistanceRequest(){
		global $address, $city, $state, $zip, $reps;
		$origin 	 = createOrigin();
		$destination = urlencode($address . ", " . $city . ", " . $state . " " . $zip);
		$url 		 = "http://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destination}&mode=driving&language=en-us&sensor=false";
		$handle = fopen($url, "r");
		$data   = json_decode(stream_get_contents($handle));
		
		$smallestDistance = PHP_INT_MAX;
		$smallestIndex;
		for ($i = 0; $i < count($data->rows); $i++){
			if ($data->rows[$i]->elements[0]->duration->value < $smallestDistance){
				$smallestDistance = $data->rows[$i]->elements[0]->duration->value;
				$smallestIndex	  = $i;
			}
		}
		if ($smallestDistance <= 9000)
			return $reps[$smallestIndex]["id"];
		else
			return -1;
	}
	
	function createOrigin(){
		global $reps;
		$origin = "";
		$query  = "SELECT * FROM reps ORDER BY `id` ASC";
		$result = mysql_query($query);
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			if ($row['address'] != "" && $row['token'] != ""){
				$reps[] = $row;
				$origin .= $row['address'] . ", " . $row['city'] . ", " . $row['state'] . " " . $row['zip'] . "|";
			}
		}
		$origin = substr($origin, 0, -1);
		return str_replace("%7C", "|", urlencode($origin));
	}
	
	function sendPush($message){
		global $APP_KEY, $APP_MASTER_SECRET, $rep;
		// set up the Airship object
		$airship = new Airship($APP_KEY, $APP_MASTER_SECRET);
		
		// get the device token for the Rep id
		$deviceToken = $rep['token'];
		
		// send the message
		$airship->push($message, null, array($deviceToken), null, null); // the second param is for iPhone device tokens and the third is for android apids
	}
	
	function buildMessage($appointmentId){
		global $address, $city, $state, $zip, $customer, $time;
		$phone = $_REQUEST['contactPhone'];
		$timestamp = strtotime($time);
		$message  = "An appointment has been created for you at {$time} at {$address}, {$city}, {$state} {$zip}";
		$payload = array($address, $city, $state, $zip, $time, $appointmentId, $timestamp, $phone, $customer);
		
		$message = array("aps"=>array("New Appointment"=>$message), "android"=>array("alert" => $message, "extra" => json_encode($payload)));
		return $message;
	}
	
	function getRep($id){
		$query  = "SELECT * FROM reps WHERE `id` = {$id}";
		$result = mysql_query($query);
		return mysql_fetch_assoc($result);
	}
	
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
?>