<?php
	date_default_timezone_set('Asia/Kolkata');
	function Select_Client()
	{
		return mysql_query("Select * From leads where add_to_account='1' order by name asc");
	}
	function SelectProductCategory()
	{
		return mysql_query("Select * From product_category order by name asc");
	}
	function SelectProduct()
	{
		return mysql_query("Select * From product");
	}
	function SelectCourier()
	{
		return mysql_query("Select * From couriers Order by couriers asc");
	}
	function Select_SalesNo()
	{
		return mysql_query("Select id from sales_order order by id desc");
	}
	function Select_Sales_order()
	{
		return mysql_query("Select count(*) as total from sales_order order by id desc");
	}
	function SaleOrder_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("Select *  from sales_order order by id desc Limit $Start,$Limit");
	}
	function SaleOrder_Delete_ById($Id)
	{
		return mysql_query("Delete from sales_order where id='".$Id."'");
	}
	function Select_Sales_orderSearch($Search)
	{
		$Query = "";
		if($Search)
		{
			$Query .= " (";
			$SelectLead = mysql_query("Select * From leads where name like  '".$Search."%' or name like '%".$Search."'  or name like '%".$Search."%' ");
			$j = $k = mysql_num_rows($SelectLead);
			while($FetchLead = mysql_fetch_array($SelectLead))
			{
				$j -= 1;
				$Query .= "lead_id like '".$FetchLead['id']."' ";
				if($j)
					$Query .= " OR ";
			}
			$Query .= ")";
			/*$SelectMeterial = mysql_query("SELECT * FROM  rawmaterial   where materialcode like '".$Search."%' or materialcode like '%".$Search."'  or materialcode like '%".$Search."%'");
			$i = mysql_num_rows($SelectMeterial);
			while($FetchMeterial = mysql_fetch_array($SelectMeterial))
			{
				$i -= 1;
				$Query .= "rawmaterialid like '".$FetchMeterial['id']."%'  or rawmaterialid like '%".$FetchMeterial['id']."'  or rawmaterialid like '%".$FetchMeterial['id']."%'";
				if($i)
					$Query .= " OR ";
			}*/
			if($k)
				return mysql_query("SELECT count(*) as total FROM sales_order  where  ".$Query."	ORDER BY id DESC");
			else
				return mysql_query("SELECT count(*) as total FROM sales_order  where  (id like  '".$Search."%' or id like '%".$Search."'  or id like '%".$Search."%')	ORDER BY id DESC");
		}
	}
	function Select_Sales_orderSearchByLimit($Search,$Start,$Limit)
	{
		$Query = "";
		if($Search)
		{
			$Query .= " (";
			$SelectLead = mysql_query("Select * From leads where name like  '".$Search."%' or name like '%".$Search."'  or name like '%".$Search."%' ");
			$j = $k = mysql_num_rows($SelectLead);
			while($FetchLead = mysql_fetch_array($SelectLead))
			{
				$j -= 1;
				$Query .= "lead_id like '".$FetchLead['id']."' ";
				if($j)
					$Query .= " OR ";
			}
			$Query .= ")";
			/*$SelectMeterial = mysql_query("SELECT * FROM  rawmaterial   where materialcode like '".$Search."%' or materialcode like '%".$Search."'  or materialcode like '%".$Search."%'");
			$i = mysql_num_rows($SelectMeterial);
			while($FetchMeterial = mysql_fetch_array($SelectMeterial))
			{
				$i -= 1;
				$Query .= "rawmaterialid like '".$FetchMeterial['id']."%'  or rawmaterialid like '%".$FetchMeterial['id']."'  or rawmaterialid like '%".$FetchMeterial['id']."%'";
				if($i)
					$Query .= " OR ";
			}*/
			if($k)
				return mysql_query("SELECT * FROM sales_order  where ".$Query." ORDER BY id DESC Limit $Start,$Limit");
			else
				return mysql_query("SELECT * FROM sales_order  where  (id like  '".$Search."%' or id like '%".$Search."'  or id like '%".$Search."%') ORDER BY id DESC Limit $Start,$Limit");
		}
	}
	function Select_Sales_orderSummary()
	{
		return mysql_query("SELECT count(*) as total FROM sales_order ORDER BY id DESC");
	}
	function Select_Sales_orderSummaryByLimitSearch($Search)
	{
		$Query = "";
		if($Search)
		{
			$Query .= " (";
			$SelectLead = mysql_query("Select * From leads where name like  '".$Search."%' or name like '%".$Search."'  or name like '%".$Search."%' ");
			$j = $k = mysql_num_rows($SelectLead);
			while($FetchLead = mysql_fetch_array($SelectLead))
			{
				$j -= 1;
				$Query .= "lead_id like '".$FetchLead['id']."' ";
				if($j)
					$Query .= " OR ";
			}
			$Query .= ")";
			if($k)
				return mysql_query("SELECT * FROM sales_order  where ".$Query." ORDER BY id DESC");
			else
				return mysql_query("SELECT * FROM sales_order  where  (id like  '".$Search."%' or id like '%".$Search."'  or id like '%".$Search."%') ORDER BY id DESC");
		}
	}
	function Select_Sales_orderSummaryByLimit()
	{
		return mysql_query("SELECT * FROM sales_order ORDER BY id DESC ");
	}
	function SelectWork($LeadId)
	{
		//echo "Select oppurtunities.id from oppurtunities JOIN oppurtunities_comments ON oppurtunities_id=oppurtunities.id JOIN oppurtunity_status ON oppurtunities_comments.status_id=oppurtunity_status.id  where oppurtunity_status.status like '%Won' and lead_id='".$LeadId."' oppurtunities.id not in(select oppurtunity_id from sales_order)order by oppurtunities.id asc";
		return mysql_query("Select oppurtunities.id from oppurtunities JOIN oppurtunities_comments ON oppurtunities_id=oppurtunities.id JOIN oppurtunity_status ON oppurtunities_comments.status_id=oppurtunity_status.id  where (oppurtunity_status.status like '%Won' || oppurtunity_status.status like '%won') and lead_id='".$LeadId."' and oppurtunities.id not in(select oppurtunity_id from sales_order)order by oppurtunities.id asc");
	}
	function SaleOrder_Insert()
	{
		mysql_query("Update oppurtunities set description='".$_POST['description']."', quantity='".$_POST['quantity']."',date='".$_POST['date']."',company='".$_POST['company']."',contact_person='".$_POST['contactperson']."' where id='".$_POST['workid']."'");
		if($_POST['billing_address']=="" && $_POST['bill'])
			return mysql_query("INSERT INTO sales_order(lead_id,oppurtunity_id,po_number,shipping_address,billing_address,courier_by_id,is_self_or_customer_pay) values('".$_POST['lead_id']."','".$_POST['workid']."','".$_POST['po']."','".$_POST['shipping_address']."','".$_POST['shipping_address']."','".$_POST['courier_by_id']."','".$_POST['is_self_pay']."')");
		else
			return mysql_query("INSERT INTO sales_order(lead_id,oppurtunity_id,po_number,shipping_address,billing_address,courier_by_id,is_self_or_customer_pay) values('".$_POST['lead_id']."','".$_POST['workid']."','".$_POST['po']."','".$_POST['shipping_address']."','".$_POST['billing_address']."','".$_POST['courier_by_id']."','".$_POST['is_self_pay']."')");
	}
	function SaleOrder_Update()
	{
		mysql_query("Update oppurtunities set description='".$_POST['description']."', quantity='".$_POST['quantity']."',date='".$_POST['date']."',company='".$_POST['company']."',contact_person='".$_POST['contactperson']."' where id='".$_POST['workid']."'");
		if($_POST['billing_address']=="" && $_POST['bill'])
			return mysql_query("Update sales_order SET lead_id='".$_POST['lead_id']."',oppurtunity_id='".$_POST['workid']."',po_number='".$_POST['po']."',shipping_address='".$_POST['shipping_address']."',billing_address='".$_POST['shipping_address']."',courier_by_id='".$_POST['courier_by_id']."',is_self_or_customer_pay='".$_POST['is_self_or_customer_pay']."' where id='".$_POST['id']."'");
		else	
			return mysql_query("Update sales_order SET lead_id='".$_POST['lead_id']."',oppurtunity_id='".$_POST['workid']."',po_number='".$_POST['po']."',shipping_address='".$_POST['shipping_address']."',billing_address='".$_POST['billing_address']."',courier_by_id='".$_POST['courier_by_id']."',is_self_or_customer_pay='".$_POST['is_self_or_customer_pay']."' where id='".$_POST['id']."'");
	}
	function Select_Opportunity($WorkId)
	{
		return mysql_query("Select * from oppurtunities where id='".$WorkId."'");
	}
	function SelectProductCategoryById($Id)
	{
		return mysql_query("Select * From product_category where id='".$Id."'");
	}
	function SelectProductById($Id)
	{
		return mysql_query("Select * From product where id='".$Id."'");
	}
	function SelectCourierById($Id)
	{
		return mysql_query("Select * From couriers where id='".$Id."'");
	}
	function FetchLeadById($Id)
	{
		return mysql_query("Select * From leads where id='".$Id."'");
	}
	function SaleOrder_Select_ById()
	{
		return mysql_query("Select * from sales_order where id='".$_GET['id']."' || id='".$_GET['saleorderid']."' || id='".$_GET['SaleOrderId']."'");
	}
	function SelectStatus()
	{
		return mysql_query("Select * from salesorder_status order by sales_status asc");
	}
	function Select_Approver()
	{
		return mysql_query("Select * from approver where module='Sales'");
	}
	function SaleOrder_UpdateComments()
	{
		return mysql_query("insert into  saleorder_comments values('','".$_POST['saleorderid']."','".date('Y-m-d h:i:s')."','".$_POST['status']."','".$_POST['comments']."','".$_SESSION['id']."')");
	}
	function Select_Comments()
	{
			return mysql_query("select count(*) as total from saleorder_comments where sales_orderid='".$_GET['saleorderid']."' order by id desc");
	}
	function Select_CommentsByLimit($Start,$Limit)
	{
			return mysql_query("select * from saleorder_comments where sales_orderid='".$_GET['saleorderid']."' order by id desc Limit $Start,$Limit");
	}
	function FetchStatus($StatusId)
	{
		return mysql_query("select * from salesorder_status where id='".$StatusId."'");
	}	
	function FetchUser($UserId)
	{
		return mysql_query("select * from user where id='".$UserId."'");
	}
	function AddApprover($ApproverId,$SaleOrderId)
	{
		return mysql_query("Insert into sales_order_approval values('','".$SaleOrderId."','".$ApproverId."','".date('Y-m-d h:i:s')."')");
	}
	function SelectApprovers($SaleOrderId)
	{
		return mysql_query("Select * from sales_order_approval where sales_order_id='".$SaleOrderId."'");
	}
	function SelectApproversById($ApproverId,$SaleOrderId)
	{
		return mysql_query("Select * from sales_order_approval where sales_order_id='".$SaleOrderId."' and approved_by='".$ApproverId."'");
	}
	function FetchComments($Id)
	{
		return mysql_query("Select * from saleorder_comments where sales_orderid='".$Id."' order by sales_orderid desc");
	}
?>