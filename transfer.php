<?php
$bookstoreName = $_GET['bookstore'];
$dbName		   = $_GET['dbname'];
$id			   = $_GET['ids'];
$req		   = $_GET['req'];
$i			   = 0;
$isbns		   = Array();
$titles   	   = Array();
$authors  	   = Array();
$editions 	   = Array();

$id = explode(",", $id);
echo count($id);

$host = "localhost";
$database = "jteplitz_bookstore";
$table = "schools";
$user = "jteplitz";
$pass = "jtt0511";
mysql_connect($host, $user, $pass);
mysql_select_db($database);
$query = "Select * FROM {$table} WHERE school = '{$dbName}'";
$result = mysql_query($query);

$wuid  = mysql_fetch_row($result);
$wuid  = $wuid[1];
if ($wuid == ""){
	$wuid = "zXrIMmSVv1lr6F6pOSMLrbBat4NfBe3n";
}
$table = "books";
if ($req != "isbn"){
	for ($j = 0; $j < count($id); $j++){
		$current = $id[$j];
		$query  = "SELECT * FROM books WHERE id = {$current}";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			if ($row['isbn'] == 0){
				array_push($titles, $row['titles']);
				array_push($authors, $row['authors']);
				array_push($editions, $row['editions']);
			}else
				array_push($isbns, $row['isbn']);
		}
	}
}else{
	$isbns = explode(" ", $_GET['isbns']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo "<title>{$bookstoreName} Bookstore by The Bookstore Genie</title>"; ?>
<link rel = "stylesheet" type = "text/css" href = "style/main.css" />
<!--<script src = "script/prototype.js" language="javascript" type="text/javascript"></script>-->
<script language="javascript" type="text/javascript" src="script/autocomplete.js"></script>
<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<script language=javascript src="https://payments.amazon.com/cba/js/PaymentWidgets.js"></script>
<script type="text/javascript">
		var amazonBooks  = new Array(), cheggBooks = new Array(), textbooksrusBooks = new Array(), halfBooks = new Array(), badBooks_arr = new Array(), noNew = Array(), noUsed = Array(), popupStatus = 0, currentIsbn;
function book(price, link, isbn10, isbn13){
	this.price  = price;
	this.link   = link;
	this.isbn10 = isbn10;
	this.isbn13 = isbn13;
}


var Try = {
  these: function() {
    var returnValue;

    for (var i = 0; i < arguments.length; i++) {
      var lambda = arguments[i];
      try {
        returnValue = lambda();
        break;
      } catch (e) {}
    }

    return returnValue;
  }
}

function loadPopup(title, message){  
	//loads popup only if it is disabled  
	if(popupStatus==0){  
		$("#backgroundPopup").css({  
			"opacity": "0.7"  
		});  
		$("#backgroundPopup").fadeIn("slow");  
		$("#popupContact").fadeIn("slow");  
		popupStatus = 1;  
	} 
	$("#popUpTitle").html(title);
	$("#contactArea").html(message);
	centerPopup();
	$("#popupContactClose").click(function(){  
		disablePopup();  
	});  
	$("#popupClose").click(function(){  
		disablePopup();
	});  
	//Click out event!  
	$("#backgroundPopup").click(function(){  
		disablePopup();  
	});  
	//Press Escape event!  
	$(document).keypress(function(e){  
		if(e.keyCode==27 && popupStatus==1){  
			disablePopup();  
		}
	});		
}

//disabling popup with jQuery magic!  
function disablePopup(){  
	//disables popup only if it is enabled  
	if(popupStatus==1){  
		$("#backgroundPopup").fadeOut("slow");  
		$("#popupContact").fadeOut("slow");  
		popupStatus = 0;  
	}
 document.BB_BuyButtonForm.submit();	
}

//centering popup  
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
	  
}  		var isbnString   = "";
		var totalUsed 	 = 0;
		var totalNew  	 = 0;

	window.onload = function(){
		var request;
		var completed 	 = 0;
		var bad 		 = 0;
		var newBooks, usedBooks;
		var uri = "getprice.php?isbn=";
		<?php echo "var isbns = " . json_encode($isbns) . ";\r\n" ?>
		if (isbns.length > 1){
			for (var i = 0; i < isbns.length; i++){
				usedBooks = false;
				newBooks  = false;
				var url = uri + isbns[i];
				currentIsbn = isbns[i];
				isbnString += currentIsbn + " ";
				request = $.ajax({
					url: url,
					dataType: "text",
					success: function(data){
						var usedPrices   	   = new Array();
						var newPrices    	   = new Array();
						var textbooksrusPrices = new Array();
						var halfPrices 		   = new Array();
						var isbn10, isbn13, price;
						var offer;
						var ajaxResponse = Try.these(
							function() { return new DOMParser().parseFromString(data, 'text/xml'); },
							function() { var xmldom = new ActiveXObject('Microsoft.XMLDOM'); xmldom.loadXML(data); return xmldom; }
						);
						$(ajaxResponse).find("offer").each(function(){
							if ($(this).find("total_price").text() != ''){
								if ($(this).find("condition_id").text() == "2"){
									usedPrices.push($(this).find("total_price").text());
									newBooks  = true;
								}else if ($(this).find("condition_id").text() == "1"){
									newPrices.push($(this).find("total_price").text());
									usedBooks = true;
								}
								var merchantName = $(this).find("merchant_name").text();
								if (merchantName == "Amazon.com"){
									amazonBooks.push(new book($(this).find("price").text(), $(this).find("link").text(), $(this).find("isbn10").text(), $(this).find("isbn13").text()));
								}else if (merchantName == "Chegg"){
									cheggBooks.push(new book($(this).find("price").text(), $(this).find("link").text(), $(this).find("isbn10").text(), $(this).find("isbn13").text()));
								}else if (merchantName == "TextbooksRus.com"){
									textbooksrusBooks.push(new book($(this).find("price").text(), $(this).find("link").text(), $(this).find("isbn10").text(), $(this).find("isbn13").text()));
								}else if (merchantName == "Half.com"){
									halfBooks.push(new book($(this).find("price").text(), $(this).find("link").text(), $(this).find("isbn10").text(), $(this).find("isbn13").text()));
								}
							}else
								bad++;
						});
						if (!newBooks){
							noNew.push(currentIsbn);
							newPrices[0] = usedPrices[0];
						}
						if (!usedBooks){
							noUsed.push(currentIsbn);
							usedPrices[0] = newPrices[0];
						}
						if ($(ajaxResponse).find("offer").length == 0){
							badBooks_arr.push(currentIsbn);
						}
						usedPrices[0] = eval(usedPrices[0]);
						newPrices[0]  = eval(newPrices[0]);
						if (usedPrices[0] != null)
							totalUsed += usedPrices[0];
						if (newPrices[0] != null)
							totalNew  += newPrices[0];
						completed++;
						if (completed == isbns.length){
							totalUsed *= 1.3;
							totalNew  *= 1.3;
							$("#newOption").html("$" + Round(totalNew, 2) + " - NEW");
							$("#usedOption").html("$" + Round(totalUsed, 2) + " - USED");
							$("#itemTitle").val("New - " + isbnString);
							$("#newOptionValue").attr("value", Round(totalNew, 2));
							$("#usedOptionValue").attr("value", Round(totalUsed, 2));
							if (cheggBooks.length >= isbns.length - bad){
								var totalChegg = 0;
								for (var j = 0; j < cheggBooks.length; j++){
									totalChegg += Round(cheggBooks[j].price, 2);
								}
								var element = document.createElement("img");
								element.setAttribute('src', 'images/chegg.png');
								element.setAttribute("onclick", "cheggClick()");
								element.setAttribute("id", "cheggButton");
								element.setAttribute("class", "pointer");
								$('#buyFrom').append(element);
							}
							if (amazonBooks.length >= isbns.length - bad){
								var totalAmazon = 0;
								for (var j = 0; j < amazonBooks.length; j++){
									totalAmazon += Round(amazonBooks[j].price, 2);
								}
								var element = document.createElement("img");
								element.setAttribute("src", "images/amazon.png");
								element.setAttribute("id", "amazonButton");
								element.setAttribute("onclick", "amazonClick()");
								element.setAttribute("class", "pointer");
								$('#buyFrom').append(element);
							}
							if (textbooksrusBooks.length >= isbns.length - bad){
								var totalTextbooksrus = 0;
								for (var j = 0; j < textbooksrusBooks.length; j++){
									totalTextbooksrus += Round(textbooksrusBooks[j].price, 2);
								}
								var element = document.createElement("img");
								element.setAttribute('src', 'images/textbooksrus.png');
								element.setAttribute("onclick", "textbooksrusClick()");
								element.setAttribute("id", "textbooksrusButton");
								element.setAttribute("class", "pointer");
								$('#buyFrom').append(element);
							}
							if (halfBooks.length >= isbns.length - bad){
								var totalHalf = 0;
								for (var j = 0; j < halfBooks.length; j++){
									totalHalf += Round(halfBooks[j].price, 2);
								}
								var element = document.createElement("img");
								element.setAttribute('src', 'images/half.png');
								element.setAttribute("onclick", "halfClick()");
								element.setAttribute("id", "cheggButton");
								element.setAttribute("class", "pointer");
								$('#buyFrom').append(element);
							}
						}
					},
					error: function(request, status, error){
						alert("Unable to retrieve Book Data");
					}
				});
			}
		}else{
			$("#googleCheckout").setAttribute("class", "hidden");
		}
	}
function amazonClick(){
	var i, j, bad = false;
	for (i = 0; i < amazonBooks.length; i++){
		bad = false;
		for (j = 0; j < amazonBooks.length; j++){
			if (amazonBooks[i].isbn10 == amazonBooks[j].isbn10 && amazonBooks[i].isbn13 == amazonBooks[j].isbn13){
				if (amazonBooks[j].price < amazonBooks[i].price){
					bad = true;
					break;
				}
			}
		}
		if (!bad)
			window.open(amazonBooks[i].link);
	}
}
function cheggClick(){
	var i, j, bad = false;
	for (i = 0; i < cheggBooks.length; i++){
		bad = false;
		for (j = 0; j < cheggBooks.length; j++){
			if (cheggBooks[i].isbn10 == cheggBooks[j].isbn10 && cheggBooks[i].isbn13 == cheggBooks[j].isbn13){
				if (cheggBooks[j].price < cheggBooks[i].price){
					bad = true;
					break;
				}
			}
		}
		if (!bad)
			window.open(cheggBooks[i].link);
	}
}
function textbooksrusClick(){
	var i, j, bad = false;
	for (i = 0; i < textbooksrusBooks.length; i++){
		bad = false;
		for (j = 0; j < textbooksrusBooks.length; j++){
			if (textbooksrusBooks[i].isbn10 == textbooksrusBooks[j].isbn10 && textbooksrusBooks[i].isbn13 == textbooksrusBooks[j].isbn13){
				if (textbooksrusBooks[j].price < textbooksrusBooks[i].price){
					bad = true;
					break;
				}
			}
		}
		if (!bad)
			window.open(textbooksrusBooks[i].link);
	}
}
function halfClick(){
	var i, j, bad = false;
	for (i = 0; i < halfBooks.length; i++){
		bad = false;
		for (j = 0; j < halfBooks.length; j++){
			if (halfBooks[i].isbn10 == halfBooks[j].isbn10 && halfBooks[i].isbn13 == halfBooks[j].isbn13){
				if (halfBooks[j].price < halfBooks[i].price){
					bad = true;
					break;
				}
			}
		}
		if (!bad)
			window.open(halfBooks[i].link);
	}
}

function submitForm(){
	if (badBooks_arr.length > 0){
		var isbnText = "";
		for (var i = 0; i < badBooks_arr.length; i++){
			isbnText += badBooks_arr[i];
		}
		loadPopup("Out of Stock", "We are out of stock of the following item(s): <br /> " + isbnText);
	}
	if ($("#item_selection_1").attr("value") == 1){
		if (noNew.length != 0){
			var isbnText = "";
			for (var i = 0; i < noNew.length; i++){
				isbnText += noNew[i];
			}
			loadPopup("Out of Stock", "We do not have the following item(s) new and we will have to purchase them used: <br /> " + isbnText);
		}else
			document.BB_BuyButtonForm.submit();
	}else if ($("#item_selection_1").attr("value") == 2){
		if (noUsed.length != 0){
			var isbnText = "";
			for (var i = 0; i < noUsed.length; i++){
				isbnText += noUsed[i];
			}
			loadPopup("Out of Stock", "We do not have the following item(s) used and we will have to purchase them new: <br /> " + isbnText);
		}else
			document.BB_BuyButtonForm.submit();
	}
	
}

function Round(number, precision) { number=parseFloat( number) + 0.5 * Math.pow(10, -precision); number = Math.floor(number * Math.pow(10, precision)); var res = (number * Math.pow(10, -precision)).toFixed(precision); if (res.charAt(0) == ".") { res = "0" + res; } return parseFloat(res); }
function changed(){
	if ($("#item_selection_1").val() == 1){
		$("#itemTitle").val("New - " + isbnString);
		$("#newOptionValue").val(Round(totalNew, 2));		
	}else if ($("#item_selection_1").val() == 2){
		$("#itemTitle").val("Used - " + isbnString);
		$("#newOptionValue").val(Round(totalUsed, 2));
	}
}
</script>
</head>

<body>
<div id = "bg"><img id = "background_image" src = "images/background.png" width = "100%" height = "100%" /></div>

	<div id = "wrapper">
    	<div id = "header">
        	<a href = "index.html"><img border = "0" id = "logo_img" src = "images/logo.png" /></a>
           	<!--<img id = "nav_img" src = "images/nav.png" usemap = "#nav_map" border = "0" />-->
		<map name = "nav_map">
		  <area shape = "rect" coords = "0,0,57,16" href = "index.html" />
		  <area shape = "rect" coords = "57,0,144,16" href = "about.html" />
		</map>
        </div>
        <div id = "update"></div>
        <div id = "content">
        	<ol id = "content_top" class = "content_list">
        		<li class = "content_list_item"><img id = "genie" src = "images/genie.png" /></li>
            	<li class = "content_list_item"><img id = "bubble" src = "images/bubble.png" /></li>
            </ol>
            <ol id = "content_bottom_buy" class = "content_list">
			<li class = ' <?php if (count($isbns) < 2) echo "hidden" ?> '  id = "googleCheckout" class = "content_list_buy">
<form id="BB_BuyButtonForm" >

    <table cellpadding="5" cellspacing="0" width="1%">
        <tr>
            <td align="right" width="1%">
				<div id = "optionContainer">
					<select onChange = 'changed()'id = "item_selection_1" >
						<option id ="newOption" value="1">Loading</option>
						<option id = "usedOption" value="2">Loading</option>
					</select>
				</div>

				<input name="item_merchant_id_1" value="A2RZGFLKCTCU4T" type="hidden" />
				<input id = "itemTitle" name="item_title_1" value="New" type="hidden" />
				<input id = "newOptionValue" name="item_price_1" value="19.99" type="hidden" />
				<input name="item_quantity_1" value="1" type="hidden" />
				<input name="currency_code" value="USD" type="hidden" />
				<!--<img onclick = "submitForm()" class = "pointer" src = 'images/google_02.png' /> -->
				<div class = "pointer" id="cbaButton1"/>
					<script>
						new CBA.Widgets.StandardCheckoutWidget({
						merchantId:'A2RZGFLKCTCU4T',
						orderInput: {format: "HTML",
						value: "BB_BuyButtonForm"},
						buttonSettings: {size:'large',color:'orange',background:'white'}
						}).render("cbaButton1");
					</script>
            </td>
        </tr>
    </table>
</form>
</li>
<li id ="buyFrom">
</li>
			<li id = "widgets" class = "content_list_buy"><?php
		for ($j = 0; $j < count($isbns); $j++){
			echo "<iframe class = 'widget' src ='http://widgets.campusbooks.com/widget.php?wuid={$wuid}&isbn={$isbns[$j]}' width='860' height='350'></iframe>";
		}
		for ($j = 0; $j < count($titles); $j++){
			echo "<iframe class = 'widget' src ='http://widgets.campusbooks.com/widget.php?wuid={$wuid}&title={$titles[$j]}&author={$authors[$j]}' width='860' height='350'></iframe>";
		}
		echo "<h3><b><a href='selectbooks.php?dbname={$dbName}&bookstore={$bookstoreName}&titles=" . urlencode(json_encode($titles)) . "&authors=" . urlencode(json_encode($authors)) . "&isbns=" . urlencode(json_encode($isbns)) . "'>Click here to go back and enter in more books</a></b></h3>";
?></li>
</ol>
	</div>
			<div id = "footer">
				<img id = "footer_img" src = "images/footer.png" />
			</div>
		</div>

	<div id="popupContact">  
        <a class = "pointer" id="popupContactClose">x</a>  
        <h1 id = "popUpTitle"></h1>  
        <p id="contactArea">  
           
        </p>
		<a class = "pointer rollover" id = "popupClose">Okay</a>
    </div>
	<div id="backgroundPopup"></div> 
</body>
</html>