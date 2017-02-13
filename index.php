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
define('TPL_FOLDER', RES_PATH.'/tpl');
define('XML_FILEPATH', RES_PATH.'/data.xml');
define('TPL_FILEPATH', TPL_FOLDER.'/form.tpl.html');

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

		$linked_objet 		= trim($_POST['linked_objet']);
		$linked_objets 		= trim($_POST['linked_objets']);
		$search 			= $_POST['search'];

		// Les paramètres éventuels saisies pour les champs sont dans le $_POST


		$db = utils::getMysqlCnx($_POST["db_server"], $_POST["db_user"], $_POST["db_password"], $_POST["db_base"]);
		if (!$db->connect_error) {
			// Creation du dossier de  base
			define('OUTPUT_FOLDER', 'out/' . $project_folder);
			define('OUTPUT_PATH', ROOT_PATH.'/'.OUTPUT_FOLDER);
			define('OUTPUT_LANG_PATH', OUTPUT_PATH.'/lang');
			define('OUTPUT_PROPERTIES_PATH', OUTPUT_PATH.'/inc/properties');
			define('OUTPUT_CLASSES_PATH', OUTPUT_PATH.'/inc/classes');
			define('OUTPUT_TPL_PATH', OUTPUT_PATH.'/tpl');

			if (!is_dir(OUTPUT_PATH)) {
				mkdir(OUTPUT_PATH, 0777, true);
				utils::copyDir(BASE_PATH.'/', OUTPUT_PATH.'/');
			}


			$cols = utils::getFields($db, $table, $_POST);

			//utils::debugArray($cols); die();

			// --------------------------- > Fichier de properties ---------------------------
			echo "> Fichier : <strong>properties.ini</strong><br/>";
			$tplFilePath = TPL_FOLDER.DS."properties.ini";
			$ouputFilePath = OUTPUT_PROPERTIES_PATH.DS."properties.ini";

			$content = file_get_contents($tplFilePath); // lit le template

			$search  = array("#db_server#", "#db_user#", "#db_password#", '#db_base#');
			$replace = array($db_server, $db_user, $db_password, $db_base,);
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			// --------------------------- Génération de la classe ---------------------------
			echo "> Fichier : <strong>".$objet.".class.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/objet.class.php";
			$ouputFilePath = OUTPUT_CLASSES_PATH."/".$objet.".class.php";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@vars@"), $cols, null, $objet);
			$content = utils::iterationReplace($content, array("@getters_setters@"), $cols, array("int"), $objet);

			$search  = array("#project_name#", "#project_author#", "#date#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $objet, $objets, ucfirst($objet), ucfirst($objets), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets));

			//utils::debugArray($replace);

			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération de la classe Manager --------------------------- */
			echo "> Fichier : <strong>".$objet."Manager.class.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."objetManager.class.php";
			$ouputFilePath = OUTPUT_CLASSES_PATH."/".$objet."Manager.class.php";

			$tab_vars = array();
			$query_fields = array();
			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@binds@"), $cols, array("int"), $objet, array("id"));

			foreach ($cols as $col)
				if ($col["Field"] != "id") {
					array_push($tab_vars, $col["Field"]." = :".$col["Field"]);
					array_push($query_fields, $col["Field"]." LIKE :query");
				}

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#query_fields#', '#liste_vars#', '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), implode(" OR ", $query_fields), implode(", ", $tab_vars), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du controleur --------------------------- */
			echo "> Fichier : <strong>".$objets.".php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."objet.php";
			$ouputFilePath = OUTPUT_PATH."/".$objets.".php";

			$fields = array();
			foreach ($cols as $col) array_push($fields, "\"".$col["Field"]."\""." => $".$col["Field"]);

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@vars@"), $cols, null, $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", "#liste_sql_fields#", '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), implode(", ", $fields), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template edit --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."edit.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."edit.tpl.html";
			utils::createFolders(OUTPUT_TPL_PATH."/".$objets);
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."edit.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@items@"), $cols, array("text", "date"), $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template list --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."list.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."list.tpl.html";
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."list.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@headers@", "@fields@"), $cols, array("date"), $objet, array("id"), array("text"), true);

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#', '@delete@');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets), "");
			
			if (empty($linked_objets)) $content = clearDeleteLines($content);
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));
			
			/* ------- Génération du template search --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."search.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."search.tpl.html";
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."search.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@headers@", "@fields@"), $cols, array("date"), $objet, array("id"), array("text"), true);

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#linked_objet#', '#linked_objets#', '#Linked_objet#', '#Linked_objets#', '@delete@');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), $linked_objet, $linked_objets, ucfirst($linked_objet), ucfirst($linked_objets), "");

			if (empty($linked_objets)) $content = clearDeleteLines($content);
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));
			/* ------- Ajout des traductions en francais --------------------------- */
			echo "> Fichier : <strong>fr.txt</strong><br/>";
			$langFilePath = OUTPUT_LANG_PATH."/fr.txt";
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

			file_put_contents($langFilePath, $content . $data);

			/* ------------------------------------------------------------------- */

			echo "<br/><a target='_blank' href='".OUTPUT_FOLDER.DS.$objets.".php'>Tester</a> | <a href='index.php'>Retour</a>";
			exit();
		}
		break;

	default :
		utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project"), "save_project", "");
}

/* ------------------------------------------- Fonctions ------------------------------------ */
// Efface les lignes avec la balise @delete@
function clearDeleteLines($content) {
	$lines = explode("\n", $content);
	$content = "";
	foreach($lines as $line) {
		if (strpos($line, "@delete@") === false) $content = $content.$line;
	}
	return $content;
}
?>
