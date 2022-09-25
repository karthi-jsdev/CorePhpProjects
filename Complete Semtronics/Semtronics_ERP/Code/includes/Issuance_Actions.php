<?php
	session_start();
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	include("Config.php");
	include("Issuance_Queries.php");
	$_POST['id'] = $_GET['id'];
	$_POST['issuancedate'] = $_GET['issuancedate'];
	$_POST['number'] = $_GET['number'];
	$_POST['issuedto'] = $_GET['issuedto'];
	$_POST['rawmaterialid'] = $_GET['rawmaterialid'];
	$_POST['batchid'] = $_GET['batchid'];
	$_POST['quantity'] = $_GET['quantity'];
	
	if($_GET['Action'] == "Insert" && $_POST['number'] && $_POST['issuedto'] && $_POST['rawmaterialid'] && $_POST['batchid'] && $_POST['quantity'])
	{
		Insert_Issuance();
		$EditData = mysql_fetch_assoc(Select_StockIssuance_ByBatch());
		echo "Issuance added successfully$$".$EditData['id']."$$";
		$StockIssuances = Select_StockIssuance();
		while($StockIssuance = mysql_fetch_array($StockIssuances))
		{
			echo "<tr id='".$StockIssuance['id']."'><td>".$StockIssuance['materialcode']."</td>
			<td>".$StockIssuance['number']."</td><td>".$StockIssuance['quantity']."</td>
			<td><a href='#' onclick='Issuance_Actions(".$StockIssuance['id'].", \"\", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Issuance_Actions(".$StockIssuance['id'].", \"\", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td></tr>";
			$_SESSION['Last_Id'] = $StockIssuance['id'];
		} ?>$$<br />
		<div class="clearfix">
			<label>&nbsp;&nbsp;Raw Material <font color="red">*</font></label>
			<select id="" name="rawmaterialid" onchange='var OptionSplit = this.value.split("$"); document.getElementById("partno").value = OptionSplit[1];document.getElementById("rawmaterialname").value = OptionSplit[2];document.getElementById("rawmaterialid").value = OptionSplit[0]; document.getElementById("div_partno").innerHTML = (OptionSplit[1])?"&nbsp;&nbsp;Part No. : "+OptionSplit[1]:"&nbsp;&nbsp;Part No. : -";GetOptions("Batches", OptionSplit[0]);'>
				<option value="">Select</option>
				<?php
				$RawMaterials = Select_All_RawMaterial();
				while($RawMaterial = mysql_fetch_assoc($RawMaterials))
					echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."'>".$RawMaterial['materialcode']."</option>";
				?>
			</select>
			<div id="div_partno"></div>
			<input type="hidden" id="rawmaterialid" value="" />
			<input type="hidden" id="rawmaterialname" value="" />
			<input type="hidden" id="partno" value="" />
		</div>
		<div class="clearfix">
			<label>&nbsp;&nbsp;Batch <font color="red">*</font></label>
			<div id="Batches">
				<select id="" name="batchid">
					<option value="">Select</option>
				</select>
				<div id="div_available_quantity"></div>
				<input type="hidden" id="batchid" value="" />
				<input type="hidden" id="batchnumber" value="" />
				<input type="hidden" id="available_quantity" value="" />
			</div>
			<div id="div_available_quantity"></div>
			<input type="hidden" id="available_quantity" value="" />
			<input type="hidden" id="batchid" value="" />
		</div>
		<div class="clearfix">
			<label>&nbsp;&nbsp;Quantity To Issuance <font color="red">*</font></label>
			<input type="text" id="quantity" name="quantity" required="required" value="" onkeypress="return Amount(event, '');"/>
		</div>
		<center>
			<a class="button button-orange" onclick="validation()">Add New</a>&nbsp;&nbsp;&nbsp;
			<a class="button button-green" onclick="window.location.assign('?page=Stores&subpage=spage->Issuance,ssubpage->Status&number='+document.getElementById('number').value)">Finish</a>
		</center><br />
	<?php
	}
	else if($_GET['Action'] == "Edit")
	{
		$CurrentIssuance = mysql_fetch_array(Select_StockIssuance_ById());
		$issuebatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockinventory.quantity) as quantity FROM batch
							JOIN stock ON stock.batchid=batch.id
							JOIN stockinventory ON stockinventory.batchid=batch.id
							WHERE batch.rawmaterialid=".$CurrentIssuance['rawmaterialid']." && stockinventory.quantity>0 && stockinventory.inspection='1' group by batch.id ORDER BY batch.id"));
		$CurrentIssuance['stockquantity'] = $issuebatch['quantity'] - $CurrentIssuance['stockquantity'];
		?>
		<td colspan="5">
			<hr />
			<div class="clearfix">
				<label>&nbsp;&nbsp;Raw Material <font color="red">*</font></label>
				<select id="" name="rawmaterialidE" onchange='var OptionSplitE = this.value.split("$"); document.getElementById("partnoE").value = OptionSplitE[1];document.getElementById("rawmaterialnameE").value = OptionSplitE[2];document.getElementById("rawmaterialidE").value = OptionSplitE[0]; document.getElementById("div_partnoE").innerHTML = (OptionSplitE[1])?"&nbsp;&nbsp;Part No. : "+OptionSplitE[1]:"&nbsp;&nbsp;Part No. : -";GetOptions("BatchesE", OptionSplitE[0]);'>
					<option value="">Select</option>
					<?php
					$RawMaterials = Select_All_RawMaterial();
					while($RawMaterial = mysql_fetch_assoc($RawMaterials))
					{
						if($RawMaterial['id'] == $CurrentIssuance['rawmaterialid'])
							echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."' selected>".$RawMaterial['materialcode']."</option>";
						else
							echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."'>".$RawMaterial['materialcode']."</option>";
					} ?>
				</select>
				<div id="div_partnoE">&nbsp;&nbsp;Part No. : <?php echo $CurrentIssuance['partnumber'];?></div>
				<input type="hidden" id="rawmaterialidE" value="<?php echo $CurrentIssuance['rawmaterialid'];?>" />
				<input type="hidden" id="rawmaterialnameE" value="<?php echo $CurrentIssuance['materialcode'];?>" />
				<input type="hidden" id="partnoE" value="<?php echo $CurrentIssuance['partnumber'];?>" />
			</div>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Batch <font color="red">*</font></label>
				<div id="BatchesE">
					<select id="" name="batchidE" onchange='var OptionSplitE = this.value.split("$"); document.getElementById("batchidE").value = OptionSplitE[0]; document.getElementById("batchnumberE").value = OptionSplitE[2]; document.getElementById("available_quantityE").value = OptionSplitE[1]; document.getElementById("div_available_quantityE").innerHTML = (OptionSplitE[1])?"&nbsp;&nbsp;Available Quantity : "+OptionSplitE[1]:"&nbsp;&nbsp;Available Quantity : -";'>
						<option value="">Select</option>
						<?php
						$_POST['rawmaterialid'] = $CurrentIssuance['rawmaterialid'];
						$issuebatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockissuance.quantity) as quantity FROM batch
							JOIN stock ON stock.batchid=batch.id
							JOIN stockissuance ON stockissuance.batchid=batch.id
							WHERE batch.rawmaterialid=".$CurrentIssuance['rawmaterialid']." group by batch.id "));
						$inventorybatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockinventory.quantity) as quantity FROM batch
						JOIN stock ON stock.batchid=batch.id
						JOIN stockinventory ON stockinventory.batchid=batch.id
						WHERE batch.rawmaterialid=".$CurrentIssuance['rawmaterialid']." && stockinventory.quantity>0 && stockinventory.inspection='1' group by batch.id ORDER BY batch.id"));
						$CurrentIssuance['stockquantity'] =$inventorybatch['quantity'] - $issuebatch['quantity'];
						$Batches = Select_All_Batches();
						while($Batch = mysql_fetch_assoc($Batches))
						{
							if($Batch['id'] == $CurrentIssuance['batchid'])
								echo "<option value='".$Batch['id']."$".$Batch['quantity']."$".$Batch['number']."' selected>".$Batch['number']."</option>";
							else
								echo "<option value='".$Batch['id']."$".$Batch['quantity']."$".$Batch['number']."'>".$Batch['number']."</option>";
						} ?>
					</select>
					<div id="div_available_quantityE">&nbsp;&nbsp;Available Quantity : <?php echo $CurrentIssuance['stockquantity'];?></div>
					<input type="hidden" id="batchidE" value="<?php echo $CurrentIssuance['batchid'];?>" />
					<input type="hidden" id="batchnumberE" value="<?php echo $CurrentIssuance['number'];?>" />
					<input type="hidden" id="available_quantityE" value="<?php echo $CurrentIssuance['stockquantity'];?>" />
				</div>
				<div id="div_available_quantityE"></div>
				<input type="hidden" id="available_quantityE" value="" />
				<input type="hidden" id="batchidE" value="" />
			</div>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Quantity To Issuance <font color="red">*</font></label>
				<input type="text" id="quantityE" name="quantityE" required="required" value="<?php echo $CurrentIssuance['quantity'];?>" onkeypress="return Amount(event, 'E');"/>
			</div>
			<center>
				<a class="button button-green" onclick="Issuance_Actions(<?php echo $_POST['id']; ?>,'','Update')">Update</a>
				<a class="button button-orange" onclick="Issuance_Actions(<?php echo $_POST['id']; ?>,'','Cancel')">Cancel</a>
			</center><hr />
		</td>
	<?php
	}
	else if($_GET['Action'] == "Update" && $_POST['rawmaterialid'] && $_POST['batchid'] && $_POST['quantity'])
	{
		Update_Issuance();
		echo "Issuance details updated successfully";
	}
	else if($_GET['Action'] == "Delete")
	{
		Delete_Issuance();
		echo "Issuance deleted successfully";
	}
	else
		echo "Please input properly";
	?>