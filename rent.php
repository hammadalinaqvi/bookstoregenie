<?php include_once('rent/rent_header.php');?>

	    <div class="container_12">
        	<div class="grid_12 " style="margin:0;">
                <h2 class="intro-text">Take the Challenge!  Enter the ISBN of the textbooks you need!</h2>
            </div>
            <div class="clear"></div>
            
            <div class="features">
           
				<div class="grid_12" style="margin:0;">
            		<form onsubmit='var isbns = document.getElementById("isbnInput").value;var re = new RegExp("^[0-9Xx,;: ]+$"); if(isbns.match(re)){var url = "https://bookstoregenie.zigron.com/rentbook.php?isbns="+isbns; window.location = url;return false;}else{alert("Please enter only ISBN numbers in your search.  Thank you!");return false;}'>
                        <div style="margin:0px; overflow:hidden;">
                             <div style="float:left; overflow:hidden; margin:0px;"><input type="text" name="strbook" class="searchbook" id="isbnInput" onClick = "isbnInputClicked()" value = "Enter your ISBN number(s) ex. 9781403975072" tabindex="2" onFocus="if (this.value == 'Enter your ISBN number(s) ex. 978140397507') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Enter your ISBN number(s) ex. 978140397507';}" /></div>
                            <div style="float:left; overflow:hidden; margin:0px;"> <input onClick = 'var isbns = document.getElementById("isbnInput").value;var re = new RegExp("^[0-9Xx,;: ]+$"); if(isbns.match(re)){var url = "https://bookstoregenie.zigron.com/rentbook.php?isbns="+isbns; window.location = url;return false;}else{alert("Please enter only ISBN numbers in your search.  Thank you!");return false;}' type="submit" class="booksubmit" value="Search" /></div>
                        </div>
                    </form>
            	</div>
            	
            	<div class="clear"></div> 
            	<div class="separator"></div>   
            </div><!-- Features End -->
            
            <div class="equation" style="width:942px;">
            	<div class="grid_3 alpha">
                	<div class="box">
                    	<h4>You the Student</h4>
                        <p>Trying to navigate the treacherous textbook market, not knowing whose price is fair, which vendors will actually ship your books on time... it's no way to live life.</p>
                    </div>
                </div>
                <div class="grid_1">
                	<span class="sign">+</span>

                </div>
                <div class="grid_3">
                	<div class="box">
                    <h4>Bookstore Genie</h4>
                    <p>Bringing price transparency to all and calling out Non-Genie Entities that attempt to swindle students out of the little money they have....</p>
                    </div>
                </div>
                <div class="grid_1">
                	<span class="sign">=</span>
                </div>
                <div class="grid_4 omega">
                	<div class="box">
                    	<div class="space10"></div>
                    	<ul class="list-type-9">
                            <li>Less time worrying about textbook costs</li>
                            <li>Having the tools you need to succeed</li>
                            <li>More time spent studying</li>
                            <li>Hassle free textbook experience</li>
                            <li>More money for beer!... unless you're under 21 ;)</li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div><!-- Ecuation End -->
            
        </div>
<?php include_once('rent/rent_footer.php');?>