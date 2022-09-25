<link rel="stylesheet" type="text/css" href="style.css">
<?php
		echo '<div style="float:left;margin-top:100px;margin-left:-100px;width:250px">';
		$sql1 = mysql_query("SELECT * FROM taskstatus");
		if(mysql_num_rows($sql1))
		{
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th align='left'>Status</th>
						<th align='left'>No. of Items</th>
					</tr>";
					echo "<tr><td>";?> 
					<a href="#" style='text-decoration:underline;' onclick="loadtaskstatus('includes/gettask.php')">All</a></td>
					
					<?php
					$query1 = mysql_query("SELECT * FROM task");
							echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($query1)."</a></td>";	
					
					echo "</tr>";
					while($row1 = mysql_fetch_array($sql1))
					{
						echo "<tr><td>";
						?><a href="#" style='text-decoration:underline;' onclick='loadtaskstatus("includes/gettask.php?status=<?php echo $row1['tstatus']; ?>")'><?php echo $row1['tstatus']."</a></td>";
						if($row1['tstatus'] == "Open")
						{
							//$open = mysql_query("SELECT * FROM task WHERE status='".$row1['tstatus']."'");
							$query = mysql_query("SELECT * FROM task WHERE taskid IN (SELECT tskid FROM taskcomments WHERE tstatus ='".$row1['tstatus']."' and enable='1') OR status='".$row1['tstatus']."'");
							$var = mysql_num_rows($open)+mysql_num_rows($query);
							echo "<td><a style='text-decoration:underline;'>".$var."</a></td>";	
							echo "</tr>";
						}
						else
						{
							$query = mysql_query("SELECT * FROM task WHERE taskid IN (SELECT tskid FROM taskcomments WHERE tstatus ='".$row1['tstatus']."' and enable='1')");
								echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($query)."</a></td>";	
							echo "</tr>";
						}
					}	
			echo "</table><br>";
		}
		$queryAssignee = mysql_query("SELECT * FROM assignee");
		echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th align='left'>Task Assignee</th>
						<th align='left'>No. of Tasks</th>
					</tr>";
		while($fetchAssignee = mysql_fetch_array($queryAssignee))
		{
			echo "<tr><td>";?><a href="#" style='text-decoration:underline;' onclick='loadtaskstatus("includes/gettask.php?assignee=<?php echo $fetchAssignee['id'];?>")'><?php
			echo $fetchAssignee['name']."</a></td>";
			$noOfTaskQuery = mysql_query("SELECT * FROM task WHERE assignee='".$fetchAssignee['id']."' AND taskid NOT IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1)");
			echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($noOfTaskQuery)."</a></td>
			</tr>";
		}
	echo "</table><br>";
	echo "<table border='1'  align='left' class='paginate sortable full1'>
		<tr>
			<th align='left'>Task Assignee</th>
			<th align='left'>Closed Tasks</th>
		</tr>";
		$queryAssignee = mysql_query("SELECT * FROM assignee");
		while($fetchAssignee = mysql_fetch_array($queryAssignee))
		{
			echo "<tr><td>";?><a href="#" style='text-decoration:underline;' onclick='loadtaskstatus("includes/gettask.php?assignee1=<?php echo $fetchAssignee['id'];?>")'><?php
			echo $fetchAssignee['name']."</a></td>";
			$noOfTaskQuery = mysql_query("SELECT * FROM task WHERE assignee='".$fetchAssignee['id']."' AND taskid IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1)");
			echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($noOfTaskQuery)."</a></td>
			</tr>";
		}
	echo "</table>
	
	</div>";
?>
 <script>
 function loadtaskstatus(file)
 {	
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{	
			var results = xmlhttp.responseText;
			var split1 = results.split('#');	
			document.getElementById('sub').innerHTML = split1[1];
			document.getElementById('sub1').innerHTML = split1[0];
		}
	}
	xmlhttp.open("GET",file,true);
	xmlhttp.send();
 }
 </script>
