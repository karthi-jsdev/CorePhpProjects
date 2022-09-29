<section class="first">
	<?php
		$Columns = array("id","customerid", "name", "address", "contactname","phone", "fax","email");
		if($_GET['action'] == 'Edit')
		{
			$Customer = mysqli_fetch_assoc(Customer_Select_Id());
			foreach($Columns as $Col)
				$_POST[$Col] = $Customer[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Customer_Delete();
			$message = "<br /><div class='message success'><b>Message</b> : One Customer deleted successfully</div>";
			//$_GET['id']='';
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{	
			$customer_id = mysqli_fetch_assoc(Customer_Select_CustomerId());
			/*$customer = (substr($customer_id['customerid'],3,5))+1;
			echo strlen($customer);
			if(strlen($customer)==1)
				$_POST['customerid']="CAC00".$customer;
			else if(strlen($customer)==2)
				$_POST['customerid']="CAC0".$customer;
			else if(strlen($customer)==3)
				$_POST['customerid']="CAC".$customer;
			else
				$_POST['customerid']="CAC001";*/ 
			if(!$customer_id['id'])
				$_POST['customerid']="CAC001";
			else
			{
				$Zeros = array("", "0", "00"); 
				$_POST['customerid'] = "CAC".$Zeros[3 - strlen($customer_id['id']+1)].($customer_id['id']+1);
			}
			//if(strlen($_POST['phone']) != 10)
				//$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
			//else
			//{ 
				if(isset($_POST['Submit']) && isset($_POST['name']))
				{
					Customer_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Customer added successfully</div>";
				}
				else if(isset($_POST['Update']))
				{
					Customer_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Customer details updated successfully</div>";
				}
			//} 
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}?>
	<div class="columns leading">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" name="form" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<h3>Customer Master</h3><hr/>
				<fieldset>
					<div class="clearfix">
						<label>Customer Name <font color="red">*</font></label>
						<input type="text" id="customername" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return Number_description(event)"/>
					</div>
					<div class="clearfix">
						<label>Address <font color="red">*</font></label>
						<textarea id="address" cols="40" rows="3" name="address" required="required" onkeypress="return NumberCount_address()"><?php echo $_POST['address']; ?></textarea>
					</div>
					<div class="clearfix">
						<label>Contact Person </label>
						<input type="text" id="contactname" name="contactname" value="<?php echo $_POST['contactname']; ?>" onkeypress="return contactperson(event)"/>
					</div>
					<div class="clearfix">
						<label>Phone </label>
						<input type="text" id="phone" name="phone" value="<?php echo $_POST['phone']; ?>" onkeypress="return isNumeric(event)"/>
					</div>
					<div class="clearfix">
						<label>Fax </label>
						<input type="text" id="fax" name="fax" value="<?php echo $_POST['fax']; ?>" onkeypress="return isNumberKey(event)"/>
					</div>
					<div class="clearfix">
						<label>Email Address <font color="red">*</font></label>
						<input type="text" id="email" name="email" required="required" value="<?php echo $_POST['email']; ?>" />
					</div>
				</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-blue" type="submit" name="Update" value="Update" >Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-blue" type="submit" name="Submit" >Submit</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Reset</button>
			</form>
		</div>
	</div>
	<div class="columns leading">
		<div class="first">
			<h3>Customer List:&nbsp;
				<?php 
				$customers = Customer_Select();
				echo 'Total no. of Customers - '.mysqli_num_rows($customers);?> 
			</h3>
			<hr/>
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Customer Id</th>
						<th>Name</th>
						<th>Address</th>
						<th>Contact Name</th>
						<th>Phone</th>
						<th>Fax</th>
						<th>E-Mail</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1; 
					$total = mysqli_fetch_assoc(Customer_Select_ByCount());
					$Limit=10;
					$total_pages = ceil($total['total']/$Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1; 
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $total['total']- $Start;
					else
						$i = $total['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Total_Customer = Customer_Select_ByLimit($Start, $Limit);
				
					if(mysqli_num_rows($customers)==0)
						echo "<tr><td colspan='10' style='color:red;'><center>No Data found</center></td></tr>";
					else
					{
						while($customer = mysqli_fetch_assoc($Total_Customer))
						{
							echo"<tr>
								<td>".$i--."</td>
								<td>".$customer['customerid']."</td>
								<td>".$customer['name']."</td>
								<td>".$customer['address']."</td>
								<td>".$customer['contactname']."</td>
								<td>".$customer['phone']."</td>
								<td>".$customer['fax']."</td>
								<td>".$customer['email']."</td>
								<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$customer['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$customer['id'].")'>Delete</a></td>
							</tr>";
						}
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
</section>
<?php
$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>
<script>
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46 || charCode == 127) 
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
		{
			if(document.getElementById("fax").value.length < 15)
			{
				return true;
				return NumberCount();
			}
			else
				return false;
		}
	}
	/*function validate()
	{
	var x=document.forms["form"]["email"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<2 || dotpos<atpos+2 || dotpos+2>=x.length)
	  {
	  alert("Not a valid e-mail address");
	  return false;
	  }
	}*/
	function NumberCount()
	{
		if(document.getElementById("phone").value.length < 15)
			return true;
		else
			return false;
	}
	function Number_description(evt)
	{	
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46 || charCode == 127) 
			return true;
		if((charCode>=65 && charCode<=90 || charCode>=97 && charCode<=122) || charCode==32)
		{ 
			if(document.getElementById("customername").value.length < 25)
				return true;
			else
				return false;
		}
		else
			return false;
	} 
	function contactperson(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46 || charCode == 127) 
			return true;
		if((charCode>=65 && charCode<=90 || charCode>=97 && charCode<=122)|| charCode==32)
		{ 
			if(document.getElementById("contactname").value.length < 15)
				return true; 
			else
				return false;
		}
		else
			return false;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 9  || charCode == 46) 
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
	function NumberCount_address()
	{
		if(document.getElementById("address").value.length < 150)
			return true;
		else
			return false;
	}
	function validation()
	{
		/*if(document.getElementById("phone").value.length != 10)
		{
			alert("Enter a valid 10-digit Phone number");
				return false;
				return true;
		}*/
		var x=document.forms["form"]["email"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<2 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			alert("Not a valid e-mail address");
			return false;
		}
		var add = document.getElementById("address");
		var addres = add.value.trim().length;
		if (addres == 0)
		{
			alert('Please enter proper address');
			return false;
		}
		var tb = document.getElementById("customername");
		var tbLen = tb.value.trim().length;
		if (tbLen == 0)
		{
			alert('Please enter customer name');
			return false;
		}
		/*var cont = document.getElementById("contactname");
		var conta_name = cont.value.trim().length;
		if (conta_name == 0)
		{
			alert('Please enter contact name');
			return false;
		}*/
	}
</script>