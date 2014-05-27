// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults

	function getCookie(c_name)
	{
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++)
	  	{
	    		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	      		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	        	x=x.replace(/^\s+|\s+$/g,"");
		  	if (x==c_name)
		      	{
		        	return unescape(y);
			}
		}
	}

	function setCookie(c_name,value,exdays)
	{
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}

	function addToCart()
	{
		cookie = getCookie("results");
		setCookie("cart",cookie,10);
	}

	function removeFromCart(asin)
	{
		cookie = getCookie("cart");
		var re = new RegExp("\\("+asin+".\\d*,\\d*\\);","g");
		new_cookie = cookie.replace(re,"");
		setCookie("cart",new_cookie,10);
		setCookie("results",new_cookie,10);
		location.reload(true);
	}

	function checkAll(checker)
	{
		checkboxes = document.getElementsByName("asin");
		for (var i in checkboxes)
			checkboxes[i].checked = document.getElementById(checker).checked;
	}

	function removeChecked()
	{
		cookie = getCookie("cart");
		asins = cookie.split("(");
		for (i=1; i<asins.size(); i++){
			as = asins[i].split(",");
			asin = as[0];
			check = document.getElementById("check"+asin).checked;
			if(check)
				removeFromCart(asin);

		}		
	}

	function increment(id)
	{
		document.getElementById(id).value = eval(document.getElementById(id).value+"+1");
		asin = id.replace("newpcs","");
		asin = asin.replace("usedpcs","");
		updateCookie();
		updateTotal();
	}

	function decrement(id)
	{
		if(document.getElementById(id).value=='0')
			return false;
		document.getElementById(id).value = eval(document.getElementById(id).value+"-1");
		asin = id.replace("newpcs","");
		asin = asin.replace("usedpcs","");
		updateCookie();
		updateTotal();
	}

	function removeBook(asin)
	{
		document.getElementById("book"+asin).innerHTML = "";
		cookie = getCookie("results");
		var re = new RegExp("\\("+asin+".\\d*,\\d*\\);","g");
		new_cookie = cookie.replace(re,"");
		setCookie("results",new_cookie,10);
		updateTotal();
	}

	function updateCookie()
	{
		cookie = getCookie("results");
		asins = cookie.split("(");
		for(i=1;i<asins.size();i++){
			cookie = getCookie("results");
			as = asins[i].split(",");
			asin = as[0];
			new_pieces = document.getElementById("newpcs"+asin).value;
			used_pieces = document.getElementById("usedpcs"+asin).value;
			var re = new RegExp(asin+",\\d*,\\d*","g");
			if(cookie.search(re) >= 0){
				new_cookie = cookie.replace(re,asin+","+new_pieces+","+used_pieces);
				setCookie("results",new_cookie,10);
			}
			else{
				new_cookie = cookie + "("+asin+",1,1);";
				setCookie("results",new_cookie,10);
			}
		}
		
	}

	function updateTotal()
	{
		asins = getCookie("results");
		myAsins = new Array();
		asins = asins.split("(");
		for(i = 1 ; i<asins.length; i++){
			as = asins[i].split(",");
			myAsins[i-1] = as[0];
		}

		newOverall = 0;
		usedOverall = 0;
		totalOverall = 0;
		priceOverall = 0;

		for(i = 0 ; i < myAsins.length; i++){
			asin = myAsins[i];
			cookie = getCookie("results");
			newpcs = cookie.split(asin)[1];
			newpcs = newpcs.split(",")[1];
			usedpcs = cookie.split(asin)[1];
			usedpcs = usedpcs.split(",")[2];
			usedpcs = usedpcs.split(")")[0];

			document.getElementById("newpcs"+asin).value = newpcs;
			document.getElementById("usedpcs"+asin).value = usedpcs;
			newprice =  document.getElementById("newPrice"+asin).innerHTML.replace("$","");
			usedprice =  document.getElementById("usedPrice"+asin).innerHTML.replace("$","");
			if(newprice.search("-") >= 0)
				newprice = 0;
			if(usedprice.search("-") >= 0)
				usedprice = 0;
			subtotal = eval(newpcs+"*"+newprice+"+"+usedpcs+"*"+usedprice);
			document.getElementById("Subtotal"+asin).innerHTML = "$"+(Math.round(eval(subtotal)*100)/100).toFixed(2);

			newOverall += eval(newpcs);
			usedOverall += eval(usedpcs);
			totalOverall += eval(newpcs + "+" + usedpcs);
			priceOverall += subtotal;
		}
		
		document.getElementById("totalBooks1").innerHTML = totalOverall;
		document.getElementById("totalNewBooks1").innerHTML = newOverall;
		document.getElementById("totalUsedBooks1").innerHTML = usedOverall;
		document.getElementById("totalPrice1").innerHTML = "$"+(Math.round(priceOverall*100)/100).toFixed(2);;

		document.getElementById("totalBooks").innerHTML = totalOverall;
		document.getElementById("totalNewBooks").innerHTML = newOverall;
		document.getElementById("totalUsedBooks").innerHTML = usedOverall;
		document.getElementById("totalPrice").innerHTML = "$"+(Math.round(priceOverall*100)/100).toFixed(2);

	}

	function notValidISBN(id, parentNode){
		if(parentNode == undefined)
			document.getElementById(id).parentNode.style.background = "#FA8072";
		else
			document.getElementById(id).style.borderColor = "#FA8072";
		document.getElementById("div-error").innerHTML = "One or more of the ISBN's you entered is not valid";
		return false;

	}

	function validateISBN(id, parentNode){
		document.getElementById("div-error").innerHTML = "";
		ISBN = document.getElementById(id).value;
		ISBN = ISBN.replace(/-/g,"");
		ISBN = ISBN.replace(/ /g,"");
		reg = new RegExp("\\d*");
		if ((ISBN.match(reg)!="") && (validISBN10(ISBN)||validISBN13(ISBN)))
				return true;

		return notValidISBN(id, parentNode);
	}

	function validISBN10(isbn){
		if(isbn.length==10){
			var cksum = 0;
			for(i=0;i<=9;i++){
				cksum += parseInt(isbn[i])*(10-i);
			}
			return cksum % 11 == 0;
		}
		return false;
	}

	function validISBN13(isbn){
		if(isbn.length==13){
			var cksum = 0;
			for(i=0;i<12;i++){
				if(i%2 == 0)
					cksum += parseInt(isbn[i]);
				else
					cksum += parseInt(isbn[i])*3;
			}
			return parseInt(isbn[12]) == (10 - cksum % 10) % 10;
		}
		return false;
	}

	function addressCheck(){

		 // get the current URL
		 var url = window.location.toString();

		 //get the parameters
		 url.match(/\?(.+)$/);
		 var params = RegExp.$1;

		// split up the query string and store in an
		// associative array
		 var params = params.split("&");
		 var queryStringList = {};
		
		 for(var i=0;i<params.length;i++){
		 	var tmp = params[i].split("=");
			queryStringList[tmp[0]] = decode_utf(unescape(tmp[1])).replace(/\+/g," ");
		}
				   
		// print all querystring in key value pairs
		if(queryStringList["valid"] != undefined){
			if(queryStringList["valid"] == "false"){
				error(null,"* Address is not valid!");
				error("address");
				error("city");
				error("zip");
				error("state");
			}
			else{
				error(null,"* Check address is not valid!");
				error("caddress");
				error("ccity");
				error("czip");
				error("ccountry");
			}
			setValue("email",queryStringList["options[email]"]);
			setValue("country","US");
			setValue("city",queryStringList["options[city]"]);
			setValue("zip",queryStringList["options[zip]"]);
			setValue("address",queryStringList["options[addressline1]"]);
			setValue("state",queryStringList["options[state]"]);
			setValue("name",queryStringList["options[name]"]);
			setValue("university",queryStringList["options[university]"]);
			setValue("paypalmail",queryStringList["options[paypalmail]"]);
			setValue("ccity",queryStringList["options[ccity]"]);
			setValue("czip",queryStringList["options[czip]"]);
			setValue("ccountry",queryStringList["options[ccountry]"]);
			setValue("caddress",queryStringList["options[caddressline1]"]);
		}
	}

	function termsAgreed(){
		if (document.getElementById("terms").checked == false){
			error("terms-label","* You have to accept our terms!");
			valid = false;
		}
	}

	function checkCart(){
		if (getCookie("cart")!="")
			return true;
		alert("Your cart is empty!");
		return false;
	}

	function copyValue(id1, id2){
		document.getElementById(id2).value = document.getElementById(id1).value;
	}

	function setValue(id,value){
		document.getElementById(id).value = value;
	}

	function decode_utf(utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}

	function updateCheck(){
		if(document.getElementById("same").checked == true){
			copyValue("state","ccountry");
			copyValue("address","caddress");
			copyValue("zip","czip");
			copyValue("city","ccity");
			return false;
		}
		setValue("caddress","Address line 1");
		setValue("ccountry","State code");
		setValue("czip","Zip code");
		setValue("ccity","City");
	}
	
	function validateEmail(mail){
		var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(reg.test(mail)==false){
			return false;
		}
		return true;
	}

	function validateState(sstate) {

		sstates = "wa|or|ca|ak|nv|id|ut|az|hi|mt|wy|" +

				"co|nm|nd|sd|ne|ks|ok|tx|mn|ia|mo|" +

				"ar|la|wi|il|ms|mi|in|ky|tn|al|fl|" +

				"ga|sc|nc|oh|wv|va|pa|ny|vt|me|nh|" +

				"ma|ri|ct|nj|de|md|dc|";


		if (sstates.indexOf(sstate.toLowerCase() + "|") > -1) {	
			return true;
		}
		return false;
	}

	var valid = true;

	function resetLabelColors(){
		var labels = document.getElementsByTagName("input");
		for( i=0; i<labels.length;i++ ){
			labels[i].style.borderColor="#b4c1c6";
		}
		document.getElementById("terms-label").style.borderColor = "#b4c1c6";
		document.getElementById("paypal-label").style.borderColor = "#84a8c9";
		document.getElementById("check-label").style.borderColor = "#84a8c9";
	}

	function validateZipCode(elementValue){
	    var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
	    return zipCodePattern.test(elementValue);
	}
	
	function validator() {
		document.getElementById('div-error').innerHTML = '';
		resetLabelColors();
		valid = true;
		document.getElementById('div-error').innerHTML = document.getElementById('div-error').innerHTML.replace('* Address is not valid!<br>','');
		termsAgreed();

		if(validateEmail(document.getElementById("email").value)==false){
			error("email","* Email address is not valid!");
			valid = false;
		}

		if(validateZipCode(document.getElementById("zip").value)==false){
			error("zip","* Zip code is not valid!");
			valid = false;
		}

		if(validateState(document.getElementById("state").value) == false){
			error("state","* State code is not valid!");
			valid = false;
		}	

		if(document.getElementById("radio").checked == true && validateEmail(document.getElementById("paypalmail").value) == false){
			error("paypalmail","* Paypal email address is not valid!");
			valid = false;
		}

		if(document.getElementById("radio").checked == false && document.getElementById("check").checked == false){
			error("paypal-label","* Please select a payment method!");
			error("check-label");
			valid = false;
		}

		if(document.getElementById("check").checked == true){
			if(validateZipCode(document.getElementById("czip").value)==false){
				error("czip","* Check zip code is not valid!");
				valid = false;
			}
			if(validateState(document.getElementById("ccountry").value) == false){
				error("ccountry","* Check state code is not valid!");
				valid = false;
			}	
		}

		if(valid == false)
			return false;
		return true;
	}

	function error(id, error){
		if(id!=null)
			document.getElementById(id).style.borderColor='#A30000';
		if(error!=undefined)
			document.getElementById('div-error').innerHTML += error+'<br/>';
	}

	function checkPassword(){
		var p = document.getElementById("p").value;
		var pc = document.getElementById("pc").value;

		if(validateEmail(document.getElementById("admin").value)==false){
			alert("Invalid email!");
			return false;
		}
		if(p!=pc || p.length <6){
			alert("Password mismatch or is too short (at least 6 characters)!");
			return false;
		}

		return true;
	}
