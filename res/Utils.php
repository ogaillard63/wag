<?php
/**
 * User: HOME
 * Date: 08/02/2015
 * Time: 10:25
 */

class Utils {


    /*
     *  Renvoi la chaine comprise entre $from et $to
     */
    public static function getInnerSubstring($str, $from, $to) {
        $sub = substr($str, strpos($str,$from)+strlen($from), strlen($str));
        return substr($sub, 0, strpos($sub,$to));
    }

    /**
     * Effectue le remplacement des iterations de ligne
     * > $alt_types ! null on doit trouver la balise @default@ et toutes les balises contenu dans $alt_types
     *
     * @param $content
     * @param $needles
     * @param $fields
     * @param $alt_types
     * @param $exclude_fields
     * @return mixed
     */
    public static function iterationReplace($content, $needles, $fields, $alt_types, $object, $exclude_fields = null, $exclude_types = null, $exclude_notchecked = false) {
        foreach ($needles as $needle) {
            $lines = array();
            $type_str = array();
            $line = self::getInnerSubstring($content, $needle, $needle);

            if ($alt_types != null) {
                $alt_types[] = "default";
                //$type_str["default"] = self::getInnerSubstring($line, "@default@", "@default@");
                foreach ($alt_types as $type) {
                    $type_str[$type] = self::getInnerSubstring($line, "@".$type."@", "@".$type."@");
                }

               // $opt1 = self::getInnerSubstring($content, $needle, "@alt@");
               // $opt2 = self::getInnerSubstring($content, "@alt@", $needle);
            }
            foreach ($fields as $col) {
                if ($exclude_notchecked == false || $col["cb"] != 0) { // exclu les champs non cochés
                    if ($exclude_types == null || !in_array($col["Type"], $exclude_types)) {
                        if ($exclude_fields == null || !in_array($col["Field"], $exclude_fields)) {
                            if ($alt_types != null) $str = (in_array($col["Type"], $alt_types)) ? $type_str[$col["Type"]] : $type_str["default"];
                            else $str = $line;
                            $lines[] = str_replace(array("#label#", "#Label#", "#field#"),
                                array($col["Field"], utils::formatVar($col["Field"]), $object . "->" . $col["Field"]), $str);
                            // , (strlen($col["Object"]) > 0 )?$col["Object"]:$col["Field"]
                        }
                    }
                }
            }
            $content = str_replace($needle.$line.$needle, implode($lines, "\n"), $content);
        }
        return $content;
    }

/* ------------------------------------------------------------- */

	// efface ou conserve les lignes de codes selon les options choisies
    public static function fetchOptionalCode(&$content, $tag, $state) {
        $beginTag = "[".$tag."]";
        $endTag = "[/".$tag."]";
        $btwTag = false; // pointeur entre les balises

        $lines = explode("\n", $content);
        $output = array();
        foreach($lines as $line) {
            if (strpos($line, $beginTag) !== false) $btwTag = true;	
            else if (strpos($line, $endTag) !== false)  $btwTag = false;	
            else if ($btwTag && $state) $output[] = $line;
            else if (!$btwTag) $output[] = $line;
            //else echo htmlentities($line)."<br/>"; // debug rebus
        }
        $content = implode("\n", $output); //\r\n
    }


// Ecrit les itérations du code
    public static function fetchLoopCode(&$content, $var, $pieces, $opt = array()) {
        $beginTag = "[loop]";
        $endTag = "[/loop]";
        $pos1 = strpos($content, $beginTag); // cherche la première balise
        while ($pos1 !== false) {
            if (($pos2 = strpos($content, $endTag, $pos1))!==false) {
                // récupére le code entre les balises
                $needle = substr ($content, $pos1, $pos2 + + strlen($endTag) - $pos1 );
                //$code = preg_replace("/^(\r\n|\r|\n)|(\r\n|\r|\n|\t*)$/", "",$needle);
                $code = str_replace(array($beginTag, $endTag), "", $needle);  // vire les balises 
               // self::debugArray($code);

                if (strpos($needle, "#".$var."#") !== false || strpos($needle, "#".ucfirst($var)."#") !== false) {
                     $tabout = array(); // vide le tableau
                    foreach($pieces as $piece) {// Remplace $var pour chaque $pieces
                        $search  = array('#'.$var.'#', '#'.ucfirst($var).'#', "#opt#");
                         $replace = array($piece["Field"], self::formatVar(ucfirst($piece["Field"])));
                         // ajoute le code optionnel #opt# en fonction du type de variable
                        if ((isset( $opt[0])) && $piece["Type"] == "int" ) $replace[] =  $opt[0];
                        if ((isset( $opt[1])) && $piece["Type"] == "date" ) $replace[] =  $opt[1];
                        if ((isset( $opt[2])) && $piece["Type"] == "varchar" ) $replace[] =  $opt[2];
                        if ((isset( $opt[3])) && $piece["Type"] == "text" ) $replace[] =  $opt[3];
                        else $replace[] =  "";
                         $tabout[] = str_replace($search,  $replace, $code);
                        }
                    //self::debugArray($tabout);
                    // remplace avec le code généré
                    $content = str_replace( $needle, implode("", $tabout), $content);  // remplace le code    
                    }
                }
        $pos1 = strpos($content, $beginTag, $pos1 + strlen($needle)); // cherche la balise suivante
        }
    }

