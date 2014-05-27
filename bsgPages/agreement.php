<?php
	
	include '../xajax/xajax_core/xajax.inc.php';
	
	$xajax = new xajax();

	$xajax->configure("javascript URI","../xajax/");

	$xajax->register(XAJAX_FUNCTION, 'verifyUser');
	
	$xajax->processRequest();
	
	function verifyUser($agreement, $address, $email, $code, $city,$state,$zip,$ssn,$firstname)
	{
		$response = new xajaxResponse();
		
		$mysqli = new mysqli('localhost', 'jteplitz', 'jtt0511');
		
		$query = "select * from jteplitz_bookstore.organizations where code = '$code' and email = '$email'";
		$result = $mysqli->query($query);
		if ($result->fetch_object() == null) {
			$status = "<font color='red'>Sorry! You are not currently set to be hired as a representative of Bookstore Genie.  If this message is in error, please contact your hiring representative for more information.<font>";
			$response->assign('userStatus', 'innerHTML', $status);
		}
		else if($agreement == 0)
		{
			$status = "<font color='red'>Sorry! You have not elected to agree to the terms and conditions of employment with Bookstore Genie.  Please ensure that you have read the terms and conditions, agree to the contract, and click the approval box on this page.<font>";
			$response->assign('userStatus', 'innerHTML', $status);
		}
		else
		{
			$query = "update jteplitz_bookstore.organizations set address='$address',city='$city',state='$state',zip='$zip',ssn='$ssn',verified=1 where code='$code' and email='$email'";
			$mysqli->query($query);
			
			$status = "<font color='green'>Congratulations $firstname!  You are now a genie.  You will recieve a confirmation email shortly.  Thank you!  <font>";
			$response->assign('userStatus', 'innerHTML', $status);
			sendRepEmail($firstname, $email);
			sendConfirmEmail($firstname, $email);
			
		}
		
		$mysqli->close();
		
		return $response;
	}
	
	
	function sendRepEmail($firstname, $email)
	{
		
	
		$to = "$email";
		$subject = "Welcome to the Bookstore Genie Team!";		
		
		$body = "Hey $firstname!<br><br>

 

We are incredibly excited to have you on board as a Genie Rep! 
<br><br>
 

It’s a new school year and we want to thank you for joining the Genie Rep team.  You are a member of a unique team of students from around the country at college campuses.  You have all been qualified to possess above average attributes of drive, ambition, and enthusiasm together with an extensive social network.   Ultimately, you will earn the opportunity to deposit money in the bank and add important accomplishments to your resume. 
<br><br>
 

We have worked with scores of Genie Reps at campus’ nationwide and have learned what it takes to be highly successful.   We are always available during business hours to answer your questions, to discuss strategy or to listen to your ideas.  Remember, you are a member of the Genie Team.  We are in this together.  Your success and a long-term relationship are important to us!
<br><br>
 

What you can expect from us is very simple:  We are here to support successful achievement of your goals as a Genie Rep.  We expect you to freely communicate with us at any time with questions, ideas, recommendations, complaints, and even compliments.  Or, if you simply want to chat and feel connected to the Genie family, give us a call.
<br><br>
 

We also have expectations of you.  We want you to deliver sufficient effort in achieving your goals so we have something to celebrate together.  We ask that you commit to and follow a plan that is designed to support your success.  And, we want you to be available to speak with your Genie Manager on a scheduled basis to discuss strategies and tactics that will add measureable return to your efforts.

 <br><br>

As a next step, we would like for you to get in touch with your Genie Rep to discuss the first phase of your guerrilla marketing campaign and then to begin thinking about your plan to achieve Master Genie® status.
<br><br>

Go Forth and Prosper.  Have fun and Trust the Genie. 
<br><br>
 

Sincerely,
<br><br>
 

Farhan Daredia";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Bookstore Genie <support@bookstoregenie.com>' . "\r\n";
		
		mail($to, $subject, $body, $headers);
		
	}
	
	function sendConfirmEmail($firstname, $email)
	{
		
	
		$to = "eugenek79@gmail.com,genierep@bookstoregenie.com,tonyparacha@gmail.com,fdaredia@gmail.com";
		$subject = "Another rep has signed up!";		
		
		$body = "$firstname has signed up as a rep!<br><br>
		There email address is $email.";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Bookstore Genie <support@bookstoregenie.com>' . "\r\n";
		
		mail($to, $subject, $body, $headers);
		
	}
	
?>

 <!DOCTYPE html> 
