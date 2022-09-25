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
		});
	</script>
	<?php
	if($_GET['id']&&$_GET['action']=="delete")
	{
		Opportunity_Delete();
		echo "<br /><div class='message error'><b>Message</b> : Opportunity Deleted Successfully</div>";
	}
	if(isset($_POST['Submit']))
	{
		if(empty($_POST['lead_id'])||empty($_POST['description'])||empty($_POST['product_id'])||empty($_POST['quantity'])||empty($_POST['date'])||empty($_POST['company'])||empty($_POST['contact_person'])||empty($_POST['designation'])||empty($_POST['email_id'])||empty($_POST['contact_no']))
			echo "<br /><div class='message error'><b>Message</b> : Mandatory Fields should not be empty</div>";
		else
		{
			Opportunity_Create();
			echo "<br /><div class='message success'><b>Message</b> : Opportunity Created Successfully</div>";
			$_POST['product_id']="";$_POST['product_category_id']="";$_POST['lead_id']="";$_POST['description']="";$_POST['quantity']="";$_POST['date']="";
			$_POST['product_subcategory_id'] ="";$_POST['others']="";$_POST['company']="";$_POST['contact_person']="";$_POST['designation']="";$_POST['email_id']="";$_POST['contact_no']="";
		}
	}
	if($_GET['id'] && $_GET['action']=="edit")
	{
		$Opportunity_Edit = mysql_fetch_assoc(Opportunity_Item_Edit());
		$_POST['id'] = $Opportunity_Edit['id']; $_POST['product_id'] = $Opportunity_Edit['pid'];
		$_POST['product_category_id'] = $Opportunity_Edit['pcid']; $_POST['product_subcategory_id'] = $Opportunity_Edit['pscid'];
		$_POST['lead_id'] = $Opportunity_Edit['lead_id']; $_POST['description'] = $Opportunity_Edit['opp_description'];
		$_POST['quantity'] = $Opportunity_Edit['quantity']; $_POST['date'] = $Opportunity_Edit['date'];
		$_POST['company'] = $Opportunity_Edit['company']; $_POST['contact_person'] = $Opportunity_Edit['contact_person'];
		$_POST['designation'] = $Opportunity_Edit['designation']; $_POST['email_id'] = $Opportunity_Edit['email_id'];
		$_POST['contact_no'] = $Opportunity_Edit['contact_no']; $_POST['others'] = $Opportunity_Edit['others'];
	}
	if((isset($_POST['Update']))&&!$_POST['Submit'])
	{
		if(empty($_POST['lead_id'])||empty($_POST['description'])||empty($_POST['product_id'])||empty($_POST['quantity'])||empty($_POST['date'])||empty($_POST['company'])||empty($_POST['contact_person'])||empty($_POST['designation'])||empty($_POST['email_id'])||empty($_POST['contact_no']))
			echo "<br /><div class='message error'><b>Message</b> : Mandatory Fields should not be empty</div>";
		else
		{
			Opportunity_Update();
			$_POST['product_id']="";$_POST['product_category_id']="";$_POST['lead_id']="";$_POST['description']="";$_POST['quantity']="";$_POST['date']="";
			$_POST['product_subcategory_id'] ="";$_POST['others']="";$_POST['company']="";$_POST['contact_person']="";$_POST['designation']="";$_POST['email_id']="";$_POST['contact_no']="";
			echo "<br /><div class='message success'><b>Message</b> : Opportunity Updated Successfully</div>";
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
					$Work = mysql_fetch_assoc(Workid());
					$Work_id = $Work['id'];
					$Work_id = ++$Work_id; 
					if(strlen($Work_id)==0)
						echo "<br/><strong>WK0000001</strong>";
					if(strlen($Work_id)==1)
						echo "<br/><strong>WK000000".$Work_id.'</strong>';
					else if(strlen($Work_id)==2)
						echo "<br/><strong>WK00000".$Work_id.'</strong>';
					else if(strlen($Work_id)==3)
						echo "<br/><strong>WK0000".$Work_id.'</strong>';
					else if(strlen($Work_id)==4)
						echo "<br/><strong>WK000".$Work_id.'</strong>';
					else if(strlen($Work_id)==5)
						echo "<br/><strong>WK00".$Work_id.'</strong>';
					else if(strlen($Work_id)==6)
						echo "<br/><strong>WK0".$Work_id.'</strong>';
					else if(strlen($Work_id)==7)
						echo "<br/><strong>WK".$Work_id.'</strong>';
					?>
					</label>
					<label>
						<strong>Lead Name</strong><font color="red">*</font>
						<?php $leadname = Lead_selection(); ?>
						<select name="lead_id" id="lead_id">
							<option value="Select">Select</option>
							<?php
							while($lead_name = mysql_fetch_assoc($leadname))
							{
								if($lead_name['id']==$_POST['lead_id'])
									echo'<option value="'.$lead_name['id'].'" selected>'.$lead_name['name'].'</option>';
								else
									echo'<option value="'.$lead_name['id'].'">'.$lead_name['name'].'</option>';
							} ?>
						</select>
					</label>
					<!--label>
						<strong>Product Category</strong><font color="red">*</font>
						<?php //$product_category = Product_Category(); ?>
						<select name="product_category_id" id="product_category_id" onchange="product_subcategory();">
							<option value="Select">Select</option>
							<?php
							/* while($productcategory = mysql_fetch_assoc($product_category))
							{
								if($_POST['product_category_id']==$productcategory['id'])
									echo '<option value="'.$productcategory['id'].'" selected>'.$productcategory['name'].'</option>';
								else
									echo '<option value="'.$productcategory['id'].'">'.$productcategory['name'].'</option>';
							}  */?>
						</select>
					</label>
					<label>
						<strong>Product Sub-Category</strong>
						<?php //$product_subcatvalue = Product_subcategory_Edit();?>
						<select name="product_subcategory_id" id="product_subcategory_id" onchange="product();">
							<option value="Select">Select</option>
							<?php 
							/* if($_GET['id'])
							{
								while($product_subvalue = mysql_fetch_assoc($product_subcatvalue))
								{
									if($_POST['product_subcategory_id']==$product_subvalue['pscid'])
										echo '<option value="'.$product_subvalue['pscid'].'" selected>'.$product_subvalue['name'].'</option>';
									else
										echo '<option value="'.$product_subvalue['pscid'].'">'.$product_subvalue['name'].'</option>';
								}
							} */ ?>
						</select>
					</label-->
					<label>
						<strong>Product</strong><font color="red">*</font>
						<?php $product_value = Product();?>
						<select name="product_id" id="product_id">
							<option value="Select">Select</option>
							<?php
							while($product_values = mysql_fetch_assoc($product_value))
							{
								if($_GET['id'] && $_POST['product_id']==$product_values['id'])
									echo '<option value="'.$product_values['id'].'" selected>'.$product_values['productcode'].'</option>';
								else
									echo '<option value="'.$product_values['id'].'">'.$product_values['productcode'].'</option>';
							}
							?>
						</select>
					</label>
					<label><strong>Other New Product</strong>
					<input type="text" autocomplete="off" id="others" name="others" maxlength="20" value="<?php if($_POST['Submit'])
																				$_POST['others']="";
																			else
																				echo $_POST['others'];  ?>"/></label>
					</div>
					<div class="clearfix">
					<label><strong>Quantity</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="quantity" maxlength="6" name="quantity" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['quantity']="";
																									else
																										echo $_POST['quantity']; 
																								?>" onkeypress="return isNumeric(event)"/></label>
					<label><strong>Expected Date</strong><font color="red">*</font>
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
				</div>
				<div class="clearfix">
					<label><strong>Designation</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="designation" name="designation" required="required" value="<?php
																										if($_POST['Submit'])
																											$_POST['designation']="";
																										else
																											echo $_POST['designation'];
																										?>" onkeypress="return isAlphabetic(event)"/></label> 
					<label><strong>E-mail Id</strong><font color="red">*</font>
					<input type="text" autocomplete="off" id="email_id" name="email_id" required="required" value="<?php  
																								if($_POST['Submit'])
																									$_POST['email_id']="";
																								else
																									echo $_POST['email_id'];				
																								?>"/></label>
					<label><strong>Contact No.</strong><font color="red">*</font>
					<input type="text" autocomplete="off" maxlength="25" id="contact_no" name="contact_no" required="required" value="<?php 
																									if($_POST['Submit'])
																										$_POST['contact_no']="";
																									else
																										echo $_POST['contact_no'];
																									?>" onkeypress="return isNumeric_contact(event)"/></label>
					<label>
						<strong>Description</strong><font color="red">*</font>
						<textarea name="description" maxlength="120" id="description" rows="2" cols="40"><?php
																							if($_POST['Submit'])
																								$_POST['description']="";
																							else
																								echo $_POST['description'];
																							?></textarea>
					</label>
				</div>
				<div class="clearfix">
					<?php
					if($_GET['action']=="edit")
						echo '<input class="button button-green" type="submit" name="Update" value="Update" onclick="return vali_date();">&nbsp;&nbsp;';
					else
						echo '<input class="button button-green" type="submit" name="Submit" value="Create Opportunity" onclick="return vali_date();">&nbsp;&nbsp;';
					echo '<button class="button button-gray" type="RESET" name="reset">Reset</button>&nbsp;&nbsp;';
					?>
				</div>
			</fieldset>
		</form>
	</div>
</section>
<table class="paginate sortable full">
	<thead>
		<tr>
			<th>Work</th>
			<th>Lead Name</th>
			<th>Product Name</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Date</th>
			<th>Contact</th>
			<th>Designation</th>
			<th>E-Mail</th>
			<th>Contact_No.</th>
			<th>Company</th>
			<th>Action</th>
		</tr>
	</thead>
	<form action="" method="POST" onsubmit="return SearchEmpty();">
		<div style="float:right">
			<input type="text" value="<?php if(isset($_POST['contentSearch'])) echo $_POST['contentSearch'];else echo $_GET['contentSearch'];?>" name="contentSearch" autocomplete="off" id="contentSearch">
			<button name="search" style="border:0px;background:none;"><img src="images/search.png"></button>
		</div>
	</form><br/>
	<?php
	if($_POST['contentSearch'] || $_GET['contentSearch'])
	{
		if(!$_POST['contentSearch'])
		{
			$_POST['contentSearch']=$_GET['contentSearch'];
		}
		$totaldata = mysql_fetch_assoc(Opportunity_Search_Count());
	}
	else
		$totaldata = mysql_fetch_assoc(Opportunity_Item_List_Count());
	$Limit = 5;
	
	if(!$totaldata['total'])
		echo'<tr><td style="color:#FF0000;" colspan="11"><center>No data Found</center></td></tr>';
	$total_pages = ceil($totaldata['total'] / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
	if($_POST['contentSearch']=="")
	{
		$opportunity_list = Opportunity_Item_List($Start,$Limit);
		while($list = mysql_fetch_assoc($opportunity_list))
		{
			//$Work_display = mysql_fetch_assoc(Workid());
			$Work_d = $list['id'];
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
			echo '<tbody>
					<tr>
						<td>'.$work.'</td>
						<td>'.$list['name'].'</td>
						<td>'.$list['description'].'</td>
						<td>'.wordwrap($list['opp_description'], 25, "\n", true).'</td>
						<td>'.$list['quantity'].'</td>
						<td>'.date("d-m-Y",strtotime($list['date'])).'</td>
						<td>'.$list['contact_person'].'</td>
						<td>'.$list['designation'].'</td>
						<td>'.$list['email_id'].'</td>
						<td>'.$list['contact_no'].'</td>
						<td>'.wordwrap($list['company'],15,"\n",true).'</td>
						<td width="6%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity&id='.$list['id'].'&action=edit" class="action-button" title="user-edit"><span class="user-edit"></span></a>&nbsp;<a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity&id='.$list['id'].'&action=delete" onclick="return delete_data()" class="action-button" title="user-delete"><span class="user-delete"></span></a>&nbsp;</td>
					</tr>
				</tbody>';
		}
	}
	if((isset($_POST['contentSearch']))||$_GET['contentSearch'])
	{
		$opportunity_search = Opportunity_Search($Start,$Limit);
		while($search = mysql_fetch_assoc($opportunity_search))
		{
			$Work_d = $search['id'];
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
						<td>'.$work.'</td>
						<td>'.$search['name'].'</td>
						<td>'.$search['description'].'</td>
						<td>'.wordwrap($search['opp_description'], 25, "\n", true).'</td>
						<td>'.$search['quantity'].'</td>
						<td>'.date("d-m-Y",strtotime($search['date'])).'</td>
						<td>'.$search['contact_person'].'</td>
						<td>'.$search['designation'].'</td>
						<td>'.$search['email_id'].'</td>
						<td>'.$search['contact_no'].'</td>
						<td>'.wordwrap($search['company'],15,"\n",true).'</td>
						<td width="6%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity&id='.$search['id'].'&action=edit" class="action-button" title="user-edit"><span class="user-edit"></span></a>&nbsp;<a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity&id='.$search['id'].'&action=delete" onclick="return delete_data()" class="action-button" title="user-delete"><span class="user-delete"></span></a></td>
					</tr>
				</tbody>';
		}
	} ?>
</table>
<?php
	$GETParameters = "page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity&contentSearch=".$_POST['contentSearch']."&";
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
			window.location.assign("?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity");
			return false;
		}
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
	function delete_data()
	{
		return  confirm("Are You Sure Want to Delete?");
	}
	function vali_date()
	{
		if(document.getElementById('lead_id').selectedIndex == 0)
		{
			alert("Please Select Lead");
			return false;
		}
		if(document.getElementById('description').value == ""||document.getElementById('description').value ==null)
		{
			alert("Please Write Description");
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
		var qty = document.getElementById("quantity");
		var quantity = qty.value.trim().length;
		if (quantity == 0)
		{
			alert('Please Specify Quantity');
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
		var cno = document.getElementById("contact_no");
		var contactno = cno.value.trim().length;
		if (contactno == 0)
		{
			alert('Please Enter Contact Number');
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