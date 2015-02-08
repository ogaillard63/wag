<?php
/**
* @project		#project_name#
* @author		#project_author#
* @version		1.0 du #date#
* @desc			Gestion des #objets#
*/

class #Objet#Manager {
	protected $bdd;

	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}

	/**
	* Retourne l'objet #objet# correspondant à l'Id
	* @param $id
	*/
	public function get#Objet#($id) {
	if ($id) {
		$q = $this->bdd->prepare("SELECT * FROM #table# WHERE id = :id");
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		return new #Objet#($q->fetch(PDO::FETCH_ASSOC));
		}
	}

	/**
	* Retourne la liste des #objets#
	*/
	public function get#Objets#($offset = null, $count = null) {
		$#objets# = array();
		if (isset($offset) && isset($count)) {
			$q = $this->bdd->prepare('SELECT * FROM #table# ORDER BY id DESC LIMIT :offset, :count');
			$q->bindValue(':offset', $offset, PDO::PARAM_INT);
			$q->bindValue(':count', $count, PDO::PARAM_INT);
		}
		else {
			$q = $this->bdd->prepare('SELECT * FROM #table# ORDER BY id');
		}

		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$#objets#[] = new #Objet#($data);
		}
		return $#objets#;
	}
	
	/**
	 * Retourne la liste des #objets# par page
	 */
	 public function get#Objets#ByPage($page_num, $count) {
		return $this->get#Objets#(($page_num-1)*$count, $count);
	 }

	/**
	 * Retourne le nombre max de places
	 */
	public function getMax#Objets#() {
		$q = $this->bdd->prepare('SELECT count(1) FROM #objets#');
		$q->execute();
		return intval($q->fetch(PDO::FETCH_COLUMN));
	}


	/**
	* Efface l'objet #objet# de la bdd
	* @param #Objet# $#objet#
	*/
	public function delete#Objet#(#Objet# $#objet#) {
		$q = $this->bdd->prepare("DELETE FROM #table# WHERE id = :id");
		$q->bindValue(':id', $#objet#->getId(), PDO::PARAM_INT);
		return $q->execute();
	}

	/**
	* Enregistre l'objet #objet# en bdd
	* @param #Objet# $#objet#
	*/
	public function save#Objet#(#Objet# $#objet#) {
		if ($#objet#->getId() == -1) {
			$q = $this->bdd->prepare('INSERT INTO #table# SET #liste_vars#');
		} else {
			$q = $this->bdd->prepare('UPDATE #table# SET #liste_vars# WHERE id = :id');
			$q->bindValue(':id', $#objet#->getId(), PDO::PARAM_INT);
		}
@binds@@default@		$q->bindValue(':#label#', $#objet#->get#Label#(), PDO::PARAM_STR);@default@@int@		$q->bindValue(':#label#', $#objet#->get#Label#(), PDO::PARAM_INT);@int@@binds@
		$q->execute();
		if ($#objet#->getId() == -1) $#objet#->setId($this->bdd->lastInsertId());
	}


	/* ----------- fonctions optionnelles ----------- */

	/**
	 * Retourne la liste des #objets# avec les objets de type #Objet2# avec EagerFetch
	 */
	/* public function get#Objets#($isEagerFetch = false, $offset = null, $count = null) {
		$#objets# = array();
		if (isset($offset) && isset($count)) {
			$q = $this->bdd->prepare('SELECT * FROM #table# ORDER BY id DESC LIMIT :offset, :count');
			$q->bindValue(':offset', $offset, PDO::PARAM_INT);
			$q->bindValue(':count', $count, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT * FROM #table# ORDER BY id');
			}
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$#objet# = new #Objet#($data);
			if ($isEagerFetch) {
				$#objet2#_manager = new #Objet2#Manager($this->bdd);
				$#objet#->set#Objet2#($#objet2#_manager->get#Objet2#($#objet#->get#Objet2#Id()));
				}
			$#objets#[] = $#objet#;
		}
		return $#objets#;
	} */

	/**
	 * Retourne la liste des #objets# par page avec EagerFetch
	 */
	/* public function get#Objets#ByPage($page_num, $count, $isEagerFetch = false) {
		return $this->get#Objets#($isEagerFetch, ($page_num-1)*$count, $count);
	} */

	/**
	 * Retourne une liste des #objets# formatée pour peupler un menu déroulant
	 */
	/*public function get#Objets#ForSelect() {
		$#objets# = array();
		$q = $this->bdd->prepare('SELECT id, name FROM #table# ORDER BY id');
		$q->execute();
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$#objets#[$row["id"]] =  $row["name"];
		}
		return $#objets#;
	}*/


	/**
	 * Retourne la liste des #objets# par parent
	 */
	/*public function get#Objets#ByParent() {
		$#objets# = array();
		$q1 = $this->bdd->prepare('SELECT * FROM #table# WHERE parent_id = 0');
		$q1->execute();
		while ($data = $q1->fetch(PDO::FETCH_ASSOC)) {
			$#objet# = new #Objet#($data);
			$#objets#[] = $#objet#;
			$q2 = $this->bdd->prepare('SELECT * FROM #table# WHERE parent_id = :parent_id');
			$q2->bindValue(':parent_id', $#objet#->getId(), PDO::PARAM_INT);
			$q2->execute();
			while ($data = $q2->fetch(PDO::FETCH_ASSOC)) {
				$#objets#[] = new #Objet#($data);
			}
		}
		return  $#objets#;
	}
	*/

}
?>