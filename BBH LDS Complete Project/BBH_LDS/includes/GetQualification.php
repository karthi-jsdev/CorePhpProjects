<?php
include("Config.php");
 $Qualification = "where ";
 $ExplodeQual = explode("$",$_GET['qualificationid']);
 $j = count($ExplodeQual)-1;
 for($i=0;$i<(count($ExplodeQual)-1);$i++)
 {
	$j -= 1;
	if($ExplodeQual[$i]!="")
		$Qualification .= "name!='".$ExplodeQual[$i]."'";
	if($j)
		$Qualification .= " And ";
 }
 $Select = mysql_query("select * from qualification $Qualification"); 
 echo '<select name="qualificationid[]" id="qualificationid'.$_GET['i'].'" required="required">
 <option value="">Select</option>';
 
while($Fetch = mysql_fetch_array($Select)) 
{ 
	echo '<option value="'.$Fetch['name'].'">'.$Fetch['name'].'</option>';
 }
 echo '</select>';
 ?>