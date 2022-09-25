<?php
	
	function Class_List()
	{
		return mysql_query("SELECT section.name as sname,class.name as classname,section.id as sectionid FROM class join section on class.id = section.classid");
	}

	//Reports ALL Student_Information
	function Student_Select_Count_All()
	{
		return mysql_query("SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
	}
	function Student_Select_ByLimit($Start,$Limit)
	{
		if($Limit)
			$SQL_Limit = "Limit $Start,$Limit";
		return mysql_query("SELECT class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no,student_admission.residenceaddress,student_admission.contact_person FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id $SQL_Limit");
	}
	
	//Reports Class Student_Information
	function Student_Count_ByClass()
	{
		if($_POST['sectionid'] == '')
			return mysql_query("SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
		else	
			return mysql_query("SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE student_admission.section_id='".$_POST['sectionid']."'");
	}
	function Student_Select_ByClass()
	{
		if($_POST['sectionid'] == '')
			return mysql_query("SELECT class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no,student_admission.residenceaddress,student_admission.contact_person  FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id ");
		else	
			return mysql_query("SELECT class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no,student_admission.residenceaddress,student_admission.contact_person  FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE student_admission.section_id='".$_POST['sectionid']."'");
	}
	
	
	//Payment Information
	function Payment_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(DISTINCT(student_admission.id)) as total FROM payment_log JOIN student_admission on student_admission.id = payment_log.student_id order by datetime desc");
	}
	function Payment_Select_ByLimit()
	{
		return mysql_query("SELECT SUM(payment_log.scholarshipamount) as scholarshipamount,SUM(paidamount) as paidamount,student_admission.fees_catagoryids,student_admission.id,student_admission.contact_person,student_admission.contact_no,class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.section_id,student_admission.father_name,payment_log.finepaid,sum(payment_log.fineamount) as fineamount,payment_log.month_id,payment_log.datetime,student_admission.gender FROM payment_log 
		JOIN student_admission on student_admission.id = payment_log.student_id 
		JOIN section on payment_log.section_id = section.id
		JOIN class on class.id = section.classid
		group by payment_log.student_id
		");
	}
	function Payment_Select_Count_byclass()
	{
		if($_POST['sectionid'] == '')
		{
			return mysql_query("SELECT COUNT(DISTINCT(student_admission.id)) as total FROM payment_log JOIN student_admission on student_admission.id = payment_log.student_id 
			JOIN section on student_admission.section_id = section.id
			order by datetime desc");
		}
		else 
		{
			return mysql_query("SELECT COUNT(DISTINCT(student_admission.id)) as total FROM payment_log JOIN student_admission on student_admission.id = payment_log.student_id 
			JOIN section on student_admission.section_id =section.id where payment_log.section_id='".$_POST['sectionid']."'
			order by datetime desc");
		}
	}
	function Payment_Select_ByclassLimit()
	{
		if($_POST['sectionid'] == '')
		{
			return mysql_query("SELECT SUM(payment_log.scholarshipamount) as scholarshipamount,SUM(paidamount) as paidamount,student_admission.fees_catagoryids,student_admission.id,student_admission.contact_person,student_admission.contact_no,class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.section_id,student_admission.father_name,payment_log.finepaid,sum(payment_log.fineamount) as fineamount,payment_log.month_id,payment_log.datetime,student_admission.gender FROM payment_log 
		JOIN student_admission on student_admission.id = payment_log.student_id 
		JOIN section on payment_log.section_id = section.id
		JOIN class on class.id = section.classid
		group by payment_log.student_id");
		}
		else 
		{
			return mysql_query("SELECT SUM(payment_log.scholarshipamount) as scholarshipamount,SUM(paidamount) as paidamount,student_admission.fees_catagoryids,student_admission.id,student_admission.contact_person,student_admission.contact_no,class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.section_id,student_admission.father_name,payment_log.finepaid,sum(payment_log.fineamount) as fineamount,payment_log.month_id,payment_log.datetime,student_admission.gender FROM payment_log 
		JOIN student_admission on student_admission.id = payment_log.student_id 
		JOIN section on payment_log.section_id = section.id
		JOIN class on class.id = section.classid where  payment_log.section_id = '".$_POST['sectionid']."'
		group by payment_log.student_id");
		}
	}
	
	function Feescategory_List()
	{
		return mysql_query("SELECT * FROM fees_catagory order by id asc");
	}
	
	
	
	
	
	//PayementCollectionInformation
	function Paymentcollection_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(DISTINCT(payment_log.section_id)) as total FROM payment_log");
	}
	function Paymentcollection_Select_ByLimit()
	{
		return mysql_query("SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
		JOIN class on class.id = section.classid
		JOIN student_admission on student_admission.id = payment_log.student_id
		LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
		GROUP BY section.id");
	}
	
	function Paymentcollection_Select_Count_byclass()
	{
		if(($_POST['sectionid'] == '' && $_POST['feescategoryid'] == '') && ($_POST['startdate'] && $_POST['enddate']))
		{
			return mysql_query("SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log WHERE datetime  between '".date('Y-m-d',strtotime($_POST['startdate']))."'  and  '".date('Y-m-d',strtotime($_POST['enddate']))."' group by payment_log.section_id order by datetime desc");
		}
		else if($_POST['feescategoryid'] && $_POST['sectionid'])
		{
			$Query = "where ";
			if(isset($_POST['sectionid']))
				$Query .= "section_id = '".$_POST['sectionid']."' and ";
			if(isset($_POST['feescategoryid']))
				$Query .= "feescategory_id = '".$_POST['feescategoryid']."' and ";	
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
				$Query .= " datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."' ";
			return mysql_query("SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log ".str_replace("= ''", "!= ''", $Query."  group by payment_log.section_id 
			order by datetime desc"));
		}
		 else if($_POST['feescategoryid'])
		{
			$Query = "";
			if(isset($_POST['feescategoryid']))
			{
				$Feescategoryid = mysql_query("SELECT fees_category_assign.id FROM  fees_category_assign  join fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.feescategoryid ='".$_POST['feescategoryid']."'");
				while($Feescategoryassignid = mysql_fetch_array($Feescategoryid))
				{
					if($Query == "")
						$Query .= "feescategory_id = '".$Feescategoryassignid['id']."'";
					else
						$Query .= " || feescategory_id = '".$Feescategoryassignid['id']."'";
				}
			}
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
			{
				$Query = "($Query) && datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."'";
			}
			return mysql_query("SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log ".str_replace("= ''", "!= ''", "WHERE ".$Query." group by payment_log.section_id 
			order by datetime desc"));
		} 
		else if($_POST['sectionid'])
		{
			$Query = "where ";
			if(isset($_POST['sectionid']))
				$Query .= "section_id = '".$_POST['sectionid']."' and ";
			if(isset($_POST['feescategoryid']))
				$Query .= "feescategory_id = '".$_POST['feescategoryid']."' and ";	
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
				$Query .= " datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."' ";
			return mysql_query("SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log ".str_replace("= ''", "!= ''", $Query."  group by payment_log.section_id 
			order by datetime desc"));
		}
	}
	function Paymentcollection_Select_ByclassLimit()
	{
		if(($_POST['sectionid'] == '' && $_POST['feescategoryid'] == '') && ($_POST['startdate'] && $_POST['enddate'])) 
		{
			return mysql_query("SELECT max(datetime),SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount FROM payment_log 
			JOIN section on section.id = payment_log.section_id JOIN class on class.id = section.classid 
			JOIN student_admission on student_admission.id = payment_log.student_id 
			LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY section_id) AS finelog on section.id = finelog.section_id 
			WHERE datetime between '".date('Y-m-d',strtotime($_POST['startdate']))."'  and  '".date('Y-m-d',strtotime($_POST['enddate']))."'
			GROUP BY section.id");
		}
		else if($_POST['feescategoryid'] && $_POST['sectionid'])
		{
			$Query = "where ";
			if(isset($_POST['sectionid']))
				$Query .= "payment_log.section_id = '".$_POST['sectionid']."' and ";
			if($_POST['feescategoryid'])
				$Query .= "payment_log.feescategory_id = '".$_POST['feescategoryid']."' and ";	
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
				$Query .= " payment_log.datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."' ";
			return mysql_query("SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
			JOIN class on class.id = section.classid
			JOIN student_admission on student_admission.id = payment_log.student_id
			LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
			".str_replace("= ''", "!= ''", $Query." GROUP BY section.id"));
		}
		 else if($_POST['feescategoryid'])
		{
			$Query = "";
			if(isset($_POST['feescategoryid']))
			{
				$Feescategoryid = mysql_query("SELECT fees_category_assign.id FROM  fees_category_assign  join fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.feescategoryid ='".$_POST['feescategoryid']."'");
				while($Feescategoryassignid = mysql_fetch_array($Feescategoryid))
				{
					if($Query == "")
						$Query .= "feescategory_id = '".$Feescategoryassignid['id']."'";
					else
						$Query .= " || feescategory_id = '".$Feescategoryassignid['id']."'";
				}
			}
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
			{
				$Query = "($Query) && datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."'";
			}
			
			return mysql_query("SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
			JOIN class on class.id = section.classid
			JOIN student_admission on student_admission.id = payment_log.student_id
			LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
			".str_replace("= ''", "!= ''", "WHERE ".$Query." group by payment_log.section_id "));
		}
		else if($_POST['sectionid'])
		{
			$Query = "where ";
			if(isset($_POST['sectionid']))
				$Query .= "payment_log.section_id = '".$_POST['sectionid']."' and ";
			if($_POST['feescategoryid'])
				$Query .= "payment_log.feescategory_id = '".$_POST['feescategoryid']."' and ";	
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
				$Query .= " payment_log.datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."' ";
			return mysql_query("SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
			JOIN class on class.id = section.classid
			JOIN student_admission on student_admission.id = payment_log.student_id
			LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
			".str_replace("= ''", "!= ''", $Query." GROUP BY section.id"));
		}
		else 
		{
			$Query = "where ";
			if(isset($_POST['sectionid']))
				$Query .= "payment_log.section_id = '".$_POST['sectionid']."' and ";
			if($_POST['feescategoryid'])
				$Query .= "payment_log.feescategory_id = '".$_POST['feescategoryid']."' and ";	
			if(isset($_POST['startdate']) && isset($_POST['enddate']))
				$Query .= " payment_log.datetime between  '".date('Y-m-d',strtotime($_POST['startdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['enddate']))."' ";
			return mysql_query("SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
			JOIN class on class.id = section.classid
			JOIN student_admission on student_admission.id = payment_log.student_id
			LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
			".str_replace("= ''", "!= ''", $Query." GROUP BY section.id"));
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function Student_Count_ByGetClass()
	{
		return mysql_query("SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE class.id='".$_GET['class']."'");
	}
	function Student_Select_ByGetClass()
	{
		return mysql_query("SELECT section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE class.id='".$_POST['class']."'");
	}
	function Student_Select_ByGetLimit()
	{
		return mysql_query("SELECT section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
	}
?>