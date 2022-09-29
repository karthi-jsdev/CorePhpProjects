<?php
	//Opportunity
	function Lead_selection()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM leads");
	}
	/* function Product_Category()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_category");
	}
	function Product_Subcategory()
	{
		return mysqli_query($_SESSION['connection'],"SELECT name,id from product_subcategory where category_id='".$_GET['product_category_id']."'");
	} */
	function Product()
	{ 
		return mysqli_query($_SESSION['connection'],"SELECT product.id,products.productcode from product JOIN products on product.productcode=products.id");
	}
	function Product_subcategory_Edit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT name,product_subcategory.id as pscid FROM product_subcategory join oppurtunities on product_subcategory.id=product_subcategory_id WHERE oppurtunities.id='".$_GET['id']."'");
	}
	function Product_Edit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT code,product.id as pid FROM product join oppurtunities on product.id=product_id WHERE oppurtunities.id='".$_GET['id']."'");
	}
	//Opportunity Creation
	function Opportunity_Create()
	{
		if($_POST['others'])
		{
			return mysqli_query($_SESSION['connection'],"INSERT INTO oppurtunities(lead_id,description,product_id,others,quantity,date,company,contact_person,designation,email_id,contact_no)
			VALUES ('".$_POST['lead_id']."','".$_POST['description']."','".$_POST['product_id']."','".$_POST['others']."',
			'".$_POST['quantity']."','".$_POST['date']."','".$_POST['company']."','".$_POST['contact_person']."','".$_POST['designation']."','".$_POST['email_id']."',
			'".$_POST['contact_no']."')");
		}
		else
		{
			return mysqli_query($_SESSION['connection'],"INSERT INTO oppurtunities(lead_id,description,product_id,quantity,date,company,contact_person,designation,email_id,contact_no)
			VALUES ('".$_POST['lead_id']."','".$_POST['description']."','".$_POST['product_id']."','".$_POST['quantity']."',
			'".$_POST['date']."','".$_POST['company']."','".$_POST['contact_person']."','".$_POST['designation']."','".$_POST['email_id']."',
			'".$_POST['contact_no']."')");
		}
	}
	function Opportunity_Item_List_Count()
	{
		if($_GET['status_id']==2)
		{
			return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM oppurtunities 
								LEFT JOIN leads ON lead_id = leads.id 
								LEFT JOIN product ON oppurtunities.product_id = product.id
								LEFT JOIN products ON product.productcode = products.id
								LEFT JOIN oppurtunities_comments ON oppurtunities_id = oppurtunities.id 
								LEFT JOIN oppurtunity_status ON status_id = oppurtunity_status.id
								WHERE oppurtunities.id not in(SELECT oppurtunities_id from oppurtunities_comments where oppurtunities_id not
								IN(SELECT oppurtunities_id FROM oppurtunities_comments GROUP BY oppurtunities_id having MAX(status_id)='2'))");
		}
		else if($_GET['status_id'])
		{
			return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from oppurtunities 
								join leads on lead_id=leads.id 
								LEFT JOIN product ON oppurtunities.product_id = product.id
								LEFT JOIN products ON product.productcode = products.id
								join oppurtunities_comments on oppurtunities_id=oppurtunities.id 
								join oppurtunity_status on status_id= oppurtunity_status.id where status_id='".$_GET['status_id']."'");
		}
		else
			return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from oppurtunities join leads on lead_id=leads.id join product on oppurtunities.product_id=product.id join products on product.productcode=products.id");
	}
	function Opportunity_Item_List($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT oppurtunities.id,leads.name,products.productcode as description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id join product on oppurtunities.product_id=product.id join products on product.productcode=products.id order by oppurtunities.id DESC LIMIT $Start,$Limit");
	}
	function Opportunity_Item_Edit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT leads.name as leadname,
							products.productcode as prodescription,oppurtunities.others,lead_id,
							product.id as pid,oppurtunities.id,leads.name,product.description,oppurtunities.description as opp_description,
							oppurtunities.quantity,
							oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,
							oppurtunities.contact_no,
							oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id 
							join product on oppurtunities.product_id=product.id
							join products on products.id=product.productcode
							where oppurtunities.id='".$_GET['id']."'");
	}
	function Opportunity_Item_Edit_Update()
	{
		return mysqli_query($_SESSION['connection'],"SELECT products.productcode as psname,leads.name as leadname,product.description as prodescription
							,oppurtunities.others,lead_id,product.id as pid,oppurtunities.id,leads.name,product.description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id 
							join product on oppurtunities.product_id=product.id 
							join products on product.productcode=products.id
							where oppurtunities.id='".$_POST['id']."' ORDER BY leads.id DESC LIMIT 0,1");
	}
	function Opportunity_Update()
	{
		if($_POST['others'])
			return mysqli_query($_SESSION['connection'],"Update oppurtunities set lead_id='".$_POST['lead_id']."',description='".$_POST['description']."',product_id='".$_POST['product_id']."',others='".$_POST['others']."',quantity='".$_POST['quantity']."',date='".$_POST['date']."',contact_person='".$_POST['contact_person']."',designation='".$_POST['designation']."',email_id='".$_POST['email_id']."',contact_no='".$_POST['contact_no']."',company='".$_POST['company']."' where oppurtunities.id='".$_POST['id']."'");
		else
			return mysqli_query($_SESSION['connection'],"Update oppurtunities set lead_id='".$_POST['lead_id']."',description='".$_POST['description']."',product_id='".$_POST['product_id']."',quantity='".$_POST['quantity']."',date='".$_POST['date']."',contact_person='".$_POST['contact_person']."',designation='".$_POST['designation']."',email_id='".$_POST['email_id']."',contact_no='".$_POST['contact_no']."',company='".$_POST['company']."' where oppurtunities.id='".$_POST['id']."'");
	}
	function Opportunity_Delete()
	{
		mysqli_query($_SESSION['connection'],"DELETE FROM oppurtunities_comments where oppurtunities_id='".$_GET['id']."'");
		mysqli_query($_SESSION['connection'],"DELETE FROM oppurtunities where id='".$_GET['id']."'");
	}
	function Workid()
	{
		return mysqli_query($_SESSION['connection'],"select oppurtunities.id from oppurtunities order by id DESC LIMIT 0,1");
	}
	function Opportunity_Search($Start,$Limit)
	{
		if(($_POST['contentSearch']) == 'WK')
			{}
		else if(strpos($_POST['contentSearch'],'WK') === 0)
			$_POST['contentSearch']=substr($_POST['contentSearch'],2,strlen($_POST['contentSearch']));
		return mysqli_query($_SESSION['connection'],"SELECT oppurtunities.id,leads.name,products.productcode as description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id join product on oppurtunities.product_id=product.id join products on products.id=product.productcode 
							WHERE leads.name='".$_POST['contentSearch']."' || oppurtunities.id='".$_POST['contentSearch']."'order by oppurtunities.id DESC LIMIT $Start,$Limit");
	}
	function Opportunity_Search_Count()
	{	
		if(($_POST['contentSearch']) == 'WK')
			{}
		else if(strpos($_POST['contentSearch'],'WK') === 0)
			$_POST['contentSearch']=substr($_POST['contentSearch'],2,strlen($_POST['contentSearch']));
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from oppurtunities
							join leads on lead_id=leads.id join product on oppurtunities.product_id=product.id join products on products.id=product.productcode 
							WHERE leads.name='".$_POST['contentSearch']."' || oppurtunities.id='".$_POST['contentSearch']."'order by oppurtunities.id");
	
	}
	function OpportunityManagement_Item_List($Start,$Limit)
	{
		if($_GET['status_id']==2)
			return mysqli_query($_SESSION['connection'],"SELECT status_id, oppurtunities.id, leads.name, products.productcode as description, oppurtunities.description AS opp_description, oppurtunities.quantity, oppurtunities.`date` , oppurtunities.contact_person, oppurtunities.designation, oppurtunities.email_id, oppurtunities.contact_no, oppurtunities.company
								FROM oppurtunities
								LEFT JOIN leads ON lead_id = leads.id
								LEFT JOIN product ON oppurtunities.product_id = product.id
								LEFT JOIN products on product.productcode=products.id
								LEFT JOIN oppurtunities_comments ON oppurtunities_id = oppurtunities.id
								LEFT JOIN oppurtunity_status ON status_id = oppurtunity_status.id
								WHERE oppurtunities.id not in(SELECT oppurtunities_id from oppurtunities_comments where oppurtunities_id not
								IN(SELECT oppurtunities_id FROM oppurtunities_comments GROUP BY oppurtunities_id having MAX(status_id)='2')) 
								ORDER BY oppurtunities.id DESC LIMIT $Start,$Limit");
		else if($_GET['status_id'])
			return mysqli_query($_SESSION['connection'],"SELECT MAX(status_id) as s,oppurtunities.id, leads.name, products.productcode as description, oppurtunities.description AS opp_description, oppurtunities.quantity, oppurtunities.`date` , oppurtunities.contact_person, oppurtunities.designation, oppurtunities.email_id, oppurtunities.contact_no, oppurtunities.company
								FROM oppurtunities
								INNER JOIN leads ON lead_id = leads.id
								INNER JOIN product ON oppurtunities.product_id = product.id
								INNER JOIN products on product.productcode=products.id
								INNER JOIN oppurtunities_comments ON oppurtunities_id = oppurtunities.id
								INNER JOIN oppurtunity_status ON status_id = oppurtunity_status.id
								GROUP BY oppurtunities_id having s='".$_GET['status_id']."' ORDER BY oppurtunities_id DESC LIMIT $Start,$Limit");
			/*return mysqli_query($_SESSION['connection'],"SELECT status,oppurtunities.id,leads.name,product.description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
								inner join leads on lead_id=leads.id
								inner join product on oppurtunities.product_id=product.id
								inner join oppurtunities_comments on oppurtunities_id=oppurtunities.id
								inner join oppurtunity_status on status_id= oppurtunity_status.id
								where status_id='".$_GET['status_id']."'
								order by oppurtunities.id DESC LIMIT $Start,$Limit");*/
		else
			return mysqli_query($_SESSION['connection'],"SELECT oppurtunities.id,leads.name,products.productcode as description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id join product on oppurtunities.product_id=product.id join products on product.productcode=products.id order by oppurtunities.id DESC LIMIT $Start,$Limit");
	
	}
	function Status_List_WithCount()
	{
		return mysqli_query($_SESSION['connection'],"select status from oppurtunity_status join oppurtunities_comments ON status_id = oppurtunity_status.id where oppurtunity_status.id='".$_GET['status_id']."'");
	}	
	function Status_List()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(oppurtunities_id) as total,oppurtunities_comments.id,status_id,status FROM `oppurtunities_comments` join oppurtunity_status on oppurtunity_status.id=status_id where oppurtunities_id='".$_POST['id']."' group by status_id order by oppurtunities_comments.id DESC limit 0,1");
	}
	
	//Opportunity Management
	function Opportunity_Status()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE enabled!='0'");
	}
	function Opportunity_Status1()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE enabled!='0'");
	}
	function Opportunity_Status_Update()
	{	
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE enabled!='0' and oppurtunity_status.id not in(select status_id from oppurtunities_comments where oppurtunities_id='".$_POST['id']."')");
	}
	function Status_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"select count(id) as All_Data from oppurtunities where oppurtunities.id not in(select oppurtunities_id from oppurtunities_comments where oppurtunities_id in(select count(statustotal) as prospect from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='2') opp_comment group by statustotal))");
	}
	/*function Status_Count_Prospecting()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM oppurtunities LEFT JOIN leads ON lead_id = leads.id LEFT JOIN product ON oppurtunities.product_id = product.id
				LEFT JOIN oppurtunities_comments ON oppurtunities_id = oppurtunities.id
				LEFT JOIN oppurtunity_status ON status_id = oppurtunity_status.id
				WHERE oppurtunities.id not in(SELECT oppurtunities_id from oppurtunities_comments where oppurtunities_id not
				IN(SELECT oppurtunities_id FROM oppurtunities_comments GROUP BY oppurtunities_id having MAX(status_id)='2')) 
				ORDER BY oppurtunities.id DESC");
	}*/
	function Status_Count_Prospecting()
	{	
		return mysqli_query($_SESSION['connection'],"SELECT count(id) as total FROM oppurtunities WHERE oppurtunities.id not in (select oppurtunities_id from oppurtunities_comments)");
	}
	function Status_Count_Prospecting1()
	{	
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as prospect from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='2') opp_comment group by statustotal");
	}
	function Status_Count_Analysi()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as analysi from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='3') opp_comment group by statustotal");
	}
	function Status_Count_Presentation()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as presentation from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='4') opp_comment group by statustotal");
	}
	function Status_Count_SamplesProvided()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as samplesprovided from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='5') opp_comment group by statustotal");
	}
	function Status_Count_SamplesApproved()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as samplesapproved from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='6') opp_comment group by statustotal");
	}
	function Status_Count_NegotiationtoPilot()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as ntp from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='7') opp_comment group by statustotal");
	}
	function Status_Count_PilotLotOrder()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as plo from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='8') opp_comment group by statustotal");
	}
	function Status_Count_Quotedtest()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as qtest from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='9') opp_comment group by statustotal");
	}
	function Status_Count_FindReview()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as freview from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='10') opp_comment group by statustotal");
	}
	function Status_Count_HoldPostpone()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as hp from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='11') opp_comment group by statustotal");
	}
	function Status_Count_ClosedWon()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as cw from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='12') opp_comment group by statustotal");
	}
	function Status_Count_ClosedLost()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as cl from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='13') opp_comment group by statustotal");
	}
	function Status_Count_Others()
	{
		return mysqli_query($_SESSION['connection'],"select count(statustotal) as other from( SELECT MAX(status_id) as statustotal,oppurtunities_id,status_id FROM oppurtunities_comments group by oppurtunities_id having statustotal='14') opp_comment group by statustotal");
	}
	function OpportunityManagement_StatusDisplay()
	{
		return mysqli_query($_SESSION['connection'],"SELECT date_update,oppurtunities_id,oppurtunities_comments.date,oppurtunities_comments.comments,oppurtunities_comments.amount,
							oppurtunity_status.status FROM oppurtunities_comments
							join oppurtunity_status on oppurtunity_status.id=oppurtunities_comments.status_id
							join oppurtunities on oppurtunities.id=oppurtunities_id where oppurtunities_id='".$_GET['id']."'");
	}
	function OpportunityManagement_Status_Display1()
	{
		return mysqli_query($_SESSION['connection'],"SELECT date_update,oppurtunities_id,oppurtunities_comments.date,oppurtunities_comments.comments,oppurtunities_comments.amount,
							oppurtunity_status.status FROM oppurtunities_comments
							join oppurtunity_status on oppurtunity_status.id=oppurtunities_comments.status_id
							join oppurtunities on oppurtunities.id=oppurtunities_id where oppurtunities_id='".$_POST['id']."'");
	}
	function OpportunityManagement_StatusInsertion()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO oppurtunities_comments(status_id,oppurtunities_id,amount,comments,date,date_update) VALUES ('".$_POST['status_id']."','".$_POST['id']."','".$_POST['amount']."','".$_POST['comments']."','".$_POST['date']."','".$_POST['date_update']."')");
	}
	function Update_Disable()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(oppurtunities_id) as total from oppurtunities_comments where oppurtunities_id='".$_GET['id']."' and (status_id='12' || status_id='13')");
	}
	function CreateOrder_Enable()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(oppurtunities_id) as total from oppurtunities_comments where oppurtunities_id='".$_GET['id']."' and status_id='12'");
	}
	function Sales_Order_Issue_Search()
	{
		return mysqli_query($_SESSION['connection'],"SELECT oppurtunities.id,leads.name,products.productcode as description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id 
							join product on oppurtunities.product_id=product.id 
							join products on products.id=product.productcode 
							where oppurtunities.id in(
							SELECT distinct oppurtunities_id FROM `oppurtunities_comments` WHERE leads.name ='".$_POST['contentSearch']."' and status_id='12' and oppurtunities_id not in(select oppurtunity_id from sales_order)) ORDER BY oppurtunities.id DESC");
	}
	function Sales_Order_Issue()
	{
		return mysqli_query($_SESSION['connection'],"SELECT oppurtunities.id,leads.name,products.productcode as description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id 
							join product on oppurtunities.product_id=product.id 
							join products on products.id=product.productcode 
							where oppurtunities.id in(
							SELECT distinct oppurtunities_id FROM `oppurtunities_comments` WHERE status_id='12' and oppurtunities_id not in(select oppurtunity_id from sales_order)) ORDER BY oppurtunities.id DESC");
	 }
	function Sales_Order_Issue_Count()
	{
		return mysqli_query($_SESSION['connection'],"SELECT Count(*) as salesordertotal from oppurtunities
							join leads on lead_id=leads.id 
							join product on oppurtunities.product_id=product.id 
							join products on products.id=product.productcode
							where oppurtunities.id in(SELECT distinct oppurtunities_id FROM `oppurtunities_comments` WHERE status_id='12' and oppurtunities_id not in(select oppurtunity_id from sales_order))");
	}
	//Sample Management
	function SampleManagement_Insertion()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO samples(lead_id,oppurtunity_id,specification,product_id,date,company,contact_person,designation,email_id,contact_no,assigned_to,sample_prize,no_of_samples,follow_up) VALUES ('".$_POST['lead_id']."','".$_POST['oppurtunity_id']."','".$_POST['specification']."','".$_POST['product_id']."','".$_POST['date']."','".$_POST['company']."','".$_POST['contact_person']."','".$_POST['designation']."','".$_POST['email_id']."','".$_POST['contact_no']."','".$_POST['assigned_to']."','".$_POST['sample_prize']."','".$_POST['no_of_samples']."','".$_POST['follow_up']."')");
	}
	function Samples_Id()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id from samples ORDER BY id DESC LIMIT 0,1");
	}
	function Sample_Opportunity_Item_List()
	{
		return mysqli_query($_SESSION['connection'],"SELECT oppurtunities.id,leads.name,product.description,oppurtunities.description as opp_description,oppurtunities.quantity,oppurtunities.`date`,oppurtunities.contact_person,oppurtunities.designation,oppurtunities.email_id,oppurtunities.contact_no,oppurtunities.company from oppurtunities
							join leads on lead_id=leads.id join product on oppurtunities.product_id=product.id WHERE oppurtunities.lead_id='".$_GET['lead_id']."' order by oppurtunities.id DESC");
	}
	function Sample_Selection($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT samples.id,`oppurtunity_id`, leads.name,products.productcode as description,samples.date,samples.company,samples.contact_person,samples.designation,samples.email_id,samples.contact_no,samples.assigned_to,samples.sample_prize,samples.no_of_samples,samples.follow_up,samples.`specification` 
							from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id join products on product.productcode=products.id ORDER BY samples.id DESC LIMIT $Start,$Limit");
	}
	function Sample_Selection_Leadname($Start,$Limit)
	{
		if(($_POST['contentSearch']) == 'S')
			{}
		else if (strpos($_POST['contentSearch'],'S') === 0)
			$_POST['contentSearch']=substr($_POST['contentSearch'],1,strlen($_POST['contentSearch']));
		return mysqli_query($_SESSION['connection'],"SELECT samples.id,`oppurtunity_id`, leads.name,product.description,samples.date,samples.company,samples.contact_person,samples.designation,samples.email_id,samples.contact_no,samples.assigned_to,samples.sample_prize,samples.no_of_samples,samples.follow_up,samples.`specification` 
							from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id WHERE leads.name='".$_POST['contentSearch']."' || samples.id='".$_POST['contentSearch']."' ORDER BY samples.id DESC LIMIT $Start,$Limit");
	}
	function Sample_Selection_ByCount()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id join products on products.id=product.productcode");
	}
	function Sample_Selection_ByValueCount()
	{
		if(($_POST['contentSearch']) == 'S')
			{}
		else if(strpos($_POST['contentSearch'],'S') === 0)
			$_POST['contentSearch']=substr($_POST['contentSearch'],1,strlen($_POST['contentSearch']));
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id 
		join product on product.id=samples.product_id join products on products.id=product.productcode WHERE leads.name='".$_POST['contentSearch']."' || samples.id='".$_POST['contentSearch']."' ORDER BY samples.id DESC");
	}
	function Sample_Edit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT leads.id as lid,samples.id as sid,`oppurtunity_id`,leads.name,product.id as pid,products.productcode as description,samples.date,samples.company,samples.contact_person,samples.designation,samples.email_id,samples.contact_no,samples.assigned_to,samples.sample_prize,samples.no_of_samples,samples.follow_up,samples.`specification` 
		from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id join products on products.id=product.productcode WHERE samples.id='".$_GET['id']."'");
	}
	function Sample_Updation()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE samples SET lead_id='".$_POST['lead_id']."',oppurtunity_id='".$_POST['oppurtunity_id']."',product_id='".$_POST['product_id']."',
							specification='".$_POST['specification']."',company='".$_POST['company']."',date='".$_POST['date']."',designation='".$_POST['designation']."',contact_no='".$_POST['contact_no']."',
							email_id='".$_POST['email_id']."',assigned_to='".$_POST['assigned_to']."',sample_prize='".$_POST['sample_prize']."',no_of_samples='".$_POST['no_of_samples']."'
							,follow_up='".$_POST['follow_up']."',contact_person='".$_POST['contact_person']."' WHERE id='".$_POST['id']."'");
	}
	function Sample_Deletion()
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM samples WHERE id='".$_GET['id']."'");
	}
	function Sample_Opportunity_id()
	{
		return mysqli_query($_SESSION['connection'],"SELECT oppurtunity_id from samples where samples.id='".$_GET['id']."'");
	}
	function Sample_Productsubcategory_Edit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT name,product_subcategory.id as pscid FROM product_subcategory join samples on product_subcategory.id=product_subcategory_id WHERE samples.id='".$_GET['id']."'");
	}
	function Sample_ProductEdit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT products.productcode,product.id as pid FROM product join product on product.id=product_id WHERE samples.id='".$_GET['id']."'");
	}
	//Sample Management Edit
	function Status_disableAction()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(status_id) AS tot FROM oppurtunities_comments WHERE oppurtunities_id ='".$_GET['id']."' and (status_id='12' || status_id='13')");
	}
	function SalesOrder_disableAction()
	{
		return mysqli_query($_SESSION['connection'],"select count(oppurtunity_id) as total from sales_order where oppurtunity_id='".$_GET['id']."'");
	}
	function SalesOrder_ForACCLead()
	{
		return mysqli_query($_SESSION['connection'],"select add_to_account from leads join oppurtunities on leads.id=lead_id where oppurtunities.id='".$_GET['id']."'");
	}
?>