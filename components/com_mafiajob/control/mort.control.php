<?php
/**
* @version $Id: mort.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

function mortel ()
{
	global $perso, $persoArme, $persoVoiture;
	
	$perso->vie = 100;
	$perso->mort = 0;
	$perso->casier = 0;
	$perso->xp = 0;
	$perso->actif = 0;
	$perso->idvoiture = false;
	$perso->idarme = false;
	$perso->banque = 0;
	$perso->volevoiture = 0;
	$perso->volearme = 0;
	$perso->voleargent = 0;
	$perso->nbrattaque = 0;
	
	if($perso->MafFlic())
		$perso->equipe = rand (2,3);
		
	$perso->tempsmove = time();
	$perso->tempsplanque = time();
	$perso->RetirerArme();
	$perso->RetirerVoiture();
	$perso->MafAleatoire();
	$perso->MafUpdate();
	$persoArme = false;
	$persoVoiture = false;
}

$sauvegarde = $fonction->Get( 'sauvegarde' );
$gameover = $fonction->Get( 'gameover' );
$formulaire = false;	

//le personnage désire avoir game over
if($gameover)
{
	mortel ();
	$historique->MafAjout( $perso, 70 );
		
		require_once( $config->chemin . '/control/planque.control.php' );
}
//le personnage est désire utiliser une sauvegarde
elseif($sauvegarde)
{
		$my->allopass--;
	
		$perso->vie = 100;
		$perso->mort = 0;
		$perso->casier = 0;
		$perso->xp = round( $perso->xp / 2 );
		$perso->actif = 0;
	
		if($perso->MafFlic())
			$perso->equipe = rand (2,3);
		
		$perso->tempsplanque = time();
		$perso->argent = round( $perso->argent / 2 );
		$perso->MafReplacer();
		$perso->MafUpdate();
		$perso->MafAllopassMAJ();

		$historique->MafAjout( $perso, 71 );
		
		require_once( $config->chemin . '/control/planque.control.php' );
}
//le personnage est en planque
else
{
?>
    <link href="<?php echo $config->url;?>/css/action.mafiajob.css" rel="stylesheet" type="text/css" />
    <h1>GAME OVER</h1>
    <span class="alert">Vous venez de mourir car votre niveau de santé est à 0.</span>
    <p>
    Vous avez la possibilité de ne pas recommencer à zéro. Pour cela il suffit que votre compte de Mafia-pass soit créditeur. Le coût d'une sauvegarde est d'un Mafia-pass. 
    Votre compte de Mafia-pass est de : <?php echo number_format($my->allopass); ?></p><span class="note">Mais votre personnage perdra 50% des points d'expérience et de son argent qu'il possède.</span>
    <form id="form1" name="form1" method="post" action="">
      <input type="submit" name="sauvegarde" id="sauvegarde" class="buttonMaf" value="Je souhaite utiliser un Mafia-pass" /> 
      <input type="submit" name="gameover" id="gameover" class="buttonMaf" value="Je ne souhaite pas utiliser un Mafia-pass" />
    </form>
<?php
}

?>