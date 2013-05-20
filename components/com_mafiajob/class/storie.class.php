<?php
/**
* @version $Id: storie.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafStorie extends Mafiajob {
	
	// initialisation de la class
	function MafStorie ( &$db )
	{
		$this->mosDBTable( '#__wub_storie', 'id', $db );
		$this->MafConfig();
	}
	
	// fonction pour selectionner
	function MafSelection ( &$ordre )
	{
		$query = "SELECT * FROM " . $this->_tbl . " WHERE ordre = '" . $ordre . "'";

		$this->_db->setQuery( $query );
		$donnee = $this->_db->loadObjectList();
		
		if($donnee)
		{
			foreach( $donnee as  $var )
			{
				foreach( $var as  $key => $value)
					$this->$key = $value;
			}
			return true;
		}
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