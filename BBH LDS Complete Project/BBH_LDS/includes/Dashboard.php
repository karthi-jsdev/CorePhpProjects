<?php include("Dashboard_Queries.php");?>
<table>
<!--div align='right'><a href="" title="Download" onclick='Export()'><img src="images/icons/download.png"></a></div-->
	<tr>
		<td>
			<div>
				<h3>Present Day Leave Summary</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Department</th>
							<th align="left">No.Of.Persons</th>
						</tr>
					</thead>
					<tbody id="presentleave">	
					</tbody>	
				</table>
				<div id="1">
				</div>
			</div>	
		</td>
		
		<td>
			<div style="padding-left:50px;">	
				<h3>Future Day Leave Summary</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Department</th>
							<th align="left">No.Of.Persons</th>
						</tr>
					</thead>
					<tbody id="futureleave">	
						
					</tbody>	
				</table>
				<div id="2">
				</div>
			</div>
		</td>
	
		<td>
			<div style="padding-left:50px;">
				<h3>Past Day Leave Summary</h3>
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Department</th>
							<th align="left">No.Of.Persons</th>
						</tr>
					</thead>
					<tbody id="pastleave">	
					</tbody>	
				</table>
				<div id="3">
				</div>
			</div>	
		</td>
	</tr>
</table>
	<div>
		<h3>Consultant Doctors Present Leave Summary</h3>
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Name</th>
					<th align="left">Group</th>
					<th align="left">Department</th>
					<th align="left">Comments</th>
					<th align="left">Start Date</th>
					<th align="left">End Date</th>
				</tr>
			</thead>
			<tbody id="consultantpresentleave">
			</tbody>
		</table>
		<div id="4">
		</div>	
	</div>	
	<!--div>	
		<h3>Consultant Doctors Future Day Leave Summary</h3>
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Name</th>
					<th align="left">Group</th>
					<th align="left">Department</th>
					<th align="left">Comments</th>
					<th align="left">Start Date</th>
					<th align="left">End Date</th>
				</tr>
			</thead>
			<tbody id="consultantfutureleave">	
				
			</tbody>	
		</table>
		<div id="5">
		</div>
	</div-->
	<!--div>
		<h3>Consultant Doctors Past Day Leave Summary</h3>
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Name</th>
					<th align="left">Group</th>
					<th align="left">Department</th>
					<th align="left">Comments</th>
					<th align="left">Start Date</th>
					<th align="left">End Date</th>
				</tr>
			</thead>
			<tbody id="consultantpastleave">	
			</tbody>	
		</table>
		<div id="6">
		</div>
	</div-->	
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
	include("includes/Leavechart.php");
?>
<script>
	Ajax_Pagination("presentleave", 1);
	Ajax_Pagination("futureleave", 1);
	Ajax_Pagination("pastleave", 1);
	Ajax_Pagination("consultantpresentleave", 1);
	Ajax_Pagination("consultantfutureleave", 1);
	Ajax_Pagination("consultantpastleave", 1);
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		$.post("includes/Dashboard_Data.php?PaginationFor="+PaginationFor+"&CurrentPageNo="+CurrentPageNo, 
		function(Response)
		{
			var Results = Response.split('$');
			document.getElementById(PaginationFor).innerHTML = Results[0];
			if(PaginationFor == "presentleave")
				document.getElementById("1").innerHTML = Results[1];
			if(PaginationFor == "futureleave")	
				document.getElementById("2").innerHTML = Results[1];
			if(PaginationFor == "pastleave")	
				document.getElementById("3").innerHTML = Results[1];
			if(PaginationFor == "consultantpresentleave")	
				document.getElementById("4").innerHTML = Results[1];
			if(PaginationFor == "consultantfutureleave")	
				document.getElementById("5").innerHTML = Results[1];
			if(PaginationFor == "consultantpastleave")	
				document.getElementById("6").innerHTML = Results[1];
		});
	}
	function Export()
	{
		window.open("includes/ExportData.php?export=1",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>	