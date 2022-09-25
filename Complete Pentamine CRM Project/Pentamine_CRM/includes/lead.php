<?php
	session_start();
	if($_SESSION['clientId'])
		$product = explode(',',$row1['product']);
	include("config.php");
	ini_set( "display_errors", "0" );
	$date = date("Y-m-d");
	if(($_POST['cname']) && $_POST['submit'])
	{
		$count = mysql_query("SELECT id FROM lead ORDER BY id DESC");
		$idval = mysql_fetch_array($count);
		$var = "PTLID-000".($idval['id']+1);
		mysql_query("INSERT INTO lead (ptclid,cname,ldesc,ldate,ptype,pstype,assign) VALUES ('".$var."','".$_POST['cname']."','".$_POST['ldesc']."','".$date."','".$_POST['ptype']."','".$_POST['stype']."','".$_POST['assign']."')");
		if($var)
			echo '<script type="text/javascript">alert("PTC-ID is '.$var.'\n\n Successfully Submitted."); </script>';
	}	
	if($_GET['edit'])
	{
		$query1 = mysql_fetch_array(mysql_query("SELECT * FROM lead WHERE ptclid='".$_GET['ptclid']."'"));
		echo "You are Editing ".$_GET['ptclid']."";
	}
	if( $_POST['update'])
	{
		$var = $_POST['ptclid'];
		mysql_query("UPDATE lead SET cname='".$_POST['cname']."',ldesc='".htmlspecialchars($_POST['ldesc'])."',ptype='".$_POST['ptype']."',pstype='".$_POST['stype']."',assign='".$_POST['assign']."' WHERE ptclid='".$var."'");
		if($var)
			echo '<script type="text/javascript">alert("PTC-ID is '.$var.'\n\n Successfully Updated."); </script>';
	}
	if($_GET['del'])
	{
		mysql_query("DELETE FROM lead WHERE ptclid='".$_GET['ptclid']."'");
		echo $_GET['ptclid']." Deleted Successfully";
	}
