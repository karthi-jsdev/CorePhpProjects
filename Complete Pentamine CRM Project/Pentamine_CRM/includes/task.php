<?php
	session_start();
	include("config.php");
	ini_set( "display_errors", "0" );
	$date = date("Y-m-d");
	if($_POST['submit'] && $_POST['desc'])
	{
		$count = mysql_query("SELECT id FROM task ORDER BY id DESC");
		$idval = mysql_fetch_array($count);
		$var = "PTTKID-00".($idval['id']+1);
		//mysql_query("insert into task (taskdate,tdesc,tdate,assignee,tstatus) values ('".$date."','".$_POST['desc']."','".$_POST['date']."','".$_POST['assign']."','".$_POST['status']."')");
		mysql_query("insert into task VALUES('null','".$var."','".$date."','".htmlspecialchars($_POST['desc'])."','".$_POST['date']."','".$_POST['assign']."','".$_POST['status']."','".$_POST['leads']."','Open')");
		echo "Task Id is ".$var." And successfully created";
	}
	if($_GET['edit'] && $_GET['id'])
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM task WHERE id='".$_GET['id']."'"));
		echo "You are Editing ".$_GET['task']."";
	}
	if($_POST['update'])
	{
		$var = $_POST['id'];
		mysql_query("UPDATE task SET tdesc='".htmlspecialchars($_POST['desc'])."',tdate='".$_POST['date']."',assignee='".$_POST['assign']."',tstatus='".$_POST['status']."',ptclid='".$_POST['leads']."' WHERE id='".$var."'");
		echo $_POST['task1']." Updated Successfully";
	}
?>



<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
		<link rel="stylesheet" href="css/styles1.css">
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="wordwrap.css">
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
		</script>	
	</head>
	<br />
	<pre>
	</pre>
	<table>
			<tr><td style='width:800px'></td>
			<td><button onclick="window.location.href='?page=tasksummary'" >Task Summary</button></td>
			<?php if($_GET['id'] && $_GET['ptcid'])
			{?>
				<td><button onclick='window.location.href="?page=leadstatus&ptcid=<?php echo $_GET['ptcid'];?>&id=<?php echo $_GET['id'];?>"'>Lead Status</button></td>		
			<?php 
			}
			echo	"</tr>
		</table>";?>
	<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js">
		</script>
	
		<div class="grid_6 first">
			<form action="?page=task" method="POST" onsubmit="return validateForm(this)" name="form" id="form" class="form panel">
			<header>
				<h2>Task Management</h2>
			</header>
			<hr>			
				<fieldset>
					<div class="clearfix">
						<label>Description:</label>
						<?php echo '<textarea name="desc" id="desc">'.$row['tdesc'].'</textarea>';?>
							<script language="javascript1.2">
								generate_wysiwyg('desc');
							</script>
					</div>
					<div class="clearfix">
						<label>	Target Date:</label>
						<?php echo '<input type="text" name="date" id="date" value="'.$row['tdate'].'">'; ?>
					</div>
					<div class="clearfix">
						<label>Assignee:</label>
						<select name="assign">
							<option value="Select" >Select</option>
							<?php
							$query = mysql_query("select * from assignee");
							while($row1=mysql_fetch_array($query))
							{
								if($_GET['edit'] && $row['assignee'] == $row1['id'])
									echo "<option value='".$row1['id']."' selected>".$row1['name']."</option>";
								else
									echo "<option value='".$row1['id']."'>".$row1['name']."</option>";
							} 
							?>
						</select>
					</div>
					<div class="clearfix">
						<label>Leads:</label>
						<select name="leads">
							<option value="Select" >Select</option>
							<?php
							if($_GET['edit'] || ($row['ptclid'] == 'Others'))
								echo '<option value="Others" selected>Others</option>';
							else	
								echo '<option value="Others" >Others</option>';
							?>
							<?php
							$query = mysql_query("select * from lead");
							while($row1=mysql_fetch_array($query))
							{
								if($_GET['id'] == $row1['ptclid'] || (($row['ptclid'] == $row1['ptclid'])  && $_GET['edit']) )
									echo "<option value='".$row1['ptclid']."' selected>".$row1['ptclid']."</option>";
								else
									echo "<option value='".$row1['ptclid']."'>".$row1['ptclid']."</option>";
							} ?>
						</select>
					</div>
				</fieldset>	
				<hr>
				<?php
						if($_GET['edit'])
						{
							echo '<button class="button button-green" type="hidden" name="update" value="update">Update</button>';
							echo '<input type="hidden" name="id" value="'.$_GET['id'].'">
								<input type="hidden" name="task1" value="'.$_GET["task"].'">';
						}
						else
							echo '<button class="button button-green" value="Submit" type="submit" name="submit">Submit</button>';
					?>	
			</form>
		</div>	
