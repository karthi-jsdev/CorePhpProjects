<?php
if($_POST['DB'])
{
	date_default_timezone_set('Asia/Kolkata'); 
	$tables = '*';
	$link = mysql_connect($mysql_hostname,$mysql_user,$mysql_password);
	mysql_select_db($mysql_database,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	//$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	$handle = fopen('Database Backup/Chiramith_Backup '.str_replace("-", "_", date("d-m-Y H-i")).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	
	?><br/>
<br/>
<table class="paginate sortable">
	<tr>
		<td>
			Newly Created Database
		</td>
	</tr>
	<tr>
	<td>
		<a href="Database Backup/Chiramith_Backup <?php echo str_replace("-", "_", date("d-m-Y H-i")); ?>.sql" title="ChiramithBackup" target="_blank" download>Chiramith Database Download <?php echo date("d-m-Y H:i")?></a>
	</td>
	</tr>
</table>
<?php
} ?>

<br/>
<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>">
<input type="submit" class="button button-blue"  name="DB" value="DataBase BackUp">
<br/>
<br/>
<div id="dailystatus">
</div>
<br/>
<a href="#" class="button button-blue" onclick="DailyStatus()">Report Machine Status Update</a>
</form>
<script>
	function DailyStatus()
	{
		$.post("includes/Machine_Daily_Status_Actions.php?Action=Insert",function(Response)
		{
			$("#dailystatus").html('<div class="message success">Daily Report Machine Status Updated Successfully</div>');
		});
	}
</script>