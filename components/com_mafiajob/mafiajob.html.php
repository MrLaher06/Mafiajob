<?php
/**
* @version $Id: personnage.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class HTML_mafiajob {

	function entete()
	{
		global $config, $mosConfig_live_site;
		?>
		<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_hideform_mini.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $config->url;?>/js/prototype.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $config->url;?>/js/scriptaculous.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $config->url;?>/js/dragdrop.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $config->url;?>/js/unittest.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $config->url;?>/js/fonction.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $config->url;?>/js/machineSous.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/modules/fatAjax.php"></script>
		<?php
		$choix = mosGetParam( $_COOKIE, 'choixSon');

		if(!$choix || $choix == 'sans')
		{
		?>
    <script language="javascript" type="text/javascript">
    <!--
		Sound.disable();
    -->
    </script>
    <?php
		}
		else
		{
		?>
    <script language="javascript" type="text/javascript">
    <!--
		Sound.enable();
    -->
    </script>
    <?php
		}
	}
}
?>