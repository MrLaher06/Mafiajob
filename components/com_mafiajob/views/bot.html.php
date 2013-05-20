<?php
/**
* @version $Id: bot.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafBotHTML {
	
	function MafBotHTML ( )
	{
	} 
	
	function titreListe ( ) 
	{
	?>
    <?php
	}
	
	function entete ( ) 
	{
	global $config;
	?>

    <?php
	}
	
	function PreparationAttaque ( ) 
	{
	global $config;
	?>
        <span class="info">Tu es en préparation d'une action, celle d'attaquer un habitant.<br />
        Regarde dans la partie <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=equipe');" title="Se rendre dans la partie équipe">équipe </a></span>
    <?php
	}
	
	function PreparationAttaqueLouper ( ) 
	{
		global $config;
	?>
        <span class="alert">Tu ne peux pas préparer cette action, peut-être que tu en as déjà une en cours.<br />
        Regarde dans la partie <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=equipe');" title="Se rendre dans la partie équipe">équipe </a></span>
    <?php
	}
	
	function detail (&$perso, &$var, $arme = false, $voiture = false, $detail = true ) 
	{
		global $config, $fonction;
	?>
    <div class="contentheading"><?php echo $var->nom;?></div>
    <blockquote>
      <table border="0" cellspacing="10" cellpadding="0" >
        <tr>
          <td width="106" align="left" valign="top">
          <img class="imgBlock" onclick="VoirInventaire(4,'4_<?php echo $var->id;?>');" title="Photo de <?php echo $var->nom;?>" src="<?php echo $config->url;?>/images/ennemis/<?php echo $var->image;?>" alt="<?php echo $var->nom;?>" style="cursor:pointer;" width="100" />
          </td>
          <td width="106" align="left" valign="top"><?php 
		if($arme) 
		{
		?>
            <img onclick="VoirInventaire(1,'1_<?php echo $arme->id;?>');" title="<?php echo $var->nom;?> est &eacute;quip&eacute; de l'arme : <?php echo $arme->nom;?>" class="imgBlock" src="<?php echo $config->url;?>/images/armes/<?php echo $arme->image;?>" alt="<?php echo $arme->nom;?>" width="100" style="cursor:pointer;" />
            <?php 
          }
          else 
          { 
          ?>
            <img title="<?php echo $var->nom;?> n'est pas &eacute;quip&eacute; d'une arme " class="imgBlock" src="<?php echo $config->url;?>/images/armes/aucunBot.jpg" alt="Acucne" width="100" />
            <?php 
          } 
          ?>
          </td>
          <td width="106" align="left" valign="top"><?php 
        if($voiture) 
        {
        ?>
            <img onclick="VoirInventaire(2,'2_<?php echo $voiture->id;?>');" title="<?php echo $var->nom;?> roule en : <?php echo $voiture->nom;?>" class="imgBlock" src="<?php echo $config->url;?>/images/voitures/<?php echo $voiture->image;?>" alt="<?php echo $voiture->nom;?>" width="100" style="cursor:pointer;" />
            <?php 
          }
          else 
          {
          ?>
            <img title="<?php echo $var->nom;?> n'est pas &eacute;quip&eacute; d'une voiture " class="imgBlock" src="<?php echo $config->url;?>/images/voitures/aucunBot.jpg" alt="Acucne" width="100" />
            <?php } ?>
          </td>
          <td align="left" valign="top">
            <b>Sante</b> : <?php echo $fonction->MafBG($var->vie);?>
            <b>Expérience</b> : <?php echo number_format($var->xp);?> pts<br />
            <b>Humeur</b> : <?php echo MafBot::humeur($var->humeur);?><br />
            <b>Commentaire</b> : <?php echo $var->commentaire;?><br /></td>
        </tr>
      </table>
      <?php
	  if($detail)	// permet de faire afficher les liens action
	  {
		$sons = $config->url.'/sons/bruitages/attack14.mp3';
	  ?>
      <table width="100%" border="0">
        <tr>
          <td align="left" valign="top">
            <img src="<?php echo $config->url;?>/images/attaquer.png" alt="Attaque" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=attaque&idbot=<?php echo $var->id;?>'); Sound.play('<?php echo $sons; ?>',{replace:true}); return false"> Préparer une attaque contre ce personnage</a> 
            <br />
            <?php 
			if(!$perso->MafFlic()) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/voleargent.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=argent&idbot=<?php echo $var->id;?>');"> Voler de l'argent &agrave; ce personnage</a> 
            <br />
            <?php 
            }
            else
            {
            ?>
            <img src="<?php echo $config->url;?>/images/voleargent.png" alt="Voler" align="middle" /> Voler de l'argent &agrave; ce personnage <br />
            <?php 
            } 
            ?>
            <?php 
			if(!$perso->MafFlic() && $var->idvoiture != 0) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/voler.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=voiture&idbot=<?php echo $var->id;?>');"> Voler le véhicule de ce personnage</a> 
            <br />
            <?php 
            }
            else
            {
            ?>
            <img src="<?php echo $config->url;?>/images/voler.png" alt="Voler" align="middle" /> Voler le véhicule de ce personnage <br />
            <?php 
            } 
            ?>
            <?php 
			if(!$perso->MafFlic() && $var->idarme != 0) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/volearme.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=arme&idbot=<?php echo $var->id;?>');"> Voler l'arme de ce personnage</a> 
            <br />
            <?php 
            }
            else
            {
            ?>
            <img src="<?php echo $config->url;?>/images/volearme.png" alt="Voler" align="middle" /> Voler l'arme de ce personnage <br />
			<?php 
            } 
            ?>
          </td>
          <td align="left" valign="top">
		  <?php 
			if($var->discuter != 0) 
			{
			?>
		<img src="<?php echo $config->url;?>/images/discuter.png" alt="Discuter" align="middle" /> 
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=discuter&idbot=<?php echo $var->id;?>');"> Discuter avec ce personnage</a> <br />
		<?php 
			}
			else
			{
			 ?>
		<img src="<?php echo $config->url;?>/images/discuter.png" alt="Discuter" align="middle" /> Discuter avec ce personnage <br />
		<?php 
			}
			 
			if( $var->taxi == 1 && $perso->idvoiture == 0) 
			{
			?>
		<img src="<?php echo $config->url;?>/images/taxi.png" alt="Taxi" align="middle" /> 
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=deposer&idbot=<?php echo $var->id;?>');"> Ce personnage te propose de te d&eacute;poser sur sa route</a><br />
		<?php 
			}
			else
			{
			 ?>
		<img src="<?php echo $config->url;?>/images/taxi.png" alt="Taxi" align="middle" /> Ce personnage te propose de te d&eacute;poser sur sa route<br />
		<?php 
			}
			 
			if( ( $var->reservoir > 0 && $perso->idvoiture != 0 && $perso->reservoir <= $config->minimumEssence ) || ( $var->reservoir > 0 && $perso->MafFlic() && $perso->idvoiture != 0 && $perso->reservoir <= ( $config->minimumEssence * 2 ) ) ) 
			{
			?>
		<img src="<?php echo $config->url;?>/images/essence.png" alt="Essence" align="middle" /> 
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=gericane&idbot=<?php echo $var->id;?>');"> Ce personnage te propose un giricane de <?php echo $var->reservoir;?> L</a><br />
		<?php 
			}
			else
			{
			 ?>
		<img src="<?php echo $config->url;?>/images/essence.png" alt="Essence" align="middle" /> Ce personnage ne propose pas d'essence<br />
		<?php 
			} 
			 
			if( $var->munition > 0 && $perso->idarme != 0 && !$perso->MafFlic() && $perso->munition <= $config->minimumMunition ) 
			{
			?>
		<img src="<?php echo $config->url;?>/images/munition.png" alt="Munition" align="middle" /> 
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&choix_bot=munition&idbot=<?php echo $var->id;?>');"> Ce personnage te propose <?php echo $var->munition;?> munition(s)</a>
		<?php 
			}
			else
			{
			 ?>
		<img src="<?php echo $config->url;?>/images/munition.png" alt="Munition" align="middle" /> Ce personnage ne te propose pas de munition
		<?php 
			} 
			?>
          </td>
        </tr>
      </table>
     <?php
	 }
	 ?>
    </blockquote>
    <?php
    }
	
	function PlusLa()
	{
	?>
    	<span class="alert">L'habitant est pas ou n'est plus sur cette position, il a aussi pu se planquer</span>
    <?php
	}
}
?>
