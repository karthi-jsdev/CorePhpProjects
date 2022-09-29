<?php
if($_POST['DB'])
{
	date_default_timezone_set('Asia/Kolkata'); 
	$tables = '*';
	$link = mysqli_connect('mysql_hostname','mysql_user','$mysql_password');
	mysqli_select_db($mysql_database,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($_SESSION['connection'],'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
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
		$result = mysqli_query($_SESSION['connection'],'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($_SESSION['connection'],'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
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
	$handle = fopen('Database Backup/BBH_Backup '.str_replace("-", "_", date("d-m-Y H-i")).'.sql','w+');
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
			<a href="Database Backup/BBH_Backup <?php echo str_replace("-", "_", date("d-m-Y H-i")); ?>.sql" title="BBHBackup" target="_blank" download>BBH Database Download <?php echo date("d-m-Y H:i")?></a>
		</td>
	</tr>
</table>
<?php
} ?>

<br/><br/><br/><br/>
<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>">
	<input type="submit" class="button button-green"  name="DB" value="DataBase BackUp" />
</form>