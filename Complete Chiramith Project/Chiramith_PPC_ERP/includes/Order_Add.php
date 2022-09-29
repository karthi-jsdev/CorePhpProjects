<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#tentative_date").datepicker(
			{
				dateFormat: "dd-mm-yy", minDate: 0,
				onSelect: function (date)
				{
					var date2 = $('#tentative_date').datepicker('getDate');
					var productionDays = (Number(($('#plannedquantity').val()/($('#product_output_perhour').val()*$('#productionhours').val())))+Number($('#settingdays').val()));
console.log("(plannedquantity/(product_output_perhour*productionhours))+settingdays = "+productionDays+" - Ceil:"+Math.ceil(productionDays));
					date2.setDate(date2.getDate() + Math.ceil(productionDays));
					var Sundays = (Number(CountSundays($('#tentative_date').datepicker('getDate'),  date2)));
//console.log(date2+"--"+(date2.getDate()+Number(CountSundays($('#tentative_date').datepicker('getDate'),  date2))));
					//date2.setDate(date2.getDate() + CountSundays);

					$('#tentative_enddate').datepicker('setDate', date2);
					$('#tentative_enddate').datepicker('option', 'minDate', date2);
					if(date2 != $('#tentative_enddate').val())
						$('#tentative_enddate').datepicker('setDate', date2);
					Display_Available_Machines();
				}
			});
			$('#tentative_enddate').datepicker(
			{
				dateFormat: "dd-mm-yy", minDate: 0,
				onClose: function()
				{
					var dt1 = $('#tentative_date').datepicker('getDate'), dt2 = $('#tentative_enddate').datepicker('getDate');
					if(dt2 <= dt1)
						$('#tentative_enddate').datepicker('setDate', $('#tentative_enddate').datepicker('option', 'minDate'));
					Display_Available_Machines();
				}
			});
		});
		
		//To add the number of sundays.
		function CountSundays(Start, End)
		{
			var Sundays = 0, Inter = Start;
			while(Inter <= End)
			{
				if(Inter.getDay() == 0)
					++Sundays;
				Inter.setDate(Inter.getDate() + 1);
			}
			if(Sundays) //After addition if the end date is a sunday then increment by 1
			{
				End.setDate(End.getDate() + Sundays);
				if(End.getDay() == 0)
					return Sundays+1;
			}
			return Sundays;
		}
	</script>
