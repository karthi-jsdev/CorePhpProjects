<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#followupdate").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
		});
	</script>
</head>
<section role="main" id="main">
	<?php
		$Columns = array("id", "name","address", "email_id", "contact_no", "contact_person1", "designation1", "email_id1", "contact_no1", "contact_person2", "designation2", "email_id2", "contact_no2", "client_category_id", "reference_id","reference_group_id","industry_category_id","add_to_account");
		if($_GET['action'] == 'Edit')
		{
			$Lead = mysqli_fetch_assoc(Lead_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Lead[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Lead_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Lead deleted successfully</div>";
		}
		if($_GET['leadid'])
			$Leads = mysqli_fetch_assoc(Lead_Select_ById());
		if($_POST['Update']=='Comments')
		{
			Leads_Insert();
			$message = "<br /><div class='message success'><b>Message</b> : Comments added successfully</div>";
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			/*if(strlen($_POST['contact_no']) != 10)
				$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
			else
			{*/
				$LeadResource = Lead_Select_ByName();
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($LeadResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Lead already exists</div>";
					else
					{
						Lead_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Lead added successfully</div>";
					}
				}
				else if($_POST['Update']=="Update")
				{
					/*$Lead = mysqli_fetch_assoc($LeadResource);
					if(mysqli_num_rows(Lead_Select_ByName()))
						$message = "<br /><div class='message error'><b>Message</b> : This Lead already exists</div>";
					else
					{*/
						Lead_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Lead details updated successfully</div>";
					//}
				}
			//}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	if(!$_GET['leadid']) 
	{ ?>
	<div class="columns">
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" required="required"/>
			<header><h2>Lead Management</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<div style="padding-left:20em;"><legend>Primary Contact</legend></div><div style="padding-left:40em;margin-top:-15px;"><legend>Secondary Contact</legend></div>
					<label>Company Name <font color="red">*</font><input type="text" id="name" name="name" required="required" autocomplete="off" value= "<?php echo $_POST["name"];?>" onkeypress="return isAlphaOrNumeric(event)"/></label>
					<label>Contact Person Name <font color="red">*</font><input type="text" id="contact_person1" name="contact_person1" required="required" autocomplete="off" value="<?php echo $_POST["contact_person1"]; ?>"onkeypress="return isAlphabetic(event)"/></label>
					<label>Contact Person Name <input type="text" id="contact_person2" name="contact_person2" autocomplete="off" value="<?php echo $_POST["contact_person2"];?>" onkeypress="return isAlphabetic(event)"/></label>
					<label>Client Category <font color="red">*</font>
						<select id="vendor_category_id" name="vendor_category_id">
							<option value="">Select</option>
							<?php
							$SelectClientcategory = SelectClientcategorycode();
							while($FetchClientcategory = mysqli_fetch_array($SelectClientcategory))
							{
								if($FetchClientcategory['id']== $_POST['client_category_id'])
									echo "<option value='".$FetchClientcategory['id']."'selected>".$FetchClientcategory['clientcategory']."</option>";
								else
									echo "<option value='".$FetchClientcategory['id']."'>".$FetchClientcategory['clientcategory']."</option>";
							} ?>
						</select>
					</label>	
				</div>
				<div class="clearfix">
					<label>Address <font color="red">*</font><textarea  maxlength="100" id="address"  name="address" required="required"><?php echo $_POST["address"]; ?></textarea></label>
					<label>Designation <font color="red">*</font><input type="text" id="designation1" name="designation1" required="required" autocomplete="off" value="<?php echo $_POST["designation1"]; ?>"  onkeypress="return isAlphaOrNumeric(event)" /></label>
					<label>Designation <input type="text" id="designation2" name="designation2" autocomplete="off" value="<?php echo $_POST["designation2"]; ?>" onkeypress="return isAlphaOrNumeric(event)"/></label>
					<label>Referred By <font color="red">*</font>
						<select id="reference_id" name="reference_id">
							<option value="">Select</option>
							<?php
								$Selectreferredby = Selectreferredbycode();
								while($Fetchreferredby = mysqli_fetch_array($Selectreferredby))
								{
									if($Fetchreferredby['id']==$_POST['reference_id'])
										echo "<option value='".$Fetchreferredby['id']."'selected>".$Fetchreferredby['reference']."</option>";
									else
										echo "<option value='".$Fetchreferredby['id']."'>".$Fetchreferredby['reference']."</option>";
								}
							?>
						</select>
					</label>
				</div>
				<div class="clearfix">
					<label>Company Email <font color="red">*</font><input type="text" id="email_id" name="email_id" required="required" autocomplete="off" value="<?php echo $_POST["email_id"]; ?>" /></label>
					<label>Contact Person Email <font color="red">*</font><input type="text" id="email_id1" name="email_id1" required="required" autocomplete="off" value="<?php echo $_POST["email_id1"]; ?>" /></label>
					<label>Contact Person Email <input type="text" id="email_id2" name="email_id2" autocomplete="off" value="<?php echo $_POST["email_id2"]; ?>"  /></label>
					<label>Reference<font color="red">*</font>
						<select id="reference_group_id" name="reference_group_id">
							<option value="">Select</option>
							<?php
								$Selectreferredgroupby = Selectreferencegroup();
								while($Fetchreferredgroupby = mysqli_fetch_array($Selectreferredgroupby))
								{
									if($Fetchreferredgroupby['id']==$_POST['reference_group_id'])
										echo "<option value='".$Fetchreferredgroupby['id']."'selected>".$Fetchreferredgroupby['name']."</option>";
									else
										echo "<option value='".$Fetchreferredgroupby['id']."'>".$Fetchreferredgroupby['name']."</option>";
								}
							?>
						</select>
					</label>
				</div>
				<div class="clearfix">
					<label>Phone No. <font color="red">*</font><input type="text" id="contact_no" maxlength="25" name="contact_no" required="required" autocomplete="off" value="<?php echo $_POST["contact_no"];?>" onkeypress="return isNumeric(event,'contact_no')"/></label>
					<label>Contact Person Phone No. <font color="red">*</font><input type="text" id="contact_no1" maxlength="25" name="contact_no1" required="required" autocomplete="off"  value="<?php echo $_POST["contact_no1"];?>"  onkeypress="return isNumeric(event,'contact_no1')"/></label>
					<label>Contact Person Phone No. <input type="text" id="contact_no2" maxlength="25" name="contact_no2" autocomplete="off"  value="<?php echo $_POST["contact_no2"];?>"  onkeypress="return isNumeric(event,'contact_no2')"/></label>
					<label>Industry<font color="red">*</font>
						<select id="industry_category_id" name="industry_category_id">
							<option value="">Select</option>
							<?php
								$Selectindustryby = Selectindustrycode();
								while($Fetchindustryby = mysqli_fetch_array($Selectindustryby))
								{
									if($Fetchindustryby['id']==$_POST['industry_category_id'])
										echo "<option value='".$Fetchindustryby['id']."'selected>".$Fetchindustryby['name']."</option>";
									else
										echo "<option value='".$Fetchindustryby['id']."'>".$Fetchindustryby['name']."</option>";
								}
							?>
						</select>
					</label>
				</div>
				<div>
					<label for="add_to_account">Add To Account <font color="red">*</font></label>
						<?php
							if($_POST['add_to_account'])
								echo '<input type="checkbox" name="add_to_account" id="add_to_account" value="1" checked></input>';
							else
								echo '<input type="checkbox" name="add_to_account" id="add_to_account" value="1"></input>';
						?>
					
				</div>
			</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-green" type="submit" name="Submit">Create Lead</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Cancel</button>			
		</form>
	</div>
	<div class="columns">
			<h3>
				<?php
				if($_GET['Search'])
				{
					$Search = "";
					if(substr($_GET['Search'],0,2)=="LD")
					{
						$RevString = strrev($_GET['Search']);
						$ArrayStrings = str_split($RevString);
						$Array = array();
						for($i = 0;$i<count($ArrayStrings);$i++)
						{
							if((is_numeric($ArrayStrings[$i]) && $ArrayStrings[$i]!=0)  && $ArrayStrings[$i+1]==0)
								$Array[] = $ArrayStrings[$i];
							else if((is_numeric($ArrayStrings[$i]) && $ArrayStrings[$i]!=0)  && $ArrayStrings[$i+1]!=0)
								$Array[] = $ArrayStrings[$i];
							else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]!=0)  && $ArrayStrings[$i]==0)
								$Array[] = $ArrayStrings[$i];
							else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+2]) && $ArrayStrings[$i+2]!=0))
								$Array[] = $ArrayStrings[$i];
							else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+3]) && $ArrayStrings[$i+3]!=0))
								$Array[] = $ArrayStrings[$i];
							else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+4]) && $ArrayStrings[$i+4]!=0))
								$Array[] = $ArrayStrings[$i];
							else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+5]) && $ArrayStrings[$i+5]!=0))
								$Array[] = $ArrayStrings[$i];
						}
						foreach($Array as $A)
							$Search.=$A;
						$Search = strrev($Search);
					}
					else 
						$Search = $_GET['Search'];
					$LeadTotalRows = mysqli_fetch_assoc(Lead_Select_Count_All_Search($Search));
				}
				else
					$LeadTotalRows = mysqli_fetch_assoc(Lead_Select_Count_All());
				echo "<div>Total No. of Leads - ".$LeadTotalRows['total'];
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  "placeholder="Search" id="Search" name="Search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/></div>';
				?>
			</h3>
			<hr />	
			<div style="width: 1000px; overflow-x: auto;" >
			<table class="paginate sortable full" style="width: 2100px;">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Lead No</th>
						<th align="left">Name</th>
						<th align="left">Address</th>
						<th align="left">Email Id</th>
						<th align="left">Phone No.</th>
						<th align="left">Contact Person Name</th>
						<th align="left">Designation</th>
						<th align="left">Email</th>
						<th align="left">Contact Phone</th>
						<th align="left">Contact Person Name</th>
						<th align="left">Designation</th>
						<th align="left">Email</th>
						<th align="left">Contact Phone</th>
						<th align="left">Client Category</th>
						<th align="left">Referred By</th>
						<th align="left">Reference Group</th>
						<th align="left">Industry</th>
						<th align="left">Add To Account</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$_GET['Search'])
					{
						if(!$LeadTotalRows['total'])
							echo '<tr><td colspan="20"><font color="red"><center>No data found</center></font></td></tr>';
						$Limit = 10;
						$total_pages = ceil($LeadTotalRows['total'] / $Limit);
						if(!$_GET['pageno'])
							$_GET['pageno'] = 1;
						
						$i = $Start = ($_GET['pageno']-1)*$Limit;
						$i++;
						$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
						$LeadRows = Lead_Select_ByLimit($Start, $Limit);
						while($Lead = mysqli_fetch_assoc($LeadRows))
						{
							$Clientcategory = mysqli_fetch_array(Client_Category_Name($Lead['client_category_id']));
							$Reference = mysqli_fetch_array(Reference_Name($Lead['reference_id']));
							$ReferenceGroup = mysqli_fetch_array(Reference_GroupName($Lead['reference_group_id']));
							$Industrycategory = mysqli_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
							$Digits = array("","0", "00", "000", "0000", "00000", "000000");
							$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);
							echo "<tr style='valign:middle;'>
								<td align='center'>".$i++."</td>
								<td>".$LDNo."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['address']."</td>
								<td>".$Lead['email_id']."</td>
								<td>".$Lead['contact_no']."</td>
								<td>".$Lead['contact_person1']."</td>
								<td>".$Lead['designation1']."</td>
								<td>".$Lead['email_id1']."</td>
								<td>".$Lead['contact_no1']."</td>
								<td>".$Lead['contact_person2']."</td>
								<td>".$Lead['designation2']."</td>
								<td>".$Lead['email_id2']."</td>
								<td>".$Lead['contact_no2']."</td>
								<td>".$Clientcategory['clientcategory']."</td>
								<td>".$Reference['reference']."</td>
								<td>".$ReferenceGroup['name']."</td>
								<td>".$Industrycategory['name']."</td>";
								if($Lead['add_to_account'] == '1')
									echo "<td>YES</td>";
								else	
									echo "<td>NO</td>";
								echo "<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Lead['id']."&pageno=".$_GET['pageno']."&action=Edit'  title='Lead-edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$Lead['id'].")'  title='Lead-delete'>Delete</a></td>
							</tr>";
						}
					}
					else
					{
						if(!$LeadTotalRows['total'])
							echo '<tr><td colspan="20"><font color="red"><center>No data found</center></font></td></tr>';
						$Limit = 10;
						$total_pages = ceil($LeadTotalRows['total'] / $Limit);
						if(!$_GET['pageno'])
							$_GET['pageno'] = 1;
						
						$i = $Start = ($_GET['pageno']-1)*$Limit;
						$i++;
						$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
						$LeadRows = Lead_Select_ByLimitSearch($Start, $Limit,$Search);
						while($Lead = mysqli_fetch_assoc($LeadRows))
						{
							$Vendorcategory = mysqli_fetch_array(Vendor_Category_Name($Lead['vendor_category_id']));
							$Reference = mysqli_fetch_array(Reference_Name($Lead['reference_id']));
							$ReferenceGroup = mysqli_fetch_array(Reference_GroupName($Lead['reference_group_id']));
							$Industrycategory = mysqli_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
							$Digits = array("","0", "00", "000", "0000", "00000", "000000");
							$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);
							echo "<tr style='valign:middle;'>
								<td align='center'>".$i++."</td>
								<td>".$LDNo."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['address']."</td>
								<td>".$Lead['email_id']."</td>
								<td>".$Lead['contact_no']."</td>
								<td>".$Lead['contact_person1']."</td>
								<td>".$Lead['designation1']."</td>
								<td>".$Lead['email_id1']."</td>
								<td>".$Lead['contact_no1']."</td>
								<td>".$Lead['contact_person2']."</td>
								<td>".$Lead['designation2']."</td>
								<td>".$Lead['email_id2']."</td>
								<td>".$Lead['contact_no2']."</td>
								<td>".$Vendorcategory['name']."</td>
								<td>".$Reference['reference']."</td>
								<td>".$ReferenceGroup['name']."</td>
								<td>".$Industrycategory['name']."</td>";
								if($Lead['add_to_account'] == '1')
									echo "<td>YES</td>";
								else	
									echo "<td>NO</td>";
								echo "<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Lead['id']."&pageno=".$_GET['pageno']."&action=Edit'  title='Lead-Edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$Lead['id'].")'  title='Lead-delete'>Delete</a></td>
							</tr>";
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	if($_GET['Search'])
		$GETParameters = "page=Sales&subpage=spage->Lead,ssubpage->".$_GET['ssubpage']."&Search=".$_GET['Search']."&";
	else
		$GETParameters = "page=Sales&subpage=spage->Lead,ssubpage->".$_GET['ssubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	} 
	else
	{ ?>
	<div class="columns">
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&leadid=".$_GET['leadid']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="leadid" value="<?php echo $_GET['leadid']; ?>" required="required"/>
			<?php 
				if($_GET['leadid'])
				{
					$Leads = mysqli_fetch_assoc(Lead_Select_ById()); 
					$Digits = array("","0", "00", "000", "0000", "00000", "000000");
					$LDNo = "LD".$Digits[6 - strlen($Leads['id'])].($Leads['id']);	
				}
			?>
			<header><h2>Lead Management</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
				<?php
					echo '<label>LeadId: '.$LDNo.'</label>
					<label>Company Name: '.$Leads['name'].'</label>
					<div style="padding-left:20em;"><legend>Primary Contact</legend></div><div style="padding-left:60em;margin-top:-15px;"><legend>Secondary Contact</legend></div>
					<label>Contact Person Name: '.$Leads['contact_person1'].'</label>
					<label>Contact Person Name: '.$Leads['contact_person2'].'</label>';
					$Vendorcategorysummary = mysqli_fetch_array(Vendor_Category_Name_Summary($Leads['vendor_category_id']));
					echo '<label>Vendor Category : '.$Vendorcategorysummary['name'].'</label>
					<label>Address: '.$Leads['address'].'</label>
				</div>
				<div class="clearfix">
					<div style="padding-left:20em;"><label>Designation: '.$Leads['designation1'].'</label></div>
					<label>Designation: '.$Leads['designation2'].'</label>';
					$Referencesummary = mysqli_fetch_array(Reference_Name_Summary($Leads['reference_id']));
				echo '<label>Referred By: '.$Referencesummary['reference'].'</label>
				</div>
				<div class="clearfix">
					<label>Company Email: '.$Leads['email_id'].'</label>
					<label>Contact Person Email: '.$Leads['email_id1'].'</label>
					<label>Contact Person Email: '.$Leads['email_id2'].'</label>';
					$ReferenceGroupsummary = mysqli_fetch_array(Reference_GroupName_Summary($Leads['reference_group_id']));
				echo '<label>Reference: '.$ReferenceGroupsummary['name'].'</label>
				</div>
				<div class="clearfix">
				<label>Phone No. '.$Leads['contact_no'].'</label>
				<label>Contact Person Phone No. '.$Leads['contact_no1'].'</label>
				<label>Contact Person Phone No. '.$Leads['contact_no2'].'</label>';
				$Industrycategorysummary = mysqli_fetch_array(Industrycategory_Name_Summary($Leads['industry_category_id']));
			echo '<label>Industry: '.$Industrycategorysummary['name'].'</label>
			</div>';
			if($Leads['id'])
			{
				echo '<label>Comment:<font color="red">*</font>
						<textarea style="width: 450px; height: 100px;" name="comments" id="comments" ></textarea>
					</label><br /><br /><br /><br /><br /><br /><br /><br /><br />
					<label>Follow-Up-Date: <font color="red">*</font>
						<input type="text" name="followupdate" id="followupdate" onkeypress="return false"></input>
					</label>
					<br /><button class="button button-green" type="submit" name="Update" value="Comments">Update</button>&nbsp;&nbsp;
					<button class="button button-gray" type="reset">Cancel</button>
					<a href="?page=Sales&subpage=spage->Lead,ssubpage->Lead_Summary" class="button button-green" name="back" value="back">Back</a>';	
			} ?>
		</form>
	<h3>
		<?php
		$LeadcommentsTotalRows = mysqli_fetch_assoc(Leadcomments_Select_Count_All());
		echo "No. of Updates - ".$LeadcommentsTotalRows['total'];
		?>
	</h3>
	<hr />	
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Commented-Date</th>
				<th align="left">Comments</th>
				<th align="left">Follow-Up-Date</th>
				<th align="left">Updated By</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$LeadcommentsTotalRows['total'])
				echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$total_pages = ceil($LeadcommentsTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$LeadcommentsRows = Leadcomments_Select_ByLimit($Start, $Limit);
			while($LeadComments = mysqli_fetch_assoc($LeadcommentsRows))
			{
				$Updatedby = mysqli_fetch_array(UpdatedBy_Name($LeadComments['updatedby']));
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>
					<td>".$LeadComments['commentsdate']."</td>
					<td>".$LeadComments['comments']."</td>
					<td>".$LeadComments['followupdate']."</td>
					<td>".$Updatedby['name']."</td>
					</tr>";
			} ?>
		</tbody>
	</table>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	if($_GET['Search'])
		$GETParameters = "page=Sales&subpage=spage->Lead,ssubpage->".$_GET['ssubpage']."&Search=".$_GET['Search']."&leadid=".$_GET['leadid']."&";
	else
		$GETParameters = "page=Sales&subpage=spage->Lead,ssubpage->".$_GET['ssubpage']."&leadid=".$_GET['leadid']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	} ?>
</section>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 36 || charCode == 45 || charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt,id)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 36 || charCode == 45 || charCode == 46 || charCode == 47)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	
	
	function validation()
	{
		var message = "";
		var mail=/^([a-zA-Z0-9_\.\-]{3,30})+\@(([a-zA-Z0-9\-]{2,50})+\.)+([a-zA-Z0-9]{2,4})+$/;
		<?php if($Leads['id'])
		{ ?>
		if(document.getElementById("followupdate").value.length == "")
			message = "Please select the followupdate";
		if(document.getElementById("comments").value.length == 0)
			message = "Please enter the comments";
		<?php } 
		else
		{
		?>
		if(document.getElementById("industry_category_id").value == "")
			message = "Please select the industry";
		if(document.getElementById("reference_group_id").value == "")
			message = "Please select the reference group";
		/* if(document.getElementById("contact_no2").value.length < 10)
			message = "Contact number is not valid"; */
		if(document.getElementById("reference_id").value == "")
			message = "Please select the reference name";
		/* if(!mail.test(document.getElementById('email_id2').value))
			message = "Please enter valid-contact person email!";*/
		if(!mail.test(document.getElementById('email_id1').value))
			message = "Please enter valid-contact person email!";		
		if(!mail.test(document.getElementById('email_id').value))
			message = "Please enter valid-company email!";	
		/* if(document.getElementById("designation2").value.length ==0)
			message = "Please enter the designation"; */
		if(document.getElementById("contact_person1").value.length ==0)
			message = "Please enter the contact person";
		if(document.getElementById("contact_no1").value.length < 10)
			message = "Contact number is not valid";
		if(document.getElementById("designation1").value.length ==0)
			message = "Please enter the designation";
		if(document.getElementById("vendor_category_id").value=="")
			message = "Please select the Client Category";
		/* if(document.getElementById("contact_person2").value.length ==0)
			message = "Please enter the contact person"; */
		if(document.getElementById("contact_no").value.length < 10)
			message = "Phone number is not valid";
		if(document.getElementById("address").value.length < 4 || document.getElementById("address").value.length >100)
			message = "Address should be within 4 to 50 characters";	
		if(document.getElementById("address").value.length == 0)
			message = "Please enter the address";
		if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 25)
			message = "Company name should be within 4 to 25 characters";
		if(document.getElementById("name").value.length == 0)
			message = "Please enter the company name";	
		<?php } ?>
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}

	function checkEmail(id) 
	{
		var email = document.getElementById(id);
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,4})+\.)+([a-zA-Z0-9]{2,4})+$/;

		if(!filter.test(email.value)) 
		{
			alert('Please provide a valid email address');
			email.focus;
			return false;
		}
	}
	
	function Search()
	{
		document.location.assign("index.php?page=Sales&subpage=spage->Lead,ssubpage-><?php echo $_GET['ssubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>