<?php
/**
* @version $Id: batiment.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafBatimentHTML 
{
	
	function entete ( ) 
	{
		global $config, $mosConfig_live_site;
	?>

    <?php
	}
	
	function ListeDeVosBatiment ( ) 
	{
	?>
        <h1>Liste des batiments</h1>
    <?php
	}
	
	function PreparationBraquage ( ) 
	{
	global $config;
	?>
        <span class="info">Tu es en préparation d'une action, celle de braquer un établissement.<br />
        Regarde dans la partie <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=equipe');" title="Se rendre dans la partie équipe">équipe </a></span>
    <?php
	}
	
	function PreaparationBraquageLouper ( ) 
	{
		global $config;
	?>
        <span class="alert">Tu ne peux pas préparer cette action, peut-être que tu en as déjà une en cours.<br />
        Regarde dans la partie <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=equipe');" title="Se rendre dans la partie équipe">équipe </a></span>
    <?php
	}
	
	function presentation ( &$var , $MeilleurProtection = 0 , $PrixAchat, $Proprietaire = false, $Lien = true) 
	{
		global $config, $task, $fonction, $equipe, $perso;
		
		$pourcentage = $fonction->MoyennePourcentage($var->protection, $MeilleurProtection);
	
		if($task == 'batiment') 
		{ 
		?>
            <h1>Bienvenue dans notre établissement</h1>
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=action');"><img src="<?php echo $config->url;?>/images/voirbatiment.png" align="middle" title="Voir ce que propose ce batiment" alt="batiment" /> Sortir de cet établissement</a>
        <?php 
		} 
		else 
		{ 
		?>
        <div class="contentheading"><?php echo $var->nom; ?></div>
        <blockquote>
          <table border="0" cellspacing="0" cellpadding="10" >
            <tr>
              <td align="left" valign="top"><img onclick="VoirInventaire(3,'3_<?php echo $var->id;?>');" style="cursor:pointer;" src="<?php echo $config->url;?>/images/batiments/<?php echo $var->image;?>" alt="<?php echo $var->nom;?>" height="100" class="imgBlock">
                <?php if($var->proprio_equipe) { ?>
                <div class="blockEquipe" style="background-color:<?php echo $equipe->CouleurEquipe($var->proprio_equipe);?>;"><?php echo $equipe->NomEquipe($var->proprio_equipe);?></div>
                <?php } ?>
              </td>
              <td align="left" valign="top" ><div align="justify"> <b>Position</b> : <?php echo $fonction->convertLng ($var->lng);?> - <?php echo $var->lat;?><br />
                  <?php echo $fonction->MafBG($pourcentage); ?> <b>Prix d'achat</b> : <?php echo number_format($var->prix_achat);?> $<br />
                  <b>Commentaire</b> : <?php echo $var->commentaire;?>
                  <?php 
				  if($Lien) 
				  { 
					  ?>
					  <br />
					  <img src="<?php echo $config->url;?>/images/voirbatiment.png" title="Voir ce que propose ce batiment" alt="batiment" /> <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=batiment');">Entrer dans cet établissement pour voir ses options</a> <br />
					  <?php 
					  if($var->proprio_equipe != $perso->equipe) 
					  { 
					  ?>
                      <img src="<?php echo $config->url;?>/images/braquage.png"  title="Braquer ce batiment" alt="Braquage" /> <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=braquage');" >Braquer cet établissement seul ou avec d'autres joueurs</a> <br />
					  <?php 
					  }
					  if($var->proprio != $perso->iduser && $var->prix_achat) 
					  { 
					  ?>
					  <img src="<?php echo $config->url;?>/images/stat.png"  title="Acheter ce batiment" alt="Achat" /> <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=achatBatiment');" >Acheter ce batiment <?php echo number_format($PrixAchat);?> $ pour en devenir le propriétaire</a>
					  <?php 
					  }
					  elseif($var->proprio == $perso->iduser )
					  { 
					  ?>
					  <img src="<?php echo $config->url;?>/images/stat.png"  title="Gerer ce batiment" alt="Gestion" /> <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=achatBatiment');" >Gérer votre batiment</a>
					  <?php 
					  } 
					  ?>
                  <?php 
				  } 
				  ?>
                </div></td>
            </tr>
          </table>
          <?php 
            if($Proprietaire)
            {
				?>
				<span class="info">Le propriétaire actuel est : <?php echo $Proprietaire; ?></span>
				<?php 
            } 
            ?>
        </blockquote>
        <?php
        
        } ?>
<?php
	}
}
?>
