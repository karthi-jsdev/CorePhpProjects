<section role="main" id="main">
	<?php
		$Columns = array("id", "name","classid");
		if($_GET['action'] == 'Edit')
		{
			$Section = mysql_fetch_assoc(Section_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Section[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Section_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One User deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$SectionResource = Section_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($SectionResource))
					$message = "<br /><div class='message error'><b>Message</b> : This User already exists</div>";
				else
				{
					Section_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : User added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				//$User = mysql_fetch_assoc($UserResource);
				if(mysql_num_rows(Section_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This User already exists</div>";
				else
				{
					Section_Update();
					$message = "<br /><div class='message success'><b>Message</b> : User details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['SM_id']; ?>" required="required"/>
			<header><h2>Add Section</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Classname <font color="red">*</font></label>
					<select id="classname" name="classname">
						<option value="">Select</option>
						<?php
						$Classes = Class_Select_All();
						while($Class = mysql_fetch_assoc($Classes))
						{
							if($Class['id'] == $_POST['classid'])
								echo "<option value=".$Class['id']." selected>".$Class['name']."</option>";
							else
								echo "<option value=".$Class['id'].">".$Class['name']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Section Name <font color="red">*</font></label>
					<input type="text" id="sectionname" name="sectionname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>
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
			<h3>Section List
				<?php
				$SectionTotalRows = mysql_fetch_assoc(Section_Select_Count_All());
				echo " : No. of total Users - ".$SectionTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Class Name</th>
						<th align="left">Section Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$SectionTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($SectionTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $SectionTotalRows['total']- $Start;
					else
						$i = $SectionTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$SectionRows = Section_Select_ByLimit($Start, $Limit);
					while($Section = mysql_fetch_assoc($SectionRows))
					{
						$Class = mysql_fetch_assoc(Classes_Select_ById($Section['classid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i--."</td>
							<td>".$Class['name']."</td>
							<td>".$Section['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Section['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Section['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
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
	function validation()
	{
		var message = "";
		if(document.getElementById("sectionname").value.length < 2 || document.getElementById("sectionname").value.length > 15)
			message = "Section name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>