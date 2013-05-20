<?php

defined( '_VALID_MOS' ) or die( 'Restriction d\'accès' );


$type = $fonction->Get('type');

switch($type)
{
	case 1 : $sql = '#__wub_armes ORDER BY nom'; break;
	case 2 : $sql = '#__wub_voitures ORDER BY nom'; break;
	case 3 : $sql = "#__wub_batiments WHERE nom != '' ORDER BY nom"; break;
	case 4 : $sql = '#__wub_ennemis ORDER BY nom'; break;
	case 5 : $sql = '#__wub_equipe ORDER BY nom'; break;
}

if($type == 0)
{
	$limit = $fonction->Get( 'limit' );
	if(!$limit) $limit = 5;
	$limitstart = $fonction->Get( 'limitstart' );
	
	$sql = "#__wub_personnage j , #__users u WHERE u.id = j.iduser AND u.activation = '' ORDER BY j.username";
	
	$database->setQuery( "SELECT COUNT(j.iduser) FROM ".$sql );
	require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/pageNavigation.class.php' );
	$pageNav = new mosPageNav(  $database->loadResult(), $limitstart, $limit, 'inventaire'  );
	
	$database->setQuery( "SELECT * FROM ".$sql, $pageNav->limitstart, $pageNav->limit );
	$rows = $database->loadObjectList();
}
else
{
	$database->setQuery("SELECT * FROM ".$sql);
	$rows = $database->loadObjectList();
}

	?>
