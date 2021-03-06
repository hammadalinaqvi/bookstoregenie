<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>JWChat - Groupchat</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
<script>
 // this one's needed to make roster.js work
var JABBERSERVER = opener.JABBERSERVER;
</script>
    <script src="shared.js"></script>
    <script src="browsercheck.js"></script>
    <script src="emoticons.js"></script>
    <script src="config.js"></script>
    <script src="statusLed.js"></script>
    <script src="jsjac.js"></script>
    <script src="roster.js"></script>
    <script language="JavaScript1.2">
<!--
var colors = new Array('maroon','green','olive','navy','purple','teal','red','blue');

var scrollHeight = 0;
function putMsgHTML(msg,mtime,user,usercolor,err) {
  var msgHTML = '';
  
  msgHTML += "<div><span class=time>["+mtime+"] </span>";    
  
  if (msg.match(/^\/me /)) {
    msg = msgFormat(msg);
    msg = msg.replace(/^\/me /,"<span style=\"color:green;font-weight:bold;\" class=msgnick title='@ "+mtime+"'>*&nbsp;"+htmlEnc(user)+"</span> ");
  } else if (user != group) {
    msg = msgFormat(msg);
    msgHTML += "<span style=\"color:"+usercolor+";\" class=msgnick title='@ "+mtime+"'>&lt;" + htmlEnc(user) + "&gt;</span>&nbsp;";
  }

  if (user == group) {/* channel status messages */
    if (err)
      msgHTML += "<span style=\"font-weight:bold;color:red;\">"+msg+"</span>";
    else
      msgHTML += "<span style=\"font-weight:bold;\">"+msg+"</span>";
  } else {
    if (user != nick && meRegExp.test(msg) && !notHREFMeRegExp.test(msg))
      msgHTML += "&nbsp;" + msg.replace(meRegExp,"<span class='highlighted'>$1</span>");
    else 
      msgHTML +=  msg;
  }

  msgHTML += "</div>";

  var scroll_bottom = false;
  if (cFrame.body.scrollTop+cFrame.body.clientHeight >= cFrame.body.scrollHeight)
    scroll_bottom = true;
				
  cFrame.body.innerHTML += msgHTML;

  if (scroll_bottom)
    frames.groupchatChat.groupchatIChat.scrollTo(0,cFrame.body.scrollHeight);
}

function popMsgs() {

  if (!user) 
    user = srcW.roster.getUserByJID(group);

  while (user.chatmsgs.length>0) {
    var msg;
    if (is.ie5||is.op) {
      msg = user.chatmsgs[0];
      user.chatmsgs = user.chatmsgs.slice(1,user.chatmsgs.length);
    } else
      msg = user.chatmsgs.shift();

    var from = msg.getFrom();
    if (msg.getFrom().indexOf('/') != -1)
      from = msg.getFrom().substring(msg.getFrom().indexOf('/')+1);

    /* get date */
    var timestamp;
    if (msg.jwcTimestamp)
      timestamp = msg.jwcTimestamp;
    else
      timestamp = new Date();

    var mtime = '';
    if (new Date() - timestamp > 24*3600*1000)
      mtime += timestamp.toLocaleDateString() + " ";
		
    mtime += timestamp.toLocaleTimeString();
    
    /* look for a subject */
    if (msg.getSubject()) { // set topic
      user.roster.subject = msg.getSubject();
      frames.groupchatTop.document.forms[0].elements['subject'].value = msg.getSubject();
      putMsgHTML("/me veranderde het onderwerp in: "+msg.getSubject(), mtime, from);
      return;
    }

    if(!msg.getBody() || msg.getBody() == '')
      return;
	
    /* calculate color */
    var charSum = 0;
    for (var i=0; i<from.length; i++)
      charSum += from.charCodeAt(i);
    
    putMsgHTML(msg.getBody(),mtime,from,colors[charSum%(colors.length)]);
  }

  /* disabled: it's annoying */
  //  if (srcW.focusWindows) frames.groupchatBottom.document.forms[0].msgbox.focus();
}

function displayTimestamp() {
  var tstyle;
  if (is.ie) {
    tstyle = cFrame.styleSheets('timestampstyle');
    tstyle.disabled = opener.top.timestamps;
  } else {
    tstyle = cFrame.getElementById("timestampstyle");
    tstyle.sheet.disabled = opener.top.timestamps;
  }
}

function updateMe() {
  frames.groupchatTop.document.forms[0].subject.disabled = (roster.me.role == 'none');
  frames.groupchatBottom.document.forms[0].submit.disabled = (roster.me.role == 'none');

  if (roster.me.affiliation == 'owner')
    frames.groupchatBottom.document.getElementById('config_chan_button').style.display = '';
  else
    frames.groupchatBottom.document.getElementById('config_chan_button').style.display = 'none';

  if (roster.me.role == 'none') {// seems we left
    cFrame.body.innerHTML += "<span style='color:red';>"+"Niet verbonden."+"</span><br>";
    frames.groupchatChat.groupchatIChat.scrollTo(0,cFrame.body.scrollHeight);
  }

  if (frames.groupchatRoster.updateMe)
    frames.groupchatRoster.updateMe();
}

