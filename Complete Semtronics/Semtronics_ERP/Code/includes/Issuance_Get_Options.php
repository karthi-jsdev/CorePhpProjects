<?php
ini_set("display_errors","0");
include("Config.php");
include("Issuance_Queries.php");

if($_GET['Module'] == 'Batches' && $_GET['id'])
{
	$_POST['rawmaterialid'] = $_GET['id'];
	$Issuance = mysql_fetch_assoc(Select_Issuance_ById()); ?>
	<select id="" name="batchid" onchange='var OptionSplit = this.value.split("$"); document.getElementById("batchid").value = OptionSplit[0]; document.getElementById("batchnumber").value = OptionSplit[2]; document.getElementById("available_quantity").value = OptionSplit[1];  document.getElementById("location_space").value = OptionSplit[3];      document.getElementById("div_available_quantity").innerHTML = (OptionSplit[1])?"&nbsp;&nbsp;Available Quantity : "+OptionSplit[1]:"&nbsp;&nbsp;Available Quantity : -"; document.getElementById("div_location_space").innerHTML = (OptionSplit[3])?" &nbsp;&nbsp;Location : "+OptionSplit[3]:Location;'>
		<option value="">Select</option>
		<?php
		$Batches = Select_All_BatchesByInspection();
		while($Batch = mysql_fetch_assoc($Batches))
		{
			$issuebatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockissuance.quantity) as quantity FROM batch
					JOIN stock ON stock.batchid=batch.id
					JOIN stockissuance ON stockissuance.batchid=batch.id
					WHERE stock.quantity>0 && batch.rawmaterialid=".$_POST['rawmaterialid']." group by batch.id ORDER BY batch.id"));
			$Batch['quantity'] = $Batch['quantity']-$issuebatch['quantity'];
			if($Batch['id'] == $_GET['batchid'])
				echo "<option value='".$Batch['id']."$".$Batch['quantity']."$".$Batch['number']."$".$Batch['name']."' selected >".$Batch['number']."</option>";
			else
				echo "<option value='".$Batch['id']."$".$Batch['quantity']."$".$Batch['number']."$".$Batch['name']."'>".$Batch['number']."</option>";
		} ?>
	</select>
	<div id="div_available_quantity"></div>
	<div id="div_location_space"></div>
	<input type="hidden" id="batchid" value="" />
	<input type="hidden" id="batchnumber" value="" />
	<input type="hidden" id="available_quantity" value="" />
	<input type="hidden" id="location_space" value="" />
<?php
}

if($_GET['Module'] == 'BatchesE' && $_GET['id'])
{
	$_POST['rawmaterialid'] = $_GET['id'];
	$Issuance = mysql_fetch_assoc(Select_Issuance_ById()); ?>
	<select id="" name="batchidE" onchange='var OptionSplitE = this.value.split("$"); document.getElementById("batchidE").value = OptionSplitE[0]; document.getElementById("batchnumberE").value = OptionSplitE[2]; document.getElementById("available_quantityE").value = OptionSplitE[1]; document.getElementById("div_available_quantityE").innerHTML = (OptionSplitE[1])?"&nbsp;&nbsp;Available Quantity : "+OptionSplitE[1]:"&nbsp;&nbsp;Available Quantity : -";'>
		<option value="">Select</option>
		<?php
		$Batches = Select_All_BatchesByInspection();
		while($Batch = mysql_fetch_assoc($Batches))
		{
			$issuebatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockissuance.quantity) as quantity FROM batch
					JOIN stock ON stock.batchid=batch.id
					JOIN stockissuance ON stockissuance.batchid=batch.id
					WHERE stock.quantity>0 && batch.rawmaterialid=".$_POST['rawmaterialid']." group by batch.id ORDER BY batch.id"));
			$Batch['quantity'] = $Batch['quantity']-$issuebatch['quantity'];
			if($Batch['id'] == $_GET['batchid'])
				echo "<option value='".$Batch['id']."$".$Batch['quantity']."$".$Batch['number']."' selected>".$Batch['number']."</option>";
			else
				echo "<option value='".$Batch['id']."$".$Batch['quantity']."$".$Batch['number']."'>".$Batch['number']."</option>";
		} ?>
	</select>
	<div id="div_available_quantityE"></div>
	<input type="hidden" id="batchidE" value="" />
	<input type="hidden" id="batchnumberE" value="" />
	<input type="hidden" id="available_quantityE" value="" />
<?php
} ?>