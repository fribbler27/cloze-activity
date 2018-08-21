<?php
require_once "../config.php";

use \Tsugi\Core\LTIX;
use \Tsugi\Core\Settings;
use \Tsugi\Util\Net;

require_once "src/activity.php";

class Controller {
	public function instructor_view() {
		global $LAUNCH;

		$link_id = $LAUNCH->link->id;
		require_once "views/v-instructor.php";
	}

	public function student_view() {
		global $LAUNCH;
		require_once "views/v-student.php";
	}

	private function launch_data() {
		global $LAUNCH;
		return json_encode([
			"session_id" => session_id(),
			"context_id" => $LAUNCH->context->id,
			"link_id" => $LAUNCH->link->id,
			"user_id" => $LAUNCH->user->id,
			"firstname" => $LAUNCH->user->firstname,
			"lastname" => $LAUNCH->user->lastname,
		]);
	}

	private function link_data() {
		global $LAUNCH;
		// start with json
		$a = new Activity("launch");
		$d = $a->to_object();

		// return json encoded so it can be included in the file
		return json_encode($d);
	}

	private function show_launch() {
		global $LAUNCH;
		echo "<pre>";
		print_r($LAUNCH);
		echo "</pre>";
	}
}
