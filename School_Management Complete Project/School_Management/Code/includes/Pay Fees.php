<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
<script src="js/datepicker/jquery.ui.core.js"></script>
<script src="js/datepicker/jquery.ui.widget.js"></script>
<script src="js/datepicker/jquery.ui.datepicker.js"></script>
<script>
	$(function()
	{
		$("#payment_date").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
	});
</script>
<section role="main" id="main">
	<?php
	$Columns = array("id", "student_id", "terms", "payment_mode", "payment_done", "payment_date", "total_amount", "amount_pending", "fees_category_id", "discount_id", "fine");
	if($_GET['action'] == 'Edit')
	{
		$Section = mysql_fetch_assoc(Select_PayFees_ByAddNo());
		foreach($Columns as $Col)
			$_POST[$Col] = $Section[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Delete_PayFees_ById();
		$message = "<br /><div class='message success'><b>Message</b> : One record deleted successfully</div>";
	}
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		if(isset($_POST['Submit']))
		{
			Insert_PayFees();
			$message = "<br /><div class='message success'><b>Message</b> : Record added successfully</div>";
		}
		else if(isset($_POST['Update']))
		{
			Update_PayFees();
			$message = "<br /><div class='message success'><b>Message</b> : Record details updated successfully</div>";
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	} 
	if($_POST['student_id'])
	{
		$FetchStudent = mysql_fetch_array(mysql_query("SELECT student_admission.id,student_admission.admission_no, student_admission.first_name, class.name as classname FROM student_admission JOIN section ON section.id=student_admission.section_id JOIN class ON class.id=section.classid where student_admission.id='".$_POST['student_id']."'"));
	}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['SM_id']; ?>" required="required"/>
			<header><h2>Pay Fees</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Admission No. <font color="red">*</font></label>
					<select id="" onchange="var Options = this.value.split('.');  document.getElementById('student_id').value=Options[0];document.getElementById('first_name').value=Options[1];document.getElementById('class_name').value=Options[2];">
						<option value="">Select</option>
						<?php
						$StudentAdmissions = Select_All_StudentAdmissions();
						while($StudentAdmission = mysql_fetch_assoc($StudentAdmissions))
						{
							if($StudentAdmission['id'] == $_POST['student_id'])
								echo "<option value='".$StudentAdmission['id'].".".$StudentAdmission['first_name'].".".$StudentAdmission['classname']."' selected>".$StudentAdmission['admission_no']."</option>";
							else
								echo "<option value='".$StudentAdmission['id'].".".$StudentAdmission['first_name'].".".$StudentAdmission['classname']."'>".$StudentAdmission['admission_no']."</option>";
						} ?>
					</select>
					<input id="student_id" name="student_id" type="hidden" value="<?php echo $_POST['student_id']; ?>"/>
				</div>
				<div class="clearfix">
					<label>Student Name <font color="red">*</font></label>
					<input type="text" id="first_name" name="first_name" required="required" disabled value="<?php echo $FetchStudent['first_name']; ?>" />
				</div>
				<div class="clearfix">
					<label>Class Name <font color="red">*</font></label>
					<input type="text" id="class_name" name="class_name" required="required" disabled value="<?php echo $FetchStudent['classname']; ?>" />
				</div>
				<div class="clearfix">
					<label>Terms <font color="red">*</font></label>
					<select id="terms" name="terms[]" onchange="" multiple>
						<option value="" disabled>Select</option>
						<?php
						$Terms = Select_All_Terms();
						
						$explodeTerms = explode('.',$_POST['terms']);
						$ID = array();
						while($Term = mysql_fetch_assoc($Terms))
						{
							foreach($explodeTerms as $explodeTerm)
							{
								if($Term['id']==$explodeTerm && !in_array($explodeTerm,$ID))
								{
									echo "<option value='".$Term['id']."' selected>".$Term['name']."</option>";
									$ID[] = $explodeTerm;
								}
							}
							if(!in_array($Term['id'],$ID))
							{
								echo "<option value='".$Term['id']."' >".$Term['name']."</option>";
								$ID[] = $Term['id'];
							}
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Payment Mode <font color="red">*</font></label>
					<select id="payment_mode" name="payment_mode" onchange="">
						<option value="">Select</option>
						<?php
						$PaymentModes = Select_All_PaymentModes();
						while($PaymentMode = mysql_fetch_assoc($PaymentModes))
						{
							if($PaymentMode['id'] == $_POST['payment_mode'])
								echo "<option value='".$PaymentMode['id']."' selected>".$PaymentMode['name']."</option>";
							else
								echo "<option value='".$PaymentMode['id']."'>".$PaymentMode['name']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Total Amount <font color="red">*</font></label>
					<input type="text" id="total_amount" name="total_amount" required="required" value="<?php echo $_POST['total_amount']; ?>" onkeypress="return isNumeric(event)" placeholder="INR"/>
				</div>
				<div class="clearfix">
					<label>Amount Pending <font color="red">*</font></label>
					<input type="text" id="amount_pending" name="amount_pending" required="required" value="<?php echo $_POST['amount_pending']; ?>" onkeypress="return isNumeric(event)" placeholder="INR"/>
				</div>
				<div class="clearfix">
					<label>Payment Done <font color="red">*</font></label>
					<input type="text" id="payment_done" name="payment_done" required="required" value="<?php echo $_POST['payment_done']; ?>" onkeypress="return isNumeric(event)" placeholder="INR"/>
				</div>
				<div class="clearfix">
					<label>Payment Date <font color="red">*</font></label>
					<input type="text" id="payment_date" name="payment_date" required="required" value="<?php echo $_POST['payment_date']; ?>" onkeypress="return false"/>
				</div>
				<div class="clearfix">
					<label>Fee Category <font color="red">*</font></label>
					<select id="fees_category_id" name="fees_category_id" onchange="GetFees(this.value,'')">
						<option value="">Select</option>
						<?php
						$FeesCategories = Select_All_FeesCategories();
						while($FeesCategory = mysql_fetch_assoc($FeesCategories))
						{
							if($FeesCategory['id'] == $_POST['fees_category_id'])
								echo "<option value='".$FeesCategory['id']."' selected>".$FeesCategory['name']."</option>";
							else
								echo "<option value='".$FeesCategory['id']."'>".$FeesCategory['name']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Fees Particulars </label>
					<div id="fees_particulars"></div>
				</div>
				<div class="clearfix">
					<label>Discount </label>
					<select id="discount_id" name="discount_id" onchange="">
						<option value="">Select</option>
						<?php
						$Discounts = Select_All_Discounts();
						while($Discount = mysql_fetch_assoc($Discounts))
						{
							if($Discount['id'] == $_POST['discount_id'])
								echo "<option value='".$Discount['id']."' selected>".$Discount['name']."</option>";
							else
								echo "<option value='".$Discount['id']."'>".$Discount['name']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Fine <font color="red">*</font></label>
					<select id="fine_id" name="fine_id" onchange="var Options = this.value.split('/');  document.getElementById('fine').innerHTML=Options[1]; ">
						<option value="">Select</option>
						<?php
						$Fines = mysql_query("select * from fine");
						$FetchFineAmount = mysql_fetch_array(mysql_query("select * from fine where id='".$_POST['fine']."'"));
						while($Fine = mysql_fetch_assoc($Fines))
						{
							if($Fine['id'] == $_POST['fine'])
								echo "<option value='".$Fine['id'].'/'.$Fine['amount']."' selected>".$Fine['name']."</option>";
							else
								echo "<option value='".$Fine['id'].'/'.$Fine['amount']."'>".$Fine['name']."</option>";
						} ?>
					</select>
				</div>	
				<div class="clearfix">
					<label>Amount</label>
					<div id="fine">
						<?php echo $FetchFineAmount['amount']; ?>
					</div>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
	</div>
	
	<div class="columns">
		<h3>Fees Payment List
			<?php
			$AllPayFees = mysql_fetch_assoc(Count_AllPayFees());
			echo " : No. of total records - ".$AllPayFees['total'];
			?>
		</h3>
		<hr />			
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.No.</th>
					<th>Admission No.</th>
					<th>Student Name</th>
					<th>Terms</th>
					<th>Total Amount</th>
					<th>Amount Pending</th>
					<th>Payment Done</th>
					<th>Payment Date</th>
					<th>Fee Category</th>
					<th>Discount</th>
					<th>Fine</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$AllPayFees['total'])
					echo '<tr><td colspan="10"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($AllPayFees['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$Start = ($_GET['pageno']-1)*$Limit;
				if($_GET['pageno']>=2)
					$i = $Start+1;
				else
					$i =1;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$AllPayFees = Select_PayFees_ByLimit($Start, $Limit);
				while($PayFees = mysql_fetch_assoc($AllPayFees))
				{
					//$FetchStudentFees = mysql_fetch_array(mysql_query("select * from student_fees where id='".$PayFees['id']."'"));
					$FetchDiscount = mysql_fetch_array(mysql_query("select * from discount where id='".$PayFees['discount_id']."'"));
					$SelectedTerms = "";
					$Terms = Select_Terms_ById($PayFees['terms']);
					while($Term = mysql_fetch_assoc($Terms))
						$SelectedTerms .= $Term['name'].", ";
					echo "<tr style='valign:middle;'>
						<td align='center'>".$i++."</td>
						<td>".$PayFees['admission_no']."</td>
						<td>".$PayFees['first_name']."</td>
						<td>".substr($SelectedTerms,0 , strlen($SelectedTerms)-2)."</td>
						<td>".$PayFees['total_amount']."</td>
						<td>".$PayFees['amount_pending']."</td>
						<td>".$PayFees['payment_done']."</td>
						<td>".substr($PayFees['payment_date'], 0,16)."</td>
						<td>".$PayFees['fees_catagory_name']."</td>
						<td>".$FetchDiscount['name']."</td>
						<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$PayFees['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$PayFees['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 32) 
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
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode==9)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function validation()
	{
		var message = "";
		if(!document.getElementById("fees_category_id").value)
			message = "Please select fees category";
		if(!document.getElementById("payment_date").value)
			message = "Please enter payment date";
		if(document.getElementById("total_amount").value < document.getElementById("payment_done").value)
			message = "Total amount should be greater than payment done";
		if(document.getElementById("total_amount").value < document.getElementById("amount_pending").value)
			message = "Total amount should be greater than pending amount";
		if(document.getElementById("payment_done").value > document.getElementById("amount_pending").value)
			message = "Payment done should be equal or lesser than pending amount";
		//if(document.getElementById("payment_done").value <= 0)
			//message = "Please enter valid payment done";
		if(!document.getElementById("payment_done").value)
			message = "Please enter payment done";
		//if(document.getElementById("amount_pending").value <= 0)
			//message = "Please enter valid pending amount";
		if(!document.getElementById("amount_pending").value)
			message = "Please enter amount pending";
		if(document.getElementById("total_amount").value <= 0)
			message = "Please enter valid total amount";
		if(!document.getElementById("total_amount").value)
			message = "Please enter total amount";
		if(!document.getElementById("payment_mode").value)
			message = "Please select payment mode";
		if(!document.getElementById("terms").value)
			message = "Please select terms";
		if(!document.getElementById("student_id").value)
			message = "Please select a admission no.";
		
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	<?php
	if($_POST['fees_category_id'])
	{
	?>
		GetFees(<?php echo $_POST['fees_category_id']; ?>,'');
	<?php
	}
	?>
	function GetFees(FeesId,ParticularId)
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
				document.getElementById("fees_particulars").innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/GetFeesParticulars.php?FeesId="+FeesId+"&ParticularId="+ParticularId,true);
		xmlhttp.send();
	}
</script>