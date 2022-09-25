<?php
include('Config.php');
ini_set("display_errors","0");
?>
<fieldset>
	<table>
		<tr>
			<td style="padding-right: 30px;">
				<strong>Section</strong>
				<select id="section_id" onchange="Get_Module_Options()">
					<option value="">All</option>
					<?php
					$Sections = mysql_query("SELECT DISTINCT(section.id), section.name FROM `order` JOIN job ON order.id = job.order_id
					JOIN customer ON order.customer_id = customer.id
					JOIN product ON product.id = job.product_id
					JOIN machine ON machine.id = job.machine_id
					JOIN machine_assignment ON machine_assignment.machine_id=machine.id
					JOIN location ON location.id=machine_assignment.location_id
					LEFT JOIN section ON section.id=location.section_id
					WHERE ".str_replace("=''", "!=''", "section.id='".$_POST['section_id']."' && customer.id='".$_POST['customer_id']."' && order.id='".$_POST['order_id']."' && product.description='".$_POST['description']."' && product.id='".$_POST['product_id']."'")."
					ORDER BY section.id ASC");
					
					while($Section = mysql_fetch_assoc($Sections))
						echo str_replace('"'.$_POST['section_id'].'"', '"'.$Section['id'].'" selected', '<option value="'.$Section['id'].'" >'.$Section['name'].'</option>');
					?>
				</select>
			</td>
			<td style="padding-right: 30px;">
				<strong>Customer</strong>
				<select id="customer_id" onchange="Get_Module_Options()">
					<option value="">All</option>
					<?php 
					$Customers = mysql_query("SELECT DISTINCT(customer.id), customer.name FROM `order` JOIN job ON order.id = job.order_id
					JOIN customer ON order.customer_id = customer.id
					JOIN product ON product.id = job.product_id
					JOIN machine ON machine.id = job.machine_id
					JOIN machine_assignment ON machine_assignment.machine_id=machine.id
					JOIN location ON location.id=machine_assignment.location_id
					LEFT JOIN section ON section.id=location.section_id
					WHERE ".str_replace("=''", "!=''", "section.id='".$_POST['section_id']."' && customer.id='".$_POST['customer_id']."' && order.id='".$_POST['order_id']."' && product.description='".$_POST['description']."' && product.id='".$_POST['product_id']."'")."
					ORDER BY customer.id ASC");
					
					while($Customer = mysql_fetch_assoc($Customers))
						echo str_replace('"'.$_POST['customer_id'].'"', '"'.$Customer['id'].'" selected', '<option value="'.$Customer['id'].'" >'.$Customer['name'].'</option>');
					?>
				</select>
			</td>
			<td style="padding-right: 30px;">
				<strong>Order</strong>
				<select id="order_id" onchange="Get_Module_Options()">
					<option value="">All</option>
					<?php
					$Orders = mysql_query("SELECT DISTINCT(order.id), order.number FROM `order` JOIN job ON order.id = job.order_id
					JOIN customer ON order.customer_id = customer.id
					JOIN product ON product.id = job.product_id
					JOIN machine ON machine.id = job.machine_id
					JOIN machine_assignment ON machine_assignment.machine_id=machine.id
					JOIN location ON location.id=machine_assignment.location_id
					LEFT JOIN section ON section.id=location.section_id
					WHERE ".str_replace("=''", "!=''", "section.id='".$_POST['section_id']."' && customer.id='".$_POST['customer_id']."' && order.id='".$_POST['order_id']."' && product.description='".$_POST['description']."' && product.id='".$_POST['product_id']."'")."
					ORDER BY order.id ASC");
					while($order = mysql_fetch_assoc($Orders))
						echo str_replace('"'.$_POST['order_id'].'"','"'.$order['id'].'" selected','<option value="'.$order['id'].'">'.$order['number'].'</option>');
						?>
				</select>
			</td>	
			<td style="padding-right: 30px;">	
				<strong>Product Desc</strong>
				<select id="description" onchange="Get_Module_Options()">
					<option value="">All</option>
					<?php
					$Products = mysql_query("SELECT DISTINCT(product.description) FROM `order` JOIN job ON order.id = job.order_id
					JOIN customer ON order.customer_id = customer.id
					JOIN product ON product.id = job.product_id
					JOIN machine ON machine.id = job.machine_id
					JOIN machine_assignment ON machine_assignment.machine_id=machine.id
					JOIN location ON location.id=machine_assignment.location_id
					LEFT JOIN section ON section.id=location.section_id
					WHERE ".str_replace("=''", "!=''", "section.id='".$_POST['section_id']."' && customer.id='".$_POST['customer_id']."' && order.id='".$_POST['order_id']."' && product.description='".$_POST['description']."' && product.id='".$_POST['product_id']."'")."
					ORDER BY product.id ASC");
					while($Product = mysql_fetch_assoc($Products))
						echo str_replace('"'.$_POST['description'].'"','"'.$Product['description'].'" selected','<option value="'.$Product['description'].'">'.$Product['description'].'</option>');
					 ?>
				</select>
			</td>
			<td style="padding-right: 30px;">
				<strong>Drawing Number</strong>
				<select id="product_id" onchange="Get_Module_Options()">
					<option value="">All</option>
					<?php
					$Drawing_numbers = mysql_query("SELECT DISTINCT(product.id), product.drawing_number FROM `order` JOIN job ON order.id = job.order_id
					JOIN customer ON order.customer_id = customer.id
					JOIN product ON product.id = job.product_id
					JOIN machine ON machine.id = job.machine_id
					JOIN machine_assignment ON machine_assignment.machine_id=machine.id
					JOIN location ON location.id=machine_assignment.location_id
					LEFT JOIN section ON section.id=location.section_id
					WHERE ".str_replace("=''", "!=''", "section.id='".$_POST['section_id']."' && customer.id='".$_POST['customer_id']."' && order.id='".$_POST['order_id']."' && product.description='".$_POST['description']."' && product.id='".$_POST['product_id']."'")."
					ORDER BY product.id ASC");
					while($Drawing_number = mysql_fetch_assoc($Drawing_numbers))
						echo str_replace('"'.$_POST['product_id'].'"','"'.$Drawing_number['id'].'" selected','<option value="'.$Drawing_number['id'].'">'.$Drawing_number['drawing_number'].'</option>');
					 ?>
				</select>
			</td>
			<td style="padding-right: 30px;">
				<strong>Status</strong>
				<select id="status_id" onchange="Get_Module_Options()">
					<option value="">All</option>
					<?php
					echo str_replace('"'.$_POST['status_id'].'"', '"'.$_POST['status_id'].'" selected',
					'<option value="1">Running</option>
					<option value="2">Nearing</option>
					<option value="3">Future</option>
					<option value="4">Not Running</option>');
					?>
				</select>
			</td>	
		</tr>
	</table>	
</fieldset>