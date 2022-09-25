<?php
	include("includes/Complaint_Queries.php");
	if(isset($_POST['Submit']))
	{
		$FileName = str_replace(array('-', ' ', ':'), '', date("Y-m-d H:i:s"))."_".$_FILES["file"]["name"];
		if($_FILES["file"]["name"])
		{
			$allowedExts = array("doc", "pdf", "txt","docx","ppt","pptx","xls","xlsx","gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if(($_FILES["file"]["size"] < 10000000) && in_array($extension, $allowedExts))
			{
				if($_FILES["file"]["error"] > 0)
					echo "<div class='message error'>File having some errors:".$_FILES["file"]["error"]."</div><br>";
				else
					move_uploaded_file($_FILES["file"]["tmp_name"], "Files/".$FileName);
			}
			else
				echo "Invalid file";
		}
		$Ticket = mysqli_fetch_assoc(Complaint_GetLastIdBy($_POST['group']));
		$TicketNo = explode("-",$Ticket['ticketno']);
		$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
		$TicketNo = $_POST['group']."-".$Digits[7 - strlen($TicketNo[1]+1)].($TicketNo[1]+1);
		if($assignedto = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select `department`.`".$_GET['groupid']."` from `department` where `department`.`".$_GET['groupid']."`!=0 && id='".$_POST['department']."' and  `department`.`".$_GET['groupid']."` = `department`.`".$_GET['groupid']."`")))
			$assignedto = $assignedto[$_GET['groupid']];
		else if($assignedto =  mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from `group` where name='".$_POST['group']."'")))
			$assignedto = $assignedto['defaultadmin'];
		if($_GET['groupid'] != 3)
			Complaint_Insert($TicketNo,$description,$remarks,$complainttypeid,$zoneid,$assignedto,$sourceid,$departmentid,$_POST['groupid'],$priorityid,$statusid,$reasonforhold,$createdby,date("Y-m-d H:i:s"),$updatedby,date("Y-m-d H:i:s"));
		else	
		{
			if($_POST['equipmentname'])
				$_POST['item_id'] = $_POST['equipmentname'];
			else if($_POST['serialnumber'])
				$_POST['item_id'] = $_POST['serialnumber'];
			else if($_POST['equipment_id'])
				$_POST['item_id'] = $_POST['equipment_id'];	
			BiocomplaintInsert($TicketNo,$description,$remarks,$assignedto,$departmentid,$_POST['groupid'],$_POST['subdepartment'],$priorityid,$statusid,$reasonforhold,$createdby,date("Y-m-d H:i:s"),$updatedby,date("Y-m-d H:i:s"),$locationid,$itemid,$sourceid);	
		}
		$Tickets = mysqli_fetch_assoc(Ticket_Fetch());
		$Explode_FileName = explode("_",$FileName);
		if($Explode_FileName[1])
			UpdateFilename($Tickets['id'],$FileName);
		$message = "<br /><div class='message success'><b>Complaint</b> : Added successfully</div>";
		echo "<section class='grid_6 first'>";
				$SourceName = mysqli_fetch_assoc(SourceName_Fetch($Tickets['sourceid']));
				$DepartmentName = mysqli_fetch_assoc(Department_Fetch($Tickets['departmentid']));
				$Location = mysqli_fetch_assoc(Location_Fetch($Tickets['locationid']));
				$Zone = mysqli_fetch_assoc(Zone_Fetch($Tickets['zoneid']));
				$SubGroup = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($Tickets['subgroupid']));
				$Equipment = mysqli_fetch_array(Complaint_Select_Equipment($Tickets['itemid']));
				$Equipment_Name = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment WHERE id='".$Equipment['id']."'"));
				//$Equipment_Name = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM  assets_inventory WHERE id='".$Tickets['itemid']."'"));
				echo "<fieldset>
				<div class='columns'>
					<div class='grid_6 first'>
						<form class='form panel'>";
						if($Tickets['sourceid'])
							echo"<div class='clearfix'>
									<label> Source Of Complaint:</label> ".$SourceName['name']."
								</div>";
						echo"<div class='clearfix'>
								<label>Department:</label>".$DepartmentName['name']."
							</div>";
						if($_GET['groupid']!=3)	
							echo "<div class='clearfix'>
								<label>Sub-Department:</label>".$SubGroup['name']."
							</div>";
						if($Tickets['locationid'])	
							echo "<div class='clearfix'>
								<label>Location:</label>".$Location['name']."
							</div>";
						if($Equipment['id'])
							echo "<div class='clearfix'>
							<label>Equipment Name:".$Equipment_Name['equipment']."</label>
							<label>Equipment Serial Number:".$Equipment['serialnumber']."</label>
							<label>Equipment ID:".$Equipment['equipmentid']."</label>
							</div>";
						if($Zone['name'])
							echo "<div class='clearfix'>
								<label>Zone:</label>".$Zone['name']."
							</div>";
						echo "<div class='clearfix'>
							<label>Defect:</label>".$Tickets['description']."
						</div>
						<div class='clearfix'>
							<label>Remarks:</label>".$Tickets['remarks']."
						</div>";
						if($_FILES["file"]["name"])
						{
							echo "<div class='clearfix'>
								<label>Uploaded filename:</label>".$_FILES["file"]["name"]."
							</div>";
						}
				echo "</form>
					</div>
				</div>
			</fieldset>
			<div class='message info'>
				<h3>Information</h3>
				<b><p>Your Ticket Has Been Raised !!!</p>
				<p>Your Ticket Referece Number is ".$Tickets['ticketno']."</p></b>
			</div>
		</section>";
	}
	else
	{
		echo $message;
		if(!$_GET['group'])
		{
			$UserCloseTicket = UserhastoCloseTicket();
			if(mysqli_num_rows($UserCloseTicket))
			{
				echo '<div class="panel" style="float:right; width:20%; border:1px solid #46464f;">';
				echo "<font style='color:red;'><span id='blink'><table><tr>Attention: </tr>Below Tickets are in Resolved Status Please Close and Rate it.</table></span></font>";
				while($UserNotClosedTickets = mysqli_fetch_assoc($UserCloseTicket))
				{
					echo '<table><tr><td><a href="?page=Close_Complaint&TicketNo='.$UserNotClosedTickets["ticketno"].'">'.$UserNotClosedTickets["ticketno"].'</a></td></tr></table>';
				}
			echo '</div>';
			} 
			?>
			<section class="grid_6 first">
				<div class="columns">
					<div class="grid_6 first">
						<div class="panel">
							<center>
								<br />
								<h3>Choose the maintenance department you want to raise the issue.</h3><br />
								<?php
								$Groups = Group_Select_ALL();
								$BtImg = array("", "BBHMISBt", "BBHMantenanceBt","BBHBiomedicalBt","BBHCommonBt");
								while($Group = mysqli_fetch_assoc($Groups))
									echo "<a class='button button-orange' href=\"?page=".$_GET['page']."&group=".$Group['name']."&groupid=".$Group['id']."\"><img src='images/".$BtImg[$Group['id']].".jpg' width='250px'/><br />".$Group['name']."</a>&nbsp;&nbsp;";
								?>
								<br /><br /><br />
							</center>
						</div>
					<?php
		}
		else if($_GET['group']=='Biomedical')
		{  
		?>
			<form id="form" class="form panel" method="POST" onsubmit="return validation()" enctype="multipart/form-data">
				<header><h2>Complaint : <?php echo $_GET['group'];?> department</h2></header>
				<hr />
				<input type="hidden" name="group" value="<?php echo $_GET['group']; ?>" />
				<input type="hidden" name="groupid" value="<?php echo $_GET['groupid']; ?>" />
				<fieldset>
					<!--div class="clearfix">
						<label>Source Of Complaint<font color="red">*</font></label>
						<select id="SRCComplaint" name="source" >
							<option value="">Select</option>
							<?php
							/*$Source_Complaint = Source_Select_All_Biomedical();
							while($Source = mysqli_fetch_assoc($Source_Complaint))
							{
								echo "<option value=".$Source['id']." selected>".$Source['name']."</option>";
							}*/ ?>
						</select>
					</div-->
					<div class="clearfix">
						<label>User Department<font color="red">*</font></label>
						<select id="department" name="department" onchange="Getextension(this.value,<?php echo $_GET['groupid'];?>);GetEquipment();">
						<option value="">Select</option>
						<?php
							$Department_Complaint = Department_Select_All_Biomedical();
							while($Department = mysqli_fetch_assoc($Department_Complaint))
							{
								if($Department['id'] == $_POST['Department'] || (!$_POST['Department'] && $Department['id'] == $_SESSION['departmentid']))
									echo "<option value=".$Department['id']." selected>".$Department['name']."</option>";
								else
									echo "<option value=".$Department['id'].">".$Department['name']."</option>";
							} ?>
						</select>
						ext:&nbsp;<font color="red" id='extension'></font>
					</div>
					<!--div class="clearfix">
						<label>Sub-Department<font color="red">*</font></label>
						<select id="subdepartment" name="subdepartment">
						<?php
							/*$SubDepartment_Complaint = Complaint_SubDepartment($_GET['groupid']);
							while($SubDepartment = mysqli_fetch_assoc($SubDepartment_Complaint))
							{
								echo "<option value=".$SubDepartment['id']."  selected>".$SubDepartment['name']."</option>";
							} */?>
						</select>
					</div-->
					<!--div class="clearfix">
						<label>Location</label>
						<div id='locationchange'>
						</div>
					</div-->
					<?php $SubDepartment = mysqli_fetch_assoc(Complaint_SubDepartment($_GET['groupid']));?>
					<input type="hidden" name="subdepartment" value="<?php echo $SubDepartment['id'];?>">
					<div class="clearfix">
						<label>Equipment Name: <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>OR</strong>
						<div id='equipmentnamevalue'>
							<select id="equipmentname" name="equipmentname" onchange="Equipment_Change('equipmentname')">
								<option value="">Select</option>
								<?php
								$Biomedical_Equipment_Name_Complaint = Complaint_Equipment_Name();
								while($Equipment_name = mysqli_fetch_assoc($Biomedical_Equipment_Name_Complaint))
								{
									if($Equipment_name['id'] == $_POST['equipmentname'] || (!$_POST['equipmentname'] && $Equipment_name['department_id'] == $_SESSION['departmentid']))
										echo "<option value=".$Equipment_name['id']." >".$Equipment_name['equipment']."</option>";
									else
										echo "<option value=".$Equipment_name['id'].">".$Equipment_name['equipment']."</option>";
								} ?>
							</select>
						</div></label>
						<label>Serial Number:<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>OR</strong>
						<div id='serialnumbervalue'>
							<select id="serialnumber" name="serialnumber" onchange="Equipment_Change('serialnumber')">
								<option value="">Select</option>
								<?php
								$Biomedical_Equipment_Serial_Complaint = Complaint_EquipmentSerailNumber();
								while($Equipment_Serialnumber = mysqli_fetch_assoc($Biomedical_Equipment_Serial_Complaint))
								{
									if($Equipment_Serialnumber['id'] == $_POST['serialnumber'] || (!$_POST['serialnumber'] && $Equipment_Serialnumber['id'] == $_SESSION['departmentid']))
										echo "<option value=".$Equipment_Serialnumber['id']." >".$Equipment_Serialnumber['serialnumber']."</option>";
									else
										echo "<option value=".$Equipment_Serialnumber['id'].">".$Equipment_Serialnumber['serialnumber']."</option>";
								} ?>
							</select>
						</div></label>
						<label>Equipment ID:<font color="red">*</font>
						<div id='equipment_idvalue'>
							<select id="equipment_id" name="equipment_id" onchange="Equipment_Change('equipment_id')">
								<option value="">Select</option>
								<?php
								$Biomedical_Equipment_Id_Complaint = Complaint_Equipment_Id();
								while($Equipment_Id = mysqli_fetch_assoc($Biomedical_Equipment_Id_Complaint))
								{
									if($Equipment_Id['id'] == $_POST['equipment_id'] || (!$_POST['equipment_id'] && $Equipment_Id['id'] == $_SESSION['departmentid']))
										echo "<option value=".$Equipment_Id['id']." >".$Equipment_Id['equipmentid']."</option>";
									else
										echo "<option value=".$Equipment_Id['id'].">".$Equipment_Id['equipmentid']."</option>";
								} ?>
							</select>
						</div></label>
					</div>
					<!--div class="clearfix" id='zoneblock'>
						<label>Zone<font color="red"></font></label>
						<select id="zone" name="zone">
						<option value="">Select</option>
						<?php
							/*$Zone_Complaint = Zone_Select_All();
							while($zone = mysqli_fetch_assoc($Zone_Complaint))
							{
								if($zone['id']==$_POST['zone'])
									echo "<option value=".$zone['id']." selected>".$zone['name']."</option>";
								else
									echo "<option value=".$zone['id'].">".$zone['name']."</option>";
							}*/ ?>
						</select>
					</div-->
					<div class="clearfix">
						<label>Defect<font color="red">*</font></label>
						<textarea rows="4" cols="50" id='description' name='description'></textarea>
					</div>
					<div class="clearfix">
						<label>Remarks<font color="red">*</font></label>
						<textarea rows="4" cols="50" id='remarks' name='remarks'></textarea>
					</div>
					
				</fieldset>
				<hr />
				<button class="button button-green" type="submit" name="Submit">Submit Issue</button>
				<a href='?page=<?php echo $_GET['page']; ?>'class="button button-orange" type="submit">Cancel</a>
				<button class="button button-gray" name ="reset" type="reset" >Reset</button>
			</form>
<?php	}
		else if($_GET['group']!='Biomedical')
		{ ?>
			<form id="form" class="form panel" method="POST" onsubmit="return validation()" enctype="multipart/form-data">
				<header><h2>Complaint : <?php echo $_GET['group'];?> department</h2></header>
				<hr />
				<input type="hidden" name="group" value="<?php echo $_GET['group']; ?>" />
				<input type="hidden" name="groupid" value="<?php echo $_GET['groupid']; ?>" />
				<fieldset>
					<div class="clearfix">
						<label>Source Of Complaint<font color="red">*</font></label>
						<select id="SRCComplaint" name="source" onchange='zoneblock(this.value)'>
							<option value="">Select</option>
							<?php
							$Source_Complaint = Source_Select_All();
							while($Source = mysqli_fetch_assoc($Source_Complaint))
							{
								if($Source['id'] == $_POST['Source'])
									echo "<option value=".$Source['id']." selected>".$Source['name']."</option>";
								else
									echo "<option value=".$Source['id'].">".$Source['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>User Department<font color="red">*</font></label>
						<select id="department" name="department" onchange="GetLocation(this.value,<?php echo $_GET['groupid'];?>)">
						<option value="">Select</option>
						<?php
							$Department_Complaint = Department_Select_All();
							while($Department = mysqli_fetch_assoc($Department_Complaint))
							{
								if($Department['id'] == $_POST['Department'] || (!$_POST['Department'] && $Department['id'] == $_SESSION['departmentid']))
									echo "<option value=".$Department['id']." selected>".$Department['name']."</option>";
								else
									echo "<option value=".$Department['id'].">".$Department['name']."</option>";
							} ?>
						</select>
						ext:&nbsp;<font color="red" id='extension'></font>
					</div>
					<div class="clearfix">
						<label>Sub-Department<font color="red">*</font></label>
						<select id="subdepartment" name="subdepartment">
						<option value="">Select</option>
						<?php
							$SubDepartment_Complaint = Complaint_SubDepartment($_GET['groupid']);
							while($SubDepartment = mysqli_fetch_assoc($SubDepartment_Complaint))
							{
								echo "<option value=".$SubDepartment['id'].">".$SubDepartment['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Location</label>
						<div id='locationchange'></div>
					</div>
					<div class="clearfix" id='zoneblock'>
						<label>Zone<font color="red"></font></label>
						<select id="zone" name="zone">
							<option value="">Select</option>
							<?php
							$Zone_Complaint = Zone_Select_All();
							while($zone = mysqli_fetch_assoc($Zone_Complaint))
							{
								if($zone['id']==$_POST['zone'])
									echo "<option value=".$zone['id']." selected>".$zone['name']."</option>";
								else
									echo "<option value=".$zone['id'].">".$zone['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Defect<font color="red">*</font></label>
						<textarea rows="4" cols="50" id='description' name='description'></textarea>
					</div>
					<div class="clearfix">
						<label>Remarks<font color="red">*</font></label>
						<textarea rows="4" cols="50" id='remarks' name='remarks'></textarea>
					</div>
					<?php
					if($_GET['group']=="MIS")
					{ ?>
						<div class="clearfix">
							<label>File Attachment </label>
							<input type="file" name="file" id="file" >
						</div>
					<?php
					} ?>
				</fieldset>
				<hr />
				<button class="button button-green" type="submit" name="Submit">Submit Issue</button>
				<a href='?page=<?php echo $_GET['page']; ?>'class="button button-orange" type="submit">Cancel</a>
				<button class="button button-gray" name ="reset" type="reset" >Reset</button>
			</form>
		<?php
		} ?>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
	</section>
	<?php
	}
	if($_GET['groupid'] && !$_POST['groupid'])
	{ ?>
		<script>
			function validation()
			{
				var message = "";
				if(document.getElementById('remarks').value.length < 5 || document.getElementById('remarks').value.length > 500)
					message = "Remarks should be within 5 to 500 characters";
				if(document.getElementById('description').value.length < 5 || document.getElementById('description').value.length > 500)
					message = "Defect should be within 5 to 500 characters";
				<?php if($_GET['groupid'] ==3 )
					{ ?>
				if((document.getElementById('equipmentname').value == "") && (document.getElementById('serialnumber').value == "") && (document.getElementById('equipment_id').value == ""))
					message = "Please select a equipmentname or serialnumber or equipment_id";
				<?php }
				if($_GET['groupid'] !=3 )
				{ ?>
				if(document.getElementById('subdepartment').value == "")
					message = "Please select a subdepartment";
				if(document.getElementById('SRCComplaint').value == "")
					message = "Please select a source of complaint";
				<?php } ?>	
				if(message)
				{
					alert(message);
					return false;
				}
				else
					return true;
			}
			<?php
			if($_GET['group']!='Biomedical')
			{ ?>
				GetLocation(document.getElementById('department').value,<?php echo $_GET['groupid'];?>);
				function GetLocation(Department,Group)
				{
					//document.getElementById('location').options.length = 0; 	//For remove all options of dropdown list
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
							var Extension= xmlhttp.responseText;
							var splitextension = Extension.split("#");
							document.getElementById('locationchange').innerHTML = splitextension[1];
							document.getElementById('extension').innerHTML = splitextension[0];
						}
					}
					xmlhttp.open("GET","includes/Complaint_Get_Location.php?Department="+Department+"&Group="+Group,true);
					xmlhttp.send();
				}
			
			document.getElementById('zoneblock').style.display='none';
			function zoneblock(zone)
			{
				if(zone==5)
					document.getElementById('zoneblock').style.display='block';
				else	
					document.getElementById('zoneblock').style.display='none';
			}
			<?php } 
			if($_GET['group']=='Biomedical')
			{ ?>
			var DropDowns = ["equipmentname", "serialnumber", "equipment_id"];
			function Equipment_Change(Id)
			{
				switch(Id)
				{
					case "equipmentname":
						if($("#equipmentname").val())
						{
							$("#serialnumber").val("");
							$("#equipment_id").val("")
						}
					break;
					case "serialnumber":
						if($("#serialnumber").val())
						{
							$("#equipmentname").val("");
							$("#equipment_id").val("")
						}
					break;
					case "equipment_id":
						if($("#equipment_id").val())
						{
							$("#serialnumber").val("");
							$("#equipmentname").val("")
						}
					break;
				}
			}
			
			function GetEquipment()
			{
				$.post("includes/GetEquipment.php?department="+document.getElementById('department').value, function(Response)
				{
					var Extension= Response;
					var splitextension = Extension.split("#");
					document.getElementById('equipmentnamevalue').innerHTML = splitextension[0];
					document.getElementById('serialnumbervalue').innerHTML = splitextension[1];
					document.getElementById('equipment_idvalue').innerHTML = splitextension[2];
				});
			}
			//Getextension(document.getElementById('department').value,<?php echo $_GET['groupid'];?>);
			function Getextension(Department,Group)
			{
			$.post("includes/GetExtension.php?Department="+Department+"&Group="+Group, function(Response)
				{
					document.getElementById('extension').innerHTML = Response;
				});	
			}	
			$(function()
			{
				var DropDowns = ["equipmentname", "serialnumber", "equipment_id"];
				DropDowns.forEach(function(DropDown)
				{
					$("#uniform-"+DropDown).find("span").remove();
					$("#uniform-"+DropDown).removeClass("selector");
					$("#"+DropDown).removeAttr("style");
				});
			});
			<?php
			} ?>
		</script>
	<?php
	}
	if(!$_GET['group'])
	{ 
		$UserCloseTicket = UserhastoCloseTicket();
		if(mysqli_num_rows($UserCloseTicket))
		{ ?>
		<script>
		Blink();
		function Blink()
		{
			obj=document.getElementById("blink");
			if (obj.style.visibility=="hidden")
				obj.style.visibility="visible";
			else obj.style.visibility="hidden";
			window.setTimeout("Blink();",500);
		}
		</script>
	<?php
		} 
	} ?>