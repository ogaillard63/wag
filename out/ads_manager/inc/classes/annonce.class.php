<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Objet annonce
*/

class Annonce {
	public $id;
	public $clef;
	public $creation;
	public $designation;
	public $designation_url;
	public $description;
	public $datasheet;
	public $stock;
	public $frais;
	public $paiement;
	public $photo;
	public $prix;
	public $vendeur;
	public $vendeur_id;
	public $telephone;
	public $tel_cache;
	public $email;
	public $mdp;
	public $signal;
	public $flag_top;
	public $rubrique_id;
	public $nb_clic;
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
	// clef
	public function setClef($clef) {
		$this->clef = $clef;
	}
	public function getClef() {
		return $this->clef;
	}
	// creation
	public function setCreation($creation) {
		$this->creation = $creation;
	}
	public function getCreation() {
		return $this->creation;
	}
	// designation
	public function setDesignation($designation) {
		$this->designation = $designation;
	}
	public function getDesignation() {
		return $this->designation;
	}
	// designation_url
	public function setDesignationUrl($designation_url) {
		$this->designation_url = $designation_url;
	}
	public function getDesignationUrl() {
		return $this->designation_url;
	}
	// description
	public function setDescription($description) {
		$this->description = $description;
	}
	public function getDescription() {
		return $this->description;
	}
	// datasheet
	public function setDatasheet($datasheet) {
		$this->datasheet = $datasheet;
	}
	public function getDatasheet() {
		return $this->datasheet;
	}
	// stock
	public function setStock($stock) {
		$this->stock = $stock;
	}
	public function getStock() {
		return $this->stock;
	}
	// frais
	public function setFrais($frais) {
		$this->frais = $frais;
	}
	public function getFrais() {
		return $this->frais;
	}
	// paiement
	public function setPaiement($paiement) {
		$this->paiement = $paiement;
	}
	public function getPaiement() {
		return $this->paiement;
	}
	// photo
	public function setPhoto($photo) {
		$this->photo = $photo;
	}
	public function getPhoto() {
		return $this->photo;
	}
	// prix
	public function setPrix($prix) {
		$this->prix = $prix;
	}
	public function getPrix() {
		return $this->prix;
	}
	// vendeur
	public function setVendeur($vendeur) {
		$this->vendeur = $vendeur;
	}
	public function getVendeur() {
		return $this->vendeur;
	}
	// vendeur_id
	public function setVendeurId($vendeur_id) {
		$this->vendeur_id = $vendeur_id;
	}
	public function getVendeurId() {
		return $this->vendeur_id;
	}
	// telephone
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	// tel_cache
	public function setTelCache($tel_cache) {
		$this->tel_cache = $tel_cache;
	}
	public function getTelCache() {
		return $this->tel_cache;
	}
	// email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	// mdp
	public function setMdp($mdp) {
		$this->mdp = $mdp;
	}
	public function getMdp() {
		return $this->mdp;
	}
	// signal
	public function setSignal($signal) {
		$this->signal = $signal;
	}
	public function getSignal() {
		return $this->signal;
	}
	// flag_top
	public function setFlagTop($flag_top) {
		$this->flag_top = $flag_top;
	}
	public function getFlagTop() {
		return $this->flag_top;
	}
	// rubrique_id
	public function setRubriqueId($rubrique_id) {
		$this->rubrique_id = $rubrique_id;
	}
	public function getRubriqueId() {
		return $this->rubrique_id;
	}
	// nb_clic
	public function setNbClic($nb_clic) {
		$this->nb_clic = $nb_clic;
	}
	public function getNbClic() {
		return $this->nb_clic;
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
