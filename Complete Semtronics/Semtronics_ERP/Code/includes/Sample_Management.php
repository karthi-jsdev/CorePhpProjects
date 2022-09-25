<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#date").datepicker({dateFormat: 'yy-mm-dd',minDate:0});
			$("#follow_up").datepicker({dateFormat: 'yy-mm-dd',minDate:0});
		});
	</script>
	<?php
	if($_GET['id']&&$_GET['action']=="delete"&&!$_POST['Submit'])
	{
		Sample_Deletion();
		echo "<br /><div class='message error'><b>Message</b> : Samples Data Deleted Successfully</div>";
	}
	if(isset($_POST['Submit']))
	{
		if(empty($_POST['lead_id'])|| empty($_POST['oppurtunity_id'])|| empty($_POST['specification'])|| empty($_POST['product_id'])|| empty($_POST['date'])||empty($_POST['contact_person'])||empty($_POST['designation'])||empty($_POST['email_id'])||empty($_POST['assigned_to'])|| empty($_POST['sample_prize'])| empty($_POST['no_of_samples'])||empty($_POST['follow_up'])||empty($_POST['company'])||empty($_POST['contact_no']))
			echo "<br /><div class='message error'><b>Message</b> :Mandatory Fields Should not be empty</div>";
		else
		{
			SampleManagement_Insertion();
			echo "<br /><div class='message success'><b>Message</b> :Samples Created Successfully</div>";
			$_POST['lead_id'] = "";
			$_POST['oppurtunity_id'] = "";
			$_POST['specification'] = "";
			$_POST['product_id'] = "";
			$_POST['date'] = "";
			$_POST['contact_person'] = "";
			$_POST['designation'] = "";
			$_POST['email_id'] = "";
			$_POST['assigned_to'] = "";
			$_POST['sample_prize'] = "";
			$_POST['no_of_samples'] = "";
			$_POST['follow_up'] = "";
			$_POST['company'] = "";
			$_POST['contact_no'] = "";
		}
	}
	if($_GET['action']=="edit" && $_GET['id'])
	{
		$sampleedit = mysql_fetch_assoc(Sample_Edit());
		$_POST['id'] = $sampleedit['sid']; 
		$_POST['lead_id'] = $sampleedit['lid'];
		$_POST['oppurtunity_id'] = $sampleedit['oppurtunity_id']; 
		$_POST['specification'] = $sampleedit['specification'];
		$_POST['product_id'] = $sampleedit['pid'];  
		$_POST['date'] = $sampleedit['date'];
		$_POST['contact_person'] = $sampleedit['contact_person']; 
		$_POST['designation'] = $sampleedit['designation'];
		$_POST['email_id'] = $sampleedit['email_id']; 
		$_POST['assigned_to'] = $sampleedit['assigned_to'];
		$_POST['sample_prize'] = $sampleedit['sample_prize']; 
		$_POST['no_of_samples'] = $sampleedit['no_of_samples'];
		$_POST['follow_up'] = $sampleedit['follow_up'];
		$_POST['company'] = $sampleedit['company'];
		$_POST['contact_no'] = $sampleedit['contact_no'];
	}
	if(isset($_POST['Update']))
	{
		if(empty($_POST['lead_id'])|| empty($_POST['oppurtunity_id'])|| empty($_POST['specification'])|| empty($_POST['product_id'])||empty($_POST['date'])|| empty($_POST['contact_person'])|| empty($_POST['designation'])|| empty($_POST['email_id'])|| empty($_POST['assigned_to'])|| empty($_POST['sample_prize'])|| empty($_POST['no_of_samples'])|| empty($_POST['follow_up'])|| empty($_POST['company'])|| empty($_POST['contact_no']))
			echo "<br /><div class='message error'><b>Message</b> :Mandatory Fields Should not be empty</div>";
		else
		{
			Sample_Updation();
			$_POST['lead_id'] = "";$_POST['oppurtunity_id'] = "";$_POST['specification'] = "";$_POST['product_id'] = "";$_POST['date'] = "";
			$_POST['contact_person'] = "";$_POST['designation'] = "";$_POST['email_id'] = "";$_POST['assigned_to'] = "";$_POST['sample_prize'] = "";$_POST['no_of_samples'] = "";$_POST['follow_up'] = "";$_POST['company'] = "";$_POST['contact_no'] = "";
			echo "<br /><div class='message success'><b>Message</b> :Sample Updated Successfully</div>";
		}
	} ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message;?>
		<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validate();">
			<fieldset>
				<input type="hidden" value="<?php echo $_POST['id'];?>" name="id">
				<div class="clearfix">
					<label>
					<?php 
					$Sample_id = mysql_fetch_assoc(Samples_Id());
					$Samplesid = $Sample_id['id'];
					$Samplesid = ++$Samplesid; 
					if(strlen($Samplesid)==0)
						echo "<br/><strong>S0000001</strong>";
					if(strlen($Samplesid)==1)
						echo "<br/><strong>S000000".$Samplesid.'</strong>';
					else if(strlen($Samplesid)==2)
						echo "<br/><strong>S00000".$Samplesid.'</strong>';
					else if(strlen($Samplesid)==3)
						echo "<br/><strong>S0000".$Samplesid.'</strong>';
					else if(strlen($Samplesid)==4)
						echo "<br/><strong>S000".$Samplesid.'</strong>';
					else if(strlen($Samplesid)==5)
						echo "<br/><strong>S00".$Samplesid.'</strong>';
					else if(strlen($Samplesid)==6)
						echo "<br/><strong>S0".$Samplesid.'</strong>';
					else if(strlen($Samplesid)==7)
						echo "<br/><strong>S".$Samplesid.'</strong>';
					?>
					</label>
					<label>
						<strong>Lead Name</strong><font color="red">*</font>
						<?php $leadname = Lead_selection(); ?>
						<select name="lead_id" id="lead_id" onchange="Work_no(this.value);">
							<option value="Select">Select</option>
							<?php
								while($lead_name = mysql_fetch_assoc($leadname))
								{
								if($_POST['lead_id'] == $lead_name['id'])
									echo'<option value="'.$lead_name['id'].'" selected>'.$lead_name['name'].'</option>';
								else
									echo'<option value="'.$lead_name['id'].'">'.$lead_name['name'].'</option>';
								}
							?>
						</select>
					</label>
					<label>
						<strong>Work Number</strong><font color="red">*</font>
						<select id="oppurtunity_id" name="oppurtunity_id">
							<option value="Select">Select</option>
							<?php
							if($_GET['id'])
							{
								$list = mysql_fetch_assoc(Sample_Opportunity_id());
								$Work_d = $list['oppurtunity_id'];
								if(strlen($Work_d)==1)
									$work = "WK000000".$Work_d;
								else if(strlen($Work_d)==2)
									$work = "WK00000".$Work_d;
								else if(strlen($Work_d)==3)
									$work = "WK0000".$Work_d;
								else if(strlen($Work_d)==4)
									$work = "WK000".$Work_d;
								else if(strlen($Work_d)==5)
									$work = "WK00".$Work_d;
								else if(strlen($Work_d)==6)
									$work = "WK0".$Work_d;
								else if(strlen($Work_d)==7)
										$work = "WK".$Work_d;
								if($_POST['oppurtunity_id'] == $list['oppurtunity_id'])
									echo'<option value="'.$list['oppurtunity_id'].'" selected>'.$work.'</option>';
								else
									echo'<option value="'.$list['oppurtunity_id'].'">'.$work.'</option>';
							} ?>	
						</select>
					</label>
					<label>
						<strong>Product</strong><font color="red">*</font>
						<?php $sample_value = Product();?>
						<select name="product_id" id="product_id">
							<option value="Select">Select</option>
							<?php 
								while($sample_values = mysql_fetch_assoc($sample_value))
								{
									if($_GET['id'] && $_POST['product_id'] == $sample_values['id'])
										echo '<option value="'.$sample_values['id'].'" selected>'.$sample_values['productcode'].'</option>';
									else
										echo '<option value="'.$sample_values['id'].'">'.$sample_values['productcode'].'</option>';
								}
							?>
						</select>
					</label>
					<label><strong>Date</strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" autocomplete="off" id="date" name="date" required="required" value="<?php
																							if($_POST['Submit'])
																								$_POST['date']="";
																							else
																								echo $_POST['date'];
																							?>"/></label>
					
					<label><strong>Company</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="company" name="company" required="required" value="<?php
																								if($_POST['Submit'])
																									$_POST['company']=""; 
																								else
																									echo $_POST['company'];
																								?>" onkeypress="return isAlphabetic(event)"/></label>
				<label><strong>Contact Person</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="contact_person" name="contact_person" required="required" value="<?php 
																											if($_POST['Submit'])
																												$_POST['contact_person']="";
																											else
																												echo $_POST['contact_person'];
																											?>" onkeypress="return isAlphabetic(event)"/></label>
					<label><strong>Designation</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="designation" name="designation" required="required" value="<?php
																										if($_POST['Submit'])
																											$_POST['designation']="";
																										else
																											echo $_POST['designation'];
																										?>" onkeypress="return isAlphabetic(event)"/></label> 
					
				</div>
				<div class="clearfix">
					<!--label>
						<strong>Product</strong><font color="red">*</font>
						<?php //$product = Product()?>
						<select name="product_id" id="product_id">
							<option value="Select">Select</option>
							<?php
							/*while($product_value = mysql_fetch_assoc($product))
							{
							if($_POST['product_id']==$product_value['id'])
								echo '<option value="'.$product_value['id'].'" selected>'.$product_value['description'].'</option>';
							else
								echo '<option value="'.$product_value['id'].'">'.$product_value['description'].'</option>';
							}*/
							?>
						</select>
					</label-->
				</div>
				<div class="clearfix">
					<label><strong>E-mail Id</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="email_id" name="email_id" required="required" value="<?php  
																								if($_POST['Submit'])
																									$_POST['email_id']="";
																								else
																									echo $_POST['email_id'];				
																								?>"/></label>
					<label><strong>Contact No.</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="contact_no" maxlength="25" name="contact_no" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['contact_no']="";
																									else
																										echo $_POST['contact_no'];
																									?>" onkeypress="return isNumeric_contact(event)"/></label>
					<label><strong>Assigned To</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="assigned_to" name="assigned_to" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['assigned_to']="";
																									else
																										echo $_POST['assigned_to'];
																									?>" onkeypress="return isAlphabetic(event)"/></label>
					<label><strong>Sample Price</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="sample_prize" maxlength="4" name="sample_prize" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['sample_prize']="";
																									else
																										echo $_POST['sample_prize'];
																									?>" onkeypress="return isNumeric(event)"/></label>
					<label><strong>No Of Samples</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="no_of_samples" maxlength="3" name="no_of_samples" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['no_of_samples']="";
																									else
																										echo $_POST['no_of_samples'];
																									?>" onkeypress="return isNumeric(event)"/></label>
					<label><strong>Follow Up</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="follow_up" name="follow_up" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['follow_up']="";
																									else
																										echo $_POST['follow_up'];
																									?>" /></label>
					<label>
						<strong>Specification</strong><font color="red">*</font>
						<textarea name="specification" id="specification" maxlength="50" rows="2" cols="25"><?php
																							if($_POST['Submit'])
																								$_POST['specification']="";
																							else
																								echo $_POST['specification'];
																							?></textarea>
					</label>
				</div>
				<div class="clearfix">
					<?php
					if($_GET['action']=='edit')
						echo '<button type="submit" class="button button-green" value="Update" name="Update" onclick="return vali_Date();">Update</button>&nbsp;&nbsp;';
					else
						echo'<button type="submit" class="button button-green" value="Add Samples" name="Submit" onclick="return vali_Date();">Add Samples</button>&nbsp;&nbsp;';
						echo'<button type="reset" class="button button-gray" value="Reset" name="reset">Reset</button>';
					?>
				</div>
			</fieldset>
		</form>
	</div>
