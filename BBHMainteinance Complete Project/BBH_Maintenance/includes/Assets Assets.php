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
	<br />
	<?php
		$Columns = array("id", "divisionid","departmentid","locationid","itemid","itemname","itemdescription","connectiontype","purchasedat","warrantydate","amcperiod","condemned","standby","softwareids","ipaddress");
		if($_GET['action'] == 'Edit')
		{
			$Assets = mysqli_fetch_assoc(Assets_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Assets[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Assets_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Assets deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if($_POST['softwareids'])
				$_POST['softwareids'] = implode($_POST['softwareids'], ".");
			if(isset($_POST['Submit']))
			{
				//if($_POST['locationid'] == "undefined")
					//$_POST['locationid']="";
				Assets_Insert($_POST['divisionid'],$_POST['departmentid'],$_POST['locationid'],$_POST['itemid'],$_POST['itemname'],$_POST['itemdescription'],$_POST['connectiontype'],$_POST['purchasedat'],$_POST['warrantydate'],$_POST['amcperiod'],$_POST['condemned'],$_POST['standby'],$_POST['softwareids'],$_POST['ipaddress']);
				$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				//if($_POST['locationid'] == "undefined")
					//$_POST['locationid']="";
				Assets_Update($_POST['id'],$_POST['divisionid'],$_POST['departmentid'],$_POST['locationid'],$_POST['itemid'],$_POST['itemname'],$_POST['itemdescription'],$_POST['connectiontype'],$_POST['purchasedat'],$_POST['warrantydate'],$_POST['amcperiod'],$_POST['condemned'],$_POST['standby'],$_POST['softwareids'],$_POST['ipaddress']);
				$message = "<br /><div class='message success'><b>Message</b> : Assets details updated successfully</div>";
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
				<header><h2>Add Assets</h2></header>
				<hr />
				<fieldset>
					<div class="clearfix">
						<label>Division<font color="red">*</font></label>
						<select id="divisionid" name="divisionid" onchange = "Asset_Values(this.value,'')">
							<option value="">Select</option>
							<?php $Select_Division = Assets_Select_Division();
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
							<?php $Select_items = Assets_Select_item_All();
							while($Fetch_item = mysqli_fetch_array($Select_items))
							{
								if($Fetch_item['id'] == $_POST['itemid'])
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
						<label>IP Address</label>
						<input type="text" name="ipaddress" id='ipaddress'  value="<?php echo $_POST['ipaddress']; ?>" />
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Connection Type<font color="red">*</font></label>
						<?php
						if(!$_POST['connectiontype'])
							echo '<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype"   value="0" checked>none</input></span>
								<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype" value="1" >Standby</input></span>
								<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype" value="2" >Network</input></span>';
						else if(!$_POST['connectiontype']==1)
							echo '<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype"   value="0" >none</input></span>
								<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype" value="1"  checked>Standby</input></span>
								<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype" value="2" >Network</input></span>';
						else
							echo '<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype"   value="0" >none</input></span>
								<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype" value="1" >Standby</input></span>
								<span class="radio-input"><input type="radio" name="connectiontype" id="connectiontype" value="2" checked>Network</input></span>';						
						?>	
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
							echo '<span class="radio-input"><input type="radio" name="condemned" id="condemned"  value="0" checked>No</input></span>
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
						echo '<span class="radio-input"><input type="radio" name="standby" id="standby"   value="0" checked>No</input></span>
							<span class="radio-input"><input type="radio" name="standby" id="standby" value="1" >Yes</input></span>';
					else
						echo '<span class="radio-input"><input type="radio" name="standby" id="standby" value="0" >No</input></span>
							<span class="radio-input"><input type="radio" name="standby" id="standby" value="1"  checked>Yes</input></span>';		
					?>	
				</div>
				<fieldset>
					<div class="clearfix">
						<label>Softwares </label>
						<table>
							<tbody>
								<tr valign="top">
									<td></td>
									<td>
										<b>Installed Softwares</b>
									</td>
									<td></td>
									<td>
										<b>Available Softwares</b>
									</td>
								</tr>
								<tr valign="top">
									<td>&nbsp;&nbsp;&nbsp;</td>
									<td>
										<select name="softwareids[]" id="s" size="10" multiple="multiple">
											<?php
											if($_POST['softwareids'] != "")
												$_POST['softwareids'] = explode(".", $_POST['softwareids']);
											$AvailableSoftwares = "";
											$Softwares = Softwares_Select_All();
											while($Software = mysqli_fetch_assoc($Softwares))
											{
												if(in_array($Software['id'], $_POST['softwareids']))
													echo "<option value='".$Software['id']."'>".$Software['name']."</option>";
												else
													$AvailableSoftwares .= "<option value='".$Software['id']."'>".$Software['name']."</option>";
											} ?>
										</select>
									</td>
									<td>									
										<a href="#" class="button button-green" onclick="listbox_moveacross('s', 'd')">&gt;&gt;</a><br />
										<a href="#" class="button button-green" onclick="listbox_moveacross('d', 's')">&lt;&lt;</a>									
									</td>	
									<td>
										<select id="d" size="10" multiple="multiple">
											<?php echo $AvailableSoftwares; ?>
										</select>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-green" type="submit" name="Update" onclick="selectAll()" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-green" type="submit" name="Submit" onclick="selectAll()">Submit</button>&nbsp;&nbsp;';
				?>
				<a href='?page=<?php echo $_GET['page']; ?>' class="button button-gray" type="reset" type="reset">Reset</a>
			</form>
		</div>
	</div>

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Assets List
			<?php
				if($_GET['Search'])
					$AssetsTotalRows = mysqli_num_rows(Assets_Select_AllBySearch($_GET['Search']));
				else
					$AssetsTotalRows = mysqli_num_rows(Assets_Select_All());	
				echo " : No. of total Assets - ".$AssetsTotalRows;
			?>
			</h3>
			<hr />	
			<input type="text" placeholder="Search" id="Search" name="Search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a></br>&nbsp;		
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
						<th align="left">IP Address</th>
						<th align="left">Connection Type</th>
						<th align="left">Purchased Date</th>
						<th align="left">Warranty Date</th>
						<th  align="left">Amc Period</th>
						<th align="left">Condemned</th>
						<th align="left">Stand By</th>
						<th align="left">Software Application</th>
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
					if($_GET['Search'])
						$AssetsRows = Assets_Select_ByLimitSearch($_GET['Search'],$Start,$Limit);
					else	
						$AssetsRows = Assets_Select_ByLimit($Start, $Limit);
					$Connetciontype = array("none","Standby","Network");
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
						$Asset_Name = mysqli_fetch_array(Asset_Division_BYId($Assets['divisionid']));
						$Assets_Department = mysqli_fetch_array(Assets_DepartmentById($Assets['departmentid']));
						$Assets_Location = mysqli_fetch_array(Assets_LocationById($Assets['locationid']));
						$Assets_item = mysqli_fetch_array(Assets_itemById($Assets['itemid']));
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
						<td>".$Assets['ipaddress']."</td>
						<td>".$Connetciontype[$Assets['connectiontype']]."</td>
						<td>".$PurchasedAt."</td>
						<td>".date('d-m-Y',strtotime($Assets['warrantydate']))."</td>
						<td>".$Assets['amcperiod']."</td>
						<td>".$Option[$Assets['condemned']]."</td>
						<td>".$Option[$Assets['standby']]."</td><td>";
						$Softwares=array();
						$condition="";
						if($Assets['softwareids'])
						{
							$Softwareids = explode(".", $Assets['softwareids']);
							foreach($Softwareids as $Id)
							{
								$condition .= " OR id=".$Id;
							}
						}
						$Softwareselect = Softwares_Select_ById(substr($condition, 3));
						while($Software = mysqli_fetch_assoc($Softwareselect))
						{
							$Softwares[] = $Software['name'];
						}
						if(count($Softwares)==1)
							echo $Softwares[0];
						else
						{
							echo '<a id="show'.$rowno.'" onclick="Software('.$rowno.')">'.$Softwares[0].'..,</a>'.'<a id="hide'.$rowno.'" onclick="hide('.$rowno.')">'.$Softwares[0].'</a>';
							echo "<div id='software".$rowno."'>";
								for($i=1;$i<count($Softwares);$i++)
									echo '<a>'.$Softwares[$i].',</a>';
							echo "</div>";
							$rowno++;
						}
						echo "</td>
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
	function selectAll() 
    {
        selectBox = document.getElementById("s");
        for(var i = 0; i < selectBox.options.length; i++)
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
		if(document.getElementById('connectiontype').value == "")
			message = "Please select a Connection Type";	
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
	for(var i=0; i<<?php echo mysqli_num_rows($AssetsRows);?> ; i++)
	{
		document.getElementById("software"+i).style.display="none";
		document.getElementById("hide"+i).style.display="none";
	}
	function Software(i)
	{
		document.getElementById("show"+i).style.display="none";
		document.getElementById("software"+i).style.display="block";
		document.getElementById("hide"+i).style.display="block";
	}
	function hide(i)
	{
		document.getElementById("software"+i).style.display="none";
		document.getElementById("hide"+i).style.display="none";
		document.getElementById("show"+i).style.display="block";
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
	function Search()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>