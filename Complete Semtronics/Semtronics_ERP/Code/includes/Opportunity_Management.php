<br/><br/>
<?php
	$All = mysql_fetch_assoc(Status_Count_All());
	$Prospect = mysql_fetch_assoc(Status_Count_Prospecting());
	$Prospect1 = mysql_fetch_assoc(Status_Count_Prospecting1());
	$Prospecting = $Prospect1['prospect']+$Prospect['total'];
	$Analysis = mysql_fetch_assoc(Status_Count_Analysi());
	$Presentation = mysql_fetch_assoc(Status_Count_Presentation());
	$Samplesprovided = mysql_fetch_assoc(Status_Count_SamplesProvided());
	$Samplesapproved = mysql_fetch_assoc(Status_Count_SamplesApproved());
	$Ntp = mysql_fetch_assoc(Status_Count_NegotiationtoPilot());
	$Plo = mysql_fetch_assoc(Status_Count_PilotLotOrder());
	$Qtest = mysql_fetch_assoc(Status_Count_Quotedtest());
	$Freview = mysql_fetch_assoc(Status_Count_FindReview());
	$Hp = mysql_fetch_assoc(Status_Count_HoldPostpone());
	$Cw = mysql_fetch_assoc(Status_Count_ClosedWon());
	$Cl = mysql_fetch_assoc(Status_Count_ClosedLost());
	$Other = mysql_fetch_assoc(Status_Count_Others());
