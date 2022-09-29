<?php
	$Columns = array("id","employee_no","joined_date","name_prefix","first_name","last_name","dob","gender","phone_no",
	"email_id","department_id","grade_id","designation_id","qualification_id","address","father_or_husband_name",
	"mother_or_wife_name","marital_status","blood_group_id","nationality_id","religion_id","community",
	"last_institutution_worked","last_institution_address","major_subjects_taught_id","salary","total_experience");
	if($_GET['action'] == 'Edit')
	{
		$FetchEmployee = mysqli_fetch_assoc(Employee_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $FetchEmployee[$Col];
	}
	if(!($_GET['action']=='Edit'))
			$_GET['action']=0;
	if($_POST['save'])
	{ 
		Staff_Insert();
	}
	if($_POST['update'])
	{
		Staff_Update();
	}
?>
<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#date").datepicker({dateFormat: 'dd-mm-yy',changeYear: true,
				yearRange: "-35:+0"});
			$("#dob").datepicker({dateFormat: 'dd-mm-yy',changeYear: true,
				yearRange: "-49:+0"});
		});
	</script>
</head>
<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel"  onsubmit="return validation()"  enctype="multipart/form-data">
	<fieldset>
		<h3>General information</h3>
	</fieldset>
		<hr/>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
		<div>
			<table>
				<tr>
					<td>
						<label><strong>Joining Date</strong>
						<input type="text" id="date" value="<?php if($_GET['action']) echo date('d-m-Y',strtotime($_POST['joined_date']));?>" name="date" />
						</label>
					</td>
					<td>
						<div style="width:300px;margin: 10px 0; display: block;float: left;">
							<font style="font-size: 11px;">
								<strong>First Name </strong><font color="red">*</font><br/>
								<?php
								echo '<select name="nameprefix" id="nameprefix">
										<option value="">Select</option>';
										$Sirnames = array("Mr.", "Ms.", "Mrs.");
										foreach($Sirnames as $Sir)
										{
											if($_POST['name_prefix']==$Sir)
												echo '<option value="'.$Sir.'" selected>'.$Sir.'</option>';
											else
												echo '<option value="'.$Sir.'">'.$Sir.'</option>';
										}
								echo '</select>';?>
								<div style="padding-left:75px;"><input type="text" id="name" value="<?php echo $_POST['first_name'];?>" name="name" required="required"/></div>
							</font>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<label><strong>Last Name</strong><font color="red">*</font>
							<input type="text" id="lastname" value="<?php echo $_POST['last_name'];?>"  name="lastname" required="required"/> 
						</label>
					</td>
					<td>
						<label><strong>DOB </strong><font color="red">*</font> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<input type="text" id="dob" name="dob"  value="<?php if($_GET['action']) echo date('d-m-Y',strtotime($_POST['dob']));?>" required="required" />
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<font style="font-size: 11px;"><strong>Gender </strong></font><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
						<br/><?php
							$Gender = array("Male","Female");
							$i=1;
							foreach($Gender as $Gen)
							{
								if($_POST['gender']==$i && $_GET['action'])
									echo '<span class="radio-input"><input type="radio" name="gender" value="'.$i.'"  id="gender" checked>'.$Gen.'</input></span>';
								else
									echo '<span class="radio-input"><input type="radio" name="gender" value="'.$i.'"  id="gender">'.$Gen.'</input></span>';
								$i--;
							}
						?>
					</td>
					<td>
						<font style="font-size: 11px;"><strong>Contact number </strong></font><font color="red">*</font><br/>
						<input type="text" id="contactnumber" value="<?php echo $_POST['phone_no'];?>" name="contactnumber" required="required"/> 
					</td>
				</tr>
				<tr>
					<td>
						<div style="margin-top:-89px">
							<label><strong>Email </strong><br/>
								<input type="text" id="email" value="<?php echo $_POST['email_id'];?>" name="email" >
							</label>
						</div>
					</td>
					<td>
						<label><strong>Qualification </strong><font color="red">*</font>
							<select  id="qualification" name="qualification" > 
								<option value="">Select</option>
								<?php
									$Selectqualification = Select_Qualification();
									while($Fetchqualification  = mysqli_fetch_array($Selectqualification))
									{
										if($_POST['qualification_id']==$Fetchqualification['id'])
											echo '<option value="'.$Fetchqualification['id'].'" selected>'.$Fetchqualification['name'].'</option>';
										else
											echo '<option value="'.$Fetchqualification['id'].'">'.$Fetchqualification['name'].'</option>';
									}
								?>
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<div style="margin-top:-100px">
							<label>
								<strong>Designation </strong><font color="red">*</font>
								<select  id="designation" name="designation" > 
									<option value="">Select</option>
									<?php
										$Selectdesignation = Select_Designation();
										while($Fetchdesignation  = mysqli_fetch_array($Selectdesignation))
										{
											if($_POST['designation_id']==$Fetchdesignation['id'])
												echo '<option value="'.$Fetchdesignation['id'].'" selected>'.$Fetchdesignation['name'].'</option>';
											else
												echo '<option value="'.$Fetchdesignation['id'].'">'.$Fetchdesignation['name'].'</option>';
										}
									?>
								</select>
							</label>
						</div>
					</td>
					<td>
						<div style="margin-top:-30px">
							<label><strong>Address </strong><font color="red">*</font>
								<textarea id="address" name="address"  required="required"><?php echo $_POST['address'];?></textarea>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="margin-top:-30px">
							<label><strong>Department </strong><font color="red">*</font>
								<select  id="department" name="department"  > 
									<option value="">Select</option>
									<?php
										$Selectdepartment = Select_Department();
										while($Fetchdepartment  = mysqli_fetch_array($Selectdepartment))
										{
											if($_POST['department_id']==$Fetchdepartment['id'])
												echo '<option value="'.$Fetchdepartment['id'].'" selected>'.$Fetchdepartment['name'].'</option>';
											else
												echo '<option value="'.$Fetchdepartment['id'].'">'.$Fetchdepartment['name'].'</option>';
										}
									?>
								</select>
							</label>
						</div>
					</td>
					<td>
						<div style="margin-top:-20px">
						<label>
							<strong>Grade </strong><font color="red">*</font>
							<select  id="grade" name="grade" onchange='var department = document.getElementById("department"); var Deptval = department.options[department.selectedIndex].value; GetSalDetails(this.value,Deptval)'> 
								<option value="">Select</option>
								<?php
									//
									$Selectdesignation = Select_Grade();
									while($Fetchdesignation  = mysqli_fetch_array($Selectdesignation))
									{
										if($_POST['grade_id']==$Fetchdesignation['id'])
											echo '<option value="'.$Fetchdesignation['id'].'" selected>'.$Fetchdesignation['name'].'</option>';
										else
											echo '<option value="'.$Fetchdesignation['id'].'">'.$Fetchdesignation['name'].'</option>';
									}
								?>
							</select>
						</label>
						</div>
					</td>
				</tr>
				<?php
					$SelectParticulars = SelectParticulars();
					$i = 0;
					while($FetchParticulars = mysqli_fetch_array($SelectParticulars))
					{
						if($i%2 == 0)
							echo '<tr>';
						if($FetchParticulars['particular'])
						{
							echo '<td><label><strong>'.$FetchParticulars['particular'].' </strong><br/>
									<input type="text" name="partculars[]" id="'.($i+1).'"  value="'.$_POST[($i+1)].'" required="required" >
								</label></td>';
						}
						if($i%2!=0)
							echo '</tr>';
						$i++;
					}
				?>
				<tr>
					<td>
						<label><strong>Upload User Photo </strong>
							<input type="file" id="photo" name="photo" /> 
						</label>
						
					</td>
				</tr>
			</table>
		</div>
		<div style="margin-left:600px;margin-top:-720px">
			<label><h3><strong>Personal Details</strong></h3></label>
		</div>
		<div class="clearfix"><br/><br/><br/><br/><br/>
			<div style="padding-left:550px;padding-top:-5px"><label><strong>Father/Husband Name </strong><input type="text"  value="<?php echo $_POST['father_or_husband_name'];?>" id="fname" name="fname" /></label><label><strong>Mother/Wife Name &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><input type="text" value="<?php echo $_POST['mother_or_wife_name'];?>" id="mname" name="mname"  /></label></div>
		</div>
		<div class="clearfix">
			<div style="padding-left:550px"><label><strong>Martial Status </strong>
				<select  id="mstatus" name="mstatus" > 
					<option value="">Select</option>
					<?php
						$Status = array("Single","Married");
						$i=1;
						foreach($Status as $st)
						{
							if($_POST['marital_status']==$i)
								echo '<option value="'.$i.'" selected>'.$st.'</option>';
							else
								echo '<option value="'.$i.'">'.$st.'</option>';
							$i++;
						}
					?>
				</select></label>
				<label><strong>Blood Group &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><select  id="bloodgroup" name="bloodgroup" > 
					<option value="">Select</option>
					<?php
						$SelectBlood = Select_Blood();
						while($FetchBlood  = mysqli_fetch_array($SelectBlood))
						{
							if($_POST['blood_group_id']==$FetchBlood['id'])
								echo '<option value="'.$FetchBlood['id'].'" selected>'.$FetchBlood['name'].'</option>';
							else
								echo '<option value="'.$FetchBlood['id'].'">'.$FetchBlood['name'].'</option>';
						}
					?>
				</select></label>
			</div>
		</div>
		<div class="clearfix">
			<div style="padding-left:550px;">
				<label><strong>Nationality &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong>
				<select  id="nationality" name="nationality" > 
					<option value="">Select</option>
					<?php
						$SelectNationality = Select_Nationality();
						while($FetchNationality  = mysqli_fetch_array($SelectNationality))
						{
							if($_POST['nationality_id']==$FetchNationality['id'])
								echo '<option value="'.$FetchNationality['id'].'" selected>'.$FetchNationality['name'].'</option>';
							else
								echo '<option value="'.$FetchNationality['id'].'">'.$FetchNationality['name'].'</option>';
						}
					?>
				</select></label>
				<label><strong>Religion &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><select  id="religion" name="religion" > 
					<option value="">Select</option>
					<?php
						$SelectReligion = Select_Religion();
						while($FetchReligion  = mysqli_fetch_array($SelectReligion))
						{
							if($_POST['religion_id']==$FetchReligion['id'])
								echo '<option value="'.$FetchReligion['id'].'" selected>'.$FetchReligion['name'].'</option>';
							else
								echo '<option value="'.$FetchReligion['id'].'">'.$FetchReligion['name'].'</option>';
						}
					?>
				</select></label>
			</div>
		</div>
		<div class="clearfix">
			<div style="padding-left:550px">
				<label><strong>Community </strong>
				<select name="community" id="community" >
					<option value="">Select</option>
					<?php
						$SelectCommunity = mysqli_query($_SESSION['connection'],"select * from community");
						while($FetchCommunity =  mysqli_fetch_array($SelectCommunity))
						{
							if($_POST['community']==$FetchCommunity['id'])
								echo '<option value="'.$FetchCommunity['id'].'" selected>'.$FetchCommunity['name'].'</option>';
							else
								echo '<option value="'.$FetchCommunity['id'].'">'.$FetchCommunity['name'].'</option>';
						}
					?>
				</select></label></div>
		</div>
		<div class="clearfix">
			<div style="padding-left:550px"><br/><h3><strong>Previous Experience Details</strong></h3></div>
			<div style="padding-left:550px"><label><strong>Last Institution Worked </strong><input type="text" id="lastinstitution" value="<?php echo $_POST['last_institutution_worked'];?>" name="lastinstitution" /></label><label><strong>Address &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><input type="text" id="laddress"value="<?php echo $_POST['last_institution_address'];?>"  name="laddress" /></label></div>
		</div>
		<div class="clearfix">
			
			<div style="padding-left:550px"><label><strong>Major Subject Tought </strong><font color="red">*</font>
				<select  id="subject" name="subject"> 
					<option value="">Select</option>
					<?php
						$SelectSubject = Select_Subject();
						while($FetchSubject  = mysqli_fetch_array($SelectSubject))
						{
							if($_POST['major_subjects_taught_id']==$FetchSubject['id'])
								echo '<option value="'.$FetchSubject['id'].'" selected>'.$FetchSubject['name'].'</option>';
							else
								echo '<option value="'.$FetchSubject['id'].'">'.$FetchSubject['name'].'</option>';
						}
					?>
				</select>
			</label><label><strong>Salary &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><input type="text" id="salary" value="<?php echo $_POST['salary'];?>" name="salary" /></label></div>
		</div>
		<div style='padding-left:550px'><label><strong>Year </strong>
			<?php
				if($_POST['total_experience'])
					$Year_Month = explode(' ',$_POST['total_experience']);
				echo '<select  id="year" name="year"> 
								<option value="">Select</option>';
									for($i=0;$i<11;$i++)
									{
										if($Year_Month[0]==$i && $_POST['total_experience'])
										{
											if($i==10)
												echo '<option value="'.$i.'" selected>'.$i.'+</option>';
											else
												echo '<option value="'.$i.'" selected>'.$i.'</option>';
										}
										else if($i==10)
											echo '<option value="'.$i.'">'.$i.'+</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
							echo '</select>
						</label>';		
						echo '<label><strong>Month </strong>
						<select  id="month" name="month"> 
							<option value="">Select</option>';
								for($i=0;$i<13;$i++)
								{
									if($Year_Month[1]==$i && $_POST['total_experience'])
										echo '<option value="'.$i.'" selected>'.$i.'</option>';
									else
										echo '<option value="'.$i.'">'.$i.'</option>';
								}
						echo '</select>
					</label>
						</div>';
			?>
		<br/><br/><br/><br/><br/><br/><br/>
		<?php
		if(!$_GET['action'])
			echo '<hr/>';
		if(!$_GET['action'])	
			echo '<input type="submit" class="button button-green" id="save" name="save" value="Save">
			&nbsp;&nbsp;&nbsp;<button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button>';
		else
			echo '<input type="submit" class="button button-green" id="update" name="update" value="Update">
			&nbsp;&nbsp;&nbsp;<button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button>';
		
		?>
		</div>
	</fieldset>
</form>
<script>
<?php
	if($_GET['id'])
	{ ?>
		//GetSalDetails(<?php echo $_POST['grade_id']; ?>,<?php echo $_POST['department_id']; ?>);
		GetSalDetails(<?php echo $_GET['id']; ?>,0);
<?php
	} ?>
	$(function()
	{
		var DropDowns = ["nameprefix"];
		DropDowns.forEach(function(DropDown)
		{
			$("#uniform-"+DropDown).find("span").remove();
			$("#uniform-"+DropDown).removeClass("selector");
			$("#"+DropDown).removeAttr("style");
		});
	});
	function GetSalDetails(Grade,Department)
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
				var splitresult = results.split("#");
				for(var i=1;i<splitresult.length;i++)
					document.getElementById(i).value = splitresult[i];
			}
		}
		xmlhttp.open("GET","includes/GetSalDetails.php?Grade="+Grade+"&Department="+Department,true);
		xmlhttp.send();
	}
	
