<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Add Organization</title>
		<meta name="robots" content="noindex" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
		<script src="script/jquery.jqtransform.js" type = "text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" type="text/javascript"></script>
		<script src = "script/jquery.loading.1.6.4.js" type = "text/javascript"></script>
		<script src="script/jqueryform.js" type = "text/javascript"></script>
		<link rel = "stylesheet" href = "style/main.css" />
		<link rel = "stylesheet" href=  "style/add_organization.css" />
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />
		<link rel = "stylesheet" type = "text/css" href = "style/jquery.loading.1.6.css"></script>
		<link rel = "stylesheet" href = "style/jqtransform.css" />
		<!--[if lte IE 7]>
		<style>
		#interfaceContainer{
			background-image: url(../images/interfacebg.png);
			width: 928px;
			height: 286px;
			text-align: left;
			font-family: Arial;
			margin-left: 50px;
			margin-top: 30px;
		}
		#isbnContainer{
			background-image: url(../images/isbnbg.png);
			width: 928px;
			height: 170px;
			margin-left: 50px;
			margin-top: 30px;
			float: left;
		}
		#search{
			font-size: 20px;
			font-family: Verdana, Geneva, sans-serif;
			background: none;
			border: none transparent;
			width: 620px;
			height: 34px;
			float: left;
			position: relative;
			z-index: 10;
			padding-left: 10px;
			position: relative;
			left: -60px;
		}
		</style>
		<![endif]-->
		<script type = "text/javascript">
		var checked = false;
		function College(name, dbName, isbn, link){
			this.name   = name;
			this.dbName = dbName;
			this.isbn   = isbn;
			this.link   = link;
		}
			var colleges = new Array(), data = new Array(), popupStatus = 0;  ;
			window.onload = function(){
				if ($("#search").val() !=  ""){
					$("#firstForm").slideDown(600);
					$("#secondaryForm").slideDown(600);
					$("#checkForm").jqTransform();
					$("#secondaryForm").jqTransform();
					$("html, body").animate({
						scrollTop: $("#firstForm").offset().top
					}, 600);
					setLabels();
				}
				$("#accept").click(function(){
					if (!checked)
						checked = true;
					else
						checked = false;
				});
				$("#secondaryForm").ajaxForm({
					"beforeSubmit": function(){
						if (checked){
							if ($("#accountNum").val() != $("#accountNum2").val()){
								$("#popupTitle").html("Error");
								$("#contactArea").html("Account Numbers do not match");
								centerPopup();
								loadPopup();
								$("#popupContactClose").click(function(){  
									disablePopup();  
								});  
								//Click out event
								$("#backgroundPopup").click(function(){  
									disablePopup();  
								});  
								//Press Escape event
								$(document).keypress(function(e){  
									if(e.keyCode==27 && popupStatus==1){  
										disablePopup();  
									}  
								});  
								$("html, body").animate({
							scrollTop: $("#popupTitle").offset().top - 30
						}, 600);
								return false;
							}
							$.loading(true, {mask:true, img: "images/loading.gif", align: "center"});
						}else{
							$("#popupTitle").html("Error");
							$("#contactArea").html("You must accept the agreement before you can submit the form");
							centerPopup();
							loadPopup();
							$("#popupContactClose").click(function(){  
								disablePopup();  
							});  
							//Click out event
							$("#backgroundPopup").click(function(){  
								disablePopup();  
							});  
							//Press Escape event
							$(document).keypress(function(e){  
								if(e.keyCode==27 && popupStatus==1){  
									disablePopup();  
								}  
							});  
							$("html, body").animate({
							scrollTop: $("#popupTitle").offset().top - 30
						}, 600);
							return false;
						}
					},
					"success" : function(response){
						$.loading(false);
						$("#popupTitle").html("Registration successful");
						$("#contactArea").html("Thank you, You have been successfully registered.");
						centerPopup();
						loadPopup();
						$("#popupContactClose").click(function(){  
							disablePopup();  
						});  
						//Click out event
						$("#backgroundPopup").click(function(){  
							disablePopup();  
						});  
						//Press Escape event
						$(document).keypress(function(e){  
							if(e.keyCode==27 && popupStatus==1){  
								disablePopup();  
							}  
						});  
						$("html, body").animate({
							scrollTop: $("#popupTitle").offset().top - 30
						}, 600);
					}
				});
				$.ajax({
					url: "portal.php",
					type: "POST",
					data: {req: "school"},
					success: function(transport){
						var transport = eval ("(" + transport + ")");
						for (var i = 0; i < colleges.length; i++){
							data.push(colleges[i].name);
						}
						for (var i = 0; i < transport.length; i++){
							colleges.push(new College(transport[i][0], "", true, transport[i][1]));
							data.push(transport[i][0]);
						}
						data.sort();
						//AutoComplete_Create('search', data);'
						autocomplete = $("#search").autocomplete({
							source: data
						});
						$("#search").bind("autocompleteopen", function(event, ui){
							$("<li class='ui-menu-item' role='menuitem'>Can't find your University?</li>").appendTo(autocomplete);
						});
					},
					faliure: function(){
						alert("Unable to retrieve school information. Check your internet connection.");
					}
				});

				colleges.push(new College("University of Wisconsin Madison", "wisc", false, ""));
			};
			function setLabels(){
				 var max = 0;
				 $("label").each(function(){
					 if ($(this).width() > max)
						 max = $(this).width();    
				});
				 $("label").width(max);
			 };
			function clearUniversity(){
				if ($("#search").val() == "Type in your University")
					document.getElementById('search').value='';
			}
			function goClick(){
				$("#universityInput").val($("#search").val());
				$("#firstForm").slideDown(600);
				$("#secondaryForm").slideDown(600);
				$("#checkForm").jqTransform();
				$("#secondaryForm").jqTransform();
				$("html, body").animate({
					scrollTop: $("#firstForm").offset().top
				}, 600);
				setLabels();
			}
			function loadPopup(){  
				//loads popup only if it is disabled  
				if(popupStatus==0){  
					$("#backgroundPopup").css({  
						"opacity": "0.7"  
					});  
					$("#backgroundPopup").fadeIn("slow");  
					$("#popupContact").fadeIn("slow");  
					popupStatus = 1;  
				}  
			}
			function disablePopup(){  
				//disables popup only if it is enabled  
				if(popupStatus==1){  
					$("#backgroundPopup").fadeOut("slow");  
					$("#popupContact").fadeOut("slow");  
					popupStatus = 0;  
				}  
			}  			
			function centerPopup(){  
				//request data for centering  
				var windowWidth = document.documentElement.clientWidth;  
				var windowHeight = document.documentElement.clientHeight;  
				var popupHeight = $("#popupContact").height();  
				var popupWidth = $("#popupContact").width();  
				//centering  
				$("#popupContact").css({  
					"position": "absolute",  
					"top": windowHeight/2-popupHeight/2,  
					"left": windowWidth/2-popupWidth/2  
				});  
				//only need force for IE6    
				$("#backgroundPopup").css({  
					"height": windowHeight  
				});
			}
			function changeSearch(text){
				$("#search").val(text);
			}
			function setSignature(){
				$("#realSignature").val(("#signature").val());
			}
		</script>
	</head>
	<body>
		<div id = "bg"><img id = "background_image" src = "images/background.png" width = "100%" height = "100%" /></div>
		<div id = "wrapper">
			<div id = "header">
			   <img id = "logo_img" src = "images/logo.png" />
					<!--<img id = "nav_img" src = "images/nav.png" usemap = "#nav_map" border = "0" />-->
				<map name = "nav_map">
				  <area shape = "rect" coords = "0,0,57,16" href = "index.html">
				  <area shape = "rect" coords = "57,0,144,16" href = "about.html">
				</map>
			</div>
			<div id = "update"></div>
			<div id = "content">
				<ol id = "content_top" class = "content_list">
					<li class = "content_list_item"><img id = "genie" src = "images/genie.png" /></li>
					<li class = "content_list_item"><img id = "bubble" src = "images/bubble.png" /></li>
				</ol>
				<ol id = "content_bottom_index" class = "content_list">
					<li id = "search_item" class = ""><div id = "searchContainer" class = "text"><input id = "search" onfocus = "clearUniversity()" name = "university" type = "text" title = "Search your University!" value = "<?php echo $_REQUEST['university']; ?>"></input></div>
						<img id = "goImg" class = "hand" src = "images/next_step.png" onClick = "goClick()" />
						<div id = "popSearches">Popular Searches: "<span class = "popular hand" onClick = "changeSearch('George Washington University')">George Washington University</span>", "<span class = "popular hand" onClick = "changeSearch('Emory University')">Emory</span>", "<span class = "popular hand" onClick = "changeSearch('Berkeley')">Berkeley</span>"</div>
					</li>
				</ol>
				<div style = "display:none; padding-left: 100px; text-align: center; padding-right: 15px; width: 677px;" id = "firstForm" class = "bigForm">
				<div style = "color: RED; font-size: large;">Please read this agreement entirely and carefully. Once digitally signed and the submit button is pressed, it is a legally binding contract. </div>
									<div class = "rowElem"><textarea rows = "14" cols = "80">INDEPENDENT CONTRACTOR AGREEMENT
