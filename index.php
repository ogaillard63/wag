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
define('OUTPUT_FOLDER', 'out/ads_manager');
define('OUTPUT_PATH', ROOT_PATH.'/'.OUTPUT_FOLDER);
define('OUTPUT_LANG_PATH', OUTPUT_PATH.'/lang');

define('OUTPUT_PROPERTIES_PATH', OUTPUT_PATH.'/inc/properties');
define('OUTPUT_CLASSES_PATH', OUTPUT_PATH.'/inc/classes');
define('OUTPUT_TPL_PATH', OUTPUT_PATH.'/tpl');
define('RES_PATH', ROOT_PATH.'/res');
define('TPL_FOLDER', RES_PATH.'/tpl');
define('XML_FILEPATH', RES_PATH.'/data.xml');
define('TPL_FILEPATH', TPL_FOLDER.'/form.tpl.html');

// Récupération de l'action
$action = getInput("action");

switch ($action) {

	case "save_project" :
		$xml = saveParams(XML_FILEPATH, $_POST);
		displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection"), "save_connection");
		break;

	case "save_connection" :
		$db = getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"]);
		if (!$db->connect_error) {
			// Enregistre la liste des bases de données
			saveParams(XML_FILEPATH, array("database" => getRowsFromSql($db, "SHOW DATABASES", getParamFromXml(XML_FILEPATH, "database"))));
			$db->close();
			// Enregistre les paramètres du formulaire		
			saveParams(XML_FILEPATH, $_POST);
			displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database"), "save_database");
		}
		break;

	case "save_database" :
		$db = getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"], $_POST["database"]);
		if (!$db->connect_error) {
			// Enregistre la liste des tables
			saveParams(XML_FILEPATH, array("table" => getRowsFromSql($db, "SHOW tables FROM " . $_POST["database"], getParamFromXml(XML_FILEPATH, "table"))));
			$db->close();
			saveParams(XML_FILEPATH, $_POST);
			displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database", "table"), "save_table");
		}
		break;

	case "save_table" :
		$db = getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"], $_POST["database"]);
		if (!$db->connect_error) {
			// Affiche la liste des champs
			saveParams(XML_FILEPATH, array("fields" => getRowsFromSql($db, "SHOW columns FROM " . $_POST["table"])));
			$db->close();
			$xml = saveParams(XML_FILEPATH, $_POST);
			displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection", "database", "table", "fields"), "build");
		}
		break;

	case "build" :

		$xml = simplexml_load_file(XML_FILEPATH);

		$server 	= $_POST['server'];
		$user 		= $_POST['user'];
		$password 	= $_POST['password'];
		$database 	= $_POST['database'];

		$project_name 		= $_POST['project_name'];
		$project_author 	= $_POST['project_author'];
		$table 				= $_POST['table'];
		$objet 				= $_POST['objet'];
		$objets 			= $_POST['objets'];

		$objet2 			= $_POST['objet2'];
		$objet3 			= $_POST['objet3'];

		// Les evntuelles parametres saisies pour les champs sont dans le $_POST


		$db = getMysqlCnx($_POST["server"], $_POST["user"], $_POST["password"], $_POST["database"]);
		if (!$db->connect_error) {
			$cols = getFields($db, $table, $_POST);

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
			$content = iterationReplace($content, array("@vars@"), $cols, null, $objet);
			$content = iterationReplace($content, array("@getters_setters@"), $cols, array("int"), $objet);

			$search  = array("#project_name#", "#project_author#", "#date#", "#objet#", "#objets#", "#Objet#", "#Objets#", '#objet2#', '#objet3#', '#Objet2#', '#Objet3#');
			$replace = array($project_name, $project_author, date("d/m/Y"), $objet, $objets, ucfirst($objet), ucfirst($objets), $objet2, $objet3, ucfirst($objet2), ucfirst($objet3));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération de la classe Manager --------------------------- */
			echo "> Fichier : <strong>".$objet."Manager.class.php</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."objetManager.class.php";
			$ouputFilePath = OUTPUT_CLASSES_PATH."/".$objet."Manager.class.php";

			$tab_vars = array();
			$content = file_get_contents($tplFilePath); // lit le template
			$content = iterationReplace($content, array("@binds@"), $cols, array("int"), $objet, array("id"));

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
			$content = iterationReplace($content, array("@vars@"), $cols, null, $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#", "#liste_sql_fields#", '#objet3#' );
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets), implode(", ", $fields), $objet3);
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template edit --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."edit.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."edit.tpl.html";
			createFolders(OUTPUT_TPL_PATH."/".$objets);
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."edit.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = iterationReplace($content, array("@items@"), $cols, array("text"), $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#");
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets));
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Génération du template list --------------------------- */
			echo "> Fichier : <strong>".$objets."/"."list.tpl.html</strong><br/>";

			$tplFilePath = TPL_FOLDER."/"."list.tpl.html";
			$ouputFilePath = OUTPUT_TPL_PATH."/".$objets."/"."list.tpl.html";

			$content = file_get_contents($tplFilePath); // lit le template
			$content = iterationReplace($content, array("@headers@", "@fields@"), $cols, null, $objet, array("id"));

			$search  = array("#project_name#", "#project_author#", "#date#", "#table#", "#objet#", "#objets#", "#Objet#", "#Objets#" );
			$replace = array($project_name, $project_author, date("d/m/Y"), $table, $objet, $objets, ucfirst($objet), ucfirst($objets) );
			file_put_contents($ouputFilePath, str_replace($search, $replace, $content));

			/* ------- Ajout des traductions --------------------------- */
			echo "> Fichier : <strong>fr.txt</strong><br/>";
			$langFilePath = OUTPUT_LANG_PATH."/fr.txt";
			$content = file_get_contents($langFilePath); // lit le fichier de langue

			$data = "\n#".$objet."\n";
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


			file_put_contents($langFilePath, $content . $data);

			/* ------------------------------------------------------------------- */

			echo "<br/><a href='".OUTPUT_FOLDER.DS.$objets.".php'>Tester</a>";
			exit();
		}
		break;

	default :
		displayForm(TPL_FILEPATH, XML_FILEPATH, array("project"), "save_project", "");
}

