<?php
/**
* @version $Id: update.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafUpdateHTML {
	
	function MafUpdateHTML ($titre = false) 
	{
		global $config, $my;		
	?>
<span class="download"><?php echo $titre; ?></span> <img align="left" title="Update" src="<?php echo $config->url;?>/images/update.png" alt="Update" width="70" hspace="5"/>
<p align="justify"> Vous avez la posibilit&eacute; de pouvoir personnaliser votre avatar. Cela n'est pas gratuit, il vous en coutera 1 Mafia pass (<b>Il n'y a que sur l'hospital de Mafiajob qu'on peut en acheter</b>). <b>Attention</b>, notre &eacute;quipe se r&eacute;serve le droit de vous refuser votre avatar si celui-ci ne correspond pas &agrave; la charte du jeu, c'est a dire que votre avatar doit &ecirc;tre une photo et non un dessin, un portrait et non un paysage, il devra repr&eacute;senter principalement le visage de votre personnage et pas autre chose. Il ne doit par faire plus de <b>50 Ko</b> et <b>200 px</b> de large.</p>
<form action="<?php echo $config->lienTask; ?>" name="upload" method="post" enctype="multipart/form-data">
  <input type="file" name="file" class="inputbox" /> <input type="submit" name="fileupdate" value="envoyer mon avatar" class="buttonMaf" />
    <br />
    <i>(Vous avez <?php echo $my->allopass; ?> Mafiapass)</i>
</form>
<?php
	}
}
?>
