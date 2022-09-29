<?php
	include("Config.php");
	if($_GET['productid'])
	{
		$FetchProductCode = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From products Where id='".$_GET['productid']."'"));
		$Select_Kitting  = mysqli_query($_SESSION['connection'],"Select distinct(kittingname) From kitting where productcode='".$FetchProductCode['id']."'"); 
		echo '<option value=select>Select</option>';
		while($FetchKittingName = mysqli_fetch_array($Select_Kitting))
		{
			echo '<option value='.$FetchKittingName['kittingname'].'>'.$FetchKittingName['kittingname'].'</option>';
		}
	}
		else
			echo "<br /><div style='color:red;'>No Kitting for this product<input name='versions' type='hidden' value=''></div>";
			 ?>