<?php
/**
* @version $Id: pageNavigation.class.php,v 5 01/07/2008 00:00:00 akede Exp $
* @package Wubart Moteur de recherche
* @copyright (C) 2008 Alban PASQUELIN
* @license Wubart
* Site web : http://www.wubart.net
* E-mail : contact@wubart.net
*/

defined( '_VALID_MOS' ) or die( 'Page interdite' );

class mosPageNav {

	public $limitstart = null;

	public $limit 		= null;

	public $total 		= null;

	public $type;

	public function mosPageNav( $total, $limitstart, $limit, $type = false ) 
	{
		$this->total 		= (int) $total;
		$this->limitstart 	= (int) max( $limitstart, 0 );
		$this->limit 		= (int) max( $limit, 1 );
		$this->type 		= $type;
		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}
		if (($this->limit-1)*$this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}
	
	public function getLimitBox () 
	{
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) 
			$limits[] = mosHTML::makeOption( "$i" );
		
		$limits[] = mosHTML::makeOption( "50" );
		$limits[] = mosHTML::makeOption( "100" );

		$html = mosHTML::selectList( $limits, 'limit', 'class="inputbox" id="limit" size="1" onchange="pageNavigation(null,\''.$this->type.'\');"','value', 'text', $this->limit );
		$html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"$this->limitstart\" />";
		
