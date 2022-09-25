<br />
<?php
if($_SESSION['SM_role'])
{
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Student Search";
	//if($_SESSION['SM_roleid'] == 1 || $_SESSION['SM_roleid'] == 2)
	$subheaders = array("Student Search", "Employee","Payroll","Fee Collections","StudentInformation","PaymentInformation","PaymentCollectionInformation","StudentPaidStatus");
	for($i = 0; $i < count($subheaders); $i++)
	{
		$split = explode("_", $subheaders[$i]);
		for($j = 0; $j < count($split); $j++)
		{
			if($j == 0)
				$subpagename = $split[$j];
			//else
				//$subpagename = $subpagename." ".$split[$j];
		}
		if($_GET['subpage'] == $subheaders[$i])
			echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		else
			echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
	}
	$filename = "includes/".$_GET['subpage'].".php";
	if(file_exists($filename) && in_array($_GET['subpage'], $subheaders))
	{
		echo '<div class="columns" style="width:1000px">';
		include($filename);
		echo '</div>';
	}
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
	?>
	<div class="clear">&nbsp;</div>
<?php
}
else
{ ?>
	<div class="message info">
		<h3><font color="red">Note :</font></h3>
		<p>This page is only for Admins. If you have credentials of either, Please login to continue.</p>
	</div>
<?php
} ?>