This simply wraps the CampusBooks API.

Node.JS:

    npm install campusbooks

Ender.JS:

    ender build campusbooks

Example Usage:
----

    <!DOCTYPE HTML>
    <html>
      <head>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
      <script>
        jQuery.noConflict();
      </script>
      <script src="vendor/global-es5.js"></script>
      <script src="release/campusbooks.ender.js"></script>
      </head>
      <body>
        Not Loaded Yet
      </body>
      <script>
        var CampusBooks = require('campusbooks'),
          cb = CampusBooks.create("YOUR_API_KEY_HERE");

        cb.search({
          keywords: "Bits, Gates, and Beyond"
        }).when(function (err, xhr, data) {
          document.getElementsByTagName("body")[0].innerHTML = "" +
            "<pre><code>" + JSON.stringify(err || data, undefined, "  ") + "</code></pre>";
        });
      </script>
    </html>

`campusbooks.all.min.js` is a minified version of

  * `lib/campusbooks.js` (mostly vanilla es5 javascript),
  * `vendor/futures/lib/private.js` (for promises),
  * `vendor/futures/lib/promises.js` (for promises),
  * `vendor/ahr/lib/ahr.js` (for http request object that works in browser and node),
  * `vendor/global-es5.js` (for legacy browsers)

API
====

REQUESTS: `constants`, `prices`, `bookinfo`, `search`, `bookprices`, `buybackprices`, `merchant`

PARAMS: `isbn`, `image_height`, `image_width` `author`, `title`, `keywords`, `page`, `image_height`, `image_width`

    var cb = CampusBooks.create(YOUR_API_KEY);
    cb.REQUEST({ PARAM: "your_param"}, { timeout: 10000 })
      .when(function (err, data) {
        console.log(err || data);
      });

An error will be given if incorrect parameters are specified

Detailed Documentation
----

    console.log(CampusBooks.documentation);
    alert(CampusBooks.documentation);

Extra Features
----

I don't know why you would want to, but it's safe to have multiple CampusBooks APIs per page.

    var CBWidget1 = CampusBooks.create("YOUR_API_KEY");
    var CBWidget2 = CampusBooks.create("YOUR_OTHER_API_KEY");

TODO
====

  * add undocmunted param 'pages'
  * Create documentation page directly from JSON-API doc.
  * provide NodeJS backend
  * complete jQuery backend

Other
====

Compressed with http://jscompress.com/
