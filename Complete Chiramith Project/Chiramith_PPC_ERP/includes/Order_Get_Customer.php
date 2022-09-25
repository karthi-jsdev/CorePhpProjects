<?php
	include("Config.php");
	include("Create_Order_Queries.php");
	if($_GET['Number'])
	{
		$Customers = Customers_Select_Orderno($_GET['Number']);
		if(mysql_num_rows($Customers))
		{ ?>
			<select id="" name="customer_id" onchange='var OptionSplit = this.value.split("."); document.getElementById("customer_id").value = OptionSplit[0]; document.getElementById("customer_name").value = OptionSplit[1];'>
			 <option value="">Select</option>';
			<?php	
			$Customer = mysql_fetch_assoc($Customers);
					echo "<option value='".$Customer['id'].".".$Customer['name']."' selected>".$Customer['name']."</option>";
			echo '</select>
				<input type="hidden" id="customer_id" value="'.$Customer['id'].'" />
				<input type="hidden" id="customer_name" value="'.$Customer['name'].'" />';
		}
	}
?>