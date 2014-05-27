(function( $ ) {
		$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "";
					switch(select.attr("id")){
						case "department_select":
							var id = 'department_input';
							value = "Select Department";
							break;
						case "course_select":
							var id = "course_input";
							value = "Select Course";
							break;
						case "section_select":
							var id = "section_input";
							value = "Select Section";
							break;
					}
				var input = this.input = $( "<input id = '" + id + "'>" )
					.insertAfter( select )
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
							if (select.attr("id") == "department_select"){
								$("#interfaceContainer").loading(true, {mask:true, img: "images/alternate-loader.gif", align: "center"});
								setDepartment(ui.item.value);
								$.ajax({
									url: "portal.php",
									type: "POST",
									data: {req: "course", school: school, department: department},
									success: function(transport){
										$("#interfaceContainer").loading(false);
										$("#course_select").empty();
										$("#course_input").val("");
										var list = new Array(), bad = false;
										var transport = eval ("(" + transport + ")");
										for (var i in transport){
										 bad = false;
											for (var j in list){
												if (transport[i] == list[j]){
													bad = true;
													break;
												}
											}
											if (!bad){
												$("#course_select").append("<option value = '" + transport[i] + "'>" + transport[i]  + "</option>");
												list.push(transport[i]);
											}
										}
										$("#course_input").attr("value", "Select Course");
										$("#course_input").click(courseClick);
										$("#course_box").css("display", "block");
										$("#selectcoursebox_grey").css("display", "none");
										$("#section_box").css("display", "none");
										$("#selectsectionbox_grey").css("display", "block");
									},
									faliure: function(){
										alert("Unable to retrieve class information");
									}
								});
							}else if (select.attr("id") == "course_select"){
								$("#interfaceContainer").loading(true, {mask:true, img: "images/alternate-loader.gif", align: "center"});
								setCourse(ui.item.value);
								$.ajax({
									url: "portal.php",
									type: "POST",
									data: {req: "section", school: school, department: department, course: course},
									success: function(transport){
										$("#interfaceContainer").loading(false);
										$("#section_select").empty();
										$("#section_input").val("");
										var list = new Array(), bad = false;
										var transport = eval ("(" + transport + ")");
										for (var i in transport){
										 bad = false;
											for (var j in list){
												if (transport[i][0] == list[j]){
													bad = true;
													break;
												}
											}
											if (!bad){
												$("#section_select").append("<option value = '" + transport[i][1] + "'>" + transport[i][0]  + "</option>");
												list.push(transport[i][0]);
											}
										}
										$("#section_input").attr("value", "Select Section");
										$("#section_input").click(sectionClick);
										$("#section_box").css("display", "block");
										$("#selectsectionbox_grey").css("display", "none");
									},
									faliure: function(){
										alert("Unable to retrieve class information");
									}
								});
							}else if (select.attr("id") == "section_select"){
								/*$("#go").css("display", "block");
								$("#go").attr("href", "testpass.php?department=" + department + "&course=" + course + "&section=" + ui.item.value + "&rownumber=1");*/
								section = ui.item.value;
							}
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( $( this ).text().match( matcher ) ) {
										this.selected = valid = true;
										//return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									input.data( "autocomplete" ).term = "";
									return false;
								}
							}
						}
					})
					.addClass( "ui-widget ui-autocomplete-custom" )
					.removeClass("ui-autocomplete-input");

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					if (!item.label[item.label.search("</strong>") + 9]){
						if (select.attr("id") == "department_select"){
								setDepartment(item.value);
								$("#interfaceContainer").loading(true, {mask:true, img: "images/alternate-loader.gif", align: "center"});
								$.ajax({
									url: "portal.php",
									type: "POST",
									data: {req: "course", school: school, department: department},
									success: function(transport){
									$("#interfaceContainer").loading(false);
										$("#course_select").empty();
										$("#course_input").val("");
										var list = new Array(), bad = false;
										var transport = eval ("(" + transport + ")");
										for (var i in transport){
										 bad = false;
											for (var j in list){
												if (transport[i] == list[j]){
													bad = true;
													break;
												}
											}
											if (!bad){
												$("#course_select").append("<option value = '" + transport[i] + "'>" + transport[i]  + "</option>");
												list.push(transport[i]);
											}
										}
										$("#course_input").attr("value", "Select Course");
										$("#course_input").click(courseClick);
										$("#course_box").css("display", "block");
										$("#selectcoursebox_grey").css("display", "none");
										$("#section_box").css("display", "none");
										$("#selectsectionbox_grey").css("display", "block");
									},
									faliure: function(){
										alert("Unable to retrieve class information");
									}
								});
							}else if (select.attr("id") == "course_select"){
								setCourse(item.value);
								$("#interfaceContainer").loading(true, {mask:true, img: "images/alternate-loader.gif", align: "center"});
								$.ajax({
									url: "portal.php",
									type: "POST",
									data: {req: "section", school: school, department: department, course: course},
									success: function(transport){
									$("#interfaceContainer").loading(false);
										$("#section_select").empty();
										$("#section_input").val("");
										var list = new Array(), bad = false;
										var transport = eval ("(" + transport + ")");
										for (var i = 0; i < transport.length; i++){
										 bad = false;
											for (var j in list){
												if (transport[i][0] == list[j]){
													bad = true;
													break;
												}
											}
											if (!bad){
												$("#section_select").append("<option value = '" + transport[i][1] + "'>" + transport[i][0]  + "</option>");
												list.push(transport[i][0]);
											}
										}
										$("#section_input").attr("value", "Select Section");
										$("#section_input").click(sectionClick);
										$("#section_box").css("display", "block");
										$("#selectsectionbox_grey").css("display", "none");
									},
									faliure: function(){
										alert("Unable to retrieve class information");
									}
								});
							}else if (select.attr("id") == "section_select"){
								/*$("#go").css("display", "block");
								$("#go").attr("href", "testpass.php?department=" + department + "&course=" + course + "&section=" + ui.item.value + "&rownumber=1");*/
								section = item.value;
							}
					}
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				this.button = $( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.attr("id", id + "autocompleteButton")
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-button-custom-icon"
						},
						text: false
					})
					.removeClass( "ui-corner-all ui-icon ui-state-default ui-button-icon-only" )
					//.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					})
					.mouseover(function(){
						$(id + "autocompleteButton").removeClass("ui-state-hover");
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	})( jQuery );

	$(function() {
		$( ".combobox" ).combobox();
		/*$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});*/
	});