    /** 
    *   fetchImplode
    *   1 - Pour chaque code entre les balises [implode]
    *   2 - Pour chaque $pieces génére une chaine en remplacant $var dans le code   
    *   3 - Assemble ces chaines en intercalant $glue
    *   4 - Remplace le code trouvé et les balises avec le code généré
    **/
    public static function fetchImplode(&$content, $var, $pieces, $glue, $noId = true) {
        $tabout = array();
        $beginTag = "[implode]";
        $endTag = "[/implode]";
        $pos1 = strpos($content, $beginTag); // cherche la première balise
        while ($pos1 !== false) {
            if (($pos2 = strpos($content, $endTag, $pos1))!==false) {
                // récupére le code entre les balises
                $needle = substr ($content, $pos1, $pos2 + + strlen($endTag) - $pos1 );
                if (strpos($needle, "#".$var."#") !== false) {
                    // récupére code sans les balises
                    $code = str_replace(array($beginTag, $endTag), "", $needle);  // vire les balises  
                    foreach($pieces as $piece) // Remplace $var pour chaque $pieces
                        $tabout[] = str_replace( "#".$var."#", $piece["Field"], $code); 
                    // remplace avec le code généré
                    $content = str_replace( $needle, implode ($glue, $tabout), $content);  // remplace le code    
                    }
                }
        $pos1 = strpos($content, $beginTag, $pos1 + strlen($needle)); // cherche la balise suivante
        }
    }
/* ------------------------------------------------------------- */


// Retourne le contenu variable en post ou get
    public static function getInput($var) {
        if (isset($_GET[$var])) return $_GET[$var];
        if (isset($_POST[$var])) return $_POST[$var];
        return null;
    }

// Retourne une connection à la base de données
    public static function getMysqlCnx($server, $user, $password, $database = "") {
        $db = new mysqli($server, $user, $password, $database);
        if ($db->connect_error) {
            $msg = 'Erreur de connection (' . $db->connect_errno . ') '	. $db->connect_error;
            self::displayForm(TPL_FILEPATH, XML_FILEPATH, array("project", "connection"), "save_cnx", $msg);
        }
        return $db;
    }
// Retourne le code html du champ sous la forme d'un checkbox
    public static function getHtmlCheckbox($label, $value) {
        $html  = '<p><label>'.ucfirst($label).'</label>';
        $html .= '<input id="'.$label.'" name="'.$label.'" type="checkbox">';
        $html .= '</p>';
        return $html;
    }

// Retourne le code html du champ sous la forme d'un imput
    public static function getHtmlInput($label, $value) {
        $html  = '<p><label>'.ucfirst($label).'</label>';
        $html .= '<input id="'.$label.'" name="'.$label.'" type="text" size="20" value="'.$value.'">';
        $html .= '</p>';
        return $html;
    }

// Retourne le code html des champs sous la forme d'une liste d'imput
    public static function getHtmlInputFields($label, $values) {
        $html  = "";
        foreach (explode(",", $values)  as $value) {
            $html .= '<p><label>'.$value.'</label>';
            $html .= '<input name="'.$value.'" type="text" size="20">';
            $html .= '<input name="cb_'.$value.'" type="checkbox" checked="checked">';
            $html .= '</p>';
        }
        return $html;
    }

// Retourne le code html du champ sous la forme d'une liste déroulante
    public static function getHtmlSelect($label, $value) {
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
    public static function getParamFromXml($xmlFilePath, $param) {
        foreach (simplexml_load_file($xmlFilePath) as $section) {
            foreach ($section as $key=>$value) {
                if ($key == $param) return $value;
            }
        }
        return null;
    }

    // Sauvegarde des params du formulaire dans le fichier XML
    public static function saveParams($xmlFilePath, $params) {
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
    public static function displayForm($formTplPathFile, $xmlFilePath, $sectionsToShow, $nextAction, $msg = "") {
        $line = "";
        foreach (simplexml_load_file($xmlFilePath) as $section) {
            if (in_array(strtolower($section->title), $sectionsToShow) !== false) {
                foreach ($section as $key=>$value) {
                    //echo $key." - ".$value."<br/>";
                    if ($key == "title") $line.= "<h2>".$value."</h2>";
                    if ($value->attributes() == "input") $line .= self::getHtmlInput($key, $value);
                    if ($value->attributes() == "checkbox") $line .= self::getHtmlCheckbox($key, $value);
                    if ($value->attributes() == "field") $line .= self::getHtmlInputFields($key, $value);
                    if ($value->attributes() == "select") $line .=self::getHtmlSelect($key, $value);
                    $line .= "\n";
                }
            }
        }
        $search  = array('#form_content#', '#action#', '#message#');
        $replace = array($line, $nextAction, $msg);
        echo str_replace($search, $replace, file_get_contents($formTplPathFile));
    }

    // Retourne le résultat d'une requete sous la forme d'une liste
    public static function getRowsFromSql($db, $query, $selected = null) {
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
    public static function getFields($db, $table, $post) {
        $colnames=array();
        if ($result = mysqli_query($db, "SHOW COLUMNS FROM ". $table)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $colnames[] = array("Field" => $row['Field'], "Type" => @preg_replace('/\(([0-9]*)\)/', '', $row['Type']),
                    "Object" => (isset($post[$row['Field']]))?$post[$row['Field']]:"", "cb" => (isset($post["cb_".$row['Field']]))?1:0);
            }
        }
        return $colnames;
    }



    public static function slugify($text) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '_', $text));
    }

    // copyDir : Copie récursive
    public static function copyDir($dir2copy, $dir_paste) {
        if (is_dir($dir2copy)) {
            if ($dh = opendir($dir2copy)) {
                while (($file = readdir($dh)) !== false) {
                    if (!is_dir($dir_paste))
                        mkdir($dir_paste, 0777);
                    if (is_dir($dir2copy . $file) && $file != '..' && $file != '.')
                        self::copyDir($dir2copy . $file . '/', $dir_paste . $file . '/');
                    elseif ($file != '..' && $file != '.')
                        copy($dir2copy . $file, $dir_paste . $file);
                }
                closedir($dh);
            }
        }
    }


    public static function formatVar($var){
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
    public static function createFolders($path) {
        if (!is_dir($path) && !mkdir($path, 0777)) {
            die('Echec lors de la création des répertoires : '.$path);
        }
    }

// Debug array
    public static function  debugArray($array) {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }


}