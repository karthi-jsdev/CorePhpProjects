<br />
<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#quotation_date").datepicker({dateFormat: 'yy-mm-dd',minDate:0});
			$("#quotation_date").datepicker().datepicker("setDate", new Date());
		});
	</script>
	<div class="columns" style='width:902px;'>
		<?php echo $message;?>
		<form class="form panel" onsubmit="return validate();">
			<fieldset>
				<div class="clearfix">
					<h3>Quotation</h3>
					<label>
						<strong>Quotation Number</strong><font color="red">*</font>
						<?php
						if(!$Quotation = mysql_fetch_array(Select_Last_Quotation_Id()))
							$Quotation['quotation_no'] = "10000001";
						?>
						<input type="text" autocomplete="off" id="quotation_no" value="<?php echo ++$Quotation['quotation_no'];?>" readonly onblur="Validate_Quotation();"/>
					</label>
					<label>
						<strong>Client Name </strong><font color="red">*</font>
						<select id="client_id" required="required" onchange="vendorno(this.value);">
							<option value="">Select</option>
							<?php
							$Client = Client_Select_All();
							while($Client_name = mysql_fetch_assoc($Client))
								echo '<option value="'.$Client_name['id'].'">'.$Client_name['client_name'].'</option>';
							?>
						</select>
					</label>
					<div id="vendorid"></div>
					<label><strong>Select Date</strong><font color="red">*</font>
						<input type="text" autocomplete="off" id="quotation_date" required="required" />
					</label>
				</div>
				<div class="clearfix">
					<label><strong>Subject</strong><font color="red">*</font>
					<textarea cols="100" rows="1" id="subject" required="required"></textarea></label>
				</div>
				<div class="clearfix">
					<a class="button button-blue" onclick="Add_Quotation();">Add Quotation</a>
				</div>
				
				<center id="Work_Table" style="display:none;">
					<table class="paginate sortable full" style="width:750px;">
						<thead>
							<tr>
								<th align="left">Code</th>
								<th align="left" style="width:280px;">Work Description</th>
								<th align="left">Work Quantity</th>
								<th align="left">Rate</th>
								<th align="left">Unit</th>
								<th align="left">Amount</th>
								<th align="left">Action</th>
							</tr>
						</thead>
						<tbody id="Work_Datas"></tbody>
					</table>
				</center>
				<div id="WandSWForms" style="display:none;">
					<div id="New" style="border:1px solid;border-radius:10px;padding-left:10px">
						<br/>
						<div id="work_form">
							<input type="hidden" id="quotation_id" />
							<div class="clearfix">
								<label><strong>Work Description</strong><font color="red">*</font></label>
								<input type="text" id="code" name="code" onblur="Description();"/>
								<textarea cols="100" rows="1" id="work_description" required="required"> </textarea>
							</div>
							<div class="clearfix">
								<label><strong>Number</strong><br />
									<input type="text" autocomplete="off" id="work_quantity" disabled placeholder="Read Only"/>
								</label>
								<label>
									<strong>Rate</strong><font color="red" >*</font><br />
									<input type="text" autocomplete="off" id="rate" required="required" onkeypress="return values(event);"/>
								</label>
								<label>
									<strong>Unit</strong><font color="red">*</font><br />
									<select id="unit_id" required="required" onchange="vendorno(this.value);">
										<option value="">Select</option>
										<?php
										$Units = Select_All_Units();
										while($Unit = mysql_fetch_assoc($Units))
											echo '<option value="'.$Unit['id'].'">'.$Unit['name'].'</option>';
										?>
									</select>
								</label>
								<label>
									<strong>Amount</strong><br />
									<input type="text" autocomplete="off" id="amount" disabled placeholder="Read Only"/>
								</label>
							</div>
							<br />
						</div>
						<center id="Work_Buttons">
							<a class="button button-blue" id="Add_Work" onclick="Add_Work();">Add Work</a>
						</center>
						
						<div id="subwork_form" style="display:none;border:1px solid;border-radius:5px;height:250px;padding-left:10px;width:800px;">
							<br />
							<input type="hidden" id="quotation_work_id" value=""/>
							<div class="clearfix">
								<label><strong>SubWork Description</strong><font color="red">*</font></label>
								<input type="text" id="subcode" name="subcode" onblur="SubDescription();"/>
								<textarea  cols="100" rows="1" id="subwork_description" required="required" /></textarea>
							</div>	
							<div class="clearfix">
								<label>
									<strong>Subwork Quantity</strong><font color="red">*</font><br />
									<input type="text" autocomplete="off" id="subwork_quantity" required="required" onkeypress="return IsNumber(event);" />
								</label>
								<label>
									<strong>Length</strong><font color="red">*</font><br />
									<input type="text" autocomplete="off" id="length" required="required" onkeypress="return Length(event);"/>
								</label>
								<label>
									<strong>Breadth</strong><font color="red">*</font><br />
									<input type="text" autocomplete="off" id="breadth" required="required" onkeypress="return Breadth(event);"/>
								</label>
								<label>
									<strong>Depth</strong><font color="red">*</font><br />
									<input type="text" autocomplete="off" id="depth" required="required" onkeypress="return Depth(event);"/>
								</label>
								<label style="width:150px;">
									<strong>Area</strong><br /><br />
									<input type="text" autocomplete="off" id="area" required="required" disabled placeholder="Read Only" onkeypress="return values(event);"/>
								</label>
							</div>
							<center id="SubWork_Buttons">
								<a class="button button-blue" onclick="Add_SubWork()">Add SubWork</a>
							</center>
							<br />
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</section>
<script>
	var QuotationParams = ["quotation_no", "client_id", "subject", "quotation_date"];
	var WorkParams = ["code","work_description", "work_quantity", "rate", "unit_id", "amount"];
	var WorkParamsRequired = ["code","work_description", "rate", "unit_id"];
	var SubWorkParams = ["subcode","subwork_description", "subwork_quantity", "length", "breadth", "depth", "area"];
	
	function IsNumber(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	$(function()
	{
		var DropDowns = ["unit_id"];
		DropDowns.forEach(function(DropDown)
		{
			$("#uniform-"+DropDown).find("span").remove();
			$("#uniform-"+DropDown).removeClass("selector");
			$("#"+DropDown).removeAttr("style");
		});
	});
	function Add_Quotation()
	{
		var message = "";
		if(!$('#subject').val())
			message = "Enter the subject";
		if(!$('#client_id').val())
			message = "Select the client name";
		if(!$('#quotation_no').val())
			message = "Enter the quotation number";
		if(message)
			alert(message);
		else
		{
			<?php $_SESSION['Quotation_Id'] = $_SESSION['Last_Work_Id'] = $_SESSION['Last_SubWork_Id'] = "";?>
			var VarsAndValues = "";
			QuotationParams.forEach(function(Param)
			{
				VarsAndValues += "&"+Param+"="+$("#"+Param).val();
			});
			document.getElementById('WandSWForms').style.display="block";
			document.getElementById('work_form').style.display="block";
			$.post("includes/Quotation_Actions.php?Action=Add_Quotation"+VarsAndValues,
			function(Response)
			{
				$("#quotation_id").val(Response);
			});
		}
	}
	function Add_Work()
	{
		var message = "";
		if(!$('#unit_id').val())
			message = "Select the unit";
		if(!$('#rate').val())
			message = "Enter the rate";
		if(!$('#work_description').val())
			message = "Enter the work description";
		if(!$('#code').val())
			message = "Enter the code";
		if(message)
			alert(message);
		else
		{
			var VarsAndValues = "";
			WorkParams.forEach(function(Param)
			{
				VarsAndValues += "&"+Param+"="+$("#"+Param).val();
				$('#'+Param).attr('disabled', true);
			});
			document.getElementById('Add_Work').style.display = "none";
			document.getElementById('Work_Table').style.display = "block";
			document.getElementById('work_form').style.display = "none";
			document.getElementById('subwork_form').style.display = "block";
			$.post("includes/Quotation_Actions.php?Action=Add_Work&quotation_id="+$("#quotation_id").val()+VarsAndValues,
			function(Response)
			{
				SubWork_Clear_Inputs();
				var SplittedResponse = Response.split("@");
				$("#quotation_work_id").val(SplittedResponse[0]);
				document.getElementById("Work_Datas").innerHTML += SplittedResponse[1]+'<thead><tr><td> &nbsp;&nbsp;<b>SubWorkCode</b></td> <td><b>SubWork Description</b></td><td><b>Number</b></td><td><b>Length</b></td><td><b>Breadth</b></td><td><b>Depth</b></td><td><b>Area</b></td><td><b>Action</b></td></tr></thead>';
			});
		}
	}
	function vendorno(vendorno)
	{
		$.post("includes/Quotation_vendorno.php?client_id="+vendorno, function(Response)
		{
			document.getElementById("vendorid").innerHTML = Response;
		});
	}
	function SubWork_Clear_Inputs()
	{
		SubWorkParams.forEach(function(Param)
		{
			$("#"+Param).val("");
		});
	}
	function Add_SubWork()
	{
		var message="";
		if(!$('#depth').val())
			message = "Enter the depth";
		if(!$('#breadth').val())
			message = "Enter the breadth";
		if(!$('#length').val())
			message = "Enter the length";
		if(!$('#subwork_quantity').val())
			message = "Enter the Subwork quantity";
		if(!$('#subwork_description').val())
			message = "Enter the Subwork description";
		if(!$('#subcode').val())
			message = "Enter the Subwork code";	
		if(message)
			alert(message);
		else
		{
			$("#area").val( $("#subwork_quantity").val() * $("#length").val() * $("#breadth").val() * $("#depth").val() );
			document.getElementById('subwork_form').style.display = "block";	
			var VarsAndValues = "";
			SubWorkParams.forEach(function(Param)
			{
				VarsAndValues += "&"+Param+"="+$("#"+Param).val();
			});
			
			document.getElementById("SubWork_Buttons").innerHTML = '<a class="button button-blue" onclick="Add_SubWork()">Add SubWork</a> &nbsp;<a class="button button-blue" onclick="Finish_SubWork()">Finish SubWork</a>';
			$.post("includes/Quotation_Actions.php?Action=Add_SubWork&quotation_work_id="+$("#quotation_work_id").val()+VarsAndValues, function(Response)
			{
				var SplittedResponse = Response.split("@");
				alert(SplittedResponse[0]);
				document.getElementById("Work_Datas").innerHTML += SplittedResponse[1];
				document.getElementById($("#quotation_work_id").val()).innerHTML = SplittedResponse[2];
				SubWork_Clear_Inputs();
			});
		}
	}
	var backup, edit = 0;
	function Actions(Id, Action)
	{
		if(Action == "Delete")
		{
			if(confirm("Do you really want to delete this record!"))
			{
				$.post("includes/Quotation_Actions.php?Action="+Action+"&id="+Id, function(Response)
				{
					var SplittedResponse = Response.split("@");
					if(isNaN(Id))
					{
						document.getElementById(Id).innerHTML = "";
						document.getElementById(SplittedResponse[1]).innerHTML = SplittedResponse[2];
					}
					else
					{
						if(SplittedResponse[0] == "Work deleted successfully")
						{
							document.getElementById(Id).innerHTML = "";
						}
					}
					alert(SplittedResponse[0]);
				});
			}
		}
		else if(Action == "Edit" && !edit)
		{
			edit = 1;
			backup = document.getElementById(Id).innerHTML;
			document.getElementById(Id).innerHTML = "";
			$.post("includes/Quotation_Actions.php?Action="+Action+"&id="+Id, function(Response)
			{
				document.getElementById(Id).innerHTML = Response;
			});
		}
		else if(Action == "Update")
		{
			edit = 0;
			var VarsAndValues = "";
			if(isNaN(Id))
			{
				$("#areaE").val( $("#subwork_quantityE").val() * $("#lengthE").val() * $("#breadthE").val() * $("#depthE").val() );
				SubWorkParams.forEach(function(Param)
				{
					VarsAndValues += "&"+Param+"E="+$("#"+Param+"E").val();
				});
			}
			else
			{
				WorkParams.forEach(function(Param)
				{
					VarsAndValues += "&"+Param+"E="+$("#"+Param+"E").val();
				});
			}
			$.post("includes/Quotation_Actions.php?Action="+Action+"&id="+Id+VarsAndValues, function(Response)
			{
				var SplittedResponse = Response.split("@");
				alert(SplittedResponse[0]);
				if(SplittedResponse[0] == "Work updated successfully")
				{
					document.getElementById(Id).innerHTML = SplittedResponse[1];
					if(isNaN(Id))
						document.getElementById(SplittedResponse[2]).innerHTML = SplittedResponse[3];
				}
			});
		}
		else if(Action == "Cancel")
		{
			document.getElementById(Id).innerHTML = backup;
			edit = 0;
		}
	}
	function Finish_SubWork()
	{
		SubWorkParams.forEach(function(Param)
		{
			$("#"+Param).val("");
		});
		document.getElementById('subwork_form').style.display="none";
		
		WorkParams.forEach(function(Param)
		{
			$("#"+Param).val("");
		});
		WorkParamsRequired.forEach(function(Param)
		{
			$('#'+Param).attr('disabled', false);
		});
		document.getElementById('work_form').style.display = "block";
		document.getElementById('Add_Work').style.display = "block";
		document.getElementById("Work_Buttons").innerHTML = '<a class="button button-blue" id="Add_Work" onclick="Add_Work()">Add Work</a> &nbsp;<a class="button button-blue" href="#" onclick="Finish_Work()">Finish Work</a>';
	}
	function Validate_Quotation()
	{
		$.post("includes/Quotation_vendorno.php?quotation_nos="+$("#quotation_no").val(), function(Response)
		{
			if(Response != false)
			{
				document.getElementById("quotation_no").innerHTML = Response;
				alert(Response);
			}
		});
	}
	function Finish_Work()
	{
		if($("#quotation_id").val())
			window.location.href = "index.php?page=Quotation&subpage=Quotation Retrieval&quotation_id="+$("#quotation_id").val();
	}
	function values(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("rate").value.indexOf('.') >= 0 && charCode == 46)
			return false;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function Length(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("length").value.indexOf('.') >= 0 && charCode == 46)
			return false;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function Breadth(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("breadth").value.indexOf('.') >= 0 && charCode == 46)
			return false;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function Depth(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("depth").value.indexOf('.') >= 0 && charCode == 46)
			return false;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function Description()
	{
		$.post("includes/Quotation_Work_Description.php?code="+$("#code").val(),function(Response)
		{
			$('#work_description').val(Response);
		});	
	}
	function SubDescription()
	{
		$.post("includes/Quotation_Work_Description.php?subcode="+$("#subcode").val(),function(Response)
		{
			$("#subwork_description").val(Response);
		});	
	}
</script>