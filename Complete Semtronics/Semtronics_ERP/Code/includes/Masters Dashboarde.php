<section role="main" id="main">
	<?php
		include('Config.php');
		if(isset($_POST['Submit']))
		{
			mysqli_query($_SESSION['connection'],"INSERT INTO dashboarded(modulename,status) VALUES ('".$_POST['modulename']."','".$_POST['status']."')");
			$_POST['modulename'] = "";
			$_POST['status'] = "";
		}
		else if($_POST['Update'])
		{
			mysqli_query($_SESSION['connection'],"UPDATE dashboarded SET status='".$_POST['status']."' WHERE id='".$_POST['id']."'");
			$_POST['modulename'] = "";
			$_POST['status'] = "";
		}
		if($_GET['id'] && $_GET['action']=='Edit')
		{
			$values = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM dashboarded WHERE id='".$_GET['id']."'"));
			$_POST['modulename'] = $values['modulename'];
			$_POST['status'] = $values['status'];
		}
		if($_GET['id'] && $_GET['action']=='Delete')
			mysqli_query($_SESSION['connection'],"DELETE FROM dashboarded WHERE id='".$_GET['id']."'");
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Dashboard Enable Disable</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Module name<font color="red">*</font></label>
					<?php
					if($_GET['id'])
					{
					?>
						<input type="text" disabled autocomplete="off" id="modulename" name="modulename" required="required" value="<?php echo $_POST['modulename']; ?>" onkeypress="return isAlphabetic(event)"/>
					<?php
					}
					else
					{?>
						<input type="text" autocomplete="off" id="modulename" name="modulename" required="required" value="<?php echo $_POST['modulename']; ?>" onkeypress="return isAlphabetic(event)"/>
					<?php
					}
					?>
				</div>
				<div class="clearfix">
					<label>Status<font color="red">*</font></label>
					<input type="text" maxlength="1" id="status" autocomplete="off" name="status" required="required" value="<?php echo $_POST['status']; ?>" onkeydown="return isNumeric(event)"/>
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
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Modulname</th>
						<th align="left">Status</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=1;
						$enabledisable = mysqli_query($_SESSION['connection'],"SELECT * FROM dashboarded");
						while($edisable = mysqli_fetch_assoc($enabledisable))
						{
							echo'<tr>
									<td>'.$i++.'</td>
									<td>'.$edisable['modulename'].'</td>
									<td>'.$edisable['status'].'</td>
									<td><a href="?page=Masters&subpage=Stockmaster&innersubpage=Dashboarde&id='.$edisable['id'].'&action=Edit" class=action-button title=user-edit><span class=user-edit></span><a href="?page=Masters&subpage=Stockmaster&innersubpage=Dashboarde&id='.$edisable['id'].'&action=Delete"class=action-button title=user-delete><span class=user-delete></span></td>
								</tr>';
						}
					?>
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
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 ||charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 32)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==48 || charCode==49 || charCode==8 || charCode==127 || charCode==37 || charCode==38 || charCode==39 || charCode==40)
			return true;
		else
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("sort_order")==0)
			message = "Please Enter the sort order";
		if(document.getElementById("sales_status")==0)
			message = "Please Enter the sales status";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>