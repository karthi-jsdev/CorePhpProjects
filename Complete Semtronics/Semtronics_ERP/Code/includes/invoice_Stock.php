<?php session_start();?>
<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
<script src="js/datepicker/jquery.ui.core.js"></script>
<script src="js/datepicker/jquery.ui.widget.js"></script>
<script src="js/datepicker/jquery.ui.datepicker.js"></script>
<script>
	$(function()
	{
		$("#date").datepicker({dateFormat: 'yy-mm-dd',minDate:-45});
		$("#date").datepicker().datepicker("setDate", new Date());
	});
</script>
<section role="main" id="main">
	<div class="columns" style='width:902px;'>
	<?php echo $message;?>
		<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form1" class="form panel" onsubmit="return validate();" enctype="multipart/form-data" >
			<fieldset>
				<h3>Stock</h3>
				<input type="hidden" name="id" id="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<div class="clearfix">
					<label><strong>Select Date</strong><font color="red">*</font>
						<input type="text" autocomplete="off" id="date" name="date" required="required" value="<?php echo $_POST['date']; ?>"/> <!-- onkeypress="return isAlphabetic(event)"-->
					</label>
					<label><strong>Vendor Name </strong><font color="red">*</font>
						<select id="vendorid" name="vendorid" required="required" onchange="load_rawmaterial(this.value);">
							<option value="">Select</option>
							<?php
							$vendor = Vendor_Dropdowndisplay();
							while($vendor_name = mysql_fetch_assoc($vendor))
							{
								if($_POST['vendorid']==$vendor_name['id'])
									echo '<option value="'.$vendor_name['id'].'" selected="selected">'.$vendor_name['name'].'</option>';
								else
									echo '<option value="'.$vendor_name['id'].'">'.$vendor_name['name'].'</option>';
							}
							?>
						</select>
					</label>
					<label><strong>Invoice Number</strong><font color="red">*</font>
						<input type="text" autocomplete="off" id="number" name="number" required="required" value="<?php echo $_POST['number']; ?>"/> 
					</label><br/>
					<label><strong>Excise Tax</strong>
						<select multiple="multiple" name="excises[]" id="excises">
							<option value="Select">Select</option>
							<?php
							$excisetax = mysql_query("SELECT * FROM excisetax");
							while($excise = mysql_fetch_assoc($excisetax))
							{
								if($_POST['excise']==$excise['id'])
									echo'<option value='.$excise['percent'].' selected>'.$excise['percent'].'</option>';
								else
									echo'<option value='.$excise['percent'].'>'.$excise['percent'].'</option>';
							} ?>
						</select> 
					</label>
					<label><strong>Courier Charges </strong>
						<input type="text" autocomplete="off" id="couriers" name="couriers" value=""/>
					</label>
					<label><strong>Scanned File </strong>
						<!--?php $_SESSION['Uploaded_Image'] = ""; ?>
						<form method="POST" name="form1" id="form1" onsubmit="return validate();" enctype="multipart/form-data" action='includes/UploadImage.php' target='upload_to'>
							<input type="file" autocomplete="off" id="file" name="file" value="" />
						</form-->
<?php 
	$_SESSION['Uploaded_Image'] = "";
	$_SESSION['type'] = "";
	$_SESSION['tmp_name'] = "";
	$_SESSION['size'] = "";
 ?>
<html> 
<script language="Javascript">
	function fileUpload(form, action_url, div_id)
	{
		// Create the iframe...
		var iframe = document.createElement("iframe");
		iframe.setAttribute("id", "upload_iframe");
		iframe.setAttribute("name", "upload_iframe");
		iframe.setAttribute("width", "0");
		iframe.setAttribute("height", "0");
		iframe.setAttribute("border", "0");
		iframe.setAttribute("style", "width: 0; height: 0; border: none;");
	 
		// Add to document...
		form.parentNode.appendChild(iframe);
		window.frames['upload_iframe'].name = "upload_iframe";
	 
		iframeId = document.getElementById("upload_iframe");
	 
		// Add event...
		var eventHandler = function()
		{
			if(iframeId.detachEvent)
				iframeId.detachEvent("onload", eventHandler);
			else
				iframeId.removeEventListener("load", eventHandler, false);

			// Message from server...
			if(iframeId.contentDocument)
				content = iframeId.contentDocument.body.innerHTML;
			else if(iframeId.contentWindow)
				content = iframeId.contentWindow.document.body.innerHTML;
			else if(iframeId.document)
				content = iframeId.document.body.innerHTML;

			document.getElementById(div_id).innerHTML = content;
			// Del the iframe...
			setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
		}
	 
		if(iframeId.addEventListener)
			iframeId.addEventListener("load", eventHandler, true);
		if(iframeId.attachEvent)
			iframeId.attachEvent("onload", eventHandler);
	 
		// Set properties of form...
		form.setAttribute("target", "upload_iframe");
		form.setAttribute("action", action_url);
		form.setAttribute("method", "post");
		form.setAttribute("enctype", "multipart/form-data");
		form.setAttribute("encoding", "multipart/form-data");
	 
		// Submit the form...
		form.submit();
		document.getElementById(div_id).innerHTML = "Uploading...";
	}
	
	$(function()
	{
		$("input:file").change(function()
		{
			if($(this).val())
				$("#Upload_Bt").click();
		});
	});
