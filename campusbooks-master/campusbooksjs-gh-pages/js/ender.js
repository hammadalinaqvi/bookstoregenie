/*!
  * =============================================================
  * Ender: open module JavaScript framework (https://ender.no.de)
  * Build: ender build jQuery querystring url pure futures campusbooks
  * =============================================================
  */

/*!
  * Ender-JS: open module JavaScript framework (client-lib)
  * copyright Dustin Diaz & Jacob Thornton 2011 (@ded @fat)
  * https://ender.no.de
  * License MIT
  */
!function (context) {

  // a global object for node.js module compatiblity
  // ============================================

  context['global'] = context;

  // Implements simple module system
  // losely based on CommonJS Modules spec v1.1.1
  // ============================================

  var modules = {};

  function require (identifier) {
    var module = modules[identifier] || window[identifier];
    if (!module) throw new Error("Requested module '" + identifier + "' has not been defined.");
    return module;
  }

  function provide (name, what) {
    return modules[name] = what;
  }

  context['provide'] = provide;
  context['require'] = require;

  // Implements Ender's $ global access object
  // =========================================

  function aug(o, o2) {
    for (var k in o2) {
      k != 'noConflict' && k != '_VERSION' && (o[k] = o2[k]);
    }
    return o;
  }

  function boosh(s, r, els) {
                          // string || node || nodelist || window
    if (ender._select && (typeof s == 'string' || s.nodeName || s.length && 'item' in s || s == window)) {
      els = ender._select(s, r);
      els.selector = s;
    } else {
      els = isFinite(s.length) ? s : [s];
    }
    return aug(els, boosh);
  }

  function ender(s, r) {
    return boosh(s, r);
  }

  aug(ender, {
    _VERSION: '0.2.5',
    ender: function (o, chain) {
      aug(chain ? boosh : ender, o);
    },
    fn: context.$ && context.$.fn || {} // for easy compat to jQuery plugins
  });

  aug(boosh, {
    forEach: function (fn, scope, i) {
      // opt out of native forEach so we can intentionally call our own scope
      // defaulting to the current item and be able to return self
      for (i = 0, l = this.length; i < l; ++i) {
        i in this && fn.call(scope || this[i], this[i], i, this);
      }
      // return self for chaining
      return this;
    },
    $: ender // handy reference to self
  });

  var old = context.$;
  ender.noConflict = function () {
    context.$ = old;
    return this;
  };

  (typeof module !== 'undefined') && module.exports && (module.exports = ender);
  // use subscript notation as extern for Closure compilation
  context['ender'] = context['$'] = context['ender'] || ender;

}(this);

!function () {

  var module = { exports: {} }, exports = module.exports;

  // Copyright Joyent, Inc. and other Node contributors.
  //
  // Permission is hereby granted, free of charge, to any person obtaining a
  // copy of this software and associated documentation files (the
  // "Software"), to deal in the Software without restriction, including
  // without limitation the rights to use, copy, modify, merge, publish,
  // distribute, sublicense, and/or sell copies of the Software, and to permit
  // persons to whom the Software is furnished to do so, subject to the
  // following conditions:
  //
  // The above copyright notice and this permission notice shall be included
  // in all copies or substantial portions of the Software.
  //
  // THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
  // OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  // MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
  // NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
  // DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
  // OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
  // USE OR OTHER DEALINGS IN THE SOFTWARE.
  
  // Query String Utilities
  
  (typeof define === "undefined" ? function($) { $(require, exports, module) } : define)(function(require, exports, module, undefined) {
  "use strict";
  
  var QueryString = exports;
  
  function charCode(c) {
    return c.charCodeAt(0);
  }
  
  QueryString.unescape = decodeURIComponent;
  QueryString.escape = encodeURIComponent;
  
  var stringifyPrimitive = function(v) {
    switch (typeof v) {
      case 'string':
        return v;
  
      case 'boolean':
        return v ? 'true' : 'false';
  
      case 'number':
        return isFinite(v) ? v : '';
  
      default:
        return '';
    }
  };
  
  
  QueryString.stringify = QueryString.encode = function(obj, sep, eq, name) {
    sep = sep || '&';
    eq = eq || '=';
    obj = (obj === null) ? undefined : obj;
  
    switch (typeof obj) {
      case 'object':
        return Object.keys(obj).map(function(k) {
          if (Array.isArray(obj[k])) {
            return obj[k].map(function(v) {
              return QueryString.escape(stringifyPrimitive(k)) +
                     eq +
                     QueryString.escape(stringifyPrimitive(v));
            }).join(sep);
          } else {
            return QueryString.escape(stringifyPrimitive(k)) +
                   eq +
                   QueryString.escape(stringifyPrimitive(obj[k]));
          }
        }).join(sep);
  
      default:
        if (!name) return '';
        return QueryString.escape(stringifyPrimitive(name)) + eq +
               QueryString.escape(stringifyPrimitive(obj));
    }
  };
  
  // Parse a key=val string.
  QueryString.parse = QueryString.decode = function(qs, sep, eq) {
    sep = sep || '&';
    eq = eq || '=';
    var obj = {};
  
    if (typeof qs !== 'string' || qs.length === 0) {
      return obj;
    }
  
    qs.split(sep).forEach(function(kvp) {
      var x = kvp.split(eq);
      var k = QueryString.unescape(x[0], true);
      var v = QueryString.unescape(x.slice(1).join(eq), true);
  
      if (!(k in obj)) {
        obj[k] = v;
      } else if (!Array.isArray(obj[k])) {
        obj[k] = [obj[k], v];
      } else {
        obj[k].push(v);
      }
    });
  
    return obj;
  };
  
  });
  

  provide("querystring", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
  function create(window) {
    var location, navigator, XMLHttpRequest;
  
    window = window || require('jsdom').jsdom().createWindow();
    location = window.location || require('location');
    navigator = window.navigator || require('navigator');
  
    if (!window.XMLHttpRequest && 'function' !== typeof window.ActiveXObject) {
      window.XMLHttpRequest = require('xmlhttprequest'); // require('XMLHttpRequest');
      // TODO repackage XMLHttpRequest
    }
  
    // end npm / ender header
  
  /*!
   * jQuery JavaScript Library v1.5.2pre
   * http://jquery.com/
   *
   * Copyright 2011, John Resig
   * Dual licensed under the MIT or GPL Version 2 licenses.
   * http://jquery.org/license
   *
   * Includes Sizzle.js
   * http://sizzlejs.com/
   * Copyright 2011, The Dojo Foundation
   * Released under the MIT, BSD, and GPL Licenses.
   *
   * Date: Tue Mar 15 17:06:24 2011 -0400
   */
  (function( window, undefined ) {
  
  // Use the correct document accordingly with window argument (sandbox)
  var document = window.document;
  var jQuery = (function() {
  
  // Define a local copy of jQuery
  var jQuery = function( selector, context ) {
  		// The jQuery object is actually just the init constructor 'enhanced'
  		return new jQuery.fn.init( selector, context, rootjQuery );
  	},
  
  	// Map over jQuery in case of overwrite
  	_jQuery = window.jQuery,
  
  	// Map over the $ in case of overwrite
  	_$ = window.$,
  
  	// A central reference to the root jQuery(document)
  	rootjQuery,
  
  	// A simple way to check for HTML strings or ID strings
  	// (both of which we optimize for)
  	quickExpr = /^(?:[^<]*(<[\w\W]+>)[^>]*$|#([\w\-]+)$)/,
  
  	// Check if a string has a non-whitespace character in it
  	rnotwhite = /\S/,
  
  	// Used for trimming whitespace
  	trimLeft = /^\s+/,
  	trimRight = /\s+$/,
  
  	// Check for digits
  	rdigit = /\d/,
  
  	// Match a standalone tag
  	rsingleTag = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,
  
  	// JSON RegExp
  	rvalidchars = /^[\],:{}\s]*$/,
  	rvalidescape = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
  	rvalidtokens = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
  	rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g,
  
  	// Useragent RegExp
  	rwebkit = /(webkit)[ \/]([\w.]+)/,
  	ropera = /(opera)(?:.*version)?[ \/]([\w.]+)/,
  	rmsie = /(msie) ([\w.]+)/,
  	rmozilla = /(mozilla)(?:.*? rv:([\w.]+))?/,
  
  	// Keep a UserAgent string for use with jQuery.browser
  	userAgent = navigator.userAgent,
  
  	// For matching the engine and version of the browser
  	browserMatch,
  
  	// The deferred used on DOM ready
  	readyList,
  
  	// The ready event handler
  	DOMContentLoaded,
  
  	// Save a reference to some core methods
  	toString = Object.prototype.toString,
  	hasOwn = Object.prototype.hasOwnProperty,
  	push = Array.prototype.push,
  	slice = Array.prototype.slice,
  	trim = String.prototype.trim,
  	indexOf = Array.prototype.indexOf,
  
  	// [[Class]] -> type pairs
  	class2type = {};
  
  jQuery.fn = jQuery.prototype = {
  	constructor: jQuery,
  	init: function( selector, context, rootjQuery ) {
  		var match, elem, ret, doc;
  
  		// Handle $(""), $(null), or $(undefined)
  		if ( !selector ) {
  			return this;
  		}
  
  		// Handle $(DOMElement)
  		if ( selector.nodeType ) {
  			this.context = this[0] = selector;
  			this.length = 1;
  			return this;
  		}
  
  		// The body element only exists once, optimize finding it
  		if ( selector === "body" && !context && document.body ) {
  			this.context = document;
  			this[0] = document.body;
  			this.selector = "body";
  			this.length = 1;
  			return this;
  		}
  
  		// Handle HTML strings
  		if ( typeof selector === "string" ) {
  			// Are we dealing with HTML string or an ID?
  			match = quickExpr.exec( selector );
  
  			// Verify a match, and that no context was specified for #id
  			if ( match && (match[1] || !context) ) {
  
  				// HANDLE: $(html) -> $(array)
  				if ( match[1] ) {
  					context = context instanceof jQuery ? context[0] : context;
  					doc = (context ? context.ownerDocument || context : document);
  
  					// If a single string is passed in and it's a single tag
  					// just do a createElement and skip the rest
  					ret = rsingleTag.exec( selector );
  
  					if ( ret ) {
  						if ( jQuery.isPlainObject( context ) ) {
  							selector = [ document.createElement( ret[1] ) ];
  							jQuery.fn.attr.call( selector, context, true );
  
  						} else {
  							selector = [ doc.createElement( ret[1] ) ];
  						}
  
  					} else {
  						ret = jQuery.buildFragment( [ match[1] ], [ doc ] );
  						selector = (ret.cacheable ? jQuery.clone(ret.fragment) : ret.fragment).childNodes;
  					}
  
  					return jQuery.merge( this, selector );
  
  				// HANDLE: $("#id")
  				} else {
  					elem = document.getElementById( match[2] );
  
  					// Check parentNode to catch when Blackberry 4.6 returns
  					// nodes that are no longer in the document #6963
  					if ( elem && elem.parentNode ) {
  						// Handle the case where IE and Opera return items
  						// by name instead of ID
  						if ( elem.id !== match[2] ) {
  							return rootjQuery.find( selector );
  						}
  
  						// Otherwise, we inject the element directly into the jQuery object
  						this.length = 1;
  						this[0] = elem;
  					}
  
  					this.context = document;
  					this.selector = selector;
  					return this;
  				}
  
  			// HANDLE: $(expr, $(...))
  			} else if ( !context || context.jquery ) {
  				return (context || rootjQuery).find( selector );
  
  			// HANDLE: $(expr, context)
  			// (which is just equivalent to: $(context).find(expr)
  			} else {
  				return this.constructor( context ).find( selector );
  			}
  
  		// HANDLE: $(function)
  		// Shortcut for document ready
  		} else if ( jQuery.isFunction( selector ) ) {
  			return rootjQuery.ready( selector );
  		}
  
  		if (selector.selector !== undefined) {
  			this.selector = selector.selector;
  			this.context = selector.context;
  		}
  
  		return jQuery.makeArray( selector, this );
  	},
  
  	// Start with an empty selector
  	selector: "",
  
  	// The current version of jQuery being used
  	jquery: "1.5.2pre",
  
  	// The default length of a jQuery object is 0
  	length: 0,
  
  	// The number of elements contained in the matched element set
  	size: function() {
  		return this.length;
  	},
  
  	toArray: function() {
  		return slice.call( this, 0 );
  	},
  
  	// Get the Nth element in the matched element set OR
  	// Get the whole matched element set as a clean array
  	get: function( num ) {
  		return num == null ?
  
  			// Return a 'clean' array
  			this.toArray() :
  
  			// Return just the object
  			( num < 0 ? this[ this.length + num ] : this[ num ] );
  	},
  
  	// Take an array of elements and push it onto the stack
  	// (returning the new matched element set)
  	pushStack: function( elems, name, selector ) {
  		// Build a new jQuery matched element set
  		var ret = this.constructor();
  
  		if ( jQuery.isArray( elems ) ) {
  			push.apply( ret, elems );
  
  		} else {
  			jQuery.merge( ret, elems );
  		}
  
  		// Add the old object onto the stack (as a reference)
  		ret.prevObject = this;
  
  		ret.context = this.context;
  
  		if ( name === "find" ) {
  			ret.selector = this.selector + (this.selector ? " " : "") + selector;
  		} else if ( name ) {
  			ret.selector = this.selector + "." + name + "(" + selector + ")";
  		}
  
  		// Return the newly-formed element set
  		return ret;
  	},
  
  	// Execute a callback for every element in the matched set.
  	// (You can seed the arguments with an array of args, but this is
  	// only used internally.)
  	each: function( callback, args ) {
  		return jQuery.each( this, callback, args );
  	},
  
  	ready: function( fn ) {
  		// Attach the listeners
  		jQuery.bindReady();
  
  		// Add the callback
  		readyList.done( fn );
  
  		return this;
  	},
  
  	eq: function( i ) {
  		return i === -1 ?
  			this.slice( i ) :
  			this.slice( i, +i + 1 );
  	},
  
  	first: function() {
  		return this.eq( 0 );
  	},
  
  	last: function() {
  		return this.eq( -1 );
  	},
  
  	slice: function() {
  		return this.pushStack( slice.apply( this, arguments ),
  			"slice", slice.call(arguments).join(",") );
  	},
  
  	map: function( callback ) {
  		return this.pushStack( jQuery.map(this, function( elem, i ) {
  			return callback.call( elem, i, elem );
  		}));
  	},
  
  	end: function() {
  		return this.prevObject || this.constructor(null);
  	},
  
  	// For internal use only.
  	// Behaves like an Array's method, not like a jQuery method.
  	push: push,
  	sort: [].sort,
  	splice: [].splice
  };
  
  // Give the init function the jQuery prototype for later instantiation
  jQuery.fn.init.prototype = jQuery.fn;
  
  jQuery.extend = jQuery.fn.extend = function() {
  	var options, name, src, copy, copyIsArray, clone,
  		target = arguments[0] || {},
  		i = 1,
  		length = arguments.length,
  		deep = false;
  
  	// Handle a deep copy situation
  	if ( typeof target === "boolean" ) {
  		deep = target;
  		target = arguments[1] || {};
  		// skip the boolean and the target
  		i = 2;
  	}
  
  	// Handle case when target is a string or something (possible in deep copy)
  	if ( typeof target !== "object" && !jQuery.isFunction(target) ) {
  		target = {};
  	}
  
  	// extend jQuery itself if only one argument is passed
  	if ( length === i ) {
  		target = this;
  		--i;
  	}
  
  	for ( ; i < length; i++ ) {
  		// Only deal with non-null/undefined values
  		if ( (options = arguments[ i ]) != null ) {
  			// Extend the base object
  			for ( name in options ) {
  				src = target[ name ];
  				copy = options[ name ];
  
  				// Prevent never-ending loop
  				if ( target === copy ) {
  					continue;
  				}
  
  				// Recurse if we're merging plain objects or arrays
  				if ( deep && copy && ( jQuery.isPlainObject(copy) || (copyIsArray = jQuery.isArray(copy)) ) ) {
  					if ( copyIsArray ) {
  						copyIsArray = false;
  						clone = src && jQuery.isArray(src) ? src : [];
  
  					} else {
  						clone = src && jQuery.isPlainObject(src) ? src : {};
  					}
  
  					// Never move original objects, clone them
  					target[ name ] = jQuery.extend( deep, clone, copy );
  
  				// Don't bring in undefined values
  				} else if ( copy !== undefined ) {
  					target[ name ] = copy;
  				}
  			}
  		}
  	}
  
  	// Return the modified object
  	return target;
  };
  
  jQuery.extend({
  	noConflict: function( deep ) {
  		window.$ = _$;
  
  		if ( deep ) {
  			window.jQuery = _jQuery;
  		}
  
  		return jQuery;
  	},
  
  	// Is the DOM ready to be used? Set to true once it occurs.
  	isReady: false,
  
  	// A counter to track how many items to wait for before
  	// the ready event fires. See #6781
  	readyWait: 1,
  
  	// Handle when the DOM is ready
  	ready: function( wait ) {
  		// A third-party is pushing the ready event forwards
  		if ( wait === true ) {
  			jQuery.readyWait--;
  		}
  
  		// Make sure that the DOM is not already loaded
  		if ( !jQuery.readyWait || (wait !== true && !jQuery.isReady) ) {
  			// Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
  			if ( !document.body ) {
  				return setTimeout( jQuery.ready, 1 );
  			}
  
  			// Remember that the DOM is ready
  			jQuery.isReady = true;
  
  			// If a normal DOM Ready event fired, decrement, and wait if need be
  			if ( wait !== true && --jQuery.readyWait > 0 ) {
  				return;
  			}
  
  			// If there are functions bound, to execute
  			readyList.resolveWith( document, [ jQuery ] );
  
  			// Trigger any bound ready events
  			if ( jQuery.fn.trigger ) {
  				jQuery( document ).trigger( "ready" ).unbind( "ready" );
  			}
  		}
  	},
  
  	bindReady: function() {
  		if ( readyList ) {
  			return;
  		}
  
  		readyList = jQuery._Deferred();
  
  		// Catch cases where $(document).ready() is called after the
  		// browser event has already occurred.
  		if ( document.readyState === "complete" ) {
  			// Handle it asynchronously to allow scripts the opportunity to delay ready
  			return setTimeout( jQuery.ready, 1 );
  		}
  
  		// Mozilla, Opera and webkit nightlies currently support this event
  		if ( document.addEventListener ) {
  			// Use the handy event callback
  			document.addEventListener( "DOMContentLoaded", DOMContentLoaded, false );
  
  			// A fallback to window.onload, that will always work
  			window.addEventListener( "load", jQuery.ready, false );
  
  		// If IE event model is used
  		} else if ( document.attachEvent ) {
  			// ensure firing before onload,
  			// maybe late but safe also for iframes
  			document.attachEvent("onreadystatechange", DOMContentLoaded);
  
  			// A fallback to window.onload, that will always work
  			window.attachEvent( "onload", jQuery.ready );
  
  			// If IE and not a frame
  			// continually check to see if the document is ready
  			var toplevel = false;
  
  			try {
  				toplevel = window.frameElement == null;
  			} catch(e) {}
  
  			if ( document.documentElement.doScroll && toplevel ) {
  				doScrollCheck();
  			}
  		}
  	},
  
  	// See test/unit/core.js for details concerning isFunction.
  	// Since version 1.3, DOM methods and functions like alert
  	// aren't supported. They return false on IE (#2968).
  	isFunction: function( obj ) {
  		return jQuery.type(obj) === "function";
  	},
  
  	isArray: Array.isArray || function( obj ) {
  		return jQuery.type(obj) === "array";
  	},
  
  	// A crude way of determining if an object is a window
  	isWindow: function( obj ) {
  		return obj && typeof obj === "object" && "setInterval" in obj;
  	},
  
  	isNaN: function( obj ) {
  		return obj == null || !rdigit.test( obj ) || isNaN( obj );
  	},
  
  	type: function( obj ) {
  		return obj == null ?
  			String( obj ) :
  			class2type[ toString.call(obj) ] || "object";
  	},
  
  	isPlainObject: function( obj ) {
  		// Must be an Object.
  		// Because of IE, we also have to check the presence of the constructor property.
  		// Make sure that DOM nodes and window objects don't pass through, as well
  		if ( !obj || jQuery.type(obj) !== "object" || obj.nodeType || jQuery.isWindow( obj ) ) {
  			return false;
  		}
  
  		// Not own constructor property must be Object
  		if ( obj.constructor &&
  			!hasOwn.call(obj, "constructor") &&
  			!hasOwn.call(obj.constructor.prototype, "isPrototypeOf") ) {
  			return false;
  		}
  
  		// Own properties are enumerated firstly, so to speed up,
  		// if last one is own, then all properties are own.
  
  		var key;
  		for ( key in obj ) {}
  
  		return key === undefined || hasOwn.call( obj, key );
  	},
  
  	isEmptyObject: function( obj ) {
  		for ( var name in obj ) {
  			return false;
  		}
  		return true;
  	},
  
  	error: function( msg ) {
  		throw msg;
  	},
  
  	parseJSON: function( data ) {
  		if ( typeof data !== "string" || !data ) {
  			return null;
  		}
  
  		// Make sure leading/trailing whitespace is removed (IE can't handle it)
  		data = jQuery.trim( data );
  
  		// Make sure the incoming data is actual JSON
  		// Logic borrowed from http://json.org/json2.js
  		if ( rvalidchars.test(data.replace(rvalidescape, "@")
  			.replace(rvalidtokens, "]")
  			.replace(rvalidbraces, "")) ) {
  
  			// Try to use the native JSON parser first
  			return window.JSON && window.JSON.parse ?
  				window.JSON.parse( data ) :
  				(new Function("return " + data))();
  
  		} else {
  			jQuery.error( "Invalid JSON: " + data );
  		}
  	},
  
  	// Cross-browser xml parsing
  	// (xml & tmp used internally)
  	parseXML: function( data , xml , tmp ) {
  
  		if ( window.DOMParser ) { // Standard
  			tmp = new DOMParser();
  			xml = tmp.parseFromString( data , "text/xml" );
  		} else { // IE
  			xml = new ActiveXObject( "Microsoft.XMLDOM" );
  			xml.async = "false";
  			xml.loadXML( data );
  		}
  
  		tmp = xml.documentElement;
  
  		if ( ! tmp || ! tmp.nodeName || tmp.nodeName === "parsererror" ) {
  			jQuery.error( "Invalid XML: " + data );
  		}
  
  		return xml;
  	},
  
  	noop: function() {},
  
  	// Evalulates a script in a global context
  	globalEval: function( data ) {
  		if ( data && rnotwhite.test(data) ) {
  			// Inspired by code by Andrea Giammarchi
  			// http://webreflection.blogspot.com/2007/08/global-scope-evaluation-and-dom.html
  			var head = document.head || document.getElementsByTagName( "head" )[0] || document.documentElement,
  				script = document.createElement( "script" );
  
  			if ( jQuery.support.scriptEval() ) {
  				script.appendChild( document.createTextNode( data ) );
  			} else {
  				script.text = data;
  			}
  
  			// Use insertBefore instead of appendChild to circumvent an IE6 bug.
  			// This arises when a base node is used (#2709).
  			head.insertBefore( script, head.firstChild );
  			head.removeChild( script );
  		}
  	},
  
  	nodeName: function( elem, name ) {
  		return elem.nodeName && elem.nodeName.toUpperCase() === name.toUpperCase();
  	},
  
  	// args is for internal usage only
  	each: function( object, callback, args ) {
  		var name, i = 0,
  			length = object.length,
  			isObj = length === undefined || jQuery.isFunction(object);
  
  		if ( args ) {
  			if ( isObj ) {
  				for ( name in object ) {
  					if ( callback.apply( object[ name ], args ) === false ) {
  						break;
  					}
  				}
  			} else {
  				for ( ; i < length; ) {
  					if ( callback.apply( object[ i++ ], args ) === false ) {
  						break;
  					}
  				}
  			}
  
  		// A special, fast, case for the most common use of each
  		} else {
  			if ( isObj ) {
  				for ( name in object ) {
  					if ( callback.call( object[ name ], name, object[ name ] ) === false ) {
  						break;
  					}
  				}
  			} else {
  				for ( var value = object[0];
  					i < length && callback.call( value, i, value ) !== false; value = object[++i] ) {}
  			}
  		}
  
  		return object;
  	},
  
  	// Use native String.trim function wherever possible
  	trim: trim ?
  		function( text ) {
  			return text == null ?
  				"" :
  				trim.call( text );
  		} :
  
  		// Otherwise use our own trimming functionality
  		function( text ) {
  			return text == null ?
  				"" :
  				text.toString().replace( trimLeft, "" ).replace( trimRight, "" );
  		},
  
  	// results is for internal usage only
  	makeArray: function( array, results ) {
  		var ret = results || [];
  
  		if ( array != null ) {
  			// The window, strings (and functions) also have 'length'
  			// The extra typeof function check is to prevent crashes
  			// in Safari 2 (See: #3039)
  			// Tweaked logic slightly to handle Blackberry 4.7 RegExp issues #6930
  			var type = jQuery.type(array);
  
  			if ( array.length == null || type === "string" || type === "function" || type === "regexp" || jQuery.isWindow( array ) ) {
  				push.call( ret, array );
  			} else {
  				jQuery.merge( ret, array );
  			}
  		}
  
  		return ret;
  	},
  
  	inArray: function( elem, array ) {
  		if ( array.indexOf ) {
  			return array.indexOf( elem );
  		}
  
  		for ( var i = 0, length = array.length; i < length; i++ ) {
  			if ( array[ i ] === elem ) {
  				return i;
  			}
  		}
  
  		return -1;
  	},
  
  	merge: function( first, second ) {
  		var i = first.length,
  			j = 0;
  
  		if ( typeof second.length === "number" ) {
  			for ( var l = second.length; j < l; j++ ) {
  				first[ i++ ] = second[ j ];
  			}
  
  		} else {
  			while ( second[j] !== undefined ) {
  				first[ i++ ] = second[ j++ ];
  			}
  		}
  
  		first.length = i;
  
  		return first;
  	},
  
  	grep: function( elems, callback, inv ) {
  		var ret = [], retVal;
  		inv = !!inv;
  
  		// Go through the array, only saving the items
  		// that pass the validator function
  		for ( var i = 0, length = elems.length; i < length; i++ ) {
  			retVal = !!callback( elems[ i ], i );
  			if ( inv !== retVal ) {
  				ret.push( elems[ i ] );
  			}
  		}
  
  		return ret;
  	},
  
  	// arg is for internal usage only
  	map: function( elems, callback, arg ) {
  		var ret = [], value;
  
  		// Go through the array, translating each of the items to their
  		// new value (or values).
  		for ( var i = 0, length = elems.length; i < length; i++ ) {
  			value = callback( elems[ i ], i, arg );
  
  			if ( value != null ) {
  				ret[ ret.length ] = value;
  			}
  		}
  
  		// Flatten any nested arrays
  		return ret.concat.apply( [], ret );
  	},
  
  	// A global GUID counter for objects
  	guid: 1,
  
  	proxy: function( fn, proxy, thisObject ) {
  		if ( arguments.length === 2 ) {
  			if ( typeof proxy === "string" ) {
  				thisObject = fn;
  				fn = thisObject[ proxy ];
  				proxy = undefined;
  
  			} else if ( proxy && !jQuery.isFunction( proxy ) ) {
  				thisObject = proxy;
  				proxy = undefined;
  			}
  		}
  
  		if ( !proxy && fn ) {
  			proxy = function() {
  				return fn.apply( thisObject || this, arguments );
  			};
  		}
  
  		// Set the guid of unique handler to the same of original handler, so it can be removed
  		if ( fn ) {
  			proxy.guid = fn.guid = fn.guid || proxy.guid || jQuery.guid++;
  		}
  
  		// So proxy can be declared as an argument
  		return proxy;
  	},
  
  	// Mutifunctional method to get and set values to a collection
  	// The value/s can be optionally by executed if its a function
  	access: function( elems, key, value, exec, fn, pass ) {
  		var length = elems.length;
  
  		// Setting many attributes
  		if ( typeof key === "object" ) {
  			for ( var k in key ) {
  				jQuery.access( elems, k, key[k], exec, fn, value );
  			}
  			return elems;
  		}
  
  		// Setting one attribute
  		if ( value !== undefined ) {
  			// Optionally, function values get executed if exec is true
  			exec = !pass && exec && jQuery.isFunction(value);
  
  			for ( var i = 0; i < length; i++ ) {
  				fn( elems[i], key, exec ? value.call( elems[i], i, fn( elems[i], key ) ) : value, pass );
  			}
  
  			return elems;
  		}
  
  		// Getting an attribute
  		return length ? fn( elems[0], key ) : undefined;
  	},
  
  	now: function() {
  		return (new Date()).getTime();
  	},
  
  	// Use of jQuery.browser is frowned upon.
  	// More details: http://docs.jquery.com/Utilities/jQuery.browser
  	uaMatch: function( ua ) {
  		ua = ua.toLowerCase();
  
  		var match = rwebkit.exec( ua ) ||
  			ropera.exec( ua ) ||
  			rmsie.exec( ua ) ||
  			ua.indexOf("compatible") < 0 && rmozilla.exec( ua ) ||
  			[];
  
  		return { browser: match[1] || "", version: match[2] || "0" };
  	},
  
  	sub: function() {
  		function jQuerySubclass( selector, context ) {
  			return new jQuerySubclass.fn.init( selector, context );
  		}
  		jQuery.extend( true, jQuerySubclass, this );
  		jQuerySubclass.superclass = this;
  		jQuerySubclass.fn = jQuerySubclass.prototype = this();
  		jQuerySubclass.fn.constructor = jQuerySubclass;
  		jQuerySubclass.subclass = this.subclass;
  		jQuerySubclass.fn.init = function init( selector, context ) {
  			if ( context && context instanceof jQuery && !(context instanceof jQuerySubclass) ) {
  				context = jQuerySubclass(context);
  			}
  
  			return jQuery.fn.init.call( this, selector, context, rootjQuerySubclass );
  		};
  		jQuerySubclass.fn.init.prototype = jQuerySubclass.fn;
  		var rootjQuerySubclass = jQuerySubclass(document);
  		return jQuerySubclass;
  	},
  
  	browser: {}
  });
  
  // Populate the class2type map
  jQuery.each("Boolean Number String Function Array Date RegExp Object".split(" "), function(i, name) {
  	class2type[ "[object " + name + "]" ] = name.toLowerCase();
  });
  
  browserMatch = jQuery.uaMatch( userAgent );
  if ( browserMatch.browser ) {
  	jQuery.browser[ browserMatch.browser ] = true;
  	jQuery.browser.version = browserMatch.version;
  }
  
  // Deprecated, use jQuery.browser.webkit instead
  if ( jQuery.browser.webkit ) {
  	jQuery.browser.safari = true;
  }
  
  if ( indexOf ) {
  	jQuery.inArray = function( elem, array ) {
  		return indexOf.call( array, elem );
  	};
  }
  
  // IE doesn't match non-breaking spaces with \s
  if ( rnotwhite.test( "\xA0" ) ) {
  	trimLeft = /^[\s\xA0]+/;
  	trimRight = /[\s\xA0]+$/;
  }
  
  // All jQuery objects should point back to these
  rootjQuery = jQuery(document);
  
  // Cleanup functions for the document ready method
  if ( document.addEventListener ) {
  	DOMContentLoaded = function() {
  		document.removeEventListener( "DOMContentLoaded", DOMContentLoaded, false );
  		jQuery.ready();
  	};
  
  } else if ( document.attachEvent ) {
  	DOMContentLoaded = function() {
  		// Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
  		if ( document.readyState === "complete" ) {
  			document.detachEvent( "onreadystatechange", DOMContentLoaded );
  			jQuery.ready();
  		}
  	};
  }
  
  // The DOM ready check for Internet Explorer
  function doScrollCheck() {
  	if ( jQuery.isReady ) {
  		return;
  	}
  
  	try {
  		// If IE is used, use the trick by Diego Perini
  		// http://javascript.nwbox.com/IEContentLoaded/
  		document.documentElement.doScroll("left");
  	} catch(e) {
  		setTimeout( doScrollCheck, 1 );
  		return;
  	}
  
  	// and execute any waiting functions
  	jQuery.ready();
  }
  
  // Expose jQuery to the global object
  return jQuery;
  
  })();
  
  
  var // Promise methods
  	promiseMethods = "then done fail isResolved isRejected promise".split( " " ),
  	// Static reference to slice
  	sliceDeferred = [].slice;
  
  jQuery.extend({
  	// Create a simple deferred (one callbacks list)
  	_Deferred: function() {
  		var // callbacks list
  			callbacks = [],
  			// stored [ context , args ]
  			fired,
  			// to avoid firing when already doing so
  			firing,
  			// flag to know if the deferred has been cancelled
  			cancelled,
  			// the deferred itself
  			deferred  = {
  
  				// done( f1, f2, ...)
  				done: function() {
  					if ( !cancelled ) {
  						var args = arguments,
  							i,
  							length,
  							elem,
  							type,
  							_fired;
  						if ( fired ) {
  							_fired = fired;
  							fired = 0;
  						}
  						for ( i = 0, length = args.length; i < length; i++ ) {
  							elem = args[ i ];
  							type = jQuery.type( elem );
  							if ( type === "array" ) {
  								deferred.done.apply( deferred, elem );
  							} else if ( type === "function" ) {
  								callbacks.push( elem );
  							}
  						}
  						if ( _fired ) {
  							deferred.resolveWith( _fired[ 0 ], _fired[ 1 ] );
  						}
  					}
  					return this;
  				},
  
  				// resolve with given context and args
  				resolveWith: function( context, args ) {
  					if ( !cancelled && !fired && !firing ) {
  						// make sure args are available (#8421)
  						args = args || [];
  						firing = 1;
  						try {
  							while( callbacks[ 0 ] ) {
  								callbacks.shift().apply( context, args );
  							}
  						}
  						finally {
  							fired = [ context, args ];
  							firing = 0;
  						}
  					}
  					return this;
  				},
  
  				// resolve with this as context and given arguments
  				resolve: function() {
  					deferred.resolveWith( this, arguments );
  					return this;
  				},
  
  				// Has this deferred been resolved?
  				isResolved: function() {
  					return !!( firing || fired );
  				},
  
  				// Cancel
  				cancel: function() {
  					cancelled = 1;
  					callbacks = [];
  					return this;
  				}
  			};
  
  		return deferred;
  	},
  
  	// Full fledged deferred (two callbacks list)
  	Deferred: function( func ) {
  		var deferred = jQuery._Deferred(),
  			failDeferred = jQuery._Deferred(),
  			promise;
  		// Add errorDeferred methods, then and promise
  		jQuery.extend( deferred, {
  			then: function( doneCallbacks, failCallbacks ) {
  				deferred.done( doneCallbacks ).fail( failCallbacks );
  				return this;
  			},
  			fail: failDeferred.done,
  			rejectWith: failDeferred.resolveWith,
  			reject: failDeferred.resolve,
  			isRejected: failDeferred.isResolved,
  			// Get a promise for this deferred
  			// If obj is provided, the promise aspect is added to the object
  			promise: function( obj ) {
  				if ( obj == null ) {
  					if ( promise ) {
  						return promise;
  					}
  					promise = obj = {};
  				}
  				var i = promiseMethods.length;
  				while( i-- ) {
  					obj[ promiseMethods[i] ] = deferred[ promiseMethods[i] ];
  				}
  				return obj;
  			}
  		} );
  		// Make sure only one callback list will be used
  		deferred.done( failDeferred.cancel ).fail( deferred.cancel );
  		// Unexpose cancel
  		delete deferred.cancel;
  		// Call given func if any
  		if ( func ) {
  			func.call( deferred, deferred );
  		}
  		return deferred;
  	},
  
  	// Deferred helper
  	when: function( firstParam ) {
  		var args = arguments,
  			i = 0,
  			length = args.length,
  			count = length,
  			deferred = length <= 1 && firstParam && jQuery.isFunction( firstParam.promise ) ?
  				firstParam :
  				jQuery.Deferred();
  		function resolveFunc( i ) {
  			return function( value ) {
  				args[ i ] = arguments.length > 1 ? sliceDeferred.call( arguments, 0 ) : value;
  				if ( !( --count ) ) {
  					deferred.resolveWith( deferred, args );
  				}
  			};
  		}
  		if ( length > 1 ) {
  			for( ; i < length; i++ ) {
  				if ( args[ i ] && jQuery.isFunction( args[ i ].promise ) ) {
  					args[ i ].promise().then( resolveFunc(i), deferred.reject );
  				} else {
  					--count;
  				}
  			}
  			if ( !count ) {
  				deferred.resolveWith( deferred, args );
  			}
  		} else if ( deferred !== firstParam ) {
  			deferred.resolveWith( deferred, length ? [ firstParam ] : [] );
  		}
  		return deferred.promise();
  	}
  });
  
  
  
  
  (function() {
  
  	jQuery.support = {};
  
  	var div = document.createElement("div");
  
  	div.style.display = "none";
  	div.innerHTML = "   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";
  
  	var all = div.getElementsByTagName("*"),
  		a = div.getElementsByTagName("a")[0],
  		select = document.createElement("select"),
  		opt = select.appendChild( document.createElement("option") ),
  		input = div.getElementsByTagName("input")[0];
  
  	// Can't get basic test support
  	if ( !all || !all.length || !a ) {
  		return;
  	}
  
  	jQuery.support = {
  		// IE strips leading whitespace when .innerHTML is used
  		leadingWhitespace: div.firstChild.nodeType === 3,
  
  		// Make sure that tbody elements aren't automatically inserted
  		// IE will insert them into empty tables
  		tbody: !div.getElementsByTagName("tbody").length,
  
  		// Make sure that link elements get serialized correctly by innerHTML
  		// This requires a wrapper element in IE
  		htmlSerialize: !!div.getElementsByTagName("link").length,
  
  		// Get the style information from getAttribute
  		// (IE uses .cssText insted)
  		style: /red/.test( a.getAttribute("style") ),
  
  		// Make sure that URLs aren't manipulated
  		// (IE normalizes it by default)
  		hrefNormalized: a.getAttribute("href") === "/a",
  
  		// Make sure that element opacity exists
  		// (IE uses filter instead)
  		// Use a regex to work around a WebKit issue. See #5145
  		opacity: /^0.55$/.test( a.style.opacity ),
  
  		// Verify style float existence
  		// (IE uses styleFloat instead of cssFloat)
  		cssFloat: !!a.style.cssFloat,
  
  		// Make sure that if no value is specified for a checkbox
  		// that it defaults to "on".
  		// (WebKit defaults to "" instead)
  		checkOn: input.value === "on",
  
  		// Make sure that a selected-by-default option has a working selected property.
  		// (WebKit defaults to false instead of true, IE too, if it's in an optgroup)
  		optSelected: opt.selected,
  
  		// Will be defined later
  		deleteExpando: true,
  		optDisabled: false,
  		checkClone: false,
  		noCloneEvent: true,
  		noCloneChecked: true,
  		boxModel: null,
  		inlineBlockNeedsLayout: false,
  		shrinkWrapBlocks: false,
  		reliableHiddenOffsets: true
  	};
  
  	input.checked = true;
  	jQuery.support.noCloneChecked = input.cloneNode( true ).checked;
  
  	// Make sure that the options inside disabled selects aren't marked as disabled
  	// (WebKit marks them as diabled)
  	select.disabled = true;
  	jQuery.support.optDisabled = !opt.disabled;
  
  	var _scriptEval = null;
  	jQuery.support.scriptEval = function() {
  		if ( _scriptEval === null ) {
  			var root = document.documentElement,
  				script = document.createElement("script"),
  				id = "script" + jQuery.now();
  
  			try {
  				script.appendChild( document.createTextNode( "window." + id + "=1;" ) );
  			} catch(e) {}
  
  			root.insertBefore( script, root.firstChild );
  
  			// Make sure that the execution of code works by injecting a script
  			// tag with appendChild/createTextNode
  			// (IE doesn't support this, fails, and uses .text instead)
  			if ( window[ id ] ) {
  				_scriptEval = true;
  				delete window[ id ];
  			} else {
  				_scriptEval = false;
  			}
  
  			root.removeChild( script );
  			// release memory in IE
  			root = script = id  = null;
  		}
  
  		return _scriptEval;
  	};
  
  	// Test to see if it's possible to delete an expando from an element
  	// Fails in Internet Explorer
  	try {
  		delete div.test;
  
  	} catch(e) {
  		jQuery.support.deleteExpando = false;
  	}
  
  	if ( !div.addEventListener && div.attachEvent && div.fireEvent ) {
  		div.attachEvent("onclick", function click() {
  			// Cloning a node shouldn't copy over any
  			// bound event handlers (IE does this)
  			jQuery.support.noCloneEvent = false;
  			div.detachEvent("onclick", click);
  		});
  		div.cloneNode(true).fireEvent("onclick");
  	}
  
  	div = document.createElement("div");
  	div.innerHTML = "<input type='radio' name='radiotest' checked='checked'/>";
  
  	var fragment = document.createDocumentFragment();
  	fragment.appendChild( div.firstChild );
  
  	// WebKit doesn't clone checked state correctly in fragments
  	jQuery.support.checkClone = fragment.cloneNode(true).cloneNode(true).lastChild.checked;
  
  	// Figure out if the W3C box model works as expected
  	// document.body must exist before we can do this
  	jQuery(function() {
  		var div = document.createElement("div"),
  			body = document.getElementsByTagName("body")[0];
  
  		// Frameset documents with no body should not run this code
  		if ( !body ) {
  			return;
  		}
  
  		div.style.width = div.style.paddingLeft = "1px";
  		body.appendChild( div );
  		jQuery.boxModel = jQuery.support.boxModel = div.offsetWidth === 2;
  
  		if ( "zoom" in div.style ) {
  			// Check if natively block-level elements act like inline-block
  			// elements when setting their display to 'inline' and giving
  			// them layout
  			// (IE < 8 does this)
  			div.style.display = "inline";
  			div.style.zoom = 1;
  			jQuery.support.inlineBlockNeedsLayout = div.offsetWidth === 2;
  
  			// Check if elements with layout shrink-wrap their children
  			// (IE 6 does this)
  			div.style.display = "";
  			div.innerHTML = "<div style='width:4px;'></div>";
  			jQuery.support.shrinkWrapBlocks = div.offsetWidth !== 2;
  		}
  
  		div.innerHTML = "<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>";
  		var tds = div.getElementsByTagName("td");
  
  		// Check if table cells still have offsetWidth/Height when they are set
  		// to display:none and there are still other visible table cells in a
  		// table row; if so, offsetWidth/Height are not reliable for use when
  		// determining if an element has been hidden directly using
  		// display:none (it is still safe to use offsets if a parent element is
  		// hidden; don safety goggles and see bug #4512 for more information).
  		// (only IE 8 fails this test)
  		jQuery.support.reliableHiddenOffsets = tds[0].offsetHeight === 0;
  
  		tds[0].style.display = "";
  		tds[1].style.display = "none";
  
  		// Check if empty table cells still have offsetWidth/Height
  		// (IE < 8 fail this test)
  		jQuery.support.reliableHiddenOffsets = jQuery.support.reliableHiddenOffsets && tds[0].offsetHeight === 0;
  		div.innerHTML = "";
  
  		body.removeChild( div ).style.display = "none";
  		div = tds = null;
  	});
  
  	// Technique from Juriy Zaytsev
  	// http://thinkweb2.com/projects/prototype/detecting-event-support-without-browser-sniffing/
  	var eventSupported = function( eventName ) {
  		var el = document.createElement("div");
  		eventName = "on" + eventName;
  
  		// We only care about the case where non-standard event systems
  		// are used, namely in IE. Short-circuiting here helps us to
  		// avoid an eval call (in setAttribute) which can cause CSP
  		// to go haywire. See: https://developer.mozilla.org/en/Security/CSP
  		if ( !el.attachEvent ) {
  			return true;
  		}
  
  		var isSupported = (eventName in el);
  		if ( !isSupported ) {
  			el.setAttribute(eventName, "return;");
  			isSupported = typeof el[eventName] === "function";
  		}
  		el = null;
  
  		return isSupported;
  	};
  
  	jQuery.support.submitBubbles = eventSupported("submit");
  	jQuery.support.changeBubbles = eventSupported("change");
  
  	// release memory in IE
  	div = all = a = null;
  })();
  
  
  
  var rbrace = /^(?:\{.*\}|\[.*\])$/;
  
  jQuery.extend({
  	cache: {},
  
  	// Please use with caution
  	uuid: 0,
  
  	// Unique for each copy of jQuery on the page
  	// Non-digits removed to match rinlinejQuery
  	expando: "jQuery" + ( jQuery.fn.jquery + Math.random() ).replace( /\D/g, "" ),
  
  	// The following elements throw uncatchable exceptions if you
  	// attempt to add expando properties to them.
  	noData: {
  		"embed": true,
  		// Ban all objects except for Flash (which handle expandos)
  		"object": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
  		"applet": true
  	},
  
  	hasData: function( elem ) {
  		elem = elem.nodeType ? jQuery.cache[ elem[jQuery.expando] ] : elem[ jQuery.expando ];
  
  		return !!elem && !isEmptyDataObject( elem );
  	},
  
  	data: function( elem, name, data, pvt /* Internal Use Only */ ) {
  		if ( !jQuery.acceptData( elem ) ) {
  			return;
  		}
  
  		var internalKey = jQuery.expando, getByName = typeof name === "string", thisCache,
  
  			// We have to handle DOM nodes and JS objects differently because IE6-7
  			// can't GC object references properly across the DOM-JS boundary
  			isNode = elem.nodeType,
  
  			// Only DOM nodes need the global jQuery cache; JS object data is
  			// attached directly to the object so GC can occur automatically
  			cache = isNode ? jQuery.cache : elem,
  
  			// Only defining an ID for JS objects if its cache already exists allows
  			// the code to shortcut on the same path as a DOM node with no cache
  			id = isNode ? elem[ jQuery.expando ] : elem[ jQuery.expando ] && jQuery.expando;
  
  		// Avoid doing any more work than we need to when trying to get data on an
  		// object that has no data at all
  		if ( (!id || (pvt && id && !cache[ id ][ internalKey ])) && getByName && data === undefined ) {
  			return;
  		}
  
  		if ( !id ) {
  			// Only DOM nodes need a new unique ID for each element since their data
  			// ends up in the global cache
  			if ( isNode ) {
  				elem[ jQuery.expando ] = id = ++jQuery.uuid;
  			} else {
  				id = jQuery.expando;
  			}
  		}
  
  		if ( !cache[ id ] ) {
  			cache[ id ] = {};
  
  			// TODO: This is a hack for 1.5 ONLY. Avoids exposing jQuery
  			// metadata on plain JS objects when the object is serialized using
  			// JSON.stringify
  			if ( !isNode ) {
  				cache[ id ].toJSON = jQuery.noop;
  			}
  		}
  
  		// An object can be passed to jQuery.data instead of a key/value pair; this gets
  		// shallow copied over onto the existing cache
  		if ( typeof name === "object" || typeof name === "function" ) {
  			if ( pvt ) {
  				cache[ id ][ internalKey ] = jQuery.extend(cache[ id ][ internalKey ], name);
  			} else {
  				cache[ id ] = jQuery.extend(cache[ id ], name);
  			}
  		}
  
  		thisCache = cache[ id ];
  
  		// Internal jQuery data is stored in a separate object inside the object's data
  		// cache in order to avoid key collisions between internal data and user-defined
  		// data
  		if ( pvt ) {
  			if ( !thisCache[ internalKey ] ) {
  				thisCache[ internalKey ] = {};
  			}
  
  			thisCache = thisCache[ internalKey ];
  		}
  
  		if ( data !== undefined ) {
  			thisCache[ name ] = data;
  		}
  
  		// TODO: This is a hack for 1.5 ONLY. It will be removed in 1.6. Users should
  		// not attempt to inspect the internal events object using jQuery.data, as this
  		// internal data object is undocumented and subject to change.
  		if ( name === "events" && !thisCache[name] ) {
  			return thisCache[ internalKey ] && thisCache[ internalKey ].events;
  		}
  
  		return getByName ? thisCache[ name ] : thisCache;
  	},
  
  	removeData: function( elem, name, pvt /* Internal Use Only */ ) {
  		if ( !jQuery.acceptData( elem ) ) {
  			return;
  		}
  
  		var internalKey = jQuery.expando, isNode = elem.nodeType,
  
  			// See jQuery.data for more information
  			cache = isNode ? jQuery.cache : elem,
  
  			// See jQuery.data for more information
  			id = isNode ? elem[ jQuery.expando ] : jQuery.expando;
  
  		// If there is already no cache entry for this object, there is no
  		// purpose in continuing
  		if ( !cache[ id ] ) {
  			return;
  		}
  
  		if ( name ) {
  			var thisCache = pvt ? cache[ id ][ internalKey ] : cache[ id ];
  
  			if ( thisCache ) {
  				delete thisCache[ name ];
  
  				// If there is no data left in the cache, we want to continue
  				// and let the cache object itself get destroyed
  				if ( !isEmptyDataObject(thisCache) ) {
  					return;
  				}
  			}
  		}
  
  		// See jQuery.data for more information
  		if ( pvt ) {
  			delete cache[ id ][ internalKey ];
  
  			// Don't destroy the parent cache unless the internal data object
  			// had been the only thing left in it
  			if ( !isEmptyDataObject(cache[ id ]) ) {
  				return;
  			}
  		}
  
  		var internalCache = cache[ id ][ internalKey ];
  
  		// Browsers that fail expando deletion also refuse to delete expandos on
  		// the window, but it will allow it on all other JS objects; other browsers
  		// don't care
  		if ( jQuery.support.deleteExpando || cache != window ) {
  			delete cache[ id ];
  		} else {
  			cache[ id ] = null;
  		}
  
  		// We destroyed the entire user cache at once because it's faster than
  		// iterating through each key, but we need to continue to persist internal
  		// data if it existed
  		if ( internalCache ) {
  			cache[ id ] = {};
  			// TODO: This is a hack for 1.5 ONLY. Avoids exposing jQuery
  			// metadata on plain JS objects when the object is serialized using
  			// JSON.stringify
  			if ( !isNode ) {
  				cache[ id ].toJSON = jQuery.noop;
  			}
  
  			cache[ id ][ internalKey ] = internalCache;
  
  		// Otherwise, we need to eliminate the expando on the node to avoid
  		// false lookups in the cache for entries that no longer exist
  		} else if ( isNode ) {
  			// IE does not allow us to delete expando properties from nodes,
  			// nor does it have a removeAttribute function on Document nodes;
  			// we must handle all of these cases
  			if ( jQuery.support.deleteExpando ) {
  				delete elem[ jQuery.expando ];
  			} else if ( elem.removeAttribute ) {
  				elem.removeAttribute( jQuery.expando );
  			} else {
  				elem[ jQuery.expando ] = null;
  			}
  		}
  	},
  
  	// For internal use only.
  	_data: function( elem, name, data ) {
  		return jQuery.data( elem, name, data, true );
  	},
  
  	// A method for determining if a DOM node can handle the data expando
  	acceptData: function( elem ) {
  		if ( elem.nodeName ) {
  			var match = jQuery.noData[ elem.nodeName.toLowerCase() ];
  
  			if ( match ) {
  				return !(match === true || elem.getAttribute("classid") !== match);
  			}
  		}
  
  		return true;
  	}
  });
  
  jQuery.fn.extend({
  	data: function( key, value ) {
  		var data = null;
  
  		if ( typeof key === "undefined" ) {
  			if ( this.length ) {
  				data = jQuery.data( this[0] );
  
  				if ( this[0].nodeType === 1 ) {
  					var attr = this[0].attributes, name;
  					for ( var i = 0, l = attr.length; i < l; i++ ) {
  						name = attr[i].name;
  
  						if ( name.indexOf( "data-" ) === 0 ) {
  							name = name.substr( 5 );
  							dataAttr( this[0], name, data[ name ] );
  						}
  					}
  				}
  			}
  
  			return data;
  
  		} else if ( typeof key === "object" ) {
  			return this.each(function() {
  				jQuery.data( this, key );
  			});
  		}
  
  		var parts = key.split(".");
  		parts[1] = parts[1] ? "." + parts[1] : "";
  
  		if ( value === undefined ) {
  			data = this.triggerHandler("getData" + parts[1] + "!", [parts[0]]);
  
  			// Try to fetch any internally stored data first
  			if ( data === undefined && this.length ) {
  				data = jQuery.data( this[0], key );
  				data = dataAttr( this[0], key, data );
  			}
  
  			return data === undefined && parts[1] ?
  				this.data( parts[0] ) :
  				data;
  
  		} else {
  			return this.each(function() {
  				var $this = jQuery( this ),
  					args = [ parts[0], value ];
  
  				$this.triggerHandler( "setData" + parts[1] + "!", args );
  				jQuery.data( this, key, value );
  				$this.triggerHandler( "changeData" + parts[1] + "!", args );
  			});
  		}
  	},
  
  	removeData: function( key ) {
  		return this.each(function() {
  			jQuery.removeData( this, key );
  		});
  	}
  });
  
  function dataAttr( elem, key, data ) {
  	// If nothing was found internally, try to fetch any
  	// data from the HTML5 data-* attribute
  	if ( data === undefined && elem.nodeType === 1 ) {
  		data = elem.getAttribute( "data-" + key );
  
  		if ( typeof data === "string" ) {
  			try {
  				data = data === "true" ? true :
  				data === "false" ? false :
  				data === "null" ? null :
  				!jQuery.isNaN( data ) ? parseFloat( data ) :
  					rbrace.test( data ) ? jQuery.parseJSON( data ) :
  					data;
  			} catch( e ) {}
  
  			// Make sure we set the data so it isn't changed later
  			jQuery.data( elem, key, data );
  
  		} else {
  			data = undefined;
  		}
  	}
  
  	return data;
  }
  
  // TODO: This is a hack for 1.5 ONLY to allow objects with a single toJSON
  // property to be considered empty objects; this property always exists in
  // order to make sure JSON.stringify does not expose internal metadata
  function isEmptyDataObject( obj ) {
  	for ( var name in obj ) {
  		if ( name !== "toJSON" ) {
  			return false;
  		}
  	}
  
  	return true;
  }
  
  
  
  
  jQuery.extend({
  	queue: function( elem, type, data ) {
  		if ( !elem ) {
  			return;
  		}
  
  		type = (type || "fx") + "queue";
  		var q = jQuery._data( elem, type );
  
  		// Speed up dequeue by getting out quickly if this is just a lookup
  		if ( !data ) {
  			return q || [];
  		}
  
  		if ( !q || jQuery.isArray(data) ) {
  			q = jQuery._data( elem, type, jQuery.makeArray(data) );
  
  		} else {
  			q.push( data );
  		}
  
  		return q;
  	},
  
  	dequeue: function( elem, type ) {
  		type = type || "fx";
  
  		var queue = jQuery.queue( elem, type ),
  			fn = queue.shift();
  
  		// If the fx queue is dequeued, always remove the progress sentinel
  		if ( fn === "inprogress" ) {
  			fn = queue.shift();
  		}
  
  		if ( fn ) {
  			// Add a progress sentinel to prevent the fx queue from being
  			// automatically dequeued
  			if ( type === "fx" ) {
  				queue.unshift("inprogress");
  			}
  
  			fn.call(elem, function() {
  				jQuery.dequeue(elem, type);
  			});
  		}
  
  		if ( !queue.length ) {
  			jQuery.removeData( elem, type + "queue", true );
  		}
  	}
  });
  
  jQuery.fn.extend({
  	queue: function( type, data ) {
  		if ( typeof type !== "string" ) {
  			data = type;
  			type = "fx";
  		}
  
  		if ( data === undefined ) {
  			return jQuery.queue( this[0], type );
  		}
  		return this.each(function( i ) {
  			var queue = jQuery.queue( this, type, data );
  
  			if ( type === "fx" && queue[0] !== "inprogress" ) {
  				jQuery.dequeue( this, type );
  			}
  		});
  	},
  	dequeue: function( type ) {
  		return this.each(function() {
  			jQuery.dequeue( this, type );
  		});
  	},
  
  	// Based off of the plugin by Clint Helfers, with permission.
  	// http://blindsignals.com/index.php/2009/07/jquery-delay/
  	delay: function( time, type ) {
  		time = jQuery.fx ? jQuery.fx.speeds[time] || time : time;
  		type = type || "fx";
  
  		return this.queue( type, function() {
  			var elem = this;
  			setTimeout(function() {
  				jQuery.dequeue( elem, type );
  			}, time );
  		});
  	},
  
  	clearQueue: function( type ) {
  		return this.queue( type || "fx", [] );
  	}
  });
  
  
  
  
  var rclass = /[\n\t\r]/g,
  	rspaces = /\s+/,
  	rreturn = /\r/g,
  	rspecialurl = /^(?:href|src|style)$/,
  	rtype = /^(?:button|input)$/i,
  	rfocusable = /^(?:button|input|object|select|textarea)$/i,
  	rclickable = /^a(?:rea)?$/i,
  	rradiocheck = /^(?:radio|checkbox)$/i;
  
  jQuery.props = {
  	"for": "htmlFor",
  	"class": "className",
  	readonly: "readOnly",
  	maxlength: "maxLength",
  	cellspacing: "cellSpacing",
  	rowspan: "rowSpan",
  	colspan: "colSpan",
  	tabindex: "tabIndex",
  	usemap: "useMap",
  	frameborder: "frameBorder"
  };
  
  jQuery.fn.extend({
  	attr: function( name, value ) {
  		return jQuery.access( this, name, value, true, jQuery.attr );
  	},
  
  	removeAttr: function( name, fn ) {
  		return this.each(function(){
  			jQuery.attr( this, name, "" );
  			if ( this.nodeType === 1 ) {
  				this.removeAttribute( name );
  			}
  		});
  	},
  
  	addClass: function( value ) {
  		if ( jQuery.isFunction(value) ) {
  			return this.each(function(i) {
  				var self = jQuery(this);
  				self.addClass( value.call(this, i, self.attr("class")) );
  			});
  		}
  
  		if ( value && typeof value === "string" ) {
  			var classNames = (value || "").split( rspaces );
  
  			for ( var i = 0, l = this.length; i < l; i++ ) {
  				var elem = this[i];
  
  				if ( elem.nodeType === 1 ) {
  					if ( !elem.className ) {
  						elem.className = value;
  
  					} else {
  						var className = " " + elem.className + " ",
  							setClass = elem.className;
  
  						for ( var c = 0, cl = classNames.length; c < cl; c++ ) {
  							if ( className.indexOf( " " + classNames[c] + " " ) < 0 ) {
  								setClass += " " + classNames[c];
  							}
  						}
  						elem.className = jQuery.trim( setClass );
  					}
  				}
  			}
  		}
  
  		return this;
  	},
  
  	removeClass: function( value ) {
  		if ( jQuery.isFunction(value) ) {
  			return this.each(function(i) {
  				var self = jQuery(this);
  				self.removeClass( value.call(this, i, self.attr("class")) );
  			});
  		}
  
  		if ( (value && typeof value === "string") || value === undefined ) {
  			var classNames = (value || "").split( rspaces );
  
  			for ( var i = 0, l = this.length; i < l; i++ ) {
  				var elem = this[i];
  
  				if ( elem.nodeType === 1 && elem.className ) {
  					if ( value ) {
  						var className = (" " + elem.className + " ").replace(rclass, " ");
  						for ( var c = 0, cl = classNames.length; c < cl; c++ ) {
  							className = className.replace(" " + classNames[c] + " ", " ");
  						}
  						elem.className = jQuery.trim( className );
  
  					} else {
  						elem.className = "";
  					}
  				}
  			}
  		}
  
  		return this;
  	},
  
  	toggleClass: function( value, stateVal ) {
  		var type = typeof value,
  			isBool = typeof stateVal === "boolean";
  
  		if ( jQuery.isFunction( value ) ) {
  			return this.each(function(i) {
  				var self = jQuery(this);
  				self.toggleClass( value.call(this, i, self.attr("class"), stateVal), stateVal );
  			});
  		}
  
  		return this.each(function() {
  			if ( type === "string" ) {
  				// toggle individual class names
  				var className,
  					i = 0,
  					self = jQuery( this ),
  					state = stateVal,
  					classNames = value.split( rspaces );
  
  				while ( (className = classNames[ i++ ]) ) {
  					// check each className given, space seperated list
  					state = isBool ? state : !self.hasClass( className );
  					self[ state ? "addClass" : "removeClass" ]( className );
  				}
  
  			} else if ( type === "undefined" || type === "boolean" ) {
  				if ( this.className ) {
  					// store className if set
  					jQuery._data( this, "__className__", this.className );
  				}
  
  				// toggle whole className
  				this.className = this.className || value === false ? "" : jQuery._data( this, "__className__" ) || "";
  			}
  		});
  	},
  
  	hasClass: function( selector ) {
  		var className = " " + selector + " ";
  		for ( var i = 0, l = this.length; i < l; i++ ) {
  			if ( (" " + this[i].className + " ").replace(rclass, " ").indexOf( className ) > -1 ) {
  				return true;
  			}
  		}
  
  		return false;
  	},
  
  	val: function( value ) {
  		if ( !arguments.length ) {
  			var elem = this[0];
  
  			if ( elem ) {
  				if ( jQuery.nodeName( elem, "option" ) ) {
  					// attributes.value is undefined in Blackberry 4.7 but
  					// uses .value. See #6932
  					var val = elem.attributes.value;
  					return !val || val.specified ? elem.value : elem.text;
  				}
  
  				// We need to handle select boxes special
  				if ( jQuery.nodeName( elem, "select" ) ) {
  					var index = elem.selectedIndex,
  						values = [],
  						options = elem.options,
  						one = elem.type === "select-one";
  
  					// Nothing was selected
  					if ( index < 0 ) {
  						return null;
  					}
  
  					// Loop through all the selected options
  					for ( var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++ ) {
  						var option = options[ i ];
  
  						// Don't return options that are disabled or in a disabled optgroup
  						if ( option.selected && (jQuery.support.optDisabled ? !option.disabled : option.getAttribute("disabled") === null) &&
  								(!option.parentNode.disabled || !jQuery.nodeName( option.parentNode, "optgroup" )) ) {
  
  							// Get the specific value for the option
  							value = jQuery(option).val();
  
  							// We don't need an array for one selects
  							if ( one ) {
  								return value;
  							}
  
  							// Multi-Selects return an array
  							values.push( value );
  						}
  					}
  
  					// Fixes Bug #2551 -- select.val() broken in IE after form.reset()
  					if ( one && !values.length && options.length ) {
  						return jQuery( options[ index ] ).val();
  					}
  
  					return values;
  				}
  
  				// Handle the case where in Webkit "" is returned instead of "on" if a value isn't specified
  				if ( rradiocheck.test( elem.type ) && !jQuery.support.checkOn ) {
  					return elem.getAttribute("value") === null ? "on" : elem.value;
  				}
  
  				// Everything else, we just grab the value
  				return (elem.value || "").replace(rreturn, "");
  
  			}
  
  			return undefined;
  		}
  
  		var isFunction = jQuery.isFunction(value);
  
  		return this.each(function(i) {
  			var self = jQuery(this), val = value;
  
  			if ( this.nodeType !== 1 ) {
  				return;
  			}
  
  			if ( isFunction ) {
  				val = value.call(this, i, self.val());
  			}
  
  			// Treat null/undefined as ""; convert numbers to string
  			if ( val == null ) {
  				val = "";
  			} else if ( typeof val === "number" ) {
  				val += "";
  			} else if ( jQuery.isArray(val) ) {
  				val = jQuery.map(val, function (value) {
  					return value == null ? "" : value + "";
  				});
  			}
  
  			if ( jQuery.isArray(val) && rradiocheck.test( this.type ) ) {
  				this.checked = jQuery.inArray( self.val(), val ) >= 0;
  
  			} else if ( jQuery.nodeName( this, "select" ) ) {
  				var values = jQuery.makeArray(val);
  
  				jQuery( "option", this ).each(function() {
  					this.selected = jQuery.inArray( jQuery(this).val(), values ) >= 0;
  				});
  
  				if ( !values.length ) {
  					this.selectedIndex = -1;
  				}
  
  			} else {
  				this.value = val;
  			}
  		});
  	}
  });
  
  jQuery.extend({
  	attrFn: {
  		val: true,
  		css: true,
  		html: true,
  		text: true,
  		data: true,
  		width: true,
  		height: true,
  		offset: true
  	},
  
  	attr: function( elem, name, value, pass ) {
  		// don't get/set attributes on text, comment and attribute nodes
  		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || elem.nodeType === 2 ) {
  			return undefined;
  		}
  
  		if ( pass && name in jQuery.attrFn ) {
  			return jQuery(elem)[name](value);
  		}
  
  		var notxml = elem.nodeType !== 1 || !jQuery.isXMLDoc( elem ),
  			// Whether we are setting (or getting)
  			set = value !== undefined;
  
  		// Try to normalize/fix the name
  		name = notxml && jQuery.props[ name ] || name;
  
  		// Only do all the following if this is a node (faster for style)
  		if ( elem.nodeType === 1 ) {
  			// These attributes require special treatment
  			var special = rspecialurl.test( name );
  
  			// Safari mis-reports the default selected property of an option
  			// Accessing the parent's selectedIndex property fixes it
  			if ( name === "selected" && !jQuery.support.optSelected ) {
  				var parent = elem.parentNode;
  				if ( parent ) {
  					parent.selectedIndex;
  
  					// Make sure that it also works with optgroups, see #5701
  					if ( parent.parentNode ) {
  						parent.parentNode.selectedIndex;
  					}
  				}
  			}
  
  			// If applicable, access the attribute via the DOM 0 way
  			// 'in' checks fail in Blackberry 4.7 #6931
  			if ( (name in elem || elem[ name ] !== undefined) && notxml && !special ) {
  				if ( set ) {
  					// We can't allow the type property to be changed (since it causes problems in IE)
  					if ( name === "type" && rtype.test( elem.nodeName ) && elem.parentNode ) {
  						jQuery.error( "type property can't be changed" );
  					}
  
  					if ( value === null ) {
  						if ( elem.nodeType === 1 ) {
  							elem.removeAttribute( name );
  						}
  
  					} else {
  						elem[ name ] = value;
  					}
  				}
  
  				// browsers index elements by id/name on forms, give priority to attributes.
  				if ( jQuery.nodeName( elem, "form" ) && elem.getAttributeNode(name) ) {
  					return elem.getAttributeNode( name ).nodeValue;
  				}
  
  				// elem.tabIndex doesn't always return the correct value when it hasn't been explicitly set
  				// http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
  				if ( name === "tabIndex" ) {
  					var attributeNode = elem.getAttributeNode( "tabIndex" );
  
  					return attributeNode && attributeNode.specified ?
  						attributeNode.value :
  						rfocusable.test( elem.nodeName ) || rclickable.test( elem.nodeName ) && elem.href ?
  							0 :
  							undefined;
  				}
  
  				return elem[ name ];
  			}
  
  			if ( !jQuery.support.style && notxml && name === "style" ) {
  				if ( set ) {
  					elem.style.cssText = "" + value;
  				}
  
  				return elem.style.cssText;
  			}
  
  			if ( set ) {
  				// convert the value to a string (all browsers do this but IE) see #1070
  				elem.setAttribute( name, "" + value );
  			}
  
  			// Ensure that missing attributes return undefined
  			// Blackberry 4.7 returns "" from getAttribute #6938
  			if ( !elem.attributes[ name ] && (elem.hasAttribute && !elem.hasAttribute( name )) ) {
  				return undefined;
  			}
  
  			var attr = !jQuery.support.hrefNormalized && notxml && special ?
  					// Some attributes require a special call on IE
  					elem.getAttribute( name, 2 ) :
  					elem.getAttribute( name );
  
  			// Non-existent attributes return null, we normalize to undefined
  			return attr === null ? undefined : attr;
  		}
  		// Handle everything which isn't a DOM element node
  		if ( set ) {
  			elem[ name ] = value;
  		}
  		return elem[ name ];
  	}
  });
  
  
  
  
  var rnamespaces = /\.(.*)$/,
  	rformElems = /^(?:textarea|input|select)$/i,
  	rperiod = /\./g,
  	rspace = / /g,
  	rescape = /[^\w\s.|`]/g,
  	fcleanup = function( nm ) {
  		return nm.replace(rescape, "\\$&");
  	};
  
  /*
   * A number of helper functions used for managing events.
   * Many of the ideas behind this code originated from
   * Dean Edwards' addEvent library.
   */
  jQuery.event = {
  
  	// Bind an event to an element
  	// Original by Dean Edwards
  	add: function( elem, types, handler, data ) {
  		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
  			return;
  		}
  
  		// TODO :: Use a try/catch until it's safe to pull this out (likely 1.6)
  		// Minor release fix for bug #8018
  		try {
  			// For whatever reason, IE has trouble passing the window object
  			// around, causing it to be cloned in the process
  			if ( jQuery.isWindow( elem ) && ( elem !== window && !elem.frameElement ) ) {
  				elem = window;
  			}
  		}
  		catch ( e ) {}
  
  		if ( handler === false ) {
  			handler = returnFalse;
  		} else if ( !handler ) {
  			// Fixes bug #7229. Fix recommended by jdalton
  			return;
  		}
  
  		var handleObjIn, handleObj;
  
  		if ( handler.handler ) {
  			handleObjIn = handler;
  			handler = handleObjIn.handler;
  		}
  
  		// Make sure that the function being executed has a unique ID
  		if ( !handler.guid ) {
  			handler.guid = jQuery.guid++;
  		}
  
  		// Init the element's event structure
  		var elemData = jQuery._data( elem );
  
  		// If no elemData is found then we must be trying to bind to one of the
  		// banned noData elements
  		if ( !elemData ) {
  			return;
  		}
  
  		var events = elemData.events,
  			eventHandle = elemData.handle;
  
  		if ( !events ) {
  			elemData.events = events = {};
  		}
  
  		if ( !eventHandle ) {
  			elemData.handle = eventHandle = function() {
  				// Handle the second event of a trigger and when
  				// an event is called after a page has unloaded
  				return typeof jQuery !== "undefined" && !jQuery.event.triggered ?
  					jQuery.event.handle.apply( eventHandle.elem, arguments ) :
  					undefined;
  			};
  		}
  
  		// Add elem as a property of the handle function
  		// This is to prevent a memory leak with non-native events in IE.
  		eventHandle.elem = elem;
  
  		// Handle multiple events separated by a space
  		// jQuery(...).bind("mouseover mouseout", fn);
  		types = types.split(" ");
  
  		var type, i = 0, namespaces;
  
  		while ( (type = types[ i++ ]) ) {
  			handleObj = handleObjIn ?
  				jQuery.extend({}, handleObjIn) :
  				{ handler: handler, data: data };
  
  			// Namespaced event handlers
  			if ( type.indexOf(".") > -1 ) {
  				namespaces = type.split(".");
  				type = namespaces.shift();
  				handleObj.namespace = namespaces.slice(0).sort().join(".");
  
  			} else {
  				namespaces = [];
  				handleObj.namespace = "";
  			}
  
  			handleObj.type = type;
  			if ( !handleObj.guid ) {
  				handleObj.guid = handler.guid;
  			}
  
  			// Get the current list of functions bound to this event
  			var handlers = events[ type ],
  				special = jQuery.event.special[ type ] || {};
  
  			// Init the event handler queue
  			if ( !handlers ) {
  				handlers = events[ type ] = [];
  
  				// Check for a special event handler
  				// Only use addEventListener/attachEvent if the special
  				// events handler returns false
  				if ( !special.setup || special.setup.call( elem, data, namespaces, eventHandle ) === false ) {
  					// Bind the global event handler to the element
  					if ( elem.addEventListener ) {
  						elem.addEventListener( type, eventHandle, false );
  
  					} else if ( elem.attachEvent ) {
  						elem.attachEvent( "on" + type, eventHandle );
  					}
  				}
  			}
  
  			if ( special.add ) {
  				special.add.call( elem, handleObj );
  
  				if ( !handleObj.handler.guid ) {
  					handleObj.handler.guid = handler.guid;
  				}
  			}
  
  			// Add the function to the element's handler list
  			handlers.push( handleObj );
  
  			// Keep track of which events have been used, for global triggering
  			jQuery.event.global[ type ] = true;
  		}
  
  		// Nullify elem to prevent memory leaks in IE
  		elem = null;
  	},
  
  	global: {},
  
  	// Detach an event or set of events from an element
  	remove: function( elem, types, handler, pos ) {
  		// don't do events on text and comment nodes
  		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
  			return;
  		}
  
  		if ( handler === false ) {
  			handler = returnFalse;
  		}
  
  		var ret, type, fn, j, i = 0, all, namespaces, namespace, special, eventType, handleObj, origType,
  			elemData = jQuery.hasData( elem ) && jQuery._data( elem ),
  			events = elemData && elemData.events;
  
  		if ( !elemData || !events ) {
  			return;
  		}
  
  		// types is actually an event object here
  		if ( types && types.type ) {
  			handler = types.handler;
  			types = types.type;
  		}
  
  		// Unbind all events for the element
  		if ( !types || typeof types === "string" && types.charAt(0) === "." ) {
  			types = types || "";
  
  			for ( type in events ) {
  				jQuery.event.remove( elem, type + types );
  			}
  
  			return;
  		}
  
  		// Handle multiple events separated by a space
  		// jQuery(...).unbind("mouseover mouseout", fn);
  		types = types.split(" ");
  
  		while ( (type = types[ i++ ]) ) {
  			origType = type;
  			handleObj = null;
  			all = type.indexOf(".") < 0;
  			namespaces = [];
  
  			if ( !all ) {
  				// Namespaced event handlers
  				namespaces = type.split(".");
  				type = namespaces.shift();
  
  				namespace = new RegExp("(^|\\.)" +
  					jQuery.map( namespaces.slice(0).sort(), fcleanup ).join("\\.(?:.*\\.)?") + "(\\.|$)");
  			}
  
  			eventType = events[ type ];
  
  			if ( !eventType ) {
  				continue;
  			}
  
  			if ( !handler ) {
  				for ( j = 0; j < eventType.length; j++ ) {
  					handleObj = eventType[ j ];
  
  					if ( all || namespace.test( handleObj.namespace ) ) {
  						jQuery.event.remove( elem, origType, handleObj.handler, j );
  						eventType.splice( j--, 1 );
  					}
  				}
  
  				continue;
  			}
  
  			special = jQuery.event.special[ type ] || {};
  
  			for ( j = pos || 0; j < eventType.length; j++ ) {
  				handleObj = eventType[ j ];
  
  				if ( handler.guid === handleObj.guid ) {
  					// remove the given handler for the given type
  					if ( all || namespace.test( handleObj.namespace ) ) {
  						if ( pos == null ) {
  							eventType.splice( j--, 1 );
  						}
  
  						if ( special.remove ) {
  							special.remove.call( elem, handleObj );
  						}
  					}
  
  					if ( pos != null ) {
  						break;
  					}
  				}
  			}
  
  			// remove generic event handler if no more handlers exist
  			if ( eventType.length === 0 || pos != null && eventType.length === 1 ) {
  				if ( !special.teardown || special.teardown.call( elem, namespaces ) === false ) {
  					jQuery.removeEvent( elem, type, elemData.handle );
  				}
  
  				ret = null;
  				delete events[ type ];
  			}
  		}
  
  		// Remove the expando if it's no longer used
  		if ( jQuery.isEmptyObject( events ) ) {
  			var handle = elemData.handle;
  			if ( handle ) {
  				handle.elem = null;
  			}
  
  			delete elemData.events;
  			delete elemData.handle;
  
  			if ( jQuery.isEmptyObject( elemData ) ) {
  				jQuery.removeData( elem, undefined, true );
  			}
  		}
  	},
  
  	// bubbling is internal
  	trigger: function( event, data, elem /*, bubbling */ ) {
  		// Event object or event type
  		var type = event.type || event,
  			bubbling = arguments[3];
  
  		if ( !bubbling ) {
  			event = typeof event === "object" ?
  				// jQuery.Event object
  				event[ jQuery.expando ] ? event :
  				// Object literal
  				jQuery.extend( jQuery.Event(type), event ) :
  				// Just the event type (string)
  				jQuery.Event(type);
  
  			if ( type.indexOf("!") >= 0 ) {
  				event.type = type = type.slice(0, -1);
  				event.exclusive = true;
  			}
  
  			// Handle a global trigger
  			if ( !elem ) {
  				// Don't bubble custom events when global (to avoid too much overhead)
  				event.stopPropagation();
  
  				// Only trigger if we've ever bound an event for it
  				if ( jQuery.event.global[ type ] ) {
  					// XXX This code smells terrible. event.js should not be directly
  					// inspecting the data cache
  					jQuery.each( jQuery.cache, function() {
  						// internalKey variable is just used to make it easier to find
  						// and potentially change this stuff later; currently it just
  						// points to jQuery.expando
  						var internalKey = jQuery.expando,
  							internalCache = this[ internalKey ];
  						if ( internalCache && internalCache.events && internalCache.events[ type ] ) {
  							jQuery.event.trigger( event, data, internalCache.handle.elem );
  						}
  					});
  				}
  			}
  
  			// Handle triggering a single element
  
  			// don't do events on text and comment nodes
  			if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 ) {
  				return undefined;
  			}
  
  			// Clean up in case it is reused
  			event.result = undefined;
  			event.target = elem;
  
  			// Clone the incoming data, if any
  			data = jQuery.makeArray( data );
  			data.unshift( event );
  		}
  
  		event.currentTarget = elem;
  
  		// Trigger the event, it is assumed that "handle" is a function
  		var handle = jQuery._data( elem, "handle" );
  
  		if ( handle ) {
  			handle.apply( elem, data );
  		}
  
  		var parent = elem.parentNode || elem.ownerDocument;
  
  		// Trigger an inline bound script
  		try {
  			if ( !(elem && elem.nodeName && jQuery.noData[elem.nodeName.toLowerCase()]) ) {
  				if ( elem[ "on" + type ] && elem[ "on" + type ].apply( elem, data ) === false ) {
  					event.result = false;
  					event.preventDefault();
  				}
  			}
  
  		// prevent IE from throwing an error for some elements with some event types, see #3533
  		} catch (inlineError) {}
  
  		if ( !event.isPropagationStopped() && parent ) {
  			jQuery.event.trigger( event, data, parent, true );
  
  		} else if ( !event.isDefaultPrevented() ) {
  			var old,
  				target = event.target,
  				targetType = type.replace( rnamespaces, "" ),
  				isClick = jQuery.nodeName( target, "a" ) && targetType === "click",
  				special = jQuery.event.special[ targetType ] || {};
  
  			if ( (!special._default || special._default.call( elem, event ) === false) &&
  				!isClick && !(target && target.nodeName && jQuery.noData[target.nodeName.toLowerCase()]) ) {
  
  				try {
  					if ( target[ targetType ] ) {
  						// Make sure that we don't accidentally re-trigger the onFOO events
  						old = target[ "on" + targetType ];
  
  						if ( old ) {
  							target[ "on" + targetType ] = null;
  						}
  
  						jQuery.event.triggered = true;
  						target[ targetType ]();
  					}
  
  				// prevent IE from throwing an error for some elements with some event types, see #3533
  				} catch (triggerError) {}
  
  				if ( old ) {
  					target[ "on" + targetType ] = old;
  				}
  
  				jQuery.event.triggered = false;
  			}
  		}
  	},
  
  	handle: function( event ) {
  		var all, handlers, namespaces, namespace_re, events,
  			namespace_sort = [],
  			args = jQuery.makeArray( arguments );
  
  		event = args[0] = jQuery.event.fix( event || window.event );
  		event.currentTarget = this;
  
  		// Namespaced event handlers
  		all = event.type.indexOf(".") < 0 && !event.exclusive;
  
  		if ( !all ) {
  			namespaces = event.type.split(".");
  			event.type = namespaces.shift();
  			namespace_sort = namespaces.slice(0).sort();
  			namespace_re = new RegExp("(^|\\.)" + namespace_sort.join("\\.(?:.*\\.)?") + "(\\.|$)");
  		}
  
  		event.namespace = event.namespace || namespace_sort.join(".");
  
  		events = jQuery._data(this, "events");
  
  		handlers = (events || {})[ event.type ];
  
  		if ( events && handlers ) {
  			// Clone the handlers to prevent manipulation
  			handlers = handlers.slice(0);
  
  			for ( var j = 0, l = handlers.length; j < l; j++ ) {
  				var handleObj = handlers[ j ];
  
  				// Filter the functions by class
  				if ( all || namespace_re.test( handleObj.namespace ) ) {
  					// Pass in a reference to the handler function itself
  					// So that we can later remove it
  					event.handler = handleObj.handler;
  					event.data = handleObj.data;
  					event.handleObj = handleObj;
  
  					var ret = handleObj.handler.apply( this, args );
  
  					if ( ret !== undefined ) {
  						event.result = ret;
  						if ( ret === false ) {
  							event.preventDefault();
  							event.stopPropagation();
  						}
  					}
  
  					if ( event.isImmediatePropagationStopped() ) {
  						break;
  					}
  				}
  			}
  		}
  
  		return event.result;
  	},
  
  	props: "altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),
  
  	fix: function( event ) {
  		if ( event[ jQuery.expando ] ) {
  			return event;
  		}
  
  		// store a copy of the original event object
  		// and "clone" to set read-only properties
  		var originalEvent = event;
  		event = jQuery.Event( originalEvent );
  
  		for ( var i = this.props.length, prop; i; ) {
  			prop = this.props[ --i ];
  			event[ prop ] = originalEvent[ prop ];
  		}
  
  		// Fix target property, if necessary
  		if ( !event.target ) {
  			// Fixes #1925 where srcElement might not be defined either
  			event.target = event.srcElement || document;
  		}
  
  		// check if target is a textnode (safari)
  		if ( event.target.nodeType === 3 ) {
  			event.target = event.target.parentNode;
  		}
  
  		// Add relatedTarget, if necessary
  		if ( !event.relatedTarget && event.fromElement ) {
  			event.relatedTarget = event.fromElement === event.target ? event.toElement : event.fromElement;
  		}
  
  		// Calculate pageX/Y if missing and clientX/Y available
  		if ( event.pageX == null && event.clientX != null ) {
  			var doc = document.documentElement,
  				body = document.body;
  
  			event.pageX = event.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc && doc.clientLeft || body && body.clientLeft || 0);
  			event.pageY = event.clientY + (doc && doc.scrollTop  || body && body.scrollTop  || 0) - (doc && doc.clientTop  || body && body.clientTop  || 0);
  		}
  
  		// Add which for key events
  		if ( event.which == null && (event.charCode != null || event.keyCode != null) ) {
  			event.which = event.charCode != null ? event.charCode : event.keyCode;
  		}
  
  		// Add metaKey to non-Mac browsers (use ctrl for PC's and Meta for Macs)
  		if ( !event.metaKey && event.ctrlKey ) {
  			event.metaKey = event.ctrlKey;
  		}
  
  		// Add which for click: 1 === left; 2 === middle; 3 === right
  		// Note: button is not normalized, so don't use it
  		if ( !event.which && event.button !== undefined ) {
  			event.which = (event.button & 1 ? 1 : ( event.button & 2 ? 3 : ( event.button & 4 ? 2 : 0 ) ));
  		}
  
  		return event;
  	},
  
  	// Deprecated, use jQuery.guid instead
  	guid: 1E8,
  
  	// Deprecated, use jQuery.proxy instead
  	proxy: jQuery.proxy,
  
  	special: {
  		ready: {
  			// Make sure the ready event is setup
  			setup: jQuery.bindReady,
  			teardown: jQuery.noop
  		},
  
  		live: {
  			add: function( handleObj ) {
  				jQuery.event.add( this,
  					liveConvert( handleObj.origType, handleObj.selector ),
  					jQuery.extend({}, handleObj, {handler: liveHandler, guid: handleObj.handler.guid}) );
  			},
  
  			remove: function( handleObj ) {
  				jQuery.event.remove( this, liveConvert( handleObj.origType, handleObj.selector ), handleObj );
  			}
  		},
  
  		beforeunload: {
  			setup: function( data, namespaces, eventHandle ) {
  				// We only want to do this special case on windows
  				if ( jQuery.isWindow( this ) ) {
  					this.onbeforeunload = eventHandle;
  				}
  			},
  
  			teardown: function( namespaces, eventHandle ) {
  				if ( this.onbeforeunload === eventHandle ) {
  					this.onbeforeunload = null;
  				}
  			}
  		}
  	}
  };
  
  jQuery.removeEvent = document.removeEventListener ?
  	function( elem, type, handle ) {
  		if ( elem.removeEventListener ) {
  			elem.removeEventListener( type, handle, false );
  		}
  	} :
  	function( elem, type, handle ) {
  		if ( elem.detachEvent ) {
  			elem.detachEvent( "on" + type, handle );
  		}
  	};
  
  jQuery.Event = function( src ) {
  	// Allow instantiation without the 'new' keyword
  	if ( !this.preventDefault ) {
  		return new jQuery.Event( src );
  	}
  
  	// Event object
  	if ( src && src.type ) {
  		this.originalEvent = src;
  		this.type = src.type;
  
  		// Events bubbling up the document may have been marked as prevented
  		// by a handler lower down the tree; reflect the correct value.
  		this.isDefaultPrevented = (src.defaultPrevented || src.returnValue === false ||
  			src.getPreventDefault && src.getPreventDefault()) ? returnTrue : returnFalse;
  
  	// Event type
  	} else {
  		this.type = src;
  	}
  
  	// timeStamp is buggy for some events on Firefox(#3843)
  	// So we won't rely on the native value
  	this.timeStamp = jQuery.now();
  
  	// Mark it as fixed
  	this[ jQuery.expando ] = true;
  };
  
  function returnFalse() {
  	return false;
  }
  function returnTrue() {
  	return true;
  }
  
  // jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
  // http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
  jQuery.Event.prototype = {
  	preventDefault: function() {
  		this.isDefaultPrevented = returnTrue;
  
  		var e = this.originalEvent;
  		if ( !e ) {
  			return;
  		}
  
  		// if preventDefault exists run it on the original event
  		if ( e.preventDefault ) {
  			e.preventDefault();
  
  		// otherwise set the returnValue property of the original event to false (IE)
  		} else {
  			e.returnValue = false;
  		}
  	},
  	stopPropagation: function() {
  		this.isPropagationStopped = returnTrue;
  
  		var e = this.originalEvent;
  		if ( !e ) {
  			return;
  		}
  		// if stopPropagation exists run it on the original event
  		if ( e.stopPropagation ) {
  			e.stopPropagation();
  		}
  		// otherwise set the cancelBubble property of the original event to true (IE)
  		e.cancelBubble = true;
  	},
  	stopImmediatePropagation: function() {
  		this.isImmediatePropagationStopped = returnTrue;
  		this.stopPropagation();
  	},
  	isDefaultPrevented: returnFalse,
  	isPropagationStopped: returnFalse,
  	isImmediatePropagationStopped: returnFalse
  };
  
  // Checks if an event happened on an element within another element
  // Used in jQuery.event.special.mouseenter and mouseleave handlers
  var withinElement = function( event ) {
  	// Check if mouse(over|out) are still within the same parent element
  	var parent = event.relatedTarget;
  
  	// Firefox sometimes assigns relatedTarget a XUL element
  	// which we cannot access the parentNode property of
  	try {
  
  		// Chrome does something similar, the parentNode property
  		// can be accessed but is null.
  		if ( parent !== document && !parent.parentNode ) {
  			return;
  		}
  		// Traverse up the tree
  		while ( parent && parent !== this ) {
  			parent = parent.parentNode;
  		}
  
  		if ( parent !== this ) {
  			// set the correct event type
  			event.type = event.data;
  
  			// handle event if we actually just moused on to a non sub-element
  			jQuery.event.handle.apply( this, arguments );
  		}
  
  	// assuming we've left the element since we most likely mousedover a xul element
  	} catch(e) { }
  },
  
  // In case of event delegation, we only need to rename the event.type,
  // liveHandler will take care of the rest.
  delegate = function( event ) {
  	event.type = event.data;
  	jQuery.event.handle.apply( this, arguments );
  };
  
  // Create mouseenter and mouseleave events
  jQuery.each({
  	mouseenter: "mouseover",
  	mouseleave: "mouseout"
  }, function( orig, fix ) {
  	jQuery.event.special[ orig ] = {
  		setup: function( data ) {
  			jQuery.event.add( this, fix, data && data.selector ? delegate : withinElement, orig );
  		},
  		teardown: function( data ) {
  			jQuery.event.remove( this, fix, data && data.selector ? delegate : withinElement );
  		}
  	};
  });
  
  // submit delegation
  if ( !jQuery.support.submitBubbles ) {
  
  	jQuery.event.special.submit = {
  		setup: function( data, namespaces ) {
  			if ( this.nodeName && this.nodeName.toLowerCase() !== "form" ) {
  				jQuery.event.add(this, "click.specialSubmit", function( e ) {
  					var elem = e.target,
  						type = elem.type;
  
  					if ( (type === "submit" || type === "image") && jQuery( elem ).closest("form").length ) {
  						trigger( "submit", this, arguments );
  					}
  				});
  
  				jQuery.event.add(this, "keypress.specialSubmit", function( e ) {
  					var elem = e.target,
  						type = elem.type;
  
  					if ( (type === "text" || type === "password") && jQuery( elem ).closest("form").length && e.keyCode === 13 ) {
  						trigger( "submit", this, arguments );
  					}
  				});
  
  			} else {
  				return false;
  			}
  		},
  
  		teardown: function( namespaces ) {
  			jQuery.event.remove( this, ".specialSubmit" );
  		}
  	};
  
  }
  
  // change delegation, happens here so we have bind.
  if ( !jQuery.support.changeBubbles ) {
  
  	var changeFilters,
  
  	getVal = function( elem ) {
  		var type = elem.type, val = elem.value;
  
  		if ( type === "radio" || type === "checkbox" ) {
  			val = elem.checked;
  
  		} else if ( type === "select-multiple" ) {
  			val = elem.selectedIndex > -1 ?
  				jQuery.map( elem.options, function( elem ) {
  					return elem.selected;
  				}).join("-") :
  				"";
  
  		} else if ( elem.nodeName.toLowerCase() === "select" ) {
  			val = elem.selectedIndex;
  		}
  
  		return val;
  	},
  
  	testChange = function testChange( e ) {
  		var elem = e.target, data, val;
  
  		if ( !rformElems.test( elem.nodeName ) || elem.readOnly ) {
  			return;
  		}
  
  		data = jQuery._data( elem, "_change_data" );
  		val = getVal(elem);
  
  		// the current data will be also retrieved by beforeactivate
  		if ( e.type !== "focusout" || elem.type !== "radio" ) {
  			jQuery._data( elem, "_change_data", val );
  		}
  
  		if ( data === undefined || val === data ) {
  			return;
  		}
  
  		if ( data != null || val ) {
  			e.type = "change";
  			e.liveFired = undefined;
  			jQuery.event.trigger( e, arguments[1], elem );
  		}
  	};
  
  	jQuery.event.special.change = {
  		filters: {
  			focusout: testChange,
  
  			beforedeactivate: testChange,
  
  			click: function( e ) {
  				var elem = e.target, type = elem.type;
  
  				if ( type === "radio" || type === "checkbox" || elem.nodeName.toLowerCase() === "select" ) {
  					testChange.call( this, e );
  				}
  			},
  
  			// Change has to be called before submit
  			// Keydown will be called before keypress, which is used in submit-event delegation
  			keydown: function( e ) {
  				var elem = e.target, type = elem.type;
  
  				if ( (e.keyCode === 13 && elem.nodeName.toLowerCase() !== "textarea") ||
  					(e.keyCode === 32 && (type === "checkbox" || type === "radio")) ||
  					type === "select-multiple" ) {
  					testChange.call( this, e );
  				}
  			},
  
  			// Beforeactivate happens also before the previous element is blurred
  			// with this event you can't trigger a change event, but you can store
  			// information
  			beforeactivate: function( e ) {
  				var elem = e.target;
  				jQuery._data( elem, "_change_data", getVal(elem) );
  			}
  		},
  
  		setup: function( data, namespaces ) {
  			if ( this.type === "file" ) {
  				return false;
  			}
  
  			for ( var type in changeFilters ) {
  				jQuery.event.add( this, type + ".specialChange", changeFilters[type] );
  			}
  
  			return rformElems.test( this.nodeName );
  		},
  
  		teardown: function( namespaces ) {
  			jQuery.event.remove( this, ".specialChange" );
  
  			return rformElems.test( this.nodeName );
  		}
  	};
  
  	changeFilters = jQuery.event.special.change.filters;
  
  	// Handle when the input is .focus()'d
  	changeFilters.focus = changeFilters.beforeactivate;
  }
  
  function trigger( type, elem, args ) {
  	// Piggyback on a donor event to simulate a different one.
  	// Fake originalEvent to avoid donor's stopPropagation, but if the
  	// simulated event prevents default then we do the same on the donor.
  	// Don't pass args or remember liveFired; they apply to the donor event.
  	var event = jQuery.extend( {}, args[ 0 ] );
  	event.type = type;
  	event.originalEvent = {};
  	event.liveFired = undefined;
  	jQuery.event.handle.call( elem, event );
  	if ( event.isDefaultPrevented() ) {
  		args[ 0 ].preventDefault();
  	}
  }
  
  // Create "bubbling" focus and blur events
  if ( document.addEventListener ) {
  	jQuery.each({ focus: "focusin", blur: "focusout" }, function( orig, fix ) {
  		jQuery.event.special[ fix ] = {
  			setup: function() {
  				this.addEventListener( orig, handler, true );
  			},
  			teardown: function() {
  				this.removeEventListener( orig, handler, true );
  			}
  		};
  
  		function handler( e ) {
  			e = jQuery.event.fix( e );
  			e.type = fix;
  			return jQuery.event.handle.call( this, e );
  		}
  	});
  }
  
  jQuery.each(["bind", "one"], function( i, name ) {
  	jQuery.fn[ name ] = function( type, data, fn ) {
  		// Handle object literals
  		if ( typeof type === "object" ) {
  			for ( var key in type ) {
  				this[ name ](key, data, type[key], fn);
  			}
  			return this;
  		}
  
  		if ( jQuery.isFunction( data ) || data === false ) {
  			fn = data;
  			data = undefined;
  		}
  
  		var handler = name === "one" ? jQuery.proxy( fn, function( event ) {
  			jQuery( this ).unbind( event, handler );
  			return fn.apply( this, arguments );
  		}) : fn;
  
  		if ( type === "unload" && name !== "one" ) {
  			this.one( type, data, fn );
  
  		} else {
  			for ( var i = 0, l = this.length; i < l; i++ ) {
  				jQuery.event.add( this[i], type, handler, data );
  			}
  		}
  
  		return this;
  	};
  });
  
  jQuery.fn.extend({
  	unbind: function( type, fn ) {
  		// Handle object literals
  		if ( typeof type === "object" && !type.preventDefault ) {
  			for ( var key in type ) {
  				this.unbind(key, type[key]);
  			}
  
  		} else {
  			for ( var i = 0, l = this.length; i < l; i++ ) {
  				jQuery.event.remove( this[i], type, fn );
  			}
  		}
  
  		return this;
  	},
  
  	delegate: function( selector, types, data, fn ) {
  		return this.live( types, data, fn, selector );
  	},
  
  	undelegate: function( selector, types, fn ) {
  		if ( arguments.length === 0 ) {
  				return this.unbind( "live" );
  
  		} else {
  			return this.die( types, null, fn, selector );
  		}
  	},
  
  	trigger: function( type, data ) {
  		return this.each(function() {
  			jQuery.event.trigger( type, data, this );
  		});
  	},
  
  	triggerHandler: function( type, data ) {
  		if ( this[0] ) {
  			var event = jQuery.Event( type );
  			event.preventDefault();
  			event.stopPropagation();
  			jQuery.event.trigger( event, data, this[0] );
  			return event.result;
  		}
  	},
  
  	toggle: function( fn ) {
  		// Save reference to arguments for access in closure
  		var args = arguments,
  			i = 1;
  
  		// link all the functions, so any of them can unbind this click handler
  		while ( i < args.length ) {
  			jQuery.proxy( fn, args[ i++ ] );
  		}
  
  		return this.click( jQuery.proxy( fn, function( event ) {
  			// Figure out which function to execute
  			var lastToggle = ( jQuery._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
  			jQuery._data( this, "lastToggle" + fn.guid, lastToggle + 1 );
  
  			// Make sure that clicks stop
  			event.preventDefault();
  
  			// and execute the function
  			return args[ lastToggle ].apply( this, arguments ) || false;
  		}));
  	},
  
  	hover: function( fnOver, fnOut ) {
  		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
  	}
  });
  
  var liveMap = {
  	focus: "focusin",
  	blur: "focusout",
  	mouseenter: "mouseover",
  	mouseleave: "mouseout"
  };
  
  jQuery.each(["live", "die"], function( i, name ) {
  	jQuery.fn[ name ] = function( types, data, fn, origSelector /* Internal Use Only */ ) {
  		var type, i = 0, match, namespaces, preType,
  			selector = origSelector || this.selector,
  			context = origSelector ? this : jQuery( this.context );
  
  		if ( typeof types === "object" && !types.preventDefault ) {
  			for ( var key in types ) {
  				context[ name ]( key, data, types[key], selector );
  			}
  
  			return this;
  		}
  
  		if ( jQuery.isFunction( data ) ) {
  			fn = data;
  			data = undefined;
  		}
  
  		types = (types || "").split(" ");
  
  		while ( (type = types[ i++ ]) != null ) {
  			match = rnamespaces.exec( type );
  			namespaces = "";
  
  			if ( match )  {
  				namespaces = match[0];
  				type = type.replace( rnamespaces, "" );
  			}
  
  			if ( type === "hover" ) {
  				types.push( "mouseenter" + namespaces, "mouseleave" + namespaces );
  				continue;
  			}
  
  			preType = type;
  
  			if ( type === "focus" || type === "blur" ) {
  				types.push( liveMap[ type ] + namespaces );
  				type = type + namespaces;
  
  			} else {
  				type = (liveMap[ type ] || type) + namespaces;
  			}
  
  			if ( name === "live" ) {
  				// bind live handler
  				for ( var j = 0, l = context.length; j < l; j++ ) {
  					jQuery.event.add( context[j], "live." + liveConvert( type, selector ),
  						{ data: data, selector: selector, handler: fn, origType: type, origHandler: fn, preType: preType } );
  				}
  
  			} else {
  				// unbind live handler
  				context.unbind( "live." + liveConvert( type, selector ), fn );
  			}
  		}
  
  		return this;
  	};
  });
  
  function liveHandler( event ) {
  	var stop, maxLevel, related, match, handleObj, elem, j, i, l, data, close, namespace, ret,
  		elems = [],
  		selectors = [],
  		events = jQuery._data( this, "events" );
  
  	// Make sure we avoid non-left-click bubbling in Firefox (#3861) and disabled elements in IE (#6911)
  	if ( event.liveFired === this || !events || !events.live || event.target.disabled || event.button && event.type === "click" ) {
  		return;
  	}
  
  	if ( event.namespace ) {
  		namespace = new RegExp("(^|\\.)" + event.namespace.split(".").join("\\.(?:.*\\.)?") + "(\\.|$)");
  	}
  
  	event.liveFired = this;
  
  	var live = events.live.slice(0);
  
  	for ( j = 0; j < live.length; j++ ) {
  		handleObj = live[j];
  
  		if ( handleObj.origType.replace( rnamespaces, "" ) === event.type ) {
  			selectors.push( handleObj.selector );
  
  		} else {
  			live.splice( j--, 1 );
  		}
  	}
  
  	match = jQuery( event.target ).closest( selectors, event.currentTarget );
  
  	for ( i = 0, l = match.length; i < l; i++ ) {
  		close = match[i];
  
  		for ( j = 0; j < live.length; j++ ) {
  			handleObj = live[j];
  
  			if ( close.selector === handleObj.selector && (!namespace || namespace.test( handleObj.namespace )) && !close.elem.disabled ) {
  				elem = close.elem;
  				related = null;
  
  				// Those two events require additional checking
  				if ( handleObj.preType === "mouseenter" || handleObj.preType === "mouseleave" ) {
  					event.type = handleObj.preType;
  					related = jQuery( event.relatedTarget ).closest( handleObj.selector )[0];
  				}
  
  				if ( !related || related !== elem ) {
  					elems.push({ elem: elem, handleObj: handleObj, level: close.level });
  				}
  			}
  		}
  	}
  
  	for ( i = 0, l = elems.length; i < l; i++ ) {
  		match = elems[i];
  
  		if ( maxLevel && match.level > maxLevel ) {
  			break;
  		}
  
  		event.currentTarget = match.elem;
  		event.data = match.handleObj.data;
  		event.handleObj = match.handleObj;
  
  		ret = match.handleObj.origHandler.apply( match.elem, arguments );
  
  		if ( ret === false || event.isPropagationStopped() ) {
  			maxLevel = match.level;
  
  			if ( ret === false ) {
  				stop = false;
  			}
  			if ( event.isImmediatePropagationStopped() ) {
  				break;
  			}
  		}
  	}
  
  	return stop;
  }
  
  function liveConvert( type, selector ) {
  	return (type && type !== "*" ? type + "." : "") + selector.replace(rperiod, "`").replace(rspace, "&");
  }
  
  jQuery.each( ("blur focus focusin focusout load resize scroll unload click dblclick " +
  	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
  	"change select submit keydown keypress keyup error").split(" "), function( i, name ) {
  
  	// Handle event binding
  	jQuery.fn[ name ] = function( data, fn ) {
  		if ( fn == null ) {
  			fn = data;
  			data = null;
  		}
  
  		return arguments.length > 0 ?
  			this.bind( name, data, fn ) :
  			this.trigger( name );
  	};
  
  	if ( jQuery.attrFn ) {
  		jQuery.attrFn[ name ] = true;
  	}
  });
  
  
  /*!
   * Sizzle CSS Selector Engine
   *  Copyright 2011, The Dojo Foundation
   *  Released under the MIT, BSD, and GPL Licenses.
   *  More information: http://sizzlejs.com/
   */
  (function(){
  
  var chunker = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
  	done = 0,
  	toString = Object.prototype.toString,
  	hasDuplicate = false,
  	baseHasDuplicate = true,
  	rBackslash = /\\/g,
  	rNonWord = /\W/;
  
  // Here we check if the JavaScript engine is using some sort of
  // optimization where it does not always call our comparision
  // function. If that is the case, discard the hasDuplicate value.
  //   Thus far that includes Google Chrome.
  [0, 0].sort(function() {
  	baseHasDuplicate = false;
  	return 0;
  });
  
  var Sizzle = function( selector, context, results, seed ) {
  	results = results || [];
  	context = context || document;
  
  	var origContext = context;
  
  	if ( context.nodeType !== 1 && context.nodeType !== 9 ) {
  		return [];
  	}
  	
  	if ( !selector || typeof selector !== "string" ) {
  		return results;
  	}
  
  	var m, set, checkSet, extra, ret, cur, pop, i,
  		prune = true,
  		contextXML = Sizzle.isXML( context ),
  		parts = [],
  		soFar = selector;
  	
  	// Reset the position of the chunker regexp (start from head)
  	do {
  		chunker.exec( "" );
  		m = chunker.exec( soFar );
  
  		if ( m ) {
  			soFar = m[3];
  		
  			parts.push( m[1] );
  		
  			if ( m[2] ) {
  				extra = m[3];
  				break;
  			}
  		}
  	} while ( m );
  
  	if ( parts.length > 1 && origPOS.exec( selector ) ) {
  
  		if ( parts.length === 2 && Expr.relative[ parts[0] ] ) {
  			set = posProcess( parts[0] + parts[1], context );
  
  		} else {
  			set = Expr.relative[ parts[0] ] ?
  				[ context ] :
  				Sizzle( parts.shift(), context );
  
  			while ( parts.length ) {
  				selector = parts.shift();
  
  				if ( Expr.relative[ selector ] ) {
  					selector += parts.shift();
  				}
  				
  				set = posProcess( selector, set );
  			}
  		}
  
  	} else {
  		// Take a shortcut and set the context if the root selector is an ID
  		// (but not if it'll be faster if the inner selector is an ID)
  		if ( !seed && parts.length > 1 && context.nodeType === 9 && !contextXML &&
  				Expr.match.ID.test(parts[0]) && !Expr.match.ID.test(parts[parts.length - 1]) ) {
  
  			ret = Sizzle.find( parts.shift(), context, contextXML );
  			context = ret.expr ?
  				Sizzle.filter( ret.expr, ret.set )[0] :
  				ret.set[0];
  		}
  
  		if ( context ) {
  			ret = seed ?
  				{ expr: parts.pop(), set: makeArray(seed) } :
  				Sizzle.find( parts.pop(), parts.length === 1 && (parts[0] === "~" || parts[0] === "+") && context.parentNode ? context.parentNode : context, contextXML );
  
  			set = ret.expr ?
  				Sizzle.filter( ret.expr, ret.set ) :
  				ret.set;
  
  			if ( parts.length > 0 ) {
  				checkSet = makeArray( set );
  
  			} else {
  				prune = false;
  			}
  
  			while ( parts.length ) {
  				cur = parts.pop();
  				pop = cur;
  
  				if ( !Expr.relative[ cur ] ) {
  					cur = "";
  				} else {
  					pop = parts.pop();
  				}
  
  				if ( pop == null ) {
  					pop = context;
  				}
  
  				Expr.relative[ cur ]( checkSet, pop, contextXML );
  			}
  
  		} else {
  			checkSet = parts = [];
  		}
  	}
  
  	if ( !checkSet ) {
  		checkSet = set;
  	}
  
  	if ( !checkSet ) {
  		Sizzle.error( cur || selector );
  	}
  
  	if ( toString.call(checkSet) === "[object Array]" ) {
  		if ( !prune ) {
  			results.push.apply( results, checkSet );
  
  		} else if ( context && context.nodeType === 1 ) {
  			for ( i = 0; checkSet[i] != null; i++ ) {
  				if ( checkSet[i] && (checkSet[i] === true || checkSet[i].nodeType === 1 && Sizzle.contains(context, checkSet[i])) ) {
  					results.push( set[i] );
  				}
  			}
  
  		} else {
  			for ( i = 0; checkSet[i] != null; i++ ) {
  				if ( checkSet[i] && checkSet[i].nodeType === 1 ) {
  					results.push( set[i] );
  				}
  			}
  		}
  
  	} else {
  		makeArray( checkSet, results );
  	}
  
  	if ( extra ) {
  		Sizzle( extra, origContext, results, seed );
  		Sizzle.uniqueSort( results );
  	}
  
  	return results;
  };
  
  Sizzle.uniqueSort = function( results ) {
  	if ( sortOrder ) {
  		hasDuplicate = baseHasDuplicate;
  		results.sort( sortOrder );
  
  		if ( hasDuplicate ) {
  			for ( var i = 1; i < results.length; i++ ) {
  				if ( results[i] === results[ i - 1 ] ) {
  					results.splice( i--, 1 );
  				}
  			}
  		}
  	}
  
  	return results;
  };
  
  Sizzle.matches = function( expr, set ) {
  	return Sizzle( expr, null, null, set );
  };
  
  Sizzle.matchesSelector = function( node, expr ) {
  	return Sizzle( expr, null, null, [node] ).length > 0;
  };
  
  Sizzle.find = function( expr, context, isXML ) {
  	var set;
  
  	if ( !expr ) {
  		return [];
  	}
  
  	for ( var i = 0, l = Expr.order.length; i < l; i++ ) {
  		var match,
  			type = Expr.order[i];
  		
  		if ( (match = Expr.leftMatch[ type ].exec( expr )) ) {
  			var left = match[1];
  			match.splice( 1, 1 );
  
  			if ( left.substr( left.length - 1 ) !== "\\" ) {
  				match[1] = (match[1] || "").replace( rBackslash, "" );
  				set = Expr.find[ type ]( match, context, isXML );
  
  				if ( set != null ) {
  					expr = expr.replace( Expr.match[ type ], "" );
  					break;
  				}
  			}
  		}
  	}
  
  	if ( !set ) {
  		set = typeof context.getElementsByTagName !== "undefined" ?
  			context.getElementsByTagName( "*" ) :
  			[];
  	}
  
  	return { set: set, expr: expr };
  };
  
  Sizzle.filter = function( expr, set, inplace, not ) {
  	var match, anyFound,
  		old = expr,
  		result = [],
  		curLoop = set,
  		isXMLFilter = set && set[0] && Sizzle.isXML( set[0] );
  
  	while ( expr && set.length ) {
  		for ( var type in Expr.filter ) {
  			if ( (match = Expr.leftMatch[ type ].exec( expr )) != null && match[2] ) {
  				var found, item,
  					filter = Expr.filter[ type ],
  					left = match[1];
  
  				anyFound = false;
  
  				match.splice(1,1);
  
  				if ( left.substr( left.length - 1 ) === "\\" ) {
  					continue;
  				}
  
  				if ( curLoop === result ) {
  					result = [];
  				}
  
  				if ( Expr.preFilter[ type ] ) {
  					match = Expr.preFilter[ type ]( match, curLoop, inplace, result, not, isXMLFilter );
  
  					if ( !match ) {
  						anyFound = found = true;
  
  					} else if ( match === true ) {
  						continue;
  					}
  				}
  
  				if ( match ) {
  					for ( var i = 0; (item = curLoop[i]) != null; i++ ) {
  						if ( item ) {
  							found = filter( item, match, i, curLoop );
  							var pass = not ^ !!found;
  
  							if ( inplace && found != null ) {
  								if ( pass ) {
  									anyFound = true;
  
  								} else {
  									curLoop[i] = false;
  								}
  
  							} else if ( pass ) {
  								result.push( item );
  								anyFound = true;
  							}
  						}
  					}
  				}
  
  				if ( found !== undefined ) {
  					if ( !inplace ) {
  						curLoop = result;
  					}
  
  					expr = expr.replace( Expr.match[ type ], "" );
  
  					if ( !anyFound ) {
  						return [];
  					}
  
  					break;
  				}
  			}
  		}
  
  		// Improper expression
  		if ( expr === old ) {
  			if ( anyFound == null ) {
  				Sizzle.error( expr );
  
  			} else {
  				break;
  			}
  		}
  
  		old = expr;
  	}
  
  	return curLoop;
  };
  
  Sizzle.error = function( msg ) {
  	throw "Syntax error, unrecognized expression: " + msg;
  };
  
  var Expr = Sizzle.selectors = {
  	order: [ "ID", "NAME", "TAG" ],
  
  	match: {
  		ID: /#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
  		CLASS: /\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
  		NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
  		ATTR: /\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,
  		TAG: /^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
  		CHILD: /:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,
  		POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
  		PSEUDO: /:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
  	},
  
  	leftMatch: {},
  
  	attrMap: {
  		"class": "className",
  		"for": "htmlFor"
  	},
  
  	attrHandle: {
  		href: function( elem ) {
  			return elem.getAttribute( "href" );
  		},
  		type: function( elem ) {
  			return elem.getAttribute( "type" );
  		}
  	},
  
  	relative: {
  		"+": function(checkSet, part){
  			var isPartStr = typeof part === "string",
  				isTag = isPartStr && !rNonWord.test( part ),
  				isPartStrNotTag = isPartStr && !isTag;
  
  			if ( isTag ) {
  				part = part.toLowerCase();
  			}
  
  			for ( var i = 0, l = checkSet.length, elem; i < l; i++ ) {
  				if ( (elem = checkSet[i]) ) {
  					while ( (elem = elem.previousSibling) && elem.nodeType !== 1 ) {}
  
  					checkSet[i] = isPartStrNotTag || elem && elem.nodeName.toLowerCase() === part ?
  						elem || false :
  						elem === part;
  				}
  			}
  
  			if ( isPartStrNotTag ) {
  				Sizzle.filter( part, checkSet, true );
  			}
  		},
  
  		">": function( checkSet, part ) {
  			var elem,
  				isPartStr = typeof part === "string",
  				i = 0,
  				l = checkSet.length;
  
  			if ( isPartStr && !rNonWord.test( part ) ) {
  				part = part.toLowerCase();
  
  				for ( ; i < l; i++ ) {
  					elem = checkSet[i];
  
  					if ( elem ) {
  						var parent = elem.parentNode;
  						checkSet[i] = parent.nodeName.toLowerCase() === part ? parent : false;
  					}
  				}
  
  			} else {
  				for ( ; i < l; i++ ) {
  					elem = checkSet[i];
  
  					if ( elem ) {
  						checkSet[i] = isPartStr ?
  							elem.parentNode :
  							elem.parentNode === part;
  					}
  				}
  
  				if ( isPartStr ) {
  					Sizzle.filter( part, checkSet, true );
  				}
  			}
  		},
  
  		"": function(checkSet, part, isXML){
  			var nodeCheck,
  				doneName = done++,
  				checkFn = dirCheck;
  
  			if ( typeof part === "string" && !rNonWord.test( part ) ) {
  				part = part.toLowerCase();
  				nodeCheck = part;
  				checkFn = dirNodeCheck;
  			}
  
  			checkFn( "parentNode", part, doneName, checkSet, nodeCheck, isXML );
  		},
  
  		"~": function( checkSet, part, isXML ) {
  			var nodeCheck,
  				doneName = done++,
  				checkFn = dirCheck;
  
  			if ( typeof part === "string" && !rNonWord.test( part ) ) {
  				part = part.toLowerCase();
  				nodeCheck = part;
  				checkFn = dirNodeCheck;
  			}
  
  			checkFn( "previousSibling", part, doneName, checkSet, nodeCheck, isXML );
  		}
  	},
  
  	find: {
  		ID: function( match, context, isXML ) {
  			if ( typeof context.getElementById !== "undefined" && !isXML ) {
  				var m = context.getElementById(match[1]);
  				// Check parentNode to catch when Blackberry 4.6 returns
  				// nodes that are no longer in the document #6963
  				return m && m.parentNode ? [m] : [];
  			}
  		},
  
  		NAME: function( match, context ) {
  			if ( typeof context.getElementsByName !== "undefined" ) {
  				var ret = [],
  					results = context.getElementsByName( match[1] );
  
  				for ( var i = 0, l = results.length; i < l; i++ ) {
  					if ( results[i].getAttribute("name") === match[1] ) {
  						ret.push( results[i] );
  					}
  				}
  
  				return ret.length === 0 ? null : ret;
  			}
  		},
  
  		TAG: function( match, context ) {
  			if ( typeof context.getElementsByTagName !== "undefined" ) {
  				return context.getElementsByTagName( match[1] );
  			}
  		}
  	},
  	preFilter: {
  		CLASS: function( match, curLoop, inplace, result, not, isXML ) {
  			match = " " + match[1].replace( rBackslash, "" ) + " ";
  
  			if ( isXML ) {
  				return match;
  			}
  
  			for ( var i = 0, elem; (elem = curLoop[i]) != null; i++ ) {
  				if ( elem ) {
  					if ( not ^ (elem.className && (" " + elem.className + " ").replace(/[\t\n\r]/g, " ").indexOf(match) >= 0) ) {
  						if ( !inplace ) {
  							result.push( elem );
  						}
  
  					} else if ( inplace ) {
  						curLoop[i] = false;
  					}
  				}
  			}
  
  			return false;
  		},
  
  		ID: function( match ) {
  			return match[1].replace( rBackslash, "" );
  		},
  
  		TAG: function( match, curLoop ) {
  			return match[1].replace( rBackslash, "" ).toLowerCase();
  		},
  
  		CHILD: function( match ) {
  			if ( match[1] === "nth" ) {
  				if ( !match[2] ) {
  					Sizzle.error( match[0] );
  				}
  
  				match[2] = match[2].replace(/^\+|\s*/g, '');
  
  				// parse equations like 'even', 'odd', '5', '2n', '3n+2', '4n-1', '-n+6'
  				var test = /(-?)(\d*)(?:n([+\-]?\d*))?/.exec(
  					match[2] === "even" && "2n" || match[2] === "odd" && "2n+1" ||
  					!/\D/.test( match[2] ) && "0n+" + match[2] || match[2]);
  
  				// calculate the numbers (first)n+(last) including if they are negative
  				match[2] = (test[1] + (test[2] || 1)) - 0;
  				match[3] = test[3] - 0;
  			}
  			else if ( match[2] ) {
  				Sizzle.error( match[0] );
  			}
  
  			// TODO: Move to normal caching system
  			match[0] = done++;
  
  			return match;
  		},
  
  		ATTR: function( match, curLoop, inplace, result, not, isXML ) {
  			var name = match[1] = match[1].replace( rBackslash, "" );
  			
  			if ( !isXML && Expr.attrMap[name] ) {
  				match[1] = Expr.attrMap[name];
  			}
  
  			// Handle if an un-quoted value was used
  			match[4] = ( match[4] || match[5] || "" ).replace( rBackslash, "" );
  
  			if ( match[2] === "~=" ) {
  				match[4] = " " + match[4] + " ";
  			}
  
  			return match;
  		},
  
  		PSEUDO: function( match, curLoop, inplace, result, not ) {
  			if ( match[1] === "not" ) {
  				// If we're dealing with a complex expression, or a simple one
  				if ( ( chunker.exec(match[3]) || "" ).length > 1 || /^\w/.test(match[3]) ) {
  					match[3] = Sizzle(match[3], null, null, curLoop);
  
  				} else {
  					var ret = Sizzle.filter(match[3], curLoop, inplace, true ^ not);
  
  					if ( !inplace ) {
  						result.push.apply( result, ret );
  					}
  
  					return false;
  				}
  
  			} else if ( Expr.match.POS.test( match[0] ) || Expr.match.CHILD.test( match[0] ) ) {
  				return true;
  			}
  			
  			return match;
  		},
  
  		POS: function( match ) {
  			match.unshift( true );
  
  			return match;
  		}
  	},
  	
  	filters: {
  		enabled: function( elem ) {
  			return elem.disabled === false && elem.type !== "hidden";
  		},
  
  		disabled: function( elem ) {
  			return elem.disabled === true;
  		},
  
  		checked: function( elem ) {
  			return elem.checked === true;
  		},
  		
  		selected: function( elem ) {
  			// Accessing this property makes selected-by-default
  			// options in Safari work properly
  			if ( elem.parentNode ) {
  				elem.parentNode.selectedIndex;
  			}
  			
  			return elem.selected === true;
  		},
  
  		parent: function( elem ) {
  			return !!elem.firstChild;
  		},
  
  		empty: function( elem ) {
  			return !elem.firstChild;
  		},
  
  		has: function( elem, i, match ) {
  			return !!Sizzle( match[3], elem ).length;
  		},
  
  		header: function( elem ) {
  			return (/h\d/i).test( elem.nodeName );
  		},
  
  		text: function( elem ) {
  			// IE6 and 7 will map elem.type to 'text' for new HTML5 types (search, etc) 
  			// use getAttribute instead to test this case
  			return "text" === elem.getAttribute( 'type' );
  		},
  		radio: function( elem ) {
  			return "radio" === elem.type;
  		},
  
  		checkbox: function( elem ) {
  			return "checkbox" === elem.type;
  		},
  
  		file: function( elem ) {
  			return "file" === elem.type;
  		},
  		password: function( elem ) {
  			return "password" === elem.type;
  		},
  
  		submit: function( elem ) {
  			return "submit" === elem.type;
  		},
  
  		image: function( elem ) {
  			return "image" === elem.type;
  		},
  
  		reset: function( elem ) {
  			return "reset" === elem.type;
  		},
  
  		button: function( elem ) {
  			return "button" === elem.type || elem.nodeName.toLowerCase() === "button";
  		},
  
  		input: function( elem ) {
  			return (/input|select|textarea|button/i).test( elem.nodeName );
  		}
  	},
  	setFilters: {
  		first: function( elem, i ) {
  			return i === 0;
  		},
  
  		last: function( elem, i, match, array ) {
  			return i === array.length - 1;
  		},
  
  		even: function( elem, i ) {
  			return i % 2 === 0;
  		},
  
  		odd: function( elem, i ) {
  			return i % 2 === 1;
  		},
  
  		lt: function( elem, i, match ) {
  			return i < match[3] - 0;
  		},
  
  		gt: function( elem, i, match ) {
  			return i > match[3] - 0;
  		},
  
  		nth: function( elem, i, match ) {
  			return match[3] - 0 === i;
  		},
  
  		eq: function( elem, i, match ) {
  			return match[3] - 0 === i;
  		}
  	},
  	filter: {
  		PSEUDO: function( elem, match, i, array ) {
  			var name = match[1],
  				filter = Expr.filters[ name ];
  
  			if ( filter ) {
  				return filter( elem, i, match, array );
  
  			} else if ( name === "contains" ) {
  				return (elem.textContent || elem.innerText || Sizzle.getText([ elem ]) || "").indexOf(match[3]) >= 0;
  
  			} else if ( name === "not" ) {
  				var not = match[3];
  
  				for ( var j = 0, l = not.length; j < l; j++ ) {
  					if ( not[j] === elem ) {
  						return false;
  					}
  				}
  
  				return true;
  
  			} else {
  				Sizzle.error( name );
  			}
  		},
  
  		CHILD: function( elem, match ) {
  			var type = match[1],
  				node = elem;
  
  			switch ( type ) {
  				case "only":
  				case "first":
  					while ( (node = node.previousSibling) )	 {
  						if ( node.nodeType === 1 ) { 
  							return false; 
  						}
  					}
  
  					if ( type === "first" ) { 
  						return true; 
  					}
  
  					node = elem;
  
  				case "last":
  					while ( (node = node.nextSibling) )	 {
  						if ( node.nodeType === 1 ) { 
  							return false; 
  						}
  					}
  
  					return true;
  
  				case "nth":
  					var first = match[2],
  						last = match[3];
  
  					if ( first === 1 && last === 0 ) {
  						return true;
  					}
  					
  					var doneName = match[0],
  						parent = elem.parentNode;
  	
  					if ( parent && (parent.sizcache !== doneName || !elem.nodeIndex) ) {
  						var count = 0;
  						
  						for ( node = parent.firstChild; node; node = node.nextSibling ) {
  							if ( node.nodeType === 1 ) {
  								node.nodeIndex = ++count;
  							}
  						} 
  
  						parent.sizcache = doneName;
  					}
  					
  					var diff = elem.nodeIndex - last;
  
  					if ( first === 0 ) {
  						return diff === 0;
  
  					} else {
  						return ( diff % first === 0 && diff / first >= 0 );
  					}
  			}
  		},
  
  		ID: function( elem, match ) {
  			return elem.nodeType === 1 && elem.getAttribute("id") === match;
  		},
  
  		TAG: function( elem, match ) {
  			return (match === "*" && elem.nodeType === 1) || elem.nodeName.toLowerCase() === match;
  		},
  		
  		CLASS: function( elem, match ) {
  			return (" " + (elem.className || elem.getAttribute("class")) + " ")
  				.indexOf( match ) > -1;
  		},
  
  		ATTR: function( elem, match ) {
  			var name = match[1],
  				result = Expr.attrHandle[ name ] ?
  					Expr.attrHandle[ name ]( elem ) :
  					elem[ name ] != null ?
  						elem[ name ] :
  						elem.getAttribute( name ),
  				value = result + "",
  				type = match[2],
  				check = match[4];
  
  			return result == null ?
  				type === "!=" :
  				type === "=" ?
  				value === check :
  				type === "*=" ?
  				value.indexOf(check) >= 0 :
  				type === "~=" ?
  				(" " + value + " ").indexOf(check) >= 0 :
  				!check ?
  				value && result !== false :
  				type === "!=" ?
  				value !== check :
  				type === "^=" ?
  				value.indexOf(check) === 0 :
  				type === "$=" ?
  				value.substr(value.length - check.length) === check :
  				type === "|=" ?
  				value === check || value.substr(0, check.length + 1) === check + "-" :
  				false;
  		},
  
  		POS: function( elem, match, i, array ) {
  			var name = match[2],
  				filter = Expr.setFilters[ name ];
  
  			if ( filter ) {
  				return filter( elem, i, match, array );
  			}
  		}
  	}
  };
  
  var origPOS = Expr.match.POS,
  	fescape = function(all, num){
  		return "\\" + (num - 0 + 1);
  	};
  
  for ( var type in Expr.match ) {
  	Expr.match[ type ] = new RegExp( Expr.match[ type ].source + (/(?![^\[]*\])(?![^\(]*\))/.source) );
  	Expr.leftMatch[ type ] = new RegExp( /(^(?:.|\r|\n)*?)/.source + Expr.match[ type ].source.replace(/\\(\d+)/g, fescape) );
  }
  
  var makeArray = function( array, results ) {
  	array = Array.prototype.slice.call( array, 0 );
  
  	if ( results ) {
  		results.push.apply( results, array );
  		return results;
  	}
  	
  	return array;
  };
  
  // Perform a simple check to determine if the browser is capable of
  // converting a NodeList to an array using builtin methods.
  // Also verifies that the returned array holds DOM nodes
  // (which is not the case in the Blackberry browser)
  try {
  	Array.prototype.slice.call( document.documentElement.childNodes, 0 )[0].nodeType;
  
  // Provide a fallback method if it does not work
  } catch( e ) {
  	makeArray = function( array, results ) {
  		var i = 0,
  			ret = results || [];
  
  		if ( toString.call(array) === "[object Array]" ) {
  			Array.prototype.push.apply( ret, array );
  
  		} else {
  			if ( typeof array.length === "number" ) {
  				for ( var l = array.length; i < l; i++ ) {
  					ret.push( array[i] );
  				}
  
  			} else {
  				for ( ; array[i]; i++ ) {
  					ret.push( array[i] );
  				}
  			}
  		}
  
  		return ret;
  	};
  }
  
  var sortOrder, siblingCheck;
  
  if ( document.documentElement.compareDocumentPosition ) {
  	sortOrder = function( a, b ) {
  		if ( a === b ) {
  			hasDuplicate = true;
  			return 0;
  		}
  
  		if ( !a.compareDocumentPosition || !b.compareDocumentPosition ) {
  			return a.compareDocumentPosition ? -1 : 1;
  		}
  
  		return a.compareDocumentPosition(b) & 4 ? -1 : 1;
  	};
  
  } else {
  	sortOrder = function( a, b ) {
  		var al, bl,
  			ap = [],
  			bp = [],
  			aup = a.parentNode,
  			bup = b.parentNode,
  			cur = aup;
  
  		// The nodes are identical, we can exit early
  		if ( a === b ) {
  			hasDuplicate = true;
  			return 0;
  
  		// If the nodes are siblings (or identical) we can do a quick check
  		} else if ( aup === bup ) {
  			return siblingCheck( a, b );
  
  		// If no parents were found then the nodes are disconnected
  		} else if ( !aup ) {
  			return -1;
  
  		} else if ( !bup ) {
  			return 1;
  		}
  
  		// Otherwise they're somewhere else in the tree so we need
  		// to build up a full list of the parentNodes for comparison
  		while ( cur ) {
  			ap.unshift( cur );
  			cur = cur.parentNode;
  		}
  
  		cur = bup;
  
  		while ( cur ) {
  			bp.unshift( cur );
  			cur = cur.parentNode;
  		}
  
  		al = ap.length;
  		bl = bp.length;
  
  		// Start walking down the tree looking for a discrepancy
  		for ( var i = 0; i < al && i < bl; i++ ) {
  			if ( ap[i] !== bp[i] ) {
  				return siblingCheck( ap[i], bp[i] );
  			}
  		}
  
  		// We ended someplace up the tree so do a sibling check
  		return i === al ?
  			siblingCheck( a, bp[i], -1 ) :
  			siblingCheck( ap[i], b, 1 );
  	};
  
  	siblingCheck = function( a, b, ret ) {
  		if ( a === b ) {
  			return ret;
  		}
  
  		var cur = a.nextSibling;
  
  		while ( cur ) {
  			if ( cur === b ) {
  				return -1;
  			}
  
  			cur = cur.nextSibling;
  		}
  
  		return 1;
  	};
  }
  
  // Utility function for retreiving the text value of an array of DOM nodes
  Sizzle.getText = function( elems ) {
  	var ret = "", elem;
  
  	for ( var i = 0; elems[i]; i++ ) {
  		elem = elems[i];
  
  		// Get the text from text nodes and CDATA nodes
  		if ( elem.nodeType === 3 || elem.nodeType === 4 ) {
  			ret += elem.nodeValue;
  
  		// Traverse everything else, except comment nodes
  		} else if ( elem.nodeType !== 8 ) {
  			ret += Sizzle.getText( elem.childNodes );
  		}
  	}
  
  	return ret;
  };
  
  // Check to see if the browser returns elements by name when
  // querying by getElementById (and provide a workaround)
  (function(){
  	// We're going to inject a fake input element with a specified name
  	var form = document.createElement("div"),
  		id = "script" + (new Date()).getTime(),
  		root = document.documentElement;
  
  	form.innerHTML = "<a name='" + id + "'/>";
  
  	// Inject it into the root element, check its status, and remove it quickly
  	root.insertBefore( form, root.firstChild );
  
  	// The workaround has to do additional checks after a getElementById
  	// Which slows things down for other browsers (hence the branching)
  	if ( document.getElementById( id ) ) {
  		Expr.find.ID = function( match, context, isXML ) {
  			if ( typeof context.getElementById !== "undefined" && !isXML ) {
  				var m = context.getElementById(match[1]);
  
  				return m ?
  					m.id === match[1] || typeof m.getAttributeNode !== "undefined" && m.getAttributeNode("id").nodeValue === match[1] ?
  						[m] :
  						undefined :
  					[];
  			}
  		};
  
  		Expr.filter.ID = function( elem, match ) {
  			var node = typeof elem.getAttributeNode !== "undefined" && elem.getAttributeNode("id");
  
  			return elem.nodeType === 1 && node && node.nodeValue === match;
  		};
  	}
  
  	root.removeChild( form );
  
  	// release memory in IE
  	root = form = null;
  })();
  
  (function(){
  	// Check to see if the browser returns only elements
  	// when doing getElementsByTagName("*")
  
  	// Create a fake element
  	var div = document.createElement("div");
  	div.appendChild( document.createComment("") );
  
  	// Make sure no comments are found
  	if ( div.getElementsByTagName("*").length > 0 ) {
  		Expr.find.TAG = function( match, context ) {
  			var results = context.getElementsByTagName( match[1] );
  
  			// Filter out possible comments
  			if ( match[1] === "*" ) {
  				var tmp = [];
  
  				for ( var i = 0; results[i]; i++ ) {
  					if ( results[i].nodeType === 1 ) {
  						tmp.push( results[i] );
  					}
  				}
  
  				results = tmp;
  			}
  
  			return results;
  		};
  	}
  
  	// Check to see if an attribute returns normalized href attributes
  	div.innerHTML = "<a href='#'></a>";
  
  	if ( div.firstChild && typeof div.firstChild.getAttribute !== "undefined" &&
  			div.firstChild.getAttribute("href") !== "#" ) {
  
  		Expr.attrHandle.href = function( elem ) {
  			return elem.getAttribute( "href", 2 );
  		};
  	}
  
  	// release memory in IE
  	div = null;
  })();
  
  if ( document.querySelectorAll ) {
  	(function(){
  		var oldSizzle = Sizzle,
  			div = document.createElement("div"),
  			id = "__sizzle__";
  
  		div.innerHTML = "<p class='TEST'></p>";
  
  		// Safari can't handle uppercase or unicode characters when
  		// in quirks mode.
  		if ( div.querySelectorAll && div.querySelectorAll(".TEST").length === 0 ) {
  			return;
  		}
  	
  		Sizzle = function( query, context, extra, seed ) {
  			context = context || document;
  
  			// Only use querySelectorAll on non-XML documents
  			// (ID selectors don't work in non-HTML documents)
  			if ( !seed && !Sizzle.isXML(context) ) {
  				// See if we find a selector to speed up
  				var match = /^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec( query );
  				
  				if ( match && (context.nodeType === 1 || context.nodeType === 9) ) {
  					// Speed-up: Sizzle("TAG")
  					if ( match[1] ) {
  						return makeArray( context.getElementsByTagName( query ), extra );
  					
  					// Speed-up: Sizzle(".CLASS")
  					} else if ( match[2] && Expr.find.CLASS && context.getElementsByClassName ) {
  						return makeArray( context.getElementsByClassName( match[2] ), extra );
  					}
  				}
  				
  				if ( context.nodeType === 9 ) {
  					// Speed-up: Sizzle("body")
  					// The body element only exists once, optimize finding it
  					if ( query === "body" && context.body ) {
  						return makeArray( [ context.body ], extra );
  						
  					// Speed-up: Sizzle("#ID")
  					} else if ( match && match[3] ) {
  						var elem = context.getElementById( match[3] );
  
  						// Check parentNode to catch when Blackberry 4.6 returns
  						// nodes that are no longer in the document #6963
  						if ( elem && elem.parentNode ) {
  							// Handle the case where IE and Opera return items
  							// by name instead of ID
  							if ( elem.id === match[3] ) {
  								return makeArray( [ elem ], extra );
  							}
  							
  						} else {
  							return makeArray( [], extra );
  						}
  					}
  					
  					try {
  						return makeArray( context.querySelectorAll(query), extra );
  					} catch(qsaError) {}
  
  				// qSA works strangely on Element-rooted queries
  				// We can work around this by specifying an extra ID on the root
  				// and working up from there (Thanks to Andrew Dupont for the technique)
  				// IE 8 doesn't work on object elements
  				} else if ( context.nodeType === 1 && context.nodeName.toLowerCase() !== "object" ) {
  					var oldContext = context,
  						old = context.getAttribute( "id" ),
  						nid = old || id,
  						hasParent = context.parentNode,
  						relativeHierarchySelector = /^\s*[+~]/.test( query );
  
  					if ( !old ) {
  						context.setAttribute( "id", nid );
  					} else {
  						nid = nid.replace( /'/g, "\\$&" );
  					}
  					if ( relativeHierarchySelector && hasParent ) {
  						context = context.parentNode;
  					}
  
  					try {
  						if ( !relativeHierarchySelector || hasParent ) {
  							return makeArray( context.querySelectorAll( "[id='" + nid + "'] " + query ), extra );
  						}
  
  					} catch(pseudoError) {
  					} finally {
  						if ( !old ) {
  							oldContext.removeAttribute( "id" );
  						}
  					}
  				}
  			}
  		
  			return oldSizzle(query, context, extra, seed);
  		};
  
  		for ( var prop in oldSizzle ) {
  			Sizzle[ prop ] = oldSizzle[ prop ];
  		}
  
  		// release memory in IE
  		div = null;
  	})();
  }
  
  (function(){
  	var html = document.documentElement,
  		matches = html.matchesSelector || html.mozMatchesSelector || html.webkitMatchesSelector || html.msMatchesSelector,
  		pseudoWorks = false;
  
  	try {
  		// This should fail with an exception
  		// Gecko does not error, returns false instead
  		matches.call( document.documentElement, "[test!='']:sizzle" );
  	
  	} catch( pseudoError ) {
  		pseudoWorks = true;
  	}
  
  	if ( matches ) {
  		Sizzle.matchesSelector = function( node, expr ) {
  			// Make sure that attribute selectors are quoted
  			expr = expr.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");
  
  			if ( !Sizzle.isXML( node ) ) {
  				try { 
  					if ( pseudoWorks || !Expr.match.PSEUDO.test( expr ) && !/!=/.test( expr ) ) {
  						return matches.call( node, expr );
  					}
  				} catch(e) {}
  			}
  
  			return Sizzle(expr, null, null, [node]).length > 0;
  		};
  	}
  })();
  
  (function(){
  	var div = document.createElement("div");
  
  	div.innerHTML = "<div class='test e'></div><div class='test'></div>";
  
  	// Opera can't find a second classname (in 9.6)
  	// Also, make sure that getElementsByClassName actually exists
  	if ( !div.getElementsByClassName || div.getElementsByClassName("e").length === 0 ) {
  		return;
  	}
  
  	// Safari caches class attributes, doesn't catch changes (in 3.2)
  	div.lastChild.className = "e";
  
  	if ( div.getElementsByClassName("e").length === 1 ) {
  		return;
  	}
  	
  	Expr.order.splice(1, 0, "CLASS");
  	Expr.find.CLASS = function( match, context, isXML ) {
  		if ( typeof context.getElementsByClassName !== "undefined" && !isXML ) {
  			return context.getElementsByClassName(match[1]);
  		}
  	};
  
  	// release memory in IE
  	div = null;
  })();
  
  function dirNodeCheck( dir, cur, doneName, checkSet, nodeCheck, isXML ) {
  	for ( var i = 0, l = checkSet.length; i < l; i++ ) {
  		var elem = checkSet[i];
  
  		if ( elem ) {
  			var match = false;
  
  			elem = elem[dir];
  
  			while ( elem ) {
  				if ( elem.sizcache === doneName ) {
  					match = checkSet[elem.sizset];
  					break;
  				}
  
  				if ( elem.nodeType === 1 && !isXML ){
  					elem.sizcache = doneName;
  					elem.sizset = i;
  				}
  
  				if ( elem.nodeName.toLowerCase() === cur ) {
  					match = elem;
  					break;
  				}
  
  				elem = elem[dir];
  			}
  
  			checkSet[i] = match;
  		}
  	}
  }
  
  function dirCheck( dir, cur, doneName, checkSet, nodeCheck, isXML ) {
  	for ( var i = 0, l = checkSet.length; i < l; i++ ) {
  		var elem = checkSet[i];
  
  		if ( elem ) {
  			var match = false;
  			
  			elem = elem[dir];
  
  			while ( elem ) {
  				if ( elem.sizcache === doneName ) {
  					match = checkSet[elem.sizset];
  					break;
  				}
  
  				if ( elem.nodeType === 1 ) {
  					if ( !isXML ) {
  						elem.sizcache = doneName;
  						elem.sizset = i;
  					}
  
  					if ( typeof cur !== "string" ) {
  						if ( elem === cur ) {
  							match = true;
  							break;
  						}
  
  					} else if ( Sizzle.filter( cur, [elem] ).length > 0 ) {
  						match = elem;
  						break;
  					}
  				}
  
  				elem = elem[dir];
  			}
  
  			checkSet[i] = match;
  		}
  	}
  }
  
  if ( document.documentElement.contains ) {
  	Sizzle.contains = function( a, b ) {
  		return a !== b && (a.contains ? a.contains(b) : true);
  	};
  
  } else if ( document.documentElement.compareDocumentPosition ) {
  	Sizzle.contains = function( a, b ) {
  		return !!(a.compareDocumentPosition(b) & 16);
  	};
  
  } else {
  	Sizzle.contains = function() {
  		return false;
  	};
  }
  
  Sizzle.isXML = function( elem ) {
  	// documentElement is verified for cases where it doesn't yet exist
  	// (such as loading iframes in IE - #4833) 
  	var documentElement = (elem ? elem.ownerDocument || elem : 0).documentElement;
  
  	return documentElement ? documentElement.nodeName !== "HTML" : false;
  };
  
  var posProcess = function( selector, context ) {
  	var match,
  		tmpSet = [],
  		later = "",
  		root = context.nodeType ? [context] : context;
  
  	// Position selectors must be done after the filter
  	// And so must :not(positional) so we move all PSEUDOs to the end
  	while ( (match = Expr.match.PSEUDO.exec( selector )) ) {
  		later += match[0];
  		selector = selector.replace( Expr.match.PSEUDO, "" );
  	}
  
  	selector = Expr.relative[selector] ? selector + "*" : selector;
  
  	for ( var i = 0, l = root.length; i < l; i++ ) {
  		Sizzle( selector, root[i], tmpSet );
  	}
  
  	return Sizzle.filter( later, tmpSet );
  };
  
  // EXPOSE
  jQuery.find = Sizzle;
  jQuery.expr = Sizzle.selectors;
  jQuery.expr[":"] = jQuery.expr.filters;
  jQuery.unique = Sizzle.uniqueSort;
  jQuery.text = Sizzle.getText;
  jQuery.isXMLDoc = Sizzle.isXML;
  jQuery.contains = Sizzle.contains;
  
  
  })();
  
  
  var runtil = /Until$/,
  	rparentsprev = /^(?:parents|prevUntil|prevAll)/,
  	// Note: This RegExp should be improved, or likely pulled from Sizzle
  	rmultiselector = /,/,
  	isSimple = /^.[^:#\[\.,]*$/,
  	slice = Array.prototype.slice,
  	POS = jQuery.expr.match.POS,
  	// methods guaranteed to produce a unique set when starting from a unique set
  	guaranteedUnique = {
  		children: true,
  		contents: true,
  		next: true,
  		prev: true
  	};
  
  jQuery.fn.extend({
  	find: function( selector ) {
  		var ret = this.pushStack( "", "find", selector ),
  			length = 0;
  
  		for ( var i = 0, l = this.length; i < l; i++ ) {
  			length = ret.length;
  			jQuery.find( selector, this[i], ret );
  
  			if ( i > 0 ) {
  				// Make sure that the results are unique
  				for ( var n = length; n < ret.length; n++ ) {
  					for ( var r = 0; r < length; r++ ) {
  						if ( ret[r] === ret[n] ) {
  							ret.splice(n--, 1);
  							break;
  						}
  					}
  				}
  			}
  		}
  
  		return ret;
  	},
  
  	has: function( target ) {
  		var targets = jQuery( target );
  		return this.filter(function() {
  			for ( var i = 0, l = targets.length; i < l; i++ ) {
  				if ( jQuery.contains( this, targets[i] ) ) {
  					return true;
  				}
  			}
  		});
  	},
  
  	not: function( selector ) {
  		return this.pushStack( winnow(this, selector, false), "not", selector);
  	},
  
  	filter: function( selector ) {
  		return this.pushStack( winnow(this, selector, true), "filter", selector );
  	},
  
  	is: function( selector ) {
  		return !!selector && jQuery.filter( selector, this ).length > 0;
  	},
  
  	closest: function( selectors, context ) {
  		var ret = [], i, l, cur = this[0];
  
  		if ( jQuery.isArray( selectors ) ) {
  			var match, selector,
  				matches = {},
  				level = 1;
  
  			if ( cur && selectors.length ) {
  				for ( i = 0, l = selectors.length; i < l; i++ ) {
  					selector = selectors[i];
  
  					if ( !matches[selector] ) {
  						matches[selector] = jQuery.expr.match.POS.test( selector ) ?
  							jQuery( selector, context || this.context ) :
  							selector;
  					}
  				}
  
  				while ( cur && cur.ownerDocument && cur !== context ) {
  					for ( selector in matches ) {
  						match = matches[selector];
  
  						if ( match.jquery ? match.index(cur) > -1 : jQuery(cur).is(match) ) {
  							ret.push({ selector: selector, elem: cur, level: level });
  						}
  					}
  
  					cur = cur.parentNode;
  					level++;
  				}
  			}
  
  			return ret;
  		}
  
  		var pos = POS.test( selectors ) ?
  			jQuery( selectors, context || this.context ) : null;
  
  		for ( i = 0, l = this.length; i < l; i++ ) {
  			cur = this[i];
  
  			while ( cur ) {
  				if ( pos ? pos.index(cur) > -1 : jQuery.find.matchesSelector(cur, selectors) ) {
  					ret.push( cur );
  					break;
  
  				} else {
  					cur = cur.parentNode;
  					if ( !cur || !cur.ownerDocument || cur === context ) {
  						break;
  					}
  				}
  			}
  		}
  
  		ret = ret.length > 1 ? jQuery.unique(ret) : ret;
  
  		return this.pushStack( ret, "closest", selectors );
  	},
  
  	// Determine the position of an element within
  	// the matched set of elements
  	index: function( elem ) {
  		if ( !elem || typeof elem === "string" ) {
  			return jQuery.inArray( this[0],
  				// If it receives a string, the selector is used
  				// If it receives nothing, the siblings are used
  				elem ? jQuery( elem ) : this.parent().children() );
  		}
  		// Locate the position of the desired element
  		return jQuery.inArray(
  			// If it receives a jQuery object, the first element is used
  			elem.jquery ? elem[0] : elem, this );
  	},
  
  	add: function( selector, context ) {
  		var set = typeof selector === "string" ?
  				jQuery( selector, context ) :
  				jQuery.makeArray( selector ),
  			all = jQuery.merge( this.get(), set );
  
  		return this.pushStack( isDisconnected( set[0] ) || isDisconnected( all[0] ) ?
  			all :
  			jQuery.unique( all ) );
  	},
  
  	andSelf: function() {
  		return this.add( this.prevObject );
  	}
  });
  
  // A painfully simple check to see if an element is disconnected
  // from a document (should be improved, where feasible).
  function isDisconnected( node ) {
  	return !node || !node.parentNode || node.parentNode.nodeType === 11;
  }
  
  jQuery.each({
  	parent: function( elem ) {
  		var parent = elem.parentNode;
  		return parent && parent.nodeType !== 11 ? parent : null;
  	},
  	parents: function( elem ) {
  		return jQuery.dir( elem, "parentNode" );
  	},
  	parentsUntil: function( elem, i, until ) {
  		return jQuery.dir( elem, "parentNode", until );
  	},
  	next: function( elem ) {
  		return jQuery.nth( elem, 2, "nextSibling" );
  	},
  	prev: function( elem ) {
  		return jQuery.nth( elem, 2, "previousSibling" );
  	},
  	nextAll: function( elem ) {
  		return jQuery.dir( elem, "nextSibling" );
  	},
  	prevAll: function( elem ) {
  		return jQuery.dir( elem, "previousSibling" );
  	},
  	nextUntil: function( elem, i, until ) {
  		return jQuery.dir( elem, "nextSibling", until );
  	},
  	prevUntil: function( elem, i, until ) {
  		return jQuery.dir( elem, "previousSibling", until );
  	},
  	siblings: function( elem ) {
  		return jQuery.sibling( elem.parentNode.firstChild, elem );
  	},
  	children: function( elem ) {
  		return jQuery.sibling( elem.firstChild );
  	},
  	contents: function( elem ) {
  		return jQuery.nodeName( elem, "iframe" ) ?
  			elem.contentDocument || elem.contentWindow.document :
  			jQuery.makeArray( elem.childNodes );
  	}
  }, function( name, fn ) {
  	jQuery.fn[ name ] = function( until, selector ) {
  		var ret = jQuery.map( this, fn, until ),
  			// The variable 'args' was introduced in
  			// https://github.com/jquery/jquery/commit/52a0238
  			// to work around a bug in Chrome 10 (Dev) and should be removed when the bug is fixed.
  			// http://code.google.com/p/v8/issues/detail?id=1050
  			args = slice.call(arguments);
  
  		if ( !runtil.test( name ) ) {
  			selector = until;
  		}
  
  		if ( selector && typeof selector === "string" ) {
  			ret = jQuery.filter( selector, ret );
  		}
  
  		ret = this.length > 1 && !guaranteedUnique[ name ] ? jQuery.unique( ret ) : ret;
  
  		if ( (this.length > 1 || rmultiselector.test( selector )) && rparentsprev.test( name ) ) {
  			ret = ret.reverse();
  		}
  
  		return this.pushStack( ret, name, args.join(",") );
  	};
  });
  
  jQuery.extend({
  	filter: function( expr, elems, not ) {
  		if ( not ) {
  			expr = ":not(" + expr + ")";
  		}
  
  		return elems.length === 1 ?
  			jQuery.find.matchesSelector(elems[0], expr) ? [ elems[0] ] : [] :
  			jQuery.find.matches(expr, elems);
  	},
  
  	dir: function( elem, dir, until ) {
  		var matched = [],
  			cur = elem[ dir ];
  
  		while ( cur && cur.nodeType !== 9 && (until === undefined || cur.nodeType !== 1 || !jQuery( cur ).is( until )) ) {
  			if ( cur.nodeType === 1 ) {
  				matched.push( cur );
  			}
  			cur = cur[dir];
  		}
  		return matched;
  	},
  
  	nth: function( cur, result, dir, elem ) {
  		result = result || 1;
  		var num = 0;
  
  		for ( ; cur; cur = cur[dir] ) {
  			if ( cur.nodeType === 1 && ++num === result ) {
  				break;
  			}
  		}
  
  		return cur;
  	},
  
  	sibling: function( n, elem ) {
  		var r = [];
  
  		for ( ; n; n = n.nextSibling ) {
  			if ( n.nodeType === 1 && n !== elem ) {
  				r.push( n );
  			}
  		}
  
  		return r;
  	}
  });
  
  // Implement the identical functionality for filter and not
  function winnow( elements, qualifier, keep ) {
  	if ( jQuery.isFunction( qualifier ) ) {
  		return jQuery.grep(elements, function( elem, i ) {
  			var retVal = !!qualifier.call( elem, i, elem );
  			return retVal === keep;
  		});
  
  	} else if ( qualifier.nodeType ) {
  		return jQuery.grep(elements, function( elem, i ) {
  			return (elem === qualifier) === keep;
  		});
  
  	} else if ( typeof qualifier === "string" ) {
  		var filtered = jQuery.grep(elements, function( elem ) {
  			return elem.nodeType === 1;
  		});
  
  		if ( isSimple.test( qualifier ) ) {
  			return jQuery.filter(qualifier, filtered, !keep);
  		} else {
  			qualifier = jQuery.filter( qualifier, filtered );
  		}
  	}
  
  	return jQuery.grep(elements, function( elem, i ) {
  		return (jQuery.inArray( elem, qualifier ) >= 0) === keep;
  	});
  }
  
  
  
  
  var rinlinejQuery = / jQuery\d+="(?:\d+|null)"/g,
  	rleadingWhitespace = /^\s+/,
  	rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,
  	rtagName = /<([\w:]+)/,
  	rtbody = /<tbody/i,
  	rhtml = /<|&#?\w+;/,
  	rnocache = /<(?:script|object|embed|option|style)/i,
  	// checked="checked" or checked
  	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
  	wrapMap = {
  		option: [ 1, "<select multiple='multiple'>", "</select>" ],
  		legend: [ 1, "<fieldset>", "</fieldset>" ],
  		thead: [ 1, "<table>", "</table>" ],
  		tr: [ 2, "<table><tbody>", "</tbody></table>" ],
  		td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],
  		col: [ 2, "<table><tbody></tbody><colgroup>", "</colgroup></table>" ],
  		area: [ 1, "<map>", "</map>" ],
  		_default: [ 0, "", "" ]
  	};
  
  wrapMap.optgroup = wrapMap.option;
  wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
  wrapMap.th = wrapMap.td;
  
  // IE can't serialize <link> and <script> tags normally
  if ( !jQuery.support.htmlSerialize ) {
  	wrapMap._default = [ 1, "div<div>", "</div>" ];
  }
  
  jQuery.fn.extend({
  	text: function( text ) {
  		if ( jQuery.isFunction(text) ) {
  			return this.each(function(i) {
  				var self = jQuery( this );
  
  				self.text( text.call(this, i, self.text()) );
  			});
  		}
  
  		if ( typeof text !== "object" && text !== undefined ) {
  			return this.empty().append( (this[0] && this[0].ownerDocument || document).createTextNode( text ) );
  		}
  
  		return jQuery.text( this );
  	},
  
  	wrapAll: function( html ) {
  		if ( jQuery.isFunction( html ) ) {
  			return this.each(function(i) {
  				jQuery(this).wrapAll( html.call(this, i) );
  			});
  		}
  
  		if ( this[0] ) {
  			// The elements to wrap the target around
  			var wrap = jQuery( html, this[0].ownerDocument ).eq(0).clone(true);
  
  			if ( this[0].parentNode ) {
  				wrap.insertBefore( this[0] );
  			}
  
  			wrap.map(function() {
  				var elem = this;
  
  				while ( elem.firstChild && elem.firstChild.nodeType === 1 ) {
  					elem = elem.firstChild;
  				}
  
  				return elem;
  			}).append(this);
  		}
  
  		return this;
  	},
  
  	wrapInner: function( html ) {
  		if ( jQuery.isFunction( html ) ) {
  			return this.each(function(i) {
  				jQuery(this).wrapInner( html.call(this, i) );
  			});
  		}
  
  		return this.each(function() {
  			var self = jQuery( this ),
  				contents = self.contents();
  
  			if ( contents.length ) {
  				contents.wrapAll( html );
  
  			} else {
  				self.append( html );
  			}
  		});
  	},
  
  	wrap: function( html ) {
  		return this.each(function() {
  			jQuery( this ).wrapAll( html );
  		});
  	},
  
  	unwrap: function() {
  		return this.parent().each(function() {
  			if ( !jQuery.nodeName( this, "body" ) ) {
  				jQuery( this ).replaceWith( this.childNodes );
  			}
  		}).end();
  	},
  
  	append: function() {
  		return this.domManip(arguments, true, function( elem ) {
  			if ( this.nodeType === 1 ) {
  				this.appendChild( elem );
  			}
  		});
  	},
  
  	prepend: function() {
  		return this.domManip(arguments, true, function( elem ) {
  			if ( this.nodeType === 1 ) {
  				this.insertBefore( elem, this.firstChild );
  			}
  		});
  	},
  
  	before: function() {
  		if ( this[0] && this[0].parentNode ) {
  			return this.domManip(arguments, false, function( elem ) {
  				this.parentNode.insertBefore( elem, this );
  			});
  		} else if ( arguments.length ) {
  			var set = jQuery(arguments[0]);
  			set.push.apply( set, this.toArray() );
  			return this.pushStack( set, "before", arguments );
  		}
  	},
  
  	after: function() {
  		if ( this[0] && this[0].parentNode ) {
  			return this.domManip(arguments, false, function( elem ) {
  				this.parentNode.insertBefore( elem, this.nextSibling );
  			});
  		} else if ( arguments.length ) {
  			var set = this.pushStack( this, "after", arguments );
  			set.push.apply( set, jQuery(arguments[0]).toArray() );
  			return set;
  		}
  	},
  
  	// keepData is for internal use only--do not document
  	remove: function( selector, keepData ) {
  		for ( var i = 0, elem; (elem = this[i]) != null; i++ ) {
  			if ( !selector || jQuery.filter( selector, [ elem ] ).length ) {
  				if ( !keepData && elem.nodeType === 1 ) {
  					jQuery.cleanData( elem.getElementsByTagName("*") );
  					jQuery.cleanData( [ elem ] );
  				}
  
  				if ( elem.parentNode ) {
  					elem.parentNode.removeChild( elem );
  				}
  			}
  		}
  
  		return this;
  	},
  
  	empty: function() {
  		for ( var i = 0, elem; (elem = this[i]) != null; i++ ) {
  			// Remove element nodes and prevent memory leaks
  			if ( elem.nodeType === 1 ) {
  				jQuery.cleanData( elem.getElementsByTagName("*") );
  			}
  
  			// Remove any remaining nodes
  			while ( elem.firstChild ) {
  				elem.removeChild( elem.firstChild );
  			}
  		}
  
  		return this;
  	},
  
  	clone: function( dataAndEvents, deepDataAndEvents ) {
  		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
  		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;
  
  		return this.map( function () {
  			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
  		});
  	},
  
  	html: function( value ) {
  		if ( value === undefined ) {
  			return this[0] && this[0].nodeType === 1 ?
  				this[0].innerHTML.replace(rinlinejQuery, "") :
  				null;
  
  		// See if we can take a shortcut and just use innerHTML
  		} else if ( typeof value === "string" && !rnocache.test( value ) &&
  			(jQuery.support.leadingWhitespace || !rleadingWhitespace.test( value )) &&
  			!wrapMap[ (rtagName.exec( value ) || ["", ""])[1].toLowerCase() ] ) {
  
  			value = value.replace(rxhtmlTag, "<$1></$2>");
  
  			try {
  				for ( var i = 0, l = this.length; i < l; i++ ) {
  					// Remove element nodes and prevent memory leaks
  					if ( this[i].nodeType === 1 ) {
  						jQuery.cleanData( this[i].getElementsByTagName("*") );
  						this[i].innerHTML = value;
  					}
  				}
  
  			// If using innerHTML throws an exception, use the fallback method
  			} catch(e) {
  				this.empty().append( value );
  			}
  
  		} else if ( jQuery.isFunction( value ) ) {
  			this.each(function(i){
  				var self = jQuery( this );
  
  				self.html( value.call(this, i, self.html()) );
  			});
  
  		} else {
  			this.empty().append( value );
  		}
  
  		return this;
  	},
  
  	replaceWith: function( value ) {
  		if ( this[0] && this[0].parentNode ) {
  			// Make sure that the elements are removed from the DOM before they are inserted
  			// this can help fix replacing a parent with child elements
  			if ( jQuery.isFunction( value ) ) {
  				return this.each(function(i) {
  					var self = jQuery(this), old = self.html();
  					self.replaceWith( value.call( this, i, old ) );
  				});
  			}
  
  			if ( typeof value !== "string" ) {
  				value = jQuery( value ).detach();
  			}
  
  			return this.each(function() {
  				var next = this.nextSibling,
  					parent = this.parentNode;
  
  				jQuery( this ).remove();
  
  				if ( next ) {
  					jQuery(next).before( value );
  				} else {
  					jQuery(parent).append( value );
  				}
  			});
  		} else {
  			return this.length ?
  				this.pushStack( jQuery(jQuery.isFunction(value) ? value() : value), "replaceWith", value ) :
  				this;
  		}
  	},
  
  	detach: function( selector ) {
  		return this.remove( selector, true );
  	},
  
  	domManip: function( args, table, callback ) {
  		var results, first, fragment, parent,
  			value = args[0],
  			scripts = [];
  
  		// We can't cloneNode fragments that contain checked, in WebKit
  		if ( !jQuery.support.checkClone && arguments.length === 3 && typeof value === "string" && rchecked.test( value ) ) {
  			return this.each(function() {
  				jQuery(this).domManip( args, table, callback, true );
  			});
  		}
  
  		if ( jQuery.isFunction(value) ) {
  			return this.each(function(i) {
  				var self = jQuery(this);
  				args[0] = value.call(this, i, table ? self.html() : undefined);
  				self.domManip( args, table, callback );
  			});
  		}
  
  		if ( this[0] ) {
  			parent = value && value.parentNode;
  
  			// If we're in a fragment, just use that instead of building a new one
  			if ( jQuery.support.parentNode && parent && parent.nodeType === 11 && parent.childNodes.length === this.length ) {
  				results = { fragment: parent };
  
  			} else {
  				results = jQuery.buildFragment( args, this, scripts );
  			}
  
  			fragment = results.fragment;
  
  			if ( fragment.childNodes.length === 1 ) {
  				first = fragment = fragment.firstChild;
  			} else {
  				first = fragment.firstChild;
  			}
  
  			if ( first ) {
  				table = table && jQuery.nodeName( first, "tr" );
  
  				for ( var i = 0, l = this.length, lastIndex = l - 1; i < l; i++ ) {
  					callback.call(
  						table ?
  							root(this[i], first) :
  							this[i],
  						// Make sure that we do not leak memory by inadvertently discarding
  						// the original fragment (which might have attached data) instead of
  						// using it; in addition, use the original fragment object for the last
  						// item instead of first because it can end up being emptied incorrectly
  						// in certain situations (Bug #8070).
  						// Fragments from the fragment cache must always be cloned and never used
  						// in place.
  						results.cacheable || (l > 1 && i < lastIndex) ?
  							jQuery.clone( fragment, true, true ) :
  							fragment
  					);
  				}
  			}
  
  			if ( scripts.length ) {
  				jQuery.each( scripts, evalScript );
  			}
  		}
  
  		return this;
  	}
  });
  
  function root( elem, cur ) {
  	return jQuery.nodeName(elem, "table") ?
  		(elem.getElementsByTagName("tbody")[0] ||
  		elem.appendChild(elem.ownerDocument.createElement("tbody"))) :
  		elem;
  }
  
  function cloneCopyEvent( src, dest ) {
  
  	if ( dest.nodeType !== 1 || !jQuery.hasData( src ) ) {
  		return;
  	}
  
  	var internalKey = jQuery.expando,
  		oldData = jQuery.data( src ),
  		curData = jQuery.data( dest, oldData );
  
  	// Switch to use the internal data object, if it exists, for the next
  	// stage of data copying
  	if ( (oldData = oldData[ internalKey ]) ) {
  		var events = oldData.events;
  				curData = curData[ internalKey ] = jQuery.extend({}, oldData);
  
  		if ( events ) {
  			delete curData.handle;
  			curData.events = {};
  
  			for ( var type in events ) {
  				for ( var i = 0, l = events[ type ].length; i < l; i++ ) {
  					jQuery.event.add( dest, type + ( events[ type ][ i ].namespace ? "." : "" ) + events[ type ][ i ].namespace, events[ type ][ i ], events[ type ][ i ].data );
  				}
  			}
  		}
  	}
  }
  
  function cloneFixAttributes(src, dest) {
  	// We do not need to do anything for non-Elements
  	if ( dest.nodeType !== 1 ) {
  		return;
  	}
  
  	var nodeName = dest.nodeName.toLowerCase();
  
  	// clearAttributes removes the attributes, which we don't want,
  	// but also removes the attachEvent events, which we *do* want
  	dest.clearAttributes();
  
  	// mergeAttributes, in contrast, only merges back on the
  	// original attributes, not the events
  	dest.mergeAttributes(src);
  
  	// IE6-8 fail to clone children inside object elements that use
  	// the proprietary classid attribute value (rather than the type
  	// attribute) to identify the type of content to display
  	if ( nodeName === "object" ) {
  		dest.outerHTML = src.outerHTML;
  
  	} else if ( nodeName === "input" && (src.type === "checkbox" || src.type === "radio") ) {
  		// IE6-8 fails to persist the checked state of a cloned checkbox
  		// or radio button. Worse, IE6-7 fail to give the cloned element
  		// a checked appearance if the defaultChecked value isn't also set
  		if ( src.checked ) {
  			dest.defaultChecked = dest.checked = src.checked;
  		}
  
  		// IE6-7 get confused and end up setting the value of a cloned
  		// checkbox/radio button to an empty string instead of "on"
  		if ( dest.value !== src.value ) {
  			dest.value = src.value;
  		}
  
  	// IE6-8 fails to return the selected option to the default selected
  	// state when cloning options
  	} else if ( nodeName === "option" ) {
  		dest.selected = src.defaultSelected;
  
  	// IE6-8 fails to set the defaultValue to the correct value when
  	// cloning other types of input fields
  	} else if ( nodeName === "input" || nodeName === "textarea" ) {
  		dest.defaultValue = src.defaultValue;
  	}
  
  	// Event data gets referenced instead of copied if the expando
  	// gets copied too
  	dest.removeAttribute( jQuery.expando );
  }
  
  jQuery.buildFragment = function( args, nodes, scripts ) {
  	var fragment, cacheable, cacheresults,
  		doc = (nodes && nodes[0] ? nodes[0].ownerDocument || nodes[0] : document);
  
  	// Only cache "small" (1/2 KB) HTML strings that are associated with the main document
  	// Cloning options loses the selected state, so don't cache them
  	// IE 6 doesn't like it when you put <object> or <embed> elements in a fragment
  	// Also, WebKit does not clone 'checked' attributes on cloneNode, so don't cache
  	if ( args.length === 1 && typeof args[0] === "string" && args[0].length < 512 && doc === document &&
  		args[0].charAt(0) === "<" && !rnocache.test( args[0] ) && (jQuery.support.checkClone || !rchecked.test( args[0] )) ) {
  
  		cacheable = true;
  		cacheresults = jQuery.fragments[ args[0] ];
  		if ( cacheresults ) {
  			if ( cacheresults !== 1 ) {
  				fragment = cacheresults;
  			}
  		}
  	}
  
  	if ( !fragment ) {
  		fragment = doc.createDocumentFragment();
  		jQuery.clean( args, doc, fragment, scripts );
  	}
  
  	if ( cacheable ) {
  		jQuery.fragments[ args[0] ] = cacheresults ? fragment : 1;
  	}
  
  	return { fragment: fragment, cacheable: cacheable };
  };
  
  jQuery.fragments = {};
  
  jQuery.each({
  	appendTo: "append",
  	prependTo: "prepend",
  	insertBefore: "before",
  	insertAfter: "after",
  	replaceAll: "replaceWith"
  }, function( name, original ) {
  	jQuery.fn[ name ] = function( selector ) {
  		var ret = [],
  			insert = jQuery( selector ),
  			parent = this.length === 1 && this[0].parentNode;
  
  		if ( parent && parent.nodeType === 11 && parent.childNodes.length === 1 && insert.length === 1 ) {
  			insert[ original ]( this[0] );
  			return this;
  
  		} else {
  			for ( var i = 0, l = insert.length; i < l; i++ ) {
  				var elems = (i > 0 ? this.clone(true) : this).get();
  				jQuery( insert[i] )[ original ]( elems );
  				ret = ret.concat( elems );
  			}
  
  			return this.pushStack( ret, name, insert.selector );
  		}
  	};
  });
  
  function getAll( elem ) {
  	if ( "getElementsByTagName" in elem ) {
  		return elem.getElementsByTagName( "*" );
  	
  	} else if ( "querySelectorAll" in elem ) {
  		return elem.querySelectorAll( "*" );
  
  	} else {
  		return [];
  	}
  }
  
  jQuery.extend({
  	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
  		var clone = elem.cloneNode(true),
  				srcElements,
  				destElements,
  				i;
  
  		if ( (!jQuery.support.noCloneEvent || !jQuery.support.noCloneChecked) &&
  				(elem.nodeType === 1 || elem.nodeType === 11) && !jQuery.isXMLDoc(elem) ) {
  			// IE copies events bound via attachEvent when using cloneNode.
  			// Calling detachEvent on the clone will also remove the events
  			// from the original. In order to get around this, we use some
  			// proprietary methods to clear the events. Thanks to MooTools
  			// guys for this hotness.
  
  			cloneFixAttributes( elem, clone );
  
  			// Using Sizzle here is crazy slow, so we use getElementsByTagName
  			// instead
  			srcElements = getAll( elem );
  			destElements = getAll( clone );
  
  			// Weird iteration because IE will replace the length property
  			// with an element if you are cloning the body and one of the
  			// elements on the page has a name or id of "length"
  			for ( i = 0; srcElements[i]; ++i ) {
  				cloneFixAttributes( srcElements[i], destElements[i] );
  			}
  		}
  
  		// Copy the events from the original to the clone
  		if ( dataAndEvents ) {
  			cloneCopyEvent( elem, clone );
  
  			if ( deepDataAndEvents ) {
  				srcElements = getAll( elem );
  				destElements = getAll( clone );
  
  				for ( i = 0; srcElements[i]; ++i ) {
  					cloneCopyEvent( srcElements[i], destElements[i] );
  				}
  			}
  		}
  
  		// Return the cloned set
  		return clone;
  },
  	clean: function( elems, context, fragment, scripts ) {
  		context = context || document;
  
  		// !context.createElement fails in IE with an error but returns typeof 'object'
  		if ( typeof context.createElement === "undefined" ) {
  			context = context.ownerDocument || context[0] && context[0].ownerDocument || document;
  		}
  
  		var ret = [];
  
  		for ( var i = 0, elem; (elem = elems[i]) != null; i++ ) {
  			if ( typeof elem === "number" ) {
  				elem += "";
  			}
  
  			if ( !elem ) {
  				continue;
  			}
  
  			// Convert html string into DOM nodes
  			if ( typeof elem === "string" && !rhtml.test( elem ) ) {
  				elem = context.createTextNode( elem );
  
  			} else if ( typeof elem === "string" ) {
  				// Fix "XHTML"-style tags in all browsers
  				elem = elem.replace(rxhtmlTag, "<$1></$2>");
  
  				// Trim whitespace, otherwise indexOf won't work as expected
  				var tag = (rtagName.exec( elem ) || ["", ""])[1].toLowerCase(),
  					wrap = wrapMap[ tag ] || wrapMap._default,
  					depth = wrap[0],
  					div = context.createElement("div");
  
  				// Go to html and back, then peel off extra wrappers
  				div.innerHTML = wrap[1] + elem + wrap[2];
  
  				// Move to the right depth
  				while ( depth-- ) {
  					div = div.lastChild;
  				}
  
  				// Remove IE's autoinserted <tbody> from table fragments
  				if ( !jQuery.support.tbody ) {
  
  					// String was a <table>, *may* have spurious <tbody>
  					var hasBody = rtbody.test(elem),
  						tbody = tag === "table" && !hasBody ?
  							div.firstChild && div.firstChild.childNodes :
  
  							// String was a bare <thead> or <tfoot>
  							wrap[1] === "<table>" && !hasBody ?
  								div.childNodes :
  								[];
  
  					for ( var j = tbody.length - 1; j >= 0 ; --j ) {
  						if ( jQuery.nodeName( tbody[ j ], "tbody" ) && !tbody[ j ].childNodes.length ) {
  							tbody[ j ].parentNode.removeChild( tbody[ j ] );
  						}
  					}
  
  				}
  
  				// IE completely kills leading whitespace when innerHTML is used
  				if ( !jQuery.support.leadingWhitespace && rleadingWhitespace.test( elem ) ) {
  					div.insertBefore( context.createTextNode( rleadingWhitespace.exec(elem)[0] ), div.firstChild );
  				}
  
  				elem = div.childNodes;
  			}
  
  			if ( elem.nodeType ) {
  				ret.push( elem );
  			} else {
  				ret = jQuery.merge( ret, elem );
  			}
  		}
  
  		if ( fragment ) {
  			for ( i = 0; ret[i]; i++ ) {
  				if ( scripts && jQuery.nodeName( ret[i], "script" ) && (!ret[i].type || ret[i].type.toLowerCase() === "text/javascript") ) {
  					scripts.push( ret[i].parentNode ? ret[i].parentNode.removeChild( ret[i] ) : ret[i] );
  
  				} else {
  					if ( ret[i].nodeType === 1 ) {
  						ret.splice.apply( ret, [i + 1, 0].concat(jQuery.makeArray(ret[i].getElementsByTagName("script"))) );
  					}
  					fragment.appendChild( ret[i] );
  				}
  			}
  		}
  
  		return ret;
  	},
  
  	cleanData: function( elems ) {
  		var data, id, cache = jQuery.cache, internalKey = jQuery.expando, special = jQuery.event.special,
  			deleteExpando = jQuery.support.deleteExpando;
  
  		for ( var i = 0, elem; (elem = elems[i]) != null; i++ ) {
  			if ( elem.nodeName && jQuery.noData[elem.nodeName.toLowerCase()] ) {
  				continue;
  			}
  
  			id = elem[ jQuery.expando ];
  
  			if ( id ) {
  				data = cache[ id ] && cache[ id ][ internalKey ];
  
  				if ( data && data.events ) {
  					for ( var type in data.events ) {
  						if ( special[ type ] ) {
  							jQuery.event.remove( elem, type );
  
  						// This is a shortcut to avoid jQuery.event.remove's overhead
  						} else {
  							jQuery.removeEvent( elem, type, data.handle );
  						}
  					}
  
  					// Null the DOM reference to avoid IE6/7/8 leak (#7054)
  					if ( data.handle ) {
  						data.handle.elem = null;
  					}
  				}
  
  				if ( deleteExpando ) {
  					delete elem[ jQuery.expando ];
  
  				} else if ( elem.removeAttribute ) {
  					elem.removeAttribute( jQuery.expando );
  				}
  
  				delete cache[ id ];
  			}
  		}
  	}
  });
  
  function evalScript( i, elem ) {
  	if ( elem.src ) {
  		jQuery.ajax({
  			url: elem.src,
  			async: false,
  			dataType: "script"
  		});
  	} else {
  		jQuery.globalEval( elem.text || elem.textContent || elem.innerHTML || "" );
  	}
  
  	if ( elem.parentNode ) {
  		elem.parentNode.removeChild( elem );
  	}
  }
  
  
  
  
  var ralpha = /alpha\([^)]*\)/i,
  	ropacity = /opacity=([^)]*)/,
  	rdashAlpha = /-([a-z])/ig,
  	rupper = /([A-Z])/g,
  	rnumpx = /^-?\d+(?:px)?$/i,
  	rnum = /^-?\d/,
  
  	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
  	cssWidth = [ "Left", "Right" ],
  	cssHeight = [ "Top", "Bottom" ],
  	curCSS,
  
  	getComputedStyle,
  	currentStyle,
  
  	fcamelCase = function( all, letter ) {
  		return letter.toUpperCase();
  	};
  
  jQuery.fn.css = function( name, value ) {
  	// Setting 'undefined' is a no-op
  	if ( arguments.length === 2 && value === undefined ) {
  		return this;
  	}
  
  	return jQuery.access( this, name, value, true, function( elem, name, value ) {
  		return value !== undefined ?
  			jQuery.style( elem, name, value ) :
  			jQuery.css( elem, name );
  	});
  };
  
  jQuery.extend({
  	// Add in style property hooks for overriding the default
  	// behavior of getting and setting a style property
  	cssHooks: {
  		opacity: {
  			get: function( elem, computed ) {
  				if ( computed ) {
  					// We should always get a number back from opacity
  					var ret = curCSS( elem, "opacity", "opacity" );
  					return ret === "" ? "1" : ret;
  
  				} else {
  					return elem.style.opacity;
  				}
  			}
  		}
  	},
  
  	// Exclude the following css properties to add px
  	cssNumber: {
  		"zIndex": true,
  		"fontWeight": true,
  		"opacity": true,
  		"zoom": true,
  		"lineHeight": true
  	},
  
  	// Add in properties whose names you wish to fix before
  	// setting or getting the value
  	cssProps: {
  		// normalize float css property
  		"float": jQuery.support.cssFloat ? "cssFloat" : "styleFloat"
  	},
  
  	// Get and set the style property on a DOM Node
  	style: function( elem, name, value, extra ) {
  		// Don't set styles on text and comment nodes
  		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
  			return;
  		}
  
  		// Make sure that we're working with the right name
  		var ret, origName = jQuery.camelCase( name ),
  			style = elem.style, hooks = jQuery.cssHooks[ origName ];
  
  		name = jQuery.cssProps[ origName ] || origName;
  
  		// Check if we're setting a value
  		if ( value !== undefined ) {
  			// Make sure that NaN and null values aren't set. See: #7116
  			if ( typeof value === "number" && isNaN( value ) || value == null ) {
  				return;
  			}
  
  			// If a number was passed in, add 'px' to the (except for certain CSS properties)
  			if ( typeof value === "number" && !jQuery.cssNumber[ origName ] ) {
  				value += "px";
  			}
  
  			// If a hook was provided, use that value, otherwise just set the specified value
  			if ( !hooks || !("set" in hooks) || (value = hooks.set( elem, value )) !== undefined ) {
  				// Wrapped to prevent IE from throwing errors when 'invalid' values are provided
  				// Fixes bug #5509
  				try {
  					style[ name ] = value;
  				} catch(e) {}
  			}
  
  		} else {
  			// If a hook was provided get the non-computed value from there
  			if ( hooks && "get" in hooks && (ret = hooks.get( elem, false, extra )) !== undefined ) {
  				return ret;
  			}
  
  			// Otherwise just get the value from the style object
  			return style[ name ];
  		}
  	},
  
  	css: function( elem, name, extra ) {
  		// Make sure that we're working with the right name
  		var ret, origName = jQuery.camelCase( name ),
  			hooks = jQuery.cssHooks[ origName ];
  
  		name = jQuery.cssProps[ origName ] || origName;
  
  		// If a hook was provided get the computed value from there
  		if ( hooks && "get" in hooks && (ret = hooks.get( elem, true, extra )) !== undefined ) {
  			return ret;
  
  		// Otherwise, if a way to get the computed value exists, use that
  		} else if ( curCSS ) {
  			return curCSS( elem, name, origName );
  		}
  	},
  
  	// A method for quickly swapping in/out CSS properties to get correct calculations
  	swap: function( elem, options, callback ) {
  		var old = {};
  
  		// Remember the old values, and insert the new ones
  		for ( var name in options ) {
  			old[ name ] = elem.style[ name ];
  			elem.style[ name ] = options[ name ];
  		}
  
  		callback.call( elem );
  
  		// Revert the old values
  		for ( name in options ) {
  			elem.style[ name ] = old[ name ];
  		}
  	},
  
  	camelCase: function( string ) {
  		return string.replace( rdashAlpha, fcamelCase );
  	}
  });
  
  // DEPRECATED, Use jQuery.css() instead
  jQuery.curCSS = jQuery.css;
  
  jQuery.each(["height", "width"], function( i, name ) {
  	jQuery.cssHooks[ name ] = {
  		get: function( elem, computed, extra ) {
  			var val;
  
  			if ( computed ) {
  				if ( elem.offsetWidth !== 0 ) {
  					val = getWH( elem, name, extra );
  
  				} else {
  					jQuery.swap( elem, cssShow, function() {
  						val = getWH( elem, name, extra );
  					});
  				}
  
  				if ( val <= 0 ) {
  					val = curCSS( elem, name, name );
  
  					if ( val === "0px" && currentStyle ) {
  						val = currentStyle( elem, name, name );
  					}
  
  					if ( val != null ) {
  						// Should return "auto" instead of 0, use 0 for
  						// temporary backwards-compat
  						return val === "" || val === "auto" ? "0px" : val;
  					}
  				}
  
  				if ( val < 0 || val == null ) {
  					val = elem.style[ name ];
  
  					// Should return "auto" instead of 0, use 0 for
  					// temporary backwards-compat
  					return val === "" || val === "auto" ? "0px" : val;
  				}
  
  				return typeof val === "string" ? val : val + "px";
  			}
  		},
  
  		set: function( elem, value ) {
  			if ( rnumpx.test( value ) ) {
  				// ignore negative width and height values #1599
  				value = parseFloat(value);
  
  				if ( value >= 0 ) {
  					return value + "px";
  				}
  
  			} else {
  				return value;
  			}
  		}
  	};
  });
  
  if ( !jQuery.support.opacity ) {
  	jQuery.cssHooks.opacity = {
  		get: function( elem, computed ) {
  			// IE uses filters for opacity
  			return ropacity.test((computed && elem.currentStyle ? elem.currentStyle.filter : elem.style.filter) || "") ?
  				(parseFloat(RegExp.$1) / 100) + "" :
  				computed ? "1" : "";
  		},
  
  		set: function( elem, value ) {
  			var style = elem.style;
  
  			// IE has trouble with opacity if it does not have layout
  			// Force it by setting the zoom level
  			style.zoom = 1;
  
  			// Set the alpha filter to set the opacity
  			var opacity = jQuery.isNaN(value) ?
  				"" :
  				"alpha(opacity=" + value * 100 + ")",
  				filter = style.filter || "";
  
  			style.filter = ralpha.test(filter) ?
  				filter.replace(ralpha, opacity) :
  				style.filter + ' ' + opacity;
  		}
  	};
  }
  
  if ( document.defaultView && document.defaultView.getComputedStyle ) {
  	getComputedStyle = function( elem, newName, name ) {
  		var ret, defaultView, computedStyle;
  
  		name = name.replace( rupper, "-$1" ).toLowerCase();
  
  		if ( !(defaultView = elem.ownerDocument.defaultView) ) {
  			return undefined;
  		}
  
  		if ( (computedStyle = defaultView.getComputedStyle( elem, null )) ) {
  			ret = computedStyle.getPropertyValue( name );
  			if ( ret === "" && !jQuery.contains( elem.ownerDocument.documentElement, elem ) ) {
  				ret = jQuery.style( elem, name );
  			}
  		}
  
  		return ret;
  	};
  }
  
  if ( document.documentElement.currentStyle ) {
  	currentStyle = function( elem, name ) {
  		var left,
  			ret = elem.currentStyle && elem.currentStyle[ name ],
  			rsLeft = elem.runtimeStyle && elem.runtimeStyle[ name ],
  			style = elem.style;
  
  		// From the awesome hack by Dean Edwards
  		// http://erik.eae.net/archives/2007/07/27/18.54.15/#comment-102291
  
  		// If we're not dealing with a regular pixel number
  		// but a number that has a weird ending, we need to convert it to pixels
  		if ( !rnumpx.test( ret ) && rnum.test( ret ) ) {
  			// Remember the original values
  			left = style.left;
  
  			// Put in the new values to get a computed value out
  			if ( rsLeft ) {
  				elem.runtimeStyle.left = elem.currentStyle.left;
  			}
  			style.left = name === "fontSize" ? "1em" : (ret || 0);
  			ret = style.pixelLeft + "px";
  
  			// Revert the changed values
  			style.left = left;
  			if ( rsLeft ) {
  				elem.runtimeStyle.left = rsLeft;
  			}
  		}
  
  		return ret === "" ? "auto" : ret;
  	};
  }
  
  curCSS = getComputedStyle || currentStyle;
  
  function getWH( elem, name, extra ) {
  	var which = name === "width" ? cssWidth : cssHeight,
  		val = name === "width" ? elem.offsetWidth : elem.offsetHeight;
  
  	if ( extra === "border" ) {
  		return val;
  	}
  
  	jQuery.each( which, function() {
  		if ( !extra ) {
  			val -= parseFloat(jQuery.css( elem, "padding" + this )) || 0;
  		}
  
  		if ( extra === "margin" ) {
  			val += parseFloat(jQuery.css( elem, "margin" + this )) || 0;
  
  		} else {
  			val -= parseFloat(jQuery.css( elem, "border" + this + "Width" )) || 0;
  		}
  	});
  
  	return val;
  }
  
  if ( jQuery.expr && jQuery.expr.filters ) {
  	jQuery.expr.filters.hidden = function( elem ) {
  		var width = elem.offsetWidth,
  			height = elem.offsetHeight;
  
  		return (width === 0 && height === 0) || (!jQuery.support.reliableHiddenOffsets && (elem.style.display || jQuery.css( elem, "display" )) === "none");
  	};
  
  	jQuery.expr.filters.visible = function( elem ) {
  		return !jQuery.expr.filters.hidden( elem );
  	};
  }
  
  
  
  
  var r20 = /%20/g,
  	rbracket = /\[\]$/,
  	rCRLF = /\r?\n/g,
  	rhash = /#.*$/,
  	rheaders = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg, // IE leaves an \r character at EOL
  	rinput = /^(?:color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
  	// #7653, #8125, #8152: local protocol detection
  	rlocalProtocol = /^(?:about|app|app\-storage|.+\-extension|file|widget):$/,
  	rnoContent = /^(?:GET|HEAD)$/,
  	rprotocol = /^\/\//,
  	rquery = /\?/,
  	rscript = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
  	rselectTextarea = /^(?:select|textarea)/i,
  	rspacesAjax = /\s+/,
  	rts = /([?&])_=[^&]*/,
  	rucHeaders = /(^|\-)([a-z])/g,
  	rucHeadersFunc = function( _, $1, $2 ) {
  		return $1 + $2.toUpperCase();
  	},
  	rurl = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/,
  
  	// Keep a copy of the old load method
  	_load = jQuery.fn.load,
  
  	/* Prefilters
  	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
  	 * 2) These are called:
  	 *    - BEFORE asking for a transport
  	 *    - AFTER param serialization (s.data is a string if s.processData is true)
  	 * 3) key is the dataType
  	 * 4) the catchall symbol "*" can be used
  	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
  	 */
  	prefilters = {},
  
  	/* Transports bindings
  	 * 1) key is the dataType
  	 * 2) the catchall symbol "*" can be used
  	 * 3) selection will start with transport dataType and THEN go to "*" if needed
  	 */
  	transports = {},
  
  	// Document location
  	ajaxLocation,
  
  	// Document location segments
  	ajaxLocParts;
  
  // #8138, IE may throw an exception when accessing
  // a field from document.location if document.domain has been set
  try {
  	ajaxLocation = document.location.href;
  } catch( e ) {
  	// Use the href attribute of an A element
  	// since IE will modify it given document.location
  	ajaxLocation = document.createElement( "a" );
  	ajaxLocation.href = "";
  	ajaxLocation = ajaxLocation.href;
  }
  
  // Segment location into parts
  ajaxLocParts = rurl.exec( ajaxLocation.toLowerCase() ) || [];
  
  // Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
  function addToPrefiltersOrTransports( structure ) {
  
  	// dataTypeExpression is optional and defaults to "*"
  	return function( dataTypeExpression, func ) {
  
  		if ( typeof dataTypeExpression !== "string" ) {
  			func = dataTypeExpression;
  			dataTypeExpression = "*";
  		}
  
  		if ( jQuery.isFunction( func ) ) {
  			var dataTypes = dataTypeExpression.toLowerCase().split( rspacesAjax ),
  				i = 0,
  				length = dataTypes.length,
  				dataType,
  				list,
  				placeBefore;
  
  			// For each dataType in the dataTypeExpression
  			for(; i < length; i++ ) {
  				dataType = dataTypes[ i ];
  				// We control if we're asked to add before
  				// any existing element
  				placeBefore = /^\+/.test( dataType );
  				if ( placeBefore ) {
  					dataType = dataType.substr( 1 ) || "*";
  				}
  				list = structure[ dataType ] = structure[ dataType ] || [];
  				// then we add to the structure accordingly
  				list[ placeBefore ? "unshift" : "push" ]( func );
  			}
  		}
  	};
  }
  
  //Base inspection function for prefilters and transports
  function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR,
  		dataType /* internal */, inspected /* internal */ ) {
  
  	dataType = dataType || options.dataTypes[ 0 ];
  	inspected = inspected || {};
  
  	inspected[ dataType ] = true;
  
  	var list = structure[ dataType ],
  		i = 0,
  		length = list ? list.length : 0,
  		executeOnly = ( structure === prefilters ),
  		selection;
  
  	for(; i < length && ( executeOnly || !selection ); i++ ) {
  		selection = list[ i ]( options, originalOptions, jqXHR );
  		// If we got redirected to another dataType
  		// we try there if executing only and not done already
  		if ( typeof selection === "string" ) {
  			if ( !executeOnly || inspected[ selection ] ) {
  				selection = undefined;
  			} else {
  				options.dataTypes.unshift( selection );
  				selection = inspectPrefiltersOrTransports(
  						structure, options, originalOptions, jqXHR, selection, inspected );
  			}
  		}
  	}
  	// If we're only executing or nothing was selected
  	// we try the catchall dataType if not done already
  	if ( ( executeOnly || !selection ) && !inspected[ "*" ] ) {
  		selection = inspectPrefiltersOrTransports(
  				structure, options, originalOptions, jqXHR, "*", inspected );
  	}
  	// unnecessary when only executing (prefilters)
  	// but it'll be ignored by the caller in that case
  	return selection;
  }
  
  jQuery.fn.extend({
  	load: function( url, params, callback ) {
  		if ( typeof url !== "string" && _load ) {
  			return _load.apply( this, arguments );
  
  		// Don't do a request if no elements are being requested
  		} else if ( !this.length ) {
  			return this;
  		}
  
  		var off = url.indexOf( " " );
  		if ( off >= 0 ) {
  			var selector = url.slice( off, url.length );
  			url = url.slice( 0, off );
  		}
  
  		// Default to a GET request
  		var type = "GET";
  
  		// If the second parameter was provided
  		if ( params ) {
  			// If it's a function
  			if ( jQuery.isFunction( params ) ) {
  				// We assume that it's the callback
  				callback = params;
  				params = undefined;
  
  			// Otherwise, build a param string
  			} else if ( typeof params === "object" ) {
  				params = jQuery.param( params, jQuery.ajaxSettings.traditional );
  				type = "POST";
  			}
  		}
  
  		var self = this;
  
  		// Request the remote document
  		jQuery.ajax({
  			url: url,
  			type: type,
  			dataType: "html",
  			data: params,
  			// Complete callback (responseText is used internally)
  			complete: function( jqXHR, status, responseText ) {
  				// Store the response as specified by the jqXHR object
  				responseText = jqXHR.responseText;
  				// If successful, inject the HTML into all the matched elements
  				if ( jqXHR.isResolved() ) {
  					// #4825: Get the actual response in case
  					// a dataFilter is present in ajaxSettings
  					jqXHR.done(function( r ) {
  						responseText = r;
  					});
  					// See if a selector was specified
  					self.html( selector ?
  						// Create a dummy div to hold the results
  						jQuery("<div>")
  							// inject the contents of the document in, removing the scripts
  							// to avoid any 'Permission Denied' errors in IE
  							.append(responseText.replace(rscript, ""))
  
  							// Locate the specified elements
  							.find(selector) :
  
  						// If not, just inject the full result
  						responseText );
  				}
  
  				if ( callback ) {
  					self.each( callback, [ responseText, status, jqXHR ] );
  				}
  			}
  		});
  
  		return this;
  	},
  
  	serialize: function() {
  		return jQuery.param( this.serializeArray() );
  	},
  
  	serializeArray: function() {
  		return this.map(function(){
  			return this.elements ? jQuery.makeArray( this.elements ) : this;
  		})
  		.filter(function(){
  			return this.name && !this.disabled &&
  				( this.checked || rselectTextarea.test( this.nodeName ) ||
  					rinput.test( this.type ) );
  		})
  		.map(function( i, elem ){
  			var val = jQuery( this ).val();
  
  			return val == null ?
  				null :
  				jQuery.isArray( val ) ?
  					jQuery.map( val, function( val, i ){
  						return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
  					}) :
  					{ name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
  		}).get();
  	}
  });
  
  // Attach a bunch of functions for handling common AJAX events
  jQuery.each( "ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split( " " ), function( i, o ){
  	jQuery.fn[ o ] = function( f ){
  		return this.bind( o, f );
  	};
  } );
  
  jQuery.each( [ "get", "post" ], function( i, method ) {
  	jQuery[ method ] = function( url, data, callback, type ) {
  		// shift arguments if data argument was omitted
  		if ( jQuery.isFunction( data ) ) {
  			type = type || callback;
  			callback = data;
  			data = undefined;
  		}
  
  		return jQuery.ajax({
  			type: method,
  			url: url,
  			data: data,
  			success: callback,
  			dataType: type
  		});
  	};
  } );
  
  jQuery.extend({
  
  	getScript: function( url, callback ) {
  		return jQuery.get( url, undefined, callback, "script" );
  	},
  
  	getJSON: function( url, data, callback ) {
  		return jQuery.get( url, data, callback, "json" );
  	},
  
  	// Creates a full fledged settings object into target
  	// with both ajaxSettings and settings fields.
  	// If target is omitted, writes into ajaxSettings.
  	ajaxSetup: function ( target, settings ) {
  		if ( !settings ) {
  			// Only one parameter, we extend ajaxSettings
  			settings = target;
  			target = jQuery.extend( true, jQuery.ajaxSettings, settings );
  		} else {
  			// target was provided, we extend into it
  			jQuery.extend( true, target, jQuery.ajaxSettings, settings );
  		}
  		// Flatten fields we don't want deep extended
  		for( var field in { context: 1, url: 1 } ) {
  			if ( field in settings ) {
  				target[ field ] = settings[ field ];
  			} else if( field in jQuery.ajaxSettings ) {
  				target[ field ] = jQuery.ajaxSettings[ field ];
  			}
  		}
  		return target;
  	},
  
  	ajaxSettings: {
  		url: ajaxLocation,
  		isLocal: rlocalProtocol.test( ajaxLocParts[ 1 ] ),
  		global: true,
  		type: "GET",
  		contentType: "application/x-www-form-urlencoded",
  		processData: true,
  		async: true,
  		/*
  		timeout: 0,
  		data: null,
  		dataType: null,
  		username: null,
  		password: null,
  		cache: null,
  		traditional: false,
  		headers: {},
  		crossDomain: null,
  		*/
  
  		accepts: {
  			xml: "application/xml, text/xml",
  			html: "text/html",
  			text: "text/plain",
  			json: "application/json, text/javascript",
  			"*": "*/*"
  		},
  
  		contents: {
  			xml: /xml/,
  			html: /html/,
  			json: /json/
  		},
  
  		responseFields: {
  			xml: "responseXML",
  			text: "responseText"
  		},
  
  		// List of data converters
  		// 1) key format is "source_type destination_type" (a single space in-between)
  		// 2) the catchall symbol "*" can be used for source_type
  		converters: {
  
  			// Convert anything to text
  			"* text": window.String,
  
  			// Text to html (true = no transformation)
  			"text html": true,
  
  			// Evaluate text as a json expression
  			"text json": jQuery.parseJSON,
  
  			// Parse text as xml
  			"text xml": jQuery.parseXML
  		}
  	},
  
  	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
  	ajaxTransport: addToPrefiltersOrTransports( transports ),
  
  	// Main method
  	ajax: function( url, options ) {
  
  		// If url is an object, simulate pre-1.5 signature
  		if ( typeof url === "object" ) {
  			options = url;
  			url = undefined;
  		}
  
  		// Force options to be an object
  		options = options || {};
  
  		var // Create the final options object
  			s = jQuery.ajaxSetup( {}, options ),
  			// Callbacks context
  			callbackContext = s.context || s,
  			// Context for global events
  			// It's the callbackContext if one was provided in the options
  			// and if it's a DOM node or a jQuery collection
  			globalEventContext = callbackContext !== s &&
  				( callbackContext.nodeType || callbackContext instanceof jQuery ) ?
  						jQuery( callbackContext ) : jQuery.event,
  			// Deferreds
  			deferred = jQuery.Deferred(),
  			completeDeferred = jQuery._Deferred(),
  			// Status-dependent callbacks
  			statusCode = s.statusCode || {},
  			// ifModified key
  			ifModifiedKey,
  			// Headers (they are sent all at once)
  			requestHeaders = {},
  			// Response headers
  			responseHeadersString,
  			responseHeaders,
  			// transport
  			transport,
  			// timeout handle
  			timeoutTimer,
  			// Cross-domain detection vars
  			parts,
  			// The jqXHR state
  			state = 0,
  			// To know if global events are to be dispatched
  			fireGlobals,
  			// Loop variable
  			i,
  			// Fake xhr
  			jqXHR = {
  
  				readyState: 0,
  
  				// Caches the header
  				setRequestHeader: function( name, value ) {
  					if ( !state ) {
  						requestHeaders[ name.toLowerCase().replace( rucHeaders, rucHeadersFunc ) ] = value;
  					}
  					return this;
  				},
  
  				// Raw string
  				getAllResponseHeaders: function() {
  					return state === 2 ? responseHeadersString : null;
  				},
  
  				// Builds headers hashtable if needed
  				getResponseHeader: function( key ) {
  					var match;
  					if ( state === 2 ) {
  						if ( !responseHeaders ) {
  							responseHeaders = {};
  							while( ( match = rheaders.exec( responseHeadersString ) ) ) {
  								responseHeaders[ match[1].toLowerCase() ] = match[ 2 ];
  							}
  						}
  						match = responseHeaders[ key.toLowerCase() ];
  					}
  					return match === undefined ? null : match;
  				},
  
  				// Overrides response content-type header
  				overrideMimeType: function( type ) {
  					if ( !state ) {
  						s.mimeType = type;
  					}
  					return this;
  				},
  
  				// Cancel the request
  				abort: function( statusText ) {
  					statusText = statusText || "abort";
  					if ( transport ) {
  						transport.abort( statusText );
  					}
  					done( 0, statusText );
  					return this;
  				}
  			};
  
  		// Callback for when everything is done
  		// It is defined here because jslint complains if it is declared
  		// at the end of the function (which would be more logical and readable)
  		function done( status, statusText, responses, headers ) {
  
  			// Called once
  			if ( state === 2 ) {
  				return;
  			}
  
  			// State is "done" now
  			state = 2;
  
  			// Clear timeout if it exists
  			if ( timeoutTimer ) {
  				clearTimeout( timeoutTimer );
  			}
  
  			// Dereference transport for early garbage collection
  			// (no matter how long the jqXHR object will be used)
  			transport = undefined;
  
  			// Cache response headers
  			responseHeadersString = headers || "";
  
  			// Set readyState
  			jqXHR.readyState = status ? 4 : 0;
  
  			var isSuccess,
  				success,
  				error,
  				response = responses ? ajaxHandleResponses( s, jqXHR, responses ) : undefined,
  				lastModified,
  				etag;
  
  			// If successful, handle type chaining
  			if ( status >= 200 && status < 300 || status === 304 ) {
  
  				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
  				if ( s.ifModified ) {
  
  					if ( ( lastModified = jqXHR.getResponseHeader( "Last-Modified" ) ) ) {
  						jQuery.lastModified[ ifModifiedKey ] = lastModified;
  					}
  					if ( ( etag = jqXHR.getResponseHeader( "Etag" ) ) ) {
  						jQuery.etag[ ifModifiedKey ] = etag;
  					}
  				}
  
  				// If not modified
  				if ( status === 304 ) {
  
  					statusText = "notmodified";
  					isSuccess = true;
  
  				// If we have data
  				} else {
  
  					try {
  						success = ajaxConvert( s, response );
  						statusText = "success";
  						isSuccess = true;
  					} catch(e) {
  						// We have a parsererror
  						statusText = "parsererror";
  						error = e;
  					}
  				}
  			} else {
  				// We extract error from statusText
  				// then normalize statusText and status for non-aborts
  				error = statusText;
  				if( !statusText || status ) {
  					statusText = "error";
  					if ( status < 0 ) {
  						status = 0;
  					}
  				}
  			}
  
  			// Set data for the fake xhr object
  			jqXHR.status = status;
  			jqXHR.statusText = statusText;
  
  			// Success/Error
  			if ( isSuccess ) {
  				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
  			} else {
  				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
  			}
  
  			// Status-dependent callbacks
  			jqXHR.statusCode( statusCode );
  			statusCode = undefined;
  
  			if ( fireGlobals ) {
  				globalEventContext.trigger( "ajax" + ( isSuccess ? "Success" : "Error" ),
  						[ jqXHR, s, isSuccess ? success : error ] );
  			}
  
  			// Complete
  			completeDeferred.resolveWith( callbackContext, [ jqXHR, statusText ] );
  
  			if ( fireGlobals ) {
  				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s] );
  				// Handle the global AJAX counter
  				if ( !( --jQuery.active ) ) {
  					jQuery.event.trigger( "ajaxStop" );
  				}
  			}
  		}
  
  		// Attach deferreds
  		deferred.promise( jqXHR );
  		jqXHR.success = jqXHR.done;
  		jqXHR.error = jqXHR.fail;
  		jqXHR.complete = completeDeferred.done;
  
  		// Status-dependent callbacks
  		jqXHR.statusCode = function( map ) {
  			if ( map ) {
  				var tmp;
  				if ( state < 2 ) {
  					for( tmp in map ) {
  						statusCode[ tmp ] = [ statusCode[tmp], map[tmp] ];
  					}
  				} else {
  					tmp = map[ jqXHR.status ];
  					jqXHR.then( tmp, tmp );
  				}
  			}
  			return this;
  		};
  
  		// Remove hash character (#7531: and string promotion)
  		// Add protocol if not provided (#5866: IE7 issue with protocol-less urls)
  		// We also use the url parameter if available
  		s.url = ( ( url || s.url ) + "" ).replace( rhash, "" ).replace( rprotocol, ajaxLocParts[ 1 ] + "//" );
  
  		// Extract dataTypes list
  		s.dataTypes = jQuery.trim( s.dataType || "*" ).toLowerCase().split( rspacesAjax );
  
  		// Determine if a cross-domain request is in order
  		if ( !s.crossDomain ) {
  			parts = rurl.exec( s.url.toLowerCase() );
  			s.crossDomain = !!( parts &&
  				( parts[ 1 ] != ajaxLocParts[ 1 ] || parts[ 2 ] != ajaxLocParts[ 2 ] ||
  					( parts[ 3 ] || ( parts[ 1 ] === "http:" ? 80 : 443 ) ) !=
  						( ajaxLocParts[ 3 ] || ( ajaxLocParts[ 1 ] === "http:" ? 80 : 443 ) ) )
  			);
  		}
  
  		// Convert data if not already a string
  		if ( s.data && s.processData && typeof s.data !== "string" ) {
  			s.data = jQuery.param( s.data, s.traditional );
  		}
  
  		// Apply prefilters
  		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );
  
  		// If request was aborted inside a prefiler, stop there
  		if ( state === 2 ) {
  			return false;
  		}
  
  		// We can fire global events as of now if asked to
  		fireGlobals = s.global;
  
  		// Uppercase the type
  		s.type = s.type.toUpperCase();
  
  		// Determine if request has content
  		s.hasContent = !rnoContent.test( s.type );
  
  		// Watch for a new set of requests
  		if ( fireGlobals && jQuery.active++ === 0 ) {
  			jQuery.event.trigger( "ajaxStart" );
  		}
  
  		// More options handling for requests with no content
  		if ( !s.hasContent ) {
  
  			// If data is available, append data to url
  			if ( s.data ) {
  				s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.data;
  			}
  
  			// Get ifModifiedKey before adding the anti-cache parameter
  			ifModifiedKey = s.url;
  
  			// Add anti-cache in url if needed
  			if ( s.cache === false ) {
  
  				var ts = jQuery.now(),
  					// try replacing _= if it is there
  					ret = s.url.replace( rts, "$1_=" + ts );
  
  				// if nothing was replaced, add timestamp to the end
  				s.url = ret + ( (ret === s.url ) ? ( rquery.test( s.url ) ? "&" : "?" ) + "_=" + ts : "" );
  			}
  		}
  
  		// Set the correct header, if data is being sent
  		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
  			requestHeaders[ "Content-Type" ] = s.contentType;
  		}
  
  		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
  		if ( s.ifModified ) {
  			ifModifiedKey = ifModifiedKey || s.url;
  			if ( jQuery.lastModified[ ifModifiedKey ] ) {
  				requestHeaders[ "If-Modified-Since" ] = jQuery.lastModified[ ifModifiedKey ];
  			}
  			if ( jQuery.etag[ ifModifiedKey ] ) {
  				requestHeaders[ "If-None-Match" ] = jQuery.etag[ ifModifiedKey ];
  			}
  		}
  
  		// Set the Accepts header for the server, depending on the dataType
  		requestHeaders.Accept = s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[0] ] ?
  			s.accepts[ s.dataTypes[0] ] + ( s.dataTypes[ 0 ] !== "*" ? ", */*; q=0.01" : "" ) :
  			s.accepts[ "*" ];
  
  		// Check for headers option
  		for ( i in s.headers ) {
  			jqXHR.setRequestHeader( i, s.headers[ i ] );
  		}
  
  		// Allow custom headers/mimetypes and early abort
  		if ( s.beforeSend && ( s.beforeSend.call( callbackContext, jqXHR, s ) === false || state === 2 ) ) {
  				// Abort if not done already
  				jqXHR.abort();
  				return false;
  
  		}
  
  		// Install callbacks on deferreds
  		for ( i in { success: 1, error: 1, complete: 1 } ) {
  			jqXHR[ i ]( s[ i ] );
  		}
  
  		// Get transport
  		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );
  
  		// If no transport, we auto-abort
  		if ( !transport ) {
  			done( -1, "No Transport" );
  		} else {
  			jqXHR.readyState = 1;
  			// Send global event
  			if ( fireGlobals ) {
  				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
  			}
  			// Timeout
  			if ( s.async && s.timeout > 0 ) {
  				timeoutTimer = setTimeout( function(){
  					jqXHR.abort( "timeout" );
  				}, s.timeout );
  			}
  
  			try {
  				state = 1;
  				transport.send( requestHeaders, done );
  			} catch (e) {
  				// Propagate exception as error if not done
  				if ( status < 2 ) {
  					done( -1, e );
  				// Simply rethrow otherwise
  				} else {
  					jQuery.error( e );
  				}
  			}
  		}
  
  		return jqXHR;
  	},
  
  	// Serialize an array of form elements or a set of
  	// key/values into a query string
  	param: function( a, traditional ) {
  		var s = [],
  			add = function( key, value ) {
  				// If value is a function, invoke it and return its value
  				value = jQuery.isFunction( value ) ? value() : value;
  				s[ s.length ] = encodeURIComponent( key ) + "=" + encodeURIComponent( value );
  			};
  
  		// Set traditional to true for jQuery <= 1.3.2 behavior.
  		if ( traditional === undefined ) {
  			traditional = jQuery.ajaxSettings.traditional;
  		}
  
  		// If an array was passed in, assume that it is an array of form elements.
  		if ( jQuery.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {
  			// Serialize the form elements
  			jQuery.each( a, function() {
  				add( this.name, this.value );
  			} );
  
  		} else {
  			// If traditional, encode the "old" way (the way 1.3.2 or older
  			// did it), otherwise encode params recursively.
  			for ( var prefix in a ) {
  				buildParams( prefix, a[ prefix ], traditional, add );
  			}
  		}
  
  		// Return the resulting serialization
  		return s.join( "&" ).replace( r20, "+" );
  	}
  });
  
  function buildParams( prefix, obj, traditional, add ) {
  	if ( jQuery.isArray( obj ) && obj.length ) {
  		// Serialize array item.
  		jQuery.each( obj, function( i, v ) {
  			if ( traditional || rbracket.test( prefix ) ) {
  				// Treat each array item as a scalar.
  				add( prefix, v );
  
  			} else {
  				// If array item is non-scalar (array or object), encode its
  				// numeric index to resolve deserialization ambiguity issues.
  				// Note that rack (as of 1.0.0) can't currently deserialize
  				// nested arrays properly, and attempting to do so may cause
  				// a server error. Possible fixes are to modify rack's
  				// deserialization algorithm or to provide an option or flag
  				// to force array serialization to be shallow.
  				buildParams( prefix + "[" + ( typeof v === "object" || jQuery.isArray(v) ? i : "" ) + "]", v, traditional, add );
  			}
  		});
  
  	} else if ( !traditional && obj != null && typeof obj === "object" ) {
  		// If we see an array here, it is empty and should be treated as an empty
  		// object
  		if ( jQuery.isArray( obj ) || jQuery.isEmptyObject( obj ) ) {
  			add( prefix, "" );
  
  		// Serialize object item.
  		} else {
  			for ( var name in obj ) {
  				buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
  			}
  		}
  
  	} else {
  		// Serialize scalar item.
  		add( prefix, obj );
  	}
  }
  
  // This is still on the jQuery object... for now
  // Want to move this to jQuery.ajax some day
  jQuery.extend({
  
  	// Counter for holding the number of active queries
  	active: 0,
  
  	// Last-Modified header cache for next request
  	lastModified: {},
  	etag: {}
  
  });
  
  /* Handles responses to an ajax request:
   * - sets all responseXXX fields accordingly
   * - finds the right dataType (mediates between content-type and expected dataType)
   * - returns the corresponding response
   */
  function ajaxHandleResponses( s, jqXHR, responses ) {
  
  	var contents = s.contents,
  		dataTypes = s.dataTypes,
  		responseFields = s.responseFields,
  		ct,
  		type,
  		finalDataType,
  		firstDataType;
  
  	// Fill responseXXX fields
  	for( type in responseFields ) {
  		if ( type in responses ) {
  			jqXHR[ responseFields[type] ] = responses[ type ];
  		}
  	}
  
  	// Remove auto dataType and get content-type in the process
  	while( dataTypes[ 0 ] === "*" ) {
  		dataTypes.shift();
  		if ( ct === undefined ) {
  			ct = s.mimeType || jqXHR.getResponseHeader( "content-type" );
  		}
  	}
  
  	// Check if we're dealing with a known content-type
  	if ( ct ) {
  		for ( type in contents ) {
  			if ( contents[ type ] && contents[ type ].test( ct ) ) {
  				dataTypes.unshift( type );
  				break;
  			}
  		}
  	}
  
  	// Check to see if we have a response for the expected dataType
  	if ( dataTypes[ 0 ] in responses ) {
  		finalDataType = dataTypes[ 0 ];
  	} else {
  		// Try convertible dataTypes
  		for ( type in responses ) {
  			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[0] ] ) {
  				finalDataType = type;
  				break;
  			}
  			if ( !firstDataType ) {
  				firstDataType = type;
  			}
  		}
  		// Or just use first one
  		finalDataType = finalDataType || firstDataType;
  	}
  
  	// If we found a dataType
  	// We add the dataType to the list if needed
  	// and return the corresponding response
  	if ( finalDataType ) {
  		if ( finalDataType !== dataTypes[ 0 ] ) {
  			dataTypes.unshift( finalDataType );
  		}
  		return responses[ finalDataType ];
  	}
  }
  
  // Chain conversions given the request and the original response
  function ajaxConvert( s, response ) {
  
  	// Apply the dataFilter if provided
  	if ( s.dataFilter ) {
  		response = s.dataFilter( response, s.dataType );
  	}
  
  	var dataTypes = s.dataTypes,
  		converters = {},
  		i,
  		key,
  		length = dataTypes.length,
  		tmp,
  		// Current and previous dataTypes
  		current = dataTypes[ 0 ],
  		prev,
  		// Conversion expression
  		conversion,
  		// Conversion function
  		conv,
  		// Conversion functions (transitive conversion)
  		conv1,
  		conv2;
  
  	// For each dataType in the chain
  	for( i = 1; i < length; i++ ) {
  
  		// Create converters map
  		// with lowercased keys
  		if ( i === 1 ) {
  			for( key in s.converters ) {
  				if( typeof key === "string" ) {
  					converters[ key.toLowerCase() ] = s.converters[ key ];
  				}
  			}
  		}
  
  		// Get the dataTypes
  		prev = current;
  		current = dataTypes[ i ];
  
  		// If current is auto dataType, update it to prev
  		if( current === "*" ) {
  			current = prev;
  		// If no auto and dataTypes are actually different
  		} else if ( prev !== "*" && prev !== current ) {
  
  			// Get the converter
  			conversion = prev + " " + current;
  			conv = converters[ conversion ] || converters[ "* " + current ];
  
  			// If there is no direct converter, search transitively
  			if ( !conv ) {
  				conv2 = undefined;
  				for( conv1 in converters ) {
  					tmp = conv1.split( " " );
  					if ( tmp[ 0 ] === prev || tmp[ 0 ] === "*" ) {
  						conv2 = converters[ tmp[1] + " " + current ];
  						if ( conv2 ) {
  							conv1 = converters[ conv1 ];
  							if ( conv1 === true ) {
  								conv = conv2;
  							} else if ( conv2 === true ) {
  								conv = conv1;
  							}
  							break;
  						}
  					}
  				}
  			}
  			// If we found no converter, dispatch an error
  			if ( !( conv || conv2 ) ) {
  				jQuery.error( "No conversion from " + conversion.replace(" "," to ") );
  			}
  			// If found converter is not an equivalence
  			if ( conv !== true ) {
  				// Convert with 1 or 2 converters accordingly
  				response = conv ? conv( response ) : conv2( conv1(response) );
  			}
  		}
  	}
  	return response;
  }
  
  
  
  
  var jsc = jQuery.now(),
  	jsre = /(\=)\?(&|$)|\?\?/i;
  
  // Default jsonp settings
  jQuery.ajaxSetup({
  	jsonp: "callback",
  	jsonpCallback: function() {
  		return jQuery.expando + "_" + ( jsc++ );
  	}
  });
  
  // Detect, normalize options and install callbacks for jsonp requests
  jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {
  
  	var dataIsString = ( typeof s.data === "string" );
  
  	if ( s.dataTypes[ 0 ] === "jsonp" ||
  		originalSettings.jsonpCallback ||
  		originalSettings.jsonp != null ||
  		s.jsonp !== false && ( jsre.test( s.url ) ||
  				dataIsString && jsre.test( s.data ) ) ) {
  
  		var responseContainer,
  			jsonpCallback = s.jsonpCallback =
  				jQuery.isFunction( s.jsonpCallback ) ? s.jsonpCallback() : s.jsonpCallback,
  			previous = window[ jsonpCallback ],
  			url = s.url,
  			data = s.data,
  			replace = "$1" + jsonpCallback + "$2",
  			cleanUp = function() {
  				// Set callback back to previous value
  				window[ jsonpCallback ] = previous;
  				// Call if it was a function and we have a response
  				if ( responseContainer && jQuery.isFunction( previous ) ) {
  					window[ jsonpCallback ]( responseContainer[ 0 ] );
  				}
  			};
  
  		if ( s.jsonp !== false ) {
  			url = url.replace( jsre, replace );
  			if ( s.url === url ) {
  				if ( dataIsString ) {
  					data = data.replace( jsre, replace );
  				}
  				if ( s.data === data ) {
  					// Add callback manually
  					url += (/\?/.test( url ) ? "&" : "?") + s.jsonp + "=" + jsonpCallback;
  				}
  			}
  		}
  
  		s.url = url;
  		s.data = data;
  
  		// Install callback
  		window[ jsonpCallback ] = function( response ) {
  			responseContainer = [ response ];
  		};
  
  		// Install cleanUp function
  		jqXHR.then( cleanUp, cleanUp );
  
  		// Use data converter to retrieve json after script execution
  		s.converters["script json"] = function() {
  			if ( !responseContainer ) {
  				jQuery.error( jsonpCallback + " was not called" );
  			}
  			return responseContainer[ 0 ];
  		};
  
  		// force json dataType
  		s.dataTypes[ 0 ] = "json";
  
  		// Delegate to script
  		return "script";
  	}
  } );
  
  
  
  
  // Install script dataType
  jQuery.ajaxSetup({
  	accepts: {
  		script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
  	},
  	contents: {
  		script: /javascript|ecmascript/
  	},
  	converters: {
  		"text script": function( text ) {
  			jQuery.globalEval( text );
  			return text;
  		}
  	}
  });
  
  // Handle cache's special case and global
  jQuery.ajaxPrefilter( "script", function( s ) {
  	if ( s.cache === undefined ) {
  		s.cache = false;
  	}
  	if ( s.crossDomain ) {
  		s.type = "GET";
  		s.global = false;
  	}
  } );
  
  // Bind script tag hack transport
  jQuery.ajaxTransport( "script", function(s) {
  
  	// This transport only deals with cross domain requests
  	if ( s.crossDomain ) {
  
  		var script,
  			head = document.head || document.getElementsByTagName( "head" )[0] || document.documentElement;
  
  		return {
  
  			send: function( _, callback ) {
  
  				script = document.createElement( "script" );
  
  				script.async = "async";
  
  				if ( s.scriptCharset ) {
  					script.charset = s.scriptCharset;
  				}
  
  				script.src = s.url;
  
  				// Attach handlers for all browsers
  				script.onload = script.onreadystatechange = function( _, isAbort ) {
  
  					if ( !script.readyState || /loaded|complete/.test( script.readyState ) ) {
  
  						// Handle memory leak in IE
  						script.onload = script.onreadystatechange = null;
  
  						// Remove the script
  						if ( head && script.parentNode ) {
  							head.removeChild( script );
  						}
  
  						// Dereference the script
  						script = undefined;
  
  						// Callback if not abort
  						if ( !isAbort ) {
  							callback( 200, "success" );
  						}
  					}
  				};
  				// Use insertBefore instead of appendChild  to circumvent an IE6 bug.
  				// This arises when a base node is used (#2709 and #4378).
  				head.insertBefore( script, head.firstChild );
  			},
  
  			abort: function() {
  				if ( script ) {
  					script.onload( 0, 1 );
  				}
  			}
  		};
  	}
  } );
  
  
  
  
  var // #5280: next active xhr id and list of active xhrs' callbacks
  	xhrId = jQuery.now(),
  	xhrCallbacks,
  
  	// XHR used to determine supports properties
  	testXHR;
  
  // #5280: Internet Explorer will keep connections alive if we don't abort on unload
  function xhrOnUnloadAbort() {
  	jQuery( window ).unload(function() {
  		// Abort all pending requests
  		for ( var key in xhrCallbacks ) {
  			xhrCallbacks[ key ]( 0, 1 );
  		}
  	});
  }
  
  // Functions to create xhrs
  function createStandardXHR() {
  	try {
  		return new window.XMLHttpRequest();
  	} catch( e ) {}
  }
  
  function createActiveXHR() {
  	try {
  		return new window.ActiveXObject( "Microsoft.XMLHTTP" );
  	} catch( e ) {}
  }
  
  // Create the request object
  // (This is still attached to ajaxSettings for backward compatibility)
  jQuery.ajaxSettings.xhr = window.ActiveXObject ?
  	/* Microsoft failed to properly
  	 * implement the XMLHttpRequest in IE7 (can't request local files),
  	 * so we use the ActiveXObject when it is available
  	 * Additionally XMLHttpRequest can be disabled in IE7/IE8 so
  	 * we need a fallback.
  	 */
  	function() {
  		return !this.isLocal && createStandardXHR() || createActiveXHR();
  	} :
  	// For all other browsers, use the standard XMLHttpRequest object
  	createStandardXHR;
  
  // Test if we can create an xhr object
  testXHR = jQuery.ajaxSettings.xhr();
  jQuery.support.ajax = !!testXHR;
  
  // Does this browser support crossDomain XHR requests
  jQuery.support.cors = testXHR && ( "withCredentials" in testXHR );
  
  // No need for the temporary xhr anymore
  testXHR = undefined;
  
  // Create transport if the browser can provide an xhr
  if ( jQuery.support.ajax ) {
  
  	jQuery.ajaxTransport(function( s ) {
  		// Cross domain only allowed if supported through XMLHttpRequest
  		if ( !s.crossDomain || jQuery.support.cors ) {
  
  			var callback;
  
  			return {
  				send: function( headers, complete ) {
  
  					// Get a new xhr
  					var xhr = s.xhr(),
  						handle,
  						i;
  
  					// Open the socket
  					// Passing null username, generates a login popup on Opera (#2865)
  					if ( s.username ) {
  						xhr.open( s.type, s.url, s.async, s.username, s.password );
  					} else {
  						xhr.open( s.type, s.url, s.async );
  					}
  
  					// Apply custom fields if provided
  					if ( s.xhrFields ) {
  						for ( i in s.xhrFields ) {
  							xhr[ i ] = s.xhrFields[ i ];
  						}
  					}
  
  					// Override mime type if needed
  					if ( s.mimeType && xhr.overrideMimeType ) {
  						xhr.overrideMimeType( s.mimeType );
  					}
  
  					// X-Requested-With header
  					// For cross-domain requests, seeing as conditions for a preflight are
  					// akin to a jigsaw puzzle, we simply never set it to be sure.
  					// (it can always be set on a per-request basis or even using ajaxSetup)
  					// For same-domain requests, won't change header if already provided.
  					if ( !s.crossDomain && !headers["X-Requested-With"] ) {
  						headers[ "X-Requested-With" ] = "XMLHttpRequest";
  					}
  
  					// Need an extra try/catch for cross domain requests in Firefox 3
  					try {
  						for ( i in headers ) {
  							xhr.setRequestHeader( i, headers[ i ] );
  						}
  					} catch( _ ) {}
  
  					// Do send the request
  					// This may raise an exception which is actually
  					// handled in jQuery.ajax (so no try/catch here)
  					xhr.send( ( s.hasContent && s.data ) || null );
  
  					// Listener
  					callback = function( _, isAbort ) {
  
  						var status,
  							statusText,
  							responseHeaders,
  							responses,
  							xml;
  
  						// Firefox throws exceptions when accessing properties
  						// of an xhr when a network error occured
  						// http://helpful.knobs-dials.com/index.php/Component_returned_failure_code:_0x80040111_(NS_ERROR_NOT_AVAILABLE)
  						try {
  
  							// Was never called and is aborted or complete
  							if ( callback && ( isAbort || xhr.readyState === 4 ) ) {
  
  								// Only called once
  								callback = undefined;
  
  								// Do not keep as active anymore
  								if ( handle ) {
  									xhr.onreadystatechange = jQuery.noop;
  									delete xhrCallbacks[ handle ];
  								}
  
  								// If it's an abort
  								if ( isAbort ) {
  									// Abort it manually if needed
  									if ( xhr.readyState !== 4 ) {
  										xhr.abort();
  									}
  								} else {
  									status = xhr.status;
  									responseHeaders = xhr.getAllResponseHeaders();
  									responses = {};
  									xml = xhr.responseXML;
  
  									// Construct response list
  									if ( xml && xml.documentElement /* #4958 */ ) {
  										responses.xml = xml;
  									}
  									responses.text = xhr.responseText;
  
  									// Firefox throws an exception when accessing
  									// statusText for faulty cross-domain requests
  									try {
  										statusText = xhr.statusText;
  									} catch( e ) {
  										// We normalize with Webkit giving an empty statusText
  										statusText = "";
  									}
  
  									// Filter status for non standard behaviors
  
  									// If the request is local and we have data: assume a success
  									// (success with no data won't get notified, that's the best we
  									// can do given current implementations)
  									if ( !status && s.isLocal && !s.crossDomain ) {
  										status = responses.text ? 200 : 404;
  									// IE - #1450: sometimes returns 1223 when it should be 204
  									} else if ( status === 1223 ) {
  										status = 204;
  									}
  								}
  							}
  						} catch( firefoxAccessException ) {
  							if ( !isAbort ) {
  								complete( -1, firefoxAccessException );
  							}
  						}
  
  						// Call complete if needed
  						if ( responses ) {
  							complete( status, statusText, responses, responseHeaders );
  						}
  					};
  
  					// if we're in sync mode or it's in cache
  					// and has been retrieved directly (IE6 & IE7)
  					// we need to manually fire the callback
  					if ( !s.async || xhr.readyState === 4 ) {
  						callback();
  					} else {
  						// Create the active xhrs callbacks list if needed
  						// and attach the unload handler
  						if ( !xhrCallbacks ) {
  							xhrCallbacks = {};
  							xhrOnUnloadAbort();
  						}
  						// Add to list of active xhrs callbacks
  						handle = xhrId++;
  						xhr.onreadystatechange = xhrCallbacks[ handle ] = callback;
  					}
  				},
  
  				abort: function() {
  					if ( callback ) {
  						callback(0,1);
  					}
  				}
  			};
  		}
  	});
  }
  
  
  
  
  var elemdisplay = {},
  	rfxtypes = /^(?:toggle|show|hide)$/,
  	rfxnum = /^([+\-]=)?([\d+.\-]+)([a-z%]*)$/i,
  	timerId,
  	fxAttrs = [
  		// height animations
  		[ "height", "marginTop", "marginBottom", "paddingTop", "paddingBottom" ],
  		// width animations
  		[ "width", "marginLeft", "marginRight", "paddingLeft", "paddingRight" ],
  		// opacity animations
  		[ "opacity" ]
  	];
  
  jQuery.fn.extend({
  	show: function( speed, easing, callback ) {
  		var elem, display;
  
  		if ( speed || speed === 0 ) {
  			return this.animate( genFx("show", 3), speed, easing, callback);
  
  		} else {
  			for ( var i = 0, j = this.length; i < j; i++ ) {
  				elem = this[i];
  				display = elem.style.display;
  
  				// Reset the inline display of this element to learn if it is
  				// being hidden by cascaded rules or not
  				if ( !jQuery._data(elem, "olddisplay") && display === "none" ) {
  					display = elem.style.display = "";
  				}
  
  				// Set elements which have been overridden with display: none
  				// in a stylesheet to whatever the default browser style is
  				// for such an element
  				if ( display === "" && jQuery.css( elem, "display" ) === "none" ) {
  					jQuery._data(elem, "olddisplay", defaultDisplay(elem.nodeName));
  				}
  			}
  
  			// Set the display of most of the elements in a second loop
  			// to avoid the constant reflow
  			for ( i = 0; i < j; i++ ) {
  				elem = this[i];
  				display = elem.style.display;
  
  				if ( display === "" || display === "none" ) {
  					elem.style.display = jQuery._data(elem, "olddisplay") || "";
  				}
  			}
  
  			return this;
  		}
  	},
  
  	hide: function( speed, easing, callback ) {
  		if ( speed || speed === 0 ) {
  			return this.animate( genFx("hide", 3), speed, easing, callback);
  
  		} else {
  			for ( var i = 0, j = this.length; i < j; i++ ) {
  				var display = jQuery.css( this[i], "display" );
  
  				if ( display !== "none" && !jQuery._data( this[i], "olddisplay" ) ) {
  					jQuery._data( this[i], "olddisplay", display );
  				}
  			}
  
  			// Set the display of the elements in a second loop
  			// to avoid the constant reflow
  			for ( i = 0; i < j; i++ ) {
  				this[i].style.display = "none";
  			}
  
  			return this;
  		}
  	},
  
  	// Save the old toggle function
  	_toggle: jQuery.fn.toggle,
  
  	toggle: function( fn, fn2, callback ) {
  		var bool = typeof fn === "boolean";
  
  		if ( jQuery.isFunction(fn) && jQuery.isFunction(fn2) ) {
  			this._toggle.apply( this, arguments );
  
  		} else if ( fn == null || bool ) {
  			this.each(function() {
  				var state = bool ? fn : jQuery(this).is(":hidden");
  				jQuery(this)[ state ? "show" : "hide" ]();
  			});
  
  		} else {
  			this.animate(genFx("toggle", 3), fn, fn2, callback);
  		}
  
  		return this;
  	},
  
  	fadeTo: function( speed, to, easing, callback ) {
  		return this.filter(":hidden").css("opacity", 0).show().end()
  					.animate({opacity: to}, speed, easing, callback);
  	},
  
  	animate: function( prop, speed, easing, callback ) {
  		var optall = jQuery.speed(speed, easing, callback);
  
  		if ( jQuery.isEmptyObject( prop ) ) {
  			return this.each( optall.complete );
  		}
  
  		return this[ optall.queue === false ? "each" : "queue" ](function() {
  			// XXX 'this' does not always have a nodeName when running the
  			// test suite
  
  			var opt = jQuery.extend({}, optall), p,
  				isElement = this.nodeType === 1,
  				hidden = isElement && jQuery(this).is(":hidden"),
  				self = this;
  
  			for ( p in prop ) {
  				var name = jQuery.camelCase( p );
  
  				if ( p !== name ) {
  					prop[ name ] = prop[ p ];
  					delete prop[ p ];
  					p = name;
  				}
  
  				if ( prop[p] === "hide" && hidden || prop[p] === "show" && !hidden ) {
  					return opt.complete.call(this);
  				}
  
  				if ( isElement && ( p === "height" || p === "width" ) ) {
  					// Make sure that nothing sneaks out
  					// Record all 3 overflow attributes because IE does not
  					// change the overflow attribute when overflowX and
  					// overflowY are set to the same value
  					opt.overflow = [ this.style.overflow, this.style.overflowX, this.style.overflowY ];
  
  					// Set display property to inline-block for height/width
  					// animations on inline elements that are having width/height
  					// animated
  					if ( jQuery.css( this, "display" ) === "inline" &&
  							jQuery.css( this, "float" ) === "none" ) {
  						if ( !jQuery.support.inlineBlockNeedsLayout ) {
  							this.style.display = "inline-block";
  
  						} else {
  							var display = defaultDisplay(this.nodeName);
  
  							// inline-level elements accept inline-block;
  							// block-level elements need to be inline with layout
  							if ( display === "inline" ) {
  								this.style.display = "inline-block";
  
  							} else {
  								this.style.display = "inline";
  								this.style.zoom = 1;
  							}
  						}
  					}
  				}
  
  				if ( jQuery.isArray( prop[p] ) ) {
  					// Create (if needed) and add to specialEasing
  					(opt.specialEasing = opt.specialEasing || {})[p] = prop[p][1];
  					prop[p] = prop[p][0];
  				}
  			}
  
  			if ( opt.overflow != null ) {
  				this.style.overflow = "hidden";
  			}
  
  			opt.curAnim = jQuery.extend({}, prop);
  
  			jQuery.each( prop, function( name, val ) {
  				var e = new jQuery.fx( self, opt, name );
  
  				if ( rfxtypes.test(val) ) {
  					e[ val === "toggle" ? hidden ? "show" : "hide" : val ]( prop );
  
  				} else {
  					var parts = rfxnum.exec(val),
  						start = e.cur();
  
  					if ( parts ) {
  						var end = parseFloat( parts[2] ),
  							unit = parts[3] || ( jQuery.cssNumber[ name ] ? "" : "px" );
  
  						// We need to compute starting value
  						if ( unit !== "px" ) {
  							jQuery.style( self, name, (end || 1) + unit);
  							start = ((end || 1) / e.cur()) * start;
  							jQuery.style( self, name, start + unit);
  						}
  
  						// If a +=/-= token was provided, we're doing a relative animation
  						if ( parts[1] ) {
  							end = ((parts[1] === "-=" ? -1 : 1) * end) + start;
  						}
  
  						e.custom( start, end, unit );
  
  					} else {
  						e.custom( start, val, "" );
  					}
  				}
  			});
  
  			// For JS strict compliance
  			return true;
  		});
  	},
  
  	stop: function( clearQueue, gotoEnd ) {
  		var timers = jQuery.timers;
  
  		if ( clearQueue ) {
  			this.queue([]);
  		}
  
  		this.each(function() {
  			// go in reverse order so anything added to the queue during the loop is ignored
  			for ( var i = timers.length - 1; i >= 0; i-- ) {
  				if ( timers[i].elem === this ) {
  					if (gotoEnd) {
  						// force the next step to be the last
  						timers[i](true);
  					}
  
  					timers.splice(i, 1);
  				}
  			}
  		});
  
  		// start the next in the queue if the last step wasn't forced
  		if ( !gotoEnd ) {
  			this.dequeue();
  		}
  
  		return this;
  	}
  
  });
  
  function genFx( type, num ) {
  	var obj = {};
  
  	jQuery.each( fxAttrs.concat.apply([], fxAttrs.slice(0,num)), function() {
  		obj[ this ] = type;
  	});
  
  	return obj;
  }
  
  // Generate shortcuts for custom animations
  jQuery.each({
  	slideDown: genFx("show", 1),
  	slideUp: genFx("hide", 1),
  	slideToggle: genFx("toggle", 1),
  	fadeIn: { opacity: "show" },
  	fadeOut: { opacity: "hide" },
  	fadeToggle: { opacity: "toggle" }
  }, function( name, props ) {
  	jQuery.fn[ name ] = function( speed, easing, callback ) {
  		return this.animate( props, speed, easing, callback );
  	};
  });
  
  jQuery.extend({
  	speed: function( speed, easing, fn ) {
  		var opt = speed && typeof speed === "object" ? jQuery.extend({}, speed) : {
  			complete: fn || !fn && easing ||
  				jQuery.isFunction( speed ) && speed,
  			duration: speed,
  			easing: fn && easing || easing && !jQuery.isFunction(easing) && easing
  		};
  
  		opt.duration = jQuery.fx.off ? 0 : typeof opt.duration === "number" ? opt.duration :
  			opt.duration in jQuery.fx.speeds ? jQuery.fx.speeds[opt.duration] : jQuery.fx.speeds._default;
  
  		// Queueing
  		opt.old = opt.complete;
  		opt.complete = function() {
  			if ( opt.queue !== false ) {
  				jQuery(this).dequeue();
  			}
  			if ( jQuery.isFunction( opt.old ) ) {
  				opt.old.call( this );
  			}
  		};
  
  		return opt;
  	},
  
  	easing: {
  		linear: function( p, n, firstNum, diff ) {
  			return firstNum + diff * p;
  		},
  		swing: function( p, n, firstNum, diff ) {
  			return ((-Math.cos(p*Math.PI)/2) + 0.5) * diff + firstNum;
  		}
  	},
  
  	timers: [],
  
  	fx: function( elem, options, prop ) {
  		this.options = options;
  		this.elem = elem;
  		this.prop = prop;
  
  		if ( !options.orig ) {
  			options.orig = {};
  		}
  	}
  
  });
  
  jQuery.fx.prototype = {
  	// Simple function for setting a style value
  	update: function() {
  		if ( this.options.step ) {
  			this.options.step.call( this.elem, this.now, this );
  		}
  
  		(jQuery.fx.step[this.prop] || jQuery.fx.step._default)( this );
  	},
  
  	// Get the current size
  	cur: function() {
  		if ( this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null) ) {
  			return this.elem[ this.prop ];
  		}
  
  		var parsed,
  			r = jQuery.css( this.elem, this.prop );
  		// Empty strings, null, undefined and "auto" are converted to 0,
  		// complex values such as "rotate(1rad)" are returned as is,
  		// simple values such as "10px" are parsed to Float.
  		return isNaN( parsed = parseFloat( r ) ) ? !r || r === "auto" ? 0 : r : parsed;
  	},
  
  	// Start an animation from one number to another
  	custom: function( from, to, unit ) {
  		var self = this,
  			fx = jQuery.fx;
  
  		this.startTime = jQuery.now();
  		this.start = from;
  		this.end = to;
  		this.unit = unit || this.unit || ( jQuery.cssNumber[ this.prop ] ? "" : "px" );
  		this.now = this.start;
  		this.pos = this.state = 0;
  
  		function t( gotoEnd ) {
  			return self.step(gotoEnd);
  		}
  
  		t.elem = this.elem;
  
  		if ( t() && jQuery.timers.push(t) && !timerId ) {
  			timerId = setInterval(fx.tick, fx.interval);
  		}
  	},
  
  	// Simple 'show' function
  	show: function() {
  		// Remember where we started, so that we can go back to it later
  		this.options.orig[this.prop] = jQuery.style( this.elem, this.prop );
  		this.options.show = true;
  
  		// Begin the animation
  		// Make sure that we start at a small width/height to avoid any
  		// flash of content
  		this.custom(this.prop === "width" || this.prop === "height" ? 1 : 0, this.cur());
  
  		// Start by showing the element
  		jQuery( this.elem ).show();
  	},
  
  	// Simple 'hide' function
  	hide: function() {
  		// Remember where we started, so that we can go back to it later
  		this.options.orig[this.prop] = jQuery.style( this.elem, this.prop );
  		this.options.hide = true;
  
  		// Begin the animation
  		this.custom(this.cur(), 0);
  	},
  
  	// Each step of an animation
  	step: function( gotoEnd ) {
  		var t = jQuery.now(), done = true;
  
  		if ( gotoEnd || t >= this.options.duration + this.startTime ) {
  			this.now = this.end;
  			this.pos = this.state = 1;
  			this.update();
  
  			this.options.curAnim[ this.prop ] = true;
  
  			for ( var i in this.options.curAnim ) {
  				if ( this.options.curAnim[i] !== true ) {
  					done = false;
  				}
  			}
  
  			if ( done ) {
  				// Reset the overflow
  				if ( this.options.overflow != null && !jQuery.support.shrinkWrapBlocks ) {
  					var elem = this.elem,
  						options = this.options;
  
  					jQuery.each( [ "", "X", "Y" ], function (index, value) {
  						elem.style[ "overflow" + value ] = options.overflow[index];
  					} );
  				}
  
  				// Hide the element if the "hide" operation was done
  				if ( this.options.hide ) {
  					jQuery(this.elem).hide();
  				}
  
  				// Reset the properties, if the item has been hidden or shown
  				if ( this.options.hide || this.options.show ) {
  					for ( var p in this.options.curAnim ) {
  						jQuery.style( this.elem, p, this.options.orig[p] );
  					}
  				}
  
  				// Execute the complete function
  				this.options.complete.call( this.elem );
  			}
  
  			return false;
  
  		} else {
  			var n = t - this.startTime;
  			this.state = n / this.options.duration;
  
  			// Perform the easing function, defaults to swing
  			var specialEasing = this.options.specialEasing && this.options.specialEasing[this.prop];
  			var defaultEasing = this.options.easing || (jQuery.easing.swing ? "swing" : "linear");
  			this.pos = jQuery.easing[specialEasing || defaultEasing](this.state, n, 0, 1, this.options.duration);
  			this.now = this.start + ((this.end - this.start) * this.pos);
  
  			// Perform the next step of the animation
  			this.update();
  		}
  
  		return true;
  	}
  };
  
  jQuery.extend( jQuery.fx, {
  	tick: function() {
  		var timers = jQuery.timers;
  
  		for ( var i = 0; i < timers.length; i++ ) {
  			if ( !timers[i]() ) {
  				timers.splice(i--, 1);
  			}
  		}
  
  		if ( !timers.length ) {
  			jQuery.fx.stop();
  		}
  	},
  
  	interval: 13,
  
  	stop: function() {
  		clearInterval( timerId );
  		timerId = null;
  	},
  
  	speeds: {
  		slow: 600,
  		fast: 200,
  		// Default speed
  		_default: 400
  	},
  
  	step: {
  		opacity: function( fx ) {
  			jQuery.style( fx.elem, "opacity", fx.now );
  		},
  
  		_default: function( fx ) {
  			if ( fx.elem.style && fx.elem.style[ fx.prop ] != null ) {
  				fx.elem.style[ fx.prop ] = (fx.prop === "width" || fx.prop === "height" ? Math.max(0, fx.now) : fx.now) + fx.unit;
  			} else {
  				fx.elem[ fx.prop ] = fx.now;
  			}
  		}
  	}
  });
  
  if ( jQuery.expr && jQuery.expr.filters ) {
  	jQuery.expr.filters.animated = function( elem ) {
  		return jQuery.grep(jQuery.timers, function( fn ) {
  			return elem === fn.elem;
  		}).length;
  	};
  }
  
  function defaultDisplay( nodeName ) {
  	if ( !elemdisplay[ nodeName ] ) {
  		var elem = jQuery("<" + nodeName + ">").appendTo("body"),
  			display = elem.css("display");
  
  		elem.remove();
  
  		if ( display === "none" || display === "" ) {
  			display = "block";
  		}
  
  		elemdisplay[ nodeName ] = display;
  	}
  
  	return elemdisplay[ nodeName ];
  }
  
  
  
  
  var rtable = /^t(?:able|d|h)$/i,
  	rroot = /^(?:body|html)$/i;
  
  if ( "getBoundingClientRect" in document.documentElement ) {
  	jQuery.fn.offset = function( options ) {
  		var elem = this[0], box;
  
  		if ( options ) {
  			return this.each(function( i ) {
  				jQuery.offset.setOffset( this, options, i );
  			});
  		}
  
  		if ( !elem || !elem.ownerDocument ) {
  			return null;
  		}
  
  		if ( elem === elem.ownerDocument.body ) {
  			return jQuery.offset.bodyOffset( elem );
  		}
  
  		try {
  			box = elem.getBoundingClientRect();
  		} catch(e) {}
  
  		var doc = elem.ownerDocument,
  			docElem = doc.documentElement;
  
  		// Make sure we're not dealing with a disconnected DOM node
  		if ( !box || !jQuery.contains( docElem, elem ) ) {
  			return box ? { top: box.top, left: box.left } : { top: 0, left: 0 };
  		}
  
  		var body = doc.body,
  			win = getWindow(doc),
  			clientTop  = docElem.clientTop  || body.clientTop  || 0,
  			clientLeft = docElem.clientLeft || body.clientLeft || 0,
  			scrollTop  = (win.pageYOffset || jQuery.support.boxModel && docElem.scrollTop  || body.scrollTop ),
  			scrollLeft = (win.pageXOffset || jQuery.support.boxModel && docElem.scrollLeft || body.scrollLeft),
  			top  = box.top  + scrollTop  - clientTop,
  			left = box.left + scrollLeft - clientLeft;
  
  		return { top: top, left: left };
  	};
  
  } else {
  	jQuery.fn.offset = function( options ) {
  		var elem = this[0];
  
  		if ( options ) {
  			return this.each(function( i ) {
  				jQuery.offset.setOffset( this, options, i );
  			});
  		}
  
  		if ( !elem || !elem.ownerDocument ) {
  			return null;
  		}
  
  		if ( elem === elem.ownerDocument.body ) {
  			return jQuery.offset.bodyOffset( elem );
  		}
  
  		jQuery.offset.initialize();
  
  		var computedStyle,
  			offsetParent = elem.offsetParent,
  			prevOffsetParent = elem,
  			doc = elem.ownerDocument,
  			docElem = doc.documentElement,
  			body = doc.body,
  			defaultView = doc.defaultView,
  			prevComputedStyle = defaultView ? defaultView.getComputedStyle( elem, null ) : elem.currentStyle,
  			top = elem.offsetTop,
  			left = elem.offsetLeft;
  
  		while ( (elem = elem.parentNode) && elem !== body && elem !== docElem ) {
  			if ( jQuery.offset.supportsFixedPosition && prevComputedStyle.position === "fixed" ) {
  				break;
  			}
  
  			computedStyle = defaultView ? defaultView.getComputedStyle(elem, null) : elem.currentStyle;
  			top  -= elem.scrollTop;
  			left -= elem.scrollLeft;
  
  			if ( elem === offsetParent ) {
  				top  += elem.offsetTop;
  				left += elem.offsetLeft;
  
  				if ( jQuery.offset.doesNotAddBorder && !(jQuery.offset.doesAddBorderForTableAndCells && rtable.test(elem.nodeName)) ) {
  					top  += parseFloat( computedStyle.borderTopWidth  ) || 0;
  					left += parseFloat( computedStyle.borderLeftWidth ) || 0;
  				}
  
  				prevOffsetParent = offsetParent;
  				offsetParent = elem.offsetParent;
  			}
  
  			if ( jQuery.offset.subtractsBorderForOverflowNotVisible && computedStyle.overflow !== "visible" ) {
  				top  += parseFloat( computedStyle.borderTopWidth  ) || 0;
  				left += parseFloat( computedStyle.borderLeftWidth ) || 0;
  			}
  
  			prevComputedStyle = computedStyle;
  		}
  
  		if ( prevComputedStyle.position === "relative" || prevComputedStyle.position === "static" ) {
  			top  += body.offsetTop;
  			left += body.offsetLeft;
  		}
  
  		if ( jQuery.offset.supportsFixedPosition && prevComputedStyle.position === "fixed" ) {
  			top  += Math.max( docElem.scrollTop, body.scrollTop );
  			left += Math.max( docElem.scrollLeft, body.scrollLeft );
  		}
  
  		return { top: top, left: left };
  	};
  }
  
  jQuery.offset = {
  	initialize: function() {
  		var body = document.body, container = document.createElement("div"), innerDiv, checkDiv, table, td, bodyMarginTop = parseFloat( jQuery.css(body, "marginTop") ) || 0,
  			html = "<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";
  
  		jQuery.extend( container.style, { position: "absolute", top: 0, left: 0, margin: 0, border: 0, width: "1px", height: "1px", visibility: "hidden" } );
  
  		container.innerHTML = html;
  		body.insertBefore( container, body.firstChild );
  		innerDiv = container.firstChild;
  		checkDiv = innerDiv.firstChild;
  		td = innerDiv.nextSibling.firstChild.firstChild;
  
  		this.doesNotAddBorder = (checkDiv.offsetTop !== 5);
  		this.doesAddBorderForTableAndCells = (td.offsetTop === 5);
  
  		checkDiv.style.position = "fixed";
  		checkDiv.style.top = "20px";
  
  		// safari subtracts parent border width here which is 5px
  		this.supportsFixedPosition = (checkDiv.offsetTop === 20 || checkDiv.offsetTop === 15);
  		checkDiv.style.position = checkDiv.style.top = "";
  
  		innerDiv.style.overflow = "hidden";
  		innerDiv.style.position = "relative";
  
  		this.subtractsBorderForOverflowNotVisible = (checkDiv.offsetTop === -5);
  
  		this.doesNotIncludeMarginInBodyOffset = (body.offsetTop !== bodyMarginTop);
  
  		body.removeChild( container );
  		body = container = innerDiv = checkDiv = table = td = null;
  		jQuery.offset.initialize = jQuery.noop;
  	},
  
  	bodyOffset: function( body ) {
  		var top = body.offsetTop,
  			left = body.offsetLeft;
  
  		jQuery.offset.initialize();
  
  		if ( jQuery.offset.doesNotIncludeMarginInBodyOffset ) {
  			top  += parseFloat( jQuery.css(body, "marginTop") ) || 0;
  			left += parseFloat( jQuery.css(body, "marginLeft") ) || 0;
  		}
  
  		return { top: top, left: left };
  	},
  
  	setOffset: function( elem, options, i ) {
  		var position = jQuery.css( elem, "position" );
  
  		// set position first, in-case top/left are set even on static elem
  		if ( position === "static" ) {
  			elem.style.position = "relative";
  		}
  
  		var curElem = jQuery( elem ),
  			curOffset = curElem.offset(),
  			curCSSTop = jQuery.css( elem, "top" ),
  			curCSSLeft = jQuery.css( elem, "left" ),
  			calculatePosition = (position === "absolute" && jQuery.inArray('auto', [curCSSTop, curCSSLeft]) > -1),
  			props = {}, curPosition = {}, curTop, curLeft;
  
  		// need to be able to calculate position if either top or left is auto and position is absolute
  		if ( calculatePosition ) {
  			curPosition = curElem.position();
  		}
  
  		curTop  = calculatePosition ? curPosition.top  : parseInt( curCSSTop,  10 ) || 0;
  		curLeft = calculatePosition ? curPosition.left : parseInt( curCSSLeft, 10 ) || 0;
  
  		if ( jQuery.isFunction( options ) ) {
  			options = options.call( elem, i, curOffset );
  		}
  
  		if (options.top != null) {
  			props.top = (options.top - curOffset.top) + curTop;
  		}
  		if (options.left != null) {
  			props.left = (options.left - curOffset.left) + curLeft;
  		}
  
  		if ( "using" in options ) {
  			options.using.call( elem, props );
  		} else {
  			curElem.css( props );
  		}
  	}
  };
  
  
  jQuery.fn.extend({
  	position: function() {
  		if ( !this[0] ) {
  			return null;
  		}
  
  		var elem = this[0],
  
  		// Get *real* offsetParent
  		offsetParent = this.offsetParent(),
  
  		// Get correct offsets
  		offset       = this.offset(),
  		parentOffset = rroot.test(offsetParent[0].nodeName) ? { top: 0, left: 0 } : offsetParent.offset();
  
  		// Subtract element margins
  		// note: when an element has margin: auto the offsetLeft and marginLeft
  		// are the same in Safari causing offset.left to incorrectly be 0
  		offset.top  -= parseFloat( jQuery.css(elem, "marginTop") ) || 0;
  		offset.left -= parseFloat( jQuery.css(elem, "marginLeft") ) || 0;
  
  		// Add offsetParent borders
  		parentOffset.top  += parseFloat( jQuery.css(offsetParent[0], "borderTopWidth") ) || 0;
  		parentOffset.left += parseFloat( jQuery.css(offsetParent[0], "borderLeftWidth") ) || 0;
  
  		// Subtract the two offsets
  		return {
  			top:  offset.top  - parentOffset.top,
  			left: offset.left - parentOffset.left
  		};
  	},
  
  	offsetParent: function() {
  		return this.map(function() {
  			var offsetParent = this.offsetParent || document.body;
  			while ( offsetParent && (!rroot.test(offsetParent.nodeName) && jQuery.css(offsetParent, "position") === "static") ) {
  				offsetParent = offsetParent.offsetParent;
  			}
  			return offsetParent;
  		});
  	}
  });
  
  
  // Create scrollLeft and scrollTop methods
  jQuery.each( ["Left", "Top"], function( i, name ) {
  	var method = "scroll" + name;
  
  	jQuery.fn[ method ] = function(val) {
  		var elem = this[0], win;
  
  		if ( !elem ) {
  			return null;
  		}
  
  		if ( val !== undefined ) {
  			// Set the scroll offset
  			return this.each(function() {
  				win = getWindow( this );
  
  				if ( win ) {
  					win.scrollTo(
  						!i ? val : jQuery(win).scrollLeft(),
  						i ? val : jQuery(win).scrollTop()
  					);
  
  				} else {
  					this[ method ] = val;
  				}
  			});
  		} else {
  			win = getWindow( elem );
  
  			// Return the scroll offset
  			return win ? ("pageXOffset" in win) ? win[ i ? "pageYOffset" : "pageXOffset" ] :
  				jQuery.support.boxModel && win.document.documentElement[ method ] ||
  					win.document.body[ method ] :
  				elem[ method ];
  		}
  	};
  });
  
  function getWindow( elem ) {
  	return jQuery.isWindow( elem ) ?
  		elem :
  		elem.nodeType === 9 ?
  			elem.defaultView || elem.parentWindow :
  			false;
  }
  
  
  
  
  // Create innerHeight, innerWidth, outerHeight and outerWidth methods
  jQuery.each([ "Height", "Width" ], function( i, name ) {
  
  	var type = name.toLowerCase();
  
  	// innerHeight and innerWidth
  	jQuery.fn["inner" + name] = function() {
  		return this[0] ?
  			parseFloat( jQuery.css( this[0], type, "padding" ) ) :
  			null;
  	};
  
  	// outerHeight and outerWidth
  	jQuery.fn["outer" + name] = function( margin ) {
  		return this[0] ?
  			parseFloat( jQuery.css( this[0], type, margin ? "margin" : "border" ) ) :
  			null;
  	};
  
  	jQuery.fn[ type ] = function( size ) {
  		// Get window width or height
  		var elem = this[0];
  		if ( !elem ) {
  			return size == null ? null : this;
  		}
  
  		if ( jQuery.isFunction( size ) ) {
  			return this.each(function( i ) {
  				var self = jQuery( this );
  				self[ type ]( size.call( this, i, self[ type ]() ) );
  			});
  		}
  
  		if ( jQuery.isWindow( elem ) ) {
  			// Everyone else use document.documentElement or document.body depending on Quirks vs Standards mode
  			// 3rd condition allows Nokia support, as it supports the docElem prop but not CSS1Compat
  			var docElemProp = elem.document.documentElement[ "client" + name ];
  			return elem.document.compatMode === "CSS1Compat" && docElemProp ||
  				elem.document.body[ "client" + name ] || docElemProp;
  
  		// Get document width or height
  		} else if ( elem.nodeType === 9 ) {
  			// Either scroll[Width/Height] or offset[Width/Height], whichever is greater
  			return Math.max(
  				elem.documentElement["client" + name],
  				elem.body["scroll" + name], elem.documentElement["scroll" + name],
  				elem.body["offset" + name], elem.documentElement["offset" + name]
  			);
  
  		// Get or set width or height on the element
  		} else if ( size === undefined ) {
  			var orig = jQuery.css( elem, type ),
  				ret = parseFloat( orig );
  
  			return jQuery.isNaN( ret ) ? orig : ret;
  
  		// Set the width or height on the element (default to pixels if value is unitless)
  		} else {
  			return this.css( type, typeof size === "string" ? size : size + "px" );
  		}
  	};
  
  });
  
  
  window.jQuery = window.$ = jQuery;
  })(window);
  
    // begin npm / ender footer
    window.jQuery.noConflict();
    return window.jQuery;
  }
  module.exports = create('undefined' === typeof window ? undefined : window);
  module.exports.create = create;
  }());
  
  

  provide("jQuery", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
  // Copyright Joyent, Inc. and other Node contributors.
  //
  // Permission is hereby granted, free of charge, to any person obtaining a
  // copy of this software and associated documentation files (the
  // "Software"), to deal in the Software without restriction, including
  // without limitation the rights to use, copy, modify, merge, publish,
  // distribute, sublicense, and/or sell copies of the Software, and to permit
  // persons to whom the Software is furnished to do so, subject to the
  // following conditions:
  //
  // The above copyright notice and this permission notice shall be included
  // in all copies or substantial portions of the Software.
  //
  // THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
  // OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  // MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
  // NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
  // DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
  // OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
  // USE OR OTHER DEALINGS IN THE SOFTWARE.
  
  exports.parse = urlParse;
  exports.resolve = urlResolve;
  exports.resolveObject = urlResolveObject;
  exports.format = urlFormat;
  
  // Reference: RFC 3986, RFC 1808, RFC 2396
  
  // define these here so at least they only have to be
  // compiled once on the first module load.
  var protocolPattern = /^([a-z0-9]+:)/i,
      portPattern = /:[0-9]+$/,
      // RFC 2396: characters reserved for delimiting URLs.
      delims = ['<', '>', '"', '`', ' ', '\r', '\n', '\t'],
      // RFC 2396: characters not allowed for various reasons.
      unwise = ['{', '}', '|', '\\', '^', '~', '[', ']', '`'].concat(delims),
      // Allowed by RFCs, but cause of XSS attacks.  Always escape these.
      autoEscape = ['\''],
      // Characters that are never ever allowed in a hostname.
      // Note that any invalid chars are also handled, but these
      // are the ones that are *expected* to be seen, so we fast-path
      // them.
      nonHostChars = ['%', '/', '?', ';', '#']
        .concat(unwise).concat(autoEscape),
      nonAuthChars = ['/', '@', '?', '#'].concat(delims),
      hostnameMaxLen = 255,
      hostnamePartPattern = /^[a-zA-Z0-9][a-z0-9A-Z-]{0,62}$/,
      hostnamePartStart = /^([a-zA-Z0-9][a-z0-9A-Z-]{0,62})(.*)$/,
      // protocols that can allow "unsafe" and "unwise" chars.
      unsafeProtocol = {
        'javascript': true,
        'javascript:': true
      },
      // protocols that never have a hostname.
      hostlessProtocol = {
        'javascript': true,
        'javascript:': true
      },
      // protocols that always have a path component.
      pathedProtocol = {
        'http': true,
        'https': true,
        'ftp': true,
        'gopher': true,
        'file': true,
        'http:': true,
        'ftp:': true,
        'gopher:': true,
        'file:': true
      },
      // protocols that always contain a // bit.
      slashedProtocol = {
        'http': true,
        'https': true,
        'ftp': true,
        'gopher': true,
        'file': true,
        'http:': true,
        'https:': true,
        'ftp:': true,
        'gopher:': true,
        'file:': true
      },
      querystring = require('querystring');
  
  function urlParse(url, parseQueryString, slashesDenoteHost) {
    if (url && typeof(url) === 'object' && url.href) return url;
  
    var out = {},
        rest = url;
  
    // cut off any delimiters.
    // This is to support parse stuff like "<http://foo.com>"
    for (var i = 0, l = rest.length; i < l; i++) {
      if (delims.indexOf(rest.charAt(i)) === -1) break;
    }
    if (i !== 0) rest = rest.substr(i);
  
  
    var proto = protocolPattern.exec(rest);
    if (proto) {
      proto = proto[0];
      var lowerProto = proto.toLowerCase();
      out.protocol = lowerProto;
      rest = rest.substr(proto.length);
    }
  
    // figure out if it's got a host
    // user@server is *always* interpreted as a hostname, and url
    // resolution will treat //foo/bar as host=foo,path=bar because that's
    // how the browser resolves relative URLs.
    if (slashesDenoteHost || proto || rest.match(/^\/\/[^@\/]+@[^@\/]+/)) {
      var slashes = rest.substr(0, 2) === '//';
      if (slashes && !(proto && hostlessProtocol[proto])) {
        rest = rest.substr(2);
        out.slashes = true;
      }
    }
  
    if (!hostlessProtocol[proto] &&
        (slashes || (proto && !slashedProtocol[proto]))) {
      // there's a hostname.
      // the first instance of /, ?, ;, or # ends the host.
      // don't enforce full RFC correctness, just be unstupid about it.
  
      // If there is an @ in the hostname, then non-host chars *are* allowed
      // to the left of the first @ sign, unless some non-auth character
      // comes *before* the @-sign.
      // URLs are obnoxious.
      var atSign = rest.indexOf('@');
      if (atSign !== -1) {
        // there *may be* an auth
        var hasAuth = true;
        for (var i = 0, l = nonAuthChars.length; i < l; i++) {
          var index = rest.indexOf(nonAuthChars[i]);
          if (index !== -1 && index < atSign) {
            // not a valid auth.  Something like http://foo.com/bar@baz/
            hasAuth = false;
            break;
          }
        }
        if (hasAuth) {
          // pluck off the auth portion.
          out.auth = rest.substr(0, atSign);
          rest = rest.substr(atSign + 1);
        }
      }
  
      var firstNonHost = -1;
      for (var i = 0, l = nonHostChars.length; i < l; i++) {
        var index = rest.indexOf(nonHostChars[i]);
        if (index !== -1 &&
            (firstNonHost < 0 || index < firstNonHost)) firstNonHost = index;
      }
  
      if (firstNonHost !== -1) {
        out.host = rest.substr(0, firstNonHost);
        rest = rest.substr(firstNonHost);
      } else {
        out.host = rest;
        rest = '';
      }
  
      // pull out port.
      var p = parseHost(out.host);
      if (out.auth) out.host = out.auth + '@' + out.host;
      var keys = Object.keys(p);
      for (var i = 0, l = keys.length; i < l; i++) {
        var key = keys[i];
        out[key] = p[key];
      }
  
      // we've indicated that there is a hostname,
      // so even if it's empty, it has to be present.
      out.hostname = out.hostname || '';
  
      // validate a little.
      if (out.hostname.length > hostnameMaxLen) {
        out.hostname = '';
      } else {
        var hostparts = out.hostname.split(/\./);
        for (var i = 0, l = hostparts.length; i < l; i++) {
          var part = hostparts[i];
          if (!part) continue;
          if (!part.match(hostnamePartPattern)) {
            var validParts = hostparts.slice(0, i);
            var notHost = hostparts.slice(i + 1);
            var bit = part.match(hostnamePartStart);
            if (bit) {
              validParts.push(bit[1]);
              notHost.unshift(bit[2]);
            }
            if (notHost.length) {
              rest = '/' + notHost.join('.') + rest
            }
            out.hostname = validParts.join('.');
            break;
          }
        }
      }
      // hostnames are always lower case.
      out.hostname = out.hostname.toLowerCase();
  
      out.host = ((out.auth) ? out.auth + '@' : '') +
          (out.hostname || '') +
          ((out.port) ? ':' + out.port : '');
      out.href += out.host;
    }
  
    // now rest is set to the post-host stuff.
    // chop off any delim chars.
    if (!unsafeProtocol[lowerProto]) {
  
      // First, make 100% sure that any "autoEscape" chars get
      // escaped, even if encodeURIComponent doesn't think they
      // need to be.
      for (var i = 0, l = autoEscape.length; i < l; i++) {
        var ae = autoEscape[i];
        var esc = encodeURIComponent(ae);
        if (esc === ae) {
          esc = escape(ae);
        }
        rest = rest.split(ae).join(esc);
      }
  
      // Now make sure that delims never appear in a url.
      var chop = rest.length;
      for (var i = 0, l = delims.length; i < l; i++) {
        var c = rest.indexOf(delims[i]);
        if (c !== -1) {
          chop = Math.min(c, chop);
        }
      }
      rest = rest.substr(0, chop);
    }
  
  
    // chop off from the tail first.
    var hash = rest.indexOf('#');
    if (hash !== -1) {
      // got a fragment string.
      out.hash = rest.substr(hash);
      rest = rest.slice(0, hash);
    }
    var qm = rest.indexOf('?');
    if (qm !== -1) {
      out.search = rest.substr(qm);
      out.query = rest.substr(qm + 1);
      if (parseQueryString) {
        out.query = querystring.parse(out.query);
      }
      rest = rest.slice(0, qm);
    } else if (parseQueryString) {
      // no query string, but parseQueryString still requested
      out.search = '';
      out.query = {};
    }
    if (rest) out.pathname = rest;
    if (slashedProtocol[proto] &&
        out.hostname && !out.pathname) {
      out.pathname = '/';
    }
  
    // finally, reconstruct the href based on what has been validated.
    out.href = urlFormat(out);
  
    return out;
  }
  
  // format a parsed object into a url string
  function urlFormat(obj) {
    // ensure it's an object, and not a string url.
    // If it's an obj, this is a no-op.
    // this way, you can call url_format() on strings
    // to clean up potentially wonky urls.
    if (typeof(obj) === 'string') obj = urlParse(obj);
  
    var auth = obj.auth;
    if (auth) {
      auth = auth.split('@').join('%40');
      for (var i = 0, l = nonAuthChars.length; i < l; i++) {
        var nAC = nonAuthChars[i];
        auth = auth.split(nAC).join(encodeURIComponent(nAC));
      }
    }
  
    var protocol = obj.protocol || '',
        host = (obj.host !== undefined) ? obj.host :
            obj.hostname !== undefined ? (
                (auth ? auth + '@' : '') +
                obj.hostname +
                (obj.port ? ':' + obj.port : '')
            ) :
            false,
        pathname = obj.pathname || '',
        query = obj.query &&
                ((typeof obj.query === 'object' &&
                  Object.keys(obj.query).length) ?
                   querystring.stringify(obj.query) :
                   '') || '',
        search = obj.search || (query && ('?' + query)) || '',
        hash = obj.hash || '';
  
    if (protocol && protocol.substr(-1) !== ':') protocol += ':';
  
    // only the slashedProtocols get the //.  Not mailto:, xmpp:, etc.
    // unless they had them to begin with.
    if (obj.slashes ||
        (!protocol || slashedProtocol[protocol]) && host !== false) {
      host = '//' + (host || '');
      if (pathname && pathname.charAt(0) !== '/') pathname = '/' + pathname;
    } else if (!host) {
      host = '';
    }
  
    if (hash && hash.charAt(0) !== '#') hash = '#' + hash;
    if (search && search.charAt(0) !== '?') search = '?' + search;
  
    return protocol + host + pathname + search + hash;
  }
  
  function urlResolve(source, relative) {
    return urlFormat(urlResolveObject(source, relative));
  }
  
  function urlResolveObject(source, relative) {
    if (!source) return relative;
  
    source = urlParse(urlFormat(source), false, true);
    relative = urlParse(urlFormat(relative), false, true);
  
    // hash is always overridden, no matter what.
    source.hash = relative.hash;
  
    if (relative.href === '') return source;
  
    // hrefs like //foo/bar always cut to the protocol.
    if (relative.slashes && !relative.protocol) {
      relative.protocol = source.protocol;
      return relative;
    }
  
    if (relative.protocol && relative.protocol !== source.protocol) {
      // if it's a known url protocol, then changing
      // the protocol does weird things
      // first, if it's not file:, then we MUST have a host,
      // and if there was a path
      // to begin with, then we MUST have a path.
      // if it is file:, then the host is dropped,
      // because that's known to be hostless.
      // anything else is assumed to be absolute.
  
      if (!slashedProtocol[relative.protocol]) return relative;
  
      source.protocol = relative.protocol;
      if (!relative.host && !hostlessProtocol[relative.protocol]) {
        var relPath = (relative.pathname || '').split('/');
        while (relPath.length && !(relative.host = relPath.shift()));
        if (!relative.host) relative.host = '';
        if (relPath[0] !== '') relPath.unshift('');
        if (relPath.length < 2) relPath.unshift('');
        relative.pathname = relPath.join('/');
      }
      source.pathname = relative.pathname;
      source.search = relative.search;
      source.query = relative.query;
      source.host = relative.host || '';
      delete source.auth;
      delete source.hostname;
      source.port = relative.port;
      return source;
    }
  
    var isSourceAbs = (source.pathname && source.pathname.charAt(0) === '/'),
        isRelAbs = (
            relative.host !== undefined ||
            relative.pathname && relative.pathname.charAt(0) === '/'
        ),
        mustEndAbs = (isRelAbs || isSourceAbs ||
                      (source.host && relative.pathname)),
        removeAllDots = mustEndAbs,
        srcPath = source.pathname && source.pathname.split('/') || [],
        relPath = relative.pathname && relative.pathname.split('/') || [],
        psychotic = source.protocol &&
            !slashedProtocol[source.protocol] &&
            source.host !== undefined;
  
    // if the url is a non-slashed url, then relative
    // links like ../.. should be able
    // to crawl up to the hostname, as well.  This is strange.
    // source.protocol has already been set by now.
    // Later on, put the first path part into the host field.
    if (psychotic) {
  
      delete source.hostname;
      delete source.auth;
      delete source.port;
      if (source.host) {
        if (srcPath[0] === '') srcPath[0] = source.host;
        else srcPath.unshift(source.host);
      }
      delete source.host;
  
      if (relative.protocol) {
        delete relative.hostname;
        delete relative.auth;
        delete relative.port;
        if (relative.host) {
          if (relPath[0] === '') relPath[0] = relative.host;
          else relPath.unshift(relative.host);
        }
        delete relative.host;
      }
      mustEndAbs = mustEndAbs && (relPath[0] === '' || srcPath[0] === '');
    }
  
    if (isRelAbs) {
      // it's absolute.
      source.host = (relative.host || relative.host === '') ?
                        relative.host : source.host;
      source.search = relative.search;
      source.query = relative.query;
      srcPath = relPath;
      // fall through to the dot-handling below.
    } else if (relPath.length) {
      // it's relative
      // throw away the existing file, and take the new path instead.
      if (!srcPath) srcPath = [];
      srcPath.pop();
      srcPath = srcPath.concat(relPath);
      source.search = relative.search;
      source.query = relative.query;
    } else if ('search' in relative) {
      // just pull out the search.
      // like href='?foo'.
      // Put this after the other two cases because it simplifies the booleans
      if (psychotic) {
        source.host = srcPath.shift();
      }
      source.search = relative.search;
      source.query = relative.query;
      return source;
    }
    if (!srcPath.length) {
      // no path at all.  easy.
      // we've already handled the other stuff above.
      delete source.pathname;
      return source;
    }
  
    // if a url ENDs in . or .., then it must get a trailing slash.
    // however, if it ends in anything else non-slashy,
    // then it must NOT get a trailing slash.
    var last = srcPath.slice(-1)[0];
    var hasTrailingSlash = (
        (source.host || relative.host) && (last === '.' || last === '..') ||
        last === '');
  
    // strip single dots, resolve double dots to parent dir
    // if the path tries to go above the root, `up` ends up > 0
    var up = 0;
    for (var i = srcPath.length; i >= 0; i--) {
      last = srcPath[i];
      if (last == '.') {
        srcPath.splice(i, 1);
      } else if (last === '..') {
        srcPath.splice(i, 1);
        up++;
      } else if (up) {
        srcPath.splice(i, 1);
        up--;
      }
    }
  
    // if the path is allowed to go above the root, restore leading ..s
    if (!mustEndAbs && !removeAllDots) {
      for (; up--; up) {
        srcPath.unshift('..');
      }
    }
  
    if (mustEndAbs && srcPath[0] !== '' &&
        (!srcPath[0] || srcPath[0].charAt(0) !== '/')) {
      srcPath.unshift('');
    }
  
    if (hasTrailingSlash && (srcPath.join('/').substr(-1) !== '/')) {
      srcPath.push('');
    }
  
    var isAbsolute = srcPath[0] === '' ||
        (srcPath[0] && srcPath[0].charAt(0) === '/');
  
    // put the host back
    if (psychotic) {
      source.host = isAbsolute ? '' : srcPath.shift();
    }
  
    mustEndAbs = mustEndAbs || (source.host && srcPath.length);
  
    if (mustEndAbs && !isAbsolute) {
      srcPath.unshift('');
    }
  
    source.pathname = srcPath.join('/');
  
  
    return source;
  }
  
  function parseHost(host) {
    var out = {};
    var port = portPattern.exec(host);
    if (port) {
      port = port[0];
      out.port = port.substr(1);
      host = host.substr(0, host.length - port.length);
    }
    if (host) out.hostname = host;
    return out;
  }
  
  }());
  

  provide("url", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*!
  	PURE Unobtrusive Rendering Engine for HTML
  
  	Licensed under the MIT licenses.
  	More information at: http://www.opensource.org
  
  	Copyright (c) 2011 Michael Cvilic - BeeBole.com
  
  	Thanks to Rog Peppe for the functional JS jump
  	revision: 2.67
  */
  
  var $p, pure = $p = function(){
  	var sel = arguments[0], 
  		ctxt = false;
  
  	if(typeof sel === 'string'){
  		ctxt = arguments[1] || false;
  	}else if(sel && !sel[0] && !sel.length){
  		sel = [sel];
  	}
  	return $p.core(sel, ctxt);
  };
  
  $p.core = function(sel, ctxt, plugins){
  	//get an instance of the plugins
  	var templates = [];
  	plugins = plugins || getPlugins();
  
  	//search for the template node(s)
  	switch(typeof sel){
  		case 'string':
  			templates = plugins.find(ctxt || document, sel);
  			if(templates.length === 0) {
  				error('The template "' + sel + '" was not found');
  			}
  		break;
  		case 'undefined':
  			error('The root of the template is undefined, check your selector');
  		break;
  		default:
  			templates = sel;
  	}
  	
  	for(var i = 0, ii = templates.length; i < ii; i++){
  		plugins[i] = templates[i];
  	}
  	plugins.length = ii;
  
  	// set the signature string that will be replaced at render time
  	var Sig = '_s' + Math.floor( Math.random() * 1000000 ) + '_',
  		// another signature to prepend to attributes and avoid checks: style, height, on[events]...
  		attPfx = '_a' + Math.floor( Math.random() * 1000000 ) + '_',
  		// rx to parse selectors, e.g. "+tr.foo[class]"
  		selRx = /^(\+)?([^\@\+]+)?\@?([^\+]+)?(\+)?$/,
  		// set automatically attributes for some tags
  		autoAttr = {
  			IMG:'src',
  			INPUT:'value'
  		},
  		// check if the argument is an array - thanks salty-horse (Ori Avtalion)
  		isArray = Array.isArray ?
  			function(o) {
  				return Array.isArray(o);
  			} :
  			function(o) {
  				return Object.prototype.toString.call(o) === "[object Array]";
  			};
  	
  	/* * * * * * * * * * * * * * * * * * * * * * * * * *
  		core functions
  	 * * * * * * * * * * * * * * * * * * * * * * * * * */
  
  
  	// error utility
  	function error(e){
  		if(typeof console !== 'undefined'){
  			console.log(e);
  			debugger;
  		}
  		throw('pure error: ' + e);
  	}
  	
  	//return a new instance of plugins
  	function getPlugins(){
  		var plugins = $p.plugins,
  			f = function(){};
  		f.prototype = plugins;
  
  		// do not overwrite functions if external definition
  		f.prototype.compile    = plugins.compile || compile;
  		f.prototype.render     = plugins.render || render;
  		f.prototype.autoRender = plugins.autoRender || autoRender;
  		f.prototype.find       = plugins.find || find;
  		
  		// give the compiler and the error handling to the plugin context
  		f.prototype._compiler  = compiler;
  		f.prototype._error     = error;
   
  		return new f();
  	}
  	
  	// returns the outer HTML of a node
  	function outerHTML(node){
  		// if IE, Chrome take the internal method otherwise build one
  		return node.outerHTML || (
  			function(n){
          		var div = document.createElement('div'), h;
  	        	div.appendChild( n.cloneNode(true) );
  				h = div.innerHTML;
  				div = null;
  				return h;
  			})(node);
  	}
  	
  	// returns the string generator function
  	function wrapquote(qfn, f){
  		return function(ctxt){
  			return qfn('' + f.call(ctxt.context, ctxt));
  		};
  	}
  
  	// default find using querySelector when available on the browser
  	function find(n, sel){
  		if(typeof n === 'string'){
  			sel = n;
  			n = false;
  		}
  		if(typeof document.querySelectorAll !== 'undefined'){
  			return (n||document).querySelectorAll( sel );
  		}else{
  			return error('You can test PURE standalone with: iPhone, FF3.5+, Safari4+ and IE8+\n\nTo run PURE on your browser, you need a JS library/framework with a CSS selector engine');
  		}
  	}
  	
  	// create a function that concatenates constant string
  	// sections (given in parts) and the results of called
  	// functions to fill in the gaps between parts (fns).
  	// fns[n] fills in the gap between parts[n-1] and parts[n];
  	// fns[0] is unused.
  	// this is the inner template evaluation loop.
  	function concatenator(parts, fns){
  		return function(ctxt){
  			var strs = [ parts[ 0 ] ],
  				n = parts.length,
  				fnVal, pVal, attLine, pos;
  
  			for(var i = 1; i < n; i++){
  				fnVal = fns[i].call( this, ctxt );
  				pVal = parts[i];
  				
  				// if the value is empty and attribute, remove it
  				if(fnVal === ''){
  					attLine = strs[ strs.length - 1 ];
  					if( ( pos = attLine.search( /[^\s]+=\"?$/ ) ) > -1){
  						strs[ strs.length - 1 ] = attLine.substring( 0, pos );
  						pVal = pVal.substr( 1 );
  					}
  				}
  				
  				strs[ strs.length ] = fnVal;
  				strs[ strs.length ] = pVal;
  			}
  			return strs.join('');
  		};
  	}
  
  	// parse and check the loop directive
  	function parseloopspec(p){
  		var m = p.match( /^(\w+)\s*<-\s*(\S+)?$/ );
  		if(m === null){
  			error('bad loop spec: "' + p + '"');
  		}
  		if(m[1] === 'item'){
  			error('"item<-..." is a reserved word for the current running iteration.\n\nPlease choose another name for your loop.');
  		}
  		if( !m[2] || (m[2] && (/context/i).test(m[2]))){ //undefined or space(IE) 
  			m[2] = function(ctxt){return ctxt.context;};
  		}
  		return {name: m[1], sel: m[2]};
  	}
  
  	// parse a data selector and return a function that
  	// can traverse the data accordingly, given a context.
  	function dataselectfn(sel){
  		if(typeof(sel) === 'function'){
  			return sel;
  		}
  		//check for a valid js variable name with hyphen(for properties only), $, _ and :
  		var m = sel.match(/^[a-zA-Z\$_\@][\w\$:-]*(\.[\w\$:-]*[^\.])*$/);
  		if(m === null){
  			var found = false, s = sel, parts = [], pfns = [], i = 0, retStr;
  			// check if literal
  			if(/\'|\"/.test( s.charAt(0) )){
  				if(/\'|\"/.test( s.charAt(s.length-1) )){
  					retStr = s.substring(1, s.length-1);
  					return function(){ return retStr; };
  				}
  			}else{
  				// check if literal + #{var}
  				while((m = s.match(/#\{([^{}]+)\}/)) !== null){
  					found = true;
  					parts[i++] = s.slice(0, m.index);
  					pfns[i] = dataselectfn(m[1]);
  					s = s.slice(m.index + m[0].length, s.length);
  				}
  			}
  			if(!found){
  				return function(){ return sel; };
  			}
  			parts[i] = s;
  			return concatenator(parts, pfns);
  		}
  		m = sel.split('.');
  		return function(ctxt){
  			var data = ctxt.context || ctxt,
  				v = ctxt[m[0]],
  				i = 0;
  			if(v && v.item){
  				i += 1;
  				if(m[i] === 'pos'){
  					//allow pos to be kept by string. Tx to Adam Freidin
  					return v.pos;
  				}else{
  					data = v.item;
  				}
  			}
  			var n = m.length;
  			for(; i < n; i++){
  				if(!data){break;}
  				data = data[m[i]];
  			}
  			return (!data && data !== 0) ? '':data;
  		};
  	}
  
  	// wrap in an object the target node/attr and their properties
  	function gettarget(dom, sel, isloop){
  		var osel, prepend, selector, attr, append, target = [];
  		if( typeof sel === 'string' ){
  			osel = sel;
  			var m = sel.match(selRx);
  			if( !m ){
  				error( 'bad selector syntax: ' + sel );
  			}
  			
  			prepend = m[1];
  			selector = m[2];
  			attr = m[3];
  			append = m[4];
  			
  			if(selector === '.' || ( !selector && attr ) ){
  				target[0] = dom;
  			}else{
  				target = plugins.find(dom, selector);
  			}
  			if(!target || target.length === 0){
  				return error('The node "' + sel + '" was not found in the template:\n' + outerHTML(dom).replace(/\t/g,'  '));
  			}
  		}else{
  			// autoRender node
  			prepend = sel.prepend;
  			attr = sel.attr;
  			append = sel.append;
  			target = [dom];
  		}
  		
  		if( prepend || append ){
  			if( prepend && append ){
  				error('append/prepend cannot take place at the same time');
  			}else if( isloop ){
  				error('no append/prepend/replace modifiers allowed for loop target');
  			}else if( append && isloop ){
  				error('cannot append with loop (sel: ' + osel + ')');
  			}
  		}
  		var setstr, getstr, quotefn, isStyle, isClass, attName, setfn;
  		if(attr){
  			isStyle = (/^style$/i).test(attr);
  			isClass = (/^class$/i).test(attr);
  			attName = isClass ? 'className' : attr;
  			setstr = function(node, s) {
  				node.setAttribute(attPfx + attr, s);
  				if (attName in node && !isStyle) {
  					node[attName] = '';
  				}
  				if (node.nodeType === 1) {
  					node.removeAttribute(attr);
  					isClass && node.removeAttribute(attName);
  				}
  			};
  			if (isStyle || isClass) {//IE no quotes special care
  				if(isStyle){
  					getstr = function(n){ return n.style.cssText; };
  				}else{
  					getstr = function(n){ return n.className;	};
  				}
  			}else {
  				getstr = function(n){ return n.getAttribute(attr); };
  			}
  			quotefn = function(s){ return s.replace(/\"/g, '&quot;'); };
  			if(prepend){
  				setfn = function(node, s){ setstr( node, s + getstr( node )); };
  			}else if(append){
  				setfn = function(node, s){ setstr( node, getstr( node ) + s); };
  			}else{
  				setfn = function(node, s){ setstr( node, s ); };
  			}
  		}else{
  			if (isloop) {
  				setfn = function(node, s) {
  					var pn = node.parentNode;
  					if (pn) {
  						//replace node with s
  						pn.insertBefore(document.createTextNode(s), node.nextSibling);
  						pn.removeChild(node);
  					}
  				};
  			} else {
  				if (prepend) {
  					setfn = function(node, s) { node.insertBefore(document.createTextNode(s), node.firstChild);	};
  				} else if (append) {
  					setfn = function(node, s) { node.appendChild(document.createTextNode(s));};
  				} else {
  					setfn = function(node, s) {
  						while (node.firstChild) { node.removeChild(node.firstChild); }
  						node.appendChild(document.createTextNode(s));
  					};
  				}
  			}
  			quotefn = function(s) { return s; };
  		}
  		return { attr: attr, nodes: target, set: setfn, sel: osel, quotefn: quotefn };
  	}
  
  	function setsig(target, n){
  		var sig = Sig + n + ':';
  		for(var i = 0; i < target.nodes.length; i++){
  			// could check for overlapping targets here.
  			target.set( target.nodes[i], sig );
  		}
  	}
  
  	// read de loop data, and pass it to the inner rendering function
  	function loopfn(name, dselect, inner, sorter, filter){
  		return function(ctxt){
  			var a = dselect(ctxt),
  				old = ctxt[name],
  				temp = { items : a },
  				filtered = 0,
  				length,
  				strs = [],
  				buildArg = function(idx, temp, ftr, len){
  					//keep the current loop. Tx to Adam Freidin
  					var save_pos = ctxt.pos,
  						save_item = ctxt.item,
  						save_items = ctxt.items;
  					ctxt.pos = temp.pos = idx;
  					ctxt.item = temp.item = a[ idx ];
  					ctxt.items = a;
  					//if array, set a length property - filtered items
  					typeof len !== 'undefined' &&  (ctxt.length = len);
  					//if filter directive
  					if(typeof ftr === 'function' && ftr.call(ctxt.item, ctxt) === false){
  						filtered++;
  						return;
  					}
  					strs.push( inner.call(ctxt.item, ctxt ) );
  					//restore the current loop
  					ctxt.pos = save_pos;
  					ctxt.item = save_item;
  					ctxt.items = save_items;
  				};
  			ctxt[name] = temp;
  			if( isArray(a) ){
  				length = a.length || 0;
  				// if sort directive
  				if(typeof sorter === 'function'){
  					a.sort(sorter);
  				}
  				//loop on array
  				for(var i = 0, ii = length; i < ii; i++){
  					buildArg(i, temp, filter, length - filtered);
  				}
  			}else{
  				if(a && typeof sorter !== 'undefined'){
  					error('sort is only available on arrays, not objects');
  				}
  				//loop on collections
  				for(var prop in a){
  					a.hasOwnProperty( prop ) && buildArg(prop, temp, filter);
  				}
  			}
  
  			typeof old !== 'undefined' ? ctxt[name] = old : delete ctxt[name];
  			return strs.join('');
  		};
  	}
  	// generate the template for a loop node
  	function loopgen(dom, sel, loop, fns){
  		var already = false, ls, sorter, filter, prop;
  		for(prop in loop){
  			if(loop.hasOwnProperty(prop)){
  				if(prop === 'sort'){
  					sorter = loop.sort;
  					continue;
  				}else if(prop === 'filter'){
  					filter = loop.filter;
  					continue;
  				}
  				if(already){
  					error('cannot have more than one loop on a target');
  				}
  				ls = prop;
  				already = true;
  			}
  		}
  		if(!ls){
  			error('Error in the selector: ' + sel + '\nA directive action must be a string, a function or a loop(<-)');
  		}
  		var dsel = loop[ls];
  		// if it's a simple data selector then we default to contents, not replacement.
  		if(typeof(dsel) === 'string' || typeof(dsel) === 'function'){
  			loop = {};
  			loop[ls] = {root: dsel};
  			return loopgen(dom, sel, loop, fns);
  		}
  		var spec = parseloopspec(ls),
  			itersel = dataselectfn(spec.sel),
  			target = gettarget(dom, sel, true),
  			nodes = target.nodes;
  			
  		for(i = 0; i < nodes.length; i++){
  			var node = nodes[i],
  				inner = compiler(node, dsel);
  			fns[fns.length] = wrapquote(target.quotefn, loopfn(spec.name, itersel, inner, sorter, filter));
  			target.nodes = [node];		// N.B. side effect on target.
  			setsig(target, fns.length - 1);
  		}
  		return target;
  	}
  	
  	function getAutoNodes(n, data){
  		var ns = n.getElementsByTagName('*'),
  			an = [],
  			openLoops = {a:[],l:{}},
  			cspec,
  			isNodeValue,
  			i, ii, j, jj, ni, cs, cj;
  		//for each node found in the template
  		for(i = -1, ii = ns.length; i < ii; i++){
  			ni = i > -1 ?ns[i]:n;
  			if(ni.nodeType === 1 && ni.className !== ''){
  				//when a className is found
  				cs = ni.className.split(' ');
  				// for each className 
  				for(j = 0, jj=cs.length;j<jj;j++){
  					cj = cs[j];
  					// check if it is related to a context property
  					cspec = checkClass(cj, ni.tagName);
  					// if so, store the node, plus the type of data
  					if(cspec !== false){
  						isNodeValue = (/nodevalue/i).test(cspec.attr);
  						if(cspec.sel.indexOf('@') > -1 || isNodeValue){
  							ni.className = ni.className.replace('@'+cspec.attr, '');
  							if(isNodeValue){
  								cspec.attr = false;
  							} 
  						}
  						an.push({n:ni, cspec:cspec});
  					}
  				}
  			}
  		}
  		
  		function checkClass(c, tagName){
  			// read the class
  			var ca = c.match(selRx),
  				attr = ca[3] || autoAttr[tagName],
  				cspec = {prepend:!!ca[1], prop:ca[2], attr:attr, append:!!ca[4], sel:c},
  				i, ii, loopi, loopil, val;
  			// check in existing open loops
  			for(i = openLoops.a.length-1; i >= 0; i--){
  				loopi = openLoops.a[i];
  				loopil = loopi.l[0];
  				val = loopil && loopil[cspec.prop];
  				if(typeof val !== 'undefined'){
  					cspec.prop = loopi.p + '.' + cspec.prop;
  					if(openLoops.l[cspec.prop] === true){
  						val = val[0];
  					}
  					break;
  				}
  			}
  			// not found check first level of data
  			if(typeof val === 'undefined'){
  				val = dataselectfn(cspec.prop)(isArray(data) ? data[0] : data);
  				// nothing found return
  				if(val === ''){
  					return false;
  				}
  			}
  			// set the spec for autoNode
  			if(isArray(val)){
  				openLoops.a.push( {l:val, p:cspec.prop} );
  				openLoops.l[cspec.prop] = true;
  				cspec.t = 'loop';
  			}else{
  				cspec.t = 'str';
  			}
  			return cspec;
  		}
  
  		return an;
  
  	}
  
  	// returns a function that, given a context argument,
  	// will render the template defined by dom and directive.
  	function compiler(dom, directive, data, ans){
  		var fns = [], j, jj, cspec, n, target, nodes, itersel, node, inner, dsel, sels, sel, sl, i, h, parts,  pfns = [], p;
  		// autoRendering nodes parsing -> auto-nodes
  		ans = ans || data && getAutoNodes(dom, data);
  		if(data){
  			// for each auto-nodes
  			while(ans.length > 0){
  				cspec = ans[0].cspec;
  				n = ans[0].n;
  				ans.splice(0, 1);
  				if(cspec.t === 'str'){
  					// if the target is a value
  					target = gettarget(n, cspec, false);
  					setsig(target, fns.length);
  					fns[fns.length] = wrapquote(target.quotefn, dataselectfn(cspec.prop));
  				}else{
  					// if the target is a loop
  					itersel = dataselectfn(cspec.sel);
  					target = gettarget(n, cspec, true);
  					nodes = target.nodes;
  					for(j = 0, jj = nodes.length; j < jj; j++){
  						node = nodes[j];
  						inner = compiler(node, false, data, ans);
  						fns[fns.length] = wrapquote(target.quotefn, loopfn(cspec.sel, itersel, inner));
  						target.nodes = [node];
  						setsig(target, fns.length - 1);
  					}
  				}
  			}
  		}
  		// read directives
  		for(sel in directive){
  			if(directive.hasOwnProperty(sel)){
  				i = 0;
  				dsel = directive[sel];
  				sels = sel.split(/\s*,\s*/); //allow selector separation by quotes
  				sl = sels.length;
  				do{
  					if(typeof(dsel) === 'function' || typeof(dsel) === 'string'){
  						// set the value for the node/attr
  						sel = sels[i];
  						target = gettarget(dom, sel, false);
  						setsig(target, fns.length);
  						fns[fns.length] = wrapquote(target.quotefn, dataselectfn(dsel));
  					}else{
  						// loop on node
  						loopgen(dom, sel, dsel, fns);
  					}
  				}while(++i < sl);
  			}
  		}
          // convert node to a string 
          h = outerHTML(dom);
  		// IE adds an unremovable "selected, value" attribute
  		// hard replace while waiting for a better solution
          h = h.replace(/<([^>]+)\s(value\=""|selected)\s?([^>]*)>/ig, "<$1 $3>");
  		
          // remove attribute prefix
          h = h.split(attPfx).join('');
  
  		// slice the html string at "Sig"
  		parts = h.split( Sig );
  		// for each slice add the return string of 
  		for(i = 1; i < parts.length; i++){
  			p = parts[i];
  			// part is of the form "fn-number:..." as placed there by setsig.
  			pfns[i] = fns[ parseInt(p, 10) ];
  			parts[i] = p.substring( p.indexOf(':') + 1 );
  		}
  		return concatenator(parts, pfns);
  	}
  	// compile the template with directive
  	// if a context is passed, the autoRendering is triggered automatically
  	// return a function waiting the data as argument
  	function compile(directive, ctxt, template){
  		var rfn = compiler( ( template || this[0] ).cloneNode(true), directive, ctxt);
  		return function(context){
  			return rfn({context:context});
  		};
  	}
  	//compile with the directive as argument
  	// run the template function on the context argument
  	// return an HTML string 
  	// should replace the template and return this
  	function render(ctxt, directive){
  		var fn = typeof directive === 'function' && directive, i = 0, ii = this.length;
  		for(; i < ii; i++){
  			this[i] = replaceWith( this[i], (fn || plugins.compile( directive, false, this[i] ))( ctxt, false ));
  		}
  		context = null;
  		return this;
  	}
  
  	// compile the template with autoRender
  	// run the template function on the context argument
  	// return an HTML string 
  	function autoRender(ctxt, directive){
  		var fn = plugins.compile( directive, ctxt, this[0] );
  		for(var i = 0, ii = this.length; i < ii; i++){
  			this[i] = replaceWith( this[i], fn( ctxt, false));
  		}
  		context = null;
  		return this;
  	}
  	
  	function replaceWith(elm, html) {
  		var ne,
  			ep = elm.parentNode,
  			depth = 0;
  		if(!ep){ //if no parents
  			ep = document.createElement('DIV');
  			ep.appendChild(elm);
  		}
  		switch (elm.tagName) {
  			case 'TBODY': case 'THEAD': case 'TFOOT':
  				html = '<TABLE>' + html + '</TABLE>';
  				depth = 1;
  			break;
  			case 'TR':
  				html = '<TABLE><TBODY>' + html + '</TBODY></TABLE>';
  				depth = 2;
  			break;
  			case 'TD': case 'TH':
  				html = '<TABLE><TBODY><TR>' + html + '</TR></TBODY></TABLE>';
  				depth = 3;
  			break;
  		}
  		tmp = document.createElement('SPAN');
  		tmp.style.display = 'none';
  		document.body.appendChild(tmp);
  		tmp.innerHTML = html;
  		ne = tmp.firstChild;
  		while (depth--) {
  			ne = ne.firstChild;
  		}
  		ep.insertBefore(ne, elm);
  		ep.removeChild(elm);
  		document.body.removeChild(tmp);
  		elm = ne;
  
  		ne = ep = null;
  		return elm;
  	}
  
  	return plugins;
  };
  
  $p.plugins = {};
  
  $p.libs = {
  	dojo:function(){
  		if(typeof document.querySelector === 'undefined'){
  			$p.plugins.find = function(n, sel){
  				return dojo.query(sel, n);
  			};
  		}
  	},
  	domassistant:function(){
  		if(typeof document.querySelector === 'undefined'){
  			$p.plugins.find = function(n, sel){
  				return $(n).cssSelect(sel);
  			};
  		}
  		DOMAssistant.attach({ 
  			publicMethods : [ 'compile', 'render', 'autoRender'],
  			compile:function(directive, ctxt){
  				return $p([this]).compile(directive, ctxt);
  			},
  			render:function(ctxt, directive){
  				return $( $p([this]).render(ctxt, directive) )[0];
  			},
  			autoRender:function(ctxt, directive){
  				return $( $p([this]).autoRender(ctxt, directive) )[0];
  			}
  		});
  	},
  	jquery:function(){
  		if(typeof document.querySelector === 'undefined'){
  			$p.plugins.find = function(n, sel){
  				return jQuery(n).find(sel);
  			};
  		}
  		jQuery.fn.extend({
  			directives:function(directive){
  				this._pure_d = directive; return this;
  			},
  			compile:function(directive, ctxt){
  				return $p(this).compile(this._pure_d || directive, ctxt);
  			},
  			render:function(ctxt, directive){
  				return jQuery( $p( this ).render( ctxt, this._pure_d || directive ) );
  			},
  			autoRender:function(ctxt, directive){
  				return jQuery( $p( this ).autoRender( ctxt, this._pure_d || directive ) );
  			}
  		});
  	},
  	mootools:function(){
  		if(typeof document.querySelector === 'undefined'){
  			$p.plugins.find = function(n, sel){
  				return $(n).getElements(sel);
  			};
  		}
  		Element.implement({
  			compile:function(directive, ctxt){ 
  				return $p(this).compile(directive, ctxt);
  			},
  			render:function(ctxt, directive){
  				return $p([this]).render(ctxt, directive);
  			},
  			autoRender:function(ctxt, directive){
  				return $p([this]).autoRender(ctxt, directive);
  			}
  		});
  	},
  	prototype:function(){
  		if(typeof document.querySelector === 'undefined'){
  			$p.plugins.find = function(n, sel){
  				n = n === document ? n.body : n;
  				return typeof n === 'string' ? $$(n) : $(n).select(sel);
  			};
  		}
  		Element.addMethods({
  			compile:function(element, directive, ctxt){ 
  				return $p([element]).compile(directive, ctxt);
  			}, 
  			render:function(element, ctxt, directive){
  				return $p([element]).render(ctxt, directive);
  			}, 
  			autoRender:function(element, ctxt, directive){
  				return $p([element]).autoRender(ctxt, directive);
  			}
  		});
  	},
  	sizzle:function(){
  		if(typeof document.querySelector === 'undefined'){
  			$p.plugins.find = function(n, sel){
  				return Sizzle(sel, n);
  			};
  		}
  	},
  	sly:function(){
  		if(typeof document.querySelector === 'undefined'){  
  			$p.plugins.find = function(n, sel){
  				return Sly(sel, n);
  			};
  		}
  	}
  };
  
  // get lib specifics if available
  (function(){
  	var libkey = 
  		typeof dojo         !== 'undefined' && 'dojo' || 
  		typeof DOMAssistant !== 'undefined' && 'domassistant' ||
  		typeof jQuery       !== 'undefined' && 'jquery' || 
  		typeof MooTools     !== 'undefined' && 'mootools' ||
  		typeof Prototype    !== 'undefined' && 'prototype' || 
  		typeof Sizzle       !== 'undefined' && 'sizzle' ||
  		typeof Sly          !== 'undefined' && 'sly';
  		
  	libkey && $p.libs[libkey]();
  	
  	//for node.js
  	if(typeof exports !== 'undefined'){
  		exports.$p = $p;
  	}
  })();

  provide("pure", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    var MAX_INT = Math.pow(2,52);
  
    function isFuture(obj) {
      return obj instanceof future;
    }
  
    function futureTimeout(time) {
      this.name = "FutureTimeout";
      this.message = "timeout " + time + "ms";
    }
  
  
  
    function future(global_context) {
      var everytimers = {},
        onetimers = {},
        index = 0,
        deliveries = 0,
        time = 0,
        fulfilled,
        data,
        timeout_id,
        //asap = false,
        asap =  true,
        passenger,
        self = this;
  
      // TODO change `null` to `this`
      global_context = ('undefined' === typeof global_context ? null : global_context);
  
  
      function resetTimeout() {
        if (timeout_id) {
          clearTimeout(timeout_id);
          timeout_id = undefined;
        }
  
        if (time > 0) {
          timeout_id = setTimeout(function () {
            self.deliver(new futureTimeout(time));
            timeout_id = undefined;
          }, time);
        }
      }
  
  
  
      self.isFuture = isFuture;
  
      self.setContext = function (context) {
        global_context = context;
      };
  
      self.setTimeout = function (new_time) {
        time = new_time;
        resetTimeout();
      };
  
  
  
      self.errback = function () {
        if (arguments.length < 2) {
          self.deliver.call(self, arguments[0] || new Error("`errback` called without Error"));
        } else {
          self.deliver.apply(self, arguments);
        }
      };
  
  
  
      self.callback = function () {
        var args = Array.prototype.slice.call(arguments);
  
        args.unshift(undefined);
        self.deliver.apply(self, args);
      };
  
  
  
      self.callbackCount = function() {
        return Object.keys(everytimers).length;
      };
  
  
  
      self.deliveryCount = function() {
        return deliveries;
      };
  
  
  
      self.setAsap = function(new_asap) {
        if (undefined === new_asap) {
          new_asap = true;
        }
        if (true !== new_asap && false !== new_asap) {
          throw new Error("Future.setAsap(asap) accepts literal true or false, not " + new_asap);
        }
        asap = new_asap;
      };
  
  
  
      // this will probably never get called and, hence, is not yet well tested
      function cleanup() {
        var new_everytimers = {},
          new_onetimers = {};
  
        index = 0;
        Object.keys(everytimers).forEach(function (id) {
          var newtimer = new_everytimers[index] = everytimers[id];
  
          if (onetimers[id]) {
            new_onetimers[index] = true;
          }
  
          newtimer.id = index;
          index += 1;
        });
  
        onetimers = new_onetimers;
        everytimers = new_everytimers;
      }
  
  
  
      function findCallback(callback, context) {
        var result;
        Object.keys(everytimers).forEach(function (id) {
          var everytimer = everytimers[id];
          if (callback === everytimer.callback) {
            if (context === everytimer.context || everytimer.context === global_context) {
              result = everytimer;
            }
          }
        });
        return result;
      }
  
  
  
      self.hasCallback = function () {
        return !!findCallback.apply(self, arguments);
      };
  
  
  
      self.removeCallback = function(callback, context) {
        var everytimer = findCallback(callback, context);
        if (everytimer) {
          delete everytimers[everytimer.id];
          onetimers[everytimer.id] = undefined;
          delete onetimers[everytimer.id];
        }
  
        return self;
      };
  
  
  
      self.deliver = function() {
        if (fulfilled) {
          throw new Error("`Future().fulfill(err, data, ...)` renders future deliveries useless");
        }
        var args = Array.prototype.slice.call(arguments);
        data = args;
  
        deliveries += 1; // Eventually reaches `Infinity`...
  
        Object.keys(everytimers).forEach(function (id) {
          var everytimer = everytimers[id],
            callback = everytimer.callback,
            context = everytimer.context;
  
          if (onetimers[id]) {
            delete everytimers[id];
            delete onetimers[id];
          }
  
          // TODO
          callback.apply(context, args);
          /*
          callback.apply(('undefined' !== context ? context : newme), args);
          context = newme;
          context = ('undefined' !== global_context ? global_context : context)
          context = ('undefined' !== local_context ? local_context : context)
          */
        });
  
        if (args[0] && "FutureTimeout" !== args[0].name) {
          resetTimeout();
        }
  
        return self;
      };
  
  
  
      self.fulfill = function () {
        if (arguments.length) {
          self.deliver.apply(self, arguments);
        } else {
          self.deliver();
        }
        fulfilled = true;
      };
  
  
  
      self.whenever = function (callback, local_context) {
        var id = index,
          everytimer;
  
        if ('function' !== typeof callback) {
          throw new Error("Future().whenever(callback, [context]): callback must be a function.");
        }
  
        if (findCallback(callback, local_context)) {
          // TODO log
          throw new Error("Future().everytimers is a strict set. Cannot add already subscribed `callback, [context]`.");
          return;
        }
  
        everytimer = everytimers[id] = {
          id: id,
          callback: callback,
          context: (null === local_context) ? null : (local_context || global_context)
        };
  
        if (asap && deliveries > 0) {
          // doesn't raise deliver count on purpose
          everytimer.callback.apply(everytimer.context, data);
          if (onetimers[id]) {
            delete onetimers[id];
            delete everytimers[id];
          }
        }
  
        index += 1;
        if (index >= MAX_INT) {
          cleanup(); // Works even for long-running processes
        }
  
        return self;
      };
  
  
  
      self.when = function (callback, local_context) {
        // this index will be the id of the everytimer
        onetimers[index] = true;
        self.whenever(callback, local_context);
  
        return self;
      };
  
  
      //
      function privatize(obj, pubs) {
        var result = {};
        pubs.forEach(function (pub) {
          result[pub] = function () {
            obj[pub].apply(obj, arguments);
            return result;
          };
        });
        return result;
      }
  
      passenger = privatize(self, [
        "when",
        "whenever"
      ]);
  
      self.passable = function () {
        return passenger;
      };
  
    }
  
    function Future(context) {
      // TODO use prototype instead of new
      return (new future(context));
    }
  
    Future.isFuture = isFuture;
    module.exports = Future;
  }());
  

  provide("future", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    var Future = require('future');
  
    function asyncify(doStuffSync, context) {
      var future = Future(),
        passenger = future.passable();
  
      future.setAsap(false);
  
      function doStuff() {
        var self = ('undefined' !== typeof context ? context : this),
          err,
          data;
  
        future.setContext(self);
  
        try {
          data = doStuffSync.apply(self, arguments);
        } catch(e) {
          err = e;
        }
  
        future.deliver(err, data);
  
        return passenger;
      }
  
      doStuff.when = passenger.when;
      doStuff.whenever = passenger.whenever;
  
      return doStuff;
    }
  
    module.exports = asyncify;
  }());
  

  provide("asyncify", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    function isSequence(obj) {
      return obj instanceof sequence;
    }
  
    function sequence(global_context) {
      var self = this,
        waiting = true,
        data,
        stack = [];
  
      global_context = global_context || null;
  
      function next() {
        var args = Array.prototype.slice.call(arguments),
          seq = stack.shift(); // BUG this will eventually leak
  
        data = arguments;
  
        if (!seq) {
          // the chain has ended (for now)
          waiting = true;
          return;
        }
  
        args.unshift(next);
        seq.callback.apply(seq.context, args);
      }
  
      function then(callback, context) {
        if ('function' !== typeof callback) {
          throw new Error("`Sequence().then(callback [context])` requires that `callback` be a function and that `context` be `null`, an object, or a function");
        }
        stack.push({
          callback: callback,
          context: (null === context ? null : context || global_context),
          index: stack.length
        });
  
        // if the chain has stopped, start it back up
        if (waiting) {
          waiting = false;
          next.apply(null, data);
        }
  
        return self;
      }
  
      self.next = next;
      self.then = then;
    }
  
    function Sequence(context) {
      // TODO use prototype instead of new
      return (new sequence(context));
    }
    Sequence.isSequence = isSequence;
    module.exports = Sequence;
  }());
  

  provide("sequence", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    var Future = require('future'),
      Sequence = require('sequence');
  
    // This is being saved in case I later decide to require future-functions
    // rather than always passing `next`
    function handleResult(next, result) {
      // Do wait up; assume that any return value has a callback
      if ('undefined' !== typeof result) {
        if ('function' === typeof result.when) {
          result.when(next);
        } else if ('function' === typeof result) {
          result(next);
        } else {
          next(result);
        }
      }
    }
  
    /**
     * Async Method Queing
     */
    function Chainify(providers, modifiers, consumers, context, params) {
      var Model = {};
  
      if ('undefined' === typeof context) {
        context = null;
      }
  
      /**
       * Create a method from a consumer
       * These may be promisable (validate e-mail addresses by sending an e-mail)
       * or return synchronously (selecting a random number of friends from contacts)
       */
      function methodify(provider, sequence) {
        var methods = {};
  
        function chainify_one(callback, is_consumer) {
          return function () {
            var params = Array.prototype.slice.call(arguments);
  
            sequence.then(function() {
              var args = Array.prototype.slice.call(arguments)
                , args_params = []
                , next = args.shift();
  
              args.forEach(function (arg) {
                args_params.push(arg);
              });
              params.forEach(function (param) {
                args_params.push(param);
              });
              params = undefined;
  
              if (is_consumer) {
                // Don't wait up, just keep on truckin'
                callback.apply(context, args_params);
                next.apply(null, args);
              } else {
                // Do wait up
                args_params.unshift(next);
                callback.apply(context, args_params);
              }
  
              // or
              // handleResult(next, result)
            });
            return methods;
          };
        }
  
        Object.keys(modifiers).forEach(function (key) {
          methods[key] = chainify_one(modifiers[key]);
        });
  
        Object.keys(consumers).forEach(function (key) {
          methods[key] = chainify_one(consumers[key], true);
        });
  
        return methods;
      }
  
      /**
       * A model might be something such as Contacts
       * The providers might be methods such as:
       * all(), one(id), some(ids), search(key, params), search(func), scrape(template)
       */
      function chainify(provider, key) {
        return function () {
          var args = Array.prototype.slice.call(arguments),
            future = Future(),
            sequence = Sequence();
  
          // provide a `next`
          args.unshift(future.deliver);
          provider.apply(context, args);
  
          sequence.then(future.when);
  
          return methodify(providers[key], sequence);
        };
      }
  
      Object.keys(providers).forEach(function (key) {
        Model[key] = chainify(providers[key], key);
      });
  
      return Model;
    }
  
    module.exports = Chainify;
  }());
  

  provide("chainify", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  if ('undefined' === typeof process) {
    process = {};
  }
  (function () {
    "use strict";
  
    process.EventEmitter = process.EventEmitter || function () {};
  
  // Copyright Joyent, Inc. and other Node contributors.
  //
  // Permission is hereby granted, free of charge, to any person obtaining a
  // copy of this software and associated documentation files (the
  // "Software"), to deal in the Software without restriction, including
  // without limitation the rights to use, copy, modify, merge, publish,
  // distribute, sublicense, and/or sell copies of the Software, and to permit
  // persons to whom the Software is furnished to do so, subject to the
  // following conditions:
  //
  // The above copyright notice and this permission notice shall be included
  // in all copies or substantial portions of the Software.
  //
  // THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
  // OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  // MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
  // NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
  // DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
  // OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
  // USE OR OTHER DEALINGS IN THE SOFTWARE.
  
  var EventEmitter = exports.EventEmitter = process.EventEmitter;
  var isArray = Array.isArray;
  
  // By default EventEmitters will print a warning if more than
  // 10 listeners are added to it. This is a useful default which
  // helps finding memory leaks.
  //
  // Obviously not all Emitters should be limited to 10. This function allows
  // that to be increased. Set to zero for unlimited.
  var defaultMaxListeners = 10;
  EventEmitter.prototype.setMaxListeners = function(n) {
    if (!this._events) this._events = {};
    this._events.maxListeners = n;
  };
  
  
  EventEmitter.prototype.emit = function(type) {
    // If there is no 'error' event listener then throw.
    if (type === 'error') {
      if (!this._events || !this._events.error ||
          (isArray(this._events.error) && !this._events.error.length))
      {
        if (arguments[1] instanceof Error) {
          throw arguments[1]; // Unhandled 'error' event
        } else {
          throw new Error("Uncaught, unspecified 'error' event.");
        }
        return false;
      }
    }
  
    if (!this._events) return false;
    var handler = this._events[type];
    if (!handler) return false;
  
    if (typeof handler == 'function') {
      switch (arguments.length) {
        // fast cases
        case 1:
          handler.call(this);
          break;
        case 2:
          handler.call(this, arguments[1]);
          break;
        case 3:
          handler.call(this, arguments[1], arguments[2]);
          break;
        // slower
        default:
          var args = Array.prototype.slice.call(arguments, 1);
          handler.apply(this, args);
      }
      return true;
  
    } else if (isArray(handler)) {
      var args = Array.prototype.slice.call(arguments, 1);
  
      var listeners = handler.slice();
      for (var i = 0, l = listeners.length; i < l; i++) {
        listeners[i].apply(this, args);
      }
      return true;
  
    } else {
      return false;
    }
  };
  
  // EventEmitter is defined in src/node_events.cc
  // EventEmitter.prototype.emit() is also defined there.
  EventEmitter.prototype.addListener = function(type, listener) {
    if ('function' !== typeof listener) {
      throw new Error('addListener only takes instances of Function');
    }
  
    if (!this._events) this._events = {};
  
    // To avoid recursion in the case that type == "newListeners"! Before
    // adding it to the listeners, first emit "newListeners".
    this.emit('newListener', type, listener);
  
    if (!this._events[type]) {
      // Optimize the case of one listener. Don't need the extra array object.
      this._events[type] = listener;
    } else if (isArray(this._events[type])) {
  
      // If we've already got an array, just append.
      this._events[type].push(listener);
  
      // Check for listener leak
      if (!this._events[type].warned) {
        var m;
        if (this._events.maxListeners !== undefined) {
          m = this._events.maxListeners;
        } else {
          m = defaultMaxListeners;
        }
  
        if (m && m > 0 && this._events[type].length > m) {
          this._events[type].warned = true;
          console.error('(node) warning: possible EventEmitter memory ' +
                        'leak detected. %d listeners added. ' +
                        'Use emitter.setMaxListeners() to increase limit.',
                        this._events[type].length);
          console.trace();
        }
      }
    } else {
      // Adding the second element, need to change to array.
      this._events[type] = [this._events[type], listener];
    }
  
    return this;
  };
  
  EventEmitter.prototype.on = EventEmitter.prototype.addListener;
  
  EventEmitter.prototype.once = function(type, listener) {
    var self = this;
    function g() {
      self.removeListener(type, g);
      listener.apply(this, arguments);
    };
  
    g.listener = listener;
    self.on(type, g);
  
    return this;
  };
  
  EventEmitter.prototype.removeListener = function(type, listener) {
    if ('function' !== typeof listener) {
      throw new Error('removeListener only takes instances of Function');
    }
  
    // does not use listeners(), so no side effect of creating _events[type]
    if (!this._events || !this._events[type]) return this;
  
    var list = this._events[type];
  
    if (isArray(list)) {
      var position = -1;
      for (var i = 0, length = list.length; i < length; i++) {
        if (list[i] === listener ||
            (list[i].listener && list[i].listener === listener))
        {
          position = i;
          break;
        }
      }
  
      if (position < 0) return this;
      list.splice(position, 1);
      if (list.length == 0)
        delete this._events[type];
    } else if (list === listener ||
               (list.listener && list.listener === listener))
    {
      delete this._events[type];
    }
  
    return this;
  };
  
  EventEmitter.prototype.removeAllListeners = function(type) {
    // does not use listeners(), so no side effect of creating _events[type]
    if (type && this._events && this._events[type]) this._events[type] = null;
    return this;
  };
  
  EventEmitter.prototype.listeners = function(type) {
    if (!this._events) this._events = {};
    if (!this._events[type]) this._events[type] = [];
    if (!isArray(this._events[type])) {
      this._events[type] = [this._events[type]];
    }
    return this._events[type];
  };
  
  }());
  

  provide("events.node", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    var Sequence = require('sequence');
  
    function forEachAsync(arr, callback) {
      var sequence = Sequence();
  
      function handleItem(item, i, arr) {
        sequence.then(function (next) {
          callback(next, item, i, arr);
        });
      }
  
      arr.forEach(handleItem);
  
      return sequence;
    }
  
    module.exports = forEachAsync;
  }());
  

  provide("forEachAsync", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    var Future = require('future');
  
    function isJoin(obj) {
      return obj instanceof join;
    }
  
    function join(global_context) {
      var self = this,
        data = [],
        ready = [],
        subs = [],
        promise_only = false,
        begun = false,
        updated = 0,
        join_future = Future(global_context);
  
      global_context = global_context || null;
  
      function relay() {
        var i;
        if (!begun || updated !== data.length) {
          return;
        }
        updated = 0;
        join_future.deliver.apply(join_future, data);
        data = Array(data.length);
        ready = Array(ready.length);
        //for (i = 0; i < data.length; i += 1) {
        //  data[i] = undefined;
        //}
      }
  
      function init() {
        var type = (promise_only ? "when" : "whenever");
  
        begun = true;
        data = Array(subs.length);
        ready = Array(subs.length);
  
        subs.forEach(function (sub, id) {
          sub[type](function () {
            var args = Array.prototype.slice.call(arguments);
            data[id] = args;
            if (!ready[id]) {
              ready[id] = true;
              updated += 1;
            }
            relay();
          });
        });
      }
  
      self.deliverer = function () {
        var future = Future();
        self.add(future);
        return future.deliver;
      };
      self.newCallback = self.deliverer;
  
      self.when = function () {
        if (!begun) {
          init();
        }
        join_future.when.apply(join_future, arguments);
      };
  
      self.whenever = function () {
        if (!begun) {
          init();
        }
        join_future.whenever.apply(join_future, arguments);
      };
  
      self.add = function () {
        if (begun) {
          throw new Error("`Join().add(Array<future> | subs1, [subs2, ...])` requires that all additions be completed before the first `when()` or `whenever()`");
        }
        var args = Array.prototype.slice.call(arguments);
        if (0 === args.length) {
          return self.newCallback();
        }
        args = Array.isArray(args[0]) ? args[0] : args;
        args.forEach(function (sub) {
          if (!sub.whenever) {
            promise_only = true;
          }
          if (!sub.when) {
            throw new Error("`Join().add(future)` requires either a promise or future");
          }
          subs.push(sub);
        });
      };
    }
  
    function Join(context) {
      // TODO use prototype instead of new
      return (new join(context));
    }
    Join.isJoin = isJoin;
    module.exports = Join;
  }());
  

  provide("join", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  (function () {
    "use strict";
  
    var Future = require('future');
  
    function MaxCountReached(max_loops) {
        this.name = "MaxCountReached";
        this.message = "Loop looped " + max_loops + " times";
    }
  
    function timestamp() {
      return (new Date()).valueOf();
    }
  
    function loop(context) {
      var self = this,
        future = Future(),
        min_wait = 0,
        count = 0,
        max_loops = 0,
        latest,
        time,
        timed_out,
        timeout_id,
        data,
        callback;
  
      self.setMaxLoop = function (new_max) {
        max_loops = new_max;
        return self;
      };
  
  
  
      self.setWait = function (new_wait) {
        min_wait = new_wait;
        return self;
      };
  
  
  
      self.setTimeout = function (new_time) {
        if (time) {
          throw new Error("Can't set timeout, the loop has already begun!");
        }
        time = new_time;
        var timeout_id = setTimeout(function () {
          timed_out = true;
          future.deliver(new Error("LoopTimeout"));
        }, time);
  
        future.when(function () {
          clearTimeout(timeout_id);
        });
        return self;
      };
  
  
  
      function runAgain() {
        var wait = Math.max(min_wait - (timestamp() - latest), 0);
        if (isNaN(wait)) {
          wait = min_wait;
        }
  
        if (timed_out) {
          return;
        }
        if (max_loops && count >= max_loops) {
          future.deliver(new MaxCountReached(max_loops));
          return;
        }
  
        data.unshift(next);
        setTimeout(function () {
          latest = timestamp();
          try {
            callback.apply(context, data);
            count += 1;
          } catch(e) {
            throw e;
          }
        }, wait);
      }
  
  
  
      function next() {
        // dirty hack to turn arguments object into an array
        data = Array.prototype.slice.call(arguments);
        if ("break" === data[0]) {
          data.shift();
          future.deliver.apply(future, data);
          return;
        }
        runAgain();
      }
  
  
  
      self.run = function (doStuff) {
        // dirty hack to turn arguments object into an array
        data = Array.prototype.slice.call(arguments);
        callback = doStuff;
        data[0] = undefined;
        next.apply(self, data);
        return self;
      };
  
  
  
      self.when = future.when;
      self.whenever = future.whenever;
  
    }
  
  
  
    function Loop(context) {
      // TODO use prototype instead of new
      return (new loop(context));
    }
    module.exports = Loop;
  }());
  

  provide("loop", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint browser: true, devel: true, debug: true, es5: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
  (function () {
    "use strict";
  
    var modulepath;
  
    function upgradeMessage() {
      var msg = "You have upgraded to Futures 2.x. See http://github.com/coolaj86/futures for details.";
      console.log(msg);
      throw new Error(msg);
    }
  
    module.exports = {
      promise: upgradeMessage,
      subscription: upgradeMessage,
      synchronize: upgradeMessage,
      whilst: upgradeMessage,
      future: require('future'),
      forEachAsync: require('forEachAsync'),
      sequence: require('sequence'),
      join: require('join'),
      asyncify: require('asyncify'),
      loop: require('loop'),
      chainify: require('chainify')
    };
  }());
  

  provide("futures", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint white: false, onevar: true, undef: true, node: true, nomen: true, regexp: false, plusplus: true, bitwise: true, es5: true, newcap: true, maxerr: 5 */
  (function () {
    "use strict";
  
    var utils = exports
      , jsonpRegEx = /\s*([\$\w]+)\s*\(\s*(.*)\s*\)\s*/;
  
    utils.clone = function (obj) {
      return JSON.parse(JSON.stringify(obj));
    };
  
    // useful for extending global options onto a local variable
    utils.extend = function (global, local) {
      //global = utils.clone(global);
      Object.keys(local).forEach(function (key) {
        global[key] = local[key] || global[key];
      });
      return global;
    };
  
    // useful for extending global options onto a local variable
    utils.preset = function (local, global) {
      // TODO copy functions
      // TODO recurse / deep copy
      global = utils.clone(global);
      Object.keys(global).forEach(function (key) {
        if ('undefined' === typeof local[key]) {
          local[key] = global[key];
        }
      });
      return local;
    };
  
    utils.objectToLowerCase = function (obj, recurse) {
      // Make headers all lower-case
      Object.keys(obj).forEach(function (key) {
        var value;
  
        value = obj[key];
        delete obj[key];
        if ('string' === typeof value) {
          obj[key.toLowerCase()] = value.toLowerCase();
        }
      });
      return obj;
    };
  
    utils.parseJsonp = function (jsonpCallback, jsonp) {
      var match = jsonp.match(jsonpRegEx)
        , data
        , json;
  
      if (!match || !match[1] || !match[2]) {
        throw new Error('No JSONP matched');
      }
      if (jsonpCallback !== match[1]) {
        throw new Error('JSONP callback doesn\'t match');
      }
      json = match[2];
  
      data = JSON.parse(json);
      return data;
    };
  
    utils.uriEncodeObject = function(json) {
      var query = '';
  
      try {
        JSON.parse(JSON.stringify(json));
      } catch(e) {
        return 'ERR_CYCLIC_DATA_STRUCTURE';
      }
  
      if ('object' !== typeof json) {
        return 'ERR_NOT_AN_OBJECT';
      }
  
      Object.keys(json).forEach(function (key) {
        var param, value;
  
        // assume that the user meant to delete this element
        if ('undefined' === typeof json[key]) {
          return;
        }
  
        param = encodeURIComponent(key);
        value = encodeURIComponent(json[key]);
        query += '&' + param;
  
        // assume that the user wants just the param name sent
        if (null !== json[key]) {
          query += '=' + value;
        }
      });
  
      // remove first '&'
      return query.substring(1);
    };
  
    utils.addParamsToUri = function(uri, params) {
      var query
        , anchor = ''
        , anchorpos;
  
      uri = uri || "";
      anchor = '';
      params = params || {};
  
      // just in case this gets used client-side
      if (-1 !== (anchorpos = uri.indexOf('#'))) {
        anchor = uri.substr(anchorpos);
        uri = uri.substr(0, anchorpos);
      }
  
      query = utils.uriEncodeObject(params);
  
      // cut the leading '&' if no other params have been written
      if (query.length > 0) {
        if (!uri.match(/\?/)) {
          uri += '?' + query;
        } else {
          uri += '&' + query;
        }
      }
  
      return uri + anchor;
    };
  }());
  

  provide("ahr.utils", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint devel: true, debug: true, es5: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
  (function () {
    "use strict";
  
    var globalOptions
      , ahrOptions = exports
      , url = require('url')
      , File = require('File')
      , FileList = require('FileList')
      , FormData = require('FormData')
      , utils = require('ahr.utils')
      , location
      , uriEncodeObject
      , clone
      , preset
      , objectToLowerCase
      ;
  
    try {
      location = require('./location');
    } catch(e) {
      location = require('location');
    }
  
    uriEncodeObject = utils.uriEncodeObject;
    clone = utils.clone;
    preset = utils.preset;
    objectToLowerCase = utils.objectToLowerCase;
  
    globalOptions = {
      port: 80,
      host: 'localhost',
      ssl: false,
      protocol: 'file:',
      method: 'GET',
      headers: {
        //'accept': "application/json; charset=utf-8, */*; q=0.5"
      },
      pathname: '/',
      search: '',
      redirectCount: 0,
      redirectCountMax: 5,
      query: {},
      // contentType: 'json',
      // accept: 'json',
      followRedirect: true,
      timeout: 20000
    };
  
  
    //
    // Manage global options while keeping state safe
    //
    ahrOptions.globalOptionKeys = function () {
      return Object.keys(globalOptions);
    };
  
    ahrOptions.globalOption = function (key, val) {
      if ('undefined' === typeof val) {
        return globalOptions[key];
      }
      if (null === val) {
        val = undefined;
      }
      globalOptions[key] = val;
    };
  
    ahrOptions.setGlobalOptions = function (bag) {
      Object.keys(bag).forEach(function (key) {
        globalOptions[key] = bag[key];
      });
    };
  
  
    /*
     * About the HTTP spec and which methods allow bodies, etc:
     * http://stackoverflow.com/questions/299628/is-an-entity-body-allowed-for-an-http-delete-request
     */
    function checkBodyAllowed(options) {
      var method = options.method.toUpperCase();
      if ('HEAD' !== method && 'GET' !== method && 'DELETE' !== method && 'OPTIONS' !== method) {
        return true;
      }
      if (options.body && !options.forceAllowBody) {
        throw new Error("The de facto standard is that '" + method + "' should not have a body.\n" +
          "Most web servers just ignore it. Please use 'query' rather than 'body'.\n" +
          "Also, you may consider filing this as a bug - please give an explanation.\n" +
          "Finally, you may allow this by passing { forceAllowBody: 'true' } ");
      }
      if (options.body && options.jsonp) {
        throw new Error("The de facto standard is that 'jsonp' should not have a body (and I don't see how it could have one anyway).\n" +
          "If you consider filing this as a bug please give an explanation.");
      }
    }
  
  
    /*
      Node.js
  
      > var url = require('url');
      > var urlstring = 'http://user:pass@host.com:8080/p/a/t/h?query=string#hash';
      > url.parse(urlstring, true);
      { href: 'http://user:pass@host.com:8080/p/a/t/h?query=string#hash',
        protocol: 'http:',
        host: 'user:pass@host.com:8080',
        auth: 'user:pass',
        hostname: 'host.com',
        port: '8080',
        pathname: '/p/a/t/h',
        search: '?query=string',
        hash: '#hash',
  
        slashes: true,
        query: {'query':'string'} } // 'query=string'
    */
  
    /*
      Browser
  
        href: "http://user:pass@host.com:8080/p/a/t/h?query=string#hash"
        protocol: "http:" 
        host: "host.com:8080"
        hostname: "host.com"
        port: "8080"
        pathname: "/p/a/t/h"
        search: '?query=string',
        hash: "#hash"
  
        origin: "http://host.com:8080"
     */
  
    function parseAuth(options) {
      var auth = options.auth
        , username
        , password;
  
      if (auth) {
        username = auth.split(':')[0] || "";
        password = auth.split(':')[1] || "";
      }
  
      preset(options, {
        username: username,
        password: password
      });
  
      return options;
    }
  
    function parseHost(options) {
      var auth
        , host = options.host
        , port
        , hostname
        , username
        , password;
  
      if (!host) {
        return options;
      }
      if (/@/.test(host)) {
        auth = host.substr(0, '@');
        host = host.substr('@' + 1);
        if (auth) {
          username = auth.split(':')[0] || "";
          password = auth.split(':')[1] || "";
        }
      }
      if (/:/.test(host)) {
        port = host.substr(0, ':');
        hostname = host.substr(':' + 1);
      }
  
      preset(options, {
        username: username,
        password: password,
        hostname: hostname,
        port: port
      });
  
      return options;
    }
  
    // href should be parsed if present
    function parseHref(options) {
      var urlObj;
  
      if (!options.href) {
        return options;
      }
      if (-1 === options.href.indexOf('://')) {
        options.href = url.resolve(location.href, options.href);
      }
      urlObj = url.parse(options.href || "", true);
  
      preset(options, urlObj);
  
      return options;
    }
  
    function handleUri(options) {
      var presets;
  
      presets = clone(globalOptions);
  
      if (!options) {
        throw new Error('ARe yOu kiddiNg me? You have to provide some sort of options');
      }
  
      if (options.uri || options.url) {
        console.log('Use `options.href`. `options.url` and `options.uri` are obsolete');
      }
      if (options.params) {
        console.log('Use `options.query`. `options.params` is obsolete');
      }
  
      if ('string' === typeof options) {
        options = {
          href: options
        };
      }
  
      options.syncback = options.syncback || function () {};
  
      // Use SSL if desired
      if ('https:' === options.protocol || '443' === options.port || true === options.ssl) {
        presets.ssl = true;
        presets.port = '443';
        presets.protocol = 'https:';
        // hopefully no one would set prt 443 to standard http
        options.protocol = 'https:';
      }
  
      if ('tcp:' === options.protocol || 'tcps:' === options.protocol || 'udp:' === options.protocol) {
        options.method = options.method || 'POST';
      }
  
      options.href = options.href || options.uri || options.url;
      options.query = options.query || options.params || {};
  
      if (options.jsonp) {
        // i.e. /path/to/res?x=y&jsoncallback=jsonp8765
        // i.e. /path/to/res?x=y&json=jsonp_ae75f
        options.jsonpCallback = 'jsonp_' + (new Date()).valueOf();
        options.dataType = 'jsonp';
        options.query[options.jsonp] = options.jsonpCallback;
      }
  
      // TODO auth or username and password
      parseAuth(options);
      // TODO host or auth, hostname, and port
      parseHost(options);
      // TODO href and query; or host
      parseHref(options);
      options.href = url.format(options);
  
      preset(options, presets);
  
      return options;
    }
  
    function handleHeaders(options) {
      var presets;
  
      presets = clone(globalOptions);
  
      options.headers = options.headers || {};
      if (options.jsonp) {
        options.headers.accept = "text/javascript";
      }
      // TODO user-agent should retain case
      options.headers = objectToLowerCase(options.headers || {});
      options.headers = preset(options.headers, presets.headers);
      options.headers.host = options.hostname;
      options.headers = objectToLowerCase(options.headers);
  
      return options;
    }
  
    function hasFiles(body, formData) {
      var hasFile = false;
      if ('object' !== typeof body) {
        return false;
      }
      Object.keys(body).forEach(function (key) {
        var item = body[key];
        if (item instanceof File) {
          hasFile = true;
        } else if (item instanceof FileList) {
          hasFile = true;
        }
      });
      return hasFile;
    }
    function addFiles(body, formData) {
  
      Object.keys(body).forEach(function (key) {
        var item = body[key];
  
        if (item instanceof File) {
          formData.append(key, item);
        } else if (item instanceof FileList) {
          item.forEach(function (file) {
            formData.append(key, file);
          });
        } else {
          formData.append(key, item);
        }
      });
    }
  
    // TODO convert object/map body into array body
    // { "a": 1, "b": 2 } --> [ "name": "a", "value": 1, "name": "b", "value": 2 ]
    // this would be more appropriate and in better accordance with the http spec
    // as it allows for a value such as "a" to have multiple values rather than
    // having to do "a1", "a2" etc
    function handleBody(options) {
      function bodyEncoder() {
        checkBodyAllowed(options);
  
        if (options.encodedBody) {
          return;
        }
  
        //
        // Check for HTML5 FileApi files
        //
        if (hasFiles(options.body)) {
          options.encodedBody = new FormData(); 
          addFiles(options.body, options.encodedBody);
        }
        if (options.body instanceof FormData) {
          options.encodedBody = options.body;
        }
        if (options.encodedBody instanceof FormData) {
            // TODO: is this necessary? This breaks in the browser
  //        options.headers["content-type"] = "multipart/form-data";
          return;
        }
  
        if ('string' === typeof options.body) {
          options.encodedBody = options.body;
        }
  
        if (!options.headers["content-type"]) {
          options.headers["content-type"] = "application/x-www-form-urlencoded";
        }
  
        if (!options.encodedBody) {
          if (options.headers["content-type"].match(/application\/json/) || 
              options.headers["content-type"].match(/text\/javascript/)) {
            options.encodedBody = JSON.stringify(options.body);
          } else if (options.headers["content-type"].match(/application\/x-www-form-urlencoded/)) {
              options.encodedBody = uriEncodeObject(options.body);
          }
  
          if (!options.encodedBody) {
            throw new Error("'" + options.headers["content-type"] + "'" + "is not yet supported and you have not specified 'encodedBody'");
          }
  
          options.headers["content-length"] = options.encodedBody.length;
        }
      }
  
      function removeContentBodyAndHeaders() {
        if (options.body) {
          throw new Error('You gave a body for one of HEAD, GET, DELETE, or OPTIONS');
        }
  
        options.encodedBody = "";
        options.headers["content-type"] = undefined;
        options.headers["content-length"] = undefined;
        options.headers["transfer-encoding"] = undefined;
        delete options.headers["content-type"];
        delete options.headers["content-length"];
        delete options.headers["transfer-encoding"];
      }
  
      if ('file:' === options.protocol) {
        options.header = undefined;
        delete options.header;
        return;
      }
  
      // Create & Send body
      // TODO support streaming uploads
      options.headers["transfer-encoding"] = undefined;
      delete options.headers["transfer-encoding"];
  
      if (options.body || options.encodedBody) {
        bodyEncoder(options);
      } else { // no body || body not allowed
        removeContentBodyAndHeaders(options);
      }
    }
  
    ahrOptions.handleOptions = function (options) {
      handleUri(options);
      handleHeaders(options);
      handleBody(options);
  
      return options;
    };
  }());
  

  provide("ahr.options", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*
     loadstart;
     progress;
     abort;
     error;
     load;
     timeout;
     loadend;
  */
  (function () {
    "use strict";
  
    function browserJsonpClient(req, res) {
      // TODO check for Same-domain / XHR2/CORS support
      // before attempting to insert script tag
      // Those support headers and such, which are good
      var options = req.userOptions
        , cbkey = options.jsonpCallback
        , script = document.createElement("script")
        , head = document.getElementsByTagName("head")[0] || document.documentElement
        , addParamsToUri = require('ahr.utils').addParamsToUri
        , timeout
        , fulfilled; // TODO move this logic elsewhere into the emitter
  
      // cleanup: cleanup window and dom
      function cleanup() {
        fulfilled = true;
        window[cbkey] = undefined;
        try {
          delete window[cbkey];
          // may have already been removed
          head.removeChild(script);
        } catch(e) {}
      }
  
      function abortRequest() {
        req.emit('abort');
        cleanup();
      }
  
      function abortResponse() {
        res.emit('abort');
        cleanup();
      }
  
      function prepareResponse() {
        // Sanatize data, Send, Cleanup
        function onSuccess(data) {
          var ev = {
            lengthComputable: false,
            loaded: 1,
            total: 1
          };
          if (fulfilled) {
            return;
          }
  
          clearTimeout(timeout);
          res.emit('loadstart', ev);
          // sanitize
          data = JSON.parse(JSON.stringify(data));
          res.emit('progress', ev);
          ev.target = { result: data };
          res.emit('load', ev);
          cleanup();
        }
  
        function onTimeout() {
          res.emit('timeout', {});
          res.emit('error', new Error('timeout'));
          cleanup();
        }
  
        window[cbkey] = onSuccess;
        // onError: Set timeout if script tag fails to load
        if (options.timeout) {
          timeout = setTimeout(onTimeout, options.timeout);
        }
      }
  
      function makeRequest() {
        var ev = {}
          , jsonp = {};
  
        function onError(ev) {
          res.emit('error', ev);
        }
  
        // ?search=kittens&jsonp=jsonp123456
        jsonp[options.jsonp] = options.jsonpCallback;
        options.href = addParamsToUri(options.href, jsonp);
  
        // Insert JSONP script into the DOM
        // set script source to the service that responds with thepadded JSON data
        req.emit('loadstart', ev);
        try {
          script.setAttribute("type", "text/javascript");
          script.setAttribute("async", "async");
          script.setAttribute("src", options.href);
          // Note that this only works in some browsers,
          // but it's better than nothing
          script.onerror = onError;
          head.insertBefore(script, head.firstChild);
        } catch(e) {
          req.emit('error', e);
        }
  
        // failsafe cleanup
        setTimeout(cleanup, 2 * 60 * 1000);
        // a moot point since the "load" occurs so quickly
        req.emit('progress', ev);
        req.emit('load', ev);
      }
  
      setTimeout(makeRequest, 0);
      req.abort = abortRequest;
      res.abort = abortResponse;
      prepareResponse();
  
      return res;
    }
  
    module.exports = browserJsonpClient;
  }());
  

  provide("ahr.browser.jsonp", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint devel: true, debug: true, es5: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
  // This module is meant for modern browsers. Not much abstraction or 1337 majic
  (function (undefined) {
    "use strict";
  
    var url //= require('url')
      , browserJsonpClient = require('ahr.browser.jsonp')
      , triedHeaders = {}
      , nativeHttpClient
      , globalOptions
      , restricted
      , debug = false
      ; // TODO underExtend localOptions
  
    // Restricted Headers
    // http://www.w3.org/TR/XMLHttpRequest/#the-setrequestheader-method
    restricted = [
        "Accept-Charset"
      , "Accept-Encoding"
      , "Connection"
      , "Content-Length"
      , "Cookie"
      , "Cookie2"
      , "Content-Transfer-Encoding"
      , "Date"
      , "Expect"
      , "Host"
      , "Keep-Alive"
      , "Referer"
      , "TE"
      , "Trailer"
      , "Transfer-Encoding"
      , "Upgrade"
      , "User-Agent"
      , "Via"
    ];
    restricted.forEach(function (val, i, arr) {
      arr[i] = val.toLowerCase();
    });
  
    if (!window.XMLHttpRequest) {
      window.XMLHttpRequest = function() {
        return new ActiveXObject('Microsoft.XMLHTTP');
      };
    }
    if (window.XDomainRequest) {
      // TODO fix IE's XHR/XDR to act as normal XHR2
      // check if the location.host is the same (name, port, not protocol) as origin
    }
  
  
    function encodeData(options, xhr2) {
      var data
        , ct = options.overrideResponseType || xhr2.getResponseHeader("content-type") || ""
        , text
        , len
        ;
  
      ct = ct.toLowerCase();
  
      if (xhr2.responseType && xhr2.response) {
        text = xhr2.response;
      } else {
        text = xhr2.responseText;
      }
  
      len = text.length;
  
      if ('binary' === ct) {
        if (window.ArrayBuffer && xhr2.response instanceof window.ArrayBuffer) {
          return xhr2.response;
        }
  
        // TODO how to wrap this for the browser and Node??
        if (options.responseEncoder) {
          return options.responseEncoder(text);
        }
  
        // TODO only Chrome 13 currently handles ArrayBuffers well
        // imageData could work too
        // http://synth.bitsnbites.eu/
        // http://synth.bitsnbites.eu/play.html
        // var ui8a = new Uint8Array(data, 0);
        var i
          , ui8a = Array(len)
          ;
  
        for (i = 0; i < text.length; i += 1) {
          ui8a[i] = (text.charCodeAt(i) & 0xff);
        }
  
        return ui8a;
      }
  
      if (ct.indexOf("xml") >= 0) {
        return xhr2.responseXML;
      }
  
      if (ct.indexOf("jsonp") >= 0 || ct.indexOf("javascript") >= 0) {
        console.log("forcing of jsonp not yet supported");
        return text;
      }
  
      if (ct.indexOf("json") >= 0) {
        try {
          data = JSON.parse(text);
        } catch(e) {
          data = text;
        }
        return data;
      }
  
      return xhr2.responseText;
    }
  
    function browserHttpClient(req, res) {
      var options = req.userOptions
        , xhr2
        , xhr2Request
        , timeoutToken
        ;
  
      function onTimeout() {
        req.emit("timeout", new Error("timeout after " + options.timeout + "ms"));
      }
  
      function resetTimeout() {
        clearTimeout(timeoutToken);
        timeoutToken = setTimeout(onTimeout, options.timeout);
      }
  
      function sanatizeHeaders(header) {
        var value = options.headers[header]
          , headerLc = header.toLowerCase()
          ;
  
        // only warn the user once about bad headers
        if (-1 !== restricted.indexOf(header.toLowerCase())) {
          if (!triedHeaders[headerLc]) {
            console.error('Ignoring all attempts to set restricted header ' + header + '. See (http://www.w3.org/TR/XMLHttpRequest/#the-setrequestheader-method)');
          }
          triedHeaders[headerLc] = true;
          return;
        }
  
        try {
          // throws INVALID_STATE_ERROR if called before `open()`
          xhr2.setRequestHeader(header, value);
        } catch(e) {
          console.error('error setting header: ' + header);
          console.error(e);
        }
      }
  
      // A little confusing that the request object gives you
      // the response handlers and that the upload gives you
      // the request handlers, but oh well
      xhr2 = new XMLHttpRequest();
      xhr2Request = xhr2.upload;
  
      /* Proper States */
      xhr2.addEventListener('loadstart', function (ev) {
          // this fires when the request starts,
          // but shouldn't fire until the request has loaded
          // and the response starts
          req.emit('loadstart', ev);
          resetTimeout();
      }, true);
      xhr2.addEventListener('progress', function (ev) {
          if (!req.loaded) {
            req.loaded = true;
            req.emit('progress', {});
            req.emit('load', {});
          }
          if (!res.loadstart) {
            res.headers = xhr2.getAllResponseHeaders();
            res.loadstart = true;
            res.emit('loadstart', ev);
          }
          res.emit('progress', ev);
          resetTimeout();
      }, true);
      xhr2.addEventListener('load', function (ev) {
        if (xhr2.status >= 400) {
          ev.error = new Error(xhr2.status);
        }
        ev.target.result = encodeData(options, xhr2);
        res.emit('load', ev);
      }, true);
      /*
      xhr2Request.addEventListener('loadstart', function (ev) {
        req.emit('loadstart', ev);
        resetTimeout();
      }, true);
      */
      xhr2Request.addEventListener('load', function (ev) {
        resetTimeout();
        req.loaded = true;
        req.emit('load', ev);
        res.loadstart = true;
        res.emit('loadstart', {});
      }, true);
      xhr2Request.addEventListener('progress', function (ev) {
        resetTimeout();
        req.emit('progress', ev);
      }, true);
  
  
      /* Error States */
      xhr2.addEventListener('abort', function (ev) {
        res.emit('abort', ev);
      }, true);
      xhr2Request.addEventListener('abort', function (ev) {
        req.emit('abort', ev);
      }, true);
      xhr2.addEventListener('error', function (ev) {
        res.emit('error', ev);
      }, true);
      xhr2Request.addEventListener('error', function (ev) {
        req.emit('error', ev);
      }, true);
      // the "Request" is what timeouts
      // the "Response" will timeout as well
      xhr2.addEventListener('timeout', function (ev) {
        req.emit('timeout', ev);
      }, true);
      xhr2Request.addEventListener('timeout', function (ev) {
        req.emit('timeout', ev);
      }, true);
  
      /* Cleanup */
      res.on('loadend', function () {
        // loadend is managed by AHR
        req.status = xhr2.status;
        res.status = xhr2.status;
        clearTimeout(timeoutToken);
      });
  
      if (options.username) {
        xhr2.open(options.method, options.href, true, options.username, options.password);
      } else {
        xhr2.open(options.method, options.href, true);
      }
  
      Object.keys(options.headers).forEach(sanatizeHeaders);
  
      setTimeout(function () {
        if ('binary' === options.overrideResponseType) {
          xhr2.overrideMimeType("text/plain; charset=x-user-defined");
          xhr2.responseType = 'arraybuffer';
        }
        try {
          xhr2.send(options.encodedBody);
        } catch(e) {
          req.emit('error', e);
        }
      }, 1);
      
  
      req.abort = function () {
        xhr2.abort();
      };
      res.abort = function () {
        xhr2.abort();
      };
  
      res.browserRequest = xhr2;
      return res;
    }
  
    function send(req, res) {
      var options = req.userOptions;
      // TODO fix this ugly hack
      url = url || require('url');
      if (options.jsonp && options.jsonpCallback) {
        return browserJsonpClient(req, res);
      }
      return browserHttpClient(req, res);
    }
  
    module.exports = send;
  }());
  

  provide("ahr.browser.request", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  // intentionally blank
  

  provide("ahr.browser", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint devel: true, debug: true, es5: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
  (function () {
    "use strict";
  
    var EventEmitter = require('events.node').EventEmitter
      , Future = require('future')
      , Join = require('join')
      , ahrOptions
      , nextTick
      , utils
      , preset
      ;
  
    function nextTick(fn, a, b, c, d) {
      try {
        process.nextTick(fn, a, b, c, d);
      } catch(e) {
        setTimeout(fn, 0, a, b, c, d);
      }
    }
  
    ahrOptions = require('ahr.options');
    utils = require('ahr.utils');
    
    preset = utils.preset;
  
    // The normalization starts here!
    function NewEmitter() {
      var emitter = new EventEmitter()
        , promise = Future()
        , ev = {
              lengthComputable: false
            , loaded: 0
            , total: undefined
          };
  
      function loadend(ev, errmsg) {
        nextTick(function () {
          ev.error = errmsg && new Error(errmsg);
          emitter.emit('loadend', ev);
        });
      }
  
      // any error in the quest causes the response also to fail
      emitter.on('loadend', function (ev) {
        if (emitter.done) {
          console.error('loadend called several times', emitter, ev);
        }
        emitter.done = true;
        // in FF this is only a getter, setting is not allowed
        if (!ev.target) {
          ev.target = {};
        }
        promise.fulfill(emitter.error || ev.error, emitter, ev.target.result, ev.error ? false : true);
      });
      emitter.on('timeout', function (ev) {
        emitter.error = ev;
        loadend(ev, 'timeout');
      });
      emitter.on('abort', function (ev) {
        loadend(ev, 'abort');
      });
      emitter.on('error', function (err, evn) {
        // TODO rethrow the error if there are no listeners (incl. promises)
        //if (respEmitter.listeners.loadend) {}
        if (emitter.cancelled) {
          // return;
        }
        emitter.error = err;
        ev.error = err;
        if (evn) {
          ev.lengthComputable = evn.lengthComputable || true;
          ev.loaded = evn.loaded || 0;
          ev.total = evn.total;
        }
        loadend(ev);
      });
      // TODO there can actually be multiple load events per request
      // as is the case with mjpeg, streaming media, and ad-hoc socket-ish things
      emitter.on('load', function (evn) {
        // ensure that `loadend` is after `load` for all interested parties
        if (emitter.cancelled) {
          return;
        }
        loadend(evn);
      });
  
      emitter.when = promise.when;
  
      return emitter;
    }
  
  
    //
    // Emulate `request`
    //
    function ahr(options, callback) {
      var NativeHttpClient
        , req = NewEmitter()
        , res = NewEmitter()
        ;
  
      if (callback || options.callback) {
        return ahr(options).when(callback);
      }
  
      options.href = options.href || options.url;
  
      ahrOptions.handleOptions(options);
  
      // todo throw all the important properties in the request
      req.userOptions = options;
      // in the browser tradition
      res.upload = req;
  
      // if the request fails, then the response must also fail
      req.on('error', function (err, ev) {
        if (!res.error) {
          res.emit('error', err, ev);
        }
      });
      req.on('timeout', function (ev) {
        res.emit('timeout', ev);
      });
      req.on('abort', function (ev) {
        res.emit('abort', ev);
      });
  
      try {
        NativeHttpClient = require('ahr.node');
      } catch(e) {
        NativeHttpClient = require('ahr.browser.request');
      }
  
      return NativeHttpClient(req, res);
    };
    ahr.globalOptionKeys = ahrOptions.globalOptionKeys;
    ahr.globalOption = ahrOptions.globalOption;
    ahr.setGlobalOptions = ahrOptions.setGlobalOptions;
    ahr.handleOptions = ahrOptions.handleOptions;
  
  
    ahr.join = Join;
  
  
    //
    //
    // All of these convenience methods are safe to cut if needed to save kb
    //
    //
    function allRequests(method, href, query, body, jsonp, options, callback) {
      options = options || {};
  
      if (method) { options.method = method; }
      if (href) { options.href = href; }
      if (jsonp) { options.jsonp = jsonp; }
  
      if (query) { options.query = preset((query || {}), (options.query || {})) }
      if (body) { options.body = body; }
  
      return ahr(options, callback);
    }
  
    ahr.http = ahr;
    ahr.file = ahr;
    // TODO copy the jquery / reqwest object syntax
    // ahr.ajax = ahr;
  
    // HTTP jQuery-like body-less methods
    ['HEAD', 'GET', 'DELETE', 'OPTIONS'].forEach(function (verb) {
      verb = verb.toLowerCase();
      ahr[verb] = function (href, query, options, callback) {
        return allRequests(verb, href, query, undefined, undefined, options, callback);
      };
    });
  
    // Correcting an oversight of jQuery.
    // POST and PUT can have both query (in the URL) and data (in the body)
    ['POST', 'PUT'].forEach(function (verb) {
      verb = verb.toLowerCase();
      ahr[verb] = function (href, query, body, options, callback) {
        return allRequests(verb, href, query, body, undefined, options, callback);
      };
    });
  
    // JSONP
    ahr.jsonp = function (href, jsonp, query, options, callback) {
      if (!jsonp || 'string' !== typeof jsonp) {
        throw new Error("'jsonp' is not an optional parameter.\n" +
          "If you believe that this should default to 'callback' rather" +
          "than throwing an error, please file a bug");
      }
  
      return allRequests('GET', href, query, undefined, jsonp, options, callback);
    };
  
    // HTTPS
    ahr.https = function (options, callback) {
      options.ssl = true;
      options.protocol = "https:";
  
      return ahr(options, callback);
    };
  
    ahr.tcp = function (options, callback) {
      options.protocol = "tcp:";
  
      return ahr(options, callback);
    };
  
    ahr.udp = function (options, callback) {
      options.protocol = "udp:";
  
      return ahr(options, callback);
    };
  
    module.exports = ahr;
  }());
  

  provide("ahr2", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint es5: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
  (function () {
    "use strict";
  
    var request = require('ahr2'),
      Future = require('future'),
      createRestClient;
    /**
     * Scaffold
     *
     * This produces an API skeleton based on the JSON-API doc.
     * When printed as a string this provides a nice starting point for your API
     */
    createRestClient = function (doc) {
      var factory = {};
      // TODO allow for multiple versions
      // TODO move creation params to doc
      factory.create = function (api_key) {
      
        var api = {}, api_req;
        // Base API / REST request
        api_req = function(action, params, options) {
          var promise = Future()
            , result
            ;
  
          // Uses abstractHttpRequest
          params[doc.key.name] = api_key;
          Object.keys(doc.api_params).forEach(function (key) {
            if ('undefined' === typeof params[key]) {
              params[key] = doc.api_params[key];
            }
          });
  
          result = request.jsonp(doc.api_url + action, doc.jsonp_callback, params, options);
          result.when(function (err, xhr, data) {
            if (data && data.response && data.response.errors) {
              err = data.response.errors;
            }
            promise.fulfill(err, xhr, data);
          });
          return promise;
        };
        doc.requests.forEach(function (module) {
          // example: CampusBooks.search(params, options);
          api[module.name] = function (params, options) {
            var pdoc = module.parameters,
              promise = Future(),
              validates = true,
              undocumented = [],
              msg = "",
              result;
  
            if (pdoc) {
              // TODO move to validations model
              if (pdoc.required) {
                pdoc.required.forEach(function (pname) {
                  if ('undefined' === typeof params[pname] || !params[pname].toString()) {
                    validates = false;
                    msg += "All of the params '" + pdoc.required.toString() + "' must be specified for the '" + module.name  + "' call.";
                  }
                });
              }
              if ('undefined' !== typeof pdoc.oneOf) {
                Object.keys(params).forEach(function (pname) {
                  var exists = false;
                  pdoc.oneOf.forEach(function (ename) {
                    if (pname === ename) {
                      exists = true;
                    }
                  });
                  if (true !== exists) {
                    undocumented.push(pname);
                  }
                });
                if (0 !== undocumented.length) {
                  validates = false;
                  msg += "The params '" + undocumented.toString() + "' are useless for this call.";
                }
              }
              // TODO end move to validations model block
              
              if (pdoc.validation) {
                validates = pdoc.validation(params);
                msg = validates;
              }
              if (true !== validates) {
                promise.fulfill(msg);
                return promise;
              }
            }
  
            result = api_req(module.name, params, options);
            return result;
          };
        });
        return api;
      };
      return factory;
    };
  
    module.exports = {
      createRestClient: createRestClient
    };
  
  }());
  

  provide("jsonapi", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true */
  var provide = provide || function () {},
    global = (function () {return this; }());
  (function () {
      "use strict";
  
      var classes = "Boolean Number String Function Array Date RegExp Object".split(" "),
        i,
        name,
        class2type = {};
  
      for (i in classes) {
        if (classes.hasOwnProperty(i)) {
          name = classes[i];
          class2type["[object " + name + "]"] = name.toLowerCase();
        }
      }
  
      function typeOf(obj) {
        return (null === obj || undefined === obj) ? String(obj) : class2type[Object.prototype.toString.call(obj)] || "object";
      }
  
      function isEmpty(o) {
          var i, v;
          if (typeOf(o) === 'object') {
              for (i in o) { // fails jslint
                  v = o[i];
                  if (v !== undefined && typeOf(v) !== 'function') {
                      return false;
                  }
              }
          }
          return true;
      }
  
      if (!String.prototype.entityify) {
          String.prototype.entityify = function () {
              return this.replace(/&/g, "&amp;").replace(/</g,
                  "&lt;").replace(/>/g, "&gt;");
          };
      }
  
      if (!String.prototype.quote) {
          String.prototype.quote = function () {
              var c, i, l = this.length, o = '"';
              for (i = 0; i < l; i += 1) {
                  c = this.charAt(i);
                  if (c >= ' ') {
                      if (c === '\\' || c === '"') {
                          o += '\\';
                      }
                      o += c;
                  } else {
                      switch (c) {
                      case '\b':
                          o += '\\b';
                          break;
                      case '\f':
                          o += '\\f';
                          break;
                      case '\n':
                          o += '\\n';
                          break;
                      case '\r':
                          o += '\\r';
                          break;
                      case '\t':
                          o += '\\t';
                          break;
                      default:
                          c = c.charCodeAt();
                          o += '\\u00' + Math.floor(c / 16).toString(16) +
                              (c % 16).toString(16);
                      }
                  }
              }
              return o + '"';
          };
      } 
  
      if (!String.prototype.supplant) {
          String.prototype.supplant = function (o) {
              return this.replace(/{([^{}]*)}/g,
                  function (a, b) {
                      var r = o[b];
                      return typeof r === 'string' || typeof r === 'number' ? r : a;
                  }
              );
          };
      }
  
      if (!String.prototype.trim) {
          String.prototype.trim = function () {
              return this.replace(/^\s*(\S*(?:\s+\S+)*)\s*$/, "$1");
          };
      }
  
      // Boiler Plate
      if ('undefined' === typeof module) { module = {}; }
      module.exports = {
          typeOf: typeOf,
          isEmpty: isEmpty
      };
      global.typeOf = global.typeOf || typeOf;
      global.isEmpty = global.isEmpty || isEmpty;
      provide('remedial');
  }());
  

  provide("remedial", module.exports);

  $.ender(module.exports);

}();

!function () {

  var module = { exports: {} }, exports = module.exports;

  /*jslint es5: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
  (function () {
    "use strict";
  
    var jsonapi = require('jsonapi'),
      CampusBooks = {},
      documentation;
  
    /**
     * Documention
     * TODO: list all params
     * 
     */
    documentation = {
      requests: [
        {
          name: "constants",
          description: "The Constants call just returns a list of each of the types of constants, and their available id/value pairs",
          parameters: {
            oneOf: []
          }
        },
        {
          name: "prices",
          parameters: {
            oneOf: [
              "isbn"
            ],
            required: [
              "isbn"
            ]
          },
          description: "The prices call requires a single valid ISBN to be passed in via a 'isbn' parameter:\n" +
            "<br/>\n" +
            "<pre>http://api.campusbooks.com/10/rest/prices?key=YOUR_API_KEY_HERE&isbn=ISBN_HERE</pre>\n" +
            "<br/>\n" +
            "It returns groupings for each condition where each group contains multiple offers.\n" + 
            "Each offer contains the following fields:",
          response: [
            {
              name: "isbn",
              description: "The thirteen digit ISBN for this offer"
            },
            {
              name: "merchant_id",
              description: "A numeric merchant ID (Note, this value may be signed)"
            },
            {
              name: "merchant_name",
              description: "The Name of the merchant (looked up from the defined constants)"
            },
            {
              name: "merchant_image",
              description: "URL of the merchant logo"
            },
            {
              name: "price",
              description: "The price that this merchant is listing this item for"
            },
            {
              name: "shipping_ground",
              description: "The cost to ship to an address in the US via ground services"
            },
            {
              name: "total_price",
              description: "Seller price plus the ground shipping price"
            },
            {
              name: "link",
              description: "Link to purchase the book"
            },
            {
              name: "condition_id",
              description: "Numeric representation of the condition (see constants)"
            },
            {
              name: "condition_text",
              description: "Text representation of the condition"
            },
            {
              name: "availability_id",
              description: "Numeric representation of the availability (how long it takes for the seller to ship it)"
            },
            {
              name: "availability_text",
              description: "Text representation of the availability"
            },
            {
              name: "location",
              description: "Geographic location where this item ships from (not always present)"
            },
            {
              name: "their_id",
              description: "The merchant's id for this offer (not always present)"
            },
            {
              name: "comments",
              description: "Comments about this offering"
            },
            {
              name: "condition_text",
              description: "Text representation of the condition"
            },
            {
              name: "rental_detail",
              description: "This node is available only for offers from book rental companies.\n" + 
                "If available, each sub-node indicates a price for one of three rental periods (SEMESTER, TERM, or SUMMER)",
              values: [
                {
                  name: "days",
                  description: "The exact number of days that this book may be rented for"
                },
                {
                  name: "price",
                  description: "The price for this rental period"
                },
                {
                  name: "link",
                  description: "A link that will take the visitor to a page specific to this rental period\n" + 
                    "(if supported by the merchant)"
                }
              ]
            }
          ]
        },
        {
          name: "bookinfo",
          parameters: {
            oneOf: [
              "isbn",
              "image_height",
              "image_width"
            ],
            required: [
              "isbn"
            ]
          },
          description: "The bookinfo call requires a single valid ISBN to be passed in via a 'isbn' parameter:\n" +
            "<br/>\n" +
            "<pre>http://api.campusbooks.com/10/rest/bookinfo?key=YOUR_API_KEY_HERE&isbn=0824828917[&image_height=HEIGHT][&image_width=WIDTH]</pre>\n" +
            "<br/>\n" +
            "It returns a 'page' element with all of the book attributes.",
          response: [
            {
              name: "isbn10",
              description: "Ten-Digit ISBN for this book"
            },
            {
              name: "isbn13",
              description: "Thirteen-Digit ISBN for this book"
            },
            {
              name: "title",
              description: "Book Title"
            },
            {
              name: "author",
              description: "Book Author"
            },
            {
              name: "binding",
              description: "Book Binding"
            },
            {
              name: "msrp",
              description: "List price for the book"
            },
            {
              name: "pages",
              description: "Number of pages in the book"
            },
            {
              name: "publisher",
              description: "Book Publisher"
            },
            {
              name: "published_date",
              description: "Published Date"
            },
            {
              name: "edition",
              description: "Book Edition (ie: 2nd, 3rd, etc)"
            },
            {
              name: "description",
              description: "A text description for the book"
            }
          ]
        },
        {
          name: "search",
          cimplate: "div.book",
          values: {
            "image": ".image[src={value}]",
            "title": ".title",
            "author": ".author",
            "isbn10": ".isbn10",
            "isbn13": ".isbn13",
            "edition": ".edition"
          },
          render: function (result) {
            var me = this,
              dimplset = [];
  
            function find_or_create(css) {
              // parse css
              // loop through from parentto child
              // find
              // if length 0, create in parent (or body)
            }
            //try {
              result.response.page.results.book.forEach(function (book) {
                var html = $('#templates ' + me.cimplate).clone();
                Object.keys(book).forEach(function (key) {
                  // TODO parse css to produce subtemplates
                  if ("image" === key) {
                    html.find('.'+key).attr("src", book[key]);
                    return;
                  }
                  html.find('.'+key).html(book[key]);
                });
                dimplset.push(html);
              });
            //} catch(e) {}
            return dimplset;
          },
          parameters: {
            oneOf: [
              "author",
              "title",
              "keywords",
              "page",
              "image_height",
              "image_width"
            ],
            validation: function(parameters) {
              var msg = true;
              if (0 === parameters.length) {
                msg = "you must specify at least one search parameter";
              }
              return msg;
            }
          },
          description: "The search call can be used to do an author, title, or keyword search.\n" +
            "It returns a list of books that match the search criteria\n" +
            "<br/>\n" +
            "<pre>http://api.campusbooks.com/10/rest/search?key=YOUR_API_KEY_HERE&[&author=AUTHOR][&title=TITLE][&keywords=KEYWORDS][&page=1][&image_height=HEIGHT][&image_width=WIDTH]</pre>\n" +
            "<br/>\n" +
            "At least one of 'author', 'title', or 'keywords' must be specified.\n" +
            "The result contains up to 10 results on the page. You can specify a page with the 'page' parameter'",
          response: [
            {
              name: "count",
              description: "The number of results for your search results (only 10 are displayed on this page)"
            },
            {
              name: "pages",
              description: "The number of pages of results available"
            },
            {
              name: "current_page",
              description: "The current page you are on"
            },
            {
              name: "results",
              description: "A list of books. The format of each is the same as from the bookinfo call defined above"
            }
          ]
        },
        {
          name: "bookprices",
          parameters: {
            oneOf: [
              "isbn",
              "image_height",
              "image_width"
            ],
            required: [
              "isbn"
            ]
          },
          description: "This function combines the bookinfo and prices functions into a single call.\n" +
            " It requires an ISBN and returns the book information as well as all of the pricing data\n" +
            "<br/>\n" +
            "<pre>http://api.campusbooks.com/10/rest/bookprices?key=YOUR_API_KEY_HERE&isbn=ISBN[&image_height=HEIGHT][&image_width=WIDTH]</pre>\n",
          response: [
            {
              name: "book",
              description: "A book item. The contents of this item are the same as which is returned with the bookinfo function"
            },
            {
              name: "offers",
              description: "This node contains all of the pricing data that a call to the price function returns"
            }
          ]
        },
        {
          name: "buybackprices",
          parameters: {
            oneOf: [
              "isbn",
              "image_height",
              "image_width"
            ],
            required: [
              "isbn"
            ]
          },
          description: "This function combines the bookinfo request with buyback pricing information.\n" +
            "It requires an ISBN and returns buyback prices for all of the merchants that you have enabled." +
            "<br/>\n" +
            "<pre>http://api.campusbooks.com/10/rest/buybackprices?key=YOUR_API_KEY_HERE&isbn=ISBN[&image_height=HEIGHT][&image_width=WIDTH]</pre>\n",
          response: [
            {
              name: "book",
              description: "A book item. The contents of this item are the same as which is returned with the bookinfo function"
            },
            {
              name: "offers",
              description: "This node contains an array of merchant nodes, each with the following structure",
              values: [
                {
                  name: "merchant_id",
                  description: "A numeric merchant ID"
                },
                {
                  name: "merchant_image",
                  description: "URL of the merchant logo"
                },
                {
                  name: "name",
                  description: "The name of the merchant"
                },
                {
                  name: "notes",
                  description: "A text description about this merchant. It contains payment and shipping information about this merchant"
                },
                {
                  name: "prices",
                  description: "prices contains a price node for each condition (new and used)"
                },
                {
                  name: "link",
                  description: "The link for directing visitors to this merchant."
                }
              ]
            }
          ],
          example: "<pre><code>" +
            "&lt;merchant&gt;" +
            "    &lt;merchant_id&gt;108&lt;/merchant_id&gt;" +
            "    &lt;merchant_image&gt;http://www.campusbooks.com/images/markets/firstclassbooks.gif&lt;/merchant_iamge&gt;" +
            "    &lt;name&gt;First Class Books&lt;/name&gt;" +
            "    &lt;notes&gt;Free shipping via USPS or FedEx. Books must be ....&lt;/notes&gt;" +
            "    &lt;prices&gt;" +
            "        &lt;price condition=\"new\"&gt;13.55&lt;/price&gt;" +
            "        &lt;price condition=\"used\"&gt;13.55&lt;/price&gt;" +
            "        &lt;/prices&gt;" +
            "    &lt;link&gt; http://partners.campusbooks.com/link.php?params=b3...&lt;/link&gt;" +
            "&lt;/merchant&gt;" +
          "</code></pre>"
        },
        {
          name: "merchant",
          parameters: {
            oneOf: [
              "buyback",
              "coupons"
            ]
          },
          description: "This function returns a list of merchants and their home page links you can use for direct promotions.\n" +
            "It can also return a list of available coupons for that merchant" +
            "<br/>\n" +
            "<pre>http://api.campusbooks.com/10/rest/merchants?key=YOUR_API_KEY_HERE[&coupons][&buyback=TYPE]</pre>\n",
          response: [
            {
              name: "name", 
              description: "The name of the merchant"
            },
            {
              name: "type",
              description: "The type of the merchant (BUY, BUYBACK)"
            },
            {
              name: "merchant_id",
              description: "A numeric merchant ID"
            },
            {
              name: "homepage_link",
              description: "A link for directing visitors to this merchants homepage"
            },
            {
              name: "coupon",
              description: "This node contains the coupon information"
            }
          ]
        }
      ],
      version: "10",
      compatible: ["10","9","8","7","6","5","4","3","2","1"],
      jsonp_callback: "callback",
      api_url: "http://api.campusbooks.com/10/rest/",
      api_params: {
        format: "json"
      },
      required_keys: [
        "api"
      ],
      key: {
        name: "key"
      }
    };
  
    CampusBooks = jsonapi.createRestClient(documentation);
    CampusBooks.documentation = documentation;
  
    module.exports = CampusBooks
  }());
  

  provide("campusbooks", module.exports);

  $.ender(module.exports);

}();