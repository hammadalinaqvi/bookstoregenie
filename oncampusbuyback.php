<!DOCTYPE html>
<?php
	$name = $_REQUEST['name'];
	$correctRep = is_numeric($name) ? "true" : "false";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel = "stylesheet" type = "text/css" href = "style/jquery.loading.1.6.css" />
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script> Using local jquery script for now because I have no internet, undo this before upload-->
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css" />
<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script src = "script/json.js" type = "text/javascript"></script>
<script src = "script/jquery.loading.1.6.4.js" type = "text/javascript"></script>
<link rel = "stylesheet" href = "style/buyback.css" type = 'text/css' />
<script id = 'bookTemplate' type = "text/x-jquery-tmpl">
	<li class = 'bookRow' data-icon = "delete" id = 'bookRow${id}'>
		<div data-role = "collapsible" data-collapsed="true">
			<h3>${title} $${price}.00</h3>
			<p>
				<select name="slider" id="bookSlider${id}" data-role="slider">
					<option value="used">Used</option>
					<option value="new">New</option>
				</select>
				<a href="#" id = 'bookDelete${id}' data-role="button" data-icon="delete">Remove</a>
			</p>
		</div></li>
</script>
<script type = "text/javascript" language = "JavaScript">
var isbnFields = 0;
var object;
var book_arr = new Array(), totalPrice = 0;
<?php
	if ($_GET['type'] == 'accept'){
		$id = $_GET['appointment_id'];
		echo <<< EOT
var newAppointment = true, newAppointmentId = {$id}, newAppointmentData = eval( "(" + '{$_REQUEST['data']}' + ")" );

EOT;
	}else{
		echo <<< EOT
var newAppointment = false;

EOT;
	}
	$timestamp = time();
	echo <<< EOT
var timestamp = {$timestamp};

