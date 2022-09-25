<?php
include('Config.php');
$i=1;
?>
<form action="?index.php&page=Stores&subpage=spage->Stock_Management,ssubpage->Inspection" method="post">
<?php 
if(mysql_num_rows(Stock_Inspection())==0)
	echo "<br/><h3>Total Number Stocks to be Inspected -".'0'.'</h3><br/>';
else
{
?>
<table class="paginate sortable full">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Invoice Number</th>
			<th align="left">Rawmaterial Code</th>
			<th align="left">Vendor</th>
			<th align="left">Quantity</th>
			<th align="left">Status</th>
			<th align="left">Inspection Quantity</th>
			<th align="left">Remarks</th>
			<th align="left" id="action">Action</th>
		</tr>
	</thead>
<?php
	$summary = Stock_Inspection();
	echo "<br/><h3>Total Number Stocks to be Inspected -".mysql_num_rows($summary).'</h3><br/>';
	while($stock_summary = mysql_fetch_assoc($summary))
	{
		echo'<tbody>
			<tr>
				<td  style="vertical-align:top">'.$i++.'</td>
				<td  style="vertical-align:top"><a href="?index.php&page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='.$stock_summary['number'].'&vendor='.$stock_summary['vendorid'].'">'.$stock_summary['number'].'</a></td>
				<td  style="vertical-align:top">'.$stock_summary['materialcode'].'</td>
				<td  style="vertical-align:top">'.$stock_summary['name'].'</td>
				<td  style="vertical-align:top">'.$stock_summary['sum(quantity)'].'</td>';
			$ArrayItems = array("Select","Accept","Reject","Cancel","Consider later");
			echo '<td><div id="inspect'.$stock_summary['id'].'"><select name="inspection'.$stock_summary['id'].'" id="inspection'.$stock_summary['id'].'">';
			$j=0;
			foreach($ArrayItems as $ArrayItem)
			{
				if($stock_summary['inspection']==$j)
					echo '<option value="'.$j.'" selected>'.$ArrayItem.'</option>';
				else
					echo '<option value="'.$j.'">'.$ArrayItem.'</option>';
				$j++;
			}
			if(!$stock_summary['inspectionquantity'])
				$stock_summary['inspectionquantity']="";
			echo '</select></div></td>
			<td style="vertical-align:top"> <div id="inspectionqunt'.$stock_summary['id'].'"> <input type="text"  onkeypress="return isNumeric(event)" value="'.$stock_summary['inspectionquantity'].'" name="quantity'.$stock_summary['id'].'" id="quantity'.$stock_summary['id'].'"><input type="hidden" value="'.$stock_summary['id'].'" name="id'.$stock_summary['id'].'"></div></td>
			<td style="vertical-align:top"> <div id="stats'.$stock_summary['id'].'"> <input type="text" value="'.$stock_summary['status'].'" name="status'.$stock_summary['id'].'" id="status'.$stock_summary['id'].'"><input type="hidden" value="'.$stock_summary['id'].'" name="id'.$stock_summary['id'].'"></div></td>
			<td style="vertical-align:top"><a class="button button-green" id="buttons'.$stock_summary['id'].'" onclick="validation('.$stock_summary['id'].','.$stock_summary['sum(quantity)'].');" >Submit</a></td></tr>
		</tbody>';//
	}
?>
</table>
<?php }?>
<script>
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function UpdateStock(Id)
	{
		var Inspection = document.getElementById("inspection"+Id).value;
		var Status = document.getElementById("status"+Id).value;
		var Quantity = document.getElementById("quantity"+Id).value;
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
				var SplitRes = results.split("#");
				document.getElementById('inspect'+Id).innerHTML = SplitRes[0];
				document.getElementById('stats'+Id).innerHTML = SplitRes[1];
				document.getElementById('inspectionqunt'+Id).innerHTML = SplitRes[2];
				document.getElementById("buttons"+Id).style.display="none";
				document.getElementById("action").style.display="none";
				//document.getElementById('partculars').innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/InsertInspection.php?Inspection="+Inspection+"&Status="+Status+"&Id="+Id+"&Quantity="+Quantity+"&SessionId=<?php echo $_SESSION['id'];?>",true);
		xmlhttp.send();
	}
	function validation(Id,Quantity)
	{
		var message = "";
		if(document.getElementById("status"+Id).value=="")
			message = "Please enter Remarks";
		if(document.getElementById("quantity"+Id).value > Quantity)
			message = "Inspection Quantity should be lesser than or equal to Quantity";
		if(document.getElementById("quantity"+Id).value=="")
			message = "Please enter Quantity";
		if(document.getElementById("inspection"+Id).value==0)
			message = "Please select Status";
		
		/*if(document.getElementById("quantity"+Id).value > Quantity)
			message = "Inspection quantity should be lesser than or equal to quantity";
		if(document.getElementById("quantity"+Id).value=="")
			message = "Please enter quantity";
		if(document.getElementById("status"+Id).value=="")
			message = "Please enter status";*/
		
		if(message)
			alert(message);
		else
			UpdateStock(Id);
	}
</script>