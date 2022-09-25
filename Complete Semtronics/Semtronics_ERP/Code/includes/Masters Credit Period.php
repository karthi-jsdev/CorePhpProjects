<section role="main" id="main">
	<?php
		$Columns = array("id", "period");
		if($_GET['action'] == 'Edit')
		{
			$Credit = mysql_fetch_assoc(Credit_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Credit[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Credit_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Credit Period deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$CreditResource = Credit_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows($CreditResource))
						$message = "<br /><div class='message error'><b>Message</b> : Credit Period already exists</div>";
					else
					{
						Credit_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Credit Period added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Credit = mysql_fetch_assoc($CreditResource);
					if(mysql_num_rows(Credit_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Credit Period already exists</div>";
					else
					{
						Credit_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Credit Period details updated successfully</div>";
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
			<header><h2>Add Credit Period</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Period <font color="red">*</font></label>
					<input type="text" autocomplete="off" id="period" name="period" required="required" value="<?php echo $_POST['period']; ?>" onkeypress="return AlphaNumCheck(e)"/> *Days
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
				$CreditTotalRows = mysql_fetch_assoc(Credit_Select_Count_All());
				echo "Total No. of Credit Period - ".$CreditTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Period</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$CreditTotalRows['total'])
						echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($CreditTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$CreditRows = Credit_Select_ByLimit($Start, $Limit);
					while($Credit = mysql_fetch_assoc($CreditRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Credit['period']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Credit['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Credit['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
        if (charCode == 8 || charCode == 32) 
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
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("period")==0)
			message = "Please Enter the Credit Period";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>