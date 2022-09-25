<HEAD>
  <TITLE> Timepicker Addon</TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-1.8.16.custom.css" />
  <link rel="stylesheet"  type="text/css" href="css/datetimepicker.css" />
  
<style type="text/css">

</style>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#startdate').datetimepicker({ showSecond: true,dateFormat: 'yy-mm-dd',timeFormat: 'hh:mm:ss',changeMonth: true,changeYear: true});
	$('#enddate').datetimepicker({ showSecond: true,dateFormat: 'yy-mm-dd',timeFormat: 'hh:mm:ss',changeMonth: true,changeYear: true});
});
</script>
 </HEAD>
<?php
	date_default_timezone_set("Asia/Kolkata"); 
	$Ticket = $_GET['TicketNo'];
	$Ticketname = explode("-",$_GET['TicketNo']);
	$Ticketbiomedical =  $Ticketname[0];
	if($_GET['action']=="delete")
		PartsDelete_ById($_GET['id']);
	if($_GET['action']=="edit")
		$SelectPartDetailsById = mysqli_fetch_array(Complaint_PartDetailsById($_GET['id']));
	$Select_Complaint = mysqli_fetch_array(Complaint_A_Ticket($_GET['TicketNo']));
	if(isset($_POST['Update'])  && ($_POST['comments']) || $_POST['Submit'])
	{
		if($_POST['itemname'] == "undefined" || $_POST['itemname'] == "")
			$_POST['itemname'] = $Select_Complaint['itemid'];
		$ExplodeComplaintTypeId = explode("#",$_POST['subdepartment']);
		if($_POST['comments'] && $_POST['status'])
			InsertAudit($_POST['complaintid'],$_POST['comments'],$_POST['status'],$_POST['Complaint_Priorities'],$Select_Complaint['zoneid'],$_SESSION['id']); 
		if($_POST['complaintid'] && ($_POST['comments']) && $_POST['status'])
		{
			UpdateComplaint($_POST['complaintid'],$ExplodeComplaintTypeId[0],$ExplodeComplaintTypeId[0],$_POST['Complaint_Priorities'],$_POST['technician'],$_POST['status'],$_POST['category'],$_POST['reasonforhold'],$_SESSION['id'],$_POST['itemname']);
		}
		if($Ticketbiomedical =="Biomedical" && $_POST['complaintid'] && ($_POST['comments']) && $_POST['status'])
			UpdateBioComplaint($_POST['complaintid'],$ExplodeComplaintTypeId[0],$ExplodeComplaintTypeId[0],$_POST['Complaint_Priorities'],$_POST['technician'],$_POST['status'],$_POST['category'],$_POST['reasonforhold'],$_SESSION['id'],$_POST['itemname'],$_POST['startdate'],$_POST['enddate'],$_POST['remarks'],$_POST['breakdowncategory']);
		if($Ticketbiomedical =="Biomedical" &&  ($_POST['comments']) && ($_POST['startdate']))
			mysqli_query($_SESSION['connection'],"insert into assets_inventory_status (id,assetinventory_id,date,inspectby,fault,costinvolved,remark,complaintid) values ('','".$_POST['itemname']."','".date('Y-m-d H:i:s', strtotime($_POST['startdate']))."','".$_SESSION['id']."','".$_POST['remarks']."','".$_POST['amount']."','".$_POST['comments']."','".$_POST['complaintid']."')");
		if($_POST['Complaint_Parts'] && $_POST['partname'] && $_POST['department'])
			InsertPartDetails($_POST['complaintid'],$_POST['partname'],$_POST['quantity'],$_POST['department'],$_POST['amount'],$_POST['bycash'],$_SESSION['id']); 
		//if($_POST['amount'] &&  $_POST['Submit'])
			//mysqli_query($_SESSION['connection'],"update assets_inventory_status  SET costinvolved='".$_POST['amount']."' where complaintid='".$_POST['complaintid']."'");
		if($_FILES['file']['name'])
		{
			if(count($_FILES['file']['name']))
			{
				if(!$Select_Complaint['filename'])
					$imageslist = '';
				else
					$imageslist = $Select_Complaint['filename'];
				for($i=0; $i < count($_FILES['file']['name']); $i++)
				{
					$tmpFilePath = $_FILES['file']['tmp_name'][$i];
					if($_FILES['file']['name'][$i])
					{
						$image_RandImageName = str_replace(array('-', ' ', ':'), '', date("Y-m-d H:i:s"))."_".$_FILES['file']['name'][$i]; //Set the Destination Image path with Random Name
						$imageslist .= $image_RandImageName.'#';
						$image_DestRandImageName = "Files/".$image_RandImageName; 	
						if($tmpFilePath != "")
						{
							if(move_uploaded_file($tmpFilePath, $image_DestRandImageName))
							{
							}
						}
					}
				}
				if($imageslist)
					mysqli_query($_SESSION['connection'],"UPDATE complaint SET filename='".mysql_real_escape_string($imageslist)."' WHERE id='".$_POST['complaintid']."'");	
			}
		}
	}
	/*if(isset($_POST['Submit']) &&  $_POST['partname'] )
	{	
		$ExplodeComplaintTypeId = explode("#",$_POST['subdepartment']);
		if($_POST['comments'] && $_POST['status'])
			InsertAudit($_POST['complaintid'],$_POST['comments'],$_POST['status'],$_POST['Complaint_Priorities'],$Select_Complaint['zoneid'],$_SESSION['id']); 
		if($_POST['complaintid'] && ($_POST['comments']) && $_POST['status'])
			UpdateComplaint($_POST['complaintid'],$ExplodeComplaintTypeId[0],$ExplodeComplaintTypeId[0],$_POST['Complaint_Priorities'],$_POST['technician'],$_POST['status'],$_POST['category'],$_POST['reasonforhold'],$_SESSION['id'],$_POST['itemname']);
		
		
		//
	}*/
	if(isset($_POST['moveto']))
	{
		$ExplodeGroup = explode("-",$_POST['groupid']);
		$Group = mysqli_fetch_assoc(Complaint_Select_GroupNameByNotId($Select_Complaint['groupid']));
		$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
		$Ticket = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"Select * from complaint where ticketno like '".$Group['name']."%' order by id desc"));
		$TicketNo = explode("-",$Ticket['ticketno']);
		$TicketNo = $Group['name']."-".$Digits[7 - strlen($TicketNo[1]+1)].($TicketNo[1]+1);
		ComplaintMoveToOtherInsert($_GET['TicketNo'], $Select_Complaint['groupid'], $Select_Complaint['id'],$TicketNo,$Select_Complaint['description'],$Select_Complaint['remarks'],$Group['defaultadmin'],$Select_Complaint['sourceid'],$Select_Complaint['departmentid'],$Select_Complaint['locationid'],$Group['id'],'3','1',$Select_Complaint['reasonforhold'],$Select_Complaint['createdby'],$_SESSION['id']);		
		$OtherGroupname = mysqli_fetch_array(Complaint_Select_GroupNameByNotId($ExplodeGroup[0]));
		echo "<div class='message info'>
			<p>This Issue is Not Related to ".$ExplodeGroup[0].". Creating New Issue ".$TicketNo." Where ".$OtherGroupname['name']."  moved by ".$_SESSION['name'].".</p>
		</div>";
	}
	if(isset($_POST['UpdatePart']))
		UpdatePartDetails();
	$Complaint = mysqli_fetch_array(Complaint_A_Ticket($_GET['TicketNo'])); 
	$FetchComplaintTypeId = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($Complaint['complainttypeid']));
	$SelectAudit = mysqli_fetch_array(Complaint_Comments($Complaint['id']));
	$SelectPartDetails = mysqli_fetch_array(Complaint_PartDetails($Complaint['id']));
	$ComplaintSelectGroup = mysqli_fetch_array(ComplaintGroup($Complaint['groupid']));
	$ExplodeTicketNo = explode('-',$_GET['TicketNo']);
	$Locationname = mysqli_fetch_array(Complaint_Get_Location($Complaint['locationid'])); 
	$Selectbiobreakdown = mysqli_fetch_array(Complaintbiobreakdown($Complaint['id']));
