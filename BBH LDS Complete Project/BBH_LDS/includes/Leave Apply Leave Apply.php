<section role="main" id="main">
	<?php
		include("Resource_UpdateQueries.php");
		$Columns = array("id","group_id","name","starttime","endtime","comments","half","leavetypeid");
		if($_GET['action'] == 'Edit')
		{
			$FetchResource = mysqli_fetch_assoc(Leave_Select_ById());
			//echo mysqli_num_rows(Leave_Select_ById());
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$User_Apply_Leave = User_Select_Byname_Leave();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(User_Select_Byname_Leave())>=1)
					$message = "<br /><div class='message error'><b>Message</b> : This User already apply the leave in the same day</div>";
				else
				{
					Leave_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Username = mysqli_fetch_assoc($User_Apply_Leave);
				if(mysqli_num_rows(User_Select_BynameId($Username['id'],$Username['name'],$Username['startdate'],$Username['enddate']))>=1)
					$message = "<br /><div class='message error'><b>Message</b> : This User already apply the leave in the same day</div>";
				else
				{
					Leave_Update();
					$message = "<br /><div class='message success'><b>Message</b> : User details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
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
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['SM_id']; ?>" required="required"/>
			<header><h2>Add</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Group <font color="red">*</font></label>
					<select name="groupid" id="groupid" onchange="GetDepartment(this.value)">
						<option value="" >Select</option>
					<?php
						$Select_Group = mysqli_query($_SESSION['connection'],"select * from `group` order by name asc");
						while($Fetch_Group = mysql_fetch_array($Select_Group))
						{
							if($FetchResource['groupid']==$Fetch_Group['id'])
								echo '<option value="'.$Fetch_Group['id'].'" selected>'.$Fetch_Group['name'].'</option>';
							else
								echo '<option value="'.$Fetch_Group['id'].'">'.$Fetch_Group['name'].'</option>';
						}
					?>
					</select>
				</div>
				<div class="clearfix" id="dept">
					<label>Department <font color="red">*</font></label>
					<select name="departmentid" id="departmentid"  onchange="GetDepartment(document.getElementById('groupid').value,this.value)">
						<option value="" >Select</option>
						<?php
							$Select_Department= mysqli_query($_SESSION['connection'],"select * from `department` where groupid='".$FetchResource['groupid']."' order by name asc");
							while($Fetch_Department = mysql_fetch_array($Select_Department))
							{
								if($Fetch_Department['id']==$FetchResource['departmentid'])
									echo '<option value="'.$Fetch_Department['id'].'" selected>'.$Fetch_Department['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Department['id'].'">'.$Fetch_Department['name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix" id="names">
					<label>Name <font color="red">*</font></label>
					<select name="name" id="name" >
						<option value="" >Select</option>
						<?php
							$Select_Name= mysqli_query($_SESSION['connection'],"select * from `resource_update` where departmentid='".$FetchResource['departmentid']."'  and  groupid='".$FetchResource['groupid']."' order by name asc");
							while($Fetch_Name = mysql_fetch_array($Select_Name))
							{
								if($Fetch_Name['id']==$FetchResource['name'])
									echo '<option value="'.$Fetch_Name['id'].'" selected>'.$Fetch_Name['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Name['id'].'">'.$Fetch_Name['name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix" id="names">
					<label>Leave Type <font color="red">*</font></label>
					<select name="leavetypeid" id="leavetypeid" >
						<option value="" >Select</option>
						<?php
							$Leavetype_Name= mysqli_query($_SESSION['connection'],"select * from `leavetype`  order by name asc");
							while($Fetch_Leavetype_Name = mysql_fetch_array($Leavetype_Name))
							{
								if($Fetch_Leavetype_Name['id']==$FetchResource['leavetypeid'])
									echo '<option value="'.$Fetch_Leavetype_Name['id'].'" selected>'.$Fetch_Leavetype_Name['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Leavetype_Name['id'].'">'.$Fetch_Leavetype_Name['name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix" onclick="Days();">
					<label>Full day/Half Day</label>
					<?php 
						$Full = array("Full Day","Half Day");
						$i=1;
						foreach($Full as $Fu)
						{
							if($_POST['full']==$i && $_GET['action'])
								echo '<span class="radio-input"><input type="radio" name="full" value="'.$i.'" id="full" checked>'.$Fu.'</input></span>';
							else	
								echo '<span class="radio-input"><input type="radio" name="full" value="'.$i.'" id="full">'.$Fu.'</input></span>';
							$i++;	
						}
					?>
				</div>
				<div class="clearfix" id="halfday" style="display:none;">
					<label>Half Day</label>
					<?php
							$Half = array("AM","PM");
							$i=1;
							foreach($Half as $Hal)
							{
								if($_POST['half']==$i && $_GET['action'])
									echo '<span class="radio-input"><input type="radio" name="half" value="'.$i.'"  id="half" checked>'.$Hal.'</input></span>';
								else
									echo '<span class="radio-input"><input type="radio" name="half" value="'.$i.'"  id="half">'.$Hal.'</input></span>';
								$i++;
							}
						?>
				</div>
				<div class="clearfix">
					<label>Start Date <font color="red">*</font></label>
					<input type="text" name="startdate" required="required" value="<?php echo $FetchResource['startdate']; ?>" id="startdate">
				</div>
				<div class="clearfix">
					<label>End Date <font color="red">*</font></label>
					<input type="text" name="enddate" required="required" value="<?php echo $FetchResource['enddate']; ?>" id="enddate">
				</div>
				<div class="clearfix">
					<label>Comments </label>
					<textarea name="comments"  id="comments"><?php echo $FetchResource['comments'];?></textarea>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit') //style="display:none"
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		<div class="columns">
			<h3>Leave Apply List
				<?php
				$ResourceTotalRows = mysqli_fetch_assoc(LeaveApply_Select_Count_All());
				echo " : No. of List - ".$ResourceTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full" style="width:900px;">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Name</th>
						<th align="left">Group</th>
						<th align="left">Department</th>
						<th align="left">Comments</th>
						<th align="left">Leave Type</th>
						<th align="left">Halfday</th>
						<th align="left">Start Date</th>
						<th align="left">End Date</th>
						<th align="left">Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ResourceTotalRows['total'])
						echo '<tr><td colspan="12"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ResourceTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ResourceUpdate = Leave_Select_ByLimit($Start, $Limit);
					$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
					while($Resource = mysqli_fetch_assoc($ResourceUpdate))
					{ 
						echo "<td>".($i++)."</td>";
						echo "<td>".$Resource['title'].".".$Resource['Name']."</td>";
						echo "<td>".$Resource['groupName']."</td>";
						echo "<td>".$Resource['departmentName']."</td>";
						echo "<td>".$Resource['comments']."</td>";
						echo "<td>".$Resource['leavetypename']."</td>";
						if($Resource['half'] == 1)
							echo "<td>AM</td>";
						elseif($Resource['half'] == 2)	
							echo "<td>PM</td>";
						else	
							echo "<td>-</td>";
						echo "<td>".date('d-m-Y',strtotime($Resource['startdate']))."</td>";
						echo "<td>".date('d-m-Y',strtotime($Resource['enddate']))."</td>";
						echo "<td style='vertical-align:middle'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Resource['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function Days()
	{
		var Full = document.getElementsByName("full");
		var flag = 1;
			for (var i = 1; i< Full.length; i++)
				if(Full[i].checked)
				flag++;	
		if(flag==2)
			document.getElementById("halfday").style.display="block";
		else	
			document.getElementById("halfday").style.display="none";
	}
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
		{
			document.getElementById("dept").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","includes/GetDepartment.php?var=1&GroupId="+GroupId,true);
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
	xmlhttp.open("GET","includes/GetNames.php?GroupId="+GroupId+"&DeptId="+DeptId,true);
	xmlhttp.send();
}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("phone").value.length < 10)
			return true;
		else
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("enddate").value ==0)
			message = "Please select the End date";
		if(document.getElementById("startdate").value ==0)
			message = "Please select the Start date";
		if(document.getElementById("name").value ==0)
			message = "Please select the name";
		if(document.getElementById("leavetypeid").value ==0)
			message = "Please select the leavetype";
		if(document.getElementById("departmentid").value ==0)
			message = "Please select the department";
		if(document.getElementById("groupid").value ==0)
			message = "Please select the group";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>