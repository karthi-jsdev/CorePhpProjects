<?php
	include("Dashboard_Queries.php");
	include("Config.php");
	if($_GET['Limit'])
	{ 
		echo '<table class="paginate sortable full">';
			$product = Product_Machine_AvailabilityList_ByLimit5(0,$_GET['Limit']);
			$i=1;
			echo'
				<thead>
					<tr>
						<th align="left">Sl. No.</th>
						<th align="left">Product Description</th>
						<th align="left">Drawing No.</th>
						<th align="left">Material Size</th>
						<th align="left">Material Type</th>
						<th align="left">Material Grade/Alloy</th>
						<th align="left">Planned Quantity</th>
						<th align="left">Assigned M/c no</th>
						<th align="left">Tentative Finishing Date</th>
					</tr>
				</thead>
				<tbody>';
				$j = 1;
			if(mysqli_num_rows($product))
			{
				while($product_limit = mysqli_fetch_assoc($product))
				{
					$MachineNum = mysqli_fetch_array(Select_Machine($product_limit['id']));
					$FetchMachine = mysqli_fetch_array(Fetch_Machine($MachineNum['machine_id']));
					echo '<tr>
							<td>'.$j++.'</td>
							<td>'.$product_limit['description'].'</td>
							<td>'.$product_limit['drawing_number'].'</td>
							<td>'.$product_limit['material_size'].'</td>
							<td>'.$product_limit['material_type'].'</td>
							<td>'.$product_limit['grade'].'</td>
							<td>'.$product_limit['numberofpieces'].'</td>
							<td>'.$FetchMachine['machine_number'].'</td>
							<td>'.$product_limit['tentative_enddate'].'</td>
						</tr>
					</tbody>';
				}
			}
			echo'</table>';
} ?>