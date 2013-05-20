<?php
/**
* @version $Id: toolbar.mafiajob.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restriction d\'accès' );


class TOOLBAR_mafiajob {

	function _EDIT() 
	{
		global $id;

		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		if ( $id ) {
			mosMenuBar::cancel( 'cancel', 'Annuler' );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::endTable();	mosMenuBar::endTable();
	}

	function _DEFAULT() 
	{
		mosMenuBar::startTable();
		mosMenuBar::custom( false, 'frontpage.png', 'frontpage.png', 'Accueil', false );
		mosMenuBar::endTable();
	}
	
}
?>