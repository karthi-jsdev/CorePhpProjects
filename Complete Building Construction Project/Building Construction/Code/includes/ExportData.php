<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Quotation_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
	}
		
	if($_GET['getdata']=='totalstatus')
	{ ?>
		<section role="main" id="main">
		<?php
		$TotalRows = mysqli_fetch_assoc(Quotation_Summary_Count());
		echo "<br/><h3>Quotation Status: Total Number of Quotations - ".$TotalRows["total"]."</h3>";
	?>
		<table class="paginate sortable full" id="Filter_Display" border='1'>
			<thead>
				<tr>
					<th align="left">Sl.No.</th>
					<th align="left">Quotation Number</th>
					<th align="left">Client</th>
					<th align="left">Subject</th>
					<th align="left">Quotation Date</th>
				</tr>
			</thead>
		<?php
			$Limit = 10;
			$total_pages = ceil($TotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
			$summary = Quotation_Summary($Start,$Limit);
			echo $summary['name'];
			while($quotation_summary = mysqli_fetch_assoc($summary))
			{
				echo'<tbody><tr>
						<td>'.$i++.'</td>
						<td><a href="?page=Quotation&subpage=Quotation Status&quotation_id='.$quotation_summary['id'].'">'.$quotation_summary['quotation_no'].'</a></td>
						<td>'.$quotation_summary['client_name'].'</td>
						<td>'.$quotation_summary['subject'].'</td>
						<!--td>'.$quotation_summary['amount'].'</td-->
						<td>'.date('d-m-Y',strtotime($quotation_summary['quotation_date'])).'</td>
					</tr>
				</tbody>';
			} ?>
		</table>
		<?php
		$GETParameters = "page=Quotation&subpage->Quotation Status&";
		if($total_pages > 1)
			include("includes/Pagination.php");
			?>
	</section>	
	<?php
	} 
	