<h1>Toutes les informations sur le jeu</h1>
	[ <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','type=0');">Perso</a> ] 
  [ <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','type=1');">Arme</a> ] 
  [ <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','type=2');">Voiture</a> ]  
  [ <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','type=3');">Batiment</a> ]  
  [ <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','type=4');">Habitant</a> ] 
  [ <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>','type=5');">Equipe</a> ]
<p align="justify"><img align="left" title="Scores" src="<?php echo $mosConfig_live_site;?>/components/com_mafiajob/images/humeur.png" alt="Scores" width="50" hspace="5"/>Cette page vous permet de conna&icirc;tre toutes les informations concernant le jeu Mafiajob, vous pouvez voir la liste de tous les joueurs de Mafiajob et les mafias auquelle ils appartiennent, voir la liste de tous les habitants de la ville mais aussi la liste des armes et des voitures disponibles sur le jeux et enfin la liste de tous les b&acirc;timents qui se trouve sur la carte.</p>
<?php
switch($type)
{
	case 1 : echo '<div class="componentheading">Armes</div>'; break;
	case 2 : echo '<div class="componentheading">Voitures</div>'; break;
	case 3 : echo '<div class="componentheading">Batiments</div>'; break;
	case 4 : echo '<div class="componentheading">Habitants</div>'; break;
	case 5 : echo '<div class="componentheading">Equipes</div>'; break;
	default : echo '<div class="componentheading">Joueurs actifs sur cette partie</div>'; break;
}

$k = 0;
for ($i=0, $n=count( $rows ); $i < $n; $i++) 
{
	$row 	=& $rows[$i];
	echo '<blockquote id="'.$type.'_'.$row->id.'">';
	?>
  
    <table width="100%" cellspacing="0" cellpadding="5" class="adminlist">
      <tr >
        <td width="20"><?php echo $i+1;?> </td>
        <?php
	
	if($type == 0)
	{
		?>
        <td align="left" valign="top" width="110"><img src="http://ima.minigao.com/l80/p87/<?php echo $row->iduser; ?>.jpg" alt="Photo" width="80" class="imgBlockMod" style="background-color:<?php echo $equipe->CouleurEquipe($row->equipe); ?>" /></td>
        <td align="left" valign="top"><div class="infoaffiche" >
           <h3><?php echo utf8_decode($row->username);?></h3>
            <br />
            <b>Equipe</b> : <?php echo $equipe->NomEquipe($row->equipe); ?><br />
            <b>Commentaire</b> : <?php echo $row->commentaire; ?><br />
            <b>Inscription</b> : <?php echo utf8_decode($fonction->MafDate($row->registerDate)); ?><br />
            <b>Derni&egrave;re visite</b> : <?php echo utf8_decode($fonction->MafDate($row->lastvisitDate)); ?><br />
            <b>Argent</b> : <?php echo number_format($row->argent); ?> $<br />
            <b>Exp&eacute;rience</b> : <?php echo number_format($row->xp); ?> pts</div>
        </td>
        <?php
	}
	else
	{
		?>
        <td  align="left" valign="top" width="110"><?php
		  switch($type)
		{
			case 1 : echo '<img class="imgInfo" src="./components/com_mafiajob/images/armes/'.$row->image.'" width="80" style="border:1px solid #999999; margin:2px; padding:5px;" />'; break;
			case 2 : echo '<img class="imgInfo" src="./components/com_mafiajob/images/voitures/'.$row->image.'" width="80" style="border:1px solid #999999; margin:2px; padding:5px;" />'; break;
			case 3 : echo '<img class="imgInfo" src="./components/com_mafiajob/images/batiments/'.$row->image.'" width="80" style="border:1px solid #999999; margin:2px; padding:5px;" />'; break;
			case 4 : echo '<img class="imgInfo" src="./components/com_mafiajob/images/ennemis/'.$row->image.'" width="80" style="border:1px solid #999999; margin:2px; padding:5px;" />'; break;
			case 5 : echo '<img class="imgInfo" src="./components/com_mafiajob/images/mafia/'.$row->image.'" width="80" style="border:1px solid #999999; margin:2px; padding:5px;" />'; break;
		}
		?>
        </td>
        <td align="left" valign="top"><div class="infoaffiche" >
              <h3><?php  echo $row->nom; ?></h3>
            <?php
		if($type == 4)
		{
		?>
            <table border="0" cellpadding="3" cellspacing="0" width="150">
              <tr>
                <td><b>Sante</b> : <?php echo $fonction->MafBG($row->vie);?>
                  <b>Position</b> : <?php echo $fonction->ConvertLng($row->lng);?> - <?php echo ($row->lat);?><br />
                  <b>Exp&eacute;rience</b> : <?php echo number_format($row->xp);?> pts<br />
                  <b>Humeur</b> : <?php echo ($row->humeur);?><br /></td>
              </tr>
            </table>
            <?php
		}
		elseif($type == 3)
			{
			?>
            <table border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td><b>Position</b> : <?php echo $fonction->ConvertLng($row->lng);?> - <?php echo ($row->lat);?></td>
              </tr>
            </table>
            <?php
		}
		elseif($type == 2)
			{
			?>
            <table border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td width="200"><b>Rapidit&eacute;</b> : <?php echo $row->rapidite; ?>/100 pts</td>
                <td width="200"><b>Consommation</b> : <?php echo $row->consommation; ?> L/100km</td>
              </tr>
              <tr>
                <td width="200"><?php echo $fonction->MafBG($row->rapidite); ?></td>
                <td width="200"><?php echo $fonction->MafBG($row->consommation); ?></td>
              </tr>
              <tr>
                <td width="200"><b>Discr&eacute;tion</b> : <?php echo $row->defense; ?>/100 pts</td>
                <td width="200"><b>Tenue de route</b> : <?php echo $row->tenue_route; ?>/100 pts</td>
              </tr>
              <tr>
                <td width="200"><?php echo $fonction->MafBG($row->defense); ?></td>
                <td width="200"><?php echo $fonction->MafBG($row->tenue_route); ?></td>
              </tr>
            </table>
            <table border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td><b>Exp&eacute;rience pour ce v&eacute;hicule</b> : <?php echo $row->xp; ?> pts</td>
            </tr>
          </table>
            <?php
		}   
		elseif($type == 1)
		{
		?>
            <table border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td width="200"><b>Attaque</b> : <?php echo $row->attaque; ?>/100 pts</td>
              </tr>
              <tr>
                <td width="200"><?php echo $fonction->MafBG($row->attaque); ?></td>
              </tr>
              <tr>
                <td width="200"><b>D&eacute;fense </b>: <?php echo $row->defense; ?>/100 pts</td>
              </tr>
              <tr>
                <td width="200"><?php echo $fonction->MafBG($row->defense); ?></td>
              </tr>
            </table>
            <?php
		}  
		?>
            <b>Commentaire</b> :
            <?php  echo $row->commentaire; ?>
          </div></td>
        <?php
		}
		
		?>
      </tr>
    </table>
  </blockquote>
  <?php if((count( $rows ) - 1) != $i) { ?>
  <div align="right"><img src="./components/com_mafiajob/images/remonter.png" alt="top" align="top" width="15" height="12" /> <a href="javascript:;" onclick="new Effect.ScrollTo('bg-top'); return false;">Remonter en haut de la page</a> - <img src="./components/com_mafiajob/images/retour.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="RetourHisto();">Retour</a></div>
  <?php
	}
	$k = 1 - $k;
}
	
if($type == 0)
		echo $pageNav->getListFooter();
?>
