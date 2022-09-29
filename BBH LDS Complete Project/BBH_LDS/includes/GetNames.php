<label>Name </label>
<select name="name" id="name" >
	<option value="" ><?php if(isset($_GET['All'])) echo 'All'; else echo 'Select'; ?></option>
	<?php
	include("Config.php");
	$SelectNames = mysqli_query($_SESSION['connection'],"select id,name from resource_update where groupid='".$_GET['GroupId']."' and departmentid='".$_GET['DeptId']."'");
	while($FetchNames = mysql_fetch_array($SelectNames))
	{
		echo '<option value="'.$FetchNames['id'].'">'.$FetchNames['name'].'</option>';
	}
	?>
</select>