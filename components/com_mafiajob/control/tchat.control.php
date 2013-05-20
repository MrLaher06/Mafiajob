<?php

$jal_version = "1.15";

$jal_number_of_comments = 35;


	include($mosConfig_absolute_path.'/components/com_shoutbox/languages/english.php');


// Register globals - Thanks Karan et Etienne
$jal_lastID    = isset($_GET['jal_lastID']) ? $_GET['jal_lastID'] : "";
$jal_user_name = isset($_POST['n']) ? $_POST['n'] : ""; 
$jal_user_url  = isset($_POST['u']) ? $_POST['u'] : "";
$jal_user_text = isset($_POST['c']) ? $_POST['c'] : "";
$jalGetChat    = isset($_GET['jalGetChat']) ? $_GET['jalGetChat'] : "";
$jalSendChat   = isset($_GET['jalSendChat']) ? $_GET['jalSendChat'] : "";

// Time Since function courtesy 
// http://blog.natbat.co.uk/archive/2003/Jun/14/jal_time_since

// Works out the time since the entry post, takes a an argument in unix time (seconds)
function jal_time_since($original) {
    // array of time period chunks
    $chunks = array(
        array(60 * 60 * 24 * 365 , _JAL_YEAR , _JAL_YEARS),
        array(60 * 60 * 24 * 30 , _JAL_MONTH , _JAL_MONTHS),
        array(60 * 60 * 24 * 7, _JAL_WEEK , _JAL_WEEKS),
        array(60 * 60 * 24 , _JAL_DAY , _JAL_DAYS),
        array(60 * 60 , _JAL_HOUR , _JAL_HOURS),
        array(60 , _JAL_MINUTE , _JAL_MINUTES),
    );
    $original = $original - 10; // Shaves a second, eliminates a bug where $time and $original match.
    $today = time(); /* Current unix time  */
    $since = $today - $original;
    
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
		$names = $chunks[$i][2];
        
        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$names}";
    
    if ($i + 1 < $j) {
        // now getting the second item
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];
		$names2 = $chunks[$i + 1][2];
        
        // add second item if it's greater than 0
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
            $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$names2}";
        }
    }
return $print;
}

////////////////////////////////////////////////////////////
// Functions Below are for getting comments from the database
////////////////////////////////////////////////////////////

// Never cache this page
if ($jalGetChat == "yes" || $jalSendChat == "yes") {
	header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" ); 
	header( "Cache-Control: no-cache, must-revalidate" ); 
	header( "Pragma: no-cache" );
	header("Content-Type: text/html; charset=utf-8");
	
	//if the request does not provide the id of the last know message the id is set to 0
	if (!$jal_lastID) $jal_lastID = 0;
}

// retrieves all messages with an id greater than $jal_lastID
if ($jalGetChat == "yes") {
	jal_getData($jal_lastID);
}

// Where the shoutbox receives information
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
		
		// append the new id's to the beginning of $loop
		$loop = $id."---".stripslashes($name)."---".stripslashes($text)."---".jal_time_since($time)." "._JAL_AGO."---".stripslashes($url)."---" . $loop; // --- is being used to separate the fields in the output
	}
	echo $loop;
	
	// if there's no new data, send one byte. Fixes a bug where safari gives up w/ no data
	if (empty($loop)) { echo "0"; }
}

// Why doesn't htmlentities() figure this one out? who knows
function jal_special_chars ($s) {
  $s = htmlspecialchars($s, ENT_COMPAT,'UTF-8');
  return str_replace("---","&minus;-&minus;",$s);
}

////////////////////////////////////////////////////////////
// Functions Below are for submitting comments to the database
////////////////////////////////////////////////////////////

// When user submits and javascript fails
if (isset($_POST['shout_no_js'])) {
	if ($_POST['shoutboxname'] != '' && $_POST['chatbarText'] != '') {
		jal_addData($_POST['shoutboxname'], $_POST['chatbarText'], $_POST['shoutboxurl']);
		
		jal_deleteOld(); //some database maintenance
    	
    	//setcookie("jalUserName",$_POST['shoutboxname'],time()+60*60*24*30*3,'/');
    	//setcookie("jalUrl",$_POST['shoutboxurl'],time()+60*60*24*30*3,'/');
        //take them right back where they left off
		header('location: '.$_SERVER['HTTP_REFERER']);
	} else echo "You must have a name and a comment";
}

	//only if a name and a message have been provides the information is added to the db
if ($jal_user_name != '' && $jal_user_text != '' && $jalSendChat == "yes") {
		jal_addData($jal_user_name,$jal_user_text,$jal_user_url); //adds new data to the database
		jal_deleteOld(); //some database maintenance
}

function jal_addData($jal_user_name,$jal_user_text,$jal_user_url) {
	global $jal_number_of_comments, $user, $host, $db, $pass, $prefix;
	//the message is cut of after 500 letters
	$jal_user_text = substr($jal_user_text,0,500); 
	
	$jal_user_name = substr(trim($jal_user_name), 0,18);

	// CENSORS .. default is off. To turn it on, uncomment the line below. Add new lines with new censors as needed.	
	//$jal_user_text = str_replace("fuck", "****", $jal_user_text);

	$jal_user_text = jal_special_chars(trim($jal_user_text));
	$jal_user_name = (empty($jal_user_name)) ? "Anonymous" : jal_special_chars($jal_user_name);
	$jal_user_url = ($jal_user_url == "http://") ? "" : jal_special_chars($jal_user_url);


	$conn = mysql_connect($host, $user, $pass);
	mysql_select_db($db, $conn);
	
	mysql_query("INSERT INTO ".$prefix."liveshoutbox (time,name,text,url) VALUES ('".time()."','".mysql_real_escape_string($jal_user_name)."','".mysql_real_escape_string($jal_user_text)."','".mysql_real_escape_string($jal_user_url)."')", $conn);
}

