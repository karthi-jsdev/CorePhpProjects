<?php
	include("Config.php");
	include("Sale_Order_Queries.php");
	if($_GET['LeadId'])
	{
		if(!$_GET['WorkId'])
		{
			$SelectWork = SelectWork($_GET['LeadId']);
			?>
				<select id="workid" name="workid"  onchange="GetWorkDetails(this.value)">
					<option value="">Select</option>
					<?php
						$A = array();
						while($FetchWork = mysqli_fetch_array($SelectWork))
						{
							//ECHO "select oppurtunity_id from sales_order where oppurtunity_id!='".$FetchWork['id']."'";
							//if(!in_array($FetchWork['id'],$A))
							//{
								///if($_GET['WorkId']==$FetchWork['id'])
									//echo '<option value="'.$FetchWork['id'].'" selected>WK00000'.$FetchWork['id'].'</option>';
								 //if(mysqli_num_rows(mysqli_query($_SESSION['connection'],"select oppurtunity_id from sales_order where oppurtunity_id='".$FetchWork['id']."'")))
									echo '<option value="'.$FetchWork['id'].'">WK00000'.$FetchWork['id'].'</option>';
								//$A[] = $FetchWork['id'];
							//}
						}
					?>
				</select><?php			
		}
		else
		{
			$SelectWork =mysqli_query($_SESSION['connection'],"Select oppurtunities.id from oppurtunities JOIN oppurtunities_comments ON oppurtunities_id=oppurtunities.id JOIN oppurtunity_status ON oppurtunities_comments.status_id=oppurtunity_status.id  where (oppurtunity_status.status like '%Won' || oppurtunity_status.status like '%won') and lead_id='".$_GET['LeadId']."' and (oppurtunities.id='".$_GET['WorkId']."' || oppurtunities.id not in(select oppurtunity_id from sales_order)) order by oppurtunities.id asc");
			?>
				<select id="workid" name="workid"  onchange="GetWorkDetails(this.value)">
					<option value="">Select</option>
					<?php
						//$A = array();
						while($FetchWork = mysqli_fetch_array($SelectWork))
						{
							//ECHO "select oppurtunity_id from sales_order where oppurtunity_id!='".$FetchWork['id']."'";
							//if(!in_array($FetchWork['id'],$A))
							//{
								if($_GET['WorkId']==$FetchWork['id'])
									echo '<option value="'.$FetchWork['id'].'" selected>WK00000'.$FetchWork['id'].'</option>';
								 else 
									echo '<option value="'.$FetchWork['id'].'">WK00000'.$FetchWork['id'].'</option>';
								//$A[] = $FetchWork['id'];
							//}
						}
					?>
				</select><?php
		}
	}
?>