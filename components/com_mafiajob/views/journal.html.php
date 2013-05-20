<?php
/**
* @version $Id: journal.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafJournalHTML {

	function MafEntete()
	{
		global $config;
		?>
        <h1>Le journal de Mafia City</h1>
		<?php
	}

	function MafLecture ( &$titre, &$texte, &$idEquipe , &$image, &$date ) 
	{
		global $config, $fonction, $equipe;
		
    ?>
  <blockquote>
  <h2><?php echo $titre; ?></h2>
  <img align="left" class="imgBlock" src="<?php echo $config->url; ?>/images/mafia/<?php echo $equipe->ImageEquipe($idEquipe); ?>" alt="Equipe" style="background-color:<?php echo $equipe->CouleurEquipe($idEquipe); ?>;" />
  <img align="left" class="imgBlock" src="<?php echo $image; ?>" alt="Equipe" style="background-color:<?php echo $equipe->CouleurEquipe($idEquipe); ?>;"/>
  <em>Article écrit le : <?php echo  $fonction->MafDate($date); ?></em><br />
        <?php echo $equipe->NomEquipe($idEquipe); ?>
      <p align="justify"><?php echo $texte; ?></p>
  </blockquote>
  <?php
	}
	
	function MafFooter ( &$nav) 
	{
		global $config;
		
		echo '<form action="'.$config->lienTask.'" method="post" name="adminForm">';
		echo $nav; 
		echo '</form>';
	}
}
?>
