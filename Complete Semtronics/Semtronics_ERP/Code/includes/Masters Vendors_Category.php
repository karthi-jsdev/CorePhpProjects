<section role="main" id="main">
	<?php
		$Columns = array("id", "name");
		if($_GET['action'] == 'Edit')
		{
			$Category = mysql_fetch_assoc(VendorCategory_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Category[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			VendorCategory_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Category deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows(VendorCategory_Select_ByName()))
					$message = "<br /><div class='message error'><b>Message</b> : This category name already exists</div>";
				else
				{
					VendorCategory_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Category added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysql_num_rows(VendorCategory_Select_ByNameUpdate()))
					$message = "<br /><div class='message error'><b>Message</b> : This category name already exists</div>";
				else
				{
					VendorCategory_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Category details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Add Vendor Category</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" maxlength="50" required="required" autocomplete="off" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/> <!-- onkeypress="return isAlphabetic(event)"-->
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
			<h3>
				<?php
				$VendorCategoryTotalRows = mysql_fetch_assoc(VendorCategory_Select_Count_All());
				echo "Total No. of Vendor Categories - ".$VendorCategoryTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Vendor Category</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$VendorCategoryTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($VendorCategoryTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$VendorCategoryRows = VendorCategory_Select_ByLimit($Start, $Limit);
					while($VendorCategory = mysql_fetch_assoc($VendorCategoryRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$VendorCategory['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$VendorCategory['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span> </a>  &nbsp; <a href='#' onclick='deleterow(".$VendorCategory['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode==32) 
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
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 50)
			message = "Category name should be within 2 to 50 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>