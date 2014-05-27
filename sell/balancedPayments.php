<script type="text/javascript" src="https://js.balancedpayments.com/v1/balanced.js"></script>

<script type="text/javascript">
    balanced.init('/v1/marketplaces/TEST-MPgvKYnXHXJAB8Ug0NTKLiM');

var bankAccountData = {
   "name": "Levain Bakery LLC",
   "account_number": "28304871049",
   "routing_number": "121042882"
}

//balanced.bankAccount.create(bankAccountData, callbackHandler);

balanced.bankAccount.create(bankAccountData, function(response) {
  alert(response.status);
});

</script>
