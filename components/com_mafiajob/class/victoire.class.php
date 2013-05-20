<?php
/**
* @version $Id: jeu.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafVictoire extends Mafiajob {

	private $id;
		
	public $timer;
	
	private $idequipe;
	
	private $nomequipe;
	
	private $iduser;
	
	private $username;
	
	private $couleur;
	
	private $argent;
	
	private $date_victoire;
	
	private $mafiapass;
	
	// initialisation de la class
	function MafVictoire ( &$db )
	{
		$this->mosDBTable( '#__wub_victoire', 'id', $db );
		$this->MafConfig();
		
		$query = "SELECT * FROM " . $this->_tbl . " ORDER BY id DESC LIMIT 1";

		$this->_db->setQuery( $query );
		$donnee = $this->_db->loadObjectList();
		
		if($donnee)
		{
			foreach( $donnee as  $var )
			{
				foreach( $var as  $key => $value)
					$this->$key = $value;
			}
			if($this->tempsRestant ())
			return true;
		}
		else
			return false;
	}
	
	// mise a jour 
	function Ajout ()
	{
		$info->id = $this->id;
		$info->timer = $this->timer;
		$info->idequipe = $this->idequipe;
		$info->nomequipe = $this->nomequipe;
		$info->iduser = $this->iduser;
		$info->username = $this->username;
		$info->couleur = $this->couleur;
		$info->argent = $this->argent;
		$info->date_victoire = $this->date_victoire;
		$info->mafiapass = $this->mafiapass += 1;
		
		if($this->_db->updateObject($this->_tbl , $info, $this->_tbl_key))
			return true;
		else
			return false;	
	}
	
	function delai ()
	{
		return round($this->dureeJeu + $this->timer);
	}
	
	function PrixVictoire ()
	{
		return $this->mafiapass * ( 4 / 10 );
	}
	
	//fonction pour afficher le temps restant
	function tempsRestant ()
	{
		$temps = round(time() - $this->timer);

		if( $temps > $this->dureeJeu )
		{
			$maj->id = false;
			$maj->timer = time();
			$maj->date_victoire = date($this->formatDateSQL);
			$maj->nomequipe = false;
			$maj->iduser = false;
			$maj->username = false;
			$maj->couleur = false;
			$maj->argent = false;
			
			// On initialise le jeu au complet PENSER A PLACER LES RECOMPENCES
			$this->inialiserJeu();
			$this->Mafinsert( $maj );
			return true;
		}
		else
			return false;
	}
	
	//function pour reinitialiser tout le jeu 
	function inialiserJeu()
	{
		
		$query = " TRUNCATE TABLE #__wub_personnage ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_mission ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_historique ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_forum_equipe ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_carte_victoire ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_actions_plusieurs ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_drogues ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_equipe ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = "INSERT INTO #__wub_equipe VALUES (NULL, 'Flic', '#E49F49', 0, 'flic.jpg', 'Ce n\'est pas une mafia mais bien la police. Attention on vous voit !')";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = "INSERT INTO #__wub_equipe VALUES (NULL, 'Cosa Nostra', '#f9ffbc', 0, 'cosa_nostra.jpg', 'Une mafia qui fais mal par son agressivité.')";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = "INSERT INTO #__wub_equipe VALUES (NULL, 'Mafia Rouge', '#ffbcbc', 0, 'mafia_rouge.jpg', 'Une mafia très populaire pour tous les braquages fait par leurs membres')";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_maj ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = "INSERT INTO #__wub_maj VALUES (NULL, '".time()."')";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_parking ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = " TRUNCATE TABLE #__wub_carte_voiture ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$query = "UPDATE #__wub_ennemis SET argent = '250', vie = '100', puissance = '1', intelligence = '1', actif = '1', idarme = '0', idvoiture = '0', xp = '1' ";
		$this->_db->setQuery( $query );
		$this->_db->query();
		
		$this->_db->setQuery( "UPDATE #__wub_batiments SET couleur = '' , proprio_equipe = '0' , proprio = '0' , timer = '0' " );
		$this->_db->query();
	}
	
	// Inserer la mise a jour
	function Mafinsert( $maj )
	{
		if($this->_db->insertObject($this->_tbl , $maj, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	//fonction pour afficher les erreurs
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
?>