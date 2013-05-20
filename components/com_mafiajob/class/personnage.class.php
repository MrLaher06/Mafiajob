<?php
/**
* @version $Id: personnage.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafPersonnage extends Mafiajob {

	/** @var int Primary key */
	public $id					= false;	// Identifiant de la ligne
	/** @var int */
	public $iduser				= false;	// Identifiant du personnage en relation avec la table #__user
	/** @var string */
	public $username			= false;	// Username du personnage
	/** @var int */
	public $lat					= 0;		// Latitude du personnage
	/** @var int */
	public $lng					= 0;		// Longitude du personnage
	/** @var int */
	public $vie					= 0;		// Vie du personnage de 0 à 100
	/** @var int */
	public $attaque				= 0;		// Attaque du personnage de 0 à 100
	/** @var int */
	public $defense				= 0;		// Défense du personnage de 0 à 100
	/** @var int */
	public $discretion			= 0;		// Discrétion du personnage de 0 à 100
	/** @var int */
	public $rapidite			= 0;		// Rapidité du personnage de 0 à 100
	/** @var int */
	public $visibilite			= 0;		// Visibilité du personnage de 0 à 100
	/** @var int */
	public $puissance			= 0;		// Puissance du personnage de 0 à 100
	/** @var int */
	public $intelligence		= 0;		// Intelligence du personnage de 0 à 100
	/** @var int */
	public $equipe				= 0;		// Equipe du personnage 1 = flic et 2-3 equipe par defaut
	/** @var int */
	public $xp					= 0;		// Expérience du personnage
	/** @var int */
	public $argent				= 0;		// Argent du personnage
	/** @var int */
	public $idvoiture			= 0;		// Identifiant de la voiture du personnage 0 = pas de voiture
	/** @var int */
	public $reservoir			= 0;		// Réservoir de la voiture du personnage
	/** @var int */
	public $idarme				= 0;		// Identifiant de l'arme du personnage 0 = pas d'arme
	/** @var int */
	public $munition			= 0;		// Munition de l'arme du personnage
	/** @var int */
	public $actif				= 0;		// Si le personnage est actif 0 = pas actif
	/** @var int */
	public $tempsplanque		= 0;		// Le time en seconde de l'entrée et de la sortie de planque du personnage
	/** @var string */
	public $image				= 0;		// Avatar du personnage
	/** @var string */
	public $ip					= 0;		// IP du personnage
	/** @var string */
	public $commentaire			= 'Aucun';	// Commentaire du personnage
	/** @var int */
	public $tempsmove			= 0;		// Le time en seconde du dernier déplacement du personnage
	/** @var int */
	public $banque				= 0;		// Argent en banque du personnage
	/** @var int */
	public $casier				= 0;		// Casier judiciaire du personnage 0 = pas de casier 1 = recherché et 2 = en prison
	/** @var int */
	public $mort				= 0;		// Si le personnage est mort = 1
	/** @var int */
	public $parrainage			= false;	// Identifiant du parrain en cas de parainnage
	/** @var int */
	public $stupefiant			= 0;		// Le nombre totale de vente de stupefiant(s)
	/** @var int */
	public $volevoiture			= 0;		// Le nombre totale de vole de voiture du personnage
	/** @var int */
	public $volearme			= 0;		// Le nombre totale de vole d'arme du personnage
	/** @var int */
	public $voleargent			= 0;		// Le nombre totale de vole d'argent du personnage
	/** @var int */
	public $nbrattaque			= 0;		// Le nombre totale d'attaque du personnage (joueur+bot)

	// Initialisation de la class
	function MafPersonnage ( &$db )
	{
		$this->mosDBTable( '#__wub_personnage', 'iduser', $db );	
		$this->MafConfig();
	}
	
	// Selection du personnage
	function MafSelection ( &$id, $lat = false, $lng = false )
	{	
		$requet = "iduser = '".$id."' LIMIT 1";
		
		if($lat && $lng)
			$requet = "iduser = '".$id."' AND lat = '".$lat."' AND lng = '".$lng."' LIMIT 1";			
						
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE ".$requet );
		
		$donnee = $this->_db->loadObjectList();
		
		if($donnee)
		{
			foreach( $donnee as  $var )
			{
				foreach( $var as  $key => $value)
					$this->$key = $value;
			}
			
			$this->MafVerifPosition();
			
			if($this->vie <= 0)
				$this->mort = 1;
			
			if(!$this->username || empty($this->username))
				$this->username = $this->MafUserName ( );
				
			return true;
		}
		else
			return false;
	}
	
	// Selection username du personnage
	function MafUserName ( )
	{					
		$this->_db->setQuery( "SELECT username FROM #__users WHERE id = '".$this->iduser."' LIMIT 1" );

		if($this->_db->loadObjectList())
		{
			$info = $this->_db->loadObjectList();
			return $info[0]->username;
		}
		else
			return false;
	}
	
	// Fonction qui montre la puissance du meilleur personnage
	function SelectionMeilleurPuissance ( )
	{
		$this->_db->setQuery( "SELECT puissance FROM " . $this->_tbl . " ORDER BY puissance DESC LIMIT 1" );
		$joueurs = $this->_db->loadObjectList();
		if($joueurs)
			return $joueurs[0]->puissance;
		else
			return false;
	}
	
	// Fonction qui montre l'intelligence du meilleur personnage
	function SelectionMeilleurIntelligence ( )
	{
		$this->_db->setQuery( "SELECT intelligence FROM " . $this->_tbl . " ORDER BY intelligence DESC LIMIT 1" );
		$joueurs = $this->_db->loadObjectList();
		if($joueurs)
			return $joueurs[0]->intelligence;
		else
			return false;
	}
	
	// Fonction qui montre la visibilité du meilleur personnage
	function SelectionMeilleurVisibilite ( )
	{
		$this->_db->setQuery( "SELECT visibilite FROM " . $this->_tbl . " ORDER BY visibilite DESC LIMIT 1" );
		$joueurs = $this->_db->loadObjectList();
		if($joueurs)
			return $joueurs[0]->visibilite;
		else
			return false;
	}
	
	// Inserer un joueur
	function Mafinsert()
	{
		if($this->_db->insertObject($this->_tbl , $this->MafRecupValeur(), $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Mise a jour du joueur
	function MafUpdate ( )
	{
		if($this->vie <= 0)
		{
			$this->mort = 1;
			$this->vie = 0;
		}
		
		if($this->vie > 100)
			$this->vie = 100;
		
		if($this->attaque > 100)
			$this->attaque = 100;
		
		if($this->defense > 100)
			$this->defense = 100;
		
		if($this->rapidite > 100)
			$this->rapidite = 100;
		
		if($this->discretion > 100)
			$this->discretion = 100;

		if($this->puissance <= 0)
			$this->puissance = 0;
			
		if($this->intelligence <= 0)
			$this->intelligence = 0;
			
		if($this->visibilite <= 0)
			$this->visibilite = 0;
			
		if($this->xp <= 0)
			$this->xp = 0;
			
		$this->ip = $_SERVER['REMOTE_ADDR'];
			
		if($this->_db->updateObject($this->_tbl , $this->MafRecupValeur(), $this->_tbl_key))
			return true;
		else
			return false;	
	}
	
	// Recuperation des valeurs
	function MafRecupValeur()
	{
		// Vu qu'on a un heritage de la class config on doit créer un objet de sauvegarde et non via le $this
		$maj->id =  		$this->id;
		$maj->iduser = 		$this->iduser;
		$maj->username =  	$this->username;
		$maj->lat =  		$this->lat;
		$maj->lng =  		$this->lng;
		$maj->vie =  		$this->vie;
		$maj->attaque =  	$this->attaque;
		$maj->defense =  	$this->defense;
		$maj->discretion =  $this->discretion;
		$maj->rapidite =  	$this->rapidite;
		$maj->visibilite =  $this->visibilite;
		$maj->puissance =  	$this->puissance;
		$maj->intelligence =$this->intelligence;
		$maj->equipe =  	$this->equipe;
		$maj->xp =  		$this->xp;
		$maj->argent = 		$this->argent;
		$maj->idvoiture =  	$this->idvoiture;
		$maj->reservoir =  	$this->reservoir;
		$maj->idarme =  	$this->idarme;
		$maj->munition =  	$this->munition;
		$maj->actif =  		$this->actif;
		$maj->tempsplanque =$this->tempsplanque;
		$maj->image =  		$this->image;
		$maj->ip =  		$this->ip;
		$maj->commentaire = $this->commentaire;
		$maj->tempsmove =  	$this->tempsmove;
		$maj->banque =  	$this->banque;
		$maj->casier = 		$this->casier;
		$maj->mort =  		$this->mort;
		$maj->parrainage =  $this->parrainage;
		$maj->stupefiant = $this->stupefiant;
		$maj->volevoiture = $this->volevoiture;
		$maj->volearme = 	$this->volearme;
		$maj->voleargent =  $this->voleargent;
		$maj->nbrattaque =  $this->nbrattaque;
		
		return $maj;
	}
	
	// Fonction qui defini si le personnage peut lancer une action apres un delai defini lors de sa sortie de planque
	function MafAllopassMAJ()
	{	
		global $my;
			
		$this->_db->setQuery( "UPDATE #__users SET allopass='".$my->allopass."' WHERE id=".$my->id." LIMIT 1" );
		if($this->_db->query())
			return true;
		else
			return false;	
	}

	// Argent du personnage
	function MafArgent ( )
	{
		return number_format( $this->argent );
	}

	// Temps en seconde qui indique le dernier move
	function MafMove ( )
	{
		return time() - $this->tempsmove;
	}

	// Temps en seconde qui indique le dernier move
	function MafMoveVerif (&$delai)
	{
		$temps = $delai - $this->MafMove ();
		
		if($temps < 1)
			return 0;
		else
			return $temps;
	}

	// Fonction qui gere le deplacement du personnage
	function deplacement ($direction = false, $temps = false)
	{		
		if($direction && $this->MafMoveVerif($temps) < 1)
		{
			switch($direction)
			{
				case 1 : 
					if($this->xp >= $this->XpDeplacementCarte || ( $this->idvoiture && $this->reservoir) ) 
					{ 
						$this->lat--; 
						$this->lng--; 
						$this->reservoir--;
					} 
					break;
					
				case 2 : 
					$this->lat--; 
					break;
					
				case 3 : 
					if($this->xp >= $this->XpDeplacementCarte || ( $this->idvoiture && $this->reservoir) ) 
					{ 
						$this->lat--; 
						$this->lng++; 
						$this->reservoir--;
					} 
					break;
					
				case 4 : 
					$this->lng--; 
					break;
					
				case 5 : 
					$this->lng++;
					break;
					
				case 6 : 
					if($this->xp >= $this->XpDeplacementCarte || ( $this->idvoiture && $this->reservoir) ) 
					{ 
						$this->lat++; 
						$this->lng--; 
						$this->reservoir--;
					} 
					break;
					
				case 7 : 
					$this->lat++; 
					break;
					
				case 8 : 
					if($this->xp >= $this->XpDeplacementCarte || ( $this->idvoiture && $this->reservoir) ) 
					{ 
						$this->lat++; 
						$this->lng++; 
						$this->reservoir--;
					} 
					break;
			}
			
			if(rand(0,3))
				$this->reservoir--;
			
			if(!$this->idvoiture && !rand(0,3))
				$this->xp++;
			
			$this->MafVerifPosition();
			$this->tempsmove = time();
			
			if($this->MafUpdate ())
				return true;
			else
				return false;	
		}
		else
			return false;
	}
	
	// Verification des positions du personnage
	function MafVerifPosition ( )
	{
		if ( $this->lat > 26 ) 
			$this->lat = 26; 
		elseif ( $this->lat < 1 ) 
			$this->lat = 1; 
		
		if ( $this->lng > 26 ) 
			$this->lng = 26; 
		elseif ( $this->lng < 1 ) 
			$this->lng = 1;	
	}
	
	// Fonction qui retourne le niveau du joueur
	function Niveau( $joueur = false ) 
	{		
		$texte = $this->NiveauJoueur;
		$flic = false;
		
		if($joueur)
		{
			$xp = $joueur->xp;
			
			if($joueur->equipe == 1)
				$flic = true;
		}
		else
		{
			$xp = $this->xp;
			
			if($this->MafFlic())
				$flic = true;
		}

		if($flic)
			$texte = $this->NiveauFlic;
		
			if($xp <= $this->NiveauXP[0]) 
				return $texte[0];	
			elseif($xp <= $this->NiveauXP[1]) 
				return $texte[1];	
			elseif($xp <= $this->NiveauXP[2]) 
				return $texte[2];	
			elseif($xp <= $this->NiveauXP[3]) 
				return $texte[3];	
			elseif($xp <= $this->NiveauXP[4]) 
				return $texte[4];	
			elseif($xp <= $this->NiveauXP[5]) 
				return $texte[5];		
			else return $texte[6];
	}
	
	// Fonction qui annonce le prochain niveau
	function ProchainNiveau( $xp = false ) 
	{		
		if( !$xp )
			$xp = $this->xp;
			
		if( $xp <= $this->NiveauXP[0] ) 
			return $this->NiveauXP[0];	
		elseif( $xp <= $this->NiveauXP[1] ) 
			return $this->NiveauXP[1];	
		elseif( $xp <= $this->NiveauXP[2] ) 
			return $this->NiveauXP[2];	
		elseif( $xp <= $this->NiveauXP[3] ) 
			return $this->NiveauXP[3];	
		elseif( $xp <= $this->NiveauXP[4] ) 
			return $this->NiveauXP[4];	
		elseif( $xp <= $this->NiveauXP[5] ) 
			return $this->NiveauXP[5];		
		else return $xp;	
	}
	
	// Fonction qui retire la voiture du personnage
	function RetirerVoiture ()
	{
		$this->idvoiture = 0;
		$this->discretion = 0;
		$this->rapidite = 0;
		$this->reservoir = 0;
	}
	
	// Fonction qui retire l'arme du personnage
	function RetirerArme()
	{
		$this->idarme = 0;
		$this->attaque = 0;
		$this->defense = 0;
		$this->munition = 0;
	}
	
	// Fonction qui gere la planque du joueur
	function entrerPlanquer()
	{
		if( $this->actif )
		{
			$this->tempsplanque = time();
			$this->actif = 0;
			if( $this->MafUpdate () )
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction qui gere la sortie de planque
	function sortirPlanquer()
	{
		if( !$this->actif )
		{
			if( $this->casier && ( time() - $this->tempsplanque ) > ( $this->tempsRechercher*60*60 ) )
				$this->casier = 0;
			
			$this->tempsplanque = time();
			$this->actif = 1;
			if( $this->MafUpdate() )
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction qui gere le retrait d'argent
	function RetraitArgent(&$somme)
	{
		if( $this->argent >= $somme )
		{
			$this->argent -= $somme;
			if($this->MafUpdate ())
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction qui gere l'ajout d'argent
	function AjoutArgent(&$somme)
	{
		$this->argent += $somme;
		if( $this->MafUpdate() )
			return true;
		else
			return false;
	}
	
	// Verifier que le joueur est un flic ou pas
	function MafFlic()
	{
		if( $this->equipe == 1 )
			return true;
		else
			return false;
	}
	
	// Fonction pour replacer le personnage
	function MafReplacer()
	{
		$this->_db->setQuery( "SELECT lat, lng FROM #__wub_batiments WHERE acces = '1' ORDER BY rand() LIMIT 1" );
		$result = $this->_db->loadObjectList();
	
		$this->lat = $result[0]->lat;
		$this->lng = $result[0]->lng;
		if( $this->MafUpdate() )
			return true;
		else
			return false;
	}
	
	// Fonction qui met la puissance, intelligence et visibilite aleatoirement
	function MafAleatoire ()
	{				
		$this->puissance = round( $this->creationPersonnageMaxPoint / rand (3,4) );
		$this->intelligence = round( $this->creationPersonnageMaxPoint / rand (3,4) );
		$this->visibilite = round( $this->creationPersonnageMaxPoint / rand (3,4) );
	}
	
	// Fonction qui met le joueur en prison
	function MafPrison()
	{		
		$this->casier = 2;
		$this->actif = 0;
		$this->idarme = 0;
		$this->munition = 0;
		$this->attaque = 0;
		$this->defense = 0;
		$this->stupefiant = 0;
		$this->volevoiture = 0;
		$this->volearme = 0;
		$this->voleargent = 0;
		$this->nbrattaque = 0;
		$this->tempsmove = time();
		$this->tempsplanque = time();
		$this->lat = $this->latitudePenitencier;
		$this->lng = $this->longitudePenitencier;
		
		if( $this->MafUpdate() )
			return true;
		else
			return false;
	}
	
	// Fonction qui sort le joueur de prison
	function MafSortirPrison()
	{		
		$this->casier = 0;
		$this->tempsmove = time();
		$this->tempsplanque = time();
		
		if( $this->MafUpdate() )
			return true;
		else
			return false;
	}
	
	// Fonction qui defini si le personnage peut lancer une action apres un delai defini lors de sa sortie de planque
	function MafDelaiPlanque()
	{		
		if( ( time() - $this->tempsplanque ) > $this->delaiPlanqueAction )
			return true;
		else
			return false;
	}
	
	// Fonction pour afficher les erreur s
	function MafError ()
	{
		return $this->_db->_errorMsg;
	}
}
?>