<style>
	.table3
	{
		border-collapse: collapse;
	}
	.table3, .tr3, .th3
	{
		border: 1px solid black;
	}
	.td3{
		border-left: 1px solid black;
	}
</style>
<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#startdate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
			$("#enddate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
		});
	</script>
</head>
<?php
include("includes/Quotation_Queries.php");
$quotationdropdown = Quotation_Dropdown();
$clientdropdown = Client_Dropdown();
$statusdropdown = Status_Dropdown();
if(!$_GET['quotation_id'])
{ ?>
<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
	<fieldset>
		<div class="clearfix" style="width:1000px;">
			<label><strong>Quotaion No:</strong>
				<select name="quotaion_id" id="quotaion_id">
					<option value="">All</option>
					<?php 
						while($quotation_number = mysql_fetch_assoc($quotationdropdown))
						{
							if($_GET['quotaion_id']==$quotation_number['id'])
								echo '<option value="'.$quotation_number['id'].'" selected="selected">'.$quotation_number['quotation_no'].'</option>';
							else
								echo '<option value="'.$quotation_number['id'].'" >'.$quotation_number['quotation_no'].'</option>';
						}
					?>
				</select>
			</label>
			<label><strong>Client Name</strong>
				<select name="client_id" id="client_id">
					<option value="">All</option>
					<?php
					while($client_name = mysql_fetch_assoc($clientdropdown))
						{
							if($_GET['client_id']==$client_name['id'])
								echo '<option value="'.$client_name['id'].'" selected="selected">'.$client_name['client_name'].'</option>';
							else
								echo '<option value="'.$client_name['id'].'" >'.$client_name['client_name'].'</option>';
						}
					 ?>
				</select>
			</label>
			<label><strong>Status</strong>
				<select name="status_id" id="status_id">
					<option value="">All</option>
					<?php
					
						while($status = mysql_fetch_assoc($statusdropdown))
						{
							if($_GET['status_id'] == $status['id'])
								echo '<option value="'.$status['id'].'" selected="selected">'.$status['name'].'</option>';
							else
								echo '<option value="'.$status['id'].'">'.$status['name'].'</option>';
						}						
					 ?>
				</select>
			</label>
			<label><strong>Start Date:</strong>
				<input type="text" name="startdate" id="startdate" value="<?php if($_POST['startdate']) echo $_POST['startdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
			</label>
			<label><strong>End Date:</strong>
				<input type="text" name="enddate" id="enddate" value="<?php if($_POST['enddate']) echo $_POST['enddate']; else echo date('d-m-Y');?>">
			</label>
		</div>
	</fieldset>
	<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>		
</form>
<?php } ?>
	<?php	
	if(!$_GET['quotation_id'])
	{ ?>
		<section role="main" id="main">
		<?php
		$TotalRows = mysql_fetch_assoc(Quotation_Summary_Count());
		echo "<br/><h3>Quotation Status: Total Number of Quotations - ".$TotalRows["total"]."</h3>";
		echo '<div align="right"><a href="" title="Download" onclick=\'Export_Data("getdata=totalstatus")\'><img src="images/icons/download.png"></a></div>';
		?>
		<table class="paginate sortable full" id="Filter_Display">
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
			while($quotation_summary = mysql_fetch_assoc($summary))
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
	
	?>
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
			xmlhttp.open("GET","includes/Status_Display_Table.php?quotaion_id="+document.getElementById("quotaion_id").value+"&client_id="+document.getElementById("client_id").value+"&startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value+"&status_id="+document.getElementById("status_id").value, true);
			xmlhttp.send();
		}	
		function Export_Data(PostBackValues)
		{
			window.open("includes/ExportData.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
		}
		
		function Export_Status(PostBackValues)
		{
			window.open("includes/ExportStatus.php?export=1&"+PostBackValues+"&quotaion_id="+document.getElementById("quotaion_id").value+"&client_id="+document.getElementById("client_id").value+"&startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value+"&status_id="+document.getElementById("status_id").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
		}
	</script>