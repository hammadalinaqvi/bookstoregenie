<?php require_once("security/password_protect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel = "stylesheet" href = "http://www.bookstoregenie.com/style/control_panel.css" type = 'text/css' />
		<link rel = "stylesheet" type = "text/css" href = "style/jquery.loading.1.6.css" />
		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script> Using local jquery script for now because I have no internet, undo this before upload-->
		<script src = "script/jquery.js" type = "text/javascript"></script>
		<script src = "script/jquery.loading.1.6.4.js" type = "text/javascript"></script>
		<script type = "text/javascript">
			var rep_arr = new Array(), sortLow = false;
			$(document).ready(function(){
				$("#representatives").loading(true, {mask:true, img: "images/loading.gif", align: "center"});
				$.ajax({
					url: 'rep_managment.php',
					data: {'type': 'repOverview'},
					type: "POST",
					success: function(data){
						var totalBuy = 0, totalSell = 0;
						data = eval ("(" + data + ")");
						for (var i = 0; i < data.length; i++){
							rep_arr.push(new rep(data[i].firstName, data[i].lastName, data[i].buy, data[i].sell, data[i].id));
							totalBuy  += data[i].buy;
							totalSell += data[i].sell;
							var index = rep_arr.length - 1;
							$("#reps").append("<li id = 'repRow" + index + "' onClick = 'repClick(" + index + ")' class = 'repRow'><div class = 'rowContent'><div class = 'repRowItem name'>" + data[i].firstName + "</div><div class = 'repRowItem buyPrice'>$" + data[i].buy + "</div><div class = 'repRowItem sellPrice'>$" + data[i].sell + "</div></div></li>");
						}
						totalBuy  = Math.round(totalBuy * 100) / 100;
						totalSell = Math.round(totalSell * 100) / 100;
						$("#representatives").append("<li id = 'repRow' class = 'repRow'><div class = 'rowContent'><div class = 'repRowItem name'>Total</div><div class = 'repRowItem buyPrice'>$" + totalBuy + "</div><div class = 'repRowItem sellPrice'>$" + totalSell + "</div></div></li>");
						$("#representatives").loading(false);
					},
					failure: function(error){
						alert ("Unable to get Representative Information, please check your internet connection");
					}
				});
				
				$("#buyTitle").click(function(){
					var thisRep;
					if (sortLow){
						sortLow = false;
						rep_arr.sort(function(a, b){
							return (a.buyPrice - b.buyPrice);
						});
					}else{
						sortLow = true;
						rep_arr.sort(function(a, b){
							return (b.buyPrice - a.buyPrice);							
						});
					}
					resetReps();
				});
				$("#sellTitle").click(function(){
					var thisRep;
					if (sortLow){
						sortLow = false;
						rep_arr.sort(function(a, b){
							return (a.sellPrice - b.sellPrice);
						});
					}else{
						sortLow = true;
						rep_arr.sort(function(a, b){
							return (b.sellPrice - a.sellPrice);							
						});
					}
					resetReps();
				});
			});
			
			function resetReps(){
				$("#reps").empty();
				//$("#reps").append("<li class = 'repRow'><div id = 'nameTitle' class = 'repRowTitle'>Name</div><div id = 'buyTitle' class = 'repRowTitle'>Total Money Spent</div><div id = 'sellTitle' class = 'repRowTitle'>Total Revenue</div>");
				for (var i = 0; i < rep_arr.length; i++){
					thisRep = rep_arr[i];
					$("#reps").append("<li id = 'repRow" + i + "' onClick = 'repClick(" + i + ")' class = 'repRow'><div class = 'rowContent'><div class = 'repRowItem name'>" + thisRep.firstName + "</div><div class = 'repRowItem buyPrice'>$" + thisRep.buyPrice + "</div><div class = 'repRowItem sellPrice'>$" + thisRep.sellPrice + "</div></div></li>");
				}
			}
			
			function repClick(index){
				$.ajax({
					url: 'rep_managment.php',
					type: "POST",
					data: {'type': 'repWeek', 'id': rep_arr[index]['id']},
					success: function(data){
						data = eval("(" + data + ")");
						$("#weeksContainer").empty();
						for (var i = 0; i < data.length; i++)
							$("#weeksContainer").append("<li class = 'weekRow' onClick = 'bookData(" + index + ")'><div class = 'rowContent'><div class = 'weekRowContent weekRowName'>" + data[i].info.weekString + "</div><div class = 'weekRowBuy weekRowContent'>$" + data[i].money.buyTotal + "</div><div class = 'weekRowSell weekRowContent'>$" + data[i].money.sellTotal + "</div></li>");
							
						$("#weeks").slideDown(600);
					},
					failure: function(error){
						alert ("Unable to retrieve informatino for representative, please check your internet connection " + error);
					}
				})
			}
			
			function bookData(index){
				$.ajax({
					url: 'rep_managment.php',
						type: "POST",
						data: {'type': 'singleRep', 'id': rep_arr[index]['id']},
						success: function(data){
							data = eval("(" + data + ")");
							$("#data").empty();
							for (var i = 0; i < data.length; i++)
								$("#data").append("<li class = 'dataRow'><div class = 'rowContent'><div class = 'dataRowContent dataRowIsbn'>" + data[i].isbn + "</div><div class = 'dataRowName dataRowContent'>" + data[i].title + "</div><div class = 'dataRowSell dataRowContent'>" + data[i].sellPrice + "</div><div class = 'dataRowBuy dataRowContent'>" + data[i].buyPrice + "</div><div class = 'dataRowMerchant dataRowContent'>" + data[i].merchantName + "</div></div></li>");
								
							$("#singleRep").slideDown(600);
						},
						failure: function(error){
							alert ("Unable to retrieve informatino for representative, please check your internet connection " + error);
						}
					})
			}
			
			function rep(firstName, lastName, buyPrice, sellPrice, id){
				this.firstName  = firstName;
				this.lastName   = lastName;
				this.buyPrice   = buyPrice;
				this.sellPrice  = sellPrice;
				this.id			= id;
			}
		</script>
	</head>
	<body>
		<div id = "wrapper">	
			<ul id = 'representatives'>
				<li class = 'repRow'><div id = 'nameTitle' class = 'repRowTitle'>Name</div><div id = 'buyTitle' class = 'repRowTitle'>Total Money Spent</div><div id = 'sellTitle' class = 'repRowTitle'>Total Revenue</div>
				<span id  = "reps">
				</span>
				<li class = "repRow"></li>
			</ul>
			<ul id = 'weeks' style = "display: none">
				<li class = 'weekRow'><div id = 'weekNameTitle' class = 'weekRowTitle'>Week</div><div id = 'weekSpentTitle' class = 'weekRowTitle'>Total Money Spent</div><div id = 'weekSoldTitle' class = 'weekRowTitle'>Total Revenue</div></li>
				<span id = 'weeksContainer'>
				</span>
			</ul>
			<ul id = 'singleRep' style = 'display: none'>
				<li class = 'dataRow'><div id = 'isbnTitle' class = 'dataRowTitle'>ISBN</div><div id = 'titleTitle' class = 'dataRowTitle'>Title</div><div id = 'sellPriceTitle' class = 'dataRowTitle'>Sold For</div><div id = 'buyPriceTitle' class = 'dataRowTitle'>Bought For</div><div class = 'dataRowTitle' id = 'merchantTitle'>Sold To</div></li>
				<span id = 'data'>
				</span>
			</ul>
		</div>
	</body>
</html>