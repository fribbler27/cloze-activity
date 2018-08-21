<?php
class Activity {
	function __construct($data = "") {
		$this->data = [];
		// if $data is "launch", initialize based on the launched link
		if ($data == "launch") {
			global $LAUNCH;
			$data = json_decode($LAUNCH->link->getJson(), true);
			$this->data["title"] = $LAUNCH->link->title;
			$this->data["id"] = $LAUNCH->link->id;
		}

		if (is_array($data)) {
			$this->update_from_object($data);

		} else if (is_numeric($data)) {
			// assume $data is a link_id; look up based on that link_id
		}

		// add required data properties that haven't been filled in
		if (empty($this->data["questions"])) {
			$this->data["questions"] = [];
		}
	}

	public function to_object() {
		return $this->data;
	}

	public function update_from_object($data, $from_scratch = false) {
		if ($from_scratch) {
			$this->data = [
				// just keep the id
				"id" => $this->data["id"] ?? ""
			];
		}

		foreach ($data as $key=>$val) {
			if ($val == "*clear*") {
				unset($this->data[$key]);
			} else {
				$this->data[$key] = $val;
			}
		}
	}

	public function save_to_db() {
		global $LAUNCH;
		$json = [];

		foreach ($this->data as $key=>$val) {
			if ($key != "title" && $key != "id") {
				$json[$key] = $val;
			}
		}

		$LAUNCH->link->setJson(json_encode($json));
	}
}