</script>
 
<!-- index.php could be any script server-side for receive uploads. -->
<form>
	<input type="file" name="datafile" /></br>
	<input type="button" id="Upload_Bt" value="upload" onClick="fileUpload(this.form,'includes/UploadImage.php','upload'); return false;" style="display:none;">
	<div id="upload"></div>
</form>
</html>
					</label><br/>
					<label style="float:right;">
						<div id="partnumber"></div>
					</label>
					<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<label style="float:left;">
						<div id="rawmaterialcode"></div>
					</label>
				</div>
				<center>
					<table id="tabledata" class="paginate sortable full" style="display:none;">
						<thead>
							<tr>
								<th>RawmaterialCode</th>
								<th>Category Name</th>
								<th>Part No</th>
								<th>Description</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Amount</th>
								<th>Location</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="tabledata1"></tbody>
					</table>
				</center>
				<br/>
				<input type="text" placeholder="Search" id="Search" name="Search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/>
				<div style="border:2px solid red;border-radius:15px;background-color:#C0C0C0">
					<div class="clearfix">
						<label><strong>Raw Material</strong><font color="red">*</font>
							<div id="divmaterialcode">
								<select id="materialcode1" name="materialcode1" onchange="var splitMeterial = split.this.value('$'); document.getElementById('materialcode').value=splitMeterial[0]; alert(splitMeterial[0]); document.getElementById('partnumber').innerHTML = splitMeterial[1]; GetTax(splitMeterial[0])" required="required">
									<option value="">Select</option>
									<?php
									$rawmaterialcode = Raw_material_Data();
									while($materialcode = mysql_fetch_assoc($rawmaterialcode))
									{
										if($_POST['materialcode']==$materialcode['id'])
											echo '<option value="'.$materialcode['id'].'$'.$materialcode['partnumber'].'$'.$materialcode['description'].'" selected="selected">'.$materialcode['materialcode'].'</option>';
										else
											echo '<option value="'.$materialcode['id'].'$'.$materialcode['partnumber'].'$'.$materialcode['description'].'">'.$materialcode['materialcode'].'</option>';
									} ?>
								</select>
							</div>
								<input type="hidden" id="materialcode" name="materialcode" value="<?php echo $_POST['materialcode'];?>" />
						</label>
						<label><strong>Batch Number </strong><font color="red">*</font>
							<input type="text" autocomplete="off" id="batchnumber" required="required" name="batchnumber" value=""/>
							<strong>E.G.: B0001</strong>
						</label>
						<label><strong>Quantity </strong><font color="red">*</font>
							<input type="text" autocomplete="off" id="quantity" required="required" name="quantity" value="" onkeypress="return stock_quantity(event);" onkeyup="addition();" onkeypress="rawmaterialchecking();"/>
						</label>
						<label><strong>Unit Price </strong><font color="red">*</font>
							<input type="text" autocomplete="off" id="unitprice" required="required" name="unitprice" value="" onkeypress="return Stock_unitprice(event);" onkeyup="addition();"/>
						</label>
					</div>
					<div class="clearfix">
						<label><strong>Amount </strong><font color="red">*</font>
							<input type="text" autocomplete="off" id="amount" required="required" name="amount" value="" style="background-color:#E0E0E0;" readonly/>
						</label>
						<input type="hidden" id="percent" value="" />
						<input type="hidden" id="id" value="" />
						<label><strong>Applicable Tax </strong><font color="red">*</font>
							<div id="changetax">
								<select id="taxid" name="taxid" required="required" onchange='var OptionSplit = this.value.split(","); document.getElementById("percent").value = OptionSplit[1];document.getElementById("id").value = OptionSplit[0];'/> <?php //Calculate_Excise_WithTotal();?>
									<option value="">Select</option>
									<?php
									$Taxs = Select_All_Tax();
									while($Tax = mysql_fetch_assoc($Taxs))
									{
										echo '<option onchange="taxamount();" value="'.$Tax['id'].','.$Tax['percent'].'">'.$Tax['type'].'-'.$Tax['percent'].'%</option>';
									} ?>
								</select>
							</div>	
						</label>
						<label><strong>Tax Amount </strong><font color="red">*</font>
							<input type="text" autocomplete="off" id="taxamount" name="taxamount" value="" style="background-color:#E0E0E0;" readonly />
						</label>
						<label><strong>Total Amount </strong><font color="red">*</font>
							<input type="text" autocomplete="off" id="totalamount" value="" style="background-color:#E0E0E0;" readonly />
						</label>
					</div>
					<div class="clearfix" id="locationselect">
						<label><strong>Location </strong><font color="red">*</font>
							<select id="locationid" name="locationid" required="required">
								<option value="">Select</option>
								<?php
								$Location = Location_Select_All();
								while($Locations = mysql_fetch_array($Location))
								{
									echo '<option value="'.$Locations['id'].'">'.$Locations['name'].'</option>';
								} ?>
							</select>
						</label>
					</div>
						<input type="hidden" autocomplete="off" id="excistaxes1" value="" style="background-color:#E0E0E0;" readonly/>
						<input type="hidden" autocomplete="off" id="excistaxes2" value="" style="background-color:#E0E0E0;" readonly/>
						<input type="hidden" autocomplete="off" id="excistaxes3" value="" style="background-color:#E0E0E0;" readonly/>
						</label>
					<div class="clearfix">
						<center>
							<a class="button button-green" name="addnew" id="addnew" onclick="stock_insert();">Add New</a>
							<a class="button button-green" id="d" onclick="Finish();">Finish</a>
						</center>
					</div>
					<hr/>
				</div>
			</fieldset>
		</form>
	</div>
