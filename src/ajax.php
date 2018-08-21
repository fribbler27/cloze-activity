<?php

require_once "../../config.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Core\Settings;
use \Tsugi\Util\Net;

require_once "activity.php";

function get_param($key, $options) {
	$val = $_POST[$key] ?? "";
	if (empty($options)) $options = [];

	if (empty($val)) {
		if (($options["required"] ?? "") == true) {
			// required param not there -- throw error
			throw new Exception("Required value “" . $key . "” not supplied in ajax call.");
		}
		if (!empty($options["default"])) {
			return $options["default"];
		}
		return "";
	}

	// return numeric, string, or unconverted value (use the latter for objects, e.g.)
	if (($options["numeric"] ?? "") == true) {
		return $val * 1;
	} else if (($options["string"] ?? "") == true) {
		return $val . "";
	} else {
		return $val;
	}
}

// prepare return value $rv; assume status is "ok"
$rv = ["status" => "ok"];

try {
	// look for launch_data param (required in all ajax calls)
	$launch_data = get_param("launch_data", ["required"=>true]);

	// look for required service_name
	$service_name = get_param("service_name", ["required"=>true, "string"=>true]);

	// start session and verify user_id
	$LAUNCH = LTIX::requireData();

	$user_id = $launch_data["user_id"] ?? "";
	if ($LAUNCH->user->id != $user_id) {
		throw new Exception("Received user_id ($user_id) does not match LTI user_id (" . $LAUNCH->user->id . ")");
	}

	// include file for this service and run it
	$fn = "services/$service_name.php";
	if (!file_exists($fn)) {
			// if file doesn't exist, that's an error
		throw new Error("Service “" . $service_name . "” does not exist.");
	}
	require($fn);
	service($rv);

} catch(Throwable $e) {
	$rv["status"] = $e->getMessage();
}

die(json_encode($rv, 4));
