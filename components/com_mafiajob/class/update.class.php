<?php
/**
* @version $Id: fichierUpdate.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class Upload
{
 
	private $dossier; 		// dossier ou les fichiers vont etr uplodé
	
	private $max_size; 		// taille max des fichiers (en octets)
	
	private $type; 			// type de fichiers autorisés
	
	private $nb_file; 		// nombre de fichiers a uploder

	function Upload($_dossier, $_type, $_max_size)
	{
		$this->type  = $_type;
		$this->dossier  = $_dossier;
		$this->max_size = $_max_size;
	}

	function uploading()
	{ 		
		// On test si le dossier d'upload existe 
		$open = opendir($this->dossier);
		// Si non, on le crée
		if(!$open) mkdir($this->dossier);
		
		$repertoireFichiers = $this->dossier;
		$extAutorisees = $this->type;
		
		// si le formulaire a été posté
		if(!empty($_FILES["file"]["name"])) 
		{
		// Les informations concernant le fichier
			
			$fichier = time().$_FILES["file"]["name"];
			
			$temporaryName = $_FILES["file"]["tmp_name"];
			$tailleFichier = $_FILES["file"]["size"];
			$typeFichier = $_FILES["file"]["type"];
			$maxSize = $this->max_size;
			
			// On trouve son extension
			$ext = explode(".", $fichier);
			$extension = $ext[count($ext)-1];
			
			// Si l'extension et que la taille du fichier son bons
			if (in_array($extension, $this->type) && $tailleFichier <= $maxSize && $tailleFichier != 0)
			{
				$upload = move_uploaded_file($temporaryName, $this->dossier.'/'.$fichier);
				
				if($upload) 
					return $fichier;
				else
				{
					echo '<span class="alert">Il y a eu un probleme de copiage de fichier vers le dossier serveur.</span>';
					return false;
				}
			}
			else 
			{
				echo '<span class="alert">Le poid ou la taille de votre image ne conviennent pas</span>';
				return false;
			}                
		}
	}
}
?>