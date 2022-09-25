<?php
class Database{
	var $dbh;
	var $dbLink;
	
	function Database(){
		global $config;

		#$dbh	=	mysql_pconnect('localhost','root','');
		$dbh	=	mysql_pconnect('localhost','root','');
		if(!is_resource($dbh)){
			//die("Error in Connecting to the Database Server...");
			die(mysql_error());
		}

		$dbLink	=	mysql_select_db('zeboba_tv',$dbh);
	}
	
	function select($sql,$return_type=""){ 
		$retResult	=	array();
		$rs	=	mysql_query($sql);		
		if($return_type == "")
		{
			while( ($row	=	@mysql_fetch_assoc($rs))){
				$retResult[]	=	$row;
				
			}
			return $retResult;
		}
		else if($return_type == 'resource')
			return $rs;
			
	}
	function cms_query($id){ 
		$sql_cms=mysql_query("select * from contents where content_id=".$id." and content_settings=1");
		$arr_cms=mysql_fetch_array($sql_cms);
		$content=stripslashes($arr_cms['content_desc']);
		return $content;
			
	}
			
function selectFromTable($table_name,$where = ""){
			if($where == ""){
				$query = "SELECT * FROM $table_name";
			}else{			
				$query = "SELECT * FROM $table_name WHERE $where";
			}
			//echo $query;
			$result = $this->execQuery($query);
			return $result;
		}
	function execQuery($query){
			$result = mysql_query($query) or die(mysql_error());
			return $result;
		}
	
	function num_rows($sql)
	{
		$rs	=	mysql_query($sql);
		return @mysql_num_rows($rs);
	}
	function insert($table, $arFieldsValues){
		$fields	=	array_keys($arFieldsValues);
		$values	=	array_values($arFieldsValues);
		$formatedValues	=	array();
		foreach($values as $val){
			//if(!is_numeric($val) && $val !='now()')
			//{			
				$val	=	"'".mysql_escape_string($val)."'";
				
			//}
			$formatedValues[]	=	$val;
		}
		
		
		$sql	=	"INSERT INTO ".$table." (";
		$sql	.=	join(", ",$fields).") ";
		$sql	.=	"VALUES( ";
		$sql	.=	join(", ",$formatedValues);
		$sql	.=	")";			
		mysql_query($sql) or die("Error: ".mysql_errno()." ".mysql_error());		
		return mysql_insert_id();
		
		if(mysql_query($sql)) return mysql_insert_id();
		else return false;	
	}
	
	function insert_check($table, $arFieldsValues,$field1)
	{
		$values	=	array_values($arFieldsValues);
		foreach($values as $val)
			{
				$sql='INSERT INTO '.$table.' VALUES('.$field1.','.$val.')';
				//echo $sql;
				mysql_query($sql) or die(mysql_error());
			}
		return mysql_insert_id(); //If the table contains autoincrement field
	}
	function update($table, $arFieldsValues, $strCondition=''){
	
		$formatedValues	=	array();
		foreach($arFieldsValues as $key => $val){
			//if(!is_numeric($val)){
				$val	=	"'".mysql_escape_string($val)."'";
			//}
			$formatedValues[]	=	"$key = $val";
		}
		
		$sql	=	"UPDATE ".$table." SET ";
		$sql	.=	join(", ",$formatedValues);
		if($strCondition != "") {
			$sql	.=	" WHERE ".$strCondition;
		}
		//echo $sql;
		$rs	=	mysql_query($sql) or die(mysql_error());
		return mysql_affected_rows();
		if(mysql_query($sql)) return mysql_affected_rows();
		else return false;
	}
	
	function update_check($table, $arFieldsValues,$field1)
	{
		$sql='DELETE FROM '.$table.' where package_id='.$field1;
		mysql_query($sql) or die(mysql_error());
		
		$values	=	array_values($arFieldsValues);
		foreach($values as $val)
			{
				$sql='INSERT INTO '.$table.' VALUES('.$field1.','.$val.')';
				mysql_query($sql) or die(mysql_error());
			}
		return mysql_insert_id(); //If the table contains autoincrement field*/
	}

	function delete($table, $strCondition=''){
	
		$sql	=	"DELETE FROM ".$table;
		
		if($strCondition != "" && (is_string($strCondition) or is_numeric($strCondition))) 
		{
			$sql	.=	" WHERE ".$strCondition;
		
		}
		elseif($strCondition != "" && is_array($strCondition))
		{
			$conditional_fields = array();
			$sql .= " WHERE ";
			foreach($strCondition as $field => $value)
			{
				$conditional_fields[] = $field."='".$value."'";				
			}
			
			$sql .= implode(' and ', $conditional_fields);
			

		}
	//	print $sql;
			$rs	=	mysql_query($sql) or die(mysql_error());
		return mysql_affected_rows();
	}
	
	function executeQry($sql) 
	{
		$rs	=	mysql_query($sql) or die(mysql_error());
		return mysql_affected_rows();
	}
	function datetime($diff)
	{
			$timestamp=time();
			$tm=86400*$diff;
			$tm=$timestamp+$tm;
			return (date('Y-m-d',$tm));
	}
	function daysDifference($endDate, $beginDate)
	{
	
	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
	}
/*****************************************************************************/
	function getAds()
	{
		$read_ads = "
		SELECT resource_link, banner, ad_position 
		FROM ads 
		WHERE ad_status ='active' 
		AND payment_status =1 
		AND trans_id IS NOT NULL 
		AND closing_date > CURDATE() 
		AND admin_approval =1 
		AND removed_by_user =0 
		AND expired =0 		 
		ORDER BY RAND()";
		$result_set = $this->select($read_ads);
		if(empty($result_set)) return false;
		$record_set = array();
		$index = 0;
		foreach($result_set as $ad)
		{
			$ad = array_map('stripslashes', $ad);
			if($ad['ad_position'] == 'header' and empty($record_set['header']))
			{
				$record_set['header']['resource_link'] = $ad['resource_link'];
				$record_set['header']['banner'] = $ad['banner'];
			} else {
				$record_set['footer'][$index]['resource_link'] 	= $ad['resource_link'];
				$record_set['footer'][$index]['banner'] 		= $ad['banner'];
				$index ++;
			}			
		}
		if(empty($record_set)) return false;
		return $record_set;
	}		
}
?>
