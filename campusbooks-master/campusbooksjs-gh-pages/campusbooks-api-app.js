(function () {
  "use strict";

  var $ = require('jQuery')
    , $p = require('pure').$p
    , Future = require('future')
    , CampusBooks = require('campusbooks')
  //,  cb = CampusBooks.create("BLCg7q5VrmUBxsrETg5c");
    //, cb = CampusBooks.create("BDz21GvuL6RgTKiSbwe3");
	, cb = CampusBooks.create("CE0001CcX3MiEIf4zN0i");

  /*
  cb.search({
    keywords: "Bits, Gates, and Beyond"
  }).when(function (err, data, xhr) {
    $('#booksearch_response').html("<pre><code>" +
      JSON.stringify(err || data, undefined, "  ") +
      "</code></pre>");
  });
  */

  $(function () {
  console.log('dom ready');

  var api_form_events = function (mod_name, request) {
    var mod_id = '#api_module_' + mod_name,
      mod_results = '#api_results_' + mod_name;

    var key_timeout = -1;
    function getResponse (ev) {
      ev.preventDefault();

      var promise = Future(),
       params = {};

      clearTimeout(key_timeout);

      $(mod_id + ' div.parameters input.value').each(function (index, el) {
        var key, value;
        key = $(el).attr('name');
        value = $(el).val();
        params[key] = value;
      });

      // TODO validate keys in own module
      var readyNow = false;
      Object.keys(params).forEach(function (key) {
        // TODO test unicode rather than ASCII
        if (!params[key].match(/\w$/) && params[key].length >= 5) {
          readyNow = true;
        }
      });

      // Reduce the number of requests to something the CampusBooks API handles well
      if (readyNow) {
        $(mod_results).html("Loading...");
        promise.fulfill(params);
      } else {
        key_timeout = setTimeout(promise.fulfill, 400, params);
      }

      promise.when(function (params) {
        clearTimeout(key_timeout);
        // TODO wrap AHR to detect errors
        cb[mod_name](params).when(function (err, xhr, data) {
          if (err || data && data.repsonse && data.response.errors) {
            // TODO unobtrusive alert('params: ' + JSON.stringify(params));
            return false;
          }
          if (data && data.response && data.response.page && data.response.page.results && 0 === data.response.page.results.length) {
            // TODO unobtrusive alert('params: ' + JSON.stringify(params));
            return false;
          }
          var result = data, // err occur often with instant search
            mod,
            dimpl;
          $(mod_results).html('');
          if ('function' === typeof request.render) {
            dimpl = request.render(data);
            dimpl.forEach(function (html) {
              $(mod_results).append(html);
            });
            //$(mod_results).html(dimpl);
          } else {
            $(mod_results).html(JSON.stringify(result, undefined, '  '));
            // TODO add google image search when no_image
          }
        });
      });
    }
    $('body').delegate(mod_id, 'keyup', getResponse);
    $('body').delegate(mod_id, 'submit', getResponse);
  };

  CampusBooks.documentation.requests.forEach(function (req) {
    console.log('req.name', req.name);
    api_form_events(req.name, req);
  });

  // TODO enumerate over API, providing example strings on-the-fly
  // TODO skip Key / Description for empty set
  // TODO nest nested values
  var api_params_form_tpl = $p("#api_enumeration div.parameters").compile({
    "span.parameter" : {
      "p<-oneOf": {
        "label.key": "p",
        "label.key@for": "p",
        "label.key@style": function (c) {
          var style = "";
          if (c.context.required) {
            c.context.required.forEach(function (item) {
              if (item === c.item) {
                style = "font-weight: bold";
              }
            });
          }
          return style;
        },
        "input.value@name": "p",
        "input.value@style": function () {
          return "font-style: italic";
        },
        "input.value@value": function (c) {
          return "";
        }
      }
    }
  });

  var api_params_tpl = $p("#api_enumeration span.parameters").compile({
    "span.parameter" : {
      "c<-oneOf": {
        "span.key": "c",
        "span.key@style": function (c) {
          var style = "";
          if (c.context.required) {
            c.context.required.forEach(function (item) {
              if (item === c.item) {
                style = "font-weight: bold";
              }
            });
          }
          return style;
        },
        "span.value@style": function () {
          return "font-style: italic";
        },
        "span.value": function (c) {
          return "...";
        },
        "span.comma": function (c) {
          return c.pos + 1 === c.length ? '' : ',';
        }
      }
    }
  });

  var api_tpl = $p("#api_enumeration").compile({
    "#api_modules" : {
      "req<-context" : {
        "form.action@id": "api_module_#{req.name}",
        "span.action": "req.name",
        "span.parameters": function (c) {
          if (c.item.parameters.oneOf.length > 0) {
            return api_params_tpl(c.item.parameters);
          }
          return "";
        },
        "div.parameters": function (c) {
          if (c.item.parameters.oneOf.length > 0) {
            return api_params_form_tpl(c.item.parameters);
          }
          return "";
        },
        "code.results@id": "api_results_#{req.name}"
      }
    }
  });

  $p('#api_enumeration').render(CampusBooks.documentation.requests, api_tpl);

  var tpl = $p('#content-main').compile({
    "#api_doc" : {
      "req<-context" : {
        ".name": "req.name",
        ".description": "req.description",
        ".response": {
          "res<-req.response": {
            ".key": "res.name",
            ".description": "res.description"
          }
        }
      }
    }
  });

  $p('#content-main').render(CampusBooks.documentation.requests, tpl);
  // 0. get sample data
  // 0. coalesce
  // 0. auto-template (TODO add tpl directive and produce PURE directive)
  // 0. alt-click in firebug to copy HTML, paste
  // 0. season
  });
}());
