<?php
/*\
*    This program is free software; you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation; either version 2 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*     but WITHOUT ANY WARRANTY; without even the implied warranty of              
*     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*     GNU General Public License for more details.
*
*     You should have received a copy of the GNU General Public License
*     along with this program; if not, write to the Free Software.
*
*		E-mail-contact@mafiajob.fr
*		Fichier : license.php
\*/

$jal_version = "1.15";
$jal_number_of_comments = 35;
$mosConfig_user='';
$mosConfig_db='';
$mosConfig_host='';
$mosConfig_password='';
$mosConfig_dbprefix='';
$mosConfig_live_site='';

if(defined( '_VALID_MOS' ))
	require_once("configuration.php");
else
	require_once("../configuration.php");


$user 	= $mosConfig_user;
$db		= $mosConfig_db;
$host	= $mosConfig_host;
$pass	= $mosConfig_password;
$prefix	= $mosConfig_dbprefix;
$live	= $mosConfig_live_site;

if (file_exists($mosConfig_absolute_path.'/components/com_shoutbox/languages/'.$mosConfig_lang.'.php'))
	include($mosConfig_absolute_path.'/components/com_shoutbox/languages/'.$mosConfig_lang.'.php');
else
	include($mosConfig_absolute_path.'/components/com_shoutbox/languages/english.php');

$jal_lastID    = isset($_GET['jal_lastID']) ? $_GET['jal_lastID'] : "";
$jal_user_name = isset($_POST['n']) ? $_POST['n'] : ""; 
$jal_user_url  = isset($_POST['u']) ? $_POST['u'] : "";
$jal_user_text = isset($_POST['c']) ? $_POST['c'] : "";
$jalGetChat    = isset($_GET['jalGetChat']) ? $_GET['jalGetChat'] : "";
$jalSendChat   = isset($_GET['jalSendChat']) ? $_GET['jalSendChat'] : "";

function jal_time_since($original) {

    $chunks = array(
        array(60 * 60 * 24 * 365 , _JAL_YEAR , _JAL_YEARS),
        array(60 * 60 * 24 * 30 , _JAL_MONTH , _JAL_MONTHS),
        array(60 * 60 * 24 * 7, _JAL_WEEK , _JAL_WEEKS),
        array(60 * 60 * 24 , _JAL_DAY , _JAL_DAYS),
        array(60 * 60 , _JAL_HOUR , _JAL_HOURS),
        array(60 , _JAL_MINUTE , _JAL_MINUTES),
    );
    $original = $original - 10; 
    $today = time();
    $since = $today - $original;
    
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
		$names = $chunks[$i][2];
        
        if (($count = floor($since / $seconds)) != 0)
            break;
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$names}";
    
    if ($i + 1 < $j) {

        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];
		$names2 = $chunks[$i + 1][2];
        
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
            $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$names2}";
    }
return $print;
}


if ($jalGetChat == "yes" || $jalSendChat == "yes") {
	header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" ); 
	header( "Cache-Control: no-cache, must-revalidate" ); 
	header( "Pragma: no-cache" );
	header("Content-Type: text/html; charset=ISO-8859-1");
	
	if (!$jal_lastID) $jal_lastID = 0;
}

if ($jalGetChat == "yes")
	jal_getData($jal_lastID);

function jal_getData ($jal_lastID) {
	global $user, $host, $db, $pass, $prefix;

	$conn = mysql_connect($host, $user, $pass);
	mysql_select_db($db, $conn);

	$sql = "SELECT * FROM ".$prefix."liveshoutbox WHERE id > ".$jal_lastID." ORDER BY id DESC";
	$results = mysql_query($sql, $conn);
	$loop = "";
	while ($row = mysql_fetch_array($results)) {

		$id   = $row[0];
		$time = $row[1];
		$name = $row[2];
		$text = $row[3];
		$url  = $row[4];
		
		$loop = $id."---".stripslashes($name)."---".stripslashes($text)."---".jal_time_since($time)." "._JAL_AGO."---".stripslashes($url)."---" . $loop;
	}
	echo $loop;
	
	if (empty($loop)) 
		echo "0";
}

function jal_special_chars ($s) {
  $s = htmlspecialchars($s, ENT_COMPAT,'ISO-8859-1');
  return str_replace("---","&minus;-&minus;",$s);
}


