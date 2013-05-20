<?php
/**
* @version $Id: arme.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/views/arme.html.php' );
$htmlArme = new MafArmeHTML();

$acheter = $fonction->Get('idarme');
$vendre = $fonction->Get('vendre');
$recharge = $fonction->Get('achetermunition');

if( $recharge && $perso->idarme && $perso->munition < $persoArme->munition)
{
	$perso->munition = $persoArme->munition;
	if($perso->RetraitArgent($persoArme->prix_munition))
	{
		$htmlArme->Recharge();	
		$historique->MafAjout( $perso, 74 );
	}
}
elseif($acheter && ( !$perso->idarme || $perso->MafFlic() ) )
{
	$armeacheter = $arme->Retrouver ($acheter);

	if( ( $perso->argent >= $armeacheter->prix_achat 
		&& $perso->xp >= $armeacheter->xp 
		&& $armeacheter->idmagasin == $batiment->id )
		|| ( $perso->MafFlic()  && $batiment->option == 'commissariat' && $perso->xp >= $armeacheter->xp ) )
	{
		$persoArme = $armeacheter;
		
		if(!$perso->MafFlic())
			$perso->argent -= $persoArme->prix_achat;
			
		$perso->idarme = $persoArme->id;
		$perso->attaque = $persoArme->attaque;
		$perso->defense = $persoArme->defense;
		$perso->munition = $persoArme->munition;
		$perso->MafUpdate();
		
		echo '<span class="info">Tu viens de faire l\'acquisition de ta nouvelle arme ('.$persoArme->nom.').<br />Elle a une valeur de '.number_format($persoArme->prix_achat).' $.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Acquisition d\'une nouvelle arme ('.$persoArme->nom.') d\'une valeur de '.number_format($persoArme->prix_achat).' $';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 5, $texteHistorique );
	}	
	else
		$htmlArme->error1();
}
elseif( $vendre && $perso->idarme)
{
	$munition = ( $persoArme->munition - $perso->munition );

	$prix = round( $persoArme->prix_achat - ( $persoArme->prix_achat / $config->ratioVenteArme ) + (  ( $persoArme->prix_achat / 2 ) / $persoArme->munition * ( $munition + 1 ) ) );
	
	if($prix < 10) $prix = 10;
	
	$perso->RetirerArme();
	$perso->AjoutArgent( $prix );
	
	echo '<span class="info">Tu viens de vendre ton arme ('.$persoArme->nom.') pour la somme de '. number_format($prix).' $.</span>';
			
	// permet l'insertion de cette action dans l'historique
	$texteHistorique = 'Vente d\'une arme ('.$persoArme->nom.') pour le prix de '.number_format($prix).' $';	// on modifie la phrase d'origine
	$historique->MafAjout( $perso, 6, $texteHistorique );
	
	$persoArme = false;	
}

if($persoArme)
	$htmlArme->detail($persoArme);

if( $perso->idarme && !$perso->MafFlic() )
{
	echo '<span class="note">Tu ne dois pas avoir d\'arme sur toi pour en acheter une nouvelle!<br />Pour le moment tu ne peux que les regarder sans pouvoir en acheter une.</span>';
	$htmlArme->boutonVendre();
}
elseif( $perso->MafFlic() && $batiment->option != 'commissariat' )
	echo '<span class="note">Tu es un flic, tu ne peux pas prendre d\'arme dans cette établissement.<br />Va au commissariat, il y a pleins d\'équipements pour toi.</span>';

else
	echo '<span class="info">Tu as la possibilité de prendre une arme!<br /> Par contre, tu dois avoir un minimum d\'expérience pour certaines armes.</span>';

if($perso->idarme && $perso->munition < $persoArme->munition)
	$htmlArme->boutonAcheterMunition($persoArme->prix_munition);

if( !$perso->MafFlic() || ( $perso->MafFlic()  && $batiment->option == 'commissariat' ) )
	$htmlArme->titreListeAchat();

foreach( $arme->armeId as $a)
{
	if($a)
	{
		$donnee = $arme->Retrouver ($a);
		
		if( $perso->MafFlic() && $batiment->option == 'commissariat' )
		{
			if( $donnee->special )
			{

				$htmlArme->detail( $donnee, false );
				
				if( $perso->xp >= $donnee->xp )
					$htmlArme->boutonFlic( $donnee->id );
			}
		}
		
		elseif( $donnee->idmagasin == $batiment->id && !$perso->MafFlic() )
		{
			if( !$donnee->special )
			{
				$htmlArme->detail( $donnee, false );
				
				if(!$perso->idarme && $perso->xp >= $donnee->xp)
					$htmlArme->boutonAcheter( $donnee->id );
			}
		}
	}
}
?>
