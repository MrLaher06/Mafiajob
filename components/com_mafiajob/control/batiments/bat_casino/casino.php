<?php
/**
* @version $Id: casino.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$gain = $fonction->Get('argentcasino');

if($gain)
{
	$perso->argent = $gain;
	$perso->MafUpdate();
}

?>
<style type="text/css">
<!--
.tableMachinesous {
	margin-left:55px;
	margin-top:20px;
	width:120px;
	height:35px;
}
.buttonmachinesous {
	border:0;
	background-color:inherit;
	margin-right:17px;
	cursor:pointer;
}
.divmisemachinesous {
	color:#ffffff;
	text-align:center;
	margin-left:40px;
	width:150px;
}
-->
</style>
<h2>La machine &aacute; sous</h2>
<form name="slots">
  <table width="251" height="367" border=0 align="center" cellpadding="0" cellspacing="0" background="<?php echo $config->url; ?>/images/carte/machinesous.jpg" style="margin-left:auto; margin-right:auto;">
    <tr>
      <td height="100" align=left valign="bottom"><div class="divmisemachinesous"><a href="javascript:;" style="color:#FFFFFF;" onClick="javascript:alert('Trois d\'une même sorte --> 10 x vos gains.\n\nUne Paire --> 2 x vos gains.\n');">Mise</a> <br />
          <input class="inputbox" autocomplete="off" onblur="if(this.value=='') this.value='100';" type="box" size="10" name="bet" value="100">
        </div></td>
    </tr>
    <tr>
      <td height="27" align="right" valign="top"><input type="button" onclick="rollem(<?php echo $perso->argent; ?>); return false;" value="&nbsp;" class="buttonmachinesous"></td>
    </tr>
    <tr>
      <td height="118" valign="top" ><table border=0 cellpadding=2 cellspacing=5 class="tableMachinesous">
          <tr>
            <td width="25" align="center" valign="middle"><img src="<?php echo $config->url; ?>/images/carte/1.gif" name="slot1" /></td>
            <td width="48" align="center" valign="middle"><img src="<?php echo $config->url; ?>/images/carte/2.gif" name="slot2" /></td>
            <td align="center" valign="middle"><img src="<?php echo $config->url; ?>/images/carte/3.gif" name="slot3"  /></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign="top" ><textarea name="banner" cols="22" rows="2" readonly="readonly" style="border:0; margin-left:30px; background-color:inherit; text-align:center; color:#FFFFFF; font-size:11px;"></textarea></td>
    </tr>
  </table>
</form>