<?php
ini_set("display_errors","0");
?>
<ul class="pagination clearfix">
	<?php
	if($_POST['pageno'] > 1)
	{
		echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",1)'>First</a></li>
		<li class='prev'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".($_POST['pageno']-1).")'>&laquo;</a></li>";
	}
	
	if($_POST['action'] == "add" && $_POST['total_pages'] > 5)
	{
		for($i=$_POST['total_pages']-4; $i<=$_POST['total_pages']; $i++)
		{
			if($i == $_POST['total_pages'] && $_POST['action'] == "add")
				echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".($_POST['pageno']-1).")'>".$_POST['total_pages']."</a></li>";
			else if($i == $_POST['pageno'] && $_POST['action'] != "add")
				echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			else if($i == $_POST['pageno'])
				echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			else
				echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
		}
	}
	else if($_POST['action'] == "add" && $_POST['total_pages']<5 && $_POST['total_pages'] > 1)
	{
		for($i=1; $i<=$_POST['total_pages']; $i++)
		{
			if($i == $_POST['total_pages'] && $_POST['action'] == "add")
				echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$_POST['total_pages'].")'>".$_POST['total_pages']."</a></li>";
			else if($i == $_POST['pageno'] && $_POST['action'] != "add")
				echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			else if($i == $_POST['pageno'])
				echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			else
				echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
		}
	}
	else if($_POST['total_pages']<=5)
	{
		if($_POST['total_pages']>1)
		{
			for($i=1; $i<=$_POST['total_pages']; $i++)
			{
				if($i == $_POST['pageno'])
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			}
		}
	}
	else
	{
		if($_POST['pageno'] <= 3)
		{
			for($i=1; $i<=5; $i++)
			{
				if($i == $_POST['pageno'])
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			}
		}
		else if(($_POST['pageno']>3)&&($_POST['pageno']<($_POST['total_pages']-2)))
		{
			for($i=($_POST['pageno']-2); $i<=($_POST['pageno']+2); $i++)
			{
				if($i == $_POST['pageno'])
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			}
		}
		else
		{
			if(($_POST['total_pages'] - $_POST['pageno']) == 2)
				$limit = ($_POST['pageno']-2);
			else if(($_POST['total_pages'] - $_POST['pageno']) == 1)
				$limit = ($_POST['pageno']-3);
			else if(($_POST['total_pages'] - $_POST['pageno']) == 0)
				$limit = ($_POST['pageno']-4);
			for($i=$limit; $i<=$_POST['total_pages']; $i++)
			{
				if($i == $_POST['pageno'])
					echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li> ";
			}
		}
	}
	
	if($_POST['total_pages'] > 1 && isset($_POST['submit']))
	{
		if($_POST['total_pages'] != $_POST['pageno'] && $_POST['action'] == "update")
			echo "<li class='next'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".($update+1).")'>&raquo;</a></li>
			<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$_POST['total_pages'].")'>Last</a></li>";
	}
	else if($_POST['pageno']<$_POST['total_pages'])
	{
		echo "<li class='next'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".($_POST['pageno']+1).")'>&raquo;</a></li>
		<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$_POST['total_pages'].")'>Last</a></li>";
	}
	
	if($_POST['total_pages'] > 5)
	{
		echo "<select onchange='Ajax_Pagination(\"".$_POST['PaginationFor']."\",this.value)'>";
		for($i=1;$i<=$_POST['total_pages'];$i++)
		{
			if($i == $_POST['pageno'])
				echo "<option value='".$i."' selected>".$i."</option>";
			else
				echo "<option value='".$i."'>".$i."</option>";
		}
		echo "</select>";
	} ?>	
</ul>