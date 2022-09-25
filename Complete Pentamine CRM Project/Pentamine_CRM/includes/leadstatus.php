<?php
	session_start();
	$product = explode(',',$_GET['product']);
?>

<html>
	<head>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="wordwrap.css">
		<script>
			$(document).ready(function()
			{
				$("h").hide();
				$(".btn1").hide();
				$(".btn1").click(function()
				{
					$("h").hide(500);
					$(".btn1").hide();
					$(".btn2").show();
				});
				$(".btn2").click(function()
				{
					$("h").show(500);
					$(".btn1").show();
					$(".btn2").hide();
				});	
				$(".btn3").hide();
				$("display").show();
				$("nondisplay").hide();
				$(".btn3").click(function()
				{
					$("display").show();
					$("nondisplay").hide();
					$(".btn3").hide();
					$(".btn4").show();
				});
				$(".btn4").click(function()
				{
					$("nondisplay").show();
					$("display").hide();
					$(".btn3").show();
					$(".btn4").hide();
				});
			});
			
		</script>
	</head>
	<body>
		<?php
		include("config.php");
		date_default_timezone_set("Asia/Kolkata"); 
		$cdate = date('Y-m-d h:i:s');
		echo '<div style="float:left;margin-top:0px;margin-left:150px;width:800px;">';
			echo "<div style='float:left;margin-top:0px;margin-left:0px;width:1200px'>
						<table>
							<tr><td style='width:600px'></td>";?>
								<td><button onclick='window.location.href="?page=leadsummary"'>Lead Summary</button></td><td></td>
								<td><button onclick='window.location.href="?page=task&ptcid=<?php echo $_GET['ptcid'];?>&id=<?php echo $_GET['id'];?>"'>Task</button></td><td></td>
								<td><button onclick='window.location.href="?page=tasksummary&ptcid=<?php echo $_GET['ptcid'];?>&id=<?php echo $_GET['id'];?>"'>Task Summary</button></td>
							<?php 
							$enablequery = mysql_query("select * from work where lead='".$_GET['id']."'");
							if(mysql_num_rows($enablequery))
							{
								?> <td><button style="background-color:red" id="work">Work Enabled</button></td>
							<?php 
							}
							else
							{
							?>
								<td><button onclick="window.location.href='?page=work&ptcid=<?php echo $_GET['ptcid'];?>&ptclid=<?php echo $_GET['id']?>'" id="work">Enable Working</button></td>
							<?php 
							}
							echo	"</tr>
						</table>
						<h1>LEAD STATUS</h1>";
				echo '</div>';
				echo "<br/><table border='1'  align= 'center' class='paginate sortable full'>";
				$sql = mysql_query("SELECT * from lead where ptclid='".$_GET['id']."' OR ptclid='".$_GET['ptclid']."'");
				$row = mysql_fetch_array($sql);
				echo 	"<tr>
							<th align='left'>LEAD ID:</th>
							<td>".$row['ptclid']."</td>
							<th align='left'>LEAD DESCRIPTION:</th>
							<td>".$row['ldesc']."</td>
							<th align='left'>LEAD DATE:</th>
							<td>".$row['ldate']."</td><th style='none'> 
							<td style='none'>";
							echo "<button class='btn1'>Hide</button>
						<button class='btn2'>".$row['cname']."
						</button>
													</td></th>
												</tr>
				</table>";
		if($_POST['update'] && $_POST['comment'])
		{	
			//ptclid,comment,date,status_id,amount,tax,total
			//echo $_GET['id'].",".$_POST['comment'].','.$_POST['date'].','.$_POST['status'].','.$_POST['amount'].','.$_POST['tax'].','.$_POST['total'];
			/*if($_POST['edit'])
			{
				$_GET['edit'] = 0;
				mysql_query("update comments set comment='".$_POST['comment']."', fdate='".$_POST['date']."',status_id='".$_POST['status']."',amount='".$_POST['amount']."',tax='".$_POST['tax']."',total='".$_POST['total']."' where ptclid='".$_POST['id']."'");
				
			}
			else*/
			mysql_query("UPDATE comments SET enable='0' WHERE ptclid='".$_GET['id']."'");
			mysql_query("INSERT INTO comments VALUES('null','".$_GET['id']."','".$_POST['comment']."','".$cdate."','".$_POST['date']."','".$_POST['status']."','".$_POST['amount']."','".$_POST['tax']."','".$_POST['total']."','1','".$_POST['quantity']."')");
			$query = mysql_query("SELECT * FROM client where ptcid = '".$_GET['ptcid']."'");
			if($row = mysql_fetch_array($query))
			{
				$query5 = mysql_query("SELECT * FROM comments WHERE ptclid='".$_GET['id']."' ORDER BY id DESC"); 
				$row5 = mysql_fetch_array($query5);
				$status = mysql_fetch_array(mysql_query("SELECT * FROM status  WHERE id='".$row5['status_id']."'"));		
				echo"<h><table border='1'  align='center' class='paginate sortable full'>
						<tr>
							<td colspan='2'><strong>Company Information</strong></td>
							<td style='width:10px;'> </td>
							<td colspan='2'><strong>Contact Information1</strong></td>
							<td style='width:10px;'> </td>
							<td colspan='2'><strong>Contact Information2</strong></td>
							<td style='width:10px;'> </td>";
							if(mysql_num_rows($query5))
								echo "<td colspan='2'><strong>Previous Comments</strong></td>";
					echo "</tr>
						<tr>
							<td>".$row['cname']."</td>
							<td style='width:30px;'>
							<td style='width:30px;'>
							<td>".$row['cpname1']." </td>
							<td style='width:30px;'>
							<td style='width:30px;'>
							<td>".$row['cpname2']."</td><td style='width:10px;'> </td>";
							if($row5)
							{
								$var = $row5['comment'];
								$newtext = wordwrap($var, 80, "\n",true);
								echo "<td style='width:30px;'><td>".$newtext."</td>";	
							}
				echo "</tr>
				<tr>
						<td>".$row['caddress']."</td>
						<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cppos1']."</td>
						<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cppos2']."</td>";
						if($row5)
							echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row5['cdate']."</td>"; 
				echo "</tr>
				<tr>
						   <td>".$row['cemail']."</td>
						   <td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpemail1']."</td>
						  <td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpemail2']."</td>";
						   if($row5)
							echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row5['fdate']."</td>";
				echo	"</tr>";
				echo	"<tr>
							<td>".$row['cnum1']."</td>
							<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpnum1']."</td>
							<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpnum2']."</td>";
							if($row5)
								echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$status['status']."</td>";
				echo	"</tr>";
				echo    "<tr>
							<td><strong>Reference:</strong>
							".$row['reference']."</td>";
							$fetchLead = mysql_fetch_array(mysql_query("SELECT * from lead where ptclid='".$_GET['id']."'"));
							$fetchProduct = mysql_fetch_array(mysql_query("SELECT * from producttype where slno='".$fetchLead['ptype']."'"));
							$fetchSubProduct = mysql_fetch_array(mysql_query("SELECT * from  productsubtype where id='".$fetchLead['pstype']."'"));
							echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$fetchProduct['type']."</td>
							<td style='width:30px;'></td><td style='width:30px;'></td><td>".$fetchSubProduct['type']."</td>
						 </tr>";
			echo		"</table>";
					 echo "</h><br />";
			}
		}
		include('includes/getsidestatus1.php');
		if(!$_POST['update'])	
		{	
			$query = mysql_query("SELECT * FROM client where ptcid = '".$_GET['ptcid']."'");
			$query5 = mysql_query("SELECT * FROM comments WHERE ptclid='".$_GET['id']."' ORDER BY id DESC"); 
			if($row = mysql_fetch_array($query))
			{
				$row5 = mysql_fetch_array($query5);
				$status = mysql_fetch_array(mysql_query("SELECT * FROM status  WHERE slno='".$row5['status_id']."'"));		
			echo"<h><table border='1'  align='center' class='paginate sortable full'>
						<tr>
							<td colspan='2'><strong>Company Information</strong></td>
							<td style='width:10px;'> </td>
							<td colspan='2'><strong>Contact Information1</strong></td>
							<td style='width:10px;'> </td>
							<td colspan='2'><strong>Contact Information2</strong></td>
							<td style='width:10px;'> </td>";
							if(mysql_num_rows($query5))
								echo "<td colspan='2'><strong>Previous Comments</strong></td>";
					echo "</tr>
						<tr>
							<td>".$row['cname']."</td>
							<td style='width:30px;'>
							<td style='width:30px;'>
							<td>".$row['cpname1']." </td>
							<td style='width:30px;'>
							<td style='width:30px;'>
							<td>".$row['cpname2']."</td><td style='width:10px;'> </td>";
							if($row5)
							{
								$var = $row5['comment'];
								$newtext = wordwrap($var, 80, "\n",true);
								echo "<td style='width:30px;'><td>".$newtext."</td>";	
							}
				echo "</tr>";
				echo "<tr>
						<td>".$row['caddress']."</td>
						<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cppos1']."</td>
						<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cppos2']."</td>";
						if($row5)
							echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row5['cdate']."</td>"; 
				echo "</tr>";
				echo "<tr>
						   <td>".$row['cemail']."</td>
						   <td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpemail1']."</td>
						  <td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpemail2']."</td>";
						   if($row5)
							echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row5['fdate']."</td>";
				echo "</tr>";
				echo "<tr>
							<td>".$row['cnum1']."</td>
							<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpnum1']."</td>
							<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpnum2']."</td>";
							if($row5)
								echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$status['status']."</td>";
				echo "</tr>";
				echo "<tr>
							<td><strong>Reference:</strong>
							".$row['reference']."</td>";
							$fetchLead = mysql_fetch_array(mysql_query("SELECT * from lead where ptclid='".$_GET['id']."'"));
							$fetchProduct = mysql_fetch_array(mysql_query("SELECT * from producttype where slno='".$fetchLead['ptype']."'"));
							$fetchSubProduct = mysql_fetch_array(mysql_query("SELECT * from  productsubtype where id='".$fetchLead['pstype']."'"));
							echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$fetchProduct['type']."</td>
							<td style='width:30px;'></td><td style='width:30px;'></td><td>".$fetchSubProduct['type']."</td>
						 </tr>";
			echo		"</table>";
					 echo "</h><br />";
			}
		} ?>
	</body>
