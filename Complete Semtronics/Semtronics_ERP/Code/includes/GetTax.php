
<?php
	include("Config.php");
	$Stock_Taxs = mysql_query("Select * From tax");
	$FetchRawMeterialTax = mysql_fetch_array(mysql_query("Select * From rawmaterial where id='".$_GET['RawMeterialId']."'"));
?><select id="taxid" name="taxid" required="required" onchange='var OptionSplit = this.value.split(","); document.getElementById("percent").value = OptionSplit[1];document.getElementById("id").value = OptionSplit[0]; '/> <?php //Calculate_Excise_WithTotal();?>
	<option value="">Select</option>
	<?php
	while($Tax = mysql_fetch_assoc($Stock_Taxs))
	{
		if($FetchRawMeterialTax['tax']==$Tax['id'])
			echo '<option onclick="taxamount()" value="'.$Tax['id'].','.$Tax['percent'].'" selected>'.$Tax['type'].'-'.$Tax['percent'].'%</option>';
		else
			echo '<option onclick="taxamount();" value="'.$Tax['id'].','.$Tax['percent'].'">'.$Tax['type'].'-'.$Tax['percent'].'%</option>';
	}?>
</select>