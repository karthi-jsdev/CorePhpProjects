<form method="post" action="" id="form" class="form panel">
	<fieldset>
			<label>Client Category <font color="red">*</font>
				<select id="vendor_category_id" name="vendor_category_id">
					<option value="">All</option>
					<?php
					$SelectClientcategory = SelectClientcategorycode();
					while($FetchClientcategory = mysqli_fetch_array($SelectClientcategory))
					{
						if($FetchClientcategory['id']== $_POST['client_category_id'])
							echo "<option value='".$FetchClientcategory['id']."'selected>".$FetchClientcategory['clientcategory']."</option>";
						else
							echo "<option value='".$FetchClientcategory['id']."'>".$FetchClientcategory['clientcategory']."</option>";
					} ?>
				</select>
			</label>	
			<label>Referred By <font color="red">*</font>
				<select id="reference_id" name="reference_id">
					<option value="">All</option>
					<?php
						$Selectreferredby = Selectreferredbycode();
						while($Fetchreferredby = mysqli_fetch_array($Selectreferredby))
						{
							if($Fetchreferredby['id']==$_POST['reference_id'])
								echo "<option value='".$Fetchreferredby['id']."'selected>".$Fetchreferredby['reference']."</option>";
							else
								echo "<option value='".$Fetchreferredby['id']."'>".$Fetchreferredby['reference']."</option>";
						}
					?>
				</select>
			</label>	
			<label>Reference<font color="red">*</font>
				<select id="reference_group_id" name="reference_group_id">
					<option value="">All</option>
					<?php
						$Selectreferredgroupby = Selectreferencegroup();
						while($Fetchreferredgroupby = mysqli_fetch_array($Selectreferredgroupby))
						{
							if($Fetchreferredgroupby['id']==$_POST['reference_group_id'])
								echo "<option value='".$Fetchreferredgroupby['id']."'selected>".$Fetchreferredgroupby['name']."</option>";
							else
								echo "<option value='".$Fetchreferredgroupby['id']."'>".$Fetchreferredgroupby['name']."</option>";
						}
					?>
				</select>
			</label>
			<label>Industry<font color="red">*</font>
				<select id="industry_category_id" name="industry_category_id">
					<option value="">All</option>
					<?php
						$Selectindustryby = Selectindustrycode();
						while($Fetchindustryby = mysqli_fetch_array($Selectindustryby))
						{
							if($Fetchindustryby['id']==$_POST['industry_category_id'])
								echo "<option value='".$Fetchindustryby['id']."'selected>".$Fetchindustryby['name']."</option>";
							else
								echo "<option value='".$Fetchindustryby['id']."'>".$Fetchindustryby['name']."</option>";
						}
					?>
				</select>
			</label>
					
					<br/>
			<label><input type="checkbox" name="account" id ="account">Account<br></label>
		<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>	
	</fieldset>
</form>
<div id="main">
	<?php
	if(!$_GET['vendor_category_id'] && !$_GET['reference_id'] && !$_GET['reference_group_id'] && !$_GET['industry_category_id'])
	{

		$LeadTotalRows = mysqli_fetch_assoc(Lead_Select_Count_All());
			echo "<h4>Total No. of Leads - ".$LeadTotalRows['total']."</h4>";
			echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Data("getdata=Lead_Report")\'><img src="images/icons/download.png"></a></div>';
	?>
		<div style="width: 1000px; overflow-x: auto;" >
			<table class="paginate sortable full" style="width: 2100px;">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Lead No</th>
						<th align="left">Name</th>
						<th align="left">Address</th>
						<th align="left">Email Id</th>
						<th align="left">Phone No.</th>
						<th align="left">Contact Person Name</th>
						<th align="left">Designation</th>
						<th align="left">Email</th>
						<th align="left">Contact Phone</th>
						<th align="left">Contact Person Name</th>
						<th align="left">Designation</th>
						<th align="left">Email</th>
						<th align="left">Contact Phone</th>
						<th align="left">Client Category</th>
						<th align="left">Referred By</th>
						<th align="left">Reference Group</th>
						<th align="left">Industry</th>
						<th align="left">Add To Account</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(!$LeadTotalRows['total'])
							echo '<tr><td colspan="20"><font color="red"><center>No data found</center></font></td></tr>';
						$i = 1;
						$LeadRows = Lead_Select_ByNoLimit();
						while($Lead = mysqli_fetch_assoc($LeadRows))
						{
							$Clientcategory = mysqli_fetch_array(Client_Category_Name($Lead['client_category_id']));
							$Reference = mysqli_fetch_array(Reference_Name($Lead['reference_id']));
							$ReferenceGroup = mysqli_fetch_array(Reference_GroupName($Lead['reference_group_id']));
							$Industrycategory = mysqli_fetch_array(Industrycategory_Name($Lead['industry_category_id']));
							$Digits = array("","0", "00", "000", "0000", "00000", "000000");
							$LDNo = "LD".$Digits[6 - strlen($Lead['id'])].($Lead['id']);
							echo "<tr style='valign:middle;'>
								<td align='center'>".$i++."</td>
								<td>".$LDNo."</td>
								<td>".$Lead['name']."</td>
								<td>".$Lead['address']."</td>
								<td>".$Lead['email_id']."</td>
								<td>".$Lead['contact_no']."</td>
								<td>".$Lead['contact_person1']."</td>
								<td>".$Lead['designation1']."</td>
								<td>".$Lead['email_id1']."</td>
								<td>".$Lead['contact_no1']."</td>
								<td>".$Lead['contact_person2']."</td>
								<td>".$Lead['designation2']."</td>
								<td>".$Lead['email_id2']."</td>
								<td>".$Lead['contact_no2']."</td>
								<td>".$Clientcategory['clientcategory']."</td>
								<td>".$Reference['reference']."</td>
								<td>".$ReferenceGroup['name']."</td>
								<td>".$Industrycategory['name']."</td>";
								if($Lead['add_to_account'] == '1')
									echo "<td>YES</td>";
								else	
									echo "<td>NO</td>
							</tr>";
						} ?>
				</tbody>		
			</table>		
		</div>			
	<?php
	} ?>
</div>
<script>
	function Display_Table()
	{
		var account = document.getElementsByName("account");
		var flag = 0;
			for (var i = 0; i< account.length; i++)
				if(account[i].checked)
					flag++;
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("main").innerHTML = xmlhttp.responseText;
			}
				
		}
		xmlhttp.open("GET","includes/Lead_Display_Table.php?vendor_category_id="+document.getElementById("vendor_category_id").value+"&reference_id="+document.getElementById("reference_id").value+"&reference_group_id="+document.getElementById("reference_group_id").value+"&industry_category_id="+document.getElementById("industry_category_id").value+"&account="+flag, true);
		xmlhttp.send();
	}	
	function Export_Data(PostBackValues)
	{
		window.open("includes/ExportLeadData.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Export_LeadData(PostBackValues)
	{
		var account = document.getElementsByName("account");
		var flag = 0;
			for (var i = 0; i< account.length; i++)
				if(account[i].checked)
					flag++;
		window.open("includes/ExportParticularLeadData.php?export=1&"+PostBackValues+"&vendor_category_id="+document.getElementById("vendor_category_id").value+"&reference_id="+document.getElementById("reference_id").value+"&reference_group_id="+document.getElementById("reference_group_id").value+"&industry_category_id="+document.getElementById("industry_category_id").value+"&account="+flag, true);
	}
</script>