<?php
/**
* @version $Id: discutionBot.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafDiscutionBot {

	var $type = false ; // le type du message fournit

	var $lat = false ; // la position du message fournit

	var $lng = false ; // la position du message fournit
	
	var $newtype = 1 ; // la position du message fournit
	
	function MafMessage ( $type )
	{
		$this->type = $type;
	
		switch($this->type)
		{
			case 1 : return $this->joueur (); break;
			case 2 : return $this->habitant (); break;
			case 3 : return $this->batiment (); break;
			case 4 : return $this->voiture (); break;
			case 5 : return $this->prison (); break;
			case 6 : return $this->statjoueur (); break;
			default :  return $this->Perimer (); break;
		}
	}	
	
	function NouveauType ()
	{
		return $this->newtype;
	}	
	
	function Perimer ()
	{
		$this->newtype = 0;
		return 'Désolé je n\'ai aucune information pour t\'aider.';
	}	
	
	function joueur ()
	{
		global $database, $fonction;
		
			$this->newtype = rand(4,6);
			
		$sql = "SELECT u.username, p.lat, p.lng FROM #__wub_personnage p ,  #__users u WHERE u.id = p.iduser AND p.actif = '1' ORDER BY RAND() LIMIT 1";
		$database->setQuery( $sql );
		$joueurs = $database->loadObjectList();
		
		if(	$joueurs )
			return 'J\'ai vu '.$joueurs[0]->username.' vers '. $fonction->convertLng ($joueurs[0]->lng).' - '.$joueurs[0]->lat;
		else
			return 'Je n\'ai vu aucun autre joueur.';
	}	
	
	function habitant ()
	{
		global $database, $fonction;
		
		if(rand(0,1))
			$this->newtype = rand(0,2);
			
		$sql = "SELECT nom, lat, lng FROM #__wub_ennemis WHERE actif = '1' ORDER BY RAND() LIMIT 1";
		$database->setQuery( $sql );
		$bots = $database->loadObjectList();
		
		if(	$bots )
			return 'Si tu pouvais nous débarasser de '.$bots[0]->nom.'. Je l\'ai vu en '. $fonction->convertLng ($bots[0]->lng).' - '.$bots[0]->lat;
		else
			return 'Je suis un peu anti social donc nan j\'ai rien vu dans le coin.';
	}	
	
	function batiment ()
	{
		global $database, $fonction;
		
		if(rand(0,1))
			$this->newtype = rand(4,6);
			
		$sql = "SELECT nom, lat, lng FROM #__wub_batiments ORDER BY RAND() LIMIT 1";
		$database->setQuery( $sql );
		$batiments = $database->loadObjectList();

		if(	$batiments )
			return 'J\'adore l\'établissement '.$batiments[0]->nom.' en '. $fonction->convertLng ($batiments[0]->lng).' - '.$batiments[0]->lat;
		else
			return 'Je suis nouveau dans le coin, je connais pas encore d\'établissement.';
	}
	
	function voiture ()
	{
		global $database, $fonction;
		
		if(rand(0,1))
			$this->newtype = rand(5,6);
		
		$sql = "SELECT u.username, p.lat, p.lng FROM #__wub_personnage p ,  #__users u WHERE u.id = p.iduser AND p.actif = '1' AND p.idvoiture != '0' ORDER BY RAND() LIMIT 1";
		$database->setQuery( $sql );
		$voitures = $database->loadObjectList();
					
		if(	$voitures )
			return 'J\'ai vu une voiture en '. $fonction->convertLng ($voitures[0]->lng).' - '.$voitures[0]->lat.', je l\'ai trouvé bien.';
		else
			return 'J\'ai vu personne avec une voiture depuis un petit moment.';
	}
	
	function prison ()
	{
		global $database;
			
		if(rand(0,1))
			$this->newtype =6;
					
		$sql = "SELECT u.username, p.lat, p.lng FROM #__wub_personnage p ,  #__users u WHERE u.id = p.iduser AND p.casier = '2' ORDER BY RAND() LIMIT 1";
		$database->setQuery( $sql );
		$prisonniers = $database->loadObjectList();
		
		if(	$prisonniers )
			return 'J\'ai vu '.$prisonniers[0]->username.' en prison tout à l\'heure.';
		else
			return 'J\'ai vu personne en prison tout à l\'heure.';
	}
	
	function statjoueur ()
	{
	
		global $database;
		
		$sql = "SELECT u.username, p.vieFROM #__wub_personnage p ,  #__users u WHERE u.id = p.iduser AND p.actif = '1' ORDER BY RAND() LIMIT 1";
		$database->setQuery( $sql );
		$joueurs = $database->loadObjectList();
		
		if(	$joueurs )
			return 'Je sais que '.$joueurs[0]->username.' à '.$joueurs[0]->vie.' pts de vie.';
		else
			return 'Je sais rien pour le moment sur les autres joueurs.';
	}
	
}
?>