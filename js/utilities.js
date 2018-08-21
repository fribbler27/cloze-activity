/** Checks whether a value is empty, defined as null or undefined or "".
 *  Note that 0 is defined as not empty.
 *  @param {*} val - value to check
 *  @returns {boolean}
 */
function empty(val) {
	// note that we need === because (0 == "") evaluates to true
	return (val === null || val === "" || val === undefined);
}

/** Replace variables in a string, a la PHP
 * e.g.:
 * str_replace("replace value $bar.", {bar: "foo"});
 *    =>
 * "replace value foo."
 *
 * o.bar can be either a scalar value or a function that returns a scalar value
 *
 * Or, you can pass variables in directly, and specify them with $1, $2, $3, etc.
 * str_replace("replace value $1.", "foo");
 *    =>
 * "replace value foo."
 *
 * SHORTCUT: sr()
 *
 *  @param {string} s
 *  @param {object|array} [o] - if this is an array, it will be assumed to be an array of objects. if this is not an array or an object, it will treat the arguments array as a list of scalars
 *  @returns {*}
 */
function str_replace(s, o) {
	// if o is an array, recursively process each object in the array
	if ($.isArray(o)) {
		for (var i = 0; i < o.length; ++i) {
			s = str_replace(s, o[i]);
		}

	} if (typeof(o) == "object") {
		// find all instances of $xxx
		var matches = s.match(/\$(\w+)\b/g);
		if (!empty(matches)) {
			for (var i = 0; i < matches.length; ++i) {
				var key = matches[i].substr(1);
				var val = null;
				// scalars
				if (typeof(o[key]) == "string" || typeof(o[key]) == "number") {
					val = o[key];
				} else if (typeof(o[key]) == "function") {
					val = o[key]();
				}
				if (val !== null) {
					var re = new RegExp("\\$" + key + "\\b", "g");
					s = s.replace(re, val);
				}
			}
		}
	} else {
		for (var i = 1; i < arguments.length; ++i) {
			var re = new RegExp("\\$" + i + "\\b", "g");
			s = s.replace(re, arguments[i]);
		}
	}
	return s;
}
// shortcut
var sr = str_replace;

var U = {};

U.ajax = function(service_name, data, callback_fn, override_options) {
	// add window.launch_data, which includes context_id, link_id, and user_id, in to data
	data.launch_data = window.launch_data;

	// create url with Tsugi PHPSESSID, and add service to data
	var url = "src/ajax.php?PHPSESSID=" + window.launch_data.session_id;
	data.service_name = service_name;

	var options = {
		type: "POST",
		url: url,
		cache: false,
		data: data,
		dataType: "text",
		success: function(str, text_status) {
			var result;
			if (empty(str)) {
				result = {"status": "Ajax returned with no status"};
			} else {
				try {
					result = JSON.parse(str);
				} catch(e) {
					result = {"status": str};
				}
			}

			if (empty(result.status)) {
				result.status = "Ajax returned with no status";
			}
			if (result.status != "ok") {
				// error
				console.log("ajax success but not 'ok'", result);
			}

			if (!empty(callback_fn)) {
				callback_fn(result);
			}

		},
		error: function(jqXHR, textStatus, errorThrown) {
			var result = {
				"status": "Ajax server error",
				"ajax_name": name,
				"textStatus": textStatus,
				"errorThrown": errorThrown,
				"responseText": jqXHR.responseText
			};

			if (!empty(callback)) {
				callback(result);
			}
		}
	};

	// override any options coming in
	if (!empty(override_options)) {
		for (var key in override_options) {
			options[key] = override_options[key];
		}
	}

	$.ajax(options);
}
