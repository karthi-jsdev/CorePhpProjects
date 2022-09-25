<?php
include("Config.php");
	if($_GET['Make'])
	{
		?>
		<select id="model_id" name="model_id">
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
	} ?>