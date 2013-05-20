<?php
/**
* @version $Id: parking.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafparkingHTML {

	function depose ($voiture = false)
	{	
		global $config;	
					
		$prixmax = round($voiture->prix_achat+(($voiture->prix_achat*(1/100))*3));
		$prixmin = round($voiture->prix_achat-(($voiture->prix_achat*(1/100))*3));
		
	?>

<div class="componentheading">Déposer votre voiture</div>
<form id="form1" name="form1" method="post" action="" onsubmit="verifprixparking(<?php echo $prixmax; ?>,<?php echo $prixmin; ?>,<?php echo $config->lienAjaxTask; ?>); return false;">
  <label> <i class="rouge"> Si tu souhaites mettre ta voiture en vente sur le march&eacute; noir, mets un prix de vente et le service de gardienage s'occupe du reste.<br />
  </i><br />
  <input name="prixvente" type="text" class="inputbox" id="prixvente" value="" size="11" maxlength="11" />
  </label>	
  <input type="button" onclick="verifprixparking(<?php echo $prixmax; ?>,<?php echo $prixmin; ?>,'<?php echo $config->lienAjaxTask; ?>');" name="depot" id="depot" class="buttonMaf" value="Deposer votre voiture" />
  </label>
</form>
<span class="alert">Attention de ne pas mettre de virgule dans le montant.<br />Exemple : <b>25750</b> est un montant correct par contre <b>25,750</b> est incorrect et placera le montant &agrave; 25 $</span>

<span class="note">Laissez la case vide si vous ne désirez pas mettre votre véhicule en vente, par contre le prix de vente ne doit pas être plus de <b><?php echo number_format($prixmax); ?> $</b> et moins de <b><?php echo number_format($prixmin); ?> $</b></span>
<?php
	}

	function formulaire (&$id, $recuperer = true , $prix = false)
	{	
		global $config;			
	?>
<form id="form1" name="form1" method="post" action="" onsubmit="conteneur('<?php echo $config->lienAjaxTask; ?>','idvoiture=<?php echo $id; ?>&recuperer=true');">
  <input type="hidden" name="idvoiture" id="idvoiture" value="<?php echo $id; ?>"/>
  <?php
		if($recuperer)
		{
		?>
  <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','idvoiture=<?php echo $id; ?>&recuperer=true');" name="recuperer" id="recuperer" class="buttonMaf" value="Recuperer votre voiture" />
  <?php
		}
		else
		{
		?>
  <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'idvoiture=<?php echo $id; ?>&acheter=true');" name="acheter" id="acheter" class="buttonMaf" value="Acheter cette voiture pour <?php echo number_format($prix); ?> $" />
  <?php
		}
		?>
</form>
<?php
	}

	function deposeValide ($prix = 0)
	{				
	?>
<span class="info">Tu viens de mettre ta caisse au parking.
		<?php
		if($prix > 0) echo ' Tu l\'as mis &agrave; prix pour : '.number_format($prix).' $';
		?>
</span>
<?php
	}

	function recupererValide ( )
	{				
	?>
<span class="info">Tu viens de recupérer ton véhicule au parking.</span>
<?php
	}

	function erreur ( )
	{				
	?>
<span class="alert">Il y a eu une erreur lors de l'execution du programme. Veuillez nous contacter pour nous informer.</span>
<?php
	}

	function erreurArgent ( $prix = false )
	{				
	?>
<span class="alert">Tu n'as pas assez d'argent pour acheter ce véhicule. Il te faut au moins <?php echo number_format($prix); ?> $</span>
<?php
	}
	
	function enteteListe()
	{
	?>
<h1>Liste des véhicules disponibles</h1>
<?php
	}
	
	function enteteDeposer()
	{
	?>
<h1>Tu viens de déposer ce véhicule</h1>
<?php
	}
	
	function enteteRecuperer()
	{
	?>
<h1>Tu viens de récuperer ce véhicule</h1>
<?php
	}
	
}
?>
