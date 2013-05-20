<?php
/**
* @version $Id: commissariat.html.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );


class MafFlicHTML {

	function menu()
	{
		global $config;
		?>

<ul>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=armes');">Voir l'armurie du commissariat</a></li>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=voitures');">Voir le garage du commissariat</a></li>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=nbrattaque');">Voir le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui provoquent le plus d'attaque</a></li>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=stupefiant');">Voir le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui provoquent le plus de ventes de stupéfiants</a></li>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=voleargent');">Voir le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui provoquent le plus de voles d'argent</a></li>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=volearme');">Voir le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui provoquent le plus de voles d'armes</a></li>
  <li><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>&choix=volevoiture');">Voir le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui provoquent le plus de voles de voitures</a></li>
</ul>
<?php
	}

	function titre1()
	{
	?>
<h2>Bienvenue dans votre quartier général</h2>
<?php
	}

	function titre2()
	{
		global $config;
	?>
<h3>Le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui attaquent le plus de joueurs et d'habitants</h3>
<?php
	}

	function titre3()
	{
		global $config;
	?>
<h3>Le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui vendent le plus de drogues</h3>
<?php
	}

	function titre4()
	{
		global $config;
	?>
<h3>Le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui volent le plus d'argent</h3>
<?php
	}

	function titre5()
	{
		global $config;
	?>
<h3>Le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui volent le plus d'armes</h3>
<?php
	}

	function titre6()
	{
		global $config;
	?>
<h3>Le top <?php echo $config->nombreTopRechercheFlic; ?> des joueurs qui volent le plus de voitures</h3>
<?php
	}

	function revenir()
	{
		global $config;
	?>
<a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>');">Revenir dans l'établissement</a>
<?php
	}

	function titre7()
	{
	?>
<h2>Liste des flics de la ville</h2>
<?php
	}

	function embauche( $nbrflic = false)
	{
		global $config, $perso;
	?>
<h2>La police embauche de nouvelle recrue</h2>
<?php 
    if($perso->casier)
    {
    ?>
<span class="alert">Tu es recherché par la police ce qui veut dire que tu ne peux pas être embauché pour devenir flic.<br />
Il ne faut pas avoir de casier judiciaire pour entrer dans la police.</span>
<?php
    }
    ?>
A l'heure actuelle la ville de Mafiajob compte <?php echo $nbrflic; ?> policier(s) actif(s).<br />
Voici les règles en tant que flic :
<ul>
  <li>Tu peux faire tout ce que fait un joueur</li>
  <li>Tu peux etre recherché en cas de délit et finir au pénitencier si quelqu'un te dénonce</li>
</ul>
<form id="form1" name="form1" method="post" action="<?php echo $config->lienTask; ?>">
  <input type="button" name="devenirpolice" id="devenirpolice" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'devenirpolice=true');" class="buttonMaf" value="Je souhaite devenir un policier" />
</form>
<br />
<?php
	}
	
	function flicReussi( )
	{
		global $config, $perso;
	?>
<span class="info">Tu es entré dans la police. Tu dois désormais faire appliquer la loi sur Mafiajob</span>
<?php
    }
	
	function flicEchec( )
	{
		global $config, $perso;
	?>
<span class="alert">Tu n'es pas entré dans la police, tu as peut-être un casier judiciaire ou tu es peut être un chef d'équipe.</span>
<?php
    }
}
?>
