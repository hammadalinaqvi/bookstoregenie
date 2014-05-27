<?php
	require("Mail.php");
	require("Mail/mime.php");
	dbConnect();
	$table = "pendingOrgs";
	$sendNum = 1; // number of emails to send per script run (important for getting around spam filters)
	
	$query = "SELECT * FROM {$table} LIMIT 0, {$sendNum}";
	$result = mysql_query($query);
	
	$names = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		sendMail($row['orgEmail'], $row['orgName'], $row['university'], $row['email'], $row['name'], $row['phone'], $row['officerName']);
		$names  .= ' OR orgName = "' . $row['orgName']. '"';
	}
	echo "Succesfully sent " . mysql_num_rows($result) . "emails";
	
	$names = substr($names, 3);
	$query = "DELETE FROM {$table} WHERE {$names}";
	mysql_query($query);
	
	function sendMail($address, $to, $university, $reply, $from, $phone, $name){
		$subject = "Fundraiser";
		$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\"";
		$date = date('F jS, Y');
		$text = <<< EOT
		{$date}
		Fundraiser for Your Student Organization!
		brought to you by

		Dear {$name},

		My name is {$from}, and I'm a junior at George Washington
		University.  I wanted to give you a heads-up on a fundraiser we're
		doing for student organizations across the country to get some extra
		funds for your organization.

		We've created BookstoreGenie.com -
		http://www.bookstoregenie.com , a website that takes your required textbook list and hunts through
		all of the textbook sites on the web to find the cheapest new, used,
		rental, and ebook textbooks.  We've even added a feature to tell you
		which vendor is the cheapest overall place to get your textbooks if
		you want to buy them all from one place!
		Sounds great, but how does this benefit our
		student organization?  If you set up a webpage for your organization
		through Bookstore Genie, your organization will receive 50% of the
		profit we make on each textbook that is bought through your page.  So
		not only will your members be saving money on books, but also raising
		money for your organization at the same time!

		If you're interested in this program, click here to get a webpage for
		your organization.  If you have any questions, please feel free to
		give me a call at {$phone}.

		Thanks!
		{$from}
		George Washington University, Class of '12
		B.A. Political Communications, Secondary Field of Study in Business
		Administration, Minor in Economics
		{$reply} | {$phone}
EOT;
		$html = <<< EOT
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

	<head>

		<meta content="text/html;charset=UTF-8" http-equiv="content-type" />

		<title></title>

	</head>

	<body alink="#0000FF" bgcolor="#FFFFFF" link="#0000FF" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333;" vlink="#0000FF">

		<div style="width: 600px; margin: 0 auto 0 auto">

			<table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #000000;" width="650">

				<tbody>
					<tr>
						<td align = "center" bgcolor = "#a5d6e2" colspan = "2">
							<div style = "padding-top: 20px;">
								<img alt="Bookstore Genie" border="0" hspace="0" src="http://bookstoregenie.com/images/logo.png" style="" title="Bookstore Genie" vspace="0" />
							</div>
						</td>
					</tr>

					<tr height="565">

						<td align="center" bgcolor="#a5d6e2" valign="top" width="200">

							<div style="padding: 60px 0 0 0;">

								<img align="none" alt="Bookstore Genie" border="0" height="284" hspace="0" src="http://bookstoregenie.com/images/genie.png" style="display: block; width: 150px; height: 350px; " title="Bookstore Genie" vspace="0" width="150" /></div>

						</td>

						<td bgcolor="#a5d6e2" valign="top" width="445">

							<table align="center" border="0" cellpadding="0" cellspacing="0" width="450">

								<tbody>

									<tr>

										<td align="right" bgcolor="#a5d6e2" style="padding:5px 15px;">

											<div style="font-size: 12px; color: #ffffff; font-weight: bold; font-family: Verdana, Helvetica, sans-serif">

												{$date}</div>

										</td>

									</tr>

									<tr>

										<td align="right" style="padding:15px 15px 0px 15px">

											<div style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; ">

												<span style="font-size:12pt;"><span style="font-family:verdana,geneva,sans-serif;"><font class="Apple-style-span" color="#FFFFFF"><span class="Apple-style-span">Fundraiser for Your Student Organization!</span></font></span></span><br />

										</td>

									</tr>

									<tr>

										<td>

											<table align="center" cellpadding="0" cellspacing="0" width="415">

												<tbody>

													<tr>

														<td bgcolor="#f0f5f6">

															<img alt="grey_box_top.gif" height="6" src="http://www.bookstoregenie.com/images/blue_box_top.png" style="display:block" width="415" /></td>

													</tr>

													<tr>

														<td bgcolor="#f0f5f6" style="padding:5px 15px">

															<div>

																Hey {$name},&nbsp;<br />

																<br />

																My name is {$from}, and I&#39;m a junior at George Washington University. I wanted to give you a heads-up on a fundraiser we&#39;re doing for student organizations across the country to get some extra funds for your organization.<br />

																<br />

																We&#39;ve created&nbsp;<a href="http://www.bookstoregenie.com/" style="color: rgb(0, 102, 187); outline-style: none; outline-width: initial; outline-color: initial; ">BookstoreGenie.com</a>, a website that takes your required textbook list and hunts through all of the textbook sites on the web to find the cheapest new, used, rental, and ebook textbooks. &nbsp;We&#39;ve even added a feature to tell you which vendor is the cheapest overall place to get your textbooks if you want to buy them all from one place!

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	&nbsp;</div>

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	Sounds great, but how does this benefit&nbsp;{$to}? &nbsp; <span style = "font-weight:bold;>If you set up a webpage for your organization through Bookstore Genie, {$to} will receive 50% of the profit we make on each textbook that is bought through your page.</span> &nbsp;So not only will your members be saving money on books, but also raising money for your organization at the same time!</div>

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	&nbsp;</div>

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	If you&#39;re interested in this program, click <a href = "http://www.bookstoregenie.com/add_organization.php?university={$university}">here</a> to get a webpage for your organization. &nbsp;If you have any questions, please feel free to give me a call at {$phone}.</div>

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	&nbsp;</div>

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	Thanks!</div>

																<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																	<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																		{$from}</div>

																	<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																		George Washington University, Class of &#39;12</div>

																	<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																		B.A. Political Communications, Secondary Field of Study in Business Administration, Minor in Economics</div>

																	<div style="outline-style: none; outline-width: initial; outline-color: initial; ">

																		{$reply} | {$phone}</div>

																</div>

															</div>

														</td>

													</tr>

													<tr>

														<td bgcolor="#f0f5f6">

															<img alt="grey_box_bottom.gif" height="6" src="http://www.bookstoregenie.com/images/blue_box_bottom.png" style="display:block" width="415" /></td>

													</tr>

												</tbody>

											</table>

										</td>

									</tr>

								</tbody>

							</table>

						</td>

					</tr>
					<tr>
						<td bgcolor = "#a5d6e2" colspan="2">
							<div>

								<img align="center" alt="Bookstore Genie Steps" border="0" hspace="0" vspace="0"src="http://www.bookstoregenie.com/images/center.png" style="padding-left: 25px; padding-top: 10px; width: 600px; height: 258px; " title="Bookstore Genie Steps" vspace="5" /><br /></div>

						</td>

					</tr>
					<tr>

						<td colspan="2" bgcolor="#a5d6e2" valign="bottom">

							&nbsp;</td>

					</tr>

				</tbody>

			</table>

		</div>

		<br />

	</body>

</html>
EOT;
		$crlf = "\n";
		$hdrs = array(
					  'From'    => $from . '<' . $reply . '>',
					  'Subject' => $subject,
					  'Reply'   => $reply
					  );

		$mime = new Mail_mime($crlf);
		$image = 'images/genie.png';
		$mime->addHTMLImage(file_get_contents($image),mime_content_type($image),basename($image),false);
		$image = 'images/logo.png';
		$mime->addHTMLImage(file_get_contents($image),mime_content_type($image),basename($image),false);
		echo $mime->get();
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);

		//do not ever try to call these lines in reverse order
		$body = $mime->get();
		$hdrs = $mime->headers($hdrs);

		$mail =& Mail::factory('mail');
		$mail->send($address, $hdrs, $body);
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