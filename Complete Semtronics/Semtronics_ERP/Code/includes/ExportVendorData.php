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
		echo '<div align="center"><h4>All Vendors </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
		
	if($_GET['getdata']=='vendors_Report')
	{  ?>

		<section role="main" id="main">
			<?php
			$VendorTotalRows = mysql_fetch_assoc(Vendors_Count());
		//	echo "<h4>Vendor Status: Total Number of Vendors - ".$VendorTotalRows["total"]."</h4>";
			?>
			<table class="paginate sortable full" border="1">
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
					if(!$VendorTotalRows['total'])
						echo '<tr><td colspan="11"><font color="red"><center>No data found</center></font></td></tr>';
					/*$Limit = 10;
					$total_pages = ceil($VendorTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$VendorRows = Vendor_Select_ByLimit($Start, $Limit);*/
					$VendorRows = Vendor_Select_ByLimit();
					$i=1;
					while($Vendor = mysql_fetch_assoc($VendorRows))
					{
						$CreditIdExplode = explode('.',$Vendor['categoryid']);
						$FetchCreditPeriod = mysql_fetch_array(FetchCreditPeriodById($Vendor['creditperiodid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Vendor['vendorid']."</td>
							<td>".$Vendor['name']."</td><td>";
							$I = count($CreditIdExplode);
							foreach($CreditIdExplode as $CreditId)	
							{
								$I -= 1;
								$FetchCreditId = mysql_fetch_array(Select_VendorCategoryById($CreditId));
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
			<?php
			/*$GETParameters = "page=Reports&subpage=spage->Store_Reports,ssubpage->Vendors_Reports";
			if($total_pages > 1)
				include("includes/Pagination.php");*/
			?>
		</section>
	<?php
	} 	?>