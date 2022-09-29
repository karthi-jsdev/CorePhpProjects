<?php
include('Config.php');
$i=1;
?>
<form action="?index.php&page=Stores&subpage=spage->Stock_Management,ssubpage->Inspection_Summary" method="post">
<br/><br/><table class="paginate sortable full">
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
			<th align="left">Inspected By</th>
			<th align="left">Date and Time</th>
		</tr>
	</thead>
<?php date_default_timezone_set('Asia/Kolkata');
	$summary = Stock_InspectionSummary();
	while($stock_summary = mysqli_fetch_assoc($summary))
	{
		$FetchName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * from user where id='".$stock_summary['inspectedby']."'"));
		echo'<tbody>
			<tr>
				<td  style="vertical-align:top">'.$i++.'</td>
				<td  style="vertical-align:top"><a href="?index.php&page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='.$stock_summary['number'].'&vendor='.$stock_summary['vendorid'].'">'.$stock_summary['number'].'</a></td>
				<td  style="vertical-align:top">'.$stock_summary['materialcode'].'</td>
				<td  style="vertical-align:top">'.$stock_summary['name'].'</td>
				<td  style="vertical-align:top">'.$stock_summary['sum(quantity)'].'</td>';
			$ArrayItems = array("Select","Accept","Reject","Cancel","Consider later");
			echo '<td><div id="inspect'.$stock_summary['id'].'">';
			$j=0;
			foreach($ArrayItems as $ArrayItem)
			{
				if($stock_summary['inspection']==$j)
					echo $ArrayItem;	//echo '<option value="'.$j.'" selected>'.$ArrayItem.'</option>';
				//else
					//echo $ArrayItem;	//echo '<option value="'.$j.'">'.$ArrayItem.'</option>';
				$j++;
			}
			if(!$stock_summary['inspectionquantity'])
				$stock_summary['inspectionquantity']="";
			echo '</div></td>
				<td style="vertical-align:top">'.$stock_summary['inspectionquantity'].'</td>
				<td style="vertical-align:top">'.$stock_summary['status'].'</td>
				<td style="vertical-align:top">'.$FetchName['firstname'].'</td>
				<td style="vertical-align:top">'.date('d-m-Y h:i',strtotime($stock_summary['datetime'])).'</td>
			</tr>
		</tbody>';//
	}
?>
</table>
<script>
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
				alert(results);
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
</script>