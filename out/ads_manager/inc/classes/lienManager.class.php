<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Gestion des liens
*/

class LienManager {
	protected $bdd;

	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}

	/**
	* Retourne l'objet lien correspondant à l'Id
	* @param $id
	*/
	public function getLien($id) {
	if ($id) {
		$q = $this->bdd->prepare("SELECT * FROM liens WHERE id = :id");
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		return new Lien($q->fetch(PDO::FETCH_ASSOC));
		}
	}

	/**
	* Retourne la liste des liens
	*/
	public function getLiens() {
		$liens = array();
		$q = $this->bdd->prepare('SELECT * FROM liens ORDER BY id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$liens[] = new Lien($data);
		}
		return $liens;
	}
	
	/* public function getLiens($isEagerFetch = true) {
		$liens = array();
		$q = $this->bdd->prepare('SELECT * FROM liens ORDER BY _id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$lien = new Lien($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$lien->set($_manager->get($lien->getId()));
				}
			$liens[] = $lien;
		}
		return $liens;
	} */

	/**
	* Retourne la liste des liens par page
	*/
	/* public function getLiensByPage($_id, $page_num, $lpp, $isEagerFetch = true) {
		$liens = array();
		$start = ($page_num-1)*$lpp;
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT * FROM liens WHERE _id = :_id ORDER BY id DESC LIMIT :start, :lpp');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT * FROM liens ORDER BY id DESC LIMIT :start, :lpp');
		}
		$q->bindValue(':start', $start, PDO::PARAM_INT);
		$q->bindValue(':lpp', $lpp, PDO::PARAM_INT);
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$lien = new Lien($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$lien->set($_manager->get($lien->getId()));
				}
			$liens[] = $lien;
		}
		return $liens;
	} */
	
	/**
	 * Retourne une liste des liens formatée pour peupler un menu déroulant
	 */
	 public function getLiensForSelect() {
		$liens = array();
		$q = $this->bdd->prepare('SELECT id, name FROM liens ORDER BY id');
		$q->execute();
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$liens[$row["id"]] =  $row["name"];
		}
		return $liens;
	}
	
	/**
	 * Retourne le nombre max de places
	 */
	public function getMaxLiens($_id) {
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT count(1) FROM liens WHERE _id = :_id');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT count(1) FROM liens');
		}
		$q->execute();
		return intval($q->fetch(PDO::FETCH_COLUMN));
	}
	
	/**
	* Efface l'objet lien de la bdd
	* @param Lien $lien
	*/
	public function deleteLien(Lien $lien) {
		$q = $this->bdd->prepare("DELETE FROM liens WHERE id = :id");
		$q->bindValue(':id', $lien->getId(), PDO::PARAM_INT);
		return $q->execute();
	}

	/**
	* Enregistre l'objet lien en bdd
	* @param Lien $lien
	*/
	public function saveLien(Lien $lien) {
		if ($lien->getId() == -1) {
			$q = $this->bdd->prepare('INSERT INTO liens SET rub_id = :rub_id, titre = :titre, url = :url, descriptif = :descriptif, etat = :etat');
		} else {
			$q = $this->bdd->prepare('UPDATE liens SET rub_id = :rub_id, titre = :titre, url = :url, descriptif = :descriptif, etat = :etat WHERE id = :id');
			$q->bindValue(':id', $lien->getId(), PDO::PARAM_INT);
		}
		$q->bindValue(':rub_id', $lien->getRubId(), PDO::PARAM_STR);
		$q->bindValue(':titre', $lien->getTitre(), PDO::PARAM_STR);
		$q->bindValue(':url', $lien->getUrl(), PDO::PARAM_STR);
		$q->bindValue(':descriptif', $lien->getDescriptif(), PDO::PARAM_STR);
		$q->bindValue(':etat', $lien->getEtat(), PDO::PARAM_STR);	
		$q->execute();
		if ($lien->getId() == -1) $lien->setId($this->bdd->lastInsertId());
	}
}
?>
