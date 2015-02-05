<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Objet tache
*/

class Tache {
	public $id;
	public $jour;
	public $tache;

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

	// id
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	// jour
	public function setJour($jour) {
		$this->jour = $jour;
	}
	public function getJour() {
		return $this->jour;
	}
	// tache
	public function setTache($tache) {
		$this->tache = $tache;
	}
	public function getTache() {
		return $this->tache;
	}
}
?>
