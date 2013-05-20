<?
//function qui permet au joueur de prendre le tunnel
require_once( $config->chemin . '/class/joueur.class.php' );

$joueurs = new MafJoueurs( $database );
$listeJoueurs = $joueurs->SelectionTousJoueurs();

$transfer = $fonction->Get('transfer');
$retrait = $fonction->Get('retrait');
$transfersomme = $fonction->Get('transfersomme');
$retraitsomme = $fonction->Get('retraitsomme');

if($transfer)
{ 
	if(!$transfersomme || !is_numeric($transfersomme))
		echo '<span class="alert">Indiquez un montant valide.</span>';
	elseif ($transfersomme < 1500 )
		echo '<span class="alert">Vous devez créditer au moins de 1,500 $ et non '.number_format($transfersomme).' $.</span>';
	elseif ($perso->argent < $transfersomme )
		echo '<span class="alert">Vous n\'avez pas assez d\'argent sur vous.</span>';
	else
	{
		$iduserbanque = $fonction->Get('iduserbanque');	
		$commissionbank = $transfersomme * 5 / 100;
		$perso->argent -= $transfersomme;

		if($iduserbanque != $perso->iduser)
		{
			$profiteur = new MafPersonnage( $database );
			$profiteur->MafSelection ( $iduserbanque );
			$profiteur->banque += $transfersomme - $commissionbank;
			$profiteur->MafUpdate();
		}
		else
			$perso->banque += $transfersomme - $commissionbank;
		
		$perso->MafUpdate();
		
		echo '<span class="info">Le virement de '.number_format ($transfersomme).' $ &aacute; bien &eacute;t&eacute; effectu&eacute;. La banque a prit '. number_format ($commissionbank) .' $ de commission.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Virement bancaire de '.number_format ($transfersomme).' $ effectué';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 14, $texteHistorique );
	}
}
elseif($retrait)
{ 
	if( !$retraitsomme || !is_numeric($retraitsomme) )
	   echo '<span class="alert">Indiquez un montant valide.</span>';
	elseif ($retraitsomme < 1500 )
		echo '<span class="alert">Vous devez retirer au moins de 1,500 $ et non '.number_format($retraitsomme).' $.</span>';
	elseif ($perso->banque < $retraitsomme)
		echo '<span class="alert">Vous n\'avez pas assez d\'argent en banque.</span>';
	else
	{
		$commissionbank = $retraitsomme * 2 / 100;
		$perso->banque -= $retraitsomme;
		$perso->argent += $retraitsomme-$commissionbank;
		$perso->MafUpdate();

		echo '<span class="info">Le retrait de '.number_format ($retraitsomme).' $ &aacute; bien &eacute;t&eacute; effectu&eacute;. La banque a prit '. number_format ($commissionbank) .' $ de commission.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Retrait bancaire de '.number_format ($retraitsomme).' $ effectué';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 15, $texteHistorique );
	}
}

$selectionjoueur = '<option value="'.$perso->iduser.'">Sur votre compte</option>';
foreach($joueurs->TousJoueurs as $list)
{
	if($list->iduser != $perso->iduser && $list->equipe == $perso->equipe)
		$selectionjoueur .= '<option value="'.$list->iduser.'">'.$list->username.'</option>';
}
			
?>
<h2>Accédez à vos comptes banquaire</h2>
<form action="<?php echo $config->lienAjaxTask; ?>" method="post" name="form3" id="form3">
<table border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="left" valign="top"><img src="./components/com_mafiajob/images/distributeur.jpg" class="imgBlock" alt="distributeur" /> <p>
        <font color="#990000"><b>Sur vous </b></font>: <?php echo number_format ($perso->argent); ?> $</p>
        <p>
        <font color="#990000"><b>Votre compte</b></font>: <?php echo number_format ($perso->banque); ?> $</p></td>
    <td align="left" valign="middle">
        <label>
        <select name="iduserbanque" id="iduserbanque" class="inputbox" style="width:250px; margin-bottom:5px;">
          <?php echo $selectionjoueur; ?>
        </select>
        <br />
        <b> Si vous désirez faire un dépot sur le compte d'un autre joueur, veuillez selectionner son pseudo <i>(Uniquement les joueur de ta mafia)</i></b></label>
       
    
        <p>commission de<font color="#990000"><strong> 5 %</strong></font> pour 
          les virements.<br />
          Commision de <strong><font color="#990000">2 %</font></strong> pour 
          les retraits <br />
      Le mininum pour une transaction est de <b>1,500 $</b></p>
      <p>
        <input name="transfersomme" type="text" id="transfersomme" autocomplete="off" onblur="if(this.value=='') this.value='1500';" onfocus="if(this.value=='1500') this.value='';"  value="1500" class="inputbox" maxlength="11" />
        <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ('transfersomme')+'&'+champ3('iduserbanque')+'&transfer=true');" name="transfer" id="bouton" class="buttonMaf"  value="Deposer"  />
        </p>
      <p>
        <input name="retraitsomme" type="text"  id="retraitsomme" autocomplete="off" onblur="if(this.value=='') this.value='1500';" onfocus="if(this.value=='1500') this.value='';"  value="1500" class="inputbox" maxlength="11" />
        <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ('retraitsomme')+'&retrait=true');" name="retrait" id="bouton2" class="buttonMaf" value="Retrait"  />
        <br />
      </p></td>
  </tr>
</table>
</form>