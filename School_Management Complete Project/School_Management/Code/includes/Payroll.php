<div class="form panel">
	<form method='post' action=''>
		<hr/>
		<table>
			<tr>
				<td>
					<b>Department:</b>
					<br/>
					<select name="department" id="department">	
						<option value="">All</option>
						<?php
						$SelectDepartmentName = mysql_query("select * from 	department  order by name asc");
						while($FetchDepartmentName = mysql_fetch_array($SelectDepartmentName))
						{
							if($_POST['department']==$FetchDepartmentName['id'])
								echo '<option value="'.$FetchDepartmentName['id'].'" selected>'.$FetchDepartmentName['name'].'</option>';
							else
								echo '<option value="'.$FetchDepartmentName['id'].'">'.$FetchDepartmentName['name'].'</option>';
						}
						?>
					</select>
				</td>
				<td>
					<strong>Month</strong>
					<br/>
					<?php
						echo '<select name="month" id="month">';
						$months = array("All","January","Febuary","March","April","May","June","July","August","September","October","November","December");			
						for($i=0;$i<count($months);$i++)
						{
							if($i==0)
								echo '<option value="">'.$months[$i].'</option>';
							else if($_POST['month'] == $i)
								echo '<option value="'.$i.'" selected>'.$months[$i].'</option>';
							else if($i!=0)
								echo '<option value="'.$i.'" >'.$months[$i].'</option>';
						}
						echo '</select>';
					?>
				</td>
				<td>
					<strong>Year</strong>
					<br/>
					<?php
						echo '<select name="year" id="year">
							<option value="">All</option>';
							for($i=2013;$i<=date('Y');$i++)
							{	
								if($_POST['year'] == $i)
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select>';
					?>
				</td>
				<td>
					<br/>
					<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
					<?php
					//if(mysql_num_rows(Report_Department()) && $_POST['Search'])
						//echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&department='.$_POST['department'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
					?>
				</td>
			</tr>
		</table>
	</form>
	<hr/>
</div>
<?php
	if($_POST['Search'])
	{
		$Query = "where ";
		if(isset($_POST['department']))
			$Query .= "employee_id in (select id from staff_admission where department_id='".$_POST['department']."') ";
		if(isset($_POST['month']))
			$Query .= "and month='".$_POST['month']."' ";
		if(isset($_POST['year']))
			$Query .= "and  year='".$_POST['year']."'";
		
		echo'<table class="paginate sortable full" style="width:800px">
			<thead>
				<tr>
					<th>Staff Name</th>
					<th>Department</th>
					<th>Grade</th>
					<th>Payment Amount</th>
					<th>Payment Status</th>
					<th>Payment Due</th>
				</tr>
			</thead>';
		$SelectSalaryAssignment = mysql_query("select department.name as Department,staff_grade.name as Grade,staff_admission.first_name as FirstName,staff_admission.last_name as LastName,basic_pay,da,hra,cca,ma,lop,status,approvestatus from employee_salary_assignment JOIN staff_admission ON staff_admission.id=employee_id JOIN staff_grade ON staff_grade.id=staff_admission.grade_id JOIN department ON department.id=staff_admission.department_id ".str_replace("=''", "!=''", $Query));
		while($FetchSalaryAssignment = mysql_fetch_array($SelectSalaryAssignment))
		{
			echo '<tr>
					<td align="center">'.$FetchSalaryAssignment['FirstName'].' '.$FetchSalaryAssignment['LastName'].'</td>
					<td align="center">'.$FetchSalaryAssignment['Department'].'</td>
					<td align="center">'.$FetchSalaryAssignment['Grade'].'</td>
					<td align="center">'.($FetchSalaryAssignment['basic_pay']+$FetchSalaryAssignment['da']+$FetchSalaryAssignment['hra']+$FetchSalaryAssignment['cca']+$FetchSalaryAssignment['ma']+$FetchSalaryAssignment['lop']).'</td>
					';
				if($FetchSalaryAssignment['status'] && $FetchSalaryAssignment['approvestatus'])
					echo '<td align="center">Approved</td><td align="center">No</td>';
				else
					echo '<td align="center">Yes</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>