<?php
/**
* @version $Id: admin.mafiajob.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restriction d\'accès' );

class HTML_mafiajob {

	function accueil()
	{
		global $mosConfig_live_site, $option, $task;
	?>
<table class="adminheading" border="0">
  <tr>
    <th class="cpanel"> Panneau de contr&ocirc;le de Mafiajob</th>
  </tr>
</table>
<table class="adminform">
  <tr>
    <td width="55%" valign="top"><div id="cpanel">
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=carte"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/carte.png"  alt="La carte" align="middle" border="0" /> <span>Batiments</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=carteMap"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/carte.png"  alt="La carte" align="middle" border="0" /> <span>Carte Accès</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=joueurs"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/joueurs.png"  alt="Tous les joueurs" align="joueurs" border="0" /> <span>Joueurs</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=bots"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/bots.png"  alt="Les bots" align="middle" border="0" /> <span>Bots</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=armes"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/armes.png"  alt="armes" align="middle" border="0" /> <span>Armes</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=voitures"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/voitures.png"  alt="Voitures" align="middle" border="0" /> <span>Voitures</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=action"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/actions.png"  alt="Actions" align="middle" border="0" /> <span>Actions</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=histo"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/histo.png"  alt="Historique" align="middle" border="0" /> <span>Historique</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=forum"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/forum.png"  alt="Forum" align="middle" border="0" /> <span>Forum</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=stat"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/stats.png"  alt="Statistiques" align="middle" border="0" /> <span>Statistiques</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=config"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/config.png"  alt="Configuration" align="middle" border="0" /> <span>Configuration</span> </a> </div>
      </div>
      <div style="float:left;">
        <div class="icon"> <a href="index2.php?option=<?php echo $option; ?>&task=articles"> <img src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mafiajob/images/articles.png"  alt="Articles" align="middle" border="0" /> <span>Articles</span> </a> </div>
      </div>
      <div style="clear:both;"> </div></td>
    <td width="45%" valign="top"><div style="width: 100%;">
        <link id="luna-tab-style-sheet" type="text/css" rel="stylesheet" href="<?php echo $mosConfig_live_site; ?>/includes/js/tabs/tabpane.css" />
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/tabs/tabpane_mini.js"></script>
        <div class="tab-page" id="modules-cpanel">
          <script type="text/javascript"> var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 ) </script>
          <div class="tab-page" id="module32">
            <h2 class="tab">Connectés</h2>
            <script type="text/javascript">tabPane1.addTabPage( document.getElementById( "module32" ) );</script>
            <table class="adminlist">
              <tr>
                <th colspan="4"> Joueurs actuellement connectés </th>
              </tr>
              <tr>
                <td width="5%"> 1 </td>
                <td><a href="index2.php?option=com_users&task=editA&hidemainmenu=1&id=62" title="Editer Utilisateur">admin</a> </td>
                <td> Super Administrator </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="tab-page" id="module33">
            <h2 class="tab">Bots</h2>
            <script type="text/javascript">tabPane1.addTabPage( document.getElementById( "module33" ) );</script>
            <table class="adminlist">
              <tr>
                <th colspan="4"> Bots actuellement connectés </th>
              </tr>
              <tr>
                <td width="5%"> 1 </td>
                <td><a href="index2.php?option=com_users&task=editA&hidemainmenu=1&id=62" title="Editer Utilisateur">admin</a> </td>
                <td> Super Administrator </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
      </div></td>
  </tr>
</table>
<?php
	}
		
	function carte( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="42%" class="title"> Nom </th>
      <th width="15%" nowrap="nowrap" class="title">Option</th>
      <th width="15%" nowrap="nowrap" class="title">Protection</th>
      <th width="15%" nowrap="nowrap" class="title">Caisse</th>
      <th width="7%" nowrap="nowrap" class="title">Position</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
			$link 	= 'index2.php?option=com_mafiajob&task=editCarteA&IdMafiajob='. $row->id. '';
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><a href="<?php echo $link; ?>"> <?php echo $row->nom; ?> </a> </td>
      <td><?php echo $row->option; ?></td>
      <td><?php echo number_format($row->protection); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->coffre); ?> $ </td>
      <td><?php echo $row->lat; ?> - <?php echo chr($row->lng+64); ?></td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}
		
	function config( $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
</form>
<?php
	}
		
	function stats( $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
 
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
</form>
<?php
	}

function armes( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="58%" class="title"> Nom </th>
      <th width="15%" nowrap="nowrap" class="title">Attaque</th>
      <th width="15%" nowrap="nowrap" class="title">Defense</th>
      <th width="7%" nowrap="nowrap" class="title">Prix</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
			$link 	= 'index2.php?option=com_mafiajob&task=editArmesA&IdMafiajob='. $row->id. '';
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><a href="<?php echo $link; ?>"> <?php echo $row->nom; ?> </a> </td>
      <td><?php echo number_format($row->attaque); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->defense); ?> pts</td>
      <td><?php echo number_format($row->prix_achat); ?> $</td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}
	
	function voitures( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="44%" class="title"> Nom </th>
      <th width="15%" nowrap="nowrap" class="title">Discretion</th>
      <th width="15%" nowrap="nowrap" class="title">Rapidite</th>
      <th width="7%" nowrap="nowrap" class="title">Déplacement</th>
      <th width="7%" nowrap="nowrap" class="title">Réservoir</th>
      <th width="7%" nowrap="nowrap" class="title">Prix</th>
      <th width="7%" nowrap="nowrap" class="title">Xp</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
			$link 	= 'index2.php?option=com_mafiajob&task=editVoituresA&IdMafiajob='. $row->id. '';
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><a href="<?php echo $link; ?>"> <?php echo $row->nom; ?> </a> </td>
      <td><?php echo number_format($row->attaque); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->defense); ?> pts</td>
      <td><?php echo $row->move; ?> s</td>
      <td><?php echo $row->reservoir; ?> l</td>
      <td><?php echo number_format($row->prix_achat); ?> $</td>
      <td><?php echo $row->xp; ?> </td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}

function bots( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="80%" class="title"> Nom </th>
      <th width="15%" nowrap="nowrap" class="title">Argent</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
			$link 	= 'index2.php?option=com_mafiajob&task=editBotsA&IdMafiajob='. $row->id. '';
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><a href="<?php echo $link; ?>"> <?php echo $row->nom; ?> </a> </td>
      <td nowrap="nowrap"><?php echo number_format($row->argent); ?> $ </td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}

function articles( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="80%" class="title"> texte </th>
      <th width="15%" nowrap="nowrap" class="title">type</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
			$link 	= 'index2.php?option=com_mafiajob&task=editArticlesA&IdMafiajob='. $row->id. '';
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><a href="<?php echo $link; ?>"> <?php echo $row->texte; ?> </a> </td>
      <td nowrap="nowrap"><?php echo optiontypearticle($row->type); ?></td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}

function joueurs( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="" class="title"> Nom </th>
      <th width="" class="title"> Santé </th>
      <th width="" class="title"> Attaque </th>
      <th width="" class="title"> Defense </th>
      <th width="" class="title"> Discretion </th>
      <th width="" class="title"> Rapidite </th>
      <th width="" class="title"> Xp </th>
      <th width="" nowrap="nowrap" class="title">Argent</th>
      <th width="" class="title">Commentaire</th>
      <th width="" class="title">IP</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
			$link 	= 'index2.php?option=com_mafiajob&task=editJoueursA&IdMafiajob='. $row->id. '';
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><a href="<?php echo $link; ?>"> <?php echo $row->username; ?> </a> </td>
      <td nowrap="nowrap"><?php echo number_format($row->vie); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->attaque); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->defense); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->discretion); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->rapidite); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->xp); ?> pts</td>
      <td nowrap="nowrap"><?php echo number_format($row->argent); ?> $ </td>
      <td nowrap="nowrap"><?php echo $row->commentaire; ?></td>
      <td nowrap="nowrap"><?php echo $row->ip; ?></td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}
	
			
	function forum( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="10%" class="title"> Nom </th>
      <th width="10%" class="title"> Mafia </th>
      <th width="60%" nowrap="nowrap" class="title">Texte</th>
      <th width="15%" nowrap="nowrap" class="title">Date</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><?php echo $row->username; ?></td>
      <td><?php echo $row->idmafia; ?></td>
      <td><?php echo $row->texte; ?></td>
      <td><?php echo $row->date_crea; ?></td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}
	
			
	function histo( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="10%" class="title"> Mafia </th>
      <th width="60%" nowrap="nowrap" class="title">Texte</th>
      <th width="15%" nowrap="nowrap" class="title">Date</th>
      <th width="15%" nowrap="nowrap" class="title">Type</th>
      <th width="15%" nowrap="nowrap" class="title">Lat</th>
      <th width="15%" nowrap="nowrap" class="title">Lng</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><?php echo $row->idmafia; ?></td>
      <td><?php echo $row->texte; ?></td>
      <td><?php echo $row->date_crea; ?></td>
      <td><?php echo $row->type; ?></td>
      <td><?php echo $row->lat; ?></td>
      <td><?php echo $row->lng; ?></td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}
	
			
	function action( $rows, $pageNav, $option ) 
	{
		global $task;
?>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminlist" width="100%">
    <tr>
      <th width="2%" class="title"> # </th>
      <th width="10%" class="title"> Nom Attaquant </th>
      <th width="10%" class="title"> Mafia Attaquant </th>
      <th width="10%" class="title"> Nom Defenseur </th>
      <th width="60%" nowrap="nowrap" class="title">Type de l'attaque</th>
      <th width="15%" nowrap="nowrap" class="title">Type du défenseur</th>
      <th width="15%" nowrap="nowrap" class="title">Lat</th>
      <th width="15%" nowrap="nowrap" class="title">Lng</th>
      <th width="15%" nowrap="nowrap" class="title">Temps</th>
      <th width="3%" class="title"> ID </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) 
		{
			$row 	=& $rows[$i];
	?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?> </td>
      <td><?php echo $row->nomattaque; ?></td>
      <td><?php echo $row->nomdefense; ?></td>
      <td><?php echo $row->idmafia; ?></td>
      <td><?php echo $row->typeattaque; ?></td>
      <td><?php echo $row->typedefense; ?></td>
      <td><?php echo $row->lat; ?></td>
      <td><?php echo $row->lng; ?></td>
      <td><?php echo round(time() - $row->time_crea); ?></td>
      <td><?php echo $row->id; ?> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
	?>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
  <?php echo $pageNav->getListFooter(); ?>
</form>
<?php
	}


	function editcarte( $row , $option, $uid ) 
	{
		global $mosConfig_live_site, $task;
		
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "Vous devez saisir un nom." );
			} else {
				submitform( pressbutton );
			}
		}

		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<small><?php echo $row->id ? 'Editer' : 'Ajouter';?> un batiment</small>
			</th>
		</tr>
		</table>

		<table cellpadding="5" cellspacing="5" class="adminform">
      <tr>
        <th colspan="4"> D&eacute;tails carte </th>
      </tr>
      <tr>
        <td align="left" valign="top"><b> Nom</b></td>
        <td align="left" valign="top">
        <input type="text" name="nom" class="inputbox" size="40" value="<?php echo $row->nom; ?>" maxlength="50" />        </td>
        <td rowspan="8" align="left" valign="top">
          <textarea name="commentaire" cols="40" rows="15" class="inputbox"><?php echo $row->commentaire; ?></textarea>        </td>
        <td rowspan="8" align="left" valign="top"><img style="max-width:300px; max-height:300px;" src="../components/com_mafiajob/images/batiments/<?php echo $row->image; ?>" alt="<?php echo $row->nom; ?>" /></td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Latitude</b></td>
        <td align="left" valign="top">
          <select name="lat" class="inputbox">
			<?php
            echo selectLat(1,28,$row->lat);
            ?>
        </select></td>
      </tr>
			     <tr>
        <td align="left" valign="top"><b>Longitude</b></td>
        <td align="left" valign="top">
          <select name="lng" class="inputbox">
			<?php
            echo selectLng(1,28,$row->lng);
            ?>
          </select></td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Protection</b></td>
        <td align="left" valign="top"><input type="text" class="inputbox" name="protection"  value="<?php echo $row->protection; ?>"/> pts</td>
        </tr>
      <tr>
        <td align="left" valign="top"><b>Caisse</b></td>
        <td align="left" valign="top"><input type="text" class="inputbox" name="coffre"  value="<?php echo $row->coffre; ?>"/> $</td>
        </tr>        
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Image</b></td>
        <td align="left" valign="top"><?php
if ($img = opendir('../components/com_mafiajob/images/batiments')) {

	  echo '<select name="image" class="inputbox">';
	  echo '<option value="'.$row->image.'">'.$row->image.'</option>';

   while (false !== ($fichier = readdir($img))) {
   	  if ($fichier != '.' && $fichier != '..' && $fichier != '.DS_Store') {

   	  echo '<option value="'.$fichier.'">'.$fichier.'</option>';
	  
	  }
	   }
      echo '</select>';
closedir($img);
}
	?></td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap">Xp pour entrer</td>
        <td align="left" valign="top"><input name="xp" type="text" class="inputbox"  value="<?php echo $row->xp; ?>" size="8" maxlength="8"/>
        pts</td>
        </tr>
    </table>
  		<input type="hidden" name="type" value="1" />
		<input type="hidden" name="IdMafiajob" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $task; ?>" />
		</form>
		<?php
	}

	function editarmes( $row , $option, $uid ) 
	{
		global $mosConfig_live_site, $task;
		
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "Vous devez saisir un nom." );
			} else {
				submitform( pressbutton );
			}
		}

		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<small><?php echo $row->id ? 'Editer' : 'Ajouter';?> une arme</small>
			</th>
		</tr>
		</table>

		<table cellpadding="5" cellspacing="5" class="adminform">
      <tr>
        <th colspan="4"> D&eacute;tails arme </th>
      </tr>
      <tr>
        <td align="left" valign="top"><b> Nom</b></td>
        <td align="left" valign="top">
        <input type="text" name="nom" class="inputbox" size="40" value="<?php echo $row->nom; ?>" maxlength="50" />        </td>
        <td rowspan="16" align="left" valign="top">
          <textarea name="commentaire" cols="40" rows="15" class="inputbox"><?php echo $row->commentaire; ?></textarea>        </td>
        <td rowspan="16" align="left" valign="top"><img style="max-width:300px; max-height:300px;" src="../components/com_mafiajob/images/armes/<?php echo $row->image; ?>" alt="<?php echo $row->nom; ?>" /></td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Attaque</b></td>
<td align="left" valign="top"><select name="attaque" class="inputbox">
					<?php
					echo selectNum(1,100,$row->attaque);
					?>
          </select>
pts</td>
      </tr>
			     <tr>
        <td align="left" valign="top"><b>Defense</b></td>
<td align="left" valign="top"><select name="defense" class="inputbox">
					<?php
					echo selectNum(1,100,$row->defense);
					?>
          </select>
pts</td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Munition</b></td>
        <td align="left" valign="top">
          <select name="munition" class="inputbox">
					<?php
					echo selectNum(2,30,$row->munition);
					?>
          </select>        </td>
        </tr>
        
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Prix des munitions</b></td>
        <td align="left" valign="top"><input type="text" class="inputbox" name="prix_munition"  value="<?php echo $row->prix_munition; ?>"/>
$</td>
      </tr>  
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Prix</b></td>
        <td align="left" valign="top"><input type="text" class="inputbox" name="prix_achat"  value="<?php echo $row->prix_achat; ?>"/>
$</td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Magasin</b></td>
<td align="left" valign="top"><select name="idmagasin" class="inputbox">
					<?php
					echo selectBoutique($row->idmagasin , 2);
					?>
          </select></td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Image</b></td>
        <td align="left" valign="top"><?php
if ($img = opendir('../components/com_mafiajob/images/armes')) {

	  echo '<select name="image" class="inputbox">';
	  echo '<option value="'.$row->image.'">'.$row->image.'</option>';

   while (false !== ($fichier = readdir($img))) {
   	  if ($fichier != '.' && $fichier != '..' && $fichier != '.DS_Store') {

   	  echo '<option value="'.$fichier.'">'.$fichier.'</option>';
	  
	  }
	   }
      echo '</select>';
closedir($img);
}
	?>      </td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Xp pour l'acheter</b></td>
        <td align="left" valign="top"><input name="xp" type="text" class="inputbox"  value="<?php echo $row->xp; ?>" size="8" maxlength="8"/>
          pts</td>
        </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Nombre</b></td>
        <td align="left" valign="top"><select name="nombre" class="inputbox">
            <?php
					echo selectNum(1,5,$row->nombre);
					?>
          </select>
          disponible</td>
        </tr>
    </table>
  		<input type="hidden" name="type" value="2" />
		<input type="hidden" name="IdMafiajob" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $task; ?>" />
		</form>
		<?php
	}
	

	function editvoitures( $row , $option, $uid ) 
	{
		global $mosConfig_live_site, $task;
		
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "Vous devez saisir un nom." );
			} else {
				submitform( pressbutton );
			}
		}

		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<small><?php echo $row->id ? 'Editer' : 'Ajouter';?> une voiture</small>
			</th>
		</tr>
		</table>

		<table cellpadding="5" cellspacing="5" class="adminform">
      <tr>
        <th colspan="4"> D&eacute;tails voiture </th>
      </tr>
      <tr>
        <td align="left" valign="top"><b> Nom</b></td>
        <td align="left" valign="top">
        <input type="text" name="nom" class="inputbox" size="40" value="<?php echo $row->nom; ?>" maxlength="50" />        </td>
        <td rowspan="15" align="left" valign="top">
          <textarea name="commentaire" cols="40" rows="15" class="inputbox"><?php echo $row->commentaire; ?></textarea>        </td>
        <td rowspan="15" align="left" valign="top"><img style="max-width:300px; max-height:300px;" src="../components/com_mafiajob/images/voitures/<?php echo $row->image; ?>" alt="<?php echo $row->nom; ?>" /></td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Discretion</b></td>
<td align="left" valign="top"><select name="attaque" class="inputbox">
					<?php
					echo selectNum(1,100,$row->attaque);
					?>
          </select>
pts</td>
      </tr>
			     <tr>
        <td align="left" valign="top"><b>Rapidite</b></td>
<td align="left" valign="top"><select name="defense" class="inputbox">
					<?php
					echo selectNum(1,100,$row->defense);
					?>
          </select>
pts</td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>D&eacute;placement</b></td>
        <td align="left" valign="top">
          <select name="move" class="inputbox">
					<?php
					echo selectNum(10,120,$row->move);
					?>
          </select> 
        s</td>
        </tr>
      <tr>
        <td align="left" valign="top"><b>R&eacute;servoir</b></td>
<td align="left" valign="top">
					<select name="reservoir" class="inputbox">
					<?php
					echo selectNum(20,100,$row->reservoir);
					?>
          </select> 
        l</td>
        </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Prix</b></td>
        <td align="left" valign="top"><input type="text" class="inputbox" name="prix_achat"  value="<?php echo $row->prix_achat; ?>"/>
$</td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Nombre</b></td>
<td align="left" valign="top"><select name="nombre" class="inputbox">
					<?php
					echo selectNum(1,5,$row->nombre);
					?>
          </select> 
          disponible</td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Magasin</b></td>
<td align="left" valign="top"><select name="idmagasin" class="inputbox">
					<?php
					echo selectBoutique($row->idmagasin , 4);
					?>
          </select></td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Image</b></td>
        <td align="left" valign="top"><?php
if ($img = opendir('../components/com_mafiajob/images/voitures')) {

	  echo '<select name="image" class="inputbox">';
	  echo '<option value="'.$row->image.'">'.$row->image.'</option>';

   while (false !== ($fichier = readdir($img))) {
   	  if ($fichier != '.' && $fichier != '..' && $fichier != '.DS_Store') {

   	  echo '<option value="'.$fichier.'">'.$fichier.'</option>';
	  
	  }
	   }
      echo '</select>';
closedir($img);
}
	?></td>
      </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Xp pour l'acheter</b></td>
        <td align="left" valign="top"><input name="xp" type="text" class="inputbox"  value="<?php echo $row->xp; ?>" size="8" maxlength="8"/>
          pts</td>
        </tr>
    </table>
  		<input type="hidden" name="type" value="3" />
		<input type="hidden" name="IdMafiajob" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $task; ?>" />
		</form>
		<?php
	}
	

	function editbots( $row , $option, $uid ) 
	{
		global $mosConfig_live_site, $task;
		
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "Vous devez saisir un nom." );
			} else {
				submitform( pressbutton );
			}
		}

		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<small><?php echo $row->id ? 'Editer' : 'Ajouter';?> un bot</small>
			</th>
		</tr>
		</table>

		<table cellpadding="5" cellspacing="5" class="adminform">
      <tr>
        <th colspan="4"> D&eacute;tails bots </th>
      </tr>
      <tr>
        <td align="left" valign="top"><b> Nom</b></td>
        <td align="left" valign="top">
        <input type="text" name="nom" class="inputbox" size="40" value="<?php echo $row->nom; ?>" maxlength="50" />        </td>
        <td rowspan="12" align="left" valign="top">
          <textarea name="commentaire" cols="40" rows="7" class="inputbox"><?php echo $row->commentaire; ?></textarea>        </td>
        <td rowspan="12" align="left" valign="top"><img style="max-width:300px; max-height:300px;" src="../components/com_mafiajob/images/ennemis/<?php echo $row->image; ?>" alt="<?php echo $row->nom; ?>" /></td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Latitude</b></td>
        <td align="left" valign="top"><?php echo $row->lat ?></td>
      </tr>
			     <tr>
        <td align="left" valign="top"><b>Longitude</b></td>
        <td align="left" valign="top"><?php echo $row->lng ?></td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Protection</b></td>
        <td align="left" valign="top"><input type="text" class="inputbox" name="argent"  value="<?php echo $row->argent; ?>"/> $</td>
        </tr>
      <tr>
        <td align="left" valign="top" nowrap="nowrap"><b>Image</b></td>
        <td align="left" valign="top"><?php
if ($img = opendir('../components/com_mafiajob/images/ennemis')) {

	  echo '<select name="image" class="inputbox">';
	  echo '<option value="'.$row->image.'">'.$row->image.'</option>';

   while (false !== ($fichier = readdir($img))) {
   	  if ($fichier != '.' && $fichier != '..' && $fichier != '.DS_Store') {

   	  echo '<option value="'.$fichier.'">'.$fichier.'</option>';
	  
	  }
	   }
      echo '</select>';
closedir($img);
}
	?></td>
        </tr>
    </table>
  		<input type="hidden" name="type" value="4" />
		<input type="hidden" name="IdMafiajob" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $task; ?>" />
		</form>
		<?php
	}
	function editarticles( $row , $option, $uid ) 
	{
		global $mosConfig_live_site, $task;
		
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<small><?php echo $row->id ? 'Editer' : 'Ajouter';?> un article</small>
			</th>
		</tr>
		</table>

		<table cellpadding="5" cellspacing="5" class="adminform">
      <tr>
        <th colspan="2"> D&eacute;tails article </th>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Type</b></td>
        <td align="left" valign="top">
        
        <select class="inputbox" name="typeArticle" id="typeArticle">
        <option value="1" <?php if($row->type == 1 ) echo 'selected="selected"'; ?> >Victoire : attaque joueur</option>
        <option value="2" <?php if($row->type == 2 ) echo 'selected="selected"'; ?> >Défaite : attaque joueur</option>
        <option value="9" <?php if($row->type == 9 ) echo 'selected="selected"'; ?> >Victoire : vole joueur</option>
        <option value="10" <?php if($row->type == 10 ) echo 'selected="selected"'; ?> >Défaite : vole joueur</option>
        <option value="3" <?php if($row->type == 3 ) echo 'selected="selected"'; ?> >Victoire : braquage</option>
        <option value="4" <?php if($row->type == 4 ) echo 'selected="selected"'; ?> >Défaite : braquage</option>
        <option value="5" <?php if($row->type == 5 ) echo 'selected="selected"'; ?> >Victoire : attaque bot</option>
        <option value="6" <?php if($row->type == 6 ) echo 'selected="selected"'; ?> >Défaite : attaque bot</option>
        <option value="7" <?php if($row->type == 7 ) echo 'selected="selected"'; ?> >Victoire : vole bot</option>
        <option value="11" <?php if($row->type == 11 ) echo 'selected="selected"'; ?> >Dénoncer : joueur</option>
        <option value="8" <?php if($row->type == 8 ) echo 'selected="selected"'; ?> >Mis en prison par un flic</option>
        <option value="12" <?php if($row->type == 12 ) echo 'selected="selected"'; ?> >Achat d'une voiture au parking</option>
        </select>
        </td>
      </tr>
      <tr>
        <td align="left" valign="top"><b>texte</b></td>
        <td align="left" valign="top">Pour placer le nom du joueur mettre : <strong>{joueur}</strong><br />
  Pour placer le nom l'objectif metrre : <strong>{objectif}</strong><br />
Pour placer la date de l'action mettre : <strong>{date}</strong><br />
Pour placer les gain en cas de victoire mettre : <strong>{argent}</strong><br />
Pour placer la position de l'action mettre : <strong>{position}</strong><br />
      <br />          
    <?php editorArea( 'texte',  $row->texte , 'texte', '100%;', '350', '75', '20' ) ; ?></td>
      </tr>
    </table>
  		<input type="hidden" name="type" value="6" />
		<input type="hidden" name="IdMafiajob" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $task; ?>" />
		</form>
<?php
	}
	
	function editjoueurs( $row , $option, $uid ) 
	{
		global $mosConfig_live_site, $task;
		
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "Vous devez saisir un nom." );
			} else {
				submitform( pressbutton );
			}
		}

		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<small><?php echo $row->id ? 'Editer' : 'Ajouter';?> un joueur</small>
			</th>
		</tr>
		</table>

		<table cellpadding="5" cellspacing="5" class="adminform">
      <tr>
        <th colspan="5"> D&eacute;tails du joueur </th>
      </tr>
      <tr>
        <td align="left" valign="top"><b>Identifiant du joueur </b></td>
        <td align="left" valign="top"><?php echo $row->iduser; ?></td>
        <td align="left" valign="top"><b>Identifiant arme</b></td>
        <td align="left" valign="top"><input name="idarme" type="text" disabled="disabled" class="inputbox"  value="<?php echo $row->idarme; ?>" size="3" maxlength="3"/></td>
        <td rowspan="9" align="left" valign="top"><img class="imgBlock" title="Portrait" src="http://ima.minigao.com/l120/p87/<?php echo $row->iduser; ?>.jpg?<?php echo time(); ?>" alt="Portrait" width="100" /></td>
      </tr>
      <tr align="left" valign="top">
        <td><b> Nom</b></td>
        <td><?php echo $row->username; ?></td>
        <td><b>Nombre de muition(s)</b></td>
        <td><select name="munition" class="inputbox">
            <?php
					echo selectNum(0,50,$row->munition);
					?>
        </select></td>
        </tr>
      <tr align="left" valign="top">
        <td><b>Sant&eacute;</b></td>
        <td><select name="vie" class="inputbox">
					<?php
					echo selectNum(0,100,$row->vie);
					?>
          </select> 
          pts</td>
        <td><b>Identifiant voiture</b></td>
        <td><input name="idvoiture" type="text" disabled="disabled" class="inputbox"  value="<?php echo $row->idvoiture; ?>" size="3" maxlength="3"/></td>
        </tr>
      <tr align="left" valign="top">
        <td><b>Attaque</b></td>
        <td><input name="attaque" type="text" disabled="disabled" class="inputbox"  value="<?php echo $row->attaque; ?>" size="3" maxlength="3"/>
pts</td>
        <td><b>R&eacute;servoir</b></td>
        <td><select name="reservoir" class="inputbox">
            <?php
					echo selectNum(0,100,$row->reservoir);
					?>
        </select></td>
      </tr>
      <tr align="left" valign="top">
        <td><b>D&eacute;fense</b></td>
        <td><input name="defense" type="text" disabled="disabled" class="inputbox"  value="<?php echo $row->defense; ?>" size="3" maxlength="3"/>
pts</td>
        <td><b>Identifiant equipe</b></td>
        <td><input name="equipe" type="text" class="inputbox"  value="<?php echo $row->equipe; ?>" size="3" maxlength="3"/></td>
      </tr>
      <tr align="left" valign="top">
        <td><b>Discr&eacute;tion</b></td>
        <td><input name="discretion" type="text" disabled="disabled" class="inputbox"  value="<?php echo $row->discretion; ?>" size="3" maxlength="3"/>
pts</td>
        <td><b>En ligne/Hors ligne</b></td>
        <td><select name="actif">
            <option <?php if( $row->actif == 0 ) echo 'selected="selected"'; ?> value="0">En planque</option>
            <option <?php if( $row->actif == 1 ) echo 'selected="selected"'; ?> value="1">En ligne</option>
        </select></td>
      </tr>
      <tr align="left" valign="top">
        <td><b>Rapidit&eacute;</b></td>
        <td><input name="rapidite" type="text" disabled="disabled" class="inputbox"  value="<?php echo $row->rapidite; ?>" size="3" maxlength="3"/>
pts</td>
        <td><b>Recherch&eacute;</b></td>
        <td><select name="casier">
            <option <?php if( $row->casier == 0 ) echo 'selected="selected"'; ?> value="0">Non</option>
            <option <?php if( $row->casier == 1 ) echo 'selected="selected"'; ?> value="1">Oui</option>
        </select></td>
      </tr>
      <tr align="left" valign="top">
        <td><b>Latitude</b></td>
        <td><select name="lat" class="inputbox">
            <?php
            echo selectLat(2,26,$row->lat);
            ?>
        </select></td>
        <td><b>Exp&eacute;rience</b></td>
        <td><input name="xp" type="text" class="inputbox"  value="<?php echo $row->xp; ?>" size="5" maxlength="5"/>
          pts</td>
      </tr>
      <tr align="left" valign="top">
        <td><b>Longitude</b></td>
        <td><select name="lng" class="inputbox">
            <?php
            echo selectLng(2,26,$row->lng);
            ?>
        </select></td>
        <td><b>Argent</b></td>
        <td><input name="argent" type="text" class="inputbox"  value="<?php echo $row->argent; ?>" size="11" maxlength="11"/>
          $</td>
      </tr>
    </table>
  		<input type="hidden" name="type" value="5" />
		<input type="hidden" name="IdMafiajob" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="<?php echo $task; ?>" />
		</form>
		<?php
	}
}
?>
