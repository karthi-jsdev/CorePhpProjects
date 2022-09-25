<?php
ini_set("display_errors","0");
if(!$_GET['Initial'])
{
	include("Config.php");
	include("Create_Order_Queries.php");
	?>
	<h3>Order Summary
		<?php
		if($_GET['number'] && $_GET['name'])
			$TotalOrder = mysql_fetch_assoc(Count_All_Order_ByNameandNumber());
		else if($_GET['number'])
			$TotalOrder = mysql_fetch_assoc(Count_All_Order_ByNumber());
		else if($_GET['name'])	
			$TotalOrder = mysql_fetch_assoc(Count_All_Order_ByName());
		else
			$TotalOrder = mysql_fetch_assoc(Count_All_Order_ById());
		echo "Total Orders: ".$TotalOrder['total'];
		?>
	</h3>
	<table class="paginate sortable full">
		<thead>
			<th width="43px" align="center">S.No.</th>
			<th align="left">Order No</th>
			<th align="left">Customer Name</th>
			<th align="left">Total No.Of Jobs</th>
			<th align="left">Tendative Start Date</th>
			<th align="left">Tendative End Date</th>
		</thead>
		<tbody>
			<?php
			$Limit = 10;
			$total_pages = ceil($TotalOrder['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			$orders = Select_All_Order_ByLimit($Start, $Limit);
			while($order = mysql_fetch_assoc($orders))
			{
				$TotalNoJobs = mysql_fetch_array(TOtalJobInOrder($order['number']));
				$customers = mysql_fetch_array(Select_Customers($order['customer_id']));
				$Product = mysql_fetch_array(Select_Products($order['product_id']));
				echo "<tr id='".$order['id']."' style='valign:middle;'>
					<td align='center'>".++$i."</td>
					<td><a href='?page=Order&subpage=Job Status&number=".$order['number']."'>".$order['number']."</a></td>
					<td>".$customers['name']."</td>
					<td>".$TotalNoJobs['total']."</td>";
					if(!$TotalNoJobs['total'])
						echo "<td colspan='2'><center><a href='#' onclick='Delete_Order(".$order['id'].");'>Delete</a></center></td>";
					else
						echo "<td>".date("d-m-Y", strtotime($TotalNoJobs['mindate']))."</td>
						<td>".date("d-m-Y", strtotime($TotalNoJobs['maxdate']))."</td>";
				echo "</tr>";
			}
			if(mysql_num_rows($orders) == 0)
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			?>
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