<?php
	include("Config.php");
	if($_GET['productid'])
	{
		$FetchProductCode = mysql_fetch_array(mysql_query("Select * From products Where id='".$_GET['productid']."'"));
		$Select_Kitting  = mysql_query("Select distinct(kittingname) From kitting where productcode='".$FetchProductCode['id']."'"); 
		echo '<option value=select>Select</option>';
		while($FetchKittingName = mysql_fetch_array($Select_Kitting))
		{
			echo '<option value='.$FetchKittingName['kittingname'].'>'.$FetchKittingName['kittingname'].'</option>';
		}
	}
		else
			echo "<br /><div style='color:red;'>No Kitting for this product<input name='versions' type='hidden' value=''></div>";
			 ?>