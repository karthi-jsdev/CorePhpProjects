<html>
	<head>
		<style>
			.tablewidth 
			{ 	 
				width:35em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			} 
		</style>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script>
			function validate()
			{	
				var vendor = document.getElementById('vendorname').value; 
				if(vendor==null || vendor=='')
				{
					alert('Name Required');
					return false;
				}
				var Phonenumber = document.getElementById('phonenumber').value;
				if(Phonenumber==null || Phonenumber=='')
				{
					alert('Phonenumber Required');
					return false;
				}
				var mobile = document.getElementById("phonenumber").value;
				var pattern = /^\d{10}$/;
				if (!(pattern.test(mobile))) 
				{
					alert("It is not valid mobile number.input 10 digits number!");
					return false; 
				}  	
				var email = document.getElementById('email').value;
				if(email==null || email=='')
				{
					alert('Email Required');
					return false;
				}
				if(document.getElementById('category').selectedIndex == 0 ) 
				{
					alert ( "Please select category");
					return false;
				} 	
				
			 				
			} 
			function validateForm()
			{
				var x=document.forms["myForm"]["email"].value;
				var atpos=x.indexOf("@");
				var dotpos=x.lastIndexOf(".");
				if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
				{
					alert("Not a valid e-mail address");
					return false;
				}
				if(myForm.Address.value == "") 
				{
					alert("Please Enter Address!");
					myForm.Address.focus();
					return false;
				}
				if(myForm.Description.value == "") 
				{
					alert("Please Enter Details!");
					myForm.Description.focus();
					return false;
				}
			}	
		</script>
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js">
		</script>
		
	</head>
    <body>
		<div style="float:left;margin-top:25px;margin-left:800px;width:500px">
			<button onclick="window.location.href='?page=item'">AddItem</button>
			<button onclick="window.location.href='?page=itemsummary'">ItemSummary</button>
			<button onclick="window.location.href='?page=vendor'">Vendor</button>
			
		</div>
			<form action="" name="myForm" onsubmit="return validateForm(this);" method="POST">
				<?php 
				include"config.php"; 
				if($_POST['submit'])
				{
				 $sql_select = mysql_query("SELECT PTVID FROM vendor ORDER BY id DESC");
				if(mysql_num_rows($sql_select))
				{ 
					$data = mysql_fetch_array($sql_select);
					$ptvid = substr($data['PTVID'],6,4)+1;
					if(strlen($ptvid) == 1)
						$ptvid ="PTVID-000".$ptvid;
					if(strlen($ptvid) == 2)
						$ptvid ="PTVID-00".$ptvid;
					if(strlen($ptvid) == 3)
						$ptvid ="PTVID-0".$ptvid; 
				}
				else 
				{
					$ptvid = "PTVID-0001";
				} 
				mysql_query("INSERT INTO vendor (PTVID,Vendorname,Phonenumber,Email,Category,Address,Description) VALUES ('".$ptvid."','".$_POST['Vendor_name']."','".$_POST['Phonenumber']."','".$_POST['email']."','".$_POST['category']."','".$_POST['Address']."','".$_POST['Description']."')") or die('could not insert'.mysql_error());
				header("Location: ?page=vendor");
				}
				else if($_POST['update'])
				{	
					mysql_query("UPDATE vendor SET Vendorname='".$_POST['Vendor_name']."',Phonenumber='".$_POST['Phonenumber']."',Email='".$_POST['email']."',Category='".$_POST['category']."',Address='".$_POST['Address']."',Description='".$_POST['Description']."' WHERE id = '".$_GET['id']."'");
					$_GET['id']='';
					header("Location: ?page=vendor");
				}
				$sql_sel = mysql_query("SELECT * FROM vendor WHERE id = '".$_GET['id']."'");
				$data = mysql_fetch_array($sql_sel);
				echo '<center><strong>Vendor Details</strong></center>
						</br>
							<table width="100%" align="left" class="paginate sortable full">
								<tr>';
						if($_GET['id'])
							echo '<td><input type="text"  value="'.$data['PTVID'].'"></td>'; 
						if($_GET['id'])
							echo '<td><strong>Vendor_name</strong></td><td><input type="text" name="Vendor_name" id="vendorname" value="'.$data['Vendorname'].'"></td>';
						else
							echo '<td><strong>Vendor_name</strong></td><td><input type="text" name="Vendor_name" id="vendorname" value=""></td> ';
						if($_GET['id'])
							echo '<td><strong>Phonenumber</strong></td><td><input type="text" name="Phonenumber" id="phonenumber" value="'.$data['Phonenumber'].'"></td>';
						else
							echo '<td><strong>Phonenumber</strong></td><td><input type="text" name="Phonenumber" id="phonenumber" value=""></td>';

						if($_GET['id'])
							echo '<td><strong>E-mail</strong></td><td><input type="text" name="email" id="email" value="'.$data['Email'].'"></td>'; 
						else
							echo '<td><strong>E-mail</strong></td><td><input type="text" name="email" id="email" value=""></td> '; 	

						$sql_cat = mysql_query("SELECT * FROM vendor_category");
						echo '<td><strong>Category</strong></td><td><select id="category" name="category"><option value="select">select</option>';	
						$category = mysql_fetch_array(mysql_query("SELECT * FROM vendor WHERE id='".$_GET['id']."'"));
						while($row_cat = mysql_fetch_array($sql_cat))
						{	
							$found=0;
							foreach($category as $value)
							if($value == $row_cat['Categoryname'])
							$found=1;
						if($found)
							echo '<option value="'.$row_cat['Categoryname'].'" selected="selected">'.$row_cat['Categoryname'].'</option>';
						else
							echo '<option value="'.$row_cat['Categoryname'].'">'.$row_cat['Categoryname'].'</option>';
						}
						echo '</select></td></tr>';
						echo '
						<tr>';
						if($_GET['id'])
							echo '<td><strong>Address</strong></td><td class="tablewidth" colspan="15"><textarea rows="5" cols="200" name="Address" id="Address" bgcolor="white">'.$data['Address'].'</textarea></td>';
						else
							echo '<td><strong>Address</strong></td><td class="tablewidth" colspan="15"><textarea rows="5" cols="200" name="Address" id="Address" bgcolor="white"></textarea></td>';
						?>
						<script language="javascript1.2">
							generate_wysiwyg('Address');
						</script>
					<?php
						echo '</tr>
						<tr>';
					
						if($_GET['id'])
							echo'<td><strong>Description</strong></td><td class="tablewidth" colspan="15"><textarea rows="5" cols="200" name="Description" id="comment" bgcolor="white">'.$data['Description'].'</textarea></td>';
						else
							echo'<td><strong>Description</strong></td><td class="tablewidth" colspan="15"><textarea rows="5" cols="200" name="Description" id="comment" bgcolor="white"></textarea></td>';
							echo '</tr><tr><td>';
					?>
						<script language="javascript1.2">
							generate_wysiwyg('comment');
						</script>
					<?php
						if($_GET['id'])
							echo '<input type="submit" value="update" name="update" onclick="return validate()">';
						else
							echo '<input type="submit" value="submit" name="submit" onclick="return validate()">';
						echo '</td>
						</tr> 
						</table>';
						if(!$_GET['pageno'])
							$_GET['pageno'] = 1; 
						$rowsperpage = 20;
						$start = ($_GET['pageno']-1)*$rowsperpage; 
						$sql_ret = mysql_query("SELECT * FROM vendor ORDER BY id DESC LIMIT $start,$rowsperpage");
						$total_pages = ceil(mysql_num_rows(mysql_query("SELECT * FROM vendor")) / $rowsperpage);
						if(mysql_num_rows($sql_ret)==0)
							echo '<strong>NO VALUES</strong>';
						else
						{
							echo '<table width="1125px" class="paginate sortable fulll">
							<tr>
							<th>Vendor_id</th>
							<th>Vendor_name</th>
							<th>Phonenumber</th>
							<th>Email</th>
							<th>Category</th>
							<th>Address</th>
							<th>Description</th>
							</tr>';
							while($row_ret = mysql_fetch_array($sql_ret))
							{
								echo '<tr>
									<td>'.$row_ret['PTVID'].'</td>
									<td>'.$row_ret['Vendorname'].'</td>
									<td>'.$row_ret['Phonenumber'].'</td>
									<td>'.$row_ret['Email'].'</td>
									<td>'.$row_ret['Category'].'</td>
									<td class="tablewidth">'.$row_ret['Address'].'</td>
									<td class="tablewidth">'.$row_ret['Description'].'</td>
									<td><a href="?page=vendor&id='.$row_ret['id'].'"><img src="images/edit.png" title="edit" /></a></td>
									</tr>';
							}
							echo "</table>";
						}
				$GetValues = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
				if($total_pages > 1)
					include('pagination_1.php'); 
			?>
		</form>
	</body>
</html>