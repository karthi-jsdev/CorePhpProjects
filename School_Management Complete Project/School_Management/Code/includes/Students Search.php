<?php
	if($_GET['id'])
	{
		mysqli_query($_SESSION['connection'],"delete from student_admission where id='".$_GET['id']."'");
		echo "<br/><div class='message success'><b>Message</b> : Student information deleted successfully</div>";
	}
?>

<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validate();">
	<fieldset>
		<h3>Student Search</h3>
		<hr/>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
		<div class="clearfix">
			<label><strong>Admission No</strong></label>
			<input type="text" id="number" name="number" >
		</div>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>OR</strong>
		<div class="clearfix">
			<label><strong>First Name</strong></label>
			<input type="text" id="name" name="name" >
		</div>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>OR</strong>
		<div class="clearfix">
			<label><strong>Class & Section </strong></label>
			<select name="section" id="section">
				<option value="">Select</option>
				<?php
					$SelectSection = Select_Section();
					while($FetchSection  = mysqli_fetch_array($SelectSection))
					{
						$ClassFetch = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From class where id='".$FetchSection['classid']."'"));
						echo '<option value="'.$FetchSection['id'].'">'.$ClassFetch['name'].'-'.$FetchSection['name'].'</option>';
					}
				?>
			</select>
		</div>
		<a type="submit" class="button button-green" onclick="Search()">Search</a>
	</fieldset>
</form>
<?php
	if(($_GET['name'] && $_GET['Section']) || $_GET['number'] || $_GET['Section'] || $_GET['name'])
	{
		echo '<table class="paginate sortable full">
				<thead>
					<tr>
						<th align="left">Student Photo</th>
						<th align="left">Admission No.</th>
						<th align="left">Name</th>
						<th align="left">Class & Section</th>
						<th align="left">Contact Name</th>
						<th align="left">Contact Number</th>
						<th align="left">Action</th>
					</tr>
				</thead>';
		if($_GET['name'] && $_GET['Section'])
			$FetchStudent = mysqli_query($_SESSION['connection'],"select * from student_admission where ((first_name like '".$_GET['name']."%' or first_name like '% ".$_GET['name']."'  or first_name like '% ".$_GET['name']." %') && section_id='".$_GET['Section']."')");
		else if($_GET['number'])
		{
			$FetchStudent = mysqli_query($_SESSION['connection'],"select * from student_admission where (admission_no like '".$_GET['number']."%' or admission_no like '% ".$_GET['number']."'  or admission_no like '% ".$_GET['number']." %')");
		}
		else if($_GET['Section'])
		{
			$FetchStudent = mysqli_query($_SESSION['connection'],"select * from student_admission where section_id='".$_GET['Section']."'");
		}
		else if($_GET['name'])
			$FetchStudent = mysqli_query($_SESSION['connection'],"select * from student_admission where ((first_name like '".$_GET['name']."%' or first_name like '% ".$_GET['name']."'  or first_name like '% ".$_GET['name']." %'))");
		if(mysqli_num_rows($FetchStudent))
		{
			while($SelectStudent = mysqli_fetch_array($FetchStudent))
			{
				$SectionFetch = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From section where id='".$SelectStudent['section_id']."'"));
				$ClassFetch = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From class where id='".$SectionFetch['classid']."'"));
				echo '<tr>
						<td><img src="data:image/jpeg;base64,'.base64_encode($SelectStudent['user_img']).'"  width="90px" height="90px" alt="photo"/></td>
						<td  style="vertical-align:middle">'.$SelectStudent['admission_no'].'</td>
						<td  style="vertical-align:middle">'.$SelectStudent['first_name'].'</td>
						<td style="vertical-align:middle">'.$ClassFetch['name'].'-'.$SectionFetch['name'].'</td>
						<td style="vertical-align:middle">'.$SelectStudent['contact_person'].'</td>
						<td style="vertical-align:middle">'.$SelectStudent['contact_no'].'</td>
						<td style="vertical-align:middle"><a href="index.php?page='.$_GET['page'].'&subpage=Students Admission&id='.$SelectStudent['id'].'&pageno='.$_GET['pageno'].'&action=Edit">Edit</a><br/>
						<a href="index.php?page=Students&subpage=Students Fees&Student_id='.$SelectStudent['id'].'&Student_section_id='.$SelectStudent['section_id'].'&classid='.$SectionFetch['classid'].'&feescategoryid='.$SelectStudent['fees_catagoryids'].'&pageno='.$_GET['pageno'].'&action=Fees Details">Fees Details</a><br/>
						<a onclick="deleterow('.$SelectStudent['id'].')">Delete</a><br/>
						</td>
					</tr>';
			}
		}
		else
			echo '<tr><td colspan="8"><font color="red"><center>No data found</center></font></td></tr>';
		echo '</table>';
	}
	//else
		//echo '<div class="message error">Please enter admission number or name</div>';
?>
<script>
	function Search()
	{
		var message="";
		var number = document.getElementById('number').value;
		var Section = document.getElementById('section').value;
		var name = document.getElementById('name').value;
		if(!number && !Section && !name)
		{
			message = "Please Enter Any of One Fields";
		}
		if(message)
		{
			alert(message);
			return false;
		}
		else
		{
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&name="+name+"&Section="+Section+"&number="+number);
			return true;
		}
	}
	function deleterow(id)
	{
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&name=<?php echo $_GET['name'];?>&Section=<?php echo $_GET['Section']; ?>&number=<?php echo $_GET['number']; ?>&action=Delete"+"&id="+id);
	}
</script>