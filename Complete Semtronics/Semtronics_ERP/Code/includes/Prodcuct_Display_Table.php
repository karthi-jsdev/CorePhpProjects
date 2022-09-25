<div class="columns">
	<h3>
		<?php
		include('Config.php');
		include('Reports_Queries.php');
		ini_set("display_errors","0");
		$ProductTotalRows = mysql_fetch_assoc(Product_Select_Count_SubcategoryAll());
		echo "<h4>Total No. of Products - ".$ProductTotalRows['total']."</h4>";
		echo '<div align="right"><a href="#" title="Download" onclick=\'Export_ProductData()\'><img src="images/icons/download.png"></a></div>';
				
		?>
	</h3>			
	<table class="paginate sortable full" style="width:1000px;">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Code</th>
				<th align="left">Description</th>
				<th align="left">Watt</th>
				<th align="left">I/P Voltage</th>
				<th align="left">O/P Voltage</th>
				<th align="left">O/P Current</th>
				<th align="left">Efficiency</th>
				<th align="left">L</th>
				<th align="left">B</th>
				<th align="left">H</th>
				<th align="left">Pack Quantity</th>
				<th align="left">Remarks</th>
			</tr>
		</thead>
		<tbody>
			<?php
			
			if(!$ProductTotalRows['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$i = 1;
			$ProductRows = Product_Select_Subcategory_ByNoLimit();
			while($Product = mysql_fetch_assoc($ProductRows))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>
					<td align='center'>".$Product['code']."</td>
					<td align='left'>".$Product['description']."</td>
					<td align='center'>".$Product['watt']."</td>
					<td align='center'>".$Product['inputvoltage']."</td>
					<td align='center'>".$Product['outputvoltage']."</td>
					<td align='center'>".$Product['outputcurrent']."</td>
					<td align='center'>".$Product['efficiency']."</td>
					<td align='center'>".$Product['l']."</td>
					<td align='center'>".$Product['b']."</td>
					<td align='center'>".$Product['h']."</td>
					<td align='center'>".$Product['packquantity']."</td>
					<td align='center'>".$Product['remarks']."</td>
				</tr>";
			} ?>
		</tbody>
	</table>
</div>