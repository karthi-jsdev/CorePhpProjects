<?php
ini_set("display_errors","0");
if(!$_GET['Initial'])
{ ?>
	<h3>
	<?php
	include("Config.php");
	include("Issuance_Queries.php");
	$TotalIssuance = mysql_fetch_assoc(Count_Issuance_ByGroup());
	echo "Total No. of Issuance Summaries - ".$TotalIssuance['total'];
	?>
	</h3><hr />
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.No.</th>
				<th align="left">Issuance Code</th>
				<th align="left">Issued To</th>
				<th align="left">Total Raw Materials</th>
				<th align="left">Date and Time</th>
				<th align="left">Issuance Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$TotalIssuance['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$_GET['total_pages'] = ceil($TotalIssuance['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			
			$Issuances = Select_Issuance_ByGroup($Start, $Limit);
			while($Issuance = mysql_fetch_assoc($Issuances))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".++$i."</td>
					<td><a href='?page=Stores&subpage=spage->Issuance,ssubpage->Status&number=".$Issuance['number']."'>".$Issuance['number']."</a></td>
					<td>".$Issuance['issuanceuser']."</td>
					<td>".$Issuance['total']."</td>
					<td>".substr($Issuance['issueddate'],0,16)."</td>
					<td>".$Issuance['issuancedate']."</td>
				</tr>";
			} ?>
		</tbody>
	</table>
	<div class="clear">&nbsp;</div>
<?php
}
$_GET[limit] = 10;

if($_GET['total_pages'] > 1)
{ ?>
	<ul class="pagination clearfix">
		<?php
		if($_GET['pageno'] > 1)
		{
			echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",1,$_GET[limit])'>First</a></li>
			<li class='prev'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($_GET['pageno']-1).",$_GET[limit])'>&laquo;</a></li>";
		}
		
		if($_POST['action'] == "add" && $_GET['total_pages'] > 5)
		{
			for($i=$_GET['total_pages']-4; $i<=$_GET['total_pages']; $i++)
			{
				if($i == $_GET['total_pages'] && $_POST['action'] == "add")
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($_GET['pageno']-1).",$_GET[limit])'>".$_GET['total_pages']."</a></li>";
				else if($i == $_GET['pageno'] && $_POST['action'] != "add")
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				else if($i == $_GET['pageno'])
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
			}
		}
		else if($_POST['action'] == "add" && $_GET['total_pages']<5 && $_GET['total_pages'] > 1)
		{
			for($i=1; $i<=$_GET['total_pages']; $i++)
			{
				if($i == $_GET['total_pages'] && $_POST['action'] == "add")
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$_GET['total_pages'].",$_GET[limit])'>".$_GET['total_pages']."</a></li>";
				else if($i == $_GET['pageno'] && $_POST['action'] != "add")
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				else if($i == $_GET['pageno'])
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
			}
		}
		else if($_GET['total_pages']<=5)
		{
			if($_GET['total_pages']>1)
			{
				for($i=1; $i<=$_GET['total_pages']; $i++)
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				}
			}
		}
		else
		{
			if($_GET['pageno'] <= 3)
			{
				for($i=1; $i<=5; $i++)
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				}
			}
			else if(($_GET['pageno']>3)&&($_GET['pageno']<($_GET['total_pages']-2)))
			{
				for($i=($_GET['pageno']-2); $i<=($_GET['pageno']+2); $i++)
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
				}
			}
			else
			{
				if(($_GET['total_pages'] - $_GET['pageno']) == 2)
					$limit = ($_GET['pageno']-2);
				else if(($_GET['total_pages'] - $_GET['pageno']) == 1)
					$limit = ($_GET['pageno']-3);
				else if(($_GET['total_pages'] - $_GET['pageno']) == 0)
					$limit = ($_GET['pageno']-4);
				for($i=$limit; $i<=$_GET['total_pages']; $i++)
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.",$_GET[limit])'>".$i."</a></li> ";
				}
			}
		}
		
		if($_GET['total_pages'] > 1 && isset($_POST['submit']))
		{
			if($_GET['total_pages'] != $_GET['pageno'] && $_POST['action'] == "update")
				echo "<li class='next'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($update+1).",$_GET[limit])'>&raquo;</a></li>
				<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$_GET['total_pages'].",$_GET[limit])'>Last</a></li>";
		}
		else if($_GET['pageno']<$_GET['total_pages'])
		{
			echo "<li class='next'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($_GET['pageno']+1).",$_GET[limit])'>&raquo;</a></li>
			<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$_GET['total_pages'].",$_GET[limit])'>Last</a></li>";
		}
		
		if($_GET['total_pages'] > 5)
		{
			echo "<select id='Ajax_Pagination_Select' onchange='Ajax_Pagination(\"".$_GET['PaginationFor']."\",this.value,$_GET[limit])'>";
			for($i=1;$i<=$_GET['total_pages'];$i++)
			{
				if($i == $_GET['pageno'])
					echo "<option value='".$i."' selected>".$i."</option>";
				else
					echo "<option value='".$i."'>".$i."</option>";
			}
			echo "</select>";
		} ?>	
	</ul>
<?php
} ?>
