<?php
session_start();
if($_SESSION['clientId'])
	$product = explode(',',$row1['product']);
$product1 = $row1['product'];
$cdate="";
foreach($product as $prod)
{
	$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id1']."' and enable='1')");
	while($fetchquery=mysql_fetch_array($query))
	{
		$read = mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And status_id ='".$_GET['id1']."' and enable='1' ");
		$readquery = mysql_fetch_array($read);
		if(date("m", strtotime($readquery['cdate'])) == $_GET['date'])
		{
			$cdate .= $cdate1 = $readquery['cdate'].',';
		}
	}
}
/*$cdate="";
if($_GET['date'] && $_GET['id1'])
{
	$read = mysql_query("Select * From comments WHERE status_id ='".$_GET['id1']."' and enable='1' ");
	while($readquery = mysql_fetch_array($read))
	{
		if(date("m", strtotime($readquery['cdate'])) == $_GET['date'])
		{
			$cdate = $cdate1 = $readquery['cdate'];
		}
	}
}*/
?>		
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
		<!--link rel="stylesheet" href="css/styles1.css"-->
		
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		
		<script>
			$(document).ready(function()
			{
				$("#start_date").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
			$(document).ready(function()
			{
				$("#end_date").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
			$(document).ready(function()
			{
				$("#follow_date").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
		</script>
<?php
	include("config.php");
	session_start();
	ini_set( "display_errors", "0" );
	include('includes/getsidestatus.php');
	$condition = "";
	foreach($product as $prod)
	{
		if(!$condition)
			$condition = "ptype='".$prod."'";
		else
			$condition .= "or ptype='".$prod."'";
	}		
	//For Pagination
	if(!$_GET['id'] && !$_GET['product'] && !$_GET['nostatus'] && !$_GET['product1'] && !$_GET['id1'])
		$sql4 = mysql_query("SELECT * FROM lead WHERE $condition ORDER BY ldate Desc");
	else if($_GET['nostatus'] == 'nos')
		$sql4 = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY ldate DESC");
	else if($_GET['product'])
		$sql4 = mysql_query("select * from lead where ptype='".$_GET['product']."' AND (ptclid IN(Select ptclid From comments WHERE (status_id != '8'  and enable=1)  AND (status_id != '7'  and enable=1))  OR ptclid NOT IN (SELECT ptclid FROM comments)) ORDER BY ldate Desc");
	else if($_GET['id'])
		$sql4 = mysql_query("SELECT * FROM lead WHERE ptclid in (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id']."' and enable='1') ORDER BY ldate Desc");
	else if($_GET['date'] && $_GET['id1'])
		$sql4 = mysql_query("SELECT * FROM lead WHERE ptclid in (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id1']."' and enable='1') ORDER BY ldate Desc");
	else if($_GET['nowork'])
	{
		$sql1_st = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE status='Closed/Won'"));
		$sql4 = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN(SELECT lead FROM work) AND ptclid IN(Select ptclid From comments Where status_id='".$sql1_st['slno']."' AND enable='1')");
	}
	else
		$sql4 = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product1']."' AND ptclid IN(Select ptclid From comments WHERE status_id = '".$_GET['status1']."' AND enable=1) ORDER BY ldate DESC");
		
	$rowsperpage = 15;
	$total_pages = round((mysql_num_rows($sql4) / $rowsperpage));
	if(!$_GET['pageno'])
		$_GET['pageno']=1;	
	if($_GET['pageno']>1)
		$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
	else
		$Limit = "LIMIT 0,".$rowsperpage;	
	
	if(!$_GET['id'] && !$_GET['product'] && !$_GET['nostatus'] && !$_GET['product1'] && !$_GET['id1'])
		$sql = mysql_query("SELECT * FROM lead WHERE $condition ORDER BY ldate Desc $Limit");
	else if($_GET['nostatus'] == 'nos')
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY ldate DESC $Limit");
	else if($_GET['product'])
		$sql = mysql_query("select * from lead where ptype='".$_GET['product']."' AND (ptclid IN(Select ptclid From comments WHERE (status_id != '8'  and enable=1)  AND (status_id != '7'  and enable=1))  OR ptclid NOT IN (SELECT ptclid FROM comments))  ORDER BY ldate Desc $Limit");
	else if($_GET['id'])
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid in (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id']."' and enable='1') ORDER BY ldate Desc $Limit");
	else if($_GET['date'] && $_GET['id1'])
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid in (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id1']."' and enable='1') ORDER BY ldate Desc $Limit");
	else if($_GET['nowork'])
	{
		$sql1_st = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE status='Closed/Won'"));
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN(SELECT lead FROM work) AND ptclid IN(Select ptclid From comments Where status_id='".$sql1_st['slno']."' AND enable='1') $Limit");
	}
	else
		$sql = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product1']."' AND ptclid IN(Select ptclid From comments WHERE status_id = '".$_GET['status1']."' AND enable=1) ORDER BY ldate DESC $Limit");
		//For Product
		if($_GET['product'])
			$product2 = $_GET['product'];
		else if($_GET['product1'])
			$product2 = $_GET['product1'];
		if($_GET['id'])
			$id = $_GET['id'];
		else if($_GET['id1'])
			$id = $_GET['id1'];
		$getProduct = mysql_fetch_array(mysql_query("select * from producttype where slno='".$product2."'"));
		//For Status
		$row_status =mysql_fetch_array(mysql_query("select * from comments where status_id='".$id."'"));
		$row2=mysql_fetch_array(mysql_query("select * from status where slno='".$row_status['status_id']."'"));
			echo '<div style="float:left;margin-top:-590px;margin-left:150px;width:800px;height:150px;">';
			if(mysql_num_rows($sql))
			{
				if($_GET['nostatus'] == 'nos')
					echo "<table id='sub1'><tr><td><h1>Lead Summary  of No Status</h1></td></tr></table>";
				else if($_GET['product'])	
					echo "<table id='sub1'><tr><td><h1>Lead Summary  of ".$getProduct['type']."</h1></td></tr></table>";
				else if($_GET['id'] || $_GET['id1'])
					echo "<table id='sub1'><tr><td><h1>Lead Summary  of ".$row2['status']."</h1></td></tr></table>";
				else if($_GET['assignee'])
					echo "<table id='sub1'><tr><td><h1>Lead Summary  of ".$query1['name']." And Closed Leads</h1></td></tr></table>";
				else if($_GET['nowork'])
					echo "<table id='sub1'><tr><td><h1>Lead Summary  of No Work And Closed Leads</h1></td></tr></table>";
				else
				    echo "<table id='sub1'><tr><td><h1>Lead Summary  of All Status</h1></td></tr></table>";
				echo "<div style='width:1010px;height:550px;overflow-x:hidden;overflow-y:auto;'>";
				echo "<table  border='1'  align='left' class='paginate sortable full' id='sub' width='2000px'>
					<tr>
						<th align=''>Lead-ID</th>
						<!--th align='left'>Client-ID</th-->
						<th align=''>Company Name</th>
						<th align=''>Lead Description</th>
						<th align=''>Lead Date</th>
						<th align=''>Product Type</th>
						<!--th align='left'>Product Sub Type</th-->
						<th align=''>Assign</th>
						<th align=''>Status</th>";
				echo	"</tr>";
				if(!$_GET['assignee'] && !$_GET['id'] && !$_GET['id1'] && !$_GET['nowork'])
				{
					while($row = mysql_fetch_array($sql))
					{
						echo "<tr>
						<td align='center'><a href='?page=leadstatus&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$product1."' style='text-decoration:none;'>".$row['ptclid']."</td>";
						$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
						//echo	"<td>".$query['ptcid']."</td>
						echo	"<td align='center' style='width:150px'>".$query['cname']."</td>";
						$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
						$var = $lead['ldesc'];
						$newtext = wordwrap($var,50, "\n",true);
						echo	"<td style='width:150px'>".$newtext."</td>";
						echo	"<td  align='center'>".$lead['ldate']."</td>";
						$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
						$row1 = mysql_fetch_array($query1);
						echo	"<td  align='center'>".$row1['type']."</td>";
						$query3 = mysql_query("SELECT * FROM assignee  where slno='".$lead['assign']."'");
						$row3=mysql_fetch_array($query3);
						echo	"<td  align='center'>".$row3['name']."</td>";
						$status = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$row['ptclid']."' And enable=1"));
						$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status['status_id']."'"));
						if($status_id)
							echo "<td  align='center'>".$status_id['status']."</td>";
						else
							echo "<td  align='center'>Open</td>";
						if($_GET['id1'])
						{
							$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid IN ()"));
						}
							
						echo 	"</tr>";	
					}	
				}
				else if($_GET['id1'])
				{
					$cdate1 = explode(',',$cdate);
					foreach($cdate1 as $cdate2)
					{
						$sql2 = mysql_query("SELECT * FROM lead WHERE ptclid in (SELECT ptclid FROM comments WHERE status_id='".$_GET['id1']."' AND cdate='".$cdate2."' AND enable=1) ORDER BY ldate Desc $Limit");
						while($row = mysql_fetch_array($sql2))
						{
							echo "<tr>
							<td align='center'><a href='?page=leadstatus&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$product1."' style='text-decoration:none;'>".$row['ptclid']."</td>";
							$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
							//echo	"<td>".$query['ptcid']."</td>
							echo	"<td align='center' style='width:150px'>".$query['cname']."</td>";
							$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
							$var = $lead['ldesc'];
							$newtext = wordwrap($var,50, "\n",true);
							echo	"<td style='width:150px'>".$newtext."</td>";
							echo	"<td  align='center'>".$lead['ldate']."</td>";
							$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
							$row1 = mysql_fetch_array($query1);
							echo	"<td  align='center'>".$row1['type']."</td>";
							$query3 = mysql_query("SELECT * FROM assignee  where slno='".$lead['assign']."'");
							$row3=mysql_fetch_array($query3);
							echo	"<td  align='center'>".$row3['name']."</td>";
							$status = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$row['ptclid']."' And enable=1"));
							$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status['status_id']."'"));
							if($status_id)
								echo "<td  align='center'>".$status_id['status']."</td>";
							else
								echo "<td  align='center'>Open</td>";
								
							echo 	"</tr>";	
							}	
					}	
				}
				else
				{
					foreach($product as $prod)	
					{
						if($_GET['id'] && !$_GET['date'])
							$sql1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid in (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id']."' and enable='1') ORDER BY ldate Desc $Limit");
						else if($_GET['nowork'])
						{
							$sql1_st = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE status='Closed/Won'"));
							$sql1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid NOT IN(SELECT lead FROM Work) AND ptclid IN(Select ptclid From comments Where status_id='".$sql1_st['slno']."' AND enable='1')");
						}
						else 
							$sql1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND assign='".$_GET['assignee']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY ldate Desc $Limit");
						while($row = mysql_fetch_array($sql1))
						{
							echo "<tr>
							<td align='center'><a href='?page=leadstatus&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$product1."' style='text-decoration:none;'>".$row['ptclid']."</td>";
							$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
							//echo	"<td>".$query['ptcid']."</td>
							echo	"<td align='center' style='width:150px'>".$query['cname']."</td>";
							$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
							$var = $lead['ldesc'];
							$newtext = wordwrap($var,50, "\n",true);
							echo "<td style='width:150px'>".$newtext."</td>
							<td  align='center'>".$lead['ldate']."</td>";
							$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
							$row1 = mysql_fetch_array($query1);
							echo	"<td  align='center'>".$row1['type']."</td>";
							$query3 = mysql_query("SELECT * FROM assignee  where slno='".$lead['assign']."'");
							$row3=mysql_fetch_array($query3);
							echo	"<td  align='center'>".$row3['name']."</td>";
							$status = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$row['ptclid']."' And enable=1"));
							$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status['status_id']."'"));
							if($status_id)
								echo "<td  align='center'>".$status_id['status']."</td>";
							else
								echo "<td  align='center'>Open</td>";
							echo "</tr>";	
						}	
					}
				}
				echo "</table></div>";
				echo '<div style="float:left;margin-top:45x;margin-left:400px;width:200px;height:0px" id="page">';
					include("includes/pagination.php");
				echo '</div></div>';
				
		echo '<div style="float:left;margin-top:-0px;margin-left:-220px;width:1300px;height:1250px">';
		echo 	'<h1><center>Filter</center></h1><table  border="1"  align="left" class="paginate sortable full1" width="1500px";>
	
			<tr>
			<td>Client:<select id="client">
			<option value="all">All</option>';
			$query_client = mysql_query("Select * From client");
			while($row_client = mysql_fetch_array($query_client))
			{
				echo '<option value="'.$row_client['ptcid'].'">'.$row_client['cname']."-".$row_client['ptcid'].'</option>';
			}
		echo '</select><td>Assignee:<select id="assign">
				<option value="all">All</option>';
				$query_assignee = mysql_query("SELECT * FROM assignee");
				while($assignee = mysql_fetch_array($query_assignee))
				{
					echo '<option value="'.$assignee['slno'].'">'.$assignee['name'].'</option>';
				}
		echo	'</select></td>';
	
			echo	'<td>Status:<select id="status">
				<option value="all">All</option>';
				$query_status = mysql_query("SELECT * FROM status");
				while($status = mysql_fetch_array($query_status))
				{
					echo '<option value="'.$status['slno'].'">'.$status['status'].'</option>';
				}
				echo '<option value="nostatus">No Status</option>';
		echo	'</select></td>';
		echo 	'<td>Product:<select id="product" onchange="product_change(this.value)">
				<option value="all">All</option>';
				foreach($product as $prod )
				{
					$query_product = mysql_query("SELECT * FROM producttype WHERE slno='".$prod."'");
					while($row_product = mysql_fetch_array($query_product))
					{
						echo '<option value="'.$row_product['slno'].'">'.$row_product['type'].'</option>';
					}
				}
		echo	'</select></td>';
		echo 	'<td >Sub-Product:
				<select id="subproduct">
					<option value="all">All</option>';
		echo	'</select></td>';
		echo '<td>Start Date:<input type="text" name="start_date" id="start_date" style="width:75px"></td><td>
					End Date:<input type="text" name="end_date" id="end_date" style="width:75px"></td>
					<td>Follow up-date:<input type="text" name="follow_date" id="follow_date" style="width:75px">
					<input type="hidden" id="prod1" value="'.$product1.'"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td></tr><br />';
			echo "<tr><td><br /><button onclick ='loadXMLDoc2()'>Search</button></td></tr></table>";		
	echo	'</div >';	
			}
			else
			{
				echo '<div style="float:left;margin-top:0px;margin-left:0px;width:800px;">';
						echo "<table id='sub1'></table>";
					echo "<div style='width:1010px;height:500px;overflow-x:hidden;overflow-y:auto;'>";						
						echo "<table  border='1'  align='left' class='paginate sortable full' id='sub'>
						<tr><td></td><td>";
						echo "No Leads Found</td></tr>
						</table></div>";
						
		echo 	'<h1><center>Filter</center></h1><table  border="1"  align="left" class="paginate sortable full1">
	
			<tr>
			<td>Client:<select id="client">
			<option value="all">All</option>';
			$query_client = mysql_query("Select * From client");
			while($row_client = mysql_fetch_array($query_client))
			{
				echo '<option value="'.$row_client['ptcid'].'">'.$row_client['ptcid']."-".$row_client['cname'].'</option>';
			}
		echo '</select><td>Assignee:<select id="assign">
				<option value="all">All</option>';
				$query_assignee = mysql_query("SELECT * FROM assignee");
				while($assignee = mysql_fetch_array($query_assignee))
				{
					echo '<option value="'.$assignee['slno'].'">'.$assignee['name'].'</option>';
				}
		echo	'</select></td>';
	
			echo	'<td>Status:<select id="status">
				<option value="all">All</option>';
				$query_status = mysql_query("SELECT * FROM status");
				while($status = mysql_fetch_array($query_status))
				{
					echo '<option value="'.$status['slno'].'">'.$status['status'].'</option>';
				}
				echo '<option value="nostatus">No Status</option>';
		echo	'</select></td>';
		echo 	'<td>Product:<select id="product" onchange="product_change(this.value)">
				<option value="all">All</option>';
				foreach($product as $prod )
				{
					$query_product = mysql_query("SELECT * FROM producttype WHERE slno='".$prod."'");
					while($row_product = mysql_fetch_array($query_product))
					{
						echo '<option value="'.$row_product['slno'].'">'.$row_product['type'].'</option>';
					}
				}
		echo	'</select></td>';
		echo 	'<td >Sub-Product:
				<select id="subproduct">
					<option value="all">All</option>';
		echo	'</select></td>';
		echo '<td>Start Date:<input type="text" name="start_date" id="start_date" style="width:75px"></td><td>
					End Date:<input type="text" name="end_date" id="end_date" style="width:75px"></td>
					<td>Follow up-date:<input type="text" name="follow_date" id="follow_date" style="width:75px">
					<input type="hidden" id="prod1" value="'.$product1.'"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td><td style="width=500px"></td></tr><br />';
			echo "<tr><td><br /><button onclick ='loadXMLDoc2()'>Search</button></td></tr></table>";		
	echo	'</div >';	
			}
			