</section>
<form action="" method="POST" onsubmit="return SearchEmpty();">
	<div style="float:right">
		<input type="text" value="<?php  if(isset($_POST['contentSearch'])) echo $_POST['contentSearch'];else echo $_GET['contentSearch'];?>" name="contentSearch" autocomplete="off" id="contentSearch">
		<button id="search" style="border:0px;background:none;" type="submit" name="search"><img style="margin-top:-15px;" src="images/search.png" title="Search">
	</div>
</form>
<br/><table class="paginate sortable full">
	<thead>
		<tr>
			<th>Sample No.</th>
			<th>Lead Name</th>
			<th>Work No.</th>
			<th>Specification</th>
			<th>Product</th>
			<th>Date</th>
			<th>Contact Person</th>
			<th>Designation</th>
			<th>Email</th>
			<th>Contact No.</th>
			<th>Company</th>
			<th>Assigned To</th>
			<th>Price</th>
			<th>Sample Quantity</th>
			<th>Follow Update</th>
			<th>Action</th>
		</tr>
	</thead>
	<?php
	if($_POST['contentSearch']||$_GET['contentSearch'])
	{
		if(!$_POST['contentSearch'])
		{
			$_POST['contentSearch']=$_GET['contentSearch'];
		}
			$totaldata = mysql_fetch_assoc(Sample_Selection_ByValueCount());
	}
	else
		$totaldata = mysql_fetch_assoc(Sample_Selection_ByCount());
	$Limit = 10;
	if(!$totaldata['total'])
		echo'<tr><td style="color:#FF0000;" colspan="16"><center>No data Found</center></td></tr>';
	$total_pages = ceil($totaldata['total'] / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
	if($_POST['contentSearch']=="")
	{
		$sample_list = Sample_Selection($Start,$Limit);
		while($samplelist = mysql_fetch_assoc($sample_list))
		{
			$Samplesid = $samplelist['id'];
			if(strlen($Samplesid)==1)
				$sample = "S000000".$Samplesid;
			else if(strlen($Samplesid)==2)
				$sample = "S00000".$Samplesid;
			else if(strlen($Samplesid)==3)
				$sample = "S0000".$Samplesid;
			else if(strlen($Samplesid)==4)
				$sample = "S000".$Samplesid;
			else if(strlen($Samplesid)==5)
				$sample = "S00".$Samplesid;
			else if(strlen($Samplesid)==6)
				$sample = "S0".$Samplesid;
			else if(strlen($Samplesid)==7)
				$sample = "S".$Samplesid;
			$Work_d = $samplelist['oppurtunity_id'];
			if(strlen($Work_d)==1)
				$work = "WK000000".$Work_d;
			else if(strlen($Work_d)==2)
				$work = "WK00000".$Work_d;
			else if(strlen($Work_d)==3)
				$work = "WK0000".$Work_d;
			else if(strlen($Work_d)==4)
				$work = "WK000".$Work_d;
			else if(strlen($Work_d)==5)
				$work = "WK00".$Work_d;
			else if(strlen($Work_d)==6)
				$work = "WK0".$Work_d;
			else if(strlen($Work_d)==7)
				$work = "WK".$Work_d;
			echo'<tbody>
				<tr>
					<td>'.$sample.'</td>
					<td>'.$samplelist['name'].'</td>
					<td>'.$work.'</td>
					<td>'.wordwrap($samplelist['specification'],20,"\n",true).'</td>
					<td>'.$samplelist['description'].'</td>
					<td>'.date('d-m-Y',strtotime($samplelist['date'])).'</td>
					<td>'.$samplelist['contact_person'].'</td>
					<td>'.$samplelist['designation'].'</td>
					<td>'.$samplelist['email_id'].'</td>
					<td>'.$samplelist['contact_no'].'</td>
					<td>'.wordwrap($samplelist['company'],10,"\n",true).'</td>
					<td>'.$samplelist['assigned_to'].'</td>
					<td>'.$samplelist['sample_prize'].'</td>
					<td>'.$samplelist['no_of_samples'].'</td>
					<td>'.date('d-m-Y',strtotime($samplelist['follow_up'])).'</td>
					<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Sample_Management&id='.$samplelist['id'].'&action=edit" class="action-button" title="user-edit"><span class="user-edit"></span></a><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Sample_Management&id='.$samplelist['id'].'&action=delete" onclick="return ondelete()" class="action-button" title="user-delete"><span class="user-delete"></span></a></td>
				</tr>
			</tbody>';
		}
	}
	else if((isset($_POST['contentSearch']))||$_GET['contentSearch'])
	{
		$sample_list = Sample_Selection_Leadname($Start,$Limit);
		while($samplelist = mysql_fetch_assoc($sample_list))
		{
			$Samplesid = $samplelist['id'];
			if(strlen($Samplesid)==1)
				$sample = "S000000".$Samplesid;
			else if(strlen($Samplesid)==2)
				$sample = "S00000".$Samplesid;
			else if(strlen($Samplesid)==3)
				$sample = "S0000".$Samplesid;
			else if(strlen($Samplesid)==4)
				$sample = "S000".$Samplesid;
			else if(strlen($Samplesid)==5)
				$sample = "S00".$Samplesid;
			else if(strlen($Samplesid)==6)
				$sample = "S0".$Samplesid;
			else if(strlen($Samplesid)==7)
				$sample = "S".$Samplesid;
			$Work_d =  $samplelist['oppurtunity_id'];
			if(strlen($Work_d)==1)
				$work = "WK000000".$Work_d;
			else if(strlen($Work_d)==2)
				$work = "WK00000".$Work_d;
			else if(strlen($Work_d)==3)
				$work = "WK0000".$Work_d;
			else if(strlen($Work_d)==4)
				$work = "WK000".$Work_d;
			else if(strlen($Work_d)==5)
				$work = "WK00".$Work_d;
			else if(strlen($Work_d)==6)
				$work = "WK0".$Work_d;
			else if(strlen($Work_d)==7)
				$work = "WK".$Work_d;
			echo'<tbody>
				<tr>
					<td>'.$sample.'</td>
					<td>'.$samplelist['name'].'</td>
					<td>'.$work.'</td>
					<td>'.wordwrap($samplelist['specification'],20,"\n",true).'</td>
					<td>'.$samplelist['description'].'</td>
					<td>'.date('d-m-Y',strtotime($samplelist['date'])).'</td>
					<td>'.$samplelist['contact_person'].'</td>
					<td>'.$samplelist['designation'].'</td>
					<td>'.$samplelist['email_id'].'</td>
					<td>'.$samplelist['contact_no'].'</td>
					<td>'.wordwrap($samplelist['company'],10,"\n",true).'</td>
					<td>'.$samplelist['assigned_to'].'</td>
					<td>'.$samplelist['sample_prize'].'</td>
					<td>'.$samplelist['no_of_samples'].'</td>
					<td>'.date('d-m-Y',strtotime($samplelist['follow_up'])).'</td>
					<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Sample_Management&id='.$samplelist['id'].'&action=edit" class="action-button" title="user-edit"><span class="user-edit"></span></a><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Sample_Management&id='.$samplelist['id'].'&action=delete" onclick="return ondelete()" class="action-button" title="user-delete"><span class="user-delete"></span></a></td>
				</tr>
			</tbody>';
		}
	} ?>
</table>
<?php
	$GETParameters = "page=Sales&subpage=spage->Opportunities,ssubpage->Sample_Management&contentSearch=".$_POST['contentSearch']."&";
	if($total_pages > 1)
	include("includes/Pagination.php");
?>
<script>
	function SearchEmpty()
	{
		if(document.getElementById("contentSearch").value)
			return true;
		else
		{
			window.location.assign("?page=Sales&subpage=spage->Opportunities,ssubpage->Sample_Management");
			return false;
		}
	}
	function Work_no()
	{
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('oppurtunity_id').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Work_no.php?lead_id="+document.getElementById('lead_id').value,true);
		xmlhttp.send();
	}
	function product_subcategory()
	{
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('product_subcategory_id').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/others_display.php?product_category_id="+document.getElementById('product_category_id').value,true);
		xmlhttp.send();
	}
	function product()
	{
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('product_id').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/others_display.php?product_subcategory_id="+document.getElementById('product_subcategory_id').value,true);
		xmlhttp.send();
	}
	function ondelete()
	{
		return confirm("Are you sure want to Delete?");
	}
	function vali_Date()
	{
		if(document.getElementById('lead_id').selectedIndex == 0)
		{
			alert("Please Select Lead");
			return false;
		}
		if(document.getElementById('oppurtunity_id').selectedIndex == 0)
		{
			alert("Please Select Work Number");
			return false;
		}
		if(document.getElementById('product_category_id').selectedIndex == 0)
		{
			alert("Please Select Product Category");
			return false;
		}
		if(document.getElementById('product_subcategory_id').selectedIndex == 0)
		{
			alert("Please Select Product SubCategory");
			return false;
		}
		if(document.getElementById('product_id').selectedIndex == 0)
		{
			alert("Please Select Product");
			return false;
		}
		var da = document.getElementById("date");
		var dat = da.value.trim().length;
		if (dat == 0)
		{
			alert('Please Select Date');
			return false;
		}
		var comp = document.getElementById("company");
		var company = comp.value.trim().length;
		if (company == 0)
		{
			alert('Please Specify Company Name');
			return false;
		}
		var cperson = document.getElementById("contact_person");
		var contactperson = cperson.value.trim().length;
		if (contactperson == 0)
		{
			alert('Please Specify Contact Person');
			return false;
		}
		var designate = document.getElementById("designation");
		var designation = designate.value.trim().length;
		if (designation == 0)
		{
			alert('Please Specify Designation');
			return false;
		}
		var email = document.getElementById("email_id");
		var emailid = email.value.trim().length;
		if (emailid == 0)
		{
			alert('Please Specify Email');
			return false;
		}
		var cno = document.getElementById("contact_no");
		var contactno = cno.value.trim().length;
		if (contactno == 0)
		{
			alert('Please Enter Contact Number');
			return false;
		}
		var assign = document.getElementById("assigned_to");
		var assigned = assign.value.trim().length;
		if (assigned == 0)
		{
			alert('Please Enter Assignee');
			return false;
		}
		var sample = document.getElementById("sample_prize");
		var sampleP = sample.value.trim().length;
		if (sampleP == 0)
		{
			alert('Please Enter Sample Price');
			return false;
		}
		var noofS = document.getElementById("no_of_samples");
		var noofsample = noofS.value.trim().length;
		if (noofsample == 0)
		{
			alert('Please Specify No of Samples');
			return false;
		}
		var fup = document.getElementById("follow_up");
		var followup = fup.value.trim().length;
		if (followup == 0)
		{
			alert('Please Specify Follow Up Date');
			return false;
		}
		var specify = document.getElementById("specification");
		var specification = specify.value.trim().length;
		if ((specification == 0)||(specification == null)||(specification == ""))
		{
			alert('Please Specify Specification');
			return false;
		}
	}
	function validate()
	{
		var x=document.forms["form"]["email_id"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<2 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
		  alert("Not a valid e-mail address");
		  return false;
		  }
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8 || charCode==32)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function isNumeric_contact(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8 || charCode==32 || charCode==45 || charCode==47)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 8 || charCode==32)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
</script>