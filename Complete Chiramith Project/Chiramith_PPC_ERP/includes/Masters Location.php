<section class="first">
	<?php
		$Columns = array("id", "name", "section_id", "subsection_id", "location_reference_id");
		if($_GET['action'] == 'Edit')
		{
			$Locaion = mysql_fetch_assoc(Location_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Locaion[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Location_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Location deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$FetchLocation = Select_Location();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($FetchLocation))
					$message = "<br /><div class='message error'><b>Message</b> : This Location already exists</div>";
				else
				{
					Location_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Location added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Locaion = mysql_fetch_assoc($FetchLocation);
				if(mysql_num_rows(Select_LocationNameById()))
					$message = "<br /><div class='message error'><b>Message</b> : This Location already exists</div>";
				else
				{
					Location_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Location details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
				<header><h2>Location Master</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Location Name <font color="red">*</font></label>
						<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>&nbsp;&nbsp; Eg.:AA001
                    </div>
					<div class="clearfix">
                        <label>Section <font color="red">*</font></label>
						<select  id="section_id"  name="section_id" onchange="SubSection(this.value,'')">
							<option value=''>Select</option>
							<?php
								$SelectSection = Master_Section();
								while($FetchSection = mysql_fetch_array($SelectSection))
								{
									if($FetchSection['id'] == $_POST['section_id'])
										echo '<option value="'.$FetchSection['id'].'" selected>Section '.$FetchSection['name'].'</option>';
									else
										echo '<option value="'.$FetchSection['id'].'">Section '.$FetchSection['name'].'</option>';
								}
							?>
						</select>
                    </div>
					<div id='subsection'>
						<input id="subsection_id" type="hidden" value="" /></div>
					<div id='locationreference'>
						<input id="location_reference_id" type="hidden" value="" />
					</div>
				</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-blue" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-blue" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Reset</button>
			</form>
		</div>
	</div>

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Location List
				<?php
				$LocationTotalRows = mysql_fetch_assoc(Location_Select_Count_All());
				echo " : No. of total Location - ".$LocationTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Location Name/Id</th>
						<th align="left">Section</th>
						<th align="left">Sub-Section</th>
						<th align="left">Location Reference Id</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$LocationTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($LocationTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $LocationTotalRows['total']- $Start;
					else
						$i = $LocationTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$LocationRows = Location_Select_ByLimit($Start, $Limit);
					while($Location = mysql_fetch_assoc($LocationRows))
					{
						$Section = mysql_fetch_assoc(Select_SectionName($Location['section_id']));
						$SubSection = mysql_fetch_assoc(Select_SubSectionName($Location['subsection_id']));
						$LocationReference = mysql_fetch_assoc(Select_LoctionReference($Location['location_reference_id']));
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$Location['name']."</td>
							<td>Section ".$Section['name']."</td>
							<td>Section ".$Section['name']."".$SubSection['name']."</td>
							<td>".$LocationReference['reference']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Location['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$Location['id'].")'>Delete</a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
</section>

<?php
$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 9  || charCode == 46) 
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
	function validation()
	{
		var message = "";
		if(document.getElementById('location_reference_id').value == "")
			message = "Please select a Location Reference";
		if(document.getElementById('subsection_id').value == "")
			message = "Please select a Sub-Section";
		if(document.getElementById('section_id').value == "")
			message = "Please select a Section";
		if(document.getElementById("name").value.length < 4)
			message = "Location should be minimum 4 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function SubSection(SectionId,SubSectionId)
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
				document.getElementById('subsection').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Masters_Get_Sub_Section.php?SectionId="+SectionId+"&SubSectionId="+SubSectionId,true);
		xmlhttp.send();
	}
	function LocationReference(SubSectionId,LocationReferenceId)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
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
				document.getElementById('locationreference').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Masters_Get_Location_Reference.php?SubSectionId="+SubSectionId+"&LocationReferenceId="+LocationReferenceId,true);
		xmlhttp.send();
	}
	<?php
	if(($_POST['section_id'] && $_POST['subsection_id']) || ($_POST['subsection_id'] && $_POST['location_reference_id']))
	{ ?>
		SubSection(<?php echo $_POST['section_id'].','.$_POST['subsection_id']; ?>);
		//SubSection(<?php echo $_POST['section_id']; ?>);
		//LocationReference(<?php echo $_POST['subsection_id']; ?>);
		LocationReference(<?php echo $_POST['subsection_id'].','.$_POST['location_reference_id']; ?>);
	<?php
	} ?>
</script>