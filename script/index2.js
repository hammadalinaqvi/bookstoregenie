function College(name, dbName, isbn, link){
	this.name   = name;
	this.dbName = dbName;
	this.isbn   = isbn;
	this.link   = link;
}
var department = "", course = "", section = "", school, autocomplete, amazonLinks, amazonPrice, goDown = false;

var usedPrice = 0, newPrice = 0, rentPrice = 0, ebookPrice = 0, popupStatus = 0;
var usedLinks = new Array(), newLinks = new Array(), rentLinks = new Array(), ebookLinks = new Array(); amazonLinks = new Array();

var ids = new Array();
function setDepartment(value){
	department = value;
}
function setCourse(value){
	course = value;
}
function setSection(value){
	section = value;
}
var data = new Array(), colleges = new Array();
$(document).ready(function (){
	$(".ui-state-hover").css("background: none;");
	$(".ui-state-hover").css("border: none;");
	BrowserDetect.init();
	if (BrowserDetect.browser == "Firefox"){
		/*$(".ui-button-custom-icon").css("left", '-4px');
		$(".ui-button-custom-icon").css("top", '-32px');*/
		$(".ui-button").css("width", "32px");
		$(".ui-button").css("height", "54px");
		$(".ui-button").css("left", "-4px");
		$(".ui-button").css("top", "-5px");
		
	}
	$.ajax({
		url: "../portal.php",
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
			if (goDown)
				goClick();			
		},
		faliure: function(){
			alert("Unable to retrieve school information. Check your internet connection.");
		}
	});

	colleges.push(new College("University of Wisconsin Madison", "wisc", false, ""));
	colleges.push(new College("California State Polytechnic University Pomona", "calPolyPomona", false, ""));
});


function goClick(){
	/*for (var i = 0; i < colleges.length; i++){
		if (document.getElementById('search').value == colleges[i].name){
			window.location = "selectbooks.php?dbname=" + encodeURIComponent(colleges[i].dbName) + "&bookstore=" + encodeURIComponent(colleges[i].name);
		}
	}
	if (document.getElementById('search').value == "Can't find your University?"){
		window.location = "nopage.html";
	}*/
	for (var i = 0; i < colleges.length; i++){
		if ($('#search').val() == colleges[i].name){
			school = colleges[i].dbName;
			isbn   = colleges[i].isbn;
			link   = colleges[i].link;
		}
	}
	
	if(school == null){
		alert("Oooops, you must enter a valid school name!");
	}
	else if(link == null || link == "")
	{
		alert("Oooops, you must enter a valid school name!");
	}
	else if (!isbn){
		$.loading(true, {mask:true, img: "http://www.bookstoregenie.com/images/loading.gif", align: "center"});
		$.ajax({
			url: "portal.php",
			type: "POST",
			data: {req: "department", school: school},
			success: function(transport){
				$.loading(false);
				$("#department_select").empty();
				$("#department_input").val("");
				var list = new Array(), bad = false;
				var transport = eval ("(" + transport + ")");
				for (var i in transport){
					$("#department_select").append("<option value = '" + transport[i] + "'>" + transport[i]  + "</option>");
					list.push(transport[i]);
				}
				$("#interfaceContainer").slideDown(600);
				$("#department_input").attr("value", "Select Department");
				$("#department_input").click(departmentClick);
				$("#department_box").css("display", "block");
				$("#course_box").css("display", "none");
				$("#section_box").css("display", "none");
				$("#courses").css("display", "block");
				$("#isbnContainer").slideUp(600);
				$("html, body").animate({
					scrollTop: $("#content_bottom_index").offset().top
				}, 600);
			},
			faliure: function(){
				alert("Unable to retrieve class information");
			}
		});
	}else{
		if ($("#isbnIntro").length == 0)
			$("#isbnIntro").html("Please look up your textbook requirements <a href = '" + link + "' onClick = 'return createPopup(" + '"' + link + '"' + ")'>here</a>, and copy and paste your ISBNs below.");
		else{
			$("#isbnIntro").remove();
			$("#isbnContainer").prepend("<div id = 'isbnIntro'>Please look up your textbook requirements <a href = '" + link + "' onClick = 'return createPopup(" + '"' + link + '"' + ")'>here</a>, and copy and paste your ISBNs below.</div>");
		}
		if (link.length == 0){
			$("#isbnIntro").remove();
			$("#isbnContainer").prepend("<div id = 'isbnIntro'>Unfortunately we do not have any information for your University. Please check with your bookstore.</div>");
		}
		$("#isbnContainer").slideDown(600);
		$("#interfaceContainer").slideUp(600);
		$("html, body").animate({
			scrollTop: $("#content_bottom_index").offset().top
		}, 600);
	}
	
	$("#university").html(document.getElementById('search').value);
}

