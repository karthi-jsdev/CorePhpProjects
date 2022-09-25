<div class="columns">
	<h3>
		<?php
		$LeadTotalRows = mysql_fetch_assoc(Lead_AddtoaccountSelect_Count_All());
		echo "<div>Total No. of Leads - ".$LeadTotalRows['total'];
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Search" id="Search" name="search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/></div>';
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
			<tbody>
				<?php
				if(!$_GET['Search'])
				{
					$LeadTotalRows = mysql_fetch_assoc(Lead_AddtoaccountSelect_Count_All());
					if(!$LeadTotalRows['total'])
						echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($LeadTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$LeadRows = Lead_AddtoaccountSelect_ByLimit($Start, $Limit);
					while($Lead = mysql_fetch_assoc($LeadRows))
					{
						$Digits = array("","0","00","000","0000","00000","000000");
						$LDNO = "LD".$Digits[6-strlen($Lead['id'])].($Lead['id']);
						$Vendorcategory = mysql_fetch_array(Client_Category_Name($Lead['client_category_id']));
						$Reference = mysql_fetch_array(Reference_Name($Lead['reference_id']));
						$ReferenceGroup = mysql_fetch_array(Reference_GroupName($Lead['reference_group_id']));
						$Industrycategory = mysql_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td><a href='?page=Sales&subpage=spage->Lead,ssubpage->Lead__Management&leadid=".$Lead['id']."'>".$LDNO."</td>
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
							<td>".$Vendorcategory['clientcategory']."</td>";
							if($Lead['add_to_account'] == '1')
								echo "<td>YES</td>";
							else	
								echo "<td>NO</td>
						</tr>";
					}
				}
				else
				{
					$RevString = strrev($_GET['Search']);
					$ArrayStrings = str_split($RevString);
					$Array = array();
					for($i = 0;$i<count($ArrayStrings);$i++)
					{
						if((is_numeric($ArrayStrings[$i]) && $ArrayStrings[$i]!=0)  && $ArrayStrings[$i+1]==0)
							$Array[] = $ArrayStrings[$i];
						else if((is_numeric($ArrayStrings[$i]) && $ArrayStrings[$i]!=0)  && $ArrayStrings[$i+1]!=0)
							$Array[] = $ArrayStrings[$i];
						else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]!=0)  && $ArrayStrings[$i]==0)
							$Array[] = $ArrayStrings[$i];
						else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+2]) && $ArrayStrings[$i+2]!=0))
							$Array[] = $ArrayStrings[$i];
						else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+3]) && $ArrayStrings[$i+3]!=0))
							$Array[] = $ArrayStrings[$i];
						else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+4]) && $ArrayStrings[$i+4]!=0))
							$Array[] = $ArrayStrings[$i];
						else if((is_numeric($ArrayStrings[$i+1]) && $ArrayStrings[$i+1]==0)  && $ArrayStrings[$i]==0 && (is_numeric($ArrayStrings[$i+5]) && $ArrayStrings[$i+5]!=0))
							$Array[] = $ArrayStrings[$i];
					}
					$Search = "";
					foreach($Array as $A)
						$Search.=$A;
					$Search = strrev($Search);
					$LeadTotalRowsSearch = mysql_fetch_assoc(Lead_AddtoaccountSelect_Count_All_By_Search($Search));
					if(!$LeadTotalRowsSearch['total'])
						echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($LeadTotalRowsSearch['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$LeadRows = Lead_AddtoaccountSelect_ByLimitSearch($Start, $Limit ,$Search);
					while($Lead = mysql_fetch_assoc($LeadRows))
					{
						$Digits = array("","0","00","000","0000","00000","000000");
						$LDNO = "LD".$Digits[6-strlen($Lead['id'])].($Lead['id']);
						$Vendorcategory = mysql_fetch_array(Client_Category_Name($Lead['client_category_id']));
						$Reference = mysql_fetch_array(Reference_Name($Lead['reference_id']));
						$ReferenceGroup = mysql_fetch_array(Reference_GroupName($Lead['reference_group_id']));
						$Industrycategory = mysql_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td><a href='?page=Sales&subpage=spage->Lead,ssubpage->Lead__Management&leadid=".$Lead['id']."'>".$LDNO."</td>
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
							<td>".$Vendorcategory['clientcategory']."</td>";
							if($Lead['add_to_account'] == '1')
								echo "<td>YES</td>";
							else	
								echo "<td>NO</td>
						</tr>";
					}
				} ?>
			</tbody>
		</table>
	</div>
</div>
<div class="clear">&nbsp;</div>
<?php
	if($_GET['Search'])
		$GETParameters = "page=Sales&subpage=spage->Lead,ssubpage->".$_GET['ssubpage']."&Search=".$_GET['Search']."&";
	else
		$GETParameters = "page=Sales&subpage=spage->Lead,ssubpage->".$_GET['ssubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
?>
<script>
	function Search()
	{
		document.location.assign("index.php?page=Sales&subpage=spage->Lead,ssubpage-><?php echo $_GET['ssubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>