<?php
	if(isset($_GET['export']))
	{
		$_POST['Search'] = $_GET['Search'];
		$_POST['departmentid'] = $_GET['departmentid'];
		$_POST['groupid'] = $_GET['groupid'];
		$_POST['name'] = $_GET['name'];
		$_POST['startdate'] = $_GET['startdate'];
		$_POST['enddate'] = $_GET['enddate'];
		session_start();
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
		if(isset($_POST['name']))
			$Query .= " resource_update.id='".$_POST['name']."' ";
		if($_POST['startdate'] && $_POST['enddate'])
			$Query .= " AND (startdate>='".date("Y-m-d",strtotime($_POST['startdate']))."' AND startdate<='".date("Y-m-d",strtotime($_POST['enddate']))."') OR (enddate>='".date("Y-m-d",strtotime($_POST['startdate']))."' AND enddate<='".date("Y-m-d",strtotime($_POST['enddate']))."')";
			//$Query .= " AND ((enddate between '".date("Y-m-d",strtotime($_POST['startdate']))."' AND '".date("Y-m-d",strtotime($_POST['enddate']))."'))";
			//$Query .= " AND (startdate >='".date("Y-m-d",strtotime($_POST['startdate']))."' OR enddate<='".date("Y-m-d",strtotime($_POST['enddate']))."')"; 
		//if($_POST['enddate'])
			//$Query .= " AND (enddate<='".date("Y-m-d",strtotime($_POST['enddate']))."' || enddate>='".date("Y-m-d",strtotime($_POST['enddate']))."')";
		$ResourceUpdatenumbers = mysqli_query($_SESSION['connection'],"SELECT * FROM `leave`
										JOIN resource_update ON `leave`.name = resource_update.id
										JOIN `group` ON resource_update.groupid = group.id
										JOIN department ON resource_update.departmentid = department.id 
										JOIN title ON title.id = resource_update.titleid where ".str_replace("=''","!=''",$Query)."
										ORDER BY `leave`.id DESC");
		if(mysqli_num_rows($ResourceUpdatenumbers)!=0)
			{
				echo '<td>
							<br/>
								<div align="right"><a href="#" title="Download" onclick=\'Export()\'><img src="images/icons/download.png"></a></div>
				</td>';	
			}	
		echo '<table class="paginate sortable full" border="1">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Name</th>
						<th align="left">Group</th>
						<th align="left">Department</th>
						<th align="left">Comments</th>
						<th align="left">Start Date</th>
						<th align="left">End Date</th>
					</tr>
				</thead>
				<tbody>';
				$i=1;
				if(mysqli_num_rows($ResourceUpdatenumbers)==0)
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
		$ResourceUpdate = mysqli_query($_SESSION['connection'],"SELECT title.name as title,`leave`.id,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName ,resource_update.photo
										FROM `leave`
										JOIN resource_update ON `leave`.name = resource_update.id
										JOIN `group` ON resource_update.groupid = group.id
										JOIN department ON resource_update.departmentid = department.id 
										JOIN title ON title.id = resource_update.titleid where ".str_replace("=''","!=''",$Query)."
										ORDER BY `leave`.id DESC");
		while($Resource = mysqli_fetch_assoc($ResourceUpdate))
		{ 
			echo "<td>".($i++)."</td>";
			echo "<td>".$Resource['title'].".".$Resource['Name']."</td>";
			echo "<td>".$Resource['groupName']."</td>";
			echo "<td>".$Resource['departmentName']."</td>";
			echo "<td>".$Resource['comments']."</td>";
			echo "<td>".date('d-m-Y',strtotime($Resource['startdate']))."</td>";
			echo "<td>".date('d-m-Y',strtotime($Resource['enddate']))."</td>
			</tr></tbody>";
		} 
			echo '</table><br/>'; 
	}?>