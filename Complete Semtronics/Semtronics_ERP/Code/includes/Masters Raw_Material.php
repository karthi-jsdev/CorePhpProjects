<section role="main" id="main">
	<?php
		$Columns = array("id", "materialcode", "categorynumber", "categoryid", "partnumber", "description","tax","minquantity","bom_category");
		if($_GET['action'] == 'Edit')
		{
			$Rawmaterial = mysqli_fetch_assoc(Rawmaterial_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Rawmaterial[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Rawmaterial_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Rawmaterial deleted successfully</div>";
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$RawmaterialResource = Rawmaterial_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				//if(mysqli_num_rows($RawmaterialResource))
					//$message = "<br /><div class='message error'><b>Message</b> : Rawmaterial already exists</div>";
				//else
				//{
					/*$ExplodeProductCode = explode("/",$_POST['categoryid']);
					$prefixe = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from category where id='".$ExplodeProductCode[0]."'"));
					$categoryid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from rawmaterial where id='".$ExplodeProductCode[0]."'"));
					echo "select * from rawmaterial where id='".$ExplodeProductCode[0]."'";
					echo $categoryid['categoryid'];
					if($categoryid['categoryid']>0)
					{
						echo strlen($prefixe['prefix']);echo $prefixe['prefix'];
					}	
					else
					{
						$Code = $prefixe['prefix'].'001';
					}Rawmaterial_Insert($Code);
					*/
					$ExplodeProductCode = explode("/",$_POST['categoryid']);
					$prefixe = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from category where id='".$ExplodeProductCode[0]."'"));
					$FetchCode = mysqli_fetch_assoc(Select_RawMaterialCode($ExplodeProductCode[1]));
					$Digits = array("", "0", "00", "000");
					if(mysqli_num_rows(Select_RawMaterialCode($ExplodeProductCode[1])))
					{
						$Inc = ((int)str_replace($ExplodeProductCode[1], "", $FetchCode['materialcode'])+1);
						//$Code = $ExplodeProductCode[1].$Digits[3 - strlen(substr($FetchCode['materialcode'],5,7))+1].((substr($FetchCode['materialcode'],5,7))+1);
						 $Code = $ExplodeProductCode[1].$Digits[3 - strlen($Inc)].$Inc;
					}
					else
						$Code = $prefixe['prefix'].'001';//$Code = $ExplodeProductCode[1].$Digits[3 - strlen(substr($FetchCode['materialcode'],5,7))].(substr($FetchCode['materialcode'],5,7));
					Rawmaterial_Insert($Code);
					$message = "<br /><div class='message success'><b>Message</b> : Rawmaterial added successfully</div>";
				//}
			}
			else if(isset($_POST['Update']))
			{
				$Rawmaterial = mysqli_fetch_assoc($UserResource);
				if(mysqli_num_rows(Rawmaterial_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Rawmaterial already exists</div>";
				else
				{
					Rawmaterial_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Rawmaterial details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add Raw Material</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Raw Material <font color="red">*</font></label>
					<?php echo $_POST['materialcode']; ?>
				</div>
				<div class="clearfix">
					<label>Category Number <font color="red">*</font></label>
					<input type="text" id="categorynumber" autocomplete="off" name="categorynumber" maxlength="15" required="required" value="<?php echo $_POST['categorynumber']; ?>" onkeypress="return isAlphabetNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Category Name <font color="red">*</font></label>
					<select  id="categoryid"  name="categoryid">
						<option value=''>Select</option>
						<?php
							$RawmaterialSection = Rawmaterial_Section();
							while($MaterialSection = mysqli_fetch_array($RawmaterialSection))
							{
								if($MaterialSection['id'] == $_POST['categoryid'])
									echo '<option value="'.$MaterialSection['id'].'/'.$MaterialSection['prefix'].'" selected>'.$MaterialSection['name'].'</option>';
								else
									echo '<option value="'.$MaterialSection['id'].'/'.$MaterialSection['prefix'].'">'.$MaterialSection['name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Part Number <font color="red">*</font></label>
					<input type="text" id="partnumber" autocomplete="off" name="partnumber" maxlength="20" required="required" value="<?php echo $_POST['partnumber']; ?>" onkeypress="return Is_Reserved(event)" />
				</div>
				<div class="clearfix">
					<label>Description<font color="red">*</font></label>
					<textarea id="description" name="description" maxlength="50" required="required" onkeypress="return Is_Reserved(event)"><?php echo $_POST['description']; ?></textarea>
				</div>
				<div class="clearfix">
					<label>Tax </label>
					<?php
						$SelectTax = Select_Tax();
						while($FetchTax = mysqli_fetch_array($SelectTax))
						{
							if($_POST['tax']==$FetchTax['id'])
								echo "<span class='radio-input'><input type='radio' value='".$FetchTax['id']."' id='tax' onclick='Taxdesc(this.value)' name='tax' checked />".$FetchTax['percent']."</input></span>";
							else
								echo "<span class='radio-input'><input type='radio' value='".$FetchTax['id']."' id='tax' onclick='Taxdesc(this.value)' name='tax'>".$FetchTax['percent']."</input></span>";
						}
					?>	
				</div>	
				<div class="clearfix">
					<label>Minimum Order Quantity <font color="red">*</font></label>
					<input type="text" id="minquantity" autocomplete="off" name="minquantity" required="required" onkeypress="return isNumeric(event)" value="<?php echo $_POST['minquantity']; ?>"/>
				</div>
				<div class="clearfix">
					<label>Bom Category </label>
					<select  id="bom_category"  name="bom_category">
					<option value=''>Select</option>
						<?php
							$bom_category = SelectBomCategory();
							while($bomcategory = mysqli_fetch_array($bom_category))
							{
								if($_POST['bom_category'] == $bomcategory['id'])
									echo '<option value="'.$bomcategory['id'].'" selected>'.$bomcategory['bom_category'].'</option>';
								else
									echo '<option value="'.$bomcategory['id'].'">'.$bomcategory['bom_category'].'</option>';
							} 
						?>
					</select>
				</div>	
				<div id="taxdesc" style="margin-top:-250px;margin-left:600px;"></div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset" id="reset">Reset</button>
		</form>
	</div>
	<div class="columns">
		<h3>
			<?php
			if($_GET['Search'])
				$RawmaterialTotalRows = mysqli_fetch_assoc(Rawmaterial_Select_Count_AllSearch($_GET['Search']));
			else
				$RawmaterialTotalRows = mysqli_fetch_assoc(Rawmaterial_Select_Count_All());
			echo "Total No. of Rawmaterials -".$RawmaterialTotalRows['total'];
			?>
		</h3>
		<hr />		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" placeholder="Search" autocomplete="off" id="Search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="Search()" class="button button-orange" >Search</a><br/>&nbsp;
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Raw Material</th>
					<th align="left">Category Number</th>
					<th align="left">Category Name</th>
					<th align="left">Part No.</th>
					<th align="left">Description</th>
					<th align="left">Tax</th>
					<th align="left">Minimum Order Quantity</th>
					<th align="left">BOM_Category</th>
					<th align="left">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$_GET['Search'])
				{
					if(!$RawmaterialTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($RawmaterialTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$RawmaterialRows = Rawmaterial_Select_ByLimit($Start, $Limit);
					while($Rawmaterial = mysqli_fetch_assoc($RawmaterialRows))
					{
						$Category_Name = mysqli_fetch_assoc(Categoryname($Rawmaterial['categoryid']));
						$FetchTax = mysqli_fetch_array(Tax_SelectById($Rawmaterial['tax']));
						if(!$FetchTax['percent'])
							$FetchTax['percent'] = "-";
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Rawmaterial['materialcode']."</td>
							<td>".$Rawmaterial['categorynumber']."</td>
							<td>".$Category_Name['name']."</td>
							<td>".$Rawmaterial['partnumber']."</td>
							<td>".$Rawmaterial['description']."</td>
							<td>".$FetchTax['percent']."</td>
							<td align=center>".$Rawmaterial['minquantity']."</td>
							<td>".$Rawmaterial['bom_category']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Rawmaterial['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Rawmaterial['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					}
				}
				else	
				{
					if(!$RawmaterialTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($RawmaterialTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$RawmaterialRows = Rawmaterial_Select_ByLimitSearch($Start, $Limit,$_GET['Search']);
					while($Rawmaterial = mysqli_fetch_assoc($RawmaterialRows))
					{
						$Category_Name = mysqli_fetch_assoc(Categoryname($Rawmaterial['categoryid']));
						$FetchTax = mysqli_fetch_array(Tax_SelectById($Rawmaterial['tax']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Rawmaterial['materialcode']."</td>
							<td>".$Rawmaterial['categorynumber']."</td>
							<td>".$Category_Name['name']."</td>
							<td>".$Rawmaterial['partnumber']."</td>
							<td>".$Rawmaterial['description']."</td>
							<td>".$FetchTax['percent']."</td>
							<td>".$Rawmaterial['minquantity']."</td>
							<td>".$Rawmaterial['bom_category']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Rawmaterial['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Rawmaterial['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					}
				}?>
			</tbody>
		</table>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
		if($_GET['Search'])
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&Search=".$_GET['Search']."&";
		else
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
		if($total_pages > 1)
			include("includes/Pagination.php");
	?>
</section>
<script>
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
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode==37 || charCode==39 || charCode==46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function isAlphabetNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode >= 33 && charCode >= 64)
			return true;
		else if(charCode == 32 ||charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	function partnumber(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 32 || charCode==37 || charCode==39 || charCode==46 || charCode==9)
			return true;
		else if(charCode == 32 ||charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode >= 48 && charCode <= 57)
			return true;
		else
			return false;
	}
	function Is_Reserved(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 36)
			return false;
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("description").value.length < 5)
			message = "Description should be 5 characters";
		if(document.getElementById("description").value.length < 5)
			message = "Description should be 5 characters";
		if(document.getElementById("minquantity").value==0)
			message = "Please Enter the Minimum Order Quantity";
		if(document.getElementById("partnumber").value==0)
			message = "Please Enter the Part Number";
		if(document.getElementById("categoryid").value=="")
			message = "Please Select Category Name";
		if(document.getElementById("categorynumber").value==0)
			message = "Please Enter Category Number";
		if(document.getElementById("materialcode").value==0)
			message = "Please Enter the Material Code";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}	
	function Search()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
	function Taxdesc(Tax)
	{
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
				document.getElementById('taxdesc').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetTaxDescription.php?Tax="+Tax,true);
		xmlhttp.send();
	}
</script>