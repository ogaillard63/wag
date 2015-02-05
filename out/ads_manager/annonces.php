<?php
/**
* @project		Ads Manager
* @author		Olivier Gaillard
* @version		1.0 du 05/02/2015
* @desc			Controleur des objets : annonces
*/

require_once( "inc/prepend.php" );
//$user->isLoggedIn(); // Espace privé

// Récupération des variables
$action			= Utils::get_input('action','both');
$id				= Utils::get_input('id','both');
$page			= Utils::get_input('page','both');
$clef			= Utils::get_input('clef','post');
$creation			= Utils::get_input('creation','post');
$designation			= Utils::get_input('designation','post');
$designation_url			= Utils::get_input('designation_url','post');
$description			= Utils::get_input('description','post');
$datasheet			= Utils::get_input('datasheet','post');
$stock			= Utils::get_input('stock','post');
$frais			= Utils::get_input('frais','post');
$paiement			= Utils::get_input('paiement','post');
$photo			= Utils::get_input('photo','post');
$prix			= Utils::get_input('prix','post');
$vendeur			= Utils::get_input('vendeur','post');
$vendeur_id			= Utils::get_input('vendeur_id','post');
$telephone			= Utils::get_input('telephone','post');
$tel_cache			= Utils::get_input('tel_cache','post');
$email			= Utils::get_input('email','post');
$mdp			= Utils::get_input('mdp','post');
$signal			= Utils::get_input('signal','post');
$flag_top			= Utils::get_input('flag_top','post');
$rubrique_id			= Utils::get_input('rubrique_id','post');
$nb_clic			= Utils::get_input('nb_clic','post');
$etat			= Utils::get_input('etat','post');

$annonces_manager = new AnnonceManager($bdd);

switch($action) {
	
	case "add" :
		$smarty->assign("annonce", new Annonce(array("id" => -1)));
		$smarty->assign("content", "annonces/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;
	
	case "edit" :
		$smarty->assign("annonce", $annonces_manager->getAnnonce($id));
		$smarty->assign("content","annonces/edit.tpl.html");
		$smarty->display("main.tpl.html");
		break;

	case "save" :
		$data = array("id" => $id, "clef" => $clef, "creation" => $creation, "designation" => $designation, "designation_url" => $designation_url, "description" => $description, "datasheet" => $datasheet, "stock" => $stock, "frais" => $frais, "paiement" => $paiement, "photo" => $photo, "prix" => $prix, "vendeur" => $vendeur, "vendeur_id" => $vendeur_id, "telephone" => $telephone, "tel_cache" => $tel_cache, "email" => $email, "mdp" => $mdp, "signal" => $signal, "flag_top" => $flag_top, "rubrique_id" => $rubrique_id, "nb_clic" => $nb_clic, "etat" => $etat);
		$annonces_manager->saveAnnonce(new Annonce($data));
		$log->notification($translate->__('the_annonce_has_been_saved'));
		Utils::redirection("annonces.php");
		break;

	case "delete" :
		$annonce = $annonces_manager->getAnnonce($id);
		if ($annonces_manager->deleteAnnonce($annonce)) {
			$log->notification($translate->__('the_annonce_has_been_deleted'));
		}
		Utils::redirection("annonces.php");
		break;

	default:
		$smarty->assign("titre", $translate->__('list_of_annonces'));
		/*$rpp = 5;
		if (empty($page)) $page = 1; // Display first pagination page
		$smarty->assign("annonces", $annonces_manager->getAnnoncesByPage($_id, $page, $rpp));
		$pagination = new Pagination($page, $annonces_manager->getMaxAnnonces($_id), $rpp);
		$smarty->assign("btn_nav", $pagination->getNavigation());
		//$smarty->assign("_id", $_id);
		*/
		$smarty->assign("annonces", $annonces_manager->getAnnonces());
		$smarty->assign("content", "annonces/list.tpl.html");
		$smarty->display("main.tpl.html");
}
require_once( "inc/append.php" );
?>