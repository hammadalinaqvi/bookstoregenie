<?php
header("Content-type: application/pdf");

require('USPSLabel.php');

//echo '<pre>'; print_r(USPSLabel()); echo '</pre>';
$USPSResponse = USPSLabel();

//echo $USPSRespnse;

$USPSLabel = $USPSResponse['DeliveryConfirmationV3.0Response']['DeliveryConfirmationLabel']['VALUE'];

//echo $USPSLabel;

echo base64_decode($USPSLabel);

/*

$fp = fopen('test.pdf', 'w');

$file = fwrite('test.pdf', $shit);

if($file === false)
{echo "not running";}
else
{echo "running";}
*/
?>