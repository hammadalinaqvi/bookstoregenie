(function () {
  "use strict";

  var connect = require('connect')
    , server
    ;

  server = connect.createServer(
      connect.favicon()
    , connect.static(__dirname)
  );

  module.exports = server;
}());
