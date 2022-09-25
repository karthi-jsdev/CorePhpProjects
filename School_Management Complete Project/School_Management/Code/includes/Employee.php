<div class="form panel">
	<form method='post' action=''>
		<hr/>
		<table>
			<tr>
				<td>
					<b>Staff Name:</b>
					<br/>
					<select name="name" id="name">	
						<option value="">All</option>
						<?php
						$SelectStaffName = mysql_query("select * from staff_details  group by name");
						while($FetchStaffName = mysql_fetch_array($SelectStaffName))
						{
							if($_POST['name']==$FetchStaffName['name'])
								echo '<option value="'.$FetchStaffName['name'].'" selected>'.$FetchStaffName['name'].'</option>';
							else
								echo '<option value="'.$FetchStaffName['name'].'">'.$FetchStaffName['name'].'</option>';
						}
						?>
					</select>
				</td>
				<td>
					<b>Class:</b>
					<br/>
					<select name="class" id="class" onchange="GetSectionNames(this.value)">
						<option value="">All</option>
						<?php
						$SelectClass = mysql_query("select * from class order by name asc");
						while($FetchClass = mysql_fetch_array($SelectClass))
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
					<select name="section" id="section">
						<option value="">All</option>
						<?php
						$SelectSection = mysql_query("select * from section order by name asc");
						while($FetchSection = mysql_fetch_array($SelectSection))
						{
							if($_POST['section']==$FetchSection['id'])
								echo '<option value="'.$FetchSection['id'].'" selected>'.$FetchSection['name'].'</option>';
							else
								echo '<option value="'.$FetchSection['id'].'">'.$FetchSection['name'].'</option>';
						}
						?>
					</select>
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
		if(isset($_POST['name']))
			$Query .= "staff_details.name='".$_POST['name']."' ";
		if(isset($_POST['section']))
			$Query .= "and staff_details.section_id='".$_POST['section']."' ";
		if(isset($_POST['class']))
			$Query .= "and  classid='".$_POST['class']."'";
		$SelectEmployee = mysql_query("SELECT staff_details.name as StaffName,section.name as SectionName, class.name as ClassName, staff_details.subject_ids as SubjectIds From staff_details JOIN section ON section.id=staff_details.section_id JOIN class ON class.id = classid ".str_replace("=''", "!=''", $Query));
		echo'<table class="paginate sortable full" style="width:800px">
			<thead>
				<tr>
					<th>Staff Name</th>
					<th>Class</th>
					<th>Section</th>
					<th>Subjects</th>
				</tr>
			</thead>';
			$Subjects = array();
				while($FetchEmployee = mysql_fetch_array($SelectEmployee))
				{
					$SubjectNames = explode(',',$FetchEmployee['SubjectIds']);
					foreach($SubjectNames as $SubjectName)
					{
						$Sub = mysql_fetch_array(mysql_query("select name from subject where id='".$FetchEmployee['SubjectIds']."'"));
						$Subjects[] = $Sub['name'];
					}
					echo '<tr>
							<td align="center">'.$FetchEmployee['StaffName'].'</td>
							<td align="center">'.$FetchEmployee['ClassName'].'</td>
							<td align="center">'.$FetchEmployee['SectionName'].'</td>
							<td align="center">'.implode($Subjects,',').'</td>';
					echo '<tr>';
					unset($Subjects);
				}
		echo '</table>';
	}
	?>