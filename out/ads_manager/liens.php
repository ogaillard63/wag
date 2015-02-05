<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Controleur des objets : liens
*/

require_once( "inc/prepend.php" );
//$user->isLoggedIn(); // Espace privé

// Récupération des variables
$action			= Utils::get_input('action','both');
$id				= Utils::get_input('id','both');
$page			= Utils::get_input('page','both');
$rub_id			= Utils::get_input('rub_id','post');
$titre			= Utils::get_input('titre','post');
$url			= Utils::get_input('url','post');
$descriptif			= Utils::get_input('descriptif','post');
$etat			= Utils::get_input('etat','post');

$liens_manager = new LienManager($bdd);

switch($action) {
	
	case "add" :
		$smarty->assign("lien", new Lien(array("id" => -1)));
		$smarty->assign("content", "liens/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;
	
	case "edit" :
		$smarty->assign("lien", $liens_manager->getLien($id));
		$smarty->assign("content","liens/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;

	case "save" :
		$data = array("id" => $id, "rub_id" => $rub_id, "titre" => $titre, "url" => $url, "descriptif" => $descriptif, "etat" => $etat);
		$liens_manager->saveLien(new Lien($data));
		$log->notification($translate->__('the_lien_has_been_saved'));
		Utils::redirection("liens.php");
		break;

	case "delete" :
		$lien = $liens_manager->getLien($id);
		if ($liens_manager->deleteLien($lien)) {
			$log->notification($translate->__('the_lien_has_been_deleted'));
		}
		Utils::redirection("liens.php");
		break;

	default:
		$smarty->assign("titre", $translate->__('list_of_liens'));
		/*$rpp = 5;
		if (empty($page)) $page = 1; // Display first pagination page
		$smarty->assign("liens", $liens_manager->getLiensByPage($_id, $page, $rpp));
		$pagination = new Pagination($page, $liens_manager->getMaxLiens($_id), $rpp);
		$smarty->assign("btn_nav", $pagination->getNavigation());
		//$smarty->assign("_id", $_id);
		*/
		$smarty->assign("liens", $liens_manager->getLiens());
		$smarty->assign("content", "liens/list.tpl.html");
		$smarty->display("main.tpl.html");
}
require_once( "inc/append.php" );
?>