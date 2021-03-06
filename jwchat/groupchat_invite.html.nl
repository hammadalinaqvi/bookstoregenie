<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>JWChat - Uitnodigen</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="shared.js"></script>
    <script src="switchStyle.js"></script>
    <script src="jsjac.js"></script>
    <script>
      <!--

function doSub() {
  if (document.forms[0].invite[0].checked) {
	srcW.openGroupchat(to,srcW.jid.substring(0,srcW.jid.indexOf('@')),pass);
  } else { // decline
	var aMessage = new JSJaCMessage();
	aMessage.setTo(to);
	var x = aMessage.appendNode('x', {'xmlns': 'http://jabber.org/protocol/muc#user'});
	var decline = x.appendChild(aMessage.getDoc().createElement('decline'));
	decline.setAttribute('to',from);
	if (document.forms[0].reason.value != '')
	  decline.appendChild(aMessage.getDoc().createElement('reason')).appendChild(aMessage.getDoc().createTextNode(document.forms[0].reason.value));
	srcW.con.send(aMessage);
  }
  window.close();
}

var srcW, to, from, pass;
function init() {
	srcW = opener;

	getArgs();
	
	to = passedArgs['to'];
	from = passedArgs['from'];
	pass = passedArgs['pass'];
	var reason = passedArgs['reason'];

	document.getElementById('to').innerHTML = to;
	document.getElementById('from').innerHTML = "<span class=\"link\" onClick=\"return srcW.openUserInfo('"+from+"');\">"+from+"</span>";

	if (typeof(reason) != 'undefined' && reason != 'undefined')
		document.getElementById('reason').innerHTML = htmlEnc(reason);
	else
		document.getElementById('reason').innerHTML = "Geen opgegeven";

	document.title = "Uitnodiging op "+to;
}

onload = init;
      //-->
    </script>
  <body style="margin:8px;">
		<table width="100%" height="100%">
		<tr><td colspan=2><h2 id="title">Uitnodiging op chatruimte</h2></td></tr>
		<tr><td>Chatruimte:</td><td id="to"></td></tr>
		<tr><td>Van:</td><td id="from"></td></tr>
		<tr><td>Boodschap:</td><td id="reason"></td></tr>
		<tr><td colspan=2><hr noshade size=1></td></tr>
    <form name="sub" onsubmit="return doSub();">
		<tr><td colspan=2 width="100%" height="100%">
		<table width="100%" height="100%">
		<tr><td><input type=radio name="invite" value="join" id="join" checked></td><td><label for="join">Betreden</label></td></tr>
		<tr><td><input type=radio name="invite" value="decline" id="decline"></td><td><label for="decline">Weigeren</label></td></tr>
		<tr><td>&nbsp;</td><td>Boodschap:</td></tr>
		<tr>
		<td>&nbsp;</td>
		<td width="100%" height="100%">
		<textarea name="reason" style="width:100%;height:100%"></textarea>
		</td>
		</tr>
		</table>
		</td></tr>
		<tr><td colspan=2><hr noshade size=1></td></tr>
		<tr><td colspan=2 align=right>
		<button type=submit>Verzenden</button>
    </form>
		<td></tr>
		</table>
  </body>
</html>
