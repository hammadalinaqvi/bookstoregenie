<?php 
include("mpdf/mpdf.php");

$from_name = "Hammad Ali";
$from_add1 = "123 Main Street, Main Ave";
$from_city = "Seattle";
$from_postCode = "98102";
$from_counrty = "US";

$shipToName = "Amazon.com.indc LLC";
$shipToAdd1 = "710 South Girls School Road";
$shipToCity = "Indianapolis";
$shipToState = "IN";
$shipment_id = "FBA452XHM";
$shipToCountry = "US";

$html .= "<table width='800px' border='' cellspacing='0' cellpadding='0'>";
$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr>
			<td colspan='4' align='center'><strong><font color='#666' size='6'>Place this Packing Slip on the top of items in the carton</font></strong></td>
		  </tr>";

$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr>
			<td width='300px' colspan='2'><strong><font size='+7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FBA </font></strong></td>
			<td colspan='2'><strong><font size='+7' color='#999'>FC Prep:<br />Labeling</font></strong></td>
		</tr>";

$html .= "<tr><td bgcolor='#000' height='2px' colspan='4'></td></tr>";

$html .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td width='50%'><strong>SHIP FROM:</strong></td>
			<td width='100px'>&nbsp;</td>
			<td width='40%'><strong>SHIP TO:</strong></td>
		</tr>";

$html .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_name."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToName."</td>
		</tr>";

$html .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_add1." ".$from_add2."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToAdd1." ".$shipToAdd2."</td>
		  </tr>";

$html .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_city." ".$from_state."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToCity." ".$shipToState."</td>
		  </tr>";

$html .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_postCode."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToPostCode."</td>
		  </tr>";

$html .= "<tr>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$from_counrty."</td>
			<td width='100px'>&nbsp;</td>
			<td>&nbsp;&nbsp;".$shipToCountry."</td>
		  </tr>";

$html .= "<tr><td bgcolor='#000' height='3px' colspan='4'></td></tr>";

$html .= "<tr><td colspan='4' align='center'><strong><font size='4'>Purchase Order/Shipment ID</font></strong></td></tr>";	

//$html .= "<tr><td colspan='2' align='center'><strong>".$shipment_id."</strong></td></tr>";

$html .= "<tr>
			<td colspan='4' align='center' height='120px' valign='top'><img src='barcode.php?text=".$shipment_id."' alt='BARCODE MISSING' /></td>
		  </tr>";


$html .= "<tr><td bgcolor='#000' height='3px' colspan='4'></td></tr>";

$html .= "<tr>
			<td height='7px' colspan='4'><font color='#999' size='3'><strong>MERCHANT CHECKLIST</strong></font></td>
		  </tr>";

$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr>
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
		  
$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr><td colspan='4'><font color='#999' size='3'>Amazon Use Only</font></td></tr>";

$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr><td colspan='4'><font size='4'>MIXED SKUS</font></td></tr>";

$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr><td colspan='4'><font size='6'><strong>FBA Items - Pre Required - FNSKU Labeling</strong></font></td></tr>";

$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "<tr><td colspan='4' align='center'><strong><font color='#666' size='6'>Place this Packing Slip on the top of items in the carton</font></strong></td></tr>";

$html .= "<tr><td bgcolor='#000' height='1px' colspan='4'></td></tr>";

$html .= "</table>";

$mpdf=new mPDF();

// $html must be defined
$mpdf->WriteHTML($html);

$content = $mpdf->Output('', 'S');

print_r($content); exit;

$content = chunk_split(base64_encode($content));

// creating email
$mailto = $from_email;
$from_email_name = 'Book Store Genie';
$from_mail = 'info@bookstoregenie.com';
//$replyto = 'sender@domain.com'; 

$uid = md5(uniqid(time()));
$mime_boundary = "==Multipart_Boundary_x{".$uid."}x";

$subject = 'Your Book Shipment is created';
$message = 'Hi '.$from_name.'! <br /><br /> Your shipment for the book is created. Please download the attached Shipment Label for packaging.<br /><br /> Thank You<br /> Bookstore Genie Team. ';

$filename_OuterSlip_PDF = 'Outer_Slip.pdf';
$filename_InnerSlip_PDF = 'Inner_Slip.pdf';
$filename_USPS_PDF = 'USPS_Slip.pdf';


$header = "From: ".$from_email_name." <".$from_mail.">\r\n";
//$header .= "CC: abbas.sanjrani@zigron.com\r\n";
//$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed;  boundary=\"".$mime_boundary."\"\r\n\r\n";
$header .= "This is a multi-part message in MIME format.\r\n";
$header .= "--".$mime_boundary."\r\n";
$header .= "Content-type:text/html; charset=iso-8859-1\r\n";
$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$header .= $message."\r\n\r\n";
$header .= "--".$mime_boundary."\r\n";

$header .= "Content-Type: application/pdf; name=\"".$filename_OuterSlip_PDF."\"\r\n";
$header .= "Content-Transfer-Encoding: base64\r\n";
$header .= "Content-Disposition: attachment; filename=\"".$filename_OuterSlip_PDF."\"\r\n\r\n";
$header .= $content."\r\n\r\n";
$header .= "--".$mime_boundary."\r\n";

$header .= "Content-Type: application/pdf; name=\"".$filename_InnerSlip_PDF."\"\r\n";
$header .= "Content-Transfer-Encoding: base64\r\n";
$header .= "Content-Disposition: attachment; filename=\"".$filename_InnerSlip_PDF."\"\r\n\r\n";
$header .= $content_InnerSlip_PDF."\r\n\r\n";
$header .= "--".$mime_boundary."\r\n";

$header .= "Content-Type: application/pdf; name=\"".$filename_USPS_PDF."\"\r\n";
$header .= "Content-Transfer-Encoding: base64\r\n";
$header .= "Content-Disposition: attachment; filename=\"".$filename_USPS_PDF."\"\r\n\r\n";
$header .= $content_USPS_PDF."\r\n\r\n";
$header .= "--".$mime_boundary."\r\n";


//$is_sent = @mail($mailto, $subject, "", $header);
echo "email code commented!!";

//$mpdf->Output();
exit;
?>