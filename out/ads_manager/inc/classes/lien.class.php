<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Objet lien
*/

class Lien {
	public $id;
	public $rub_id;
	public $titre;
	public $url;
	public $descriptif;
	public $etat;

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
	// rub_id
	public function setRubId($rub_id) {
		$this->rub_id = $rub_id;
	}
	public function getRubId() {
		return $this->rub_id;
	}
	// titre
	public function setTitre($titre) {
		$this->titre = $titre;
	}
	public function getTitre() {
		return $this->titre;
	}
	// url
	public function setUrl($url) {
		$this->url = $url;
	}
	public function getUrl() {
		return $this->url;
	}
	// descriptif
	public function setDescriptif($descriptif) {
		$this->descriptif = $descriptif;
	}
	public function getDescriptif() {
		return $this->descriptif;
	}
	// etat
	public function setEtat($etat) {
		$this->etat = $etat;
	}
	public function getEtat() {
		return $this->etat;
	}
}
?>