?>
<script>
	function loadXMLDoc(url)
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
				var split_table = results.split('#');
				document.getElementById('sub1').innerHTML = split_table[0];
				document.getElementById('sub').innerHTML = split_table[1];
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	function loadXMLDoc2()
	{	
		var product1 = document.getElementById('prod1').value;
		var assign = document.getElementById('assign').value;
		var status = document.getElementById('status').value;
		var product = document.getElementById('product').value;
		var subproduct = document.getElementById('subproduct').value;
		var startdate = document.getElementById('start_date').value;
		var enddate = document.getElementById('end_date').value;
		var followdate = document.getElementById('follow_date').value;
		var client = document.getElementById('client').value;
		var url = "includes/getsearch.php?client="+client+"&assign="+assign+"&status="+status+"&product="+product+"&subproduct="+subproduct+"&startdate="+startdate+"&enddate="+enddate+"&followdate="+followdate+"&product1="+product1;
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
				var split_table = results.split('#');
				document.getElementById('sub1').innerHTML = split_table[0];
				document.getElementById('sub').innerHTML = split_table[1];
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	
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
			var select = document.getElementById('subproduct');
			select.options.length = 0; 	//For remove all options of dropdown list
			
			for(var i = 0; i < values.length; i++)
			{
				if(i%2 == 0)
					select.options[select.options.length] = new Option(values[i],values[i+1]);
			}
		}
	}
	xmlhttp.open("GET","includes/getsub3.php?q="+str,true);
	xmlhttp.send();
}
</script>