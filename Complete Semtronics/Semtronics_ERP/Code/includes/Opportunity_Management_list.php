<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#date_follow").datepicker({dateFormat: 'yy-mm-dd',minDate:0});
			$("#date_update").datepicker({dateFormat: 'yy-mm-dd'});
			$("#date_update").datepicker().datepicker("setDate", new Date());
		});
	</script>
	<?php 
	session_start();
	date_default_timezone_set("Asia/Calcutta");
	if($_GET['id'] && $_GET['action']=="edit")
	{
		$Opportunity_Edit = mysql_fetch_assoc(Opportunity_Item_Edit());
		$_POST['id'] = $Opportunity_Edit['id']; 
		$_POST['lead_id'] = $Opportunity_Edit['lead_id']; $_POST['description'] = $Opportunity_Edit['opp_description'];
		$_POST['quantity'] = $Opportunity_Edit['quantity']; $_POST['date'] = $Opportunity_Edit['date'];
		$_POST['company'] = $Opportunity_Edit['company']; $_POST['contact_person'] = $Opportunity_Edit['contact_person'];
		$_POST['designation'] = $Opportunity_Edit['designation']; $_POST['email_id'] = $Opportunity_Edit['email_id'];
		$_POST['contact_no'] = $Opportunity_Edit['contact_no']; $_POST['others'] = $Opportunity_Edit['others'];
		$_POST['leadname'] = $Opportunity_Edit['leadname']; $_POST['prodescription'] = $Opportunity_Edit['prodescription'];
		$_POST['pcname'] = $Opportunity_Edit['pcname']; $_POST['psname'] = $Opportunity_Edit['psname'];
	}
	if(isset($_POST['Update']))
	{
		OpportunityManagement_StatusInsertion();
		echo "<br /><div class='message success'><b>Message</b> : Opportunity Status Updated Successfully</div>";
		$Opportunity_Edit = mysql_fetch_assoc(Opportunity_Item_Edit_Update());
		$_POST['id'] = $Opportunity_Edit['id']; $_POST['product_id'] = $Opportunity_Edit['pid'];
		$_POST['product_category_id'] = $Opportunity_Edit['pcid']; $_POST['product_subcategory_id'] = $Opportunity_Edit['pscid'];
		$_POST['lead_id'] = $Opportunity_Edit['lead_id']; $_POST['description'] = $Opportunity_Edit['opp_description'];
		$_POST['quantity'] = $Opportunity_Edit['quantity']; $_POST['date'] = $Opportunity_Edit['date'];
		$_POST['company'] = $Opportunity_Edit['company']; $_POST['contact_person'] = $Opportunity_Edit['contact_person'];
		$_POST['designation'] = $Opportunity_Edit['designation']; $_POST['email_id'] = $Opportunity_Edit['email_id'];
		$_POST['contact_no'] = $Opportunity_Edit['contact_no']; $_POST['others'] = $Opportunity_Edit['others'];
		$_POST['leadname'] = $Opportunity_Edit['leadname']; $_POST['prodescription'] = $Opportunity_Edit['prodescription'];
		$_POST['pcname'] = $Opportunity_Edit['pcname']; $_POST['psname'] = $Opportunity_Edit['psname'];
	}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message;?>
			<form method="POST" name="form1" action="" id="form" class="form panel">
				<fieldset>
					<input type="hidden" value="<?php echo $_POST['id'];?>" name="id">
					<div class="clearfix">
						<label><strong>Lead Name</strong>
						<input style="border:0px;background-color:#EAEAEA;" type="text" id="lead_id" name="lead_id" value="<?php echo $_POST['leadname'];?>" disabled/></label>
						<label><strong>Product &nbsp;&nbsp;</strong>
						<input style="border:0px;background-color:#EAEAEA;" type="text" id="product_id" name="product_id" value="<?php echo $_POST['prodescription'];  ?>" disabled/></label>
						<label><strong>Contact Person</strong>
						<input style="border:0px;background-color:#EAEAEA;" type="text" id="contact_person" name="contact_person" value="<?php echo $_POST['contact_person'];  ?>"disabled/></label>
						<label><strong>Other New Product</strong>
						<input style="border:0px;background-color:#EAEAEA;" type="text" id="others" name="others" value="<?php echo $_POST['others'];  ?>" disabled/></label>
						<label><strong>Quantity &nbsp;&nbsp;</strong>
						<input style="border:0px;background-color:#EAEAEA;" type="text" id="quantity" name="quantity" value="<?php echo $_POST['quantity']; ?>" disabled/></label>
						<label><strong>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
						<input style="border:0px;background-color:#EAEAEA;" type="text" id="date" name="date" value="<?php echo $_POST['date'];?>" disabled/></label>
						<label><strong>Description</strong>
						<textarea style="border:0px;background-color:#EAEAEA;" id="description" name="description" disabled><?php echo $_POST['description'];  ?></textarea></label>
					</div>
					<div class="clearfix">
					<?php
					if($_GET['id']&&$_GET['action']=='edit')
					{
						$status_disable = mysql_fetch_assoc(Status_disableAction());
						if($status_disable['tot']>=1)
						{
							?><label><strong>Status</strong>
							<select name="status_id" id="status_id" disabled>
								<option value="Select">Select</option>
							</select></label>
							<?php
						}
						else
						{
							$status = Opportunity_Status();?>
							<label><strong>Status</strong>
								<select name="status_id" id="status_id">
									<option value="Select">Select</option>
									<?php
										while($opp_status = mysql_fetch_assoc($status))
										{
											echo'<option value="'.$opp_status['id'].'">'.$opp_status['status'].'</option>';
										}
									?>
								</select>
							</label>
						<?php 
						}
					}
					else if(($_POST['status_id']==12)||($_POST['status_id']==13))
					{
						?><label><strong>Status</strong>
							<select name="status_id" id="status_id" disabled>
								<option value="Select">Select</option>
							</select></label>
					<?php
					}
					else
					{
						$status1 = Opportunity_Status1();?>
						<label><strong>Status</strong>
							<select name="status_id" id="status_id">
								<option value="Select">Select</option>
								<?php
									while($opp_status = mysql_fetch_assoc($status1))
									{
										echo'<option value="'.$opp_status['id'].'">'.$opp_status['status'].'</option>';
									}
								?>
							</select>
						</label>
					<?php }?>
						<?php 
						$status_disabl = mysql_fetch_assoc(Status_disableAction());
						if($_POST['status_id']==12 || $_POST['status_id']==13 || $status_disabl['tot']>=1)
						{?>
						<label><strong>Project Amount</strong>
							<input type="text" autocomplete="off" value="<?php ?>" name="amount" id="amount" disabled>
						</label>
						<?php
						}
						else 
						{ ?>
						<label><strong>Project Amount</strong>
							<input type="text" autocomplete="off" value="<?php ?>" name="amount" id="amount"></label>
						</label>
						<?php } ?>
						<?php 
						if($_POST['status_id']==12 || $_POST['status_id']==13 || $status_disabl['tot']>=1)
						{?>
						<label><strong>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
							<input type="text" autocomplete="off" name="date" id="date_follow" value="<?php ?>" disabled>
						<?php }
						else
						{?>
						<label><strong>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
							<input type="text" autocomplete="off" name="date" id="date_follow" value="<?php ?>">
						<?php
						}
						?>
						</label>
						<?php if($_POST['status_id']==12 || $_POST['status_id']==13 || $status_disabl['tot']>=1)
						{?>
						<label><strong>Comments</strong>
							<textarea name="comments" autocomplete="off"  id="comments" rows="2" cols="25" disabled><?php ?></textarea>
						</label>
						<?php
						}
						else
						{
						?>
						<label><strong>Comments</strong> 
							<textarea name="comments" autocomplete="off"  id="comments" rows="2" cols="25"><?php ?></textarea>
						</label>
						<?php }
						if($_POST['status_id']==12 || $_POST['status_id']==13 || $status_disabl['tot']>=1)
						{?>
							<input type="hidden" autocomplete="off" name="date_update" id="date_update">
						<?php }
						else
						{
						?>
						<input type="hidden" autocomplete="off" name="date_update" id="date_update">
						<?php
						}
						?>
						</label>
					</div>
					<div class="clearfix">
					<?php
						$oppid = mysql_fetch_assoc(SalesOrder_disableAction());
						$createorder_disable = mysql_fetch_assoc(CreateOrder_Enable());
						$accleads = mysql_fetch_assoc(SalesOrder_ForACCLead());
						if($oppid['total']>=1)
							echo'<input type="hidden">';
						else if(!isset($_POST['Update']) && $createorder_disable['total']==1 && $accleads['add_to_account']==1)
							echo '<a href="?page=Sales&subpage=spage->Sale_Order&LeadId='.$_POST['lead_id'].'&oppurtunity_id='.$_GET['id'].'"  class="button button-orange">Create Sale Order</a>';
						$check = mysql_fetch_assoc(Update_Disable());
						if(isset($_POST['Update']))
						{
							$acclead = mysql_fetch_assoc(SalesOrder_ForACCLead());
							if($_POST['status_id']==12 && $acclead['add_to_account']==1)
								echo '<a href="?page=Sales&subpage=spage->Sale_Order&LeadId='.$_POST['lead_id'].'&oppurtunity_id='.$_GET['id'].'"  class="button button-orange">Create Sale Order</a>';
							//echo '<a href="?page=Sales&subpage=spage->Sale_Order" class="button button-green" name="saleorder">Create Sale Order</a>';
							else if($_POST['status_id']==12 && $acclead['add_to_account']==0)
								echo '<input type="hidden">';
							else if($_POST['status_id']==13)
								echo '<input type="hidden">';
							else
								echo'<input type="submit" class="button button-green" name="Update" value="Update">';
						}
						else if($check['total']>=1)
							echo '<input type="hidden">';
						else
							echo'<input type="submit" class="button button-green" name="Update" value="Update">';
					?>
						&nbsp;&nbsp;<button class="button button-gray" type="RESET" name="reset">Reset</button>&nbsp;
						<a href="?page=Sales&subpage=spage->Opportunities,ssubpage->Opportunity_Management" class="button button-orange" name="back" value="back">Back</a>
						
				</div>
			</fieldset>
		</form>
	</div>
