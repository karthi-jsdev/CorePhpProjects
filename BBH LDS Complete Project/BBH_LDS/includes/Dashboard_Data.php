<?php
	include("Config.php");
	include("Dashboard_Queries.php");
	ini_set("display_errors","0");
	if($_GET['PaginationFor'] == 'presentleave')
	{
		$Num_Of_Present = mysql_fetch_array(Present_Select_Count_All());
			if(!$Num_Of_Present['total'])
				echo "<tr><td colspan='3'><font color='red'><ccenter> No Data Found </center></font></td></tr>";
			$Limit = 5;
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$Start = ($_GET['pageno']-1)*Limit;
			if($_GET['pageno']>=2)
				$i = $Start+1;
			else
				$i = 1;
			$ResourceUpdate = Present_Select_ByLimit($Start, $Limit);	
			while($Department_Number = mysql_fetch_array($ResourceUpdate))
			{
			echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$Department_Number['departmentname'].'</td>
			<td>'.$Department_Number['departmentnum'].'</td>
			</tr>';
			}
	}
	else if($_GET['PaginationFor']=='futureleave')
	{
		$Num_Of_Future = mysql_fetch_array(Future_Select_Count_All());
		if(!$Num_Of_Future['total'])
			echo "<tr><td colspan='3'><font color='red'><ccenter> No Data Found </center></font></td></tr>";
		$Limit = 5;
		if(!$_GET['pageno'])
			$_GET['pageno'] = 1;
		$Start = ($_GET['pageno']-1)*Limit;
		if($_GET['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		$ResourceUpdate = Future_Select_ByLimit($Start, $Limit);	
		while($Department_Number = mysql_fetch_array($ResourceUpdate))
		{
		echo '<tr>
		<td>'.$i++.'</td>
		<td>'.$Department_Number['departmentname'].'</td>
		<td>'.$Department_Number['departmentnum'].'</td>
		</tr>';
		}
	}
	else if($_GET['PaginationFor']=='pastleave')
	{
	$Num_Of_Past = mysql_fetch_array(Past_Select_Count_All());
	if(!$Num_Of_Past['total'])
		echo "<tr><td colspan='3'><font color='red'><ccenter> No Data Found </center></font></td></tr>";
	$Limit = 5;
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$Start = ($_GET['pageno']-1)*Limit;
	if($_GET['pageno']>=2)
		$i = $Start+1;
	else
		$i = 1;
	$ResourceUpdate = Past_Select_ByLimit($Start, $Limit);	
	while($Department_Number = mysql_fetch_array($ResourceUpdate))
	{
	echo '<tr>
	<td>'.$i++.'</td>
	<td>'.$Department_Number['departmentname'].'</td>
	<td>'.$Department_Number['departmentnum'].'</td>
	</tr>';
	}
	}
	else if($_GET['PaginationFor']=='consultantpresentleave')
	{
		$Num_Of_presentconsultant = mysql_fetch_array(Consultantpresentleave_Select_Count_All());
		if(!$Num_Of_presentconsultant['total'])
			echo "<tr><td colspan='7'><font color='red'><center> No Data Found </center></font></td></tr>";
		$Limit = 5;
		if(!$_GET['pageno'])
			$_GET['pageno'] = 1;
		$Start = ($_GET['pageno']-1)*Limit;
		if($_GET['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		$ConsultantpresentleaveUpdate = Consultantpresentleave_Select_ByLimit($Start, $Limit);	
		while($Consultantpresentleaveapply = mysql_fetch_array($ConsultantpresentleaveUpdate))
		{
			echo '<tr>
			<td>'.$i++.'</td>';
			echo "<td id='imageid".$i."' onmouseover='Displayimage(".$i.");' onmouseout='Hideimage(".$i.");' style='vertical-align:middle'>".$Consultantpresentleaveapply['title'].".".$Consultantpresentleaveapply['Name']."<div id='img".$i."' style='display:none'><img src='data:image/jpeg;base64,".base64_encode($Consultantpresentleaveapply['photo'])."' width='100px' height='150px' alt='photo'/></div></td>";
					//echo "<td style='vertical-align:middle'>".$Consultantpresentleaveapply['title'].".".$Consultantpresentleaveapply['Name']."</td>";
					echo "<td style='vertical-align:middle'>".$Consultantpresentleaveapply['groupName']."</td>";
					echo "<td style='vertical-align:middle'>".$Consultantpresentleaveapply['departmentName']."</td>";
					echo "<td style='vertical-align:middle'>".$Consultantpresentleaveapply['comments']."</td>";
					echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Consultantpresentleaveapply['startdate']))."</td>";
					echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Consultantpresentleaveapply['enddate']))."</td>";
			echo '</tr>';
		}
	}
	else if($_GET['PaginationFor']=='consultantfutureleave')
	{
		$Num_Of_futureconsultant = mysql_fetch_array(Consultantfutureleave_Select_Count_All());
		if(!$Num_Of_futureconsultant['total'])
			echo "<tr><td colspan='7'><font color='red'><center> No Data Found </center></font></td></tr>";
		$Limit = 5;
		if(!$_GET['pageno'])
			$_GET['pageno'] = 1;
		$Start = ($_GET['pageno']-1)*Limit;
		if($_GET['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		$ConsultantfutureleaveUpdate = Consultantfutureleave_Select_ByLimit($Start, $Limit);	
		while($Consultantfutureleaveapply = mysql_fetch_array($ConsultantfutureleaveUpdate))
		{
			echo '<tr>
			<td>'.$i++.'</td>';
			echo "<td id='imageid".$i."' onmouseover='Displayimage(".$i.");' onmouseout='Hideimage(".$i.");' style='vertical-align:middle'>".$Consultantfutureleaveapply['title'].".".$Consultantfutureleaveapply['Name']."<div id='img".$i."' style='display:none'><img src='data:image/jpeg;base64,".base64_encode($Consultantfutureleaveapply['photo'])."' width='100px' height='150px' alt='photo'/></div></td>";
				echo "<td style='vertical-align:middle'>".$Consultantfutureleaveapply['groupName']."</td>";
				echo "<td style='vertical-align:middle'>".$Consultantfutureleaveapply['departmentName']."</td>";
				echo "<td style='vertical-align:middle'>".$Consultantfutureleaveapply['comments']."</td>";
				echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Consultantfutureleaveapply['startdate']))."</td>";
				echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Consultantfutureleaveapply['enddate']))."</td>";
			echo'</tr>';
		}
	}
	else if($_GET['PaginationFor']=='consultantpastleave')
	{
		$Num_Of_pastconsultant = mysql_fetch_array(Consultantpastleave_Select_Count_All());
		if(!$Num_Of_pastconsultant['total'])
			echo "<tr><td colspan='7'><font color='red'><center> No Data Found </center></font></td></tr>";
		$Limit = 5;
		if(!$_GET['pageno'])
			$_GET['pageno'] = 1;
		$Start = ($_GET['pageno']-1)*Limit;
		if($_GET['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		$ConsultantpastleaveUpdate = Consultantpastleave_Select_ByLimit($Start, $Limit);	
		while($Consultantpastleaveapply = mysql_fetch_array($ConsultantpastleaveUpdate))
		{
			echo '<tr>
			<td>'.$i++.'</td>';
			echo "<td id='imageid".$i."' onmouseover='Displayimage(".$i.");' onmouseout='Hideimage(".$i.");' style='vertical-align:middle'>".$Consultantpastleaveapply['title'].".".$Consultantpastleaveapply['Name']."<div id='img".$i."' style='display:none'><img src='data:image/jpeg;base64,".base64_encode($Consultantpastleaveapply['photo'])."' width='100px' height='150px' alt='photo'/></div></td>";
					echo "<td style='vertical-align:middle'>".$Consultantpastleaveapply['groupName']."</td>";
					echo "<td style='vertical-align:middle'>".$Consultantpastleaveapply['departmentName']."</td>";
					echo "<td style='vertical-align:middle'>".$Consultantpastleaveapply['comments']."</td>";
					echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Consultantpastleaveapply['startdate']))."</td>";
					echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Consultantpastleaveapply['enddate']))."</td>";
			echo'</tr>';
		}
	}
	echo "$";
	if($_GET['total_pages'] > 5)
		include("Ajax_Pagination.php");
?>