//Maintains the database by deleting past comments
function jal_deleteOld() {
	global $jal_number_of_comments, $user, $host, $db, $pass, $prefix;
	
	$conn = mysql_connect($host, $user, $pass);
	mysql_select_db($db, $conn);

	$results = mysql_query("SELECT * FROM ".$prefix."liveshoutbox ORDER BY id DESC LIMIT ".$jal_number_of_comments, $conn);	
	while ($row = mysql_fetch_array($results)) { $id = $row[0]; }
	if ($id) mysql_query("DELETE FROM ".$prefix."liveshoutbox WHERE id < ".$id, $conn);
}

//if ($jalGetChat != "yes" && $jalSendChat != "yes") {
if(defined( '_VALID_MOS' )) {
?>
			<div id="shoutbox">
				<div id="chatoutput">
					<?php
						global $jal_number_of_comments, $mosConfig_offset, $mosConfig_live_site, $mainframe;
								
								$sql = "SELECT * FROM #__liveshoutbox ORDER BY id DESC LIMIT 20";
								$database->setQuery( $sql );
								$results = $database->loadObjectList();
							
								// Will only add the last message div if it is looping for the first time
								$jal_first_time = true; 
								
								// Loops the messages into a list
								if($results) {foreach( $results as $r ) { 
								
								// Add links
								
								$r->text = preg_replace( "`(http|ftp)+(s)?:(//)((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a href=\"\\0\">&laquo;link&raquo;</a>", $r->text);

if ($jal_first_time == true) { echo '<div id="lastMessage"><span>'._JAL_LAST_MESSAGE.':</span> <em id="responseTime">'.jal_time_since( $r->time ).' '._JAL_AGO.'</em></div>
 						<ul id="outputList">
 						'; } 						
 						if ($jal_first_time == true) $lastID = $r->id;
 						
 						$url = (empty($r->url) && $r->url = "http://") ? $r->name : '<a href="'.$r->url.'">'.$r->name.'</a>';
 						 						
						        echo '<li><span title="'.jal_time_since( $r->time ).'" class="name">[ '.stripslashes($url).' ] : </span>'.convert_smilies(" ".stripslashes($r->text)).'</li>
						        '; 
						        
					$jal_first_time = false; } 
					
					// If there is less than one entry in the box
					} else {
					echo "Aucun message dans nos bases de données.";
					}
					
					$use_url = false;
					$use_textarea = false;

				?>
</ul>

				</div>
				<form id="chatForm" method="post" action="index.php">
				    <p>
					<?php
					if ( $my->id ) { 
						echo "\n";/* If they are logged in, then print their nickname */ ?>
						<input type="hidden" name="shoutboxname" id="shoutboxname" value="<?php echo $my->username; ?>" />
						
						<input type="hidden" name="shoutboxurl" id="shoutboxurl" value="" />
						
                        <input name="chatbarText" type="text" id="chatbarText" class="inputbox" size="26" />
    
                        <input type="hidden" id="jal_lastID" value="<?php echo $lastID + 1; ?>" name="jal_lastID" />
                        <input type="hidden" name="shout_no_js" value="true" />
                        <input type="submit" id="submitchat" name="submit" class="button" value="<?php echo _SEND_BUTTON; ?>" align="left" />
					<?php 
					} 
					?>
					
					</p>
				</form>
			</div>
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

// sorts the smilies' array
if (!function_exists('smiliescmp')) {
function smiliescmp ($a, $b) {
	if (strlen($a) == strlen($b)) {
		return strcmp($a, $b);
	}
		return (strlen($a) > strlen($b)) ? -1 : 1;
	}
}
uksort($wpsmiliestrans, 'smiliescmp');

// generates smilies' search & replace arrays
foreach($wpsmiliestrans as $smiley => $img) {
	$wp_smiliessearch[] = $smiley;
	$smiley_masked = htmlspecialchars( trim($smiley) , ENT_QUOTES);
	$wp_smiliesreplace[] = " <img src='components/com_shoutbox/smilies/$img' alt='$smiley_masked' class='wp-smiley' /> ";
}
    $output = '';
	if (true) { //setting smilies aan of uit
		// HTML loop taken from texturize function, could possible be consolidated
		$textarr = preg_split("/(<.*>)/U", $text, -1, PREG_SPLIT_DELIM_CAPTURE); // capture the tags as well as in between
		$stop = count($textarr);// loop stuff
		for ($i = 0; $i < $stop; $i++) {
			$content = $textarr[$i];
			if ((strlen($content) > 0) && ('<' != $content{0})) { // If it's not a tag
				$content = str_replace($wp_smiliessearch, $wp_smiliesreplace, $content);
			}
			$output .= $content;
		}
	} else {
		// return default text.
		$output = $text;
	}
	return $output;
}
?>