<?php
include('Config.php');
include('Opportunities_Queries.php');
?>
<select id="oppurtunity_id" name="oppurtunity_id">
	<option value="Select">Select</option>
<?php
if($_GET['lead_id'])
{
	$Sample_list = Sample_Opportunity_Item_List();
	while($list = mysql_fetch_assoc($Sample_list))
	{
		$Work_d = $list['id'];
		if(strlen($Work_d)==1)
			$work = "WORK000000".$Work_d;
		else if(strlen($Work_d)==2)
			$work = "WORK00000".$Work_d;
		else if(strlen($Work_d)==3)
			$work = "WORK0000".$Work_d;
		else if(strlen($Work_d)==4)
			$work = "WORK000".$Work_d;
		else if(strlen($Work_d)==5)
			$work = "WORK00".$Work_d;
		else if(strlen($Work_d)==6)
			$work = "WORK0".$Work_d;
		else if(strlen($Work_d)==7)
			$work = "WORK".$Work_d;
		echo'<option value="'.$list['id'].'">'.$work.'</option>';
	}
}
?>
</select>