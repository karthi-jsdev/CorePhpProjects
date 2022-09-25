
		<ul class="pagination clearfix">
			<?php
			if($_GET['CurrentPageNo'] > 1)
			{
				echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",1)'>First</a></li>
				<li class='prev'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($_GET['CurrentPageNo']-1).")'>&laquo;</a></li>";
			}
			
			if($_POST['action'] == "add" && $_GET['total_pages'] > 5)
			{
				for($i=$_GET['total_pages']-4; $i<=$_GET['total_pages']; $i++)
				{
					if($i == $_GET['total_pages'] && $_POST['action'] == "add")
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($_GET['CurrentPageNo']-1).")'>".$_GET['total_pages']."</a></li>";
					else if($i == $_GET['CurrentPageNo'] && $_POST['action'] != "add")
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					else if($i == $_GET['CurrentPageNo'])
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				}
			}
			else if($_POST['action'] == "add" && $_GET['total_pages']<5 && $_GET['total_pages'] > 1)
			{
				for($i=1; $i<=$_GET['total_pages']; $i++)
				{
					if($i == $_GET['total_pages'] && $_POST['action'] == "add")
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$_GET['total_pages'].")'>".$_GET['total_pages']."</a></li>";
					else if($i == $_GET['CurrentPageNo'] && $_POST['action'] != "add")
						echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					else if($i == $_GET['CurrentPageNo'])
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				}
			}
			else if($_GET['total_pages']<=5)
			{
				if($_GET['total_pages']>1)
				{
					for($i=1; $i<=$_GET['total_pages']; $i++)
					{
						if($i == $_GET['CurrentPageNo'])
							echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
						else
							echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					}
				}
			}
			else
			{
				if($_GET['CurrentPageNo'] <= 3)
				{
					for($i=1; $i<=5; $i++)
					{
						if($i == $_GET['CurrentPageNo'])
							echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
						else
							echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					}
				}
				else if(($_GET['CurrentPageNo']>3)&&($_GET['CurrentPageNo']<($_GET['total_pages']-2)))
				{
					for($i=($_GET['CurrentPageNo']-2); $i<=($_GET['CurrentPageNo']+2); $i++)
					{
						if($i == $_GET['CurrentPageNo'])
							echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
						else
							echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
					}
				}
				else
				{
					if(($_GET['total_pages'] - $_GET['CurrentPageNo']) == 2)
						$limit = ($_GET['CurrentPageNo']-2);
					else if(($_GET['total_pages'] - $_GET['CurrentPageNo']) == 1)
						$limit = ($_GET['CurrentPageNo']-3);
					else if(($_GET['total_pages'] - $_GET['CurrentPageNo']) == 0)
						$limit = ($_GET['CurrentPageNo']-4);
					for($i=$limit; $i<=$_GET['total_pages']; $i++)
					{
						if($i == $_GET['CurrentPageNo'])
							echo "<li class='page'><a class='button-blue current' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li>";
						else
							echo "<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$i.")'>".$i."</a></li> ";
					}
				}
			}
			
			if($_GET['total_pages'] > 1 && isset($_POST['submit']))
			{
				if($_GET['total_pages'] != $_GET['CurrentPageNo'] && $_POST['action'] == "update")
					echo "<li class='next'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($update+1).")'>&raquo;</a></li>
					<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$_GET['total_pages'].")'>Last</a></li>";
			}
			else if($_GET['CurrentPageNo']<$_GET['total_pages'])
			{
				echo "<li class='next'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".($_GET['CurrentPageNo']+1).")'>&raquo;</a></li>
				<li class='page'><a class='button-blue' href='#' onclick='Ajax_Pagination(\"".$_GET['PaginationFor']."\",".$_GET['total_pages'].")'>Last</a></li>";
			}
			
			if($_GET['total_pages'] > 5)
			{
				echo "<select onchange='Ajax_Pagination(\"".$_GET['PaginationFor']."\",this.value)'>";
				for($i=1;$i<=$_GET['total_pages'];$i++)
				{
					if($i == $_GET['CurrentPageNo'])
						echo "<option value='".$i."' selected>".$i."</option>";
					else
						echo "<option value='".$i."'>".$i."</option>";
				}
				echo "</select>";
			} ?>	
		</ul>