<html> 
<head> 
<title>Bookstore genie | Contract agreement</title> 
	<meta name="robots" content="noindex" />
	<meta name="robots" content="nofollow" />
  	<meta name="csrf-param" content="authenticity_token"/> 
	<meta name="csrf-token" content="uK5etSng8pH2YFKgokG0J+cjQ8cpwAj57fkTw0tG8vE="/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!-- jquery script -->
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
	
	<!-- general style -->
		<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/inline.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/pagestyles.css" media="screen" rel="stylesheet" type="text/css" />
	
	<!-- navigation style + script -->
		<link rel='stylesheet' href='css/navigation.css'>
		<script src='js/navigation.js'></script>
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

    <!-- Google Fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo|Questrial|Istok+Web|Quattrocento+Sans:400,700"  type="text/css" />
		
	<script type="text/javascript">
		!window.jQuery && document.write('<script src="js/jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
     
        <style type="text/css">
        	/*.red{
        		color: #cb4009;
        	}*/
        	.checkbox{
        		margin-left: 10px;
        	}
        	select{
				width: 200px;
				height: 30px;
			    color: #333333;
			    background-color: #FFFFFF;
			    padding-top: 7px;
			    padding-right: 3px;
			    padding-bottom: 7px;
			    padding-left: 3px;
			    border-color: #b4b4b4 #e9e9e9 #e9e9e9 #b4b4b4;
			    border-style: solid;
			    border-width: 1px;
			    /*Rounded corners*/
			    -webkit-border-radius: 5px;
			    -moz-border-radius: 5px;
			    border-radius: 5px;
			    -moz-box-shadow: 1px 1px 0px #fff;
			    -webkit-box-shadow: 1px 1px 0px #fff;
			    box-shadow: 1px 1px 0px #fff;
			}
			
			/*input, select and textarea styles*/
			
			input, textarea {
			    color: #333333;
			    background-color: #FFFFFF;
			    padding-top: 5px;
			    padding-right: 3px;
			    padding-bottom: 5px;
			    padding-left: 3px;
			    border-color: #b4b4b4 #e9e9e9 #e9e9e9 #b4b4b4;
			    border-style: solid;
			    border-width: 1px;
			    /*Rounded corners*/
			    -webkit-border-radius: 5px;
			    -moz-border-radius: 5px;
			    border-radius: 5px;
			    -moz-box-shadow: 1px 1px 0px #fff;
			    -webkit-box-shadow: 1px 1px 0px #fff;
			    box-shadow: 1px 1px 0px #fff;
			}
			
			input:focus, select:focus, textarea:focus {
			    background-color: #F2F2F2;
			}
			
			.line{
				border-bottom: 1px solid #eeeeee;
				margin: 20px 0;
			}
        	
        	.fltlt{
        		float: left;
        	}
        
        </style> 
	
</head>
 
 <?php
$xajax->printJavascript();
?>
 
<body class="in" > 
	
	<div class="header"> <!-- begin header -->
	
		<div class="innerHeader"> <!-- begin inner header -->
		
		<a href="http://bookstoregenie.com" title="BookStoreGenie"><div class="topLogo"></div></a> 
			
			<div class="nav-wrap">
				<ul class="group" id="example-one">
		            <li><a href="about.html">About Us</a></li>
		            <li><a href="http://www.bookstoregenie.com">Rent Now</a></li>
		            <li><a href="trustTheGenie.html">Trust the Genie</a></li>
		            <li><a href="contact.html">Contact</a></li>
		            <li class="current_page_item"><a href="beAgenie.html">Be a Genie</a></li>
		        </ul>
		    </div> 
			
		</div> <!-- end inner header -->
			
	</div> <!-- end header -->
 	
		<div class="heading"> <!-- begin heading --> 
		
			<div class="breadcrumbs">  <!-- begin breadcrumbs -->
				<a href="http://www.bookstoregenie.com" title="Homepage">Homepage</a> &raquo <a href="http://www.bookstoregenie.com/bsgPages/beAgenie.html" title="Homepage">Be a Genie</a> &raquo Contract Agreement
			</div> <!-- end breadcrumbs -->
		
		</div> <!-- end heading -->
 	
	<div class="wrap"> <!-- begin wrap -->
	
		<br />
		
		<h1 class="centerThat"><span>Bookstore Genie&#153; Independent Contractor Agreement</span></h1>
      

		<h4 class="redLabel centerThat">Please read this agreement entirely and carefully. Once digitally signed and the submit button is pressed, it is a legally binding contract.</h4>
		
		<div class="agreementList">
		<ul>
			<span>
			<li>&#183; All of the fields are required.</li>
			<li>&#183; Ensure that once all fields are correct that you hit the 'Submit Application' once.</li>
			<!-- <li>&#183; You will receive an email confirmation once you have completed and submitted the application, along with your username and password for logging into the Bookstore Genie internal staff site.</li> -->
			</span>
		</ul>
		</div>
		      
		<div class="line"></div>
		
		<a id="various1" href="#inline1" title="BookstoreGenie&#153; Contract Agreement"><img src="images/contract.jpg"></a>
		
		<div style="display: none;">
				<textarea id="inline1" rows='100' cols='80' style="width:601px;height:600px;overflow:scroll;font-size: 10pt;">
		
		INDEPENDENT CONTRACTOR AGREEMENT

 

This Agreement is entered into on September 15, 2011, between Bookstore Genie, a subsidiary of College Essentials, Inc ("the Company", which does business as “Bookstore Genie”) and ______________________________ (“the Contractor”).  The Company is a corporation duly organized and qualified to do business under the laws of the State of Georgia and is engaged in the business of providing students with cheap and affordable textbooks for rent, sale, and repurchase.

1.            Independent Contractor.  Subject to the terms and conditions of this Agreement, the Company hereby engages the Contractor as an Independent Contractor to perform the services set forth herein, and the Contractor hereby accepts such engagement.  The Company desires to engage the services of Contractor, the scope of which is set forth in the Contract Addendum(s) attached hereto and incorporated herein by reference (the "Service").  The Service shall be provided pursuant to the terms and conditions set forth in this Agreement and any incorporated attachment.  Contractor’s main purpose shall be to attract customers to BOOKSTORE GENIE’s website for textbook rentals, textbook sales, and textbook buy-backs.  Contractor holds him/herself out to be a motivated, detail-oriented campus representative who has legitimate ties with the college or university at which he/she agrees to be a representative of the Company.  Contractor shall not be considered under this Agreement as having employee status or as being entitled to participate in any plans, arrangements or distributions by the Company pertaining to or in connection with any pension, stock, bond or profit sharing plan or any other similar fringe benefit for the Company’s regular employees.  The Contractor shall have no claim against the Company hereunder or otherwise for vacation pay, sick leave, retirement benefits, social security, worker's compensation, health or disability benefits, unemployment insurance benefits, or employee benefits of any kind.  This Agreement shall not render the Contractor an employee, partner, agent of, or joint venturer with the Company for any purpose.  The Contractor is and will remain an independent contractor in [his or her] relationship to the Company. 

 

2.            Duties, Term, and Compensation.  The Contractor's duties, term of engagement, compensation and provisions for payment thereof shall be as set forth in the rider which is attached as Exhibit A (attached at end and titled “Duties, Term and Compensation”), which may be amended in writing from time to time.  Contractor shall have the right to sell his services to any other company or entity, provided that such activities do not interfere with the performance of Contractor's duties hereunder and such services do not conflict with the business of the Company or any of its clients.  Either party may terminate this Agreement for any reason by giving written notice (email or otherwise in writing), provided however, the terminating party is not in breach of this Agreement at the time notice is sent.  The duties and services of Contractor shall continue only so long as the Service rendered is satisfactory to the Company, regardless of any other provision contained in this Agreement, and the Company shall be the sole judge as to whether the Service is satisfactory.

3.            Taxes.  Contractor acknowledges and agrees that no federal or state withholding taxes, FICA, SDI, or other employee payroll taxes or deductions are made with respect to compensation paid to Contractor pursuant to this Agreement.  Contractor is solely responsible for all such taxes, and agrees to report for federal and state income and Franchise tax purposes all such compensation, and to pay all taxes due thereon and to indemnify, defend and hold the Company harmless in the event that any claims made by any taxing authority, by reason of Contractor's failure to properly pay any and all taxes which are due in relation to the services provided pursuant to this Agreement.  Pursuant to relevant IRS Tax Code, any Contractor earning more than $600 in a calendar year will be served with a 1099 to reflect the outcome of this Agreement.

4.            Expenses.  During the term of this Agreement, the Contractor shall pay all expenses out of pocket.  It is understood and acknowledged by the parties that Contractor, in connection with the Service to be performed, may be required to expend monies for business expenses.  It is expressly acknowledged that Contractor shall bear all such expenses, and that Contractor shall not be entitled to any reimbursement or allowance for expenses from BOOKSTORE GENIE, except as otherwise stated on the Contract Addendum(s).  Any additional monies outside of the approved rates listed in the rider which is attached as Exhibit A (attached at end and titled “Duties, Term and Compensation”) for any type of task must be pre-approved by Farhan Daredia, or a designated representative of Company prior to the expense being incurred by the Contractor.  Any expense incurred before Contractor receives proper approval shall not be reimbursable. 

5.            Financial Responsibility.  In the event Contractor is tasked with doing end of semester textbook buyback, Contractor will purchase books according to Company's guidelines as set out the Bookstore Genie Textbook Buyback Handbook.  If it becomes apparent that Contractor has not delivered appropriate number of books and/or returned appropriate amount of cash to the Company, Contractor agrees to reimburse the company for any difference in value, plus any actual losses sustained by Company as a result of Contractor’s delay and/or non-performance under this agreement.

6.            Written Reports.  Contractor is not responsible for any written reports.

7.            Hours.  Contractor may work any and all hours desired during the Term.  Such hours may not be controlled or otherwise influenced by the Company. Contractor agrees to abide by a pre-set check-in timeline which shall serve as a method for the Company to be continually updated and kept abreast of Contractor’s output, referral status and overall achievement at pre-set points in time.  Contractor acknowledges that Company may forfeit his/her commission payment if Contractor fails to check-in with the Company within a reasonable time period.  Given the often short duration of the textbook buying season, the Company has a very short timeline in which to employ persons as Independent Contractors to represent the Company.  As such, the Company reserves the right to not pay any Contractor who does not check-in with a representative of the Company as required per his/her specific check-in timeline. 

8.            Methods.  Methods will not be governed by the Company.  Contractor may devise and implement such methods at will, given that the ultimate outcome is in accordance with Company guidelines and does not violate any Federal, State, Local laws or College/University rules.  Company will provide general guidelines and sales tips to Independent Contractor as a good faith effort to help maximize Contractor's own earning potential.  The Company shall have no right to control the manner or the means by which Contractor performs the Service for Company, however, Company shall advise Contractor of its expected specifications and criteria for the Services and their satisfactory completion. Company shall not be required to make available to Contractor any facilities or equipment for performance under this contract.

 

9.            University Policies.  Contractor is expected to abide by all University policies governing student behavior and is further act in accordance with all Federal, State, and local laws.  Existence of this Agreement shall not in any way protect Contractor from any student body, university body, or law enforcement under any circumstances.  Company cannot be responsible for the behavior of Contractor, whether carrying out the duties of this Agreement or not, if that behavior is either illegal or does not meet the rules governing student behavior set forth by the University/College.  Contractor understands that he/she is solely responsible for his/her own actions, and the actions of others, to include his/her agents acting for Contractor in any fashion.  CONTRACTOR IS NOT AN AGENT OF THE COMPANY AND UNDER NO CIRCUMSTANCES MAY AN AGENCY RELATIONSHIP ACTUALLY BE FORMED, EXIST, OR BE ASSUMED between said Contractor and the Company under this agreement.

10A.       Inventions.  Any and all inventions, discoveries, developments and innovations conceived by the Contractor during this engagement relative to the duties under this Agreement shall be the exclusive property of the Company; and the Contractor hereby assigns all right, title, and interest in the same to the Company.  Any and all inventions, discoveries, developments and innovations conceived by the Contractor prior to the term of this Agreement and utilized by [him or her] in rendering duties to the Company are hereby licensed to the Company for use in its operations and for an infinite duration.  This license is non-exclusive, and may be assigned without the Contractor's prior written approval by the Company to a wholly-owned subsidiary of the Company or any other person/entity of the Company’s choice and as Company sees fit.

10.B       Ownership. All materials and other information furnished by the Company to Contractor, including, without limitation, confidential and proprietary information, shall be the sole and exclusive property of the Company. This paragraph also applies to and includes all lists of any type, email or otherwise, generated during performance by Contractor under this contract.

10.C       Work Made For Hire. Company forever owns, throughout the universe in all media now or later known, from inception and during the engagement all right, title and interest (including, without limitation, worldwide rights of copyright) in any and all of Contractor's work product ("Work Product") embodied in any tangible form, including, without limitation, all designs, ideas, concepts, themes, stories, suggestions, reports, plans, specifications, drawings, photographs, videotapes, schematics, discs, prototypes, models, inventions, and all other things, information, documents and items in any media (now known or hereafter developed) made during the course of or in contemplation of the entry into this Agreement and arising from or during the provision of the services delineated herein or provided heretofore or otherwise during the term as a work-made-for-hire for Company. Company shall have the right to use the Work Product, in whole or in part, or refrain from using the Work Product, at Company's election. The Work Product and all related rights emanating therefrom, such as the right to reproduce, display, distribute, perform, and prepare derivative works shall be owned solely by the Company and deemed to be the Company’s work-made-for-hire under the U.S. copyright laws and similar laws of other countries and related international treaties and conventions.

11.          Confidentiality. The Contractor acknowledges that during the engagement [he or she] will have access to and become acquainted with various trade secrets, inventions, innovations, processes, information, records and specifications owned or licensed by the Company and/or used by the Company in connection with the operation of its business including, without limitation, the Company's business and product processes, methods, customer lists, accounts and procedures.  The Contractor agrees that [he or she] will not disclose any of the aforesaid, directly or indirectly, or use any of them in any manner, either during the term of this Agreement or at any time thereafter, except as required in the course of this engagement with the Company.  All files, records, documents, blueprints, specifications, information, letters, notes, media lists, original artwork/creative, notebooks, and similar items relating to the business of the Company, whether prepared by the Contractor  or otherwise coming into [his or her] possession, shall remain the exclusive property of the Company.  The Contractor shall not retain any copies of the foregoing without the Company's prior written permission.  Upon the expiration or earlier termination of this Agreement, or whenever requested by the Company, the Contractor shall immediately deliver to the Company all such files, records, documents, specifications, information, and other items in [his or her] possession or under [his or her] control.  The Contractor further agrees that [he or she] will not disclose [his or her] retention as an independent contractor or the terms of this Agreement to any person without the prior written consent of the Company and shall at all times preserve the confidential nature of [his or her] relationship to the Company and of the services hereunder.

Contractor acknowledges that many aspects of the business and affairs of the Company are confidential and that Contractor heretofore had or will have access to certain commercial, business and other confidential, private, or personal information relating to or concerning the business of the Company, (the "Confidential Information," as further defined in Section b herein directly below). Contractor acknowledges and agrees that the Confidential Information is exclusively owned and controlled by the Company.

11.A       Contractor expressly agrees that he will not at any time, whether during or subsequent to the term of the engagement, in any fashion, form, or manner, unless specifically consented to in writing by the Company, either directly or indirectly use or divulge, disclose, use, exploit, appropriate, or communicate to any person, firm, or corporation, in any manner whatsoever, any confidential information of any kind, nature, or description concerning any matters related to the business of the Company.

11.B       For purposes of this Agreement, "Confidential Information" shall include, but not be limited to, all information regarding currently existing, planned, or in-development products or business initiatives of the Company, the names, buying habits, or practices of any of the Company’s licensees or customers, the Company’s marketing methods and related data, the compensation it obtains for services and/or products, lists or other written records used in the Company's business, compensation paid by the Company to employees and contractors, information related to contracts and licenses, business systems, computer programs, or any other confidential information of, about, or concerning the business of the Company, the manner of operation, or other confidential data of any kind, nature, or description, the parties to this Agreement stipulating that, as between them, the same are important, material, and confidential trade secrets and affect the successful conduct of the Company's business.

11.C       Contractor acknowledges and agrees that any disclosure of Confidential Information will cause irreparable harm to the Company and that these damages are not susceptible to measure. In the event of a breach or threatened breach of this agreement, Contractor and the Company hereby agree that any remedy at law for any breach or threatened breach of this Agreement will be inadequate and, accordingly, each party hereby stipulates that the other is entitled to obtain injunctive or declaratory relief for any such breach or threatened breach. The injunctive relief provided for in this paragraph is in addition to any and all other remedies available at law or in equity to the non-breaching party. The parties agree to waive the requirement of posting a bond in connection with a court's issuance of an injunction.

11.D       The remedies in this paragraph are not exclusive, and the parties shall have the right to pursue any other legal or equitable remedies to enforce the terms of this Agreement.  In addition, Contractor understands that this Confidential Information provision is a material term of this Agreement and any breach of this provision shall be considered a material breach.

12.          Conflicts of Interest; Non-hire Provision.  The Contractor represents that [he or she] is free to enter into this Agreement, and that this engagement does not violate the terms of any agreement between the Contractor and any third party.  Further, the Contractor, in rendering [his or her] duties shall not utilize any invention, discovery, development, improvement, innovation, or trade secret in which [he or she] does not have a proprietary interest.  During the term of this agreement, the Contractor shall devote as much of [his or her] productive time, energy and abilities to the performance of [his or her] duties hereunder as is necessary to perform the required duties in a timely and productive manner.  The Contractor is expressly free to perform services for other parties while performing services for the Company. 

12.A       Non-Compete. For a period of twelve (12) months following any termination, the Contractor shall not, directly or indirectly hire, solicit, or encourage to leave the Company's employment, any employee, consultant, or contractor of the Company or hire any such employee, consultant, or contractor who has left the Company's employment or contractual engagement within one year of such employment or engagement.

13.          Right to Injunction.  The parties hereto acknowledge that the services to be rendered by the Contractor under this Agreement and the rights and privileges granted to the Company under the Agreement are of a special, unique, unusual, and extraordinary character which gives them a peculiar value, the loss of which cannot be reasonably or adequately compensated by damages in any action at law, and the breach by the Contractor of any of the provisions of this Agreement will cause the Company irreparable injury and damage.  The Contractor expressly agrees that the Company shall be entitled to injunctive and other equitable relief in the event of, or to prevent, a breach of any provision of this Agreement by the Contractor.  Resort to such equitable relief, however, shall not be construed to be a waiver of any other rights or remedies that the Company may have for damages or otherwise.  The various rights and remedies of the Company under this Agreement or otherwise shall be construed to be cumulative, and no one of the them shall be exclusive of any other or of any right or remedy allowed by law.

14.          Warranties; Indemnification. Contractor warrants and represents that (a) Contractor has the full power and authority to enter into and execute this Agreement and to convey the rights granted herein, and that such rights are not now subject to prior assignment, transfer or other encumbrance; (b) the Work Product is the original and unpublished work of Contractor; (c) the Work Product does not infringe the copyright or violate any proprietary rights, rights of privacy or publicity, or any other rights of any third party, and does not contain any material that is libelous or otherwise contrary to law; and (d) all statements in the Work Product asserted as fact are either true or based upon generally accepted professional research practices, and no formula or procedure contained therein would cause injury if used in accordance with the instructions and/or warnings included in the Work Product. In the event that Contractor is in breach of any of the aforementioned warranties or representations, Contractor shall indemnify and hold harmless the Company, its affiliates, assigns and licensees, against any losses, liabilities, damages, costs and expenses (including legal costs and expenses) arising from or resulting out of any claim or demand of any kind relating to such breach.

15.          Termination.  The Company may terminate this Agreement at any time by 2 working days' written notice to the Contractor via email, facsimile, or other acceptable manner of transmission.  In addition, if the Contractor is convicted of any crime or offense, fails or refuses to comply with the written policies or reasonable directive of the Company, is guilty of serious misconduct in connection with performance hereunder, or materially breaches provisions of this Agreement, the Company at any time may terminate the engagement of the Contractor immediately and without prior written notice to the Contractor.

16.          Successors and Assigns.  All of the provisions of this Agreement shall be binding upon and inure to the benefit of the parties hereto and their respective heirs, if any, successors, and assigns.

17.          Choice of Law.  The laws of the District of Columbia shall govern the validity of this Agreement, the construction of its terms and the interpretation of the rights and duties of the parties hereto.

18.          Headings.  Section headings are not to be considered a part of this Agreement and are not intended to be a full and accurate description of the contents hereof.

19.          Waiver.  Waiver by one party hereto of breach of any provision of this Agreement by the other shall not operate or be construed as a continuing waiver.

20.          Assignment.  The Contractor shall not assign any of [his or her] rights under this Agreement, or delegate the performance of any of [his or her] duties hereunder, without the prior written consent of the Company.  Contractor is free to hire additional persons at his/her discretion. Such engagements shall not bind the Company in any way and the company is not liable for any acts or omissions of additional persons hired by Contractor.

21.          Notice. All notices, requests, demands, or other communication under this Agreement shall be in writing. Notice shall be sufficiently given for all purposes by email or facsimile. An email or facsimile received after 5:00 p.m. (EST) shall be deemed received on the next business day. Emails and facsimiles shall be effective upon receipt, provided that the Company reserves the right to request that a duplicate copy be promptly given by first class registered or certified mail, return receipt requested, postage prepaid and addressed as follows:

ATTN: Farhan Daredia

2200 Pennsylvania Ave NW #4075

Washington, DC 20037

22.          Modification or Amendment.  No amendment, change or modification of this Agreement shall be valid unless in writing signed by the parties hereto.

23.          Execution and Counterparts. This Agreement may be executed in counterparts, each of which shall be deemed the original, all of which together shall constitute one and the same instrument, and a faxed or electronic copy shall be deemed as an original, however, the Company reserves the right to request a hard-copy of the signed agreement from Contractor.

24.          General Terms & Conditions.

a.            This Agreement constitutes the entire agreement between Contractor and the Company, and supersedes all prior agreements, representations and understandings of the parties whether written or oral. No amendment, supplement, or modification of this Agreement shall be effective unless executed in writing by both the Company and Contractor.

b.            Company may assign this Agreement by providing thirty (30) days written notice to Contractor. Such assignment will be subject to Contractor's written consent, which shall not be unreasonably withheld or delayed.

c.             The invalidity or unenforceability of any particular provision of this Agreement shall not affect the other provisions, and this Agreement shall be construed in all respects as if any invalid or unenforceable provision were omitted.

d.            Contractor has entered into this Agreement freely and voluntarily and has either consulted with independent legal counselor or has had the opportunity to do so prior to this agreement’s execution.

e.            The validity, interpretation, performance and enforcement of this Agreement shall be governed by the laws of the District of Columbia without regard to the conflicts of laws principles thereof that would give rise to the application of the domestic substantive law of any other jurisdiction.

f.             Any controversy or claim arising out of or relating to this Agreement, or the breach thereof, shall be settled by arbitration in Washington, District of Columbia and administered by the American Arbitration Association in accordance with its then-existing Commercial Arbitration Rules. The award rendered by the arbitrator or arbitrators shall be final, and judgment may be entered upon it in accordance with applicable law in any court having jurisdiction thereof. Each party consents to, and waives any right to object to, jurisdiction with respect to the resolution of disputes hereunder in Washington, District of Columbia. In any legal action or other proceedings (including arbitration proceedings) between the parties, the prevailing party shall be entitled to recover from the non-prevailing party all reasonable costs and expenses incurred in such action or proceeding, including without limitation reasonable attorneys' fees and costs.

 


 

EXHIBIT A – DUTIES, TERM, AND COMPENSATION

DUTIES:               

1. The Contractor will instruct fellow students to rent textbooks from BookstoreGenie.com on a commission basis using Contractor’s “Genie Code” and will report directly to Campus Manager and to any other party designated by Bookstore Genie in connection with the performance of the duties under this Agreement and shall fulfill any other duties reasonably requested by the Company and agreed to by the Contractor 

2. The Contractor will purchase textbooks from students on a commission basis and will report directly to Campus Manager and to any other party designated by Bookstore Genie in connection with the performance of the duties under this Agreement and shall fulfill any other duties reasonably requested by the Company and agreed to by the Contractor.

TERM:                  

1.       This engagement shall commence two weeks before the beginning of classes, for a period of four weeks.

2.       This engagement shall commence upon the arrival of "Buying Season," defined as 2 days prior to the first final exam of the term and shall continue in full force and effect through the end of "Buying Season," defined as 1 day after the last final exam of the term. The Agreement may not be extended.  There is no continuous relationship between Contractor and the Company.

ON-CAMPUS SALES REP (i.e., “GENIE REP”) COMPENSATION:    

Contractor shall be compensated a flat-rate commission of 8% for facilitated rental orders placed at BookstoreGenie.com as a result of Contractor’s referral/marketing efforts.  Contractor’s Uniquie “Genie Code” (a specific and unique value set by Contractor) is the sole method for Company to identify Contractor’s referral customers.  Without said “Genie Code” Company has no way to identify which web orders to pay Contractor for.  Contractor understands that is solely the Contractor’s responsibility to ensure his/her referral customers do in-fact use his/her specific and unique Genie Code.  Furthermore, Contractor hereby acknowledges and understands that Company shall not pay any commission for any BookstoreGenie.com transactions which did not involve the use Contractor’s unique Genie Code.  Company is not responsible for Contractor’s referrals failure to use the proper Genie Code at time of checkout on BookstoreGenie.com, and Contractor understands that Company has no means to identify a web transaction after it has already been processed without Contractor’s specific and unique Genie Code.

BUYBACK REP COMPENSATION:              

Contractor shall be compensated on a commission basis solely dependent upon the value of books purchased during the "Buying Season."  Books must be purchased according to the pricing set forth on the company’s website, which shall be retrieved through a smartphone web-app designated by Bookstore Genie.



BUYBACK REP COMPENSATION CHART:

Value of Books Purchased ($)		% Commission Earned		Range of Compensation Paid
0 - $7,500               				10%						$0 - 750
$7,501 – 10,000				11%						$825.11 – 1,100
$10,001 – 15,000            		12.5%          				$1250.13 – 1,875
$15,001 +					15%						$2,250.15 +
 

IN WITNESS WHEREOF the undersigned have executed this Agreement as of the day and year first written above on Page 1 of 1.  The parties hereto agree that facsimile signatures shall be as effective as if originals.	
		
		
		</textarea>
			</div>

           <div class="line"></div>

            <form method='post' name='agreement' action=''>

            <p class="centerThat">School served: <input type="text" name="ic_schoolname" id="textfield" class="green" size='40' value='' /></p>

                
                  
                      <h2 class="redLabel centerThat"><p class="red centerThat">By clicking the box below and entering your full name in the space provided, you are entering into a legally binding contract.
                  Upon completion of this form, Bookstore Genie, LLC will keep a digital record of your contract and your consent
                  that the digital signature below is enforceable as a facsimile signature.</p>Check the following box to indicate your agreement to the terms of the contract: <input class="checkbox" type="checkbox" name="ic_check" id="checkbox"  /></h2>
                      
                
                <p class="centerThat">Independent Contractor (Your full name): <input name="ic_name_check" type="text" class="orange" value='' /></p>
                
                <div class="line"></div>
                
                <p class="centerThat">At the conclusion of the renting season, Bookstore Genie will issue a commission payment via Paypal. This check will be mailed between October 1 and October 15 (Fall semesters), or between February 1 and February 15 (Spring semesters).</p>
                  
                <h3 class="centerThat">Please confirm the e-mail address you would like your Paypal payment sent to</h3>
                
                <p class="centerThat">We also requirethat you confirm the cell phone number and email address for contacting you and sending email reminders. </p>  
                
                <div class="outside">
		    <!-- To copy the form HTML, start here -->
		    <div class="iphorm-outer">
				    <div class="iphorm-wrapper">
			        <div class="iphorm-inner">
		                   <div class="iphorm-message"></div>
			               <div class="iphorm-container clearfix">
			                    <!-- Begin Name element -->
		                        <div class="element-wrapper name-element-wrapper clearfix">
		                            <label for="name">First Name <span class="red">*</span></label>
		                            <div class="input-wrapper name-input-wrapper">
		                                <input class="name-element" id="firstname" type="text" name="name" />
		                            </div>
		                        </div>
		                        <!-- End Name element -->
		                        <!-- Begin Name element -->
		                        <div class="element-wrapper name-element-wrapper clearfix">
		                            <label for="name">Last Name <span class="red">*</span></label>
		                            <div class="input-wrapper name-input-wrapper">
		                                <input class="name-element" id="name" type="text" name="name" />
		                            </div>
		                        </div>
		                        <!-- End Name element -->
		                        <!-- Begin Email element -->
		                        <div class="element-wrapper email-element-wrapper clearfix">
		                            <label for="email">Email <span class="red">*</span></label>
		                            <div class="input-wrapper email-input-wrapper">
		                                <input class="email-element iphorm-tooltip" id="email" type="text" name="email" title="We will never send you spam, we value your privacy as much as our own" />
		                            </div>
		                        </div>
		                        <!-- End Email element -->
		                        
		                        <!-- Begin Email element -->
		                        <div class="element-wrapper email-element-wrapper clearfix">
		                            <label for="email">Paypal Email <span class="red">*</span></label>
		                            <div class="input-wrapper email-input-wrapper">
		                                <input class="email-element iphorm-tooltip" id="ppemail" type="text" name="Paypalemail" title="We will never send you spam, we value your privacy as much as our own" />
		                            </div>
		                        </div>
		                        <!-- End Email element -->
		                        <!-- Begin Phone element -->
		                        <div class="element-wrapper phone-element-wrapper clearfix">
		                            <label for="phone">Phone</label>
		                            <div class="input-wrapper phone-input-wrapper">
		                                <input class="phone-element iphorm-tooltip" id="phone" type="text" name="phone" title="We will only use your phone number to contact you regarding your enquiry" />
		                            </div>
		                        </div>
		                        <!-- End Phone element -->
		                        <!-- Begin Name element -->
		                        <div class="element-wrapper name-element-wrapper clearfix">
		                            <label for="name">Genie Code <span class="red">*</span></label>
		                            <div class="input-wrapper name-input-wrapper">
		                                <input class="name-element" id="code" type="text" name="name" />
		                            </div>
		                        </div>
		                        <!-- End Name element -->
		                        <!-- begin address container -->
		                        <div class="addressContainer">
		                        
			                        <!-- Begin Address element -->
			                        <div class="element-wrapper address-element-wrapper clearfix">
			                            <label for="address">Address <span class="red">*</span></label>
			                            <div class="input-wrapper name-input-wrapper">
			                                <input class="address-element" id="address" type="text" name="address" />
			                            </div>
			                        </div>
			                        <!-- End Address element -->
			                        <!-- Begin Address element -->
			                        <div class="element-wrapper city-element-wrapper clearfix">
			                            <label for="city">City <span class="red">*</span></label>
			                            <div class="input-wrapper city-input-wrapper">
			                                <input class="city-element" id="city" type="text" name="city" />
			                            </div>
			                        </div>
			                        <!-- End Address element -->
			                        <!-- Begin Zip element -->
			                        <div class="element-wrapper zipcode-element-wrapper clearfix">
			                            <label for="zip">Zip Code <span class="red">*</span></label>
			                            <div class="input-wrapper zipcode-input-wrapper">
			                                <input class="zipcode-element" id="zip" type="text" name="zip" />
			                            </div>
			                        </div>
			                        <!-- End Zip element -->
			                        <!-- Begin State element -->
			                        <div class="element-wrapper state-element-wrapper clearfix">
			                            <label for="state">State <span class="red">*</span></label>
			                            <div class="input-wrapper state-input-wrapper clearfix">
			                                <select id="state" name="state">
			                                    <option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="DC">Dist of Columbia</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
												<option value="MA">Massachusetts</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MS">Mississippi</option>
												<option value="MO">Missouri</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NV">Nevada</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NY">New York</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WA">Washington</option>
												<option value="WV">West Virginia</option>
												<option value="WI">Wisconsin</option>
												<option value="WY">Wyoming</option>
			                                </select>
			                            </div>
			                        </div>
			                        <!-- End Subject element -->
		                        </div>
		                        <!-- end address container -->
			               </div>
			           </div>
				   </div>
			</div>
			<!-- To copy the form HTML, end here -->
		</div> <!-- end outer -->

				<div style="clear:both;"></div> 

                <div class="line"></div>

                
                <p class="centerThat">We require Social Security numbers for all independent contractors;
                  if you earn more than $600 in a calendar year,
                  Bookstore Genie will submit mandatory paperwork to the IRS.
                  Your Social Security number will be encrypted and stored in a secure database,
                  and accessed only for IRS tax purposes. Bookstore Genie will never relinquish
                  your personal information to any third party.</p>
                  
            <div class="outside">
		    <!-- To copy the form HTML, start here -->
		    <div class="iphorm-outer">
				    <div class="iphorm-wrapper">
			        <div class="iphorm-inner">
		                   <div class="iphorm-message"></div>
			               <div class="iphorm-container clearfix">
			                    <!-- Begin Name element -->
		                        <div class="element-wrapper name-element-wrapper clearfix">
		                            <label for="name">SSN <span class="red">*</span></label>
		                            <div class="input-wrapper name-input-wrapper">
		                                <input class="name-element" id="ssn" type="text" name="name" />
		                            </div>
		                        </div>
		                        <!-- End Name element -->
		                        <!-- Begin Submit button -->
		                        <div class="button-wrapper submit-button-wrapper clearfix">
		                            <div class="loading-wrapper"><span class="loading">Please wait…</span></div>
		                            <div class="button-input-wrapper submit-button-input-wrapper">
		                                <input class="submit-element" type="submit" name="contact" value="Submit Application" 
		                                onclick = "var agreement = 0;
		                                if(document.agreement.ic_check.checked == true){agreement = 1;} 
		                                var address = document.getElementById('address').value;
		                                var email = document.getElementById('email').value;
		                                var code = document.getElementById('code').value;
		                                var city = document.getElementById('city').value;
		                                var state = document.getElementById('state').value;
		                                var zip = document.getElementById('zip').value;
		                                var ssn = document.getElementById('ssn').value;
		                                var firstname = document.getElementById('firstname').value;
		                                xajax_verifyUser(agreement, address, email, code, city,state,zip,ssn,firstname);
		                                return false;
		                                " />
		                            	
		                            </div>
		                        </div>
		                        <!-- End Submit button -->
		                        
			               </div>
			               <div id="userStatus"></div>
			           </div>
				   </div>
			</div>
			<!-- To copy the form HTML, end here -->
		</div> <!-- end outer -->
		
		</form>
		
		<div style="clear:both;"></div> 
				
	</div> <!-- end wrap -->
	
		<div class="footer">  <!-- begin footer -->
		
		<a href="http://www.bookstoregenie.com" title="BookStoreGenie" id="footerLogo">BookStoreGenie</a> 
		
			<!-- <ul> 
				<li><a href="about.html">About Us</a></li> 
				<li><a href="#" title="Sell Books">Sell Books</a></li> 
				<li><a href="#" title="Buy Books">Buy Books</a></li> 
				<li><a href="#" title="">Terms of Privacy</a></li> 
				<li><a href="#" title="">Terms and Conditions</a></li> 
			</ul> -->
			
			<div style="clear:both;"></div> 
			
		</div> <!-- end footer -->
	
	<script type="text/javascript" src="//asset0.zendesk.com/external/zenbox/v2.1/zenbox.js"></script>
	<style type="text/css" media="screen, projection">
	  @import url(//asset0.zendesk.com/external/zenbox/v2.1/zenbox.css);
	</style>
	<script type="text/javascript">
	  if (typeof(Zenbox) !== "undefined") {
	    Zenbox.init({
	      dropboxID:   "20019273",
	      url:         "https://bookstoregenie.zendesk.com",
	      tabID:       "support",
	      tabColor:    "blue",
	      tabPosition: "Right"
	    });
	  }
	</script>
		
	
	<!-- begin olark code -->
	<script type='text/javascript'>/*{literal}<![CDATA[*/window.olark||(function(i){var e=window,h=document,a=e.location.protocol=="https:"?"https:":"http:",g=i.name,b="load";(function(){e[g]=function(){(c.s=c.s||[]).push(arguments)};var c=e[g]._={},f=i.methods.length; while(f--){(function(j){e[g][j]=function(){e[g]("call",j,arguments)}})(i.methods[f])} c.l=i.loader;c.i=arguments.callee;c.f=setTimeout(function(){if(c.f){(new Image).src=a+"//"+c.l.replace(".js",".png")+"&"+escape(e.location.href)}c.f=null},20000);c.p={0:+new Date};c.P=function(j){c.p[j]=new Date-c.p[0]};function d(){c.P(b);e[g](b)}e.addEventListener?e.addEventListener(b,d,false):e.attachEvent("on"+b,d); (function(){function l(j){j="head";return["<",j,"></",j,"><",z,' onl'+'oad="var d=',B,";d.getElementsByTagName('head')[0].",y,"(d.",A,"('script')).",u,"='",a,"//",c.l,"'",'"',"></",z,">"].join("")}var z="body",s=h[z];if(!s){return setTimeout(arguments.callee,100)}c.P(1);var y="appendChild",A="createElement",u="src",r=h[A]("div"),G=r[y](h[A](g)),D=h[A]("iframe"),B="document",C="domain",q;r.style.display="none";s.insertBefore(r,s.firstChild).id=g;D.frameBorder="0";D.id=g+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){D.src="javascript:false"} D.allowTransparency="true";G[y](D);try{D.contentWindow[B].open()}catch(F){i[C]=h[C];q="javascript:var d="+B+".open();d.domain='"+h.domain+"';";D[u]=q+"void(0);"}try{var H=D.contentWindow[B];H.write(l());H.close()}catch(E){D[u]=q+'d.write("'+l().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}c.P(2)})()})()})({loader:(function(a){return "static.olark.com/jsclient/loader0.js?ts="+(a?a[1]:(+new Date))})(document.cookie.match(/olarkld=([0-9]+)/)),name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('1395-504-10-7822');/*]]>{/literal}*/</script>
<!-- end olark code -->

	<script type="text/javascript">
	    var GoSquared={};
	    GoSquared.acct = "GSN-024018-M";
	    (function(w){
	        function gs(){
	            w._gstc_lt=+(new Date); var d=document;
	            var g = d.createElement("script"); g.type = "text/javascript"; g.async = true; g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
	            var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(g, s);
	        }
	        w.addEventListener?w.addEventListener("load",gs,false):w.attachEvent("onload",gs);
	    })(window);
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

		});
	</script>
	
</body> 
</html> 