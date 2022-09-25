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
		$sales_status = mysql_fetch_assoc(mysql_query("select * from saleorder_comments JOIN salesorder_status ON saleorder_comments.status_id = salesorder_status.id where status_id='".$_GET['status']."' order by saleorder_comments.id desc"));
		echo '<div align="center">
		<h4>SalesOrderStatus:'.$sales_status['sales_status'].'</div><div align="right">Report Date:'.date("d-m-Y").'
		</h4></div>';
		
	}
	if($_GET['getdata']=='SaleOrder_Report')
	{ 
				$SaleOrderCommentsTotalRows = mysql_fetch_assoc(Select_Comments());
				echo "<h4>Sale Order Comments List - ".$SaleOrderCommentsTotalRows['total']."</h4>";
			?>
		<table  class="paginate sortable full" border="1">
			<thead>
				<tr>
					<th>SO No</th>
					<th>Comment Date</th>
					<th>Comments</th>
					<th>Status</th>
					<th>Updated By</th>
				</tr>
			</thead>
			<?php
				if(!$SaleOrderCommentsTotalRows['total'])
					echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
				$i = 1;
				$i++;
				$SelectComments = Select_CommentsNolimitdiplay();
				while($FetchComments = mysql_fetch_array($SelectComments))
				{
					$FetchStatus = mysql_fetch_array(FetchStatus($FetchComments['status_id']));
					$FetchUser  = mysql_fetch_array(FetchUser($FetchComments['updatedby']));
				$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
						$SONo = "SO".$Digits[7 - strlen($FetchComments['sales_orderid'])].($FetchComments['sales_orderid']);
					echo '<tr>
							<td align="center">'.$SONo.'</td>
							<td align="center">'.$FetchComments['comment_date'].'</td>
							<td align="left">'.$FetchComments['comments'].'</td>
							<td align="center">'.$FetchStatus['sales_status'].'</td>
							<td align="center">'.$FetchUser['firstname'].'</td>
					</tr>';
				}
			?>
		</table>
	<?php
	} 
?>	