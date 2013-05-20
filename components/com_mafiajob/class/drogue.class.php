<?php
/**
* @version $Id: drogue.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafDrogue extends Mafiajob {

	/** @var int Primary key */		
	public $id = false;			// Id drogue
	/** @var int */
	public $iduser = false;		// Id du joueur
	/** @var int */
	public $quantite1 = false;		//quantité de la 1 drogues
	/** @var int */
	public $prix1 = false;			//prix de la 1 drogues
	/** @var int */
	public $quantite2 = false;		//quantité de la 2 drogues
	/** @var int */
	public $prix2 = false;			//prix de la 2 drogues
	/** @var int */
	public $quantite3 = false;		//quantité de la 3 drogues
	/** @var int */
	public $prix3 = false;			//prix de la 3 drogues
	/** @var int */
	public $quantite4 = false;		//quantité de la 4 drogues
	/** @var int */
	public $prix4 = false;			//prix de la 4 drogues
	/** @var int */
	public $quantite5 = false;		//quantité de la 5 drogues
	/** @var int */
	public $prix5 = false;			//prix de la 5 drogues
	/** @var int */
	public $quantite6 = false;		//quantité de la 6 drogues
	/** @var int */
	public $prix6 = false;			//prix de la 6 drogues
	/** @var int */
	public $quantite7 = false;		//quantité de la 7 drogues
	/** @var int */
	public $prix7 = false;			//prix de la 7 drogues
	/** @var time */
	public $timer = false;			//temps en seconde depuis la derniere mise a jour
	
	// Initialisation de la class
	function MafDrogue ( &$db )
	{
		$this->mosDBTable( '#__wub_drogues', 'id', $db );
		$this->MafConfig();	
	}
	
	// Fonction initialisation pour selectionner les drogues du joueur (jointure avec perso possible je pense)
	function Drogue($id)
	{
		$this->_db->setQuery("SELECT * FROM ".$this->_tbl." WHERE iduser='".$id."' LIMIT 1 ");
		$drogues = $this->_db->loadObjectList();
		
		foreach( $this->_db->loadObjectList() as  $var )
		{
			foreach( $var as  $key => $value)
				$this->$key = $value;
		}
	}
	
	// Fonction de mise a jour des drogues du joueur
	function MafUpdate ( )
	{
		$this->timer = time();
		
		if($this->_db->updateObject($this->_tbl, $this->MafRecupValeur(), $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Inserer une ligne drogue
	function Mafinsert()
	{
		$this->timer = time();

		if($this->_db->insertObject($this->_tbl , $this->MafRecupValeur(), $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Recuperation des valeurs
	function MafRecupValeur()
	{
		// Vu qu'on a un heritage de la class config on doit créer un objet de sauvegarde et non via le $this
		$maj->id = 			$this->id;
		$maj->iduser = 		$this->iduser;
		$maj->quantite1 = 	$this->quantite1;
		$maj->prix1 = 		$this->prix1;
		$maj->quantite2 = 	$this->quantite2;
		$maj->prix2 = 		$this->prix2;
		$maj->quantite3 = 	$this->quantite3;
		$maj->prix3 = 		$this->prix3;
		$maj->quantite4 = 	$this->quantite4;
		$maj->prix4 = 		$this->prix4;
		$maj->quantite5 = 	$this->quantite5;
		$maj->prix5 = 		$this->prix5;
		$maj->quantite6 = 	$this->quantite6;
		$maj->prix6 = 		$this->prix6;
		$maj->quantite7 = 	$this->quantite7;
		$maj->prix7 = 		$this->prix7;
		$maj->timer = 		$this->timer;
		
		return $maj;
	}
	
	// Fonction pour acheter de la drogue
	function Acheter()
	{		
		$quantitetotal = 0;	
		$changement = false;
		
		$nbrDrogue = count($this->prixDrogue) + 1;

		for($i = 1; $i < $nbrDrogue; $i++)
		{
			$j = $i-1;
			$p = 'prix'.$i;
			$q = 'quantite'.$i;
			
			$quantite = $this->Get( $q );
			$prix = $this->Get( $p );
			
			if($prix != $this->$p)
				$changement = true;
			
			if($prix > 0) $this->$p = $prix;

			if($quantite > 0)
			{
				if( $this->AcheterVerif( $quantite, $this->prixDrogue[$j] ) ) 
				{
					$this->$q += $quantite;
					$quantitetotal += $quantite;
				}
			}
		}

		$this->MafUpdate();

		if($quantitetotal > 0)
			return 1;
		elseif($changement)
			return 2;
		else
			return false;
	}
	
	// Fonction au detail
	function AcheterVerif($quantite, $choix)
	{
		global $perso;
		
		$prixtotal = round( $quantite * $choix );
		
		if($perso->argent < $prixtotal)
			return false;
		else
		{
			$perso->RetraitArgent($prixtotal);
			return true;
		}
	}
	
	// Fonction qui verifie les quantité de drogue
	function Vendre( )
	{		
		$nbrDrogue = count($this->prixDrogue) + 1;
		$argentTotal = 0;

		for($i = 1; $i < $nbrDrogue; $i++)
		{
			$j = $i-1;
			$p = 'prix'.$i;
			$q = 'quantite'.$i;
		
			if( $this->$q > 0 )
			{
				if( $this->$p <= $this->VendreVerif (1, $this->$p, $this->prixDrogue[$j] ) )
				{
					$this->$q -= 1;
					$argentTotal += $this->$p;
				}
			}
		}
		
		if( $this->MafUpdate() )
			return true;
		else
			return false;
	}
	
	// Fonction au detail
	function VendreVerif($quantite, $prix, $prixdefaut )
	{
		global $perso;

		if( $this->prixdroguemax ( $prixdefaut ) >= $prix )
		{
			$perso->stupefiant++;
			return $perso->AjoutArgent( round($quantite * $prix) );
		}
		else
			return false;
	}
	
	
	// Fonction qui verifie le prix de la drogue fixer a 10%
	function prixdroguemax ($valeur = false)
	{		
		return round( $valeur + ( $valeur * ( $this->tauxVenteDrogue / 100 ) ) );
	}
	
	// Fonction pour afficher les erreurs
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
?>