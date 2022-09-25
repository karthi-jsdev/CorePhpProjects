<?php
	session_start();
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	if($_POST['PaginationFor'])
	{
		include("Config.php");
		include("Reports_Queries.php");
	}
	
$StudentTotalRows = mysql_fetch_assoc(Student_Select_Count_All());
if(!$_POST['Rowsperpage'])
{ ?>
	<div class="form panel">
		<form method='post' action=''>
			<hr/>
			<table>
				<tr>
					<td>
						<b>Class & Section:</b>
						<br/>
						<select name="sectionid" id="sectionid">
							<option value="">All</option>
							<?php
							$Selectclass = Class_List();
							while($Fetchclass  = mysql_fetch_array($Selectclass))
							{
								if($Fetchclass['sectionid']==$_POST['sectionid'])
									echo '<option value="'.$Fetchclass['sectionid'].'" selected>'.$Fetchclass['classname'].'  &  '.$Fetchclass['sname'].'</option>';
								else
									echo '<option value="'.$Fetchclass['sectionid'].'">'.$Fetchclass['classname'].'  &  '.$Fetchclass['sname'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<br/>
						<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
						<?php
						if($_POST['Search'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&sectionid='.$_POST['sectionid'].'&Search=1")\'>Download</a>';
						?>
					</td>
				</tr>
			</table>
		</form>
		<hr/>
	</div>

	<a href="" title="Download" onclick='Exportalldata("getdata=Student_Information")'><img src="images/icons/download.png"></a>
	<div class="columns">
		<h3>Student Information List
			<?php
				echo " : No. of Students - ".$StudentTotalRows['total'];
			?>
		</h3>
		<hr />
		<select id="Rowsperpage" onchange='Ajax_Pagination("Student_Information", "1")'>
			<option value="">All</option>
			<option value="200">200</option>
			<option value="400">400</option>
			<option value="600">600</option>
			<option value="800">800</option>
			<option value="1000">1000</option>
			<option value="1200">1200</option>
		</select>
		
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Student Name</th>
					<th align="left">Father's Name</th>
					<th align="left">Admission Date</th>
					<th align="left">Class & Section</th>
					<th align="left">Gender</th>
					<th align="left">Residence Address</th>
					<th align="left">Contact Person</th>
					<th align="left">Contact Number</th>
				</tr>
			</thead>
			<tbody id="Student_Data">
			<?php
			}
			if(!$StudentTotalRows['total'])
				echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
			$i = 0; 
			if($_POST['Rowsperpage'])
			{
				$Limit = $_POST['Rowsperpage'];
				$_POST['total_pages'] = ceil($StudentTotalRows['total'] / $Limit);
				if(!$_POST['pageno'])
					$_POST['pageno'] = 1;
				$i = $Start = ($_POST['pageno']-1)*$Limit; 
			}
			$student_info = Student_Select_ByLimit($Start, $Limit);
			while($student = mysql_fetch_assoc($student_info))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".++$i."</td>
					<td>".$student['first_name']." ".$student['last_name']."</td>
					<td>".$student['father_name']."</td>
					<td>".$student['admission_date']."</td>
					<td>".$student['classname']." & ".$student['sname']."</td>
					<td>".$student['gender']."</td>
					<td>".$student['residenceaddress']."</td>
					<td>".$student['contact_person']."</td>
					<td>".$student['contact_no']."</td>
				</tr>";
			}
		if(!$_POST['Rowsperpage'])
		{ ?>
				</tbody>
			</table>
			<div id="Student_Data_Pagination"></div>
		</div>
		<?php
		}
		else
		{
			echo "#$";
			require("Ajax_Pagination.php");
		} ?>