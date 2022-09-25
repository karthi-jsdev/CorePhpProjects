<section role="main" id="main">
	<?php
		$Columns = array("id", "make_id","model");
		if($_GET['action'] == 'Edit')
		{
			$Model = mysqli_fetch_assoc(Model_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Model[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Model_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Model deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$ModelResource = Model_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($ModelResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Model already exists</div>";
				else
				{
					Model_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Model added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				//$User = mysqli_fetch_assoc($UserResource);
				if(mysqli_num_rows(Model_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Model already exists</div>";
				else
				{
					Model_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Model details updated successfully</div>";
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
			<header><h2>Add Model</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Make Name <font color="red">*</font></label>
					<select id="make_id" name="make_id">
						<option value="">Select</option>
						<?php
						$Classes = Make_Select_All_Make();
						while($Class = mysqli_fetch_assoc($Classes))
						{
							if($Class['id'] == $_POST['make_id'])
								echo "<option value=".$Class['id']." selected>".$Class['make']."</option>";
							else
								echo "<option value=".$Class['id'].">".$Class['make']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Model Name <font color="red">*</font></label>
					<input type="text" id="model" name="model" required="required" value="<?php echo $_POST['model']; ?>" onkeypress="return AlphaNumCheck(event)"/>
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
			<h3>Model List
				<?php
				$ModelTotalRows = mysqli_fetch_assoc(Model_Select_Count_All());
				echo " : No. of total Users - ".$ModelTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Make Name</th>
						<th align="left">Model Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ModelTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ModelTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $ModelTotalRows['total']- $Start;
					else
						$i = $ModelTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ModelRows = Model_Select_ByLimit($Start, $Limit);
					while($Model = mysqli_fetch_assoc($ModelRows))
					{
						$Class = mysqli_fetch_assoc(Make_Select_ById_Make($Model['make_id']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i--."</td>
							<td>".$Class['make']."</td>
							<td>".$Model['model']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Model['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Model['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
		if(document.getElementById("model").value=="")
			message = "please enter the model";
		if(document.getElementById("make_id").value== "" )
			message = "Please select make name";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>