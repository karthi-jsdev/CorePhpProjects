<section role="main" id="main">
	<?php
		ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
		// include ImageManipulator class
		//require_once('ImageManipulator.php');
		include("Resource_UpdateQueries.php");
		if($_GET['index'])
		{
			$Fetch = mysql_fetch_array(mysql_query("select * from resource_update where id='".$_GET['id']."'"));
			$Fetch['qualification'] = explode('$',$Fetch['qualification']);
			$Qualification = array();
			for($i=0;$i<count($Fetch['qualification']);$i++)
				if($i!=$_GET['index'])
					$Qualification[$i] = $Fetch['qualification'][$i];
			mysql_query("update resource_update set qualification='".implode($Qualification,'$')."'  where id='".$_GET['id']."'");
		}
		$Columns = array("id","titleid", "name", "groupid", "departmentid", "qualification","specialization","status", "days","starttime","endtime","kmc","mobile","mail1","mail2","dob","sex","reason","resign");
		if($_GET['action'] == 'Edit')
		{
			$FetchResource = mysql_fetch_assoc(Resource_Select_ById());
			$ExplodeQualification = explode("$",$FetchResource['qualification']);
		}
		
		else if($_GET['action'] == 'Delete')
		{
			Resource_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One User deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$Stime = "";
			$Etime = "";
			for($i=1;$i<=7;$i++)
			{
				if($_POST['stime'.$i.''])
					$Stime .= $_POST['stime'.$i.''].',';
				else	
					$Stime .= ",";
			}
			for($j=1;$j<=7;$j++)
			{
				if($_POST['etime'.$j.''])
					$Etime .= $_POST['etime'.$j.''].',';
				else	
					$Etime .= ",";
			}
			if(isset($_POST['Submit']))
			{
				Resource_Insert($Stime,$Etime);
				$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				Resource_Update($Stime,$Etime);
				$message = "<br /><div class='message success'><b>Message</b> : User details updated successfully</div>";
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
			for(var i=1;i<=7;i++)
			{
				$('#stime'+i).timepicker({ datepicker:true,showSecond: false,timeFormat: 'hh:mm'});
				$('#etime'+i).timepicker({ datepicker:true,showSecond: false,timeFormat: 'hh:mm'});
			}
			$('#fromdate').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true,yearRange: '1950:2100'});
			$('#todate').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true,yearRange: '1950:2100'});
			$("#fromdate").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
			$("#todate").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
			$("#dob").datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,yearRange: '1950:2100',changeYear: true});
		});
		</script>
	</head>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['SM_id']; ?>" required="required"/>
			<header><h2>Resource Update</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Title <font color="red">*</font><br />
						<select name="titleid" id="titleid">
							<option value="" >Select</option>
						<?php
							$Select_Title = mysql_query("select * from `title` order by name asc");
							while($Fetch_Title = mysql_fetch_array($Select_Title))
							{
								if($FetchResource['titleid']==$Fetch_Title['id'])
									echo '<option value="'.$Fetch_Title['id'].'" selected>'.$Fetch_Title['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Title['id'].'">'.$Fetch_Title['name'].'</option>';
							}
						?>
						</select>
					</label>
					<label>Name <font color="red">*</font><br />
						<input type="text" name="name" value="<?php echo $FetchResource['Name']; ?>" id="name">
					</label>
					<label>Group <font color="red">*</font><br />
						<select name="groupid" id="groupid" onchange="GetDepartment(this.value)">
							<option value="" >Select</option>
						<?php
							$Select_Group = mysql_query("select * from `group` order by name asc");
							while($Fetch_Group = mysql_fetch_array($Select_Group))
							{
								if($FetchResource['groupId']==$Fetch_Group['id'])
									echo '<option value="'.$Fetch_Group['id'].'" selected>'.$Fetch_Group['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Group['id'].'">'.$Fetch_Group['name'].'</option>';
							}
						?>
						</select>
					</label>
					<div id="dept">
						<label>Department <font color="red">*</font><br />
							<select name="departmentid" id="departmentid">
								<option value="" >Select</option>
								<?php
									$Select_Department= mysql_query("select * from `department` where groupid='".$FetchResource['groupId']."' order by name asc");
									while($Fetch_Department = mysql_fetch_array($Select_Department))
									{
										if($Fetch_Department['id']==$FetchResource['departmentId'])
											echo '<option value="'.$Fetch_Department['id'].'" selected>'.$Fetch_Department['name'].'</option>';
										else
											echo '<option value="'.$Fetch_Department['id'].'">'.$Fetch_Department['name'].'</option>';
									}
								?>
							</select>
						</label>
					</div>
				</div>
				<div class="clearfix">
					<label>Designation <font color="red">*</font><br />
						<select name="designationid" id="designationid">
							<option value="" >Select</option>
						<?php
							$Select_Designation= mysql_query("select * from `designation` order by name asc");
							while($Fetch_Designation = mysql_fetch_array($Select_Designation))
							{
								if($Fetch_Designation['id']==$FetchResource['designationId'])
									echo '<option value="'.$Fetch_Designation['id'].'" selected>'.$Fetch_Designation['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Designation['id'].'">'.$Fetch_Designation['name'].'</option>';
							}
						?>
						</select>
					</label>
					<label>Specialization <br />
						<select name="specializationid" id="specializationid">
							<option value="" >Select</option>
						<?php
							$Select_Specialization= mysql_query("select * from `specialization` order by name asc");
							while($Fetch_Specialization = mysql_fetch_array($Select_Specialization))
							{
								if($Fetch_Specialization['id']==$FetchResource['specialization'])
									echo '<option value="'.$Fetch_Specialization['id'].'" selected>'.$Fetch_Specialization['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Specialization['id'].'">'.$Fetch_Specialization['name'].'</option>';
							}
						?>
						</select>
					</label> 
				</div>
				<div>
					<label>KMC-Number <br />
						<input type="text" name="kmc" value="<?php echo $FetchResource['kmc']; ?>" id="kmc"/>
					</label>
				</div>
				<div class="clearfix">
					<label>Qualification <font color="red">*</font><br />
						<select name="qualificationid[]" id="qualificationid" required="required">
							<option value="" >Select</option>
						<?php
							$Select_Qualification= mysql_query("select * from `qualification` order by name asc");
							while($Fetch_Qualification = mysql_fetch_array($Select_Qualification))
							{
								if($ExplodeQualification[0]==$Fetch_Qualification['name'])
									echo '<option value="'.$Fetch_Qualification['name'].'" selected>'.$Fetch_Qualification['name'].'</option>';
								else
									echo '<option value="'.$Fetch_Qualification['name'].'">'.$Fetch_Qualification['name'].'</option>';
							}
						?>
						</select>
						<a style="padding-left:400px" href="#" id="AddMoreFileBox" class="addmore"><img src="images/Add.PNG" title="Add Files"></a>
					</label>
					<?php
				if($_GET['id'])
				{
					for($i=1;$i<count($ExplodeQualification);$i++)
					{
						echo '<div class="clearfix"><label>Qualification <font color="red">*</font></label><select name="qualificationid[]" required="required" id="qualificationid'.$i.'"><option value="" >Select</option>';
						$Select_Qualification= mysql_query("select * from `qualification` order by name asc");
						while($Fetch_Qualification = mysql_fetch_array($Select_Qualification))
						{
							if($ExplodeQualification[$i]==$Fetch_Qualification['name'])
								echo '<option value="'.$Fetch_Qualification['name'].'" selected>'.$Fetch_Qualification['name'].'</option>';
							else
								echo '<option value="'.$Fetch_Qualification['name'].'">'.$Fetch_Qualification['name'].'</option>';
						}
						echo '</select><a href="index.php?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&id='.$_GET['id'].'&index='.$i.'&action=Edit" id=""><img src="images/overlay/close.png" border="0" height="25" width="25"/></a></div>';
					}
				}
				?>
				
				</div>
				<div style="padding-left:200px;" id="AddFileInputBox"></div>
				<div class="clearfix">
					<label>Status <font color="red">*</font><br />
						<select name="status" id="status" onchange="if(this.value=='Visiting') document.getElementById('days').style.display = 'block'; else document.getElementById('days').style.display = 'none';">
							<option value="" >Select</option>
						<?php
							$Status = array("Fulltime","Visiting");
							$i=1;
							foreach($Status as $St)
							{
								if($St==$FetchResource['Status'])
									echo '<option value="'.$St.'" selected>'.$St.'</option>';
								else
									echo '<option value="'.$St.'">'.$St.'</option>';
							}
						?>
						</select>
					</label>
					
				</div>
					<div class="clearfix">
						<div id="days"  style="display:none;">
							<?php
								$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
								$Days = explode('$',$FetchResource['Days']);
								$StartTime = explode(',',$FetchResource['StartTime']);
								$EndTime = explode(',',$FetchResource['EndTime']);
								//$Gender = array("Male","Female");
								$i=0;
								$j=1;
								echo '<table>';
								foreach($days as $day)
								{
									$exist = 0;	//echo "<span class='radio-input'>";
									if($i>6)
										echo '<tr>';
									foreach($Days as $Day)
									{
										if($Day==($i+1))
										{
											echo '<td>
											<span class="radio-input" style="width:200px">
												<input type="checkbox" value="'.(++$i).'" id="daystatus'.$i.'" onclick=\'if(document.getElementById("daystatus'.$i.'").checked){document.getElementById("timings"+this.value).style.display = "block";} else { document.getElementById("timings"+this.value).style.display = "none";}\' name="days[]" id="days" checked>'.$day.'</input>
												<div id="timings'.$j.'">
													<font color="red">*</font>Start Time <br/><input style="width:60px" type="text" value="'.$StartTime[($i-1)].'" id="stime'.$j.'" name="stime'.$j.'" />
													<div style="margin-top:-25px;margin-left:80px"><font color="red">*</font>End Time</div><input style="width:60px" value="'.$EndTime[($i-1)].'"  type="text" id="etime'.$j.'" name="etime'.$j.'" />
												</div>
											</span>
											</td>';
											$exist = 1;	
											break;
										}
									}
									if(!$exist)
									echo '<td>
											<span class="radio-input" style="width:200px">
												<input type="checkbox" value="'.(++$i).'" id="daystatus'.$i.'" onclick=\'if(document.getElementById("daystatus'.$i.'").checked){document.getElementById("timings"+this.value).style.display = "block";} else { document.getElementById("timings"+this.value).style.display = "none";}\' name="days[]" id="days">'.$day.'</input>
												<div id="timings'.$j.'" style="display:none;">
													<font color="red">*</font>Start Time <br/><input style="width:60px" type="text" id="stime'.$j.'" name="stime'.$j.'" />
													<div style="margin-top:-25px;margin-left:80px"><font color="red">*</font>End Time</div><input style="width:60px" type="text" id="etime'.$j.'" name="etime'.$j.'" />
												</div>
											</span>
										</td>';
									if($i==4)
										echo '</tr>';
									$j++;
								}
								echo '</table>';
							?>
						</div>
					</div>	
				
				
				<div class="clearfix">
					<label>Mobile <font color="red">*</font><br />
					<input type="text" name="mobile" value="<?php echo $FetchResource['mobile']; ?>" id="mobile" onkeypress="return isNumeric(event)"/></label>
					<label>DOB <font color="red">*</font><br />
					<input type="text" name="dob" value="<?php if($_GET['id']) echo date('d-m-Y',strtotime($FetchResource['dob'])); ?>" id="dob"></label>
					<label>Personal-Mail <font color="red">*</font><br />
					<input type="text" name="mail1" value="<?php echo $FetchResource['mail1']; ?>" id="mail1"></label>
					<label>Official-Mail <br />
					<input type="text" name="mail2" value="<?php echo $FetchResource['mail2']; ?>" id="mail2"></label>
				</div>
				<div class="clearfix">
					<label>Gender<font color="red">*</font></label>
					<?php
							$Gender = array("Male","Female");
							$i=0;
							foreach($Gender as $Gen)
							{
								if($FetchResource['sex'] == $i)
									echo '<span class="radio-input"><input type="radio" name="sex" value="'.$i.'"  id="sex" checked>'.$Gen.'</input></span>';
								else
									echo '<span class="radio-input"><input type="radio" name="sex" value="'.$i.'"  id="sex">'.$Gen.'</input></span>';
								$i++;
							}
						?>
				</div>
				<div class="clearfix" onclick="resigning();">
					<label>Active <font color="red">*</font></label>
					<?php
						if($_GET['id'])
						{
							if($_GET['resign']==0)
							{
								echo '<span class="radio-input"><input type="radio" name="resign" value="0"  id="resign" checked>No</input></span>';
								echo '<span class="radio-input"><input type="radio" name="resign" value="1"  id="resign">Yes</input></span>';
							}
							else if($_GET['resign']==1)
							{
								echo '<span class="radio-input"><input type="radio" name="resign" value="0"  id="resign">No</input></span>';
								echo '<span class="radio-input"><input type="radio" name="resign" value="1"  id="resign" checked>Yes</input></span>';
							}
						}
						else
						{
							echo '<span class="radio-input"><input type="radio" name="resign" value="0"  id="resign">No</input></span>';
							echo '<span class="radio-input"><input type="radio" name="resign" value="1"  id="resign" checked>Yes</input></span>';
						}
					?>
				</div>
				<?php
					if($_GET['action'] && $_GET['resign']==0)
					{
						echo '<div class="clearfix" id="reasoning">
						<label>Leaving Reason <font color="red">*</font></label>';
						$Reason = array("Study Leave","Sabbatical Leave","Resigned","Completed the Course");
						$k=1;
						foreach($Reason as $Rea)
						{
							if($FetchResource['reason'] == $k)
								echo '<span class="radio-input"><input type="radio" name="reason" value="'.$k.'"  id="reason" checked>'.$Rea.'</input></span>';
							else
								echo '<span class="radio-input"><input type="radio" name="reason" value="'.$k.'"  id="reason">'.$Rea.'</input></span>';
							$k++;
						}
						echo '</div>';
					}	
				else 
				{
				?>
				<div class="clearfix" id="reasoning" style="display:none">
					<label>Leaving Reason <font color="red">*</font></label>
					<?php
						$Reason = array("Study Leave","Sabbatical Leave","Resigned","Completed the Course");
						$k=1;
						foreach($Reason as $Rea)
						{
							if($FetchResource['reason'] == $k)
								echo '<span class="radio-input"><input type="radio" name="reason" value="'.$k.'"  id="reason" checked>'.$Rea.'</input></span>';
							else
								echo '<span class="radio-input"><input type="radio" name="reason" value="'.$k.'"  id="reason">'.$Rea.'</input></span>';
							$k++;
						}
						?>
				</div>
				<?php
				}
				?>
				<div class="clearfix">
					<label>Date Of Join <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="fromdate" value="<?php if($_GET['id']) echo date('d-m-Y',strtotime($FetchResource['Joining'])); ?>" id="fromdate"></label>
					<?php 
					if($_GET['action'] && $_GET['resign'] == 0)
					{ ?>
						<div id='leavingdate'>	
						<label>Date Of Leaving <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" name="todate" value="<?php if($FetchResource['Leaving']) echo $FetchResource['Leaving']; ?>" id="todate"></label>
						</div>
					<?php 
					} 
					else 
					{
					?>
					<div id='leavingdate'style="display:none">	
						<label>Date Of Leaving <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" name="todate" value="<?php if($FetchResource['Leaving']) echo $FetchResource['Leaving']; ?>" id="todate"></label>
					</div>
					<?php
					}
					?>
				</div>
				
				<div class="clearfix">
					<div >
						<label>Upload Photo 
							<input type="file" id="photo" name="photo"/>
							<?php
							$info = pathinfo($_FILES['photo']['name']);
							 $ext = $info['extension']; // get the extension of the file
							 $newname = "newname.".$ext; 
							$target = 'images/'.$newname;
							 move_uploaded_file( $_FILES['photo']['tmp_name'], $target);
							 	if($FetchResource['Photo']) 
									echo '<br/><br/><br/><img src="data:image/jpeg;base64,'.base64_encode($FetchResource['Photo']).'"  width="100px" height="150px" alt="photo"/>';
							?>
						</label> 
					</div>
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
		<font style='color:red;'><div id='blink'>Please enter the name to search.</div></font>
		<div class="columns">
			<h3>Resource Update List
				<?php
					if($_GET['Search'])
						$ResourceTotalRows = mysql_fetch_assoc(ResourceUpdate_Select_Search_Count_All($_GET['Search']));
					else
						$ResourceTotalRows = mysql_fetch_assoc(ResourceUpdate_Select_Count_All());
				echo " : No. of Total Resource Update - ".$ResourceTotalRows['total'];
				?>
			</h3>
			<input type="text" placeholder="Search" id="Search" name="search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/>&nbsp;	
			<hr />			
			<div style="border:1px solid black;width:1000px; overflow-x:scroll;overflow-y: auto;">
				<table class="paginate sortable " style='width:902px;'>
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Photo</th>
							<th align="left">Name</th>
							<th align="left">Designation</th>
							<th align="left">Qualification</th>
							<th align="left">Specialization</th>
							<th align="left">Group</th>
							<th align="left">Department</th>
							<th align="left">Joining Date</th>
							<th align="left">Leaving Date / Reason</th>
							<th align="left">Status</th>
							<th align="left">Days-StartTime-EndTime</th>
							<th align="left">KMC-Number</th>
							<th align="left">Mobile-Number</th>
							<th align="left">Personal-Mail</th>
							<th align="left">Official-Mail</th>
							<th align="left">D.O.B</th>
							<th align="left">Sex</th>
							<th align="left">Action</th>
						</tr>
					</thead>
					<tbody>
							<?php
							if(!$_GET['Search'])
							{
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
								$ResourceUpdate = ResourceUpdate_Select_ByLimit($Start, $Limit);
								$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
								
								while($Resource = mysql_fetch_assoc($ResourceUpdate))
								{ 
									$Qualification = explode('$',$Resource['qualification']);
									$Days = explode('$',$Resource['Days']);
									$StartTime = explode(',',$Resource['StartTime']);
									$EndTime = explode(',',$Resource['EndTime']);
									$Specializationname = mysql_fetch_array(mysql_query("SELECT name from specialization where id ='".$Resource['specializationname']."'"));
									echo "<tr style='valign:middle;'>
										<td align='center' style='vertical-align:middle'>".$i++."</td>
										<td><img src='data:image/jpeg;base64,".base64_encode($Resource['Photo'])."'  width='100px' height='150px' alt='photo'/></td>
										<td style='vertical-align:middle'>".$Resource['titlename'].".".$Resource['Name']."</td>
										<td style='vertical-align:middle'>".$Resource['designationName']."</td>
										<td style='vertical-align:middle'>".implode($Qualification,',')."</td>
										<td style='vertical-align:middle'>".$Specializationname['name']."</td>
										<td style='vertical-align:middle'>".$Resource['groupName']."</td>
										<td style='vertical-align:middle'>".$Resource['departmentName']."</td>";
										if($Resource['Joining'])
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Joining']))."</td>";
										else
											echo "<td style='vertical-align:middle'>-</td>";
											
										if($Resource['reason'] == '1')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Study Leave"."</td>";
										else if($Resource['reason'] == '2')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Sabbatical Leave"."</td>";
										else if($Resource['reason'] == '3')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Resigned"."</td>";
										else if($Resource['reason'] == '4')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Completed the Course"."</td>";
										else if($Resource['Leaving'])	
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."</td>";
										else
											echo "<td style='vertical-align:middle'>-</td>";
											
										if($Resource['Status']=="Visiting")
										{
											echo "<td style='vertical-align:middle'>".$Resource['Status']."</td>
											<td colspan='2' style='vertical-align:middle'>";
											foreach($Days as $Day)
												echo $days[$Day-1].' - '.date("H:i",strtotime($StartTime[$Day-1])).' - '.date("H:i",strtotime($EndTime[$Day-1])).'<br/>';
											echo "</td>";
										}
										else
											echo "<td style='vertical-align:middle'>".$Resource['Status']."</td><td style='vertical-align:middle'><center>-</center></td>";
										echo "<td style='vertical-align:middle'>".$Resource['kmc']."</td>
										<td style='vertical-align:middle'>".$Resource['mobile']."</td>
										<td style='vertical-align:middle'>".$Resource['mail1']."</td>
										<td style='vertical-align:middle'>".$Resource['mail2']."</td>";
										if($Resource['dob'])
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['dob']))."</td>";
										else
											echo "<td style='vertical-align:middle'>-</td>";
										if($Resource['sex']==0)
											echo "<td style='vertical-align:middle'>".Male."</td>";
										else	
											echo "<td style='vertical-align:middle'>".Female."</td>";
									echo "<td style='vertical-align:middle'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Resource['id']."&pageno=".$_GET['pageno']."&action=Edit&resign=".$Resource['resign']."' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Resource['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
									</tr>";
								} 
							}
							else if($_GET['Search'])
							{
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
								$ResourceUpdate = ResourceUpdate_Select_SearchByLimit($Start, $Limit,$_GET['Search']);
								$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
								
								while($Resource = mysql_fetch_assoc($ResourceUpdate))
								{ 
									$Qualification = explode('$',$Resource['qualification']);
									$Days = explode('$',$Resource['Days']);
									$StartTime = explode(',',$Resource['StartTime']);
									$EndTime = explode(',',$Resource['EndTime']);
									$Specializationname = mysql_fetch_array(mysql_query("SELECT name from specialization where id ='".$Resource['specializationname']."'"));
									echo "<tr style='valign:middle;'>
										<td align='center' style='vertical-align:middle'>".$i++."</td>
										<td><img src='data:image/jpeg;base64,".base64_encode($Resource['Photo'])."'  width='100px' height='150px' alt='photo'/></td>
										<td style='vertical-align:middle'>".$Resource['titlename'].".".$Resource['Name']."</td>
										<td style='vertical-align:middle'>".$Resource['designationName']."</td>
										<td style='vertical-align:middle'>".implode($Qualification,',')."</td>
										<td style='vertical-align:middle'>".$Specializationname['name']."</td>
										<td style='vertical-align:middle'>".$Resource['groupName']."</td>
										<td style='vertical-align:middle'>".$Resource['departmentName']."</td>
										<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Joining']))."</td>";
										if($Resource['reason'] == '1')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Study Leave"."</td>";
										else if($Resource['reason'] == '2')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Sabbatical Leave"."</td>";
										else if($Resource['reason'] == '3')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Resigned"."</td>";
										else if($Resource['reason'] == '4')
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."/"."Completed the Course"."</td>";
										else if($Resource['Leaving'])	
											echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['Leaving']))."</td>";
										else
											echo "<td style='vertical-align:middle'>-</td>";
											
										if($Resource['Status']=="Visiting")
										{
											echo "<td style='vertical-align:middle'>".$Resource['Status']."</td>
											<td style='vertical-align:middle'>";
											foreach($Days as $Day)
												echo $days[$Day-1].' - '.date("H:i",strtotime($StartTime[$Day-1])).' - '.date("H:i",strtotime($EndTime[$Day-1])).'<br/>';
											echo "</td>";
										}
										else
											echo "<td style='vertical-align:middle'>".$Resource['Status']."</td><td style='vertical-align:middle'><center>-</center></td>";
										echo "<td style='vertical-align:middle'>".$Resource['kmc']."</td>
										<td style='vertical-align:middle'>".$Resource['mobile']."</td>
										<td style='vertical-align:middle'>".$Resource['mail1']."</td>
										<td style='vertical-align:middle'>".$Resource['mail2']."</td>
										<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['dob']))."</td>";
										if($Resource['sex']==0)
											echo "<td style='vertical-align:middle'>".Male."</td>";
										else	
											echo "<td style='vertical-align:middle'>".Female."</td>";
									echo "<td style='vertical-align:middle'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Resource['id']."&pageno=".$_GET['pageno']."&action=Edit&resign=".$Resource['resign']."' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Resource['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
									</tr>";
								} 
							}
							?>
					</tbody>
				</table>
			</div>	
		</div>	
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	
	if($_GET['Search'])
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&Search=".$_GET['Search']."&";
	else
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function resigning()
	{
		if(document.getElementById("resign").checked)
		{
			document.getElementById("leavingdate").style.display = "block";
			document.getElementById("reasoning").style.display = "block";
		}
		else
		{
			document.getElementById("leavingdate").style.display = "none";
			document.getElementById("reasoning").style.display = "none";
		}
	}
	<?php
	if($FetchResource['Status']=="Visiting")
	{ ?>
		document.getElementById("days").style.display="block";
	<?php
	} ?>
	var Items = 0;
	Items = <?php echo count($ExplodeQualification); ?>;
	$(document).ready(function()
	{
		
			var FileInputsHolder = $('#AddFileInputBox');
			var MaxFileInputs = 10;
			var i = 0;
			if(Items==0)
				i = $('#AddFileInputBox div').size() + 1;
			else	
				i = Items;
			$('#AddMoreFileBox').live('click', function() 
			{
				/*var Qualifications = document.getElementsByName("qualificationid[]");
				for(var l=0;l<Qualifications.length;l++)
				{
					if(l==0)
					{
						if(!document.getElementById('qualificationid').value)
							alert("Please Select Qualification");
					}
					else 
					{
						if(!document.getElementById('qualificationid'+l).value);
					}
				}*/
					if(!document.getElementById("qualificationid").value)
						alert("Please Select Qualification");
				else
				{
					if(i < MaxFileInputs)
					{
						var Qualifications = "";
						var Qualification = document.getElementsByName("qualificationid[]");
						for(var k=0;k<Qualification.length;k++)
						{
							if(k==0)
								Qualifications += document.getElementById('qualificationid').value+"$";
							else
								Qualifications += document.getElementById('qualificationid'+k).value+"$";
						}
						$.post("includes/GetQualification.php?qualificationid="+Qualifications+"&i="+i, function(Response)
						{
							$('<span style="padding-left:50px;"><br/>'+Response+'<a href="#" id="removeFileBox"><img src="images/overlay/close.png" border="0" height="25" width="25"/></a></span>').appendTo(FileInputsHolder);
						});
						i++;
					}
					return false;
				}
			});
			$('#removeFileBox').live('click', function()
			{
				if(i > 1)
				{
					$(this).parents('span').remove();
					i--;
				}
				return false;
			});
	});
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
		if(document.getElementById("mobile").value.length < 10)
			return true;
		else
			return false;
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
			document.getElementById("dept").innerHTML = xmlhttp.responseText;
	}
	xmlhttp.open("GET","includes/GetDepartment.php?GroupId="+GroupId,true);
	xmlhttp.send();
}
	function validation()
	{
		var message = "";
		var mail=/^([a-zA-Z0-9_\.\-]{3,30})+\@(([a-zA-Z0-9\-]{3,50})+\.)+([a-zA-Z0-9]{2,4})+$/;
		var Sex = document.getElementsByName("sex");
		var Reason = document.getElementsByName("reason");
		var flag = 0;
			for (var i = 0; i< Sex.length; i++)
				if(Sex[i].checked)
				flag++;	
		var reasonflag = 0;
		for (var i = 0; i< Reason.length; i++)
			if(Reason[i].checked)
			reasonflag++;
		if(document.getElementById("resign").checked)
		{	
			if(!reasonflag)
				message = "Please select reason for leaving";
			if(document.getElementById("todate").value ==0)
			message = "Please select the Leaving Date";	
		}	
		
		if(document.getElementById("fromdate").value ==0)
			message = "Please select the Date Of Join";
		if(!flag)
			message = "Please select Sex";
		if(document.getElementById("dob").value == "")
			message = "Please Select the date-of-birth";
		if(!mail.test(document.getElementById('mail1').value) && document.getElementById('mail1').value =="")
			message = "Please enter valid Personal-Mail";
		if(document.getElementById("mobile").value.length < 10)
			message = "Mobile Number is invalid";
		if(document.getElementById("mobile").value == 0)
			message = "Mobile Number is invalid";
		if((document.getElementById("status").value == "Visiting"))
		{
			var dayschecking = 0;
			var starttimechecking = 0;
			var endtimechecking = 0;
			for(var i=1;i<=7;i++)
			{
				if(document.getElementById('daystatus'+i).checked)
					dayschecking++;
				if(document.getElementById('stime'+i).value)
					starttimechecking++;
				if(document.getElementById('etime'+i).value)
					endtimechecking++;
			}
			if(endtimechecking == 0)
			message = "Please select the endtime";
			if(starttimechecking == 0)
			message = "Please select the starttime";
			if(dayschecking == 0)
			message = "Please select the days";	
		}	
		if(document.getElementById("status").value ==0)
			message = "Please select the status";
		if(document.getElementById("qualificationid").value ==0)
			message = "Please select the qualification";
		if(document.getElementById("designationid").value ==0)
			message = "Please select the designation";
		if(document.getElementById("departmentid").value ==0)
			message = "Please select the department";
		if(document.getElementById("groupid").value ==0)
			message = "Please select the group";
		if(document.getElementById("name").value ==0)
			message = "Please enter the name";	
		if(document.getElementById("titleid").value ==0)
			message = "Please select the title";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
	}
	function Search()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
	Blink();
	function Blink()
	{
		obj=document.getElementById("blink");
		if (obj.style.visibility=="hidden")
			obj.style.visibility="visible";
		else obj.style.visibility="hidden";
		window.setTimeout("Blink();",1000);
	}
</script>