<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
		<script src="js/datepicker/jquery.ui.core.js"></script>
		<script src="js/datepicker/jquery.ui.widget.js"></script>
		<script src="js/datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				$("#purchased").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
				$("#warranty").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
			});
		</script> 
</head>
<section class="grid_6 first">
	<?php
		$Columns = array("id", "divisionid","departmentid","locationid","itemid","itemname","itemdescription","purchasedat","warrantydate","amcperiod","condemned","standby");
		if($_GET['action'] == 'Edit')
		{
			$Assets = mysqli_fetch_assoc(Biomedical_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Assets[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Biomedical_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Biomedical Asset deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				Biomedical_Insert($_POST['divisionid'],$_POST['departmentid'],$_POST['locationid'],$_POST['itemid'],$_POST['itemname'],$_POST['itemdescription'],$_POST['purchasedat'],$_POST['warrantydate'],$_POST['amcperiod'],$_POST['condemned'],$_POST['standby']);
				$message = "<br /><div class='message success'><b>Message</b> : One Biomedical Asset added Added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				Biomedical_Update($_POST['id'],$_POST['divisionid'],$_POST['departmentid'],$_POST['locationid'],$_POST['itemid'],$_POST['itemname'],$_POST['itemdescription'],$_POST['purchasedat'],$_POST['warrantydate'],$_POST['amcperiod'],$_POST['condemned'],$_POST['standby']);
				$message = "<br /><div class='message success'><b>Message</b> : Biomedical details updated successfully</div>";
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation();">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Add Biomedical Assets</h2></header>
				<hr />
				<fieldset>
					<div class="clearfix">
						<label>Division<font color="red">*</font></label>
						<select id="divisionid" name="divisionid" onchange = "Asset_Values(this.value,'')">
							<option value="">Select</option>
							<?php $Select_Division = Biomedical_Select_Division();
							while($Fetch_Division = mysqli_fetch_array($Select_Division))
							{
								if($Fetch_Division['id'] == $_POST['divisionid'])
									echo "<option value='".$Fetch_Division['id']."' selected>".$Fetch_Division['name']."</option>";
								else
									echo "<option value='".$Fetch_Division['id']."'>".$Fetch_Division['name']."</option>";
							} ?>
						</select>
					</div>	
				</fieldset>
				<div id='departmentchange'>
				<input type="hidden" value="" id="departmentid">
				</div>	
				<div id='locationchange'>
				<input type="hidden" value="" id="locationid">
				</div>	
				<fieldset>
					<div class="clearfix">
						<label>Item<font color="red">*</font></label>
						<select id="itemid" name="itemid">
							<option value="">Select</option>
							<?php $Select_items = Biomedical_Select_item_All();
							while($Fetch_item = mysqli_fetch_array($Select_items))
							{
								if($_POST['itemid'])
									echo "<option value='".$Fetch_item['id']."'selected>".$Fetch_item['name']."</option>";
								else
									echo "<option value='".$Fetch_item['id']."'>".$Fetch_item['name']."</option>";
							}
							?>
						</select>
					</div>	
				</fieldset>				
				<fieldset>
					<div class="clearfix">
                        <label>Item Name <font color="red">*</font></label>
						<input type="text" name="itemname" id="itemname"  value="<?php echo $_POST['itemname']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Item Description</label>
						<textarea name="itemdescription"  onkeypress="return isAlphaOrNumeric(event)"><?php echo $_POST['itemdescription']; ?></textarea>
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Purchase Date</label>
						<input type="text" name="purchasedat" id='purchased'  value="<?php echo $_POST['purchasedat']; ?>" />
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Warranty Date<font color="red">*</font></label>
						<input type="text" name="warrantydate" id='warranty'  value="<?php echo $_POST['warrantydate']; ?>" />
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>AMC Period<font color="red">*</font></label>
						<select name="amcperiod">
							<?php
								$amcoptions = array('1 Year','2 Years','3 Years','4 Years','5 Years','Covered Under Warranty');
								foreach($amcoptions as $options)
								{
									if(!$_POST['amcperiod'] && $options=='1 Year')
										echo "<option value='".$options."' selected>".$options."</option>";
									else if($options == $_POST['amcperiod'])
										echo "<option value='".$options."' selected>".$options."</option>";
									else
										echo "<option value='".$options."'>".$options."</option>";
								}
							?>
						</select>
					</div>
				</fieldset>
				<div class="clearfix">
						<label>Condemned<font color="red">*</font></label>
						<?php
						if(!$_POST['condemned'])
							echo '<span class="radio-input"><input type="radio" name="condemned" id="condemned"   value="0" checked>No</input></span>
								<span class="radio-input"><input type="radio" name="condemned" id="condemned" value="1" >Yes</input></span>';
						else
							echo '<span class="radio-input"><input type="radio" name="condemned" id="condemned" value="0" >No</input></span>
								<span class="radio-input"><input type="radio" name="condemned" id="condemned" value="1" checked>Yes</input></span>';		
						?>	
				</div>
				<div class="clearfix">
					<label>Stand By<font color="red">*</font></label>
					<?php
					if(!$_POST['standby'])
						echo '<span class="radio-input"><input type="radio" name="standby" id="standby"  value="0" checked>No</input></span>
							<span class="radio-input"><input type="radio" name="standby" id="standby" value="1" >Yes</input></span>';
					else
						echo '<span class="radio-input"><input type="radio" name="standby" id="standby" value="0" >No</input></span>
							<span class="radio-input"><input type="radio" name="standby" id="standby" value="1"  checked>Yes</input></span>';		
					?>	
				</div>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-green" type="submit" name="Update"  value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-green" type="submit" name="Submit" >Submit</button>&nbsp;&nbsp;';
				?>
				<a href='?page=<?php echo $_GET['page']; ?>' class="button button-gray" type="reset" type="reset">Reset</a>
			</form>
		</div>
	</div>

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Biomedical List
			<?php
			$AssetsTotalRows = mysqli_num_rows(Biomedical_Select_All());
			echo " : No. of total Biomedical Assets - ".$AssetsTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Division Name</th>
						<th align="left">Department Name</th>
						<th align="left">Location Name</th>
						<th align="left">Item</th>
						<th align="left">Item Name</th>
						<th align="left">Item Description</th>
						<th align="left">Purchased Date</th>
						<th align="left">Warranty Date</th>
						<th  align="left">Amc Period</th>
						<th align="left">Condemned</th>
						<th align="left">Stand By</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$AssetsTotalRows)
						echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($AssetsTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$AssetsRows = Biomedical_Select_ByLimit($Start, $Limit);
					$Option = array("No","Yes");
					$rowno = 0;
					if($_GET['pageno']==1)
						$j = 1;
					else
						$j = ($Limit*($_GET['pageno']-1))+1;
					while($Assets = mysqli_fetch_assoc($AssetsRows))
					{
						$PurchasedAt = "";
						echo "<tr>
						<td align='center'>".$j++."</td>";
						$Asset_Name = mysqli_fetch_array(Biomedical_Division_BYId($Assets['divisionid']));
						$Assets_Department = mysqli_fetch_array(Biomedical_DepartmentById($Assets['departmentid']));
						$Assets_Location = mysqli_fetch_array(Biomedical_LocationById($Assets['locationid']));
						$Assets_item = mysqli_fetch_array(Biomedical_itemById($Assets['itemid']));
						if(date('d-m-Y',strtotime($Assets['purchasedat'])) == '01-01-1970')
							$PurchasedAt .= "-";
						else
							$PurchasedAt .= date('d-m-Y',strtotime($Assets['purchasedat']));
						echo 
						"<td>".$Asset_Name['name']."</td>
						<td>".$Assets_Department['name']."</td>
						<td>".$Assets_Location['name']."</td>
						<td>".$Assets_item['name']."</td>
						<td>".$Assets['itemname']."</td>
						<td>".$Assets['itemdescription']."</td>
						<td>".$PurchasedAt."</td>
						<td>".date('d-m-Y',strtotime($Assets['warrantydate']))."</td>
						<td>".$Assets['amcperiod']."</td>
						<td>".$Option[$Assets['condemned']]."</td>
						<td>".$Option[$Assets['standby']]."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Assets['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Assets['id'].")'>Delete</a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>	
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
	<div class="clear">&nbsp;</div>
</section>
<script>
		<?php
	if($_POST['departmentid'])
	{
	?>
		Asset_Values(<?php echo $_POST['divisionid'].','.$_POST['departmentid'];?>);
	
	<?php
	}
	if($_POST['locationid'])
	{
	?>	Asset_Location(<?php echo $_POST['departmentid'].','.$_POST['locationid'];?>);
	<?php
	}
	?>
	function Asset_Values(Division,Department)
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
				document.getElementById('departmentchange').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Assets_Get_Values_Department.php?Division="+Division+"&Department="+Department,true);
		xmlhttp.send();
	}
	function Asset_Location(Department,Location)
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
				document.getElementById('locationchange').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Assets_Get_Values_Location.php?Department="+Department+"&Location="+Location,true);
		xmlhttp.send();
	}
	
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
	}
	function validation()
	{
		var message = "";
		if(document.getElementById('condemned').value == "")
			message = "Please Select a condemned";	
		if(document.getElementById('warranty').value == "")
			message = "Please Enter a Warranty Date";		
		if(document.getElementById('itemname').value == "")
			message = "Please Enter  Item Name";
		if(document.getElementById('itemid').value == "")
			message = "Please select a Item";
		if(document.getElementById('departmentid').value == "")
			message = "Please select a Department";
		if(document.getElementById('divisionid').value == "")
			message = "Please select a Division";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode >= 32)
			return true;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
</script>	