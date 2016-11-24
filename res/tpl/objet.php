<?php
/**
* @project		#project_name#
* @author		#project_author#
* @version		1.0 du #date#
* @desc			Controleur des objets : #objets#
*/

require_once( "inc/prepend.php" );
//$user->isLoggedIn(); // Espace privé

// Récupération des variables
$action			= Utils::get_input('action','both');
$id				= Utils::get_input('id','both');
$page			= Utils::get_input('page','both');
@vars@$#label#			= Utils::get_input('#label#','post');@vars@

$#objet#_manager = new #Objet#Manager($bdd);
// $#objet2#_manager = new #Objet2#Manager($bdd);

switch($action) {
	
	case "add" :
		$smarty->assign("#objet#", new #Objet#(array("id" => -1)));
		//$smarty->assign("#objet2#s", $#objet2#_manager->get#Objet2#sForSelect());
		$smarty->assign("content", "#objets#/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;
	
	case "edit" :
		$smarty->assign("#objet#", $#objet#_manager->get#Objet#($id));
		//$smarty->assign("#objet2#s", $#objet2#_manager->get#Objet2#sForSelect());
		$smarty->assign("content","#objets#/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;

	case "save" :
		$data = array(#liste_sql_fields#);
		$#objet#_manager->save#Objet#(new #Objet#($data));
		$log->notification($translate->__('the_#objet#_has_been_saved'));
		Utils::redirection("#objets#.php");
		break;

	case "delete" :
		$#objet# = $#objet#_manager->get#Objet#($id);
		if ($#objet#_manager->delete#Objet#($#objet#)) {
			$log->notification($translate->__('the_#objet#_has_been_deleted'));
		}
		Utils::redirection("#objets#.php");
		break;

	default:
		$smarty->assign("titre", $translate->__('list_of_#objets#'));
		$rpp = 5;
		if (empty($page)) $page = 1; // Display first page
		$smarty->assign("#objets#", $#objet#_manager->get#Objets#ByPage($page, $rpp));
		//$smarty->assign("#objets#", $#objet#_manager->get#Objets#ByPage($page, $rpp, true));
		$pagination = new Pagination($page, $#objet#_manager->getMax#Objets#(), $rpp);
		$smarty->assign("btn_nav", $pagination->getNavigation());

		$smarty->assign("content", "#objets#/list.tpl.html");
		$smarty->display("main.tpl.html");
}
require_once( "inc/append.php" );
?>