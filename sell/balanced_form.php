<html>

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

<head>
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" type="text/css">
    <style type="text/css">
        code { display: block; }
        pre { color: green; }
    </style>
</head>
<body>
<h1>Balanced Sample - Collect Bank Account Information</h1>
<div class="row">
    <div class="span6">
        <form id="payment">
            <div>
                <label>Account Name</label>
                <input type="text" name="name" value="Mahmoud MacBook">
            </div>
            <div>
                <label>Account Number</label>
                <input type="text" name="account_number" value="000000-00" autocomplete="off">
            </div>
            <div>
                <label>Bank Code (Routing Number in USA)</label>
                <input type="text" name="bank_code" value="321174851">
            </div>
            <button>submit</button>
        </form>
    </div>
</div>
<div id="result"></div>
<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    var marketplaceUri = '/v1/marketplaces/TEST-MPgvKYnXHXJAB8Ug0NTKLiM';

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
</body>
</html>