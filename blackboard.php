<?php
 define('POSTURL', 'http://blackboard.hopkins.edu/webapps/blackboard/execute/sendEmail');
 define('POSTVARS', 'navItem=email_all_students&course_id=_95_1&messagetext=test');  // POST VARIABLES TO BE SENT
 // INITIALIZE ALL VARS
 $ch='';
 $Rec_Data='';
 $Temp_Output='';
 
 //if($_SERVER['REQUEST_METHOD']==='POST') {  // REQUIRE POST OR DIE
 //if(isset($_POST['EmailAddress'])) $Email=$_POST['EmailAddress'];  // GET EMAIL INTO VAR 
 
 $ch = curl_init(POSTURL);
 curl_setopt($ch, CURLOPT_POST      ,1);
 curl_setopt($ch, CURLOPT_POSTFIELDS    ,POSTVARS);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
 curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS 
 curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
 $Rec_Data = curl_exec($ch);
 echo $Rec_Data;
 /*
 ob_start();
 header("Content-Type: text/html");
 $Temp_Output = ltrim(rtrim(trim(strip_tags(trim(preg_replace ( "/\s\s+/" , " " , html_entity_decode($Rec_Data)))),"\n\t\r\h\v\0 ")), "%20");
 $Temp_Output = ereg_replace (' +', ' ', trim($Temp_Output));
 $Temp_Output = ereg_replace("[\r\t\n]","",$Temp_Output);
 $Temp_Output = substr($Temp_Output,307,200);
 echo $Temp_Output;
 $Final_Out=ob_get_clean();
 echo $Final_Out;  */
 curl_close($ch);

exit;
?>