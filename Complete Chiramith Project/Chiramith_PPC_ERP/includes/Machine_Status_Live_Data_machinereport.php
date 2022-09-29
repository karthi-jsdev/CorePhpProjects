<?php
ini_set("display_errors","0");
if($_GET['Export'])
{
	header("Content-Type: application/msexcel");
	header("Content-Disposition: attachment; filename=".date("d_m_Y").".xls");
	echo "<h2><center>Machine Status : ".date("d-m-Y")."</center></h2>";
} ?>
<style>
	.table
	{
		border: 2px solid black;
	}
	.tr,.th,.td
	{
		border: 1px solid black;
		color:white;
	}
</style>
<?php
	include("Config.php");
	include("Machine_Status_Queries.php");
	ini_set("display_errors","0");
	$Sections = $SubSections = array("");
	$GetSections = Select_All_Sections();
	$GetSubSections = Select_All_SubSections();
	while($GetSection = mysqli_fetch_array($GetSections))
		$Sections[] = $GetSection['name'];
	while($GetSubSection = mysqli_fetch_array($GetSubSections))
		$SubSections[] = $GetSubSection['name'];
	$Layout = array(array(3), array(1, 2));
	$LayoutStyle = array("<table><tr><td rowspan='2' style='padding-left:15px;'>", "</td><td style='padding-left:20px;'>", "</td></tr><tr><td style='padding-left:20px;padding-top:5px;'>", "</td></tr><table>");
	
	$Assigned4Future = $Assigned = $Nearing = $NotAssigned = $Available = $NotAvailable = 0;
	$Machine_Status = Machine_Status_Report();
	$Machines[][] = $Machines[] = $Machines = $Size = array();
	while($Machine = mysqli_fetch_assoc($Machine_Status))
	{
		if((!$_GET['section_id'] && !$_GET['subsection_id'])|| ($_GET['section_id'] == $Machine['section_id'] || $_GET['subsection_id'] == $Machine['subsection_id']))
		{
			$Machine['location_reference_id'] = ($Machine['location_reference_id'] % 30);
			if($Machine['tentative_enddate'] != NULL)
			{
				if($Machine['10tentative_date'] && (!$_GET['status_id'] || $_GET['status_id'] == 2))
				{
					$Machines[$Machine['section_id']][$Machine['subsection_id']][$Machine['location_reference_id']] = "<td class='td' style='background:blue;width:70px;'><center><div title='Location : ".$Machine['name'].", Machine Type : ".$Machine['type'].", Specification : ".$Machine['specification'].", Customer : ".$Machine['customer'].", Product : ".$Machine['product'].", Job Setting Date : ".$Machine['tentative_date'].", Tentative End Date : ".$Machine['tentative_enddate']."'><label>".$Machine['machine_number']."</label></div></center></td>";
					$Nearing++;
				}
				else if(!$Machine['futurejob'] && $Machine['tentative_enddate'] > $TenTentative && (!$_GET['status_id'] || $_GET['status_id'] == 1))
				{
					$Machines[$Machine['section_id']][$Machine['subsection_id']][$Machine['location_reference_id']] = "<td class='td' style='background:green;width:70px;'><center><div title='Location : ".$Machine['name'].", Machine Type : ".$Machine['type'].", Specification : ".$Machine['specification'].", Customer : ".$Machine['customer'].", Product : ".$Machine['product'].", Job Setting Date : ".$Machine['tentative_date'].", Tentative End Date : ".$Machine['tentative_enddate']."'><label>".$Machine['machine_number']."</label></div></center></td>";
					$Assigned++;
				}
				else if($Machine['futurejob'] && !$Machine['10tentative_date'] && (!$_GET['status_id'] || $_GET['status_id'] == 3))
				{
					$Assigned4Future++;
					$Machines[$Machine['section_id']][$Machine['subsection_id']][$Machine['location_reference_id']] = "<td class='td' style='background:pink;width:70px;'><center><div title='Location : ".$Machine['name'].", Machine Type : ".$Machine['type'].", Specification : ".$Machine['specification'].", Customer : ".$Machine['customer'].", Product : ".$Machine['product'].", Job Setting Date : ".$Machine['tentative_date'].", Tentative End Date : ".$Machine['tentative_enddate']."'><label>".$Machine['machine_number']."</label></div></center></td>";
				}
			}
			else if($Machine['machine_number'] != NULL && (!$_GET['status_id'] || $_GET['status_id'] == 4))
			{
				$NotAssigned++;
				$Machines[$Machine['section_id']][$Machine['subsection_id']][$Machine['location_reference_id']] = "<td class='td' style='background:red;width:70px;'><center><div title='Location : ".$Machine['name'].", Machine Type : ".$Machine['type'].", Specification : ".$Machine['specification']."'><label>".$Machine['machine_number']."</label></div></center></td>";
			}
		}
	}
	$MaxSectionCount = 0;
	foreach($Layout as $SectionIds)
	{
		if(count($SectionIds) > $MaxSectionCount)
			$MaxSectionCount = count($SectionIds);
	}
	$TotalMachines = mysqli_fetch_array(Count_Available_Machines());
	echo "
	<center>
		<table>
			<tr>
				<td colspan='10'>
					<table>
						<tr>
							<td style='background:green;width:20px;'></td><td colspan='6'>&nbsp;Machine Assigned-(".$Assigned.")&nbsp;&nbsp;&nbsp;</td>
							<td style='background:blue;width:20px;'></td><td colspan='6'>&nbsp;Machine Assigned With Nearing-(".$Nearing.")&nbsp;&nbsp;&nbsp;</td>";
							if($_GET['Export'])
							echo "</tr>
							<tr>";
							echo "<td style='background:pink;width:20px;'></td><td colspan='6'>&nbsp;Machine Assigned For Future-(".$Assigned4Future.")&nbsp;&nbsp;&nbsp;</td>
							<td style='background:red;width:20px;'></td><td colspan='6'>&nbsp;Machine Not Assigned-(".($TotalMachines['total']-($Assigned+$Nearing+$Assigned4Future)).")&nbsp;&nbsp;&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</center><br />";
	$L = 1;
	foreach($Layout as $SectionIds)
	{
		foreach($SectionIds as $SectionId)
		{
			$TDData = $LayoutStyle[$L++-1]."<table class='table'>
			<tr class='tr'><td class='td' colspan='0' align='center' style='background:gray'><b>Section ".$Sections[$SectionId]."</b></td></tr>";
			$SSCount = 0;
			$SubSectionIds = array();
			$SubSectionISQuery = SubSection_Select_Required($SectionId);
			$TDSubSections = "<tr class='tr'>";
			while($SubSectionId = mysqli_fetch_assoc($SubSectionISQuery))
			{
				$SubSectionIds[] = $SubSectionId['subsection_id'];
				$TDSubSections .= "<td class='td' align='center' style='background:gray'>".$Sections[$SectionId].$SubSections[$SubSectionId['subsection_id']]."</b></td>";
				$SSCount++;
			}
			echo str_replace("colspan='0'", "colspan='".($SSCount+1)."'", $TDData);
			$TDSubSections .= "</tr>";
			$MaxLReferenceId = mysqli_fetch_assoc(Location_Reference_Select_Id($SubSectionIds));
			$MaxLReference = substr($MaxLReferenceId['reference'],2)%30;
			for($i = $MaxLReference; $i > 0; $i--)
			{
				echo "<tr class='tr'>";
				foreach($SubSectionIds as $SubSectionId)
				{
					if($Machines[$SectionId][$SubSectionId][$i])
						echo "".$Machines[$SectionId][$SubSectionId][$i]."";
					else
						echo "<td class='td' style='background:white;width:70px;'></td>";
				}
				echo "<td width='20px' align='center' style='background:gray'>&nbsp;".$i."&nbsp;</td></tr>";
			}
			echo $TDSubSections."</table></td>";
		}
	}
	echo "</table>";
	?>