</html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
		<link rel="stylesheet" href="css/styles1.css">
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		<script>
			function validateForm(form)
			{
				if(form.comment.value == "") 
				{
					alert("Please enter comment !");
					form.comment.focus();
					return false;
				}
				else if(form.status.value == "Select" || form.status.value == "Open") 
				{
					alert("Please Select Status !");
					form.status.focus();
					return false;
				}
			}
			function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57) &&toPrecision(2))
					return false;
				else
					return true;
			}
			$(document).ready(function()
			{
				$("#date").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
			$(document).ready(function()
			{
				$("#date1").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
			function calculate() 
			{
				var cost = Number(document.getElementById("amount").value);
				var tax = Number(document.getElementById("tax").value);				
				var total = cost + (cost * (tax / 100));
				total = parseFloat(total).toFixed(2);
				document.getElementById("total").value = total;
			}
		</script>
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js">
	</script>
	</head>
	<?php
	$status1 = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$_GET['id']."' AND enable=1"));
	$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status1['status_id']."'"));
	?>	
	<body style="">
		<form action="" method="POST" align="center" onSubmit="return validateForm(this);" name="form">
			<?php //echo "<input type='hidden' name='edit' value='".$_GET['edit']."' />";
			// echo "<input type='hidden' name='id' value='".$_GET['id']."' />"; ?>
			<table style='border-collapse:separate;border-spacing:0 10px;'>
				<tr>
					<td  colspan="2">
						Comment
					</td>
				</tr>
				<tr>		
					<td colspan="2">
					<?php
					echo  '<textarea rows="5" cols="200" name="comment" id="comment" bgcolor="white"></textarea>';
						?>
						<script language="javascript1.2">
							generate_wysiwyg('comment');
						</script>
					</td>
				</tr>
			</table>
			<table style='width:1500px'>
				<tr>
					<td>
						Follow-Up-Date				
						<?php
							echo  '<input type="text" name="date" id="date"  value="'.$row5['fdate'].'">';
						?>
						Status				
						<select name="status" id="status">
							 <option value="select" >select</option>
							 <?php
							 if($status_id['status'] == '')
							 {
								echo "<option value='Open' selected>Open</option>";	
								$query=mysql_query("select * from status");
								while($row=mysql_fetch_array($query))
								{
									echo "<option value='".$row['slno']."'>".$row['status']."</option>";
								}								
							 }
							 else if($status)
							 {
								$query=mysql_query("select * from status");
								while($row=mysql_fetch_array($query))
								{
									if($status['id'] == $row['slno'])
										echo "<option value='".$row['slno']."' selected>".$row['status']."</option>";
									else
										echo "<option value='".$row['slno']."'>".$row['status']."</option>";
								}
							 }
							 else
							 {
								$query=mysql_query("select * from status ORDER BY id ASC");
								while($row=mysql_fetch_array($query))
								{
									echo "<option value='".$row['slno']."'>".$row['status']."</option>";
								}
							 } ?>
						</select>
						Amount:
							<?php
							echo  '<input type="text" name="amount" id="amount"  class="decimal" value="'.$row5['amount'].'" onkeypress="return isNumberKey(event)" autocomplete="off">';
							?>
							Tax:
							<?php $query5 = mysql_query("SELECT * FROM comments WHERE ptclid='".$_GET['id']."' ORDER BY id DESC"); 
							$taxquery = mysql_fetch_array($query5);
							?>
							<select name="tax" id="tax" onchange="calculate()" >
								<option value='select'>Select</option>
								<?php
									if($taxquery['tax'] == "5.5")
										echo "<option value='5.5' selected>5.5%</option>";
									else
										echo "<option value='5.5'>5.5%</option>";
									if($taxquery['tax'] == "12.36")
										echo "<option value='12.36' selected>12.36%</option>";
									else
										echo "<option value='12.36'>12.36%</option>";
									if($taxquery['tax'] == "14.5")
										echo "<option value='14.5' selected>14.5%</option>";
									else
										echo "<option value='14.5'>14.5%</option>";
								?>
							</select>
							
						Total:
						<?php
						echo  '<input type="text" name="total" id="total" value="'.$row5['total'].'" autocomplete="off">';
						?>
							No.Of Quantity:
						<?php
						echo  '<input type="text" name="quantity" id="quantitiy" value="'.$row5['quantity'].'" onkeypress="return isNumberKey(event)" autocomplete="off">';
						?>		
					</td>
				</tr>
				<tr>
					<td>
						<pre>
						</pre>
						<input type="submit" value="Update" name="update">
					</td>
				</tr>
			</table>
		</form>
		<br />
	</body>
