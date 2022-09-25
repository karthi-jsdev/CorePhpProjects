<?php
	session_start();
	if($_POST['update'] && $_POST['tcomments'])
	{
		mysql_query("UPDATE taskcomments SET enable='0' WHERE tskid='".$_GET['id']."'");
				
				$TaskStatus = mysql_fetch_array(mysql_query("select tstatus from taskstatus where tstatus='".$_POST['tstatus']."'"));
				mysql_query("UPDATE task SET tstatus='".$TaskStatus['tstatus']."', assignee='".$_POST['tassignee']."',status='".$_POST['tstatus']."' WHERE taskid='".$_GET['id']."'");
				
				mysql_query("INSERT INTO taskcomments VALUES('null','".$_GET['id']."','".$_POST['tcomments']."','".$_POST['tdate']."',
				
				'".$_POST['tstatus']."','".$_POST['tassignee']."','".$_POST['leads']."','1')");
	
	}
		echo '<div style="float:left;margin-top:100px;margin-left:-200px;">';
				$sql1 = mysql_query("SELECT * FROM taskstatus");
				if(mysql_num_rows($sql1))
				{
					echo "<table  border='1'  align='left' class='paginate sortable full1'>
							<tr>
								<th align='left'>Status</th>
								<th align='left'>No. of Items</th>
							</tr>";
							echo "<tr><td>";?> 
							<a style='text-decoration:underline;' href="?page=tasksummary">All</a></td>
							
							<?php
							$query1 = mysql_query("SELECT * FROM task");
									echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($query1)."</a></td>";	
							
							echo "</tr>";
							while($row1 = mysql_fetch_array($sql1))
							{
								echo "<tr><td>";
								?><a style='text-decoration:underline;' href="?page=tasksummary&status=<?php echo $row1['tstatus'];?>"><?php echo $row1['tstatus']."</a></td>";
								$query = mysql_query("SELECT * FROM task WHERE taskid IN (SELECT tskid FROM taskcomments WHERE tstatus ='".$row1['tstatus']."' and enable='1') OR status='".$row1['tstatus']."'");
									echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($query)."</a></td>";	
								echo "</tr>";
							}	
					echo "</table><br/>";
				}
				$queryAssignee = mysql_query("SELECT * FROM assignee");
				echo "<table  border='1'  align='left' class='paginate sortable full1'>
							<tr>
								<th align='left'>Task Assignee</th>
								<th align='left'>No. of Tasks</th>
							</tr>";
				while($fetchAssignee = mysql_fetch_array($queryAssignee))
				{
					echo "<tr><td>";?><a style='text-decoration:underline;' href="?page=tasksummary&assignee=<?php echo $fetchAssignee['id'];?>"><?php
					echo $fetchAssignee['name']."</a></td>";
					$noOfTaskQuery = mysql_query("SELECT * FROM task WHERE assignee='".$fetchAssignee['id']."' AND taskid NOT IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1)");
					echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($noOfTaskQuery)."</a></td>
					</tr>";
				}
				echo "</table><br/>";
				echo "<table border='1'  align='left' class='paginate sortable full1'>
						<tr>
							<th align='left'>Task Assignee</th>
							<th align='left'>Closed Tasks</th>
						</tr>";
						$queryAssignee = mysql_query("SELECT * FROM assignee");
						while($fetchAssignee = mysql_fetch_array($queryAssignee))
						{
							echo "<tr><td>";?><a style='text-decoration:underline;' href="?page=tasksummary&assignee1=<?php echo $fetchAssignee['id'];?>"><?php
							echo $fetchAssignee['name']."</a></td>";
							$noOfTaskQuery = mysql_query("SELECT * FROM task WHERE assignee='".$fetchAssignee['id']."' AND taskid IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1)");
							echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($noOfTaskQuery)."</a></td>
							</tr>";
						}
					echo "</table>";
				echo '</div>';