function departmentClick(){
	if ($("#department_input").attr("value") == "Select Department")
		$("#department_input").attr("value", "");
}

function courseClick(){
	if ($("#course_input").attr("value") == "Select Course")
		$("#course_input").attr("value", "");
}

function sectionClick(){
	if ($("#section_input").attr("value") == "Select Section")
		$("#section_input").attr("value", "");
}
function interfaceGo(){
	var dbName, id_string = "";
	for (var i = 0; i < colleges.length; i++){
		if (colleges[i].name == $("#search").val()){
			dbName = colleges[i].dbName;
		}
	}
	for (var i = 0; i < ids.length; i++){
		if (i != ids.length - 1)
			id_string += ids[i] + ",";
		else
			id_string += ids[i];
	}
	$.loading(true, {mask:true, img: "http://www.bookstoregenie.com/images/loading.gif", align: "center"});
	$.ajax({
		url: "widget.php",
		type: "POST",
		data: {type: "buycourse", courses: id_string},
		success: function(transport){
			usedLinks.splice(0); newLinks.splice(0); rentLinks.splice(0); ebookLinks.splice(0);
			$.loading(false);
			var data = eval("(" + transport + ")");
			var bottom;
			var usedButton = "", newButton = "", rentButton = "", ebookButton = "";
			if (data.books.length == 1)
				if (data.books[0].title == null){
					$("#popupTitle").html("No books for course selection");
					$("#contactArea").html("Good News, there are no books for the courses that you have selected. Nice course choices, make sure to check back here next term to get your books.");
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
					return;
				}
			for (var i = 0; i < data.books.length; i++){
				var bookImage	 = data.books[i].bookInfo.image;
				var bookTitle 	 = data.books[i].bookInfo.title.substring(0, 40);
				if (data.books[i].bookInfo.title.length > 40)
					bookTitle += "...";
				var usedImage    = merchantImage(data.books[i].used[0], "merchantLarge0");
				var newImage     = merchantImage(data.books[i].New[0], "merchantLarge1");
				var rentImage    = merchantImage(data.books[i].rent[0], "merchantLarge2");
				var ebookImage   = merchantImage(data.books[i].ebook[0], "merchantLarge3");
				if (i == 0)
					bottom = "bookRowBottom";
				else
					bottom = "bookRow";
				var smallRows    = merchantSmall(data.books[i], i, bottom);
				$("<li class = '" + bottom + "'><div class = 'bookInfo'><img height = '94px' class = 'bookImage' src = '" + 
					bookImage + 
					"' /><span class = 'bookTitle'>" 
					+ bookTitle + 
					"</span><img id = 'morePrices" + i + "' onClick = 'morePrices(" + i + ")' class = 'morePrices' src = 'http://www.bookstoregenie.com/images/more_prices.png' /></div><div class = 'bookOffers'>" + 
					usedImage + 
					newImage + 
					rentImage + 
					ebookImage + 
					"</div>" + 
					"</li>" +
					smallRows)
					.insertAfter($("#widgetHeader"));
			}
			usedPrice  = data.buyall.used.price;
			newPrice   = data.buyall.New.price;
			rentPrice  = data.buyall.rent.price;
			ebookPrice = data.buyall.ebook.price;
			var j;
			if (data.buyall.used.merchant != null){
				for (j = 0; j < data.buyall.used.info.links.length; j++)
				  usedLinks.push(data.buyall.used.info.links[j]);
			}if (data.buyall.New.merchant != null){
				for (j = 0; j < data.buyall.New.info.links.length; j++)
				  newLinks.push(data.buyall.New.info.links[j]);
			}if (data.buyall.rent.merchant != null){
				for (j = 0; j < data.buyall.rent.info.links.length; j++)
				  rentLinks.push(data.buyall.rent.info.links[j]);
			}if (data.buyall.ebook.merchant != null){
				for (j = 0; j < data.buyall.ebook.info.links.length; j++)
				  ebookLinks.push(data.buyall.ebook.info.links[j]);
			}
			if(data.amazon != ""){
				amazonLinks = data.amazon.amazonLinks;
				amazonPrice = data.amazon.amazonPrice;
				$("<li onClick = 'buyAll(" + '"amazon")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Amazon</div><div class = 'buyAllCost'>$" + 
				  amazonPrice + 
				  "</div></li>").insertAfter("#buyAllLeft");
			}
			var bookCount = data.books.length;
			if (data.buyall.used.merchant != null)
				usedButton = "<li onClick = 'buyAll(" + '"used")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Used</div><div class = 'buyAllCost'>$" + 
								 usedPrice + 
								 "</div><div class = 'buyAllName'>" +
								  data.buyall.used.info.name + "</div></li>";
			if (data.buyall.New.merchant != null)
				newButton =  "<li onClick = 'buyAll(" + '"New")' + "' class = 'buyAllButton'><div class = 'buyAllType'>New</div><div class = 'buyAllCost'>$" + 
							  newPrice + 
							  "</div><div class = 'buyAllName'>" +
							    data.buyall.New.info.name + "</div></li>";
			if (data.buyall.rent.merchant != null)
				rentButton = "<li onClick = 'buyAll(" + '"rent")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Rent</div><div class = 'buyAllCost'>$" + 
							  rentPrice + 
							  "</div><div class = 'buyAllName'>" +
								  data.buyall.rent.info.name + "</div></li>";
			if (data.buyall.ebook.merchant != null)
				ebookButton = "<li onClick = 'buyAll(" + '"ebook")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Ebook</div><div class = 'buyAllCost'>$" + 
							   ebookPrice + 
							   "</div><div class = 'buyAllName'>" +
								  data.buyall.ebook.info.name + "</div></li>";
				
			// create the buy all box
			$(usedButton + newButton + rentButton + ebookButton).insertAfter($("#buyAllLeft"));
										 
			$(".smallRow").css("display", "none");
			$("#widgetContainer").slideDown(600);
			if (data.books.length > 1)
				$("#buyAllContainer").slideDown(600);
			$("html, body").animate({
				scrollTop: $("#interfaceContainer").offset().top
			}, 600);
		},
		failure: function(error){
			alert("Unable to get book data, please check your internet connection " + error);
		}
	});
}

