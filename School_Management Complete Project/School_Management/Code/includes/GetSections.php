<?php
	include("Config.php");
	include("Fees_Queries.php");
?>
<label>
	<select name="section" id="section">
		<option value="">All</option>
		<?php
		$SelectClass = Section_Select($_GET['classid']);
		while($FetchClass  = mysql_fetch_array($SelectClass))
		{
			if($FetchClass['id'] == $_GET['SectionId'])
				echo '<option value="'.$FetchClass['id'].'" selected>'.$FetchClass['name'].'</option>';
			else
				echo '<option value="'.$FetchClass['id'].'">'.$FetchClass['name'].'</option>';
		} ?>
	</select>
</label>