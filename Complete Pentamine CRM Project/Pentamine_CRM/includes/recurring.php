<?php
	include("config.php");
	ini_set( "display_errors", "0" );
	$date = date("Y-m-d");
	if($_POST['cname']  && $_POST['submit'])
	{
		$count = mysql_query("SELECT id FROM recurring ORDER BY id DESC");
		$idval = mysql_fetch_array($count);
		$var = "PTRID-00".($idval['id']+1);
		$frequency = explode('-',$_POST['frequency']);
		$yearlyAmount = $_POST['amount']*(12/$frequency[0]);
		mysql_query("INSERT INTO  recurring(recurring_id,recurring_createdate,recurring_client,recurring_product,recurring_subproduct, recurring_description,recurring_frequency,recurring_date,recurring_amount,recurring_yearlyamount,recurring_status) VALUES ('".$var."','".$date."','".$_POST['cname']."','".$_POST['ptype']."','".$_POST['stype']."','".htmlspecialchars($_POST['desc'])."','".htmlspecialchars($_POST['frequency'])."','".$_POST['recurring-date']."','".$_POST['amount']."','".$yearlyAmount."','".$_POST['status']."')");
		//mysql_query("INSERT INTO recurring_service values ('','".$var."','".$_POST['recurring-date']."') ");
		echo "Recurring of '$var' Successfully inserted ";
	}
	if($_GET['edit'])
	{
		$query1 = mysql_fetch_array(mysql_query("SELECT * FROM recurring WHERE id='".$_GET['id']."'"));
	}
	if($_POST['cname'] && $_POST['submit1'])
	{
		$frequency = explode('-',$_POST['frequency']);
		$yearlyAmount = $_POST['amount']*(12/$frequency[0]);
		mysql_query("UPDATE recurring SET recurring_client='".$_POST['cname']."',recurring_product='".$_POST['ptype']."',recurring_subproduct='".$_POST['stype']."',recurring_description='".htmlspecialchars($_POST['desc'])."',recurring_frequency='".$_POST['frequency']."',recurring_date='".$_POST['recurring-date']."',recurring_amount='".$_POST['amount']."',recurring_status= '".$_POST['status']."',recurring_yearlyamount='".$yearlyAmount."' WHERE id='".$_POST['id']."'");
		$var =$_POST['cname'];
		echo '<script type="text/javascript">alert("Recurring Of '.$var.' \n\n Successfully Updated."); </script>';
	}
	if($_GET['d_id'] && $_GET['del'])
	{
		mysql_query("DELETE FROM recurring WHERE id='".$_GET['d_id']."'");
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
		<script>
			function product_change(str)
			{
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
			function confirmation() 
				{
					var answer = confirm("Delete recurring?")
					if (!answer)
					{
						
						window.location = "by_hand.php";
					}
				}		
		</script>
	</head>
	<body style="background-color:#d0e4fe;">
		<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
		<button onclick="window.location.href='?page=recurringsummary'">Recurring Summary</button>
	</div>
	<div class="grid_6 first">
		<form action="" method="POST" name="form" id="form" class="form panel">
			<!--iv style="float:left;margin-top:-0px;margin-left:25px;width:450px"-->
				<header>
					<h2>Recurring Management</h2>	
				</header>
				<hr>
				<fieldset>
					<div class="clearfix">
						<label>Client Name:</label>
						<select name="cname">
						<option value="Select" >Select</option>
						<?php
						$work = mysql_fetch_array(mysql_query("select * from work where work_id='".$_GET[workId]."'"));
						//echo "----------------".$_GET[workId].$work['client'].$work['description'];
						$query=mysql_query("select * from client");
						while($row = mysql_fetch_array($query))
						{
							if(($_GET['edit']  && $query1['recurring_client'] == $row['ptcid']) || ($row['ptcid'] == $work['client']))
								echo "<option value='".$row['ptcid']."' selected>".$row['cname']." - ".$row['ptcid']."</option>";
							else
								echo "<option value='".$row['ptcid']."'>".$row['cname']." - ".$row['ptcid']."</option>";
						}
						?>
						</select>
					</div>
					<div class="clearfix">
						<label>Product:</label>
						<select name="ptype" onchange="product_change(this.value)">
							<option value="Select" >Select</option>
							<?php
								$product_lead=mysql_fetch_array(mysql_query("SELECT * FROM lead WHERE ptclid='".$work['lead']."'"));
								if($_GET['workId'])
									$query=mysql_query("select * from producttype where slno ='".$product_lead['ptype']."'");
								else
									$query=mysql_query("select * from producttype");
									
								while($row=mysql_fetch_array($query))
								{
									if($_GET['edit'] && $query1['recurring_product'] == $row['slno'])
										echo "<option value='".$row['slno']."' selected>".$row['type']."</option>";
									else if($_GET['workId'])
										 echo "<option value='".$row['slno']."' selected>".$row['type']."</option>";
									else
										echo "<option value='".$row['slno']."'>".$row['type']."</option>";
								}
							?>
						</select>
					</div>
					<div class="clearfix">
						<label>Sub-Product:</label>
						<select name="stype" id="sub">
							<option value="Select">Select</option>
							 <?php
									if($_GET['workId'])
									{
										$query = mysql_fetch_array(mysql_query("SELECT * FROM productsubtype where slno ='".$product_lead['pstype']."'"));
										echo '<option value="'.$query['slno'].'" selected>'.$query['type'].'</option>'; 
									}
									else if($_GET['edit'])
									{
										$subquery = mysql_query("SELECT * FROM productsubtype ");
										while ($query = mysql_fetch_array($subquery))
										{
											if($query1['recurring_subproduct'] == $query['slno'])
												echo '<option value="'.$query['slno'].'" selected>'.$query['type'].'</option>'; 
										}
									}?>
						</select>
					</div>
					<div class="clearfix">
						<label>Description:</label>
						<?php echo '<textarea name="desc">'.$query1['recurring_description'].'</textarea>';?>
					</div>	
					<div class="clearfix">
						<label>Alert Date::</label>
						<?php echo '<input type="text" id ="date" name="recurring-date" value='.$query1['recurring_date'].'>';?>
					</div>
					<div class="clearfix">
						<label>Frequency:</label>
						<select name="frequency">
							<?php $status = array('Select','1-Month','2-Month','3-Month','4-Month','5-Month','6-Month','7-Month','8-Month','9-Month','10-Month','11-Month','12-Month');
									foreach($status as $st)
									{
										if($query1['recurring_frequency'] == $st)
											echo '<option value='.$st.' selected>'.$st.'</option>';
										else
											echo '<option value='.$st.'>'.$st.'</option>';
									}
							?>
						</select>
					</div>	
					<div class="clearfix">
						<label>Amount:</label>
						<?php
						echo '<input type="text" name="amount" value='.$query1['recurring_amount'].'>';?>
					</div>
					<div class="clearfix">
						<label>Recurring Status::</label>
						<select name="status">
					<?php $status = array('Select','Enable','Disable');
							foreach($status as $st)
							{
								if($query1['recurring_status'] == $st)
									echo '<option value='.$st.' selected>'.$st.'</option>';
								else
									echo '<option value='.$st.'>'.$st.'</option>';
							}
					?>
						</select>
					</div>
				</fieldset>
				<hr>
					<?php
						if(!$_GET['edit'])
							echo '<button class="button button-green" value="submit" type="submit" name="submit">Submit</button>';
						else
						{
							echo '<input type="hidden" value="'.$_GET['id'].'" name="id">';
							echo '<button class="button button-green" type="hidden" name="submit1" value="update">Update</button>';
						}
					?>
		</form>
	</div>
		<div style="float:left;margin-top:500px;margin-left:-750px;width:100px">
		<?php
				$query = mysql_query("SELECT * FROM  recurring");
				if(mysql_num_rows($query))
				{
				echo "<div style='width:1350px;height:550px;overflow-x:scroll;overflow-y:auto;'>
						<table border='1'  align= 'left' class='paginate sortable full'>
					<tr>
						<th align='left'>Recurring ID</th>	
						<th align='left'>Recurring Create Date</th>
						<th align='left'>Client Name</th>
						<th align='left'>Product Type</th>
						<th align='left'>Product Sub Type</th>
						<th align='left'>Description</th>
						<th align='left'>Frequency</th>
						<th align='left'>Recurring-Date</th>
						<th align='left'>Staus</th>
					</tr>";
				}
				$recurring = mysql_query("SELECT * FROM recurring ORDER BY id deSC");
				
				while($row=mysql_fetch_array($recurring))
				{
				$name = mysql_fetch_array(mysql_query("SELECT cname FROM client WHERE ptcid='".$row['recurring_client']."'"));
				echo "<tr><td>".$row['recurring_id']."</td>
						<td>".$row['recurring_createdate']."</td>";
				echo	"<td>".$name['cname']."</td>";
					$query1 = mysql_query("SELECT * FROM  producttype where slno='".$row['recurring_product']."'");
					$row1 = mysql_fetch_array($query1);
			echo	"<td>".$row1['type']."</td>";
					$query2 = mysql_query("SELECT * FROM  productsubtype where id='".$row['recurring_subproduct']."'");
					$row2 = mysql_fetch_array($query2);
					echo"<td>".$row2['type']."</td>";
					echo"<td>".$row['recurring_description']."</td>";
					echo"<td>".$row['recurring_frequency']."</td>";
					echo"<td>".$row['recurring_date']."</td>";
					echo"<td>".$row['recurring_status']."</td>";
					
					echo "<td>
						<a href='?page=recurring&id=".$row['id']."&edit=1'><img src='images/edit.png' title='edit' /></a>
						<a href='?page=recurring&d_id=".$row['id']."&del=1' onclick='confirmation()' ><img src='images/delete.png' title='delete' /></a>
						
					</td>
				</tr>";
				}
					echo "</table></div></div>";
			echo '<div style="float:left;margin-top:650px;margin-left:450px;width:2000px">';
			
			include("includes/pagination.php");
			echo '</div>';
		?>
	</body>
</html>