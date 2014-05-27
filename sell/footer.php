<div class="bsg-footer">
    	<div class="bsg-content container">
    		<h6>Bookstoregenie in the house.</h6>
    	</div>
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/jquery.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-transition.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-alert.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-modal.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-dropdown.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-scrollspy.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-tab.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-tooltip.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-popover.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-button.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-collapse.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-carousel.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/bootstrap-typeahead.js"></script>
    	<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/application.js"></script>
    <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/prototype.js"></script> 
		<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/effects.js"></script> 
		<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/controls.js"></script> 
		<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/rails.js"></script> 
	
        <script language="javascript" type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/autocomplete.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" type="text/javascript"></script>
        <script src = "http://<?php echo $_SERVER['HTTP_HOST'];?>/sell/js/browserinit.js" type = 'text/javascript'></script>
     
	
        <script>
function College(name, dbName, isbn, link){
	this.name   = name;
	this.dbName = dbName;
	this.isbn   = isbn;
	this.link   = link;
}
var department = "", course = "", section = "", school, autocomplete, amazonLinks, amazonPrice, goDown = false;

var usedPrice = 0, newPrice = 0, rentPrice = 0, ebookPrice = 0, popupStatus = 0;
var usedLinks = new Array(), newLinks = new Array(), rentLinks = new Array(), ebookLinks = new Array(); amazonLinks = new Array();

var ids = new Array();
function setDepartment(value){
	department = value;
}
function setCourse(value){
	course = value;
}
function setSection(value){
	section = value;
}
var data = new Array(), colleges = new Array();
$(document).ready(function (){
	
	
	$(".ui-state-hover").css("background: none;");
	$(".ui-state-hover").css("border: none;");
	BrowserDetect.init();
	if (BrowserDetect.browser == "Firefox"){
		/*$(".ui-button-custom-icon").css("left", '-4px');
		$(".ui-button-custom-icon").css("top", '-32px');*/
		$(".ui-button").css("width", "32px");
		$(".ui-button").css("height", "54px");
		$(".ui-button").css("left", "-4px");
		$(".ui-button").css("top", "-5px");
		
	}
	$.ajax({
		url: "portal.php",
		type: "POST",
		data: {req: "school"},
		success: function(transport){
			var transport = eval ("(" + transport + ")");
			for (var i = 0; i < colleges.length; i++){
				data.push(colleges[i].name);
			}
			for (var i = 0; i < transport.length; i++){
				colleges.push(new College(transport[i][0], "", true, transport[i][1]));
				data.push(transport[i][0]);
			}
			data.sort();
			//AutoComplete_Create('search', data);'
			autocomplete = jQuery("#search").autocomplete({
				source: data
			});
			jQuery("#search").bind("autocompleteopen", function(event, ui){
				$("<li class='ui-menu-item' role='menuitem'>Can't find your University?</li>").appendTo(autocomplete);
			});
			
		},
		faliure: function(){
			alert("Unable to retrieve school information. Check your internet connection.");
		}
	});

	colleges.push(new College("University of Wisconsin Madison", "wisc", false, ""));
	colleges.push(new College("California State Polytechnic University Pomona", "calPolyPomona", false, ""));
});




function clearUniversity(){
	if ($("#search").val() == "Type in your University")
		document.getElementById('search').value='';
}

function changeSearch(text){
	$("#search").val(text);
}		</script>

  </body>
</html>
