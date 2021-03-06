<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>JWChat - Buscar por Salas</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="shared.js"></script>
    <script src="switchStyle.js"></script>
    <script src="jsjac.js"></script>
    <script>
      <!--
var srcW; // the source window with necessary data

var conference_server;
function doSub() {
	conference_server = document.forms[0].conference_server.value;

	/* check for errors */
	if (conference_server.indexOf('@') != -1 || conference_server.indexOf('/') != -1) {
		alert("No parece ser un nombre válido de host");
		return false;
	}
	
	document.getElementById("search_tab").style.display = 'none';
	document.getElementById("search_result_tab").style.display = '';
	document.getElementById("search_result_iframe").style.display = 'none';
	document.getElementById("addbookmark_button").style.display = 'none';
	document.getElementById("join_room_button").style.display = 'none';
	document.getElementById("search_result_header").innerHTML = "Resultados de la b&uacute;squeda para "+conference_server;
	document.getElementById("search_result_info").innerHTML = "Buscando "+conference_server+". Por favor espere...";
	search_result_iframe.document.body.innerHTML = '';
	search_result_iframe.selectedRow = null;

	var iq = new JSJaCIQ();
	iq.setType('get');
	iq.setTo(conference_server);
	iq.setID(conference_server+"IQ");
	iq.setQuery('http://jabber.org/protocol/disco#items');

	me = this;
	srcW.con.send(iq,me.getDiscoItems);
	return false;
}

function getDiscoItems(iq) {
	if (!iq || iq.getType() != 'result') {
		document.getElementById("search_result_info").innerHTML = "¡Ocurrió un error!";
		if (iq)
			srcW.Debug.log(iq.getDoc().xml,1);
		return false;
	}
	srcW.Debug.log(iq.getDoc().xml,2);

	var myTable = search_result_iframe.document.createElement("TABLE");

	var myTableHead = search_result_iframe.document.createElement("THEAD");
	myTableBody = search_result_iframe.document.createElement("TBODY");

	var row = search_result_iframe.document.createElement("TR");
	var header = new Array("Sala","Descripción");
	var cell; 
	for (var i=0; i<header.length; i++) {
		cell = search_result_iframe.document.createElement("TH");
		cell.appendChild(search_result_iframe.document.createTextNode(header[i]));
		row.appendChild(cell);
	}
	myTableHead.appendChild(row);
	myTable.appendChild(myTableHead);

	myTable.appendChild(myTableBody);
				
	myTable.setAttribute("id","modTable");
	myTable.setAttribute("WIDTH","100%");
	myTable.setAttribute("BORDER","0");
	myTable.setAttribute("CELLSPACING","0");
	myTable.setAttribute("CELLPADDING","0");
	myTable.setAttribute("RULES","rows");
		
	// add table
	search_result_iframe.document.body.appendChild(myTable);	

	document.getElementById("search_result_iframe").style.display = '';
	document.getElementById("addbookmark_button").style.display = '';
	document.getElementById("join_room_button").style.display = '';
	document.getElementById("addbookmark_button").disabled = true;
	document.getElementById("join_room_button").disabled = true;

	disco_items = new Array();
	disco_at = 0;
	disco_items_length = iq.getQuery().getElementsByTagName('item').length;
	for (var i=0; i<iq.getQuery().getElementsByTagName('item').length; i++) {
	  var aNode = iq.getQuery().getElementsByTagName('item').item(i);
	  disco_items[aNode.getAttribute('jid')] = aNode;
	  
	  // get vcard
	  var aIQ = new JSJaCIQ();
	  aIQ.setTo(aNode.getAttribute('jid'));
	  aIQ.setType('get');
	  aIQ.appendNode('vCard', {'xmlns': 'vcard-temp'});
	  
	  srcW.con.send(aIQ, me.getVCard);
	}

	return false;
}

function getVCard(iq) {
	var aNode = disco_items[iq.getFrom()];
	
	row = search_result_iframe.document.createElement("TR");
	
	cell = search_result_iframe.document.createElement("TD");
	textN = search_result_iframe.document.createTextNode(aNode.getAttribute('name'));
	cell.appendChild(textN);
	row.appendChild(cell);
		
	cell = search_result_iframe.document.createElement("TD");
	if (iq.getType() == 'result' && iq.getNode().getElementsByTagName('DESC').item(0) && iq.getNode().getElementsByTagName('DESC').item(0).firstChild)
		textN = search_result_iframe.document.createTextNode(iq.getNode().getElementsByTagName('DESC').item(0).firstChild.nodeValue);
	else
		textN = search_result_iframe.document.createTextNode('\ ');
	cell.appendChild(textN);
	row.appendChild(cell);
	
	row.setAttribute("jid",aNode.getAttribute('jid'));
	myTableBody.appendChild(row);

	disco_at++;

	if (disco_at == disco_items_length) {
	// we're done tell frame about it
		search_result_iframe.init();
		document.getElementById("search_result_info").innerHTML = "Finalizado.";
	}
}

function joinRoom() {
	srcW.openGroupchat(search_result_iframe.selectedRow.getAttribute('jid'),srcW.nick);
	return false;
}

function backtosearch() {
	document.getElementById("search_result_tab").style.display = 'none';
	document.getElementById("search_tab").style.display = '';
	return false;
}

function init() {
	srcW = opener.srcW;
	if (srcW.DEFAULTCONFERENCESERVER)
		document.forms[0].conference_server.value = srcW.DEFAULTCONFERENCESERVER;
	document.getElementById("search_result_tab").style.display = 'none';
}

function cleanUp() {
}

function keyPressed(e) {
  if (e.keyCode == 13)
    return doSub();
  if (e.keyCode == 27)
    window.close();
  return true;
}

onkeydown = keyPressed;
onload = init;
onunload = cleanUp;
      //-->
    </script>
    <script for="document" event="onkeydown()" language="JScript">
      <!--
      return keyPressed(window.event);
      //-->
    </script>
  </head>
  <body style="margin:8px;">
		<div id="search_tab">
			<h2>Buscar salas</h2>
			<form name="sub" onsubmit="return doSub();">
				<table width="100%">
						<tr>
							<td nowrap>
								<label for="conference_server">Buscar Servidor:
							</td>
							<td width="100%">
								<input type="text" name="conference_server" style="width:100%;">
							</td>
							<td>
								<button type="submit">Buscar</button>
							</td>
						</tr>
				</table>
			</form>
		</div>
		<table id="search_result_tab" width="100%" height="100%">
				<tr><td><h2 id="search_result_header"></h2></td></tr>
				<tr><td id="search_result_info"></td></tr>
				<tr><td width="100%" height="100%"><iframe id="search_result_iframe" name="search_result_iframe" src="searchrooms_results_iframe.html" style="width:100%;height:100%;"></iframe></tr></td>
				<tr><td><hr noshade size=1></td></tr>
				<tr>
					<td align=right>
						<button id="addbookmark_button" onClick="return addBookmark();" disabled>Marcador</button>&nbsp;<button id="join_room_button" onClick="return joinRoom();">Entrar</button>&nbsp;<button onClick="return backtosearch();">Atrás</button>
					</td>
				</tr>
		</table>
  </body>
</html>
