<section class="first">
	<?php
	$database_columns=array("id","drawing_number","description","material_type","material_size","grade","numberofpieces","outputperhour","image");
	if($_GET['action']=='Edit')
	{
		$product = mysqli_fetch_assoc(Product_Select_ById());
		foreach($database_columns as $prod)
			$_POST[$prod] = $product[$prod];
		$query = Product_Select_ById();
		while($row = mysqli_fetch_assoc($query))
			$file = $row['image'];
	}
	
	if(isset($_POST['Update'])||(isset($_POST['submit'])))
	{
		$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if(!$extension || in_array($extension, $allowedExts))
		{
			if ((($_FILES["file"]["type"] == "image/tiff")||($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/jpeg")||($_FILES["file"]["type"] == "image/jpg")||($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")|| ($_FILES["file"]["type"] == "image/png"))&& ($_FILES["file"]["size"] < 200000000)&& in_array($extension, $allowedExts))
			{
				if ($_FILES["file"]["error"] > 0)
					echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
				else
				{
					move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
					$file="upload/".$_FILES["file"]["name"];
					$_POST['file'] = $file;
				}
			}
			if(isset($_POST['submit']))
			{
				if(mysqli_num_rows(Product_Select_ByNo())>0)
					$message = "<br /><div class='message error'><b>Message</b> : This Product already exists</div>";
				//else if (!in_array($extension, $allowedExts))
					//$message = "<br /><div class='message error'><b>Message</b> : Invalid Image Type</div>";
				else
				{
					Product_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Product added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				Product_Update_ById();
				$message = "<br /><div class='message success'><b>Message</b> : Product updated successfully</div>";
			}
		}
		else
			$message = "<br /><div class='message error'><b>Message</b> : Invalid Image Type</div>";
		foreach($database_columns as $prod)
			$_POST[$prod] = "";
	}
	else if($_GET['action']=='Delete')
	{
		Product_Delete_ById();
		$message = "<br /><div class='message success'><b>Message</b> : Product deleted successfully</div>";
	} ?>
	
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" enctype="multipart/form-data" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<h3>Product Master</h3><hr/>
				<fieldset>
					<div class="clearfix">
						<label>Drawing No./Part No. <font color="red">*</font></label>
						<input type="text" id="drawing_number" maxlength="20" name="drawing_number" required="required" value="<?php echo $_POST['drawing_number']; ?>" onkeypress="return DrawingNoValidation(event)"/>
					</div>
					<div class="clearfix">
						<label>Product Description <font color="red">*</font></label>
						<input type="text" id="description" name="description" required="required" value="<?php echo $_POST['description']; ?>" onkeypress="return Number_description(event)"/>
					</div>
					<div class="clearfix">
						<label>Raw Material Type <font color="red">*</font></label>
						<input type="text" id="material_type" name="material_type" required="required" value="<?php echo $_POST['material_type']; ?>" onkeypress="return NumberCount(event)"/>
					</div> 
					<div class="clearfix">
						<label>Raw Material Size <font color="red">*</font></label>
						<input type="text" id="material_size" name="material_size" required="required" value="<?php echo $_POST['material_size']; ?>" onkeypress="return mater_Size(event)"/>&nbsp;<strong>mm</strong>
					</div>
					<div class="clearfix">
						<label>Raw Grade and Alloy<font color="red">*</font></label>
						<input type="text" id="grade" name="grade" required="required" value="<?php echo $_POST['grade']; ?>" onkeypress="return Grade_alloy(event)"/>
					</div>
					<div class="clearfix">
						<label>Raw Material For 100000 Pieces <font color="red">*</font></label>
						<input type="text" id="numberofpieces" name="numberofpieces" required="required" value="<?php echo $_POST['numberofpieces']; ?>" onkeypress="return pieces_output(event)"/>&nbsp;<strong>Kg</strong>
					</div>
					<div class="clearfix">
						<label>Production Output Per hour<font color="red">*</font></label>
						<input type="text" id="outputperhour" name="outputperhour" required="required" value="<?php echo $_POST['outputperhour']; ?>" onkeypress="return Number_description_output(event)"/>
					</div>
					<div class="clearfix">
						<?php
						if($_GET['action']=='Edit')
						{ ?>
							<label for="file">Image Filename:</label>
							<input type="file" name="file" id="file" value="<?php echo $file;?>"><br/>
							<img style="float:left;margin-left:-230px;margin-top:10px;" src="<?php echo $file;?>" width="50px" height="50px" alt="imagenotfound">
						<?php 
						}
						else
						{ ?>
							<label for="file">Image Filename:</label>
							<input type="file" name="file" id="file" value="<?php echo $_POST['image']?>"><br/>
						<?php
						} ?>
					</div>
				</fieldset><hr/>
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-blue" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-blue" type="submit" name="submit" value="Submit">Submit</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Reset</button>
			</form>
		</div>
	</div>
</section>
<div class="columns leading">
	<div class="first">
		<input type="text" placeholder="Search" id="Search" name="search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/>&nbsp;	
		<div id="searchblink"><font color="red">Enter the Drawing No./Part No. To Search</font></div>
		<h3>
			<?php
			$Total_Products = Product_Select();
			echo 'Total No. of Products - '.mysqli_num_rows($Total_Products);
			?>
		</h3><hr/>
		<table border="1px solid black" class="paginate sortable full"> 
			<thead>
				<tr>
					<th>Sl. No.</th>
					<th>Drawing No./Part No.</th>
					<th>Product Description</th>
					<th>Raw Material Type</th>
					<th>Raw Material Size</th>
					<th>Raw Grade and Alloy</th>
					<th>Raw Material For 100000 Pieces</th>
					<th>Production Output Per hour</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>	
				<?php
				if(!$_GET['Search'])
				{
					$i=1;
					$total = mysqli_fetch_assoc(Product_Select_Count()); 
					$Limit = 10;
					$total_pages = ceil($total['total']/$Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1; 
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $total['total']- $Start;
					else
						$i = $total['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Total_Product = Product_Select_ByLimit($Start, $Limit);
					if(mysqli_num_rows($Total_Products)==0)
						echo '<tr><td colspan="10" style="color:red;"><center>No Data found</center></td></tr>';
					else
					{
						while($products = mysqli_fetch_assoc($Total_Product))
						{
							echo'<tr> 
									<td>'.$i--.'</td>
									<td>'.$products['drawing_number'].'</td>
									<td>'.$products['description'].'</td>
									<td>'.$products['material_type'].'</td>
									<td>'.$products['material_size'].'</td>
									<td>'.$products['grade'].'</td>
									<td>'.$products['numberofpieces'].'</td>
									<td>'.$products['outputperhour'].'</td>
									<td><a href=?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&pageno='.$_GET['pageno'].'&id='.$products['id'].'&action=Edit>Edit</a>|<a href="#" onclick="deleterow('.$products['id'].')">Delete</a></td>
							</tr>';
						}
					} 
				}
				else
				{
					$i=1;
					$total = mysqli_fetch_assoc(Product_Select_Count_Search($_GET['Search'])); 
					echo "<h4>Total Number Of Searched Products-".$total['total']."</h4>";
					$Limit = 10;
					$total_pages = ceil($total['total']/$Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1; 
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $total['total']- $Start;
					else
						$i = $total['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Total_Product = Product_Select_ByLimit_Search($Start, $Limit,$_GET['Search']);
					if(mysqli_num_rows($Total_Products)==0)
						echo '<tr><td colspan="10" style="color:red;"><center>No Data found</center></td></tr>';
					else
					{
						while($products = mysqli_fetch_assoc($Total_Product))
						{
							echo'<tr> 
									<td>'.$i--.'</td>
									<td>'.$products['drawing_number'].'</td>
									<td>'.$products['description'].'</td>
									<td>'.$products['material_type'].'</td>
									<td>'.$products['material_size'].'</td>
									<td>'.$products['grade'].'</td>
									<td>'.$products['numberofpieces'].'</td>
									<td>'.$products['outputperhour'].'</td>
									<td><a href=?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&pageno='.$_GET['pageno'].'&id='.$products['id'].'&action=Edit>Edit</a>|<a href="#" onclick="deleterow('.$products['id'].')">Delete</a></td>
							</tr>';
						}
					}
				} ?>
			</tbody>
		</table>
	</div>
</div>
<div class="clear">&nbsp;</div>
<?php
	if($_GET['Search'])
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&Search=".$_GET['Search']."&";
		else
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
?>
<script>
	Blink();
	function Blink()
	{
		obj=document.getElementById("searchblink");
		if (obj.style.visibility=="hidden")
			obj.style.visibility="visible";
		else obj.style.visibility="hidden";
		window.setTimeout("Blink();",500);
	}
	function DrawingNoValidation(evt) 
	{
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if(charCode != 34 && charCode != 36 && charCode != 38 && charCode != 39)
			return true;
		return false;
    }
	function Number_description(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46 || charCode==127)
			return true;
		if((charCode>=65 && charCode<=90 || charCode>=97 && charCode<=122) || charCode==32)
		{
			if(document.getElementById("description").value.length < 25)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	function NumberCount(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46 || charCode==127)
			return true;
		if((charCode>=65 && charCode<=90 || charCode>=97 && charCode<=122) || charCode==32)
		{
			if(document.getElementById("material_type").value.length < 25)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	function mater_Size(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46 || charCode==127 || charCode==109 || charCode==157 || charCode==232)
			return true;
		if(charCode>=48 && charCode<=57)
		{
			if(document.getElementById("material_size").value.length < 10)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	function Grade_alloy(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46 || charCode==127)
			return true;
		if((charCode>=48 && charCode<=57)||(charCode>=65 && charCode<=90 || charCode>=97 && charCode<=122)||charCode==46)
		{
			if(document.getElementById("grade").value.length < 10)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	function Number_description_output(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46 || charCode==127)
			return true;
		if(charCode>=48 && charCode<=57)
		{
			if(document.getElementById("outputperhour").value.length < 10)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	function pieces_output(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 46 || charCode==127)
			return true;
		if((charCode>=48 && charCode<=57)||charCode==46)
		{
			if(document.getElementById("numberofpieces").value.length < 10)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	function Search()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
</script>