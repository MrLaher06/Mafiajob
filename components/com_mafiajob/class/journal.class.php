<?php
/**
* @version $Id: journal.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafJournal extends Mafiajob {

	/** @var array */
	private $type = false;		// Type de l article a récupere
	/** @var array */
	private $perso = false;		// Le personnage qui enregistre un article
	/** @var array */
	private $article = false;	// L'article récupere
	/** @var array */
	private $articles = false;	// Récupération de la totalité des articles
	/** @var array */
	private $pageNav = false;	// Navigation en les différentes découpes de pages
	
	// Initialisation de la class
	function MafJournal ( &$db, $perso = false )
	{
		$this->mosDBTable( '#__wub_journal', 'id', $db );
		$this->MafConfig();
		$this->perso = $perso;	
	}
	
	function MafLire ()
	{
		global $mosConfig_absolute_path;
		
		$limit = $this->Get( 'limit' );
		
		if(!$limit)
			$limit = 5;
			
		$limitstart = $this->Get( 'limitstart' );

		$sql = "FROM ".$this->_tbl." j , `#__wub_articles` a WHERE a.id = j.idarticle ORDER BY j.id DESC";
	
		$this->_db->setQuery( "SELECT COUNT(j.id) ".$sql );

		require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
		$this->pageNav = new mosPageNav(  $this->_db->loadResult(), $limitstart, $limit  );
		
		$this->_db->setQuery( "SELECT * ".$sql, $this->pageNav->limitstart, $this->pageNav->limit );
	
		$this->articles = $this->_db->loadObjectList();
		
		if( $this->articles )
			return $this->articles;
		else
			return false;
	}
	
	function MafFooter()
	{
		return $this->pageNav->getListFooter();
	}

	function MafEcrire( $type, $objectif, $username = false, $equipe = false, $argent = false, $image = false, $position = false) 
	{		
		if($this->perso)
		{
			$this->article->id = false;
			$this->article->idarticle = $this->MafArticle ( $type );
			$this->article->objectif = $objectif;
			$this->article->date = date($this->formatDateSQL);
			$this->article->timer = time();
			
			if($username) 
				$this->article->username = $username;
			else
				$this->article->username = $this->perso->username;
		
			if($equipe) 
				$this->article->equipe = $equipe;
			else
				$this->article->equipe = $this->perso->equipe;
			
			if($position) 
				$this->article->position = $position;
			else
				$this->article->position = $this->convertLng($this->perso->lng) .' - '. $this->perso->lat;
				
			if($image && rand(0,1)) 
				$this->article->image = $image;
			else
				$this->article->image = 'http://ima.minigao.com/l80/p87/'.$this->perso->iduser.'.jpg';
				
			if($argent) 
				$this->article->argent = $argent;
			else
				$this->article->argent = 0;
				
			if( $this->Mafinsert( ) )
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	function Mafinsert()
	{
		if($this->_db->insertObject($this->_tbl , $this->article, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Selection de l'article correspondant à un type
	function MafArticle( &$type )
	{
		$this->_db->setQuery( "SELECT id FROM `#__wub_articles` WHERE type = '".$type."' AND texte != 'vide' ORDER BY rand() LIMIT 1" );
		$article = $this->_db->loadObjectList();

		if($article)
			return $article[0]->id;
		else
			return false;
	}
	
	// Fonction pour afficher les erreurs
	function MafError ()
	{
		return $this->_db->_errorMsg;
	}
}
?>