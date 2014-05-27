<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>JWChat - Inschrijven op de aanwezigheid van de contactpersoon</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="shared.js"></script>
    <script src="switchStyle.js"></script>
    <script src="jsjac.js"></script>
    <script language="JavaScript1.2">
      <!--
var jid;
var srcW; // the source window with necessary data

function sendSub() {
  var aPresence = new JSJaCPresence();
  aPresence.setType('subscribe');
  
  if (!document.forms[0].to.value || document.forms[0].to.value == '') {
    alert("De JID ontbreekt");
    document.forms[0].to.focus();
    return false;
  }

  var to = document.forms[0].to.value;
  if (to.indexOf('@') == -1)
    to += '@' + srcW.JABBERSERVER;

  aPresence.setTo(to);
  if (document.forms[0].msg.value && document.forms[0].msg.value != '')
    aPresence.setStatus(document.forms[0].msg.value);

  srcW.con.send(aPresence);
    
  window.close();
}

function selectService(selbox) {
  var el = selbox.options[selbox.selectedIndex];
  var to = document.forms[0].elements['to'];
  // cut off node
  var i = to.value.indexOf('@');
  if (i != -1)
    to.value = to.value.substring(0,i);
  if (el.value != '')
    to.value += "@" + el.value;
}

function init() {
  // determine source window
  if (opener.roster)
    srcW = opener.top;
  else
    srcW = opener.opener.top;
  
  getArgs();
  jid = (passedArgs['jid'])?passedArgs['jid']:'';
  
  document.title = "Inschrijvingsaanvraag verzenden";
  document.title += (jid)?" aan " + jid:"";
  if (jid)
    document.forms[0].to.value = jid;
  
  /* detect services */
	
  var services = document.forms[0].elements["services"];
  var optidx=1;
  for (var i in srcW.disco) {
    if (!srcW.disco[i].getNode) continue;
    if (srcW.disco[i].getNode().getElementsByTagName('identity').item(0)) {
      var item = srcW.disco[i].getNode().getElementsByTagName('identity').item(0);
      if (item.getAttribute('category') == 'gateway')
	services.options[optidx++] = new Option(item.getAttribute('name'),srcW.disco[i].getFrom());
    }
  }

}
		
function keyPressed(e) {
  if (e.ctrlKey && e.keyCode == 13)
    sendSub();
  else if (e.keyCode == 27)
    window.close();
}
onkeydown = keyPressed;
onload = init;
      //-->
    </script>
    <script for="document" event="onkeydown()" language="JScript">
      <!--
      if (window.event.ctrlKey && window.event.keyCode == 13)
      sendSub();
      if (window.event.keyCode == 27)
      window.close();
      //-->
    </script>
  </head>
  <body style="margin:8px">
    <form name="sub" style="border:0;padding:0;margin:0;" onSubmit="return sendSub();">
      <table border="0" width="100%" height="100%">
          <tr><td nowrap>Contactpersoon zoeken:</td><td><button onClick="return srcW.openSearch();">Zoekvenster openen</button></td></tr>
          <tr><td colspan=2><hr noshade size="1" size="100%"></td></tr>
          <tr>
            <td align="right" nowrap><label for="to">Inschrijvingsaanvraag verzenden aan</label></td>
            <td width="100%"><input type="text" id="to" name="to" size="1" style="width:100%;" tabindex="1"></td>
          </tr>
          <tr>
            <td nowrap align="right"><label for="services">Dienst (optioneel)</label></td>
            <td width="100%">
              <select name="services" id="services" onChange="selectService(this);" tabindex="2"><option value="">lokale Jabber-gebruiker</option></select>
            </td>
          </tr>
          <tr height="100%">
            <td colspan=2>
              <textarea id="msg" wrap="physical" class="msgBox" tabindex="3">Ik zou u graag willen toevoegen aan mijn roster.</textarea>
            </td>
          </tr>
          <tr><td colspan="2"><hr noshade size="1" size="100%"></td></tr>
          <tr>
            <td colspan="2" align="right">
              <button type="button" onClick="window.close();" tabindex="5">Annuleren</button>&nbsp;<button type="submit" tabindex="4">Verzenden</button>
            </td>
          </tr>
      </table>
    </form>
  </body>
</html>
