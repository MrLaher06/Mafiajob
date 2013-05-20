<?php
/**
* @version $Id: voiture.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafVoitureHTML {

	function detail ($voiture, $titre = true , $MeilleurPuissance = 0, $MeilleurRapidite = 0, $garer = false, $reservoir = false) 
	{
		global $config, $fonction;

			echo '<a name="voiture" id="voiture"></a>';

		if($titre)
			echo '<h1>Information sur le v�hicule</h1>';
	?>
<div class="contentheading"><?php echo $voiture->nom; ?></div>
<blockquote>
  <table width="100%" border="0" cellpadding="0" cellspacing="10">
    <tr>
      <td width="20%" align="center" valign="top"><img onclick="VoirInventaire(2,'2_<?php echo $voiture->id;?>');" style="cursor:pointer;" title="V�hicule : <?php echo $voiture->nom;?>" class="imgBlock" src="<?php echo $config->url;?>/images/voitures/<?php echo $voiture->image;?>" alt="<?php echo $voiture->nom;?>" width="100" />
      <!-- <br /> Exemplaire : <?php echo number_format($voiture->nombre); ?>-->
      </td>
      <td width="80%" align="left" valign="top"><ul class="ulinfoperso">
      <?php
	  if($garer)
		{	
		?>
        <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>', 'garer=true');" title="garer sa voiture">Garer votre v�hicule sur cette position</a></li>
        <?php
		}
		?>
          <li><b>Exp�rience pour ce v�hicule</b> : <?php echo number_format($voiture->xp); ?> pts</li>
          <li><b>Temps de d�placement du v�hicule</b> : <?php echo $voiture->temps; ?> secondes</li>
          <li><b>Capacit� du r�servoir</b> : <?php echo number_format($voiture->reservoir); ?> L</li>
      <?php
	  if($reservoir !== false)
		{	
		?>
        <li style="color:#CC0000;">Attention le r�servoir n'a pas forc�ment le plein (actuellement : <?php echo $reservoir; ?> L)</li>
        <?php
		}
		?>
          <li><b>Consommation</b> : <?php echo number_format($voiture->consommation); ?> L/100km</li>
          <li><b>Tenue de route</b> : <?php echo number_format($voiture->tenue_route); ?> pt(s)</li>
          <li><b>Prix du v�hicule</b> : <?php echo number_format($voiture->prix_achat); ?> $</li>
          <li><b>Commentaire</b> : <?php echo $voiture->commentaire; ?></li>
        </ul>
        <table border="0" align="center">
          <tr>
            <td width="160"><b>Puissance </b>: <?php echo $voiture->puissance; ?> pts <?php echo $fonction->MafBG( $voiture->puissance ) ?></td>
            <td width="160"><b>Rapidit&eacute; </b>: <?php echo $voiture->rapidite; ?> pts <?php echo $fonction->MafBG( $voiture->rapidite ) ?></td>
            <td width="160"><b>Protection </b>: <?php echo $voiture->defense; ?> pts <?php echo $fonction->MafBG( $voiture->defense ) ?></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</blockquote>
<?php
	}
		
	function boutonAcheter( &$id )
	{
		global $config;
	?>
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
        <input type="hidden" name="idvoiture" id="idvoiture_<?php echo $id; ?>" value="<?php echo $id; ?>"/>
        <input type="button" name="acheter" id="acheter" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ2('idvoiture_<?php echo $id; ?>','idvoiture')+'&acheter=true');" value="Acheter ce v�hicule" />
        </form>
    <?php
	}
		
	function boutonFlic( &$id )
	{
		global $config;
	?>
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>&choix=voitures">
        <input type="hidden" name="idvoiture" id="idvoiture_<?php echo $id; ?>" value="<?php echo $id; ?>"/>
        <input type="button" name="acheter" id="acheter" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ2('idvoiture_<?php echo $id; ?>','idvoiture')+'&acheter=true&choix=voitures');" value="Utiliser ce v�hicule" />
        </form>
    <?php
	}
		
	function boutonVendre( &$prix )
	{
		global $config;
	?>	
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
        <input type="button" name="vendre" id="vendre" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'vendre=true');" value="Vendre votre v�hicule au magasin pour <?php echo number_format($prix); ?> $" />
        </form>
	<?php
	}
		
	function boutonVoler( &$id )
	{
		global $config;
	?>	
        <form id="form1" name="form1" method="post" action="<?php echo $config->lien; ?>">
        <input type="button" name="vendre" id="vendre" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjax; ?>', 'voler=true&idvoitureVole=<?php echo $id; ?>');" value="Voler ce v�hicule" />
        </form>
	<?php
	}
		
	function boutonRecuperer( &$id )
	{
		global $config;
	?>	
        <form id="form1" name="form1" method="post" action="<?php echo $config->lien; ?>">
        <input type="button" name="vendre" id="vendre" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjax; ?>', 'recuperer=true&idvoitureRecuperer=<?php echo $id; ?>');" value="R�cup�rer votre v�hicule" />
        </form>
	<?php
	}
		
	function titreListeAchat()
	{
	?>	
        <h2>Liste des v�hicules disponible � l'achat</h2>
    <?php
	}
		
	function boutonAcheterReservoir( $prix )
	{
		global $config;
	?>
    <span class="note">Vous d�tenez un v�hicule qui n'a pas le plein d'essence</span>
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
        <input type="button" name="acheterreservoir" id="acheterreservoir" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'acheterreservoir=true');" value="Faire le plein de votre v�hicule pour <?php echo number_format( $prix ); ?> $" />
        </form>
    <?php
	}
		
	function Recharge()
	{
	?>	
        <span class="info">Tu viens de faire le plein de ton v�hicule.</span>
    <?php
	}
		
	function Garer()
	{
	?>	
        <span class="info">Tu viens de garer ton v�hicule.</span>
    <?php
	}
		
	function Recuperer()
	{
	?>	
        <span class="info">Tu viens de r�cup�rer ton v�hicule.</span>
    <?php
	}
		
	function RecupererErreur()
	{
	?>	
        <span class="alert">Tu n'as pas pu r�cup�rer ton v�hicule suite � une erreur.</span>
    <?php
	}
		
	function Voler()
	{
	?>	
        <span class="info">Tu viens de voler un v�hicule.</span>
    <?php
	}
		
	function VolerErreur()
	{
	?>	
        <span class="alert">Tu n'as pas pu voler ton v�hicule suite � une erreur.</span>
    <?php
	}
		
	function VolerLouper( $somme = false )
	{
	?>	
        <span class="alert">Tu n'as pas r�ussi � voler ce v�hicule de <?php echo $somme; ?> pts.</span>
    <?php
	}
		
	function titreListeVoitureGarer()
	{
	?>	
        <h2>Liste des v�hicules gar�s sur cette position</h2>
    <?php
	}
		
	function titreListeVoitureGarerJoueur()
	{
	?>	
        <h1>Liste des v�hicules gar�s que vous poss�dez</h1>
        <table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td>
    <?php
	}
		
	function vignetteVehicule($voiture, $reservoir = false, $lat = false, $lng = false)
	{
		global $config;
	?>	
        <div class="miniavatarEquipe"><img onclick="VoirInventaire(2,'2_<?php echo $voiture->id;?>');" style="cursor:pointer;" title="V�hicule : <?php echo $voiture->nom;?>" class="imgBlock" src="<?php echo $config->url;?>/images/voitures/<?php echo $voiture->image;?>" alt="<?php echo $voiture->nom;?>" width="70" /><br /><center><?php echo substr($voiture->nom,0,14);?><br />R�servoir <?php echo $reservoir;?> L<br /><?php echo $lng;?> - <?php echo $lat;?></center></div>
    <?php
	}
	
	function titreListeVoitureGarerJoueurPied()
	{
	?>	
       </td>
  </tr>
</table>
    <?php
	}

}
?>
