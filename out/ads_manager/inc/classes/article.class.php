<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Objet article
*/

class Article {
	public $id;
	public $creation;
	public $publication;
	public $titre;
	public $lien;
	public $texte;
	public $flux_id;
	public $vus;

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
	// creation
	public function setCreation($creation) {
		$this->creation = $creation;
	}
	public function getCreation() {
		return $this->creation;
	}
	// publication
	public function setPublication($publication) {
		$this->publication = $publication;
	}
	public function getPublication() {
		return $this->publication;
	}
	// titre
	public function setTitre($titre) {
		$this->titre = $titre;
	}
	public function getTitre() {
		return $this->titre;
	}
	// lien
	public function setLien($lien) {
		$this->lien = $lien;
	}
	public function getLien() {
		return $this->lien;
	}
	// texte
	public function setTexte($texte) {
		$this->texte = $texte;
	}
	public function getTexte() {
		return $this->texte;
	}
	// flux_id
	public function setFluxId($flux_id) {
		$this->flux_id = $flux_id;
	}
	public function getFluxId() {
		return $this->flux_id;
	}
	// vus
	public function setVus($vus) {
		$this->vus = $vus;
	}
	public function getVus() {
		return $this->vus;
	}
}
?>
