<?php
	include("Config.php");
	include("Asset_Inventory_Queries.php");
	if($_GET['Make'] && !$_GET['Model'])
	{
		?>
		<select id="model_id" name="model_id" onchange="GetModel(document.getElementById('make_id').value,this.value)">
			<option value="" >Select</option>
		<?php
			$SelectModel = mysqli_query($_SESSION['connection'],"select * from biomedical_model where make_id='".$_GET['Make']."'");
			while($FetchModel = mysqli_fetch_array($SelectModel))
			{
				//if($_GET['Model']==$FetchModel['id'])
					//echo '<option value="'.$FetchModel['id'].'" selected>'.$FetchModel['model'].'</option>';
				//else
					echo '<option value="'.$FetchModel['id'].'">'.$FetchModel['model'].'</option>';
			}
		?>
		</select>
		<?php
	}
	echo '#';
	if($_GET['Model'] && $_GET['Make'])
	{ ?>
		<select id="equipment_idname" name="equipment_idname" >
			<option value="">Select</option>
			<?php
			$Source_Equipment = mysqli_query($_SESSION['connection'],"select * from biomedical_equipment where model_id='".$_GET['Model']."'");
			while($Equipment = mysqli_fetch_assoc($Source_Equipment))
			{
				//if($Equipment['id'] == $_GET['Equipment'])
					//echo "<option value=".$Equipment['id']." selected>".$Equipment['equipment']."</option>";
				//else
					echo "<option value=".$Equipment['id'].">".$Equipment['equipment']."</option>";
			} ?>
		</select>
	<?php 
	}
?>