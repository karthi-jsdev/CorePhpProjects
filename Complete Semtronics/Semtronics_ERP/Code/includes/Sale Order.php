<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#6").datepicker({dateFormat: 'yy-mm-dd'});
		});
	</script>
	<?php
		$Columns = array("id","lead_id", "oppurtunity_id", "po_number", "shipping_address", "billing_address", "courier_by_id", "is_self_or_customer_pay");
		if($_GET['action'] == 'Edit')
		{
			$User = mysql_fetch_assoc(SaleOrder_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $User[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			User_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One User deleted successfully</div>";
		}
		if($_GET['LeadId'])
		{
			$_POST['lead_id'] = $_GET['LeadId'];
			$_POST['oppurtunity_id'] = $_GET['oppurtunity_id'];
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				SaleOrder_Insert();
				$message = "<br /><div class='message success'><b>Message</b> : Sale Order added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				SaleOrder_Update();
				$message = "<br /><div class='message success'><b>Message</b> : Sale Order details updated successfully</div>";
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		} ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form style="width:1000px" method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Sale Order</h2></header>
			<hr />				
			<fieldset>
				<strong>
					<font color="red">SO No:
					<?php
					if($_GET['action'] != 'Edit')
					{
						$FetchSalesNo = mysql_fetch_assoc(Select_SalesNo());
						$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
						$SONo = "SO".$Digits[7 - strlen($FetchSalesNo['id']+1)].($FetchSalesNo['id']+1);
						echo $SONo;
					}
					else
					{
						$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
						$SONo = "SO".$Digits[7 - strlen($_GET['id'])].($_GET['id']);
						echo $SONo;
					} ?>
					</font>
				</strong>
				<div class="clearfix">
					<label>Lead<font color="red">*</font>
						<select name="lead_id" id="lead_id" onchange="GetWork(this.value,'')">
							<option value="">Select</option>
							<?php
							$SelectClient = Select_Client();
							while($FetchClient = mysql_fetch_array($SelectClient))
							{
								if($_POST['lead_id']==$FetchClient['id'])
									echo '<option value="'.$FetchClient['id'].'" selected>'.$FetchClient['name'].'</option>';
								else
									echo '<option value="'.$FetchClient['id'].'">'.$FetchClient['name'].'</option>';
							} ?>
						</select>
					</label>
					<label>Product Category <font color="red">*</font>
						<div id="1"><select id="productcategory" name="productcategory">
							<option value="">Select</option>
							<?php
							$SelectProductCategory = SelectProductCategory();
							while($FetchProductCategory = mysql_fetch_array($SelectProductCategory))
								echo '<option value="'.$FetchProductCategory['id'].'">'.$FetchProductCategory['productcategory'].'</option>';
							?>
						</select></div>
					</label>
					<label>Quantity <font color="red">*</font>
						<div id=""><input type="text" id="3"  name="quantity" required="required" autocomplete="off" onkeypress="return isNumeric(event)" /></div>
					</label>
					<label>Company <font color="red">*</font>
						<div id=""><input type="text" id="5"  name="company" required="required" autocomplete="off" onkeypress="return AlphaNumCheck(event)"/></div>
					</label>
					<label>Courier By <font color="red">*</font>
						<select id="courier_by_id" name="courier_by_id">
							<option value="">Select</option>
							<?php
							$SelectCourier = SelectCourier();
							while($FetchCourier = mysql_fetch_array($SelectCourier))
							{
								if($_POST['courier_by_id']==$FetchCourier['id'])
									echo '<option value="'.$FetchCourier['id'].'" selected>'.$FetchCourier['couriers'].'</option>';
								else
									echo '<option value="'.$FetchCourier['id'].'">'.$FetchCourier['couriers'].'</option>';
							} ?>
						</select>
					</label>
				</div>	
				<div class="clearfix">
					<label>Work <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div id="work"><select id="workid" name="workid">
							<option value="">Select</option>
						</select></div>
					</label>
					<label>Product <font color="red">*</font>
						<div id="2"><select id="product" name="product">
							<option value="">Select</option>
							<?php
							$SelectProduct = SelectProduct();
							while($FetchProduct = mysql_fetch_array($SelectProduct))
							{
								echo '<option value="'.$FetchProduct['id'].'">'.$FetchProduct['code'].'</option>';
							} ?>
						</select></div>
					</label>
					<label>Date <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div id=""><input type="text" id="6"  name="date" required="required" autocomplete="off"/></div>
					</label>
					<label>Contact Person <font color="red">*</font>
						<div id=""><input type="text" id="4"  name="contactperson" required="required" autocomplete="off"/></div>
					</label>
					<?php
					$Pays = array("Courier-Customer","Courier-SelfPay");
					$i=0;
					foreach($Pays as $Pay)
					{
						if($_POST['is_self_or_customer_pay']==$i)
							echo '<span class="radio-input"><input type="radio" name="is_self_or_customer_pay" value="'.$i++.'" checked>'.$Pay.'</input></span>';
						else
						{
							if($i==0)
								echo '<span class="radio-input"><input type="radio" name="is_self_or_customer_pay" value="'.$i++.'" checked>'.$Pay.'</input></span>';
							else
								echo '<span class="radio-input"><input type="radio" name="is_self_or_customer_pay" value="'.$i++.'">'.$Pay.'</input></span>';
						}
					} ?>
				</div>	
				<div class="clearfix">
					<label>Description <font color="red">*</font>
						<div id=""><textarea id="0" name="description"></textarea></div>
					</label>
					<label>Shipping Address <font color="red">*</font>
						<textarea  id="shipping_address"  name="shipping_address" required="required" autocomplete="off"><?php echo $_POST['shipping_address']; ?></textarea>
						<?php
						if($_POST['shipping_address'] && ($_POST['shipping_address']==$_POST['billing_address']))
							echo '<input type="checkbox" id="bill" onclick="PreFillBilling()" value="1" name="bill" checked/>';
						else
							echo '<input type="checkbox" id="bill" onclick="PreFillBilling()" value="1" name="bill"/>';
						?>
					</label>
					<label>Billing Address <font color="red">*</font>
						<textarea  id="billing_address"  name="billing_address" required="required" autocomplete="off"><?php echo $_POST['billing_address']; ?></textarea>
					</label>
					<label>PO Number <font color="red">*</font>
						<input type="text" id="po"  name="po" value="<?php echo $_POST['po_number']; ?>" required="required" autocomplete="off"/>
					</label>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
	<input type="text" placeholder="Search" id="Search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="Search()" class="button button-orange" >Search</a><br/>&nbsp;
	</div>
	<h3>Sale Order List
		<?php
		if($_GET['Search'])
			$SaleOrderTotalRows = mysql_fetch_assoc(Select_Sales_orderSearch($_GET['Search']));
		else
			$SaleOrderTotalRows = mysql_fetch_assoc(Select_Sales_order());
		echo " : No. of Total Sale Order -".$SaleOrderTotalRows['total'];
		?>
	</h3>
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
					<th>Approved</th>
					<th>Status</th>
					<th>Comment</th>
					<th>Shipping</th>
					<th>Billing</th>
					<th>Courier By</th>
					<th>Payment</th>
					<th>Action</th>
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
					<td>'.$SONo.'</td>
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
					<td ><a href="index.php?page=Sales&subpage=spage->Sale_Order,ssubpage->'.$_GET['ssubpage'].'&id='.$Fetch_Sales_Order['id'].'&pageno='.$_GET['pageno'].'&action=Edit" class="action-button" title="user-edit"><span class="user-edit"></span></a>  &nbsp; <a href="#" onclick="deleterow('.$Fetch_Sales_Order['id'].')" class="action-button" title="user-delete"><span class="user-delete"></span></a></td>
				  </tr>';
		}
		echo '</table>';
	?>	
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=Sales&subpage=spage->Sale_Order,ssubpage->".$_GET['ssubpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 32)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	function Search()
	{
		document.location.assign("index.php?page=Sales&subpage=spage->Sale_Order,ssubpage-><?php echo $_GET['ssubpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8) 
			return true;
        if (charCode == 42 || charCode == 45 || charCode == 46 || charCode == 95 || charCode == 64 || charCode == 63 || charCode == 32) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode==45)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("courier_by_id").value == "")
			message = "Please select courier-by ";
		if(document.getElementById("productcategory").value == "")
			message = "Please select product category";
		if(document.getElementById("workid").value == "")
			message = "Please select work";
		if(document.getElementById("lead_id").value == "")
			message = "Please select lead";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	<?php
	if($_POST['lead_id'])
	{ ?>
		GetWork(<?php echo $_POST['lead_id'];?>,<?php echo $_POST['oppurtunity_id'];?>);
	<?php
	} 
	if($_POST['oppurtunity_id'])
	{ ?>
		GetWorkDetails(<?php echo $_POST['oppurtunity_id'];?>);
	<?php
	} ?>
	function GetWork(LeadId,WorkId)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('work').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetWork.php?LeadId="+LeadId+"&WorkId="+WorkId,true);
		xmlhttp.send();
	}
	function GetWorkDetails(WorkId)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var results = xmlhttp.responseText;
				var splitresults = results.split("#");
				for(var i=0;i<splitresults.length;i++)
				{
					if(i<3)
						document.getElementById(i).innerHTML = splitresults[i];
					else
						document.getElementById(i).value = splitresults[i];
				}
			}
		}
		xmlhttp.open("GET","includes/GetWorkDetails.php?WorkId="+WorkId,true);
		xmlhttp.send();
	}
	<?php
	if($_POST['shipping_address'] && ($_POST['shipping_address']==$_POST['billing_address']))
	{ ?>
		document.getElementById("billing_address").disabled = true;
	<?php
	} ?>
	function PreFillBilling()
	{
		var Category = document.getElementsByName("bill"), flag = 0;
		for (var i = 0; i< Category.length; i++)
			if(Category[i].checked)
				flag++;
		if(flag)
		{
			document.getElementById('billing_address').value = document.getElementById('shipping_address').value;
			document.getElementById("billing_address").disabled = true;
		}
		else
			document.getElementById("billing_address").disabled = false;
	}
</script>