</html>
<?php
		$result = mysql_query("SELECT * FROM task");
		if(!mysql_num_rows($result))
			echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
		$rowsperpage = 25;
		$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
		if(!$_GET['pageno'])
			$_GET['pageno']=1;	
		if($_GET['pageno']>1)
			$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
		else
			$Limit = "LIMIT 0,".$rowsperpage;	
 $sql = mysql_query("SELECT * FROM task ORDER BY id DESC $Limit");
	if(mysql_num_rows($sql))
	{
		echo "<br/><br/><br/>
		<table  border='1'  align='center' class='paginate sortable full' id='sub'>
				
				<tr>
					<th>Task-ID</th>
					<th>Lead-ID</th>
					<th>Task Date</th>
					<th>Task Description</th>
					<th>Target Date</th>
					<th>Assignee</th>
					<!--th>Status</th-->
				</tr>";
				while($row = mysql_fetch_array($sql))
				{
					echo "<tr>
					<td align='center'>".$row['taskid']."</td>
					<td align='center'>".$row['ptclid']."</td>
					<td align='center'>".$row['taskdate']."</td>
					<td align='center'>".$row['tdesc']."</td>
					<td align='center'>".$row['tdate']."</td>";
					$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
					$row1=mysql_fetch_array($query1);
					echo "<td align='center'>".$row1['name']."</td>
						<td>
						<a href='?page=task&id=".$row['id']."&task=".$row['taskid']."&edit=1'><img src='images/edit.png' title='edit' /></a>
					</td>";
				echo 	"</tr>";	
				}	
				echo "</table>";
		}
		echo '<div style="float:left;margin-top:20px;margin-left:400px;width:2000px">';
					
					include("includes/pagination.php");
					echo "</div>";
/*else
{
		$result = mysql_query("SELECT * FROM task WHERE ptclid='".$_GET['id']."'");
			if(!mysql_num_rows($result))
				echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
			$rowsperpage = 25;
			$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
				
			if($_GET['pageno']>1)
				$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
			else
				$Limit = "LIMIT 0,".$rowsperpage;
			
			
 $sql = mysql_query("SELECT * FROM task WHERE ptclid='".$_GET['id']."'");
	if(mysql_num_rows($sql))
	{
		echo "<br/><br/><br/>
		<table  border='1'  align='left' class='paginate sortable full' id='sub'>
				
				<tr>
					<th>Lead-ID</th>
					<th>Task Date</th>
					<th>Task Description</th>
					<th>Target Date</th>
					<th>Assigneee</th>
					<!--th>Status</th-->
				</tr>";
				while($row = mysql_fetch_array($sql))
				{
					echo "<tr>
					<td>".$row['ptclid']."</td>
					<td>".$row['taskdate']."</td>
					<td>".$row['tdesc']."</td>
					<td>".$row['tdate']."</td>";
					$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
					$row1=mysql_fetch_array($query1);
					echo	"<td>".$row1['name']."</td>
						<td>
						<a href='?page=task&id=".$row['id']."&edit=1'><img src='images/edit.png' title='edit' /></a>
					</td>";
				echo 	"</tr>";	
				}	
				echo "</table>";
		}
		echo '<div style="float:left;margin-top:20px;margin-left:400px;width:2000px">';
					
					include("includes/pagination.php");
					echo "</div>";
}*/
 ?>
 <script>
 var today=new Date(); 
var curr_date = today.getDate();
var curr_month = today.getMonth();
var curr_year = today.getFullYear();
var formattedDate = curr_year+"-"+curr_month + "-" + curr_date;

 function validateForm(form)
{
	if(form.desc.value == "") 
	{
		alert("Please Enter Task Description!");
		form.desc.focus();
		return false;
	}
	if(form.date.value == "") 
	{
		alert("Please Enter Target Date!");
		form.date.focus();
		return false;
	}
	if(form.date.value)
	{
		var date2 = new Date(form.date.value);
		if(today > date2)
		{
			alert("Target Date Should be Future Dates!");
			form.date.focus();
			return false;
		}
	}
	if(form.assign.value == "Select") 
	{
		alert("Please Select Assignee!");
		form.assign.focus();
		return false;
	}
	if(form.leads.value == "Select") 
	{
		alert("Please Select Lead!");
		form.leads.focus();
		return false;
	}
}
 </script>