function changeSearch(text){
	$("#search").val(text);
}

function isbnGo(){
	$("#isbnContainer").slideDown(600);
	$("#interfaceContainer").slideUp(600);
	$("html, body").animate({
		scrollTop: $("#content_bottom_index").offset().top
	}, 600);
}

function removeBox(id){
	$(".courseText").removeShadow();
	document.getElementById("courseList").removeChild(document.getElementById(id));
	$(".courseText").dropShadow({left: 0, top: -1});
}

function isbnInputClicked(){
	if ($("#isbnInput").val() == "Enter your ISBN number(s) ex. 9781403975072")
		$("#isbnInput").val("");
}

function isbnTransfer(){
	/*var dbName;
	for (var i = 0; i < colleges.length; i++){
		if (colleges[i].name == $("#search").val()){
			dbName = colleges[i].dbName;
		}
	}
	window.location = "transfer.php?req=isbn&isbns=" + $("#isbnInput").val();*/
	
	
	if($("#isbnInput").val() == null || $("#isbnInput").val() == "" || $("#isbnInput").val() == "Type your ISBN's here")
	{
		alert("Please enter a valid ISBN!");
	}
	else{
	
	$(".bookRowBottom").remove();
	$(".bookRow").remove();
	$(".smallRow").remove();
	$(".buyAllButton").remove();
	$("#buyAllContainer").slideUp(600);
	$.loading(true, {mask:true, img: "http://www.bookstoregenie.com/images/loading.gif", align: "center"});
	$.ajax({
		url: "widget.php",
		type: "POST",
		data: {type: "buyinfo", isbns: $("#isbnInput").val(), store: trackingName},
		success: function(transport){
			usedLinks.splice(0); newLinks.splice(0); rentLinks.splice(0); ebookLinks.splice(0);
			$.loading(false);
			var data = eval("(" + transport + ")");
			var bottom;
			var usedButton = "", newButton = "", rentButton = "", ebookButton = "";
			for (var i = 0; i < data.books.length; i++){
				var bookImage	 = data.books[i].bookInfo.image;
				var bookTitle 	 = data.books[i].bookInfo.title.substring(0, 40);
				if (data.books[i].bookInfo.title.length > 40)
					bookTitle += "...";
				var usedImage    = merchantImage(data.books[i].used[0], "merchantLarge0");
				var newImage     = merchantImage(data.books[i].New[0], "merchantLarge1");
				var rentImage    = merchantImage(data.books[i].rent[0], "merchantLarge2");
				var ebookImage   = merchantImage(data.books[i].ebook[0], "merchantLarge3");
				if (i == 0)
					bottom = "bookRowBottom";
				else
					bottom = "bookRow";
				var smallRows    = merchantSmall(data.books[i], i, bottom);
				$("<li class = '" + bottom + "'><div class = 'bookInfo'><img height = '94px' class = 'bookImage' src = '" + 
					bookImage + 
					"' /><span class = 'bookTitle'>" 
					+ bookTitle + 
					"</span><img id = 'morePrices" + i + "' onClick = 'morePrices(" + i + ")' class = 'morePrices' src = 'http://www.bookstoregenie.com/images/more_prices.png' /></div><div class = 'bookOffers'>" + 
					usedImage + 
					newImage + 
					rentImage + 
					ebookImage + 
					"</div>" + 
					"</li>" +
					smallRows)
					.insertAfter($("#widgetHeader"));
			}
			usedPrice  = data.buyall.used.price;
			newPrice   = data.buyall.New.price;
			rentPrice  = data.buyall.rent.price;
			ebookPrice = data.buyall.ebook.price;
			var j;
			if (data.buyall.used.merchant != null){
				for (j = 0; j < data.buyall.used.info.links.length; j++)
				  usedLinks.push(data.buyall.used.info.links[j]);
			}if (data.buyall.New.merchant != null){
				for (j = 0; j < data.buyall.New.info.links.length; j++)
				  newLinks.push(data.buyall.New.info.links[j]);
			}if (data.buyall.rent.merchant != null){
				for (j = 0; j < data.buyall.rent.info.links.length; j++)
				  rentLinks.push(data.buyall.rent.info.links[j]);
			}if (data.buyall.ebook.merchant != null){
				for (j = 0; j < data.buyall.ebook.info.links.length; j++)
				  ebookLinks.push(data.buyall.ebook.info.links[j]);
			}
			if(data.amazon != ""){
				amazonLinks = data.amazon.amazonLinks;
				amazonPrice = data.amazon.amazonPrice;
				$("<li onClick = 'buyAll(" + '"amazon")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Amazon</div><div class = 'buyAllCost'>$" + 
				  amazonPrice + 
				  "</div></li>").insertAfter("#buyAllLeft");
			}
			var bookCount = data.books.length;
			if (data.buyall.used.merchant != null)
				usedButton = "<li onClick = 'buyAll(" + '"used")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Used</div><div class = 'buyAllCost'>$" + 
								 usedPrice + 
								 "</div><div class = 'buyAllName'>" +
								  data.buyall.used.info.name + "</div></li>";
			if (data.buyall.New.merchant != null)
				newButton =  "<li onClick = 'buyAll(" + '"New")' + "' class = 'buyAllButton'><div class = 'buyAllType'>New</div><div class = 'buyAllCost'>$" + 
							  newPrice + 
							  "</div><div class = 'buyAllName'>" +
							    data.buyall.New.info.name + "</div></li>";
			if (data.buyall.rent.merchant != null)
				rentButton = "<li onClick = 'buyAll(" + '"rent")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Rent</div><div class = 'buyAllCost'>$" + 
							  rentPrice + 
							  "</div><div class = 'buyAllName'>" +
								  data.buyall.rent.info.name + "</div></li>";
			if (data.buyall.ebook.merchant != null)
				ebookButton = "<li onClick = 'buyAll(" + '"ebook")' + "' class = 'buyAllButton'><div class = 'buyAllType'>Ebook</div><div class = 'buyAllCost'>$" + 
							   ebookPrice + 
							   "</div><div class = 'buyAllName'>" +
								  data.buyall.ebook.info.name + "</div></li>";
				
			// create the buy all box
			$(usedButton + newButton + rentButton + ebookButton).insertAfter($("#buyAllLeft"));
										 
			$(".smallRow").css("display", "none");
			$("#widgetContainer").slideDown(600);
			if (data.books.length > 1){
				$("#buyAllContainer").slideDown(600);
				$("html, body").animate({
					scrollTop: $("#isbnContainer").offset().top
				}, 600);
			}else{
				$("html, body").animate({
					scrollTop: $("#isbnContainer").offset().top
				}, 600);
			}
		},
		failure: function(error){
			alert("Unable to get book data, please check your internet connection " + error);
		}
	})
	}
}

