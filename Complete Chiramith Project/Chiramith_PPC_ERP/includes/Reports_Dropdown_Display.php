<?php
include('Config.php');
ini_set("display_errors","0");
include("Reports_Queries.php");
$customername = Customer_Report();
$report_data = $report_options = array();
$report_data[] = array();

$customerdropdown = Customer_Dropdown();
$orderdropdown = Order_Dropdown();
$prod_description = Proddesc_Dropdown();
$prod_drawno = Proddraw_Dropdown();
$prod_grade = Prodgrade_Dropdown();
$prod_size = Prodsize_Dropdown();
$machinedropdown = Machine_Dropdown();
$machinespecdropdown = Machinespec_Dropdown();
$machineturntooldropdown = Machineturn_Dropdown();

while($customer = mysql_fetch_assoc($customername))
{
	if($customer['customer_id'] && !in_array($customer['customer_id'], $report_data[0]))
	{
		if($_GET['cust_id'] == $customer['customer_id'])
			$report_options[0] .= '<option value="'.$customer['customer_id'].'" selected="selected">'.$customer['name'].'</option>';
		else
			$report_options[0] .= '<option value="'.$customer['customer_id'].'">'.$customer['name'].'</option>';
	}
	$report_data[0][] = $customer['customer_id'];
	
	if($customer['order_id'] && !in_array($customer['order_id'], $report_data[1]))
	{
		if($_GET['order_id'] == $customer['order_id'])
			$report_options[1] .= '<option value="'.$customer['order_id'].'" selected="selected">'.$customer['number'].'</option>';
		else
			$report_options[1] .= '<option value="'.$customer['order_id'].'">'.$customer['number'].'</option>';
	}
	$report_data[1][] = $customer['order_id'];
	
	if($customer['product_id'] && !in_array($customer['description'], $report_data[2]))
	{
		if($_GET['description'] == $customer['description'])
			$report_options[2] .= '<option value="'.$customer['description'].'" selected="selected">'.$customer['description'].'</option>';
		else
			$report_options[2] .= '<option value="'.$customer['description'].'">'.$customer['description'].'</option>';
	}
	$report_data[2][] = $customer['description'];
	
	if($customer['product_id'] && !in_array($customer['draw_number'], $report_data[3]))
	{
		if($_GET['drawing_number'] == $customer['draw_number'])
			$report_options[3] .= '<option value="'.$customer['draw_number'].'" selected="selected">'.$customer['draw_number'].'</option>';
		else
			$report_options[3] .= '<option value="'.$customer['draw_number'].'">'.$customer['draw_number'].'</option>';
	}
	$report_data[3][] = $customer['draw_number'];
	
	if($customer['product_id'] && !in_array($customer['grade'], $report_data[4]))
	{
		if($_GET['grade'] == $customer['grade'])
			$report_options[4] .= '<option value="'.$customer['grade'].'" selected="selected">'.$customer['grade'].'</option>';
		else
			$report_options[4] .= '<option value="'.$customer['grade'].'">'.$customer['grade'].'</option>';
	}
	$report_data[4][] = $customer['grade'];
	
	if($customer['product_id'] && !in_array($customer['material_size'], $report_data[5]))
	{
		if($_GET['material_size'] == $customer['material_size'])
			$report_options[5] .= '<option value="'.$customer['material_size'].'" selected="selected">'.$customer['material_size'].'</option>';
		else
			$report_options[5] .= '<option value="'.$customer['material_size'].'">'.$customer['material_size'].'</option>';
	}
	$report_data[5][] = $customer['material_size'];
	
	if($customer['machine_id'] && !in_array($customer['machine_id'], $report_data[6]))
	{
		if($_GET['machine'] == $customer['machine_id'])
			$report_options[6] .= '<option value="'.$customer['machine_id'].'" selected="selected">'.$customer['machineno'].'</option>';
		else
			$report_options[6] .= '<option value="'.$customer['machine_id'].'">'.$customer['machineno'].'</option>';
	}
	$report_data[6][] = $customer['machine_id'];
	
	if($customer['machinespec_id'] && !in_array($customer['machinespec_id'], $report_data[7]))
	{
		if($_GET['specification'] == $customer['machinespec_id'])
			$report_options[7] .= '<option value="'.$customer['machinespec_id'].'" selected="selected">'.$customer['specification'].'</option>';
		else
			$report_options[7] .= '<option value="'.$customer['machinespec_id'].'">'.$customer['specification'].'</option>';
	}
	$report_data[7][] = $customer['machinespec_id'];
	
	if($customer['machineturn_id'] && !in_array($customer['machineturn_id'], $report_data[8]))
	{
		if($_GET['tools'] == $customer['machineturn_id'])
			$report_options[8] .= '<option value="'.$customer['machineturn_id'].'" selected="selected">'.$customer['tool'].'</option>';
		else
			$report_options[8] .= '<option value="'.$customer['machineturn_id'].'">'.$customer['tool'].'</option>';
	}
	$report_data[8][] = $customer['machineturn_id'];
}
?>
<fieldset>
	<div class="clearfix">
		<table width="900px">
			<tr>
				<td><strong>Customer</strong></td>
				<td>
					<select name="cust_id" id="cust_id" onchange="Get_Module_Options('cust_id',this.value)">
						<option value="">All</option>
						<?php 
						if($_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['grade'] && !$_GET['material_size'] && !$_GET['machine']&& !$_GET['specification'] && !$_GET['tools'])
						{
							while($cust_name = mysql_fetch_assoc($customerdropdown))
							{
								if($_GET['cust_id']==$cust_name['id'])
									echo '<option value="'.$cust_name['id'].'" selected="selected">'.$cust_name['name'].'</option>';
								else
									echo '<option value="'.$cust_name['id'].'" >'.$cust_name['name'].'</option>';
							}
						}
						else
							echo $report_options[0]; 
						?>
					</select>
				</td>
				<td><strong>Order</strong></td>
				<td>
					<select name="number" id="order_id" onchange="Get_Module_Options('order_id',this.value)">
						<option value="">All</option>
						<?php
						if($_GET['order_id'] && !$_GET['cust_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['grade'] && !$_GET['material_size'] && !$_GET['machine']&& !$_GET['specification'] && !$_GET['tools'])
						{
							while($order_no = mysql_fetch_assoc($orderdropdown))
							{
								if($_GET['order_id']==$order_no['id'])
									echo '<option value="'.$order_no['id'].'" selected="selected">'.$order_no['number'].'</option>';
								else
									echo '<option value="'.$order_no['id'].'" >'.$order_no['number'].'</option>';
							}
						}
						else
							echo $report_options[1]; ?>
					</select>
				</td>
				<td><strong>Product</strong></td>
				<td>
					<select name="description" id="description" onchange="Get_Module_Options('description',this.value)">
						<option value="">All</option>
						<?php
						if($_GET['grade'] && !$_GET['cust_id'] && !$_GET['order_id'] && $_GET['description'] && !$_GET['drawing_number'] && !$_GET['material_size'] && !$_GET['machine']&& !$_GET['specification'] && !$_GET['tools'])
						{
							while($proddescription = mysql_fetch_assoc($prod_description))
							{
								if($_GET['description'] == $proddescription['description'])
									echo '<option value="'.$proddescription['description'].'" selected="selected">'.$proddescription['description'].'</option>';
								else
									echo '<option value="'.$proddescription['description'].'">'.$proddescription['description'].'</option>';
							}
						}						
						else
							echo $report_options[2]; ?>
					</select>
				</td>
				<td><strong>DrawingNumber</strong></td>
				<td>
					<select name="drawing_number" id="drawing_number" onchange="Get_Module_Options('drawing_number',this.value)">
						<option value="">All</option>
						<?php
						if(!$_GET['grade'] && !$_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && $_GET['drawing_number'] && !$_GET['material_size'] && !$_GET['machine']&& !$_GET['specification'] && !$_GET['tools'])
						{
							while($proddrawno = mysql_fetch_assoc($prod_drawno))
							{
								if($_GET['drawing_number']==$proddrawno['drawing_number'])
									echo '<option value="'.$proddrawno['drawing_number'].'" selected="selected">'.$proddrawno['drawing_number'].'</option>';
								else
									echo '<option value="'.$proddrawno['drawing_number'].'" >'.$proddrawno['drawing_number'].'</option>';
							}
						} 
						else
							echo $report_options[3]; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><strong>Grade</strong></td>
				<td>
					<select name="grade" id="grade" onchange="Get_Module_Options('grade',this.value)">
						<option value="">All</option>
						<?php
						if($_GET['grade'] && !$_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['material_size'] && !$_GET['machine']&& !$_GET['specification'] && !$_GET['tools'])
						{
							while($prodgrade = mysql_fetch_assoc($prod_grade))
							{
								if($_GET['grade'] == $prodgrade['grade'])
									echo '<option value="'.$prodgrade['grade'].'" selected="selected">'.$prodgrade['grade'].'</option>';
								else
									echo '<option value="'.$prodgrade['grade'].'">'.$prodgrade['grade'].'</option>';
							}
						}
						else
							echo $report_options[4]; ?>
					</select>
				</td>
				<td><strong>RawMaterialSize</strong></td>
				<td>
					<select name="material_size" id="material_size" onchange="Get_Module_Options('material_size',this.value)">
						<option value="">All</option>
						<?php 
						if($_GET['material_size'] && !$_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['grade'] && !$_GET['machine'] && !$_GET['specification'] && !$_GET['tools'])
						{
							while($prodsize  = mysql_fetch_assoc($prod_size ))
							{
								if($_GET['material_size'] == $prodsize['material_size'])
									echo '<option value="'.$prodsize['material_size'].'" selected="selected">'.$prodsize['material_size'].'</option>';
								else
									echo '<option value="'.$prodsize['material_size'].'">'.$prodsize['material_size'].'</option>';
							}
						}
						else
							echo $report_options[5]; ?>
					</select>
				</td>
				<td><strong>Machine</strong></td>
				<td>
					<select name="machine" id="machine" onchange="Get_Module_Options('machine',this.value)">
						<option value="">All</option>
						<?php 
						if($_GET['machine'] && !$_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['grade'] && !$_GET['material_size'] && !$_GET['specification'] && !$_GET['tools'])
						{
							while($machine_no= mysql_fetch_assoc($machinedropdown))
							{
								if($_GET['machine'] == $machine_no['id'])
									echo '<option value="'.$machine_no['id'].'" selected="selected">'.$machine_no['machine_number'].'</option>';
								else
									echo '<option value="'.$machine_no['id'].'" >'.$machine_no['machine_number'].'</option>';
							}
						}
						else
							echo $report_options[6]; ?>
					</select>
				</td>
				<td><strong>Machine Specification</strong></td>
				<td>
					<select name="specification" id="specification" onchange="Get_Module_Options('specification',this.value)">
						<option value="">All</option>
						<?php 
						if($_GET['specification'] && !$_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['grade'] && !$_GET['material_size'] && !$_GET['machine'] && !$_GET['tools'])
						{
							while($machine_specdropdown= mysql_fetch_assoc($machinespecdropdown))
							{
								if($_GET['specification']==$machine_specdropdown['id'])
									echo '<option value="'.$machine_specdropdown['id'].'" selected="selected">'.$machine_specdropdown['specification'].'</option>';
								else
									echo '<option value="'.$machine_specdropdown['id'].'" >'.$machine_specdropdown['specification'].'</option>';
							}
						}
						else
							echo $report_options[7]; ?>
					</select>
				</td>
				
				<td><strong>No.of Tools</strong></td>
				<td>
					<select name="tools" id="tools" onchange="Get_Module_Options('tools',this.value)">
						<option value="">All</option>
						<?php 
						if($_GET['tools'] && !$_GET['cust_id'] && !$_GET['order_id'] && !$_GET['description'] && !$_GET['drawing_number'] && !$_GET['grade'] && !$_GET['material_size'] && !$_GET['specification'] && !$_GET['machine'])
						{
							while($machinetooldropdown= mysql_fetch_assoc($machineturntooldropdown))
							{
								if($_GET['tools']==$machinetooldropdown['id'])
									echo '<option value="'.$machinetooldropdown['id'].'" selected="selected">'.$machinetooldropdown['turningtool'].'</option>';
								else
									echo '<option value="'.$machinetooldropdown['id'].'" >'.$machinetooldropdown['turningtool'].'</option>';
							}
						}
						else
							echo $report_options[8]; ?>
					</select>
				</td>
			</tr>
		</table>
	</div>
</fieldset>