		return $html;
	}
	
	public function writeLimitBox () 
	{
		echo mosPageNav::getLimitBox();
	}
	
	public function writePagesCounter() 
	{
		echo $this->getPagesCounter();
	}
	
	public function getPagesCounter() 
	{
		$html = "\nAucun Enregistrement.";
		$from_result = $this->limitstart+1;
		
		if ($this->limitstart + $this->limit < $this->total)
			$to_result = $this->limitstart + $this->limit;
		else
			$to_result = $this->total;

		if ($this->total > 0)
			$html = "\nResultats " . $from_result . " - " . $to_result . " de " . $this->total;

		return $html;
	}
	
	public function writePagesLinks() 
	{
		echo $this->getPagesLinks();
	}
	
	public function getPagesLinks() 
	{
		$html 				= '';
		$displayed_pages 	= 10;
		$total_pages 		= ceil( $this->total / $this->limit );
		$this_page 			= ceil( ($this->limitstart+1) / $this->limit );
		$start_loop 		= (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		
		if ($start_loop + $displayed_pages - 1 < $total_pages)
			$stop_loop = $start_loop + $displayed_pages - 1;
		else
			$stop_loop = $total_pages;

		if ($this_page > 1) 
		{
			$page = ($this_page - 2) * $this->limit;
			$html .= "\n<a href=\"javascript:;\" class=\"pagenav\" title=\"first page\" onclick=\"pageNavigation(0,'".$this->type."');\">&lt;&lt;&nbsp;Première</a>";
			$html .= "\n<a href=\"javascript:;\" class=\"pagenav\" title=\"previous page\" onclick=\"pageNavigation('$page','".$this->type."');\">&lt;&nbsp;Précédente</a>";
		} 
		else 
		{
			$html .= "\n<span class=\"pagenav\">&lt;&lt;&nbsp;Première</span>";
			$html .= "\n<span class=\"pagenav\">&lt;&nbsp;Précédente</span>";
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) 
		{
			$page = ($i - 1) * $this->limit;
			
			if ($i == $this_page)
				$html .= "\n<span class=\"pagenav\"> $i </span>";
			else
				$html .= "\n<a href=\"javascript:;\" class=\"pagenav\" onclick=\"pageNavigation('$page','".$this->type."');\"><strong>$i</strong></a>";
		}

		if ($this_page < $total_pages) 
		{
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$html .= "\n<a href=\"javascript:;\" class=\"pagenav\" title=\"next page\" onclick=\"pageNavigation('$page','".$this->type."');\"> Suivante&nbsp;&gt;</a>";
			$html .= "\n<a href=\"javascript:;\" class=\"pagenav\" title=\"end page\" onclick=\"pageNavigation('$end_page','".$this->type."');\"> Dernière&nbsp;&gt;&gt;</a>";
		} 
		else 
		{
			$html .= "\n<span class=\"pagenav\">Suivante&nbsp;&gt;</span>";
			$html .= "\n<span class=\"pagenav\">Dernière&nbsp;&gt;&gt;</span>";
		}
		
		$html = '<div align="center">'.$html.'</div>';
		
		return $html;
	}

	public function getListFooter() 
	{
		$html = '<table class="adminlist"><tr><th colspan="3">';
		$html .= $this->getPagesLinks();
		$html .= '</th></tr><tr>';
		$html .= '<td nowrap="nowrap" width="48%" align="right">Eléments par page</td>';
		$html .= '<td>' .$this->getLimitBox() . '</td>';
		$html .= '<td nowrap="nowrap" width="48%" align="left">' . $this->getPagesCounter() . '</td>';
		$html .= '</tr></table>';
  	
		return $html;
	}
	
	public function rowNumber( $i ) 
	{
		return $i + 1 + $this->limitstart;
	}
	
	public function orderUpIcon( $i, $condition=true, $task='orderup', $alt='En Haut' ) 
	{
		if (($i > 0 || ($i+$this->limitstart > 0)) && $condition)
			return '<a href="#reorder" onClick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'"><img src="images/uparrow.png" width="12" height="12" border="0" alt="'.$alt.'"></a>';
  	else
  		return '&nbsp;';
	}
	
	public function orderDownIcon( $i, $n, $condition=true, $task='orderdown', $alt='En Bas' ) 
	{
		if (($i < $n-1 || $i+$this->limitstart < $this->total-1) && $condition) 
			return '<a href="#reorder" onClick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'"><img src="images/downarrow.png" width="12" height="12" border="0" alt="'.$alt.'"></a>';
  	else
  		return '&nbsp;';
	}
	
	public function orderUpIcon2( $id, $order, $condition=true, $task='orderup', $alt='#' ) 
	{
		if ($alt = '#')
			$alt = 'En Haut';

		if ($order == 0) 
		{
			$img = 'uparrow0.png';
			$show = true;
		} 
		elseif($order < 0) 
		{
			$img = 'uparrow-1.png';
			$show = true;
		} 
		else 
		{
			$img = 'uparrow.png';
			$show = true;
		}
		
		if ($show) 
		{
			$output = '<a href="#ordering" onClick="listItemTask(\'cb'.$id.'\',\'orderup\')" title="'. $alt .'">';
			$output .= '<img src="images/' . $img . '" width="12" height="12" border="0" alt="'. $alt .'" title="'. $alt .'" /></a>';
			return $output;
   	} 
		else
  		return '&nbsp;';
	}
	
	public function orderDownIcon2( $id, $order, $condition=true, $task='orderdown', $alt='#' ) 
	{
		if ($alt = '#')
			$alt = 'En Bas';

		if ($order == 0) 
		{
			$img = 'downarrow0.png';
			$show = true;
		} 
		elseif($order < 0) 
		{
			$img = 'downarrow-1.png';
			$show = true;
		} 
		else 
		{
			$img = 'downarrow.png';
			$show = true;
		}
		
		if ($show) 
		{
			$output = '<a href="#ordering" onClick="listItemTask(\'cb'.$id.'\',\'orderdown\')" title="'. $alt .'">';
			$output .= '<img src="images/' . $img . '" width="12" height="12" border="0" alt="'. $alt .'" title="'. $alt .'" /></a>';

			return $output;
		}
  	else
  		return '&nbsp;';
	}
	
	public function setTemplateVars( &$tmpl, $name = 'admin-list-footer' ) 
	{
		$tmpl->addVar( $name, 'PAGE_LINKS', $this->getPagesLinks() );
		$tmpl->addVar( $name, 'PAGE_LIST_OPTIONS', $this->getLimitBox() );
		$tmpl->addVar( $name, 'PAGE_COUNTER', $this->getPagesCounter() );
	}
}
?>