<?php
	include("Config.php");
	include("Complaint_Status_Queries.php");
	if(isset($_GET['ComplaintTypeId']))
	{
		$FetchComplaintType = mysqli_fetch_array(Complaint_Complainttype_Select($_GET['ComplaintTypeId']));
		if($FetchComplaintType['name'] == 'Hardware')
		{
			$results = "";
			echo "Select#Select#";
			$ComplaintSelectAssetItem = Complaint_Select_AssetItem();
			while($ComplaintFetchAssetItem = mysqli_fetch_array($ComplaintSelectAssetItem))
			{
				$results .= $ComplaintFetchAssetItem['itemname']."#". $ComplaintFetchAssetItem['id']."#";
			}
			echo substr($results, 0, -1);
		}
	}
?>