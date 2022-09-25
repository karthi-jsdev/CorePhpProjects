<?php
	$Columns = array("id", "vendorid","rawmaterialid");
	if($_GET['action'] == 'Edit')
	{
		$Rawmaterials = mysql_fetch_assoc(Rawmaterials_Select_ById($_GET['id']));
		foreach($Columns as $Col)
			$_POST[$Col] = $Rawmaterials[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Rawmaterials_Delete_ById($_GET['id']);
		$message = "<br /><div class='message success'><b>Message</b> : One Rawmaterials deleted successfully</div>";
	}	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		if($_POST['rawmaterialid'])
			$_POST['rawmaterialid'] = implode($_POST['rawmaterialid'], ".");
		$RawmaterialResourse = Rawmaterial_Select_Byvendor();
		if(isset($_POST['Submit']))
		{	if(mysql_num_rows($RawmaterialResourse))
				$message = "<br /><div class='message error'><b>Message</b> : Vendor already exists</div>";
			else
			{
				Rawmaterials_Insert();
				$message = "<br /><div class='message success'><b>Message</b> : Rawmaterials Assigned successfully</div>";
			}
		}
		else if(isset($_POST['Update']))
		{
			$Vendor = mysql_fetch_assoc($RawmaterialResourse);
			if(mysql_num_rows(Rawmaterial_Select_Byvendor_ById()))
				$message = "<br /><div class='message error'><b>Message</b> : This Vendor already exists</div>";
			else
			{
				Rawmaterials_Update();
				$message = "<br /><div class='message success'><b>Message</b> : Rawmaterials details updated successfully</div>";
			}
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	}
?>
<section>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Assign Raw Material</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Vendor Name <font color="red">*</font></label>
					<select  id="vendorid"  name="vendorid">
						<option value=''>Select</option>
						<?php
							$VendorSection = Vendormaterial_Section();
							while($VendorMaterial = mysql_fetch_array($VendorSection))
							{
								if($VendorMaterial['id'] == $_POST['vendorid'])
									echo '<option value="'.$VendorMaterial['id'].'" selected>'.$VendorMaterial['name'].'</option>';
								else
									echo '<option value="'.$VendorMaterial['id'].'">'.$VendorMaterial['name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix" id ="part">
					<input type="radio" name="detect"  id="code" value="code" checked>Code<br/><br/>
					<input type="radio" name="detect"  id="partnumber" value="partnumber">Partnumber
				</div>
			</fieldset>
			<fieldset>
				<div class="clearfix">
					<label>Raw Materials <font color="red">*</font></label>
					<table>
						<tbody>
						<tr>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td colspan='2'>
								<input type="text" name="searchmaterials" id="searchmaterials" onkeyup="searchmaterial(this.value)"></input>
							</td>	
						</tr>
							<tr valign="top">
								<td></td>
								<td>
									<b>Assigned Raw Materials</b>
								</td>
								<td></td>
								<td>
									<b>Available Raw Materials</b>
								</td>
							</tr>
								
							<tr valign="top">
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td id="removedmaterial">
									<select name="rawmaterialid[]" id="s" size="10" multiple="multiple">
										<?php
										if($_POST['rawmaterialid'] != "")
											$_POST['rawmaterialid'] = explode(".", $_POST['rawmaterialid']);
										$AvailableMaterials = "";
										$Material = Materials_Select_All();
										while($Materials = mysql_fetch_assoc($Material))
										{
											if(in_array($Materials['id'], $_POST['rawmaterialid']))
												echo "<option value='".$Materials['id']."'>".$Materials['materialcode']."-".$Materials['description']."</option>";
											else
												$AvailableMaterials .= "<option value='".$Materials['id']."'>".$Materials['materialcode']."-".$Materials['description']."</option>";
										} ?>
									</select>
								</td>
								<td>
									<a href="#" class="button button-green" onclick="listbox_moveacross('s', 'd')">Remove&gt;&gt;</a><br />
									<a href="#" class="button button-green" onclick="listbox_moveacross('d', 's')">Add &lt;&lt;</a>									
								</td>
								<td id="assignedrawmaterial">
									<select id="d" size="10" multiple="multiple">
										<?php echo $AvailableMaterials; ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</fieldset>
			<?php 
			if($_GET['action']!='Edit')
				echo '<button class="button button-green" type="submit" name="Submit"  value="Submit" onclick="selectAll()">Save</button>';
			else	
				echo '<button class="button button-green" type="submit" name="Update"  value="Update" onclick="selectAll()">Update</button>';
			?>	
			<hr />		
		</form>
	</div>
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>
			<?php
			if($_GET['Search'])
				$RawmaterialsTotalRows = mysql_num_rows(Rawmaterials_Select_AllBySearch($_GET['Search']));
			else
				$RawmaterialsTotalRows = mysql_num_rows(Rawmaterials_Select_All());
			echo "Total No. of Raw Materials Assigned List -".$RawmaterialsTotalRows;
			?>
			</h3>
			<hr />	

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" placeholder="Search" autocomplete="off" id="Search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="button button-orange"  onclick="Search()">Search</a>	<br/>		<br/>
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Vendor Name</th>
						<th align="left">Material Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
				if(!$_GET['Search'])
				{
					if(!$RawmaterialsTotalRows)
						echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($RawmaterialsTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;	
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$RawmaterialsRow = Rawmaterials_Select_ByLimit($Start, $Limit);	
					$rowno = 0;
					if($_GET['pageno']==1)
						$j = 1;
					else
						$j = ($Limit*($_GET['pageno']-1))+1;
					while($Rawmaterials = mysql_fetch_assoc($RawmaterialsRow))
					{
						echo "<tr>
						<td width='10%' align='center'>".$j++."</td>";
						$Vendors_Name = mysql_fetch_array(Rawmaterialvendor_BYId($Rawmaterials['vendorid']));
						$Rawmaterial_Name = mysql_fetch_array(Rawmaterial_BYId($Rawmaterials['rawmaterialid']));						
						echo "<td width='20%'>".$Vendors_Name['name']."</td><td width='50%'>";
						$rawmaterialid = explode(".", $Rawmaterials['rawmaterialid']);
						$Allrawmaterials = array();
						if($Rawmaterials['rawmaterialid'])
						{
							foreach($rawmaterialid as $Id)
							{
								$Rawmaterial = mysql_fetch_assoc(Rawmaterialsassignment_Select_ById($Id));
								$Allrawmaterials[] = $Rawmaterial['materialcode'];
							}
						}	
						if(count($Allrawmaterials)==1)
							echo $Allrawmaterials[0];
						else
						{
							echo "<div id='Rawmaterial".$rowno."'>";
								for($i=1;$i<count($Allrawmaterials);$i++)
									echo $Allrawmaterials[$i].',';
							echo "</div>".$Allrawmaterials[0].'<a id="show'.$rowno.'" onclick="Rawmaterialshow('.$rowno.')">,...</a>'.'<a id="hide'.$rowno.'" onclick="hide('.$rowno.')">,...</a>';
							$rowno++;
						}
						echo "</td>
						<td  width='20%'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Rawmaterials['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span> </a> | <a href='#' onclick='deleterow(".$Rawmaterials['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					}
				}
				else
				{
					if(!$RawmaterialsTotalRows)
						echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($RawmaterialsTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;	
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$RawmaterialsRow = Rawmaterials_Select_ByLimitSearch($Start, $Limit,$_GET['Search']);	
					$rowno = 0;
					if($_GET['pageno']==1)
						$j = 1;
					else
						$j = ($Limit*($_GET['pageno']-1))+1;
					if(mysql_num_rows(Rawmaterials_Select_ByLimitSearch($Start, $Limit,$_GET['Search'])))
					{
						while($Rawmaterials = mysql_fetch_assoc($RawmaterialsRow))
						{
							echo "<tr>
							<td width='10%' align='center'>".$j++."</td>";
							$Vendors_Name = mysql_fetch_array(Rawmaterialvendor_BYId($Rawmaterials['vendorid']));
							$Rawmaterial_Name = mysql_fetch_array(Rawmaterial_BYId($Rawmaterials['rawmaterialid']));						
							echo "<td width='20%'>".$Vendors_Name['name']."</td><td width='50%'>";
							$rawmaterialid = explode(".", $Rawmaterials['rawmaterialid']);
							$Allrawmaterials = array();
							if($Rawmaterials['rawmaterialid'])
							{
								foreach($rawmaterialid as $Id)
								{
									$Rawmaterial = mysql_fetch_assoc(Rawmaterialsassignment_Select_ById($Id));
									$Allrawmaterials[] = $Rawmaterial['materialcode'];
								}
							}	
							if(count($Allrawmaterials)==1)
								echo $Allrawmaterials[0];
							else
							{
								echo "<div id='Rawmaterial".$rowno."'>";
									for($i=1;$i<count($Allrawmaterials);$i++)
										echo $Allrawmaterials[$i].',';
								echo "</div>".$Allrawmaterials[0].'<a id="show'.$rowno.'" onclick="Rawmaterialshow('.$rowno.')">,...</a>'.'<a id="hide'.$rowno.'" onclick="hide('.$rowno.')">,...</a>';
								$rowno++;
							}
							echo "</td>
							<td width='20%'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Rawmaterials['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span> </a> | <a href='#' onclick='deleterow(".$Rawmaterials['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
							</tr>";
						}
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
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&Search=".$_GET['Search']."&";
	else
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>	
<script>
	$('#part').change(function()
	{
		partoptions($('input[name=detect]:checked').val());
	});
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
	for(var i=0; i<<?php echo mysql_num_rows($RawmaterialsRow);?> ; i++)
	{
		document.getElementById("Rawmaterial"+i).style.display="none";
		document.getElementById("hide"+i).style.display="none";
	}
	function Rawmaterialshow(i)
	{
		document.getElementById("show"+i).style.display="none";
		document.getElementById("Rawmaterial"+i).style.display="block";
		document.getElementById("hide"+i).style.display="block";
	}
	function hide(i)
	{
		document.getElementById("Rawmaterial"+i).style.display="none";
		document.getElementById("hide"+i).style.display="none";
		document.getElementById("show"+i).style.display="block";
	}
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&id="+id+"&action=Delete");
	}
	
	function partoptions(option)
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
				document.getElementById("assignedrawmaterial").innerHTML = results ;
				document.getElementById("removedmaterial").innerHTML = '<select name="rawmaterialid[]" id="s" size="10" multiple="multiple"></select>';
			}
		}
		xmlhttp.open("GET","includes/Material_Get_partnumber.php?option="+option,true);
		xmlhttp.send();
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("s").value==0)
			message = "Please Select the Raw Material";
		if(document.getElementById("vendorid").value==0)
			message = "Please Select the Vendor Name";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	
	function searchmaterial(search)
	{	
		var Code = "", part = "";
		if(document.getElementById('code').checked)
			Code = document.getElementById('code').value;
		if(document.getElementById('partnumber').checked)
			part = document.getElementById('partnumber').value;
	
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
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var results = xmlhttp.responseText;
				document.getElementById("d").innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/Searchmaterial.php?search="+search+"&Code="+Code+"&part="+part,true);
		xmlhttp.send();
	}	
	function Search()
	{
		//alert(document.getElementById("Search").value);
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
		//document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo$_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>