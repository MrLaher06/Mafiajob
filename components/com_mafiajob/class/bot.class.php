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

class MafBot extends Mafiajob {

	/** @var array */
	 private $Bots = false;						// Tableau qui contient un tableau des batiments
	/** @var array */
	 private $BotPosition = array(false);		// Tableau qui contient les position des bots
	/** @var array */
	 private $BotDonnee = array(false);			// Tableau qui contient les donnée des bots
	/** @var array */
	 private $BotCase = false;					// Tableau qui contient les donnée des bots
	/** @var array */
	 public $LeBot = false;						// Tableau qui contient les donnée des bots
	 
	// Initialisation de la class
	function MafBot ( &$db )
	{
		$this->mosDBTable( '#__wub_ennemis', 'id', $db );
		$this->MafConfig();		
	}
	
	// Fonction qui montre les bots
	function SelectionBot (&$MinLat, &$MaxLat, &$MinLng, &$MaxLng)
	{
		$query = "SELECT * FROM " . $this->_tbl . " WHERE lat >= '" . $MinLat . "' AND lat < '" . $MaxLat . "' AND lng >= '" . $MinLng . "' AND lng < '" . $MaxLng . "' AND actif = '1'";

		$this->_db->setQuery( $query );
		$this->Bots = $this->_db->loadObjectList();
		
		foreach ( $this->Bots as $var )
		{
			array_push($this->BotPosition,$var->lat.'-'.$var->lng);
			array_push($this->BotDonnee,$var);
		}
	}
	
	// Selection du bot par id
	function SelectionSimple ( &$id )
	{					
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl." WHERE id = '".$id."' AND actif = '1' LIMIT 1" );
		$Lebot = $this->_db->loadObjectList();