if (isset($_POST['shout_no_js'])) {
	if ($_POST['shoutboxname'] != '' && $_POST['chatbarText'] != '') {
		jal_addData($_POST['shoutboxname'], $_POST['chatbarText'], $_POST['shoutboxurl']);
		
		jal_deleteOld(); 
    	
    	
		header('location: '.$_SERVER['HTTP_REFERER']);
	} else echo "You must have a name and a comment";
}

if ($jal_user_name != '' && $jal_user_text != '' && $jalSendChat == "yes") {
		jal_addData($jal_user_name,$jal_user_text,$jal_user_url);
		jal_deleteOld(); 
}

function jal_addData($jal_user_name,$jal_user_text,$jal_user_url) {
	global $jal_number_of_comments, $user, $host, $db, $pass, $prefix;

	$jal_user_text = substr($jal_user_text,0,500); 
	$jal_user_name = substr(trim($jal_user_name), 0,18);


	$jal_user_text = jal_special_chars(trim($jal_user_text));
	$jal_user_name = (empty($jal_user_name)) ? "Inconnu" : jal_special_chars($jal_user_name);
	$jal_user_url = ($jal_user_url == "http://") ? "" : jal_special_chars($jal_user_url);


	$conn = mysql_connect($host, $user, $pass);
	mysql_select_db($db, $conn);
	
	mysql_query("INSERT INTO ".$prefix."liveshoutbox (time,name,text,url) VALUES ('".time()."','".mysql_real_escape_string($jal_user_name)."','".mysql_real_escape_string(utf8_decode($jal_user_text))."','".mysql_real_escape_string($jal_user_url)."')", $conn);
}


function jal_deleteOld() {
	global $jal_number_of_comments, $user, $host, $db, $pass, $prefix;
	
	$conn = mysql_connect($host, $user, $pass);
	mysql_select_db($db, $conn);

	$results = mysql_query("SELECT * FROM ".$prefix."liveshoutbox ORDER BY id DESC LIMIT ".$jal_number_of_comments, $conn);	
	while ($row = mysql_fetch_array($results)) { $id = $row[0]; }
	if ($id) mysql_query("DELETE FROM ".$prefix."liveshoutbox WHERE id < ".$id, $conn);
}

