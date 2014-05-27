<html>
<body>
<?php

include_once ('.config.inc.php');
include_once ('db_connect.php');

$query = mysql_query('SELECT * FROM book_shipment WHERE transaction_status = "in_progress" && status="price" || status="quantity"');

	while ( $result = mysql_fetch_array($query) )
	{
		
		$config = array (
		  'ServiceURL' => MWS_ENDPOINT_URL,
		  'ProxyHost' => null,
		  'ProxyPort' => -1,
		  'MaxErrorRetry' => 3
		);
		
		 $service = new FBAInboundServiceMWS_Client(
			 ACCESS_KEY_ID, 
			 SECRET_ACCESS_KEY, 
			 $config,
			 APPLICATION_NAME,
			 APPLICATION_VERSION);

		$order_id = $result['book_order_id'];
		$item_SKU = $result['SKU'];
		$book_ISBN = $result['ISBN'];
		$book_quantity = $result['quantity_used'];
		$from_name = $result['from_name'];
		$from_add1 = $result['from_addressLine1'];
		$from_add2 = $result['from_addressLine2'];
		$from_city = $result['from_city'];
		$from_state = $result['from_state'];
		$from_counrty = $result['from_country'];
		$from_postCode = $result['from_postalCode'];
		$from_email = $result['email'];
		
		echo 'SKU: '.$item_SKU.'<br />';
		echo 'ISBN: '.$book_ISBN.'<br />';
		echo 'quantity: '.$book_quantity.'<br />';
		echo 'Name: '.$from_name.'<br />';
		echo 'Add1: '.$from_add1.'<br />';
		echo 'Add2: '.$from_add2.'<br />';
		echo 'City: '.$from_city.'<br />';
		echo 'State: '.$from_state.'<br />';
		echo 'Country: '.$from_counrty.'<br />';
		echo 'Post: '.$from_postCode.'<br />';
		echo 'Email: '.$from_email.'<br />';
		echo '<br /><br />'; 
//echo '<pre>'; print_r($service); echo '</pre>';

		$address = new FBAInboundServiceMWS_Model_Address();
		
		//Set Address Parameters
		$address-> setName($from_name);
		$address-> setAddressLine1($from_add1);
		$address-> setAddressLine2($from_add2);
		$address-> setCity($from_city);
		$address-> setStateOrProvinceCode($from_state);
		$address-> setCountryCode($from_counrty);
		$address-> setPostalCode($from_postCode);

//echo '<pre>'; print_r($address);  echo '</pre>';

		$item = new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItem();
		
		//Set item parameters
		$item-> setSellerSKU($item_SKU);
		$item-> setQuantity($book_quantity);
//echo '<pre>'; print_r($item);  echo '</pre>'; 
	
		$item_list = new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItemList();
		$item_list->setmember($item);
//echo '<pre>'; print_r($item_list);  echo '</pre>'; 
 
		$request = new FBAInboundServiceMWS_Model_CreateInboundShipmentPlanRequest();
		$request->setSellerId(SELLER_ID);
		$request->setMarketplace('ATVPDKIKX0DER');
		$request->setLabelPrepPreference('AMAZON_LABEL_PREFERRED');
		$request->setShipFromAddress($address);
		$request->setInboundShipmentPlanRequestItems($item_list);
//echo '<pre>'; print_r($request); echo '</pre>'; exit;

 	 try {
		  
		  $response = $service->createInboundShipmentPlan($request);
		  //echo '<pre>'; print_r($response); echo '</pre>'; 
			//echo ("Service Response\n");

			//echo("CreateInboundShipmentPlanResponse\n");
			if ($response->isSetCreateInboundShipmentPlanResult()) { 
				
				$createInboundShipmentPlanResult = $response->getCreateInboundShipmentPlanResult();
				
				if ($createInboundShipmentPlanResult->isSetInboundShipmentPlans()) { 
					
					$inboundShipmentPlans = $createInboundShipmentPlanResult->getInboundShipmentPlans();
					$memberList = $inboundShipmentPlans->getmember();
					
					foreach ($memberList as $key=>$member) {
						
						if ($member->isSetShipmentId()) 
						{
							$shipment_id = $member->getShipmentId();
							echo 'Shipment ID: '.$shipment_id.'<br/>';
						}
						if ($member->isSetDestinationFulfillmentCenterId()) 
						{
							$DestinationFulfillmentCenterId = $member->getDestinationFulfillmentCenterId();
						}
						if ($member->isSetShipToAddress()) { 
							$shipToAddress = $member->getShipToAddress();
							if ($shipToAddress->isSetName()) 
							{
								$shipToName = $shipToAddress->getName();
							}
							if ($shipToAddress->isSetAddressLine1()) 
							{
								$shipToAdd1 = $shipToAddress->getAddressLine1();
							}
							if ($shipToAddress->isSetAddressLine2()) 
							{
								$shipToAdd2 = $shipToAddress->getAddressLine2();
							}
							if ($shipToAddress->isSetDistrictOrCounty()) 
							{
								$shiptToDistrict = $shipToAddress->getDistrictOrCounty();
							}
							if ($shipToAddress->isSetCity()) 
							{
								$shipToCity = $shipToAddress->getCity();
							}
							if ($shipToAddress->isSetStateOrProvinceCode()) 
							{
								$shipToState = $shipToAddress->getStateOrProvinceCode();
							}
							if ($shipToAddress->isSetCountryCode()) 
							{
								$shipToCountry = $shipToAddress->getCountryCode();
							}
							if ($shipToAddress->isSetPostalCode()) 
							{
								$shipToPostCode = $shipToAddress->getPostalCode();
							}
						} 
						if ($member->isSetLabelPrepType()) 
						{
							$lableType = $member->getLabelPrepType();
						}
						if ($member->isSetItems()) { 
							//echo("                        Items\n");
							$items = $member->getItems();
							$member1List = $items->getmember();
							foreach ($member1List as $member1) {
								//echo("                            member\n");
								if ($member1->isSetSellerSKU()) 
								{
									$sellerSKU = $member1->getSellerSKU();
								}
								if ($member1->isSetFulfillmentNetworkSKU()) 
								{
									$fulfillmentNetworkSKU = $member1->getFulfillmentNetworkSKU();
								}
								if ($member1->isSetQuantity()) 
								{
									$quantity = $member1->getQuantity();
								}
							}
						} 
					} //END FOREACH
				} 
			} 
			if ($response->isSetResponseMetadata()) { 
				//echo("            ResponseMetadata\n");
				$responseMetadata = $response->getResponseMetadata();
				if ($responseMetadata->isSetRequestId()) 
				{
				   $requestID = $responseMetadata->getRequestId();
				}
			} 

 }
 
 catch (FBAInboundServiceMWS_Exception $ex) { 
         echo("Caught Exception: " . $ex->getMessage() . "<br />");
         echo("Response Status Code: " . $ex->getStatusCode() . "<br />");
         echo("Error Code: " . $ex->getErrorCode() . "<br />");
         echo("Error Type: " . $ex->getErrorType() . "<br />");
         echo("Request ID: " . $ex->getRequestId() . "<br />");
         echo("XML: " . $ex->getXML() . "<br />");
     }
	 
	 	echo 'To Name: '.$shipToName.'<br />';
		echo 'To Add1: '.$shipToAdd1.'<br />';
		echo 'To Add2: '.$shipToAdd2.'<br />';
		echo 'To City: '.$shipToCity.'<br />';
		echo 'To State: '.$shipToState.'<br />';
		echo 'To Country: '.$shipToCountry.'<br />';
		echo 'To Post: '.$shipToPostCode.'<br />';
		echo '<br /><br />'; 

$email_timestamp = time();	 

$query_update = mysql_query("UPDATE book_shipment SET to_name='$shipToName', to_addressLine1='$shipToAdd1', to_addressline2='$shipToAdd2', to_city='$shipToCity', to_state='$shipToState', to_country='$shipToCountry', to_postalCode='$shipToPostCode', destination_code='$DestinationFulfillmentCenterId', fulfilment_network_SKU='$fulfillmentNetworkSKU', label_type='$lableType', shipment_id='$shipment_id', email_timestamp='$email_timestamp', status='price', transaction_status='in_progress', updated_at='$email_timestamp' WHERE SKU='$item_SKU'");
	
	echo "DB Updated<br />"; 
	
	
/* *********************************************** CREATING USPS SHIPMENT SLIP ****************************************** */

class uspsxmlParser {

var $params = array(); //Stores the object representation of XML data
var $root = NULL;
var $global_index = -1;
var $fold = false;

function xmlparser($input, $xmlParams=array(XML_OPTION_CASE_FOLDING => 0)) {
  
   
    $xmlp = xml_parser_create();
        foreach($xmlParams as $opt => $optVal) {
            switch( $opt ) {
            case XML_OPTION_CASE_FOLDING:
                $this->fold = $optVal;
            break;
            default:
            break;
            }
            xml_parser_set_option($xmlp, $opt, $optVal);
    	}

    if(xml_parse_into_struct($xmlp, $input, $vals, $index)) {
        $this->root = $this->_foldCase($vals[0]['tag']);
        $this->params = $this->xml2ary($vals);
    }
    xml_parser_free($xmlp);
	} // END - function xmlparser

function _foldCase($arg) {
    return( $this->fold ? strtoupper($arg) : $arg);
	} // END _ function _foldCase

function xml2ary($vals) {

    $mnary=array();
    $ary=&$mnary;
    foreach ($vals as $r) {
        $t=$r['tag'];
        if ($r['type']=='open') {
            if (isset($ary[$t]) && !empty($ary[$t])) {
                if (isset($ary[$t][0])){
                    $ary[$t][]=array();
                } else {
                    $ary[$t]=array($ary[$t], array());
                }
                $cv=&$ary[$t][count($ary[$t])-1];
            } else {
                $cv=&$ary[$t];
            }
            $cv=array();
            if (isset($r['attributes'])) {
                foreach ($r['attributes'] as $k=>$v) {
                $cv[$k]=$v;
                }
            }

            $cv['_p']=&$ary;
            $ary=&$cv;

            } else if ($r['type']=='complete') {
                if (isset($ary[$t]) && !empty($ary[$t])) { // same as open
                    if (isset($ary[$t][0])) {
                        $ary[$t][]=array();
                    } else {
                        $ary[$t]=array($ary[$t], array());
                    }
                $cv=&$ary[$t][count($ary[$t])-1];
            } else {
                $cv=&$ary[$t];
            }
            if (isset($r['attributes'])) {
                foreach ($r['attributes'] as $k=>$v) {
                    $cv[$k]=$v;
                }
            }
            $cv['VALUE'] = (isset($r['value']) ? $r['value'] : '');

            } elseif ($r['type']=='close') {
                $ary=&$ary['_p'];
            }
    }

    $this->_del_p($mnary);
    return $mnary;
	} // END - function xml2ary

function _del_p(&$ary) {
    foreach ($ary as $k=>$v) {
    if ($k==='_p') {
          unset($ary[$k]);
        }
        else if(is_array($ary[$k])) {
          $this->_del_p($ary[$k]);
        }
    }
	} // END - function _del_p

function GetRoot() {
  return $this->root;
	} // END - function GetRoot

function GetData() {
  return $this->params;
	} // END - function GetData
} // END - class uspsxmlParser


$userName = '078BOOKS1267'; 
$FromName = $from_name;
$FromAddress2 = $from_add1; // Have to give the main address (from_address_line_1) to from_address_2 variable of USPS. Its something strange but it works
$FromCity = $from_city;
$FromState = $from_state;
$FromZip5 = $from_postCode;

$ToName = $shipToName;
$ToAddress2 = $shipToAdd1; // Have to give the main address (to_address_line_1) to to_address_2 variable of USPS. Its something strange but it works
$ToCity = $shipToCity;
$ToState = $shipToState;
$weightOunces = 8;

// CHECK IF THE POSTAL CODE MORE THAN 5 DIGITS LONG OR NOT 
if ( strlen($shipToPostCode) > 5 ) {

	$postal_code = explode('-', $shipToPostCode);
	$ToZip5 = $postal_code[0];
	$ToZip4 = $postal_code[1];
	}

else {
	$ToZip5 = $shipToPostCode;
	$ToZip4 = '';
	}


// =============== DON'T CHANGE BELOW THIS LINE ===============


$url = "https://secure.shippingapis.com/ShippingAPI.dll";
$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data = "API=DeliveryConfirmationV3&XML=<DeliveryConfirmationV3.0Request USERID=\"$userName\">
<Option>1</Option>
<ImageParameters />
<FromName>$FromName</FromName>
<FromFirm />
<FromAddress1 />
<FromAddress2>$FromAddress2</FromAddress2>
<FromCity>$FromCity</FromCity>
<FromState>$FromState</FromState>
<FromZip5>$FromZip5</FromZip5>
<FromZip4 />
<ToName>$ToName</ToName>
<ToFirm />
<ToAddress1 />
<ToAddress2>$ToAddress2</ToAddress2>
<ToCity>$ToCity</ToCity>
<ToState>$ToState</ToState>
<ToZip5>$ToZip5</ToZip5>
<ToZip4>$ToZip4</ToZip4>
<WeightInOunces>$weightOunces</WeightInOunces>
<ServiceType>Priority</ServiceType>
<POZipCode />
<ImageType>PDF</ImageType>
<LabelDate />
</DeliveryConfirmationV3.0Request>";

//echo $data;

//echo $data;
// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result = curl_exec ($ch);
$data = strstr($result, '<?');


$xmlParser = new uspsxmlParser();
$USPSResponse = $xmlParser->xmlparser($data);

//echo $USPSResponse;
$USPSResponse = $xmlParser->getData();

curl_close($ch);

$USPSLabel = $USPSResponse['DeliveryConfirmationV3.0Response']['DeliveryConfirmationLabel']['VALUE'];

$content_USPS_PDF = $USPSLabel;

$content_Outer_USPS_Slip = base64_decode($content_USPS_PDF);

/* *********************************************** MAKING THE PDF FILE FOR ATTACHMENT **************************************** */
include("mpdf/mpdf.php");

 /* *************** OUTER SLIP HTML******************* */
$html .= "<table width='600px' border='0' cellspacing='0' cellpadding='0'>";
$html .= "<tr><td colspan='2' align='center'><strong><font color='#666666'>PLEASE LEAVE THIS LABEL UNCOVERED</font></strong></td></tr>";
$html .= "<tr><td width='300px'><strong><font size='7'>FBA - PREP</font></strong></td><td align='right'><strong><font size='7'>Media</font></strong></td></tr>";

$html .= "<tr><td bgcolor='#000' height='3px' colspan='2'></td></tr>";

$html .= "<tr><td width='50%'><strong>SHIP FROM:</strong></td>				<td width='40%'><strong>SHIP TO:</strong></td></tr>";
$html .= "<tr><td>&nbsp;&nbsp;".$from_name."</td>							<td>&nbsp;&nbsp;".$shipToName."</td></tr>";
$html .= "<tr><td>&nbsp;&nbsp;".$from_add1." ".$from_add2."</td>			<td>&nbsp;&nbsp;".$shipToAdd1." ".$shipToAdd2."</td></tr>";
$html .= "<tr><td>&nbsp;&nbsp;".$from_city." ".$from_state."</td>			<td>&nbsp;&nbsp;".$shipToCity." ".$shipToState."</td></tr>";
$html .= "<tr><td>&nbsp;&nbsp;".$from_postCode."</td>						<td>&nbsp;&nbsp;".$shipToPostCode."</td></tr>";
$html .= "<tr><td>&nbsp;&nbsp;".$from_counrty."</td>						<td>&nbsp;&nbsp;".$shipToCountry."</td></tr>";

$html .= "<tr><td bgcolor='#000' height='7px' colspan='2'><font color='#FFF' size='3'><strong>FBA (".date('j/n/y h:i A') .")</strong></font></td></tr>";
$html .= "<tr><td colspan='2' align='center'><strong><font size='4'>Purchase Order/Shipment ID</font></strong></td></tr>";	
//$html .= "<tr><td colspan='2' align='center'><strong>".$shipment_id."</strong></td></tr>";
$html .= "<tr><td colspan='2' align='center'>  <img src='barcode.php?text=".$shipment_id."' alt='BARCODE MISSING' /> </td></tr>";

$html .= "<tr><td bgcolor='#000' height='7px' colspan='2'><font color='#FFF' size='3'><strong>Internal Use Only</strong></font></td></tr>";

$html .= "<tr><td><font size='3'>FC Prep Required</font></td>				<td align='right'><font size='4'><strong>Assorted SKUs</strong></font></td></tr>";

$html .= "</table>";


$mpdf = new mPDF();

// $html must be defined
$mpdf->WriteHTML($html);

$content_Outer_FBA_Slip = $mpdf->Output('', 'S');
//$content = chunk_split(base64_encode($content));

 /* *************** INNER SLIP HTML******************* */

$html_InnerSlip .= "<table width='800px' border='' cellspacing='0' cellpadding='0'>";
$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr>
			<td colspan='4' align='center'><strong><font color='#666' size='6'>Place this Packing Slip on the top of items in the carton</font></strong></td>
		  </tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr>
			<td width='300px' colspan='2'><strong><font size='+7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FBA </font></strong></td>
			<td colspan='2'><strong><font size='+7' color='#999'>FC Prep:<br />Labeling</font></strong></td>
		</tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='2px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td width='50%'><strong>SHIP FROM:</strong></td>
			<td width='100px'>&nbsp;</td>
			<td width='40%'><strong>SHIP TO:</strong></td>
		</tr>";

$html_InnerSlip .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_name."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToName."</td>
		</tr>";

$html_InnerSlip .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_add1." ".$from_add2."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToAdd1." ".$shipToAdd2."</td>
		  </tr>";

$html_InnerSlip .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_city." ".$from_state."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToCity." ".$shipToState."</td>
		  </tr>";

$html_InnerSlip .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_postCode."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToPostCode."</td>
		  </tr>";

$html_InnerSlip .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_counrty."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToCountry."</td>
		  </tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='3px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr><td colspan='4' align='center'><strong><font size='4'>Purchase Order/Shipment ID</font></strong></td></tr>";	

//$html_InnerSlip .= "<tr><td colspan='2' align='center'><strong>".$shipment_id."</strong></td></tr>";

$html_InnerSlip .= "<tr>
			<td colspan='4' align='center' height='120px' valign='top'><img src='barcode.php?text=".$shipment_id."' alt='BARCODE MISSING' /></td>
		  </tr>";


$html_InnerSlip .= "<tr><td bgcolor='#000' height='3px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr>
			<td height='7px' colspan='4'><font color='#999' size='3'><strong>MERCHANT CHECKLIST</strong></font></td>
		  </tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr>
			<td height='7px' colspan='4'>
			<font size='5'>
				<ul>
					<li>This packing slip is placed on top of all items in the carton before sealing it</li>
					<li>The FBA Package Label is placed on the top of each carton next to the shipping label but does not cover the package seam </li>
					<li>Please kepp the Tracking and Carrier Information</li>
				</ul>
			</font>
			</td>
		  </tr>";
		  
$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr><td colspan='4'><font color='#999' size='3'>Amazon Use Only</font></td></tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr><td colspan='4'><font size='4'>MIXED SKUS</font></td></tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr><td colspan='4'><font size='6'><strong>FBA Items - Pre Required - FNSKU Labeling</strong></font></td></tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "<tr><td colspan='4' align='center'><strong><font color='#666' size='6'>Place this Packing Slip on the top of items in the carton</font></strong></td></tr>";

$html_InnerSlip .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html_InnerSlip .= "</table>";

$InnerSlip_PDF = new mPDF();

// $html_InnerSlip must be defined
$InnerSlip_PDF->WriteHTML($html_InnerSlip);

$content_Inner_FBA_Slip = $InnerSlip_PDF->Output('', 'S');

//$content_InnerSlip_PDF = chunk_split(base64_encode($content_InnerSlip_PDF));



 /************************************************** CREATING EMAIL TO SEND **********************************************************/

echo '<br /><br />sending email';
include_once "Swift/lib/swift_required.php";



echo '<br />';

$subject = 'Your Book Shipment is created! Order ID:'.$order_id.'';
$from = array('shipment@bookstoregenie.com' => 'Bookstore Genie Shipment');
$to = array($from_email  => $from_name);

//echo $text = "Mandrill speaks plaintext";
$html = 'Hi '.$from_name.'! <br /><br /> Your shipment for the book is created. Please download the attached Shipment Labels for packaging.<br /><br />Thank You<br /> Bookstore Genie Team. ';

$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
$transport->setUsername('fdaredia@bookstoregenie.com');
$transport->setPassword('ae5ebf09-6eb9-480d-b79a-b17fca598150');
$swift = Swift_Mailer::newInstance($transport);

echo 'Before attach <br />';
$attachment_Inner_FBA_Slip = Swift_Attachment::newInstance($content_Inner_FBA_Slip, 'InnerAmazonFBASlip.pdf', 'application/pdf');
$attachment_Outer_FBA_Slip = Swift_Attachment::newInstance($content_Outer_FBA_Slip, 'OuterAmazonFBASlip.pdf', 'application/pdf');
$attachment_Outer_USPS_Slip = Swift_Attachment::newInstance($content_Outer_USPS_Slip, 'OuterUSPSSlip.pdf', 'application/pdf');
echo 'After attach <br />';

$message = new Swift_Message($subject);
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($to);
$message->attach($attachment_Inner_FBA_Slip);
$message->attach($attachment_Outer_FBA_Slip);
$message->attach($attachment_Outer_USPS_Slip);

//$message->addPart($text, 'text/plain');
echo 'yahan pohancha hun<br /> ';




if ($recipients = $swift->send($message, $failures))
{
 echo 'Message successfully sent!';
} else {
 echo "There was an error:\n";
 print_r($failures);
}





// used to view the created pdf in the browser
//$mpdf->Output();
echo "</body>";
echo "</html>";   
//exit;


		
	 
	 }// END OF WHILE
