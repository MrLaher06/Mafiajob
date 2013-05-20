<?php
/**
* @version $Id: drogue.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafDrogueHTML 
{
	
	// fonction qui genere les appel du javascript et du css pour la carte
	function entete()
	{
		global $mosConfig_live_site, $config;
	?>

<?php
	}
	
	function tableau ($var = false, $persoArgent = false) 
	{
		global $config;
		
		$prix = $config->prixDrogue;
		$nom = $config->nomDrogue;
		$image = $config->imageDrogue;
		$investissement = 0;
		$totalestimation = 0;		
	?>
    <h1>Gestion de vos drogues <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=drogue');" title="Pour réactualiser que la partie ci-dessous"><img src="<?php echo $config->url;?>/images/refresh.png" alt="Actualiser" /></a></h1>
<form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
<blockquote>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td height="20" align="center"><b>Drogue</b></td>
      <td height="20" align="center"><b>Quantit&eacute;</b></td>
      <td height="20" align="center"><b>Prix de revente</b></td>
      <td height="20" align="right"><b>Prix &agrave; l'achat</b></td>
      <td height="20" align="right"><b>Possession</b></td>
      <td height="20" align="center" class="titredrogue"><b>Investissement</b></td>
      <td height="20" align="center" class="titredrogue"><b>B&eacute;n&eacute;fice</b></td>
    </tr>
    <?php
	$nbrDrogue = count($config->prixDrogue) + 1;
	
	$champJavascript = '';
	
	for ($i = 1; $i < $nbrDrogue ; $i++)
	{
		$j = $i - 1;
		$d = 'drogueDescription'.$i;
		$p = 'prix'.$i;
		$q = 'quantite'.$i;
		
		$champJavascript .= '+\'&\'+champ(\'quantite'.$i.'\')+\'&\'+champ(\'prix'.$i.'\')';
		
		$imageBulle = '<img src=\''.$config->url.'/images/drogues/'.$image[$j].'\' alt=\'Img\' align=\'left\' class=\'imagebulle\' />';
	?>
    <tr >
      <td align="left"><img src="<?php echo $config->url;?>/images/drogues/<?php echo $image[$j];?>" alt="Img" width="30" height="30" align="middle" class="imgPerso" /> <span class="titredrogue"><?php echo $nom[$j];?></span> </td>
      <td align="center" valign="middle"><input name="quantite<?php echo $i; ?>" autocomplete="off" onblur="if(this.value=='') this.value='0';" onfocus="if(this.value=='0') this.value='';" value="0" type="text" class="inputbox" id="quantite<?php echo $i; ?>" size="3" maxlength="3" <?php if( $persoArgent < $prix[$j] ) { ?> disabled="disabled" <?php } ?>/>
      </td>
      <td align="center" valign="middle"><input name="prix<?php echo $i; ?>" autocomplete="off" onblur="if(this.value=='') this.value='<?php echo $var->$p;?>';" onfocus="if(this.value=='<?php echo $var->$p;?>') this.value='';" value="<?php echo $var->$p;?>" type="text" class="inputbox" id="prix<?php echo $i; ?>" size="5" maxlength="5" />
        $ </td>
      <td align="center" valign="middle"><b><?php echo number_format($prix[$j]);?> $</b></td>
      <td align="right" valign="middle"><?php echo $var->$q;?> unit&eacute;(s)</td>
      <td align="center" valign="middle" class="titredrogue"><?php echo number_format( round( $var->$q * $prix[$j] ) );?> $</td>
      <td align="center" valign="middle" class="titredrogue"><?php echo number_format( round( $var->$q* ( $var->$p - $prix[$j] ) ) );?> $</td>
    </tr>
    <?php
		$investissement += round( $var->$q * $prix[$j] );
			
		$totalestimation += round( $var->$q * $var->$p );
	}
		
	$gaintotal = $totalestimation-$investissement;	
	?>
    <tr>
      <td colspan="5" align="center">Avec la vente total de vos stocks et au prix que vous la vendez cela,<br />
        vous donnerai un capital de <b><?php echo number_format( $persoArgent + $totalestimation );?> $</b></td>
      <td align="center"><span class="titredrogue"><?php echo number_format( $investissement );?> $</span></td>
      <td align="center"><span class="titredrogue"><?php echo number_format( $gaintotal );?> $</span></td>
    </tr>
    <tr>
      <td colspan="7" align="right" valign="middle"><input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'validedrogue=true'<?php echo $champJavascript; ?>);" name="validedrogue" id="validedrogue" class="buttonMaf" value="Enregistrer" /></td>
    </tr>
  </table>
  </blockquote>
  <span class="note">Attention personne n'achete &agrave; plus de <blink><b ><?php echo $config->tauxVenteDrogue; ?> %</b></blink> du prix d'achat, 
        ce qui veut dire qu'il faut penser &agrave; modifier les prix de revente <i>(le changement du prix de revente est modifiable m&ecirc;me sans achat)</i></span>
</form>
<?php	
	}

	// fonction qui genere le message d'erreur
	function ErreurAchat()
	{
	?>
    <span class="alert" id="problemeDrogue">
Il y a eu un problème lors de votre achat de drogue.<br />
Pensez à bien vérifier que vous avez la totalité de la somme pour faire l'achat</span>
<?php MafDrogueHTML::disparition ('problemeDrogue', 3); 

	}

	// fonction qui genere le message d'erreur
	function AchatReussi()
	{
	?>
    <span class="info">Tu viens d'acheter de la drogue que tu pourras revendre par la suite</span>

<?php
	}
	
	function ChangementPrix ( ) 
	{
		?>
		<span class="note">Ton personnage vient de changer ses prix pour la vente de drogue</span>
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

}
?>
