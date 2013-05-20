<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$subnav = false;
if ($mtype=="splitmenu") :
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu.php");
	$topnav = rtShowHorizMenu($menu_name);
	$subnav = rtShowSubMenu($menu_name);
elseif ($mtype=="moomenu" or $mtype=="suckerfish") :
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_moomenu.php");
	$subnav = false;
endif;

// make sure subnav is empty
if (strlen($subnav) < 10) $subnav = false;
//Are we in edit mode
$editmode = false;
if (  !empty( $_REQUEST['task'])  && $_REQUEST['task'] == 'edit'  ) :
	$editmode = true;
endif;

$topmod_count = (mosCountModules('user3')>0) + (mosCountModules('user4')>0);
$topmod_width = $topmod_count > 0 ? ' w' . floor(99 / $topmod_count) : '';
$bottommod_count = (mosCountModules('user5')>0) + (mosCountModules('user6')>0);
$bottommod_width = $bottommod_count > 0 ? ' w' . floor(99 / $bottommod_count) : '';
$footermod_count = (mosCountModules('user7')>0) + (mosCountModules('user8')>0) + (mosCountModules('user9')>0);
$footermod_width = $footermod_count > 0 ? ' w' . floor(99 / $footermod_count) : '';

$secondcol_width = (mosCountModules('user1')>0 or $subnav) ? $secondcol_width : "0";
$thirdcol_width = mosCountModules('user2') > 0 ? $thirdcol_width : "0";

$extra_space = mosCountModules('user1') == 0 ? ' class="extraspace"' : '';

if (!$tempus) {
	$tempus = "false";
} else {
	$tempus = "\"" . $tempus . "\"";
}

$raw_width = $template_width - 50 - (134 * 2);
$template_width = 'margin: 0 auto; width: ' . $template_width . 'px;';
$safari_fix = $module_slider_height + 40;

function isIe7() {
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($agent, 'msie 7')) return true;
	return false;
}

function isIe6() {
	$agent=$_SERVER['HTTP_USER_AGENT'];
	if (stristr($agent, 'msie 6')) return true;
	return false;
}

?>