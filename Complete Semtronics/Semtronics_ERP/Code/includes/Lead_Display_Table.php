<?php
	include("Config.php");
	include("Reports_Queries.php");
	$LeadTotalRows = mysql_fetch_assoc(Lead_Select_displayCount_All());
		echo "<h4>Total No. of Leads - ".$LeadTotalRows['total']."</h4>";
		echo '<div align="right"><a href="#" title="Download" onclick=\'Export_LeadData("getdata=Lead_Report")\'><img src="images/icons/download.png"></a></div>';
		if(!$_GET['account'])
		{
	?>
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
						<th align="left">Reference Group</th>
						<th align="left">Industry</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(!$LeadTotalRows['total'])
							echo '<tr><td colspan="20"><font color="red"><center>No data found</center></font></td></tr>';
						$i = 1;
						$LeadRows = Lead_Select_BydisplayNoLimit();
						while($Lead = mysql_fetch_assoc($LeadRows))
						{
							$Digits = array("","0", "00", "000", "0000", "00000", "000000");
							$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);
							echo "<tr style='valign:middle;'>
								<td align='center'>".$i++."</td>
								<td>".$LDNo."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['address']."</td>
								<td>".$Lead['email_id']."</td>
								<td>".$Lead['contact_no']."</td>
								<td>".$Lead['contact_person1']."</td>
								<td>".$Lead['designation1']."</td>
								<td>".$Lead['email_id1']."</td>
								<td>".$Lead['contact_no1']."</td>
								<td>".$Lead['contact_person2']."</td>
								<td>".$Lead['designation2']."</td>
								<td>".$Lead['email_id2']."</td>
								<td>".$Lead['contact_no2']."</td>
								<td>".$Lead['clientcategory']."</td>
								<td>".$Lead['reference']."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['name']."</td>
							</tr>";
						} ?>
				</tbody>		
			</table>		
		</div>			
	<?php
	} 
	else
	{ ?>
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
						<th align="left">Reference Group</th>
						<th align="left">Industry</th>
						<th align="left">Add To Account</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(!$LeadTotalRows['total'])
							echo '<tr><td colspan="20"><font color="red"><center>No data found</center></font></td></tr>';
						$i = 1;
						$LeadRows = Lead_Select_BydisplayNoLimit();
						while($Lead = mysql_fetch_assoc($LeadRows))
						{
							$Digits = array("","0", "00", "000", "0000", "00000", "000000");
							$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);
							echo "<tr style='valign:middle;'>
								<td align='center'>".$i++."</td>
								<td>".$LDNo."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['address']."</td>
								<td>".$Lead['email_id']."</td>
								<td>".$Lead['contact_no']."</td>
								<td>".$Lead['contact_person1']."</td>
								<td>".$Lead['designation1']."</td>
								<td>".$Lead['email_id1']."</td>
								<td>".$Lead['contact_no1']."</td>
								<td>".$Lead['contact_person2']."</td>
								<td>".$Lead['designation2']."</td>
								<td>".$Lead['email_id2']."</td>
								<td>".$Lead['contact_no2']."</td>
								<td>".$Lead['clientcategory']."</td>
								<td>".$Lead['reference']."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['name']."</td>";
								if($Lead['add_to_account'] == '1')
									echo "<td>YES</td>";
								else	
									echo "<td>NO</td>
							</tr>";
						} ?>
				</tbody>		
			</table>		
		</div>	
<?php	}
	?>
	