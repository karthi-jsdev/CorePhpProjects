<div class="columns">
	<h3>
		<?php
		$LeadTotalRows = mysql_fetch_assoc(Lead_Select_Count_All());
		echo '<div>'."Total No. of Leads - ".$LeadTotalRows['total'];
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Search" id="Search" name="Search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/>';
		?>
	</h3>
	<div style="width: 1000px; overflow-x: auto;" >
		<table class="paginate sortable full" style="width: 2100px;">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Lead No</th>
					<th align="left">Name</th>
					<th align="left">Address</th>
					<th align="left">Email Id</th>
					<th align="left">Phone No.</th>
					<th align="left">Contact Person Name</th>
					<th align="left">Designation</th>
					<th align="left">Email</th>
					<th align="left">Contact Phone</th>
					<th align="left">Contact Person Name</th>
					<th align="left">Designation</th>
					<th align="left">Email</th>
					<th align="left">Contact Phone</th>
					<th align="left">Client Category</th>
					<th align="left">Referred By</th>
				</tr>
			</thead>
			<tbody id="AllLeadSummary">
				
			</tbody>
		</table>
		<div id="1"></div>
	</div>
</div>
<?php 

$LeadfollowupTotalRows = mysql_num_rows(Lead_followupSelect_Count_All());
if($LeadfollowupTotalRows)
{
?>
<div class="clear">&nbsp;</div>
<div class="columns">
	<h2>Follow Ups For The Next Two Weeks</h2>
	<h3>
		<?php
		echo '<div>'."Total No. of Leads - ".$LeadfollowupTotalRows;
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Search" id="Search1" name="Search" /><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/></div>';
		?>
	</h3>
	<div style="width: 1000px; overflow-x: auto;" >
		<table class="paginate sortable full" style="width: 2100px;">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Lead No</th>
					<th align="left">Name</th>
					<th align="left">Follow-Up-Date</th>
					<th align="left">Address</th>
					<th align="left">Email Id</th>
					<th align="left">Phone No.</th>
					<th align="left">Contact Person Name</th>
					<th align="left">Designation</th>
					<th align="left">Email</th>
					<th align="left">Contact Phone</th>
					<th align="left">Contact Person Name</th>
					<th align="left">Designation</th>
					<th align="left">Email</th>
					<th align="left">Contact Phone</th>
					<th align="left">Client Category</th>
					<th align="left">Referred By</th>
				</tr>
			</thead>
			<tbody id="FollowupLeadSummary">
			</tbody>
		</table>
		<div id="2"></div>
	</div>
</div>
<div class="clear">&nbsp;</div>
<?php }
else
	echo "<div><center><strong>No Follow-up for next two week</strong></center></div>"; ?>
<script>
	function Search()
	{
		document.location.assign("index.php?page=Sales&subpage=spage->Lead,ssubpage-><?php echo $_GET['ssubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value+"&Search1="+document.getElementById("Search1").value);
	}
	Ajax_Pagination("AllLeadSummary", 1);
	<?php 
	$LeadfollowupTotalRows = mysql_num_rows(Lead_followupSelect_Count_All());
	if($LeadfollowupTotalRows)
	{
	?>
	Ajax_Pagination("FollowupLeadSummary", 1);
	<?php } ?>
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		$.post("includes/Lead_Summary_Data.php?PaginationFor="+PaginationFor+"&CurrentPageNo="+CurrentPageNo+"&Search=<?php echo $_GET['Search']; ?>&Search1=<?php echo $_GET['Search1']; ?>", 
		function(Response)
		{
			var Results = Response.split('$');
			document.getElementById(PaginationFor).innerHTML = Results[0];
			if(PaginationFor == "AllLeadSummary")
				document.getElementById("1").innerHTML = Results[1];
			if(PaginationFor == "FollowupLeadSummary")	
				document.getElementById("2").innerHTML = Results[1];
		});
	}
</script>