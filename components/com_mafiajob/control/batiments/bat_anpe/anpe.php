<?php
/**
* @version $Id: anpe.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/mission.class.php' );
$mission = new MafMission( $database );

$maMission = $mission->MafSelection ( $perso->iduser );

if($fonction->Get('recevoir') && !$maMission )
{
	echo $mission->MafDemande ( $fonction->Get('niveau') );
	$maMission = $mission->MafSelection ( $perso->iduser );
}

elseif($fonction->Get('valider') && $maMission )
{
	if( $mission->MafValide ( ) )
		echo '<span class="info">Tu as réussi ta mission!</span>';
	else
		echo '<span class="alert">Tu n\'as pas réussi ta mission!</span>';
		
	$maMission = false;
}

?>
<form id="form1" name="form1" method="post" action="<?php echo $config->lienAjaxTask; ?>">

  <label>
  <?php
  if( !$maMission )
  {
  ?>
  <span class="info">Vous avez la possibilité de choisir le niveau de votre mission, ce qui permet dans un premier temps de gagner un peu de points assez rapidement.</span>
  <blockquote>
<img src="<?php echo $config->url;?>/images/mission.jpg" alt="mission" height="100" align="left" style="margin:10px;" class="imgBlock">
  <p>Ici, vous aurez la possibilit&eacute; de trouver des missions pour faire &eacute;voluer votre personnage plus rapidement. Pour cela, il vous suffit de cliquer sur le bouton ci-dessus en selectionnant le niveau de celle-ci . Vous n'aurez aucun d&eacute;lai pour effectuer votre mission. Par contre, toutes les conditions devront &ecirc;tre respect&eacute;es sinon l'effet contraire vous arrivera et vous perdrez des points d'exp&eacute;rience.</p>
  <select name="niveau" id="niveau" class="buttonMaf">
  <option value="0">Facile</option>
  <option value="2">Normal</option>
  <option value="4">Difficile</option>
  <option value="6">Extreme</option>
  </select> 
  <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ('niveau')+'&recevoir=true');" name="recevoir" id="button" class="buttonMaf" value="Je souhaite recevoir une mission" /></blockquote>
  <?php
  }
  else
  {
  
  	echo $mission->MafTitreMission ( );
	
  ?><blockquote>
	<img src="<?php echo $config->url;?>/images/mission.jpg" alt="mission" height="100" align="left" style="margin:10px;" class="imgBlock">
  <p>Vous pensez avoir r&eacute;ussi la mission du : <b><?php echo $fonction->MafDate($mission->date); ?></b><br />
  Il vous suffit de la valider via le bouton ci-dessous.<br />Par contre, faite attention d'avoir respect&eacute; les conditions du contrat sinon vous perdrez <?php echo number_format($mission->niveau + 1); ?> point(s) d'exp&eacute;rience mais si vous les respectez les conditions vous gagnerez un supplément de <?php echo number_format($config->statAvoirSupplTypeArgentGagner); ?> $ en liquide </p>
  <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', '&valider=true');" name="valider" id="valider" class="buttonMaf" value="Je souhaite valider ma mission" /></blockquote>
  <?php
  }
  ?>
  </label>

</form>