</html>
<?php
		$sql = mysql_query("SELECT * FROM comments where ptclid='".$_GET['id']."'  ORDER BY id DESC");
		if(mysql_num_rows($sql))
		{
			
		echo "<table><tr>".'<button class="btn3">Hide</button>
				<button class="btn4">Full Details</button>'."</tr>
				</table>";	
				echo "<display><table border='1' align= 'left' class='paginate sortable' width='1000'>
					<tr>
						<!--th>PTCL-ID</th-->
						<!--th>Company Name</th-->
						<!--th>Product Type</th-->
						<!--th>Product Sub Type</th-->
						<!--th>Assign</th-->
						<th align='left'>Comment Date</th>
						<th align='left'>Comment</th>
						<th align='left'>Follow-Up-Date</th>
						<th align='left'> Status</th>
					</tr>";
					while($row = mysql_fetch_array($sql))
					{
						echo "<tr>
						<!--td>".$row['ptclid']."</td-->";
						$query = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid='".$_GET['ptcid']."' "));
						echo	"<!--td>".$query['cname']."</td-->";
						$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead WHERE ptclid='".$_GET['id']."'"));
						echo	"<td align='left'>".$row['cdate']."</td>";
						$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
						$row1 = mysql_fetch_array($query1);
				echo	"<!--td>".$row1['type']."</td-->";
						$query2 = mysql_query("SELECT * FROM  productsubtype where id='".$lead['pstype']."'");
						$row2 = mysql_fetch_array($query2);
				echo	"<!--td>".$row2['type']."</td-->";
						$query3 = mysql_query("SELECT * FROM assignee  where id='".$lead['assign']."'");
						$row3=mysql_fetch_array($query3);
				echo	"<!--td>".$row3['name']."</td-->";
						$var = $row['comment'];
						$newtext = wordwrap($var, 20, "\n",true);
				echo "<td>".$newtext."</td>
				<td>".$row['fdate']."</td>";
						$query4 = mysql_query("SELECT * FROM status  where id='".$row['status_id']."'");
						$row4=mysql_fetch_array($query4);
						if($row4['status'])
							echo "<td align='left'>".$row4['status']."</td>";
						else
							echo "<td align='left'>Open</td>";
				echo		"<!--td>".$row5['tdate']."</td>";
						$query6 = mysql_query("SELECT * FROM assignee  where id='".$row5['assignee']."'");
						$row6=mysql_fetch_array($query6);
				echo "<td>".$row6['name']."</td-->
				</tr>";	
				}
				echo '</table></display>';	
		}
		$sql = mysql_query("SELECT * FROM comments where ptclid='".$_GET['id']."'  ORDER BY id DESC  $Limit");
		if(mysql_num_rows($sql))
		{
				echo "
				<nondisplay><table border='1'  align= 'left' class='paginate sortable' width='1000'>
					<tr>
						<!--th>PTCL-ID</th-->
						<!--th>Company Name</th-->
						<!--th>Product Type</th-->
						<!--th>Product Sub Type</th-->
						<!--th>Assign</th-->
						<th align='left'>Comment Date</th>
						<th align='left'>Comment</th>
						<th align='left'>Follow-Up-Date</th>
						<th align='left'>Status</th>
						<th align='left'>Amount</th>
						<th align='left'>Tax</th>
						<th align='left'>Total</th>
						<th align='left'>No.Of Quantity</th>
						
						<!--th>Task Date</th>
						<th align='left'>Assignee</th-->
					</tr>";
					while($row = mysql_fetch_array($sql))
					{
						echo "<tr>
						<!--td>".$row['ptclid']."</td-->";
						$query = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid='".$_GET['ptcid']."' "));
						echo	"<!--td>".$query['cname']."</td-->";
						$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead WHERE ptclid='".$_GET['id']."'"));
						echo	"<td align='left'>".$row['cdate']."</td>";
						$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
						$row1 = mysql_fetch_array($query1);
				echo	"<!--td>".$row1['type']."</td-->";
						$query2 = mysql_query("SELECT * FROM  productsubtype where id='".$lead['pstype']."'");
						$row2 = mysql_fetch_array($query2);
				echo	"<!--td>".$row2['type']."</td-->";
						$query3 = mysql_query("SELECT * FROM assignee  where id='".$lead['assign']."'");
						$row3=mysql_fetch_array($query3);
				echo	"<!--td>".$row3['name']."</td-->";
						$var = $row['comment'];
						$newtext = wordwrap($var, 20, "\n",true);
				echo "<td>".$newtext."</td>
				<td>".$row['fdate']."</td>";
						$query4 = mysql_query("SELECT * FROM status  where id='".$row['status_id']."'");
						$row4=mysql_fetch_array($query4);
						if($row4['status'])
							echo "<td align='left'>".$row4['status']."</td>";
						else
							echo "<td align='left'>Open</td>";
				echo "<td align='left'>".$row['amount']."</td>
						<td align='left'>".$row['tax']."</td>
						<td align='left'>".$row['total']."</td>
						<td align='left'>".$row['quantity']."</td>
						
						<!--td>".$row5['tdate']."</td>";
						$query6 = mysql_query("SELECT * FROM assignee  where id='".$row5['assignee']."'");
						$row6=mysql_fetch_array($query6);
				echo "<td>".$row6['name']."</td-->
				</tr>";	
				}
				echo '</table></nondisplay>';		
		}
		//include('includes/leadstatus_pagination.php');
		echo "</div>";
?>	
<script>
	$("#status").ready(function()
	{
		if(document.getElementById("status").value == 7)
			$("#work").show();
		else if($(this).val() == "")
		{
			$("#work").hide();
		}
	});
	$("#status").change(function() 
	{
		// foo is the id of the other select box 
		if ($(this).val() == 7) 
		{
			$("#work").show();
		}else
		{
			$("#work").hide();
		} 
	});
	Number.prototype.toFixedDown = function(digits) {
  var n = this - Math.pow(10, -digits)/2;
  n += n / Math.pow(2, 53); // added 1360765523: 17.56.toFixedDown(2) === "17.56"
  return n.toFixed(digits);
}
$( function() {
    $('.decimal').keyup(function(){
        if($(this).val().indexOf('.')!=-1){         
            if($(this).val().split(".")[1].length > 2){                
                if( isNaN( parseFloat( this.value ) ) ) return;
                this.value = parseFloat(this.value).toFixedDown(2);
            }  
         }            
         return this; //for chaining
    });
});
	
</script>