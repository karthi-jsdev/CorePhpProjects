<?php
	$Columns = array("id","admission_no","admission_date","first_name","last_name","gender","dob","birth_place","section_id","blood_group_id","mother_tongue","nationality_id","subcast_id","cast_id","region_id","father_name","father_occupation_id","mother_name","mother_occupation_id",
			"annual_income","address","contact_no","email_id","contact_person","relation_id","prev_school_name","prev_school_address","prev_school_medium","prev_studied_std","promoted","busroute_id","fees_catagoryids");
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
<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation();" enctype="multipart/form-data">
	<fieldset>
		<h3>Student Admission</h3>
		<hr/>
		<br/>
		<div id="admexist"></div>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
		<div class="clearfix">
			<label><strong>Admission No.</strong><font color="red">*</font>
			<?php
				if(!$_POST['admission_no'])
					echo '<input type="text" id="number" name="number" value="" onblur="return validateAdmNo(this.value);" required="required" ><input type="hidden" name="adexist" id="adexist" >';
				else
					echo '<input type="text" id="number" name="number" value="'.$_POST['admission_no'].'" required="required" >';
			?>
				
				
			</label>
			<label><strong>Admission Date</strong>
				<input type="text" id="date" name="date" value="<?php if($_GET['action']) echo date('d-m-Y',strtotime($_POST['admission_date']));?>"/>
			</label>
			<div style="padding-left:550px"><label><h3><strong>Previous School Details</strong></h3></label></div>
		</div>
		<div class="clearfix">
			<label><strong>First Name </strong><font color="red">*</font>
				<input type="text" id="name" name="name" value="<?php echo $_POST['first_name'];?>" required="required" onkeypress="return isAlphabetic(event)"/>
			</label>
			<label><strong>Last Name</strong><font color="red">*</font>
				<input type="text" id="lastname" name="lastname" value="<?php echo $_POST['last_name'];?>"  onkeypress="return isAlphabetic(event)" required="required"/> 
			</label>
			<div style="padding-left:550px"><label><strong>School Name </strong><input type="text" value="<?php echo $_POST['prev_school_name'];?>" id="sname" name="sname"/></label><label><strong>Address &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><input type="text" value="<?php echo $_POST['prev_school_address'];?>" id="saddress" name="saddress" /></label></div>
		</div>
		<div class="clearfix">
			<div style="width:100px;margin: 10px 0;"><!--style="width:100px;margin: 15px 0;"-->
				<strong>Gender </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
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
			</div>
			<div style="width:100px;margin: -10px 200px;">
			<strong>DOB </strong><font color="red">*</font> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
				<input type="text" id="dob" value="<?php if($_GET['action']) echo date('d-m-Y',strtotime($_POST['dob']));?>"  name="dob" required="required" />
			</div>
				<div style="padding-left:550px"><label><strong>Medium of Instruction </strong><input type="text" id="instruction" value="<?php echo $_POST['prev_school_medium'];?>" name="instruction" /></label><label><strong>Previous Studied Std &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong><input type="text" value="<?php echo $_POST['prev_studied_std'];?>" id="pstudied" name="pstudied" /></label></div>
		</div>
		<div class="clearfix">
			<label><strong>Class & Section </strong><font color="red">*</font>
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
			<label><strong>Birth Place </strong>
				<input type="text" id="birthplace" onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['birth_place'];?>" name="birthplace" />
			</label>
			<div style="padding-left:550px"><!--style="width:100px;margin: 15px 0;"-->
				<strong>Promoted <br/></strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
				<?php
					$Gender = array("Yes","No");
					$i=1;
					foreach($Gender as $Gen)
					{
						if($_POST['promoted']==$i && $_GET['action'])
							echo '<span class="radio-input"><input type="radio" name="promoted" value="'.$i.'"  id="promoted" checked>'.$Gen.'</input></span><br/><br/>';
						else
							echo '<span class="radio-input"><input type="radio" name="promoted" value="'.$i.'"  id="promoted">'.$Gen.'</input></span><br/><br/>';
						$i--;
					}
				?>
			</div>
		</div>
		<div class="clearfix">
			<label><strong>Blood Group </strong><font color="red">*</font>
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
			<!--div style="padding-left:550px"><label><strong>Fee Particulars <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</strong></label>
				<div style="width:200px;margin: 10px 0;"><!--style="width:100px;margin: 15px 0;">
				<?php
					/* $SelectParticular = FetchParticulars(); */
					//$Gender = array("Male","Female");
					/* $i=0;
					if($_POST['fees_particulars'])
						$FeesParticulars = explode('.',$_POST['fees_particulars']);
					while($FetchParticular = mysql_fetch_array($SelectParticular))
					{
						$exist = 0;									//echo "<span class='radio-input'>";
						foreach($FeesParticulars as $FeesParticular)
						{
							if($FeesParticular == $FetchParticular['id'])
							{
								echo '<span class="radio-input"  style="width:200px"><input type="checkbox" name="particulars[]" value="'.$FetchParticular['id'].'"  id="particulars" checked>'.$FetchParticular['name'].'</input></span>';
								$exist = 1;	
								break;
							}
						}
						if(!$exist)
							echo '<span class="radio-input" style="width:200px"><input type="checkbox" name="particulars[]" value="'.$FetchParticular['id'].'"  id="particulars">'.$FetchParticular['name'].'</input></span>';
					} */
				?>
				</div>
			</div-->
		</div>
		<div class="clearfix">
			<label><strong>Nationality </strong><font color="red">*</font>
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
			<label><strong>Sub Caste </strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
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
			<label><strong>Religion </strong><font color="red">*</font>
				<select  id="religion" name="religion"> 
					<option value="">Select</option>
					<?php
						$Selectreligion = Select_Religion();
						while($Fetchreligion  = mysql_fetch_array($Selectreligion))
						{
							if($_POST['region_id']==$Fetchreligion['id'])
								echo '<option value="'.$Fetchreligion['id'].'" selected>'.$Fetchreligion['name'].'</option>';
							else
								echo '<option value="'.$Fetchreligion['id'].'">'.$Fetchreligion['name'].'</option>';
						}
					?>
				</select>
			</label>
			<label><strong>Bus Route </strong>
				<select  id="route" name="route"> 
					<option value="">Select</option>
				<?php
					$SelectBusRoute = Select_BusRoute();
					while($FetchBusRoute  = mysql_fetch_array($SelectBusRoute))
					{
						if($_POST['busroute_id']==$FetchBusRoute['id'])
							echo '<option value="'.$FetchBusRoute['id'].'" selected>'.$FetchBusRoute['name'].'-'.$FetchBusRoute['timings'].'</option>';
						else
							echo '<option value="'.$FetchBusRoute['id'].'">'.$FetchBusRoute['name'].'-'.$FetchBusRoute['timings'].'</option>';
					}
					?>
				</select>
			</label>
		</div>
		<div class="clearfix">
			<label><strong>Father Name </strong><font color="red">*</font>
				<input type="text" id="fname" name="fname" onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['father_name'];?>" required="required"/> 
			</label>
			<label><strong>Father's Occupation </strong>
				<select  id="foccupation" name="foccupation"> 
					<option value="">Select</option>
				<?php
					$SelectOccupation = Select_Occupation();
					while($FetchOccupation  = mysql_fetch_array($SelectOccupation))
					{
						if($_POST['father_occupation_id']==$FetchOccupation['id'])
							echo '<option value="'.$FetchOccupation['id'].'" selected>'.$FetchOccupation['name'].'</option>';
						else
							echo '<option value="'.$FetchOccupation['id'].'">'.$FetchOccupation['name'].'</option>';
					}
					?>
				</select>
			</label>
		</div>
		<div class="clearfix">
			<label><strong>Mother Name </strong><font color="red">*</font>
				<input type="text" id="mname" name="mname"  onkeypress="return isAlphabetic(event)" value="<?php echo $_POST['mother_name'];?>" required="required"/>
			</label>
			<label><strong>Mother's Occupation </strong>
				<select  id="moccupation" name="moccupation"> 
					<option value="">Select</option>
					<?php
						$SelectOccupation = mysql_query("Select * From occupation");
						while($FetchOccupation  = mysql_fetch_array($SelectOccupation))
						{
							if($_POST['mother_occupation_id']==$FetchOccupation['id'])
								echo '<option value="'.$FetchOccupation['id'].'" selected>'.$FetchOccupation['name'].'</option>';
							else
								echo '<option value="'.$FetchOccupation['id'].'">'.$FetchOccupation['name'].'</option>';
						}
					?>
				</select>
			</label>
		</div>
		<div class="clearfix">
			<label><strong>Annual Income </strong><font color="red">*</font>
				<input type="text" id="annual" name="annual" onkeypress="return isNumeric(event)" value="<?php echo $_POST['annual_income'];?>" required="required"/>
			</label>
			<label><strong>Address </strong><font color="red">*</font>
				<textarea id="address" name="address" onkeypress="return AlphaNumCheck(event)" required="required"><?php if($_GET['action']) echo $_POST['address'];?></textarea>
			</label>
		</div>
		<div class="clearfix">
			<label><strong>Contact Person </strong><font color="red">*</font>
				<input type="text" id="contactperson" onkeypress="return isAlphabetic(event)" required="required" name="contactperson" value="<?php echo $_POST['contact_person'];?>"/>
			</label>
			<label><strong>Relation with Student </strong><font color="red">*</font>
				<select  id="relation" name="relation"> 
					<option value="">Select</option>
					<?php
						$Selectrelation = Select_Relation();
						while($Fetchrelation  = mysql_fetch_array($Selectrelation))
						{
							if($_POST['relation_id']==$Fetchrelation['id'])
								echo '<option value="'.$Fetchrelation['id'].'" selected>'.$Fetchrelation['name'].'</option>';
							else
								echo '<option value="'.$Fetchrelation['id'].'">'.$Fetchrelation['name'].'</option>';
						}
					?>
				</select>
			</label>
		</div>
			<div class="clearfix">
			<label><strong>Contact number </strong><font color="red">*</font>
				<input type="text" id="contactnumber" onkeypress="return isNumeric(event)" name="contactnumber" value="<?php echo $_POST['contact_no'];?>" required="required"/> 
			</label>
			<label><strong>Email </strong>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
				<input type="text" id="email" name="email" value="<?php echo $_POST['email_id'];?>">
			</label>
		</div>
		<div class="clearfix">
			<label><strong>Feescategory </strong><font color="red">*</font>
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
								echo '<td><input type="checkbox" id="feescategoryid'.$i.'" name="feescategoryid[]" value="'.$Fees['id'].'" checked />'.$Fees['categorydes'].'</td>&nbsp;&nbsp;';
							else
								echo '<td><input type="checkbox" name="feescategoryid[]" id="feescategoryid'.$i.'" value="'.$Fees['id'].'" />'.$Fees['categorydes'].'</td>';
						}
					}
				} ?>
			</div>
		</div>
		<?php
		if(!$_GET['action'])
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
		?>&nbsp;&nbsp;&nbsp;<button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button><br/><br/><br/>
		</div>
	</fieldset>
