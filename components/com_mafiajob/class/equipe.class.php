<?php
/**
* @version $Id: mafia.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafEquipe extends Mafiajob {

	/** @var array */
	public $Equipes;
	/** @var array */
	public $IdEquipe = array();
	/** @var array */
	public $Donnees = array();
	
	// Initialisation de la class
	function MafEquipe ( &$db )
	{
		$this->mosDBTable( '#__wub_equipe', 'id', $db );	
		$this->MafConfig();
	}
	
	// Fonction selection des equipes
	function Selection() 
	{		
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl );
		$this->Equipes = $this->_db->loadObjectList();
		
		if ($this->Equipes)
		{		
			foreach ( $this->Equipes as $var )
			{
				array_push($this->IdEquipe,$var->id);
				array_push($this->Donnees,$var);
			}	
		}
	}
	
	// Fonction selection le dernier enregistré
	function SelectionDernier() 
	{		
		$this->_db->setQuery( "SELECT id FROM ".$this->_tbl." ORDER BY id DESC LIMIT 1" );
		$idEquipe = $this->_db->loadObjectList();
		
		if ($idEquipe)
			return $idEquipe[0]->id;
	}
		
	// Fonction qui trouve l'équipe
	function SearchEquipe($id=false)
	{
		$key = array_search($id, $this->IdEquipe);
		if($key)
			return $this->Donnees[$key];
		else
			return $this->Donnees[0];
	}
	
	// Fonction qui retourne le nom de l'équipe
	function NomEquipe($id=false)
	{
		$info = $this->SearchEquipe($id);
		return $info->nom;
	}
	
	// Fonction qui retourne la couleur de l'équipe
	function CouleurEquipe($id=false)
	{
		$info = $this->SearchEquipe($id);
		return $info->couleur;
	}
	
	// Fonction qui retourne la couleur de l'équipe
	function ChefEquipe($id=false)
	{
		$info = $this->SearchEquipe($id);
		return $info->iduser;
	}
	
	// Fonction qui retourne la couleur de l'équipe
	function ImageEquipe($id=false)
	{
		$info = $this->SearchEquipe($id);
		return $info->image;
	}
	
	// Fonction pour afficher les erreur s
	function error ()
	{
		return $this->_db->_errorMsg;
	}
	
	// Fonction qui insert une mafia dans la BD
	function MafInsert()
	{
		$this->Creation->id = false;
		$this->Creation->nom = ucfirst($this->Creation->nom);
		$this->Creation->commentaire = ucfirst($this->Creation->commentaire);
		
		if($this->_db->insertObject($this->_tbl , $this->Creation, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	//fonction pour gérer l envois d'um message par mail pour une invitation a intégrer une mafia
	function envoisinvite($idinvite = false)
	{	
		global $perso, $option , $Itemid, $task, $config;
			
		$key = md5($perso->iduser.time().$perso->equipe);
		
		$lien = $config->lien.'&task=equipe&key='.$key;
		
		$subject = 'Invitation pour rejoindre : '.$this->NomEquipe($perso->equipe);
		
		$message = 'Vous avez été invité par '.$perso->username.' pour rejoindre une nouvelle équipe : '. $this->NomEquipe($perso->equipe).'<br />';
		$message .= 'Pour cela il vous sufit de cliquer sur ce lien : <b><a href="'.$lien.'" title="rejoindre une équipe" >cliquer ici</a></b><br />';
		$message .= 'Vous avez '.$config->TempsValideInvitation.' heures pour valider cette invitation, passé ce délai, elle ne pourra plus être utilisé.';
		
		$query = "INSERT INTO #__wub_invite (equipe ,key_invite ,timer) VALUES ( '".$perso->equipe."', '".$key."', '".time()."')";
		
		$this->_db->setQuery( $query );
		if($this->_db->query())
		{
			$query = "INSERT INTO #__pms (recip_id , sender_id , date , time , readstate , subject , message , inbox , sent_items , pmsnotify )
					  VALUES ( '$idinvite', '".$perso->iduser."', '".date("Y.m.d")."', '".date("H:i:s")."', '0', '$subject', '$message', '1', '1', '0')";
	
			$this->_db->setQuery( $query );
			if($this->_db->query())
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction selection via le key de l'invitation
	function SelectionInvite($key = false) 
	{	
		global $config, $perso;
		
		$temps = time() - ($config->TempsValideInvitation*60*60);
		
		$this->_db->setQuery( "SELECT equipe FROM #__wub_invite WHERE key_invite = '$key' AND timer > '$temps'  LIMIT 1" );
		$equipe = $this->_db->loadObjectList();
		
		if ($equipe)
		{	
			$subject = 'Validation invitation';
			
			$message = 'Vous avez invité '.$perso->username.' pour rejoindre votre équipe : '. $this->NomEquipe($equipe[0]->equipe).'<br />';
			$message .= 'Il vient de valider votre invitation.';	
		
			$query = "INSERT INTO #__pms (recip_id , sender_id , date , time , readstate , subject , message , inbox , sent_items , pmsnotify )
					  VALUES ( '".$this->ChefEquipe($equipe[0]->equipe)."', '".$perso->iduser."', '".date("Y.m.d")."', '".date("H:i:s")."', '0', '$subject', '$message', '1', '1', '0')";
			$this->_db->setQuery( $query );
			$this->_db->query();
			
			$this->ChangementMAJ( $equipe[0]->equipe );
			
			$this->_db->setQuery( "DELETE FROM #__wub_invite WHERE key_invite = '$key' LIMIT 1" );
			$this->_db->query();
			
			return $equipe[0]->equipe;
		}
		else
			return false;
	}
	
	// Fonction pour mettre a jour les donnée existante du joueur qui change d'équipe
	function ChangementMAJ( $equipe ) 
	{
		global $perso;

		$this->_db->setQuery( "UPDATE #__wub_batiments SET couleur = '".$this->CouleurEquipe($equipe)."' , proprio_equipe = '".$equipe."' WHERE proprio = '".$perso->iduser."' " );
		$this->_db->query();

		$this->_db->setQuery( "UPDATE #__wub_carte_victoire SET equipe = '".$equipe."' WHERE iduser = '".$perso->iduser."'" );
		$this->_db->query();
	}	
}
?>