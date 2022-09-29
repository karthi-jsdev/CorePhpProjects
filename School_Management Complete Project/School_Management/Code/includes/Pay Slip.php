<?php
	if($_GET['id'])
	{
		mysqli_query($_SESSION['connection'],"update employee_salary_assignment set approvestatus='1' where employee_id='".$_GET['id']."'");
		echo '<br/><div class="message success"><b>Message</b> : Salary approved successfully</div>';
	}
?>
<section role="main" id="main">
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']; ?>" id="form" class="form panel" >
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Pay Slip </h2></header><hr />
			<fieldset>
				<div class="clearfix">
					<label><strong>Name </strong><font color="red">*</font>
						<select name="employee_id" id="employee_id">
							<option value="">Select</option>
							<?php
							$SelectName = Select_Employee();
							while($FetchName = mysqli_fetch_assoc($SelectName))
							{
								//if($FetchName['id'] == $_POST['student_id'])
									//echo "<option value='".$FetchName['id']."' selected>".$FetchName['first_name']."</option>";
								//else
									echo "<option value='".$FetchName['id']."'>".$FetchName['first_name']."</option>";
							} ?>
						</select>
					</label>
					<label><strong>Department </strong><font color="red">*</font>
						<select name="department_id" id="department_id">
							<option value="">Select</option>
							<?php
							$SelectDepartment = Select_department();
							while($FetchDepartment  = mysqli_fetch_array($SelectDepartment))
							{
								//if($FetchClass['id']==$_POST['class_id'])
									//echo '<option value="'.$FetchClass['id'].'" selected>'.$FetchClass['name'].'</option>';
								//else
									echo '<option value="'.$FetchDepartment['id'].'">'.$FetchDepartment['name'].'</option>';
							} ?>
						</select>
					</label>
					<label><strong>Month</strong><font color="red">*</font>
						<?php
							echo '<select name="month" id="month">';
							$months = array("Select","January","Febuary","March","April","May","June","July","August","September","October","November","December");			
							for($i=0;$i<count($months);$i++)
							{
								//if($MonthYear[0] == $i)
									//echo '<option value="'.$i.'" selected>'.$months[$i].'</option>';
								//else
									echo '<option value="'.$i.'">'.$months[$i].'</option>';
							}
							echo '</select>';
						?>
					</label>
					<label><strong>Year</strong><font color="red">*</font>
						<?php
							echo '<select name="year" id="year">
								<option value="Select">Select</option>';
								for($i=2013;$i<=date('Y');$i++)
								{	
									//if($MonthYear[1] == $i)
										//echo '<option value="'.$i.'" selected>'.$i.'</option>';
									//else
										echo '<option value="'.$i.'">'.$i.'</option>';
								}
								echo '</select>';
						?>
					</label>
				</div>
			</fieldset>
			<hr /><a type="submit" class="button button-green" onclick="Search()">Search</a>
		</form>
	</div>
</section>
<?php
	if($_GET['Emp_num'])
	{
		$SelectEmployee = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From employee_salary_assignment Where employee_id='".$_GET['Emp_num']."'  && month='".$_GET['Month']."' && year='".$_GET['Year']."'"));
		$SelectEmployeeDetails = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From staff_admission Where id='".$_GET['Emp_num']."'"));
		$months = array("Select","January","Febuary","March","April","May","June","July","August","September","October","November","December");			
		for($i=0;$i<count($months);$i++)
		{
			if($i==$SelectEmployee['month'])
				$Months .= $months[$i];
		}
		for($i=2013;$i<=date('Y');$i++)
		{	
			if($SelectEmployee['year'] == $i)
				$Year .= $i;
		}
		$Total = $SelectEmployee['basic_pay']+$SelectEmployee['da']+$SelectEmployee['hra']+$SelectEmployee['cca']+$SelectEmployee['ma']+$SelectEmployee['lop'];
		$Status="";
		if($SelectEmployee['approvestatus'])
			$Status = "Approved";
		else
			$Status = "Pending";
		echo '<table class="paginate sortable full">
				<thead>
					<tr>
						<th align="left">Photo</th>
						<th align="left">Name</th>
						<th align="left">Month/Year</th>
						<th align="left">Basic-pay</th>
						<th align="left">DA</th>
						<th align="left">HRA</th>
						<th align="left">CCA</th>
						<th align="left">MA</th>
						<th align="left">LOP</th>
						<th align="left">Total Salary</th>
						<th align="left">Net Salary</th>
						<th align="left">Status</th>
						<th align="left">Action</th>
					</tr>
				</thead>
			<tr>
				<td><img src="data:image/jpeg;base64,'.base64_encode($SelectEmployeeDetails['user_img']).'"  width="90px" height="90px" alt="photo"/></td>
				<td style="vertical-align:middle">'.$SelectEmployeeDetails['first_name'].' '.$SelectEmployeeDetails['last_name'].'</td>
				<td style="vertical-align:middle">'.$Months.'/'.$Year.'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['basic_pay'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['da'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['hra'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['cca'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['ma'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['lop'].'</td>
				<td style="vertical-align:middle">'.$Total.'</td>
				<td style="vertical-align:middle">'.($Total-$SelectEmployee['lop']).'</td>
				<td style="vertical-align:middle">'.$Status.'</td>';
				if(!$SelectEmployee['approvestatus'])	
					echo '<td style="vertical-align:middle"><a href="index.php?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&Emp_num='.$_GET['Emp_num'].'&Year='.$SelectEmployee['year'].'&Month='.$SelectEmployee['month'].'&Department='.$SelectEmployeeDetails['department_id'].'&id='.$_GET['Emp_num'].'&pageno='.$_GET['pageno'].'&action=Edit">Approve</a></td>';
				else
					echo '<td style="vertical-align:middle"><a href="#" onclick="Download('.$SelectEmployee['id'].')">Download</a></td>';
			echo '</tr>	
		</table>';
	}
?>
<script>
	function Download(Id)
	{
		window.open("includes/Export.php?export=1&Id="+Id,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Search()
	{
		var Emp_num = document.getElementById('employee_id').value;
		var Department = document.getElementById('department_id').value;
		var Month = document.getElementById('month').value;
		var Year = document.getElementById('year').value;
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&Emp_num="+Emp_num+"&Department="+Department+"&Month="+Month+"&Year="+Year);
	}
</script>