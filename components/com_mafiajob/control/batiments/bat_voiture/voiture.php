<?php
/**
* @version $Id: voiture.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/views/voiture.html.php' );
$htmlvoiture = new MafvoitureHTML();

$acheter = $fonction->Get('idvoiture');
$vendre = $fonction->Get('vendre');
$recharge = $fonction->Get('acheterreservoir');
$prix = 10;

if( $perso->idvoiture && $persoVoiture )
	$prix = $persoVoiture->prix_achat - ( $persoVoiture->prix_achat / $config->ratioVenteVoiture ) - ( $persoVoiture->prix_achat / round( $perso->reservoir + 1 ) );

if( $recharge && $perso->idvoiture && $perso->reservoir < $persoVoiture->reservoir)
{
	$perso->reservoir = $persoVoiture->reservoir;
	if($perso->RetraitArgent($persoVoiture->prix_plein))
	{
		$htmlvoiture->Recharge();	
		$historique->MafAjout( $perso, 75 );
	}
}
elseif($acheter && ( $perso->MafFlic() || !$perso->idvoiture ) )
{
	$voitureacheter = $voiture->Retrouver ($acheter);

	if( ( $perso->argent >= $voitureacheter->prix_achat 
		&& $perso->xp >= $voitureacheter->xp 
		&& $voitureacheter->idmagasin == $batiment->id )
		|| ( $perso->MafFlic()  && $batiment->option == 'commissariat' && $perso->xp >= $voitureacheter->xp ) )
	{
		$persoVoiture = $voitureacheter;
		
		if(!$perso->MafFlic())
			$perso->argent -= $persoVoiture->prix_achat;
	
		$perso->idvoiture = $persoVoiture->id;
		$perso->discretion = $persoVoiture->defense;
		$perso->rapidite = $persoVoiture->rapidite;
		$perso->reservoir = $persoVoiture->reservoir;
		$perso->MafUpdate();
		$prix = $persoVoiture->prix_achat - ( $persoVoiture->prix_achat / $config->ratioVenteVoiture ) - ( $persoVoiture->prix_achat / round( $perso->reservoir + 1 ) );
		
		echo '<span class="info">Tu viens de faire l\'acquisition de ton nouveau véhicule d\'une valeur de '.number_format($persoVoiture->prix_achat).' $.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Acquisition d\'un nouveau véhicule ('.$persoVoiture->nom.') pour le prix de '.number_format($persoVoiture->prix_achat).' $';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 7, $texteHistorique );
	}	
	else
		echo '<span class="alert">Tu n\'as pas assez d\'argent ou de points d\'expérience pour avoir ce véhicule de '.number_format($persoVoiture->prix_achat) .' $.</span>';
		
}
elseif( $vendre && $perso->idvoiture)
{
	$reservoir = ( $persoVoiture->reservoir - $perso->reservoir );

	$prix = round ( $persoVoiture->prix_achat - ( $persoVoiture->prix_achat / $config->ratioVenteVoiture ) + (  ( $persoVoiture->prix_achat / 2 ) / $persoVoiture->reservoir * ( $reservoir + 1 ) ) );
	
	if($prix < 10) $prix = 10;

	$perso->RetirerVoiture();
	$perso->AjoutArgent( $prix );
	
	echo '<span class="info">Tu viens de vendre ton véhicule pour la somme de '. number_format($prix).' $.</span>';
			
	// permet l'insertion de cette action dans l'historique
	$texteHistorique = 'Vente d\'un véhicule ('.$persoVoiture->nom.') pour le prix de '.number_format($prix).' $';	// on modifie la phrase d'origine
	$historique->MafAjout( $perso, 8, $texteHistorique );
	
	$persoVoiture = false;	
}
	
if($perso->idvoiture && $persoVoiture && $perso->reservoir < $persoVoiture->reservoir)
	$htmlvoiture->boutonAcheterReservoir( $persoVoiture->prix_plein );

if($persoVoiture)
	$htmlvoiture->detail($persoVoiture);
	
if($perso->idvoiture && !$perso->MafFlic())
{
	$htmlvoiture->boutonVendre($prix);
	echo '<span class="note">Tu ne dois pas avoir de véhicule pour en acheter un nouveau!<br />Pour le moment tu peux que les regarder sans pouvoir acheter.</span>';
}
elseif( $perso->MafFlic() && $batiment->option != 'commissariat' )
	echo '<span class="note">Tu es un flic, tu ne peux pas prendre de véhicule dans cette établissement.<br />Va au commissariat, il y a pleins d\'équipements pour toi.</span>';

else
	echo '<span class="info">Tu as la possibilité d\'acheter un véhicule!<br />Par contre, tu dois avoir un minimum d\'expérience pour certains véhicules.</span>';

if( !$perso->MafFlic() || ( $perso->MafFlic()  && $batiment->option == 'commissariat' ) )
	$htmlvoiture->titreListeAchat();

foreach( $voiture->voitureId as $a)
{
	if($a)
	{
		$donnee = $voiture->Retrouver ($a);
		
		if( $perso->MafFlic() && $batiment->option == 'commissariat' )
		{
			if( $donnee->special )
			{

				$htmlvoiture->detail( $donnee, false );
				
				if( $perso->xp >= $donnee->xp )
					$htmlvoiture->boutonFlic( $donnee->id );
			}
		}
		
		elseif( $donnee->idmagasin == $batiment->id && !$perso->MafFlic() )
		{
			if( !$donnee->special )
			{
				$htmlvoiture->detail( $donnee, false );
				
				if(!$perso->idvoiture && $perso->xp >= $donnee->xp)
					$htmlvoiture->boutonAcheter( $donnee->id );
			}
		}
	}
}
?>
