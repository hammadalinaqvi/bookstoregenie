<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Add Organization</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
		<script src="script/jquery.jqtransform.js" type = "text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" type="text/javascript"></script>
		<script src = "script/jquery.loading.1.6.4.js" type = "text/javascript"></script>
		<script src="script/jqueryform.js" type = "text/javascript"></script>
		<link rel = "stylesheet" href = "style/jqtransform.css" />
		<link rel = "stylesheet" href = "style/main.css" />
		<link rel = "stylesheet" href=  "style/add_organization.css" />
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />
		<link rel = "stylesheet" type = "text/css" href = "style/jquery.loading.1.6.css"></script>
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
		function College(name, dbName, isbn, link){
			this.name   = name;
			this.dbName = dbName;
			this.isbn   = isbn;
			this.link   = link;
		}
			var colleges = new Array(), data = new Array(), popupStatus = 0;  ;
			window.onload = function(){
				$("#mainForm").jqTransform();
				if ($("#search").val() !=  ""){
					$("#mainForm").slideDown(600);
					setLabels();
				}
				$("#mainForm").ajaxForm({
					"beforeSubmit": function(){
						$.loading(true, {mask:true, img: "images/loading.gif", align: "center"});
					},
					"success" : function(response){
						$.loading(false);
						$("#contactArea").append("Thank you, your organization has been added succesfully.");
						centerPopup();
						loadPopup();
						$("html, body").animate({
							scrollTop: $("#contactArea").offset().top
						}, 600);
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
				$("#mainForm").slideDown(600);
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
				<form class = "jqtransform"	style = "display:none;" id = "mainForm" action = "alert('shit');" method = "POST">
					<h3 id = "formTitle">Student Organization Fundraiser Signup Form</h3>
					<input type = 'hidden' id = 'universityInput' name = 'university' value = "<?php echo $_REQUEST['university']; ?>"></input>
					<div class = "rowElem"><label for = "orgname">Organization Name: </label><input class = "formInput" type = "text" name = "orgname" value = "" ></input></div>
					<div class = "rowElem"><label for = "email">Contact Person: </label><input type = "text" class = "formInput" name = "contactName"   value = ""></input></div>
					<div class = "rowElem"><label for = "contactPhone">Contact E-mail: </label><input type = "text" class = "formInput" name = "email"   value = ""></input></div>
					<div class = "rowElem"><label for = "contactName">Contact Phone Number: </label><input type = "text" class = "formInput" name = "contactPhone" value = ""></input></div>
					<div class = "rowElem"><label for = "payPal">Email for Paypal Payment : </label><input type = "text" name = "payPal"  class = "formInput"value = ""></input></div>
					<div class = "rowElem"><label for = "subdomain">Fundraiser URL: </label><input type = "text" name = "subdomain" class = "formInput" value = ""></input><span class = "afterInput">.bookstoregenie.com</span></div>
					<div class = "rowElem"><input id = 'submit_btn' type = "submit" value = "Sign Up!"></input></div>
				</form>
			</div>
			<div id = "footer">
				<img style = "margin-top: 30px;" src = "images/footer.png" />
			</div>
		</div>
		 <div id="popupContact">  
			<a id="popupContactClose">x</a>  
			<h1>Organization added succesfully</h1>  
			<p id="contactArea">  
				
			</p>  
		</div>  
		<div id = "backgroundPopup"></div>
  </body>
</html>