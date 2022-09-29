<br/>
<?php
	$Columns = array("id","lead_id", "oppurtunity_id", "po_number", "shipping_address", "billing_address", "courier_by_id", "is_self_or_customer_pay");
	if($_POST['Update'])
		SaleOrder_UpdateComments();
	if($_GET['saleorderid'])
	{
		$SaleOrder = mysqli_fetch_assoc(SaleOrder_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $SaleOrder[$Col];
		$FetchOppurtunity = mysqli_fetch_array(Select_Opportunity($_POST['oppurtunity_id']));
		$FetchProduct = mysqli_fetch_array(SelectProductById($FetchOppurtunity['product_id']));
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
		<form style="width:1000px" method="post" action="" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="saleorderid" value="<?php if($_GET['saleorderid']) echo $_GET['saleorderid']; ?>" required="required"/>
			<header><h2>Sale Order Summary</h2>
			<h2 align="right"  style="color:red">Approved</h2></header>
			<hr />				
			<fieldset>
				<strong>
					<font color="red">SO No:
						<?php
						$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
						$SONo = "SO".$Digits[7 - strlen($_GET['saleorderid'])].($_GET['saleorderid']);
						echo $SONo;
						?>
					</font>
				</strong>
				<div class="clearfix">
					<br/>
					<label>
						<strong>Lead :</strong>
						<?php 
						$FetchClientName = mysqli_fetch_array(FetchLeadById($_POST['lead_id']));
						echo $FetchClientName['name']."<br/><br/><strong>Product Type:</strong>".$FetchProduct['code']; 
						?>
					</label>
					<label>Quantity <font color="red">*</font>
						<div id=""><input type="text" id="3"  name="quantity" required="required" value="<?php echo $FetchOppurtunity['quantity']; ?>" autocomplete="off" disabled /></div>
					</label>
					<label>Date <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div id=""><input type="text" id="date"  value="<?php echo $FetchOppurtunity['date']; ?>"  name="date" required="required" autocomplete="off" disabled /></div>
					</label>
					<?php echo "<strong>PO Number:</strong>&nbsp;".$_POST['po_number']; ?>
				</div>	
				<div class="clearfix">
					<label><strong>Description : </strong>
						<div id=""><textarea id="0" name="description" disabled><?php echo $FetchOppurtunity['description']; ?></textarea></div>
					</label>
					
					<label>Contact Person <font color="red">*</font>
						<div id=""><input type="text" id="4" value="<?php echo $FetchOppurtunity['contact_person']; ?>"  name="contactperson" required="required" disabled autocomplete="off"/></div>
						<label>Company <font color="red">*</font>
							<div id=""><input type="text" id="5"  name="company" value="<?php echo $FetchOppurtunity['company']; ?>" required="required" disabled autocomplete="off"/></div>
						</label>
					</label>
					<label>Status <font color="red">*</font>
						<div id="2"><select id="status" name="status">
							<option value="">Select</option>
							<?php
								$SelectStatus = SelectStatus();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['sales_status'].'</option>';
								}
							?>
						</select></div>
					</label>
					<label>Comments : 
						<div id=""><textarea id="0" name="comments"></textarea></div>
					</label>
				</div>	
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		<h3>
			<?php
			$SaleOrderCommentsTotalRows = mysqli_fetch_assoc(Select_Comments());
			echo "Total No. of Sale Orders -".$SaleOrderCommentsTotalRows['total'];
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
			while($FetchComments = mysqli_fetch_array($SelectComments))
			{
				$FetchStatus = mysqli_fetch_array(FetchStatus($FetchComments['status_id']));
				$FetchUser  = mysqli_fetch_array(FetchUser($FetchComments['updatedby']));
				$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
				$SONo = "SO".$Digits[7 - strlen($_GET['saleorderid'])].($_GET['saleorderid']);
				echo '<tr>
						<td align="center">'.$SONo.'</td>
						<td align="center">'.$FetchComments['comment_date'].'</td>
						<td align="left">'.$FetchComments['comments'].'</td>
						<td align="center">'.$FetchStatus['sales_status'].'</td>
						<td align="center">'.$FetchUser['firstname'].'</td>
				</tr>';
			} ?>
		</table>
	<?php	
	}
	if(!$_GET['saleorderid'])
	{ 
			$Search = "";
			if(substr($_GET['Search'],0,2)=="SO")
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
			if($_GET['Search'])
				$SaleOrderTotalRows = mysqli_fetch_assoc(Select_Sales_orderSearch($Search));
			else
				$SaleOrderTotalRows = mysqli_fetch_assoc(Select_Sales_order());
			
			?>
		<input type="text" placeholder="Search" id="Search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="Search()" class="button button-orange" >Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<h3>Total No. of Sale Orders -".$SaleOrderTotalRows['total'].'</h3>'; ?>
		<?php	
		echo '<table class="paginate sortable full">
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
				echo '<tr><td colspan="20"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$total_pages = ceil($SaleOrderTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			if($_GET['Search'])
				$Select_Sales_Order = Select_Sales_orderSearchByLimit($Search,$Start, $Limit);
			else
				$Select_Sales_Order = SaleOrder_Select_ByLimit($Start, $Limit);
			
			while($Fetch_Sales_Order = mysqli_fetch_array($Select_Sales_Order))
			{
				$FetchLeadName = mysqli_fetch_array(FetchLeadById($Fetch_Sales_Order['lead_id']));
				$FetchOppurtunity = mysqli_fetch_array(Select_Opportunity($Fetch_Sales_Order['oppurtunity_id']));
				$FetchProduct = mysqli_fetch_array(SelectProductById($FetchOppurtunity['product_id']));
				$FetchCourierBy =  mysqli_fetch_array(SelectCourierById($Fetch_Sales_Order['courier_by_id']));
				$FetchComments = mysqli_fetch_array(FetchComments($Fetch_Sales_Order['id']));
				$FetchStatus = mysqli_fetch_array(FetchStatus($FetchComments['status_id']));
				$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
				$SONo = "SO".$Digits[7 - strlen($Fetch_Sales_Order['id'])].($Fetch_Sales_Order['id']);
				$Users = "";
				$SelectAprovers = SelectApprovers($Fetch_Sales_Order['id']);
				$Approvers = mysqli_num_rows($SelectAprovers);
				while($FetchAprovers = mysqli_fetch_array($SelectAprovers))
				{
					$Approvers--;
					$FetchApproversName = mysqli_fetch_array(FetchUser($FetchAprovers['approved_by']));
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
				//if($FetchUser = mysqli_fetch_array($SelectUser))
				//{
					if(mysqli_num_rows($SelectUser) == mysqli_num_rows(SelectApprovers($Fetch_Sales_Order['id'])))
						echo '<td><a href="?index.php&page=Sales&subpage=spage->Sale_Order,ssubpage->'.$_GET['ssubpage'].'&saleorderid='.$Fetch_Sales_Order['id'].'">'.$SONo.'</a></td>';
					else	
						echo '<td>'.$SONo.'</td>';
				//}
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
	$GETParameters = "page=Sales&subpage=spage->Sale_Order,ssubpage->".$_GET['ssubpage']."&innersubpage=".$_GET['innersubpage']."&saleorderid=".$_GET['saleorderid']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
?>
<script>
	function Search()
	{
		document.location.assign("index.php?page=Sales&subpage=spage->Sale_Order,ssubpage-><?php echo $_GET['ssubpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>