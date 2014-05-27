(function () {
  "use strict";

  var CampusBooks = require('campusbooks'),
    // This key is a special dummy key from CampusBooks for public testing purposes 
    // Note that it only works with Half.com, not the other 20 textbook sites, so it's not very useful,
    // but good enough for this demo
    cb = CampusBooks.create("BDz21GvuL6RgTKiSbwe3");

  cb.search({ title: "single variable calculus" }).when(function (err, nativeHttpClient, data) {
    console.log("Searching generic listings for \"single variable calculus\"");
    console.log('Err (ok if blank): ');
    console.log(err);
    console.log('Data: ');
    //util.puts(JSON.stringify(data, null, '  '));
    console.log(data.response);
  });

  cb.bookprices({ isbn: "9780495384250" }).when(function (err, nativeHttpClient, data) {
    console.log("Searching for price information for \"9780495384250\"");
    console.log('Err (ok if blank): ');
    console.log(err);
    console.log('Data: ');
    console.log(data.response);
  });
}());
