<?php
/**
* @version $Id: personnage.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafPersonnageHTML {

	function creation ()
	{
		global $config, $my;
	?>
<h1>Cr&eacute;er son personnage</h1>
<span class="info"><b><i>(R&eacute;capitulation) : </i>Avant de cr&eacute;er votre personnage, veuillez lire avec attention les points suivants : </b></span> <img align="right" hspace="5" src="<?php echo $config->url;?>/images/humeur.png" />
<p>
<ul>
  <li>Ce jeu comporte des sc&egrave;nes de violence et de pornographie sugg&eacute;r&eacute;es (c'est &agrave; dire non explicites) qui peuvent heurter le jeune internaute.</li>
  <li>Le joueur certifie sur l'honneur en s'inscrivant qu'il est majeur.</li>
  <li>L'auteur et administrateur du jeu ne pourra en aucun cas &ecirc;tre tenu pour responsable de l'utilisation du jeu par un mineur.</li>
  <li>L'auteur et administrateur du jeu ne pourra en aucun cas &ecirc;tre accus&eacute; de faire l'apologie de la drogue, de la violence, de la prostitution ou de la delinquance.</li>
</ul>
</p>
<form id="form2" name="form2" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="if($('majeur').checked==true) { conteneur('<?php echo $config->lienAjaxTask; ?>', champ('majeur')+'&validepersonnage=true'); } return false;">
  <table border="0" align="center" cellpadding="10" cellspacing="10">
 
    <tr align="left" valign="middle">
      <td colspan="3" align="center" valign="top">
      <script type="text/javascript" src="http://ima.minigao.com/script.js"></script>
      <script type="text/javascript">
<!--
minigao_siteid=87;
minigao_memberid="<?php echo $my->id; ?>";
minigao_password="<?php echo md5($my->id); ?>";
minigao_widget();
//-->
      </script></td>
    </tr>
    <tr align="left" valign="middle">
      <td align="center" valign="top">&nbsp;</td>
      <td colspan="2"><label>
        <input type="checkbox" name="majeur" id="majeur" />
        J'ai plus de 18 ans</label></td>
    </tr>
    <tr align="left" valign="middle">
      <td colspan="2" align="center"><input class="buttonMaf" name="validepersonnage" type="button" onclick="if($('majeur').checked==true) { conteneur('<?php echo $config->lienAjaxTask; ?>', champ('majeur')+'&validepersonnage=true'); }" value="Valider mon personage" /></td>
    </tr>
  </table>
</form>
<span class="alert">Ce jeu est interdit au moins de 18 ans</span>
<?php
	
	}
	
	function planque ( $delai = false)
	{
		global $config, $fonction;
	?>
<h1>Tu es en planque <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=planque');" title="Pour réactualiser que la partie ci-dessous"><img src="<?php echo $config->url;?>/images/refresh.png" alt="Actualiser" /></a></h1>
<table border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td align="center" valign="middle"><img src="<?php echo $config->url;?>/images/planque.jpg" alt="En planque" class="imgBlock" /></td>
    <td align="left" valign="top"><p><b>Tu te trouve en mode &quot;planque&quot; depuis <blink><?php echo $fonction->ConvertirTemps( $delai ); ?> </blink> ce qui veut dire :</b></p>
      <ul>
        <li>Les autres joueurs ne peuvent pas te voir.</li>
        <li>Tu ne peux pas voir la carte.</li>
        <li>Tu ne peux pas faire d'action sauf, sortir de ta planque.</li>
        <li>Il est impossible de communiquer avec ton &eacute;quipe.</li>
        <li>Tu peux voir les scores et lire la Gazette.</li>
        <li>Si tu es recherché, planque toi pendant <?php echo $config->tempsRechercher; ?> h sans sortir pour ne plus l'être et l'alerte <b>"tu es recherché"</b> disparait</li>
      </ul></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="middle"><table border="0">
        <tr>
          <td><form id="form1" name="form1" method="post" action="<?php echo $config->lien; ?>&task=action">
              <input type="button" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=action', 'SortirPlanque=true');" name="SortirPlanque" id="button" class="buttonMaf" value="Sortir de la planque" />
            </form></td>
          <td><form action="index.php?option=logout" method="post" name="logout" id="logout">
              <input name="Submit" class="buttonMaf" value="Se d&eacute;connecter en s&eacute;curit&eacute; de Mafia City" type="submit" />
              <input name="option" value="logout" type="hidden" />
              <input name="op2" value="logout" type="hidden" />
              <input name="lang" value="french" type="hidden" />
              <input name="return" value="index.php" type="hidden" />
              <input name="message" value="0" type="hidden" />
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>
<span class="note">Pensez &agrave; vous planquer avant de quitter le jeu. <i>Sinon vous risquez de vous faire tuer pendant votre absence.</i></span>
<?php
	
	}

	
	function detail ($perso = false, $my = false) 
	{
		global $config, $fonction, $equipe;
		
			$portrait = 'defaut.jpg';

		if( !empty( $perso->image ) )
			$portrait = $perso->image;
		
	?>
<h1>Les informations de votre personnage</h1>
<?php 
		if($perso->casier && $perso->MafFlic() )
			echo '<span class="alert">ATTENTION tu es devenu un flic véreux, Ils autres joueurs peuvent te dénoncer s\'ils tombent sur toi.</span>';
		elseif($perso->casier )
			echo '<span class="alert">ATTENTION vous êtes recherché par les flics! pensez à faire des faux papiers</span>';
		?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="center" valign="top"><img class="imgBlock" title="Portrait" src="http://ima.minigao.com/l120/p87/<?php echo $perso->iduser; ?>.jpg?<?php echo time(); ?>" alt="Portrait" width="100" style="background-color:<?php echo $equipe->CouleurEquipe($perso->equipe); ?>;" /> <br />
      <a href="<?php echo $config->lien; ?>&task=avatar">Modifier votre avatar</a><br />
      <img class="imgBlock" title="Equipe" src="<?php echo $config->url;?>/images/mafia/<?php echo $equipe->ImageEquipe($perso->equipe); ?>" alt="Portrait" width="100" style="background-color:<?php echo $equipe->CouleurEquipe($perso->equipe); ?>;" /> </td>
    <td width="60%" align="left" valign="top"><ul class="Maful">
        <li><b>Votre identifiant</b> : <?php echo $perso->iduser; ?></li>
        <li><b>Votre nom</b> : <?php echo utf8_decode($my->name); ?></li>
        <li><b>Votre pseudo</b> : <?php echo utf8_decode($my->username); ?></li>
        <li><b>Votre mail</b> : <?php echo $my->email; ?></li>
        <li><b>Date d'inscription</b> : <?php echo utf8_decode($fonction->MafDate($my->registerDate)); ?></li>
        <li><b>Date de votre dernière visite</b> : <?php echo utf8_decode($fonction->MafDate($my->lastvisitDate)); ?></li>
        <li><b>Position</b> : <?php echo $fonction->ConvertLng ($perso->lng); ?> - <?php echo $perso->lat; ?></li>
        <li><b>Votre points de vie</b> : <?php echo $perso->vie; ?> pts</li>
        <li><b>Votre &eacute;quipe</b> : <?php echo $equipe->NomEquipe($perso->equipe); ?> </li>
        <li><b>Vos points d'expérience</b> : <?php echo number_format($perso->xp); ?>/<?php echo number_format($perso->ProchainNiveau( )); ?> pts</li>
        <li><b>Votre Niveau</b> : <?php echo $perso->Niveau( ); ?></li>
        <li><b>Le temps écoulé depuis la dernière planque</b> : <?php echo $fonction->ConvertirTemps( $perso->tempsplanque ); ?></li>
        <li><b>Nombre de vente stupefiant</b> : <?php echo number_format($perso->stupefiant); ?></li>
        <li><b>Nombre d'attaque</b> : <?php echo number_format($perso->nbrattaque); ?></li>
        <li><b>Nombre vole d'argent</b> : <?php echo number_format($perso->voleargent); ?></li>
        <li><b>Nombre vole d'arme</b> : <?php echo number_format($perso->volearme); ?></li>
        <li><b>Nombre vole de voiture</b> : <?php echo number_format($perso->volevoiture); ?></li>
      </ul>
  </tr>
</table>
<?php
	}

	function humeur ( $humeur = false )
	{
		global $config, $mosConfig_live_site;
		?>
        <div id="lienModifierHumeur" align="right"><a href="javascript:;" onclick="Effect.toggle('ModifierHumeur','appear');">Modifier l'humeur de votre personnage</a></div>
</span>
<div id="ModifierHumeur" style="display:none;">
		<h1>Humeur de votre personnage</h1> 
		<span class="info">ne pas abuser de cette option, au cas contraire vous risquez d'&ecirc;tre exclut du jeu.<br /><a href="<?php echo $mosConfig_live_site;?>/index.php?option=com_fireboard&amp;Itemid=9&amp;func=rules"> r&egrave;gles du forum</a></span>
		<p align="justify"> <img align="right" title="Humeur" src="<?php echo $config->url;?>/images/humeur.png" alt="Humeur" width="70" hspace="5"/> 	Tu as la possibilit&eacute; de mettre <strong>l'humeur de ton personnage</strong>, elle sera visible sur la carte lors du passage de la sourie. Tous les joueurs voient ton message.</p>
		
		<form id="form3" name="form3" method="post" action="<?php echo $config->lienTask; ?>">
		  <textarea name="commentaire" id="commentaire" cols="50" rows="2" class="inputbox"><?php echo $humeur; ?></textarea>
		  <p>
			<input class="buttonMaf" type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ('commentaire'));" name="validecommentaire" id="validecommentaire" value="Modifier son commentaire" />
		  </p>
		</form>
        </div>
    <?php
    }
	
	function detailAutre ($perso = false ) 
	{
		global $config, $equipe, $fonction;
		
		$portrait = 'defaut.jpg';

		if( !empty( $perso->image ) )
			$portrait = $perso->image;
		
		?>
<h1>Les informations de ce personnage</h1>
<blockquote>
<table border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="10%" align="center" valign="top"><img class="imgBlock" title="Portrait" src="http://ima.minigao.com/l120/p87/<?php echo $perso->iduser; ?>.jpg" alt="Portrait" width="100" style="background-color:<?php echo $equipe->CouleurEquipe($perso->equipe); ?>;" /></td>
    <td width="10%" align="center" valign="top"><img class="imgBlock" title="Portrait" src="<?php echo $config->url;?>/images/mafia/<?php echo $equipe->ImageEquipe($perso->equipe); ?>" alt="Equipe" height="120" style="background-color:<?php echo $equipe->CouleurEquipe($perso->equipe); ?>;" /></td>
    <td width="60%" align="left" valign="top"><ul class="number">
        <li><b>Son pseudo</b> : <?php echo $perso->username; ?></li>
        <li><b>Son &eacute;quipe</b> : <?php echo $equipe->NomEquipe($perso->equipe); ?> </li>
        <li><b>Ses points d'expérience</b> : <?php echo number_format($perso->xp); ?>/<?php echo number_format($perso->ProchainNiveau( )); ?> pts</li>
        <li><b>Son Niveau</b> : <?php echo $perso->Niveau( ); ?></li>
        <li><b>Position</b> : <?php echo $fonction->ConvertLng ($perso->lng); ?> - <?php echo $perso->lat; ?></li>
        <li><b>Ses points d'expérience</b> : <?php echo number_format($perso->xp); ?>/<?php echo number_format($perso->ProchainNiveau( )); ?> pts</li>
        <li><b>Nombre de vente stupefiant</b> : <?php echo number_format($perso->stupefiant); ?></li>
        <li><b>Nombre d'attaque</b> : <?php echo number_format($perso->nbrattaque); ?></li>
        <li><b>Nombre vole d'argent</b> : <?php echo number_format($perso->voleargent); ?></li>
        <li><b>Nombre vole d'arme</b> : <?php echo number_format($perso->volearme); ?></li>
        <li><b>Nombre vole de voiture</b> : <?php echo number_format($perso->volevoiture); ?></li>
        <li><b>Etat du joueur</b> : <?php echo $fonction->etatJoueurJeu($perso->actif); ?></li>
        <li><b>IP du joueur</b> : <?php echo $perso->ip; ?></li>
      </ul>
  </tr>
</table>
</blockquote>
<?php
	}
	
	function CreationReussie ( ) 
	{
		?>
<span class="info">Tu viens de cr&eacute;er ton personnage.</span>
<?php
	}
	
	function CreationIP ( ) 
	{
		?>
<span class="note">Il y a d&eacute;jà un personnage avec cette IP.</span>
<?php
	}
	
	function MAJCommentaire ( ) 
	{
		?>
<span class="info">Tu viens de mettre &aacute; jour le commentaire de ton profil</span>
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
}
?>