This Agreement is entered into as of March 5, 2011, between Bookstore Genie, a subsidiary of College Essentials, Inc ("the Company") and the Contractor. 
1.	Independent Contractor.  Subject to the terms and conditions of this Agreement, the Company hereby engages the Contractor as an independent contractor to perform the services set forth herein, and the Contractor hereby accepts such engagement.
2.	Duties, Term, and Compensation.  The Contractor's duties, term of engagement, compensation and provisions for payment thereof shall be as set forth in the rider which is attached as Exhibit A, which may be amended in writing from time to time.
3.	Taxes.  No taxes shall be withheld from compensation.  Contractor is solely responsible for any and all taxes that arise as a result of this Agreement.  Any Contractor earning more than $600 in a calendar year will be served with a 1099 to reflect the outcome of this Agreement.	
4.	Expenses.  During the term of this Agreement, the Contractor shall pay all expenses out of pocket.  Expenses incurred as a result of this Agreement are the sole responsibility of the Contractor.
5.	Financial Responsibility.  Contractor will purchase books according to Company's guidelines.  If it becomes apparent that Contractor has not delivered appropriate number of books or returned appropriate amount of cash, Contractor agrees to reimburse the company for the difference.
6.	Written Reports.  Contractor is not responsible for any written reports.
7.	Hours.  Contractor may work any and all hours desired during the Term.  Such hours may not be controlled or otherwise influenced by the Company.
8.	Methods.  Methods will not be governed by the Company.  Contractor may devise and implement such methods at will, given that the ultimate outcome is in accordance with Company guidelines.  Company will give instruction in a good faith effort to maximize Contractor's earning power.
9.	University Policies.  Contractor is expected to abide by all University policies governing student behavior.  Existence of this Agreement shall not in any way protect Contractor.  Company cannot be responsible for the behavior of Contractor, whether carrying out the duties of this Agreement or not.
10.	Inventions.  Any and all inventions, discoveries, developments and innovations conceived by the Contractor during this engagement relative to the duties under this Agreement shall be the exclusive property of the Company; and the Contractor hereby assigns all right, title, and interest in the same to the Company.  Any and all inventions, discoveries, developments and innovations conceived by the Contractor prior to the term of this Agreement and utilized by [him or her] in rendering duties to the Company are hereby licensed to the Company for use in its operations and for an infinite duration.  This license is non-exclusive, and may be assigned without the Contractor's prior written approval by the Company to a wholly-owned subsidiary of the Company.
11.	Confidentiality. The Contractor acknowledges that during the engagement [he or she] will have access to and become acquainted with various trade secrets, inventions, innovations, processes, information, records and specifications owned or licensed by the Company and/or used by the Company in connection with the operation of its business including, without limitation, the Company's business and product processes, methods, customer lists, accounts and procedures.  The Contractor agrees that [he or she] will not disclose any of the aforesaid, directly or indirectly, or use any of them in any manner, either during the term of this Agreement or at any time thereafter, except as required in the course of this engagement with the Company.  All files, records, documents, blueprints, specifications, information, letters, notes, media lists, original artwork/creative, notebooks, and similar items relating to the business of the Company, whether prepared by the Contractor  or otherwise coming into [his or her] possession, shall remain the exclusive property of the Company.  The Contractor shall not retain any copies of the foregoing without the Company's prior written permission.  Upon the expiration or earlier termination of this Agreement, or whenever requested by the Company, the Contractor shall immediately deliver to the Company all such files, records, documents, specifications, information, and other items in [his or her] possession or under [his or her] control.  The Contractor further agrees that [he or she] will not disclose [his or her] retention as an independent contractor or the terms of this Agreement to any person without the prior written consent of the Company and shall at all times preserve the confidential nature of [his or her] relationship to the Company and of the services hereunder.
12.	Conflicts of Interest; Non-hire Provision.  The Contractor represents that [he or she] is free to enter into this Agreement, and that this engagement does not violate the terms of any agreement between the Contractor and any third party.  Further, the Contractor, in rendering [his or her] duties shall not utilize any invention, discovery, development, improvement, innovation, or trade secret in which [he or she] does not have a proprietary interest.  During the term of this agreement, the Contractor shall devote as much of [his or her] productive time, energy and abilities to the performance of [his or her] duties hereunder as is necessary to perform the required duties in a timely and productive manner.  The Contractor is expressly free to perform services for other parties while performing services for the Company.  For a period of six months following any termination, the Contractor shall not, directly or indirectly hire, solicit, or encourage to leave the Company's employment, any employee, consultant, or contractor of the Company or hire any such employee, consultant, or contractor who has left the Company's employment or contractual engagement within one year of such employment or engagement.
13.	Right to Injunction.  The parties hereto acknowledge that the services to be rendered by the Contractor under this Agreement and the rights and privileges granted to the Company under the Agreement are of a special, unique, unusual, and extraordinary character which gives them a peculiar value, the loss of which cannot be reasonably or adequately compensated by damages in any action at law, and the breach by the Contractor of any of the provisions of this Agreement will cause the Company irreparable injury and damage.  The Contractor expressly agrees that the Company shall be entitled to injunctive and other equitable relief in the event of, or to prevent, a breach of any provision of this Agreement by the Contractor.  Resort to such equitable relief, however, shall not be construed to be a waiver of any other rights or remedies that the Company may have for damages or otherwise.  The various rights and remedies of the Company under this Agreement or otherwise shall be construed to be cumulative, and no one of the them shall be exclusive of any other or of any right or remedy allowed by law.
14.	Hold Harmless Provision.  Contractor shall indemnify and save harmless Company from and against all claims for bodily injuries and damage of property in connection with the performance of this contract.
15.	Termination.  The Company may terminate this Agreement at any time by 10 working days' written notice to the Contractor.  In addition, if the Contractor is convicted of any crime or offense, fails or refuses to comply with the written policies or reasonable directive of the Company, is guilty of serious misconduct in connection with performance hereunder, or materially breaches provisions of this Agreement, the Company at any time may terminate the engagement of the Contractor immediately and without prior written notice to the Contractor.
16.	Independent Contractor.  This Agreement shall not render the Contractor an employee, partner, agent of, or joint venturer with the Company for any purpose.  The Contractor is and will remain an independent contractor in [his or her] relationship to the Company.  The Company shall not be responsible for withholding taxes with respect to the Contractor's compensation hereunder.  The Contractor shall have no claim against the Company hereunder or otherwise for vacation pay, sick leave, retirement benefits, social security, worker's compensation, health or disability benefits, unemployment insurance benefits, or employee benefits of any kind.
17.	Successors and Assigns.  All of the provisions of this Agreement shall be binding upon and inure to the benefit of the parties hereto and their respective heirs, if any, successors, and assigns.
18.	Choice of Law.  The laws of the state of Pennsylvania shall govern the validity of this Agreement, the construction of its terms and the interpretation of the rights and duties of the parties hereto.
19.	Arbitration. Any controversies arising out of the terms of this Agreement or its interpretation shall be settled in the District of Columbia in accordance with the rules of the American Arbitration Association, and the judgment upon award may be entered in any court having jurisdiction thereof.
20.	Headings.  Section headings are not to be considered a part of this Agreement and are not intended to be a full and accurate description of the contents hereof.
21.	Waiver.  Waiver by one party hereto of breach of any provision of this Agreement by the other shall not operate or be construed as a continuing waiver.
22.	Assignment.  The Contractor shall not assign any of [his or her] rights under this Agreement, or delegate the performance of any of [his or her] duties hereunder, without the prior written consent of the Company.  Contractor is free to hire additional persons at his/her discretion.  Such engagements shall not bind the Company in any way.
23.	Notices.  Any and all notices, demands, or other communications required or desired to be given hereunder by any party shall be in writing and shall be validly given or made to another party if personally served, or if deposited  in the United States mail, certified or registered, postage prepaid, return receipt requested.  If such notice or demand is served personally, notice shall be deemed constructively made at the time of such personal service.  If such notice, demand or other communication is given by mail, such notice shall be conclusively deemed given five days after deposit thereof in the United States mail addressed to the party to whom such notice, demand or other communication is to be given as follows:
	If to the Contractor: (Address in the form below)
	If to the Company:		Bookstore Genie
					825 New Hampshire Ave. NW
					#105
					Washington, DC 20037
	Any party hereto may change its address for purposes of this paragraph by written
	notice given in the manner provided above.
