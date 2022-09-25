<?php
	include("config.php");
	if($_POST['from'] && $_POST['submit'])
	{
		if($_POST['approved'])
			mysql_query("INSERT INTO leaves(empid,empname,fromdate,todate,days,c_number,reason,approved,leavestatus) VALUES('".$_POST['empid']."','".$_POST['empname']."','".$_POST['from']."','".$_POST['to']."','".$_POST['days']."','".$_POST['c_number']."','".$_POST['reason']."','".$_POST['approved']."','".$_POST['leavestatus']."')");	
		else
			mysql_query("INSERT INTO leaves(empid,empname,fromdate,todate,days,c_number,reason,leavestatus) VALUES('".$_POST['empid']."','".$_POST['empname']."','".$_POST['from']."','".$_POST['to']."','".$_POST['days']."','".$_POST['c_number']."','".$_POST['reason']."','Pending')");		
	}	
	if($_GET['edit'])
	{
		$name = mysql_query("SELECT * FROM leaves WHERE empname='".$_GET['empname']."'");
		$query1 = mysql_fetch_array($name);
		echo "You are Editing ".$_GET['empname']."<br>";
	}
	if( $_POST['update'])
	{
		$var = $_POST['empname'];
		mysql_query("UPDATE leaves SET fromdate='".$_POST['from']."',todate='".$_POST['to']."',days='".$_POST['days']."',c_number='".$_POST['c_number']."',reason='".$_POST['reason']."',approved='".$_POST['approved']."',leavestatus='".$_POST['leavestatus']."' WHERE empname='".$var."'");
		if($var)
			echo '<script type="text/javascript">alert("PTC-ID is '.$var.'\n\n Successfully Updated."); </script>';
	}
	if($_POST['cancel'])
		header("Location:?page=empleave");
