<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#issuancedate").datepicker({dateFormat: 'yy-mm-dd'});
			$("#issuancedate").datepicker().datepicker("setDate", new Date());
		});
	</script>
<div class="columns" style='width:902px;'>
	<?php echo $message; ?>
	<form class="form panel" onsubmit="return validation()">
		<header><h2>Add Issuance</h2></header>
		<hr />				
		<fieldset>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Issuance Code <font color="red">*</font></label>
				<?php
					if($Exixsts = mysqli_fetch_array(Select_Issuance_ByNumber()))
						$Exixsts['number']++;
					else
						$Exixsts['number'] = date("Ym")."0000001";
				?>
				<input type="text" id="number" value="<?php echo $Exixsts['number']; ?>" disabled />
			</div>
			<div class="clearfix">
				<label>&nbsp;Select Date<font color="red">*</font></label>
				<input type="text" autocomplete="off" id="issuancedate" name="issuancedate" required="required" value="<?php echo $_POST['issuancedate']; ?>"/>
			</div>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Issued To <font color="red">*</font></label>
				<select id="client" onchange='var OptionSplit = this.value.split("$"); document.getElementById("issuedto").value = OptionSplit[0]; document.getElementById("issuedtoname").value = OptionSplit[1];'>
					<option value="">Select</option>
					<?php
					$Users = Select_All_Users();
					while($User = mysqli_fetch_assoc($Users))
					{
						if($User['id'] == $_POST['issuedto'])
							echo "<option value='".$User['id']."$".$User['issuanceuser']."' selected>".$User['issuanceuser']."</option>";
						else
							echo "<option value='".$User['id']."$".$User['issuanceuser']."'>".$User['issuanceuser']."</option>";
					} ?>
				</select>
				<input type="hidden" id="issuedto" value="" />
				<input type="hidden" id="issuedtoname" value="" />
			<input type="text" placeholder="Search" id="Search" name="Search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/>
			<label>
				<div id="rawmaterialcode"></div>
			</label>
			</div>
			<center id="issuancetable" style="display:none;">
				<table class="paginate sortable full" style="width:600px;">
					<thead>
						<tr>
							<th align="left">Raw Material</th>
							<th align="left">Batch</th>
							<th align="left">Issued Quantity</th>
							<th align="left">Action</th>
						</tr>
					</thead>
					<tbody id="Datas"></tbody>
				</table>
			</center>
			<div id="New" style="border:1px solid;border-radius:10px;">
				<div class="clearfix">
					<label>&nbsp;&nbsp; category<font color="red">*</font></label>
					<select name="category" id="category" onchange="category1()">
						<option value="">Select</option>
							<?php
								$category = mysqli_query($_SESSION['connection'],"SELECT * FROM category");
								while($categorylist = mysqli_fetch_array($category))
								{
									if($_POST['category']==$categorylist['id'])
										echo "<option value='".$categorylist['id']."' selected>".$categorylist['name']."</option>";
									else
										echo "<option value='".$categorylist['id']."'>".$categorylist['name']."</option>";
								}
							?>
					</select>
				</div>
				<div class="clearfix">
					<label>&nbsp;&nbsp;Raw Material <font color="red">*</font></label>
					<select id="rawmaterialnames" onchange='var OptionSplit = this.value.split("$"); document.getElementById("partno").value = OptionSplit[1];document.getElementById("rawmaterialname").value = OptionSplit[2]; document.getElementById("rawmaterialid").value = OptionSplit[0]; document.getElementById("description").value = OptionSplit[3];document.getElementById("Desc").innerHTML = (OptionSplit[3])?"&nbsp;&nbsp;Desc. : "+OptionSplit[3]:"&nbsp;&nbsp;Part No. : -"; document.getElementById("div_partno").innerHTML = (OptionSplit[1])?"&nbsp;&nbsp;Part No. : "+OptionSplit[1]:"&nbsp;&nbsp;Part No. : -";GetOptions("Batches", OptionSplit[0]);'>
						<option value="">Select</option>
						<?php
						/* $RawMaterials = Select_All_RawMaterial();
						while($RawMaterial = mysqli_fetch_assoc($RawMaterials))
						{
							if($RawMaterial['id'] == $_POST['rawmaterialid'])
								echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."$".$RawMaterial['description']."' selected>".$RawMaterial['materialcode']."</option>";
							else
								echo "<option value='".$RawMaterial['id']."$".$RawMaterial['partnumber']."$".$RawMaterial['materialcode']."$".$RawMaterial['description']."'>".$RawMaterial['materialcode']."</option>";
						}  */?>
					</select>
					<div id="div_partno"></div>
					<div id="Desc"></div>
					<input type="hidden" id="rawmaterialid" value="" />
					<input type="hidden" id="rawmaterialname" value="" />
					<input type="hidden" id="partno" value="" />
					<input type="hidden" id="description" value="" />
				</div>
				<div class="clearfix">
					<label>&nbsp;&nbsp;Batch <font color="red">*</font></label>
					<div id="Batches">
						<select>
							<option value="">Select</option>
						</select>
						<div id="div_available_quantity"></div>
						<input type="hidden" id="batchid" />
						<input type="hidden" id="batchnumber" />
						<input type="hidden" id="available_quantity" value="0" />
					</div>
				</div>
				<div class="clearfix">
					<label>&nbsp;&nbsp;Quantity To Issuance <font color="red">*</font></label>
					<input type="text" id="quantity" required="required" onkeypress="return Amount(event, '');"/>
				</div>
				<center>
					<a class="button button-orange" onclick="validation()">Add</a>
				</center><br />
			</div>
		</fieldset>
	</form>
