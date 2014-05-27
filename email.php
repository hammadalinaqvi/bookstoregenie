<html>

<head>
	<title>Professor email page</title>
	<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
	<link rel = "stylesheet" href = "style/email.css">
	<script>
	var bookDiv;
	// copyright prototype borrowed under terms of its liscence
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
	
	$(document).ready(function(){
		var element;
		for (var i = 0; i < 15; i++){
			element = $(document.createElement("option"));
			element.val(i);
			element.html(i + 1);
			$("#books_num").append(element);
		}
		$("#books_num").change(function(){
			var title, author, edition, isbn, price;
			for (var i = 0; i <= $("#books_num").val(); i++){
				bookDiv = $(document.createElement("div"));
				bookDiv.attr("class", "book_div");
				
				title   = createBookElement("title", i);
				author  = createBookElement("author", i);
				edition = createBookElement("edition", i);
				isbn    = createBookElement("isbn", i);
				price   = createBookElement("price", i);
				
				$(isbn).change(getPrice(isbn, bookDiv));
				
				$("#form").append(bookDiv);
			}
		});
	});
	
	function createBookElement(name, index){
		var reference = name + index;
		
		var element = $(document.createElement("input"));
		element.attr("name", reference);
		element.attr("id", reference);
		
		bookDiv.append(name + ":");
		bookDiv.append(element);
		
		return element;
	}
		var container;
		var number;
		function getPrice(isbn, element, i){
			alert("called");
			container = element;
			number    = i;
			request = $.ajax({
				url: "getprice.php?isbn=" + isbn.val(),
				dataType: "text",
				success: function(data){
					var usedPrices   	   = new Array();
					var newPrices    	   = new Array();
					var offer;
					var ajaxResponse = Try.these(
						function() { return new DOMParser().parseFromString(data, 'text/xml'); },
						function() { var xmldom = new ActiveXObject('Microsoft.XMLDOM'); xmldom.loadXML(data); return xmldom; }
					);		
					$(ajaxResponse).find("offer").each(function(){
						if ($(this).find("total_price").text() != ''){
							if ($(this).find("condition_id").text() == "2"){
								usedPrices.push($(this).find("total_price").text());
							}else if ($(this).find("condition_id").text() == "1"){
								newPrices.push($(this).find("total_price").text());
							}
						}
					});
					if ($(ajaxResponse).find("offer").length == 0){
						alert("bad isbn");
					}
					/*usedPrices[0] = eval(usedPrices[0]);
					newPrices[0]  = eval(newPrices[0]);*/
					
					var priceString = "";
					if (usedPrices[0] != null)
						priceString += "New: $" + usedPrices[0] + " &nbsp;";
					if (newPrices[0] != null)
						priceString += "Used: $" + newPrices[0];
					
					alert (priceString);
					
					var newBox = $(document.createElement("div"));
					container.append(newBox);
					newBox.attr("id", "isbn" + number + "Price");
					newBox.html(priceString);
					newBox.attr("name", "isbn" + number + "Price");
					newBox.addClass("price");
				},
				error: function(request, status, error){
					alert("Unable to retrieve Book Data");
				}
			});
		}
	</script>
</head>

<body>
	<h1> Email Form </h1>
	<form id = "form" action = "send_email.php" method = "POST">
		Course Name: <input type = "text" name = "courseName" id = "courseName" /> <br />
		Profesor: <input type = "text" name = "profesor" id = "profesor" /> <br />
		Profesor Email: <input type = "text" name = "email" id = "email" /> <br />
		Number of Books: <select name = "books_num" id = "books_num" value = "-1">
			<option value = "-1">Pick a number </option>
		</select>
	</form>
</body>

</html>