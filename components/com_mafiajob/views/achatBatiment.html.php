<?php
/**
* @version $Id: MafAchatBatiment.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafAchatBatimentHTML {
	
	function EnteteAchat ( ) 
	{
	global $config;
	?>
    <h1>Acheter cet �tablissement</h1>
    <?php
	} 
	
	function EnteteGestion ( ) 
	{
	global $config;
	?>
    <h1>Gestion de votre �tablissement</h1>
    <?php
	} 
	
	function Lien ( ) 
	{
	global $config;
	?>
    <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=action');">Revenir a la page action</a><br />
    <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=batiment');">Entrer dans cet �tablissement</a>
    <?php
	}
	
	function ErreurArgent ( ) 
	{
	?>
    <span class="alert">Il y a eu un probl�me lors de la revente de l'�tablissement.</span>
    <?php
	} 
	
	function Argent ( ) 
	{
	?>
    <span class="alert">Tu n'as pas assez d'argent pour acheter cet �tablissement.</span>
    <?php
	} 
	
	function Revente ( $prix = false ) 
	{
	?>
    <span class="info">Tu viens de revendre cet �tablissement pour <?php echo number_format( $prix ); ?> $.</span>
    <?php
	} 
	
	function Feliciation ( $prix = false ) 
	{
	?>
    <span class="info">Tu viens d'acheter cet �tablissement pour <?php echo number_format( $prix ); ?> $.</span>
    <?php
	} 
	
	function PresentationGestion ( &$var, $option = false, $optionType = false ) 
	{
	global $config, $fonction;
	?>
    <blockquote>
    <table border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td rowspan="2" valign="top"><img onclick="VoirInventaire(3,'3_<?php echo $var->id;?>');" style="cursor:pointer;" src="<?php echo $config->url;?>/images/batiments/<?php echo $var->image;?>" alt="<?php echo $var->nom;?>" height="100" class="imgBlock"></td>
        <td valign="top">La valeur actuelle de votre �tablissement est de <?php echo number_format($var->prix_achat);?> $.<br />
        Si vous d�sirez vendre cet �tablissement, sa vente vous rapportera <?php echo number_format($var->prix_achat / 2);?> $.<br />
        Vous poss�dez cet �tablissement depuis <?php echo $fonction->ConvertirTemps($var->timer);?>.
        
    <?php 
    if($option && $optionType)
    {
    ?>
    <span class="note">Cet �tablissement te permet d'avoir des avantages.<br />Lors de la vente de ton �tablissement, ton personnage gagnera <?php echo number_format($option);?> pt(s) de <?php echo $config->nomOptionBatiment[$optionType];?> multipli� par le nombre(s) de jour complet(s) que tu es propri�taire de cet �tablissement</span>
    
    <?php
    }
    else
    {
    ?>
    <span class="note">Cet �tablissement ne te permet pas d'avoir des avantages.</span>
    <?php
    }
    ?>
    <?php 
    if( ( (time() - $var->timer) / 60 / 60 ) < 24 && $optionType)
    {
    ?>
    <span class="alert">ATTENTION : si tu vends ton �tablissement maintenant, tu ne gagnera aucun point de <?php echo $config->nomOptionBatiment[$optionType];?> car tu es propri�taire depuis moins de 24 h</span>
    
    <?php
    }
	?></td>
      </tr>
    </table>
    </blockquote>
    <?php
	}
	function PresentationAchat ( &$var, $proprio = false, $option = false ) 
	{
	global $config;
	?>
    <blockquote>
    <table border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td rowspan="2" valign="top"><img onclick="VoirInventaire(3,'3_<?php echo $var->id;?>');" style="cursor:pointer;" src="<?php echo $config->url;?>/images/batiments/<?php echo $var->image;?>" alt="<?php echo $var->nom;?>" height="100" class="imgBlock"></td>
        <td valign="top">Vous souhaitez devenir le futur propri&eacute;taire de cet &eacute;tablissement, pour cela il vous suffit de d&eacute;bourser <?php echo number_format($var->prix_achat);?> $.<br />
    <?php 
    if($proprio && $proprio->MafUserName())
    {
        echo 'Le propri�taire actuel de cet �tablissement est : <b>'.$proprio->MafUserName().'</b>';
    }
    ?>
    <?php 
    if($option)
    {
    ?>
    <span class="info">Cet �tablissement te permet d'avoir des avantages.</span>
    
    <?php
    }
    else
    {
    ?>
    <span class="info">Cet �tablissement ne te permet pas d'avoir des avantages.</span>
    <?php
    }
    ?></td>
      </tr>
    </table>
    </blockquote>
    <?php
	}
	
	function FormulaireAchat ( ) 
	{
	global $config;
	?>
    <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="conteneur('<?php echo $config->lienAjaxTask; ?>', champ('prixAchat')+'&acheter=true'); return false;">
	<table border="0" cellpadding="5" cellspacing="5">
	  <tr>
		<td valign="top">
          <label>Acheter pour un prix plus �lev�
          <input type="text" name="prixAchat" id="prixAchat" size="11" class="inputbox" /> </label>
			</td>
	    <td valign="top"><input class="buttonMaf" type="button" name="acheter" id="acheter" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ('prixAchat')+'&acheter=true');" value="Acheter cet �tablissement" /></td>
      </tr>
	</table></form>	
    <span class="note">Laisser le champs vide si vous souhaitez acheter cet �tablissement avec le prix indiqu� ci-dessus.</span>
	<?php
	}
	
	function FormulaireRevente ( ) 
	{
	global $config;
	?>
	<table border="0" cellpadding="5" cellspacing="5">
	  <tr>
		<td valign="top"><form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="conteneur('<?php echo $config->lienAjaxTask; ?>', 'vendre=true'); return false;">
		  <input class="buttonMaf" type="button" name="vendre" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'vendre=true');" id="vendre" value="Vendre cet �tablissement" />
		</form>
		</td>
	  </tr>
	</table>
	<?php
	}
}
?>