function changeUserStat(jid,stat,val,confirm,reason) {
  var user = roster.getUserByJID(jid);
  var iq = new JSJaCIQ();
  iq.setType('set');
  iq.setTo(group);

  var query = iq.setQuery('http://jabber.org/protocol/muc#admin');
  var item = query.appendChild(iq.getDoc().createElement('item'));
  item.setAttribute('nick',user.name);

  item.setAttribute(stat,val);
	
  if (reason || (confirm && (reason = prompt("Reason","")) != ''))
    item.appendChild(iq.getDoc().createElement('reason')).appendChild(iq.getDoc().createTextNode(reason));

  me = this;
  srcW.con.send(iq,me.handleError);
}

function handleError(iq) {
  // handle error
  if (iq && iq.getType() == 'error') {
    srcW.Debug.log(iq.xml(),1);
    var error = iq.getNode().getElementsByTagName('error').item(0);
    if (error) {
      var msg = '';
      for (var i=0; i<error.childNodes.length; i++) {
        switch (error.childNodes.item(i).nodeName) {
        case 'not-allowed':
          putMsgHTML("Niet toegestaan",new Date(),group,null,true);
          break;
        case 'forbidden':
          putMsgHTML("Verboden",new Date(),group,null,true);
          break;
        case 'item-not-found':
          putMsgHTML("Niet gevonden",new Date(),group,null,true);
          break;
        default:
          putMsgHTML(error.childNodes.item(i).nodeName,new Date(),group,null,true);
          break;
        }
      }
    }
  }
}

function changeRole(jid,role,confirm,reason) {
  changeUserStat(jid,"role",role,confirm,reason);
}

function changeAffiliation(jid,affil,confirm,reason) {
  changeUserStat(jid,"affiliation",affil,confirm);
}

var configW
function openConfig() {
  if (!configW || configW.closed)
    configW = open("groupchatconfig.html","gccW"+makeWindowName(jid),"width=480,height=380,resizable=yes,scrollbars=yes");
  configW.focus();
  return false;
}

function cleanUp() {
  if (configW && !configW.closed)
    configW.close();
}

function part() {
  cleanUp();

  if (srcW.con) {
    var presence = new JSJaCPresence();
    presence.setType('unavailable');
    presence.setTo(group);
    srcW.con.send(presence);
  }

  if (!user.messages.length && !user.chatmsgs.length && srcW && srcW.roster) {
    srcW.roster.removeUser(user);
    srcW.roster.print();
  }
}

/* global vars */
var srcW,user,roster,cFrame,jid,nick,pass,meRegExp,notHREFMeRegExp;

function init() {
  getArgs();
  
  srcW = opener;
 
  jid = passedArgs['jid'];
  group = jid;

  if (typeof(passedArgs['nick']) != 'undefined')
    nick = passedArgs['nick'];
  if(typeof(nick) == 'undefined' || nick == '')
    nick = srcW.roster.nick; // guess a nick

  meRegExp = new RegExp("\\b("+nick+")\\b","i");
  notHREFMeRegExp = new RegExp("href=\"\\S*\\b"+nick+"\\b\\S*\"","i");

  if (passedArgs['pass'] != 'undefined')
    pass = passedArgs['pass'];

  srcW.Debug.log("groupchat room: "+jid+", nick: "+nick + ", pass: "+pass ,2);
  
  // send presence
  var aPresence = new JSJaCPresence();
  aPresence.setTo(group+'/'+nick);

  var x = aPresence.appendNode('x', 
	{'xmlns': 'http://jabber.org/protocol/muc'});
  if (typeof(pass) != 'undefined' && pass != '')
    x.appendChild(aPresence.buildNode('password' ,pass));

  if (srcW.onlstat != 'available' && srcW.onlstat != 'invisible')
    aPresence.setShow(srcW.onlstat);

  if (srcW.onlmsg != '')
    aPresence.setStatus(srcW.onlmsg);

  srcW.Debug.log("sending muc presence:\n"+aPresence.xml(),3);

  srcW.con.send(aPresence);
  
  cFrame = frames.groupchatChat.groupchatIChat.document;

  user = srcW.roster.getUserByJID(group);
  if(!user) {
    user = srcW.roster.addUser(new RosterUser(group,'',["Chatruimtes"],group.substring(0,group.indexOf('@'))));
    user.chatW = window.self;
  }
  user.status = 'available';
  srcW.roster.print();
  
  user.roster = new GroupchatRoster(window.self);
  user.roster.nick = nick; // remember my nickname
  roster = user.roster;
  //        user.roster.print();
  
  //  document.title += " - " + group;
  document.title = group+'/'+nick;

  popMsgs();
  displayTimestamp();
}

function keyPressed(e) {
  if (e.keyCode == 27)
    window.close();
}

function updateStyleIE() {
  try {
    if (user && user.roster)
      user.roster.updateStyleIE();
  } catch(e) {}
}

onkeydown = keyPressed;
onload = init;
onunload = part;
onresize = updateStyleIE;
//-->
    </script>

    <script for="document" event="onkeydown()" language="JScript">
      <!--
      if (window.event && window.event.keyCode == 27)
      window.close();
      //-->
    </script>
  </head>

  <frameset cols="75%,*" frameborder=2 framespacing=2 border=2 bordercolor=black>
    <frameset rows="40,*,90" frameborder=2 framespacing=2 border=2 bordercolor=black>
      <frame src="groupchat_top.html" name="groupchatTop" scrolling="no" />
        <frame src="groupchat_chat.html" name="groupchatChat" scrolling="no" />
          <frame src="groupchat_bottom.html" name="groupchatBottom" scrolling="no" />
    </frameset>
    <frame src="groupchat_roster.html" name="groupchatRoster" scrolling="no" />
  </frameset>
</html>
