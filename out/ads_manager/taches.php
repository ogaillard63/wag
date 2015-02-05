<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Controleur des objets : taches
*/

require_once( "inc/prepend.php" );
//$user->isLoggedIn(); // Espace privé

// Récupération des variables
$action			= Utils::get_input('action','both');
$id				= Utils::get_input('id','both');
$page			= Utils::get_input('page','both');
$jour			= Utils::get_input('jour','post');
$tache			= Utils::get_input('tache','post');

$taches_manager = new TacheManager($bdd);

switch($action) {
	
	case "add" :
		$smarty->assign("tache", new Tache(array("id" => -1)));
		$smarty->assign("content", "taches/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;
	
	case "edit" :
		$smarty->assign("tache", $taches_manager->getTache($id));
		$smarty->assign("content","taches/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;

	case "save" :
		$data = array("id" => $id, "jour" => $jour, "tache" => $tache);
		$taches_manager->saveTache(new Tache($data));
		$log->notification($translate->__('the_tache_has_been_saved'));
		Utils::redirection("taches.php");
		break;

	case "delete" :
		$tache = $taches_manager->getTache($id);
		if ($taches_manager->deleteTache($tache)) {
			$log->notification($translate->__('the_tache_has_been_deleted'));
		}
		Utils::redirection("taches.php");
		break;

	default:
		$smarty->assign("titre", $translate->__('list_of_taches'));
		/*$rpp = 5;
		if (empty($page)) $page = 1; // Display first pagination page
		$smarty->assign("taches", $taches_manager->getTachesByPage($_id, $page, $rpp));
		$pagination = new Pagination($page, $taches_manager->getMaxTaches($_id), $rpp);
		$smarty->assign("btn_nav", $pagination->getNavigation());
		//$smarty->assign("_id", $_id);
		*/
		$smarty->assign("taches", $taches_manager->getTaches());
		$smarty->assign("content", "taches/list.tpl.html");
		$smarty->display("main.tpl.html");
}
require_once( "inc/append.php" );
?>