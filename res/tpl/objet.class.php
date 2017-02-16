<?php
/**
* @project		#project_name#
* @author		#project_author#
* @version		1.0 du #date#
* @desc			Objet #objet#
*/

class #Objet# {
[loop]	public $#var#;
[/loop]
[linked_objet]
	public $#linked_objet#;
[/linked_objet]

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

[loop]	// #var#;
	public function set#Var#($#var#) {
		$this->#var# = #opt#$#var#;
	}
	public function get#Var#() {
		return $this->#var#;
	}
[/loop]
[linked_objet]
	// #linked_objet#
	public function set#Linked_objet#($#linked_objet#) {
		$this->#linked_objet# = $#linked_objet#;
	}
	public function get#Linked_objet#() {
		return $this->#linked_objet#;
	}
[/linked_objet]

}
?>
