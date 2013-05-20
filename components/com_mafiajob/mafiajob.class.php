<?php
/**
* @version $Id: mafiajob.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class Mafiajob extends MafConfig
{	
	/*
		Function pour convertir la longitude par un symbole
	*/
	function ConvertLng( $lng = false )
	{
		return chr( $lng+64 );
	}
	
	/*
		Function pour convertir le temps qui est en seconde
	*/
	function ConvertirTemps( $temps , $sanstime = false )
	{
		$seconde = $temps;

		if(!$sanstime)
			$seconde = time() - $temps;
		
		if( $seconde < 60 )
			return $seconde . ' s';
		elseif( $seconde < 3600 )
			return floor ( $seconde/60 ) . ' min';
		elseif($seconde < 86400)
			return floor ( $seconde/60/60 ) . ' h';
		else
			return floor ( $seconde/60/60/24 ) . ' j';
	}
	
	/*
		Function pour permettre de mettre les stat joueur sous forme graphique
	*/
	function MafBG( $valeur )
	{
		return '<div class=\'conteneurGraphique\'><div class=\'contenuGraphique\' style=\'width:' . $valeur . '%;\'></div></div>';
	}
	
	/*
		Function pour convertir la date
	*/
	function MafDate( $date = false )
	{
		return mosFormatDate ( $date, '%A %d %B %Y - %H:%M:%S' ) ;
	}
	
	/*
		Function pour couper une chaine de caractere
	*/
	function tronque($str, $nb = 150) 
	{
		if (strlen($str) > $nb) 
		{
			$str = substr($str, 0, $nb);
			$position_espace = strrpos($str, ' ');
			$texte = substr($str, 0, $position_espace); 
			$str = $str.'...';
		}
		return $str; 
	}
	
	/*
		Function recup le pourcentage du personnage par rapport a une valeur
	*/
	function MoyennePourcentage($valeur = false, $max = false) 
	{
		if($max == $valeur)
			return 100;
		elseif($valeur == 0)
			return 0;
		else
			return ( 100 / ( $max / $valeur) ); 
	}
	
	/*
		Function pour recuperer les get ou post
	*/
	function Get( $nom = false )
	{
		return strtolower( strval( mosGetParam( $_REQUEST, $nom ) ) );
	}
	
	/*
		Function pour stringer  si actif ou pas
	*/
	function etatJoueurJeu ($actif=false)
	{
		if($actif)
			return 'Actif sur le jeu';
		else
			return 'Pas actif sur le jeu (en planque)';
	}
	
	/*
		Function pour placer des variable dans un defined
	*/
	function MafSprintf($str='', $vars=array(), $char='%')
	{
		if (!$str) return '';
		if (count($vars) > 0)
		{
			foreach ($vars as $k => $v)
			{
				$str = str_replace($char . $k, $v, $str);
			}
		}
	
		return $str;
	}
	
	/*
		Function pour placer des variable dans un defined
	*/
	function Mafip ( &$ip )
	{
		global $database;
		
		$query = "SELECT id FROM #__wub_personnage WHERE ip = '".$ip."' LIMIT 1";

		$database->setQuery( $query );
		$ip = $database->loadObjectList();
		if($ip)
			return true;
		else
			return false;
	}
	
	/*
		Function pour pour placer des variable dans un defined
	*/
	function MafMailEnvois($to = false, $message = false, $subject  = false) 
	{
		global $my, $config;
			
		// cl&eacute; al&eacute;atoire de limite
		$boundary = md5(uniqid(microtime(), true));
		
		// Headers
		$headers = 'From: '.$my->email.' <'.$my->email.'>'."\r\n";
		$headers .= 'Mime-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: multipart/mixed;boundary='.$boundary."\r\n";
		$headers .= "\r\n";
		
		// Message HTML
		$monhtml = file_get_contents($config->url .'/views/mail.html.php');
		$monhtml = str_replace('{message}', $message, $monhtml);
	
	
		$msg = '--'.$boundary."\r\n";
		$msg .= 'Content-type: text/html; charset=utf-8'."\r\n\r\n";
		$msg .= $monhtml;		
		
		// Function mail()
		if(mail($to, $subject, $msg, $headers))
			return true;
		else
			return false;
	}
	// function qui gere la mise a jour de la ville (vente de drogue et ennemis automatique)
	function selectmaj()
	{
		global $database, $config;

		$database->setQuery( "SELECT timer FROM #__wub_maj ORDER BY id DESC LIMIT 1" );
		$maj = $database->loadObjectList();
		
		$database->setQuery( "INSERT INTO #__wub_maj ( `timer` ) VALUES ( '".( time() + $config->delaiMAJBot )."'  )" );

		if($maj)
		{
			if( $maj[0]->timer < time() )
			{		
				if($database->query())
					return true;
				else
					return false;
			}
			else
				return false;
		}
		else
		{
			$database->query();
			return false;
		}
	}
}
?>