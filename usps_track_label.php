<?php 

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
$FromName = 'Bookstoregenie.com';
$FromAddress2 = '15001 Bitterroot Way';
$FromCity = 'Rockville';
$FromState = 'MD';
$FromZip5 = '20853';

$ToName = 'Eugene Kim';
$ToAddress2 = '226 Springloch Road';
$ToCity = 'Silver Spring';
$ToState = 'MD';
$ToZip5 = '20904';

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


$url = "http://production.shippingapis.com/ShippingAPI.dll";
$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

//Shipment ID 420209049101969010386874720168

$data = 'API=TrackV2&XML=
<TrackRequest USERID="078BOOKS1267">
<TrackID ID="420209049101969010386874720168"></TrackID>
</TrackRequest>';

//echo $data;

//echo $data;
// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result = curl_exec ($ch);
$data = strstr($result, '<?');
//echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments

$xmlParser = new uspsxmlParser();
//$USPSResponse = $xmlParser->xmlparser($data);
$USPSResponse = $xmlParser->xmlparser($data);



//echo $USPSResponse;
$USPSResponse = $xmlParser->getData();

echo '<pre>';
print_r($USPSResponse);

echo '<br /><br />********************************************************************************<br /><br />';
echo "Tracking ID: ".$USPSResponse['TrackResponse']['TrackInfo']['ID']."<br />";
echo "Shipment Status: ".$USPSResponse['TrackResponse']['TrackInfo']['TrackSummary']['VALUE']."<br />";
echo '<br /><br />********************************************************************************<br /><br />';
echo '</pre>';

//exit;

curl_close($ch);

$USPSLabel = $USPSResponse['DeliveryConfirmationV3.0Response']['DeliveryConfirmationLabel']['VALUE'];


$content_USPS_PDF = $USPSLabel;

//echo '<br /><br />***********************************************************************************************************************************<br /><br />';

$content_Outer_USPS_Slip = base64_decode($content_USPS_PDF);

echo '<pre>';
print_r($content_Outer_USPS_Slip);
echo '</pre>';
//$mpdf->Output('', 'S');
?>