</div>
</section>
<script>
	var SNo = 1;
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	function Amount(evt, Mode)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(Number(document.getElementById("quantity"+Mode).value+''+String.fromCharCode(charCode)) > document.getElementById("available_quantity"+Mode).value)
			return false;
		if(charCode == 8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}

	function GetOptions(Module, Id)
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
				if(xmlhttp.responseText)
					document.getElementById(Module).innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Issuance_Get_Options.php?Module="+Module+"&id="+Id, true);
		xmlhttp.send();
	}

	function validation()
	{
		var message = "";
		if(!document.getElementById("quantity").value || document.getElementById("quantity").value == 0)
			message = "Enter Issuance quantity to be issued";
		if(document.getElementById("available_quantity").value.length == 0)
			message = "Raw material quantity is not available";
		if(document.getElementById("quantity").value > Number(document.getElementById("available_quantity").value))
			message = "Issuance quantity should be lesser than or equal to available quantity";
		if(!document.getElementById("batchid").value)
			message = "Please select batch";
		if(!document.getElementById("rawmaterialid").value)
			message = "Please select raw material";
		if(!document.getElementById("issuedto").value)
			message = "Please select issuance";
		if(!document.getElementById("number").value)
			message = "Please enter Issuance code";
		
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
					var response = xmlhttp.responseText.split("$$");
					if(response[0] == "Issuance added successfully")
					{
						<?php $_SESSION['Issuance_Id'] = $_SESSION['Last_Id'] = ""; ?>
						document.getElementById("issuancetable").style.display = "block";
						document.getElementById("client").disabled=true;
						//document.getElementById("Datas").innerHTML += "<tr id='"+response[1]+"'><td>"+document.getElementById("rawmaterialname").value+"</td><td>"+document.getElementById("batchnumber").value+"</td><td>"+document.getElementById("quantity").value+"</td><td><a href='#' onclick='Issuance_Actions("+response[1]+", "+document.getElementById("number").value+",\"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Issuance_Actions("+response[1]+", "+document.getElementById("number").value+",\"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td></tr>";
						document.getElementById("Datas").innerHTML += response[2];
						SNo++;
					}
					document.getElementById("New").innerHTML = response[3];
				}
			}
			xmlhttp.open("GET","includes/Issuance_Actions.php?Action=Insert&issuancedate="+document.getElementById("issuancedate").value+"&number="+document.getElementById("number").value+"&issuedto="+document.getElementById("issuedto").value+"&rawmaterialid="+document.getElementById("rawmaterialid").value+"&batchid="+document.getElementById("batchid").value+"&quantity="+document.getElementById("quantity").value, true);
			xmlhttp.send();
		}
		return true;
	}
	var backup, edit = 0;
	function Issuance_Actions(Id, Code, Action)
	{
		if(Action == "Delete")
		{
			if(confirm("Do you really want to delete this record!"))
			{
				document.getElementById(Id).innerHTML = "";
				var xmlhttp;
				if(window.XMLHttpRequest)
					xmlhttp = new XMLHttpRequest();
				else
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
					{
						alert(xmlhttp.responseText);
					}
				}
				xmlhttp.open("GET","includes/Issuance_Actions.php?Action="+Action+"&number="+Code+"&id="+Id, true);
				xmlhttp.send();
			}
		}
		else if(Action == "Edit" && !edit)
		{
			edit = 1;
			backup = document.getElementById(Id).innerHTML;
			document.getElementById(Id).innerHTML = "";
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
					document.getElementById(Id).innerHTML = xmlhttp.responseText;
			}
			xmlhttp.open("GET","includes/Issuance_Actions.php?Action="+Action+"&number="+Code+"&id="+Id, true);
			xmlhttp.send();
		}
		else if(Action == "Update")
		{
			edit = 0;
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
					alert(xmlhttp.responseText);
					if(response[0] == "Issuance details updated successfully")
					{
						document.getElementById(Id).innerHTML = "<td>"+document.getElementById("rawmaterialnameE").value+"</td><td>"+document.getElementById("batchnumberE").value+"</td><td>"+document.getElementById("quantityE").value+"</td><td><a href='#' onclick='Issuance_Actions("+Id+", "+document.getElementById("number").value+",\"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Issuance_Actions("+Id+", "+document.getElementById("number").value+",\"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>";
						SNo++;
					}
				}
			}
			xmlhttp.open("GET","includes/Issuance_Actions.php?Action="+Action+"&id="+Id+"&rawmaterialid="+document.getElementById("rawmaterialidE").value+"&batchid="+document.getElementById("batchidE").value+"&quantity="+document.getElementById("quantityE").value, true);
			xmlhttp.send();
		}
		else if(Action == "Cancel")
		{
			document.getElementById(Id).innerHTML = backup;
			edit = 0;
		}
	}
	function Search()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("rawmaterialcode").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetRawmaterial.php?Search="+document.getElementById("Search").value,true);
		xmlhttp.send();
	}
	function category1()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("rawmaterialnames").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/categoryfilter.php?category="+document.getElementById("category").value,true);
		xmlhttp.send();
	}
	function rawmaterialnames()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("rawmaterialnames").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/categoryfilter.php?category="+document.getElementById("category").value,true);
		xmlhttp.send();
	}
</script>