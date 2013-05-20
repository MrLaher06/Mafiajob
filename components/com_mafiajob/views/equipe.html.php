<?php
/**
* @version $Id: equipe.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafEquipeHTML {
	
	function MafEntete ( ) 
	{
		global $config;
		?>

<h1>Récapitulation des actions de votre équipe <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'ajax=1');" title="Pour réactualiser que la partie ci-dessous"><img src="<?php echo $config->url;?>/images/refresh.png" alt="Actualiser" /></a></h1>
<?php
	}
	
	function MafTitreDetail ( $root = false, $participe = false, $iddefense = false, $iduser = false ) 
	{
		global $config;
		?>
<h1> Detail de l'action qui est en préparation 
  &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'ajax=1');"> <img title="Revenir à la page équipe" src="<?php echo $config->url;?>/images/revenir.png" alt="revenir" /></a>
  <?php 
		if($root) {
			?>
  &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=equipe&detail=<?php echo $root; ?>');" title="Pour réactualiser que la partie ci-dessous"> <img title="Actualiser cette page"  src="<?php echo $config->url;?>/images/refresh.png" alt="Actualiser"/></a> &nbsp; <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $root; ?>&lancer=true', 'ajax=1');"> <img title="Lancer l'action" src="<?php echo $config->url;?>/images/lancer.png" alt="lancer" /></a> &nbsp; <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $root; ?>&annuler=true', 'ajax=1');"> <img title="Annuler l'action" src="<?php echo $config->url;?>/images/annuler.png" alt="annuler" /></a>
  <?php 
		}
		elseif($participe)
		{
			?>
  &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $participe; ?>', 'ajax=1');"> <img title="Actualiser cette page"  src="<?php echo $config->url;?>/images/refresh.png" alt="Actualiser"/></a>
  <?php
            if($iduser == $iddefense) 
			{ 
				?>
  &nbsp; <img title="Tu es la cible de l'attaque" src="<?php echo $config->url;?>/images/cible.png" alt="cible" />
  <?php 
			}
			else
			{
			?>
  &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $participe; ?>&participer=true', 'ajax=1');"> <img title="Participer à l'action" src="<?php echo $config->url;?>/images/participer.png" alt="participer" /></a> &nbsp; <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $participe; ?>&annuler=true', 'ajax=1');"> <img title="Annuler votre participation" src="<?php echo $config->url;?>/images/annuler.png" alt="annuler" /></a>
  <?php 
			}
			?>
  <?php
		}
		?>
</h1>
<?php
	}
	
	function MafParticipantDetail ( $nbrParticipant = false ) 
	{
		?>
<span class="info">Il y a <?php echo $nbrParticipant; ?> participant(s) pour le moment sur cette action.</span>
<h2>Liste des participants de cette action</h2>
<?php
	}
	
	function MafCibleDetail ( ) 
	{
		?>
<h2>Informations sur la cible qui va être attaqué</h2>
<?php
	}
	
	function MafActionEquipe( &$perso, &$list ) 
	{
		global $fonction, $config;
		?>
<div class="contentheading"> <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $list->idattaque; ?>', 'ajax=1');"> <?php echo $list->nomdefense; ?> est la cible de <?php echo $list->nomattaque; ?> (<?php echo MafPlusieurs::MafType($list->type); ?>) </a> </div>
<blockquote>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><b><?php echo $list->nomattaque; ?></b> est en train de préparer une action contre un <b><?php echo MafPlusieurs::MafType($list->type); ?></b> <br />
        L'action se trouve en : <?php echo $fonction->convertLng ( $list->lng ).' - '.$list->lat; ?> </td>
      <td align="right" valign="top"><?php 
                    if($list->idattaque == $perso->iduser && $list->iduser == $perso->iduser) 
                    { 
						?>
        <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $perso->iduser; ?>&lancer=true', 'ajax=1');"> <img title="Lancer l'action" src="<?php echo $config->url;?>/images/lancer.png" alt="lancer" /> </a> &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $perso->iduser; ?>&annuler=true', 'ajax=1');"> <img title="Annuler l'action" src="<?php echo $config->url;?>/images/annuler.png" alt="annuler" /> </a>
        <?php 
                    }
                    elseif($list->idattaque != $perso->iduser && $list->iddefense != $perso->iduser) 
                    { 
					   ?>
        &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&&detail=<?php echo $list->idattaque; ?>&participer=true', 'ajax=1');"> <img title="Participer à l'action" src="<?php echo $config->url;?>/images/participer.png" alt="participer" /></a> &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $list->idattaque; ?>&annuler=true', 'ajax=1');"> <img title="Annuler l'action" src="<?php echo $config->url;?>/images/annuler.png" alt="annuler" /></a>
        <?php 
                    }
                    elseif($list->iddefense == $perso->iduser) 
                    { 
						?>
        &nbsp; <img title="Tu es la cible de l'attaque" src="<?php echo $config->url;?>/images/cible.png" alt="cible" />
        <?php 
                    }
                    elseif($list->iduser == $perso->iduser) 
                    { 
						?>
        &nbsp; <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'ajax=1');"> <img title="Tu es sur le point de retirer ta participation" src="<?php echo $config->url;?>/images/annulparticipation.png" alt="participation actif" /></a>
        <?php 
                    }
                    ?>
        <br />
        <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $list->idattaque; ?>', 'ajax=1');">Voir le détail </a></td>
    </tr>
  </table>
</blockquote>
<?php
	}
	
	function MafActionParticipant( &$id, &$nom, &$role, &$lat, &$lng, &$temps , $root = false  ) 
	{
		global $fonction, $config;
		?>
<blockquote>
  <table width="100%" border="0">
    <tr>
      <td width="35%"><?php echo $nom; ?></td>
      <td width="20%"><?php echo MafPlusieurs::MafRole($role); ?></td>
      <td width="10%"><?php echo $fonction->convertLng ( $lng ).' - '.$lat; ?></td>
      <td width="25%">Participe depuis <?php echo $temps; ?></td>
      <td width="10%"><a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=information&iduser=<?php echo $id; ?>', 'ajax=1');">Detail</a>
        <?php 
            if($root && $id != $root) {
            ?>
        &nbsp; <a  href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&detail=<?php echo $root; ?>&retirer=<?php echo $id; ?>', 'ajax=1');"><img title="Retirer" src="<?php echo $config->url;?>/images/annuler.png" alt="annuler" /></a>
        <?php 
            }
            ?>
      </td>
    </tr>
  </table>
</blockquote>
<?php
	}
	
	function AnnulerLanceur ( ) 
	{
	?>
<span class="info">Tu viens d'annuler l'action que tu préparais.</span>
<?php
	}
	
	function AnnulerParticipant ( ) 
	{
	?>
<span class="info">Tu viens d'annuler ta participation à l'action prévue.<br />
Bien entendu si tu ne participais pas à aucune action cela n'a servi à rien...</span>
<?php
	}
	
	function AnnulerVide ( ) 
	{
	?>
<span class="info">Tu veux annuler une action auquel tu n'est même pas impliqué. Pense à participer avant de penser à annuler.</span>
<?php
	}
	
	function Participation ( ) 
	{
	?>
<span class="info">Tu participe desormais à l'action que tu viens de selectionner.</span>
<?php
	}
	
	function ParticipationLouper ( ) 
	{
	?>
<span class="alert">Tu n'as pas pu participer à l'action que tu viens de selectionner.<br />
Peut-être que tu es déjà entrain de participer à cette action ou à une autre action.</span>
<?php
	}
	
	function AnnulerLanceurParticipation ( ) 
	{
	?>
<span class="alert">Tu viens de retirer un joueur de votre action qui est en cours de préparation.</span>
<?php
	}
	
	function NombreAction ( ) 
	{
		global $config;
		?>
<span class="note">Il y a <?php echo $config->action; ?> action(s) en cours en ce moment que votre équipe prépare.</span>
<?php
	}
	
	function AucuneAction ( ) 
	{
		?>
  <span class="note" id="NoActionCours">Pour le moment, aucune action n'est en cours dans votre équipe.</span>
  <?php MafEquipeHTML::disparition ('NoActionCours', 3); ?>
<?php
	
	}
	
	function MafSeparateur ( ) 
	{
		?>
<div class="accent">
  <div class="accent-left"></div>
  <div class="accent-right"></div>
</div>
<?php
	}
	
	function VictoireAction ( $score = false ) 
	{
		?>
<span class="info">Action a &eacute;t&eacute; victorieuse, votre action l'a remporté de <?php echo number_format($score); ?> pts par rapport à la défense.</span>
<?php
	}
	
	function DefaiteAction ( $score = false ) 
	{
		?>
<span class="alert">Action a &eacute;t&eacute; deffectieuse, la défense l'a remporté de <?php echo number_format($score); ?> pts par rapport à votre action.</span>
<?php
	}
	
	function PlanqueAction ( ) 
	{
		?>
<span class="alert">Le joueur n'est plus actif (en planque)</span>
<?php
	}
	
	function AutrePositionAction ( ) 
	{
		?>
<span class="alert">Le joueur que tu attaques n'est pas ou n'est plus à cette position</span>
<?php
	}
	
	function EcartAction ( ) 
	{
		?>
<span class="alert">Il y a un trop grand écart d'expérience avec cet habitant pour que tu gagnes des points.</span>
<?php
	}
	
	function EcartActionFacile ( ) 
	{
		?>
<span class="alert">Ton attaque n'a rien rapporté car tu n'avais vraiment aucun mal pour le tuer.</span>
<?php
	}
	
	function MafForumAucun ( ) 
	{
		?>
<span id="forumVide" class="note">Pour le moment le forum de votre équipe est vide</span>
<?php MafEquipeHTML::disparition ('forumVide', 3); ?>
<?php
	}
	
	function disparition ($div, $time = 5)
	{
	?>
  <script language="javascript" type="text/javascript">
  <!--
  delaiDisparait('<?php echo $div; ?>',<?php echo $time; ?>);
  -->
  </script>
  <?php
	}
	
	function MafForumConteneur ( &$texte, &$nav ) 
	{		
		echo $texte.$nav; 
	}
	
	
	function MafForumFormulaire ( ) 
	{
		global $config;
		?>
<h1>Discuter avec votre équipe en sécurité</h1>
<form id="formforum" name="formforum" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="conteneur('<?php echo $config->lienAjaxTask; ?>', 'valideforum=true&'+champ('texteforum')); return false;">
  <table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td><label>Message :
        <input name="texteforum" type="text" id="texteforum" class="inputbox" size="70" />
        </label> <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'valideforum=true&'+champ('texteforum'));" name="valideforum" id="button" class="buttonMaf" value="Envoyer" /></td>
    </tr>
  </table>
</form>
<script language="javascript" type="text/javascript">
  <!--
  $('texteforum').focus();
  -->
  </script>
<?php
	}
	
	function creation ()
	{
		global $config;
		?>
<span class="info"> Tu as la possibilité de créer ta propre équipe.
<div id="lienCreationEquipe"><a href="javascript:;" onclick="Effect.toggle('creationEquipe','appear');">Afficher les informations pour créer son équipe</a></div>
</span>
<div id="creationEquipe" style="display:none;">
  <h1>Création de votre équipe</h1>
  <p align="justify">Vous avez la possibilit&eacute; de cr&eacute;er votre propre équipe, Cela vous co&ucirc;tera <b>100,000 $</b> et il faut avoir au minimun <b>500 pts d'expérience</b>. Vous deviendrez le chef par d&eacute;faut, par contre si vous mourez, le membre de votre mafia qui sera le plus riche r&eacute;cup&eacute;rera votre place en tant que chef de Mafia. Vous pourrez agrandir le nombre de vos menbres en leur envoyant une invitation directement via votre page de gestion de Mafia. <i>(Invitation envoy&eacute; par mail avant une dur&eacute;e de vie de 24h)</i></p>
  <blockquote>
    <form id="formforum" name="opener_form" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="if(verif_champ_mafia() == true) { conteneur('<?php echo $config->lienAjaxTask; ?>', champ('nommafia')+'&'+champ3('imagemafia')+'&'+champ('couleur')+'&'+champ('commentaire')+'&creermafia=true'); } return false;" >
      <table width="100%" border="0" cellpadding="0" cellspacing="5">
        <tr>
          <td align="left" valign="top"><label>Nom de votre équipe :
            <input type="text" size="30" name="nommafia" id="nommafia" class="inputbox" />
            </label>
          </td>
          <td rowspan="6" align="center"><div id="affimagemafia"><img src="<?php echo $config->url;?>/images/mafia/random.jpg" alt="Image de votre equipe" class="imgBlock" /></div></td>
        </tr>
        <tr>
          <td align="left" valign="top">Image de votre équipe :
            <?php		
		if ($img = opendir($config->chemin.'/images/mafia')) 
		{
			echo '<select onchange="affimage(\''.$config->url.'/images/mafia/\'+this.value, \'affimagemafia\'); return false;" id="imagemafia" name="imagemafia" class="inputbox" style="width:140px;">';
			echo '<option value="">Sélectionner</option>';
			
			while (false !== ($fichier = readdir($img)))
			{
				if ($fichier != '.' && $fichier != '..' && $fichier != 'index.html' && $fichier != '.DS_Store' && $fichier != 'flic.jpg') 
				{
					$fich = explode('.',$fichier);
					echo '<option value="'.$fichier.'">'.$fich[0].'</option>';
				}
			}
			echo '</select>';
			closedir($img);
		}
	?></td>
        </tr>
        <tr>
          <td align="left" valign="top">Couleur de l'&eacute;quipe :
            <input type="text" name="couleur" id="couleur" size="7" maxlength="7" value="" style="width:70px;" class="inputbox" />
            <input type="button" value="Changer..." onclick="popup_color_picker();" class="buttonMaf"/>
            <input type="button" name="exemple" style="width:60px; height:25px; background-color:#FFFFFF; border:1px solid #CCCCCC;" /></td>
        </tr>
        <tr>
          <td align="left" valign="top">Commentaire :<br />
            <textarea name="commentaire" cols="44" rows="4" id="commentaire" class="inputbox"></textarea></td>
        </tr>
        <tr>
          <td align="left" valign="top"><input type="button" onclick="if(verif_champ_mafia() == true) { conteneur('<?php echo $config->lienAjaxTask; ?>', champ('nommafia')+'&'+champ3('imagemafia')+'&'+champ('couleur')+'&'+champ('commentaire')+'&creermafia=true'); }" name="creermafia" class="buttonMaf" value="Cr&eacute;er votre équipe" /></td>
        </tr>
      </table>
    </form>
  </blockquote>
</div>
<?php
	}
	
	function gestion ($listjoueur = false, $listjoueurEquipe = false, $perso = false)
	{
		global $equipe, $config;
		?>
<span class="info"> Tu es le chef d'équipe des <?php echo $equipe->NomEquipe($perso->equipe); ?>.
<div id="lienGestionEquipe"><a href="javascript:;" onclick="Effect.toggle('gestionEquipe','appear');">Informations pour gerer son équipe</a></div>
</span>
<div id="gestionEquipe" style="display:none;">
  <h1>Gestion de votre équipe</h1>
  <blockquote> <img align="left" title="mafia" src="<?php echo $config->url;?>/images/mission.jpg" alt="Mafia" width="100" class="imgBlock2" hspace="5"/>
    <p align="justify" >Vous avez la possibilit&eacute; d'inviter des joueurs &agrave; rejoindre votre équipe. Par contre une fois dans votre équipe, la seule fa&ccedil;on que le joueur a de la quitter, est qu'il doit &ecirc;tre invit&eacute; par une autre équipe hors celles de d&eacute;part ou être viré par vous même.</p>
    <form id="form2" name="form2" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="if(verif_champ_invite() == true) { conteneur('<?php echo $config->lienAjaxTask; ?>', champ3('idinvite')+'&invite=true'); } return false;">
      <table border="0" cellspacing="0" cellpadding="5" class="TableauActionCombat">
        <tr>
          <td><label>Choix du joueur
            <select name="idinvite" id="idinvite" class="inputbox">
              <?php echo $listjoueur; ?>
            </select>
            </label></td>
          <td><input type="button" onclick="if(verif_champ_invite() == true) { conteneur('<?php echo $config->lienAjaxTask; ?>', champ3('idinvite')+'&invite=true'); }" name="invite" id="invite" class="buttonMaf" value="Inviter ce joueur" />
            </label>
          </td>
        </tr>
        <tr>
          <td colspan="2"><h3>Membre de ton équipe :</h3></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo $listjoueurEquipe; ?> </td>
        </tr>
      </table>
    </form>
  </blockquote>
</div>
<?php
	}
	
	function MafImpossibleCreation () 
	{
		global $config;
		?>
<span class="alert">Tu ne peux pas créer ton équipe pour le moment.<br />
Il te faut : <?php echo number_format($config->ArgentCreationEquipe); ?> $ et <?php echo number_format($config->XpCreationEquipe); ?> pts d'expériences </span>
<?php
	}
	
	function MafCreationValide () 
	{
		?>
<span class="info">Tu as réussi à créer ta propre équipe, seras tu la gérer correctement? Seul le temps nous le dira.</span>
<?php
	}
	
	function MafCreationNonValide () 
	{
		?>
<span class="info">Tu ne respectes pas les conditions pour créer ton équipe pour le moment.</span>
<?php
	}
	
	function MafInvitationValide () 
	{
		?>
<span class="info">Votre invitation vient d'être envoyé.</span>
<?php
	}
	
	function MafInvitationErreur () 
	{
		?>
<span class="alert">Une erreur est survenue, votre invitation n'a pas été envoyé.</span>
<?php
	}
	
	function MafInvitationValideJoueur () 
	{
		?>
<span class="info">Votre changement d'équipe a bien eu lieu.</span>
<?php
	}
	
	function MafInvitationErreurJoueur () 
	{
		?>
<span class="alert">Erreur lors de la mise à jour de votre compte.</span>
<?php
	}
	
	function MafInvitationMAJJoueur () 
	{
		?>
<span class="alert">Votre invitation n'est pas ou n'est plus valide.</span>
<?php
	}
	
}
?>