function morePrices(index){
	if ($(".smallRow" + index).css("display") == "none"){
		$(".smallRow" + index).slideDown(600);
		$("html, body").animate({
			scrollTop: $("#widgetHeader").offset().top
		}, 600);
		$("#morePrices" + index).attr("src", "http://www.bookstoregenie.com/images/more_prices_over.png");
	}else{
		$(".smallRow" + index).slideUp(600);
		$("#morePrices" + index).attr("src", "http://www.bookstoregenie.com/images/more_prices.png");
	}
}

function merchantImage(offer, Class){
	if (offer != null)
		return "<a target = '_BLANK' class = '" + Class + "' href = '" + offer.link + "'><img class = 'merchantImage' width = '133px' height = '33px' src = '" + offer.image + "' /> <div class = 'priceImage'><div class = 'priceText'><span class = 'dollar'>$</span>" + offer.price +"</div></div></a>";
	else
		//return "<a class = 'merchantLarge'><img class = 'merchantImage' width = '133px' height = '33px' src = 'images/blank_merchant.png' /><div class = 'blankPriceImage'><div class = 'blankPriceText'><span class = 'dollar'>$</span>100</div></div></a>";
		return "";
}

function merchantImageSmall(offer, Class){
	if (offer != null)
		return "<a target = '_BLANK' class = '" + Class + "' href = '" + offer.link + "'><img class = 'merchantImageSmall' width = '111px' height = '25px' src = '" + offer.image + "' /> <div class = 'priceImageSmall'><div class = 'priceText'><span class = 'dollar'>$</span>" + offer.price +"</div></div></a>";
		else
			//return "<a class = 'merchantSmall'><img class = 'merchantImageSmall' width = '111px' height = '25px' src = 'images/blank_merchant_small.png' /><div class = 'blankPriceImageSmall'><div class = 'blankPriceText'><span class = 'dollar'>$</span>100</div></div></a>";
			return "";
}

