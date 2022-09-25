<?php
	include("includes/Reports_Queries.php");
?>
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
									}
								?>
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
		<?php 
		if(!$_POST['Search'])
		{
		?>
			<a href="" title="Download" onclick='Exportalldata("getdata=Student_Information")'><img src="images/icons/download.png"></a>
			<div class="columns">
				<h3>Student Information List
					<?php
						$StudentTotalRows = mysql_fetch_assoc(Student_Select_Count_All());
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
						$i = $Start = ($_GET['pageno']-1)*$Limit; */
						$i = 1;
						$student_info = Student_Select_ByLimit($Start, $Limit);
						while($student = mysql_fetch_assoc($student_info))
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
		}
		if($_POST['Search'])
			include("includes/ExportStudentInformation.php");	
	?>	
<script>
	function Export(PostBackValues)
	{
		window.open("includes/ExportStudentInformation.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Exportalldata(PostBackValues)
	{
		window.open("includes/ExportAllStudent_Information.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}	
</script>