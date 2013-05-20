<?php
/**
* @version 2.3 $
* @package SmileTAG
* @copyright (C) 2006 Yuniar Setiawan
* @license http://www.gnu.org/copyleft/gpl.HTML GNU/GPL
*/
 
	/** ensure this file is being included by a parent file */

	if (defined( '_VALID_MOS' )){
		require_once("configuration.php");
	}
	else{
		die( 'Direct Access to this location is not allowed.' );
	}
	 
	$smiletagURL = $mosConfig_live_site.'/modules/smiletag/';

?>

<!-- Edit HTML Below to customize the look of your smiletag form and iframe -->

<style type="text/css">
<!--
.smiletagFrame{
	border-right: #cccccc 1px solid;
	border-top: #cccccc 1px solid;
	border-left: #cccccc 1px solid;
	border-bottom: #cccccc 1px solid;
}
-->
</style>
<script type="text/javascript" language="JavaScript">
<!--
	var smiletagURL = "<?php echo $smiletagURL; ?>";
//-->
</script>
<script type="text/javascript" language="JavaScript" src="<?php echo $smiletagURL; ?>smiletag-script.js"></script>
<table border="0" cellpadding="0" cellspacing="0">
     <tr>
          <td valign="top" >
      	  <iframe name="iframetag" marginwidth="0" marginheight="0" src="<?php echo $smiletagURL; ?>view.php" width="160" height="300" frameborder="0" class="smiletagFrame">
			Your Browser must support IFRAME to view
			this page correctly
		  </iframe>
		  </td>
     </tr>
     <tr>
          <td>
  			<form name="smiletagform" method="post" action="<?php echo $smiletagURL; ?>post.php" target="iframetag"><br />
              Name<br /><input type="text" name="name"/><br />
              URL or Email<br /><input type="text" name="mail_or_url" value="http://" /><br />
              Message<br /><textarea name="message_box" rows="2" cols="15"></textarea><br />
              <input type="hidden" name="message" value="" />
              <input type="submit" name="submit" value="Tag!" onclick="clearMessage()" /> 
			  <input type="reset"  name="reset" value="Reset" /><br />
            </form>
	       </td>
        </tr>
</table>