<?php
	include("Config.php");
	include("Masters_Queries.php");
?>
	<label>Particulars <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
	<select name="assignment_particulars" id="assignment_particulars">
		<option value="">Select</option>
		<?php
			$SelectParticulars = Select_ParticularsByCategoryId($_GET['categoryid']);
			while($FetchParticulars  = mysqli_fetch_array($SelectParticulars))
			{
				if($_GET['particularid']==$FetchParticulars['id'])
					echo '<option value="'.$FetchParticulars['id'].'" selected>'.$FetchParticulars['name'].'</option>';
				else
					echo '<option value="'.$FetchParticulars['id'].'">'.$FetchParticulars['name'].'</option>';
			}
		?>
	</select>
	</label>