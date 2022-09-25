<?php include("Dashboard_Queries.php");?> 
<table>
	<tr>
		<td>
			<div>
				<h3>Client Summary</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Item</th>
							<th align="left">Details</th>
						</tr>
					</thead>
					<tbody>	
					<?php
					$TotalClients = mysql_fetch_assoc(Total_Clients());
					$NewClients = mysql_fetch_assoc(New_Client_Added_This_Month());
					$ActiveClients = mysql_fetch_assoc(Active_Clients());
					$TotalClientsthisyear = mysql_fetch_assoc(This_YearClients());
					?>
					<tr><td>1</td><td>Total Client List</td><td><?php echo $TotalClients["total"];?></td></tr>
					<tr><td>2</td><td>New Client Added This Month</td><td><?php echo $NewClients["total"]; ?></td></tr>
					<tr><td>3</td><td>Total Active Clients</td><td><?php echo $ActiveClients["total"];?></td></tr>
					<tr><td>4</td><td>Total Client Added Year today</td><td><?php echo $TotalClientsthisyear["total"];?></td></tr>
					</tbody>	
				</table>
			</div>	
		</td>
		
		<td>
			<div style="padding-left:100px;">	
				<h3>Current Month Quotation Status</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Quotation No.</th>
							<th align="left">Client Name</th>
							<th align="left">Quotation Date</th>
							<th align="left">Total Amount</th>
							<th align="left">Status</th>
						</tr>
					</thead>
					<tbody id="MonthQuotation">	
					</tbody>		
				</table>
				<div id="3">
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div>
				<h3>Last Three Month Top Quotation</h3>
				<table class="paginate sortable  full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Quotation No.</th>
							<th align="left">Client Name</th>
							<th align="left">Quotation Date</th>
							<th align="left">Total Amount</th>
						</tr>
					</thead>
					<tbody id="TopQuotation">	
						
					</tbody>	
				</table>
				<div id="1">
				</div>
			</div>	
		</td>
		<td>
			<div style="padding-left:30px;">	
				<h3>Last Three Month Quotation Pending</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Quotation No.</th>
							<th align="left">Client Name</th>
							<th align="left">Quotation Date</th>
							<th align="left">Amount</th>
							<th align="left">Status</th>
						</tr>
					</thead>
					<tbody id="PendingQuotation">
					</tbody>	
				</table>
				<div id="2">
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h3>No.Of Quotation Pending for Last Three Months</h3>
			<table class="paginate sortable">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Client Name</th>
							<th align="left">Total Amount</th>
							<th align="left">Number Of Quotations</th>
						</tr>
					</thead>
					<tbody id="NumberQuotation">
					</tbody>		
			</table>
			<div id="4">
			</div>
		</td>
	</tr>
</table>
<script>
	Ajax_Pagination("TopQuotation", 1);
	Ajax_Pagination("PendingQuotation", 1);
	Ajax_Pagination("MonthQuotation", 1);
	Ajax_Pagination("NumberQuotation", 1);
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		$.post("includes/Dashboard_Data.php?PaginationFor="+PaginationFor+"&CurrentPageNo="+CurrentPageNo, 
		function(Response)
		{
			var Results = Response.split('$');
			document.getElementById(PaginationFor).innerHTML = Results[0];
			if(PaginationFor == "TopQuotation")
				document.getElementById("1").innerHTML = Results[1];
			if(PaginationFor == "PendingQuotation")	
				document.getElementById("2").innerHTML = Results[1];
			if(PaginationFor == "MonthQuotation")	
				document.getElementById("3").innerHTML = Results[1];
			if(PaginationFor == "NumberQuotation")	
				document.getElementById("4").innerHTML = Results[1];
		});
	}
</script>	