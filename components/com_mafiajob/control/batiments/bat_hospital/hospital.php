<?php
/**
* @version $Id: hospital.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

if(!$perso->xp)
	echo '<span class="alert">Tu n\'a pas de point d\'exp�rience donc aucun �change est possible.</span>';

$nbrchoix = $fonction->Get('nombre');

if($fonction->Get('echange') && $perso->xp >= $nbrchoix)
{
	$perso->xp -= $nbrchoix;
	$perso->vie += round( $nbrchoix * $config->pointVieRecupEchangeHospital );
	$perso->MafUpdate();
	
	$texte = 'Ton personnage a �chang� '.$nbrchoix.' point(s) d\'exp�rience contre '.$nbrchoix.' point(s) de sant� � l\'hospital';
	
	$historique->MafAjout( $perso, 76 , $texte);
}


if($fonction->Get('mafiapasshosto') && $my->allopass)
{
	$my->allopass--;
	$perso->vie += $config->pointVieRecupAchatHospital;
	$perso->MafUpdate();
	$perso->MafAllopassMAJ();
	
	$historique->MafAjout( $perso, 77 );
}

?>
<span class="note">Un point de sant� vaut un point d'exp�rience.</span>
Vous avez la possibilit� de reprendre des forces. Pour cela il vous suffit de faire un �changer avec vos points d'exp�rience contre des points de sant�.
    
  <?php
  if($perso->vie < 100)
  {
  ?>
  
<blockquote>
  <form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
  <table border="0" cellpadding="5" cellspacing="5">
  <?php
  if($perso->xp)
  {
  ?>
    <tr>
      <td>Echanger X * <?php echo $config->pointVieRecupEchangeHospital; ?> points d'exp&eacute;rience contre
        <select name="nombre" id="nombre" class="buttonMaf">
          <?php for($i=1; $i <= 100; $i++)
	echo '<option value="'.$i.'" >'.$i.'</option>';
?>
        </select>
point(s) de sant&eacute; </td>
      <td><input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', champ3('nombre')+'&echange=true');" name="echange" class="buttonMaf" id="echange" value="Utiliser" /></td>
    </tr>
    <?php
	}
	?>
    <tr>
      <td>Utiliser 1 Mafia-pass contre <?php echo $config->pointVieRecupAchatHospital; ?> points de sant&eacute;<br />Tu as actuellement <?php echo $my->allopass; ?> Mafia-pass sur toi.</td>
      <td>
          <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'mafiapasshosto=true');" name="mafiapasshosto" class="buttonMaf" id="mafiapasshosto" value="1 Mafia-pass" />
        </td>
    </tr>
  </table>
  </form>
</blockquote>
    <?php
	}
	else
		echo '<span class="info">La sant� de ton personnage est au maximum.</span>';
	?>