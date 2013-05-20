<?php
/**
* @version $Id: carte.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafCarteHTML {

	//fonction qui gere l affichage d'un batiment
	function blocBatiment ($element = false)
	{
		global $config, $fonction;
		
		if($element->acces)
		{

		$infobulle = '<table border=\'0\' cellpadding=\'0\' cellspacing=\'0\'>';
		$infobulle .= '<tr><td>';
		
		$infobulle .= '<img align=\'left\' class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/batiments/miniatures/'.$element->image.'\'/>';
				
		$infobulle .= '<b>Protection :</b> ' . $element->protection . ' pts<br />';
		
		$infobulle .= $fonction->tronque($element->commentaire, 60);
		$infobulle .= '</td> </tr>';
		$infobulle .= '</table>';
			
		return '<img ' . $this->Bulle('Le batiment : ' . $element->nom, htmlentities($infobulle)) . ' src="' . $config->url . '/images/batiments/miniatures/'.$element->image.'" alt="'.$element->nom.'" class="ImgBlocCarteBatiment" />';
		}
		else
			return '<img src="' . $config->url . '/images/space.gif" alt="space" />';
	}

	//fonction qui gere l affichage d'un bot
	function blocJoueurSimple ($element = false, $class = false, $nbr = false, $arme = false, $voiture = false)
	{
		global $config, $fonction, $equipe;
		
		$armeBot = $arme->Retrouver ($element->idarme);
		$voitureBot = $voiture->Retrouver ($element->idvoiture);

		$infobulle = '<table border=\'0\'>';
		$infobulle .= '<tr><td>';
		
		$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'http://ima.minigao.com/l80/p87/'.$element->iduser.'.jpg?'.time().'\'/>';
		
		if($armeBot)
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/'.$armeBot->image.'\'/>';
		else
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/aucunBot.jpg\'/>';

		if($voitureBot)
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/'.$voitureBot->image.'\'/>';
		else
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/aucunBot.jpg\'/>';
	
		$infobulle .= '</td></tr>';
		$infobulle .= '<tr><td>';
		$infobulle .= '<b>Expérience :</b> ' . number_format($element->xp) . ' pts<br />';
		$infobulle .= '<b>Equipe :</b> ' . $equipe->NomEquipe($element->equipe) . '<br />';
		$infobulle .= $fonction->tronque($element->commentaire, 50);
		$infobulle .= '</td> </tr>';
		$infobulle .= '</table>';
		
		$display = '<img ' . $this->Bulle( $element->username, htmlentities($infobulle)) . ' src="http://ima.minigao.com/l80/p87/'.$element->iduser.'.jpg?'.time().'" alt="'.$element->username.'" class="ImgBlocCarte" />';
		return $display;
	}
	
	//fonction qui gere l affichage de plusieur bots
	function blocJoueurMulti ($elements = false, $class = false, $nbr = false, $arme = false, $voiture = false)
	{
		global $config, $fonction, $equipe;
		
		$infobulle = '';
	
		for($k = 0; $k< count($elements); $k++)
		{			
			$element = $elements[$k];
			
			$armeBot = $arme->Retrouver ($element->idarme);
			$voitureBot = $voiture->Retrouver ($element->idvoiture);
			
			if(empty($element->nom))
			{
				$nom = $element->username;
				$image = 'avatars';
			}
			else
			{
				$nom = $element->nom;
				$image = 'ennemis/miniatures';
			}

			$infobulle .= '<table border=\'0\'>';
			$infobulle .= '<tr><td>';
			$infobulle .= '<b>' . $nom . '</b>';
			$infobulle .= '</td> </tr>';
			$infobulle .= '<tr><td>';
			
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/'.$image.'/'.$element->image.'\'/>';
			
			if($armeBot)
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/'.$armeBot->image.'\'/>';
			else
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/aucunBot.jpg\'/>';

			if($voitureBot)
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/'.$voitureBot->image.'\'/>';
			else
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/aucunBot.jpg\'/>';
			
			$infobulle .= '</td></tr>';
			$infobulle .= '<tr><td>';
			$infobulle .= '<b>Expérience :</b> ' . number_format($element->xp) . ' pts<br />';
			$infobulle .= '<b>Equipe :</b> ' . $equipe->NomEquipe($element->equipe) . '<br />';
			$infobulle .= $fonction->tronque($element->commentaire, 50);
			$infobulle .= '</td> </tr>';
			$infobulle .= '</table>';
		}
		
		$display = '<img ' . $this->Bulle('Il y a ' . $nbr . ' habitants',htmlentities($infobulle)) . ' src="' . $config->url . '/images/batiments/multibot.jpg" alt="multibot" class="ImgBlocCarte" />';
			
		return $display;
	}

	//fonction qui gere l affichage d'un bot
	function blocBotSimple ($element = false, $class = false, $nbr = false, $arme = false, $voiture = false)
	{
		global $config, $fonction;
		
		$armeBot = $arme->Retrouver ($element->idarme);
		$voitureBot = $voiture->Retrouver ($element->idvoiture);

		$infobulle = '<table border=\'0\'>';
		$infobulle .= '<tr><td>';
		
		$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/ennemis/miniatures/'.$element->image.'\'/>';
		
		if($armeBot)
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/'.$armeBot->image.'\'/>';
		else
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/aucunBot.jpg\'/>';

		if($voitureBot)
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/'.$voitureBot->image.'\'/>';
		else
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/aucunBot.jpg\'/>';
	
		$infobulle .= '</td></tr>';
		$infobulle .= '<tr><td>';
		$infobulle .= '<b>Expérience :</b> ' . number_format($element->xp) . ' pts<br />';
		$infobulle .= '<b>Humeur :</b> ' . $class->Humeur( $element->humeur ) . ' <br />';
		$infobulle .= $fonction->tronque($element->commentaire, 50);
		$infobulle .= '</td> </tr>';
		$infobulle .= '</table>';
		
		$display = '<img ' . $this->Bulle('Habitant : ' . $element->nom, htmlentities($infobulle)) . ' src="' . $config->url . '/images/ennemis/miniatures/'.$element->image.'" alt="'.$element->nom.'" class="ImgBlocCarte" width="48" height="48" />';
		return $display;
	}
	
	//fonction qui gere l affichage de plusieur bots
	function blocBotMulti ($elements = false, $class = false, $nbr = false, $arme = false, $voiture = false)
	{
		global $config, $fonction;
		
		$infobulle = '';
	
		for($k = 0; $k< count($elements); $k++)
		{			
			$element = $elements[$k];
			
			$armeBot = $arme->Retrouver ($element->idarme);
			$voitureBot = $voiture->Retrouver ($element->idvoiture);

			$infobulle .= '<table border=\'0\'>';
			$infobulle .= '<tr><td>';
			$infobulle .= '<b>' . $element->nom . '</b>';
			$infobulle .= '</td> </tr>';
			$infobulle .= '<tr><td>';
			
			$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/ennemis/'.$element->image.'\'/>';
			
			if($armeBot)
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/'.$armeBot->image.'\'/>';
			else
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/armes/aucunBot.jpg\'/>';

			if($voitureBot)
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/'.$voitureBot->image.'\'/>';
			else
				$infobulle .= '<img class=\'PhotoBotCarteBulle\' alt=\'image\' src=\'' . $config->url . '/images/voitures/aucunBot.jpg\'/>';
			
			$infobulle .= '</td></tr>';
			$infobulle .= '<tr><td>';
			$infobulle .= '<b>Expérience :</b> ' . number_format($element->xp) . ' pts<br />' . $fonction->tronque($element->commentaire, 50);
			$infobulle .= '</td> </tr>';
			$infobulle .= '</table>';
		}
		
		$display = '<img ' . $this->Bulle('Il y a ' . $nbr . ' habitants',htmlentities($infobulle)) . ' src="' . $config->url . '/images/batiments/multibot.jpg" alt="multibot" class="ImgBlocCarte" />';
			
		return $display;
	}
	
	//fonction qui gere l affichage de son personnage
	function blocPersonnage ($element = false, $user = false, $batiment = false)
	{
		global $fonction, $config;
		
		$puissance = $fonction->MoyennePourcentage( $element->puissance, $element->SelectionMeilleurPuissance ( ) ); 
		$intelligence = $fonction->MoyennePourcentage( $element->intelligence, $element->SelectionMeilleurIntelligence ( ) ); 
		$visibilite = $fonction->MoyennePourcentage( $element->visibilite, $element->SelectionMeilleurVisibilite ( ) ); 
		
		$infobulle = '<table border=\'0\' cellspacing=\'0\' cellpadding=\'0\' class=\'TableauInfoJoueurCarte\' >';
		$infobulle .= '<tr>';
		$infobulle .= '<td ><b>Santé</b></td>';
		$infobulle .= '<td >'.$element->vie.'/100 pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($element->vie).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Attaque</b></td>';
		$infobulle .= '<td >'.$element->attaque.'/100 pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($element->attaque).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Défense</b></td>';
		$infobulle .= '<td >'.$element->defense.'/100 pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($element->defense).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Discrétion</b></td>';
		$infobulle .= '<td >'.$element->discretion.'/100 pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($element->discretion).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Rapidité</b></td>';
		$infobulle .= '<td >'.$element->rapidite.'/100 pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($element->rapidite).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Puissance</b></td>';
		$infobulle .= '<td >'. $element->puissance .'/'.$element->SelectionMeilleurPuissance ( ).' pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($puissance).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Intelligence</b></td>';
		$infobulle .= '<td >'. $element->intelligence .'/'.$element->SelectionMeilleurIntelligence ( ).' pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($intelligence).'</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td ><b>Visibilité</b></td>';
		$infobulle .= '<td >'. $element->visibilite .'/'.$element->SelectionMeilleurVisibilite ( ).' pts</td>';
		$infobulle .= '</tr><tr>';
		$infobulle .= '<td colspan=\'2\' >'.$fonction->MafBG($visibilite).'</td>';
		$infobulle .= '</tr>';
		$infobulle .= '</table>';
		
		if($batiment && $fonction->Get('RefreshCarte') != 'refresh')			
		{
			$display = '<div class="CarteJoueur"><img src="' . $config->url . '/images/batiments/miniatures/'.$batiment->image.'" alt="'.$batiment->nom.'" class="ImgBlocCarteBatiment" /></div><div class="CarteDiv"><div id="MonPersonnage" class="CarteJoueur" style="display:none;" ><img ' . $this->Bulle('Vos informations',htmlentities($infobulle), 160, false, true) . ' src="http://ima.minigao.com/l80/p87/'.$element->iduser.'.jpg?'.time().'" alt="'.$user->username.'" class="ImgBlocCarteJoueur" /></div></div>';
			
			$display .= '<script type="text/javascript">'."\n";
			$display .= '<!--'."\n";
			$display .= 'Effect.Appear(\'MonPersonnage\');'."\n";
			$display .= '-->'."\n";
			$display .= '</script>'."\n";
		}
		else
		$display = '<div class="CarteDiv"><div id="MonPersonnage" class="CarteJoueur" ><img ' . $this->Bulle('Vos informations',htmlentities($infobulle), 160, false, true) . ' src="http://ima.minigao.com/l80/p87/'.$element->iduser.'.jpg?'.time().'" alt="'.$user->username.'" class="ImgBlocCarteJoueur" /></div></div>';

		return $display;
						
	}
	
	// fonction info bulle
	function Bulle($titre=false, $donnee=false, $taille=210, $couleur=false, $onclick=false) 
	{
		if(!$couleur)
			$couleur = '#990000';
			
		if($titre && $donnee && !$onclick)
			return 'onmouseover="infobulle(\''.addslashes($titre).'\', \''.addslashes($donnee).'\', '.$taille.', \''.$couleur.'\') " onmouseout="return nd();"';
			
		elseif($titre && $donnee && $onclick)
			return 'onclick="infobulle(\''.addslashes($titre).'\', \''.addslashes($donnee).'\', '.$taille.', \''.$couleur.'\') " onmouseout="return nd();"';
			
		else
			return false;
	}

	// fonction qui genere les appel du javascript et du css pour la carte
	function entete()
	{
		global $mosConfig_live_site, $config;
		
		?>
        <!--[if IE]>
           <style type="text/css">
           /*<![CDATA[*/  
			.ImgBlocCarteJoueur{margin-left:-55px};
           /*]]>*/
           </style>
        <![endif]--> 
    <?php
		$this->CompteurScript();
	}

	// fonction qui genere la reactualisation ajax
	function Refresh()
	{
		global $Itemid, $config;
	?>
        <script type="text/javascript">
		<!--
		setInterval("CarteAjax('index2.php?option=com_mafiajob&Itemid=<?php echo $Itemid;?>&task=carte', 'ajax=actualiser')",<?php echo $config->delaiRefreshCarte;?>);
        -->
        </script>
    <?php
	}

	// fonction qui genere la reactualisation ajax
	function CompteurScript($actif = 0)
	{
		global $perso;
		?>
        <script type="text/javascript"> 
		<!--
		Init(); 
        -->
        </script>
    <?php
	}	
}
?>