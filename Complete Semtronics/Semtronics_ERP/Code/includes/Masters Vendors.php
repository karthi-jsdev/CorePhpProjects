<section role="main" id="main">
	<?php
		$Columns = array("id", "vendorid", "name", "address", "phonenumber", "email", "contactperson", "categoryid", "creditlimit", "creditperiodid", "leadtime");
		if($_GET['action'] == 'Edit')
		{
			$Vendor = mysql_fetch_assoc(Vendor_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Vendor[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Vendor_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Vendor deleted successfully</div>";
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				Vendor_Insert();
				$message = "<br /><div class='message success'><b>Message</b> : Vendor added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				Vendor_Update();
				$message = "<br /><div class='message success'><b>Message</b> : Vendor details updated successfully</div>";
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" name="vendorform" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<?php
			if($_GET['action'] != 'Edit')
			{
				$FetchVendorId = mysql_fetch_assoc(Select_Vendor());
				$Digits = array("", "0", "00", "000", "0000");
				$VendorNo = "VIN".$Digits[4 - strlen((substr($FetchVendorId['vendorid'], -4))+1)].((substr($FetchVendorId['vendorid'], -4))+1);
				echo '<input type="hidden" name="vendorid" value="'.$VendorNo.'" required="required"/>';
			}
			?>
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add Vendor</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Vendor Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" maxlength="30" autocomplete="off" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphabetic(event)"/> <!-- onkeypress="return isAlphabetic(event)"-->
				</div>
				<div class="clearfix">
					<label>Address <font color="red">*</font></label>
					<textarea id="address" cols="50" rows="2" name="address" maxlength="100" autocomplete="off" required="required"><?php echo $_POST['address']; ?></textarea> <!--onkeypress="return isAlphabetic(event)"-->
				</div>
				<div class="clearfix">
					<label>Phone Num/Mob <font color="red">*</font></label>
					<input type="text" id="phonenumber" name="phonenumber" maxlength="25" autocomplete="off" required="required" value="<?php echo $_POST['phonenumber']; ?>" onkeypress="return isNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Email-Id <font color="red">*</font></label>
					<input type="text" id="email" name="email" required="required" autocomplete="off" value="<?php echo $_POST['email']; ?>" />
				</div>
				<div class="clearfix">
					<label>Contact Person <font color="red">*</font></label>
					<input type="text" id="contactperson" name="contactperson" maxlength="30" autocomplete="off" required="required" value="<?php echo $_POST['contactperson']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Category <font color="red">*</font></label>
					 <table>
						<tbody>
							<tr valign="top">
								<td></td>
								<td>
									<b>Added Category</b>
								</td>
								<td>
								</td>
								<td>
									<b>Available Category</b>
								</td>
							</tr>
							<tr valign="top">
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td>
									<select name="categoryid[]" id="s" size="10" multiple="multiple">
										<?php
										if($_POST['categoryid'] != "")
											$_POST['categoryid'] = explode(".", $_POST['categoryid']);
										
										$AvailableCategory = "";
										$SelectVendorCategory = Select_VendorCategory();
										while($FetchVendorCategory = mysql_fetch_array($SelectVendorCategory))
										{
											if(in_array($FetchVendorCategory['id'], $_POST['categoryid']))
												echo "<option value='".$FetchVendorCategory['id']."'>".$FetchVendorCategory['name']."</option>";
											else
												$AvailableCategory .= "<option value='".$FetchVendorCategory['id']."'>".$FetchVendorCategory['name']."</option>";
										} ?>
									</select>
								</td>
								<td  style="padding-right:10px">									
									<a href="#" class="button button-green" onclick="listbox_moveacross('s', 'd')">&gt;&gt;</a><br />
									<a href="#" class="button button-green" onclick="listbox_moveacross('d', 's')">&lt;&lt;</a>									
								</td>	
								<td style="padding-left:10px">
									<select id="d" size="10" multiple="multiple">
										<?php echo $AvailableCategory; ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>&nbsp;
				<div class="clearfix">
					<label>Credit Limit <font color="red">*</font></label>
					<input type="text" id="creditlimit" name="creditlimit"  maxlength="20" autocomplete="off" required="required" value="<?php echo $_POST['creditlimit']; ?>" onkeypress="return AlphaNumCheck(event)"/>
				</div>
				<div class="clearfix">
					<label>Credit Period <font color="red">*</font></label>
					<select id="creditperiodid" name="creditperiodid">
						<option value="">Select</option>
						<?php
							$SelectCreditPeriod = SelectCreditPeriod();
							while($FetchCreditPeriod = mysql_fetch_array($SelectCreditPeriod))
							{
								if($_POST['creditperiodid'] == $FetchCreditPeriod['id'])
									echo '<option value="'.$FetchCreditPeriod['id'].'" selected>'.$FetchCreditPeriod['period'].' Days</option>';
								else
									echo '<option value="'.$FetchCreditPeriod['id'].'">'.$FetchCreditPeriod['period'].' Days</option>';
							}
						?>
					</select>
					<!--input type="text" id="creditperiodid" name="creditperiodid" required="required" value="<?php echo $_POST['creditperiodid']; ?>" /-->
				</div>
				<div class="clearfix">
					<label>Lead Time <font color="red">*</font></label>
					<input type="text" id="leadtime" name="leadtime" required="required"  autocomplete="off" maxlength="11"  value="<?php echo $_POST['leadtime']; ?>"  onkeypress="return AlphaNumCheck(event)"/>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="selectAll();">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" onclick="selectAll();">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>
				<?php
				$VendorTotalRows = mysql_fetch_assoc(Vendor_Select_Count_All());
				echo "Total No. of Vendors - ".$VendorTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Vendor Id</th>
						<th align="left">Vendor Name</th>
						<th align="left">Category</th>
						<th align="left">Address</th>
						<th align="left">Phone No.</th>
						<th align="left">E-Mail Id</th>
						<th align="left">Cont. Person</th>
						<th align="left">Credit Limit</th>
						<th align="left">Credit Period</th>
						<th align="left">Lead Time</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$VendorTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($VendorTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$VendorRows = Vendor_Select_ByLimit($Start, $Limit);
					while($Vendor = mysql_fetch_assoc($VendorRows))
					{
						$CreditIdExplode = explode('.',$Vendor['categoryid']);
						$FetchCreditPeriod = mysql_fetch_array(FetchCreditPeriodById($Vendor['creditperiodid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Vendor['vendorid']."</td>
							<td>".$Vendor['name']."</td><td>";
							$I = count($CreditIdExplode);
							foreach($CreditIdExplode as $CreditId)	
							{
								$I -= 1;
								$FetchCreditId = mysql_fetch_array(Select_VendorCategoryById($CreditId));
								echo $FetchCreditId['name'];
								if($I)
									echo ',';
							}
						echo "</td><td>".$Vendor['address']."</td>
							<td>".$Vendor['phonenumber']."</td>
							<td>".$Vendor['email']."</td>
							<td>".$Vendor['contactperson']."</td>
							<td>".$Vendor['creditlimit']."</td>
							<td>".$FetchCreditPeriod['period']."</td>
							<td>".$Vendor['leadtime']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Vendor['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a><a href='#' onclick='deleterow(".$Vendor['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function selectAll() 
    {
        selectBox = document.getElementById("s");
        for (var i = 0; i < selectBox.options.length; i++)
             selectBox.options[i].selected = true;
    }
	
	function listbox_move(listID, direction)
	{
		var listbox = document.getElementById(listID);
		var selIndex = listbox.selectedIndex,increment = -1;
		if(-1 == selIndex)
		{
			alert("Please select an option to move.");
			return;
		}
		if (direction == 'up')
			increment = -1;
		else
			increment = 1;
		if ((selIndex + increment) < 0 || (selIndex + increment) > (listbox.options.length - 1))
			return;
		
		var selValue = listbox.options[selIndex].value, selText = listbox.options[selIndex].text;
		listbox.options[selIndex].value = listbox.options[selIndex + increment].value
		listbox.options[selIndex].text = listbox.options[selIndex + increment].text
		listbox.options[selIndex + increment].value = selValue;
		listbox.options[selIndex + increment].text = selText;
		listbox.selectedIndex = selIndex + increment;
	}

	function listbox_moveacross(sourceID, destID)
	{
		var src = document.getElementById(sourceID), dest = document.getElementById(destID);
		for(var count = 0; count < src.options.length; count++)
		{
			if(src.options[count].selected == true)
			{
				var option = src.options[count], newOption = document.createElement("option");
				newOption.value = option.value;
				newOption.text = option.text;
				newOption.selected = true;
				try
				{
					dest.add(newOption, null);
					src.remove(count, null);
				}
				catch (error)
				{
					dest.add(newOption);
					src.remove(count);
				}
				count--;
			}
		}
	}

	function listbox_selectall(listID, isSelect)
	{
		var listbox = document.getElementById(listID);
		for(var count = 0; count < listbox.options.length; count++)
			listbox.options[count].selected = isSelect;
	}
	
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 32) 
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
		if(charCode == 8 || charCode == 32 || charCode==37 || charCode==35  || charCode==39 || charCode==36 || charCode==46 || charCode==9)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode==118 || charCode==120 || charCode==47 || charCode==45 || charCode==37 || charCode==35 || charCode==36 || charCode==46 || charCode==39 || charCode==9)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function validation()
	{
		
		var message = "";
		var mail=/^([a-zA-Z0-9_\.\-]{3,30})+\@(([a-zA-Z0-9\-]{2,50})+\.)+([a-zA-Z0-9]{2,4})+$/;
		/*var Category = document.getElementsByName("categoryid[]");
		var flag = 0;
		for (var i = 0; i< Category.length; i++)
			if(Category[i].checked)
				flag++;*/
		if(document.getElementById("creditperiodid").value == "")
			message = "Please select credit period";
		if(document.getElementById('s').value == "")
			message = "Please select the vendor category";
		if(!mail.test(document.getElementById('email').value))
			message = "Please enter valid-email!";
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
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>");
	}
</script>