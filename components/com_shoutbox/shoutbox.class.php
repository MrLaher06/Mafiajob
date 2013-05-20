
<?
/**
* @version : shoutbox.class.php,v 1.8 2004/09/27 15:18:21 stingrey Exp $
* @package Mambo_4.5.1
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Category database table class
* @package Mambo_4.5.1
*/
class ShoutBox extends mosDBTable {
	/** @var int Primary key */
	var $id=null;
	
	/** @var string */
	var $name=null;
	/** @var date */
	var $time=null;
	
	/** @var datetime */
	var $text=null;
	/** @var int */
	var $url=null;

	/** @var string */
	/** var $params=null; */
	/**
	* @param database A database connector object
	*/
	function ShoutBox( &$db ) {
		$this->mosDBTable( '#__liveshoutbox', 'id', $db );
	}
}
?>
