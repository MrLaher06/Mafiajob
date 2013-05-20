<?php
/**
* @version $Id: papier.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$papier = $fonction->Get( 'papier' );
	
$prix = $perso->argent - round( $perso->argent * (7/10) ); 

if($prix < 10000) $prix = 10000;

if($papier)
{
	if( $perso->casier == 0)
		echo '<span class="alert">Tu n\'es pas recherch&eacute; par les forces de police!</span>';
		
	elseif( $perso->argent < $prix)
		echo '<span class="alert">Tu manques d\'argent, c\'est '.number_format($prix).' $ mec !</span>';
		
	elseif( $config->ArgentPourRechercheFauxPapiers < $perso->argent - $prix)
		echo '<span class="alert">M&ecirc;me avec des faux papiers tu seras recherch&eacute; car tu as trop d\'argent sur toi!</span>';
		
	else
	{
		$perso->argent -= $prix;
		$perso->casier = 0;
		$perso->MafUpdate();
		
		echo '<span class="info">Tu viens d\'avoir tes faux papiers, tu n\'es plus recherch&eacute;.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 16 );
	}
}
			
?>
<h2>Gestion des faux papiers</h2>
<img src="<?php echo $config->url;?>/images/empreinte.jpg" alt="empreinte" height="60" align="left" style="margin:5px;"class="imgBlock" />
<p align="justify">Tu as la possibilit&eacute; de faire des faux papiers dans cette &eacute;tablissement, ce qui te permettra de ne plus &ecirc;tre recherch&eacute; par la police. Mais pour un prix qui varie selon la personne qui fait la demande de faux papiers.<br />
  <br />
  Pour toi c'est : <strong><?php echo number_format($prix); ?> $</strong>. <br />
</p>
<?php
if($perso->casier)
{
?>
<span class="info">Tu n'es pas recherch&eacute; par les forces de police!</span>
<form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
  <input type="button" onclick="if (confirm('Tu es sur ?')) { conteneur('<?php echo $config->lienAjaxTask; ?>', 'papier=true') };" name="papier" value="Faire de faux papier pour <?php echo number_format($prix); ?> $" class="buttonMaf" />
</form>
<?php
}
else
	echo '<span class="info">Tu n\'es pas recherch&eacute; par les forces de police!</span>';
?>