?>
<html>
	<head>
	<style>
			div.scrollWrapper
			{
			  height:600px;
			  width:1290px;
			  overflow:scroll;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
		<link rel="stylesheet" href="css/styles1.css">
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js">
		<script>
			$(document).ready(function()
			{
				$("#date").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					changeYear: true,
					yearRange: "-35:+0"
				});
			});
		</script>
	</head>
	<body style="background-color:#d0e4fe;">	
	<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
		<button onclick="window.location.href='?page=leadsummary'">Lead Summary</button>
	</div>
	<div class="grid_6 first">
	<?php
		echo '<form action="?page=leads" method="POST" onSubmit="return validateForm(this)" name="form" id="form" class="form panel">';
	?>	<header>
		<h2>Lead Management</h2>
	</header>
			<hr>
			<fieldset>
				<div class="clearfix">
					<label>	Client Name:</label>
					<select name="cname">
							<option value="Select" >Select</option>
							<?php
							$query=mysql_query("select * from client");
							while($row = mysql_fetch_array($query))
							{
								if($_GET['edit']  && $query1['cname'] == $row['ptcid'])
									echo "<option value='".$row['ptcid']."' selected>".$row['cname']." - ".$row['ptcid']."</option>";
								else
									echo "<option value='".$row['ptcid']."'>".$row['cname']." - ".$row['ptcid']."</option>";
							}
							?>
					</select>
				</div>
				<div class="clearfix">
					<label>	Lead Description:</label>
					<?php
						echo '<textarea name="ldesc" id="ldesc">'.$query1['ldesc'].'</textarea>';
					?>
					<script language="javascript1.2">
						generate_wysiwyg('ldesc');
					</script>
				</div>
				<div class="clearfix">
					<label>	Product Type:</label>
					<select name="ptype" onchange="product_change(this.value)">
						<option value="Select" >Select</option>
						<?php
						for($i = 0; $i < count($product); $i++)
						{
							$query=mysql_query("select * from producttype WHERE slno='".$product[$i]."'");
							while($row=mysql_fetch_array($query))
							{
								if($_GET['edit'] && $query1['ptype'] == $row['slno'])
									echo "<option value='".$row['slno']."' selected>".$row['type']."</option>";
								else
									echo "<option value='".$row['slno']."'>".$row['type']."</option>";
							}
						}
						?>
						</select> 	
				</div>
				<div class="clearfix">
					<label>	Product Sub-Type:</label>
					<select name="stype" id="sub">
							<option value="Select">Select</option>
							 <?php
								if($_GET['edit'] && !$_POST['update'])
								{
									$query = mysql_fetch_array(mysql_query("SELECT * FROM productsubtype where id='".$query1['ptype']."'"));
										echo '<option value="'.$query['id'].'" selected>'.$query['type'].'</option>';
								}  ?>
					</select>
				</div>
				<div class="clearfix">
					<label>	Assigned To:</label>
					<select name="assign">
							<option value="Select" >Select</option>
							<?php
							$query = mysql_query("select * from assignee");
							while($row=mysql_fetch_array($query))
							{
								if($_GET['edit'] && $query1['assign'] == $row['slno'])
									echo "<option value='".$row['slno']."' selected>".$row['name']."</option>";
								else
									echo "<option value='".$row['slno']."'>".$row['name']."</option>";
							} ?>
						</select>
				</div>				
			</fieldset>	
			<hr>	
			<?php
				if($_GET['edit'])
				{
					echo '<button class="button button-green" type="hidden" name="update" value="1">update</button>';
					echo '<input type="hidden" name="ptclid" value="'.$_GET['ptclid'].'">';
				}
				else
					echo '<button class="button button-green" type="submit" value="submit" name="submit">Submit</button>';
			?>	
		</form>
	</div>
		<?php
				$result = mysql_query("SELECT * FROM lead");
				if(!mysql_num_rows($result))
					echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
				$rowsperpage = 15;
				$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
				if(!$_GET['pageno'])
					$_GET['pageno']=1;
				if($_GET['pageno']>1)
					$Limit = "LIMIT ".$rowsperpage.",".(($_GET['pageno']-1)*$rowsperpage);
				else
					$Limit = "LIMIT 0,".($rowsperpage);
					
				echo '<div style="float:left;margin-top:20px;margin-left:0px;width:2000px">';
				$query = mysql_query("SELECT * FROM lead ORDER BY  ldate Desc $Limit");
				if(mysql_num_rows($query))
				{
				echo "<div style='width:1150px;height:650px;overflow-x:scroll;overflow-y:auto;'>
						<table border='1'  align= 'left' class='paginate sortable full1' width='1150px'>
					<tr>
						<th align='left'>Client Name</th>
						<th align='left'>Lead-ID</th>
						<th align='left'>Lead Description</th>
						<th align='left'>Lead Date</th>
						
						<th align='left'>Product Type</th>
						<th align='left'>Product Sub Type</th>
						<th align='left'>Assign To</th>
						
					</tr>";
				}
				$condition = "";
				foreach($product as $prod)
				{
					if(!$condition)
						$condition = "ptype='".$prod."'";
					else
						$condition .= " or ptype='".$prod."'";
				}
				$Lead = mysql_query("SELECT * FROM lead WHERE $condition ORDER BY id deSC $Limit");
				while($row=mysql_fetch_array($Lead))
				{
				$name = mysql_fetch_array(mysql_query("SELECT cname FROM client WHERE ptcid='".$row['cname']."'"));
				echo "<tr><td style='width:150px'>".$name['cname']."</td>
				<td style='width:10px'>".$row['ptclid']."</td>";
				$var = $row['ldesc'];
				$newtext = wordwrap($var,50, "\n",true);
				echo	"<td style='width:150px'>".$newtext."</td>
				<td>".$row['ldate']."</td>";
				$query1 = mysql_query("SELECT * FROM  producttype where slno='".$row['ptype']."'");
					$row1 = mysql_fetch_array($query1);
			echo	"<td>".$row1['type']."</td>";
					$query2 = mysql_query("SELECT * FROM  productsubtype where id='".$row['pstype']."'");
					$row2 = mysql_fetch_array($query2);
					echo"<td>".$row2['type']."</td>";
					$query3 = mysql_query("SELECT * FROM assignee  where slno='".$row['assign']."'");
					$row3=mysql_fetch_array($query3);//onclick='myFunction('?page=leads&ptclid=".$row['ptclid']."&ptcid=".$row['cname']."&del=1')'
			echo	"<td>".$row3['name']."</td>
					<td>
						<a href='?page=leads&ptclid=".$row['ptclid']."&ptcid=".$row['cname']."&edit=1'><img src='images/edit.png' title='edit' /></a>";
						?><a href='' onclick='myFunction("<?php echo $row['ptclid'];?>","<?php echo $row['cname'];?>","1")'><img src='images/delete.png' title='delete' /></a>
						</td>
					</tr>
				<?php 
				}
			echo "</table></div></div>";		
			echo '<div style="float:left;margin-top:20px;margin-left:400px;width:2000px">';
				include("includes/pagination.php");
			echo "<center></div>";
		?>
	</body>
</html>
<script>
function product_change(str)
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
						var results = xmlhttp.responseText;
						var values = results.split("#");
						var select = document.getElementById('sub');
						select.options.length = 0; 	//For remove all options of dropdown list
						
						for(var i = 0; i < values.length; i++)
						{
							if(i%2 == 0)
								select.options[select.options.length] = new Option(values[i],values[i+1]);
						}
					}
				}
				xmlhttp.open("GET","includes/getsub.php?q="+str,true);
				xmlhttp.send();
			}
function myFunction(ptclid,ptcid,del)
{
	var x;
	var r = confirm("Do you Want to Delete...?");
	if(r == true)
	{
		window.location.assign("?page=leads&ptclid="+ptclid+"&ptcid="+ptcid+"&del="+del);
		alert("");
	}
}
function validateForm(form)
{
	if(form.cname.value == "Select") 
	{
		alert("Please Select Client Name!");
		form.cname.focus();
		return false;
	}
	if(form.ldesc.value == "") 
	{
		alert("Please Enter Lead Description!");
		form.ldesc.focus();
		return false;
	}
	if(form.ptype.value == "Select") 
	{
		alert("Please Select Product Type!");
		form.ptype.focus();
		return false;
	}
	if(form.stype.value == "Select") 
	{
		alert("Please Select Product Sub Type!");
		form.stype.focus();
		return false;
	}
	if(form.assign.value == "Select") 
	{
		alert("Please Select Assignee!");
		form.assign.focus();
		return false;
	}
}
</script>