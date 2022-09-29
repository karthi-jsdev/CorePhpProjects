<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix" style="width:1000px;">
			<label><strong>Rawmaterial Category</strong>
				<select name="rawmaterial_category_id" id="rawmaterial_category_id">
					<option value="">All</option>
					<?php 
						$rawmaterial_category = rawmaterial_category_name();
						while($rawmaterial_category_number = mysqli_fetch_assoc($rawmaterial_category))
						{
							if($_GET['vendor_category_id']==$rawmaterial_category_number['id'])
								echo '<option value="'.$rawmaterial_category_number['id'].'" selected="selected">'.$rawmaterial_category_number['name'].'</option>';
							else
								echo '<option value="'.$rawmaterial_category_number['id'].'" >'.$rawmaterial_category_number['name'].'</option>';
						}
					?>
				</select>
			</label><br />
			<label><input type="checkbox" name="minimumquantity" id ="minimumquantity">Minimum Order Quantity<br></label>
				<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>	
		</div>		
	</fieldset>
</form>
<?php
	if(!$_GET['rawmaterial_category_id'])
	{
	?>
		<section role="main" id="main">
		<?php
		$i=1;
		$Stock_status = mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,rawmaterial.minquantity,stock.unitprice,category.name,sum(stock.amount) as amount,sum(stock.quantity) as quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber
								FROM category
								INNER JOIN rawmaterial ON categoryid = category.id
								INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
								INNER JOIN stock ON stock.batchid = batch.id
								WHERE rawmaterialid IS NOT NULL GROUP BY batch.rawmaterialid");
		echo "<h4>Stock Status: Total Number of Stocks - ".mysqli_num_rows($Stock_status)."</h4>";
		?>
		<div align="right"><a href="" title="Download" onclick='Export_Data("getdata=Stock_Report")'><img src="images/icons/download.png"></a></div>
		<table class="paginate sortable full" id="Filter_Display">
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
			echo'<tbody>';
					if(mysqli_num_rows($Stock_status)==0)
						echo'<tr><td colspan="7" style="color:red;"><center>No data Found</center></td></tr>';
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
						$inspection1 = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='0') group by rawmaterialid"));	
						$inspection = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
						$inspect_color = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='1' || stockinventory.inspection='2' || stockinventory.inspection='3') group by stockinventory.batchid"));
						$inspection_green = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by stockinventory.batchid)a"));
						$inspection_blue = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by stockinventory.batchid)a"));
						echo '<tr ';
					/*	if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) < $Stock_quantity['minquantity']) && $inspection_green['total'] >=1)
							echo 'style="color:green;"';
						else if((($Stock_quantity['quantity']-$inspection['quantity'])< $Stock_quantity['minquantity']) && $inspect_color)
							echo 'style="color:red;"';
						if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) > $Stock_quantity['minquantity']) && $inspection_blue['total'] >=1)
							echo 'style="color:blue;"';*/
						echo '>
								<td>'.$i++.'</td>
								<form action="" method="POST">
								<td>'.$Stock_quantity['materialcode'].'
									<input type="hidden" id="batches" value="'.$Stock_quantity['id'].'">
								</form><a href="#" onclick="Batchs('.$Stock_quantity['id'].')" ><img src="images/plus1.png" width="20px" height="20px"></a>&nbsp;&nbsp;<img src="images/minus.png" width="20px" height="20px" onclick="batchvalues()"></td>';
					
								echo '<td>'.($Stock_quantity['quantity']-$inspection1['quantity']-$inspection['quantity']).'</td>
								<td>'.$Stock_quantity['unitprice'].'</td>';
								echo'<td>'.number_format($Stock_quantity['amount']-$inspection['amount']-$inspection1['amount'],2).'</td>
								<td>'.$Stock_quantity['description'].'</td>
								<td>'.$Stock_quantity['partnumber'].'</td>
								<td>'.$Stock_quantity['name'].'</td>
								<td>'.$Stock_location['locationname'].'</td>
						</tr>';
					} 
					echo '<div id="batchs"></div>';
					?>
			</tbody>	
		</table>
	</section>
<?php 
	} ?>
	<script>
	function Display_Table()
	{
		var minimumquantity = document.getElementsByName("minimumquantity");
		var flag = 0;
			for (var i = 0; i< minimumquantity.length; i++)
				if(minimumquantity[i].checked)
					flag++;
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("main").innerHTML = xmlhttp.responseText;
			}
				
		}
		xmlhttp.open("GET","includes/Stock_Display_Table.php?rawmaterial_category_id="+document.getElementById("rawmaterial_category_id").value+"&minimumquantity="+flag, true);
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
	function Export_Data()
	{
		window.open("includes/Custom_Report_Actions.php?Module=Stock_Status&rawmaterial_category_id="+$("#rawmaterial_category_id").val(),'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Export_StatusData()
	{
		var minimumquantity = document.getElementsByName("minimumquantity");
		var flag = 0;
			for (var i = 0; i< minimumquantity.length; i++)
				if(minimumquantity[i].checked)
					flag++;
		window.open("includes/Custom_Report_Actions.php?Module=Stock_Status&&rawmaterial_category_id="+document.getElementById("rawmaterial_category_id").value+"&minimumquantity="+flag,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function batchvalues()
	{
		document.getElementById("batchs").innerHTML='';
	}
</script>