<?php
	include("Config.php");
	include("Reports_Queries.php");
	if($_GET['status'])
	{
?>	
			<?php
				$SaleOrderCommentsTotalRows = mysql_fetch_assoc(Select_Comments());
				echo "<h4>Sale Order Comments List - ".$SaleOrderCommentsTotalRows['total']."</h4>";
				echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Data("getdata=SaleOrder_Report")\'><img src="images/icons/download.png"></a></div>';			
			?>
		<table  class="paginate sortable full">
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