<?php
/**
* @version $Id: validation.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$valide = $fonction->Get('validejeu');
		
if($valide)
{
		$argent = 0;
		$nbrattaque = 0;
		$volevoiture = 0;
		$volearme = 0;
		$voleargent = 0;
		$error = false;
		$idusers ='';
		$nomusers ='';
		
		//listing de tous les joueurs qui se trouve sur la même position
		$listeJoueurs = $joueurs->SelectionTousJoueurs($perso->lat, $perso->lng);
		
		if($listeJoueurs)
		{
			foreach($listeJoueurs as $joueur)
			{	
				if( $list->equipe == $perso->equipe )
				{
					
					if( $list->iduser != $perso->iduser )
					{
						$participant = new MafPersonnage( $database );
						$participant->MafSelection ( $list->iduser );
					}
					else
						$participant = $perso;
						
					$argent += $participant->argent;
					$nbrattaque += $participant->argent;
					$volevoiture += $participant->argent;
					$volearme += $participant->argent;
					$voleargent += $participant->argent;
					
					if($participant->lat != $participant->lat || $participant->lng != $participant->lng) 
						$error = true;
					if($participant->xp < $config->statAvoirVictoireXp) 
						$error = true;
					if($participant->casier) 
						$error = true;
					if(!$participant->idarme) 
						$error = true;
					if(!$participant->reservoir) 
						$error = true;
					if(!$participant->munition) 
						$error = true;
					if(!$participant->idvoiture) 
						$error = true;
					if(!$participant->actif) 
						$error = true;
					if($participant->timerplanque > (time() - 60)) 
						$error = true;
					if($participant->timermove > (time() - 60)) 
						$error = true;
					if($participant->vie < $config->statAvoirVictoireSante) 
						$error = true;
					
					$idusers .= '|'.$joueur->id;
					$nomusers .= '|'.$joueur->username;		
				}
			}
		}
		
		if(!$error && $argent > $config->statAvoirVictoireArgent)
		{
			
			$query = "INSERT INTO #__wub_victoire ( `idequipe` , `nomequipe` , `iduser` , `username` , `idjoueurs` , `nomjoueurs` , `couleur`, `argent`, `date_crea` , `timer` ) VALUES (  '".$perso->equipe."', '".$equipe->NomEquipe($perso->equipe)."', '".$perso->iduser."', '".$perso->username."', '".$idusers."', '".$nomusers."', '".$equipe->CouleurEquipe($perso->equipe)."', '".$argent."', NOW(), '".time()."' )"; 
	
			$database->setQuery( $query );
			$database->query();
			
			echo '<span class="info">Victoire des : '.$equipe->NomEquipe($perso->equipe)."\n";
			echo '<br />Nom des joueurs : '.$nomusers.'</span>'."\n";
			
		}
		else
		{
			echo '<span class="alert">Défaite des : '.$equipe->NomEquipe($perso->equipe)."\n";
			echo '<br />Nom des joueurs : '.$nomusers.'</span>'."\n";
		}
}
?>
<h2>Vous pouvez v&eacute;rifier que vous avez gagn&eacute; la partie</h2>
<span class="info">Pour gagner, il suffit de respecter ces diff&eacute;rentes obligations.</span> Les conditions :
<ul>
  <li>La mafia doit avoir un capital de <b><?php echo number_format($config->statAvoirVictoireArgent); ?> $</b></li>
  <li><b>Tous les joueurs de la mafia</b> doivent &ecirc;tre <b>actif</b> sur cette case pendant au<b> moins 1 minutes</b></li>
  <li>Aucun joueur <b>ne doit &ecirc;tre recherch&eacute;</b></li>
  <li>Tous les joueurs doivent avoir <b>une arme</b> et <b>une voiture</b></li>
  <li>L'exp&eacute;rience de chaque joueur doit &ecirc;tre supr&eacute;rieur &agrave; <b>500 pts</b></li>
  <li>Avoir une sant&eacute; sup&eacute;rieur &agrave; <b><?php echo number_format($config->statAvoirVictoireSante); ?> pts</b></li>
  <li>Avoir un total d'attaque de joueurs(habitants supérieur à <b><?php echo number_format($config->statAvoirVictoireAttaque); ?> pts</b></li>
  <li>Avoir un total de vole d'argent supérieur à <b><?php echo number_format($config->statAvoirVictoireVoleArgent); ?> pts</b></li>
  <li>Avoir un total de vole d'arme supérieur à <b><?php echo number_format($config->statAvoirVictoireVoleArme); ?> pts</b></li>
  <li>Avoir un total de vole de voiture supérieur à <b><?php echo number_format($config->statAvoirVictoireVoleVoiture); ?> pts</b></li>
  <li>Avoir un total de vente de stupéfiant supérieur à <b><?php echo number_format($config->statAvoirVictoireStupefiant); ?> pts</b></li>
</ul>
<form id="form2" name="form2" method="post" action="">
  <input type="submit" name="validejeu" id="validejeu" class="buttonMaf" value="Je valide la fin de la partie" />
</form>