</section>
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th align="left">Follow UpDate</th>
				<th align="left">Comment</th>
				<th align="left">Status</th>
				<th align="left">Amount</th>
				<th align="left">Updated by</th>
				<th align="left">Updated Date</th>
			</tr>
		</thead>
		<tbody>
	<?php
	if(isset($_POST['Update']))
	{
		$opp_statusdisplay = OpportunityManagement_Status_Display1();
		if(mysql_num_rows(OpportunityManagement_Status_Display1())==0)
			echo '<tr><td style="color:red;" colspan="5"><center>No Data Found</center></td></tr>';
		else
		{
			while($oppstatus = mysql_fetch_assoc($opp_statusdisplay))
			{
			echo
				'<tr>
					<td>'.date('d-m-Y',strtotime($oppstatus['date'])).'</td>
					<td>'.wordwrap($oppstatus['comments'],20,"\n",true).'</td>
					<td>'.$oppstatus['status'].'</td>
					<td>'.$oppstatus['amount'].'</td>
					<td>'.$_SESSION['name'].'</td>
					<td>'.date('d-m-Y',strtotime($oppstatus['date_update'])).'</td>
				</tr>';
			}
		}
	}
	else
	{
		$oppstatusdisplay = OpportunityManagement_StatusDisplay();
		if(mysql_num_rows(OpportunityManagement_StatusDisplay())==0)
			echo '<tr><td style="color:red;" colspan="5"><center>No Data Found</center></td></tr>';
		else
		{
			while($oppstatus = mysql_fetch_assoc($oppstatusdisplay))
			{
			echo'<tr>
					<td>'.date('d-m-Y',strtotime($oppstatus['date'])).'</td>
					<td>'.wordwrap($oppstatus['comments'],20,"\n",true).'</td>
					<td>'.$oppstatus['status'].'</td>
					<td>'.$oppstatus['amount'].'</td>
					<td>'.$_SESSION['name'].'</td>
					<td>'.date('d-m-Y',strtotime($oppstatus['date_update'])).'</td>
				</tr>';
			}
		}
	}
	?>
	</tbody>
	</table>