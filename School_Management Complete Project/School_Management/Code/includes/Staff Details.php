<?php
	$Columns = array("id","name","emp_no","section_id","subject_ids","is_class_teacher");
	if($_GET['action'] == 'Edit')
	{
		$FetchStaff = mysql_fetch_assoc(StaffDetails_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $FetchStaff[$Col];
	}
	if($_POST['submit'])
	{
		Staff_Details_Insert();
	}
	if($_POST['update'])
	{
		Staff_Details_Update();
	}
?>
<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation();">
	<fieldset>
		<h3>Staff Details</h3>
		<hr/>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
		<div class="clearfix">
			<label><strong>Name </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="text" value="<?php echo $_POST['name']; ?>" id="name" name="name" required="required"/></label>
		</div>
		<div class="clearfix">
			<label><strong>Class & Section </strong><font color="red">*</font>
				<select name="section" id="section">
					<option value="">Select</option>
					<?php
						$SelectSection = Select_Section();
						while($FetchSection  = mysql_fetch_array($SelectSection))
						{
							$ClassFetch = mysql_fetch_array(mysql_query("Select * From class where id='".$FetchSection['classid']."'"));
							if($FetchSection['id']==$_POST['section_id'])
								echo '<option value="'.$FetchSection['id'].'" selected>'.$ClassFetch['name'].'-'.$FetchSection['name'].'</option>';
							else
								echo '<option value="'.$FetchSection['id'].'">'.$ClassFetch['name'].'-'.$FetchSection['name'].'</option>';
						}
					?>
				</select>
			</label>
			<label><strong>Subjects</strong><font color="red">*</font> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
				<select name="subjects[]" id="subjects" multiple>
					<option value="" disabled>Select</option>
					<?php
						$SelectSubject = Select_Subject();
						$Subjects = explode(",",$_POST['subject_ids']);
						while($FetchSubject  = mysql_fetch_array($SelectSubject))
						{
							if($_POST['subject_ids'])
							{
								foreach($Subjects as $Sub)
								{
									if($FetchSubject['id']==$Sub)
										echo '<option value="'.$FetchSubject['id'].'" selected>'.$FetchSubject['name'].'</option>';	
								}
							}
							else
								echo '<option value="'.$FetchSubject['id'].'">'.$FetchSubject['name'].'</option>';
						}
					?>
				</select>
			</label>
		</div>
		<div class="clearfix">
		<?php
			if($_POST['is_class_teacher'])
				echo '<span class="radio-input"><input type="checkbox" name="cteacher" value="1"  id="cteacher" checked>Class Teacher</input></span>';
			else
				echo '<span class="radio-input"><input type="checkbox" name="cteacher" value="1"  id="cteacher">Class Teacher</input></span>';
		?>
		</div>
		<hr/>
		<?php
		if(!$_GET['action'])
			echo '<input type="submit" class="button button-green" id="submit" name="submit" value="Submit"><br/><br/>';
		else
			echo '<input type="submit" class="button button-green" id="update" name="update" value="Update"><br/><br/>';
		?>
	</fieldset>
</form>
<?php
	$SelectStaffDetails = Select_Staff_Details();
	if(mysql_num_rows($SelectStaffDetails))
	{
		echo '<table class="paginate sortable full">
					<thead>
						<tr>
							<th align="left">Name</th>
							<th align="left">Class/Section</th>
							<th align="left">Subjects</th>
							<th align="left">Class Teacher</th>
							<th align="left">Action</th>
						</tr>
					</thead>';
		while($FetchStaffDetails = mysql_fetch_array($SelectStaffDetails))
		{
			$FetchSection = mysql_fetch_array(Select_SectionById($FetchStaffDetails['section_id']));
			$ClassFetch = mysql_fetch_array(mysql_query("Select * From class where id='".$FetchSection['classid']."'"));
			$Sub = explode(",",$FetchStaffDetails['subject_ids']);
			echo '<tr>
					<td>'.$FetchStaffDetails['name'].'</td>
					<td>'.$ClassFetch['name'].'/'.$FetchSection['name'].'</td><td>';
					foreach($Sub as $Subjects)
					{
						$FetchSubjects = mysql_fetch_array(mysql_query("Select * From subject where id='".$Subjects."'"));
						echo $FetchSubjects['name'].',';
					}
					echo '</td><td>';
					if($FetchStaffDetails['is_class_teacher'])
						echo 'Yes';
					else
						echo 'No';
					echo '</td>
					<td><a href="index.php?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&id='.$FetchStaffDetails['id'].'&pageno='.$_GET['pageno'].'&action=Edit">Edit</a></td>
				</tr>';
		}			
		echo 	'</table>';
	}
?>
<script>
	function Search()
	{
		var Emp_num = document.getElementById('number').value;
		var Department = document.getElementById('department').value;
		var name = document.getElementById('name').value;
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&Emp_num="+Emp_num+"&Department="+Department+"&name="+name);
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("subjects").value == "")
			message = "Please select Subjects"; 
		if(document.getElementById("section").value == "")
			message = "Please select Class/Section"; 
		if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 15)
			message = "Name should be within 4 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>