EOT;
?>
	$(document).ready(function(){
		$("#isbn_0").focus();
		if (!<?php echo $correctRep ?>){
			$('body').append('<a id="temp" href="badrep_dialog.html" data-rel="dialog" style="display:none"></a>');
			$('#temp').click().remove();
			return;
		}
		$("#mainList").delegate("#submitButton", "click", function(){
			$("#isbnForm").submit();
		});
		
		var params = {
			"type": "register_device_token",
			"id": "<?php echo $name ?>",
			"device": "2",
			"token": "0"
		}
		$.ajax({
			url: "rep_info.php",
			method: "POST",
			data: params,
			
		});
		
		$("html").delegate("#confirmEmail", "click", function(){
			var book, send_arr = new Array();
			for (var i = 0; i < book_arr.length; i++){
				book = book_arr[i];
				if (book.valid){
					send_arr.push(book);
				}
			}
			params = {
				"books": $.JSON.encode(send_arr),
				"name" : '<?php echo $name ?>',
				"email": $("#email").val()
			};
			$.mobile.pageLoading();
			$.ajax({
				url: "store_buyback.php",
				type: 'post',
				data: params,
				success: function(transport){
					 $('.ui-dialog').dialog('close');
					reset();
					$.mobile.pageLoading(true);
				},
				failure: function(transport){
					$('#output').html("Unable to submit request, please check data connection.");
				}
			});
			return false;
		});
		$("html").delegate("#skipEmail", "click", function(){
			var book, send_arr = new Array();
			for (var i = 0; i < book_arr.length; i++){
				book = book_arr[i];
				if (book.valid){
					send_arr.push(book);
				}
			}
			params = {
				"books": $.JSON.encode(send_arr),
				"name" : '<?php echo $name ?>',
				"email": "0"
			};
			$.mobile.pageLoading();
			$.ajax({
				url: "store_buyback.php",
				type: 'post',
				data: params,
				success: function(transport){
					$('.ui-dialog').dialog('close');
					reset();
					$.mobile.pageLoading(true);
				},
				failure:function(transport){
					$('#output').html("Failed");
				}
			});
			return false;
		});
		$("#mainList").delegate("#dontBuy", "click", function(){
			$.mobile.pageLoading();	
			reset();
			$.mobile.pageLoading(true);
		});
	});
		
	function getBuyback(){
		var params;
		params = {
			"isbns":$('#isbn_0').val(),
			_: new Date().getSeconds(),
			"type": 'buyback'
		};
		$.mobile.pageLoading();
		$.ajax({
			url: 'widget.php',
			type: 'POST',
			data: params,
			success: function(transport){
				$.mobile.pageLoading(true);
				$("#isbn_0").val("");
				var data = eval ("(" + transport + ")");
				for (var i = 0; i < data.books.length; i++){
					var book = data.books[i];
					book_arr.push(new Book(book.fullTitle, book.price, book.merchant, book.isbn, book.sellPrice));
					//$("#output").prepend("<div data-role='delete' id = 'bookRow" + () + "' class = 'bookRow'><div class = 'bookTitle'>" + book.title + "</div><div class = 'bookPrice'>$" + book.price + ".00</div><img onClick = 'remove(" + (book_arr.length - 1) + ")' class = 'x' width='16px' height='16px' src = 'images/buybackx.png' /></div>");
					$("#bookTemplate").tmpl({"id" : book_arr.length - 1, "title": book.title, "price": book.price}).prependTo("#books").page();
					totalPrice += book.price;
					$("#bookDelete" + (book_arr.length - 1)).bind("click", {id: book_arr.length -1}, function(event){
						var id = event.data.id;
						var book = book_arr[id];
						totalPrice -= book.price;
						$("#bookRow" + id).remove();
						book.clear();
						$("#subtotal").html("Subtotal: $" + totalPrice + ".00");
					});
				}
				$("#subtotal").html("Subtotal: $" + totalPrice + ".00");
				$("#buttons").addClass("visible");
				$("#buttons").removeClass("notVisible");
				try { 
					$("#mainList").listview("refresh");
				} catch(e){
					alert("Unable to refresh list, please contact Farhan.");
				} 
			},
			failure:function(transport){
				$('#output').innerHTML = "Failed";
			}
		});
		return false;
	}
	
	function remove(id){
		var book = book_arr[id];
		totalPrice -= book.price;
		$("#bookRow" + id).remove();
		book.clear();
		$("#subtotal").html("Subtotal: $" + totalPrice + ".00");
	}
	
	function sendStuff(){
	}
	
	function reset(){
		book_arr.splice(0);
		totalPrice = 0;
		$("#books").empty();
		$("#subtotal").html("Subtotal: $0.00");
	}
	
	function Book(name, price, merchant, isbn, sellPrice){
		this.name      = name;
		this.price     = price;
		this.merchant  = merchant;
		this.isbn	   = isbn;
		this.sellPrice = sellPrice;
		this.condition = "used";
		this.valid = true;
		
		this.setCondition = function(value){
			this.condition = value;
		}
		
		this.clear = function(){
			this.name     = "";
			this.price    = 0;
			this.merchant = 0;
			this.valid    = false;
		}
	}
</script>
</head>
<body>
<div data-role = "page">
	<div data-role = "header">
		<h1>Bookstore Buyback App</h1>
	</div>
	<div data-role = "content">
		<ul id = 'mainList' data-role = 'listview'>
		<li data-role = 'list-divider'>Isbns:</li>
		<li><form id = "isbnForm" data-ajax = "false" name = "form" onSubmit = "return getBuyback()">
			<input type = "text" id = "isbn_0" name = "isbn_0" class = "textBook"></input>
			<a href="#" id = 'submitButton' data-role="button" data-icon="search">Search</a>
		</form></li>
		
		<li data-role = 'list-divider'>Books:</li>
		<span id = 'books'></span>
		<li id = "output">
			<div id = "subtotal"></div>
		</li>
		<li data-role = 'list-divider'>Do you want to Buy?</li>
		<a id = 'buy_btn' data-role="button" data-rel = "dialog" href = "email_dialog.html" data-icon="check">Yes</a>
		<a id = 'dontBuy' data-role="button" data-icon="delete">No</a>
		</ul>
	</div>
	<div data-id = "footer" data-role = "footer" data-position = "fixed">
		<div data-role = "navbar">
			<ul>
				<li><a href="buyback.php" data-icon = "home" class = "ui-btn-active">Home</a></li>
				<li><a href = "appointment.html" data-icon = "grid">Appointments</a></li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>