<?php
/**
* @version $Id: admin.verjaardagen.html.php,v 1.22 2004/09/21 16:36:46 stingrey Exp $
* @package Mambo_4.5.1
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo_4.5.1
*/
require_once( $mosConfig_absolute_path. "/administrator/components/com_shoutbox/shoutbox.cfg.php");

class HTML_shoutbox {

	function settingsShoutBox() {
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="adminForm">
		Update Every: <input type="text" maxlength="3" name="conf_shoutbox_update_seconds" value="<?php echo stripslashes(shoutbox_update_seconds)/ 1000; ?>" size="2" /> Seconds <br />
  		<p>This determines how "live" the shoutbox is. With a bigger number, it will take more time for messages to show up, but also decrease the server load. You may use decimals. This number is used as the base for the first 8 javascript loads. After that, the number gets successively bigger. Adding a new comment or mousing over the shoutbox will reset the interval to the number suplied above. Default: 4 Seconds</p>
		Fade from: #<input type="text" maxlength="6" name="conf_shoutbox_fade_from" value="<?php echo stripslashes(shoutbox_fade_from); ?>" size="6" /> <span style="background: #<?php echo stripslashes(shoutbox_fade_from); ?>;">&nbsp;</span>
  		<p>The color that new messages fade in from. Default: <span style="color: #666">666666</span></p>
		Fade to: #<input type="text" maxlength="6" name="conf_shoutbox_fade_to" value="<?php echo stripslashes(shoutbox_fade_to); ?>" size="6" /> <span style="background: #<?php echo stripslashes(shoutbox_fade_to); ?>;">&nbsp;</span>
		<p>Also used as the background color of the box. Default: FFFFFF (white)</p>
		Text Color: #<input type="text" maxlength="6" name="conf_shoutbox_text_color" value="<?php echo stripslashes(shoutbox_text_color); ?>" size="6" /> <span style="background: #<?php echo stripslashes(shoutbox_text_color); ?>;">&nbsp;</span>
		<p>The color of text within the box. Default: <span style="color: #333">333333</span></p>
		Name Color: #<input type="text" maxlength="6" name="conf_shoutbox_name_color" value="<?php echo stripslashes(shoutbox_name_color); ?>" size="6" /> <span style="background: #<?php echo stripslashes(shoutbox_name_color); ?>;">&nbsp;</span>
		<p>The color of peoples' names. Default: <span style="color: #06c">0066CC</span></p>
		Fade Length: <input type="text" maxlength="3" name="conf_shoutbox_fade_length" value="<?php echo stripslashes(shoutbox_fade_length) / 1000; ?>" size="2" /> Seconds <br />
		<p>The amount of time it takes for the fader to completely blend with the background color. You may use decimals. Default 1.5 seconds</p>
        Use textarea: <input type="checkbox" name="conf_use_textarea" <?php if(use_textarea == true) { echo 'checked="checked" '; } ?>/>
        <p>A textarea is a bigger type of input box. Users will have more room to type their comments, but pressing return won't work for submission.</p>
        Use URL field: <input type="checkbox" name="conf_use_url" <?php if(use_url == true) { echo 'checked="checked" '; } ?>/>
        <p>Check this if you want users to have an option to add their URL when submitting a message.</p>
		<input type="hidden" name="option" value="com_shoutbox" />
		<input type="hidden" name="myname" value="Jabba Binks" />
		<input type="hidden" name="task" value="">
		</form>
		<h1>Under Construction</h1>
		<?php
	}

	function showShoutBox( $option, &$rows, &$lists, &$search, &$pageNav ) {
		global $my;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			ShoutBox Manager
			</th>
		  </tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<? echo count( $rows ); ?>);" />
			</th>
			
			<!-- ------------------- -->
			<!-- 1 of 6 Change/Edit your column titles to display -->
			<!-- ------------------- -->
			
			<th class="title" nowrap="nowrap">
			ID			</th>
			<th class="title" nowrap="nowrap">
			Name			</th>
			<th class="title" nowrap="nowrap">
			Text			</th>
			<th class="title" nowrap="nowrap">
			URL			</th>
			<th class="title" nowrap="nowrap">
			Time			</th>
		</tr>
		<?
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			$task = $row->published ? 'unpublish' : 'publish';
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? 'Published' : 'Unpublished';
			?>
			<tr class="<? echo "row$k"; ?>">
				<td width="20">
				<? echo mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) ); ?>
				</td>
				
				<!-- ------------------- -->
				<!-- 2 of 6 Change the following display values to match your header -->
				<!-- ------------------- -->
				
				<td align="left">
					<? echo $row->id; ?>
					</a>
				</td>
				<td align="left">
				<? echo $row->name; ?>
				</td>
				<td align="left">
				<? echo $row->text; ?>
				</td>
				<td align="left">
				<? echo $row->url; ?>
				</td>
				<td align="left">
				<? echo $row->time; ?>
				</td>
			</tr>
			<?			
			$k = 1 - $k; 
		} 
		?>
		</table>
		<? echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<? echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?
	}



