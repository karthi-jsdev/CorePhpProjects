<?php
	
	if(isset($_GET['export']))
	{
		$_POST['Search'] = $_GET['Search'];
		$_POST['month'] = $_GET['month'];
		session_start();
		ini_set("display_errors","0");
		include("Config.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace("-", "_",date("d-m-Y H-i")).".xls");
	}
	if($_POST['Search'])
	{
	$Query = "";
		if(isset($_POST['month']))
		{
			$ResourceUpdatenumbers = mysqli_query($_SESSION['connection'],"Select title.name as titlename,resource_update.titleid,resource_update.photo as Photo,resource_update.joiningdate as Joining,resource_update.leavingdate as Leaving,resource_update.reason,
												resource_update.id as id,designation.name as designationName,`group`.name as groupName,
												department.name as departmentName,resource_update.name as Name,resource_update.status as Status,resource_update.qualification AS qualification,
												resource_update.days as Days,resource_update.starttime as StartTime,resource_update.endtime as EndTime,resource_update.kmc,resource_update.mobile,resource_update.mail1,resource_update.mail2,resource_update.dob,resource_update.sex
												from resource_update JOIN designation ON designationid=designation.id JOIN
												department ON departmentid=department.id JOIN `group` ON resource_update.groupid=group.id
												JOIN `title` ON title.id = resource_update.titleid
												where EXTRACT(MONTH FROM resource_update.dob)  = ".$_POST['month']."
												ORDER BY `resource_update`.id DESC");
		}
		if(mysqli_num_rows($ResourceUpdatenumbers)!=0)
			{
				echo '<td>
							<br/>
								<div align="right"><a href="#" title="Download" onclick=\'Export()\'><img src="images/icons/download.png"></a></div>
				</td>';	
			}	
		echo '<div style="border:1px solid black;width:1000px;overflow-x:scroll;overflow-y: auto;">
		<table class="paginate sortable full" border="1">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Photo</th>
						<th align="left">Name</th>
						<th align="left">Designation</th>
						<th align="left">Qualification</th>
						<th align="left">Group</th>
						<th align="left">Department</th>
						<th align="left">D.O.B</th>
						<th align="left">Sex</th>
					</tr>
				</thead>
				<tbody>';
				$i=1;
				if(mysqli_num_rows($ResourceUpdatenumbers)==0)
						echo '<tr><td colspan="17"><font color="red"><center>No data found</center></font></td></tr>';
		$ResourceUpdate = mysqli_query($_SESSION['connection'],"Select title.name as titlename,resource_update.titleid,resource_update.photo as Photo,resource_update.joiningdate as Joining,resource_update.leavingdate as Leaving,resource_update.reason,
												resource_update.id as id,designation.name as designationName,`group`.name as groupName,
												department.name as departmentName,resource_update.name as Name,resource_update.status as Status,resource_update.qualification AS qualification,
												resource_update.days as Days,resource_update.starttime as StartTime,resource_update.endtime as EndTime,resource_update.kmc,resource_update.mobile,resource_update.mail1,resource_update.mail2,resource_update.dob,resource_update.sex
												from resource_update JOIN designation ON designationid=designation.id JOIN
												department ON departmentid=department.id JOIN `group` ON resource_update.groupid=group.id
												JOIN `title` ON title.id = resource_update.titleid
												where  EXTRACT(MONTH FROM resource_update.dob)  = ".$_POST['month']."
										ORDER BY `resource_update`.id DESC");
		$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");								
		while($Resource = mysqli_fetch_assoc($ResourceUpdate))
		{ 
			$Qualification = explode('$',$Resource['qualification']);
									$Days = explode('$',$Resource['Days']);
									$StartTime = explode(',',$Resource['StartTime']);
									$EndTime = explode(',',$Resource['EndTime']);
									echo "<tr style='valign:middle;'>
										<td align='center' style='vertical-align:middle'>".$i++."</td>
										<td><img src='data:image/jpeg;base64,".base64_encode($Resource['Photo'])."'  width='100px' height='150px' alt='photo'/></td>
										<td style='vertical-align:middle'>".$Resource['titlename'].".".$Resource['Name']."</td>
										<td style='vertical-align:middle'>".$Resource['designationName']."</td>
										<td style='vertical-align:middle'>".implode($Qualification,',')."</td>
										<td style='vertical-align:middle'>".$Resource['groupName']."</td>
										<td style='vertical-align:middle'>".$Resource['departmentName']."</td>
										<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['dob']))."</td>";
										if($Resource['sex']==0)
											echo "<td style='vertical-align:middle'>".Male."</td>";
										else	
											echo "<td style='vertical-align:middle'>".Female."</td>
									</tr>";
		} 
			echo '</tbody></table></div><br/>'; 
	}?>