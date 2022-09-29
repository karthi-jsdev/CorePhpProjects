<?php
	include("Config.php");
	include("Masters_Queries.php");
	if($_GET['SectionId'])
	{ ?>
		<div class="clearfix">
			<label>Sub-Section <font color="red">*</font></label>
			<select id="subsection_id" name="subsection_id" onchange="LocationReference(this.value,'')">
				<option value=''>Select</option>
				<?php
				$FetchSection = mysqli_fetch_array(Select_SectionName($_GET['SectionId']));
				$SelectSubSection = Master_SubSectionBySectionId($_GET['SectionId']);
				while($FetchSubSection = mysqli_fetch_array($SelectSubSection))
				{
					if($FetchSubSection['id'] == $_GET['SubSectionId'])
						echo '<option value="'.$FetchSubSection['id'].'" selected>Section '.$FetchSection['name'].''.$FetchSubSection['name'].'</option>';
					else
						echo '<option value="'.$FetchSubSection['id'].'">Section '.$FetchSection['name'].''.$FetchSubSection['name'].'</option>';
				} ?>
			</select>
		</div>
	<?php
	} ?>