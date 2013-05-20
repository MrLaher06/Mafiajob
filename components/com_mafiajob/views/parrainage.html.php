<?php
/**
* @version $Id: parrainage.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafParrainageHTML {
	
	function MafParrainageHTML ($perso = false, $my = false) 
	{
		global $config;
	?>
<span class="note">Vous désirez parrainer un ami(e).</span>
<div class="componentheading">Parrainage</div>
<img align="left" title="Parrainage" src="<?php echo $config->url;?>/images/parrainage.png" alt="Parrainage" width="70" hspace="5"/>
<p align="justify"> Si vous désirez parrainer un ami(e), veuillez indiquer son e-mail et un message contenant votre identifiant lui sera communiqu&eacute; pour des raisons de compte fantome l'application de vos 5 points d'expériences se fera lorsque le parrainé atteindra 50 points d'expériences avec son personnage.</p>
<form id="form4" name="form4" method="post" action="<?php echo $config->lienTask; ?>" onsubmit="return Verif_mail_invite();">
  <input name="parrainer" id="parrainer" type="text" class="inputbox" value="" size="35" /> <input class="buttonMaf" type="submit" name="valideparrainage" id="valideparrainage" value="Envoyer une invitation" />
</form>
<?php
	}
}
?>