<?php
	echo "<table>
	<tr><td style='width:700px'></td>";
	if(isset($_GET['id']))
	{?>
		<td><button onclick='window.location.href="?page=leadsummary&id=<?php echo $_GET['id'];?>"'>Lead Summary</button></td><td></td>
		<td><button onclick='window.location.href="?page=leads"'>Lead</button></td><td></td>
	<?php 
	}
	if(isset($_GET['id'])&& $_GET['ptcid'])
	{?>
		<td><button onclick='window.location.href="?page=leadstatus&ptcid=<?php echo $_GET['ptcid'];?>&id=<?php echo $_GET['id'];?>"'>Lead Status</button></td>		
	<?php 
	}
	echo	"</tr>
	</table>";
	include("config.php");
	$result = mysql_query("SELECT * FROM task");
	$rowsperpage = 25;
	$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
	if(!$_GET['pageno'])
		$_GET['pageno']=1;		
	if($_GET['pageno']>1)
		$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
	else
		$Limit = "LIMIT 0,".$rowsperpage;
	
	if(!$_GET['assignee'] && !$_GET['status'] && !$_GET['assignee1'])
		$sql = mysql_query("SELECT * FROM task ORDER BY tdate DESC $Limit");
	else if($_GET['assignee'])
		$sql = mysql_query("SELECT * FROM task WHERE assignee='".$_GET['assignee']."'  AND taskid NOT IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1) ORDER BY tdate DESC $Limit");
	else if($_GET['status'])
		$sql = mysql_query("SELECT * FROM task WHERE status='".$_GET['status']."' OR taskid IN(SELECT tskid FROM taskcomments WHERE tstatus='".$_GET['status']."' AND enable=1) ORDER BY tdate DESC $Limit");
	else
		$sql = mysql_query("SELECT * FROM task WHERE assignee='".$_GET['assignee1']."' AND taskid IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1) ORDER BY tdate DESC $Limit");
	if($_GET['assignee'])
		$getassignee = $_GET['assignee'];
	else if($_GET['assignee1'])
		$getassignee = $_GET['assignee1'];
	$getAssignee = mysql_fetch_array(mysql_query("SELECT * FROM assignee WHERE id='".$getassignee."'"));
	if(mysql_num_rows($sql))
	{
		echo '<div style="float:left;margin-top:-600px;margin-left:150px;width:900px;height:1250px;">';
		if(!$_GET['assignee'] && !$_GET['status'] && !$_GET['assignee1'])
			echo "<table id='sub1'><tr><td><h1>Task Summary of All </h1><td></tr></table>";
		else if($_GET['status'])
			echo "<table id='sub1'><tr><td><h1>Task Summary of ".$_GET['status']." </h1><td></tr></table>";
		else if($_GET['assignee1'])	
			echo "<table id='sub1'><tr><td><h1>Task Summary of ".$getAssignee['name']." And Closed Tasks </h1><td></tr></table>";
		else if($_GET['assignee'])	
			echo "<table id='sub1'><tr><td><h1>Task Summary of ".$getAssignee['name']."</h1><td></tr></table>";
		echo "<div style='width:1000px;height:550px;overflow-x:hidden;overflow-y:auto;'>";
		echo "<table  border='1'  align='left' class='paginate sortable full' id='sub'>
			<tr>
				<th align='center'>Task-ID</th>
				<th align='center'>Client</th>
				<th align='center'>Task Date</th>
				<th align='center'>Task Description</th>
				<th align='center'>Target Date</th>
				<th align='center'>Assignee</th>
				<th align='center'>Status</th>
			</tr>";
		while($row = mysql_fetch_array($sql))
		{
			echo "<tr>
			<td align='center'><a href='?page=taskstatus&id=".$row['taskid']."&ptclid=".$row['ptclid']."'>".$row['taskid']."</a></td>";
			if($row['ptclid'] != "Others")
			{
				$client_id = mysql_fetch_array(mysql_query("SELECT * FROM lead WHERE ptclid='".$row['ptclid']."' "));
				$client_name = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid='".$client_id['cname']."' "));
				echo "<td>".$client_name['cname']."</td>";
			}
			else
				echo "<td align='center'>".$row['ptclid']."</td>";
			echo "<td align='center'>".$row['taskdate']."</td>
			<td align='center'>".$row['tdesc']."</td>
			<td align='center'>".$row['tdate']."</td>";
			$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
			$row1=mysql_fetch_array($query1);
			echo "<td align='center'>".$row1['name']."</td>";
			$status_id = mysql_fetch_array(mysql_query("Select * From taskcomments Where tskid='".$row['taskid']."' AND enable=1"));
			if($status_id)
				echo "<td align='center'>".$status_id['tstatus']."</td>";
			else
				echo "<td align='center'>Open</td>";
			echo "</tr>";	
		}	
		echo "</table></div>";
	}
	else
	{
		echo '<div style="float:left;margin-top:-200px;margin-left:150px;width:900px;height:1250px;">';
		echo "<table id='sub1'></table><div style='width:1000px;height:550px;overflow-x:hidden;overflow-y:auto;'>
		<table  border='1'  align='left' class='paginate sortable full' id='sub'>
		<tr><td></td><td>";
		echo "No Tasks Found</td></tr>
		</table></div></div>";
	}
	echo '<div style="float:left;margin-top:20px;margin-left:400px;width:2000px">';
		include("includes/pagination.php");
	echo "</div></div>";
?>