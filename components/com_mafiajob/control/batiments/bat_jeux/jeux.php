<?php
/**
* @version $Id: jeux.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

	$choixjeu = strtolower( strval( mosGetParam( $_REQUEST, 'choixjeu', 'Jeux%20Shooter' ) ) );

	$var = $config->url .'/control/batiments/bat_jeux/jeux/' . $choixjeu . '.swf';
		
			?>

<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="center" valign="top"><br />
      <?php
			if ($img = opendir($config->chemin .'/control/batiments/bat_jeux/jeux')) 
			{
				echo '<select name="choixjeu" onchange="conteneur(\''.$config->lienAjaxTask.'&choixjeu=\'+this.value+\'&no_html=1\');" class="inputbox" style="width:300px;">';
				echo '<option  value="">Sélectionner</option>';
				
				while (false !== ($fichier = readdir($img))) 
				{
				
					if ($fichier != '.' && $fichier != '..' && $fichier != 'index.html' && $fichier != 'images') 
					{
						$fich = explode('.',$fichier);
						echo '<option value="'.$fich[0].'">'.$fich[0].'</option>';
					}
				
				}
				echo '</select>';
				closedir($img);
			}
			?>
    </td>
  </tr>
  <tr>
    <td align="center"><div id="flash">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="500" height="380" align="middle" title="jeux">
          <param name="movie" value="<?php echo $var; ?>" />
          <param name="BGCOLOR" value="#FFFFFF" />
          <embed src="<?php echo $var; ?>" width="500" height="380" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#FFFFFF"></embed>
        </object>
      </div></td>
  </tr>
</table>
