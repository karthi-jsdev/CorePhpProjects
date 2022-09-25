<?php
	
	$Columns = array("id","admission_no","admission_date","first_name","last_name","gender","dob","section_id","blood_group_id","mother_tongue","nationality_id","subcast_id","cast_id","religion_id","father_name","father_occupation","mother_name","mother_occupation",
			"annual_income","residenceaddress","officeaddress","contact_no","email_id","contact_person","fees_catagoryids");
	if($_GET['action'] == 'Edit')
	{
		$FetchStudent = mysql_fetch_assoc(Student_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $FetchStudent[$Col];
	}
	if(!$_GET['action'])
	{
		$Admission = mysql_fetch_assoc(Fetch_LastAdmissionNum());
		$Admission_Num = explode(" ",$Admission['admission_no']);
		$Digits = array("", "0", "00", "000", "0000");
		$AdmissionNum = "Adm ".$Digits[4 - strlen($Admission_Num[1]+1)].($Admission_Num[1]+1);
	}
	if($_POST['save'] && !$_POST['adexist'])
	{ 
		$Feesnames = implode(',',$_POST['feescategoryid']);
		if(Student_Insert($Feesnames))
			echo "<br/><div class='message success'><b>Message</b> : Student information added successfully</div>";
	}
	else if($_POST['save'] && $_POST['adexist'])
		echo "<br/><div class='message error'><b>Message</b> : Student Admission Number already exist....!</div>";
	if($_POST['update'])
	{ 
		$Feesnames = implode(',',$_POST['feescategoryid']);
		Student_Update($Feesnames);
		echo "<br/><div class='message success'><b>Message</b> : Student information Updated successfully</div>";
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
				yearRange: "-35:+0" }); //, minDate: 0
			$("#dob").datepicker({dateFormat: 'dd-mm-yy',changeYear: true,
				yearRange: "-35:+0",maxDate: 0});
		});
	</script>
