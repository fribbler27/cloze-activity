<?php
/** save_activity ajax service */
function service(&$rv) {
	$a = new Activity("launch");
	$link_data = get_param("link_data", ["required"=>true]);
	$a->update_from_object($link_data);
	$a->save_to_db();

	$rv["link_data"] = $a->to_object();
}
