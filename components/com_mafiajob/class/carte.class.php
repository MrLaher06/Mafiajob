<?php
/**
* @version $Id: carte.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafCarte extends Mafiajob {
	 
	/** @var int */
	 public $MinLat;						// La latitude min
	/** @var int */
	 public $MinLng;						// La longitude min
	/** @var int */
	 public $MaxLat;						// La latitude max
	/** @var int */
	 public $MaxLng;						// La longitude max

	// initialisation de la class
	function MafCarte ( )
	{
		$this->MafConfig();	
	}
	
	// Fonction vue du joueur
	function Verificationvisible($perso,$lat,$lng)
	{			
		$visibilite = $this->MoyennePourcentage( $perso->visibilite, $perso->SelectionMeilleurVisibilite ( ) ); 
		$vue = floor( $visibilite / 10 );
		
		if($vue < 3)
			$vue = 3;
			
		if( ( $perso->lat + $vue ) > $lat 
		&& ( $perso->lat - $vue ) < $lat 
		&& ( $perso->lng + $vue ) > $lng 
		&& ( $perso->lng - $vue ) < $lng)
		{
			if( $perso->lat > $lat)
				$valeurlat = ($perso->lat  - $lat);
			else
				$valeurlat = ($lat - $perso->lat);
		
			if( $perso->lng > $lng)
				$valeurlng = ($perso->lng  - $lng);
			else
				$valeurlng = ($lng - $perso->lng);
		
			if( $vue > $valeurlng+$valeurlat)
				return true;
			else
				return false;
		}
	}
	
	// Fonction qui verifi si le lien de deplacement est a afficher et son numero
	function Deplacement ($perso, $lat, $long)
	{		
		if( $lat == $perso->lat - 1 && $long == $perso->lng - 1 && ( $perso->xp >= $this->XpDeplacementCarte || ( $perso->idvoiture && $perso->reservoir > 0 ) ) ) 
			return 1;
		elseif( $lat == $perso->lat - 1 && $long == $perso->lng ) 
			return 2;
		elseif( $lat == $perso->lat - 1 && $long == $perso->lng + 1 && ( $perso->xp >= $this->XpDeplacementCarte || ( $perso->idvoiture && $perso->reservoir > 0 ) ) ) 
			return 3;
		elseif( $lat == $perso->lat && $long == $perso->lng - 1 ) 
			return 4;
		elseif( $lat == $perso->lat && $long == $perso->lng + 1 ) 
			return 5;
		elseif( $lat == $perso->lat + 1 && $long == $perso->lng - 1 && ( $perso->xp >= $this->XpDeplacementCarte || ( $perso->idvoiture && $perso->reservoir > 0 ) ) ) 
			return 6;
		elseif( $lat == $perso->lat + 1 && $long == $perso->lng) 
			return 7;
		elseif( $lat == $perso->lat + 1 && $long == $perso->lng + 1 && ( $perso->xp >= $this->XpDeplacementCarte || ( $perso->idvoiture && $perso->reservoir > 0 ) ) ) 
			return 8;
		else 
			return false;
	}
	
	// Fonction qui genere le lien de deplacement
	function LienBouton ($numeroLien, $contenu = false, $acces = true, $effet = false)
	{
		global $task, $perso , $delaiDeplacement, $config;
		
		$lien = $this->lienAjax . '&task=' . $task ;
		
		$onclick = 'ajaxdeplacement(\''. htmlentities($lien) .'\', \'' . $numeroLien.'\', \'' . $effet.'\')';
		
		if($perso->MafMoveVerif( $delaiDeplacement ) < 1)
			$class = 'class="BlocCarteVert"';
		else
			$class = 'class="BlocCarteRouge"';

		if( $contenu && !$acces )
			return '<div><img src="' . $config->url . '/images/space.gif" alt="space" /></div>';
		elseif( $contenu )
			return '<div onclick="' . $onclick . '" id="lienDeplacement-'.$numeroLien.'" '.$class.' >' . $contenu . '</div>';
		else
			return '<div onclick="' . $onclick . '" id="lienDeplacement-'.$numeroLien.'" '.$class.'" ></div>';
	}
	
	// Fonction qui permet de conntre la zone pour afficher par exemple le fond d image
	function Zone ($lat, $lng)
	{
		if( $lat <= 7 && $lng <= 7 ) 	 	 return 1;
		elseif( $lat <= 7 && $lng <= 13 ) 	 return 2;
		elseif( $lat <= 7 && $lng <= 19 ) 	 return 3;
		elseif( $lat <= 7 && $lng <= 26 ) 	 return 4;
		elseif( $lat <= 13 && $lng <= 7 ) 	 return 5;
		elseif( $lat <= 13 && $lng <= 13 ) 	 return 6;
		elseif( $lat <= 13 && $lng <= 19 ) 	 return 7;
		elseif( $lat <= 13 && $lng <= 26 ) 	 return 8;
		elseif( $lat <= 19 && $lng <= 7 ) 	 return 9;
		elseif( $lat <= 19 && $lng <= 13 ) 	 return 10;
		elseif( $lat <= 19 && $lng <= 19 ) 	 return 11;
		elseif( $lat <= 19 && $lng <= 26 ) 	 return 12;
		elseif( $lat <= 26 && $lng <= 7 ) 	 return 13;
		elseif( $lat <= 26 && $lng <= 13 ) 	 return 14;
		elseif( $lat <= 26 && $lng <= 19 ) 	 return 15;
		elseif( $lat <= 26 && $lng <= 26 ) 	 return 16;
	}
	
	// Fonction qui permet d'afficher les partie de la carte
	function LatLng ($lat, $lng)
	{
		if( $lat <= 7 ) 	 $this->MinLat = 1;
		elseif( $lat <= 13 ) $this->MinLat = 7;
		elseif( $lat <= 19 ) $this->MinLat = 13;
		elseif( $lat <= 26 ) $this->MinLat = 19;
		
		if( $lng <= 7 ) 	 $this->MinLng = 1;
		elseif( $lng <= 13 ) $this->MinLng = 7;
		elseif( $lng <= 19 ) $this->MinLng = 13;
		elseif( $lng <= 26 ) $this->MinLng = 19;
		
		$this->MaxLat = $this->MinLat+8;
		$this->MaxLng = $this->MinLng+8;
	}
	
	// Fonction qui permet d'afficher en pied de carte
	function Pied ($nbrJoueur = false, $nbrBot = false, $nbrBatiment = false, $deplacement)
	{
		global $Itemid;
		
		return '<div class="piedcarte" >'._DEPLACEMENT_CARTE.' <input type="text" class="compteur" name="compteur" id="compteur" size="3" value="'.$deplacement.'" readonly="readonly" />- '._JOUEUR_CARTE.' <b>'.$nbrJoueur.'</b> - '._HABITANT_CARTE.' <b>'.$nbrBot.'</b> - '._BATIMENT_CARTE.' <b>'.$nbrBatiment.'</b> <a href="javascript:;" onclick="CarteAjaxRefresh(\'index2.php?option=com_mafiajob&Itemid='.$Itemid.'&task=carte\')"><img src="'.$this->url.'/images/refresh.png" alt="Actualiser" /></a></div>';
	}
	
	// Fonction pour afficher les erreur s
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
	
?>