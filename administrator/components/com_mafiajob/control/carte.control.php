    <?php
	
if(isset($_POST['validation']))
{
	// $i = latitude
	for ( $i = 1; $i <= 26; $i++ ) 
	{
		// $j = longitude
		for ($j = 1; $j <= 26; $j++ ) 
		{
			$choix = 1;
						   
			if(!empty($_POST[$i.'-'.$j]))
				$choix = 0;
			
			$query = "SELECT acces FROM #__wub_batiments WHERE lat = '" . $i . "' AND lng = '" . $j . "' LIMIT 1";
			$database->setQuery($query);
			
			if( $database->loadObjectList() )
				$query = "UPDATE #__wub_batiments SET acces = '".$choix."' WHERE lat = '" . $i . "' AND lng = '" . $j . "' LIMIT 1";
			else
				$query = "INSERT INTO #__wub_batiments ( lng , lat , acces ) VALUES ( '".$j."', '".$i."', '".$choix."')";

			$database->setQuery( $query );
			$database->query(); 
		}
	}
	$query = "DELETE FROM #__wub_batiments WHERE nom = '' AND acces = '1'";
	$database->setQuery( $query );
	$database->query(); 
}
?>

<style type="text/css">
<!--
.tableau {
background-image:url(<?php echo $url; ?>/image/map.jpg);
}
.limite {
border:1px dotted #CCCCCC;
width:33px;
text-align:center;
vertical-align:middle;
height:33px;

    filter : alpha(opacity=50);
    -moz-opacity : 0.5;
    opacity : 0.5; 
}
-->
</style>
<form action="index2.php" method="post" name="adminForm">
  <table width="910" height="910" border="0" align="center" cellspacing="0" cellpadding="0" class="tableau" >
    <?php
// $i = latitude
for ( $i = 1; $i <= 26; $i++ ) 
{
?>
    <tr>
      <?php
	// $j = longitude
	for ($j = 1; $j <= 26; $j++ ) 
	{
		$database->setQuery("SELECT acces, nom FROM #__wub_batiments WHERE lat = '" . $i . "' AND lng = '" . $j . "' LIMIT 1");
		$batiment = $database->loadObjectList();
		
		$cocher = '';
		$couleur = '';
		
		if($batiment)
		{
			if(!$batiment[0]->acces)
				$cocher = 'checked';
				
			if($batiment[0]->nom)
				$couleur = 'style="background-color:#990000;"';
		}

		?>
      <td width="35" height="35" align="center" valign="middle">
      <div class="limite" <?php echo $couleur; ?> title="<?php echo chr( $j+64 ).'-'.$i; ?>" >
        <input type="checkbox" <?php echo $cocher; ?> name="<?php echo $i.'-'.$j; ?>" id="checkbox">
       </div>
      </td>
      <?php
	}
	?>
    </tr>
    <?php
}
?>
  </table>
  <input type="submit" name="validation" id="button" value="Envoyer">
    <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="<?php echo $task; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
</form>
