<table class="paginate sortable full">
	<thead>
		<tr>
			<th width="43px" align="center">S.NO.</th>
			<th align="left">Vendor Id</th>
			<th align="left">Vendor Name</th>
			<th align="left">Category</th>
			<th align="left">Address</th>
			<th align="left">Phone No.</th>
			<th align="left">E-Mail Id</th>
			<th align="left">Cont. Person</th>
			<th align="left">Credit Limit</th>
			<th align="left">Credit Period</th>
			<th align="left">Lead Time</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include('Config.php');
		include('Reports_Queries.php');
		ini_set("display_errors","0");
		$VendorTotalRows = mysqli_fetch_assoc(VendorsCategory_Count());
		echo "<h4>Vendor Status: Total Number of Vendors - ".$VendorTotalRows["total"]."</h4>";
		echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Vendor_Data()\'><img src="images/icons/download.png"></a></div>';
			if(!$VendorTotalRows['total'])
				echo '<tr><td colspan="11"><font color="red"><center>No data found</center></font></td></tr>';
			/*$Limit = 10;
			$total_pages = ceil($VendorTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$VendorRows = Vendor_Category_Select_ByLimit($Start, $Limit);*/
			$i=1;
			$VendorRows = Vendor_Category_Select_ByLimit();
			while($Vendor = mysqli_fetch_assoc($VendorRows))
			{
				$CreditIdExplode = explode('.',$Vendor['categoryid']);
				$FetchCreditPeriod = mysqli_fetch_array(FetchCreditPeriodById($Vendor['creditperiodid']));
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>
					<td>".$Vendor['vendorid']."</td>
					<td>".$Vendor['name']."</td><td>";
					$I = count($CreditIdExplode);
					foreach($CreditIdExplode as $CreditId)	
					{
						$I -= 1;
						$FetchCreditId = mysqli_fetch_array(Select_VendorCategoryById($CreditId));
						echo $FetchCreditId['name'];
						if($I)
							echo ',';
					}
				echo "</td><td>".$Vendor['address']."</td>
					<td>".$Vendor['phonenumber']."</td>
					<td>".$Vendor['email']."</td>
					<td>".$Vendor['contactperson']."</td>
					<td>".$Vendor['creditlimit']."</td>
					<td>".$FetchCreditPeriod['period']."</td>
					<td>".$Vendor['leadtime']."</td>
				</tr>";
			} ?>
	</tbody>
</table>