</section>
<script>
	$(document).ready(function (e)
	{
		$('#form1').submit(function()
		{
			if(Message = Validation())
				alert(Message);
			else
				$('div#ajax_upload_demo img').attr('src','loading.gif');
		});
		
		$('iframe[name=upload_to]').load(function()
		{
			var result = $(this).contents().text();
			if(result !='')
			{
				if(result == 'Err:big')
				{
					$('div#ajax_upload_demo img').attr('src','avatar_big.jpg');
					return;
				}
				if(result == 'Err:format')
				{
					$('div#ajax_upload_demo img').attr('src','avatar_invalid.jpg');
					return;
				}
				$('div#ajax_upload_demo img').attr('src',$(this).contents().text());
			}
		});
	});
	
	function addition()
	{	
		document.getElementById("locationid").value="";
		document.getElementById("taxid").value="";
		document.getElementById("taxamount").value="";
		document.getElementById("totalamount").value="";
		//document.getElementById("etotalamount").value="";
		var quantity = document.getElementById("quantity").value;
		var unitprice = document.getElementById("unitprice").value;
		if(document.getElementById("quantity").value && document.getElementById("unitprice").value)
			document.getElementById("amount").value = quantity * unitprice;
	}
	function taxamount()
	{
		var e = document.getElementById("taxid").value;
		var spli = e.split(",");
		var x = spli[1];
		var amt = document.getElementById("amount").value;
		var tax = document.getElementById("percent").value;
		var amount = parseFloat(amt);
		var y = parseFloat(tax);
		var totaltaxamt = ((amount*tax)/100);
		var z = totaltaxamt + amount;
		document.getElementById("taxamount").value = totaltaxamt;
		document.getElementById("totalamount").value = z;
		//document.getElementById("etotalamount").value = totaltaxamt + z;
		if(document.getElementById("excises").selectedIndex)
		{
			var data = $('#excises').val().toString().split(',');
			var excisetax = data.length;
			for(var i=0;i<excisetax;i++)
			{
				var x = data[0];
				var y = data[1];
				var z = data[2];
			}
			document.getElementById("excistaxes1").value = x;
			document.getElementById("excistaxes2").value = y;
			document.getElementById("excistaxes3").value = z;
		}
	}
	function Finish()
	{
		document.location.assign('index.php?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='+document.getElementById('number').value+'&vendor='+document.getElementById('vendorid').value);
	}
	$( document ).ready(function()
	{
		$('#uniform-locationid').removeAttr('class');
		$('#uniform-locationid').removeAttr('style');
		$('#locationid').removeAttr('style');
		$("#uniform-locationid span").remove();
	});
	
	function GetTax(RawMeterialId)
	{
		document.getElementById("taxid").value="";
		document.getElementById("taxamount").value="";
		document.getElementById("totalamount").value="";
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById('changetax').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetTax.php?RawMeterialId="+RawMeterialId,true);
		xmlhttp.send();
	}
	function autoclear()
	{
		document.getElementById("materialcode").value="";
		document.getElementById("materialcode1").selectedIndex="0";
		document.getElementById("locationid").selectedIndex="0";
		document.getElementById("taxid").value="";
		document.getElementById("batchnumber").value="";
		document.getElementById("quantity").value="";
		document.getElementById("unitprice").value="";
		document.getElementById("amount").value="";
		document.getElementById("taxamount").value="";
		document.getElementById("totalamount").value="";
	}
	function stock_insert()
	{
		var message="";
		if(document.getElementById("locationid").value==""||document.getElementById("locationid").value==null)
			message="Please Select Location";
		if(document.getElementById("taxid").value==""||document.getElementById("taxid").value==null)
			message="Please Select Tax";
		if(document.getElementById("unitprice").value==""||document.getElementById("unitprice").value==null)
			message="Please Specify Unitprice";
		if(document.getElementById("quantity").value==""||document.getElementById("quantity").value<=0)
			message="Please Specify Quantity";
		if(document.getElementById("batchnumber").value==""||document.getElementById("batchnumber").value==null)
			message="Please Specify BatchNumber";
		if(document.getElementById("materialcode").value==""||document.getElementById("materialcode").value==null)
			message="Please Select Rawmaterial Code";
		if(document.getElementById("number").value==""|| document.getElementById("number").value<=0)
			message="Please Specify Invoice Number";
		if(document.getElementById("vendorid").value==""||document.getElementById("vendorid").value==null)
			message="Please Select Vendor";
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
					document.getElementById("tabledata").style.display = "block";
					document.getElementById("tabledata1").innerHTML += xmlhttp.responseText;
					xmlhttp.responseText;
					autoclear();
				}
			}
			if(document.getElementById("excises").selectedIndex)
			{
				xmlhttp.open("GET","includes/stock_ajax_insertion.php?randomnumber=<?php echo date("YmdHis").rand(1,100);?>&materialcode="+document.getElementById("materialcode").value+"&batchnumber="+document.getElementById("batchnumber").value +"&quantity="+document.getElementById("quantity").value+"&unitprice="+document.getElementById("unitprice").value +"&amount="+document.getElementById("amount").value +"&taxid="+document.getElementById("taxid").value+ "&taxamount="+document.getElementById("taxamount").value+"&vendorid="+document.getElementById("vendorid").value+"&number="+document.getElementById("number").value+"&date="+document.getElementById("date").value+"&locationid="+document.getElementById("locationid").value+"&excises="+document.getElementById("excises").value+"&ecisetax1="+document.getElementById("excistaxes1").value+"&ecisetax2="+document.getElementById("excistaxes2").value+"&ecisetax3="+document.getElementById("excistaxes3").value+"&couriers="+document.getElementById("couriers").value,true);
				xmlhttp.send();
			}
			else
			{
				xmlhttp.open("GET","includes/stock_ajax_insertion.php?randomnumber=<?php echo date("YmdHis").rand(1,100);?>&materialcode="+document.getElementById("materialcode").value+"&batchnumber="+document.getElementById("batchnumber").value +"&quantity="+document.getElementById("quantity").value+"&unitprice="+document.getElementById("unitprice").value +"&amount="+document.getElementById("amount").value +"&taxid="+document.getElementById("taxid").value+ "&taxamount="+document.getElementById("taxamount").value+"&vendorid="+document.getElementById("vendorid").value+"&number="+document.getElementById("number").value+"&date="+document.getElementById("date").value+"&locationid="+document.getElementById("locationid").value+"&couriers="+document.getElementById("couriers").value,true);
				xmlhttp.send();
			}
		}
	}
	var backup, edit = 0;
	function Stock_Actions(Id, Action)
	{
		if(Action == "Delete")
		{
			var x =confirm("Are you sure want yo delete?");
			if(x==true){}
			else
				return false;
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
					xmlhttp.responseText;
					alert("Stock Deleted Succesfully");
				}
			}
			xmlhttp.open("GET","includes/stock_delete.php?Action="+Action+"&id="+Id, true);
			xmlhttp.send();
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
				{
					document.getElementById(Id).innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","includes/stock_edit.php?Action="+Action+"&id="+Id+"&vendorid="+document.getElementById("vendorid").value, true);
			xmlhttp.send();
		}
		else if(Action == "Update")
		{
			var message="";
			if(document.getElementById("unitpriceE").value==""||document.getElementById("unitpriceE").value==null)
				message="Please Specify Unitprice";
			if(document.getElementById("quantityE").value==""||document.getElementById("quantityE").value==null)
				message="Please Specify Quantity";
			if(document.getElementById("batchnumberE").value==""||document.getElementById("batchnumberE").value==null)
				message="Please Specify BatchNumber";
			if(document.getElementById("materialcodeE").value==""||document.getElementById("materialcodeE").value==null)
				message="Please Select Rawmaterial Code";
			if(document.getElementById("taxidE").value==""||document.getElementById("taxidE").value==null)
				message="Please Select Tax";
			if(document.getElementById("locationid").value==""||document.getElementById("locationid").value==null)
				message="Please Select Location";
			if(message)
				alert(message);
			else
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
						alert("Stock details updated successfully");
						document.getElementById(Id).innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","includes/stock_edit.php?Action=Update&id="+Id+"&materialcode="+document.getElementById("materialcodeE").value+"&batchnumber="+document.getElementById("batchnumberE").value +"&quantity="+document.getElementById("quantityE").value+"&unitprice="+document.getElementById("unitpriceE").value +"&amount="+document.getElementById("amountE").value +"&taxid="+document.getElementById("idE").value+ "&taxamount="+document.getElementById("taxamountE").value +"&locationid="+document.getElementById("locationid").value,true);
				xmlhttp.send();
			}	
		}
		else if(Action == "Cancel")
		{
			document.getElementById(Id).innerHTML = backup;
			edit = 0;
		}
	}
	function stock_retrieval()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("tabledata1").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/stock_retrieval.php?number="+document.getElementById("number").value,true);
		xmlhttp.send();
	}
	
	function stock_quantity(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8||charCode==127||charCode==46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	function Stock_unitprice(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8||charCode==127||charCode==46)
			return true;
		if(charCode >= 48 && charCode <= 57)
			return true;
			return false;
		var countof = document.getElementById('unitprice').value;
		var dotcount = countof.split(".").length -1;
		if(dotcount>1)
		{
			alert('please remove other dots(.)');
			return false;
		}
	}
	function taxamountpercent()
	{
		var amt = document.getElementById("amountE").value;
		var tax = document.getElementById("percentE").value;
		var taxamt = amt/tax;
		var x = parseFloat(taxamt);
		var y = parseFloat(amt);
		var z =x+y;
		document.getElementById("taxamountE").value = taxamt;
		document.getElementById("totalamountE").value = z;
	}
	function additiondata()
	{	
		var quantity = document.getElementById("quantityE").value;
		var unitprice = document.getElementById("unitpriceE").value;
		if(document.getElementById("quantityE").value && document.getElementById("unitpriceE").value)
			document.getElementById("amountE").value = quantity * unitprice;
		document.getElementById("taxidE").value="";
		document.getElementById("taxamountE").value="";
		document.getElementById("totalamountE").value="";
	}
	function load_rawmaterial(rawmaterial)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("divmaterialcode").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/stock_inventory_material.php?vendorid="+rawmaterial,true);
		xmlhttp.send();
	}
	function load_rawmaterialE(rawmaterial)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("divmaterialcodeE").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/stock_inventory_materialedit.php?vendorid="+rawmaterial,true);
		xmlhttp.send();
	}
	function tabledata()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("tabledata1").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/invoice_stock_ajax.php?save="+document.getElementById("save").value,true);
		xmlhttp.send();
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
	function rawmaterialchecking()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				alert(xmlhttp.responseText);
		}
		xmlhttp.open("GET","includes/Rawmaterialchecking.php?materialcode="+document.getElementById("materialcode").value+"&batchnumber="+document.getElementById("batchnumber").value +"&number="+document.getElementById("number").value,true);
		xmlhttp.send();
	}
</script>