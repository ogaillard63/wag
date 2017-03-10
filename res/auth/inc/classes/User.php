<?php
/**
* @project		Dinero
* @author		Olivier Gaillard
* @version		1.0 du 11/12/2014
* @desc	   		Objet User
*/
namespace App;

class User {
	
	public $id; 
	public $firstname;
	public $lastname;
	public $login;
	public $email;
	public $profil_id;
	public $password;
	public $expiration;
	public $last_cnx;
	public $last_update;
	
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

	/* --- getters & setters --- */
	
	// id	
	public function setId($id) {
		$this->id = (integer)$id;
	}
	public function getId() {
		return $this->id;
	}
	// firstname
	public function setFirstname($firstname) {
	    $this->firstname = $firstname;
	}
	public function getFirstname() {
	    return $this->firstname;
	}
	// lastname
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}
	public function getLastname() {
		return $this->lastname;
	}
	// login
	public function setLogin($login) {
	    $this->login = $login;
	}
	public function getLogin() {
	    return $this->login;
	}
	// email
	public function setEmail($email) {
	    $this->email = $email;
	}
	public function getEmail() {
	    return $this->email;
	}
	// profil_id
	public function setProfilId($profil_id) {
	    $this->profil_id = $profil_id;
	}
	public function getProfilId() {
	    return $this->profil_id;
	}
	// password
	public function setPassword($password) {
	    $this->password = $password;
	}
	public function getPassword() {
	    return $this->password;
	}
	// expiration
	public function setExpiration($expiration) {
	    $this->expiration = $expiration;
	}
	public function getExpiration() {
	    return $this->expiration;
	}
	// last_cnx
	public function setLastCnx($last_cnx) {
	    $this->last_cnx = $last_cnx;
	}
	public function getLastCnx() {
	    return $this->last_cnx;
	}
	// last_update
	public function setLastUpdate($last_update) {
	    $this->last_update = $last_update;
	}
	public function getLastUpdate() {
	    return $this->last_update;
	}
		
	/* --- methodes --- */
	
}
?>