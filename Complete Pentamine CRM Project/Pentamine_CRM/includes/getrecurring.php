<?php
	include('config.php');
	ini_set( "display_errors", "0" );
	if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all') && ($_GET['status'] == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all') && $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_status="'.$_GET['status'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && ($_GET['frequency'] == 'all') && $_GET['alert-date'] && ($_GET['status']  == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_alertdate="'.$_GET['alert-date'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && ($_GET['frequency'] == 'all') && $_GET['alert-date']  &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_status="'.$_GET['status'].'" AND recurring_alertdate= "'.$_GET['alert-date'].'" ORDER BY id DESC');	
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && $_GET['frequency'] && ($_GET['alert-date'] == 'all')  &&  ($_GET['status'] == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_frequency="'.$_GET['frequency'].'"  ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && $_GET['frequency'] && ($_GET['alert-date'] == 'all')  &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_frequency="'.$_GET['frequency'].'"  AND recurring_status="'.$_GET['status'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && $_GET['frequency'] && $_GET['alert-date']  &&  ($_GET['status'] == 'all') )
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_frequency="'.$_GET['frequency'].'" AND recurring_alertdate="'.$_GET['alert-date'].'" ORDER BY id DESC');	
	else if(($_GET['company'] == 'all') && ($_GET['product'] == 'all') && $_GET['frequency'] && $_GET['alert-date']  &&  $_GET['status'] )
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_frequency="'.$_GET['frequency'].'" AND recurring_alertdate="'.$_GET['alert-date'].'" AND recurring_status="'.$_GET['status'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && $_GET['product']  && ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all')  &&  ($_GET['status'] == 'all') )
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  ORDER BY id DESC');		
	else if(($_GET['company'] == 'all') && $_GET['product']  && ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all')  &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_status="'.$_GET['status'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && $_GET['product']  && ($_GET['frequency'] == 'all') && $_GET['alert-date'] &&  ($_GET['status'] == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_alertdate="'.$_GET['alert-date'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && $_GET['product']  && ($_GET['frequency'] == 'all') && $_GET['alert-date'] &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_alertdate="'.$_GET['alert-date'].'" AND  recurring_status="'.$_GET['status'].'" ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && $_GET['product']  && $_GET['frequency']  && ($_GET['alert-date'] == 'all') &&  ($_GET['status'] == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_frequency="'.$_GET['frequency'].'"  ORDER BY id DESC');
	else if(($_GET['company'] == 'all') && $_GET['product']  && $_GET['frequency']  && ($_GET['alert-date'] == 'all') &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_frequency="'.$_GET['frequency'].'" AND recurring_status="'.$_GET['status'].'"  ORDER BY id DESC');		
	else if(($_GET['company'] == 'all') && $_GET['product']  && $_GET['frequency']  && $_GET['alert-date']  &&  ($_GET['status']== 'all'))
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_frequency="'.$_GET['frequency'].'" AND recurring_alertdate="'.$_GET['alert-date'].'"  ORDER BY id DESC');		
	else if(($_GET['company'] == 'all') && $_GET['product']  && $_GET['frequency']  && $_GET['alert-date']  &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE  recurring_product="'.$_GET['product'].'"  AND recurring_frequency="'.$_GET['frequency'].'" AND recurring_alertdate="'.$_GET['alert-date'].'"  AND recurring_status="'.$_GET['status'].'"  ORDER BY id DESC');		
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all') && ($_GET['status'] == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'" ORDER BY id DESC');	
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all') && $_GET['status'] )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_status="'.$_GET['status'].'" ORDER BY id DESC');		
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date']) && ($_GET['status']  == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"   AND recurring_alertdate="'.$_GET['alert-date'].'" ORDER BY id DESC');		
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date']) && $_GET['status'] )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_status="'.$_GET['status'].'" AND recurring_alertdate="'.$_GET['alert-date'].'" ORDER BY id DESC');	
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  $_GET['frequency'] && ($_GET['alert-date'] == 'all') && ($_GET['status']  == 'all') )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_frequency="'.$_GET['frequency'].'"  ORDER BY id DESC');	
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  $_GET['frequency'] && ($_GET['alert-date'] == 'all') && $_GET['status']  )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_frequency="'.$_GET['frequency'].'"  and recurring_status="'.$_GET['status'].'"   ORDER BY id DESC');
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  $_GET['frequency'] && $_GET['alert-date']  && ($_GET['status']  == 'all')  )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_frequency="'.$_GET['frequency'].'"  and recurring_alertdate="'.$_GET['alert-date'].'"   ORDER BY id DESC');	
	else if($_GET['company'] && ($_GET['product'] == 'all') &&  $_GET['frequency'] && $_GET['alert-date']  && $_GET['status']   )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_frequency="'.$_GET['frequency'].'"  and recurring_alertdate="'.$_GET['alert-date'].'"  AND recurring_status="'.$_GET['status'].'" ORDER BY id DESC');		
	else if($_GET['company'] && $_GET['product'] &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all') && ($_GET['status'] == 'all')  )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   ORDER BY id DESC');			
	else if($_GET['company'] && $_GET['product'] &&  ($_GET['frequency'] == 'all') && ($_GET['alert-date'] == 'all') && $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   AND recurring_status="'.$_GET['status'].'"  ORDER BY id DESC');				
	else if($_GET['company'] && $_GET['product'] &&  ($_GET['frequency'] == 'all') && $_GET['alert-date']  && ($_GET['status'] == 'all'))
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   AND recurring_alertdate="'.$_GET['alert-date'].'"  ORDER BY id DESC');					
	else if($_GET['company'] && $_GET['product'] &&  ($_GET['frequency'] == 'all') && $_GET['alert-date']  && $_GET['status'] )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   AND recurring_alertdate="'.$_GET['alert-date'].'"  AND recurring_status="'.$_GET['status'].'" ORDER BY id DESC');						
	else if($_GET['company'] && $_GET['product'] &&  $_GET['frequency'] && ($_GET['alert-date'] == 'all') && ($_GET['status'] == 'all') )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   AND recurring_frequency="'.$_GET['frequency'].'" ORDER BY id DESC');							
	else if($_GET['company'] && $_GET['product'] &&  $_GET['frequency'] && ($_GET['alert-date'] == 'all') && $_GET['status'] )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   AND recurring_frequency="'.$_GET['frequency'].'" AND recurring_status="'.$_GET['status'].'"ORDER BY id DESC');								
	else if($_GET['company'] && $_GET['product'] &&  $_GET['frequency'] && $_GET['alert-date']  && ($_GET['status'] == 'all') )
		$all_recurring = mysql_query('Select * FROM recurring  WHERE  recurring_client="'.$_GET['company'].'"  AND recurring_product="'.$_GET['product'].'"   AND recurring_frequency="'.$_GET['frequency'].'" AND recurring_alertdate="'.$_GET['alert-date'].'"ORDER BY id DESC');									
	else if($_GET['company']  && $_GET['product'] && $_GET['frequency'] && $_GET['alert-date']  &&  $_GET['status'])
		$all_recurring = mysql_query('Select * FROM recurring WHERE recurring_client="'.$_GET['company'].'" AND recurring_status="'.$_GET['status'].'" AND recurring_alertdate= "'.$_GET['alert-date'].'" AND recurring_frequency= "'.$_GET['frequency'].'" AND recurring_product= "'.$_GET['product'].'" ORDER BY id DESC');	
	if(mysql_num_rows($all_recurring))
	{
		echo "<table><tr><td><h1>Recurring Summary of All Company</h1></td></tr></table>#
		<table  border='1'  align='left' class='paginate sortable full'>
				<tr>
					<th align='left'>Company Name</th>
					<th align='left'>Product Type</th>
					<th align='left'>Frequency</th>
					<th align='left'>Alert-Date</th>
					<th align='left'>Status</th>
				</tr>";
				while($fetch_recurring = mysql_fetch_array($all_recurring))
				{					
					echo "<tr>";
					$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$fetch_recurring['recurring_client']."'"));
							echo	"<td>".$query['cname']."</td>";
					$query1 = mysql_fetch_array(mysql_query("SELECT * FROM producttype where slno='".$fetch_recurring['recurring_product']."'"));
							echo  "<td>".$query1['type']."</td>";
							echo  "<td>".$fetch_recurring['recurring_frequency']."</td>";
							echo  "<td>".$fetch_recurring['recurring_alertdate']."</td>";
							echo  "<td>".$fetch_recurring['recurring_status']."</td>";
							
				echo "</tr>";	
				}	
		echo "</table>";
	}
	else
	{
		echo "No Leads";
	}
	
?>