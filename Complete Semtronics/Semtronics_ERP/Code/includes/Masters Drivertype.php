<section role="main" id="main">
	<?php
		include('Config.php');
		if(isset($_POST['Submit']))
		{
			mysqli_query($_SESSION['connection'],"INSERT INTO drivertype(drivertype,indexvalue) VALUES ('".$_POST['drivertype']."','".$_POST['indexvalue']."')");
			$_POST['drivertype'] = "";
			$_POST['indexvalue'] = "";
		}
		else if($_POST['Update'])
		{
			mysqli_query($_SESSION['connection'],"UPDATE drivertype SET drivertype='".$_POST['drivertype']."',indexvalue='".$_POST['indexvalue']."' WHERE id='".$_POST['id']."'");
			$_POST['drivertype'] = "";
			$_POST['indexvalue'] = "";
		}
		if($_GET['id'] && $_GET['action']=='Edit')
		{
			$values = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM drivertype WHERE id='".$_GET['id']."'"));
			$_POST['drivertype'] = $values['drivertype'];
			$_POST['indexvalue'] = $values['indexvalue'];
		}
		if($_GET['id'] && $_GET['action']=='Delete')
			mysqli_query($_SESSION['connection'],"DELETE FROM drivertype WHERE id='".$_GET['id']."'");
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Product Driver Type</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Driver Type<font color="red">*</font></label>
						<input type="text" autocomplete="off" id="drivertype" name="drivertype" required="required" value="<?php echo $_POST['drivertype']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Index<font color="red">*</font></label>
					<input type="text" id="indexvalue" autocomplete="off" name="indexvalue" required="required" value="<?php echo $_POST['indexvalue']; ?>"/>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="validation();">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" onclick="validation();">Submit</button>&nbsp;&nbsp;';
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
						<th align="left">Driver Type</th>
						<th align="left">Index</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=1;
						$enabledisable = mysqli_query($_SESSION['connection'],"SELECT * FROM drivertype");
						if(mysqli_num_rows($enabledisable)==0)
							echo '<tr><td colspan="4" style="color:red;"><center>No data found<center></td></tr>';
						else
						{
							while($edisable = mysqli_fetch_assoc($enabledisable))
							{
								echo'<tr>
										<td>'.$i++.'</td>
										<td>'.$edisable['drivertype'].'</td>
										<td>'.$edisable['indexvalue'].'</td>
										<td><a href="?page=Masters&subpage=Stockmaster&innersubpage=Drivertype&id='.$edisable['id'].'&action=Edit" class=action-button title=user-edit><span class=user-edit></span><a href="?page=Masters&subpage=Stockmaster&innersubpage=Drivertype&id='.$edisable['id'].'&action=Delete"class=action-button title=user-delete onclick="return deleterows();"><span class=user-delete></span></td>
									</tr>';
							}
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
		if(document.getElementById("drivertype").value==""||document.getElementById("drivertype").value==null)
			return alert('Enter Driver Type');
		if(document.getElementById("indexvalue").value==""||document.getElementById("indexvalue").value==null)
			return alert('Enter Index');
	}
	function deleterows()
	{
		var x = confirm("Are you sure want to delete?");
		if(x==true){}
		else
			return false;
	}
</script>