function merchantSmall(offers, i){
	var rows = "";
	var row, length;
	
	if (offers.used.length > offers.New.length)
		if (offers.rent.length > offers.used.length)
			if (offers.ebook.length > offers.rent.length)
				length = offers.ebook.length;
			else
				length = offers.rent.length;
		else if (offers.ebook.length > offers.used.length)
			length = offers.ebook.length;
		else
			length = offers.used.length
	else if (offers.rent.length > offers.New.length)
		if (offers.ebook.length > offers.rent.length)
			length = offers.ebook.length;
		else
			length = offers.rent.length;
	else	
		length = offers.New.length;
		
	for (var j = 1; j < length; j++){
		row = "<li class = 'smallRow smallRow" + i + "'>" +
			  merchantImageSmall(offers.used[j], "merchantSmall0") + 
			  merchantImageSmall(offers.New[j], "merchantSmall1") + 
			  merchantImageSmall(offers.rent[j], "merchantSmall2") + 
			  merchantImageSmall(offers.ebook[j], "merchantSmall3") +
			  "</li>";
		rows += row;
	}
	return rows + "</div>";
}

function createPopup(url) {
	newwindow=window.open(url,'University_Bookstore','scrollbars=1, height=600,width=800');
	if (window.focus) {newwindow.focus()}
		return false;
}

function clearUniversity(){
	if ($("#search").val() == "Type in your University")
		document.getElementById('search').value='';
}

function buyAll(type){
	var currentArray;
	switch (type){
		case 'New':
			currentArray = newLinks;
			break;
		case 'used':
			currentArray = usedLinks;
			break;
		case 'rent':
			currentArray = rentLinks;
			break;
		case 'ebook':
			currentArray = ebookLinks;
			break;
		case 'amazon':
			currentArray = amazonLinks;
			break;
	}
	
	for (var i = 0; i < currentArray.length; i++){
		window.open(currentArray[i], 'bookBuy' + type + i, "scrollbars=1, resizable=1, toolbar=1, height=700, width=800");
	}
}

function addCourse(){
	if (department != "" && course != "" && section != ""){
		var string = department.substring(0, 4) + course + "." + section;
		var id = $("#section_select").val();
		$("#courseList").append("<div id = '" + id + "'class = 'course'><div class = 'courseText'>" + string + "</div><img width = '22px' height = '22px' class = 'courseX hand' src = 'images/coursex.png' onClick = 'removeBox(" + '"' + id + '"' + ")'/></div>");
		$("#course_box").css("display", "none");
		$("#section_box").css('display', "none");
		$("#department_input").attr("value", "Select Department");
		$("#search_btn").slideDown(600);
		ids.push(id);
		$(".courseText").removeShadow();
		$(".courseText").dropShadow({left: 0, top: -1});
		$("#selectcoursebox_grey").css("display", "block");
		$("#selectsectionbox_grey").css("display", "block");
		department = "";
		course	   = "";
		section    = "";
	}
}

// popup code, make a jquery plugin for this one day
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