<?php
/**
* @version $Id: mission.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafMission extends Mafiajob {

	/** @var int Primary key */
	public $id = false;
	/** @var int */
	public $iduser = false;
	/** @var int */
	public $type = false;
	/** @var int */
	public $score = false;
	/** @var datetime */
	public $date = false;
	/** @var int */
	public $niveau = 0;
	
	// initialisation de la class
	function MafMission ( &$db )
	{
		$this->mosDBTable( '#__wub_mission', 'id', $db );
		$this->MafConfig();
	}
	
	// fonction pour selectionner notre mission
	function MafSelection ( &$id )
	{
		$this->_db->setQuery( "SELECT * FROM " . $this->_tbl . " WHERE iduser = '" . $id . "'" );
		$donnee = $this->_db->loadObjectList();
		
		if($donnee)
		{
			foreach( $donnee as  $var )
			{
				foreach( $var as  $key => $value)
					$this->$key = $value;
			}
			return true;
		}
		else
			return false;
	}
	
	// inserer une action
	function MafInsert()
	{
		global $perso;
		
		$this->iduser = $perso->iduser;
		$this->date = date($this->formatDateSQL);
		
		$maj->id = $this->id;
		$maj->iduser = $this->iduser;
		$maj->type = $this->type;
		$maj->score = $this->score;
		$maj->date = $this->date;
		$maj->niveau = $this->niveau;
		
		if($this->_db->insertObject($this->_tbl, $maj, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// supprimer une action
	function MafDelete ( )
	{
		if($this->delete( $this->id ))
			return true;
		else
			return false;	
	}
	
	// mission type 1 => Avoir un score de nbr d'attaque de +X par rapport a score 
	function MafType1 ( )
	{
		global $perso;
		
		$this->score = $perso->nbrattaque + $this->niveauCalcul ( $this->statAvoirSupplType1 );
		$this->MafInsert();
		
		return '<span class="info">'.$this->MafSprintf(_TYPE_MISSION_1 , array('a' => number_format( $this->score )) ).'</span>';
	}
	
	// mission type 2 => Avoir un score de stupéfiant de +X par rapport a score 
	function MafType2 ( )
	{
		global $perso;
		
		$this->score = $perso->stupefiant + $this->niveauCalcul ( $this->statAvoirSupplType2 );
		$this->MafInsert();

		return '<span class="info">'.$this->MafSprintf(_TYPE_MISSION_2 , array('a' => number_format( $this->score )) ).'</span>';	
	}
	
	// mission type 3 => Avoir un score de xp de +X par rapport a score 
	function MafType3 ( )
	{
		global $perso;
		
		$this->score = $perso->xp + $this->niveauCalcul ( $this->statAvoirSupplType3 );
		$this->MafInsert();

		return '<span class="info">'.$this->MafSprintf(_TYPE_MISSION_3 , array('a' => number_format( $this->score )) ).'</span>';	
	}
	
	// mission type 4 => Avoir un score de vole d'arme de +X par rapport a score 
	function MafType4 ( )
	{
		global $perso;
		
		$this->score = $perso->volearme + $this->niveauCalcul ( $this->statAvoirSupplType4 );
		$this->MafInsert();

		return '<span class="info">'.$this->MafSprintf(_TYPE_MISSION_4 , array('a' => number_format( $this->score )) ).'</span>';	
	}
	
	// mission type 5 => Avoir un score de vole de voiture de +X par rapport a score 
	function MafType5 ( )
	{
		global $perso;
		
		$this->score = $perso->volevoiture + $this->niveauCalcul ( $this->statAvoirSupplType5 );
		$this->MafInsert();

		return '<span class="info">'.$this->MafSprintf(_TYPE_MISSION_5 , array('a' => number_format( $this->score )) ).'</span>';	
	}
	
	// On demande une mission par type
	function MafDemande ( $niveau = 0 )
	{
		$this->type = rand( 1,5 );
		$this->niveau = $niveau;
		
		switch($this->type)
		{
			case 1 : return $this->MafType1(); break;
			case 2 : return $this->MafType2(); break;
			case 3 : return $this->MafType3(); break;
			case 4 : return $this->MafType4(); break;
			case 5 : return $this->MafType5(); break;
		}
	}
	
	//function calcul pour le niveau
	function niveauCalcul ( $valeur , $ratio = 1 )
	{
		return round( $valeur *= $ratio + $this->niveau );
	}
	
	// On demande une mission par type
	function MafTitreMission ( )
	{		
		switch($this->niveau)
		{
			case 0 : $titre = '<h1>'._MISSION_NIVEAU_1.'</h1>'; break;
			case 1 : $titre = '<h1>'._MISSION_NIVEAU_2.'</h1>'; break;
			case 2 : $titre = '<h1>'._MISSION_NIVEAU_3.'</h1>'; break;
			case 3 : $titre = '<h1>'._MISSION_NIVEAU_4.'</h1>'; break;
		}
			
		switch($this->type)
		{
			case 1 : $display = $this->MafType1Titre($titre); break;
			case 2 : $display = $this->MafType2Titre($titre); break;
			case 3 : $display = $this->MafType3Titre($titre); break;
			case 4 : $display = $this->MafType4Titre($titre); break;
			case 5 : $display = $this->MafType5Titre($titre); break;
		}
		
		return '<a name="mission" id="mission"></a>'.$display.'<br /><br />';	// les retour a la ligne sont pour eviter que le separateur soit coller sur le bottom
	}
	
	// On demande une mission par type
	function MafValide ( )
	{
		global $perso, $config;
		
		$display = false;
		
		if( $this->type == 1 && $this->score <= $perso->nbrattaque )
		{
			$perso->puissance += $this->niveauCalcul ( $this->statAvoirSupplType1Gagner , 2 );
			$display = true;
		}
		elseif( $this->type == 2 && $this->score <= $perso->stupefiant )
		{
			$perso->visibilite += $this->niveauCalcul ( $this->statAvoirSupplType2Gagner , 2 );
			$display = true;
		}
		elseif( $this->type == 3 && $this->score <= $perso->xp )
		{
			$perso->xp += $this->niveauCalcul ( $this->statAvoirSupplType3Gagner , 2 );
			$display = true;
		}
		elseif( $this->type == 4 && $this->score <= $perso->volearme )
		{
			$perso->intelligence += $this->niveauCalcul ( $this->statAvoirSupplType4Gagner , 2 );
			$display = true;
		}
		elseif( $this->type == 5 && $this->score <= $perso->volevoiture )
		{
			$perso->intelligence += $this->niveauCalcul ( $this->statAvoirSupplType5Gagner , 2 );
			$display = true;
		}
		else
		{
			$perso->xp -= round( $this->niveau + 1 );
			$display = false;
		}
		
		if($display)
		{
			$perso->argent += $config->statAvoirSupplTypeArgentGagner;
			$perso->casier = 0;
		}
			
		$perso->MafUpdate();
			
		$this->MafDelete ( );
		
		return $display;
	}
	
	// mission type 1 => Avoir un score de nbr d'attaque de +X par rapport a score 
	function MafType1Titre ( $titre )
	{
		global $perso;
		
		return $this->MafSprintf(_INFO_TYPE_MISSION_1 , array('a' => $titre, 'b' => number_format( $this->score ), 'c' => number_format( $perso->nbrattaque ) ) );	
	}
	
	// mission type 2 => Avoir un score de stupéfiant de +X par rapport a score 
	function MafType2Titre ( $titre )
	{
		global $perso;
		
		return $this->MafSprintf(_INFO_TYPE_MISSION_2 , array('a' => $titre, 'b' => number_format( $this->score ), 'c' => number_format( $perso->stupefiant ) ) );	
	}
	
	// mission type 3 => Avoir un score de xp de +X par rapport a score 
	function MafType3Titre ( $titre )
	{
		global $perso;
		
		return $this->MafSprintf(_INFO_TYPE_MISSION_3 , array('a' => $titre, 'b' => number_format( $this->score ), 'c' => number_format( $perso->xp ) ) );	
	}
	
	// mission type 4 => Avoir un score de vole d'arme de +X par rapport a score 
	function MafType4Titre ( $titre )
	{
		global $perso;
		
		return $this->MafSprintf(_INFO_TYPE_MISSION_4 , array('a' => $titre, 'b' => number_format( $this->score ), 'c' => number_format( $perso->volearme ) ) );	
	}
	
	// mission type 5 => Avoir un score de vole de voiture de +X par rapport a score 
	function MafType5Titre ( $titre )
	{
		global $perso;
		
		return $this->MafSprintf(_INFO_TYPE_MISSION_5 , array('a' => $titre, 'b' => number_format( $this->score ), 'c' => number_format( $perso->volevoiture ) ) );
	}
	
	//fonction pour afficher les erreurs
	function MafError ()
	{
		return $this->_db->_errorMsg;
	}
}
?>