?>

<?php if($ex == '' || $ex == NULL ){ 


?>

<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr height="40px" bgcolor="#EEE" style="font-size:20px; font-weight:bold;">
    <td colspan="2">Sender Information</td>
    <td colspan="2">Amazon API Information</td>
  </tr>
  <tr height="40px">
    <td width="13%">Sender Name: </td>
    <td width="38%"><?php echo $from_name;?></td>
    <td width="20%">Name: </td>
    <td width="29%"><?php echo $shipToName;?></td>
  </tr>
  <tr height="40px" bgcolor="#EEE">
    <td>Address Line 1: </td>
    <td><?php echo $from_add1;?></td>
    <td>Address Line 1: </td>
    <td><?php echo $shipToAdd1;?></td>
  </tr>
  <tr height="40px">
    <td>Address Line 2: </td>
    <td><?php echo $from_add2;?></td>
    <td>Address Line 2: </td>
    <td><?php echo $shipToAdd2;?></td>
  </tr>
  <tr height="40px" bgcolor="#EEE">
    <td>City: </td>
    <td><?php echo $from_city;?></td>
    <td>To City: </td>
    <td><?php echo $shipToCity;?></td>
  </tr>
  <tr height="40px">
    <td>State/Province: </td>
    <td><?php echo $from_state;?></td>
    <td>To State: </td>
    <td><?php echo $shipToState;?></td>
  </tr>
  <tr height="40px" bgcolor="#EEE">
    <td>Country: </td>
    <td><?php echo $from_counrty;?></td>
    <td>To Country: </td>
    <td><?php echo $shipToCountry;?></td>
  </tr>
  <tr height="40px">
    <td>Postal Code: </td>
    <td><?php echo $from_postCode;?></td>
    <td>To Postal Code: </td>
    <td><?php echo $shipToPostCode;?></td>
  </tr>
  <tr height="40px" bgcolor="#EEE">
    <td>&nbsp;</td>
    <td></td>
    <td>Shipment ID: </td>
    <td><?php echo $shipment_id;?></td>
  </tr>
  <tr height="40px">
    <td>&nbsp;</td>
    <td></td>
    <td>Destination Code: </td>
    <td><?php echo $DestinationFulfillmentCenterId;?></td>
  </tr>
  <tr height="40px" bgcolor="#EEE">
    <td>&nbsp;</td>
    <td></td>
    <td>Fulfillment Network SKU: </td>
    <td><?php echo $fulfillmentNetworkSKU;?></td>
  </tr>
  <tr height="40px">
    <td>Book Title: </td>
    <td><?php echo $bookTitle;?></td>
    <td>Seller SKU: </td>
    <td><?php echo $sellerSKU;?></td>
  </tr>
  <tr height="40px" bgcolor="#EEE">
    <td>ISBN 10: </td>
    <td><?php echo $ISBN?></td>
    <td>Quantity: </td>
    <td><?php echo $quantity;?></td>
  </tr>
  <tr height="40px">
    <td>&nbsp;</td>
    <td></td>
    <td>Lable Type: </td>
    <td><?php echo $lableType;?></td>
  </tr>
</table>
<?php }?>



</body>
</html>                          
