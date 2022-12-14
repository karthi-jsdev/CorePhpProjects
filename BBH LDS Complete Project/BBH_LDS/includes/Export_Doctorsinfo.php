<?php
	
	if(isset($_GET['export']))
	{
		$_POST['Search'] = $_GET['Search'];
		$_POST['departmentid'] = $_GET['departmentid'];
		$_POST['groupid'] = $_GET['groupid'];
		$_POST['designationid'] = $_GET['designationid'];
		$_POST['status'] = $_GET['status'];
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
		if(isset($_POST['departmentid']))
			$Query .= " resource_update.departmentid='".$_POST['departmentid']."' and ";
		if(isset($_POST['groupid']))
			$Query .= " resource_update.groupid='".$_POST['groupid']."' and ";
		if(isset($_POST['designationid']))
			$Query .= " resource_update.designationid='".$_POST['designationid']."' and ";
		if(isset($_POST['status']))
			$Query .= "resource_update.status='".$_POST['status']."' ";
		$ResourceUpdatenumbers = mysqli_query($_SESSION['connection'],"Select title.name as titlename,resource_update.titleid,resource_update.photo as Photo,resource_update.joiningdate as Joining,resource_update.leavingdate as Leaving,resource_update.reason,
												resource_update.id as id,designation.name as designationName,`group`.name as groupName,
												department.name as departmentName,resource_update.name as Name,resource_update.status as Status,resource_update.qualification AS qualification,
												resource_update.days as Days,resource_update.starttime as StartTime,resource_update.endtime as EndTime,resource_update.kmc,resource_update.mobile,resource_update.mail1,resource_update.mail2,resource_update.dob,resource_update.sex
												from resource_update JOIN designation ON designationid=designation.id JOIN
												department ON departmentid=department.id JOIN `group` ON resource_update.groupid=group.id
												JOIN `title` ON title.id = resource_update.titleid
												where ".str_replace("=''","!=''",$Query)."
												ORDER BY `resource_update`.id DESC");
		if(mysqli_num_rows($ResourceUpdatenumbers)!=0)
			{
				echo '<td>
							<br/>
								<div align="right"><a href="#" title="Download" onclick=\'Export()\'><img src="images/icons/download.png"></a></div>
				</td>';	
			}	
		echo '<div style="border:1px solid black;width:1100px;overflow-x:scroll;overflow-y: auto;">
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
						<th align="left">Joining Date</th>
						<th align="left">Leaving Date/Reason</th>
						<th align="left">Status</th>
						<th align="left" colspan="2">Days-StartTime-EndTime</th>
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
												 where ".str_replace("=''","!=''",$Query)."
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
										<td style='vertical-align:middle'>".$Resource['departmentName']."</td>";
										if($Resource['Joining'])
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Joining']))."</td>";
										else	
											echo "<td style='vertical-align:middle'>-</td>";
										if($Resource['reason'] == '1' && $Resource['Leaving']!="")
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Study Leave"."</td>";
										else if($Resource['reason'] == '2' && $Resource['Leaving']!="")
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Sabbatical Leave"."</td>";
										else if($Resource['reason'] == '3' && $Resource['Leaving']!="")
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Resigned"."</td>";
										else if($Resource['reason'] == '4' && $Resource['Leaving']!="")
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Completed the Course"."</td>";
										else	
											echo "<td style='vertical-align:middle'>-</td>";
										if($Resource['Status']=="Visiting")
										{
											echo "<td style='vertical-align:middle'>".$Resource['Status']."</td>
											<td style='vertical-align:middle' colspan='3'>";
											foreach($Days as $Day)
												echo $days[$Day-1].' - '.date("H:i",strtotime($StartTime[$Day-1])).' - '.date("H:i",strtotime($EndTime[$Day-1])).'<br/>';
											echo "</td>";
										}
										else
											echo "<td style='vertical-align:middle'>".$Resource['Status']."</td><td style='vertical-align:middle'><center>-</center></td>";
										
							echo 	"</tr>";
		} 
			echo '</tbody></table></div><br/>'; 
	}?>