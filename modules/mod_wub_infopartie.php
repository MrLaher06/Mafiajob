<?php
/**
* @version $Id: mod_wub_infopartie.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mosConfig_absolute_path, $database;

$database->setQuery("SELECT * FROM #__wub_victoire ORDER BY id DESC LIMIT 1");
$parties = $database->loadObjectList();

$mod_infopartie = false;

if($parties)
	$mod_infopartie = $parties[0];

if($mod_infopartie)
{
	echo '<span>La partie a d&eacute;buté il y a <b>'.mod_convertirtime($mod_infopartie->timer).'</b><br /><i>Le : '.mod_wubdate($mod_infopartie->date_victoire).'</i></span>';
}
else
	echo 'aucun resultat';

$database->setQuery("SELECT AVG (attaque) AS mattaque, ".
					"AVG (defense) AS mdefense, ".
					"AVG (discretion) AS mdiscretion, ".
					"AVG (rapidite) AS mrapidite, ".
					"AVG (visibilite) AS mvisibilite, ".
					"AVG (intelligence) AS mintelligence, ".
					"AVG (puissance) AS mpuissance, ".
					"AVG (argent) AS margent, ".
					"AVG (banque) AS mbanque, ".
					"AVG (vie) AS mvie, ".
					"AVG (xp) AS mxp FROM #__wub_personnage ");
$moyenne = $database->loadObjectList();

$moy = $moyenne[0];

echo '<ul>';
echo '<li>Moyenne de vie : <b>'.round ( $moy->mvie ).'</b> pts</li>';
echo '<li>Moyenne d\'attaque : <b>'.round ( $moy->mattaque ).'</b> pts</li>';
echo '<li>Moyenne de défense : <b>'.round ( $moy->mdefense ).'</b> pts</li>';
echo '<li>Moyenne de discrétion : <b>'.round ( $moy->mdiscretion ).'</b> pts</li>';
echo '<li>Moyenne de rapidité : <b>'.round ( $moy->mrapidite ).'</b> pts</li>';
echo '<li>Moyenne de puissance : <b>'.round ( $moy->mpuissance ).'</b> pts</li>';
echo '<li>Moyenne d\'intelligence : <b>'.round ( $moy->mintelligence ).'</b> pts</li>';
echo '<li>Moyenne de visibilité : <b>'.round ( $moy->mvisibilite ).'</b> pts</li>';
echo '<li>Moyenne de XP : <b>'.number_format ( round ( $moy->mxp ) ).'</b> pts</li>';
echo '<li>Moyenne d\'argent : <b>'.number_format ( round ( $moy->margent ) ).'</b> $</li>';
echo '<li>Moyenne en banque : <b>'.number_format ( round ( $moy->mbanque ) ).'</b> $</li>';
echo '</ul>';

/*
	Function pour convertir le temps qui est en seconde
*/
function mod_convertirtime($temps)
{
	$seconde = time() - $temps;
	
	if( $seconde < 60 )
		return $seconde .' seconde(s)';
	elseif($seconde < 3600)
		return floor ( $seconde/60 ) .' min';
	elseif($seconde < 86400)
		return floor ( $seconde/60/60 ) .' h';
	else
		return floor ( $seconde/60/60/24 ) .' jour(s)';
}

/*
	Function pour convertir la date
*/
function mod_wubdate($date=false)
{
	return utf8_decode  ( mosFormatDate ($date, '%A %d %B %Y') );
}
?>