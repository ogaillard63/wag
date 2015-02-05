<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Controleur des objets : articles
*/

require_once( "inc/prepend.php" );
//$user->isLoggedIn(); // Espace privé

// Récupération des variables
$action			= Utils::get_input('action','both');
$id				= Utils::get_input('id','both');
$page			= Utils::get_input('page','both');
$creation			= Utils::get_input('creation','post');
$publication			= Utils::get_input('publication','post');
$titre			= Utils::get_input('titre','post');
$lien			= Utils::get_input('lien','post');
$texte			= Utils::get_input('texte','post');
$flux_id			= Utils::get_input('flux_id','post');
$vus			= Utils::get_input('vus','post');

$articles_manager = new ArticleManager($bdd);

switch($action) {
	
	case "add" :
		$smarty->assign("article", new Article(array("id" => -1)));
		$smarty->assign("content", "articles/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;
	
	case "edit" :
		$smarty->assign("article", $articles_manager->getArticle($id));
		$smarty->assign("content","articles/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;

	case "save" :
		$data = array("id" => $id, "creation" => $creation, "publication" => $publication, "titre" => $titre, "lien" => $lien, "texte" => $texte, "flux_id" => $flux_id, "vus" => $vus);
		$articles_manager->saveArticle(new Article($data));
		$log->notification($translate->__('the_article_has_been_saved'));
		Utils::redirection("articles.php");
		break;

	case "delete" :
		$article = $articles_manager->getArticle($id);
		if ($articles_manager->deleteArticle($article)) {
			$log->notification($translate->__('the_article_has_been_deleted'));
		}
		Utils::redirection("articles.php");
		break;

	default:
		$smarty->assign("titre", $translate->__('list_of_articles'));
		/*$rpp = 5;
		if (empty($page)) $page = 1; // Display first pagination page
		$smarty->assign("articles", $articles_manager->getArticlesByPage($_id, $page, $rpp));
		$pagination = new Pagination($page, $articles_manager->getMaxArticles($_id), $rpp);
		$smarty->assign("btn_nav", $pagination->getNavigation());
		//$smarty->assign("_id", $_id);
		*/
		$smarty->assign("articles", $articles_manager->getArticles());
		$smarty->assign("content", "articles/list.tpl.html");
		$smarty->display("main.tpl.html");
}
require_once( "inc/append.php" );
?>