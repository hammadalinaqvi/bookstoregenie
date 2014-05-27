<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>

<script type="text/javascript">
    balanced.init('/v1/marketplaces/TEST-MP6w4EY9usfC9gtan8jC2qRy');

var bankAccountData = {
   "name": "Johnson Smith",
   "account_number": "28304871049",
   "routing_number": "121042882"
}

//balanced.bankAccount.create(bankAccountData, callbackHandler);

balanced.bankAccount.create(bankAccountData, function(response) {
  //alert(response.status);
  alert(response.data.uri);
});

</script>