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
		<script>
		function product_change(str)
		{	
			if (window.XMLHttpRequest)
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
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
					var results = xmlhttp.responseText;  
					var values = results.split("#");
					var select = document.getElementById('subproduct');
					select.options.length = 0; //For remove all options of dropdown list
					for(var i = 0; i < values.length; i++)
					{
						if(i%2 == 0)
							select.options[select.options.length] = new Option(values[i],values[i]);
					}
				}
			}
			xmlhttp.open("GET","includes/getsub.php?ptype="+str+"",true);
			xmlhttp.send();
		}
		function validate(form)
		{
			if(document.getElementById('product').selectedIndex == 0 ) 
			{
				alert ( "Please select product");
				return false;
			} 
			if(document.getElementById('subproduct').selectedIndex == 0 ) 
			{
				alert ( "Please select subproduct");
				return false;
			} 
			if(form.description.value == "") 
			{
				alert("Please Enter Description!");
				form.description.focus();
				return false;
			}  
		}
		</script>
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js"></script> 
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="wordwrap.css"> 
	</head>
	<body>
		<div style="float:left;margin-top:25px;margin-left:900px;width:500px">
			<button onclick="window.location.href='?page=resource'">Resource</button>
			<button onclick="window.location.href='?page=resourcesummary'">Resource Summary</button>
		</div>
		<form action="" name="form" method="POST" onsubmit="return validate(this);">
			<?php
				include"config.php";
				session_start(); 
				ini_set( "display_errors", "0" );
				$i=2;$j=1; 
				$date = new DateTime();
				date_default_timezone_set('Asia/Calcutta'); 
				$date1 = date("Y-m-d h:i:sA", $date->format('U'));
				if($_POST['submit'])
				{ 	
					$sql_select = mysql_query("SELECT PTRID FROM resource ORDER BY id DESC");
					if(mysql_num_rows($sql_select))
					{
						$data = mysql_fetch_array($sql_select);
						$ptrid = substr($data['PTRID'],6,4)+1;
						if(strlen($ptrid) == 1)
							$ptrid ="PTRID-000".$ptrid;
						if(strlen($ptrid) == 2)
							$ptrid ="PTRID-00".$ptrid;
						if(strlen($ptrid) == 3)
							$ptrid ="PTRID-0".$ptrid;
					}
					else 
					{
						$ptrid = "PTRID-0001";
					}
					mysql_query("INSERT INTO resource (PTRID,product,subproduct,description,date,updatedby) VALUES ('".$ptrid."','".$_POST['product']."','".$_POST['subproduct']."','".$_POST['description']."','".$date1."','".$_SESSION['clientId']."')");
					header("Location: ?page=resource");
				}	
				if($_POST['update'] && $_GET['id'])
				{	
					mysql_query("UPDATE resource SET product='".$_POST['product']."',subproduct='".$_POST['subproduct']."',description='".$_POST['description']."' WHERE id='".$_GET['id']."'");
					$_GET['id']='';
					header("Location: ?page=resource");
				} 
				if($_GET['id'])
				{
					$row_ret = mysql_fetch_array(mysql_query("SELECT * FROM resource WHERE id='".$_GET['id']."'"));
					$value_pro = $row_ret['product'];
					$value_sub = $row_ret['subproduct']; 
				}
				$product = mysql_query("SELECT * FROM producttype"); 
				echo'<div style="float:left;padding-top:10px;margin-left:10px;margin-top:20px;width:790px"><table class="paginate sortable full">
						<tr>';
				if($_GET[id])
					echo '<td></td><td><input type="text" value="'.$row_ret['PTRID'].'" ></td></tr>';
							echo'<tr><td><th>Product</th></td><td>
							<select name="product" id="product" onchange="product_change(this.value)">
							<option value="select">Select</option>';  
				if($value_pro=="other")
					echo'<option value="'.$value_pro.'" selected="selected">'.$value_pro.'</option>'; 
				else
					echo '<option value="other">other</option>';
				while($product_value = mysql_fetch_array($product))
				{
					if($value_pro == $product_value['type']) 
						echo'<option value="'.$product_value['type'].'" selected="selected">'.$product_value['type'].'</option>';
					else 	
						echo'<option value="'.$product_value['type'].'">'.$product_value['type'].'</option>'; 
				}
				echo'</select>
						</td><td><th>SubProduct</th></td>
							<td><select name="subproduct" id="subproduct" >
							<option value="select" selected="selected">Select</option>';
				$sub_product = mysql_query("SELECT * FROM productsubtype"); 
				if($value_sub=="other")
					echo'<option value="'.$value_sub.'" selected="selected">'.$value_sub.'</option>'; 
				//else
					//echo '<option value="other">other</option>';
				while($sub_product_value = mysql_fetch_array($sub_product))
				{ 	 
					if($value_sub == $sub_product_value['type'])
						echo'<option value="'.$sub_product_value['type'].'" selected="selected">'.$sub_product_value['type'].'</option>'; 
					//else
						//echo'<option value="'.$sub_product_value['type'].'">'.$sub_product_value['type'].'</option>';
				}
				echo'</select></td></tr>';
				
				if($_GET[id])
					echo '<tr><td><th>Description</th></td><td colspan="4"><textarea rows="5" cols="200" name="description" id="description" bgcolor="white">'.$row_ret['description'].'</textarea></td>';
				else
					echo '<td><th>Description</th></td><td colspan="4"><textarea rows="5" cols="200" name="description" id="description" bgcolor="white"></textarea></td></tr>';
				?>
				<script language="javascript1.2">
					generate_wysiwyg('description');
				</script>
				<?php
				if($_GET[id])
					echo '<tr><td></td><td><input type="submit" name="update" value="update" onclick="return validate()"></td>';
				else
					echo '<td></td><td><input type="submit" name="submit" value="submit" onclick="return validate()"></td></tr></table>';
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1; 
				$rowsperpage = 20;
				$start = ($_GET['pageno']-1)*$rowsperpage; 
				$ret = mysql_query("SELECT * FROM resource ORDER BY id DESC LIMIT $start,$rowsperpage");
				$total_pages = ceil(mysql_num_rows(mysql_query("SELECT * FROM resource")) / $rowsperpage);
				if(mysql_num_rows($ret) == 0)
					echo'<strong>No Values</strong>';
				else
				{
					echo '<div style="float:left;padding-top:10px;margin-left:0px;width:790px"><table class="paginate sortable fulll" width="1150px">
							<tr>
								<th>PTRID</th>
								<th>product</th>
								<th>SubProduct</th>
								<th>Description</th>
								<th>Date</th>
								<th>UpdatedBy</th>
							</tr>';
					while($r_ret = mysql_fetch_array($ret))
					{	
						//$rret = $r_ret['description'];
						//$word_ret = wordwrap($rret,80,"\n",true);
						echo'<tr>
								<td>'.$r_ret['PTRID'].'</td>
								<td>'.$r_ret['product'].'</td>
								<td>'.$r_ret['subproduct'].'</td>
								<td class="tablewidth">'.$r_ret['description'].'</td>
								<td>'.$r_ret['date'].'</td> 
								<td>'.$r_ret['updatedby'].'</td> 
								<td><a href="?page=resource&id='.$r_ret['id'].'"><img src="images/edit.png" title="edit" /></td> 
							</tr>';
					}
					echo'</table></div>';
				}
				$GetValues = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
				if($total_pages > 1)
					include('pagination_1.php'); 				
			?>
		</form>
	</body>
</html>