<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
	}

if($_GET['getdata'] == "Student_Information")
	{ ?>
		<div class="columns">
			<h3>Student Information List
				<?php
					$StudentTotalRows = mysqli_fetch_assoc(Student_Select_Count_All());
					echo " : No. of Students - ".$StudentTotalRows['total'];
				?>
			</h3>
			<hr />	
				
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Student Name</th>
						<th align="left">Father's Name</th>
						<th align="left">Admission Date</th>
						<th align="left">Class & Section</th>
						<th align="left">Gender</th>
						<th align="left">Contact Person</th>
						<th align="left">Contact Number</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$StudentTotalRows['total'])
						echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
					/* $Limit = 10;
					$total_pages = ceil($StudentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++; */
					$i = 1;
					$student_info = Student_Select_ByLimit($Start, $Limit);
					while($student = mysqli_fetch_assoc($student_info))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$student['first_name']." ".$student['last_name']."</td>
							<td>".$student['father_name']."</td>
							<td>".$student['admission_date']."</td>
							<td>".$student['classname']." & ".$student['sname']."</td>";
								if($student['gender'] == 0)
									echo "<td>Female</td>";
								else	
									echo "<td>Male</td>";
								echo "	
							<td>".$student['contact_person']."</td>
							<td>".$student['contact_no']."</td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
<?php	
	} ?>