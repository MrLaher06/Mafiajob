<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$module_slider_width = $template_width;
$max_mods_per_row = 3;										

function outputTabModules($module, $counter) {
	global $max_mods_per_row;
	
	if (mosCountModules($module["module"])>$max_mods_per_row) {
		$cols = $max_mods_per_row;
	} else {
		$cols = mosCountModules($module["module"]);
	}

	echo "<div class=\"tab-pane\" id=\"tab-$counter-pane\">\n";
	echo "<h1 class=\"tab-title\"><span>" . $module["title"] . "</span></h1>\n";
	echo "<div class=\"padding mmpr-" . $cols . "\">\n";
	mosLoadModules($module["module"],-3);
	echo "</div>\n";
	echo "</div>\n";
	
}

function displayTabs() {
	global $mainframe, $mosConfig_live_site;
	global $module_slider_width, $module_slider_height, $modules_list;

	if (intval($module_slider_width) > 0) {
		$module_slider_width = intval($module_slider_width) - 50;
	} else {
		$module_slider_width = 700;
	}
	
	$module_count = 0;
	foreach ($modules_list as $module) {
		if (mosCountModules($module["module"]) > 0) $module_count++;
	}
	
	if ($module_count > 0) {
		echo "<script type=\"text/javascript\" src=\"" . $mosConfig_live_site . "/templates/" . $mainframe->getTemplate() . "/js/rokslidestrip.js\"></script>\n";
		echo "<script type=\"text/javascript\">
					window.addEvent('domready', function() {
						var mySlideModules = new RokSlide($('moduleslide'), {
							fx: {
								wait: true,
								duration: 1000
							},
							scrollFX: {
								transition: Fx.Transitions.Cubic.easeIn
							},
							dimensions: {
								width: $module_slider_width,
								height: $module_slider_height
							}
						});
					});
					</script>\n";
		echo '<div id="moduleslide">';
		$counter = 0;
	
		foreach ($modules_list as $module) {
			if (mosCountModules($module["module"])) {
				outputTabModules( $module, $counter++ );
			}
		}
		echo '</div>';
	}
}


?>