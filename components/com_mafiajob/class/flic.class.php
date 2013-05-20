<?php
/**
* @version $Id: flic.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafFlic extends Mafiajob {

	// initialisation de la class
	function MafFlic ( &$db )
	{
		$this->mosDBTable( '#__wub_personnage', 'iduser', $db );	
		$this->MafConfig();
	}
	
	// selection du flic
	function MafSelection (  )
	{	
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE equipe ='1' " );

		return $this->_db->loadObjectList();
	}
	
	// selection du top x de ceux qui attaque le plus
	function MafToptype ( $type = 'nbrattaque' )
	{					
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE equipe !='1' ORDER BY $type DESC LIMIT ".$this->nombreTopRechercheFlic );

		return $this->_db->loadObjectList();
	}
	
	// mise a jour du flic
	function MafUpdate ( &$info )
	{
		if($this->_db->updateObject($this->_tbl , $info, $this->_tbl_key))
			return true;
		else
			return false;	
	}
	
	// function qui retourne le niveau du joueur
	function Niveau() 
	{		
		$texte = $this->NiveauJoueur;

		if($this->MafFlic())
			$texte = $config->NiveauFlic;
		
		if($this->xp <= $this->NiveauXP[0]) return $texte[0];	
		elseif($this->xp <= $this->NiveauXP[1]) return $texte[1];	
		elseif($this->xp <= $this->NiveauXP[2]) return $texte[2];	
		elseif($this->xp <= $this->NiveauXP[3]) return $texte[3];	
		elseif($this->xp <= $this->NiveauXP[4]) return $texte[4];	
		elseif($this->xp <= $this->NiveauXP[5]) return $texte[5];		
		else return $texte[6];
	}
	
	// function qui annonce le prochain niveau
	function ProchainNiveau() 
	{		
		if($this->xp <= $this->NiveauXP[0]) return $this->NiveauXP[0];	
		elseif($this->xp <= $this->NiveauXP[1]) return $this->NiveauXP[1];	
		elseif($this->xp <= $this->NiveauXP[2]) return $this->NiveauXP[2];	
		elseif($this->xp <= $this->NiveauXP[3]) return $this->NiveauXP[3];	
		elseif($this->xp <= $this->NiveauXP[4]) return $this->NiveauXP[4];	
		elseif($this->xp <= $this->NiveauXP[5]) return $this->NiveauXP[5];		
		else return $this->xp;	
	}
}
	
?>