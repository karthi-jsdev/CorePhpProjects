<?php
include('Config.php');

?>
<br/><br/>
<form action="" method="POST">
	<div style="float:right">
		<input type="text" value="<?php echo $_POST['stock1'];?>" name="stock1" id="contet">
		<a id="check" onclick="Display_Table();" class="button button-orange">Search</a>
	</div>
	<br/><br/>
	<table class="paginate sortable full" id="display1">
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
	$Stock_status_count = mysql_fetch_assoc(mysql_query("SELECT count(*)as total
								FROM category
								INNER JOIN rawmaterial ON categoryid = category.id
								INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
								INNER JOIN stock ON stock.batchid = batch.id
								WHERE rawmaterialid IS NOT NULL "));
	$Limit = 10;
	$total_pages = ceil($Stock_status_count['total'] / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
	$Stock_status = mysql_query("SELECT rawmaterial.id,rawmaterial.minquantity,stock.unitprice,category.name,sum(stock.amount) as amount,sum(stock.quantity) as quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber
								FROM category
								INNER JOIN rawmaterial ON categoryid = category.id
								INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
								INNER JOIN stock ON stock.batchid = batch.id
								WHERE rawmaterialid IS NOT NULL GROUP BY batch.rawmaterialid");
	if($Stock_status_count['total']==0)
		echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
	else
	{
		$j=1;
		while($Stock_quantity = mysql_fetch_assoc($Stock_status))
		{
			if($Stock_quantity['quantity']==null)
				$Stock_quantity['quantity']='0';
			if($Stock_quantity['amount']==null)
				$Stock_quantity['amount']='0';
			 $Stock_location = mysql_fetch_assoc(mysql_query("SELECT location.name as locationname FROM category
											INNER JOIN rawmaterial ON categoryid = category.id
											INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
											INNER JOIN stockinventory ON stockinventory.batchid = batch.id
											INNER JOIN location ON location.id = stockinventory.locationid
											INNER JOIN stock ON stock.batchid = batch.id
											WHERE rawmaterial.id='".$Stock_quantity['id']."'")); 
			$inspection = mysql_fetch_assoc(mysql_query("select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
			$inspect_color = mysql_fetch_assoc(mysql_query("select * from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='1' || stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterial.id"));
			$inspection_green = mysql_fetch_assoc(mysql_query("select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by rawmaterial.id)a"));
			$inspection_blue = mysql_fetch_assoc(mysql_query("select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by rawmaterial.id)a"));

			echo'<tbody>';
				echo '<tr ';
			if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) < $Stock_quantity['minquantity']) && $inspection_green['total'] >=1)
				echo 'style="color:green;"';
			else if((($Stock_quantity['quantity']-$inspection['quantity'])< $Stock_quantity['minquantity']) && $inspect_color)
				echo 'style="color:red;"';
			if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) > $Stock_quantity['minquantity']) && $inspection_blue['total'] >=1)
				echo 'style="color:blue;"';
			echo '>
					<td>'.$j++.'</td>
					<form action="" method="POST">
					<td>'.$Stock_quantity['materialcode'].'
						<input type="hidden" id="batches" value="'.$Stock_quantity['id'].'">
					</form><a href="#" onclick="Batchs('.$Stock_quantity['id'].')" ><img src="images/plus1.png" width="20px" height="20px"></a>&nbsp;&nbsp;<img src="images/minus.png" width="20px" height="20px" onclick="batchvalues()"></td>';
					echo '<td>'.($Stock_quantity['quantity']-$inspection['quantity']).'</td>
					<td>'.$Stock_quantity['unitprice'].'</td>';
					echo'<td>'.number_format($Stock_quantity['amount']-$inspection['amount'],2).'</td>
					<td>'.$Stock_quantity['description'].'</td>
					<td>'.$Stock_quantity['partnumber'].'</td>
					<td>'.$Stock_quantity['name'].'</td>
					<td>'.$Stock_location['locationname'].'</td>
				</tr>';
		}
			echo '<div id="batchs"></div>';
	}
	?>
		</tbody>
	</table><br/>
			<table>
			<tr>
				<td style='background:red;width:20px;'></td><td>Less than minimum quantity</td>
				<td style='background:green;width:20px;'></td><td>Less than minimum quantity and Inspection needed</td></tr>
				<td style='background:blue;width:20px;'></td><td>Inspection needed</td></tr>
			</tr>
		</table>
</form>
<div class="clear">&nbsp;</div>
	<?php
		$GETParameters = "page=".$_GET['page']."&subpage=spage->".$_GET['spage'].",ssubpage->".$_GET['ssubpage']."&";
		if($total_pages > 1)
		include("includes/Pagination.php");
	?>
<script>
	function Display_Table()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("display1").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Stock_status_ajax.php?stock1="+document.getElementById('contet').value, true);
		xmlhttp.send();
	}
	function Batchs(batch)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("batchs").innerHTML=xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/rawmaterialbatch.php?batch="+batch,true);
		xmlhttp.send();
	}
	function batchvalues()
	{
		document.getElementById("batchs").innerHTML='';
	}
</script>