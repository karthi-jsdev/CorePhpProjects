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
						<label>Group </label>
						<select name="groupid" id="groupid" onchange="GetDepartment(this.value)">
							<option value="" >All</option>
							<?php
								$Select_Group = mysql_query("select * from `group` order by name asc");
								while($Fetch_Group = mysql_fetch_array($Select_Group))
								{
									if($_POST['groupid']==$Fetch_Group['id'])
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
								$Select_Department= mysql_query("select * from `department` where groupid='".$_POST['groupid']."' order by name asc");
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
					<div class="clearfix" id="names">
						<label>Name </label>
						<select name="name" id="name" >
							<option value="" >All</option>
							<?php 	
							if($_POST['departmentid'])
							{
								$SelectNames = mysql_query("select id,name from resource_update where groupid='".$_POST['groupid']."' and departmentid='".$_POST['departmentid']."'");
								while($FetchNames = mysql_fetch_array($SelectNames))
								{
									if($FetchNames['id'] == $_POST['name'])
										echo '<option value="'.$FetchNames['id'].'" selected>'.$FetchNames['name'].'</option>';
									else
										echo '<option value="'.$FetchNames['id'].'">'.$FetchNames['name'].'</option>';
								} 
							}?>
						</select>
					</div>
				</td>
				<td>
					<div class="clearfix">
						<label style="width:100px;">Start Date </label>
						<input type="text" name="startdate"  value="<?php echo $_POST['startdate'];?>" id="startdate">
					</div>
				</td>
				<td>
					<div class="clearfix">
						<label style="width:100px;">End Date </label>
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
	include("Export.php");
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
	xmlhttp.open("GET","includes/GetDepartment.php?var=1&All=All&GroupId="+GroupId,true);
	xmlhttp.send();
}
	function GetNames(GroupId,DeptId)
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
			document.getElementById("names").innerHTML = xmlhttp.responseText;
	}
	xmlhttp.open("GET","includes/GetNames.php?All=All&GroupId="+GroupId+"&DeptId="+DeptId,true);
	xmlhttp.send();
}
function Export()
	{
		window.open("includes/Export.php?export=1&Search=<?php echo $_POST['Search'].'&departmentid='.$_POST['departmentid'].'&groupid='.$_POST['groupid'].'&name='.$_POST['name'].'&startdate='.$_POST['startdate'].'&enddate='.$_POST['enddate']; ?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
//function GetValuesByMonthly()
	//{
		//document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&groupid="+document.getElementById('groupid').value+"&departmentId="+document.getElementById('departmentid').value+"&name="+document.getElementById('name').value+"&startdate="+document.getElementById('startdate').value+"&enddate="+document.getElementById('enddate').value);
	//}
</script>