
<?php
  // this script will create a new subdomain for the organization, assign it an api key, and craete a new directory for the subdomain and place the appropiate files in it
  // globals
  $apiTable = "apikeys";
  $organizationTable = "organizations";

  getVars();
  dbConnect();
  $apiKey = getApiKey();
  
  insertOrganization();
  
  function insertOrganization(){
    global $orgname, $email, $phone, $name, $paypal, $apiKey, $organizationTable, $subdomain, $university;
    $query = "INSERT INTO {$organizationTable} (`name`, `email`, `phone`, `contactName`, `paypal`, `subdomain`, `key`, `university`) VALUES ('{$orgname}', '{$email}', '{$phone}', '{$name}', '{$paypal}', '{$subdomain}', '{$apiKey}', '{$university}')";
    mysql_query($query);
    echo mysql_error();
  }

  function getApiKey(){
    global $apiTable;
    
    $query  = "SELECT * FROM {$apiTable} WHERE USED = 0";
    $result = mysql_query($query);
    $row    = mysql_fetch_assoc($result);

    $apiKey = $row['key'];
    $query  = "UPDATE {$apiTable} SET `used` = 1 WHERE `key` = '{$apiKey}'";
    mysql_query($query);
    echo mysql_error();
    return $apiKey;
  }

  function getVars(){
    global $orgname, $email, $phone, $name, $paypal, $subdomain, $university;
    $university = $_REQUEST['university'];
    $orgname    = $_REQUEST['orgname'];
    $email      = $_REQUEST['email'];
    $phone      = $_REQUEST['contactPhone'];
    $name       = $_REQUEST['contactName'];
    $paypal     = $_REQUEST['payPal'];
    $subdomain  = $_REQUEST['subdomain'];
  }

  function dbConnect(){
	$host      		 = "localhost";
	$database  		 = "jteplitz_bookstore";
	$user	  		 = "jteplitz";
	$pass	   		 = "jtt0511";
	mysql_connect($host, $user, $pass);
	mysql_select_db($database);
  }

  // start of subdomain script

###############################################################
# cPanel Subdomains Creator 1.1
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
###############################################################
#
# Can be used in 3 ways:
# 1. just open script in browser and fill the form
# 2. pass all info via url and form will not appear
# Sample: cpanel_subdomains.php?cpaneluser=USER&cpanelpass=PASSWORD&domain=DOMAIN&subdomain=SUBDOMAIN
# 3. list subdomains in file. In this case you must provide all the defaults below
#
# Note: you can omit any parameter, except "subdomain".
# When omitted, default value specified below will be taken
###############################################################

// cpanel user
define('CPANELUSER','jteplitz');

// cpanel password
define('CPANELPASS','jtt0511');

// name of the subdomains list file.
// file format may be 1 column or 2 columns divided with semicilon (;)
// Example for two columns:
//   rootdomain1;subdomain1
//   rootdomain1;subdomain2
// Example for one columns:
//   subdomain1
//   subdomain2
define('INPUT_FILE','domains.txt');

// cPanel skin (mainly "x")
// Check http://www.zubrag.com/articles/determine-cpanel-skin.php
// to know it for sure
define('CPANEL_SKIN','x3');

// Default domain (subdomains will be created for this domain)
// Will be used if not passed via parameter and not set in subdomains file
define('DOMAIN','home/jason/www/organizations');

/////////////// END OF INITIAL SETTINGS ////////////////////////
////////////////////////////////////////////////////////////////

function getVar($name, $def = '') {
  if (isset($_REQUEST[$name]) && ($_REQUEST[$name] != ''))
    return $_REQUEST[$name];
  else 
    return $def;
}

$cpaneluser=getVar('cpaneluser', CPANELUSER);
$cpanelpass=getVar('cpanelpass', CPANELPASS);
$cpanel_skin = getVar('cpanelskin', CPANEL_SKIN);

/*if (isset($_REQUEST["subdomain"])) {
  // get parameters passed via URL or form, emulate string from file 
  $doms = array( getVar('domain', DOMAIN) . ";" . $_REQUEST["subdomain"]);
  if (getVar('domain', DOMAIN) == '') die("You must specify domain name");
}
else {
  // open file with domains list
  $doms = @file(INPUT_FILE);
  if (!$doms) {
    // file does not exist, show input form
    echo "
Cannot find input file with subdomains information. It is ok if you are not creating subdomains from file.<br>
Tip: leave field empty to use default value you have specified in the script's code.<br>
<form method='post'>
  Subdomain:<input name='subdomain'><br>
  Domain:<input name='domain'><br>
  cPanel User:<input name='cpaneluser'><br>
  cPanel Password:<input name='cpanelpass'><br>
  cPanel Skin:<input name='cpanelskin'><br>
  <input type='submit' value='Create Subdomain' style='border:1px solid black'>
</form>";
    die();
  }
}*/

// create subdomain
function subd($host,$port,$ownername,$passw,$request) {

  $sock = fsockopen('localhost',2082);
  if(!$sock) {
    print('Socket error');
    exit();
  }

  $authstr = "$ownername:$passw";
  $pass = base64_encode($authstr);
  $in = "GET $request\r\n";
  $in .= "HTTP/1.0\r\n";
  $in .= "Host:$host\r\n";
  $in .= "Authorization: Basic $pass\r\n";
  $in .= "\r\n";
 
  fputs($sock, $in);
  while (!feof($sock)) {
    $result .= fgets ($sock,128);
  }
  fclose( $sock );

  return $result;
}

$domain = getVar('domain', DOMAIN);
$request = "/frontend/$cpanel_skin/subdomain/doadddomain.html?rootdomain=$domain&domain=$subdomain";
$result = subd('localhost',2082,$cpaneluser,$cpanelpass,$request);
/*
foreach($doms as $dom) {
  $lines = explode(';',$dom);
  if (count($lines) == 2) {
    // domain and subdomain passed
    $domain = trim($lines[0]);
    $subd = trim($lines[1]);
  }
  else {
    // only subdomain passed
    $domain = getVar('domain', DOMAIN);
    $subd = trim($lines[0]);
  }
  // http://[domainhere]:2082/frontend/x/subdomain/doadddomain.html?domain=[subdomain here]&rootdomain=[domain here]
  $request = "/frontend/$cpanel_skin/subdomain/doadddomain.html?rootdomain=$domain&domain=$subd";
  $result = subd('localhost',2082,$cpaneluser,$cpanelpass,$request);
  $show = strip_tags($result);
  echo $show;
}*/

// insert the index
$handle = fopen("orgindex.txt", "r");
$data   = fread($handle, filesize("orgindex.txt"));
fclose($handle);
$data   = str_replace("&organization", $subdomain, $data);
$data   = str_replace("&university",   $university, $data);
$handle = fopen($subdomain . "/index.html", "w");
fwrite($handle, $data);
fclose($handle);

$handle = fopen("widget.php", "r");
$data   = fread($handle, filesize("widget.php"));
fclose($handle);
$handle = fopen($subdomain . "/widget.php", "w");
fwrite($handle, $data);
fclose($handle);

$handle = fopen("portal.php", "r");
$data   = fread($handle, filesize("portal.php"));
fclose($handle);
$handle = fopen($subdomain . "/portal.php", "w");
fwrite($handle, $data);
fclose($handle);

$handle = fopen(".htaccess", "r");
$data   = fread($handle, filesize(".htaccess"));
fclose($handle);
$handle = fopen($subdomain . "/.htaccess", "w");
fwrite($handle, $data);
fclose($handle);
?>