<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>JWChat - История сообщений</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="shared.js"></script>
    <script src="emoticons.js"></script>
    <script src="switchStyle.js"></script>
    <script src="jsjac.js"></script>
    <script>
      <!--
function reloadHistory(iq) {

  if (iq && iq.getType != 'result')
	srcW.Debug.log(iq.xml(),1);

  // clear iframes
  selected_collection.document.body.innerHTML = '';
  collections.document.body.innerHTML = '';

  // get collections
  var aIQ = new JSJaCIQ();
  aIQ.setType('get');
  aIQ.setTo(srcW.loghost);
  var aNode = aIQ.appendNode(
	'list', 
	{'xmlns': 'http://jabber.org/protocol/archive',
	 'with': jid});
  srcW.con.send(aIQ,me.handleCollsGet);

  return false;
}

function handleCollGet(iq) {
	if (!iq || iq.getType() != 'result')
		return;

	srcW.Debug.log(iq.xml(),2);

	var histHTML = '';

	var aStore = iq.getNode().firstChild;
	for (var i=0; i<aStore.childNodes.length; i++) {
		var aChild = aStore.childNodes.item(i);
		if (aChild.nodeName == 'to') // message from me
			histHTML += "<font color=\"blue\">&lt;" + srcW.nick + "&gt;</font> ";
		else
			histHTML += "<font color=\"red\">&lt;" + user.name + "&gt;</font> ";

		if (aChild.firstChild.firstChild)
			histHTML += htmlEnc(aChild.firstChild.firstChild.nodeValue);
		histHTML += '<br>';
		continue;
	}
	selected_collection.document.body.innerHTML = histHTML;
}

function handleCollsGet(iq) {
	if (!iq || iq.getType() != 'result')
		return;

	srcW.Debug.log(iq.getDoc().xml,2);

	var items = iq.getNode().firstChild.getElementsByTagName('store');

	var myTable = collections.document.createElement("TABLE");
	var myTableBody = collections.document.createElement("TBODY");

	myTable.appendChild(myTableBody);

	var row, cell, textN;
	for (var i=0; i<items.length; i++) {

		var item = items.item(i);

		row = collections.document.createElement("TR");
		row.setAttribute("start",item.getAttribute('start'));
		myTableBody.appendChild(row);

		cell = collections.document.createElement("TD");
		row.appendChild(cell);

		textN = collections.document.createTextNode(hrTime(item.getAttribute('start')));
		cell.appendChild(textN);

	}

	myTable.setAttribute("id","myTable");
	myTable.setAttribute("WIDTH","100%");
	myTable.setAttribute("BORDER","0");
	myTable.setAttribute("CELLSPACING","0");
	myTable.setAttribute("CELLPADDING","0");
	myTable.setAttribute("RULES","rows");

	// add table
	collections.document.body.appendChild(myTable);

	// tell frame about it
	collections.init();
}

function deleteHistory() {
  if (!confirm("Вы уверены что хотите полностью удалить эту историю сообщений?"))
	return;

  var aIQ = new JSJaCIQ();
  aIQ.setType('set');
  aIQ.setTo(srcW.loghost);
  var aNode = 
	aIQ.appendNode('remove',
				   {'xmlns': 'http://jabber.org/protocol/archive',
					'with': jid});
	
  srcW.Debug.log(aIQ.xml(),2);

  me = this;
  srcW.con.send(aIQ,me.reloadHistory);
}

var srcW;
function init() {
	// determine source window
	if (opener.top.roster)
		srcW = opener.top;
	if (typeof(srcW) == 'undefined' || !srcW)
		return;

	getArgs();
	jid = passedArgs['jid'];

	if (typeof(jid) == 'undefined' || jid == '') {
		alert("Отсутствует JID.\nОтмена операции...");
		window.close();
	}

	user = srcW.roster.getUserByJID(jid);

	var dtitle = "История сообщений для "+user.name;
	document.getElementById('title').innerHTML = dtitle;
	document.title = dtitle;

	// get collections
	var aIQ = new JSJaCIQ();
	aIQ.setType('get');
	aIQ.setTo(srcW.loghost);
  var aNode = 
	aIQ.appendNode('list',
				   {'xmlns': 'http://jabber.org/protocol/archive',
					'with': jid});
  me = this;
  srcW.con.send(aIQ,me.handleCollsGet);
}

function keyPressed(e) {
  if (e.keyCode == 27)
    window.close();
  return true;
}

onkeydown = keyPressed;
onload = init;
      //-->
    </script>
    <script for="document" event="onkeydown()" language="JScript">
      <!--
      return keyPressed(window.event);
      //-->
    </script>
  </head>
  <body style="margin:8px;">
		<table width="100%" height="100%" border=0>
				<tr>
					<td><h2 id="title"></h2></td><td align="right"><button onClick="deleteHistory();">Удалить</button> <button onClick="reloadHistory();">Обновить</td>
				</tr>
				<tr height="100%">
					<td>
						<iframe id="collections" name="collections" src="userhist_collections_iframe.html" style="width:240px;height:100%;" scrolling="auto"></iframe>
					</td>
					<td width="100%">
						<iframe id="selected_collection" name="selected_collection" src="chat_iframe.html" style="width:100%;height:100%;"></iframe>
					</td>
				</tr>
		</table>
  </body>
</html>
