<?php
	include("Config.php");
	include("Dashboard_Queries.php");
	ini_set("display_errors","0");
	if($_POST['PaginationFor'] == 'Thisyearcollection')
	{
		$Num_Of_Thisyear = mysql_fetch_array(Class_Select_Count_All());
		$Limit = 5;
		$_POST['total_pages'] = ceil($Num_Of_Thisyear['total'] / $Limit);
		if(!$_POST['pageno'])
			$_POST['pageno'] = 1;
		$Start = ($_POST['pageno']-1)*$Limit;
		if($_POST['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		if(!$Num_Of_Thisyear['total'])
			echo "<tr><td colspan='3'><font color='red'><ccenter> No Data Found </center></font></td></tr>";
		else
			$Thisyear = Thisyearcollected_Select_ByLimit($Start, $Limit);	
		while($Thisyearcollection = mysql_fetch_array($Thisyear))
		{
			echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$Thisyearcollection['classname'].  '&' .$Thisyearcollection['sname'].'</td>
			<td>'.$Thisyearcollection['paidamount'].'</td>
			</tr>';
		}
	}
	if($_POST['PaginationFor'] == 'Thismonthcollection')
	{
		$Num_Of_Thisyear = mysql_fetch_array(Class_Select_Count_All());
		$Limit = 5;
		$_POST['total_pages'] = ceil($Num_Of_Thisyear['total'] / $Limit);
		if(!$_POST['pageno'])
			$_POST['pageno'] = 1;
		$Start = ($_POST['pageno']-1)*$Limit;
		if($_POST['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		if(!$Num_Of_Thisyear['total'])
			echo "<tr><td colspan='3'><font color='red'><ccenter> No Data Found </center></font></td></tr>";
		else
			$Thismonth = Thismonthcollected_Select_ByLimit($Start, $Limit);	
		while($Thismonthcollection = mysql_fetch_array($Thismonth))
		{
			echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$Thismonthcollection['classname'].  '&' .$Thismonthcollection['sname'].'</td>
			<td>'.$Thismonthcollection['paidamount'].'</td>
			</tr>';
		}
	}
	if($_POST['PaginationFor'] == 'Thisyearpending')
	{
		$Alllasssection = "";
		$Allsections = "";
		$class_section = Class_Select_Based_Section();
		while($classsection = mysql_fetch_assoc($class_section))
		{
			if(!$Alllasssection)
				$Alllasssection = $classsection['classids'];
			else
				$Alllasssection .= ",".$classsection['classids'];
		}
		$Alllasssection = "class.id=".implode(" || class.id=", array_unique(explode(",", $Alllasssection)));
		
		$sections = mysql_query("SELECT *,section.id as sid FROM section JOIN class on class.id=section.classid WHERE $Alllasssection");
		while($section =  mysql_fetch_Assoc($sections))
		{
			if(!$Allsections)
				$Allsections = $section['sid'];
			else
				$Allsections .= ",".$section['sid'];
		}
		$Allsections = "section.id=".implode(" || section.id=", array_unique(explode(",", $Allsections)));
		$Thisyear = mysql_Fetch_Assoc(mysql_query("SELECT class.id as cid,section.name as sname,class.name as classname,section.id as sid,student_admission.id as studentid FROM section
													JOIN class on class.id=section.classid
													JOIN student_admission on student_admission.section_id=section.id 
													WHERE EXTRACT(YEAR FROM CURDATE()) && ($Allsections) group by section.id"));
		$yearpending = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM section WHERE ($Allsections)"));
		$Limit = 5;
		$_POST['total_pages'] = ceil($yearpending['total'] / $Limit);
		if(!$_POST['pageno'])
			$_POST['pageno'] = 1;
		$Start = ($_POST['pageno']-1)*$Limit;
		if($_POST['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		if($yearpending['total']==0)
			echo "<tr><td colspan='3'><font color='red'><center> No Data Found </center></font></td></tr>";
		else
		{
			$amtpending = mysql_query("SELECT sum(amount)as amount,section.name as sname,class.name as classname,section.id as sid FROM section JOIN class ON section.classid=class.id 
															JOIN student_admission on student_admission.section_id=section.id 
															JOIN fees_category_assign ON FIND_IN_SET(".$Thisyear['cid'].",classids)
															WHERE ($Allsections) && EXTRACT(YEAR FROM CURDATE()) && student_admission.id NOT IN(SELECT student_id from payment_log WHERE $Allsections) 
															group by section.id LIMIT $Start,$Limit");
			while($Thisyearcollection = mysql_fetch_array($amtpending))
			{
				echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$Thisyearcollection['classname'].'&' .$Thisyearcollection['sname'].'</td>
						<td>'.$Thisyearcollection['amount'].'</td>
					</tr>';
			}
		}
	}
	if($_POST['PaginationFor'] == 'Thismonthpending')
	{
		$AllMonths="";
		$Alllasssection = "";
		$Allsections = "";
		$month_class = mysql_query("SELECT * FROM fees_category_assign WHERE monthids = EXTRACT(MONTH FROM CURDATE())-4 and YEAR(NOW())=EXTRACT(YEAR FROM CURDATE())");
		while($monthclass = mysql_fetch_assoc($month_class))
		{
			if(!$AllMonths)
				$AllMonths = $monthclass['monthids'];
			else
				$AllMonths .= ",".$monthclass['monthids'];
		}
		$CurrentMonth = date("m")-4;
		if(in_array($CurrentMonth, explode(",", $AllMonths)))
			$AllMonths = "monthids=".implode(" || monthids=", explode(",",$CurrentMonth));
		
		$class_section = mysql_query("SELECT * FROM fees_category_assign WHERE $AllMonths");
		while($classsection = mysql_fetch_assoc($class_section))
		{
			if(!$Alllasssection)
				$Alllasssection = $classsection['classids'];
			else
				$Alllasssection .= ",".$classsection['classids'];
		}
		$Alllasssection = "class.id=".implode(" || class.id=", array_unique(explode(",", $Alllasssection)));
		
		$sections = mysql_query("SELECT *,section.id as sid FROM section JOIN class on class.id=section.classid WHERE $Alllasssection");
		while($section =  mysql_fetch_Assoc($sections))
		{
			if(!$Allsections)
				$Allsections = $section['sid'];
			else
				$Allsections .= ",".$section['sid'];
		}
		$Allsections = "section.id=".implode(" || section.id=", array_unique(explode(",", $Allsections)));
		$Thismonth = mysql_Fetch_Array(mysql_query("SELECT class.id as cid,section.name as sname,class.name as classname,section.id as sid,student_admission.id as studentid FROM section
												JOIN class on class.id=section.classid
												JOIN student_admission on student_admission.section_id=section.id 
												WHERE EXTRACT(MONTH FROM CURDATE())-4 and YEAR(NOW())=EXTRACT(YEAR FROM CURDATE()) && ($Allsections) group by section.id"));
		$monthpending = mysql_Fetch_Array(mysql_query("SELECT count(*) as total FROM section WHERE ($Allsections)"));
		$Limit = 5;
		$_POST['total_pages'] = ceil($monthpending['total'] / $Limit);
		if(!$_POST['pageno'])
			$_POST['pageno'] = 1;
		$Start = ($_POST['pageno']-1)*$Limit;
		if($_POST['pageno']>=2)
			$i = $Start+1;
		else
			$i = 1;
		if($monthpending['total']==0)
			echo "<tr><td colspan='5'><font color='red'><center> No Data Found </center></font></td></tr>";
		else
		{
			$amtpending = mysql_query("SELECT sum(amount)as amount,section.name as sname,class.name as classname,section.id as sid FROM section JOIN class ON section.classid=class.id 
															JOIN student_admission on student_admission.section_id=section.id 
															JOIN fees_category_assign ON FIND_IN_SET(".$Thismonth['cid'].",classids)
															WHERE EXTRACT(MONTH FROM CURDATE())-4 and YEAR(NOW())=EXTRACT(YEAR FROM CURDATE()) && ($Allsections) && student_admission.id NOT IN(SELECT student_id from payment_log WHERE $Allsections) 
															group by section.id LIMIT $Start,$Limit");
			while($balamt = mysql_fetch_array($amtpending))
			{
				echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$balamt['classname'].'&' .$balamt['sname'].'</td>
						<td>'.$balamt['amount'].'</td>
					</tr>';
			}
		}
	}
	echo "$";
	if($_POST['total_pages'] > 1)
		include("Ajax_Pagination.php");
?>