<?php 
include("config.php");
$fetch_assignee = mysql_fetch_array(mysql_query("select * from user where username = '".$_GET['user']."'"));
?>
<table border='1'  align= 'left' class='paginate sortable1' width='150'>
	<?php
	$task = mysql_query("select * from task WHERE assignee='".$fetch_assignee['assignee']."'");
	$tasknum = mysql_num_rows($task);
	?>
		<tr>
			<td>
				<a href='#' onclick="loadtaskstatus('<?php echo $fetch_assignee['assignee'];?>')" style='text-decoration:underline;'>All Task</a>
			</td>
			<td>
			<a><?php echo $tasknum;?></a>
			</td>
		</tr>
		<tr>
			<td>
				<a href='#' onclick="loadtaskstatus('day')" style='text-decoration:underline;'>Todays Task </a>
				</td>
				<td>
					<a>
					<?php
					$task = mysql_query("select * from task where assignee='".$fetch_assignee['assignee']."' AND tdate='".date('Y-m-d')."'");
					echo $tasknum = mysql_num_rows($task);
					?>
					</a>
				</td>	
		</tr>
		<tr>
			<td>
			<a href='#' onclick="loadtaskstatus('week')" style='text-decoration:underline;'>This Week Task</a>
			</td>
			<td>
			<a>
				<?php
				$task = mysql_query("select * from task where assignee='".$fetch_assignee['assignee']."' AND  tdate>'".date('Y-m-d')."' and tdate<'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."'");
				echo $tasknum = mysql_num_rows($task);
				?>
			</a>
		</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('nextweek')" style='text-decoration:underline;'>Next Week Task</a>
				</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee='".$fetch_assignee['assignee']."' AND  tdate>'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' and tdate<'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
			</tr>
		<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('future')" style='text-decoration:underline;'>Future Task</a>
				</td>
			<td>
				<a>
					<?php
						$task = mysql_query("select * from task where assignee='".$fetch_assignee['assignee']."' AND  tdate>'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."'");
						echo $tasknum = mysql_num_rows($task);
					?>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href='#' onclick="loadtaskstatus('overdue')" style='text-decoration:underline;'>Overdue Task</a>
			</td>
			<td>
				<a>
					<?php
						$task = mysql_query("select * from task where assignee='".$fetch_assignee['assignee']."' AND  tdate<'".date('Y-m-d')."' and tstatus<=4");
						echo $tasknum = mysql_num_rows($task);
					?>
				</a>
			</td>
		</tr>
	</table>
<?php
/*	include("config.php");
	$fetch_assignee = mysql_fetch_array(mysql_query("select * from user where username = '".$_GET['user']."'"));
		$task = mysql_query("select * from task where assignee = '".$fetch_assignee['assignee']."'");
	echo ''.
	"<table><tr><td><h1>Task Summary of All </h1><td></tr></table>#
	<table  border='1'  align='left' class='paginate sortable full' id='sub'>
		<tr>
			<th>Task-ID</th>
			<th>Lead-ID</th>
			<th>Task Date</th>
			<th>Task Description</th>
			<th>Target Date</th>
			<th>Assigneee</th>
			<!--th>Status</th-->
		</tr>";
			while($row = mysql_fetch_array($task))
						{
							echo "<tr>
							<td><a href='?page=taskstatus&id=".$row['taskid']."&ptclid=".$row['ptclid']."'>".$row['taskid']."</a></td>
							<td>".$row['ptclid']."</td>
							<td>".$row['taskdate']."</td>
							<td>".$row['tdesc']."</td>
							<td>".$row['tdate']."</td>
							<td>".$row['assignee']."</td>
							</tr>";	
						}	
						echo "</table>";*/
?>