<?php
	function SelectClientcategorycode()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * from clientcategory");
	}
	function Selectreferredbycode()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * from reference");
	}
	function Selectreferencegroup()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * from reference_group");
	}
	function Selectindustrycode()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * from industry_category");
	}
	function Lead_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads where id='".$_GET['id']."' || id='".$_GET['leadid']."'");
	}
	function Lead_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM leads WHERE id='".$Id."'");
	}
	function Lead_Select_ByName()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads where name='".$_POST['name']."'");
	}
	function Lead_Insert()
	{
		return mysqli_query($_SESSION['connection'],"INSERT into leads(id,name,address,email_id,	contact_no,contact_person1,designation1,email_id1,contact_no1,contact_person2,designation2,email_id2,contact_no2,client_category_id,reference_id,reference_group_id,industry_category_id,add_to_account) values ('','".$_POST['name']."','".$_POST['address']."','".$_POST['email_id']."','".$_POST['contact_no']."','".$_POST['contact_person1']."','".$_POST['designation1']."','".$_POST['email_id1']."','".$_POST['contact_no1']."','".$_POST['contact_person2']."','".$_POST['designation2']."','".$_POST['email_id2']."','".$_POST['contact_no2']."','".$_POST['vendor_category_id']."','".$_POST['reference_id']."','".$_POST['reference_group_id']."','".$_POST['industry_category_id']."','".$_POST['add_to_account']."')");
	}
	function Lead_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE  leads SET  name='".$_POST['name']."', address='".$_POST['address']."', email_id = '".$_POST['email_id']."', contact_no='".$_POST['contact_no']."', contact_person1='".$_POST['contact_person1']."', designation1='".$_POST['designation1']."', email_id1='".$_POST['email_id1']."', contact_no1='".$_POST['contact_no1']."', contact_person2='".$_POST['contact_person2']."', designation2='".$_POST['designation2']."', email_id2='".$_POST['email_id2']."', contact_no2='".$_POST['contact_no2']."', Client_category_id='".$_POST['vendor_category_id']."', reference_id='".$_POST['reference_id']."', reference_group_id='".$_POST['reference_group_id']."', industry_category_id='".$_POST['industry_category_id']."', add_to_account = '".$_POST['add_to_account']."' WHERE id='".$_POST['id']."' ");
	}
	function Lead_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM leads ORDER BY id DESC");
	}
	function Lead_Select_Count_All_Search($Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM leads WHERE id like '%".$Search."' or id like '".$Search."%' or id like '%".$Search."%' or name like '%".$Search."' or name like '".$Search."%' or name like '%".$Search."%' ORDER BY id DESC");
	}
	function Lead_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Lead_Select_ByLimitSearch($Start, $Limit, $Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads WHERE id like '%".$Search."' or id like '".$Search."%' or id like '%".$Search."%' or name like '%".$Search."' or name like '".$Search."%' or name like '%".$Search."%' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Vendor_Category_Name($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory WHERE id='".$Id."'");
	}
	function Client_Category_Name($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM clientcategory WHERE id='".$Id."'");
	}
	function Vendor_Category_Name_Summary($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory WHERE id='".$Id."'");
	}
	function Reference_Name($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference WHERE id='".$Id."'");
	}
	function Reference_Name_Summary($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference WHERE id='".$Id."'");
	}
	function Reference_GroupName($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference_group WHERE id='".$Id."'");
	}
	function Reference_GroupName_Summary($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference_group WHERE id='".$Id."'");
	}
	function Industrycategory_Name($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM industry_category WHERE id='".$Id."'");
	}
	function Industrycategory_Name_Summary($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM industry_category WHERE id='".$Id."'");
	}
	
	//Lead Comments 
	function Leads_Insert()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO leadscomments(id,leadid,commentsdate,comments,followupdate,updatedby) values('','".$_POST['leadid']."','".date('Y-m-d H:i:s')."','".$_POST['comments']."','".date('Y-m-d',strtotime($_POST[followupdate]))."','".$_SESSION['id']."')");
	}
	function Leadcomments_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM leadscomments WHERE leadid='".$_GET['leadid']."' ORDER BY id DESC");
	}
	function Leadcomments_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leadscomments WHERE leadid='".$_GET['leadid']."' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function UpdatedBy_Name($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE id='".$Id."'");
	}
	
	//Lead Followup Count
	function Lead_followupSelect_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leadscomments
		JOIN leads ON leadscomments.leadid = leads.id
		WHERE leadscomments.followupdate <= CURRENT_DATE + INTERVAL '14' DAY && leads.id NOT IN
		(
			SELECT InterTable.leadid
			FROM
			(
				SELECT *
				FROM leadscomments
				WHERE leadscomments.followupdate > CURRENT_DATE + INTERVAL '14'
				DAY
			) AS InterTable
			JOIN leadscomments ON InterTable.id = leadscomments.id
		)
		GROUP BY(leads.id) ORDER BY leads.id DESC");
	}
	function Lead_Select_ByLasttwoweekLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leadscomments
		JOIN leads ON leadscomments.leadid = leads.id
		WHERE leadscomments.followupdate <= CURRENT_DATE + INTERVAL '14' DAY && leads.id NOT IN
		(
			SELECT InterTable.leadid
			FROM
			(
				SELECT *
				FROM leadscomments
				WHERE leadscomments.followupdate > CURRENT_DATE + INTERVAL '14'
				DAY
			) AS InterTable
			JOIN leadscomments ON InterTable.id = leadscomments.id
		)
		GROUP BY(leads.id) ORDER BY leadscomments.followupdate ASC LIMIT $Start, $Limit");
	}
	function Lead_followupSelect_Count_AllBySearch($Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM leadscomments
		JOIN leads ON leadscomments.leadid = leads.id
		WHERE leadscomments.followupdate <= CURRENT_DATE + INTERVAL '14' DAY && (leads.id like '%".$Search."' or leads.id like '".$Search."%' or leads.id like '%".$Search."%' or leads.name like '%".$Search."' or leads.name like '".$Search."%' or leads.name like '%".$Search."%') && leads.id NOT IN
		(
			SELECT InterTable.leadid
			FROM
			(
				SELECT *
				FROM leadscomments
				WHERE leadscomments.followupdate > CURRENT_DATE + INTERVAL '14'
				DAY
			) AS InterTable
			JOIN leadscomments ON InterTable.id = leadscomments.id
		)
		GROUP BY(leads.id)  ORDER BY leads.id DESC");
	}
	function Lead_Select_ByLasttwoweekLimitSearch($Start, $Limit, $Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leadscomments
		JOIN leads ON leadscomments.leadid = leads.id
		WHERE leadscomments.followupdate <= CURRENT_DATE + INTERVAL '14' DAY && (leads.id like '%".$Search."' or leads.id like '".$Search."%' or leads.id like '%".$Search."%' or leads.name like '%".$Search."' or leads.name like '".$Search."%' or leads.name like '%".$Search."%') && leads.id NOT IN
		(
			SELECT InterTable.leadid
			FROM
			(
				SELECT *
				FROM leadscomments
				WHERE leadscomments.followupdate > CURRENT_DATE + INTERVAL '14'
				DAY
			) AS InterTable
			JOIN leadscomments ON InterTable.id = leadscomments.id
		)
		GROUP BY(leads.id)   ORDER BY leadscomments.followupdate ASC LIMIT $Start, $Limit");
	}
	
	//Lead Accountsummary
	function Lead_AddtoaccountSelect_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM leads WHERE add_to_account='1' ORDER BY id DESC");
	}
	function Lead_AddtoaccountSelect_Count_All_By_Search($Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM leads WHERE add_to_account='1' AND (id like '%".$Search."' or id like '".$Search."%' or id like '%".$Search."%' or name like '%".$Search."' or name like '".$Search."%' or name like '%".$Search."%') ORDER BY id DESC");
	}
	function Lead_AddtoaccountSelect_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads WHERE add_to_account='1' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Lead_AddtoaccountSelect_ByLimitSearch($Start, $Limit, $Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads WHERE add_to_account='1' AND (id like '%".$Search."' or id like '".$Search."%' or id like '%".$Search."%' or name like '%".$Search."' or name like '".$Search."%' or name like '%".$Search."%' ) ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
 ?>