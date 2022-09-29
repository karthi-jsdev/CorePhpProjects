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
		echo '<div align="center"><h4>Lead Report </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
		
	if($_GET['getdata']=='Lead_Report')
	{ 
	$LeadTotalRows = mysqli_fetch_assoc(Lead_Select_Count_All());
		echo "<h4>Total No. of Leads - ".$LeadTotalRows['total']."</h4>";
	?>	
	<div style="width: 1000px; overflow-x: auto;" >
		<table class="paginate sortable full" style="width: 2100px;" border="1">
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
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$LeadRows = Lead_Select_ByNoLimit();
					while($Lead = mysqli_fetch_assoc($LeadRows))
					{
						$Clientcategory = mysqli_fetch_array(Client_Category_Name($Lead['client_category_id']));
						$Reference = mysqli_fetch_array(Reference_Name($Lead['reference_id']));
						$ReferenceGroup = mysqli_fetch_array(Reference_GroupName($Lead['reference_group_id']));
						$Industrycategory = mysqli_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
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
							<td>".$Clientcategory['clientcategory']."</td>
							<td>".$Reference['reference']."</td>
							<td>".$ReferenceGroup['name']."</td>
							<td>".$Industrycategory['name']."</td>";
							if($Lead['add_to_account'] == '1')
								echo "<td>YES</td>";
							else	
								echo "<td>NO</td>
						</tr>";
					} ?>
			</tbody>		
		</table>		
	</div>	
<?php
} ?>	