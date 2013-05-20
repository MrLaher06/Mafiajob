<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$fontstyle = "f-" . $default_font;
$tstyle = $default_style;
$mtype = $menu_type;
$tempus = false;

if (date('H') >= 20)
 $tempus = "night";
else if (date('H') >= 17)
 $tempus = "dusk";
else if (date('H') >= 9)
 $tempus = "day";
else if (date('H') >= 5)
 $tempus = "dawn";
else
 $tempus = "night";
			 
$cookie_prefix = "dim-";

$menu_type = $mtype;

$thisurl = $_SERVER['PHP_SELF'] . rebuildQueryString();

function rebuildQueryString() {
  $ignores = array("tstyle","contraststyle","fontstyle","widthstyle", "tempus");
  if (!empty($_SERVER['QUERY_STRING'])) {
      $parts = explode("&", $_SERVER['QUERY_STRING']);
      $newParts = array();
      foreach ($parts as $val) {
          $val_parts = explode("=", $val);
          if (!in_array($val_parts[0], $ignores)) {
            array_push($newParts, $val);
          }
      }
      if (count($newParts) != 0) {
          $qs = implode("&amp;", $newParts);
      } else {
          return "?";
      }
      return "?" . $qs . "&amp;"; // this is your new created query string
  } else {
      return "?";
  } 
}
?>
