<?php
/**
* @version $Id: arme.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafArmeHTML {
	
	function detail ( $arme , $titre = true ) 
	{
		global $config, $fonction;

			echo '<a name="arme" id="arme"></a>';

		if($titre)
			echo '<h1>Information sur l\'arme</h1>';
	?>
<div class="contentheading"> <?php echo $arme->nom; ?></div>
<blockquote>
  <table width="100%" border="0" cellpadding="0" cellspacing="10">
  <tr>
    <td width="20%" align="center" valign="top">
   
      <img title="Arme : <?php echo $arme->nom;?>" class="imgBlock" onclick="VoirInventaire(1,'1_<?php echo $arme->id;?>');" style="cursor:pointer;" src="<?php echo $config->url;?>/images/armes/<?php echo $arme->image;?>" alt="<?php echo $arme->nom;?>" width="100" /><br />
     
    </td>
    <td width="80%" align="left" valign="top" >
      <ul class="Maful">
        <li><b>Expérience pour cette arme</b> : <?php echo number_format($arme->xp); ?> pts</li>
        <li><b>Nombre de munitions dans le chargeur</b> : <?php echo $arme->munition; ?></li>
        <li><b>Prix du chargeur</b> : <?php echo number_format($arme->prix_munition); ?> $</li>
        <li><b>Prix de l'arme</b> : <?php echo number_format($arme->prix_achat); ?> $</li>
        <li><b>Commentaire</b> : <?php echo $arme->commentaire; ?> </li>
      </ul>
      <table border="0" align="center">
        <tr>
          <td width="160"><b>Attaque </b>: <?php echo $arme->attaque; ?> pts <?php echo $fonction->MafBG( $arme->attaque ) ?></td>
          <td width="160"><b>D&eacute;fense </b>: <?php echo $arme->defense; ?> pts <?php echo $fonction->MafBG( $arme->defense ) ?></td>
        </tr>
      </table></td>
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
        <input type="hidden" name="idarme" id="idarme_<?php echo $id; ?>" value="<?php echo $id; ?>"/>
        <input type="button" name="acheter" id="acheter" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ2('idarme_<?php echo $id; ?>','idarme')+'&acheter=true');" value="Acheter cette arme" />
        </form>
    <?php
	}
		
	function boutonFlic( &$id )
	{
		global $config;
	?>
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
        <input type="hidden" name="idarme" id="idarme_<?php echo $id; ?>" value="<?php echo $id; ?>"/>
        <input type="button" name="acheter" id="acheter" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ2('idarme_<?php echo $id; ?>','idarme')+'&acheter=true&choix=armes');" value="Utiliser cette arme" />
        </form>
    <?php
	}
		
	function boutonVendre()
	{
		global $config;
	?>	
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
        <input type="button" name="vendre" id="vendre" class="buttonMaf" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'vendre=true');" value="Vendre votre arme au magasin" />
        </form>
	<?php
	}
		
	function titreListeAchat()
	{
	?>	
        <h2>Liste des armes disponible à l'achat</h2>
    <?php
	}
		
	function error1()
	{
	?>	
        <span class="alert">Tu n'as pas assez d'argent ou de points d'expérience pour avoir cette arme.</span>
    <?php
	}
		
	function Recharge()
	{
	?>	
        <span class="info">Tu viens d'acheter des munitions pour ton arme.</span>
    <?php
	}
		
	function boutonAcheterMunition( $prix )
	{
		global $config;
	?>
    <span class="note">Vous détenez une arme qui n'a pas la totalité des munitions qu'elle peut supporter</span>
        <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
        <input type="button"onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'achetermunition=true');" name="achetermunition" id="achetermunition" class="buttonMaf" value="Acheter des munitions pour votre arme pour <?php echo number_format( $prix ); ?> $" />
        </form>
    <?php
	}
}
?>
