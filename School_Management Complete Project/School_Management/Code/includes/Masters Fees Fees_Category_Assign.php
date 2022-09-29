<section role="main" id="main">
	<?php
		$Columns = array("id", "categorydes", "feescategoryid", "classids", "amount", "monthids");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysqli_fetch_assoc(Feescategoryassign_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Feescategoryassign_Delete_ById();
			$message = "<br /><div class='message success'><b>Message</b> : One Fees category Assign name deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$FeescategoryassignResource = Feescategoryassign_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($FeescategoryassignResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Fees category Assign name already exists</div>";
				else
				{
					$Class_names = $_POST['classnames'];
					$values = array();
					foreach($Class_names as $Classes)
					{
						$values[] = $Classes;
					}
					$Classnames = implode(',',$values);
					$Month_names = $_POST['monthnames'];
					$values = array();
					foreach($Month_names as $Months)
					{
						$values[] = $Months;
					}
					$Monthnames = implode(',',$values);
					Feescategoryassign_Insert($Classnames,$Monthnames);
					$message = "<br /><div class='message success'><b>Message</b> : Fees category Assign name added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysqli_fetch_assoc($FeescategoryassignResource);
				if(mysqli_num_rows(Feescategoryassign_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Fees category Assign name already exists</div>";
				else
				{
					$Class_names = $_POST['classnames'];
					$values = array();
					foreach($Class_names as $Classes)
					{
						$values[] = $Classes;
					}
					$Classnames = implode(',',$values);
					$Month_names = $_POST['monthnames'];
					$values = array();
					foreach($Month_names as $Months)
					{
						$values[] = $Months;
					}
					$Monthnames = implode(',',$values);
					Feescategoryassign_Update($Classnames,$Monthnames);
					$message = "<br /><div class='message success'><b>Message</b> : Fees category Assign details updated successfully</div>";
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
		<header><h2>Fees Catagory Assign</h2></header>
		<hr />			
		<fieldset>
			<div class="clearfix">
				<label>Catagory Description <font color="red">*</font></label>
					<input type="text" id="categorydes" name="categorydes" required="required" value="<?php echo $_POST['categorydes']; ?>" />
			</div>
			<div class="clearfix">
					<label>Fees Catagory <font color="red">*</font></label>
					<select id="feescategoryid" name="feescategoryid">
						<option value="">Select</option>
						<?php
						$Feescategory = Feescategory_Select_All();
						while($Feescategory_Name = mysqli_fetch_assoc($Feescategory))
						{
							if($Feescategory_Name['id'] == $_POST['feescategoryid'])
								echo "<option value=".$Feescategory_Name['id']." selected>".$Feescategory_Name['name']."</option>";
							else
								echo "<option value=".$Feescategory_Name['id'].">".$Feescategory_Name['name']."</option>";
						} ?>
					</select>
			</div>
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Classes <font color="red">*</font>
				</label>
					<table>
						<tr>
						<?php 
							$_POST['classids'] = explode(",", $_POST['classids']);
							$i = 1;
							$Classnames = mysqli_query($_SESSION['connection'],"SELECT * FROM class order by class.id asc");
							while($Classes = mysqli_fetch_array($Classnames))
							{
								$i++;
								if(in_array($Classes['id'], $_POST['classids']))
									echo '<td><input type="checkbox" id="classnames'.$i.'" name="classnames[]" value="'.$Classes['id'].'" checked />'.$Classes['name'].'</td>';
								else
									echo '<td><input type="checkbox" id="classnames'.$i.'" name="classnames[]" value="'.$Classes['id'].'" />'.$Classes['name'].'</td>';
							}
						?>
						</tr>
					</table>
			</div>
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Amount <font color="red">*</font></label>
					<input type="text" id="amount" name="amount" required="required" value="<?php echo $_POST['amount']; ?>" />
			</div>
		</fieldset>	
		<fieldset>	
			<div class="clearfix">			
				<label>Month <font color="red">*</font>
				</label>
				<table>
					<tr>
						<?php
							$_POST['monthids'] = explode(',',$_POST['monthids']);
							$i = 1;
							$Monthnames = mysqli_query($_SESSION['connection'],"SELECT * FROM month order by month.id asc");
							//echo '<td style="display:none"><input type="checkbox" id="monthnames0" name="monthnames[]" value="'.$Months['id'].'" checked />'.$Months['name'].'</td>';
							while($Months = mysqli_fetch_array($Monthnames))
							{
								$i++;
								if(in_array($Months['id'],$_POST['monthids']))
									echo '<td><input type="checkbox" id="monthnames'.$i.'" name="monthnames[]" value="'.$Months['id'].'" checked />'.$Months['name'].'</td>';
								else
									echo '<td><input type="checkbox" id="monthnames'.$i.'" name="monthnames[]" value="'.$Months['id'].'">'.$Months['name'].'</td>';
							}
						?>
					</tr>
				</table>	
			</div>
		</fieldset>	
		<hr />
		<?php
		if($_GET['action'] == 'Edit')
			echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
		else
			echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
		?><button class="button button-gray" type="reset">Reset</button>
	</form>
</div>
		
<div class="columns">
	<h3>Feescategory Assign List
		<?php
		$FeescategoryTotalRows = mysqli_fetch_assoc(Feescategory_Select_Count_All());
		echo " : No. of Total Fees Catagory Assign- ".$FeescategoryTotalRows['total'];
		?>
	</h3>
	<hr />			
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Feescategory Assign</th>
				<th align="left">Feescategory Name</th>
				<th align="left">Classes</th>
				<th align="left">Amount</th>
				<th align="left">Month</th>
				<th align="left">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$FeescategoryTotalRows['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$total_pages = ceil($FeescategoryTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$Start = ($_GET['pageno']-1)*$Limit;
			if($_GET['pageno']>=2)
				$i = $Start+1;
			else
				$i =1;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			$FeescategoryRows = Feescategory_Select_ByLimit($Start, $Limit);
			while($FeescategoryAssign = mysqli_fetch_assoc($FeescategoryRows))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>";
					echo "<td>".$FeescategoryAssign['categorydes']."</td>";
					$Feescategoryname = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM fees_catagory where id='".$FeescategoryAssign['feescategoryid']."'"));
					echo "<td>".$Feescategoryname['name']."</td>";
					if($FeescategoryAssign['classids'])
					{
						$Classes = explode(",",$FeescategoryAssign['classids']);
						$All ="";
						foreach($Classes as $class)
						{
							$Classname = mysqli_fetch_array(All_Class_Name($class));
							if($All)
								$All .=",".$Classname['name'];
							else
								$All .= $Classname['name'];
						}
					echo "<td>".$All."</td>";
					}
					else
						 echo "<td>-</td>";
					echo "<td>".$FeescategoryAssign['amount']."</td>";
					if($FeescategoryAssign['monthids'])
					{
						$Months = explode(",",$FeescategoryAssign['monthids']);
						$All ="";
						foreach($Months as $Month)
						{
							$Monthname = mysqli_fetch_array(All_Month_Name($Month));
							if($All)
								$All .=",".$Monthname['name'];
							else
								$All .= $Monthname['name'];
						}
					echo "<td>".$All."</td>";
					}
					else
						 echo "<td>-</td>";
					echo"<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$FeescategoryAssign['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$FeescategoryAssign['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
				</tr>";
			} ?>
		</tbody>
	</table>
</div>
<div class="clear">&nbsp;</div>
<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
?>
</section>
<script>
	
	function validation()
	{
		var message = "";
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			message = "Fees category name should be within 2 to 15 characters";
		if(document.getElementById("name").value == " ")
			message = "Please enter category name";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>