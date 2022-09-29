<?php
	include("Config.php");
	ini_set("display_errors","0");
	if(isset($_GET['export']))
	{
		session_start();
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		$Opportunityname = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT oppurtunity_status.status as statusname, status,MAX(status_id) as s,oppurtunities.id, leads.name, product.description, oppurtunities.description AS opp_description, oppurtunities.quantity, oppurtunities.`date` , oppurtunities.contact_person, oppurtunities.designation, oppurtunities.email_id, oppurtunities.contact_no, oppurtunities.company
										FROM oppurtunities
										INNER JOIN leads ON lead_id = leads.id
										INNER JOIN product ON oppurtunities.product_id = product.id
										INNER JOIN oppurtunities_comments ON oppurtunities_id = oppurtunities.id
										INNER JOIN oppurtunity_status ON status_id = oppurtunity_status.id
										GROUP BY oppurtunities_id having s='".$_GET['status_id']."' ORDER BY oppurtunities_id DESC"));
		echo '<div align="center">
		<h4>Opportunity Status:'.$Opportunityname['statusname'].'</div><div align="right">Report Date:'.date("d-m-Y").'
		</h4></div>';
	}
	if($_GET['getdata']=='Opportunity_Report')
	{ 
		if($_GET['status_id'])
		{
			$Allstatus = mysqli_query($_SESSION['connection'],"SELECT status,MAX(status_id) as s,oppurtunities.id, leads.name, product.description, oppurtunities.description AS opp_description, oppurtunities.quantity, oppurtunities.`date` , oppurtunities.contact_person, oppurtunities.designation, oppurtunities.email_id, oppurtunities.contact_no, oppurtunities.company
										FROM oppurtunities
										INNER JOIN leads ON lead_id = leads.id
										INNER JOIN product ON oppurtunities.product_id = product.id
										INNER JOIN oppurtunities_comments ON oppurtunities_id = oppurtunities.id
										INNER JOIN oppurtunity_status ON status_id = oppurtunity_status.id
										GROUP BY oppurtunities_id having s='".$_GET['status_id']."' ORDER BY oppurtunities_id DESC");
			echo "<h4>Total Number of Opportunites -". mysqli_num_rows($Allstatus)."</h4>";
			echo '<table class="paginate sortable full" border="1">
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
			</thead>';
			if(!mysqli_num_rows($Allstatus))
				echo '<tr><td colspan="11"><font color="red"><center>No data found</center></font></td></tr>';							
			while($Status = mysqli_fetch_array($Allstatus))
			{
				$Work_d = $Status['id'];
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
							<td><a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management_Status&id='.$Status['id'].'&action=edit">'.$work.'</td>
							<td>'.$Status['name'].'</td>
							<td>'.$Status['description'].'</td>
							<td>'.wordwrap($Status['opp_description'], 25,"\n",true).'</td>
							<td>'.$Status['quantity'].'</td>
							<td>'.date("d-m-Y",strtotime($Status['date'])).'</td>
							<td>'.$Status['contact_person'].'</td>
							<td>'.$Status['designation'].'</td>
							<td>'.$Status['email_id'].'</td>
							<td>'.$Status['contact_no'].'</td>
							<td>'.wordwrap($Status['company'], 10,"\n",true).'</td>
							<td>'.$Status['status'].'</td>
						</tr>
					</tbody>';
			}
		}
	}
?>