<?php
/**
* @version $Id: mod_wub_joueur.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

if(isset($_GET['ajax_menu']))
	require_once('./mod_wub_ajax.php');
else
	global $perso, $fonction, $config, $equipe, $my, $mosConfig_live_site;

if(!empty($perso->iduser) )
{
?>
<link href="<?php echo $mosConfig_live_site; ?>/modules/mod_wub_joueur.css" rel="stylesheet" type="text/css" />
<?php
if(!isset($_GET['ajax_menu'])) echo '<div id="ModJoueur">';

$ajax_menu = $fonction->Get('ajax_menu');

$puissance = round($fonction->MoyennePourcentage( $perso->puissance, $perso->SelectionMeilleurPuissance ( ) )); 
$intelligence = round($fonction->MoyennePourcentage( $perso->intelligence, $perso->SelectionMeilleurIntelligence ( ) )); 
$visibilite = round($fonction->MoyennePourcentage( $perso->visibilite, $perso->SelectionMeilleurVisibilite ( ) )); 
?>
<div class="fondModuleJoueur">
  <table width="845" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="80" align="center" valign="top"><a href="<?php echo $config->lien; ?>&task=avatar" style="font-size:10px;" title="Modifier votre portrait"><img class="imgBlockMod" src="http://ima.minigao.com/l80/p87/<?php echo $perso->iduser; ?>.jpg?<?php echo time(); ?>" alt="Portrait" height="80" width="67" style="background-color:<?php echo $equipe->CouleurEquipe($perso->equipe); ?>;" /></a></td>
      <td width="80" align="center" valign="top"><img class="imgBlockMod" width="67" title="Portrait" src="components/com_mafiajob/images/mafia/<?php echo $equipe->ImageEquipe($perso->equipe); ?>" alt="Mafia" height="80" style="background-color:<?php echo $equipe->CouleurEquipe($perso->equipe); ?>;" /></td>
      <td width="550"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="TableauInfoJoueur">
          <tr>
            <td width="140"><span class="Style1">Sant&eacute; </span><span class="Style2"><?php echo $perso->vie; ?>pts</span></td>
            <td width="190"><?php echo $fonction->MafBG($perso->vie); ?></td>
            <td width="140"><span class="Style1">Rapidit&eacute; </span><span class="Style2"><?php echo $perso->rapidite; ?>pts <i>(<?php echo $perso->reservoir; ?>L)</i></span></td>
            <td width="130"><?php echo $fonction->MafBG($perso->rapidite); ?></td>
          </tr>
          <tr>
            <td width="140"><span class="Style1">Attaque </span><span class="Style2"><?php echo $perso->attaque; ?>pts <i>(<?php echo $perso->munition; ?>)</i></span></td>
            <td width="190"><?php echo $fonction->MafBG($perso->attaque); ?></td>
            <td width="140"><span class="Style1">Discr&eacute;tion </span><span class="Style2"><?php echo $perso->discretion; ?>pts</span></td>
            <td width="130"><?php echo $fonction->MafBG($perso->discretion); ?></td>
          </tr>
          <tr>
            <td width="140"><span class="Style1">D&eacute;fense </span><span class="Style2"><?php echo $perso->defense; ?>pts</span></td>
            <td width="190"><?php echo $fonction->MafBG($perso->defense); ?></td>
            <td width="140"><span class="Style1">Visibilit&eacute; </span><span class="Style2"><?php echo $perso->visibilite; ?>pts</span></td>
            <td width="130"><?php echo $fonction->MafBG($visibilite); ?></td>
          </tr>
          <tr>
            <td width="140"><span class="Style1">Puissance </span><span class="Style2"><?php echo $perso->puissance; ?>pts</span></td>
            <td width="190"><?php echo $fonction->MafBG($puissance); ?></td>
            <td width="140"><span class="Style1">Intelligence </span><span class="Style2"><?php echo $perso->intelligence; ?>pts</span></td>
            <td width="130"><?php echo $fonction->MafBG($intelligence); ?></td>
          </tr>
          <tr>
            <td colspan="2"><span class="Style3">Argent :</span> <span class="Style4"><?php echo number_format($perso->argent); ?>$</span></td>
            <td colspan="2"><span class="Style3">Exp&eacute;rience :</span> <span class="Style4"><?php echo number_format($perso->xp); ?>/<?php echo number_format($perso->ProchainNiveau($perso->xp)); ?> pt(s)</span></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<?php
if(!isset($_GET['ajax_menu'])) echo '</div>';

}
elseif($my->id)
{
?>
<div id="ModJoueur" align="center"><a href="index.php?option=com_scores" title="Score" ><img src="images/promo2.png" alt="promo" name="promo" border="0" usemap="#promoMap" id="promo" /></a> </div>
<?php
}
else
{
?>
<div align="center"><a href="./index.php?option=com_comprofiler&task=registers"><img name="promo" src="images/promo.png" id="promo" usemap="#m_promo" alt="promo" border="0" height="130" width="860" /></a></div>
<?php
}


?>