/* ------------------------------------------- Fonctions ------------------------------------ */

// Renvoi la chaine comprise entre $from et $to
function getInnerSubstring($str, $from, $to) {
	$sub = substr($str, strpos($str,$from)+strlen($from), strlen($str));
	return substr($sub, 0, strpos($sub,$to));
}
// Effectue le remplacement des iterations de ligne
function iterationReplace($content, $needles, $fields, $alt_types, $object, $exclude_fields = null) {
	foreach ($needles as $needle) {
		$lines = array();

		if ($alt_types != null) {
			$opt1 = getInnerSubstring($content, $needle, "@alt@");
			$opt2 = getInnerSubstring($content, "@alt@", $needle);
		}
		$line = getInnerSubstring($content, $needle, $needle);
		foreach ($fields as $col) {
			if ($exclude_fields == null || !in_array($col["Field"], $exclude_fields)) {
				if ($alt_types != null ) $str = (in_array($col["Type"], $alt_types))?$opt2:$opt1;
				else $str = $line;
				$lines[] = str_replace(array("#label#", "#Label#", "#field#"),
					array($col["Field"], formatVar($col["Field"]), $object."->".$col["Field"]), $str);
				// , (strlen($col["Object"]) > 0 )?$col["Object"]:$col["Field"]
			}
		}
		$content = str_replace($needle.$line.$needle, implode($lines, "\n"), $content);
	}
	return $content;
}

// Retourne le contenu variable en post ou get
function getInput($var) {
	if (isset($_GET[$var])) return $_GET[$var];
	if (isset($_POST[$var])) return $_POST[$var];
	return null;
}

// Retourne une connection à la base de données
function getMysqlCnx($server, $user, $password, $database = "") {
	$db = new mysqli($server, $user, $password, $database);
	if ($db->connect_error) {
		$msg = 'Erreur de connection (' . $db->connect_errno . ') '	. $db->connect_error;
		displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection"), "save_cnx", $msg);
	}
	return $db;
}

// Retourne le code html du champ sous la forme d'un imput
function getHtmlInput($label, $value) {
	$html  = '<p><label>'.ucfirst($label).'</label>';
	$html .= '<input id="'.$label.'" name="'.$label.'" type="text" size="20" value="'.$value.'">';
	$html .= '</p>';
	return $html;
}