</head>
<div class="columns">
	<div class="grid_6 first">
		<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation();" enctype="multipart/form-data">
			<fieldset>
				<h3>Student Admission</h3>
				<hr/>
				<br/>
				<div id="admexist"></div>
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>"/>
				<div class="clearfix">
					<label><strong>Admission No.</strong>
					<?php
						echo '<input type="text" id="number" name="number" value="'.$_POST['admission_no'].'" >';
					?>
					</label>
					<label><strong>Admission Date</strong>
						<input type="text" id="date" name="date" value="<?php if($_GET['action']) echo date('d-m-Y',strtotime($_POST['admission_date']));?>"/>
					</label>
				</div>
				<div class="clearfix">
					<label><strong>First Name </strong>
						<input type="text" id="name" name="name" value="<?php echo $_POST['first_name'];?>"  onkeypress="return isAlphabetic(event)"/>
					</label>
					<label><strong>Last Name</strong>
						<input type="text" id="lastname" name="lastname" value="<?php echo $_POST['last_name'];?>"  onkeypress="return isAlphabetic(event)" /> 
					</label>
					
					<label><strong>DOB </strong> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
						<input type="text" id="dob" value="<?php if($_GET['action']) echo date('d-m-Y',strtotime($_POST['dob']));?>"  name="dob"  />
					</label>
				</div>
				<div class="clearfix">
					<div style="width:100px;margin: 10px 0;"><!--style="width:100px;margin: 15px 0;"-->
						<strong>Gender </strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
					<?php
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
					<label><strong>Class & Section </strong>
						<select name="section" id="section" onchange="Feescategory(this.value)">
							<option value="">Select</option>
							<?php
								$SelectSection = Select_Section();
								while($FetchSection  = mysql_fetch_array($SelectSection))
								{
									$ClassFetch = mysql_fetch_array(mysql_query("Select * From class where id='".$FetchSection['classid']."'"));
									if($FetchSection['id']==$_POST['section_id'])
										echo '<option value="'.$FetchSection['id'].'" selected>'.$ClassFetch['name'].'-'.$FetchSection['name'].'</option>';
									else
										echo '<option value="'.$FetchSection['id'].'">'.$ClassFetch['name'].'-'.$FetchSection['name'].'</option>';
								}
							?>
						</select>
					</label>
				</div>
				
				<div class="clearfix">
					<label><strong>Blood Group </strong>
						<select  id="bloodgroup" name="bloodgroup"> 
							<option value="">Select</option>
							<?php
								$SelectBlood = Select_Blood();
								while($FetchBlood  = mysql_fetch_array($SelectBlood))
								{
									if($_POST['blood_group_id']==$FetchBlood['id'])
										echo '<option value="'.$FetchBlood['id'].'" selected>'.$FetchBlood['name'].'</option>';
									else
										echo '<option value="'.$FetchBlood['id'].'">'.$FetchBlood['name'].'</option>';
								}
							?>
						</select>
					</label>
					<label><strong>Mother Tongue </strong>
						<input type="text" id="mothertongue" onkeypress="return isAlphabetic(event)" name="mothertongue" value="<?php echo $_POST['mother_tongue'];?>" />
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Nationality </strong>
						<select  id="nationality" name="nationality"> 
							<option value="">Select</option>
						<?php
							$SelectNationality = Select_Nationality();
							while($FetchNationality  = mysql_fetch_array($SelectNationality))
							{
								if($_POST['nationality_id']==$FetchNationality['id'])
									echo '<option value="'.$FetchNationality['id'].'" selected>'.$FetchNationality['name'].'</option>';
								else
									echo '<option value="'.$FetchNationality['id'].'">'.$FetchNationality['name'].'</option>';
							}
							?>
						</select>
					</label>
					<label><strong>Community </strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<select  id="cast" name="cast"> 
							<option value="">Select</option>
						<?php
							$SelectCast = Select_Cast();
							while($FetchCast  = mysql_fetch_array($SelectCast))
							{
								if($_POST['cast_id']==$FetchCast['id'])
									echo '<option value="'.$FetchCast['id'].'" selected>'.$FetchCast['name'].'</option>';
								else
									echo '<option value="'.$FetchCast['id'].'">'.$FetchCast['name'].'</option>';
							}
							?>
						</select>
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Sub Caste </strong><!--font color="red">*</font-->&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<select  id="subcast" name="subcast"> 
							<option value="">Select</option>
						<?php
							$SelectSubCast = Select_SubCast();
							while($FetchSubCast  = mysql_fetch_array($SelectSubCast))
							{
								if($_POST['subcast_id']==$FetchSubCast['id'])
									echo '<option value="'.$FetchSubCast['id'].'" selected>'.$FetchSubCast['name'].'</option>';
								else
									echo '<option value="'.$FetchSubCast['id'].'">'.$FetchSubCast['name'].'</option>';
							}
							?>
						</select>
					</label>
					<label><strong>Religion </strong>
						<select  id="religion" name="religion"> 
							<option value="">Select</option>
							<?php
								$Selectreligion = Select_Religion();
								while($Fetchreligion  = mysql_fetch_array($Selectreligion))
								{
									if($_POST['religion_id']==$Fetchreligion['id'])
										echo '<option value="'.$Fetchreligion['id'].'" selected>'.$Fetchreligion['name'].'</option>';
									else
										echo '<option value="'.$Fetchreligion['id'].'">'.$Fetchreligion['name'].'</option>';
								}
							?>
						</select>
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Father Name </strong>
						<input type="text" id="fname" name="fname" onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['father_name'];?>"/> 
					</label>
					<label>
						<strong>Father's Occupation </strong>
						<input type="text" id="foccupation" name="foccupation" onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['father_occupation'];?>"
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Mother Name </strong>
						<input type="text" id="mname" name="mname"  onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['mother_name'];?>"
					</label>
					<label><strong>Mother's Occupation </strong>
						<input type="text" id="moccupation" name="moccupation" onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['mother_occupation'];?>" /> 
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Annual Income </strong>
						<input type="text" id="annual" name="annual" onkeypress="return isNumeric(event)" value="<?php echo $_POST['annual_income'];?>" />
					</label>
					<label><strong>Residence Address </strong>
						<textarea id="residenceaddress" name="residenceaddress" onkeypress="return AlphaNumCheck(event)" ><?php if($_GET['action']) echo $_POST['residenceaddress'];?></textarea>
					</label>
					<label><strong>Office Address </strong>
						<textarea id="officeaddress" name="officeaddress" onkeypress="return AlphaNumCheck(event)" ><?php if($_GET['action']) echo $_POST['officeaddress'];?></textarea>
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Contact Person </strong>
						<input type="text" id="contactperson" onkeypress="return isAlphabetic(event)"  name="contactperson" value="<?php echo $_POST['contact_person'];?>"/>
					</label>
					<label><strong>Contact number </strong>
						<input type="text" id="contactnumber" onkeypress="return isNumeric(event)" name="contactnumber" value="<?php echo $_POST['contact_no'];?>" /> 
					</label>
					<label><strong>Email </strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
						<input type="text" id="email" name="email" value="<?php echo $_POST['email_id'];?>">
					</label>
				</div>
				
				<div class="clearfix">
					<label><strong>Feescategory </strong>
					</label>
					<div id='Feescategory'>
						<?php
						if($_GET['action'])
						{
							$i = 1;
							$Feescategoryids = mysql_fetch_array(mysql_query("SELECT fees_catagoryids FROM student_admission  where id='".$_GET['id']."'"));
							$Feescategory = mysql_query("SELECT fees_catagory.name,fees_category_assign.id,fees_category_assign.classids,fees_category_assign.categorydes FROM fees_category_assign
							JOIN fees_catagory ON fees_catagory.id = fees_category_assign.feescategoryid
							order by fees_category_assign.id desc");
							while($Fees = mysql_fetch_array($Feescategory))
							{
								$i++;
								$Seperatedfeedcategorynames = explode(",",$Feescategoryids['fees_catagoryids']);
								if(in_array($Fees['id'], $Seperatedfeedcategorynames))
								{
									if(in_array($Fees['id'], $Seperatedfeedcategorynames))
										echo '<td><input type="checkbox" id="feescategoryid'.$i.'" name="feescategoryid[]" value="'.$Fees['id'].'" checked />'.$Fees['name'].'</td>&nbsp;&nbsp;';
									else
										echo '<td><input type="checkbox" name="feescategoryid[]" id="feescategoryid'.$i.'" value="'.$Fees['id'].'" />'.$Fees['name'].'</td>';
								}
							}
						} ?>
					</div>
				</div>
				
				<?php
				if($_GET['action'])
					echo '<div class="clearfix">
					<label><strong>Upload User Photo </strong>
						<input type="file" id="photo" name="photo"/> 
					</label>
				</div>';
				?>
					<hr/>
				<?php
				if(!$_GET['action'])
					echo '<input type="submit" class="button button-green" id="save" name="save" value="Save">';
				else
					echo '<input type="submit" class="button button-green" id="update" name="update" value="Update">';
				//onclick="Reset()"
				?>&nbsp;&nbsp;&nbsp;<button class="button button-gray" type="reset" name="reset" >Reset</button><br/><br/><br/>
			</fieldset>
		</form>
	</div>
</div>
</div>
<script>
	// function validation()
	// {
		// var message = "";
		// var gender = document.getElementsByName("gender");
		// var genderflag = 0;
			// for(var i = 0; i < gender.length; i++)
				// if(gender[i].checked)
					// genderflag++;
		// if(document.getElementById("religion").value == " ")
			// message = "please select the religion";
		// if(document.getElementById("subcast").value == " ")
			// message = "please select the subcast";
		// if(document.getElementById("cast").value == " ")
			// message = "please select the community";
		// if(document.getElementById("nationality").value == " ")
			// message = "please select the nationality";
		// if(document.getElementById("bloodgroup").value == " ")
			// message = "please select the bloodgroup";
		// if(document.getElementById("section").value == " ")
			// message = "please select the section";			
		// if(!genderflag)	
			// message = "please select the gender";
		// if(document.getElementById("dob").value == " ")
			// message = "please select the date of birth";	
		// if(document.getElementById("lastname").value.length < 2 || document.getElementById("lastname").value.length > 15)
			// message = "lastname should be within 2 to 15 characters";
		// if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			// message = "firstname should be within 2 to 15 characters";
		// if(document.getElementById("date").value == " ")
			// message = "please select the admission date";
		// if(document.getElementById("number").value.length < 2 || document.getElementById("number").value.length > 15)
			// message = "admission number should be within 2 to 15 characters";	
		// if(message)
		// {
			// alert(message);
			// return false;
		// }
		// else 
			// return true;
	// }
	function Feescategory(sectionid)
	{
		var Response = $("#Feescategory").html(Ajax("POST","includes/Get_Fees_Category.php","sectionid="+sectionid));
	}
</script>