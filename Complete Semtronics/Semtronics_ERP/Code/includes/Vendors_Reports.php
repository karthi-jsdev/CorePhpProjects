<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix" style="width:1000px;">
			<label><strong>Vendor Category</strong>
				<select name="vendor_category_id" id="vendor_category_id">
					<option value="">All</option>
					<?php 
						$vendor_category = vendor_category_name();
						while($vendor_category_number = mysql_fetch_assoc($vendor_category))
						{
							if($_GET['vendor_category_id']==$vendor_category_number['id'])
								echo '<option value="'.$vendor_category_number['id'].'" selected="selected">'.$vendor_category_number['name'].'</option>';
							else
								echo '<option value="'.$vendor_category_number['id'].'" >'.$vendor_category_number['name'].'</option>';
						}
					?>
				</select>
			</label><br />
				<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>		
		</div>		
	</fieldset>
</form>
<?php
 if(!$_GET['vendor_category_id'])
	{ ?>
		<section role="main" id="main">
		<?php
		$VendorTotalRows = mysql_fetch_assoc(Vendors_Count());
		echo "<h4>Vendor Status: Total Number of Vendors - ".$VendorTotalRows["total"]."</h4>";
		echo '<div align="right"><a href="" title="Download" onclick=\'Export_Vendor_Data()\'><img src="images/icons/download.png"></a></div>';
			if($VendorTotalRows["total"])
			{
				?>
				<table class="paginate sortable full" id="Filter_Display">
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
						
						$i = $Start = ($_GET['pageno']-1)*$Limit;*/
						//$i++;
						//$VendorRows = Vendor_Select_ByLimit($Start, $Limit);
						$i=1;
						$VendorRows = Vendor_Select_ByLimit();
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
				
			} ?>
		</section>
<?php
	} ?>
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
			{
				document.getElementById("main").innerHTML = xmlhttp.responseText;
			}
				
		}
		xmlhttp.open("GET","includes/Vendor_Display_Table.php?vendor_category_id="+document.getElementById("vendor_category_id").value, true);
		xmlhttp.send();
	}	
	function Export_Vendor_Data()
	{
		window.open("includes/Custom_Report_Actions.php?Module=Vendor&vendor_category_id="+$("#vendor_category_id").val(),'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>		