?>
	<script type="text/javascript" src="js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="wordwrap.css">
	<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js">
	</script>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
		<link rel="stylesheet" href="css/styles1.css">
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		<script>	
					
					$(document).ready(function()
					{
						$("#date").datepicker(
						{
							dateFormat: 'yy-mm-dd',
							showOn: "button",
							buttonImage: "images/calendar.png",
							buttonImageOnly: true
						});
					});
					$(document).ready(function()
					{
						$("#date1").datepicker(
						{
							dateFormat: 'yy-mm-dd',
							showOn: "button",
							buttonImage: "images/calendar.png",
							buttonImageOnly: true
						});
					});
					function calculate() 
					{
						var cost = Number(document.getElementById("amount").value);
						var tax = Number(document.getElementById("tax").value);
						var total = cost + (cost * (tax / 100));
						document.getElementById("total").value = total;
					}
		</script>
	</head>
	<div style="float:left;margin-top:-550px;margin-left:150px;width:1000px;">
			<?php
			include("config.php");
				$taskdate = date('Y-m-d');
					echo '<link rel="stylesheet" type="text/css" href="style.css" />';
				
				if(!$_POST['update'])
				{
					echo '<br /><table><tr><td style="width:800px;"></td><td width="">';?><button onclick='window.location.href="?page=tasksummary"'>Task Summary</button><?php echo '</td></tr></table>';
				}
				if($_POST['update'])
				{
					echo '<br /><table><tr><td style="width:800px;"></td><td>';?><button onclick='window.location.href="?page=tasksummary&tassignee=<?php echo $_POST['tassignee'];?>&tskid=<?php echo $_GET['id']?>"'>Task Summary</button><?php echo '</td></tr></table>';
				}
				echo "<h1>Task Status</h1>";
				echo "<table border='1'  align= 'center' class='paginate sortable full'>";
						$sql_tsk = mysql_query("SELECT * from task where taskid='".$_GET['id']."'");
						$row_tsk = mysql_fetch_array($sql_tsk);
						echo 	"<tr>
									<th align='left'>Task Id:</th>
									<td>".$row_tsk['taskid']."</td>
									<th align='left'>Task Description:</th>
									<td>".$row_tsk['tdesc']."</td>
									<th align='left'>Task Date:</th>
									<td>".$row_tsk['tdate']."</td><th style='none'> 
									<td style='none'>";
									
									echo "<button class='btn1'>Hide</button>
								<button class='btn2'>".$row_tsk['ptclid']."
								</button>
															</td></th>
														</tr>
						</table>";
			if($_POST['update'])
			{
				if($row = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid = '".$_GET['ptclid']."'")))
				{
					$task_comm = mysql_query('SELECT * FROM taskcomments WHERE tskid="'.$_GET['id'].'" ORDER BY id DESC');
					$task_comments = mysql_fetch_array($task_comm);
					echo"<h><table border='1' class='paginate sortable full'>
							<tr>
								<td ><strong>Lead Information</strong></td>
								<td ><strong>Product Information</strong></td>
								<td><strong>Previous Task Comments</strong></td>";
						echo "</tr>";
						echo "<tr>
									<td>".$row['ptclid']."</td>";
									$product=mysql_fetch_array(mysql_query("SELECT * FROM producttype where slno='".$row['ptype']."'"));
									echo "<td>".$product['type']." </td>";
									if($task_comments['tcomments'])
									{
										$var = $task_comments['tcomments'];
										$newtext = wordwrap($var, 100, "\n",true);
										echo "<td>".$var." </td>";
									}
							echo "</tr>";
						echo "<tr>";
									$var = $row['ldesc'];
									$newtext = wordwrap($var, 80, "\n",true);
						echo "<td>".$var."</td>";
						$productsub=mysql_fetch_array(mysql_query("SELECT * FROM productsubtype where slno='".$row['pstype']."'"));
						echo "<td>".$productsub['type']."</td>";
						if($task_comments['tdate'])
							echo "<td>".$task_comments['tdate']."</td>";
						
					echo 	"</tr>";
						echo  "<tr>
							   <td>".$row['ldate']."</td>";
							   $assign = mysql_fetch_array(mysql_query("select * from assignee where slno='".$row['assign']."'"));
							   echo "<td><strong>Assign To:".$assign['name']."</strong></td>";
							   if($task_comments['tassignee'])
							   {
								   $assign1 = mysql_fetch_array(mysql_query("select * from assignee where id='".$task_comments['tassignee']."'"));
								   echo "<td><strong>Task Assignee:".$assign1['name']."</strong></td>";
								}
							   
						echo "</tr>";
						echo "<tr>
								<td></td>
								<td></td>
								<td>".$task_comments['tstatus']."</td>
						</tr>";
						echo "</table></h>";
				}
			}	
				if(!$_POST['update'])	
				{
					$task_comm = mysql_query('SELECT * FROM taskcomments WHERE tskid="'.$_GET['id'].'" ORDER BY id DESC');
					$task_comments = mysql_fetch_array($task_comm);
					if($row = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid = '".$_GET['ptclid']."'")))
					{
						
						echo"<h><table border='1' class='paginate sortable full'>
								<tr>
									<td ><strong>Lead Information</strong></td>
									<td ><strong>Product Information</strong></td>";
								if(mysql_num_rows($task_comm))
									echo "<td><strong>Previous Task Comments</strong></td>";
							echo "</tr>";
							echo	"<tr>
										<td>".$row['ptclid']."</td>";
										$product=mysql_fetch_array(mysql_query("SELECT * FROM producttype where slno='".$row['ptype']."'"));
										echo "<td>".$product['type']." </td>";
										if($task_comments['tcomments'])
										{
											$var = $task_comments['tcomments'];
											$newtext = wordwrap($var, 100, "\n",true);
											echo "<td>".$var." </td>";
										}
								echo "</tr>";
							echo "<tr>";
										$var = $row['ldesc'];
										$newtext = wordwrap($var, 100, "\n",true);
							echo "<td>".$var."</td>";
							$productsub=mysql_fetch_array(mysql_query("SELECT * FROM productsubtype where slno='".$row['pstype']."'"));
							echo "<td>".$productsub['type']."</td>";
							if($task_comments['tdate'])
								echo "<td>".$task_comments['tdate']."</td>";
							echo "</tr>";
							echo  "<tr>
								   <td>".$row['ldate']."</td>";
								   $assign = mysql_fetch_array(mysql_query("select * from assignee where id='".$row['assign']."'"));
								   echo "<td><strong>Assign To:".$assign['name']."</strong></td>";
								    if($task_comments['tassignee'])
								    {
									   $assign1 = mysql_fetch_array(mysql_query("select * from assignee where id='".$task_comments['tassignee']."'"));
									   echo "<td><strong>Task Assignee:".$assign1['name']."</strong></td>";
									}
							echo "</tr>";
							echo "<tr>
									<td></td>
									<td></td>
									<td>".$task_comments['tstatus']."</td>
								</tr>";
							echo "</table></h>";
					}
				}
			//	echo '<div style="float:left;margin-top:100px;margin-left:-1050px;width:250px">';
			
	//	echo '</div>';
				
			?>
<html>
	<div class="clearfix">	
		<body style="background-color:#d0e4fe;">
		<form action="" method="POST" align="center" onSubmit="return validateForm(this);" name="form" id="form" class="form panel">
				<fieldset>
					<div class="clearfix">
					<label>Description:</label>
					<?php echo '<textarea name="tcomments" id="tcomments" rows="5" cols="175"></textarea>';?>
							<script language="javascript1.2">
								generate_wysiwyg('tcomments');
							</script>
					</div>
				</fieldset>	
				<fieldset>
					<div class="clearfix">
						<label>Target Date:</label>
							<?php 
								if(!mysql_num_rows($task_comm) && $row_tsk['tdate'])
									echo '<input type="text" name="tdate" value="'.$row_tsk['tdate'].'" id="date">'; 
								else if(mysql_num_rows($task_comm))
									echo '<input type="text" name="tdate" value="'.$task_comments['tdate'].'" id="date">'; 
								else
									echo '<input type="text" name="tdate"  id="date">'; 
							?>	
					</div>
					<div class="clearfix">
						<label>Assignee:</label>
							<select name="tassignee">
								<option value="Select" >Select</option>
								<?php
								$query = mysql_query("select * from assignee");
								while($row1=mysql_fetch_array($query))
								{
									if($row_tsk['assignee'] == $row1['id'] && !mysql_num_rows($task_comm))
										echo "<option value='".$row1['id']."' selected>".$row1['name']."</option>";
									else if(mysql_num_rows($task_comm) && $task_comments['tassignee'] == $row1['id'])
										echo "<option value='".$row1['id']."' selected>".$row1['name']."</option>";
									else
										echo "<option value='".$row1['id']."'>".$row1['name']."</option>";
								} 
								?>
							</select>
					</div>
						<div class="clearfix">
							<label>Status:</label>
							<select name='tstatus'>
								<option value='Select'>Select</option>
								<?php 
									$query = mysql_query("select * from taskstatus");
									while($row1=mysql_fetch_array($query))
									{
										if($task_comments['tstatus'] == $row1['tstatus'] || $row_tsk['status']== $row1['tstatus'])
											echo '<option value="'.$row1['tstatus'].'" selected>'.$row1['tstatus'].'</option>';
										else
											echo '<option value="'.$row1['tstatus'].'">'.$row1['tstatus'].'</option>';
									}
								?>
							</select>							
					</div>
				</fieldset>					
						<hr>
						<?php
						echo	'<button class="button button-green" type="submit" name="update" value="update">Update</button>';
						?>
			</form>
			<br />
		</body>
	</div>
</html>
	<?php
		/*$result = mysql_query("SELECT * FROM taskcomments");
		if(!mysql_num_rows($result))
			echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
		$rowsperpage = 10;
		$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
			
		if($_GET['pageno']>1)
			$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
		else
			$Limit = "LIMIT 0,".$rowsperpage;
		*/	
		$sql = mysql_query("SELECT * FROM taskcomments where tskid='".$_GET['id']."'  ORDER BY id DESC");
		$targetDate = mysql_fetch_array(mysql_query("SELECT * FROM task WHERE taskid='".$_GET['id']."'"));
		if(mysql_num_rows($sql))
		{
				
				echo "<display><table border='1'  align= 'left' class='paginate sortable' width='1000'>
					<tr>
						<!--th>PTCL-ID</th-->
						<!--th>Company Name</th-->
						<!--th>Product Type</th-->
						<!--th>Product Sub Type</th-->
						<!--th>Assign</th-->
						<th align='left'>Task Id</th>
						<th align='left'>Target Date</th>
						<th align='left'>Task Comments</th>
						<th align='left'>Task Status</th>
						<th align='left'>Task Assignee</th>
						<!--th>Task Date</th>
						<th align='left'>Assignee</th-->
					</tr>";
					while($row = mysql_fetch_array($sql))
					{
						echo "<tr>
								<td>".$_GET['id']."</td>
								<td>".$row['tdate']."</td>";
								$var = $row['tcomments'];
								$newtext = wordwrap($var, 80, "\n",true);
						echo	"<td>".$var."</td>
								<td>".$row['tstatus']."</td>";
								$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['tassignee']."'");
							$row1=mysql_fetch_array($query1);
							echo "<td>".$row1['name']."</td>";
						echo "</tr>";	
					}
				echo '</table></display>';	
		}
		
?>
</div>
<script>
var today=new Date(); 
var curr_date = today.getDate();
var curr_month = today.getMonth();
var curr_year = today.getFullYear();
var formattedDate = curr_year+"-"+curr_month + "-" + curr_date;
function validateForm(form)
{
	if(form.tcomments.value == "") 
	{
		alert("Please enter comment !");
		form.tcomments.focus();
		return false;
	}
	if(form.tdate.value)
	{	
		var date2 = new Date(form.tdate.value);
		if(today > date2)
		{
			alert("Target Date Should be Future Dates!");
			form.tdate.focus();
			return false;
		}	
	}
	if(form.tstatus.value == "Select") 
	{
		alert("Please Select Status!");
		form.tstatus.focus();
		return false;
	}
}
</script>
	<script>
				$(document).ready(function()
				{
					$("h").hide();
					$(".btn1").hide();
					$(".btn1").click(function()
					{
						$("h").hide(500);
						$(".btn1").hide();
						$(".btn2").show();
					});
					$(".btn2").click(function()
					{
						$("h").show(500);
						$(".btn1").show();
						$(".btn2").hide();
					});	
					$(".btn3").hide();
					$("display").show();
					$("nondisplay").hide();
					$(".btn3").click(function()
					{
						$("display").show();
						$("nondisplay").hide();
						$(".btn3").hide();
						$(".btn4").show();
					});
					$(".btn4").click(function()
					{
						$("nondisplay").show();
						$("display").hide();
						$(".btn3").show();
						$(".btn4").hide();
					});
				});
			</script>