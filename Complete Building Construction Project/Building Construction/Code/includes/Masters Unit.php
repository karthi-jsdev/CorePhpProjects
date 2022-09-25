<section role="main" id="main">
	<?php
		$Columns = array("id", "name", "value");
		if($_GET['action'] == 'Edit')
		{
			$Unit = mysql_fetch_assoc(Unit_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Unit[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Unit_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Unit deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$UnitResource = Unit_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows($UnitResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Unit already exists</div>";
					else
					{
						Unit_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Unit added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Unit = mysql_fetch_assoc($UnitResource);
					if(mysql_num_rows(Unit_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Unit already exists</div>";
					else
					{
						Unit_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Unit details updated successfully</div>";
					}
				}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add Unit</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>value <font color="red">*</font></label>
					<input type="text" id="value"  name="value" required="required" value="<?php echo $_POST['value']; ?>" onkeypress="return isNumeric(event)"/>
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
			<h3>Unit List
				<?php
				$UnitTotalRows = mysql_fetch_assoc(Unit_Select_Count_All());
				echo " : No. of total Units - ".$UnitTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Unit</th>
						<th align="left">Value</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$UnitTotalRows['total'])
						echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($UnitTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$UnitRows = Unit_Select_ByLimit($Start, $Limit);
					while($Unit = mysql_fetch_assoc($UnitRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Unit['name']."</td>
							<td>".$Unit['value']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Unit['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Unit['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46 || charCode == 45 || charCode == 41 || charCode == 40 || charCode == 63 || charCode == 95) 
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 9)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("name")==0)
			message = "Please Enter the Name";
		if(document.getElementById("value")==0)
			message = "Please Enter The Value";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 32 || charCode == 46 || charCode == 45) 
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
	function percentage(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("percent").value.indexOf('.') >= 0 && charCode == 46)
			return false
		if(Number(document.getElementById("percent").value+''+String.fromCharCode(charCode)) > 100)
			return false
		if(charCode == 46)
			return true;
		
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
</script>