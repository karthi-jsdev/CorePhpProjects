<?php
include('Config.php');
if($_GET['category'])
{
	$rawmaterial = mysqli_query($_SESSION['connection'],"SELECT id,materialcode,description,partnumber FROM rawmaterial WHERE rawmaterial.categoryid='".$_GET['category']."'");?>
		<option value="">Select</option>
	<?php
		while($RawMaterial = mysqli_fetch_assoc($rawmaterial))
		{/* 
			if($RawMaterial['id'] == $_POST['rawmaterialid'])
				echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."$".$RawMaterial['description']."' selected>".$RawMaterial['materialcode']."</option>";
			else */
				echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."$".$RawMaterial['description']."'>".$RawMaterial['materialcode']."</option>";
						
		}
}
?>