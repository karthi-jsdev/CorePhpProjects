<div class="form panel">
	<form method='post' action=''>
		<hr/>
		<table>
			<tr>
				<!--td>
					<b>Summary And Details:</b>
					<br/>
					<select name="summary" id="summary" onchange="SectionHideAndShow(this.value)">	
						<option value="">Select</option>
						<?php
						$Summary = array("Summary","Details");
						foreach($Summary as $Sum)
						{
							if($_POST['summary']==$Sum)
								echo '<option value="'.$Sum.'" selected>'.$Sum.'</option>';
							else
								echo '<option value="'.$Sum.'">'.$Sum.'</option>';
						}
						?>
					</select>
				</td-->
				<td>
					<b>Class:</b>
					<br/>
					<select name="class" id="class" onchange="GetSectionNames(this.value)">
						<option value="">All</option>
						<?php
						$SelectClass = mysqli_query($_SESSION['connection'],"select * from class order by name asc");
						while($FetchClass = mysqli_fetch_array($SelectClass))
						{
							if($_POST['class']==$FetchClass['id'])
								echo '<option value="'.$FetchClass['id'].'" selected>'.$FetchClass['name'].'</option>';
							else
								echo '<option value="'.$FetchClass['id'].'">'.$FetchClass['name'].'</option>';
						}
						?>
					</select>
				</td>
				<td id="sec">
					<b>Section:</b>
					<br/>
					<?php
						if($_POST['section'] && $_POST['class'])
						{ ?>
							<select name="section" id="section">
								<option value="">All</option>
								<?php
								$SelectSection = mysqli_query($_SESSION['connection'],"select * from section where classid = '".$_POST['class']."'order by name asc");
								while($FetchSection = mysqli_fetch_array($SelectSection))
								{
									if($_POST['section']==$FetchSection['id'])
										echo '<option value="'.$FetchSection['id'].'" selected>'.$FetchSection['name'].'</option>';
									else
										echo '<option value="'.$FetchSection['id'].'">'.$FetchSection['name'].'</option>';
								}
								?>
							</select>
					<?php
						}
						else 
							echo '<select name="section" id="section">
								<option value="">All</option>';?>
				</td>
				<td>
					<br/>
					<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
					<?php
					//if(mysqli_num_rows(Report_Department()) && $_POST['Search'])
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
	if(isset($_POST['class']))
		$Query .= "class.id='".$_POST['class']."' And ";
	if(isset($_POST['section']))
		$Query .= "section.id='".$_POST['section']."' ";
	$SelectClassAndSections = mysqli_query($_SESSION['connection'],"SELECT sum( student_fees.total_amount ) AS TotalAmount, ( sum( student_fees.total_amount ) - sum( student_fees.amount_pending )) as Pending,class.name as ClassName,section.name as SectionName,student_admission.admission_no as AdmissionNo,student_admission.first_name as StudentName FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON class.id=section.classid JOIN student_fees ON student_id=student_admission.id  ".str_replace("=''", "!=''", $Query)." group by admission_no");
	echo'<table class="paginate sortable full" style="width:600px">
			<thead>
				<tr>
					<th>Admission No</th>
					<th>Name</th>
					<th>Class</th>
					<th>Section</th>
					<th>Total Amount Payed</th>
					<th>Total Amount Pending</th>
				</tr>
			</thead>
			<tbody>';
				while($FetchClassAndSections = mysqli_fetch_array($SelectClassAndSections))
				{
					echo '<tr>
							<td align="center">'.$FetchClassAndSections['AdmissionNo'].'</td>
							<td align="center">'.$FetchClassAndSections['StudentName'].'</td>
							<td align="center">'.$FetchClassAndSections['ClassName'].'</td>
							<td align="center">'.$FetchClassAndSections['SectionName'].'</td>
							<td align="center">'.$FetchClassAndSections['TotalAmount'].'</td>
							<td align="center">'.$FetchClassAndSections['Pending'].'</td></tr>';
				}
			echo '</tbody>
		</table>';
}
/*else if($_POST['Search'] && $_POST['section'])
{
	$SelectStudentAdmission = mysqli_query($_SESSION['connection'],"SELECT class.name as ClassName,section.name as SectionName,student_admission.first_name FirstName,student_admission.last_name as LastName,student_admission.admission_no as AdmissionNum FROM `student_admission` JOIN section ON section.id=student_admission.section_id JOIN class ON class.id = section.classid where section_id='".$_POST['section']."'");
	echo'<table class="paginate sortable full" style="width:400px">
			<thead>
				<tr>
					<th>Admission Number</th>
					<th>Name</th>
					<th>Class</th>
					<th>Section</th>
				</tr>
			</thead>
			<tbody>';
	while($FetchStudentAdmission = mysqli_fetch_array($SelectStudentAdmission))
	{
		echo '<tr>
				<td align="center">'.$FetchStudentAdmission['AdmissionNum'].'</td>
				<td align="center">'.$FetchStudentAdmission['FirstName'].' '.$FetchStudentAdmission['LastName'].'</td>
				<td align="center">'.$FetchStudentAdmission['ClassName'].'</td>
				<td align="center">'.$FetchStudentAdmission['SectionName'].'</td>
		</tr>';
	}
	echo '</tbody>
		</table>';
}*/
	
	?>
<script>
	<?php
		if($_POST['summary'])
		{
	?>
		SectionHideAndShow('<?php echo $_POST['summary']; ?>');
	<?php 
		}
	?>
	function SectionHideAndShow(Summary)
	{
		if(Summary=="Summary")
			document.getElementById('sec').style.display = "none";
		else
			document.getElementById('sec').style.display = "block";
	}
	function GetSectionNames(ClassId)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else 
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById("section").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetSections.php?classid="+ClassId,true);
		xmlhttp.send();
	}
</script>