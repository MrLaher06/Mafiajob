<?php
/**
* @version $Id: batiment.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/batiment.class.php' );

$batiments = new MafBatiment ( $database );
$batiment = $batiments->SelectionSimple($perso->lat, $perso->lng);

if($batiment)
{
	require_once( $config->chemin . '/views/batiment.html.php' );

	$html = new MafBatimentHTML();
	
	if($task == 'braquage')
	{
		require_once( $config->chemin . '/class/plusieurs.class.php' );
	
		$preparation = new MafPlusieurs( $database );
		
		if( $preparation->MafPreparation( $perso, $batiment->id, $batiment->nom, 2 ) )
		{
			$html->PreparationBraquage();
			
			// permet l'insertion de cette action dans l'historique
			$texteHistorique = $fonction->MafSprintf(_PREPARATION_BRAQUAGE_BAT , array('a' => $batiment->nom ) );	// on modifie la phrase d'origine
			$historique->MafAjout( $perso, 2, $texteHistorique );
		}
		else
			$html->PreaparationBraquageLouper();
	}
		
	$MeilleurProtection =  $batiments->SelectionMeilleurProtection ( );
	$prixAchatBatiment = $batiment->prix_achat;
	
	$html->entete();	 
	$html->presentation($batiment, $MeilleurProtection, $prixAchatBatiment);

	if($batiment->option && $task == 'batiment')
		require_once( $config->chemin . '/control/batiments/bat_' . $batiment->option . '/' . $batiment->option .'.php' );
	elseif($task == 'batiment')
		require_once( $config->chemin . '/control/batiments/bat_defaut/defaut.php' );

	
	//on cumul le nombre d'action total pour savoir combien d'action il y a en cours (voir fichier action.control.php)
	$config->action++;
}
else
	require_once( $config->chemin . '/control/' . $config->fichierdefault );
?>