// Retourne le code html des champs sous la forme d'une liste d'imput
function getHtmlInputFields($label, $values) {
	$html  = "";
	foreach (explode(",", $values)  as $value) {
		$html .= '<p><label>'.$value.'</label>';
		$html .= '<input name="'.$value.'" type="text" size="20">';
		$html .= '</p>';
	}
	return $html;
}

// Retourne le code html du champ sous la forme d'une liste déroulante
function getHtmlSelect($label, $value) {
	$html  = '<p><label>'.ucfirst($label).'</label>';
	$html .= '<select id="'.$label.'" name="'.$label.'" onChange="'.$label.'Changed();">';
	foreach (explode(",", $value) as $option) {
		if (strpos($option, '#') !== false) { // derniere base selectionnée
			$html .= '<option value="'.substr($option,1).'" selected>'.substr($option,1).'</option>';
		}
		else $html .= '<option value="'.$option.'">'.$option.'</option>';
	}
	$html .= '</select></p>';
	return $html;
}
// Retourne la valeur du paramètre dans le fichier XML
function getParamFromXml($xmlFilePath, $param) {
	foreach (simplexml_load_file($xmlFilePath) as $section) {
		foreach ($section as $key=>$value) {
			if ($key == $param) return $value;
		}
	}
	return null;
}

// Sauvegarde des params du formulaire dans le fichier XML
function saveParams($xmlFilePath, $params) {
	$index = 0;
	$isModified = false;
	$xml = simplexml_load_file($xmlFilePath);
	foreach ($xml as $section) {
		foreach ($section as $key => $value) {
			//echo $key." -> ".$value."<br/>";
			if (isset($params[$key]) && $params[$key] != $value) {
				$xml->section[$index]->$key = $params[$key];
				$isModified = true;
			}
		}

		$index++;
	}
	if ($isModified) $xml->asXml($xmlFilePath);
	return $xml;
}

// Affiche les sections du formulaire sur la base du fichier XML
function displayForm($formTplPathFile, $xmlFilePath, $sectionsToShow, $nextAction, $msg = "") {
	$line = "";
	foreach (simplexml_load_file($xmlFilePath) as $section) {
		if (in_array(strtolower($section->title), $sectionsToShow) !== false) {
			foreach ($section as $key=>$value) {
				//echo $key." - ".$value."<br/>";
				if ($key == "title") $line.= "<h2>".$value."</h2>";
				if ($value->attributes() == "input") $line .= getHtmlInput($key, $value);
				if ($value->attributes() == "field") $line .= getHtmlInputFields($key, $value);
				if ($value->attributes() == "select") $line .= getHtmlSelect($key, $value);
				$line .= "\n";
			}
		}
	}
	$search  = array('#form_content#', '#action#', '#message#');
	$replace = array($line, $nextAction, $msg);
	echo str_replace($search, $replace, file_get_contents($formTplPathFile));
}

// Retourne le résultat d'une requete sous la forme d'une liste
function getRowsFromSql($db, $query, $selected = null) {
	$rows = array();
	if ($result = $db->query($query)) {
		while ($row = $result->fetch_row()) {
			if ($selected != null && $selected == $row[0]) $rows[] = "#".$row[0];
			else $rows[] = $row[0];
		}
		$result->free();
	}
	return implode(",", $rows);
}

// Retourne la liste des champs sous la forme d'un tableau (field/type)
function getFields($db, $table, $post) {
	$colnames=array();
	if ($result = mysqli_query($db, "SHOW COLUMNS FROM ". $table)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$colnames[] = array("Field" => $row['Field'], "Type" => @preg_replace('/(/([0-9]*/))/', '', $row['Type']),
				"Object" => (isset($post[$row['Field']]))?$post[$row['Field']]:"");
		}
	}
	//print_table($colnames);
	return $colnames;
}

function formatVar($var){
	if (strpos($var, "_") !== false) {
		$newVar = "";
		foreach (explode("_", $var) as $part) {
			$newVar .= ucfirst($part);
		}
		return $newVar;
	}
	return ucfirst($var);
}

// Crée les dossiers du path
function createFolders($path) {
	if (!is_dir($path) && !mkdir($path, 0777)) {
		die('Echec lors de la création des répertoires : '.$path);
	}
}

// Debug array
function print_table($array) {
	echo"<pre>";
	print_r($array);
	echo"</pre>";
}
?>
