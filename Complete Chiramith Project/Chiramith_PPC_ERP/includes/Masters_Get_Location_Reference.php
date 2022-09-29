<?php
include("Config.php");
include("Masters_Queries.php");
if($_GET['SubSectionId'] && $_GET['LocationReferenceId'] == '-')
{ ?>
	<div class="clearfix">
		<label>Location-Id <font color="red">*</font></label>
		<select id="location_reference_id" name="location_reference_id">
			<option value=''>Select</option>
			<?php
			$SelectLocationReference = Master_AvailableLocationReference();
			while($FetchLocationReference = mysqli_fetch_array($SelectLocationReference))
				echo '<option value="'.$FetchLocationReference['location_reference_id'].'">'.$FetchLocationReference['name'].'</option>';
			?>
		</select>
	</div>
<?php
}
else if($_GET['SubSectionId'])
{ ?>
	<div class="clearfix">
		<label>Reference Location-Id <font color="red">*</font></label>
		<select id="location_reference_id" name="location_reference_id">
			<option value=''>Select</option>
			<?php
			$SelectLocationReference = Master_LocationReference($_GET['SubSectionId']);
			while($FetchLocationReference = mysqli_fetch_array($SelectLocationReference))
			{
				$FetchLocationId = mysqli_fetch_array(Masters_SelectLocationById($FetchLocationReference['id']));
				if($FetchLocationReference['id']%30)
				{
					if($FetchLocationReference['id'] == $_GET['LocationReferenceId'])
						echo '<option value="'.$FetchLocationReference['id'].'" selected>'.$FetchLocationReference['reference'].'</option>';
					else if(!$FetchLocationId['id'])
						echo '<option value="'.$FetchLocationReference['id'].'">'.$FetchLocationReference['reference'].'</option>';
				}
			} ?>
		</select>
	</div>
<?php
} ?>