24.	Modification or Amendment.  No amendment, change or modification of this Agreement shall be valid unless in writing signed by the parties hereto.
25.	Entire Understanding.  This document and any exhibit attached constitute the entire understanding and agreement of the parties, and any and all prior agreements, understandings, and representations are hereby terminated and canceled in their entirety and are of no further force and effect.
26.	Unenforceability of Provisions.  If any provision of this Agreement, or any portion thereof, is held to be invalid and unenforceable, then the remainder of this Agreement shall nevertheless remain in full force and effect.
27.	Scanner Rental.
Independent Contractor hereby agrees to take responsibility for ONE College Essentials, Inc company scanner for use during the "Buying Season."
Should the CS3070 scanner be lost, stolen, damaged or otherwise rendered unusable during Independent Contractor's custody, Independent Contractor agrees to reimburse the Company in the amount of $300.00.
28.	Conclusion.
EXHIBIT A
DUTIES, TERM, AND COMPENSATION
DUTIES: 	The Contractor will purchase textbooks from students on a commission basis.  [He or she] will report directly to Campus Manager and to any other party designated by Bookstore Genie in connection with the performance of the duties under this Agreement and shall fulfill any other duties reasonably requested by the Company and agreed to by the Contractor.
TERM:	This engagement shall commence upon the arrival of "Buying Season," defined as 2 days prior to the first final exam of the term and shall continue in full force and effect through the end of "Buying Season," defined as 1 days after the last final exam of the term.
The Agreement may not be extended.  There is no continuous relationship between Contractor and the Company.
COMPENSATION:
		Contractor will be compensated on a commission basis solely dependent upon the value of books purchased during the "Buying Season."  Books must be purchased according to the pricing set forth on the company’s website, which shall be retrieved from www.bookstoregenie.com.
		Compensation chart:
