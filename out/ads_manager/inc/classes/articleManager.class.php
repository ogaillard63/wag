<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Gestion des articles
*/

class ArticleManager {
	protected $bdd;

	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}

	/**
	* Retourne l'objet article correspondant à l'Id
	* @param $id
	*/
	public function getArticle($id) {
	if ($id) {
		$q = $this->bdd->prepare("SELECT * FROM articles WHERE id = :id");
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		return new Article($q->fetch(PDO::FETCH_ASSOC));
		}
	}

	/**
	* Retourne la liste des articles
	*/
	public function getArticles() {
		$articles = array();
		$q = $this->bdd->prepare('SELECT * FROM articles ORDER BY id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$articles[] = new Article($data);
		}
		return $articles;
	}
	
	/* public function getArticles($isEagerFetch = true) {
		$articles = array();
		$q = $this->bdd->prepare('SELECT * FROM articles ORDER BY _id');
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$article = new Article($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$article->set($_manager->get($article->getId()));
				}
			$articles[] = $article;
		}
		return $articles;
	} */

	/**
	* Retourne la liste des articles par page
	*/
	/* public function getArticlesByPage($_id, $page_num, $lpp, $isEagerFetch = true) {
		$articles = array();
		$start = ($page_num-1)*$lpp;
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT * FROM articles WHERE _id = :_id ORDER BY id DESC LIMIT :start, :lpp');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT * FROM articles ORDER BY id DESC LIMIT :start, :lpp');
		}
		$q->bindValue(':start', $start, PDO::PARAM_INT);
		$q->bindValue(':lpp', $lpp, PDO::PARAM_INT);
		$q->execute();
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$article = new Article($data);
			if ($isEagerFetch) {
				$_manager = new Manager($this->bdd);
				$article->set($_manager->get($article->getId()));
				}
			$articles[] = $article;
		}
		return $articles;
	} */
	
	/**
	 * Retourne une liste des articles formatée pour peupler un menu déroulant
	 */
	 public function getArticlesForSelect() {
		$articles = array();
		$q = $this->bdd->prepare('SELECT id, name FROM articles ORDER BY id');
		$q->execute();
		while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$articles[$row["id"]] =  $row["name"];
		}
		return $articles;
	}
	
	/**
	 * Retourne le nombre max de places
	 */
	public function getMaxArticles($_id) {
		if ($_id > 0) {
			$q = $this->bdd->prepare('SELECT count(1) FROM articles WHERE _id = :_id');
			$q->bindValue(':_id', $_id, PDO::PARAM_INT);
			}
		else {
			$q = $this->bdd->prepare('SELECT count(1) FROM articles');
		}
		$q->execute();
		return intval($q->fetch(PDO::FETCH_COLUMN));
	}
	
	/**
	* Efface l'objet article de la bdd
	* @param Article $article
	*/
	public function deleteArticle(Article $article) {
		$q = $this->bdd->prepare("DELETE FROM articles WHERE id = :id");
		$q->bindValue(':id', $article->getId(), PDO::PARAM_INT);
		return $q->execute();
	}

	/**
	* Enregistre l'objet article en bdd
	* @param Article $article
	*/
	public function saveArticle(Article $article) {
		if ($article->getId() == -1) {
			$q = $this->bdd->prepare('INSERT INTO articles SET creation = :creation, publication = :publication, titre = :titre, lien = :lien, texte = :texte, flux_id = :flux_id, vus = :vus');
		} else {
			$q = $this->bdd->prepare('UPDATE articles SET creation = :creation, publication = :publication, titre = :titre, lien = :lien, texte = :texte, flux_id = :flux_id, vus = :vus WHERE id = :id');
			$q->bindValue(':id', $article->getId(), PDO::PARAM_INT);
		}
		$q->bindValue(':creation', $article->getCreation(), PDO::PARAM_STR);
		$q->bindValue(':publication', $article->getPublication(), PDO::PARAM_STR);
		$q->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
		$q->bindValue(':lien', $article->getLien(), PDO::PARAM_STR);
		$q->bindValue(':texte', $article->getTexte(), PDO::PARAM_STR);
		$q->bindValue(':flux_id', $article->getFluxId(), PDO::PARAM_STR);
		$q->bindValue(':vus', $article->getVus(), PDO::PARAM_STR);	
		$q->execute();
		if ($article->getId() == -1) $article->setId($this->bdd->lastInsertId());
	}
}
?>