		if( $Lebot )
		{
			$this->LeBot = $Lebot[0];
			return $this->LeBot;
		}
		else
			return false;
	}
	
	// Fonction qui montre les bots
	function SelectionCase (&$Lat, &$Lng)
	{
		$this->_db->setQuery( "SELECT * FROM " . $this->_tbl . " WHERE lat = '" . $Lat . "' AND lng = '" . $Lng . "' AND actif = '1'" );
		$Lesbots = $this->_db->loadObjectList();

		if( $Lesbots )
		{
			$this->BotCase = $Lesbots;
			return $this->BotCase;
		}
		else
			return false;
	}
	
	// Fonction selectionne tout les habitant pour faire la mise a jour
	function SelectionTous ( )
	{
		$this->_db->setQuery( "SELECT * FROM " . $this->_tbl );
		$Lesbots = $this->_db->loadObjectList();

		if( $Lesbots )
			return $Lesbots;
		else
			return false;
	}
	
	// Fonction mise a jour du batiment
	function MafUpdate ( )
	{
		if($this->_db->updateObject($this->_tbl , $this->LeBot, $this->_tbl_key))
			return true;
		else
			return false;	
	}
	
	// Fonction qui renvois le nombre total de bot
	function NbrTotal( )
	{
		return count($this->Bots);
	}

	// Fonction qui permet de retrouver les donnée dans un tableau
	function RetrouverSimple ( $pos )
	{
		$key = array_search($pos, $this->BotPosition);

		if($key) 
		{
			$var = $this->BotDonnee;
			return $var[$key];
		}
		else
			return false;
	}
	
	// Fonction qui renvois le nombre de tel ou tel element sur la carte
	function Nbr( $pos )
	{
		$key = array_keys($this->BotPosition, $pos);

		if($key)
			return count($key);
		else
			return false;
	}
	
	// Fonction qui renvois le nombre de tel ou tel element sur la carte
	function RetrouverMulti ( $pos )
	{
		$tabl = array();
		$liste = $this->BotDonnee;
		
		$key = array_keys($this->BotPosition, $pos);
		
		for($i = 0; $i< count($key); $i++)
			array_push($tabl,$liste[$key[$i]]);

		if($tabl)
			return $tabl;
		else
			return false;
	}
	
	// Fonction qui retourne le meilleur x
	function SelectionMeilleur ( $type = 'attaque' )
	{
		$this->_db->setQuery( "SELECT ".$type." FROM " . $this->_tbl . " ORDER BY ".$type." DESC LIMIT 1" );
		$Meilleurs = $this->_db->loadObjectList();
		if($Meilleurs)
			return $Meilleurs[0]->$type;
		else
			return false;
	}
	
	// Fonction qui string l'humeur du bot
	function humeur($var=false)
	{
		switch($var)
		{
			case 1 : return _BOT_HUMEUR_1; break;
			case 2 : return _BOT_HUMEUR_2; break;
			case 3 : return _BOT_HUMEUR_3; break;
			default : return _BOT_HUMEUR_4; break;
		}
	}
	
	// Fonction pour replacer un bat apres le combat ou mise a jour de la ville
	function Replacer($rand = false, $vie = false, $argent = false, $xp = false, $humeur = false, $voiturebot = false, $armebot = false)
	{
		global $arme, $voiture;
		
		$bot = $this->LeBot;
		
		if($rand)
		{
			$bot->lat = rand(1,26);
			$bot->lng = rand(1,26);
		}
		else
		{
			if(rand(0,1))
			{
				for($i=0; $i < 2;$i++)
				{
					if(rand(0,1))
					{
						if(rand(0,1))
							$bot->lat++;
						else
							$bot->lat--;
					}
					else
					{
						if(rand(0,1))
							$bot->lng++;
						else
							$bot->lng--;
					}
				}
			}
		}
		
		if($bot->lat > 26) $bot->lat--;
		if($bot->lat < 1) $bot->lat++;
		if($bot->lng > 26) $bot->lng--;
		if($bot->lng < 1) $bot->lng++;
		
		if($argent)
			$bot->argent = rand($this->miniArgentReplaceBot, $this->maxArgentReplaceBot);
		
		if($xp && !rand(0,2) )
			$bot->xp += rand(0,$this->maxXpReplaceBot);
			
		if($humeur)
			$bot->humeur = rand(0,3);
				
		$bot->actif = rand(0,1);
		
		if($armebot)
		{			
			$armebot = $arme->Retrouver( rand(1, count($arme->listeArme) ) );
			if($armebot->xp <= $bot->xp && !$armebot->special)
			{
				$bot->idarme = $armebot->id;
				
				if(!rand(0,1))
					$bot->munition = rand($this->minMunitionReplaceBot, $this->maxMunitionReplaceBot);
				elseif(!rand(0,2))
					$bot->munition = 0;
			}
		}
		
		if($voiturebot)
		{			
			$voiturebot = $voiture->Retrouver( rand(1, count($voiture->listeVoiture) ) );
			
			if($voiturebot->xp <= $bot->xp && !$voiturebot->special)
			{
				$bot->idvoiture = $voiturebot->id;
				
				if(!rand(0,1))
					$bot->reservoir = rand($this->minEssenceReplaceBot, $this->maxEssenceReplaceBot);
				elseif(!rand(0,2))
					$bot->reservoir = 0;
			}
		}
				
		if(rand(0,3) && $voiturebot)
			$bot->taxi = 1;
		else
			$bot->taxi = 0;
		
		if($vie)
			$bot->vie -= $vie;
		
		if( $bot->vie <= 0 )
		{
			$bot->vie = 100;
			
			if(!rand(0,5))
				$bot->xp = 0;
			else
			{
				$choix = rand (0,5);
				
				if( $choix == 1 )
					$sql = "WHERE actif = '1'";
				elseif( $choix == 2 )
					$sql = "ORDER BY xp LIMIT 10";
				elseif( $choix == 3 )
					$sql = "ORDER BY xp DESC LIMIT 10";
				elseif( $choix == 4 )
					$sql = "ORDER BY RAND() LIMIT 10";
				elseif( $choix == 5 )
					$sql = "WHERE tempsmove >= '".(time() - $this->tempsJoueurRecharge)."'";
				else
					$sql = "";
				
				$this->_db->setQuery("SELECT AVG (xp) AS mxp FROM #__wub_personnage ".$sql);
				$moyenne = $this->_db->loadObjectList();
				
				$moy = $moyenne[0];
				
				if(rand(0,1))
					$bot->xp = ceil( $moy->mxp - rand(0, $this->maxXpReplaceBot));
				else
					$bot->xp = ceil( $moy->mxp + rand(0, $this->maxXpReplaceBot));
			}
		}
		
		$this->discution();	// cette fonction permet aussi par la meme occassion de MAJ le bot SQL
			
	}
	
	// Modifier la discution du bot
	function discution ()
	{
		$bot = $this->LeBot;

		$bot->discuter = rand(0,5);
		
		if( $this->MafUpdate() )
			return true;
		else
			return false;

	}
	
	// Fonction pour afficher les erreur s
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
	
?>