<section role="main" id="main">
	<?php
		$Columns = array("id", "name");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysql_fetch_assoc(Qualification_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Qualification_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> :Qualification name deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$QualificationResource = Qualification_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($QualificationResource))
					$message = "<br /><div class='message error'><b>Message</b> : This qualification name already exists</div>";
				else
				{
					Qualification_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Qualification name added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysql_fetch_assoc($QualificationResource);
				if(mysql_num_rows(Qualification_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : qualification name already exists</div>";
				else
				{
					Qualification_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Qualification name updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Add Qualification</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Qualification<font color="red">*</font></label>
					<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>
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
			<h3>Qualification List
				<?php
				$QualificationTotalRows = mysql_fetch_assoc(Qualification_Select_Count_All());
				echo " : No. of total Users - ".$QualificationTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Qualifiaction</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$QualificationTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($QualificationTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $QualificationTotalRows['total']- $Start;
					else
						$i = $QualificationTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ClassRows = Qualification_Select_ByLimit($Start, $Limit);
					while($Qualification = mysql_fetch_assoc($ClassRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i--."</td>
							<td>".$Qualification['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Qualification['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Qualification['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
        if (charCode == 8) 
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
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			message = "Designation name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>