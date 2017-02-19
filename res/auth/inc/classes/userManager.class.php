<?php
/**
* @project		test
* @author		Olivier Gaillard
* @version		1.0 du 19/02/2017
* @desc			Gestion des users
*/

class UserManager {
	protected $bdd;

	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}

	/**
	* Retourne l'objet user correspondant à l'Id
	* @param $id
	*/
	public function getUser($id) {
		$q = $this->bdd->prepare("SELECT * FROM users WHERE id = :id");
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		return new User($q->fetch(PDO::FETCH_ASSOC));
	}

	/**
	* Retourne la liste des users
	*/
	public function getUsers($offset = null, $count = null) {
		$users = array();
		if (isset($offset) && isset($count)) {
			$q = $this->bdd->prepare('SELECT * FROM users ORDER BY id DESC LIMIT :offset, :count');
			$q->bindValue(':offset', $offset, PDO::PARAM_INT);
			$q->bindValue(':count', $count, PDO::PARAM_INT);
		}
		else {
			$q = $this->bdd->prepare('SELECT * FROM users ORDER BY id');
		}

		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$users[] = new User($data);
		}
		return $users;
	}

	/**
	 * Retourne la liste des users par page
	 */
	 public function getUsersByPage($page_num, $count) {
		return $this->getUsers(($page_num-1)*$count, $count);
	 }

	/**
	 * Retourne le nombre max de users
	 */
	public function getMaxUsers() {
		$q = $this->bdd->prepare('SELECT count(1) FROM users');
		$q->execute();
		return intval($q->fetch(PDO::FETCH_COLUMN));
	}

	/**
	* Efface l'objet user de la bdd
	* @param User $user
	*/
	public function deleteUser(User $user) {
		try {	
			$q = $this->bdd->prepare("DELETE FROM users WHERE id = :id");
			$q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			return $q->execute();
			}
		catch( PDOException $Exception ) {
			return false;
		}
	}

	/**
	* Enregistre l'objet user en bdd
	* @param User $user
	*/
	public function saveUser(User $user) {
		if ($user->getId() == -1) {
			$q = $this->bdd->prepare('INSERT INTO users SET lastname = :lastname, firstname = :firstname, login = :login, email = :email, password = :password, profil_id = :profil_id, expiration = :expiration, last_cnx = :last_cnx, last_update = :last_update');
		} else {
			$q = $this->bdd->prepare('UPDATE users SET lastname = :lastname, firstname = :firstname, login = :login, email = :email, password = :password, profil_id = :profil_id, expiration = :expiration, last_cnx = :last_cnx, last_update = :last_update WHERE id = :id');
			$q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
		}
		$q->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
		$q->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
		$q->bindValue(':login', $user->getLogin(), PDO::PARAM_STR);
		$q->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
		$q->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
		$q->bindValue(':profil_id', $user->getProfilId(), PDO::PARAM_INT);
		$q->bindValue(':expiration', $user->getExpiration(), PDO::PARAM_STR);
		$q->bindValue(':last_cnx', $user->getLastCnx(), PDO::PARAM_STR);
		$q->bindValue(':last_update', $user->getLastUpdate(), PDO::PARAM_STR);


		$q->execute();
		if ($user->getId() == -1) $user->setId($this->bdd->lastInsertId());
	}

	/**
	 * Retourne une liste des users formatés pour peupler un menu déroulant
	 */
	public function getUsersForSelect() {
		$users = array();
		$q = $this->bdd->prepare('SELECT id, name FROM users ORDER BY id');
		$q->execute();
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$users[$row["id"]] =  $row["name"];
		}
		return $users;
	}
}
?>