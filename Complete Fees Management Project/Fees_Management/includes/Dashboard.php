<table>
<!--div align='right'><a href="" title="Download" onclick='Export()'><img src="images/icons/download.png"></a></div-->
	<tr>
		<td>	
			<div>
				<h3>Total amount Collected this year</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Class Name</th>
							<th align="left">Amount</th>
						</tr>
					</thead>
					<tbody id="Thisyearcollection">	
					</tbody>	
				</table>
				<div id="1">
				</div>
			</div>	
		</td>
		<td>&nbsp;&nbsp;</td>
		<td>	
			<div>
				<h3>Total amount Collected this month</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Class Name</th>
							<th align="left">Amount</th>
						</tr>
					</thead>
					<tbody id="Thismonthcollection">	
					</tbody>	
				</table>
				<div id="2">
				</div>
			</div>	
		</td>
	</tr>
	
</table>
<table>
<!--div align='right'><a href="" title="Download" onclick='Export()'><img src="images/icons/download.png"></a></div-->
	<tr>
		<td>	
			<div>
				<h3>Total amount Pending this year</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Class Name</th>
							<th align="left">Amount</th>
						</tr>
					</thead>
					<tbody id="Thisyearpending">	
					</tbody>	
				</table>
				<div id="3">
				</div>
			</div>	
		</td>
		<td>&nbsp;&nbsp;</td>
		<td>	
			<div>
				<h3>Total amount Pending this month</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Class Name</th>
							<th align="left">Amount</th>
						</tr>
					</thead>
					<tbody id="Thismonthpending">	
					</tbody>	
				</table>
				<div id="4">
				</div>
			</div>	
		</td>
	</tr>
	
</table>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<script>
	Ajax_Pagination("Thisyearcollection", 1);
	Ajax_Pagination("Thismonthcollection", 2);
	Ajax_Pagination("Thisyearpending", 3);
	Ajax_Pagination("Thismonthpending", 4);
	
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		
		$.ajax({ url: "includes/Dashboard_Data.php", dataType: 'text', type: 'POST', contentType: 'application/x-www-form-urlencoded', data: "PaginationFor="+PaginationFor+"&pageno="+CurrentPageNo, success: function(data, textStatus, jQxhr )
		{
			var Results = data.split('$');
			document.getElementById(PaginationFor).innerHTML = Results[0];
			if(PaginationFor == "Thisyearcollection")
				document.getElementById("1").innerHTML = Results[1];
			if(PaginationFor == "Thismonthcollection")
				document.getElementById("2").innerHTML = Results[1];
			if(PaginationFor == "Thisyearpending")
				document.getElementById("3").innerHTML = Results[1];
			if(PaginationFor == "Thismonthpending")
				document.getElementById("4").innerHTML = Results[1];
		
		}
		});
		/* $.post("includes/Dashboard_Data.php?PaginationFor="+PaginationFor+"&CurrentPageNo="+CurrentPageNo,
		function(Response)
		{
		console.log(Response);
		}); */
	}
	function Export()
	{
		window.open("includes/ExportData.php?export=1",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>	