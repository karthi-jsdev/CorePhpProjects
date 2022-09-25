<?php
	include('Config.php');
	if($_GET['save'])
	{
?><table class="paginate sortable full">
		<thead>
			<tr>
				<th>Sl.No.</th>
				<th>RawmaterialCode</th>
				<th>Category Name</th>
				<th>Part No</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Amount</th>
				<th>Excise Duty Tax</th>
			</tr>
		</thead>
		<?php
		$i=1;
			$add_stock = mysql_query("SELECT rawmaterial.materialcode,category.name,rawmaterial.partnumber,rawmaterial.description,stock.quantity,stock.unitprice,stock.amount,stock.exciseamount FROM rawmaterial
										inner join batch on batch.rawmaterialid=rawmaterial.id
										inner join stock on stock.batchid=batch.id
										inner join category on category.id=rawmaterial.categoryid");
			while($stock = mysql_fetch_assoc($add_stock))
			{
				echo'
					<tr>
						<td>'.$i++.'</td>
						<td>'.$stock['materialcode'].'</td>
						<td>'.$stock['name'].'</td>
						<td>'.$stock['partnumber'].'</td>
						<td>'.$stock['description'].'</td>
						<td>'.$stock['quantity'].'</td>
						<td>'.$stock['unitprice'].'</td>
						<td>'.$stock['amount'].'</td>
						<td>'.$stock['exciseamount'].'</td>
					</tr>';
			}
		?>
	</table>
	<?php
	}
	?>