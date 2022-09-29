<?php
	ini_set("display_errors", "0");
	include("Config.php");
	include("Quotation_Queries.php");
	session_start();
	if($_GET['Action'] == "Add_Quotation" && $_GET['quotation_no'] && $_GET['client_id'] && $_GET['subject'] && $_GET['quotation_date'])
	{
		echo $_SESSION['Quotation_Id'] = Insert_Quotation();
	}
	else if($_GET['Action'] == "Add_Work")
	{
		echo Insert_Work();
		$Works = Select_Works_By_QuotationId();
		while($Work = mysqli_fetch_array($Works))
		{
			echo "<tr id='".$Work['id']."'><td>".$Work['code']."</td><td>".$Work['description']."</td>
			<td>".$Work['quantity']."</td><td>".$Work['rate_per_unit']."</td>
			<td>".$Work['name']."</td><td>".$Work['amount']."</td>
			<td><a href='#' onclick='Actions(".$Work['id'].", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(".$Work['id'].", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td><td></td></tr>";
			$_SESSION['Last_Work_Id'] = $Work['id'];
		}
		$_SESSION['Last_SubWork_Id'] = "";
	}
	else if($_GET['Action'] == "Add_SubWork")
	{
		echo "Sub work added@";
		Insert_SubWork();
		$SubWorks = Select_SubWorks_By_WorkId();
		while($SubWork = mysqli_fetch_array($SubWorks))
		{
			echo "<tr id='S".$SubWork['id']."'><td>".$SubWork['code']."</td><td> ".$SubWork['subworkname']."</td>
			<td>".$SubWork['quantity']."</td><td>".$SubWork['length']."</td>
			<td>".$SubWork['breath']."</td><td>".$SubWork['depth']."</td><td>".$SubWork['area']."</td>
			<td><a href='#' onclick='Actions(\"S".$SubWork['id']."\", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(\"S".$SubWork['id']."\", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td></tr>";
			$_SESSION['Last_SubWork_Id'] = $SubWork['id'];
		}
		echo "@".Select_Work_BySessionId();
	}
	else if($_GET['Action'] == "Edit")
	{
		if(is_numeric($_GET['id']))
		{
			$Work = mysqli_fetch_array(Select_Work_ById());
			?>
			<td colspan="13">
				<hr />
				<div class="clearfix">
					<label><strong>Code</strong><font color="red">*</font></label>
					<input type="text" autocomplete="off" id="codeE" value="<?php echo $Work['code']; ?>" disabled placeholder="Read Only"/>
				</div>
				<div class="clearfix">
				<label><strong>Work Description</strong><font color="red">*</font></label>
					<textarea cols="100" rows="1" id="work_descriptionE" required="required"><?php echo $Work['description']; ?></textarea>
				</div>
				<div class="clearfix">
					<label>
						<strong>Quantity</strong><br />
						<input type="text" autocomplete="off" id="work_quantityE" value="<?php echo $Work['quantity']; ?>" disabled placeholder="Read Only"/>
					</label>
					<label>
						<strong>Rate</strong><font color="red" >*</font><br />
						<input type="text" autocomplete="off" id="rateE" required="required" value="<?php echo $Work['rate_per_unit']; ?>" onkeypress="return IsNumber(event);"/>
					</label>
					<label>
						<strong>Unit</strong><font color="red">*</font><br />
						<select id="unit_idE" required="required" onchange="vendorno(this.value);">
							<option value="">Select</option>
							<?php
							$Units = Select_All_Units();
							while($Unit = mysqli_fetch_assoc($Units))
							{
								if($Work['unit_id'] == $Unit['id'])
									echo '<option value="'.$Unit['id'].'" selected>'.$Unit['name'].'</option>';
								else
									echo '<option value="'.$Unit['id'].'">'.$Unit['name'].'</option>';
							} ?>
						</select>
					</label>
					<label>
						<strong>Amount</strong><br />
						<input type="text" autocomplete="off" id="amountE" value="<?php echo $Work['amount']; ?>" disabled placeholder="Read Only"/>
					</label>
				</div>
				<center>
					<a class="button button-green" onclick="Actions(<?php echo $_GET['id']; ?>, 'Update')">Update</a>
					<a class="button button-orange" onclick="Actions(<?php echo $_GET['id']; ?>, 'Cancel')">Cancel</a>
				</center><hr />
			</td>
		<?php
		}
		else
		{
			$SubWork = mysqli_fetch_array(Select_SubWork_ById());
			?>
			<td colspan="13">
				<hr />
				<div class="clearfix">
					<label><strong>SubWork Code</strong><font color="red">*</font></label>
					<input type="text" autocomplete="off" id="subcodeE" value="<?php echo $SubWork['code']; ?>" disabled placeholder="Read Only"/>
				</div>
				<div class="clearfix">
					<label><strong>SubWork Description</strong><font color="red">*</font></label>
					<textarea  cols="100" rows="1" id="subwork_descriptionE" required="required" /><?php echo $SubWork['subworkname']; ?></textarea>
				</div>	
				<div class="clearfix">
					<label>
						<strong>Subwork Quantity</strong><font color="red">*</font><br />
						<input type="text" autocomplete="off" id="subwork_quantityE" required="required" value="<?php echo $SubWork['quantity']; ?>" onkeypress="return IsNumber(event);" />
					</label>
					<label>
						<strong>Length</strong><font color="red">*</font><br />
						<input type="text" autocomplete="off" id="lengthE" required="required" value="<?php echo $SubWork['length']; ?>" onkeypress="return IsNumber(event);"/>
					</label>
					<label>
						<strong>Breadth</strong><font color="red">*</font><br />
						<input type="text" autocomplete="off" id="breadthE" required="required" value="<?php echo $SubWork['breath']; ?>" onkeypress="return IsNumber(event);"/>
					</label>
					<label>
						<strong>Depth</strong><font color="red">*</font><br />
						<input type="text" autocomplete="off" id="depthE" required="required" value="<?php echo $SubWork['depth']; ?>" onkeypress="return IsNumber(event);"/>
					</label>
					<label style="width:150px;">
						<strong>Area</strong><br /><br />
						<input type="text" autocomplete="off" id="areaE" required="required" disabled placeholder="Read Only" value="<?php echo $SubWork['area']; ?>" onkeypress="return IsNumber(event);"/>
					</label>
				</div>
				<center>
					<a class="button button-green" onclick="Actions('<?php echo $_GET['id']; ?>', 'Update')">Update</a>
					<a class="button button-orange" onclick="Actions('<?php echo $_GET['id']; ?>', 'Cancel')">Cancel</a>
				</center><hr />
			</td>
		<?php
		}
	}
	else if($_GET['Action'] == "Update")
	{
		if(is_numeric($_GET['id']))
		{
			Update_Work_ById();
			echo "Work updated successfully@";
			$Work = mysqli_fetch_array(Select_Work_ById());
			echo "<td>".$Work['code']."</td><td>".$Work['description']."</td>
			<td>".$Work['quantity']."</td><td>".$Work['rate_per_unit']."</td>
			<td>".$Work['name']."</td><td>".$Work['amount']."</td>
			<td><a href='#' onclick='Actions(".$Work['id'].", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(".$Work['id'].", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>";
		}
		else
		{
			Update_SubWork_ById();
			echo "Work updated successfully@";
			$SubWork = mysqli_fetch_array(Select_SubWork_ById());
			echo "<tr id='S".$SubWork['id']."'><td>".$SubWork['code']."</td><td>".$SubWork['subworkname']."</td>
			<td>".$SubWork['quantity']."</td><td>".$SubWork['length']."</td>
			<td>".$SubWork['breath']."</td><td>".$SubWork['depth']."</td><td>".$SubWork['area']."</td>
			<td><a href='#' onclick='Actions(\"S".$SubWork['id']."\", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(\"S".$SubWork['id']."\", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td></tr>";
			$_GET['id'] = $_GET['quotation_work_id'] = $SubWork['quotation_work_id'];
			Update_Work_Details_BySubWork_Id();
			$Work = mysqli_fetch_array(Select_Work_ById());
			echo "@".$Work['id']."@<td>".$Work['description']."</td>
			<td>".$Work['quantity']."</td><td>".$Work['rate_per_unit']."</td>
			<td>".$Work['name']."</td><td>".$Work['amount']."</td>
			<td><a href='#' onclick='Actions(".$Work['id'].", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(".$Work['id'].", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>";
		}
	}
	else if($_GET['Action'] == "Delete")
	{
		if(is_numeric($_GET['id']))
		{
			if($Exits = mysqli_fetch_array(Select_SubWork_ByWorkId()))
				echo "Please delete all the SubWork records before this record";
			else
			{
				Delete_Work_ById();
				echo "Work deleted successfully";
			}
		}
		else
		{
			$_GET['id'] = substr($_GET['id'], 1, strlen($_GET['id']));
			$SubWork = mysqli_fetch_array(Select_SubWork_BySubWorkId());
			Delete_SubWork_ById();
			echo "SubWork deleted successfully";
			$_GET['quotation_work_id'] = $SubWork['quotation_work_id'];
			Update_Work_Details_BySubWork_Id();
			$_GET['id'] = $SubWork['quotation_work_id'];
			$Work = mysqli_fetch_array(Select_Work_ById());
			echo "@".$Work['id']."@<td>".$Work['description']."</td>
			<td>".$Work['quantity']."</td><td>".$Work['rate_per_unit']."</td>
			<td>".$Work['name']."</td><td>".$Work['amount']."</td>
			<td><a href='#' onclick='Actions(".$Work['id'].", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(".$Work['id'].", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>";
		}
	}
	else
		echo "Please input properly";
	?>