</head>
<div class="columns">
	<?php echo $message; ?>
	<div class="grid_6 first" style="width:950px;">
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Create Order</h2></header>
			<hr />
			<fieldset>
				<div class="clearfix" style="padding-left:15px;">
					<label>Order No <font color="red">*</font>
						<input type="text" id="number" name="number" required="required" value="<?php echo $_POST['number']; ?>" onkeypress="return Order_number(event)" onblur="GetCustomers(this.value)" />
					</label>
					<label>Customer Name <font color="red">*</font>
						<div id="customer">
							<select id="" name="customer_id" onchange='var OptionSplit = this.value.split("."); document.getElementById("customer_id").value = OptionSplit[0]; document.getElementById("customer_name").value = OptionSplit[1];'>
								<option value="">Select</option>
								<?php
								$Customers = Customers_Select_All();
								while($Customer = mysqli_fetch_assoc($Customers))
									echo "<option value='".$Customer['id'].".".$Customer['name']."'>".$Customer['name']."</option>";
								?>
							</select>
							<input type="hidden" id="customer_id" value="" />
							<input type="hidden" id="customer_name" value="" />
						</div>	
					</label>
				</div>
				<div id="New" style="border:1px solid;border-radius:15px;">
					<div class="clearfix" style="padding-left:15px;">
						<label>Drawing Number <font color="red">*</font>
							<select id="" name="product_id" onchange='var OptionSplit = this.value.split("$");document.getElementById("product_id").value = OptionSplit[0]; document.getElementById("product_drawing_number").value = OptionSplit[1];document.getElementById("product_output_perhour").value = OptionSplit[2];'>
								<option value="$$">Select</option>
								<?php
								$Products = Products_Select_All();
								while($Product = mysqli_fetch_assoc($Products))
									echo "<option value='".$Product['id']."$".$Product['drawing_number']."$".$Product['outputperhour']."'>".$Product['drawing_number']."</option>";
								?>
							</select>
							<input type="hidden" id="product_id" />
							<input type="hidden" id="product_drawing_number" />
							<input type="hidden" id="product_output_perhour" />
						</label>
                        <label>Total Order Quantity <font color="red">*</font>
							<input type="text" id="totalorderquantity" required="required" value="<?php echo $_POST['totalorderquantity']; ?>" onkeypress="return isNumeric(event)"/>
						</label>
						<label>Planned Quantity <font color="red">*</font>
							<input type="text" id="plannedquantity" required="required" value="<?php echo $_POST['plannedquantity']; ?>" onkeypress="return isNumeric(event)"/>
						</label>
						<label style="width:300px;">Total No Of Machine Setting Days<font color="red">*</font>
							<input type="text" id="settingdays" required="required" value="<?php echo $_POST['settingdays']; ?>" onkeypress="return isNumeric(event)"/>
						</label>
					</div>
					<div class="clearfix" style="padding-left:15px;">
						<label>Production Hours <font color="red">*</font>
							<input type="text" id="productionhours" required="required" onkeypress="return isNumeric(event)"/>
						</label>
						<label>Tentative Machine Setting Date<font color="red">*</font>
							<input type="text" id="tentative_date" onkeypress="return false" required="required" />
						</label>
						<label>Tentative Machine End Date <font color="red">*</font>
							<input type="text" id="tentative_enddate" onkeypress="return false" required="required" />
						</label>
						<label>Machine <font color="red">*</font>
							<div id="machines">
								<select id="machine_id" name="machine_id">
									<option value="">Select</option>
								</select>
								<input type="hidden" id="section_name" />
							</div>
						</label>
                    </div>
					<center>
						<a class="button button-blue" onclick="validation()" >Add New</a>&nbsp;&nbsp;
						<a class="button button-blue" onclick="window.location.assign('?page=<?php echo $_GET['page'];?>&subpage=Job Status&number='+document.getElementById('number').value)">Finish</a>
					</center><br />
				</div>
			</fieldset>
		</form>
	</div>
</div>
<div class="columns" style="width:950px;">
	<h3>Added Jobs</h3><hr />
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.No.</th>
				<th align="left">Order No</th>
				<th align="left">Customer Name</th>
				<th align="left">Drawing Number</th>
				<th align="left">Section</th>
				<th align="left">Total Order Quantity</th>
				<th align="left">Planned Quantity</th>
				<th align="left">Machine</th>
				<th align="left">Production Hours</th>
				<th align="left">Total Number Of Machine Setting Days</th>
				<th align="left">Tentative Machine Setting Date</th>
				<th align="left">Tentative Machine End Date</th>
			</tr>
		</thead>
		<tbody id="Datas"></tbody>
	</table>
	<br />
</div>

