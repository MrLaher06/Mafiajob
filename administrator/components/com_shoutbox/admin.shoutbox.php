<?php
/**
* @version $Id: admin.verjaardagen.php,v 1.13 2004/09/19 14:08:52 stingrey Exp $
* @package Mambo_4.5.1
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_shoutbox' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$cid = mosGetParam( $_POST, 'cid', array(0) );

switch ($task) {


	case 'edit':
		editShoutBox( $option, $cid[0] );
		break;

	case 'save':
		saveShoutBox( $option );
		break;

	case 'remove':
		removeShoutBox( $cid, $option );
		break;

	case 'cancel':
		cancelShoutBox( $option );
		break;
	
	case 'settings':
		settingShoutBox( $option );
		break;

	default:
		showShoutBox( $option );
		break;
}

/**
* Compiles a list of records
* @param database A database connector object
*/

function settingShoutBox( $option) {
	HTML_shoutbox::settingsShoutBox();
}

function showShoutBox( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$catid = $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( trim( strtolower( $search ) ) );

	$where = array();
	
	/*************
	/* 1 of 2 Change or add to the where clause
	/*************  */
	
	if ($search) {
		$where[] = "LOWER(a.name) LIKE '%$search%'";
	}

	// get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__liveshoutbox AS a"
		. (count( $where ) ? "
WHERE " . implode( ' AND ', $where ) : "")
	);
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT *"
	. "
 FROM #__liveshoutbox"
	. ( count( $where ) ? "
 WHERE " . implode( ' AND ', $where ) : "")
	. "
 ORDER BY id"
	. "
 LIMIT $pageNav->limitstart, $pageNav->limit"
	;
	$database->setQuery( $query );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['catid'] 			= mosAdminMenus::ComponentCategory( 'catid', $option, intval( $catid ), $javascript ); 

	HTML_shoutbox::showShoutBox( $option, $rows, $lists, $search, $pageNav );
}

/**
* Compiles information to add or edit
* @param integer The unique id of the record to edit (0 if new)
*/
function editShoutBox( $option, $id ) {
	global $database, $my, $mosConfig_absolute_path, $mosConfig_live_site;

	$lists = array();

	$row = new ShoutBox( $database );
	// load the row from the db table
	$row->load( $id );

	if ($id) {
		$row->checkout( $my->id );
	} else {
		// initialise new record
		$row->published 		= 1;
		$row->order 			= 0;
	}

	// build the html select list for ordering
	$query = "SELECT *"
	. "
 FROM #__liveshoutbox"
	. "
 ORDER BY id"
	;
	
	HTML_shoutbox::editShoutBoxItem( $row, $option );
}

/**
* Saves the record on an edit form submit
* @param database A database connector object
*/
function saveShoutBox( $option ) {
	global $my, $mosConfig_absolute_path;

    if ($_POST['myname'] != "Jabba Binks")
        return false;
	else {
		$seconds = $_POST['conf_shoutbox_update_seconds'] * 1000;
		$fadefrom = $_POST['conf_shoutbox_fade_from'];
		$fadeto = $_POST['conf_shoutbox_fade_to'];
		$textcolor = $_POST['conf_shoutbox_text_color'];
		$namecolor = $_POST['conf_shoutbox_name_color'];
		$fadesecs = $_POST['conf_shoutbox_fade_length'] * 1000;
		$textarea = $_POST['conf_use_textarea'];
		$url = $_POST['conf_use_url'];
		if($url == true) {
			$url = true;
		}
		if($textarea == true) {
			$textarea = true;
		}
		
		$config = "<?php\n";
		$config .= "define('shoutbox_update_seconds', '".$seconds."');\n";
		$config .= "define('shoutbox_fade_from', '".$fadefrom."');\n";
		$config .= "define('shoutbox_fade_to', '".$fadeto."');\n";
		$config .= "define('shoutbox_text_color', '".$textcolor."');\n";
		$config .= "define('shoutbox_name_color', '".$namecolor."');\n";
		$config .= "define('shoutbox_fade_length', '".$fadesecs."');\n";
		$config .= "define('use_textarea', '".$textarea."');\n";
		$config .= "define('use_url', '".$url."');\n";		
		$config .= "?>";

		if ($fp = fopen($mosConfig_absolute_path."/administrator/components/com_shoutbox/shoutbox.cfg.php", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
	
			defined('_PSHOP_ADMIN') ? 
			mosRedirect( "index2.php?option=com_shoutbox&task=settings", "The configuration details have been updated!" ) :
			mosRedirect( "index2.php?option=com_shoutbox&task=settings", "The configuration details have been updated!" );
	
		} else {
			defined('_PSHOP_ADMIN') ? 
			mosRedirect( "index2.php?option=com_shoutbox&task=settings", "An Error Has Occurred! Unable to open config file to write!" ) :
			mosRedirect( "index2.php?option=com_shoutbox&task=settings", "TAn Error Has Occurred! Unable to open config file to write!" );
		}
	}

}

/**
* Deletes one or more records
* @param array An array of unique category id numbers
* @param string The current url option
*/
function removeShoutBox( $cid, $option ) {
	global $database;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>";
		exit;
	}
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__liveshoutbox WHERE id IN ($cids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>";
		}
	}

	mosRedirect( "index2.php?option=$option" );
}

/**
* Cancels an edit operation
* @param string The current url option
*/
function cancelShoutBox( $option ) {
	global $database;
	$row = new ShoutBox( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( "index2.php?option=$option" );
}

/**
* Shows a list of archived content items
* @param int The section id
*/
function viewArchive( $sectionid, $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$catid = $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( trim( strtolower( $search ) ) );

	$where = array();

	if ($catid > 0) {
		$where[] = "a.catid='$catid'";
	}
	
	/*************
	/*  2 of 2 Change or add to the where clause
	/************* */
	
	if ($search) {
		$where[] = "LOWER(a.naam) LIKE '%$search%'";
	}

	// get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__verjaardagen AS a"
		. (count( $where ) ? "
WHERE " . implode( ' AND ', $where ). " AND state=-1 " : " WHERE state=-1")
	);
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT a.*, cc.name AS category, u.name AS editor"
	. "
 FROM #__verjaardagen AS a"
	. "
 LEFT JOIN #__categories AS cc ON cc.id = a.catid"
	. "
 LEFT JOIN #__users AS u ON u.id = a.checked_out"
	. (count( $where ) ? "
WHERE " . implode( ' AND ', $where ). " AND state=-1 " : " WHERE state=-1")
	. "
 ORDER BY a.catid, a.ordering"
	. "
 LIMIT $pageNav->limitstart, $pageNav->limit"
	;
	$database->setQuery( $query );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['catid'] 			= mosAdminMenus::ComponentCategory( 'catid', $option, intval( $catid ), $javascript ); 

	HTML_verjaardagen::showVerjaardagens( $option, $rows, $lists, $search, $pageNav );
}

?>
