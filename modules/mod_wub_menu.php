<?php
/**
* @version $Id: mod_wub_joueur.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

global $option, $Itemid, $mosConfig_live_site, $perso, $config;

?>

<ul class="menuside">
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=action&no_html=1');">Action</a></li>
<li class="bg0"><a href="javascript:;" onclick="javascript: window.open('<?php echo $config->lienAjax; ?>&task=carte', 'Carte', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=780,height=560'); return false;">Carte</a></li>
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=equipe&no_html=1');">Equipe</a></li>
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=drogue&no_html=1');">Drogue</a></li>
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=information&no_html=1');">Information</a></li>
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=historique&no_html=1');">Historique</a></li>
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=inventaire&no_html=1');">Inventaire</a></li>
<li class="bg0"><a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>&task=planque&no_html=1');">Planque</a></li>
</ul>