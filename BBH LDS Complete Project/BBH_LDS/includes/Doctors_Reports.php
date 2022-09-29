<head>
	<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-1.8.16.custom.css" />
	<link rel="stylesheet"  type="text/css" href="css/datetimepicker.css" />
	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
	<script>
	$(document).ready(function()
	{
		$('#startdate').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true});
		$('#enddate').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true});
	});
	</script>
</head>
<div class="form panel">
	<form method='post' action=''>
		<hr/>
		<table>
			<tr>
				<td>
					<div class="clearfix">
						<label style="width:100px;">Group </label>
						<select name="groupid" id="groupid" onchange="GetDepartment(this.value);">
							<option value="" >All</option>
							<?php
								$Select_Group = mysqli_query($_SESSION['connection'],"select * from `group` order by name asc");
								while($Fetch_Group = mysql_fetch_array($Select_Group))
								{
									if($Fetch_Group['id'] == $_POST['groupid'])
										echo '<option value="'.$Fetch_Group['id'].'" selected>'.$Fetch_Group['name'].'</option>';
									else
										echo '<option value="'.$Fetch_Group['id'].'">'.$Fetch_Group['name'].'</option>';
								}
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="clearfix" id="dept">
						<label>Department </label>
						<select name="departmentid" id="departmentid"  onchange="GetNames(document.getElementById('groupid').value,this.value)">
							<option value="" >All</option>
							<?php
							if($_POST['groupid'])
							{
								$Select_Department= mysqli_query($_SESSION['connection'],"select * from `department` where groupid='".$_POST['groupid']."' order by name asc");
								while($Fetch_Department = mysql_fetch_array($Select_Department))
								{
									if($Fetch_Department['id']==$_POST['departmentid'])
										echo '<option value="'.$Fetch_Department['id'].'" selected>'.$Fetch_Department['name'].'</option>';
									else
										echo '<option value="'.$Fetch_Department['id'].'">'.$Fetch_Department['name'].'</option>';
								}
							}	
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="clearfix" id="designation">
						<label style="width:100px;">Designation</label>
						<select name="designationid" id="designationid" >
							<option value="" >All</option>
							<?php
								$Select_Designation= mysqli_query($_SESSION['connection'],"select * from `designation`  order by name asc");
								while($Fetch_Designation = mysql_fetch_array($Select_Designation))
								{
									if($Fetch_Designation['id']==$_POST['designationid'])
										echo '<option value="'.$Fetch_Designation['id'].'" selected>'.$Fetch_Designation['name'].'</option>';
									else
										echo '<option value="'.$Fetch_Designation['id'].'">'.$Fetch_Designation['name'].'</option>';
								}
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="clearfix">
						<label style="width:100px;">Status </label>
						<select name="status" id="status">
							<option value="" >Select</option>
							<?php
								$Status = array("Fulltime","Visiting");
								$i=1;
								foreach($Status as $St)
								{
									if($St==$_POST['status'])
										echo '<option value="'.$St.'" selected>'.$St.'</option>';
									else
										echo '<option value="'.$St.'">'.$St.'</option>';
								}
							?>
						</select>
					</div>
				</td>
				<td>
					<div class="clearfix">
						<label style="width:100px;">Leaving Reason </label>
						<select name="reasonid" id="reasonid">
							<option value="" >Select</option>
							<option value="1" >Study Leave</option>
							<option value="2" >Sabbatical Leave</option>
							<option value="3" >Resigned</option>
							<option value="4" >Completed the Course</option>
						</select>
					</div>
				</td>
				<td>
					<div class="clearfix">
						<label style="width:100px;">Date Of Join </label>
						<input type="text" name="startdate"  value="<?php echo $_POST['startdate'];?>" id="startdate">
					</div>
				</td>
				<td>
					<div class="clearfix">
						<label style="width:100px;">Date Of Leaving </label>
						<input type="text" name="enddate"  value="<?php echo $_POST['enddate'];?>" id="enddate">
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<br/>
					<input type="submit" class="button button-green"  name="Search" value="Search" />&nbsp;
				</td>
			</tr>
		</table>
	</form>
	<hr/>
</div>
<?php
	include("Export_Doctors.php");
?>
<script>
function GetDepartment(GroupId)
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
			document.getElementById("dept").innerHTML = xmlhttp.responseText;
	}
	xmlhttp.open("GET","includes/GetDoctorDepartment.php?var=1&All=All&GroupId="+GroupId,true);
	xmlhttp.send();
}
	
function Export()
	{
		window.open("includes/Export_Doctors.php?export=1&Search=<?php echo $_POST['Search'].'&departmentid='.$_POST['departmentid'].'&groupid='.$_POST['groupid'].'&designationid='.$_POST['designationid'].'&status='.$_POST['status'].'&reasonid='.$_POST['reasonid'].'&startdate='.$_POST['startdate'].'&enddate='.$_POST['enddate']; ?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
//function GetValuesByMonthly()
	//{
		//document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&groupid="+document.getElementById('groupid').value+"&departmentId="+document.getElementById('departmentid').value+"&name="+document.getElementById('name').value+"&startdate="+document.getElementById('startdate').value+"&enddate="+document.getElementById('enddate').value);
	//}
</script>