<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>JWChat - Результаты поиска</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="switchStyle.js"></script>
		<script>

var ie5 = document.all&&document.getElementById;

function init() {
	var rows = document.getElementsByTagName('tr');
	for (var i=1; i<rows.length; i++) {
		rows[i].onmouseover = highlightRow;
		rows[i].onmouseout = unhighlightRow;
		rows[i].onclick = rowClicked;
		rows[i].title = "щёлкните для добавления пользователя";
	}
}
function highlightRow(e) {
 	var row = ie5 ? event.srcElement.parentNode : e.target.parentNode;
	row.className = 'highlighted';
}
function unhighlightRow(e) {
 	var row = ie5 ? event.srcElement.parentNode : e.target.parentNode;
	if (row != selectedRow)
		row.className = '';
}

var selectedRow;
function rowClicked(e) {
	if (selectedRow)
		selectedRow.className = '';
	else { 
		parent.document.getElementById('add_button').disabled = false;
		parent.document.getElementById('info_button').disabled = false;
	}
 	selectedRow = ie5 ? event.srcElement.parentNode : e.target.parentNode;
	selectedRow.className = 'highlighted';
}
		</script>

		<style type="text/css">
			body { background-color: white; }
			th { 
			font-size: 12px; 
			border-bottom: 1px solid black;
			padding: 2px;
			}
			td {
			border-bottom: 1px solid black;
			padding: 2px;
			}
			tr.highlighted {
			color: highlighttext;
			background-color: highlight;
			}
		</style>
  </head>
  <body id="results">
  </body>
</html>
