<?php
include("Config.php");
include("Lead_ManagementQueries.php");
ini_set("display_errors","0");
if($_GET['PaginationFor'] == "AllLeadSummary")
{
	if($_GET['Search'])
	{
		$Search = "";
		if(substr($_GET['Search'],0,2)=="LD")
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
			foreach($Array as $A)
				$Search.=$A;
			$Search = strrev($Search);
		}
		else 
			$Search = $_GET['Search'];
		$LeadTotalRows = mysql_fetch_assoc(Lead_Select_Count_All_Search($Search));
	}
	else
		$LeadTotalRows = mysql_fetch_assoc(Lead_Select_Count_All());
	if(!$_GET['Search'])
	{
		if(!$LeadTotalRows['total'])
			echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
		$Limit = 10;
		$_GET['total_pages'] = ceil($LeadTotalRows['total'] / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$i++;
		$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
		$LeadRows = Lead_Select_ByLimit($Start, $Limit);
		while($Lead = mysql_fetch_assoc($LeadRows))
		{
			$Digits = array("","0", "00", "000", "0000", "00000", "000000");
			$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);	
			$Vendorcategory = mysql_fetch_array(Client_Category_Name($Lead['client_category_id']));
			$Reference = mysql_fetch_array(Reference_Name($Lead['reference_id']));
			$ReferenceGroup = mysql_fetch_array(Reference_GroupName($Lead['reference_group_id']));
			$Industrycategory = mysql_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
			$fetchleadfollowupdate = mysql_fetch_array(mysql_query("SELECT * FROM leadscomments WHERE leadid='".$Lead['id']."' ORDER BY id desc"));
			echo "<tr style='valign:middle;'>
				<td align='center'>".$i++."</td>
				<td><a href='?page=Sales&subpage=spage->Lead,ssubpage->Lead__Management&leadid=".$Lead['id']."'>".$LDNo."</td>
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
				<td>".$Vendorcategory['clientcategory']."</td>
				<!--td>".$Reference['reference']."</td>
				<td>".$ReferenceGroup['name']."</td>
				<td>".$Industrycategory['name']."</td-->";
				if($Lead['add_to_account'] == '1')
					echo "<td>YES</td>";
				else	
					echo "<td>NO</td>
			</tr>";
		} 
	}
	else
	{
		
		if(!$LeadTotalRows['total'])
			echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
		$Limit = 10;
		$_GET['total_pages'] = ceil($LeadTotalRows['total'] / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$i++;
		$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
		$LeadRows = Lead_Select_ByLimitSearch($Start, $Limit, $Search);
		while($Lead = mysql_fetch_assoc($LeadRows))
		{
			$Digits = array("","0", "00", "000", "0000", "00000", "000000");
			$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);	
			$Vendorcategory = mysql_fetch_array(Client_Category_Name($Lead['client_category_id']));
			$Reference = mysql_fetch_array(Reference_Name($Lead['reference_id']));
			$ReferenceGroup = mysql_fetch_array(Reference_GroupName($Lead['reference_group_id']));
			$Industrycategory = mysql_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
			$fetchleadfollowupdate = mysql_fetch_array(mysql_query("SELECT * FROM leadscomments WHERE leadid='".$Lead['id']."' ORDER BY id desc"));
			echo "<tr style='valign:middle;'>
				<td align='center'>".$i++."</td>
				<td><a href='?page=Sales&subpage=spage->Lead,ssubpage->Lead__Management&leadid=".$Lead['id']."'>".$LDNo."</td>
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
				<td>".$Vendorcategory['clientcategory']."</td>
				<!--td>".$Reference['reference']."</td>
				<td>".$ReferenceGroup['name']."</td>
				<td>".$Industrycategory['name']."</td-->";
				if($Lead['add_to_account'] == '1')
					echo "<td>YES</td>";
				else	
					echo "<td>NO</td>
			</tr>";
		} 
	}
}
else if($_GET['PaginationFor'] == "FollowupLeadSummary")
{
	$RevString = strrev($_GET['Search1']);
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
	if(!$_GET['Search1'])
		$LeadfollowupTotalRows = mysql_num_rows(Lead_followupSelect_Count_All());
	else
		$LeadfollowupTotalRows = mysql_num_rows(Lead_followupSelect_Count_AllBySearch($Search));
	if(!$_GET['Search1'])
	{
		if(!$LeadfollowupTotalRows)
			echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
		$Limit = 10;
		$_GET['total_pages'] = ceil($LeadfollowupTotalRows / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$i++;
		$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
		$LeadLasttwoweekRows = Lead_Select_ByLasttwoweekLimit($Start, $Limit);
		while($Leadlasttwoweeks = mysql_fetch_assoc($LeadLasttwoweekRows))
		{	
			$Digits = array("","0", "00", "000", "0000", "00000", "000000");
			$LDNo = "LD".$Digits[6 - strlen($Leadlasttwoweeks['id'])].($Leadlasttwoweeks['id']);
			$Vendorcategory = mysql_fetch_array(client_Category_Name($Leadlasttwoweeks['client_category_id']));
			$Reference = mysql_fetch_array(Reference_Name($Leadlasttwoweeks['reference_id']));
			$ReferenceGroup = mysql_fetch_array(Reference_GroupName($Leadlasttwoweeks['reference_group_id']));
			$Industrycategory = mysql_fetch_array(Industrycategory_Name($Leadlasttwoweeks['industry_category_id']));
			
			if($Leadlasttwoweeks['followupdate']<= date('Y-m-d', strtotime('+2 days')))
				echo "<tr style='valign:middle;color:red;'>";
			else
				echo "<tr style='valign:middle;'>'";
			echo "<td align='center'>".$i++."</td>
				<td><a href='?page=Sales&subpage=spage->Lead,ssubpage->Lead__Management&leadid=".$Leadlasttwoweeks['id']."'>".$LDNo."</td>
				<td>".$Leadlasttwoweeks['name']."</td>
				<td>".$Leadlasttwoweeks['followupdate']."</td>
				<td>".$Leadlasttwoweeks['address']."</td>
				<td>".$Leadlasttwoweeks['email_id']."</td>
				<td>".$Leadlasttwoweeks['contact_no']."</td>
				<td>".$Leadlasttwoweeks['contact_person1']."</td>
				<td>".$Leadlasttwoweeks['designation1']."</td>
				<td>".$Leadlasttwoweeks['email_id1']."</td>
				<td>".$Leadlasttwoweeks['contact_no1']."</td>
				<td>".$Leadlasttwoweeks['contact_person2']."</td>
				<td>".$Leadlasttwoweeks['designation2']."</td>
				<td>".$Leadlasttwoweeks['email_id2']."</td>
				<td>".$Leadlasttwoweeks['contact_no2']."</td>
				<td>".$Vendorcategory['clientcategory']."</td>";
				if($Leadlasttwoweeks['add_to_account'] == '1')
					echo "<td>YES</td>";
				else	
					echo "<td>NO</td>
			</tr>";
			} 
	}
	else
	{
		if(!$LeadfollowupTotalRows)
			echo '<tr><td colspan="15"><font color="red"><center>No data found</center></font></td></tr>';
		$Limit = 10;
		$_GET['total_pages'] = ceil($LeadfollowupTotalRows / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$i++;
		$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
		$LeadLasttwoweekRows = Lead_Select_ByLasttwoweekLimitSearch($Start, $Limit, $Search);
		while($Leadlasttwoweeks = mysql_fetch_assoc($LeadLasttwoweekRows))
		{	
			$Digits = array("","0", "00", "000", "0000", "00000", "000000");
			$LDNo = "LD".$Digits[6 - strlen($Leadlasttwoweeks['id'])].($Leadlasttwoweeks['id']);
			$Vendorcategory = mysql_fetch_array(client_Category_Name($Leadlasttwoweeks['client_category_id']));
			$Reference = mysql_fetch_array(Reference_Name($Leadlasttwoweeks['reference_id']));
			$ReferenceGroup = mysql_fetch_array(Reference_GroupName($Leadlasttwoweeks['reference_group_id']));
			$Industrycategory = mysql_fetch_array(Industrycategory_Name($Leadlasttwoweeks['industry_category_id']));
			echo "<tr style='valign:middle;'>
				<td align='center'>".$i++."</td>
				<td><a href='?page=Sales&subpage=spage->Lead,ssubpage->Lead__Management&leadid=".$Leadlasttwoweeks['id']."'>".$LDNo."</td>
				<td>".$Leadlasttwoweeks['name']."</td>
				<td>".$Leadlasttwoweeks['followupdate']."</td>
				<td>".$Leadlasttwoweeks['address']."</td>
				<td>".$Leadlasttwoweeks['email_id']."</td>
				<td>".$Leadlasttwoweeks['contact_no']."</td>
				<td>".$Leadlasttwoweeks['contact_person1']."</td>
				<td>".$Leadlasttwoweeks['designation1']."</td>
				<td>".$Leadlasttwoweeks['email_id1']."</td>
				<td>".$Leadlasttwoweeks['contact_no1']."</td>
				<td>".$Leadlasttwoweeks['contact_person2']."</td>
				<td>".$Leadlasttwoweeks['designation2']."</td>
				<td>".$Leadlasttwoweeks['email_id2']."</td>
				<td>".$Leadlasttwoweeks['contact_no2']."</td>
				<td>".$Vendorcategory['clientcategory']."</td>";
				if($Leadlasttwoweeks['add_to_account'] == '1')
					echo "<td>YES</td>";
				else	
					echo "<td>NO</td>
			</tr>";
		} 
	}
}
echo "$";
include("Ajax_Pagination.php");
?>
