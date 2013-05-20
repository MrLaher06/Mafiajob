<?php
/**
* @version $Id: plusieurs.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafPlusieurs extends Mafiajob {

	/** @var array */
	public $action			= false;	//action selectionné
	/** @var array */
	public $actionEquipe 	= false;	//liste des action de l'equipe selectionné	
	
	// Initialisation de la class
	function MafPlusieurs ( &$db )
	{
		$this->mosDBTable( '#__wub_actions_plusieurs', 'id', $db );	
		$this->MafConfig();
	}
	
	// Fonction pour verifier les actions en cours
	function MafVerifiActionCoupsActif( &$idPerso )
	{
		$this->_db->setQuery( "SELECT id FROM ".$this->_tbl." WHERE iduser = '".$idPerso."' LIMIT 1" );
		
		if($this->_db->loadObjectList())
			return true;
		else
			return false;
	}
	
	// Fonction pour selectionner toutes les actions d'une meme equipe
	function MafListeActionEquipe( &$equipe )
	{		
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE equipe = '".$equipe."' AND role ='1' " );
		
		$this->actionEquipe = $this->_db->loadObjectList();
		
		if($this->actionEquipe)
			return true;
		else
			return false;
	}
	
	// Fonction pour selectionner toutes les details de l'action via le meme id attaque
	function MafListeActionDetail( &$idattaque )
	{		
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE idattaque = '".$idattaque."' ORDER BY time_crea DESC" );
		
		$donnee = $this->_db->loadObjectList();
		
		if($donnee)
			return  $donnee;
		else
			return false;
	}
	
	// Fonction pour selectionner une action	avec son identifiant
	function MafSelectAction( &$id )
	{			
		if($id)
		{										 
			$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE id = '" . $id . "' LIMIT 1" );
			$Action = $this->_db->loadObjectList();
			
			if($Action)
			{
				$this->action = $Action[0];
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}
	
	// Inserer une action
	function MafInsert()
	{
		if($this->_db->insertObject($this->_tbl, $this->action, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Mise a jour d'une action
	function MafUpdate ( )
	{
		if($this->_db->updateObject($this->_tbl, $this->action, $this->_tbl_key))
			return true;
		else
			return false;	
	}
	
	// Supprimer une action
	function MafDelete ( )
	{
		if($this->delete( $this->action->id ))
			return true;
		else
			return false;	
	}
	
	// Fonction pour supprimer toutes les action qui porte le meme id que le joueur (en cas de deplacement par exemple)	
	function MafDeleteAction( &$id , $type = false)
	{
		$sql = '';	

		if($type == 1)													//type 1 = tout retirer on purge toutes les action du joueur (Lanceur)
			$sql = "idattaque = '".$id."' OR iduser = '".$id."' OR iddefense = '".$id."'";
			
		elseif($type == 2)
			$sql = "iduser = '".$id."'";								//type 2 = retirer sa participation a une action (Participant)
			
		$this->_db->setQuery( "DELETE FROM ".$this->_tbl." WHERE ".$sql );
	
		if($this->_db->query())
			return true;
		else
			return false;
	}
	
	// Fonction pour le role du joueur dans l action	
	function MafRole( &$type )
	{
		switch($type)
		{
			case 1 : return _PLUSIEURS_ROLE_1; break;
			case 2 : return _PLUSIEURS_ROLE_2; break;
		}
	
	}
	
	// Fonction qui indique le type de l attaque
	function MafType( &$type )
	{
		switch($type)
		{
			case 1 : return _PLUSIEURS_TYPE_1; break;
			case 2 : return _PLUSIEURS_TYPE_2; break;
			case 3 : return _PLUSIEURS_TYPE_3; break;
		}
	}
	
	// Fonction pour participer a une action	
	function MafParticiperAction( &$perso )
	{	
		if( !$this->MafVerifiActionCoupsActif( $perso->iduser ) )
		{
			$this->action->id = false;
			$this->action->iduser = $perso->iduser;
			$this->action->role = 2;
			$this->action->time_crea = time();
			$this->action->lat = $perso->lat;
			$this->action->lng = $perso->lng;
			$this->action->nomattaque = $perso->MafUserName ( );

			if ( $this->MafInsert() )
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction pour preparer une action
	function MafPreparation( $perso, $Defenseid, $Defensenom, $type )
	{
		if( !$this->MafVerifiActionCoupsActif( $perso->iduser ) )
		{
			$this->action->id = false;
			$this->action->iduser = $perso->iduser;
			$this->action->role = 1;
			$this->action->type = $type;
			$this->action->lat = $perso->lat;
			$this->action->lng = $perso->lng;
			$this->action->time_crea = time();
			$this->action->equipe = $perso->equipe;
			$this->action->iddefense = $Defenseid;
			$this->action->idattaque = $perso->iduser;
			$this->action->nomattaque = $perso->MafUserName ( );
			$this->action->nomdefense = $Defensenom;
				
			if ( $this->MafInsert() )
				return true;
			else
				return false;
		}	
		else
			return false;
	}
	
	//fonction pour afficher les erreur s
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
	
?>