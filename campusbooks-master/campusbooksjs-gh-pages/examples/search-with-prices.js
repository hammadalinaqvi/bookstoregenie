      function getItemByObjectPath(obj, str) { 
        var i, path = str.split('.');
        for (i = 0; i < path.length; i += 1) { 
          obj = obj[path[i]];
          if ('undefined' === typeof obj) { 
            return;
          } 
        } 
        return obj;
      }

(function () {
  "use strict";

  var cb = require("campusbooks").create("UBxCM94GurFswUgGw3XO"),
    Futures = require("futures");

  cb.log = function (arg) {
    console.log(arg);
  }

  function joinBookPrices(books) {
    var bookprices = [],
      buybackprices = [];

    books.forEach(function (book) {
      var search = {
        isbn: book.isbn13 || book.isbn10
      };

      if (!search.isbn) { alert("missing isbn"); return; }
      bookprices.push(cb.bookprices(search));
      buybackprices.push(cb.buybackprices(search));
    });

    Futures.join(Futures.join(bookprices), Futures.join(buybackprices))
    .when(function (prices_args, buybacks_args) {
      cb.log("join complete");
      var prices = {
          err: [],
          xhr: [],
          data: []
        },
        buybacks = {
          err: [],
          xhr: [],
          data: []
        };

      console.log(prices_args[0].length);
      console.log(buybacks_args[0].length);
      prices_args[0].forEach(function (price_args) {
        prices.err.push(price_args[0]);
        prices.xhr.push(price_args[1]);
        prices.data.push(price_args[2]);
      });
      buybacks_args[0].forEach(function (buyback_args) {
        buybacks.err.push(buyback_args[0]);
        buybacks.xhr.push(buyback_args[1]);
        buybacks.data.push(buyback_args[2]);
      });

      cb.log(JSON.stringify(prices.err, null, '  '));
      //cb.log(JSON.stringify(buybacks.err, null, '  '));
      //cb.log(JSON.stringify(args2, null, '  '));
    });
  }

  function allinfo(query) {
    var results = cb.search(query);
    results.when(function (err, xhr, data) {
      cb.log("results complete");
      // TODO fix AHR to behave properly
      if ('string' === typeof data) {
        data = JSON.parse(data);
      }
      var books = getItemByObjectPath(data, "response.page.results.book");

      if (!books || !books.length) {
        cb.log('response had no results');
        cb.log(data); //JSON.stringify(data));
        return results;
      }

      if (!Array.isArray(books)) {
        books = [books];
      }

      return joinBookPrices(books);
    });
  }

  // Run App
  allinfo({
    keywords: "calculus early transcendentals"
  });

}());