?>
<html>
	<head>
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
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
			function findDiff()
			{
				var dob1= document.getElementById("date").value;
				var dob2= document.getElementById("date1").value;
				var date1 = new Date(dob1);
				var date2=new Date(dob2);

				var ONE_DAY = 1000 * 60 * 60 * 24
				var d1 = date1.getTime()
				var d2 = date2.getTime()
				var diff = Math.abs(d1 - d2)
				document.getElementById("days").value=Math.round(diff/ONE_DAY);
			}
	</script>
	</head>
	<div class="grid_6 first">
		<form action="" method="POST" id="form" class="form panel">
			<header>
				<h2>Apply Leave</h2>
			</header>
			<hr>
			<fieldset>
				<!--div class="clearfix">
				<label>Emp-Id:</label>
				<select name='empid' onchange="emp_change(this.value)">
								<option value="Select" >Select</option>
								<?php
								$empquery = mysql_query("select empid from employee");
								while($row=mysql_fetch_array($empquery))
								{
										echo "<option value='".$row['empid']."'>".$row['empid']."</option>";
								} ?>
							</select>
				</div-->
				<div class="clearfix">
					<label>Employee-Name:</label>
					<select name='empname'>
						<option value="Select" >Select</option>
						<?php
						if($row1['role']=='user')
							$empquery1 = mysql_query("select * from employee where name = '".$row1['username']."'");
						else	
							$empquery1 = mysql_query("select * from employee ");
						while($row=mysql_fetch_array($empquery1))
						{
							if(($row1['username']==$row['name'] && $row1['role']=='user') || ($_GET['edit'] && $query1['empname'] == $row['name']))
								echo "<option value='".$row['name']."' selected>".$row['name']."</option>";
							else
								echo "<option value='".$row['name']."' >".$row['name']."</option>";
							
						}?>
					</select>
				</div>
				<div class="clearfix">
					<label>From Date:</label>
					<input type="text" id ="date" name="from" value="<?php echo $query1['fromdate'];?>">
				</div>		
				<div class="clearfix">
					<label>To Date:</label>
					<input type="text" id ="date1" name="to" value="<?php echo $query1['todate'];?>">
				</div>		
				<div class="clearfix">
					<label>Number Of Days:</label>
					<input type="text" name="days" id="days" onmousemove="findDiff();" value="<?php echo $query1['days'];?>">
				</div>		
				<div class="clearfix">
					<label>Contact Number:</label>
					<input type="text" name="c_number" value="<?php echo $query1['c_number'];?>">
				</div>	
				<div class="clearfix">
					<label>Reason:</label>
					<textarea name="reason"><?php echo $query1['reason'];?>
					</textarea>
				</div>			
				<?php if($row1['role']=='admin')
				{ ?>
				<div class="clearfix">
					<label>Approved By:</label>
					<select name="approved">
						<option value="Select" >Select</option>
						<?php
						$query = mysql_query("select * from assignee");
						while($row=mysql_fetch_array($query))
						{
							if($query1['assign'] == $row['slno'])
								echo "<option value='".$row['slno']."' selected>".$row['name']."</option>";
							else
								echo "<option value='".$row['slno']."'>".$row['name']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Status:</label>
					<select name= "leavestatus">
						<option value="select">Select</option>
						<option value="approved">Approved</option>
						<option value="rejected">Rejected</option>
						<option value="cancelled">Cancelled</option>
					</select>
				</div>	
				<?php
				}
				if($_GET['edit'])
				{
					echo '<button class="button button-green" type="hidden" name="update" value="1">update</button>';
					echo '<input type="hidden" name="empname" value="'.$_GET['empname'].'">';
				}
				else
				{
				echo '<button class="button button-green" type="submit" value="Submit" name="submit">Submit</button>';			
				echo '<button class="button button-green" type="submit" value="Cancel" name="cancel">Cancel</button>';	
				}	
				?>	
			</fieldset>					
		</form>
	</div>
</html>
<?php
	include("config.php");
		$query2 = mysql_query("SELECT * from leaves ORDER BY fromdate desc");
		if(mysql_num_rows($query2))
		{
			echo "<div style='float:left;margin-top:25px;margin-left:0px;width:800px;height:0;'>
					<table id='sub1'>
						<tr><td><h1>Employee Summary</h1></td></tr>
					</table>
					<div style='width:1000px;height:550px;overflow-x:scroll;overflow-y:auto;'>
				  <table border='1'  align= 'left' class='paginate sortable full' width='20'>
					<tr>
						<th>Employee-ID</th>
						<th>Name</th>
						<th>From-To</th>
						<th>Number Of Days</th>
						<th>Contact</th>
						<th>Reason</th>";
						echo "<th>Approved By</th>";
						echo "<th>Status</th>
					</tr>";
		}
		while($row = mysql_fetch_array($query2))
		{	
		echo"<tr>";
			$empid = mysql_fetch_array(mysql_query('Select * From employee Where name="'.$row['empname'].'"'));
				echo"<td>".$empid['empid']."</td>
				<td>".$row['empname']."</td>	
					<td>".$row['fromdate']."-".$row['todate']."
					</td>
					<td>".$row['days']."
					</td>
					<td>".$row['c_number']."
					</td>
					<td>".$row['reason']."
					</td>";
					$fetch_approve = mysql_fetch_array(mysql_query("SELECT * FROM assignee where slno ='". $row['approved']."'"));
					echo "<td>".$fetch_approve['name']."</td>";
					echo "<td>".$row['leavestatus']."
					</td>
					<td>";
					echo "<a href='?page=empleave& empname=".$row['empname']."&edit=1'><img src='images/edit.png' title='edit' /></a>
					</td>
				</tr>";
		}
		echo "</table></div>";
		echo '</div><div style="float:left;margin-top:650px;margin-left:450px;width:2000px">';
		include("includes/pagination.php");
		echo '</div>';
?>		
	<script>
		function emp_change(str)
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
							var values = results.split("#");
							var select = document.getElementById('sub');
							select.options.length = 0; 	//For remove all options of dropdown list
							
							for(var i = 0; i < values.length; i++)
							{
								if(i%2 == 0)
									select.options[select.options.length] = new Option(values[i],values[i+1]);
							}
						}
					}
					xmlhttp.open("GET","includes/getemp.php?q="+str,true);
					xmlhttp.send();
				}
	</script>		
	