if(defined( '_VALID_MOS' )) {
?>
<table cellpadding="5" cellspacing="0" class="TableauStat">
<tr>
  <td>
<div id="shoutbox">
  <div id="chatoutput" style="width:100%; padding:5px;">
    <?php
						global $jal_number_of_comments, $mosConfig_offset, $mosConfig_live_site, $mainframe;
								
								$sql = "SELECT * FROM #__liveshoutbox ORDER BY id DESC LIMIT 5";
								$database->setQuery( $sql );
								$results = $database->loadObjectList();
							
								$jal_first_time = true; 
								
								if($results) {foreach( $results as $r ) { 
								
								
								$r->text = preg_replace( "`(http|ftp)+(s)?:(//)((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a href=\"\\0\">&laquo;link&raquo;</a>", $r->text);

								if ($jal_first_time == true) { echo '<div id="lastMessage"><span>'._JAL_LAST_MESSAGE.':</span> <em id="responseTime">'.jal_time_since( $r->time ).' '._JAL_AGO.'</em></div>
 						<ul id="outputList">
 						'; }
 						
 						if ($jal_first_time == true) $lastID = $r->id;
 						
 						$url = (empty($r->url) && $r->url = "http://") ? $r->name : '<a href="'.$r->url.'">'.$r->name.'</a>';
 						 						
						        echo '<li><span title="'.jal_time_since( $r->time ).'"><b>'.stripslashes($url).'</b> : </span>'.convert_smilies(" ".stripslashes($r->text)).'</li>
						        '; 
						        
					$jal_first_time = false; } 
					
					} else
					echo "Vous avez besoin au moins d'une donnée";

					
					$use_url = false;
					$use_textarea = false;

				?>
    </ul>
  </div>
  <form id="chatForm" method="post" action="index.php" style="margin-left:5px;" >
    <p>
      <?php
					if ( $my->id ) { 
						echo "\n";?>
      <input type="hidden" name="shoutboxname" id="shoutboxname" value="<?php echo $my->name; ?>" />
      <?php 
						if (!$use_url) { 
							echo '<span style="display: none">'; 
						} ?>
      <label for="shoutboxurl">url:</label>
      <input type="text" name="shoutboxurl" id="shoutboxurl" value="" />
      <?php 
						if (!$use_url) { 
							echo "</span>"; 
						} ?>
      <?php if ($use_textarea) { ?>
      <textarea rows="5" cols="40" name="chatbarText"id="chatbarText" onkeypress="return pressedEnter(this,event);" ></textarea>
      <?php } else { ?>
      <input name="chatbarText" type="text" id="chatbarText" class="inputbox" size="40" />
      <?php } ?>
      <input type="hidden" id="jal_lastID" value="<?php echo $lastID + 1; ?>" name="jal_lastID" />
      <input type="hidden" name="shout_no_js" value="true" />
      <input type="submit" id="submitchat" class="button" name="submit" value="<?php echo _SEND_BUTTON; ?>" />
      <?php 
					}else{
					
					echo '<b>Vous devez être connecté pour écrire sur le salon de discution.</b>';
					
					}
					
					echo "\n"; 
					?>
    </p>
  </form>
</div>
</td>
</tr>
</table>
<?php } 
function convert_smilies($text) {
	if (!isset($wpsmiliestrans)) {
	$wpsmiliestrans = array(
	' :)'        => 'icon_smile.gif',
	' :D'        => 'icon_biggrin.gif',
	' :-D'       => 'icon_biggrin.gif',
	':grin:'    => 'icon_biggrin.gif',
	' :)'        => 'icon_smile.gif',
	' :-)'       => 'icon_smile.gif',
	':smile:'   => 'icon_smile.gif',
	' :('        => 'icon_sad.gif',
	' :-('       => 'icon_sad.gif',
	':sad:'     => 'icon_sad.gif',
	' :o'        => 'icon_surprised.gif',
	' :-o'       => 'icon_surprised.gif',
	':eek:'     => 'icon_surprised.gif',
	' 8O'        => 'icon_eek.gif',
	' 8-O'       => 'icon_eek.gif',
	':shock:'   => 'icon_eek.gif',
	' :?'        => 'icon_confused.gif',
	' :-?'       => 'icon_confused.gif',
	' :???:'     => 'icon_confused.gif',
	' 8)'        => 'icon_cool.gif',
	' 8-)'       => 'icon_cool.gif',
	':cool:'    => 'icon_cool.gif',
	':lol:'     => 'icon_lol.gif',
	' :x'        => 'icon_mad.gif',
	' :-x'       => 'icon_mad.gif',
	':mad:'     => 'icon_mad.gif',
	' :P'        => 'icon_razz.gif',
	' :-P'       => 'icon_razz.gif',
	':razz:'    => 'icon_razz.gif',
	':oops:'    => 'icon_redface.gif',
	':cry:'     => 'icon_cry.gif',
	':evil:'    => 'icon_evil.gif',
	':twisted:' => 'icon_twisted.gif',
	':roll:'    => 'icon_rolleyes.gif',
	':wink:'    => 'icon_wink.gif',
	' ;)'        => 'icon_wink.gif',
	' ;-)'       => 'icon_wink.gif',
	':!:'       => 'icon_exclaim.gif',
	':?:'       => 'icon_question.gif',
	':idea:'    => 'icon_idea.gif',
	':arrow:'   => 'icon_arrow.gif',
	' :|'        => 'icon_neutral.gif',
	' :-|'       => 'icon_neutral.gif',
	':neutral:' => 'icon_neutral.gif',
	':mrgreen:' => 'icon_mrgreen.gif',
	);
}

if (!function_exists('smiliescmp')) {
function smiliescmp ($a, $b) {
	if (strlen($a) == strlen($b))
		return strcmp($a, $b);

		return (strlen($a) > strlen($b)) ? -1 : 1;
	}
}
uksort($wpsmiliestrans, 'smiliescmp');

foreach($wpsmiliestrans as $smiley => $img) {
	$wp_smiliessearch[] = $smiley;
	$smiley_masked = htmlspecialchars( trim($smiley) , ENT_QUOTES);
	$wp_smiliesreplace[] = " <img src='components/com_shoutbox/smilies/$img' alt='$smiley_masked' class='wp-smiley' /> ";
}
    $output = '';
	if (true) { 

		$textarr = preg_split("/(<.*>)/U", $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		$stop = count($textarr);
		for ($i = 0; $i < $stop; $i++) {
			$content = $textarr[$i];
			if ((strlen($content) > 0) && ('<' != $content{0}))
				$content = str_replace($wp_smiliessearch, $wp_smiliesreplace, $content);

			$output .= $content;
		}
	} else
		$output = $text;

	return $output;
}
?>
