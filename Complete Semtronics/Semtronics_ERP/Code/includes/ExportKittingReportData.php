<?php  
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		include("Reports_Queries.php");
		ini_set("display_errors","0");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>Kitting Report </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	} 
	if($_GET['getdata']=='KittingName_Report')
	{ ?>
<table class="paginate sortable full" border="1">
				<thead>
					<tr>
						<th>S.NO.</th>
						<th align="left">Kitting Name</th>
						<th align="left">Product Code</th>
						<th align="left">Rawmaterial Code</th>
						<th align="left">Quantity</th>
						<th align="left">Reference</th>
						<th align="left">Part Number</th>
						<th align="left">Unit Cost</th>
						<th align="left">Total cost</th>
						<th align="left">Stock</th>
						<th align="left">Kitting Quantity</th>
						<th align="left">Total Price of kitting</th>
						<th align="left">Vendor Name</th>
					</tr>
				</thead>
			<?php	
			$SelectKittingData = mysqli_query($_SESSION['connection'],"Select * From kitting where kittingname='".$_GET['kittingname']."'");
			$i = 1;
			while($FetchKittingData = mysqli_fetch_array($SelectKittingData))
			{
				echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$FetchKittingData['kittingname'].'</td>
						<td>'.$FetchKittingData['productcode'].'</td>
						<td>'.$FetchKittingData['rawmeterialcode'].'</td>
						<td>'.$FetchKittingData['quantity'].'</td>
						<td>'.$FetchKittingData['reference'].'</td>
						<td>'.$FetchKittingData['partnumber'].'</td>
						<td>'.$FetchKittingData['unitcost'].'</td>
						<td>'.$FetchKittingData['total'].'</td>';
						if($FetchKittingData['stock']==NULL)
							echo '<td>0</td>';
						else
							echo '<td>'.$FetchKittingData['stock'].'</td>';
						echo '<td>'.$FetchKittingData['kittingquantity'].'</td>
						<td>'.$FetchKittingData['totalprice'].'</td>
						<td>'.$FetchKittingData['vendorname'].'</td>
					</tr>';
			}
			echo '</table>';
	}
		?>	