function showArchivedVerjaardagens( $option, &$rows, &$lists, &$search, &$pageNav ) {
		global $my;
		?>
		<form action="index2." method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			Archived Verjaardagen Manager
			</th>
			<td>
			Filter:
			</td>
			<td>
			<input type="text" name="search" value="<? echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
			<td width="right">
			<? echo $lists['catid'];?>
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<? echo count( $rows ); ?>);" />
			</th>
			
			<!-- -------------------
			<!-- 3 of 6 Change/Edit your column titles to display
			<!-- ------------------- -->
			
			<th class="title" nowrap="nowrap">
			naam			</th>
			<th class="title" nowrap="nowrap">
			geboortedatum			</th>
			
			<!-- -------------------
			<!-- The following can stay as they are
			<!-- ------------------- -->
			
			<th width="10%" nowrap="nowrap">
			Published
			</th>
			<th colspan="2">
			Reorder
			</th>
			<th width="25%" align="center" nowrap="nowrap">
			Category
			</th>
			<th width="10%" nowrap="nowrap">
			Checked Out
			</th>
		</tr>
		<?
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			$task = $row->published ? 'unpublish' : 'publish';
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? 'Published' : 'Unpublished';
			?>
			<tr class="<? echo "row$k"; ?>">
				<td width="20">
				<? echo mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) ); ?>
				</td>
				
				<!-- -------------------
				<!-- 4 of 6 Change the following display values to match your header
				<!-- ------------------- -->
				
				<td width="50%">
				<?
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					?>
					<? echo $row->naam; ?>
					&nbsp;[ <i>Checked Out</i> ]
					<?
				} else {
					?>
					<a href="#edit" onclick="return listItemTask('cb<? echo $i;?>','edit')">
					<? echo $row->naam; ?>
					</a>
					<?
				}
				?>
				<?
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					?>
					<? echo $row->geboortedatum; ?>
					&nbsp;[ <i>Checked Out</i> ]
					<?
				} else {
					?>
					<a href="#edit" onclick="return listItemTask('cb<? echo $i;?>','edit')">
					<? echo $row->geboortedatum; ?>
					</a>
					<?
				}
				?>
				<!-- -------------------
				<!-- The following can stay as they are
				<!-- ------------------- -->
				
				<td width="10%" align="center">
				<a href="javascript: void(0);" onclick="return listItemTask('cb<? echo $i;?>','<? echo $task;?>')">
				<img src="images/<? echo $img;?>" width="12" height="12" border="0" alt="<? echo $alt; ?>" />
				</a>
				</td>
				<td>
				<? echo $pageNav->orderUpIcon( $i, ($row->catid == @$rows[$i-1]->catid) ); ?>
				</td>
      			<td>
				<? echo $pageNav->orderDownIcon( $i, $n, ($row->catid == @$rows[$i+1]->catid) ); ?>
				</td>
				<td width="25%" align="center">
				<? echo $row->category; ?>
				</td>
				<?
				if ( $row->checked_out ) { 
					?>
					<td width="10%" align="center"><? echo $row->editor; ?></td>
					<?		
				} else { 
					?>
					<td width="10%" align="center">&nbsp;</td>
					<?		
				} 
				?>
			</tr>
			<?			
			$k = 1 - $k; 
		} 
		?>
		</table>
		<? echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<? echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?
	}



/**
* Writes the edit form for new and existing record
*
* A new record is defined when <var>$row</var> is passed with the <var>id</var>
* property set to 0.
* @param mosVerjaardagen The verjaardagen object
* @param array An array of select lists
* @param string The option
*/
	function editShoutBoxItem( &$row, $option ) {
		mosMakeHtmlSafe( $row, ENT_QUOTES, 'description' );
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}


			
			/*** ***********************
			/**  5 of 6 Edit for your field validation needs
			/*** *********************** */
			
			if (form.naam.value == ""){
				alert( "Verjaardagen item must have a naam" );
			} else if (form.geboortedatum.value == ""){
				alert( "Verjaardagen item must have a geboortedatum" );
			} else {
				/*
				/** Edit this area to write your edit area back to the database
				/*   */
				submitform( pressbutton );
			}
		}
		</script>
		<table class="adminheading">
		<tr>
			<th>
			<? echo $row->id ? 'Edit' : 'Add';?> ShoutBox Item
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm" id="adminForm">

		<!-- ------------------- -->
		<!-- 6 of 6 Change the following input form to capture all your values -->
		<!-- ------------------- -->
		
		<table class="adminform">
		<tr>
			<td width="20%" align="right">
			Name:
			</td>
			<td width="80%">
			<input class="text_area" type="text" name="name" size="30" maxlength="60" value="<? echo $row->name;?>" />
			</td>

		</tr>
		<tr>
			<td valign="top" align="right">
			Text
			</td>
			<td>
			<textarea name="textarea" class="text_area" name="text" id="text" rows="3" cols="100"><? echo $row->text; ?></textarea>
			</td>
		</tr>
		<!-- ------------------- -->
		<!-- The following can stay as they are -->
		<!-- ------------------- -->

		<tr>
			<td valign="top" align="right">
			Url
			</td>
			<td>
			<input class="text_area" type="text" name="url" size="30" maxlength="60" value="<? echo $row->url;?>" />
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<? echo $row->id; ?>" />
		<input type="hidden" name="option" value="<? echo $option;?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?
	}
}
?>

