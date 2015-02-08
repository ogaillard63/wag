<?php
/**
 * @project		WebApp Generator
 *
 * @author		Olivier Gaillard <olivier.gaillard@centrefrance.com>
 * @version		1.0 du 18/11/2014
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

require(RES_PATH.'/Utils.php');
$utils = new Utils(); // fonctions utilitaires

// Récupération de l'action
$action = utils::getInput("action");

switch ($action) {

	case "save_project" :
		$xml = utils::saveParams(XML_FILEPATH, $_POST);
		utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection"), "save_connection");
		break;

	case "save_connection" :
		$db = utils::getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"]);
		if (!$db->connect_error) {
			// Enregistre la liste des bases de données
			utils::saveParams(XML_FILEPATH, array("database" => utils::getRowsFromSql($db, "SHOW DATABASES", utils::getParamFromXml(XML_FILEPATH, "database"))));
			$db->close();
			// Enregistre les paramètres du formulaire		
			utils::saveParams(XML_FILEPATH, $_POST);
			utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database"), "save_database");
		}
		break;

	case "save_database" :
		$db = utils::getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"], $_POST["database"]);
		if (!$db->connect_error) {
			// Enregistre la liste des tables
			utils::saveParams(XML_FILEPATH, array("table" => utils::getRowsFromSql($db, "SHOW tables FROM " . $_POST["database"], utils::getParamFromXml(XML_FILEPATH, "table"))));
			$db->close();
			utils::saveParams(XML_FILEPATH, $_POST);
			utils::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database", "table"), "save_table");
		}
		break;

	case "save_table" :
		$db = utils::getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"], $_POST["database"]);
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

		$server 	= $_POST['server'];
		$user 		= $_POST['user'];
		$password 	= $_POST['password'];
		$database 	= $_POST['database'];

		$project_name 		= $_POST['project_name'];
		$project_folder		= utils::slugify($project_name);
		$project_author 	= $_POST['project_author'];
		$table 				= $_POST['table'];
		$objet 				= $_POST['objet'];
		$objets 			= $_POST['objets'];

		$objet2 			= $_POST['objet2'];
		$objet3 			= $_POST['objet3'];

		// Les evntuelles parametres saisies pour les champs sont dans le $_POST


		$db = utils::getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"], $_POST["database"]);
		if (!$db->connect_error) {
			// Creation du dossier de  base
			define('OUTPUT_FOLDER', 'out/' . $project_folder);
			define('OUTPUT_PATH', ROOT_PATH.'/'.OUTPUT_FOLDER);
			define('OUTPUT_LANG_PATH', OUTPUT_PATH.'/lang');
			define('OUTPUT_PROPERTIES_PATH', OUTPUT_PATH.'/inc/properties');
			define('OUTPUT_CLASSES_PATH', OUTPUT_PATH.'/inc/classes');
			define('OUTPUT_TPL_PATH', OUTPUT_PATH.'/tpl');

			if (!is_dir(OUTPUT_FOLDER)) {
				utils::copyDir(BASE_PATH.'/', OUTPUT_PATH.'/');
			}


			$cols = utils::getFields($db, $table, $_POST);

			// --------------------------- > Fichier de properties ---------------------------
			echo "> Fichier : <strong>properties.ini</strong><br/>";
			$tplFilePath = TPL_FOLDER.DS."properties.ini";
			$ouputFilePath = OUTPUT_PROPERTIES_PATH.DS."properties.ini";

			$content = file_get_contents($tplFilePath); // lit le template

			$search  = array("#server#", "#user#", "#password#", '#database#');
			$replace = array($server, $user, $password, $database,);
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			// --------------------------- Génération de la classe ---------------------------
			echo "> Fichier : <strong>".$objet.".class.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/objet.class.php";
			$ouputFilePath = OUTPUT_CLASSES_PATH."/".$objet.".class.php";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@vars@"), $cols, null, $objet);
			$content = utils::iterationReplace($content, array("@getters_setters@"), $cols, array("int"), $objet);

			$search  = array("#project_name#", "#project_author#", "#date#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#objet2#', '#objet3#', '#Objet2#', '#Objet3#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $objet, $objets, ucfirst($objet), ucfirst($objets), $objet2, $objet3, ucfirst($objet2), ucfirst($objet3));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération de la classe Manager --------------------------- */
			echo "> Fichier : <strong>".$objet."Manager.class.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."objetManager.class.php";
			$ouputFilePath = OUTPUT_CLASSES_PATH."/".$objet."Manager.class.php";

			$tab_vars = array();
			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@binds@"), $cols, array("int"), $objet, array("id"));

			foreach ($cols as $col)
				if ($col["Field"] != "id") array_push($tab_vars, $col["Field"]." = :".$col["Field"]);

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#liste_vars#', '#objet2#', '#objet3#', '#Objet2#', '#Objet3#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), implode(", ", $tab_vars), $objet2, $objet3, ucfirst($objet2), ucfirst($objet3));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du controleur --------------------------- */
			echo "> Fichier : <strong>".$objets.".php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."objet.php";
			$ouputFilePath = OUTPUT_PATH."/".$objets.".php";

			$fields = array();
			foreach ($cols as $col) array_push($fields, "\"".$col["Field"]."\""." => $".$col["Field"]);

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@vars@"), $cols, null, $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", "#liste_sql_fields#", '#objet3#' );
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), implode(", ", $fields), $objet3);
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template edit --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."edit.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."edit.tpl.html";
			utils::createFolders(OUTPUT_TPL_PATH."/".$objets);
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."edit.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@items@"), $cols, array("text", "date"), $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#");
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template list --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."list.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."list.tpl.html";
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."list.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = utils::iterationReplace($content, array("@headers@", "@fields@"), $cols, array("date"), $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#" );
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets) );
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Ajout des traductions --------------------------- */
			echo "> Fichier : <strong>fr.txt</strong><br/>";
			$langFilePath = OUTPUT_LANG_PATH."/fr.txt";
			$content = file_get_contents($langFilePath); // lit le fichier de langue

			$data = "\n#".$objets."\n"; // titre de la section
			$data .= $objet." = ".$objet."\n";
			$data .= $objets." = ".$objets."\n";

			foreach ($cols as $col) {
				if ($col["Field"] != "id") $data .= $col["Field"]." = ".$col["Field"]."\n";
			}

			$data .= "list_of_".$objets." = list_of_".$objets."\n";
			$data .= "add_a_".$objet." = add_a_".$objet."\n";
			$data .= "delete_a_".$objet." = delete_a_".$objet."\n";
			$data .= "no_".$objet." = no_".$objet."\n";
			$data .= "edit_a_".$objet." = edit_a_".$objet."\n";
			$data .= "the_".$objet."_has_been_saved = the_".$objet."_has_been_saved.\n";
			$data .= "the_".$objet."_has_been_deleted = the_".$objet."_has_been_deleted.\n";
			$data .= "do_you_really_want_to_delete_this_".$objet." = do_you_really_want_to_delete_this_".$objet."\n";

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

?>
