<?php
include("Config.php");
include("Masters_Queries.php");
?>
<div class="clearfix">
	<label>Section <font color="red">*</font></label>
	<select id="section_id" name="section_id" onchange="SubSection(this.value,'')">
		<option value=''>Select</option>
		<?php
		$SelectSection = Master_Section();
		while($FetchSection = mysqli_fetch_array($SelectSection))
		{
			if($FetchSection['id'] == $_POST['section_id'])
				echo '<option value="'.$FetchSection['id'].'" selected>Section '.$FetchSection['name'].'</option>';
			else
				echo '<option value="'.$FetchSection['id'].'">Section '.$FetchSection['name'].'</option>';
		} ?>
	</select>
</div>