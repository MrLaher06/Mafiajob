<?php
/**
* @version $Id: carte.control.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/joueur.class.php' );
require_once( $config->chemin . '/class/bot.class.php' );
require_once( $config->chemin . '/class/batiment.class.php' );
require_once( $config->chemin . '/class/carte.class.php' );
require_once( $config->chemin . '/views/carte.html.php' );

$direction = $fonction->Get( 'direction' );
$ajax = $fonction->Get( 'ajax' );

if($direction)
{
	if($perso->deplacement($direction, $delaiDeplacement))
	{			
		require_once( $config->chemin . '/class/plusieurs.class.php' );
	
		$action = new MafPlusieurs( $database );
		
		// cette partie sert pour l'historique du joueur
		if( $action->MafDeleteAction( $perso->iduser , 1) )
			$historique->MafAjout( $perso, 36 );
			
		$historique->MafAjout( $perso, 1 );
	}
}

$carte = new MafCarte();
$html = new MafCarteHTML();

$listeVoiture = $voiture->Liste ();

$carte->LatLng ($perso->lat, $perso->lng);

$batiments = new MafBatiment ( $database );
$batiments->SelectionBatiment($carte->MinLat, $carte->MaxLat, $carte->MinLng, $carte->MaxLng);

$joueurs = new MafJoueurs ( $database );
$joueurs->SelectionJoueurs($carte->MinLat, $carte->MaxLat, $carte->MinLng, $carte->MaxLng);

$bots = new MafBot ( $database );
$bots->SelectionBot($carte->MinLat, $carte->MaxLat, $carte->MinLng, $carte->MaxLng);

if(!$ajax)
{
	$html->entete();

	echo '<table border="0" cellspacing="0" cellpadding="0" class="CarteTable"><tr><td width="530" valign="top">';
	echo '<div id="CarteAjax" >'."\n";
}

echo '<table align="center" cellspacing="0" cellpadding="0" id="CarteTable" style="background-image:url('.$config->url.'/images/map/zone'.$carte->Zone($perso->lat, $perso->lng).'.jpg);" >'."\n";
echo '<tr>'."\n";
echo '<td class="CarteTdMini"></td>'."\n";

for ( $j = $carte->MinLng; $j < $carte->MaxLng; $j++ )
	echo '<td class="CarteTdMini" align="center" valign="middle" height="15"> ' . $fonction->ConvertLng ( $j ) . ' </td>'."\n";
	
echo '</tr>'."\n";

for ( $i = $carte->MinLat; $i < $carte->MaxLat; $i++ ) 
{
	echo '<tr class="CarteTr" align="center" valign="middle" >'."\n";
	echo '<td class="CarteTdMini" align="center" valign="middle" width="15"> ' . $i . ' </td>'."\n";
	
	for ($j = $carte->MinLng; $j < $carte->MaxLng; $j++ ) 
	{
		$contenu = false;
		$effet = false;
		
		$contenuBulle = false;
		
		$position = $i.'-'.$j;
		
		$visible = $carte->Verificationvisible($perso, $i, $j);
		
		$deplace = $carte->Deplacement ($perso, $i, $j);
		
		$nbrBot = $bots->Nbr( $position );
		
		$nbrJoueur = $joueurs->Nbr( $position );
		
		$batiment =  $batiments->RetrouverSimple ( $position );
		
		//condition d'affichage
		if( $i == $perso->lat && $j == $perso->lng )
			$contenu .= $html->blocPersonnage($perso, $my, $batiment);
			
		elseif($batiment && $deplace)
		{
			$contenu .= $html->blocBatiment($batiment);
			$effet = true;
		}
		elseif($batiment)
			$contenu .= '<img src="'.$config->url.'/images/space.gif" alt="space"/>';
				
		elseif( $nbrJoueur == 1 && $visible )
		{
			$joueur = $joueurs->RetrouverSimple ( $position );
			$contenu .= $html->blocJoueurSimple($joueur, $joueurs, 1, $arme, $voiture);
		}
		elseif ( $nbrJoueur > 1 && $visible )
		{
			$joueur = $joueurs->RetrouverMulti ( $position );
			$contenu .= $html->blocJoueurMulti($joueur, $joueurs, $nbrJoueur, $arme, $voiture);
		}
		elseif( $nbrBot == 1 && $visible )
		{
			$bot = $bots->RetrouverSimple ( $position );
			$contenu .= $html->blocBotSimple($bot, $bots, 1, $arme, $voiture);
		}
		elseif ( $nbrBot > 1 && $visible )
		{
			$bot = $bots->RetrouverMulti ( $position );
			$contenu .= $html->blocBotMulti($bot, $bots, $nbrBot, $arme, $voiture);
		}
		else
			$contenu .= '<img src="'.$config->url.'/images/space.gif" alt="space" />';

		//on defini le style de la case
		$class = 'CarteTd2';
	
		if($visible)
			$class = 'CarteTd1';
		
		echo '<td class="' . $class . '" width="60" valign="middle" align="center">'."\n";
			
		if($deplace)
			echo $carte->LienBouton($deplace, $contenu, $batiments->Acces ( $position ), $effet);
		else
			echo $contenu;
		
		echo '</td>'."\n";
	}
	echo '</tr>'."\n";
}
echo '</table>'."\n";

echo $carte->Pied($joueurs->NbrTotal(), $bots->NbrTotal(), $batiments->NbrTotal(), $perso->MafMoveVerif ( $delaiDeplacement ) );

if(!$ajax)
{
	echo '</div>'."\n";
	
	$html->Refresh();

	echo '</td>';
	
	if($config->voirTchatCarte)
	{
		echo '<td width="250" valign="top">';
		
		require_once( $config->chemin . '/control/tchat.control.php' );
		
		echo '</td>';
	}
	echo '</tr></table>';
}
?>