<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validate();">
	<fieldset>
		<h3>Employee Search</h3>
		<hr/>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
		<div class="clearfix">
			<label><strong>Name </strong><font color="red">*</font></label>
			<select name="name" id="name">
				<option value="">Select</option>
				<?php
					$SelectName = Select_Name();
					while($FetchName  = mysql_fetch_array($SelectName))
					{
						echo '<option value="'.$FetchName['first_name'].'">'.$FetchName['first_name'].' '.$FetchName['last_name'].'</option>';
					}
				?>
			</select>
		</div>
		<a type="submit" class="button button-green" onclick="Search()">Search</a>
	</fieldset>
</form>
<?php
	if($_GET['name'])
	{
		$SelectEmployee = mysql_fetch_array(mysql_query("Select * From staff_admission Where first_name='".$_GET['name']."'"));
		$DepartmentFetch = mysql_fetch_array(mysql_query("Select * From department where id='".$SelectEmployee['department_id']."'"));
		$DesignationFetch = mysql_fetch_array(mysql_query("Select * From designation where id='".$SelectEmployee['designation_id']."'"));
		$RelationFetch = mysql_fetch_array(mysql_query("Select * From relation where id='".$SelectStudent['relation_id']."'"));
		echo '<img src="data:image/jpeg;base64,'.base64_encode($SelectEmployee['user_img']).'"  width="90px" height="90px" alt="photo"/>';
		echo '<table class="paginate sortable full">
				<thead>
					<tr>
						<th align="left">Name</th>
						<th align="left">Department</th>
						<th align="left">Designation</th>
						<th align="left">Contact Number</th>
						<th align="left">Address</th>
						<th align="left">Action</th>
					</tr>
				</thead>
			<tr>
				<td>'.$SelectEmployee['first_name'].' '.$SelectEmployee['last_name'].'</td>
				<td>'.$DepartmentFetch['name'].'</td>
				<td>'.$DesignationFetch['name'].'</td>
				<td>'.$SelectEmployee['phone_no'].'</td>
				<td>'.$SelectEmployee['address'].'</td>
				<td><a href="index.php?page='.$_GET['page'].'&subpage=Staff Admission&id='.$SelectEmployee['id'].'&pageno='.$_GET['pageno'].'&action=Edit">Edit</a></td>
			</tr>	
		</table>';
	}
?>
<script>
	function Search()
	{
		//var Emp_num = document.getElementById('number').value;
		//var Department = document.getElementById('department').value;
		var name = document.getElementById('name').value; //&Emp_num="+Emp_num+"&Department="+Department+"
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&name="+name);
	}
</script>