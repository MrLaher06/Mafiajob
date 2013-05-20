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

class MafJoueurHTML {
	
	
	function titreListe ( ) 
	{
	?>
    <h1>Liste des joueurs qui se trouvent sur votre position</h1>
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
        <span class="info">Tu es en préparation d'une action, celle d'attaquer un joueur.<br />
        Regarde dans la partie <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&task=equipe');" title="Se rendre dans la partie équipe">équipe </a></span>
    <?php
	}
	
	function PreparationAttaqueLouper ( ) 
	{
		global $config;
	?>
        <span class="alert">Tu ne peux pas préparer cette action, peut-être que tu en as déjà une en cours.<br />
        Regarde dans la partie <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&task=equipe');" title="Se rendre dans la partie équipe">équipe </a></span>
    <?php
	}
	
	function detail ( &$perso, &$var, $detail = true, $imageArme = false, $imageVoiture = false  ) 
	{
		global $config, $equipe, $fonction, $task;
		
			$portrait = 'defaut.jpg';

		if( !empty( $var->image ) )
			$portrait = $var->image;
		
	?>
    <blockquote>
    <h3>Informations générales sur <?php echo $var->username;?></h3>
      <table border="0" cellspacing="10" cellpadding="0" >
	  <tr>
		<td width="10%" rowspan="2" align="center" valign="top"> <img class="imgBlock2" style="background-color:<?php echo $equipe->CouleurEquipe($var->equipe); ?>;" title="Portrait" src="http://ima.minigao.com/l120/p87/<?php echo $var->iduser; ?>.jpg?<?php echo time(); ?>" alt="Portrait" height="135" />
          </td>
		<td width="10%" rowspan="2" align="center" valign="top"><img class="imgBlock" title="Equipe" src="<?php echo $config->url;?>/images/mafia/<?php echo $equipe->ImageEquipe($var->equipe); ?>" alt="Equipe" width="100" height="135" style="background-color:<?php echo $equipe->CouleurEquipe($var->equipe); ?>;"/></td>
		<td width="10%" height="55" align="center" valign="top">
        <?php
	  if($imageArme)
	  {
	   ?>
       <img class="imgBlock" title="<?php echo $imageArme->nom; ?>" src="<?php echo $config->url;?>/images/armes/<?php echo $imageArme->image; ?>" alt="Arme" width="55" />
       <?php
	  }
	  else
	  {
	   ?>
       <img class="imgBlock" title="Aucune arme" src="<?php echo $config->url;?>/images/armes/aucunBot.jpg" alt="Arme" width="55" />
       <?php
	  }
	   ?>       </td>
	  <td width="50%" rowspan="2" align="left" valign="top">
      <ul class="Maful" >
        <li><b>Son &eacute;quipe</b> : <?php echo $equipe->NomEquipe($var->equipe); ?> </li>
        <li><b>Ses points d'expérience</b> : <?php echo number_format($var->xp); ?> pts</li>
        <li><b>Son Niveau</b> : <?php echo $perso->Niveau($var); ?></li>
        <li><b>Position</b> : <?php echo $fonction->ConvertLng($var->lng); ?> - <?php echo $var->lat; ?></li>
        <li><b>Etat du joueur</b> : <?php echo $fonction->etatJoueurJeu($var->actif); ?></li>
        <li><b>IP du joueur</b> : <?php echo $var->ip; ?></li>
        <li><b>Commentairer</b> : <?php echo $var->commentaire; ?></li>
	  </ul> 
      <?php
		if($task != 'batiment')
		{
			if( ( time() - $var->tempsplanque ) > $config->delaiPlanqueJoueur && ( time() - $var->tempsmove ) > $config->delaiPlanqueJoueur && $perso->MafFlic()) 
			{
			?>
			<img src="<?php echo $config->url;?>/images/police.png" alt="Amende" align="middle" /> 
			<a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=planque&idjoueur=<?php echo $var->iduser;?>');"> Planquer ce joueur</a><br />
			<?php
			} 
			else
			{
			?>
			Actif sur la carte depuis : <?php echo $fonction->ConvertirTemps( $var->tempsplanque ); ?><br />
			<?php
				if( ( time() - $var->tempsplanque ) > $config->delaiPlanqueJoueur && ( time() - $var->tempsmove ) > $config->delaiPlanqueJoueur && !$perso->MafFlic()) 
				{
					echo 'Tu peux prévenir un flic pour qu\'il le planque.';
				}
			}
		}
		?> 
      </tr>
	  <tr>
	    <td align="center" valign="top">
      <?php
	  if($imageVoiture)
	  {
	   ?>
       <img class="imgBlock" title="<?php echo $imageVoiture->nom; ?>" src="<?php echo $config->url;?>/images/voitures/<?php echo $imageVoiture->image; ?>" alt="Voiture" width="55" />
      <?php
	  }
	  else
	  {
	   ?>
       <img class="imgBlock" title="Aucune voiture" src="<?php echo $config->url;?>/images/voitures/aucunBot.jpg" alt="Voiture" width="55" />
       <?php
	  }
	   ?>       </td>
	    </tr>
	</table>
    <?php 
	$this->MafSeparateur ( );
	?>
	  <?php
	  if( $detail && $perso->MafDelaiPlanque() )	// permet de faire afficher les liens action
	  {
	  ?>
      <h3>Les actions possibles contre <?php echo $var->username;?></h3>
      <table width="100%" border="0">
        <tr>
          <td align="left" valign="top">
            <img src="<?php echo $config->url;?>/images/attaquer.png" alt="Attaque" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=attaque&idjoueur=<?php echo $var->iduser;?>');"> Préparer une attaque contre ce joueur</a> 
            <br />
            
            <?php 
			if( $var->casier && $var->MafFlic()) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/prison.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=denoncer&idjoueur=<?php echo $var->iduser;?>');"> Dénoncer ce flic véreux</a> 
            <br />
            <?php
			}elseif(!$var->MafFlic() && $var->casier)
			{
			?>
            <img src="<?php echo $config->url;?>/images/prison.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=denoncer&idjoueur=<?php echo $var->iduser;?>');"> Dénoncer ce joueur recherché</a> 
            <br />
            <?php
			}
			?>
            <?php 
			if(!$perso->MafFlic() && $var->idvoiture) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/voler.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=voiture&idjoueur=<?php echo $var->iduser;?>');"> Voler le véhicule de ce joueur</a> 
            <br />
            <?php 
            }
            else
            {
            ?>
            <img src="<?php echo $config->url;?>/images/voler.png" alt="Voler" align="middle" /> Voler le véhicule de ce joueur<br />
            <?php 
            } 
            ?>
            <?php 
			if(!$perso->MafFlic() && $var->idarme) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/volearme.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=arme&idjoueur=<?php echo $var->iduser;?>');"> Voler l'arme de ce joueur</a> 
            <br />
            <?php 
            }
            else
            {
            ?>
            <img src="<?php echo $config->url;?>/images/volearme.png" alt="Voler" align="middle" /> Voler l'arme de ce joueur<br />
			<?php 
            } 
            ?>
            <?php 
			if($perso->MafFlic()) 
			{
			?>
				<?php 
                if( $perso->idvoiture && $perso->reservoir && $perso->idarme && $perso->munition) 
                {
                ?>
                <img src="<?php echo $config->url;?>/images/control.png" alt="Control de routine" align="middle" /> 
                <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=control&idjoueur=<?php echo $var->iduser;?>');"> Controle de routine au poste</a><br />
                <?php 
                } 
				else
				{
				?>
                <img src="<?php echo $config->url;?>/images/control.png" alt="Control de routine" align="middle" /> Controle de routine au poste<br />
                <?php
				}
				
                if( $perso->idarme && $perso->munition) 
                {
                ?>
                <img src="<?php echo $config->url;?>/images/police.png" alt="Amende" align="middle" /> 
                <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=amende&idjoueur=<?php echo $var->iduser;?>');"> Donner une amende à ce joueur</a><br />
                <?php
				} 
				else
				{
				?>
                <img src="<?php echo $config->url;?>/images/police.png" alt="Amende" align="middle" /> Donner une amende à ce joueur<br />
                <?php
				}
				
			} 
			?>
          </td>
          <td align="left" valign="top">
            <?php 
			if(!$perso->MafFlic()) 
			{
			?>
            <img src="<?php echo $config->url;?>/images/voleargent.png" alt="Voler" align="middle" /> 
            <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=argent&idjoueur=<?php echo $var->iduser;?>');"> Voler de l'argent &agrave; ce joueur</a> 
            <br />
            <?php 
            }
            else
            {
            ?>
            <img src="<?php echo $config->url;?>/images/voleargent.png" alt="Voler" align="middle" /> Voler de l'argent &agrave; ce joueur <br />
            <?php 
            } 
            ?>
		  <?php
			if( ( $var->reservoir < $config->minimumEssence && $var->idvoiture  && $perso->idvoiture  && $perso->reservoir > $config->minimumEssence ) && ( $perso->equipe == $var->equipe || $perso->MafFlic() ) ) 
			{
			?>
		<img src="<?php echo $config->url;?>/images/essence.png" alt="Essence" align="middle" /> 
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=gericane&idjoueur=<?php echo $var->iduser;?>');"> Offrir un giricane d'essence de <?php echo $config->minimumEssence;?> L à ce joueur</a><br />
		<?php 
			}
			else
			{
			 ?>
		<img src="<?php echo $config->url;?>/images/essence.png" alt="Essence" align="middle" /> Impossible d'offrir un géricane d'essence à ce joueur<br />
		<?php 
			} 
			 
			if( $var->munition < $config->minimumMunition && $perso->idarme && $var->idarme && !$perso->MafFlic() && $perso->munition > $config->minimumMunition && $perso->equipe == $var->equipe ) 
			{
			?>
		<img src="<?php echo $config->url;?>/images/munition.png" alt="Munition" align="middle" /> 
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=munition&idjoueur=<?php echo $var->iduser;?>');"> Offrir <?php echo $config->minimumMunition;?> munitions à ce joueur</a><br />
		<?php 
			}
			else
			{
			 ?>
		<img src="<?php echo $config->url;?>/images/munition.png" alt="Munition" align="middle" /> Impossible d'offrir des munitions à ce joueur<br />
		<?php 
			} 
			?>
            <?php 
			if($perso->MafFlic()) 
			{
			?>
				<?php 
                if($var->casier && $var->xp >= $config->xpJoueurPrison && $perso->xp <= $config->NiveauXP[$config->niveauFlicMettrePrison] && $perso->idarme && $perso->munition) 
                {
                ?>
                    <img src="<?php echo $config->url;?>/images/prison.png" alt="Arrestation" align="middle" /> 
                    <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask;?>&choix_joueur=arrestation&idjoueur=<?php echo $var->iduser;?>');"> Mettre ce joueur en prison</a><br />
                <?php 
                } 
				else
				{
                ?>
                    <img src="<?php echo $config->url;?>/images/prison.png" alt="Arrestation" align="middle" /> Mettre ce joueur en prison<br />
                <?php 
                }
                ?>
                <img src="<?php echo $config->url;?>/images/plusieurs.png" alt="Detail" align="middle" /> 
                <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax;?>&task=information&iduser=<?php echo $var->iduser;?>');"> Voir le détail de ce joueur</a><br />
            <?php 
			} 
			?>
          </td>
        </tr>
      </table>
      <?php 
		$this->MafSeparateur ( );
			
        if( $perso->MafFlic() ) 
        {
        ?>
      <h3>Fiche policiaire de <?php echo $var->username;?></h3>
      <table border="0" cellspacing="5" cellpadding="0" width="100%" >
          <tr>
            <td>
            <b>Argent</b> : <?php echo number_format($var->argent); ?> $<br />
            <b>Nombre de vente stupefiant</b> : <?php echo number_format($var->stupefiant); ?><br />
            </td>
            <td>
            <b>Nombre vole d'argent</b> : <?php echo number_format($var->voleargent); ?><br />
            <b>Nombre d'attaque</b> : <?php echo number_format($var->nbrattaque); ?>
        	</td>
            <td>
            <b>Nombre vole d'arme</b> : <?php echo number_format($var->volearme); ?><br />
            <b>Nombre vole de voiture</b> : <?php echo number_format($var->volevoiture); ?>
        	</td>
          </tr>
        </table>
         <?php 			
			if( $var->casier ) 
			{
				?>
				<span class="info">
				<b><?php echo $var->username; ?> est recherché par les forces de police</b>
				<?php 
					
					if(!$perso->idarme || !$perso->munition) 
					{
					?>
						<br />Tu ne peux pas faire d'action policière si tu n'as pas d'arme ou aucune munition.
					<?php 
					}
					
					if( !$perso->idvoiture || !$perso->reservoir ) 
					{
					?>
						<br />Si tu veux faire un control de routine, il te faut un véhicule pour transporter ce joueur au commissariat.
					<?php 
					} 

					if( $perso->xp < $config->xpJoueurPrison ) 
					{
					?>
						<br /><?php echo $var->username; ?> n'a pas assez d'expérience pour aller en prison pour le moment. Il a moins de <?php echo $config->xpJoueurPrison; ?> pts d'expérience.
					<?php 
					} 
					
					if($perso->xp <= $config->NiveauXP[$config->niveauFlicMettrePrison] ) 
					{
					?>
						<br />Tu n'as pas le niveau pour mettre des joueur en prison, Tu dois avoir le grade de : <b><?php echo $config->NiveauFlic[$config->niveauFlicMettrePrison]; ?></b>
					<?php 
					}
					?>
				</span>
				<?php
			}
	
			$this->MafSeparateur ( );
        }
        ?>
      <?php
	  }
	  ?>
    </blockquote>
    <?php
    }
	
	function MafSeparateur ( ) 
	{
		?>
		<div class="accent"><div class="accent-left"></div><div class="accent-right"></div></div>
		<?php
	}
	
	function PlusLa()
	{
	?>
    	<span class="alert">Le joueur n'est pas ou n'est plus sur cette position, il a aussi pu se planquer</span>
    <?php
	}
	
	function MafError()
	{
	?>
    	<span class="alert">Il y a eu une erreur système</span>
    <?php
	}
	
	function MafErrorEquipement()
	{
	?>
    	<span class="alert">Tu n'est pas équipé pour faire cette action ou tu n'est pas actif depuis assez longtemps</span>
    <?php
	}
	
	function MafDenonce( $nom, $prix )
	{
	?>
	<span class="info">Tu viens d\'envoyer <?php echo $nom; ?> au pénitencier car il ne pouvait pas payer l'amende de <?php echo $prix; ?> $.<br />
	Tu es retourné au commissariat déposer le dossier de mise en incarcération</span>
    <?php
	}
	
	function MafDenonceFlic( $nom, $prix )
	{
	?>
	<span class="info">Tu viens de coller une amende de <?php echo $prix; ?> $ à <?php echo $nom; ?>. Tu es retourné au commissariat déposer le constat</span>
    <?php
	}
}
?>
