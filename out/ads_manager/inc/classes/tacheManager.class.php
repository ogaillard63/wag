<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Gestion des taches
*/

class TacheManager {
	protected $bdd;

	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}

	/**
	* Retourne l'objet tache correspondant à l'Id
	* @param $id
	*/
	public function getTache($id) {
	if ($id) {
		$q = $this->bdd->prepare("SELECT * FROM taches WHERE id = :id");
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		return new Tache($q->fetch(PDO::FETCH_ASSOC));
		}
	}

	/**
	* Retourne la liste des taches
	*/
	public function getTaches() {
		$taches = array();
		$q = $this->bdd->prepare('SELECT * FROM taches ORDER BY id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$taches[] = new Tache($data);
		}
		return $taches;
	}
	
	/* public function getTaches($isEagerFetch = true) {
		$taches = array();
		$q = $this->bdd->prepare('SELECT * FROM taches ORDER BY _id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$tache = new Tache($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$tache->set($_manager->get($tache->getId()));
				}
			$taches[] = $tache;
		}
		return $taches;
	} */

	/**
	* Retourne la liste des taches par page
	*/
	/* public function getTachesByPage($_id, $page_num, $lpp, $isEagerFetch = true) {
		$taches = array();
		$start = ($page_num-1)*$lpp;
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT * FROM taches WHERE _id = :_id ORDER BY id DESC LIMIT :start, :lpp');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT * FROM taches ORDER BY id DESC LIMIT :start, :lpp');
		}
		$q->bindValue(':start', $start, PDO::PARAM_INT);
		$q->bindValue(':lpp', $lpp, PDO::PARAM_INT);
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$tache = new Tache($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$tache->set($_manager->get($tache->getId()));
				}
			$taches[] = $tache;
		}
		return $taches;
	} */
	
	/**
	 * Retourne une liste des taches formatée pour peupler un menu déroulant
	 */
	 public function getTachesForSelect() {
		$taches = array();
		$q = $this->bdd->prepare('SELECT id, name FROM taches ORDER BY id');
		$q->execute();
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$taches[$row["id"]] =  $row["name"];
		}
		return $taches;
	}
	
	/**
	 * Retourne le nombre max de places
	 */
	public function getMaxTaches($_id) {
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT count(1) FROM taches WHERE _id = :_id');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT count(1) FROM taches');
		}
		$q->execute();
		return intval($q->fetch(PDO::FETCH_COLUMN));
	}
	
	/**
	* Efface l'objet tache de la bdd
	* @param Tache $tache
	*/
	public function deleteTache(Tache $tache) {
		$q = $this->bdd->prepare("DELETE FROM taches WHERE id = :id");
		$q->bindValue(':id', $tache->getId(), PDO::PARAM_INT);
		return $q->execute();
	}

	/**
	* Enregistre l'objet tache en bdd
	* @param Tache $tache
	*/
	public function saveTache(Tache $tache) {
		if ($tache->getId() == -1) {
			$q = $this->bdd->prepare('INSERT INTO taches SET jour = :jour, tache = :tache');
		} else {
			$q = $this->bdd->prepare('UPDATE taches SET jour = :jour, tache = :tache WHERE id = :id');
			$q->bindValue(':id', $tache->getId(), PDO::PARAM_INT);
		}
		$q->bindValue(':jour', $tache->getJour(), PDO::PARAM_STR);
		$q->bindValue(':tache', $tache->getTache(), PDO::PARAM_STR);	
		$q->execute();
		if ($tache->getId() == -1) $tache->setId($this->bdd->lastInsertId());
	}
}
?>
