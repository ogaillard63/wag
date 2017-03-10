<?php
/**
 * @project		Mini WebApp Generator
 *
 * @author		Olivier Gaillard <ogaillar63d@gmail.com>
 * @desc	   	Generateur de webapp
 */

// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('DS', '/');
define('ROOT_PATH', dirname (__FILE__));
define('RES_PATH', ROOT_PATH.'/res');
define('BASE_PATH', RES_PATH.'/base');
define('AUTH_PATH', RES_PATH.'/auth');
define('TPL_FOLDER', RES_PATH.'/tpl');
define('XML_FILEPATH', RES_PATH.'/data.xml');
define('TPL_FILEPATH', RES_PATH.'/form.html');

// vars
$hasSearchEngine = false;
$hasLinkedObject = false;
$hasAuth = false;

require(RES_PATH . '/utils.php');
$utils = new Utils(); // fonctions utilitaires

// Récupération de l'action
$action = utils::getInput("action");

switch ($action) {

	case "save_project" :
		$xml = utils::saveParams(XML_FILEPATH, $_POST);
		utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection"), "save_connection");
		break;

	case "save_connection" :
		$db = utils::getMysqlCnx($_POST["db_server"], $_POST["db_user"], $_POST["db_password"]);
		if (!$db->connect_error) {
			// Enregistre la liste des bases de données
			utils::saveParams(XML_FILEPATH, array("db_base" => utils::getRowsFromSql($db, "SHOW DATABASES", utils::getParamFromXml(XML_FILEPATH, "db_base"))));
			$db->close();
			// Enregistre les paramètres du formulaire		
			utils::saveParams(XML_FILEPATH, $_POST);
			utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database"), "save_db_base");
		}
		break;

	case "save_db_base" :
		$db = utils::getMysqlCnx($_POST["db_server"], $_POST["db_user"], $_POST["db_password"], $_POST["db_base"]);
		if (!$db->connect_error) {
			// Enregistre la liste des tables
			utils::saveParams(XML_FILEPATH, array("table" => utils::getRowsFromSql($db, "SHOW tables FROM " . $_POST["db_base"], utils::getParamFromXml(XML_FILEPATH, "table"))));
			$db->close();
			utils::saveParams(XML_FILEPATH, $_POST);
			utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database", "table"), "save_table");
		}
		break;

	case "save_table" :
		$db = utils::getMysqlCnx($_POST["db_server"], $_POST["db_user"], $_POST["db_password"], $_POST["db_base"]);
		if (!$db->connect_error) {
			// Affiche la liste des champs
			utils::saveParams(XML_FILEPATH, array("fields" => utils::getRowsFromSql($db, "SHOW columns FROM " . $_POST["table"])));
			$db->close();
			$xml = utils::saveParams(XML_FILEPATH, $_POST);
			utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database", "table", "fields"), "build");
		}
		break;

	case "build" :

		$xml = simplexml_load_file(XML_FILEPATH);

		$db_server 			= $_POST['db_server'];
		$db_user 			= $_POST['db_user'];
		$db_password 		= $_POST['db_password'];
		$db_base 			= $_POST['db_base'];

		$project_name 		= $_POST['project_name'];
		$project_folder		= utils::slugify($project_name);
		$project_author 	= trim($_POST['project_author']);
		$table 				= trim($_POST['table']);
		$objet 				= trim($_POST['objet']);
		$objets 			= trim($_POST['objets']);

		$linked_objet 		= utils::getInput('linked_objet');
		$linked_objets 		= utils::getInput('linked_objets');
		$search_engine 		= utils::getInput('search_engine');
		$authentification 		= utils::getInput('authentification');

		// has Linked Object
		if (strlen($linked_objet)>0) $hasLinkedObject = true;
		// has Search Engine
		if (strlen($search_engine)>0) $hasSearchEngine = true;	
		// has Authentification
		if (strlen($authentification)>0) $hasAuth = true;	
		
		$db = utils::getMysqlCnx($_POST["db_server"], $_POST["db_user"], $_POST["db_password"], $_POST["db_base"]);
		if (!$db->connect_error) {
			// Creation du dossier de  base
			define('O_FOLDER', 'out/' . $project_folder);
			define('O_PATH', ROOT_PATH.'/'.O_FOLDER);
			define('O_LANG_PATH', O_PATH.'/lang');
			define('O_INC_PATH', O_PATH.'/inc');
			define('O_PROPERTIES_PATH', O_INC_PATH.'/properties');
			define('O_CLASSES_PATH', O_INC_PATH.'/classes');
			define('O_TPL_PATH', O_PATH.'/tpl');
	
			// copie des elements de base
			if (!is_dir(O_PATH)) {
				mkdir(O_PATH, 0777, true);
			}
			utils::copyDir(BASE_PATH.'/', O_PATH.'/');
			if ($hasAuth) utils::copyDir(AUTH_PATH.'/', O_PATH.'/');

			// récupére la liste de colonne 
			$cols = utils::getFields($db, $table, $_POST);
			$colsNoId = $cols; 	// liste des colonnes sans la colonne Id
			array_shift($colsNoId); // enleve la colone id

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets));

			//utils::debugArray($cols); die();

			// liste des fichiers
			 /*
			 $files = (
				array ( "file"=> "properties.ini", "path"=>  O_PROPERTIES_PATH, "tpl"=>  "properties.ini"),
				array ( "file"=> $objet.".class.php", "path"=>  O_CLASSES_PATH, "tpl"=>  "objet.class.php"),
				);

			*/
			
			// --------------------------- > Fichier de properties ---------------------------
			echo "> Fichier : <strong>properties.ini</strong><br/>";
			$tplFilePath = TPL_FOLDER.DS."properties.ini";
			$ouputFilePath = O_PROPERTIES_PATH.DS."properties.ini";

			$content = file_get_contents($tplFilePath); // lit le template

			$search1  = array("#db_server#", "#db_user#", "#db_password#", '#db_base#');
			$replace1 = array($db_server, $db_user, $db_password, $db_base,);
			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search1, $replace1, $content));

			// --------------------------- Génération de la classe ---------------------------
			echo "> Fichier : <strong>".ucfirst($objet).".php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/Objet.php";
			$ouputFilePath = O_CLASSES_PATH."/".ucfirst($objet).".php";

			$content = file_get_contents($tplFilePath); // lit le template
			//utils::debugArray($cols);
			utils::fetchLoopCode($content, "var", $cols);

			// efface ou conserve les lignes de codes selon les options choisies
			utils::fetchOptionalCode($content, "linked_objet", $hasLinkedObject);
			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération de la classe Manager --------------------------- */
			echo "> Fichier : <strong>".ucfirst($objet)."Manager.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."ObjetManager.php";
			$ouputFilePath = O_CLASSES_PATH."/".ucfirst($objet)."Manager.php";

			$content = file_get_contents($tplFilePath); // lit le template
			utils::fetchImplode($content, "var1", $colsNoId, " OR ");
			utils::fetchImplode($content, "var2", $colsNoId, ", ");
			utils::fetchLoopCode($content, "var3", $colsNoId);

			// efface ou conserve les lignes de codes selon les options choisies
			utils::fetchOptionalCode($content, "linked_objet", $hasLinkedObject);
			utils::fetchOptionalCode($content, "no_linked_objet", !$hasLinkedObject);
			utils::fetchOptionalCode($content, "search_engine", $hasSearchEngine);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du controleur --------------------------- */
			echo "> Fichier : <strong>".$objets.".php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."objets.php";
			$ouputFilePath = O_PATH."/".$objets.".php";
			$content = file_get_contents($tplFilePath); // lit le template

			utils::fetchLoopCode($content, "var", $colsNoId);
			utils::fetchImplode($content, "var", $cols, ", ");
			
			// efface les lignes de codes optionnelles
			utils::fetchOptionalCode($content, "linked_objet", $hasLinkedObject);
			utils::fetchOptionalCode($content, "no_linked_objet", !$hasLinkedObject);
			utils::fetchOptionalCode($content, "search_engine", $hasSearchEngine);
			utils::fetchOptionalCode($content, "authentification", $hasAuth);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template edit --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."edit.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."edit.tpl.html";
			utils::createFolders(O_TPL_PATH."/".$objets);
			$ouputFilePath = O_TPL_PATH."/".$objets."/"."edit.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			//$content = utils::iterationReplace($content, array("@items@"), $cols, array("text", "date"), $objet, array("id"));
			utils::fetchLoopCode($content, "var", $colsNoId);

			// efface les lignes de codes optionnelles
			utils::fetchOptionalCode($content, "linked_objet", $hasLinkedObject);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template list --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."list.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."list.tpl.html";
			$ouputFilePath = O_TPL_PATH."/".$objets."/"."list.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template

			utils::fetchLoopCode($content, "field", $colsNoId);
			// efface les lignes de codes optionnelles
			utils::fetchOptionalCode($content, "linked_objet", $hasLinkedObject);
			utils::fetchOptionalCode($content, "search_engine", $hasSearchEngine);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));
			
			/* ------- Génération du template search --------------------------- */
			if ($hasSearchEngine) {
				echo "> Fichier : <strong>".$objets."/"."search.tpl.html</strong><br/>";

				$tplFilePath = TPL_FOLDER."/"."search.tpl.html";
				$ouputFilePath = O_TPL_PATH."/".$objets."/"."search.tpl.html";

				$content = file_get_contents($tplFilePath); // lit le template
				utils::fetchLoopCode($content, "field", $colsNoId);

				// efface les lignes de codes optionnelles
				utils::fetchOptionalCode($content, "linked_objet", $hasLinkedObject);
				
				// remplace les balises
				file_put_contents($ouputFilePath, str_replace($search, $replace, $content));
			}
			
			/* ------- Génération du template header --------------------------- */
			echo "> Fichier : <strong>header.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."header.tpl.html";
			$ouputFilePath = O_TPL_PATH."/header.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template

			// efface les lignes de codes optionnelles
			utils::fetchOptionalCode($content, "authentification", $hasAuth);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du fichier prepend --------------------------- */
			echo "> Fichier : <strong>prepend.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/prepend.php";
			$ouputFilePath = O_INC_PATH."/prepend.php";

			$content = file_get_contents($tplFilePath); // lit le template
			
			// efface les lignes de codes optionnelles
			utils::fetchOptionalCode($content, "authentification", $hasAuth);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du fichier composer.json --------------------------- */
			echo "> Fichier : <strong>composer.json</strong><br/>";

			$tplFilePath = TPL_FOLDER."/composer.json";
			$ouputFilePath = O_PATH."/composer.json";

			$content = file_get_contents($tplFilePath); // lit le template
			
			// efface les lignes de codes optionnelles
			utils::fetchOptionalCode($content, "authentification", $hasLinkedObject);

			// remplace les balises
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Ajout des traductions en francais --------------------------- */
			echo "> Fichier : <strong>fr.txt</strong><br/>";
			$langFilePath = O_LANG_PATH."/fr.txt";
			$content = file_get_contents($langFilePath); // lit le fichier de langue

			$data = "\n#".$objets."\n"; // titre de la section
			$data .= $objet." = ".$objet."\n";
			$data .= $objets." = ".$objets."\n";

			foreach ($cols as $col) {
				if ($col["Field"] != "id") $data .= $col["Field"]." = ".$col["Field"]."\n";
			}

			$data .= "list_of_".$objets." = liste des ".$objets."\n";
			$data .= "add_a_".$objet." = ajouter un ".$objet."\n";
			$data .= "delete_a_".$objet." = effacer un ".$objet."\n";
			$data .= "no_".$objet." = aucun ".$objet."\n";
			$data .= "edit_a_".$objet." = modifier un ".$objet."\n";
			$data .= "the_".$objet."_has_been_saved = le ".$objet." a été enregistré.\n";
			$data .= "the_".$objet."_has_been_deleted = le ".$objet." a été effacé.\n";
			$data .= "do_you_really_want_to_delete_this_".$objet." = voulez-vous vraiment effacer ce ".$objet."\n";

			// remplace les balises
			file_put_contents($langFilePath, $content . $data);

			/* ------------------------------------------------------------------- */

			echo "<br/><a href='index.php'>Retour</a>";
			echo "<br/><br/><i>Effectuer un <b>composer update</b> dans le dossier de l'application avant de </i>";
			echo "<a href='".O_FOLDER.DS.$objets.".php' target='_blank'>tester</a>";
			exit();
		}
		break;

	default :
		utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project"), "save_project", "");
}

?>
