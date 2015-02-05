<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Gestion des annonces
*/

class AnnonceManager {
	protected $bdd;

	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}

	/**
	* Retourne l'objet annonce correspondant à l'Id
	* @param $id
	*/
	public function getAnnonce($id) {
	if ($id) {
		$q = $this->bdd->prepare("SELECT * FROM annonces WHERE id = :id");
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		return new Annonce($q->fetch(PDO::FETCH_ASSOC));
		}
	}

	/**
	* Retourne la liste des annonces
	*/
	public function getAnnonces() {
		$annonces = array();
		$q = $this->bdd->prepare('SELECT * FROM annonces ORDER BY id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$annonces[] = new Annonce($data);
		}
		return $annonces;
	}
	
	/* public function getAnnonces($isEagerFetch = true) {
		$annonces = array();
		$q = $this->bdd->prepare('SELECT * FROM annonces ORDER BY _id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$annonce = new Annonce($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$annonce->set($_manager->get($annonce->getId()));
				}
			$annonces[] = $annonce;
		}
		return $annonces;
	} */

	/**
	* Retourne la liste des annonces par page
	*/
	/* public function getAnnoncesByPage($_id, $page_num, $lpp, $isEagerFetch = true) {
		$annonces = array();
		$start = ($page_num-1)*$lpp;
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT * FROM annonces WHERE _id = :_id ORDER BY id DESC LIMIT :start, :lpp');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT * FROM annonces ORDER BY id DESC LIMIT :start, :lpp');
		}
		$q->bindValue(':start', $start, PDO::PARAM_INT);
		$q->bindValue(':lpp', $lpp, PDO::PARAM_INT);
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$annonce = new Annonce($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$annonce->set($_manager->get($annonce->getId()));
				}
			$annonces[] = $annonce;
		}
		return $annonces;
	} */
	
	/**
	 * Retourne une liste des annonces formatée pour peupler un menu déroulant
	 */
	 public function getAnnoncesForSelect() {
		$annonces = array();
		$q = $this->bdd->prepare('SELECT id, name FROM annonces ORDER BY id');
		$q->execute();
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$annonces[$row["id"]] =  $row["name"];
		}
		return $annonces;
	}
	
	/**
	 * Retourne le nombre max de places
	 */
	public function getMaxAnnonces($_id) {
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT count(1) FROM annonces WHERE _id = :_id');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT count(1) FROM annonces');
		}
		$q->execute();
		return intval($q->fetch(PDO::FETCH_COLUMN));
	}
	
	/**
	* Efface l'objet annonce de la bdd
	* @param Annonce $annonce
	*/
	public function deleteAnnonce(Annonce $annonce) {
		$q = $this->bdd->prepare("DELETE FROM annonces WHERE id = :id");
		$q->bindValue(':id', $annonce->getId(), PDO::PARAM_INT);
		return $q->execute();
	}

	/**
	* Enregistre l'objet annonce en bdd
	* @param Annonce $annonce
	*/
	public function saveAnnonce(Annonce $annonce) {
		if ($annonce->getId() == -1) {
			$q = $this->bdd->prepare('INSERT INTO annonces SET clef = :clef, creation = :creation, designation = :designation, designation_url = :designation_url, description = :description, datasheet = :datasheet, stock = :stock, frais = :frais, paiement = :paiement, photo = :photo, prix = :prix, vendeur = :vendeur, vendeur_id = :vendeur_id, telephone = :telephone, tel_cache = :tel_cache, email = :email, mdp = :mdp, signal = :signal, flag_top = :flag_top, rubrique_id = :rubrique_id, nb_clic = :nb_clic, etat = :etat');
		} else {
			$q = $this->bdd->prepare('UPDATE annonces SET clef = :clef, creation = :creation, designation = :designation, designation_url = :designation_url, description = :description, datasheet = :datasheet, stock = :stock, frais = :frais, paiement = :paiement, photo = :photo, prix = :prix, vendeur = :vendeur, vendeur_id = :vendeur_id, telephone = :telephone, tel_cache = :tel_cache, email = :email, mdp = :mdp, signal = :signal, flag_top = :flag_top, rubrique_id = :rubrique_id, nb_clic = :nb_clic, etat = :etat WHERE id = :id');
			$q->bindValue(':id', $annonce->getId(), PDO::PARAM_INT);
		}
		$q->bindValue(':clef', $annonce->getClef(), PDO::PARAM_STR);
		$q->bindValue(':creation', $annonce->getCreation(), PDO::PARAM_STR);
		$q->bindValue(':designation', $annonce->getDesignation(), PDO::PARAM_STR);
		$q->bindValue(':designation_url', $annonce->getDesignationUrl(), PDO::PARAM_STR);
		$q->bindValue(':description', $annonce->getDescription(), PDO::PARAM_STR);
		$q->bindValue(':datasheet', $annonce->getDatasheet(), PDO::PARAM_STR);
		$q->bindValue(':stock', $annonce->getStock(), PDO::PARAM_STR);
		$q->bindValue(':frais', $annonce->getFrais(), PDO::PARAM_STR);
		$q->bindValue(':paiement', $annonce->getPaiement(), PDO::PARAM_STR);
		$q->bindValue(':photo', $annonce->getPhoto(), PDO::PARAM_STR);
		$q->bindValue(':prix', $annonce->getPrix(), PDO::PARAM_STR);
		$q->bindValue(':vendeur', $annonce->getVendeur(), PDO::PARAM_STR);
		$q->bindValue(':vendeur_id', $annonce->getVendeurId(), PDO::PARAM_INT);
		$q->bindValue(':telephone', $annonce->getTelephone(), PDO::PARAM_STR);
		$q->bindValue(':tel_cache', $annonce->getTelCache(), PDO::PARAM_STR);
		$q->bindValue(':email', $annonce->getEmail(), PDO::PARAM_STR);
		$q->bindValue(':mdp', $annonce->getMdp(), PDO::PARAM_STR);
		$q->bindValue(':signal', $annonce->getSignal(), PDO::PARAM_STR);
		$q->bindValue(':flag_top', $annonce->getFlagTop(), PDO::PARAM_STR);
		$q->bindValue(':rubrique_id', $annonce->getRubriqueId(), PDO::PARAM_INT);
		$q->bindValue(':nb_clic', $annonce->getNbClic(), PDO::PARAM_STR);
		$q->bindValue(':etat', $annonce->getEtat(), PDO::PARAM_STR);
		$q->execute();
		if ($annonce->getId() == -1) $annonce->setId($this->bdd->lastInsertId());
	}
}
?>
