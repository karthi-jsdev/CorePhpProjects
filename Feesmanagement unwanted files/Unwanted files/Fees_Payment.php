<?php
	include("includes/Fees_Payement_Queries.php");
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
				<label>Payment Date <font color="red">*</font></label>
				<input type="text" id="payment_date" name="payment_date" required="required" value="<?php echo $_POST['payment_date']; ?>" onkeypress="return false"/>
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