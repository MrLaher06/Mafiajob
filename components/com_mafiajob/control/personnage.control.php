<?php
/**
* @version $Id: personnage.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/equipe.class.php' );
$equipe = new MafEquipe ( $database );
$equipe->Selection();

require_once( $config->chemin . '/class/historique.class.php' );
$historique = new MafHistorique( $database );

require_once( $config->chemin . '/class/voiture.class.php' );
$voiture = new MafVoiture( $database );

$voiture->Liste();
$persoVoiture = false;

if($perso->idvoiture)
{
	$persoVoiture = $voiture->Retrouver( $perso->idvoiture );
	if($perso->reservoir)
		$delaiDeplacement = $persoVoiture->temps; 
	else
		$delaiDeplacement = $config->DelaiDeplacementCarte;
}
else
	$delaiDeplacement = $config->DelaiDeplacementCarte;


require_once( $config->chemin . '/class/arme.class.php' );
$arme = new MafArme( $database );

$arme->Liste();

$persoArme = false;

if($perso->idarme)
	$persoArme = $arme->Retrouver( $perso->idarme );
?>