<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <script src="switchStyle.js"></script>
		<script src="shared.js" language="JavaScript1.2"></script>
    <script src="jsjac.js"></script>
    <script>
      function setSubject() {

				var aMessage = new JSJaCMessage();
				aMessage.setTo(parent.group);
				aMessage.setType('groupchat');
				aMessage.setSubject(document.forms[0].elements['subject'].value);
				parent.srcW.con.send(aMessage);

        /* restore topic */
        if (top.user.roster.subject)
          document.forms[0].elements['subject'].value = top.user.roster.subject;
        else 
          document.forms[0].elements['subject'].value = '';

        return false;
      }
    </script>
  </head>

  <body style="margin:8px;">
    <form onSubmit="return setSubject();">
      <table width="100%">
          <tr>
            <td>Тема:&nbsp;</td>
            <td width="100%"><input type="text" style="width:100%;" name="subject"></span></td>
          </tr>
      </table>
    </form>
  </body>
</html>
