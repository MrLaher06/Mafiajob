<?php
/**
* @version $Id: planque.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$SortirPlanque = $fonction->Get( 'SortirPlanque' );

//le personnage désire sortir de la planque
if($SortirPlanque)
{
	if( $perso->sortirPlanquer() )
	{
		if( !rand(0,3) )
		{
			require_once( $config->chemin . '/class/bot.class.php' );
			
			$bot = new MafBot( $database );
			$listeBots = $bot->SelectionTous();
			
			foreach ( $listeBots as $list )
			{
				$bot->LeBot = $list;
				$bot->Replacer( false, true, true, false, true, true, true);
			}
		}

		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 10 );
	}
	require_once( $config->chemin . '/control/' . $config->fichierdefault );
}
//le personnage est en planque
else
{
	if( $perso->entrerPlanquer() )
	{
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 9 );
	}
	
	//on verifi si le personnage est ou non sur la page de la carte
	if($task != 'carte')
	{
		//on verfi que le personnage n'a pas d'action en cours sinon on les supprime
		require_once( $config->chemin . '/class/plusieurs.class.php' );
	
		$action = new MafPlusieurs( $database );
		$action->MafDeleteAction( $perso->iduser , 1);
		
		//on affiche la page planque
		require_once( $config->chemin . '/views/personnage.html.php' );
		$html = new MafPersonnageHTML();
		$html->planque( $perso->tempsplanque );
	}
	//sinon on affiche les 2 liens ci-dessous
	else
	{
	?>
        <script type="text/javascript"> window.close(); </script>
    <?php
	}

}

?>