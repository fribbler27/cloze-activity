<?php
require_once "../config.php";
require_once "src/controllers.php";

// The Tsugi PHP API Documentation is available at:
// http://do1.dr-chuck.com/tsugi/phpdoc/

use \Tsugi\Core\LTIX;

// No parameter means we require CONTEXT, USER, and LINK
$LAUNCH = LTIX::requireData();

$c = new Controller;
if ( $USER->instructor ) {
	$c->instructor_view();
} else { // Student
	$c->student_view();
}
