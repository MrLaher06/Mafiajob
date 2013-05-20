<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleswitcher.php");
$default_style  = "style1";

	$enable_rokzoom				= "false";			 // true | false
	$template_width 			= "950";			 // width in px
	$secondcol_width 			= "25%";			 // width in px | width in %
	$thirdcol_width 			= "25%";			 // width in px | width in %
	$menu_name 					= "mainmenu";		 // mainmenu by default, can be any Joomla menu name
	$menu_type 					= "splitmenu";		 // moomenu | suckerfish | splitmenu | module
	$splitmenu_col				= "thirdcol";	     // secondcol | thirdcol
	$default_font 				= "default";         // smaller | default | larger
	$show_pathway 				= "false";			 // true | false
	
	$modules_list 				= array(array("title"=>"Actualités", "module"=>"user7"),
										array("title"=>"Victoires", "module"=>"user8"),
										array("title"=>"Forum", "module"=>"user9"),
										array("title"=>"Les flics", "module"=>"user10"),
										array("title"=>"Partenaires", "module"=>"user11"));
	$module_slider_height = 200;					// height in px
	$max_mods_per_row	  = 3;						// maximum number of modules per row (adjust the height if this wraps)
	require_once($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleloader.php");
	require_once($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_tabmodules.php");
	require_once($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_utils.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if ( $my->id ) 
	initEditor();
	
mosShowHead();
?>
<meta name="verify-v1" content="v+tdg9V5ngAI8LlLUvLTRbDaS6kKpWipV9Ezp/FtoWc=" />
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php if($mtype=="moomenu" or $mtype=="suckerfish") :?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/rokmoomenu.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $tstyle; ?>.css?nocache=1" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/rokslidestrip.css" rel="stylesheet" type="text/css" />
<?php if (isIe7()) :?>
<!--[if IE 7]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie7.css" rel="stylesheet" type="text/css" />	
<![endif]-->
<?php endif; ?>
<?php if (isIe6()) :?>
<!--[if lte IE 6]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie6.php" rel="stylesheet" type="text/css" />
<style type="text/css">
img { behavior: url(<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/iepngfix.htc); } 
</style>
<![endif]-->
<?php endif; ?>
<link href="<?php echo $mosConfig_live_site;?>/components/com_mafiajob/css/style.mafiajob.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/roktempus.js"></script>
<?php 
if($option != 'com_mafiajob')
{
?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/mootools-release-1.11.js"></script>
<script type="text/javascript">tempus=<?php echo $tempus; ?></script>
<?php if($mtype=="moomenu") :?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/rokmoomenu.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/mootools.bgiframe.js"></script>
<script type="text/javascript">
    window.addEvent('domready', function() {
      new Rokmoomenu($E('ul.menu'), {
        bgiframe: false,
        delay: 500,
        animate: {
          props: ['opacity', 'width', 'height'],
          opts: {
            duration:400,
            fps: 100,
            transition: Fx.Transitions.Quad.easeOut
          }
        }
      });
    });
    </script>
<?php endif; ?>
<?php if($mtype=="suckerfish" or $mtype=="splitmenu") :
      echo "<!--[if IE]>\n";		
      include_once( "$mosConfig_absolute_path/templates/" . $mainframe->getTemplate() . "/js/ie_suckerfish.js" );
      echo "<![endif]-->\n";
    endif; 

}
?>
</head>
<body <?php if($tempus!="false") echo 'id=' . $tempus .' '; ?>class="<?php echo $fontstyle; ?> <?php echo $tstyle; ?>">
<div id="bg-top">
  <div id="bg-top-overlay"></div>
</div>
<div id="overall-frame">
  <div id="bg-bottom-ie">
    <div id="bg-bottom-overlay-ie"></div>
  </div>
  <div id="bg-bottom">
    <div id="bg-bottom-overlay">
      <div class="wrapper">
        <div id="top-shadow">
          <div class="shadow-1"></div>
          <div class="shadow-2"></div>
          <div class="shadow-3"></div>
          <div id="header">
            <div id="logo-space"><a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/logo.png" border="0" alt="" id="logo" /></a><br />
              <span>Une ville hostile et sans pitié !</span></div>
          </div>
          <?php if (mosCountModules("top")) :?>
          <div id="mod-top">
            <?php mosLoadModules('top', -1); ?>
          </div>
          <?php endif; ?>
          <?php if (mosCountModules("search")) :?>
          <div id="mod-search">
            <?php mosLoadModules('search', -1); ?>
          </div>
          <?php endif; ?>
        </div>
        <div id="iefix">
          <div id="horiz-menu" class="<?php echo $mtype; ?>">
            <?php if($mtype == "splitmenu") : ?>
            <?php echo $topnav; ?>
            <?php elseif($mtype == "moomenu" or $mtype == "suckerfish") : ?>
            <?php mosShowListMenu($menu_name);	?>
            <?php else: ?>
            <?php mosLoadModules('toolbar',-1); ?>
            <?php endif; ?>
          </div>
        </div>
        <div id="inset">
          <?php mosLoadModules('inset',-1); ?>
        </div>
        <div id="body-shadow-left">
          <div id="body-shadow-right">
            <div id="body">
              <table class="mainbody" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                  <td class="maincol"><div id="maincol">
                      <div class="accent">
                        <div class="accent-left"></div>
                        <div class="accent-right"></div>
                      </div>
                      <?php if ($show_pathway == "true" && $option != 'com_mafiajob') : ?>
                      <?php mosPathway(); ?>
                      <?php endif; ?>
                      <?php mosLoadModules('user12',-2); ?>
                      <?php if (mosCountModules('user3') or mosCountModules('user4')) : ?>
                      <div id="topmodules" class="spacer<?php echo $topmod_width; ?>">
                        <?php if (mosCountModules('user3')) : ?>
                        <div class="block">
                          <?php mosLoadModules('user3',-2); ?>
                        </div>
                        <?php endif; ?>
                        <?php if (mosCountModules('user4')) : ?>
                        <div class="block">
                          <?php mosLoadModules('user4',-2); ?>
                        </div>
                        <?php endif; ?>
                      </div>
                      <?php endif; ?>
                      <div id="component">
                        <div class="padding">
                          <div id="ajax" class="ajaxConteneur">
                            <?php mosMainbody(); ?>
                          </div>
                          <?php 
													if($option == 'com_mafiajob')
													{
													?>
                      <span id="chargement" class="alert" style="display:none;">En cours de chargement</span>
                      <?php } ?>
                          <?php 
													if($option == 'com_mafiajob')
													{
													?>
                      <div align="right" style="margin-top:10px;"><img src="./components/com_mafiajob/images/remonter.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="new Effect.ScrollTo('bg-top'); return false;">Remonter en haut de la page</a> - <img src="./components/com_mafiajob/images/retour.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="RetourHisto();">Retour</a> - <span id="ClickSon">
<?php
$choix = mosGetParam( $_COOKIE, 'choixSon');

if(!$choix || $choix == 'sans')
	echo '<img src="./components/com_mafiajob/images/SonAvec.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="sonChoix();">Activer le son</span></a>';
else
	echo '<img src="./components/com_mafiajob/images/SonSans.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="sonChoix();">Désactiver le son</a>';
?>
</span>
</div>
                      <?php } ?>
                        </div>
                      </div>
                      <div align="center" style="margin-top:10px;">
                        <?php mosLoadModules('banner'); ?>
                      </div>
                      <?php if (mosCountModules('user5') or mosCountModules('user6')) : ?>
                      <div id="bottommodules" class="spacer<?php echo $bottommod_width; ?>">
                        <?php if (mosCountModules('user5')) : ?>
                        <div class="block">
                          <?php mosLoadModules('user5',-2); ?>
                        </div>
                        <?php endif; ?>
                        <?php if (mosCountModules('user6')) : ?>
                        <div class="block">
                          <?php mosLoadModules('user6',-2); ?>
                        </div>
                        <?php endif; ?>
                      </div>
                      <?php endif; ?>
                    </div></td>
                  <?php if (mosCountModules('user1') or ($subnav and $splitmenu_col=="secondcol")) : ?>
                  <td class="secondcol"><div id="secondcol">
                      <div class="accent">
                        <div class="accent-left"></div>
                        <div class="accent-right"></div>
                      </div>
                      <?php if($subnav and $splitmenu_col=="secondcol") : ?>
                      <div id="sub-menu"> <?php echo $subnav; ?> </div>
                      <?php endif; ?>
                      <?php mosLoadModules('user1',-2); ?>
                    </div></td>
                  <?php endif; ?>
                  <?php if (mosCountModules('user2') or ($subnav and $splitmenu_col=="thirdcol")) : ?>
                  <td class="thirdcol"><div id="thirdcol">
                      <div class="accent">
                        <div class="accent-left"></div>
                        <div class="accent-right"></div>
                      </div>
                      <?php if($subnav and $splitmenu_col=="thirdcol") : ?>
                      <div id="sub-menu"> <?php echo $subnav; ?> </div>
                      <?php endif; ?>
                      <?php mosLoadModules('user2',-2); ?>
                    </div></td>
                  <?php endif; ?>
                </tr>
                <tr>
                  <td class="maincol bottom"><div class="accent">
                      <div class="accent-left"></div>
                      <div class="accent-right"></div>
                    </div></td>
                  <?php if (mosCountModules('user1') or ($subnav and $splitmenu_col=="secondcol")) : ?>
                  <td class="secondcol bottom"><div class="accent">
                      <div class="accent-left"></div>
                      <div class="accent-right"></div>
                    </div></td>
                  <?php endif; ?>
                  <?php if (mosCountModules('user2') or ($subnav and $splitmenu_col=="thirdcol")) : ?>
                  <td class="thirdcol bottom"><div class="accent">
                      <div class="accent-left"></div>
                      <div class="accent-right"></div>
                    </div></td>
                  <?php endif; ?>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div id="bottom-modules">
          <div class="padding" >
            <?php if($option != 'com_mafiajob') displayTabs(); ?>
          </div>
        </div>
        <div id="footer-bar">
          <div align="center"><a href="http://www.wubart.net" title="Mafiajob" class="nounder">Wubart.net</a></div>
        </div>
        <div id="footer-shadow">
          <div class="shadow-1"></div>
          <div class="shadow-2"></div>
          <div class="shadow-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