?>
<table>
	<tr>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management">All(<?php echo $All['All_Data'];?>) </a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=2">Prospecting(<?php if(!$Prospecting) echo $Prospecting=0; else echo $Prospecting;?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=3">Analysis(<?php if(!$Analysis['analysi']) echo $Analysis['analysi']=0;else echo $Analysis['analysi'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=4">Presentation(<?php if(!$Presentation['presentation']) echo $Presentation['presentation']=0;else echo $Presentation['presentation'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=5">Samples Provided(<?php if(!$Samplesprovided['samplesprovided']) echo $Samplesprovided['samplesprovided']=0;else echo $Samplesprovided['samplesprovided'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=6">Samples Approved(<?php if(!$Samplesapproved['samplesapproved']) echo $Samplesapproved['samplesapproved']=0;else echo $Samplesapproved['samplesapproved'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=7">Negotiation to Pilot(<?php if(!$Ntp['ntp']) echo $Ntp['ntp']=0; else echo $Ntp['ntp'];?>)</a>
	</tr>
	<tr>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=8">Pilot Lot Order(<?php if(!$Plo['plo']) echo $Plo['plo']=0; else echo $Plo['plo'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=9">Quoted(<?php if(!$Qtest['qtest']) echo $Qtest['qtest']=0;else echo $Qtest['qtest']; ?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=10">Find Review(<?php if(!$Freview['freview']) echo $Freview['freview']=0;else echo $Freview['freview']; ?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=11">Hold/Postpone(<?php if(!$Hp['hp']) echo $Hp['hp']=0; else echo $Hp['hp'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=12">Closed/Won(<?php if(!$Cw['cw']) echo $Cw['cw']=0;else echo $Cw['cw'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=13">Closed/Lost(<?php if(!$Cl['cl']) echo $Cl['cl']=0;else echo $Cl['cl'];?>)</a></td>
		<td width="10%"><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management&status_id=14">Others(<?php if(!$Other['other']) echo $Other['other']=0;else echo $Other['other'];?>)</a></td>
	</tr>
</table>
	<h3>
		<?php
		$totaldata = mysql_fetch_assoc(Opportunity_Item_List_Count());
		echo "Total No. of Opportunities -".$totaldata['total'];
		?>
		</h3>
	<table class="paginate sortable full">
	<thead>
		<tr>
			<th>Work</th>
			<th>Lead Name</th>
			<th>Product Name</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Date</th>
			<th>Contact</th>
			<th>Designation</th>
			<th>E-Mail</th>
			<th>Contact_No.</th>
			<th>Company</th>
			<th>Status</th>
		</tr>
	</thead>
<?php
	$totaldata = mysql_fetch_assoc(Opportunity_Item_List_Count());
	$Limit = 10;
	$total_pages = ceil($totaldata['total'] / $Limit);
	if($total_pages==0)
		echo'<tr><td style="color:#FF0000;" colspan="12"><center>No Opportunities found</center></td></tr>';
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
	if($_GET['status_id'])
	{
		$opportunity_list = OpportunityManagement_Item_List($Start,$Limit);
		$st = mysql_fetch_assoc(Status_List_WithCount());
		if($_GET['status_id']=='2')
			$st['status']='Prospecting';
		while($list = mysql_fetch_assoc($opportunity_list))
		{
			$Work_d = $list['id'];
			if(strlen($Work_d)==1)
				$work = "WK000000".$Work_d;
			else if(strlen($Work_d)==2)
				$work = "WK00000".$Work_d;
			else if(strlen($Work_d)==3)
				$work = "WK0000".$Work_d;
			else if(strlen($Work_d)==4)
				$work = "WK000".$Work_d;
			else if(strlen($Work_d)==5)
				$work = "WK00".$Work_d;
			else if(strlen($Work_d)==6)
				$work = "WK0".$Work_d;
			else if(strlen($Work_d)==7)
				$work = "WK".$Work_d;
			echo'<tbody>
					<tr>
						<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management_list&id='.$list['id'].'&action=edit">'.$work.'</td>
						<td>'.$list['name'].'</td>
						<td>'.$list['description'].'</td>
						<td>'.wordwrap($list['opp_description'], 25,"\n",true).'</td>
						<td>'.$list['quantity'].'</td>
						<td>'.date("d-m-Y",strtotime($list['date'])).'</td>
						<td>'.$list['contact_person'].'</td>
						<td>'.$list['designation'].'</td>
						<td>'.$list['email_id'].'</td>
						<td>'.$list['contact_no'].'</td>
						<td>'.wordwrap($list['company'], 10,"\n",true).'</td>
						<td>'.$st['status'].'</td>
					</tr>
				</tbody>';
		}
	}
	else
	{
		$opportunity_list = OpportunityManagement_Item_List($Start,$Limit);
		while($list = mysql_fetch_assoc($opportunity_list))
		{	
			$_POST['id'] = $list['id'];
			$status_detail = mysql_fetch_assoc(Status_List());
			if($status_detail['total']>=1)
				$status_detail['status'];
			else
				$status_detail['status']='Prospecting';
			$Work_d = $list['id'];
			if(strlen($Work_d)==1)
				$work = "WK000000".$Work_d;
			else if(strlen($Work_d)==2)
				$work = "WK00000".$Work_d;
			else if(strlen($Work_d)==3)
				$work = "WK0000".$Work_d;
			else if(strlen($Work_d)==4)
				$work = "WK000".$Work_d;
			else if(strlen($Work_d)==5)
				$work = "WK00".$Work_d;
			else if(strlen($Work_d)==6)
				$work = "WK0".$Work_d;
			else if(strlen($Work_d)==7)
				$work = "WK".$Work_d;
			echo'<tbody>
					<tr>
						<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management_list&id='.$list['id'].'&action=edit">'.$work.'</td>
						<td>'.$list['name'].'</td>
						<td>'.$list['description'].'</td>
						<td>'.wordwrap($list['opp_description'], 25,"\n",true).'</td>
						<td>'.$list['quantity'].'</td>
						<td>'.date("d-m-Y",strtotime($list['date'])).'</td>
						<td>'.$list['contact_person'].'</td>
						<td>'.$list['designation'].'</td>
						<td>'.$list['email_id'].'</td>
						<td>'.$list['contact_no'].'</td>
						<td>'.wordwrap($list['company'],10,"\n",true).'</td>
						<td>'.$status_detail['status'].'</td>
					</tr>
				</tbody>';
		}
	}
?>
</table>
<?php
	$GETParameters = "page=Sales&subpage=spage->Opportunities,ssubpage->".$_GET['ssubpage']."&status_id=".$_GET['status_id']."&";
	if($total_pages > 1)
	include("includes/Pagination.php");
?>
<form action="" method="POST">
	<?php 
	$saleorder = mysql_fetch_assoc(Sales_Order_Issue_Count());
	if($saleorder['salesordertotal']==0)
	{?>
	<div style="float:left">
		<h3>Sales Order to be issued(<?php $sales_total = mysql_fetch_assoc(Sales_Order_Issue_Count());
									echo $sales_total['salesordertotal'];?>)
	</div>
	<?php } 
	else
	{?>
	<div style="float:left">
		<h3>Sales Order to be issued(<?php $sales_total = mysql_fetch_assoc(Sales_Order_Issue_Count());
									echo $sales_total['salesordertotal'];?>)
	</div>
	<div style="float:right">
		<input type="text" value="" name="contentSearch" id="contentSearch">
		<button name="search" style="border:0px;background:none;"><img src="images/search.png"></button></h3>
	</div>
</form>
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th>Work</th>
				<th>Lead Name</th>
				<th>Product Name</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Date</th>
				<th>Contact</th>
				<th>Designation</th>
				<th>E-Mail</th>
				<th>Contact_No.</th>
				<th>Company</th>
				<th>Status</th>
			</tr>
		</thead>
		<?php
		if($_POST['contentSearch']=="")
		{
			$opportunity_list = mysql_num_rows(Sales_Order_Issue());
			if($opportunity_list==0)
				echo'<tr><td style="color:#FF0000;" colspan="12"><center>No Data found</center></td></tr>';
			else
			{
				$opportunity_list = Sales_Order_Issue();
				while($list = mysql_fetch_assoc($opportunity_list))
				{	
					$Work_d = $list['id'];
					if(strlen($Work_d)==1)
						$work = "WK000000".$Work_d;
					else if(strlen($Work_d)==2)
						$work = "WK00000".$Work_d;
					else if(strlen($Work_d)==3)
						$work = "WK0000".$Work_d;
					else if(strlen($Work_d)==4)
						$work = "WK000".$Work_d;
					else if(strlen($Work_d)==5)
						$work = "WK00".$Work_d;
					else if(strlen($Work_d)==6)
						$work = "WK0".$Work_d;
					else if(strlen($Work_d)==7)
						$work = "WK".$Work_d;
					$status_detail['status']='Closed/Won';
					echo'<tbody>
							<tr>
								<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management_list&id='.$list['id'].'&action=edit">'.$work.'</td>
								<td>'.$list['name'].'</td>
								<td>'.$list['description'].'</td>
								<td>'.wordwrap($list['opp_description'], 25,"\n",true).'</td>
								<td>'.$list['quantity'].'</td>
								<td>'.date("d-m-Y",strtotime($list['date'])).'</td>
								<td>'.$list['contact_person'].'</td>
								<td>'.$list['designation'].'</td>
								<td>'.$list['email_id'].'</td>
								<td>'.$list['contact_no'].'</td>
								<td>'.wordwrap($list['company'],10,"\n",true).'</td>
								<td>'.$status_detail['status'].'</td>
							</tr>
						</tbody>';
				}
			}
		}
		else if(isset($_POST['search']))
		{
			$opportunity_list = mysql_num_rows(Sales_Order_Issue_Search());
			if($opportunity_list==0)
				echo'<tr><td style="color:#FF0000;" colspan="12"><center>No Data found</center></td></tr>';
			else
			{
				$opportunity_list = Sales_Order_Issue_Search();
				while($list = mysql_fetch_assoc($opportunity_list))
				{	
					$Work_d = $list['id'];
					if(strlen($Work_d)==1)
						$work = "WK000000".$Work_d;
					else if(strlen($Work_d)==2)
						$work = "WK00000".$Work_d;
					else if(strlen($Work_d)==3)
						$work = "WK0000".$Work_d;
					else if(strlen($Work_d)==4)
						$work = "WK000".$Work_d;
					else if(strlen($Work_d)==5)
						$work = "WK00".$Work_d;
					else if(strlen($Work_d)==6)
						$work = "WK0".$Work_d;
					else if(strlen($Work_d)==7)
						$work = "WK".$Work_d;
					$status_detail['status']='Closed/Won';
					echo'<tbody>
							<tr>
								<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management_list&id='.$list['id'].'&action=edit">'.$work.'</td>
								<td>'.$list['name'].'</td>
								<td>'.$list['description'].'</td>
								<td>'.wordwrap($list['opp_description'],25,"\n",true).'</td>
								<td>'.$list['quantity'].'</td>
								<td>'.date("d-m-Y",strtotime($list['date'])).'</td>
								<td>'.$list['contact_person'].'</td>
								<td>'.$list['designation'].'</td>
								<td>'.$list['email_id'].'</td>
								<td>'.$list['contact_no'].'</td>
								<td>'.wordwrap($list['company'],10,"\n",true).'</td>
								<td>'.$status_detail['status'].'</td>
							</tr>
						</tbody>';
				}
			}
		} ?>
	</table>
<?php }?>