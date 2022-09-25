<?php
	include("Config.php");
	$Amounts = explode(',',$_GET['Amount']);
	$Categorys = explode(',',$_GET['Category']);
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	header("Content-Type: application/msword");
	header("Content-Disposition: attachment; filename=".str_replace(" ", "_", date("d-m-Y H-i")).".doc");
	echo '<div style="border:1px solid;border-radius:5px;width:500px">
		<table>
				<tr>
					<td style="width:150px;padding-left:40px;"><br/>
						<font size="2px"><strong> Pay To:'.$_GET['PayTo'].'</strong></font>
					</td>
					<td><br/>
						<font size="2px"><strong> Payment Date:'.$_GET['Date'].'</strong></font>
					</td>
				</tr></table>';
		$i = 0;
		$Total = 0;
		echo '<br/><table><tr><td style="width:150px;padding-left:40px;"> <font size="2"><strong>Category</strong></font></td><td><font size="2px"><strong>Amount</strong></font></td></tr>';
		foreach($Categorys as $Category)
		{
			echo '<tr><td style="width:150px;padding-left:40px;">'.$Category.'</td><td align="right">'.$Amounts[$i].'</td></tr>';
			$Total += $Amounts[$i];
			$i++;
		}
		echo '<tr><td><hr/></td><td><hr/></td></tr><tr><td style="width:130px;padding-left:120px;"><font size="2"><strong>Total:</strong></font></td><td style="padding-left:20px;"><strong>'.$Total.'</strong></td></table>
			<br/></div>';
?>