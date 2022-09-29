<?php
	
	function Class_List()
	{
		return mysqli_query($_SESSION['connection'],"SELECT section.name as sname,class.name as classname,section.id as sectionid FROM class join section on class.id = section.classid");
	}

	//Reports ALL Student_Information
	function Student_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
	}
	function Student_Select_ByLimit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no,student_admission.contact_person FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
	}
	
	//Reports Class Student_Information
	function Student_Count_ByClass()
	{
		if($_POST['sectionid'] == '')
			return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
		else	
			return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE student_admission.section_id='".$_POST['sectionid']."'");
	}
	function Student_Select_ByClass()
	{
		if($_POST['sectionid'] == '')
			return mysqli_query($_SESSION['connection'],"SELECT class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no,student_admission.contact_person  FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id ");
		else	
			return mysqli_query($_SESSION['connection'],"SELECT class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no,student_admission.contact_person  FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE student_admission.section_id='".$_POST['sectionid']."'");
	}
	
	
	//Payment Information
	function Payment_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(student_admission.id)) as total FROM payment_log JOIN student_admission on student_admission.id = payment_log.student_id order by datetime desc");
	}
	function Payment_Select_ByLimit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT SUM(payment_log.scholarshipamount) as scholarshipamount,SUM(paidamount) as paidamount,student_admission.fees_catagoryids,student_admission.id,student_admission.contact_person,student_admission.contact_no,class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.section_id,student_admission.father_name,payment_log.finepaid,sum(payment_log.fineamount) as fineamount,payment_log.month_id,payment_log.datetime,student_admission.gender FROM payment_log 
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
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(student_admission.id)) as total FROM payment_log JOIN student_admission on student_admission.id = payment_log.student_id 
			JOIN section on student_admission.section_id = section.id
			order by datetime desc");
		}
		else 
		{
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(student_admission.id)) as total FROM payment_log JOIN student_admission on student_admission.id = payment_log.student_id 
			JOIN section on student_admission.section_id =section.id where payment_log.section_id='".$_POST['sectionid']."'
			order by datetime desc");
		}
	}
	function Payment_Select_ByclassLimit()
	{
		if($_POST['sectionid'] == '')
		{
			return mysqli_query($_SESSION['connection'],"SELECT SUM(payment_log.scholarshipamount) as scholarshipamount,SUM(paidamount) as paidamount,student_admission.fees_catagoryids,student_admission.id,student_admission.contact_person,student_admission.contact_no,class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.section_id,student_admission.father_name,payment_log.finepaid,sum(payment_log.fineamount) as fineamount,payment_log.month_id,payment_log.datetime,student_admission.gender FROM payment_log 
		JOIN student_admission on student_admission.id = payment_log.student_id 
		JOIN section on payment_log.section_id = section.id
		JOIN class on class.id = section.classid
		group by payment_log.student_id");
		}
		else 
		{
			return mysqli_query($_SESSION['connection'],"SELECT SUM(payment_log.scholarshipamount) as scholarshipamount,SUM(paidamount) as paidamount,student_admission.fees_catagoryids,student_admission.id,student_admission.contact_person,student_admission.contact_no,class.name as classname,section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.section_id,student_admission.father_name,payment_log.finepaid,sum(payment_log.fineamount) as fineamount,payment_log.month_id,payment_log.datetime,student_admission.gender FROM payment_log 
		JOIN student_admission on student_admission.id = payment_log.student_id 
		JOIN section on payment_log.section_id = section.id
		JOIN class on class.id = section.classid where  payment_log.section_id = '".$_POST['sectionid']."'
		group by payment_log.student_id");
		}
	}
	
	function Feescategory_List()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM fees_catagory order by id asc");
	}
	
	
	
	
	
	//PayementCollectionInformation
	function Paymentcollection_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(payment_log.section_id)) as total FROM payment_log");
	}
	function Paymentcollection_Select_ByLimit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
		JOIN class on class.id = section.classid
		JOIN student_admission on student_admission.id = payment_log.student_id
		LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
		GROUP BY section.id");
	}
	
	function Paymentcollection_Select_Count_byclass()
	{
		if(($_POST['sectionid'] == '' && $_POST['feescategoryid'] == '') && ($_POST['startdate'] && $_POST['enddate']))
		{
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log WHERE datetime  between '".date('Y-m-d',strtotime($_POST['startdate']))."'  and  '".date('Y-m-d',strtotime($_POST['enddate']))."' group by payment_log.section_id order by datetime desc");
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
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log ".str_replace("= ''", "!= ''", $Query."  group by payment_log.section_id 
			order by datetime desc"));
		}
		 else if($_POST['feescategoryid'])
		{
			$Query = "";
			if(isset($_POST['feescategoryid']))
			{
				$Feescategoryid = mysqli_query($_SESSION['connection'],"SELECT fees_category_assign.id FROM  fees_category_assign  join fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.feescategoryid ='".$_POST['feescategoryid']."'");
				while($Feescategoryassignid = mysqli_fetch_array($Feescategoryid))
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
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log ".str_replace("= ''", "!= ''", "WHERE ".$Query." group by payment_log.section_id 
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
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(section_id)) as total FROM payment_log ".str_replace("= ''", "!= ''", $Query."  group by payment_log.section_id 
			order by datetime desc"));
		}
	}
	function Paymentcollection_Select_ByclassLimit()
	{
		if(($_POST['sectionid'] == '' && $_POST['feescategoryid'] == '') && ($_POST['startdate'] && $_POST['enddate'])) 
		{
			return mysqli_query($_SESSION['connection'],"SELECT max(datetime),SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount FROM payment_log 
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
			return mysqli_query($_SESSION['connection'],"SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
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
				$Feescategoryid = mysqli_query($_SESSION['connection'],"SELECT fees_category_assign.id FROM  fees_category_assign  join fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.feescategoryid ='".$_POST['feescategoryid']."'");
				while($Feescategoryassignid = mysqli_fetch_array($Feescategoryid))
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
			
			return mysqli_query($_SESSION['connection'],"SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
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
			return mysqli_query($_SESSION['connection'],"SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
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
			return mysqli_query($_SESSION['connection'],"SELECT SUM(paidamount) as paidamount, student_admission.fees_catagoryids,section.name as sname,class.name as classname,SUM(payment_log.scholarshipamount) as scholarshipamount,section.id,finelog.fineamount  FROM payment_log JOIN section on section.id = payment_log.section_id
			JOIN class on class.id = section.classid
			JOIN student_admission on student_admission.id = payment_log.student_id
			LEFT JOIN (SELECT SUM(fineamount) as fineamount, section_id FROM payment_log WHERE finepaid = '1' GROUP BY  section_id) AS finelog on section.id = finelog.section_id
			".str_replace("= ''", "!= ''", $Query." GROUP BY section.id"));
		}
	}
	
	//Paid Status
	function Paymentpaid_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM student_admission order by id asc");
	}
	function Paymentstatus_Select_ByLimit()
	{
		$monthnumber =  date('m', strtotime('-1 month'));
		$Currentmonthnumber = $monthnumber - 4;
		$MonthCondition = "WHERE month_id='".$Currentmonthnumber."'";
		return mysqli_query($_SESSION['connection'],"SELECT student_admission.first_name,student_admission.last_name,section.name as sname,class.name as cname,student_admission.fees_catagoryids,payment_log2.student_id as student_paid,payment_log2.paidamount,payment_log2.scholarshipamount,payment_log2.fineamount,student_admission.contact_person,student_admission.contact_no FROM student_admission 
		JOIN section on section.id = student_admission.section_id 
		JOIN class on class.id = section.classid 
		LEFT JOIN (SELECT student_id, SUM(paidamount) as paidamount,SUM(scholarshipamount) as scholarshipamount,SUM(fineamount) as fineamount FROM payment_log $MonthCondition GROUP BY student_id) AS payment_log2 ON payment_log2.student_id = student_admission.id 
		group by student_admission.id asc");
	}
	
	//Paid Status Based On Class
	function Paymentpaid_Select_Count_by_class()
	{
		$Query = " ";
		if(isset($_POST['sectionid']))
			$Query .= "student_admission.section_id = '".$_POST['sectionid']."' "; 
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM student_admission 
	    ".str_replace("= ''", "!= ''", "WHERE ".$Query."
		"));
	}
	
	function Paymentstatus_Select_classByLimit()
	{
		if($_POST['sectionid'] && $_POST['monthid'])
		{
			$Query = " ";
			if($_POST['sectionid'])
				$Query .= "student_admission.section_id='".$_POST['sectionid']."'"; 
			if($_POST['monthid'])
				$MonthCondition = "WHERE month_id='".$_POST['monthid']."'";
			
			return mysqli_query($_SESSION['connection'],"SELECT student_admission.first_name,student_admission.last_name,section.name as sname,class.name as cname,student_admission.fees_catagoryids,payment_log2.student_id as student_paid,payment_log2.paidamount,payment_log2.scholarshipamount,payment_log2.fineamount,student_admission.contact_person,student_admission.contact_no FROM student_admission 
			JOIN section on section.id = student_admission.section_id
			JOIN class on class.id = section.classid
			LEFT JOIN (SELECT student_id, SUM(paidamount) as paidamount,SUM(scholarshipamount) as scholarshipamount,SUM(fineamount) as fineamount FROM payment_log $MonthCondition GROUP BY student_id) AS payment_log2 ON payment_log2.student_id = student_admission.id 
			".str_replace("= ''", "!= ''", "WHERE ".$Query."
			group by student_admission.id asc"));//LEFT JOIN payment_log ON payment_log.student_id = student_admission.id
		}
		else if($_POST['monthid'])	
		{
			if($_POST['monthid'])
				$MonthCondition = "WHERE month_id='".$_POST['monthid']."'";
			return mysqli_query($_SESSION['connection'],"SELECT student_admission.first_name,student_admission.last_name,section.name as sname,class.name as cname,student_admission.fees_catagoryids,payment_log2.student_id as student_paid,payment_log2.paidamount,payment_log2.scholarshipamount,payment_log2.fineamount,student_admission.contact_person,student_admission.contact_no FROM student_admission 
			JOIN section on section.id = student_admission.section_id
			JOIN class on class.id = section.classid
			LEFT JOIN (SELECT student_id, SUM(paidamount) as paidamount,SUM(scholarshipamount) as scholarshipamount,SUM(fineamount) as fineamount FROM payment_log $MonthCondition GROUP BY student_id) AS payment_log2 ON payment_log2.student_id = student_admission.id 
			group by student_admission.id asc");
		}
	}
	
	
	
	
	
	
	
	
	function Student_Count_ByGetClass()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE class.id='".$_GET['class']."'");
	}
	function Student_Select_ByGetClass()
	{
		return mysqli_query($_SESSION['connection'],"SELECT section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id WHERE class.id='".$_POST['class']."'");
	}
	function Student_Select_ByGetLimit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT section.name as sname,student_admission.first_name,student_admission.last_name,student_admission.father_name,student_admission.admission_date,student_admission.gender,student_admission.contact_no FROM student_admission JOIN section ON student_admission.section_id=section.id JOIN class ON section.classid=class.id");
	}
?>