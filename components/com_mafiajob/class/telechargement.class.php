<?php
class MafDownload{
    
    // juste un tableau pour regrouper les prpriétés du téléchargement
    private $properties = array("path" => "",       // le chemin réél du fichier
                                "name" => "",       // pour renommer le fichier on the fly
                                "extension" => "",  // extension du fichier
                                "type" => "",       // type du fichier
                                "size" => "",       // taille du fichier
                                "resume" => "",     // permettre ou non la reprise du téléchargement
                                "max_speed" => ""   // limite de la vitesse de téléchargement (en ko) ( 0 = pas de limite)
                                );          

    // le constructeur
    public function __construct($path, $name="", $resume="off", $max_speed=0){  // par défaut, la reprise n'est pas autorisée, aucune limite de vitesse
        $name = ($name == "") ? substr(strrchr("/".$path,"/"),1) : $name; // si "name" n'est pas défini, le fichier ne sera pas renommé
        $file_extension = strtolower(substr(strrchr($path,"."),1));       // extension
        switch( $file_extension ) {                                       // type
            case "mp3": $content_type="audio/mpeg"; break;
            case "mpg": $content_type="video/mpeg"; break;
            case "avi": $content_type="video/x-msvideo"; break;
            case "wmv": $content_type="video/x-ms-wmv";break;
            case "wma": $content_type="audio/x-ms-wma";break; 
            default: $content_type="application/force-download";
        }
        $file_size = filesize($path);                                     // taille 
        $this->properties =  array(
                                    "path" => $path, 
                                    "name" => $name, 
                                    "extension" =>$file_extension,
                                    "type"=>$content_type, 
                                    "size" => $file_size, 
                                    "resume" => $resume, 
                                    "max_speed" => $max_speed
                                    );
    }
    
    // méthode publique pour avoir la valeur d'une propriété
    public function get_property ($property){
        if ( array_key_exists($property,$this->properties) )   // vérifier si la propriété existe déjà 
            return $this->properties[$property];               // retourner sa valeur
        else
            return null;                                       // sinon, retourner null
    }
    
    // méthode publique pour changer la valeur d'une propriété        
    public function set_property ($property, $value){
        if ( array_key_exists($property, $this->properties) ){ // vérifier si la propriété existe déjà
            $this->properties[$property] = $value;             // changer sa valeur
            return true;
        } else
            return false;
    }
    
    // méthode publique pour commencer le téléchargement
    public function download_file(){
        if ( $this->properties['path'] == "" )                 // si le chemin n'est pas indiqué, erreur !
            echo "Nothing to download!";
        else {
            // si la reprise est permise ...
            if ($this->properties["resume"] == "on") {
                if(isset($_SERVER['HTTP_RANGE'])) {            // vérifier si http_range est envoyé par le navigateur (ou download manager)
                    list($a, $range)=explode("=",$_SERVER['HTTP_RANGE']);  
                    ereg("([0-9]+)-([0-9]*)/?([0-9]*)",$range,$range_parts); // parsing Range header
                    $byte_from = $range_parts [1];     // l'intervalle de téléchargement: de $byte_from ...
                    $byte_to = $range_parts [2];       // ... à $byte_to 
                } else
                    if(isset($_ENV['HTTP_RANGE'])) {       // quelques serveurs web utilisent plûtot $_ENV['HTTP_RANGE']
                        list($a, $range)=explode("=",$_ENV['HTTP_RANGE']);
                        ereg("([0-9]+)-([0-9]*)/?([0-9]*)",$range,$range_parts); // parsing Range header
                        $byte_from = $range_parts [1];     // l'intervalle de téléchargement: de $byte_from ... 
                        $byte_to = $range_parts [2];       // ... à $byte_to
                    }else{
                        $byte_from = 0;                         // si aucun entête http_range n'est envoyé, envoyer tout le fichier de l'octet 0 ...
                        $byte_to = $this->properties["size"] -1;   // ... au dernier octet
                    }
                if ($byte_to == "")                             // si l'octet de fin n'est pas spécifié ...
                    $byte_to = $this->properties["size"] -1;    // ... lui affecter le dernier octet
                header("HTTP/1.1 206 Patial Content");          // envoyer l'entête de téléchargement partiel
            // ... sinon, télécharger tout le fichier
         } else {
                $byte_from = 0;
                $byte_to = $this->properties["size"] - 1;
            }
            
            $download_range = $byte_from."-".$byte_to."/".$this->properties["size"]; // l'intervalle de téléchargement
            $download_size = $byte_to - $byte_from + 1;                                  // la taille de téléchargement
            
            // download speed limitation
            if (($speed = $this->properties["max_speed"]) > 0)                       // determiner la vitesse maximale ...
                $sleep_time = (8 / $speed) * 1e6;                                    // ... si "max_speed" = 0, pas de limite (par défaut)
            else
                $sleep_time = 0;
            
            // envoyer les entêtes   
            header("Pragma: public");                                                // vider le cache du navigateur
            header("Expires: 0");                                                    // ...
            header("Cache-Control:");                                                // ...
            header("Cache-Control: public");                                         // ... 
            header("Content-Description: File Transfer");                            //  
            header("Content-Type: ".$this->properties["type"]);                     // type
            header('Content-Disposition: attachment; filename="'.$this->properties["name"].'";');
            header("Content-Transfer-Encoding: binary");                             // methode du transfert 
            header("Content-Range: $download_range");                                // intervalle de téléchargement 
            header("Content-Length: $download_size");                                // taille de téléchargement
            
            // envoyer le contenu du fichier        
            $fp=fopen($this->properties["path"],"r");       // ouvrir le fichier 
            fseek($fp,$byte_from);                          // placer le pointeur au premier octet du téléchargement
            while(!feof($fp)){                              //   
                set_time_limit(0);                           // reinitialiser la limite du temps d'exécution pour les grands fichiers (sans aucun effet si php est exécuté en safe mode)
                print(fread($fp,1024*8));                   // envoyer 8ko 
                flush();
                usleep($sleep_time);                        // attendre (limitation de la vitesse)
            }
            fclose($fp);                                    // fermer le fichier
            exit;  
        }
    }
}
?>