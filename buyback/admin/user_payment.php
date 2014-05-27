<?php 
include_once('header.php');
include_once('../db_connect/config.php');
include_once('../includes/functions.php');
?>
<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<div class="container">
  <table class="table table-bordered">
    <thead>
      <tr class="tbl-header">
        <th>Name</th>
        <th>E-mail Address</th>
        <th>Phone Number</th>
        <th>University</th>
        <th>Order Number</th>
        <th># of Books</th>
        <th>Order Total</th>
        <th>Payments</th>
      </tr>
    </thead>
    <tbody>
    <?php 
		$result = mysql_query("select * from  book_order ORDER BY id DESC");
		while($row = mysql_fetch_array($result)){
	    	$result_books_query = mysql_query("select * from  book_shipment where book_order_id=".$row['id']);
			$row_book_data = mysql_fetch_assoc($result_books_query);
		
	?>
      <tr <?php 
	  		if( $row['transaction_status'] == 'in_progress') {
				echo 'class="medium"';
			}
			
			else if($row['transaction_status'] == 'complete'){
				echo 'class="high"';
			}
			
			else if($row['email_opened_status'] == 1) {
				echo 'class="low"';
			}
		 ?>
       >
        <td><?php echo $row['from_name'];?></td>
        <td><?php echo $row['from_email'];?></td>
        <td style="text-align:center"><?php if($row['phone']){echo $row['phone'];}else{echo '-';} ?></td>
        <td><?php echo $row_book_data['university'];?></td>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['total_books'];?></td>
        <td><?php echo '$'.number_format($row['total_order_price'],2);?></td>
        <td>
        <a href="#buyback_<?php echo $row['id']; ?>" data-toggle="modal">Send Payment</a> 
        
          <div id="buyback_<?php echo $row['id']; ?>" style="margin: -250px 0 0 -422px;
    width: 780px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             <script>
			(function ($) {
			// Serializes a form into a json dict
			$.fn.serializeObject = function () {
			var o = {};
			var a = this.serializeArray();
			$.each(a, function () {
			if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
			o[this.name] = [o[this.name]];
			}
			
			o[this.name].push(this.value || '');
			} else {
			o[this.name] = this.value || '';
			}
			});
			
			return o;
			
			};
			
			})(jQuery);
			
			</script>
            <h3>Collect Bank Account Information</h3>
                <div class="row">
                    <div class="span6">
                        <form id="payment" method="post">
                            <div>
                                <label>Account Name</label>
                                <input type="text" name="name" value="">
                            </div>
                            <div>
                                <label>Account Number</label>
                                <input type="text" name="account_number" value="" autocomplete="off">
                            </div>
                            <div>
                                <label>Bank Code (Routing Number in USA)</label>
                                <input type="text" name="bank_code" value="">
                            </div>
                            <button>submit</button>
                        </form>
                    </div>
                </div>
                <div id="result"></div>
                <script type="text/javascript">
                    var marketplaceUri = '/v1/marketplaces/TEST-MP6w4EY9usfC9gtan8jC2qRy';
                
                    var debug = function (tag, content) {
                        $('<' + tag + '>' + content + '</' + tag + '>').appendTo('#result');
                    };
                
                    try {
                        balanced.init(marketplaceUri);
                    } catch (e) {
                        debug('code', 'You need to set the marketplaceUri variable');
                    }
                
                    function balancedCallback(response) {
                        var tag = (response.status < 300) ? 'pre' : 'code';
                        debug(tag, JSON.stringify(response));
                        switch (response.status) {
                            case 201:
                            // response.data.uri == uri of the bank account resource, submit to your server
                            case 400:
                            case 403:
                                // missing/malformed data - check response.error for details
                                break;
                            case 404:
                                // your marketplace URI is incorrect
                                break;
                            default:
                                // we did something unexpected - check response.error for details
                                break;
                        }
                    }
                
                    var tokenizeBankAccount = function(e) {
                        e.preventDefault();
                
                        var $form = $('form#payment');
                        var bankAccountData = {
                            name: $form.find('[name="name"]').val(),
                            account_number: $form.find('[name="account_number"]').val(),
                            bank_code: $form.find('[name="bank_code"]').val()
                        };
                
                        balanced.bankAccount.create(bankAccountData, balancedCallback);
                    };
                
                    $('#payment').submit(tokenizeBankAccount);
                
                    if (window.location.protocol === 'file:') {
                        alert("balanced.js does not work when included in pages served over file:// URLs. Try serving this page over a webserver. Contact support@balancedpayments.com if you need assistance.");
                    }
                </script>
              </div>
          </div>
        
        </td>
        
      </tr>
      <?php 
		}
	  ?>
    </tbody>
  </table>
</div>
<?php include_once('footer.php');?>
