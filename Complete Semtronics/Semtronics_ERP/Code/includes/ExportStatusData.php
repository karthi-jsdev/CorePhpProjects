<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>All Stock Status </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
	if($_GET['getdata']=='Stock_Report')
	{
		$i=1;
		$Stock_status = mysql_query("SELECT rawmaterial.id,rawmaterial.minquantity, stock.unitprice, category.name, sum(stock.amount) AS amount, sum(stock.quantity) AS quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber,location.name as locationname
									FROM category
									INNER JOIN rawmaterial ON categoryid = category.id
									INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
									INNER JOIN stock ON stock.batchid = batch.id
									INNER JOIN stockinventory ON stockinventory.batchid = batch.id
									INNER JOIN location ON location.id = stockinventory.locationid 
									WHERE rawmaterial.id IS NOT NULL || rawmaterial.id IS NULL 
									GROUP BY batch.rawmaterialid");
		?>
		<table class="paginate sortable full" border="1">
			<thead>
				<tr>
					<th align="left">Sl.No.</th>
					<th align="left">RawMaterialCode</th>
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
			while($Stock_quantity = mysql_fetch_assoc($Stock_status))
			{
			if($Stock_quantity['quantity']==null)
				$Stock_quantity['quantity']='0';
			if($Stock_quantity['amount']==null)
				$Stock_quantity['amount']='0';
			$inspection1 = mysql_fetch_assoc(mysql_query("select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='0') group by rawmaterialid"));	
			$inspection = mysql_fetch_assoc(mysql_query("select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
			$inspect_color = mysql_fetch_assoc(mysql_query("select * from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='1' || stockinventory.inspection='2' || stockinventory.inspection='3') group by stockinventory.batchid"));
			$inspection_green = mysql_fetch_assoc(mysql_query("select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by stockinventory.batchid)a"));
			$inspection_blue = mysql_fetch_assoc(mysql_query("select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by stockinventory.batchid)a"));
			echo'<tbody>';
			if(mysql_num_rows($Stock_status)==0)
				echo'<tr><td colspan="7" style="color:red;"><center>No data Found</center></td></tr>';
			echo '<tr ';
			/*if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) < $Stock_quantity['minquantity']) && $inspection_green['total'] >=1)
				echo 'style="color:green;"';
			else if((($Stock_quantity['quantity']-$inspection['quantity'])< $Stock_quantity['minquantity']) && $inspect_color)
				echo 'style="color:red;"';
			if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) > $Stock_quantity['minquantity']) && $inspection_blue['total'] >=1)
				echo 'style="color:blue;"';*/
			echo '>
					<td>'.$i++.'</td>
					<td>'.$Stock_quantity['materialcode'].'</td>';
					echo '<td>'.($Stock_quantity['quantity']-$inspection1['quantity']-$inspection['quantity']).'</td>
						<td>'.$Stock_quantity['unitprice'].'</td>';
					echo'<td>'.($Stock_quantity['amount']-$inspection['amount']-$inspection1['amount']).'</td>
					<td>'.$Stock_quantity['description'].'</td>
					<td>'.$Stock_quantity['partnumber'].'</td>
					<td>'.$Stock_quantity['name'].'</td>
					<td>'.$Stock_quantity['locationname'].'</td>
				</tr></tbody>';
			}
echo	'</table>';
	}
	?>
		
	