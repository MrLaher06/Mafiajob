<?php
/**
* @version $Id: territoire.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafTerritoire extends Mafiajob {

	/** @var array */
	private $listeCarte = false;

	// initialisation de la class
	function MafTerritoire ( &$db )
	{
		$this->mosDBTable( '#__wub_carte_victoire', 'id', $db );
		$this->MafConfig();	
	}
	
	function MafAfficher()
	{
		global $perso, $equipe;
		
		$Position = array(false);
		$Donnees = array(false);
		
		$this->_db->setQuery( "SELECT * FROM ".$this->_tbl );
		$this->listeCarte = $this->_db->loadObjectList();
	
		if ($this->listeCarte)
		{		
			foreach ( $this->listeCarte as $var )
			{
				array_push($Position,$var->lat.'-'.$var->lng);
				array_push($Donnees,$var);
			}	
		}
				
		echo '<h2>'._TITRE_TERRITOIRE.'</h2>'."\n";
		echo '<blockquote><table widt="100%" border="0" cellspacing="0" cellpadding="5">'."\n";
		echo '<tr>'."\n";
		echo '<td valign="top">'."\n";
		echo '<div class="CarteTableMini" >';
		echo '<table border="0" cellspacing="0" cellpadding="0" id="CarteTableMini">'."\n";
		

		for ($i = 1; $i <= 26; $i++ )
		{
			echo '<tr>'."\n";
			for ($j = 1; $j <= 26; $j++ ) 
			{
				$key = array_search($i.'-'.$j, $Position);

				if($key && $perso->lat != $i && $perso->lng != $j)
				{
					$texteBulle = '<img align=\'left\' class=\'imgBlockInfobulle\' src=\'' . $this->url . '/images/mafia/'.$equipe->ImageEquipe($Donnees[$key]->equipe).'\'/>';
					
					$texteBulle .= $this->MafSprintf(_INFO_BULLE_TERRITOIRE , array('a' => $equipe->NomEquipe($Donnees[$key]->equipe), 'b' => $Donnees[$key]->username, 'c' => $this->MafDate($Donnees[$key]->date) ) );
					echo '<td '.$this->BulleInfo( $texteBulle ).' bgcolor="'.$equipe->CouleurEquipe($Donnees[$key]->equipe).'" class="transparence" >'."\n";
				}
				else
					echo '<td align="center" valign="middle" >'."\n";
					
					if($perso->lat == $i && $perso->lng == $j)
						echo '<blink><span class="position">'._POSITION_TERRITOIRE.'</span></blink>';
																
				echo '</td>'."\n";
			}
			echo '</tr>'."\n";
		}
		echo '</table>'."\n";
		
		
		echo '</div>';
		echo '<div id="lienTerritoire"><a href="javascript:;" onclick="Effect.toggle(\'CarteTableMini\',\'appear\');">'._MASQUE_INFO_TERRITOIRE.'</a></div>';
		
		echo '</td>'."\n";
		echo '<td valign="top"><span class="rouge"><b>'._LEGENDE_EQUIPE_TERRITOIRE.'</b></span>'."\n";	
		
		echo '<table border="0" cellspacing="5" cellpadding="0">'."\n";		
		foreach ( $equipe->Equipes as $var )
		{	
				echo '<tr>'."\n";	
				echo '<td class="tdlegende"><img src="'.$this->url.'/images/mafia/'.$var->image.'" width="20" height="20" /></td>'."\n";	
				echo '<td class="tdlegende" bgcolor="'.$var->couleur.'" width="20">&nbsp;</td>'."\n";	
				echo '<td>'.$var->nom.'</td>'."\n";	
				echo '</tr>'."\n";	
		}
		echo '</table>'."\n";
		echo '</td>'."\n";	
		echo '</tr>'."\n";
		echo '</table></blockquote>'."\n";
	}
	
	// fonction info bulle destiner à la page territoire
	function BulleInfo($donnee=false, $taille=250) 
	{
		return 'onmouseover="overlib(\''.addslashes($donnee).'\', WIDTH,'.$taille.', TEXTSIZE, \'10px\', FGCOLOR, \'#FFFFCC\', BGCOLOR, \'#990000\', ABOVE)" onmouseout="return nd();"';
	}
}
?>