function validation()
{
	var message = "";
	var mail=/^([a-zA-Z0-9_\.\-]{3,30})+\@(([a-zA-Z0-9\-]{3,50})+\.)+([a-zA-Z0-9]{2,4})+$/;
	var Gender = document.getElementsByName("gender");
	var flag = 0;
		for (var i = 0; i< Gender.length; i++)
			if(Gender[i].checked)
				flag++;
	if(document.getElementById("grade").value == "")
		message = "Please select Grade"; 
	if(document.getElementById("department").value == "")
		message = "Please select Department"; 
	if(document.getElementById("address").value.length < 4 || document.getElementById("address").value.length > 15)
		message = "Address should be within 4 to 15 characters";
	if(document.getElementById("designation").value == "")
		message = "Please select Designation"; 
	if(document.getElementById("qualification").value == "")
		message = "Please select Qualification"; 
	if(!mail.test(document.getElementById('email').value) && document.getElementById('email').value)
			message = "Please enter valid E-Mail";
	if(document.getElementById("contactnumber").value.length < 1 || document.getElementById("contactnumber").value.length > 15)
		message = "Contact Number is invalid";
	if(!flag)
		message = "Please select Gender";
	if(document.getElementById("lastname").value.length < 1 || document.getElementById("lastname").value.length > 15)
		message = "Last Name should be within 1 to 15 characters";
	if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 15)
		message = "First Name should be within 4 to 15 characters";
	if(document.getElementById("nameprefix").value == "")
		message = "Please select Name Prefix"; 
	if(message)
	{
		alert(message);
		return false;
	}
	else
		return true;
}
function Reset()
	{
		if(<?php echo $_GET['action'];?>)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&id=<?php echo $_GET['id']; ?>&action=Edit");
		else	
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>");
	}
</script>