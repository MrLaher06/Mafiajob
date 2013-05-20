<?php
/**
* @version $Id: historique.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafHistorique extends Mafiajob {

	/** @var array */	
	private $historique = false;			
	/** @var array */	
	public $listeHistorique = false;	// Tableau qui contient les historiques
	/** @var array */
	private $pageNav = false;	// Navigation en les différentes découpes de pages
	
	// initialisation de la class arme
	function MafHistorique ( &$db )
	{
		$this->mosDBTable( '#__wub_historique', 'id', $db );	
	}
	
	// fonction liste des historique
	function MafListe ( &$iduser, &$nbr )
	{
		global $mosConfig_absolute_path;
	
		$limit = $this->Get( 'limit' );
		
		if(!$limit)
			$limit = $nbr;
			
		$limitstart = $this->Get( 'limitstart' );

		$sql = "FROM ".$this->_tbl." WHERE iduser = '".$iduser."' ORDER BY id DESC";
	
		$this->_db->setQuery( "SELECT COUNT(id) ".$sql );

		require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/pageNavigation.class.php' );
		$this->pageNav = new mosPageNav(  $this->_db->loadResult(), $limitstart, $limit, 'historique'  );
		
		$this->_db->setQuery( "SELECT * ".$sql, $this->pageNav->limitstart, $this->pageNav->limit );
	
		$this->listeHistorique = $this->_db->loadObjectList();
		
		if( $this->listeHistorique )
			return true;
		else
			return false;
	}
	
	function MafFooter()
	{
		return $this->pageNav->getListFooter();
	}
	
	function MafAjout( $perso, $type, $texte = false)
	{		
		if(!$texte)
			$texte = $this->MafType ( $type, $perso );
			
		$this->historique->id = false;
		$this->historique->iduser = $perso->iduser;
		$this->historique->type = $type;
		$this->historique->equipe = $perso->equipe;
		$this->historique->lat = $perso->lat;
		$this->historique->lng = $perso->lng;
		$this->historique->date = date($this->formatDateSQL);
		$this->historique->texte = $texte;
		
		if( $this->MafInsert() )
			return true;
		else
			return false;
	}
	
	// inserer un historique
	function MafInsert()
	{
		if($this->historique && $this->_db->insertObject($this->_tbl, $this->historique, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	function MafType ( &$type, &$perso )
	{		
		switch($type)
		{
			case 1 : return _HISTORIQUE_1; break;
			case 2 : return _HISTORIQUE_2; break;
			case 3 : return _HISTORIQUE_3; break;
			case 4 : return _HISTORIQUE_4; break;
			case 5 : return _HISTORIQUE_5; break;
			case 6 : return _HISTORIQUE_6; break;
			case 7 : return _HISTORIQUE_7; break;
			case 8 : return _HISTORIQUE_8; break;
			case 9 : return _HISTORIQUE_9; break;
			case 10 : return _HISTORIQUE_10; break;
			case 11 : return _HISTORIQUE_11; break;
			case 12 : return _HISTORIQUE_12; break;
			case 13 : return _HISTORIQUE_13; break;
			case 14 : return _HISTORIQUE_14; break;
			case 15 : return _HISTORIQUE_15; break;
			case 16 : return _HISTORIQUE_16; break;
			case 17 : return _HISTORIQUE_17; break;
			case 18 : return _HISTORIQUE_18; break;
			case 19 : return _HISTORIQUE_19; break;
			case 20 : return _HISTORIQUE_20; break;
			case 21 : return _HISTORIQUE_21; break;
			case 22 : return _HISTORIQUE_22; break;
			case 23 : return _HISTORIQUE_23; break;
			case 24 : return _HISTORIQUE_24; break;
			case 25 : return _HISTORIQUE_25; break;
			case 26 : return _HISTORIQUE_26; break;
			case 27 : return _HISTORIQUE_27; break;
			case 28 : return _HISTORIQUE_28; break;
			case 29 : return _HISTORIQUE_29; break;
			case 30 : return _HISTORIQUE_30; break;
			case 31 : return _HISTORIQUE_31; break;
			case 32 : return _HISTORIQUE_32; break;
			case 33 : return _HISTORIQUE_33; break;
			case 34 : return _HISTORIQUE_34; break;
			case 35 : return _HISTORIQUE_35; break;
			case 36 : return _HISTORIQUE_36; break;
			case 37 : return _HISTORIQUE_37; break;
			case 38 : return _HISTORIQUE_38; break;
			case 39 : return _HISTORIQUE_39; break;
			case 40 : return _HISTORIQUE_40; break;
			case 41 : return _HISTORIQUE_41; break;
			case 42 : return _HISTORIQUE_42; break;
			case 43 : return _HISTORIQUE_43; break;
			case 44 : return _HISTORIQUE_44; break;
			case 45 : return _HISTORIQUE_45; break;
			case 46 : return _HISTORIQUE_46; break;
			case 47 : return _HISTORIQUE_47; break;
			case 48 : return _HISTORIQUE_48; break;
			case 49 : return _HISTORIQUE_49; break;
			case 50 : return _HISTORIQUE_50; break;
			case 51 : return _HISTORIQUE_51; break;
			case 52 : return _HISTORIQUE_52; break;
			case 53 : return _HISTORIQUE_53; break;
			case 54 : return _HISTORIQUE_54; break;
			case 55 : return _HISTORIQUE_55; break;
			case 56 : return _HISTORIQUE_56; break;
			case 57 : return _HISTORIQUE_57; break;
			case 58 : return _HISTORIQUE_58; break;
			case 59 : return _HISTORIQUE_59; break;
			case 60 : return _HISTORIQUE_60; break;
			case 61 : return _HISTORIQUE_61; break;
			case 62 : return _HISTORIQUE_62; break;
			case 63 : return _HISTORIQUE_63; break;
			case 64 : return _HISTORIQUE_64; break;
			case 65 : return _HISTORIQUE_65; break;
			case 66 : return _HISTORIQUE_66; break;
			case 67 : return _HISTORIQUE_67; break;
			case 68 : return _HISTORIQUE_68; break;
			case 69 : return _HISTORIQUE_69; break;
			case 70 : return _HISTORIQUE_70; break;
			case 71 : return _HISTORIQUE_71; break;
			case 72 : return _HISTORIQUE_72; break;
			case 73 : return _HISTORIQUE_73; break;
			case 74 : return _HISTORIQUE_74; break;
			case 75 : return _HISTORIQUE_75; break;
			case 76 : return _HISTORIQUE_76; break;
			case 77 : return _HISTORIQUE_77; break;
			default : return _HISTORIQUE_0; break;
		}
	}
	
	// Fonction pour afficher les erreurs
	function Maferror ()
	{
		return $this->_db->_errorMsg;
	}
}
?>