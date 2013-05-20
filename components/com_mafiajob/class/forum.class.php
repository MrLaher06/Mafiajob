<?php
/**
* @version $Id: forum.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafForum extends Mafiajob {

	/** @var int Primary key */
	public $id = false;
	/** @var int */
	public $iduser = false;
	/** @var int */
	public $equipe = false;
	/** @var char */
	public $username = false;
	/** @var text */
	public $texte = false;
	/** @var datetime */
	public $date_crea = false;
	/** @int timer */
	public $timer = false;																				
	 
	// initialisation de la class
	function MafForum ( &$db )
	{
		$this->mosDBTable( '#__wub_forum_equipe', 'id', $db );	
		$this->MafConfig();
	}

	function selection($equipe = false) 
	{
		global $mosConfig_absolute_path;
		
		$limit = $this->Get( 'limit' );
		
		if(!$limit)
			$limit = 5;
			
		$limitstart = $this->Get( 'limitstart' );
		
		$sql = "FROM " . $this->_tbl . " WHERE equipe = '".$equipe."' ORDER BY id DESC";
		
		$this->_db->setQuery( "SELECT COUNT(id) ".$sql );
		
		require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/pageNavigation.class.php' );
		$this->pageNav = new mosPageNav(  $this->_db->loadResult(), $limitstart, $limit, 'equipe' );
		
		$this->_db->setQuery( "SELECT * ".$sql, $this->pageNav->limitstart, $this->pageNav->limit );
	
		$list = $this->_db->loadObjectList();
		
		if($list)
			return $list;
		else
			return false;	
	}
		
	// Inserer une action
	function MafInsert()
	{
		$maj->id = 			$this->id;
		$maj->iduser = 		$this->iduser;
		$maj->equipe = 		$this->equipe;
		$maj->username = 	$this->username;
		$maj->texte = 		stripslashes(utf8_decode($this->texte));
		$maj->date_crea = 	$this->date_crea;	
		$maj->timer = 	time();	
	
		if($this->_db->insertObject($this->_tbl, $maj, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Fonction qui affiche le contenue du forum selon le type demandé					
	function afficher( &$liste )
	{
		$display = false;
		
		foreach($liste as $list)
			$display .= $this->lignetexte( $list );
			
		return $display;
	}
	
	// Fonction qui traite chaque ligne affiché					
	function lignetexte( $donnee = false )
	{		
		$display = '<h2>'.$donnee->username.'</h2>'."\n";
		$display .= '<blockquote id="'.$donnee->id.'" style="margin:5px 0 5px 0;">'."\n";
		$display .= '<span class="rouge" >'.$this->MafDate($donnee->date_crea).'</span><br />'."\n";
		$display .= $donnee->texte."\n";
		$display .= '</blockquote>'."\n";
		
		if($donnee->timer > round(time()-1))
		{
			$display .= '<script language="javascript" type="text/javascript">'."\n";
			$display .= '<!--'."\n";
			$display .= 'new Effect.Highlight(\''.$donnee->id.'\');'."\n";
			$display .= '-->'."\n";
			$display .= '</script>'."\n";
		}
			
		return $display;
	}

	// Fonction pour afficher le changement de page
	function MafFooter()
	{
		return $this->pageNav->getListFooter();
	}
	
	// Fonction pour afficher les erreurs
	function Maferror ()
	{
		return $this->_db->_errorMsg;
	}
}
?>