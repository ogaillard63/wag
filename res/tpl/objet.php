<?php
/**
* @project		#project_name#
* @author		#project_author#
* @version		1.0 du #date#
* @desc			Controleur des objets : #objets#
*/

require_once( "inc/prepend.php" );
[authentification]
$user->isLoggedIn(); // Espace privé
[/authentification]
// Récupération des variables
$action			= Utils::get_input('action','both');
$page			= Utils::get_input('page','both');
$id				= Utils::get_input('id','both');
[loop]
[date]$#var#			= Utils::dateToSql(Utils::get_input('#var#','post'));
[/date]
[default]$#var#			= Utils::get_input('#var#','post');
[/default]
[/loop]
[search_engine]
$query			= Utils::get_input('query','post');
[/search_engine]

$#objet#_manager = new #Objet#Manager($bdd);
[linked_objet]
$#linked_objet#_manager = new #Linked_objet#Manager($bdd);
[/linked_objet]

switch($action) {
	
	case "add" :
		$smarty->assign("#objet#", new #Objet#(array("id" => -1)));
[linked_objet]
		$smarty->assign("#linked_objet#s", $#linked_objet#_manager->get#Linked_objet#sForSelect());
[/linked_objet]
		$smarty->assign("content", "#objets#/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;
	
	case "edit" :
		$smarty->assign("#objet#", $#objet#_manager->get#Objet#($id));
[linked_objet]
		$smarty->assign("#linked_objet#s", $#linked_objet#_manager->get#Linked_objet#sForSelect());
[/linked_objet]
		$smarty->assign("content","#objets#/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;

[search_engine]
	case "search" :
		$smarty->assign("content","#objets#/search.tpl.html");
		$smarty->display("main.tpl.html");
		break;

	case "search_results" :
		if (strlen($query) > 2) {
			$smarty->assign("#objets#", $#objet#_manager->search#Objets#($query));
		}
		else {
			$log->notification($translate->__('query_too_short'));
			Utils::redirection("#objets#.php?action=search");
		}
		$smarty->assign("query",$query);
		$smarty->assign("content","#objets#/search.tpl.html");
		$smarty->display("main.tpl.html");
		break;
[/search_engine]

	case "save" :
		$data = array([implode]"#var#" => $#var#[/implode]);
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
		$rpp = 10;
		if (empty($page)) $page = 1; // Display first page
[no_linked_objet]
		$smarty->assign("#objets#", $#objet#_manager->get#Objets#ByPage($page, $rpp));
[/no_linked_objet]
[linked_objet]
		$smarty->assign("#objets#", $#objet#_manager->get#Objets#ByPage($page, $rpp, true));
[/linked_objet]
		$pagination = new Pagination($page, $#objet#_manager->getMax#Objets#(), $rpp);
		$smarty->assign("btn_nav", $pagination->getNavigation());

		$smarty->assign("content", "#objets#/list.tpl.html");
		$smarty->display("main.tpl.html");
}
require_once( "inc/append.php" );
?>