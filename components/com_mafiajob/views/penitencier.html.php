<?php
/**
* @version $Id: penitencier.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafPenitencierHTML {

	function entete ($temps = false, $delai = false)
	{
		global $config, $fonction;
		?>
<table border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td align="left" valign="top"><img class="imgBlock" alt="choix perso" src="<?php echo $config->url;?>/images/prison.jpg" /></td>
    <td align="left" valign="top"><div class="titregaintotal">Tu es en taule depuis : <?php echo $fonction->ConvertirTemps( $temps, true  ); ?></div>
      <ul>
        <li>Tu en as prit pour <b><?php echo $fonction->ConvertirTemps( $delai, true ); ?></b></li>
        <li>Vous avez perdu la moit&eacute; de vos stocks en drogues</li>
        <li>Vous avez peut-&ecirc;tre perdu la moit&eacute; de votre argent, si vous avez &eacute;t&eacute; d&eacute;nonc&eacute;.</li>
        <li>Vous ne pouvez pas communiquer avec votre équipe</li>
      </ul>
  </tr>
</table>
<?php
	}

}
?>
