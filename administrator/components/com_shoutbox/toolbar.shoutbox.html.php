<?php
/**
* @version : toolbar.verjaardagen.html.php,v 1.8 2004/08/26 05:20:51 rcastley Exp $
* @package Mambo_4.5.1
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo_4.5.1
*/
class TOOLBAR_shoutbox {
	function _SETTINGS() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
	
	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::deleteList();
		mosMenuBar::endTable();
	}
}
?>