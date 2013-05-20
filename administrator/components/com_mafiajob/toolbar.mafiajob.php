<?php
/**
* @version $Id: toolbar.mafiajob.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restriction d\'accès' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {
	case 'carte':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'carteMap':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'editCarteA':
		TOOLBAR_mafiajob::_EDIT();
		break;
	case 'armes':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'editArmesA':
		TOOLBAR_mafiajob::_EDIT();
		break;
	case 'voitures':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'editVoituresA':
		TOOLBAR_mafiajob::_EDIT();
		break;
	case 'bots':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'editBotsA':
		TOOLBAR_mafiajob::_EDIT();
		break;
	case 'forum':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'histo':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'action':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'stat':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'config':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'joueurs':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'editJoueursA':
		TOOLBAR_mafiajob::_EDIT();
		break;
	case 'articles':
		TOOLBAR_mafiajob::_DEFAULT();
		break;
	case 'editArticlesA':
		TOOLBAR_mafiajob::_EDIT();
		break;
}
?>