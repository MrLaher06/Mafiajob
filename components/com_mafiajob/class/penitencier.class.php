<?php
/**
* @version $Id: penitencier.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafPenitencier extends Mafiajob {
	 
	//fonction qui retourne le temps a effectuer en prison
	function heurePrison($xp = false) 
	{		
		if( $xp <= $this->NiveauXP[0] )
			return $this->tempsPrison[0] * 60;
		elseif( $xp <=  $this->NiveauXP[2] )
			return $this->tempsPrison[1] * 60;
		elseif( $xp <=  $this->NiveauXP[3] )
			return $this->tempsPrison[2] * 60;
		elseif( $xp <=  $this->NiveauXP[4] )
			return $this->tempsPrison[3] * 60;
		elseif( $xp <=  $this->NiveauXP[5] )
			return $this->tempsPrison[4] * 60;
		else
			return $this->tempsPrison[5] * 60;
	}
}
?>