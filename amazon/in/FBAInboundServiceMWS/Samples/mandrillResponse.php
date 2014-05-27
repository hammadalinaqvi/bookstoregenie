<?php
require_once('db_connect.php');

// Auth key to mandrill
$apikey = array('key' => 'ae5ebf09-6eb9-480d-b79a-b17fca598150');

// Mandrill API url
$jsonUrl = 'https://mandrillapp.com/api/1.0/messages/search.json';

$request_json = '{"key": "ae5ebf09-6eb9-480d-b79a-b17fca598150", "query": "Unique Identifier:", "limit": "1"}';

echo 'Json Reuqest" '. $request_json.'<br /><br />';

// Curl initialization
$ch = curl_init($jsonUrl);

// Curl options<br>
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apikey));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request_json));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, false);

// Getting result
$response = curl_exec($ch);
//$jsonArray = json_decode($response,true); 

$my_response = json_decode($response);
//echo '<pre>'; print_r($my_response);
echo '<pre>';
foreach($my_response as $i => $res){
	//print_r($res);
	$o_id = explode (':', $res->subject);
	$id = $o_id[1];
	echo 'ID:'.$id.'<br />';
	$open = $res->opens;
	echo 'Open: '.$open.'<br />';
	if ($open != 0){
	mysql_query("UPDATE book_order SET email_opened_status =1 WHERE id =".$id."");
	echo '<br /><br />';	
	}
}
// Close curl<br>
curl_close($ch);


?>