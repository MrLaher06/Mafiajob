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
	
	header("Cache-Control: must-revalidate");
	$offset = 60*60*24*60;
	$ExpStr = "Expires: ".gmdate("D, d M Y H:i:s",time() + $offset)." GMT";
	header($ExpStr);
	header('Content-Type: text/css');
	
	require_once( "../administrator/components/com_shoutbox/shoutbox.cfg.php");
?>

/*
This file controls the look of the Live shoutbox...
*/


#chatoutput {

height: 300px;
width: 520px;
padding: 6px 8px; 
border: 1px solid #<?php echo stripslashes(shoutbox_name_color); ?>;
font: 11px helvetica, arial, sans-serif;
color: #<?php echo stripslashes(shoutbox_text_color); ?>;
background: #<?php echo stripslashes(shoutbox_fade_to); ?>;
overflow: auto;
margin-top: 10px;
}

#chatoutput span {
font-size: 1.1em;
color: #<?php echo stripslashes(shoutbox_name_color); ?>;
background-color:inherit;
}

#chatForm label, #shoutboxAdmin {
display: block;
margin: 4px 0;
}

#chatoutput a {
font-style: normal;
font-weight: bold;
color: #000000;
background-color:inherit;
}

/* User names with links */
#chatoutput li span a {
font-weight: normal;
display: inline !important;
border-bottom: 1px dotted #CCCCCC;
}

#chatForm input, #chatForm textarea {
width: 500px;
display: block;
margin: 0 auto;
}

#chatForm textarea {
width: 500px;
}


input#submitchat {
width: 70px;
margin: 10px auto;
padding: 2px;
border: 1px solid #cccccc;
background-color: #ffffff;
color: #333333;
cursor:pointer;
}

#chatoutput ul#outputList {
padding: 0;
position: static;
margin: 0;
width:500px;
}

#chatoutput ul#outputList li {
padding: 4px;
margin: 0;
color: #<?php echo stripslashes(shoutbox_text_color); ?>;
background-color:inherit;
font-size: 1em;
list-style: none;
width:500px;
}

/* No bullets from Kubrick et al. */
#chatoutput ul#outputList li:before {
content: '';
}

ul#outputList li:first-line {
line-height: 16px;
}

#lastMessage {
padding-bottom: 2px;
text-align: center;
border-bottom: 2px dotted #<?php echo stripslashes(shoutbox_fade_from); ?>;
}

em#responseTime {
font-style: normal;
display: block;
}

#chatoutput .wp-smiley {
vertical-align: middle;
}