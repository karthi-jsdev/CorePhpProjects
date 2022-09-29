<br/>
<input type="text" placeholder="Search" id="Search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="Search()" class="button button-orange" >Search</a><br/>&nbsp;
<?php
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
	if($_GET['ApproverId'] && $_GET['SaleOrderId'])
	{
		if(!mysqli_num_rows(SelectApproversById($_GET['ApproverId'],$_GET['SaleOrderId'])))
			AddApprover($_GET['ApproverId'],$_GET['SaleOrderId']);
	}
	echo "<div style='width:1200px;height:450px;overflow-x:auto;overflow-y:auto;'>";
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
				<th>Status</th>
				<th>Comment</th>
				<th>Shipping</th>
				<th>Billing</th>
				<th>Courier By</th>
				<th>Payment</th>';
				$SelectApproversForHeader = Select_Approver();
				while($FetchApprovers = mysqli_fetch_array($SelectApproversForHeader))
					echo '<th>Approver</th>';
			echo '</tr>
		</thead>';
		
	if($Search)	
		$Select_Sales_Orders = Select_Sales_orderSummaryByLimitSearch($Search);
	else
		$Select_Sales_Orders = Select_Sales_orderSummaryByLimit();
	$i = 1;
	if(mysqli_num_rows($Select_Sales_Orders))
	{
		while($Fetch_Sales_Order = mysqli_fetch_array($Select_Sales_Orders))
		{
			$TotalApprover = mysqli_num_rows(Select_Approver());
			$FetchLeadName = mysqli_fetch_array(FetchLeadById($Fetch_Sales_Order['lead_id']));
			$FetchOppurtunity = mysqli_fetch_array(Select_Opportunity($Fetch_Sales_Order['oppurtunity_id']));
			$FetchProduct = mysqli_fetch_array(SelectProductById($FetchOppurtunity['product_id']));
			$FetchCourierBy =  mysqli_fetch_array(SelectCourierById($Fetch_Sales_Order['courier_by_id']));
			$SelectUser = Select_Approver();
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
			if(!(mysqli_num_rows(Select_Approver()) == mysqli_num_rows(SelectApprovers($Fetch_Sales_Order['id']))))
			{
				echo '<tr>
					<td>'.$SONo.'</td>
					<td align="center">'.$FetchLeadName['name'].'</td>
					<td>'.$FetchOppurtunity['description'].'</td>
					<td>'.$FetchProduct['code'].'</td>
					<td>'.$FetchOppurtunity['quantity'].'</td>
					<td>'.$FetchOppurtunity['date'].'</td>
					<td>'.$FetchOppurtunity['contact_person'].'</td>
					<td>'.$FetchOppurtunity['company'].'</td>
					<td>'.$Fetch_Sales_Order['status_id'].'</td>
					<td>'.$Fetch_Sales_Order['comments'].'</td>
					<td>'.$Fetch_Sales_Order['shipping_address'].'</td>
					<td>'.$Fetch_Sales_Order['billing_address'].'</td>
					<td>'.$FetchCourierBy['couriers'].'</td>
					<td>'.$Fetch_Sales_Order['is_self_or_customer_pay'].'</td>';
					while($FetchApprover = mysqli_fetch_array($SelectUser))
					{
						$TotalApprover--;
						$SelectApprovers = mysqli_num_rows(SelectApproversById($FetchApprover['user'],$Fetch_Sales_Order['id']));
						$FetchApproverName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from user where id='".$FetchApprover['user']."'"));
						if(!$SelectApprovers)
						{
							echo '<td><a style="width:120px" onclick="AddApprover('.$FetchApprover['user'].','.$Fetch_Sales_Order['id'].')" class="button button-blue" >Approver '.$i.'</a>';
						}
						else
							echo '<td><a style="width:120px" onclick="AddApprover('.$FetchApprover['user'].','.$Fetch_Sales_Order['id'].')" class="button button-orange" >Approved '.$i.'</a>';
						if(!$TotalApprover)
							$i=1;            
						else
							$i++;
					}
				  echo '</tr>';
			}
		}
	}
	else
		echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td style="color:red">No Data Found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
		echo '</table></div>';
		//$GETParameters = "page=Sales&subpage=spage->Sale_Order,ssubpage->".$_GET['ssubpage']."&innersubpage=".$_GET['innersubpage']."&saleorderid=".$_GET['saleorderid']."&";
		//if($total_pages > 1)
			//include("includes/Pagination.php");
	if($_GET['ApproverId'] && $_GET['SaleOrderId'])
	{
		$SeleCtApprovers = SelectApprovers($_GET['SaleOrderId']);
		if(mysqli_num_rows($SeleCtApprovers))
		{
			echo '<br/><br/><table  class="paginate sortable">
						<thead>
							<tr>
								<th>SO No</th>
								<th>Approved By</th>
								<th>Date</th>
							</tr>
						</thead>';
			while($FetchApprovers = mysqli_fetch_array($SeleCtApprovers))
			{
				$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
				$SONo = "SO".$Digits[7 - strlen($FetchApprovers['sales_order_id'])].($FetchApprovers['sales_order_id']);
				$FetchUser = mysqli_fetch_array(FetchUser($FetchApprovers['approved_by']));
				echo '<tr>
					<td>'.$SONo.'</td>
					<td>'.$FetchUser['firstname'].'</td>
					<td>'.date('d-m-Y', strtotime($FetchApprovers['date_time'])).'</td>
				</tr>';
			}
			echo '</table>';
		}
	} ?>
<script>
	function AddApprover(ApproverId,SaleOrderId)
	{
		if(ApproverId == <?php echo $_SESSION['id']; ?>)
			document.location.assign("index.php?page=Sales&subpage=spage->Sale_Order,ssubpage-><?php echo $_GET['ssubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&ApproverId="+ApproverId+"&SaleOrderId="+SaleOrderId);
	}
	function Search()
	{
		document.location.assign("index.php?page=Sales&subpage=spage->Sale_Order,ssubpage-><?php echo $_GET['ssubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>