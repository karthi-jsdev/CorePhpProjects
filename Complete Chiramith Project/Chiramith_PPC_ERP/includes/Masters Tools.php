<section class="first">
	<?php
		$Columns = array("id", "turningtool", "turningtoolid");
		if($_GET['action'] == 'Edit')
		{
			$TurningTools = mysql_fetch_assoc(TurningTools_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $TurningTools[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			TurningTools_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Tool deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$TurningToolsResource = TurningTools_Select_ByName();
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows($TurningToolsResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Tool already exists</div>";
					else
					{
						$TurningToolsNo = mysql_fetch_assoc(Machine_Get_LastId_Turningtool());
						$TurnigtoolsNo = substr($TurningToolsNo[turningtool_id],2);
						$Zeros = array("", "0", "00");
						$TurningToolsNos ="TT".$Zeros[3 - strlen($TurnigtoolsNo+1)].($TurnigtoolsNo+1);
						TurningTools_Insert($TurningToolsNos);
						$message = "<br /><div class='message success'><b>Message</b> : Tool added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$TurningTools = mysql_fetch_assoc($TurningToolsResource);
					if(mysql_num_rows(User_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Tool already exists</div>";
					else
					{
						TurningTools_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Tool details updated successfully</div>";
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
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Tools Master</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Tools <font color="red">*</font></label>
						<input type="text" id="turningtools" name="turningtools" placeholder="Enter Tool" required="required" value="<?php echo $_POST['turningtool']; ?>" onkeypress="return isNumeric(event)"/>
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
			<h3>Make List
				<?php
				$TurningTools_TotalRows = mysql_fetch_assoc(TurningTools_Select_Count_All());
				echo " : No. of total Tools - ".$TurningTools_TotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Tools ID</th>
						<th align="left">Tools</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$TurningTools_TotalRows['total'])
						echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($TurningTools_TotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $TurningTools_TotalRows['total']- $Start;
					else
						$i = $TurningTools_TotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$TurningToolsRows = TurningTools_Select_ByLimit($Start, $Limit);
					while($TurningTools = mysql_fetch_assoc($TurningToolsRows))
					{
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$TurningTools['turningtool_id']."</td>
							<td>".$TurningTools['turningtool']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$TurningTools['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$TurningTools['id'].")'>Delete</a></td>
						</tr>";
					}?>
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
		else if(charCode == 32 ||charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode >= 48 && charCode <= 57)
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
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("turningtools").value.length < 1 || document.getElementById("turningtools").value.length > 15)
			message = "Tool should be within 1 to 15 characters";
		if(message)
		{
			alert(message);
			return false;	
		}
		else
			return true;
	}
</script>