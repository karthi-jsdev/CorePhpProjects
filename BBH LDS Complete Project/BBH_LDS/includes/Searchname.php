<?php
	ini_set("display_errors","0");
	if($_GET['Nameid'])
	{
	
	?>
		<h3>Leave Apply List Of Present Day
			<?php
			$ResourceTotalRows = mysqli_fetch_assoc(Present_Select_Count_All_Name(chr($_GET['Nameid']))); 
			echo " : No. of List - ".$ResourceTotalRows['total'];
			?>
		</h3>
		<?php
			for($i=65;$i<=90;$i++)
			{
				if($_GET['Nameid']==$i)
					echo '<a href="#" onclick="Searching('.$i.')"><font color="red">'.chr($i)."</font></a> | "; 
				else
					echo '<a href="#" onclick="Searching('.$i.')">'.chr($i)."</a> | "; 
			}
		?>
		<hr />	
		<table class="paginate sortable full" style="width:900px;">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Name</th>
				<th align="left">Group</th>
				<th align="left">Department</th>
				<th align="left">Comments</th>
				<th align="left">Start Date</th>
				<th align="left">End Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$ResourceTotalRows['total'])
				echo '<tr><td colspan="12"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$total_pages = ceil($ResourceTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$Start = ($_GET['pageno']-1)*$Limit;
			if($_GET['pageno']>=2)
				$i = $Start+1;
			else
				$i =1;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			$ResourceUpdate = Present_Select_ByLimit_Name((chr($_GET['Nameid'])),$Start, $Limit);
			while($Resource = mysqli_fetch_assoc($ResourceUpdate))
			{ 
				echo "<td style='vertical-align:middle'>".($i)."</td>";
				echo "<td id='imageid".$i."' onmouseover='Displayimage(".$i.");' onmouseout='Hideimage(".$i.");' style='vertical-align:middle'>".$Resource['title'].".".$Resource['Name']."<div id='img".$i."' style='display:none'><img src='data:image/jpeg;base64,".base64_encode($Resource['photo'])."' width='100px' height='150px' alt='photo'/></div></td>";
				echo "<td style='vertical-align:middle'>".$Resource['groupName']."</td>";
				echo "<td style='vertical-align:middle'>".$Resource['departmentName']."</td>";
				echo "<td style='vertical-align:middle'>".$Resource['comments']."</td>";
				echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['startdate']))."</td>";
				echo "<td style='vertical-align:middle'>".date('d-m-Y',strtotime($Resource['enddate']))."</td>";
				//echo "<td><img src='data:image/jpeg;base64,".base64_encode($Resource['photo'])."'  width='100px' height='150px' alt='photo'/></td>";
				echo "<!--td style='vertical-align:middle'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Resource['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Resource['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td-->
				</tr>";
				$i++;
			} ?>
		</tbody>
	</table>
	
<?php	
	if(!$_GET['subpage'])
			$_GET['file'] = "BBHLDSUI";
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
		if($total_pages > 1)
			include("includes/Pagination.php");
	}
?>
<script>
	function Displayimage(id) 
	{
		 document.getElementById('img'+id).style.display="block";
    }  
	function Hideimage(id) 
	{
		document.getElementById('img'+id).style.display = "none";
	} 
</script>