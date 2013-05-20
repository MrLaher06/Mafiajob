<?php
/**
* @version $Id: arme.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafArme extends Mafiajob {

	/** @var int Primary key */
	public $id						= false;
	/** @var string */
	public $image					= false;
	/** @var int */
	public $munition				= 0;
	/** @var int */
	public $attaque				= 0;
	/** @var int */
	public $defense				= 0;
	/** @var int */
	public $precision				= 0;
	/** @var int */
	public $detente				= 0;
	/** @var int */
	public $prix_achat				= 0;
	/** @var int */
	public $prix_munition			= 0;
	/** @var string */
	public $commentaire			= false;
	/** @var string */
	public $nom					= false;
	/** @var int */
	public $idmagasin				= false;
	/** @var int */
	public $nombre					= 0;
	/** @var int */
	public $xp						= 10;
	/** @var int */
	public $special				= 0;	// permet de savoir si c'est pour les flic ou pas 1 = oui
	/** @var array */	
	public $armeId = array(false);			// Tableau qui contient les id des armes
	/** @var array */	
	public $armeDonnee = array(false);		// Tableau qui contient les données des armes
	/** @var array */	
	public $listeArme;						// Tableau qui contient les armes
	
	// Initialisation de la class arme
	function MafArme ( &$db )
	{
		$this->mosDBTable( '#__wub_armes', 'id', $db );	
		$this->MafConfig();	
	}
	
	// Fonction liste des armes
	function Liste ( )
	{
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl );
		$this->listeArme = $this->_db->loadObjectList();
		
		foreach ( $this->listeArme as $var )
		{
			array_push( $this->armeId,$var->id );
			array_push( $this->armeDonnee,$var );
		}
	}

	// Fonction qui permet de retrouver les donnée dans un tableau
	function Retrouver ( $id = false )
	{
		if($id)
		{
			$key = array_search($id, $this->armeId);
			if($key) 
			{
				$var = $this->armeDonnee;
				return $var[$key];
			}
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction pour afficher les erreurs
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
	
?>