<?php
/**
* @version $Id: admin.mafiajob.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restriction d\'accès' );


if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_mafiajob' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$cid = josGetArrayInts( 'cid' );
$IdMafiajob = strtolower( strval( mosGetParam( $_REQUEST, 'IdMafiajob' ) ) );
$type = strtolower( strval( mosGetParam( $_REQUEST, 'type' ) ) );

		$chemin = $mosConfig_absolute_path. '/administrator/components/com_mafiajob';
		$url = $mosConfig_live_site. '/administrator/components/com_mafiajob';

switch ($task) 
{
	case 'carte':
		carte( $option );
		break;
		
	case 'editCarteA':
		editcarte( $IdMafiajob , $option );
		break;
		
	case 'carteMap':
		require_once($chemin.'/control/carte.control.php'  );
		break;
		
	case 'joueurs':
		joueurs( $option );
		break;
		
	case 'editJoueursA':
		editjoueurs( $IdMafiajob , $option );
		break;
		
	case 'armes':
		armes( $option );
		break;
		
	case 'editArmesA':
		editarmes( $IdMafiajob , $option );
		break;
		
	case 'voitures':
		voitures( $option );
		break;
		
	case 'editVoituresA':
		editvoitures( $IdMafiajob , $option );
		break;
		
	case 'bots':
		bots( $option );
		break;
		
	case 'editBotsA':
		editbots( $IdMafiajob , $option );
		break;
		
	case 'articles':
		articles( $option );
		break;
		
	case 'editArticlesA':
		editarticles( $IdMafiajob , $option );
		break;
		
	case 'forum':
		forum( $option );
		break;
		
	case 'histo':
		histo( $option );
		break;
		
	case 'action':
		action( $option );
		break;
		
	case 'stat':
		stats( $option );
		break;
		
	case 'config':
		config( $option );
		break;
		
	case 'save':
	case 'apply':

		if ( $_VERSION->RESTRICT == 1 )
			mosRedirect( 'index2.php?mosmsg=Restriction d\'accès' );
		else
			save( $task , $type );
		break;

	case 'cancel':
		cancel( $option , $type );
		break;

	default:
		HTML_mafiajob::accueil();
		break;
}

function carte( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_batiments WHERE nom != '' ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_batiments WHERE nom != '' ORDER BY nom";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::carte( $rows, $pageNav,$option );
}


function editcarte( $uid='0', $option = 'com_mafiajob' ) 
{
	global $database;

	$database->setQuery( "SELECT * FROM #__wub_batiments WHERE id='$uid' LIMIT 1");
	$batiments = $database->loadObjectList();
	
	HTML_mafiajob::editcarte( $batiments[0], $option, $uid );
}



function armes( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_armes ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_armes ORDER BY prix_achat";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::armes( $rows, $pageNav,$option );
}


function editarmes( $uid='0', $option = 'com_mafiajob' ) 
{
	global $database;

	$database->setQuery( "SELECT * FROM #__wub_armes WHERE id='$uid' LIMIT 1");
	$armes = $database->loadObjectList();
	
	HTML_mafiajob::editarmes( $armes[0], $option, $uid );
}

function voitures( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_voitures ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_voitures ORDER BY prix_achat";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::voitures( $rows, $pageNav,$option );
}


function editvoitures( $uid='0', $option = 'com_mafiajob' ) 
{
	global $database;

	$database->setQuery( "SELECT * FROM #__wub_voitures WHERE id='$uid' LIMIT 1");
	$voitures = $database->loadObjectList();
	
	HTML_mafiajob::editvoitures( $voitures[0], $option, $uid );
}

function bots( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_ennemis ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_ennemis";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::bots( $rows, $pageNav,$option );
}


function editbots( $uid='0', $option = 'com_mafiajob' ) 
{
	global $database;

	$database->setQuery( "SELECT * FROM #__wub_ennemis WHERE id='$uid' LIMIT 1");
	$ennemis = $database->loadObjectList();
	
	HTML_mafiajob::editbots( $ennemis[0], $option, $uid );
}

function articles( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_articles ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_articles";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::articles( $rows, $pageNav,$option );
}


function editarticles( $uid='0', $option = 'com_mafiajob' ) 
{
	global $database;

	$database->setQuery( "SELECT * FROM #__wub_articles WHERE id='$uid' LIMIT 1");
	$articles = $database->loadObjectList();
	
	HTML_mafiajob::editarticles( $articles[0], $option, $uid );
}

function joueurs( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_personnage ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_personnage ORDER BY username";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::joueurs( $rows, $pageNav,$option );
}


function editjoueurs( $uid='0', $option = 'com_mafiajob' ) 
{
	global $database, $my;
	if($my->id == $uid && $my->id != 62)
	{
		$msg = 'Tu ne peux pas modifier ton compte';
		$link = 'index2.php?option=com_mafiajob&task=joueurs';
		mosRedirect( $link, $msg );
	}
	else
	{
		$database->setQuery( "SELECT * FROM #__wub_personnage WHERE id='$uid' LIMIT 1");
		$joueurs = $database->loadObjectList();
		
		HTML_mafiajob::editjoueurs( $joueurs[0], $option, $uid );
	}
}



function forum( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_forum_mafia ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_forum_mafia ORDER BY id DESC";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::forum( $rows, $pageNav,$option );
}


function histo( $option ) 
{	
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_historique ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_historique ORDER BY id DESC";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::histo( $rows, $pageNav,$option );
}

function action( $option )
{
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );

	$query = "SELECT COUNT(id) FROM #__wub_action ";

	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT * FROM #__wub_action ORDER BY id DESC";

	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();

	HTML_mafiajob::action( $rows, $pageNav,$option );
}

function stats( $option )
{
	global $url, $mosConfig_absolute_path, $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	
	echo '<a href="index2.php?option=com_mafiajob">espace statistique</a>';
	
	HTML_mafiajob::stats($option );

}

function config( $option )
{
	global $url, $mosConfig_absolute_path, $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	
	echo '<script src="'.$url.'/codepress/codepress.js" type="text/javascript"></script>';
	echo '<textarea id="myCpWindow" class="codepress php linenumbers-off" style="width:1000px;height:500px;">';

	$Fnm = $mosConfig_absolute_path.'/components/com_mafiajob/class/config.class.php'; 

	if( file_exists( $Fnm ))
	{
		$tableau = file($Fnm);
		while(list($cle,$val) = each($tableau))
			 echo $val;
	}
					
	echo '</textarea> ';
	
	HTML_mafiajob::config($option );
}

function save( $task = false , $type = false ) {
	global $database, $mosConfig_live_site, $IdMafiajob, $option;


		
	switch ( $type ) {
		case 1:
			$sql = saveCarte();
			$mafiatask = 'carte';
			$mafiataskedit = 'editCarteA';
			break;
		case 2:
			$sql = saveArmes();
			$mafiatask = 'armes';
			$mafiataskedit = 'editArmesA';
			break;
		case 3:
			$sql = saveVoitures();
			$mafiatask = 'voitures';
			$mafiataskedit = 'editVoituresA';
			break;
		case 4:
			$sql = saveBots();
			$mafiatask = 'bots';
			$mafiataskedit = 'editBotsA';
			break;
		case 5:
			$sql = saveJoueurs();
			$mafiatask = 'joueurs';
			$mafiataskedit = 'editJoueursA';
			break;
		case 6:
			$sql = saveArticles();
			$mafiatask = 'articles';
			$mafiataskedit = 'editArticlesA';
			break;
	}
	
	$database->SetQuery($sql);
	$database->query();
	
	switch ( $task ) {
		case 'apply':
			$msg = 'Modifications appliquées ';
			mosRedirect( $mosConfig_live_site.'/administrator/index2.php?option='. $option .'&task='.$mafiataskedit.'&IdMafiajob='. $IdMafiajob, $msg );
			break;

		case 'save':
		default:
			$msg = 'Modifications enregistrées ';
			mosRedirect( $mosConfig_live_site.'/administrator/index2.php?option='. $option .'&task='.$mafiatask, $msg );
			break;
	}
}

function cancel( $option , $type ) 
{
	
	switch ( $type ) {
		case 1: mosRedirect( 'index2.php?option='. $option .'&task=carte' , 'Annulé' ); break;
		case 2: mosRedirect( 'index2.php?option='. $option .'&task=armes' , 'Annulé' ); break;
		case 3: mosRedirect( 'index2.php?option='. $option .'&task=voitures' , 'Annulé' ); break;
		case 4: mosRedirect( 'index2.php?option='. $option .'&task=bots' , 'Annulé' ); break;
		case 5: mosRedirect( 'index2.php?option='. $option .'&task=joueurs' , 'Annulé' ); break;
		case 6: mosRedirect( 'index2.php?option='. $option .'&task=articles' , 'Annulé' ); break;
	}
}

function saveCarte()
{

	extract( $_POST );
	
	return "UPDATE #__wub_batiments SET ".
			"`nom` = '$nom', ".
			"`commentaire` = '$commentaire', ".
			"`lat` = '$lat', ".
			"`lng` = '$lng', ".
			"`protection` = '$protection', ".
			"`image` = '$image', ".
			"`coffre` = '$coffre', ".
			"`xp` = '$xp' ".
			"WHERE `id` =$IdMafiajob LIMIT 1";
}

function saveArticles()
{

	extract( $_POST );
	
	return "UPDATE #__wub_articles SET ".
			"`texte` = '$texte', ".
			"`type` = '$typeArticle' ".
			"WHERE `id` =$IdMafiajob LIMIT 1";
}

function saveArmes()
{

	extract( $_POST );
	
	return "UPDATE #__wub_armes SET ".
			"`nom` = '$nom', ".
			"`commentaire` = '$commentaire', ".
			"`attaque` = '$attaque', ".
			"`defense` = '$defense', ".
			"`munition` = '$munition', ".
			"`prix_munition` = '$prix_munition', ".
			"`idmagasin` = '$idmagasin', ".
			"`image` = '$image', ".
			"`prix_achat` = '$prix_achat', ".
			"`nombre` = '$nombre', ".
			"`xp` = '$xp' ".
			"WHERE `id` =$IdMafiajob LIMIT 1";
}

function saveVoitures()
{

	extract( $_POST );
	
	return "UPDATE #__wub_voitures SET ".
			"`nom` = '$nom', ".
			"`commentaire` = '$commentaire', ".
			"`attaque` = '$attaque', ".
			"`defense` = '$defense', ".
			"`reservoir` = '$reservoir', ".
			"`move` = '$move', ".
			"`nombre` = '$nombre', ".
			"`idmagasin` = '$idmagasin', ".
			"`image` = '$image', ".
			"`prix_achat` = '$prix_achat', ".
			"`nombre` = '$nombre', ".
			"`xp` = '$xp' ".
			"WHERE `id` =$IdMafiajob LIMIT 1";
}

function saveBots()
{

	extract( $_POST );
	
	return "UPDATE #__wub_ennemis SET ".
			"`nom` = '$nom', ".
			"`commentaire` = '$commentaire', ".
			"`image` = '$image', ".
			"`argent` = '$argent' ".
			"WHERE `id` =$IdMafiajob LIMIT 1";
}


function saveJoueurs()
{

	extract( $_POST );
	
	return "UPDATE #__wub_personnage SET ".
			"lat = '$lat', ".
			"lng = '$lng', ".
			"vie = '$vie', ".
			"xp = '$xp', ".
			"argent = '$argent', ".
			"reservoir = '$reservoir', ".
			"munition = '$munition', ".
			"actif = '$actif', ".
			"equipe = '$equipe', ".
			"casier = '$casier' ".
			"WHERE `id` =$IdMafiajob LIMIT 1";
}

function selectLat($debut=false,$fin=false,$select=false)
{
	
	$var = '';

	for($a=$debut; $a<=$fin;$a++)
	{
		$var .= '<option ';
		
		if($a == $select)
			$var .= 'selected="selected" ';
		
		$var .= 'value="'.$a.'">'.$a.'</option>';
	}
		
	return $var;

}

function selectLng($debut=false,$fin=false,$select=false)
{

	$var = '';

	for($a=$debut; $a<=$fin;$a++)
	{
		$var .= '<option ';
		
		if($a == $select)
			$var .= 'selected="selected" ';
		
		$var .= 'value="'.$a.'">'.chr($a+64).'</option>';
	}
		
	return $var;

}

function optiontypearticle($type=false)
{

	switch($type)
	{
	case '1': $a2 = 'Victoire : attaque joueur'; break;
	case '2': $a2 = 'Défaite : attaque joueur'; break;
	case '3': $a2 = 'Victoire : braquage'; break;
	case '4': $a2 = 'Défaite : braquage'; break;
	case '5': $a2 = 'Victoire : attaque bot'; break;
	case '6': $a2 = 'Défaite : attaque bot'; break;
	case '7': $a2 = 'Victoire : vole bot'; break;
	case '8': $a2 = 'Mis en prison par un flic'; break;
	case '9': $a2 = 'Victoire : vole joueur'; break;
	case '10': $a2 = 'Défaite : vole joueur'; break;
	case '11': $a2 = 'Dénoncer un joueur'; break;
	case '12': $a2 = 'Achat voiture parking'; break;
	default: $a2 = 'Erreur'; break;
	}	
		
	return $a2;

}

function selectNum($debut=false,$fin=false,$select=false)
{
	$var = '';

	for($a=$debut; $a<=$fin;$a++)
	{
		$var .= '<option ';
		
		if($a == $select)
			$var .= 'selected="selected" ';
		
		$var .= 'value="'.$a.'">'.$a.'</option>';
	}
		
	return $var;

}

function selectBoutique($select=false , $type = false)
{
	global $database;

	$database->setQuery("SELECT id,nom FROM #__wub_batiments WHERE option_bat='$type' ORDER BY nom ");
	$total = $database->loadObjectList();
	
	$var = '';
	
		foreach($total as $bat)
		{
			$var .= '<option ';
			
			if($bat->id == $select)
				$var .= 'selected="selected" ';
			
			$var .= 'value="'.$bat->id.'">'.$bat->nom.'</option>';
		}
	 return $var;
	}

function truncate($text,$numb,$etc = "...") 
{
	$text = html_entity_decode($text, ENT_QUOTES);
	if (strlen($text) > $numb) 
	{
		$text = substr($text, 0, $numb);
		$text = substr($text,0,strrpos($text," "));
		
		$punctuation = ".!?:;,-"; //punctuation you want removed
		
		$text = (strspn(strrev($text),  $punctuation)!=0)
				?
				substr($text, 0, -strspn(strrev($text),  $punctuation))
				:
		$text;
		
		$text = $text.$etc;
	}
	$text = htmlentities($text, ENT_QUOTES);
	return $text;
}
?>