<button class='btn1' style='width:965px;height:30px'>Hide</button>
<button class='btn2' style='width:965px;height:30px'>Over All Task</button>
<?php 
	session_start();
	include("config.php");
	ini_set("display_errors","0");
	$assignee = mysql_fetch_array(mysql_query("select * from assignee where name ='".$row1['assignee']."'"));
	?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
	$(function ()
	{
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Task Status Reports'
            },
            subtitle: {
                //text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories:
				[
                    '<?php  echo date('Y-m-d',time()+( 1 - date('w'))*24*3600);?>','<?php echo date('Y-m-d',strtotime('-2 Monday'));?>','<?php echo date('Y-m-d',strtotime('-3 Monday'));?>','<?php echo date('Y-m-d',strtotime('-4 Monday'));?>'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Number Of Tickets',
                data: [<?php
									$status_open1 = mysql_query("select * from task where status = 'Open' AND taskdate<='".date('Y-m-d',time()+( 1 - date('w'))*24*3600)."'  AND taskdate>'".date('Y-m-d',strtotime('-2 Monday'))."'");
									$var = mysql_num_rows($status_open1);
									echo $var;?>,
						
								<?php
									$status_open2 = mysql_query("select * from task where  status = 'Open' AND taskdate<='".date('Y-m-d',strtotime('-2 Monday'))."' and taskdate>'".date('Y-m-d',strtotime('-3 Monday'))."'");
									$var = mysql_num_rows($status_open2);
									echo $var;
								?>,
						
								<?php
									$status_open3 = mysql_query("select * from task where   status = 'Open' AND taskdate<='".date('Y-m-d',strtotime('-3 Monday'))."' and taskdate>'".date('Y-m-d',strtotime('-4 Monday'))."'");
									$var = mysql_num_rows($status_open3);
									echo $var;
								?>,
						
								<?php
									$status_open4 = mysql_query("select * from task where status = 'Open' and taskdate<='".date('Y-m-d',strtotime('-4 Monday'))."' AND taskdate>'".date('Y-m-d',strtotime('-5 Monday'))."'");
									$var = mysql_num_rows($status_open4);
									echo $var;
								?>]
            },
			{
                name: 'Open',
                data: [<?php
									$status_inprogress1 = mysql_query("select * from task where status='Open' OR taskid IN(select tskid from taskcomments where tstatus = 'Open' AND enable=1 AND tdate<='".date('Y-m-d',time()+( 1 - date('w'))*24*3600)."'  AND tdate>'".date('Y-m-d',strtotime('-2 Monday'))."')");
									$var = mysql_num_rows($status_inprogress1);
									echo $var;?>,
						
								<?php
										$status_inprogress2 = mysql_query("select * from task where status='Open' OR taskid IN (select * from taskcomments where tstatus = 'Open' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-2 Monday'))."' and tdate>'".date('Y-m-d',strtotime('-3 Monday'))."')");
										$var = mysql_num_rows($status_inprogress2);
										echo $var;
								?>,
						
								<?php
									$status_inprogress3 = mysql_query("select * from task where status = 'Open' OR taskid IN (select * from taskcomments where tstatus = 'Open' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-3 Monday'))."' and tdate>'".date('Y-m-d',strtotime('-4 Monday'))."')");
									$var = mysql_num_rows($status_inprogress3);
									echo $var;
								?>,
						
								<?php
								$status_inprogress4 = mysql_query("select * from task where status = 'Open' OR taskid IN (select * from taskcomments where tstatus = 'Open' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-4 Monday'))."'and tdate>'".date('Y-m-d',strtotime('-5 Monday'))."')");
								$var = mysql_num_rows($status_inprogress4);
								echo $var;
								?>]
    
            },
			{
                name: 'Inprogress',
                data: [<?php
									$status_inprogress1 = mysql_query("select * from taskcomments where tstatus = 'Inprogress' AND enable=1 AND tdate<='".date('Y-m-d',time()+( 1 - date('w'))*24*3600)."'  AND tdate>'".date('Y-m-d',strtotime('-2 Monday'))."'");
									$var = mysql_num_rows($status_inprogress1);
									echo $var;?>,
						
								<?php
										$status_inprogress2 = mysql_query("select * from taskcomments where tstatus = 'Inprogress' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-2 Monday'))."' and tdate>'".date('Y-m-d',strtotime('-3 Monday'))."'");
										$var = mysql_num_rows($status_inprogress2);
										echo $var;
								?>,
						
								<?php
									$status_inprogress3 = mysql_query("select * from taskcomments where tstatus = 'Inprogress' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-3 Monday'))."' and tdate>'".date('Y-m-d',strtotime('-4 Monday'))."'");
									$var = mysql_num_rows($status_inprogress3);
									echo $var;
								?>,
						
								<?php
								$status_inprogress4 = mysql_query("select * from taskcomments where tstatus = 'Inprogress' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-4 Monday'))."'and tdate>'".date('Y-m-d',strtotime('-5 Monday'))."'");
								$var = mysql_num_rows($status_inprogress4);
								echo $var;
								?>]
    
            }, {
                name: 'Reopened',
                data: [<?php
									$status_reopened1 = mysql_query("select * from taskcomments where tstatus = 'Reopened' AND enable=1 AND tdate<='".date('Y-m-d',time()+( 1 - date('w'))*24*3600)."'  AND tdate>'".date('Y-m-d',strtotime('-2 Monday'))."'");
									$var = mysql_num_rows($status_reopened1);
									echo $var;?>,						
								<?php
									$status_reopened2 = mysql_query("select * from taskcomments where tstatus = 'Reopened' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-2 Monday'))."' and tdate>'".date('Y-m-d',strtotime('-3 Monday'))."'");
									$var = mysql_num_rows($status_reopened2);
									echo $var;
								?>,
						
								<?php
									$status_reopened3 = mysql_query("select * from taskcomments where tstatus = 'Reopened' AND enable=1 AND tdate<='".date('Y-m-d',strtotime('-3 Monday'))."' and tdate>'".date('Y-m-d',strtotime('-4 Monday'))."'");
									$var = mysql_num_rows($status_reopened3);
									echo $var;
								?>,
						
								<?php
									$status_reopened4 = mysql_query("select * from taskcomments where tstatus = 'Reopened' AND enable=1 and tdate<='".date('Y-m-d',strtotime('-4 Monday'))."' AND tdate>'".date('Y-m-d',strtotime('-5 Monday'))."'");
									$var = mysql_num_rows($status_reopened4);
									echo $var;
								?>]
    
            }]
        });
    });
</script>
<script src="js/Highcharts-3.0.4/highcharts.js"></script>
<script src="js/Highcharts-3.0.4/modules/exporting.js"></script>
<?php
if($row1['role'] != 'user')
{ ?>
	<h>
	<div id="container"style=' float:left;margin-top:50px;margin-left:800px;width:410px;height:300px;'></div>
	</h>
	<div style="float:left;margin-top:100px;margin-left:800px;width:400px;">
		Filter By:
		<select onchange="drawChartDynamic(this.value)">
			<option value="status">Status</option>
			<option value="product">Product</option>
			<option value="assignee">Assignee</option>
		</select>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
				google.load("visualization", "1", {packages:["corechart"]});
				google.setOnLoadCallback(drawChart);
				var test;
				function drawChart()
				{
					if(!test)
					{
						var data = google.visualization.arrayToDataTable([
							['Task', 'Hours per Day'],
							<?php
							$status_query = mysql_query("select * from status"); 
							$i = 0;
							while($row1 = mysql_fetch_array($status_query))
							{
								$status_query1 = mysql_query("select * from comments where status_id = '".$row1['slno']."' AND enable=1");
								?>
								['<?php echo $row1['status'];?>',<?php echo mysql_num_rows($status_query1); ?>]
								<?php
								if($i++ < mysql_num_rows($status_query))
									echo ",";
							} ?>
						]);
					}
					var options = {
					title: 'Lead Activities'
					};
					var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
					chart.draw(data, options);					
					if(test)
					{
						var xmlhttp;
						if(window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp=new XMLHttpRequest();
						}
						else
						{// code for IE6, IE5
							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange=function()
						{
							if(xmlhttp.readyState==4 && xmlhttp.status==200)
							{
								var result = xmlhttp.responseText.split(",");
								var data1 = google.visualization.arrayToDataTable([
								['Task','Hours per Day'],
								[result[1], parseInt(result[2])],
								[result[3], parseInt(result[4])],
								[result[5], parseInt(result[6])],
								[result[7], parseInt(result[8])],
								[result[9], parseInt(result[10])],
								[result[11], parseInt(result[12])],
								[result[13], parseInt(result[14])],
								[result[15], parseInt(result[16])],
								[result[17], parseInt(result[18])]
								]);
								var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
								chart.draw(data1, options);
							}
						}
						xmlhttp.open("GET","includes/getchart.php?param="+test,true);
						xmlhttp.send();
					}
				}
				function drawChartDynamic(str)
				{
					test = str;					
					drawChart();
				}
			</script>
			<div id="chart_div" ></div>
		</div>
	<?php
	}
		if($row1['role'] != 'user')
			echo "<h><div style='float:left;margin-top:-652px;margin-left:-200px;width:1500px;'>";
		else
			echo "<h><div style='float:left;margin-right:52px;'>"
		?>
		<h2><?php echo Ucfirst($row1['username'])." Task";?></h2>
		<table border='1'  align='left' class='paginate sortable1' width='150'>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('overdue','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Overdue Task</a>
				</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee='".$assignee['id']."' AND  tdate<'".date('Y-m-d')."' and tstatus<=4 AND tstatus != 'Closed'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('day','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Todays Task </a>
				</td>
				<td>
					<a>
						<?php
						$task = mysql_query("select * from task where assignee='".$assignee['id']."' AND tdate='".date('Y-m-d')."' AND tstatus != 'Closed'");
						echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>	
			</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('week','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>This Week Task</a>
				</td>
				<td>
					<a>
						<?php
						$task = mysql_query("select * from task where assignee='".$assignee['id']."' AND  tdate>'".date('Y-m-d')."' and tdate<'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' AND tstatus != 'Closed'");
						echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('nextweek','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Next Week Task</a>
				</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee='".$assignee['id']."' AND  tdate>'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' and tdate<'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."' AND tstatus != 'Closed'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('future','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Future Task</a>
				</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee='".$assignee['id']."' AND  tdate>'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."' AND tstatus != 'Closed'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<?php
				$task = mysql_query("select * from task WHERE assignee='".$assignee['id']."' AND tstatus != 'Closed'");
				$tasknum = mysql_num_rows($task);
			?>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus('<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>All Task</a>
				</td>
				<td>
					<a><?php echo $tasknum;?></a>
				</td>
			</tr>
		</table>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<?php
		
		if($row1['role'] != 'user')
		{ ?>
		<h2><?php echo "Other User Task";?></h2>
		<table border='1'  align= 'left' class='paginate sortable1' width='150' >
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus1('overdue','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Overdue Task</a>
				</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee!='".$assignee['id']."' AND  tdate<'".date('Y-m-d')."' and tstatus<=4 AND tstatus != 'Closed'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus1('day','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Todays Task </a>
				</td>
				<td>
					<a>
					<?php
					$task = mysql_query("select * from task where assignee!='".$assignee['id']."' AND tdate='".date('Y-m-d')."' AND tstatus != 'Closed'");
					echo $tasknum = mysql_num_rows($task);
					?>
					</a>
				</td>	
			</tr>
			<tr>
				<td>
				<a href='#' onclick="loadtaskstatus1('week','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>This Week Task</a>
				</td>
				<td>
					<a>
						<?php
						$task = mysql_query("select * from task where assignee!='".$assignee['id']."' AND  tdate>'".date('Y-m-d')."' and tdate<'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' AND tstatus != 'Closed'");
						echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus1('nextweek','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Next Week Task</a>
				</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee!='".$assignee['id']."' AND  tdate>'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' and tdate<'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."' AND tstatus != 'Closed'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>	
			</tr>
			<tr>
					<td>
						<a href='#' onclick="loadtaskstatus1('future','<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>Future Task</a>
					</td>
				<td>
					<a>
						<?php
							$task = mysql_query("select * from task where assignee!='".$assignee['id']."' AND  tdate>'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."' AND tstatus != 'Closed'");
							echo $tasknum = mysql_num_rows($task);
						?>
					</a>
				</td>
			</tr>
			<?php
				$task = mysql_query("select * from task WHERE assignee!='".$assignee['id']."' AND tstatus != 'Closed'");
				$tasknum = mysql_num_rows($task);
			?>
			<tr>
				<td>
					<a href='#' onclick="loadtaskstatus1('<?php echo $assignee['id'];?>')" style='text-decoration:underline;'>All Task</a>
				</td>
				<td>
				<a><?php echo $tasknum;?></a>
				</td>
			</tr>
		</table>
		<?php 
		
		}?>
	</div>
	<br/>
	<?php
	if($row1['role']!='user')
		echo '<div style="float:left;margin-top:-650px;margin-left:-10px;width:500px;height:3000px;"  />';
	else	
		echo '<div style="float:left;margin-top:0px;margin-left:-10px;width:500px;height:3000px;"  />';
				$task = mysql_query("select * from task where assignee = '".$assignee['id']."' AND tdate<'".date('Y-m-d')."' and tstatus!='Closed' and tstatus<=4 ORDER BY tdate ASC");
				echo "<table><tr><td><h1>Task Summary of All </h1><td></tr></table>
					<table  border='1'  align='left' class='paginate sortable full1' style='width:800px' id='sub'>
					<tr>
						<th>Task-ID</th>
						<th>Lead-ID</th>
						<th>Task Date</th>
						<th>Task Description</th>
						<th>Target Date</th>
						<th>Assignee</th>
						<th>Status</th>
					</tr>";
					while($row = mysql_fetch_array($task))
					{
						echo "<tr>
						<td><a href='?page=taskstatus&id=".$row['taskid']."&ptclid=".$row['ptclid']."'>".$row['taskid']."</a></td>
						<td>".$row['ptclid']."</td>
						<td>".$row['taskdate']."</td>
						<td>".$row['tdesc']."</td>
						<td>".$row['tdate']."</td>";
						$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
						$row2=mysql_fetch_array($query1);
						echo "<td align='center'>".$row2['name']."</td>";
						$query2 = mysql_query("SELECT * FROM taskcomments  where tskid='".$row['taskid']."'AND enable=1");
						$row2=mysql_fetch_array($query2);
							if($row2['tstatus'])
								echo "<td align='center'>".$row2['tstatus']."</td>";
							else
								echo "<td align='center'>Open</td>";
							echo "</tr>";	
					}	
					echo "</table>";
			if($row1['role'] != 'user')
			{
				$task1 = mysql_query("select * from task where assignee != '".$assignee['id']."' AND tdate<'".date('Y-m-d')."' and tstatus!='Closed' and tstatus<=4 ORDER BY tdate ASC");
					echo "<table><tr><td><h1>Task Summary of All </h1><td></tr></table>
					<table  border='1'  align='left' class='paginate sortable full1' style='width:800px' id='sub1'>
					<tr>
						<th>Task-ID</th>
						<th>Lead-ID</th>
						<th>Task Date</th>
						<th>Task Description</th>
						<th>Target Date</th>
						<th>Assignee</th>
						<th>Status</th>
					</tr>";
					while($row = mysql_fetch_array($task1))
					{
						echo "<tr>
						<td><a href='?page=taskstatus&id=".$row['taskid']."&ptclid=".$row['ptclid']."'>".$row['taskid']."</a></td>
						<td>".$row['ptclid']."</td>
						<td>".$row['taskdate']."</td>
						<td>".$row['tdesc']."</td>
						<td>".$row['tdate']."</td>";
						$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
						$row1=mysql_fetch_array($query1);
						echo "<td align='center'>".$row1['name']."</td>";
						$query2 = mysql_query("SELECT * FROM taskcomments  where tskid='".$row['taskid']."' AND enable=1");
						$row2=mysql_fetch_array($query2);
						if($row2['tstatus'])
						{
							echo "<td align='center'>".$row2['tstatus']."</td>";
						}
						else
						{
							echo "<td align='center'>Open</td>";	
						}
							echo "</tr>";	
					}	
					echo "</table>";	
			}
			?>				
	</div>
	</h>
<script>
	$(document).ready(function()
	{
		$("h").hide();
		$(".btn1").hide();
		$(".btn1").click(function()
		{
			$("h").hide();
			$(".btn1").hide();
			$(".btn2").show();
		});
		$(".btn2").click(function()
		{
			$("h").show();
			$(".btn1").show();
			$(".btn2").hide();
		});	
	});
	function loadtaskstatus1(duration,assignee)
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
				document.getElementById('sub1').innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/timetask1.php?tim="+duration+"&assignee="+assignee,true);
		xmlhttp.send();
	}
	function loadtaskstatus(duration,assignee)
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
				document.getElementById('sub').innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/timetask.php?tim="+duration+"&assignee="+assignee,true);
		xmlhttp.send();
	}	
 </script>