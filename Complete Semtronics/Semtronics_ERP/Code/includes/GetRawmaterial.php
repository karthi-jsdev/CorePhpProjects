<?php
include('Config.php');
if($_GET['Search'])
{ 
		$rawmaterial = mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE partnumber like '%".$_GET['Search']."%'  OR description like '%".$_GET['Search']."%'");
		$rows = mysqli_num_rows($rawmaterial);
		echo '<b> Raw Material: </b><br/>';
		if($rows==0)
			echo 'No Raw Material Found';
		$i=1;
		while($rawmaterialvalue = mysqli_fetch_assoc($rawmaterial))
		{
			if($i%7==0)
			{
				echo $rawmaterialvalue['materialcode'];
				echo '<br/>';
			}
			else
				echo $rawmaterialvalue['materialcode'];
			if($rows>1)
				echo ',';
		$i++;
		}
}
?>