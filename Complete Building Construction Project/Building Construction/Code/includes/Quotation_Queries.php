<?php
	//Quotation Queries
	function Client_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM client ORDER BY id DESC");
	}
	function Vendorno()
	{
		return mysqli_query($_SESSION['connection'],"SELECT vendor_code FROM client WHERE id='".$_GET['client_id']."'");
	}
	function Quotationno()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation WHERE id='".$_GET['quotation_no']."'");
	}
	function Unit_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM unit ORDER BY id DESC");
	}
	function Select_All_Tax()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax ORDER BY id DESC");
	}
	function Select_All_Units()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM unit ORDER BY id ASC");
	}
	function Select_Last_Quotation_Id()
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation_no FROM quotation ORDER BY id DESC LIMIT 1");
	}
	function Select_Works_By_QuotationId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation_work.id,quotation_work.code, quotation_work.description, quotation_work.quantity, quotation_work.rate_per_unit, quotation_work.amount, unit.name FROM quotation_work
		JOIN unit ON unit.id=quotation_work.unit_id
		WHERE quotation_work.quotation_id='".$_SESSION['Quotation_Id']."' && quotation_work.id".str_replace(">''", "<>''", ">'".$_SESSION['Last_Work_Id']."'")." ORDER BY quotation_work.id ASC");
	}
	function Select_SubWorks_By_WorkId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation_work_division WHERE quotation_work_id='".$_SESSION['Last_Work_Id']."' && id".str_replace(">''", "<>''", ">'".$_SESSION['Last_SubWork_Id']."'")." ORDER BY id ASC");
	}
	function Select_Work_BySessionId()
	{
		$Work = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT quotation_work.id,quotation_work.code, quotation_work.description, quotation_work.quantity, quotation_work.rate_per_unit, quotation_work.amount, unit.name FROM quotation_work
		JOIN unit ON unit.id=quotation_work.unit_id
		WHERE quotation_work.quotation_id=".$_SESSION['Quotation_Id']." && quotation_work.id=".$_SESSION['Last_Work_Id']));
		return "<tr id='".$Work['id']."'><td>".$Work['code']."</td><td>".$Work['description']."</td>
			<td>".$Work['quantity']."</td><td>".$Work['rate_per_unit']."</td>
			<td>".$Work['name']."</td><td>".$Work['amount']."</td>
			<td><a href='#' onclick='Actions(".$Work['id'].", \"Edit\")' class='action-button' title='user-edit'><span class='user-edit'></span></a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='Actions(".$Work['id'].", \"Delete\")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td></tr>";
	}
	function Select_Work_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation_work WHERE id=".$_GET['id']);
	}
	function Select_SubWork_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation_work_division WHERE id=".substr($_GET['id'], 1, strlen($_GET['id'])));
	}
	function Select_SubWork_ByWorkId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation_work_division WHERE quotation_work_id=".$_GET['id']);
	}
	function Select_SubWork_BySubWorkId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation_work_division WHERE id=".$_GET['id']);
	}
	function Update_Work_ById()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE quotation_work SET description='".$_GET['work_descriptionE']."', quantity='".$_GET['work_quantityE']."', unit_id='".$_GET['unit_idE']."', rate_per_unit='".$_GET['rateE']."', amount='".$_GET['amountE']."' WHERE id='".$_GET['id']."'");
	}
	function Update_SubWork_ById()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE quotation_work_division SET subworkname='".$_GET['subwork_descriptionE']."', quantity='".$_GET['subwork_quantityE']."', length='".$_GET['lengthE']."', breath='".$_GET['breadthE']."', depth='".$_GET['depthE']."', area='".$_GET['areaE']."' WHERE id='".substr($_GET['id'], 1, strlen($_GET['id']))."'");
	}
	
	//
	function Insert_Quotation()
	{
		if(!$Quotation = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT id FROM quotation WHERE quotation_no='".$_GET['quotation_no']."'")))
		{
			mysqli_query($_SESSION['connection'],"INSERT INTO quotation VALUES('','".$_GET['quotation_no']."','".$_GET['client_id']."','".$_GET['subject']."','".$_GET['quotation_date']."')");
			$Quotation = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT id FROM quotation WHERE quotation_no='".$_GET['quotation_no']."'"));
		}
		else
			mysqli_query($_SESSION['connection'],"UPDATE quotation SET quotation_no='".$_GET['quotation_no']."', client_id='".$_GET['client_id']."', subject='".$_GET['subject']."' WHERE id='".$Quotation['id']."'");
		return $Quotation['id'];
	}
	function Insert_Work()
	{
		mysqli_query($_SESSION['connection'],"INSERT INTO quotation_work VALUES('','".$_GET['quotation_id']."','".$_GET['code']."','".$_GET['work_description']."','".$_GET['work_quantity']."','".$_GET['unit_id']."','".$_GET['rate']."','".$_GET['amount']."')");
		$Work = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT id FROM quotation_work WHERE quotation_id='".$_GET['quotation_id']."' ORDER BY id DESC LIMIT 1"));
		return $Work['id']."@";
	}
	function Insert_SubWork()
	{
		mysqli_query($_SESSION['connection'],"INSERT INTO quotation_work_division VALUES('','".$_GET['quotation_work_id']."','".$_GET['subcode']."','".$_GET['subwork_description']."','".$_GET['subwork_quantity']."','".$_GET['length']."','".$_GET['breadth']."','".$_GET['depth']."', '".($_GET['subwork_quantity']*$_GET['length'] * $_GET['breadth'] * $_GET['depth'])."')");
		Update_Work_Details();
	}
	function Update_Work_Details()
	{
		$SubWorkData = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT SUM(area) as area FROM quotation_work_division WHERE quotation_work_id='".$_GET['quotation_work_id']."'"));
		mysqli_query($_SESSION['connection'],"UPDATE quotation_work SET quantity='".$SubWorkData['area']."', amount=rate_per_unit*".$SubWorkData['area']." WHERE id=".$_GET['quotation_work_id']);
	}
	function Update_Work_Details_BySubWork_Id()
	{
		$SubWorkData = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT SUM(area) as area FROM quotation_work_division WHERE quotation_work_id='".$_GET['quotation_work_id']."'"));
		if(!$SubWorkData['area'])
			$SubWorkData['area'] = 0;
		if(!$SubWorkData['quantity'])
			$SubWorkData['quantity'] = 0;
		mysqli_query($_SESSION['connection'],"UPDATE quotation_work SET quantity='".$SubWorkData['area']."', amount=rate_per_unit*".$SubWorkData['area']." WHERE id=".$_GET['quotation_work_id']);
	}
	function Delete_Work_ById()
	{
		mysqli_query($_SESSION['connection'],"DELETE FROM quotation_work_division WHERE quotation_work_id=".$_GET['id']);
		mysqli_query($_SESSION['connection'],"DELETE FROM quotation_work WHERE id=".$_GET['id']);
	}
	function Delete_SubWork_ById()
	{
		mysqli_query($_SESSION['connection'],"DELETE FROM quotation_work_division WHERE id=".$_GET['id']);
	}
	
	//Quotation Summary
	function Quotation_Summary_Count()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) AS total FROM quotation");
	}
	function Quotation_Summary($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation.id, quotation.quotation_no, client.client_name, quotation.subject, quotation.quotation_date
		FROM quotation
		JOIN client ON client.id = quotation.client_id
		ORDER BY quotation.id DESC LIMIT $Start,$Limit");
	}
	
	//Quotation Retrieval
	function Quotation_Number()
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation_no, client_name,client.address, quotation.quotation_date,quotation.quotation_no,quotation.subject FROM quotation 
		JOIN client ON client.id = quotation.client_id
		WHERE quotation.id='".$_POST['quotation_id']."'");
	}
	function Quotation_Work_Retrieval()
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation_work.code,quotation_work.id as work_id, description, quantity, unit.name as unit, quotation_work.rate_per_unit, amount
						FROM quotation_work
						inner join unit on unit.id=quotation_work.unit_id
						where quotation_work.quotation_id='".$_POST['quotation_id']."'");
	}
	function Quotation_Work_Retrieval_Amount($QuotationId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT SUM(amount) as total FROM quotation_work WHERE quotation_id='".$QuotationId."'");
	}
	function Quotation_Subwork_Retrieval($quotation_work_id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT code,subworkname, quotation_work_division.quantity as subwork_quantity, length, breath, depth, area
						FROM quotation_work_division
						where quotation_work_division.quotation_work_id = $quotation_work_id");
						
	}
	function Quotation_Subwork_Count($quotation_work_id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) AS count
						FROM quotation_work_division
						where quotation_work_division.quotation_work_id = $quotation_work_id");
						
	}
	
	//Quotation Status
	
	function Status_Comments_Count()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM status_comments WHERE quotation_id='".$_GET['quotation_id']."'");
	}
	function Status_Comments_ByLimit($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM status_comments WHERE quotation_id='".$_GET['quotation_id']."' order by id desc LIMIT  $Start,$Limit");
	}
	function Comments_Status_name($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM status WHERE id='".$Id."'");
	}
	function Quotation_Amount_Count($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM quotation JOIN quotation_work ON  quotation.id = quotation_work.quotation_id WHERE quotation_id='".$Id."'");
	}
	function Quotation_Amount($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation.quotation_no,client.client_name,quotation.subject,quotation.quotation_date,SUM(quotation_work.amount) as amount FROM quotation JOIN quotation_work ON  quotation.id = quotation_work.quotation_id JOIN client ON client.id=quotation.client_id WHERE quotation_work.quotation_id='".$Id."' GROUP BY(quotation_work.quotation_id)");
	}
	// Filtering Status
	function Quotation_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation order by id desc");
	}
	function Client_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM client order by id desc");
	}
	function Status_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM status order by id desc");
	}
	function Status_Total_Rows()
	{
		/*if($_GET['quotaion_id'] || $_GET['client_id'] || $_GET['startdate'] || $_GET['enddate'] || $_GET['status_id'])
		{
			$_POST['quotaion_id'] = $_GET['quotaion_id'];
			$_POST['client_id'] = $_GET['client_id'];
			$_POST['startdate'] = $_GET['startdate'];
			$_POST['enddate'] = $_GET['enddate'];
			$_POST['status_id'] = $_GET['status_id'];
		}*/
		$Query = "WHERE ";
		if(($_GET['status_id']))
		{
			if(($_GET['status_id']))
				$Query .= "status.id='".$_GET['status_id']."'";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))
				$Query .= " AND quotation_date between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";	
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM quotation JOIN client ON quotation.client_id=client.id JOIN status_comments ON status_comments.id=quotation.id JOIN status ON status.id=status_comments.status_id ".str_replace("=''","!=''",$Query)." ");
		}
		else if(mysqli_num_rows(mysqli_query($_SESSION['connection'],"SELECT * FROM status_comments where quotation_id='".$_GET['quotaion_id']."'")))
		{
			if(isset($_GET['quotaion_id']) && isset($_GET['client_id']) && isset($_GET['status_id']))
				$Query .= "quotation.id='".$_GET['quotaion_id']."' AND client.id='".$_GET['client_id']."' AND status.id='".$_GET['status_id']."'";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))
				$Query .= " AND quotation_date between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM quotation JOIN client ON quotation.client_id=client.id JOIN status_comments ON status_comments.id=quotation.id JOIN status ON status.id=status_comments.status_id ".str_replace("=''","!=''",$Query)."");
		}
		else
		{
			if(isset($_GET['quotaion_id']) && isset($_GET['client_id']) && isset($_GET['status_id']))
				$Query .= "quotation.id='".$_GET['quotaion_id']."' AND client.id='".$_GET['client_id']."' ";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))
				$Query .= " AND quotation_date between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM quotation JOIN client ON quotation.client_id=client.id ".str_replace("=''","!=''",$Query)."");
		}
	}
	function Status_Data_ByLimit($Start,$Limit)
	{
		$Query = "WHERE ";
		if(($_GET['status_id']))
		{
			if(($_GET['status_id']))
				$Query .= "status.id='".$_GET['status_id']."'";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))
				$Query .= " AND quotation_date between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";	
			return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation JOIN client ON quotation.client_id=client.id JOIN status_comments ON status_comments.id=quotation.id JOIN status ON status.id=status_comments.status_id ".str_replace("=''","!=''",$Query)." LIMIT $Start,$Limit");
		}
		else if(mysqli_num_rows(mysqli_query($_SESSION['connection'],"SELECT * FROM status_comments where quotation_id='".$_GET['quotaion_id']."'")))
		{
			if(isset($_GET['quotaion_id']) && isset($_GET['client_id']) && isset($_GET['status_id']))
				$Query .= "quotation.id='".$_GET['quotaion_id']."' AND client.id='".$_GET['client_id']."' AND status.id='".$_GET['status_id']."'";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))
				$Query .= " AND quotation_date between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";
			return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation JOIN client ON quotation.client_id=client.id JOIN status_comments ON status_comments.id=quotation.id JOIN status ON status.id=status_comments.status_id ".str_replace("=''","!=''",$Query)." LIMIT $Start,$Limit");
		}
		else
		{
			if(isset($_GET['quotaion_id']) && isset($_GET['client_id']) && isset($_GET['status_id']))
				$Query .= "quotation.id='".$_GET['quotaion_id']."' AND client.id='".$_GET['client_id']."' ";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))
				$Query .= " AND quotation_date between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";
			return mysqli_query($_SESSION['connection'],"SELECT * FROM quotation JOIN client ON quotation.client_id=client.id ".str_replace("=''","!=''",$Query)." LIMIT $Start,$Limit");
		}
	}
	
	//Code Value
	
	function Code_Description()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM work WHERE code = '".$_GET['code']."'");
	}
	function subCode_Description()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM sub_work WHERE code = '".$_GET['subcode']."'");
	}
	?>