</form>
<script>
function validateAdmNo(AdmissionNo)
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
			var result = xmlhttp.responseText;
			var splitResult = result.split("#");
			document.getElementById('admexist').innerHTML = splitResult[0];
			document.getElementById('adexist').value = splitResult[1];
		}
	}
	xmlhttp.open("GET","includes/GetAdmissionNo.php?AdmissionNo="+AdmissionNo,true);
	xmlhttp.send();
}
function validation()
{
	var message = "";
	var mail=/^([a-zA-Z0-9_\.\-]{3,30})+\@(([a-zA-Z0-9\-]{2,50})+\.)+([a-zA-Z0-9]{2,4})+$/;
	var Gender = document.getElementsByName("gender");
	var flag = 0;
		for (var i = 0; i< Gender.length; i++)
			if(Gender[i].checked)
				flag++;
	/* var Particulars = document.getElementsByName("particulars[]");
	var flag1 = 0;
		for (var i = 0; i< Particulars.length; i++)
			if(Particulars[i].checked)
				flag1++;
	if(!flag1)
		message = "Please select Particulars"; */
	//if(document.getElementById("saddress").value.length < 4 || document.getElementById("saddress").value.length > 50)
		//message = "School address should be within 4 to 50 characters";
	//if(document.getElementById("sname").value.length < 4 || document.getElementById("sname").value.length > 15)
		//message = "School name should be within 4 to 15 characters";
	if(!mail.test(document.getElementById('email').value) && document.getElementById('email').value)
			message = "Please enter valid E-Mail";
	if(document.getElementById("relation").value == "")
		message = "Please select Relation with Student";
	if(document.getElementById("contactperson").value.length < 4 || document.getElementById("contactperson").value.length > 50)
		message = "Contact Person Name should be within 4 to 50 characters";
	if(document.getElementById("address").value.length < 4 || document.getElementById("address").value.length > 50)
		message = "Address should be within 4 to 50 characters";
	//if(document.getElementById("moccupation").value == "")
		//message = "Please select occupation";
	if(document.getElementById("mname").value.length < 4 || document.getElementById("mname").value.length > 15)
		message = "Mother Name should be within 4 to 15 characters";
	//if(document.getElementById("foccupation").value == "")
		//message = "Please select occupation";
	if(document.getElementById("fname").value.length < 4 || document.getElementById("fname").value.length > 15)
		message = "Father Name should be within 4 to 15 characters";
	//if(document.getElementById("subcast").value == "")
		//message = "Please select subcast"; 
	if(document.getElementById("religion").value == "")
		message = "Please select Religion"; 
	//if(document.getElementById("cast").value == "")
		//message = "Please select cast"; 
	if(document.getElementById("nationality").value == "")
		message = "Please select Nationality"; 
	//if(document.getElementById("mothertongue").value.length < 4 || document.getElementById("mothertongue").value.length > 15)
		//message = "Mother tongue should be within 4 to 15 characters";
	if(document.getElementById("bloodgroup").value == "")
		message = "Please select Bloodgroup"; 
	//if(document.getElementById("birthplace").value.length < 4 || document.getElementById("birthplace").value.length > 15)
		//message = "Birt place should be within 4 to 15 characters";
	if(document.getElementById("section").value == "")
		message = "Please select Section"; 
	if(!flag)
		message = "Please select Gender";
	if(document.getElementById("lastname").value.length < 1 || document.getElementById("lastname").value.length > 15)
		message = "Last Name should be within 1 to 15 characters";
	if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 15)
		message = "First Name should be within 4 to 15 characters";
	if(message)
	{
		alert(message);
		return false;
	}
	else
		return true;
}
function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 35 || charCode == 32) 
			return true;
         if (charCode >= 44 && charCode <= 47) 
			return true;
		var keynum;
		
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
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
function isAlphabetic(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode == 8 || charCode == 32)
		return true;
	else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
		return true;
	else
		return false;
}
function isNumeric(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode==8 || charCode==32)
		return true;
	if(charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	else
		return NumberCount();
}

function NumberCount()
{
	if(document.getElementById("contactnumber").value.length < 15)
		return true;
	else
		return false;
}
function Feescategory(sectionid)
{
	var Response = $("#Feescategory").html(Ajax("POST","includes/Get_Fees_Category.php","sectionid="+sectionid));
}
function Reset()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>");
	}
</script>