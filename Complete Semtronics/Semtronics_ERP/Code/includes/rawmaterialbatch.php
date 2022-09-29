<?php
	include("Config.php");
	$Stock_status = mysqli_query($_SESSION['connection'],"SELECT batch.number,rawmaterial.id,rawmaterial.minquantity,stock.unitprice,category.name,sum(stock.amount) as amount,sum(stock.quantity) as quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber FROM category 
								INNER JOIN rawmaterial ON categoryid = category.id 
								INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
								INNER JOIN stock ON stock.batchid = batch.id 
								WHERE rawmaterial.id='".$_GET['batch']."' GROUP BY batch.id");
?>
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th align="left">Sl.No.</th>
				<th align="left">RawMaterialCode</th>
				<th align="left">Batch No.</th>
				<th align="left">StockQuantity</th>
				<th align="left">Unitprice</th>
				<th align="left">Amount</th>
				<th align="left">Description</th>
				<th align="left">PartNumber</th>
				<th align="left">Category Name</th>
				<th align="left">Location</th>
			</tr>
		</thead>
<?php
	$i=1;
	while($Stock_quantity = mysqli_fetch_assoc($Stock_status))
	{
		if($Stock_quantity['quantity']==null)
			$Stock_quantity['quantity']='0';
		if($Stock_quantity['amount']==null)
			$Stock_quantity['amount']='0';
		$Stock_location = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT location.name as locationname FROM category
										INNER JOIN rawmaterial ON categoryid = category.id
										INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
										INNER JOIN stockinventory ON stockinventory.batchid = batch.id
										INNER JOIN location ON location.id = stockinventory.locationid
										INNER JOIN stock ON stock.batchid = batch.id
										WHERE rawmaterial.id='".$Stock_quantity['id']."'")); 
		$inspection = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
		$inspect_color = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='1' || stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterial.id"));
		$inspection_green = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by rawmaterial.id)a"));
		$inspection_blue = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by rawmaterial.id)a"));

		echo'<tbody>';
			echo '<tr ';
		if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) < $Stock_quantity['minquantity']) && $inspection_green['total'] >=1)
			echo 'style="color:green;"';
		else if((($Stock_quantity['quantity']-$inspection['quantity'])< $Stock_quantity['minquantity']) && $inspect_color)
			echo 'style="color:red;"';
		if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) > $Stock_quantity['minquantity']) && $inspection_blue['total'] >=1)
			echo 'style="color:blue;"';
		echo '>
				<td>'.$i++.'</td>
				<td>'.$Stock_quantity['materialcode'].'</td>
				<td>'.$Stock_quantity['number'].'</td>';
				echo '<td>'.($Stock_quantity['quantity']-$inspection['quantity']).'</td>
				<td>'.$Stock_quantity['unitprice'].'</td>';
				echo'<td>'.number_format($Stock_quantity['amount']-$inspection['amount'],2).'</td>
				<td>'.$Stock_quantity['description'].'</td>
				<td>'.$Stock_quantity['partnumber'].'</td>
				<td>'.$Stock_quantity['name'].'</td>
				<td>'.$Stock_location['locationname'].'</td>
			</tr>';
	}
	$Stock_status = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(stock.amount) as amount FROM rawmaterial 
								INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
								INNER JOIN stock ON stock.batchid = batch.id 
								WHERE rawmaterial.id='".$_GET['batch']."' GROUP BY rawmaterial.id"));
		echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>
		</td><td><strong>Total Amount is :</strong></td><td>'.number_format($Stock_status['amount'],2).'</td></tr>';
?>
	</tbody>
</table>