Value of Books Purchased ($)          % earned      Range of Compensation
	0 - $1000                  	  8%            0 - $80
	$1001 - $2000                    12%            $120 - $240
	$2001 - $5000                     15%         	$300 - $750	                      

IN WITNESS WHEREOF the undersigned have executed this Agreement as of the day and year first written above.  The parties hereto agree that facsimile signatures shall be as effective as if originals.
</textarea></div>
				<form class = "jqtransform" id = "checkForm" action = "" method = "POST">
				<div style = "color: RED; font-size: large;" class = "rowElem">By clicking the box below and entering your full name in the space provided, you are entering into a legally binding contract. Upon completion of this form, College Essentialls Inc. will keep a digital record of your contract and you consent that the digital signature below is enforceable as a facsimile signature.</div>
				<div style = "padding-left:40px;" class = "rowElem"><label for = "accept">Check the following box to indicate you agree to the terms of the contract:</label><input id = "accept" type = "checkbox" name = "accept"></input></div>
				<div style = "position: relative; left: -45px;" class = "rowElem"><label for = "signature">Independent Contractor (Your full name):</label><input id  = "signature" onChange = "setSignature()" type = "text" name = "signature"></input></div>
				</form></div>
			<form class = "jqtransform"	style = "display:none;" id = "secondaryForm" action = "register_rep.php" method = "POST">
					<h3 id = "formTitle">Independant Contractor Information</h3>
					<input type = 'hidden' id = 'universityInput' name = 'university' value = "<?php echo $_REQUEST['university']; ?>"></input>
					<div class = "rowElem"><label for = "firstName">First Name: </label><input class = "formInput" type = "text" name = "firstName" value = "" ></input></div>
					<div class = "rowElem"><label for = "lastName">Last Name: </label><input type = "text" class = "formInput" name = "lastName"   value = ""></input></div>
					<div class = "rowElem"><label for = "email">Email address: </label><input type = "text" class = "formInput" name = "email"   value = ""></input></div>
					<div class = "rowElem"><label for = "contactPhone">Phone Number: </label><input type = "text" class = "formInput" name = "contactPhone" value = ""></input></div>
					<div class = "rowElem"><label for = "address">Address: </label><input type = "text" name = "address"  class = "formInput"value = ""></input></div>
					<div class = "rowElem"><label for = "city">City: </label><input type = "text" name = "city" class = "formInput" value = ""></input></div>
					<div class = "rowElem"><label for = "state">State: </label><input type = "text" name = "state" class = "formInput" value = ""></input></div>
					<div class = "rowElem"><label for = "zip">Zip: </label><input type = "text" name = "zip" class = "formInput" value = ""></input></div>
					<div class = "rowElem"><label for = "license">Drivers License Number:</label><input type = "text"  class = "formInput" name = "license" value = ""></input></div>
					<div class = "rowElem"><label for = "licenseState">Drivers License State:</label><input class = "formInput" type = "text" name = "licenseState" value = ""></input></div>
					<div class = "rowElem"><label for = "social">Social Security Number :</label><input type = "text" class = "formInput" name = "social" value = ""></input></div>
					<div class = "rowElem"><label for = "bank">Bank Name:</label><input type = "text" class = "formInput" name = "bank" value = ""></input></div>
					<div class = "rowElem"><label for = "bank">Account Number:</label><input type = "password" class = "formInput" id = "accountNum" name = "accountNum" value = ""></input></div>
					<div class = "rowElem"><label for = "bank">Confirm Account Number:</label><input type = "password" class = "formInput" id = "accountNum2" name = "accountNum2" value = ""></input></div>
					<div class = "rowElem"><label for = "bank">Routing Number (wire transfer):</label><input type = "password" class = "formInput" id = "routingNum" name = "routingNum" value = ""></input></div>
					<input type = "hidden" id = "realSignature" name = "independantContractor"></input>
					<div class = "rowElem"><input id = 'submit_btn' type = "submit" value = "Submit"></input></div>
				</form>
			</div>
			<div id = "footer">
				<img style = "margin-top: 30px;" src = "images/footer.png" />
			</div>
		</div>
		 <div id="popupContact">  
			<a id="popupContactClose">x</a>  
			<h1 id = "popupTitle">Succesfully registered</h1>  
			<p id="contactArea">  
				
			</p>  
		</div>  
		<div id = "backgroundPopup"></div>
  </body>
</html>