?>
<!--form method="post" action="" id="form" class="form panel"-->
	<input type="hidden" name="id" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>" required="required"/>	
	<input type="hidden" name="groupid" value="<?php echo $ComplaintSelectGroup['name']."-".$ComplaintSelectGroup['id']; ?>" required="required"/>	
	<input type="hidden" name="complaintid" value="<?php echo $Complaint['id']; ?>" required="required"/>	
	<table>
		<tr>
			<td style='width:320px'>
				<header><h2>Ticket No: <font color='red'><?php echo $_GET['TicketNo']; ?></font></h2></header>
			</td>
			<td style="width:320px">
				<header><h2>Status:<font color='red'>
				<?php $Complaint_Select_Status = mysqli_fetch_array(Complaint_Get_Status($SelectAudit['statusid']));
						echo $Complaint_Select_Status['name']; ?>
				</font></h2></header>
			</td>
			<td>
			<?php
				if(($Complaint['statusid'] != '7') && ($_SESSION['roleid']!='4') && $Complaint['groupid']!=3)
				{
					$Commonticket = explode('-',$_GET['TicketNo']);
					if($Commonticket[0] == "Common")
					{
						$Groups = Complaint_Select_onlyMIS();
						while($Group = mysqli_fetch_assoc($Groups))
						{
							if($Group['id'] != $ComplaintSelectGroup['id'])
								echo '<button class="button button-green" type="submit" name="moveto" value="moveto">Move to '.$Group['name'].'</button>';
						}
					}
					else
					{
						$Groups = Complaint_Select_ExceptBiogroupandCommon();
						while($Group = mysqli_fetch_assoc($Groups))
						{
							if($Group['id'] != $ComplaintSelectGroup['id'])
								echo '<button class="button button-green" type="submit" name="moveto" value="moveto">Move to '.$Group['name'].'</button>';
						}
					}	//echo "<a class='button button-orange' href=\"?page=".$_GET['page']."&group=".$Group['name']."&groupid=".$Group['id']."\"><img src='images/".$BtImg[$Group['id']].".jpg' width='250px'/><br />".$Group['name']."</a>&nbsp;&nbsp;";
				}
				?>
			</td>
			<td style="padding-left:5px;">
			<?php if(mysqli_num_rows(Complaint_Comments($Complaint['id']))>1)
			{
			?>
				<a class="button button-green" onclick="Export('&ComplaintId=<?php echo $Complaint['id'];?>&TicketNo=<?php echo $_GET['TicketNo'];?>')">Download</a>
			<?php 
			} ?>
			</td>
		</tr>
	</table>
	<hr/>	
	<fieldset>
		
		<div class="clearfix">
			<table>
				<tr>
					<td style="width:400px">
						<b>Complaint Source:</b>
						<?php 
						if($Source = mysqli_fetch_array(Complaint_Get_Source($Complaint['sourceid'])))
							echo "<font size='2'>".$Source['name']."</font>"; ?>
						<br />
						<br />
						<p style="border-style:solid;border-width:1px;width:390px">
							<b>Defects:</b>
							<?php echo "<font size='2'>".$Complaint['description']."</font>"; ?>
						</p>
					</td>
					<td style="width:400px;">
						<b>Department:</b>
						<?php 
						if($Department = mysqli_fetch_array(Complaint_Get_Department($Complaint['departmentid'])))
							echo "<font size='2'>".$Department['name']."</font>";
						?>
						<b>Extension:</b>&nbsp;&nbsp;
						<?php 
						if($Department = mysqli_fetch_array(Complaint_Get_Department($Complaint['departmentid'])))
							echo "<font size='2'>".$Department['extension']."</font>";
						?>
						<br />
						<br />
						<p style="border-style:solid;border-width:1px;width:390px">
							<b>Remarks:</b>
							<?php echo "<font size='2'>".$Complaint['remarks']."</font>"; ?>
						</p>
					</td>
					<td>
						<table>
							<b>Priority:</b>
							<?php 
							$Complaint_Priority = Complaint_Status_Priority();
							while($Complaint_Priorities = mysqli_fetch_array($Complaint_Priority))
							{
								if($Complaint['priorityid'] == $Complaint_Priorities['id'])
									echo '<tr><td><input type="radio" name="Complaint_Priorities" value="'.$Complaint_Priorities['id'].'" checked>'.$Complaint_Priorities['name'].'</td></tr>';
								else
									echo '<tr><td><input type="radio" name="Complaint_Priorities" value="'.$Complaint_Priorities['id'].'">'.$Complaint_Priorities['name'].'</td></tr>';
							} ?>
						</table>
					</td>
				</tr>
			</table>
		</div>
		</br>
		<div class="clearfix">
		<?php
			if($Ticketbiomedical == "Biomedical")
			{
				$Equipment = mysqli_fetch_array(mysqli_query($_SESSION['connection'],'SELECT itemid FROM complaint where ticketno="'.$_GET['TicketNo'].'"'));
				$Equipment_Name = mysqli_fetch_array(mysqli_query($_SESSION['connection'],'SELECT * FROM biomedical_equipment JOIN assets_inventory ON biomedical_equipment.id = assets_inventory.equipment_idname  where biomedical_equipment.id="'.$Equipment['itemid'].'"'));
				$Model = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model WHERE id='".$Equipment_Name['model_id']."'"));
				$Make = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make WHERE id='".$Equipment_Name['make_id']."'"));
				echo "<b>Equipment- </b>".$Equipment_Name['equipment'];
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<b>Model- </b>".$Model['model'];
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<b>Make- </b>".$Make['make'];
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<b>Equipment ID- </b>".$Equipment_Name['equipmentid'];
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<b>Serial Number- </b>".$Equipment_Name['serialnumber'];
			}
		?>
		</div><br/>
		<div class="clearfix">
			<table>
				<tr>
					<td>
						<label><b>Sub-Department:</b>
						<?php 
						if($_SESSION['roleid']=='1' || $_SESSION['roleid']=='2' || $_SESSION['roleid']=='5' || $_SESSION['roleid']=='3')
							echo '<font color="red">*</font></label>';
						
						$Complaint_Sub_Department = Complaint_SubDepartment($Complaint['groupid']);
						echo '<select name="subdepartment"  onchange="GetTechnician(this.value, 0,0)" id="subdepartment">
								<option value="Select">Select</option>';
						while($Complaint_Sub_Departments = mysqli_fetch_array($Complaint_Sub_Department))
						{
							if($Complaint['subgroupid'] == $Complaint_Sub_Departments['id'])
								echo '<option value="'.$Complaint_Sub_Departments['id']."#".$Complaint_Sub_Departments['name'].'" selected>'.$Complaint_Sub_Departments['name'].'</option>';
							else if($_SESSION['roleid']=='4')
								echo '<option value="'.$Complaint_Sub_Departments['id']."#".$Complaint_Sub_Departments['name'].'" disabled>'.$Complaint_Sub_Departments['name'].'</option>';
							else
								echo '<option value="'.$Complaint_Sub_Departments['id']."#".$Complaint_Sub_Departments['name'].'" >'.$Complaint_Sub_Departments['name'].'</option>';
						}
						echo '</select>';
						?>
					</td>
					<td>
						<div id='techniciandiv' style='float:left;margin-top:-90px;margin-left:25px;'>
							<input id="technician" type="hidden" value="0" />
						</div>
					</td>
					<?php 
					$Ticketnumbers = explode("-",$_GET['TicketNo']);
					?>
					<td style="padding-right:350px">
						<label><b>Status:</b>
						<?php
						if($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2 || $_SESSION['roleid'] == 5 || $_SESSION['roleid'] == 3)
							echo '<font color="red">*</font></label>';
						if($Ticketnumbers[0]== 'Biomedical')
							$Status = Complaint_Status_Biomedical();
						else
							$Status = Complaint_Status();
						echo '<select name="status" onchange="ResonForHold(this.value);Bioremarks(this.value);" id="status">
						<option value="Select">Select</option>';
						if($Ticketnumbers[0]== 'Biomedical')
						{
							while($Complaint_Statuses = mysqli_fetch_array($Status))
							{
								if($SelectAudit['statusid'] == $Complaint_Statuses['id'])
									echo '<option value="'.$Complaint_Statuses['id'].'" selected>'.$Complaint_Statuses['name'].'</option>';
								//else if(($SelectAudit['statusid'] == 7 && $Complaint_Statuses['id'] == 6) || ($SelectAudit['statusid']!=7 && $SelectAudit['statusid']!=6 && $Complaint_Statuses['id']<6) || ($SelectAudit['statusid']!=7 && $SelectAudit['statusid']==6 && $Complaint_Statuses['id']>1 && $Complaint_Statuses['id']<6))
								//{
								else if($_SESSION['roleid'] == 4 && ($_SESSION['roleid'] != $Complaint['createdby'] && $SelectAudit['statusid'] != 7))
										echo '<option value="'.$Complaint_Statuses['id'].'" disabled>'.$Complaint_Statuses['name'].'</option>';
									else if($Complaint_Statuses['id']!=5 && $Complaint_Statuses['id']!=6 && $Complaint_Statuses['id']!=8)
										echo '<option value="'.$Complaint_Statuses['id'].'">'.$Complaint_Statuses['name'].'</option>';
								//}
							}
						}
						else
						{
							while($Complaint_Statuses = mysqli_fetch_array($Status))
							{
								if($SelectAudit['statusid'] == $Complaint_Statuses['id'])
									echo '<option value="'.$Complaint_Statuses['id'].'" selected>'.$Complaint_Statuses['name'].'</option>';
								else if(($SelectAudit['statusid'] == 7 && $Complaint_Statuses['id'] == 6) || ($SelectAudit['statusid']!=7 && $SelectAudit['statusid']!=6 && $Complaint_Statuses['id']<6) || ($SelectAudit['statusid']!=7 && $SelectAudit['statusid']==6 && $Complaint_Statuses['id']>1 && $Complaint_Statuses['id']<6))
								{
									if($_SESSION['roleid'] == 4 && ($_SESSION['roleid'] != $Complaint['createdby'] && $SelectAudit['statusid'] != 7))
										echo '<option value="'.$Complaint_Statuses['id'].'" disabled>'.$Complaint_Statuses['name'].'</option>';
									else
										echo '<option value="'.$Complaint_Statuses['id'].'">'.$Complaint_Statuses['name'].'</option>';
								}
							}
						}
						echo '</select>';
						?>
					</td>
					<td>
						<?php
							if($Complaint['complainttypeid'])	
								echo '<div id="complainttype" style="float:left;margin-top:-80px;margin-left:-350px;"><b>Complaint Type: </b>'.$FetchComplaintTypeId['complainttype'].'</div>';	
							else	
								echo '<div id="complainttype" style="float:left;margin-top:-80px;margin-left:-350px;"></div>';
						?>
					</td>
				</tr>
				<?php 
				if($Ticketbiomedical == "Biomedical")
				{ ?>
						<tr>
							<td>
								<b>Breakdown Category:</b>
									<select name="breakdowncategory" id="breakdowncategory">
									<option value="">select</option>
									<?php
									$Breakdown_Priority = Breakdown_Category();
									while($Breakdown_Priority_name = mysqli_fetch_array($Breakdown_Priority))
									{
										if($Breakdown_Priority_name['id'] == $Selectbiobreakdown['breakdowncategory'])
											echo "<option value=".$Breakdown_Priority_name['id']." selected>".$Breakdown_Priority_name['breakdowncategory']."</option>";
										else	
											echo "<option value=".$Breakdown_Priority_name['id'].">".$Breakdown_Priority_name['breakdowncategory']."</option>";
									} ?>
							</td>
						</tr>
				<?php 
				} ?>
				<tr>
					<?php echo "<td><div id='itemdiv'></div></td>"; ?>
				</tr>
				<?php 
				$Explode_Tickets = explode("-",$_GET['TicketNo']);
				if($Explode_Tickets[0] != "Biomedical")
				{
				?>
				<tr>
					<b>Location:
					<font color='red'><?php echo $Locationname['name']; ?></font>
					</b>
				</tr>
				<?php } ?>
			</table>
			
			<table id="reasonforhold">
				<tr>
					<td>
						<div class='clearfix'><label><b>Reason For On-Hold/In-Process Category:</b><font color='red'>*</font></label>
						<select name='category' cols='125' rows='4' id='category'>
							<option value=''>Select</option>
							<?php
							$SelectCategory = Complaint_Category_Select();
							while($FetchCategory = mysqli_fetch_array($SelectCategory))
							{
								if($Complaint['holdcategoryid'] == $FetchCategory['id'])
									echo "<option value='".$FetchCategory['id']."' selected>".$FetchCategory['name']."</option>";
								else if($_SESSION['roleid'] == 4)
									echo "<option value='".$FetchCategory['id']."' disabled>".$FetchCategory['name']."</option>";
								else
									echo "<option value='".$FetchCategory['id']."' >".$FetchCategory['name']."</option>";
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<div class='clearfix'><label><b>Reason For On-Hold/In-Process:</b><font color='red'>*</font></label>
						<textarea name='reasonforhold' cols='125' rows='4' id='reason'><?php if($Complaint['reasonforhold'] != 'null') echo $Complaint['reasonforhold'];?></textarea>
					</td>
				</tr>
			</table>
			<table id="Biohide">
				<tr>
					<td>
					<?php if($Ticketbiomedical == "Biomedical")
					{ ?>
						<div class="clearfix">
						<label><b>Start Date:</b><font color="red">*</font>
							<input type="text" name="startdate" cols="125" rows="4" id="startdate" value="<?php echo $Complaint['bio_startdate']; ?>"> </input></label>
						
							<label><b>End Date:</b><font color="red">*</font>
							<input type="text" name="enddate" cols="125" rows="4" id="enddate" value="<?php echo $Complaint['bio_enddate'];  ?>" ></input></label>
						</div>
						<div class="clearfix">
							<label><b>Remarks:</b><font color="red">*</font></label>
							<textarea name="remarks" cols="125" rows="4" id="remarks"><?php echo $Complaint['bio_remark'];  ?></textarea>
						</div>
						<?php
					}
						?>
			</table>
			<table>
						<div class="clearfix">
							<label><b>Comments:</b><font color="red">*</font></label>
							<textarea name="comments" cols="125" rows="4" id="comments"></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<label><b>Add Files/Images (Max. 10 Files/Images)</b></label>
						<div id="AddFileInputBox">
							<input type="file" name="file[]" id="file" onchange="Validatefiles('file');" multiple />
							<a href="#" id="AddMoreFileBox" class="addmore"><img src="images/Add.png" title="Add Files"></a>
						</div>
					</td>
				</tr>				
			</table>
	</fieldset>
	<?php echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="return validation()">Update</button>&nbsp;&nbsp;'; ?>
	<br/> <br/>	
	<?php 
	if($_SESSION['roleid']!='4') 
	{ ?>	
	<div style="border:1px solid;border-radius:15px;"><br />
		<table>
			<tr>
					<td >
						<b>Parts Procured:</b>
					</td>
					<td style="width:60px">
						<?php
						if(!$SelectPartDetailsById['procuredfrom'])
							echo '<span class="radio-input"><input type="radio" name="Complaint_Parts" onclick="partsenable(0)" value="0" id="Complaint_Parts" checked>No</input></span><br/>
								<span class="radio-input"><input type="radio" name="Complaint_Parts" onclick="partsenable(1)" value="1" id="Complaint_Parts">Yes</input></span>';
						else 
							echo '<span class="radio-input"><input type="radio" name="Complaint_Parts" onclick="partsenable(0)" value="0" id="Complaint_Parts">No</input></span><br/>
								<span class="radio-input"><input type="radio" name="Complaint_Parts" onclick="partsenable(1)" value="1" id="Complaint_Parts" checked>Yes</input></span>';
						?>
					</td>
					<td style="padding-left:15px;width:170px" id="partnamehide">
						<b>Parts Name:</b><font color="red" id="1">*</font>
						<input type="text" id="partname" name="partname" value="<?php echo $SelectPartDetailsById['partname'];?>" onkeypress="return AlphaNumCheck(event)"></input>
					</td>
					<td id="quantityhide">
						<b>Quantity:</b><font color="red" id="4">*</font><br>
						<input type="text" id="quantity" name="quantity" value="<?php echo $SelectPartDetailsById['quantity'];?>" onkeypress="return isNumeric(event)"></input>
					</td>
					<td style="padding-left:15px" id="procuredfromhide">
						<b>Procured From:</b><font color="red" id="2">*</font>
						<br />
						<select id="department" name="department">
							<option value="Select">Select</option>
							<?php
							$Complaint_Departments = Fetch_Stores();
							while($Departments = mysqli_fetch_array($Complaint_Departments))
							{
								if($SelectPartDetailsById['procuredfrom'] == $Departments['id'])
									echo "<option value='".$Departments['id']."' selected>".$Departments['name']."</option>";
								else
									echo "<option value='".$Departments['id']."'>".$Departments['name']."</option>";
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td id="cashhide1">
						<b>By Cash:</b>
					</td>
					<td id="cashhide2">
					<?php
						if(!$SelectPartDetailsById['bycash'])
							echo '<span class="radio-input"><input type="radio" name="bycash" id="bycash" onclick="enableamount(0)"  value="0" checked>No</input></span><br>
								<span class="radio-input"><input type="radio" name="bycash" id="bycash" value="1" onclick="enableamount(1)">Yes</input></span>';
						else
							echo '<span class="radio-input"><input type="radio" name="bycash" id="bycash" value="0" onclick="enableamount(0)">No</input></span><br>
								<span class="radio-input"><input type="radio" name="bycash" id="bycash" value="1" onclick="enableamount(1)" checked>Yes</input></span>';
					?>
					</td>
				
					<td style="width:170px;padding-left:25px;" id="amounthide">
						<b>Amount:</b><font color="red" id="3">*</font><br>
						<input type="text" id="amount" name="amount" onkeypress="return isNumeric(event)" value="<?php if($SelectPartDetailsById['amount']) echo $SelectPartDetailsById['amount'];?>"></input>
					</td>
				
				<td>
					<br />
					<?php 
					if($_GET['action']=='edit')
						echo '<button class="button button-green" id="submit" type="submit" name="UpdatePart" value="UpdatePart" onclick="return validation1()">Update</button>&nbsp;&nbsp;'; 
					else
						echo '<button class="button button-green" id="submit" type="submit" name="Submit" value="Submit" onclick="return validation1()">Add</button>&nbsp;&nbsp;'; ?>
				</td>
			</tr>
		</table>
	</div>
	<?php
	} ?>
	<hr />
<!--/form-->
	<?php
	$ComplaintSelectPartsDetails = Complaint_PartDetails($Complaint['id']);	
	if(mysqli_num_rows($ComplaintSelectPartsDetails))
	{ ?>
		<table class="paginate sortable full">
			<b>Part Details</b>
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Part Name</th>
					<th>Quantity</th>
					<th>Procured From</th>
					<th>Amount</th>
					<th>Action</th>
				</tr>
			</thead>
			<?php
			$Amount = $k = 0;
			while($ComplaintPartsDetails = mysqli_fetch_array($ComplaintSelectPartsDetails))
			{				
				$FetchStore = mysqli_fetch_array(SelectStoreById($ComplaintPartsDetails['procuredfrom']));
				echo "<tr><td align='center'>".++$k."</td>
				<td align='center'>".$ComplaintPartsDetails['partname']."</td>
				<td align='center'>".$ComplaintPartsDetails['quantity']."</td>
				<td align='center'>".$FetchStore['name']."</td>";
				$Amount += $ComplaintPartsDetails['amount'];
				echo "<td align='center'>".$ComplaintPartsDetails['amount']."</td>
				<td align='center'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&TicketNo=".$_GET['TicketNo']."&ComplaintId=".$_GET['ComplaintId']."&id=".$ComplaintPartsDetails['id']."&action=edit'>Edit</a>|<a href='#' onclick='deleterow(".$ComplaintPartsDetails['id'].")'>Delete</a></td>
				</tr>";
			} ?>
		</table>
	<?php
	echo '<br/><hr />';
	} 
	if($Complaint['filename'])	
	{
		$FileNames = explode('#',$Complaint['filename']); 
		if($FileNames)
		{ ?>
			<h4><b>Files uploaded</b></h3>
			<table class="paginate sortable">
				<thead>
					<tr>
						<th align="left">Filename</th>
					</tr>
				</thead>
				<?php 
					
					foreach($FileNames as $FileName)
					{
						$Explode_Filename = explode('_',$FileName); 
						if($Explode_Filename[0])
							echo '<tr><td><a href="Files/'.$FileName.'" title="'.$FileName[1].'" target="_blank">'.substr($Explode_Filename[0],0,4).'/'.substr($Explode_Filename[0],4,-8).'/'.substr($Explode_Filename[0],6,-6).' '.rtrim(chunk_split(substr($Explode_Filename[0],-6),2,':'),':').' '.$Explode_Filename[1].'</a></td></tr>';
					}
				?>
			</table><br/>
		<?php
		}
	} ?>
<table class="paginate sortable full">
	<thead>
		<tr>
			<th>Comments</th>
			<th>Status</th>
			<th>Date</th>
			<th>Updated-By</th>
		</tr>
	</thead>
	<?php
	$CommentsSelect = mysqli_num_rows(Complaint_Comments($Complaint['id']));
	if(!$CommentsSelect)
		echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
	$Limit = 10;
	$total_pages = ceil($CommentsSelect / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	
	$Start = ($_GET['pageno']-1)*$Limit;
	$CommentsSelectByLimit = Complaint_Comments_ByLimit($Complaint['id'],$Start, $Limit);
	while($FetchComments = mysqli_fetch_array($CommentsSelectByLimit))
	{
		$Biostartdate = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM complaint where id = '".$FetchComments['complaintid']."'"));
		$Status = mysqli_fetch_array(Complaint_Get_Status($FetchComments['statusid']));
		$Complaint_Fetch_User_Name = mysqli_fetch_array(Complaint_Fetch_User($FetchComments['addedby']));
		$ComplaintSelectPartsDetails = Complaint_PartDetails($Complaint['id']);
		echo "<tr>";
				if($FetchComments['statusid'] == 7)
					echo "<td>".$FetchComments['comments']."-".$Biostartdate['bio_startdate']."-".$Biostartdate['bio_enddate']."-".$Biostartdate['bio_remark']."</td>";
				else
					echo "<td>".$FetchComments['comments']."</td>";
				echo"<td align='center'>".$Status['name']."</td>
				<td align='center'>".$FetchComments['addedat']."</td>
				<td align='center'>".$Complaint_Fetch_User_Name['firstname']."</td>
			</tr>";
	}
	echo '</table>';
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&TicketNo=".$_GET['TicketNo']."&ComplaintId=".$_GET['ComplaintId']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
<script>
	var StatusId = "<?php echo $Complaint['statusid']; ?>";
		ResonForHold(StatusId);
		function ResonForHold(status)
		{
			if(status == 4 || status == 3)
				document.getElementById("reasonforhold").style.display = "block";
			else
				document.getElementById("reasonforhold").style.display = "none";
		}
		Bioremarks(StatusId);
		function Bioremarks(status)
		{
			if(status == 7)
				document.getElementById("Biohide").style.display = "block";
			else
				document.getElementById("Biohide").style.display = "none";
		}
	function validation()
	{
		var message = "";
		<?php if($Ticketbiomedical == "Biomedical") 
		{ ?>
		if(document.getElementById('status').value == 7)
		{
			if(document.getElementById('remarks').value.length =="")
				message = "Please enter the remarks";
			if(document.getElementById('enddate').value.length =="")
				message = "Please select  enddate";
			if(document.getElementById('startdate').value.length =="")
				message = "Please select  startdate";
		}	
		<?php 
		}	
		?>
		if(document.getElementById('comments').value.length < 5 || document.getElementById('comments').value.length > 500)
			message = "Comments should be within 10 to 500 characters";
		if(document.getElementById('status').value == 4 || document.getElementById('status').value == 3)
		{
			if(document.getElementById('reason').value.length < 5 || document.getElementById('reason').value.length > 500)
				message = "Reason should be within 10 to 500 characters";
			if(document.getElementById('category').value == "")
				message = "Please Select On-Hold/In-Process Category";
		}
		<?php
		if($_SESSION['roleid']=='1' || $_SESSION['roleid'] == '2' || $_SESSION['roleid']=='5' || $_SESSION['roleid']=='3')
		{ ?>
			if(document.getElementById('status').value == "Select")
				message = "Please select a Status";
			<?php 
			if($Ticketbiomedical == "Biomedical")
			{ ?>
				if(document.getElementById('technician').value == "Select")
					message = "Please select a Engineer";
			<?php 
			} 
			else
			{ ?> 
				if(document.getElementById('technician').value == "Select")
					message = "Please select a Technician";
	<?php	}		
			?>
			if(document.getElementById('subdepartment').value == "Select")
				message = "Please select a Sub Department";
		<?php
		} ?>
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	<?php
	if($Complaint['subgroupid'])
	{
		if(!$Complaint['itemid'])
			$Complaint['itemid'] = 0;
		?>
		GetTechnician(<?php echo "'".$Complaint['subgroupid']."#0',".$Complaint['assignedto'].",".$Complaint['itemid'];?>);
	<?php
	} ?>
	//Hide And Show Code For Parts And Amount
	<?php 
	if($_SESSION['roleid']!='4') 
	{ ?>
		var Parts_Procured_Mandatory = <?php
			if(!$SelectPartDetailsById['procuredfrom'])
				echo "0";
			else
				echo "1";
			?>;
		partsenable(Parts_Procured_Mandatory);
		function partsenable(value)
		{
			Parts_Procured_Mandatory = value;
			if(value == 0)
				document.getElementById("submit").style.display = document.getElementById("partnamehide").style.display = document.getElementById("quantityhide").style.display = document.getElementById("procuredfromhide").style.display =document.getElementById("amounthide").style.display =document.getElementById("cashhide1").style.display = document.getElementById("cashhide2").style.display ="none";
			else
			{
				$("#submit").show();
				$("#partnamehide").show();
				$("#quantityhide").show();
				$("#procuredfromhide").show();	
				$("#cashhide1").show();
				$("#cashhide2").show();
			}
		}
		var Amount = <?php if(!$SelectPartDetailsById['bycash'])
								echo "0";
							  else
								echo "1";
								?>;
		enableamount(Amount);
		function enableamount(value)
		{
			Amount = value;
			if(value == 0)
				document.getElementById("amounthide").style.display = "none";
			else 
				$("#amounthide").show();
		}
	<?php
	} ?>
	function GetTechnician(SubGroupId, assignedto, ItemId)
	{
		var SplitSubGroup = SubGroupId.split("#");
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var results = xmlhttp.responseText;
				var SplitTechAndCType = results.split("&");
				document.getElementById('techniciandiv').innerHTML = SplitTechAndCType[0];
				document.getElementById('complainttype').innerHTML = SplitTechAndCType[1];
				document.getElementById('itemdiv').innerHTML = SplitTechAndCType[2];
			}
		}
		xmlhttp.open("GET","includes/Complaint_Get_Technicians.php?SubGroupId="+SplitSubGroup[0]+"&assignedto="+assignedto+"&ItemId="+ItemId+"&groupid=<?php echo $Complaint['groupid'];?>"+"&TicketNo=<?php echo $_GET['TicketNo'];?>",true);
		xmlhttp.send();
	}
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
		if (charCode == 8 || charCode == 33 || charCode >= 35 || charCode <= 46) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
            keynum = e.keyCode;
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	function validation1()
	{
		var message = "";
		if(Amount)
		{
			if(document.getElementById('amount').value == "" || document.getElementById('amount').value<=0)
				message = "Please enter amount";
		}
		if(Parts_Procured_Mandatory)	
		{
			if(document.getElementById('department').value == "Select")
				message = "Please select department";
			if(document.getElementById('quantity').value == "")
				message = "Please enter quantity";
			if(document.getElementById('partname').value == "")
				message = "Please enter partname";
		}
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
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&TicketNo=<?php echo $_GET['TicketNo']; ?>&ComplaintId=<?php echo $_GET['ComplaintId']; ?>&id="+id+"&action=delete");
	}
	function Export(PostBackValues)
	{
		window.open("includes/ExportPDF.php?exportpdf=1"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	
	function Validatefiles(FileID)
	{
		var fileName = document.getElementById(FileID).value;
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(ext == "ppt" || ext == "pptx" || ext == "PPT" || ext == "PPTX" || ext == "xlsx" || ext == "XLS" ||  ext == "XLSX" || ext == "doc" || ext == "pdf" || ext == "txt" || ext == "docx" || ext == "xls" 
		|| ext == "DOC" || ext == "DOCX" ||ext == "PDF" || ext == "TXT" || 
		ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
			return true;
		else
		{
			document.getElementById(FileID).value = "";
			alert("Upload doc,pdf,txt,docx,xls,gif,jpeg,jpg and png format only");
			document.getElementById(FileID).focus();
			return false;
		}
	}
	$(document).ready(function()
	{
		var FileInputsHolder = $('#AddFileInputBox');
		var MaxFileInputs = 10;
		var i = $('#AddFileInputBox div').size() + 1, j = $('#AddVideoFileInputBox div').size() + 1;
		$('#AddMoreFileBox').live('click', function() 
		{
			if(i < MaxFileInputs)
			{
				i++;
				$('</br><span style="padding-left:50px;"><input type="file" name="file[]" id="file'+i+'" onchange=Validatefiles("file'+i+'"); class="addedInput" multiple /><span style="padding-left:10px;"><a href="#" class="" id="removeFileBox"><img src="images/overlay/close.png" border="0" /></a></span>').appendTo(FileInputsHolder);
			}
			return false;
		});
		$('#removeFileBox').live('click', function()
		{
			if(i > 1)
			{
				$(this).parents('span').remove();
				i--;
			}
			if(j > 1)
			{
				$(this).parents('span').remove();j--;
			}
			return false;
		});
	});	
	
</script>