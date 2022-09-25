<br/>
<?php
	$Columns = array("id","lead_id", "oppurtunity_id", "po_number", "shipping_address", "billing_address", "courier_by_id", "is_self_or_customer_pay");
	if($_POST['Update'])
	{
		SaleOrder_UpdateComments();
	}
	if($_GET['saleorderid'])
	{
		$SaleOrder = mysql_fetch_assoc(SaleOrder_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $SaleOrder[$Col];
		$FetchOppurtunity = mysql_fetch_array(Select_Opportunity($_POST['oppurtunity_id']));
		$FetchProduct = mysql_fetch_array(SelectProductById($FetchOppurtunity['product_id']));
	
?>
<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#date").datepicker({dateFormat: 'yy-mm-dd'});
		});
	</script>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form style="width:1000px" method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&saleorderid=".$_GET['saleorderid']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="saleorderid" value="<?php if($_GET['saleorderid']) echo $_GET['saleorderid']; ?>" required="required"/>
			<header><h2>Sale Order Summary</h2></header>
			<hr />				
			<fieldset>
				<strong><font color="red">SO No:
				<?php
					$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
					$SONo = "SO".$Digits[7 - strlen($_GET['saleorderid'])].($_GET['saleorderid']);
					echo $SONo;
				?></font></strong>
				<div class="clearfix">
					<br/>
					<label>
					<strong>Lead :</strong>
					<?php 
						$FetchClientName = mysql_fetch_array(FetchLeadById($_POST['lead_id']));
						echo $FetchClientName['name']."<br/><br/>"; 
						echo "<strong>Product Type:</strong>".$FetchProduct['code']; 
					?>
					</label>
					<label>Quantity <font color="red">*</font>
						<div id=""><input type="text" id="3"  name="quantity" required="required" value="<?php echo $FetchOppurtunity['quantity']; ?>" autocomplete="off"/></div>
					</label>
					<label>Date <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div id=""><input type="text" id="date"  value="<?php echo $FetchOppurtunity['date']; ?>"  name="date" required="required" autocomplete="off"/></div>
					</label>
					<?php
						echo "<strong>PO Number:</strong>&nbsp;".$_POST['po_number']; 
					?>
				</div>	
				<div class="clearfix">
					<label><strong>Description : </strong>
						<div id=""><textarea id="0" name="description"><?php echo $FetchOppurtunity['description']; ?></textarea></div>
					</label>
					
					<label>Contact Person <font color="red">*</font>
						<div id=""><input type="text" id="4" value="<?php echo $FetchOppurtunity['contact_person']; ?>"  name="contactperson" required="required" autocomplete="off"/></div>
					<label>Company <font color="red">*</font>
						<div id=""><input type="text" id="5"  name="company" value="<?php echo $FetchOppurtunity['company']; ?>" required="required" autocomplete="off"/></div>
					</label>
					</label>
					<label>Status <font color="red">*</font>
						<div id="2"><select id="status" name="status">
							<option value="">Select</option>
							<?php
								$SelectStatus = SelectStatus();
								while($FetchStatus = mysql_fetch_array($SelectStatus))
								{
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['sales_status'].'</option>';
								}
							?>
						</select></div>
					</label>
					<label>Comments : 
						<div id=""><textarea id="0" name="comments"></textarea></div>
					</label>
					<!--label>
						Approved By:
						<?php
							$SelectApprover = Select_Approver();
							while($FetchApprover = mysql_fetch_array($SelectApprover))
							{
								echo '<span class="radio-input"><input type="checkbox" name="is_self_or_customer_pay" value="'.$i++.'" checked>'.$Pay.'</input></span>';
							}
						?>
					</label-->
				</div>	
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		<h3>Sale Order Comments List
			<?php
				$SaleOrderCommentsTotalRows = mysql_fetch_assoc(Select_Comments());
				echo " : No. of Total Sale Order -".$SaleOrderCommentsTotalRows['total'];
				?>
			</h3>
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
				$Limit = 10;
				$total_pages = ceil($SaleOrderCommentsTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$i++;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$SelectComments = Select_CommentsByLimit($Start, $Limit);
				while($FetchComments = mysql_fetch_array($SelectComments))
				{
					$FetchStatus = mysql_fetch_array(FetchStatus($FetchComments['status_id']));
					$FetchUser  = mysql_fetch_array(FetchUser($FetchComments['updatedby']));
					$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
					$SONo = "SO".$Digits[7 - strlen($_GET['saleorderid'])].($_GET['saleorderid']);
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
if(!$_GET['saleorderid'])
	{
	?>
	<h3>Sale Order List
			<?php
			if($_GET['Search'])
				$SaleOrderTotalRows = mysql_fetch_assoc(Select_Sales_orderSearch($_GET['Search']));
			else
				$SaleOrderTotalRows = mysql_fetch_assoc(Select_Sales_order());
			echo " : No. of Total Sale Order -".$SaleOrderTotalRows['total'];
			?>
		</h3>
		<input type="text" placeholder="Search" id="Search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="Search()" class="button button-orange" >Search</a><br/>&nbsp;
	<?php	
	
			echo '<table  class="paginate sortable full">
					<thead>
						<tr>
							<th>SO No</th>
							<th>Lead Name</th>
							<th>Description</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Date</th>
							<th>Contact</th>
							<th>Company</th>
							<th>Approved By</th>
							<th>Status</th>
							<th>Comment</th>
							<th>Shipping</th>
							<th>Billing</th>
							<th>Courier By</th>
							<th>Payment</th>
						</tr>
					</thead>';
			if(!$SaleOrderTotalRows['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$total_pages = ceil($SaleOrderTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			if($_GET['Search'])
				$Select_Sales_Order = Select_Sales_orderSearchByLimit($_GET['Search'],$Start, $Limit);
			else
				$Select_Sales_Order = SaleOrder_Select_ByLimit($Start, $Limit);
				
			while($Fetch_Sales_Order = mysql_fetch_array($Select_Sales_Order))
			{
				$FetchLeadName = mysql_fetch_array(FetchLeadById($Fetch_Sales_Order['lead_id']));
				$FetchOppurtunity = mysql_fetch_array(Select_Opportunity($Fetch_Sales_Order['oppurtunity_id']));
				$FetchProduct = mysql_fetch_array(SelectProductById($FetchOppurtunity['product_id']));
				$FetchCourierBy =  mysql_fetch_array(SelectCourierById($Fetch_Sales_Order['courier_by_id']));
				$FetchComments = mysql_fetch_array(FetchComments($Fetch_Sales_Order['id']));
				$FetchStatus = mysql_fetch_array(FetchStatus($FetchComments['status_id']));
				$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
				$SONo = "SO".$Digits[7 - strlen($Fetch_Sales_Order['id'])].($Fetch_Sales_Order['id']);
				$Users = "";
				$SelectAprovers = SelectApprovers($Fetch_Sales_Order['id']);
				$Approvers = mysql_num_rows($SelectAprovers);
				while($FetchAprovers = mysql_fetch_array($SelectAprovers))
				{
					$Approvers--;
					$FetchApproversName = mysql_fetch_array(FetchUser($FetchAprovers['approved_by']));
					$Users .= $FetchApproversName['firstname'];
					if($Approvers)
						$Users .= ",";
				}
				$SelectUser =Select_Approver();
				if(!$FetchStatus['sales_status'])	
					$FetchStatus['sales_status'] = "None";
				if(!$FetchComments['comments'])	
					$FetchComments['comments'] = "None";
				if($Fetch_Sales_Order['is_self_or_customer_pay']==1)
					$Fetch_Sales_Order['is_self_or_customer_pay'] = "Self";
				else
					$Fetch_Sales_Order['is_self_or_customer_pay'] = "Customer";
				echo '<tr>';
					if($FetchUser = mysql_fetch_array($SelectUser))
					{
						if(mysql_num_rows($SelectUser) == mysql_num_rows(SelectApprovers($Fetch_Sales_Order['id'])))
							echo '<td><a href="?index.php&page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&saleorderid='.$Fetch_Sales_Order['id'].'">'.$SONo.'</a></td>';
						else	
							echo '<td>'.$SONo.'</td>';
					}
					echo '<td  align="center">'.$FetchLeadName['name'].'</td>
						<td>'.$FetchOppurtunity['description'].'</td>
						<td>'.$FetchProduct['code'].'</td>
						<td>'.$FetchOppurtunity['quantity'].'</td>
						<td>'.$FetchOppurtunity['date'].'</td>
						<td>'.$FetchOppurtunity['contact_person'].'</td>
						<td>'.$FetchOppurtunity['company'].'</td>
						<td>'.$Users.'</td>
						<td>'.$FetchStatus['sales_status'].'</td>
						<td>'.$FetchComments['comments'].'</td>
						<td>'.$Fetch_Sales_Order['shipping_address'].'</td>
						<td>'.$Fetch_Sales_Order['billing_address'].'</td>
						<td>'.$FetchCourierBy['couriers'].'</td>
						<td>'.$Fetch_Sales_Order['is_self_or_customer_pay'].'</td>
					  </tr>';
			}
			echo '</table>';
	}
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&saleorderid=".$_GET['saleorderid']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
	<!--?php
	if(!$_GET['saleorderid'])
	{
		$Select_Sales_Order = Select_Sales_orderSummary();
		if(mysql_num_rows($Select_Sales_Order))
		{
			echo '<table  class="paginate sortable full">
					<thead>
						<tr>
							<th>SO No</th>
							<th>Lead Name</th>
							<th>Description</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Date</th>
							<th>Contact</th>
							<th>Company</th>
							<th>Approved</th>
							<th>Status</th>
							<th>Comment</th>
							<th>Shipping</th>
							<th>Billing</th>
							<th>Courier By</th>
							<th>Payment</th>
						</tr>
					</thead>';
			while($Fetch_Sales_Order = mysql_fetch_array($Select_Sales_Order))
			{
				$FetchLeadName = mysql_fetch_array(FetchLeadById($Fetch_Sales_Order['lead_id']));
				$FetchOppurtunity = mysql_fetch_array(Select_Opportunity($Fetch_Sales_Order['oppurtunity_id']));
				$FetchProduct = mysql_fetch_array(SelectProductById($FetchOppurtunity['product_id']));
				$FetchCourierBy =  mysql_fetch_array(SelectCourierById($Fetch_Sales_Order['courier_by_id']));
				$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
				$SONo = "SO".$Digits[7 - strlen($Fetch_Sales_Order['id'])].($Fetch_Sales_Order['id']);
				if(!$Fetch_Sales_Order['approved_id'])
					$Fetch_Sales_Order['approved_id'] = "None";
				if(!$Fetch_Sales_Order['status_id'])	
					$Fetch_Sales_Order['status_id'] = "None";
				if(!$Fetch_Sales_Order['comments'])	
					$Fetch_Sales_Order['comments'] = "None";
				if($Fetch_Sales_Order['is_self_or_customer_pay']==1)
					$Fetch_Sales_Order['is_self_or_customer_pay'] = "Self";
				else
					$Fetch_Sales_Order['is_self_or_customer_pay'] = "Customer";
				echo '<tr>
						<td><a href="?index.php&page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&saleorderid='.$Fetch_Sales_Order['id'].'">'.$SONo.'</a></td>
						<td  align="center">'.$FetchLeadName['name'].'</td>
						<td>'.$FetchOppurtunity['description'].'</td>
						<td>'.$FetchProduct['code'].'</td>
						<td>'.$FetchOppurtunity['quantity'].'</td>
						<td>'.$FetchOppurtunity['date'].'</td>
						<td>'.$FetchOppurtunity['contact_person'].'</td>
						<td>'.$FetchOppurtunity['company'].'</td>
						<td>'.$Fetch_Sales_Order['approved_id'].'</td>
						<td>'.$Fetch_Sales_Order['status_id'].'</td>
						<td>'.$Fetch_Sales_Order['comments'].'</td>
						<td>'.$Fetch_Sales_Order['shipping_address'].'</td>
						<td>'.$Fetch_Sales_Order['billing_address'].'</td>
						<td>'.$FetchCourierBy['couriers'].'</td>
						<td>'.$Fetch_Sales_Order['is_self_or_customer_pay'].'</td>
					  </tr>';
			}
			echo '</table>';
		}
	}
	?-->	
<script>
function Search()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>