<?php
/**
* @project		#project_name#
* @author		#project_author#
* @version		1.0 du #date#
* @desc			Objet #objet#
*/

class #Objet# {
@vars@	public $#label#;@vars@
// public $#linked_objet#;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

	public function hydrate(array $data){
		foreach ($data as $key => $value) {
			if (strpos($key, "_") !== false) {
				$method = 'set';
				foreach (explode("_", $key) as $part) {
					$method .= ucfirst($part);
				}
			}
			else $method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	/* --- Getters et Setters --- */

@getters_setters@@default@	// #label#
	public function set#Label#($#label#) {
		$this->#label# = $#label#;
	}
	public function get#Label#() {
		return $this->#label#;
	}@default@@int@	// #label#
	public function set#Label#($#label#) {
		$this->#label# = (integer)$#label#;
	}
	public function get#Label#() {
		return $this->#label#;
	}@int@@getters_setters@

	/*
	// #linked_objet#
	public function set#Linked_objet#($#linked_objet#) {
		$this->#linked_objet# = $#linked_objet#;
	}
	public function get#Linked_objet#() {
		return $this->#linked_objet#;
	}
	*/

}
?>