<script>
	var SNo = 1;
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function Order_number(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 32 || charCode == 34)
			return false;
		else
			return true;
	}

	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if(charCode == 8 || charCode == 9 || charCode == 46)
			return true;
        var keynum, keychar, charcheck = /[a-zA-Z0-9]/;
        if(window.event)
            keynum = e.keyCode;
        else
		{
            if(e.which)
                keynum = e.which;
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	
	function validation()
	{
		var message = "";
		if(document.getElementById("machine_id").value == "")
			message = "Please select machine";
		if(document.getElementById("tentative_enddate").value == "")
			message = "Please select tentative end date";
		if(document.getElementById("tentative_date").value == "")
			message = "Please select tentative date";
		if(document.getElementById("productionhours").value <= 0)
			message = "Production hours should be greater than 0";	
		if(document.getElementById("productionhours").value == "")
			message = "Please enter production hours";
		if(document.getElementById("settingdays").value <= 0)
			message = "Setting days should be greater than 0";	
		if(document.getElementById("settingdays").value == "")
			message = "Please enter setting days";
		if(document.getElementById("plannedquantity").value<=0)
			message = "Planned quantity should be greater than 0";	
		if(document.getElementById("plannedquantity").value == "")
			message = "Please enter planned quantity";
		if(document.getElementById("totalorderquantity").value<=0)
			message = "Total order quantity should be greater than 0";	
		if(document.getElementById("totalorderquantity").value == "")
			message = "Please enter total order quantity";	
		if(document.getElementById("product_id").value == "")
			message = "Please select Drawing number";
		/*if(document.getElementById("quantity").value<=0)
			message = "Order quantity shouldbe greater than 0";	
		if(document.getElementById("quantity").value=="")
			message = "Please enter total order quantity";*/
		if(document.getElementById("customer_id").value=="")
			message = "Please select customer name";
		if(document.getElementById("number").value== "")
			message = "Please enter order number ";
		if(message)
			alert(message);
		else
		{
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					var response = xmlhttp.responseText.split("#");
					if(response[0] == "Job order added successfully")
					{
						document.getElementById("number").disabled=true;
						document.getElementById("customer_id").disabled=true;
						document.getElementById("Datas").innerHTML += "<tr><td>"+SNo+++".</td><td>"+document.getElementById("number").value+"</td><td>"+document.getElementById("customer_name").value+"</td><td>"+document.getElementById("product_drawing_number").value+"</td><td>"+document.getElementById("section_name").value+"</td><td>"+document.getElementById("totalorderquantity").value+"</td><td>"+document.getElementById("plannedquantity").value+"</td><td>"+document.getElementById("machine_number").value+"</td><td>"+document.getElementById("productionhours").value+"</td><td>"+document.getElementById("settingdays").value+"</td><td>"+document.getElementById("tentative_date").value+"</td><td>"+document.getElementById("tentative_enddate").value+"</td></tr>";
						form_clear();
					}
				}
			}
			xmlhttp.open("GET","includes/Order_Actions.php?Action=Insert&number="+document.getElementById("number").value+"&customer_id="+document.getElementById("customer_id").value+"&product_id="+document.getElementById("product_id").value+"&totalorderquantity="+document.getElementById("totalorderquantity").value+"&plannedquantity="+document.getElementById("plannedquantity").value+"&machine_id="+document.getElementById("machine_id").value+"&productionhours="+document.getElementById("productionhours").value+"&settingdays="+document.getElementById("settingdays").value+"&tentative_date="+document.getElementById("tentative_date").value+"&tentative_enddate="+document.getElementById("tentative_enddate").value, true);
			xmlhttp.send();
		}
		return true;
	}
	
	function form_clear()
	{
		document.getElementById("totalorderquantity").value = "";
		document.getElementById("plannedquantity").value = "";
		document.getElementById("machine_id").value = "";
		document.getElementById("productionhours").value = "";
		document.getElementById("settingdays").value = "";
		document.getElementById("tentative_date").value = "";
		document.getElementById("tentative_enddate").value = "";
	}
	
	function GetCustomers(Number)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var result = xmlhttp.responseText;
				if(result)
					document.getElementById('customer').innerHTML = result;
			}
		}
		xmlhttp.open("GET","includes/Order_Get_Customer.php?Number="+Number,true);
		xmlhttp.send();
	}
	
	function Display_Available_Machines()
	{
		if(document.getElementById("tentative_date").value && document.getElementById("tentative_enddate").value)
		{
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var result = xmlhttp.responseText;
					if(result)
						document.getElementById('machines').innerHTML = result;
				}
			}
			xmlhttp.open("GET","includes/Order_Get_Machine.php?machineid="+document.getElementById("machine_id").value+"&startdate="+document.getElementById("tentative_date").value+"&enddate="+document.getElementById("tentative_enddate").value,true);
			xmlhttp.send();
		}
	}
</script>