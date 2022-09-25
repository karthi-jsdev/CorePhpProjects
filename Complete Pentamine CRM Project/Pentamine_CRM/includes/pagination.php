<ul class="pagination clearfix">
	<?php
		if($_GET['pageno'] > 1)
		{
			echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=1'>First</a></li>"; 
			echo "<li class='prev'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".($_GET['pageno'] - 1)."'>&laquo;</a></li> ";	
		}
		
		if(mysql_real_escape_string($_POST['action']) == "add" && $total_pages > 5)
		{
			for ($i=$total_pages-4; $i<=$total_pages; $i++)
			{
				if($i == $total_pages && mysql_real_escape_string($_POST['action']) == "add")
					echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=$total_pages'>".$total_pages."</a></li>";
				else if($i == $_GET['pageno'] && mysql_real_escape_string($_POST['action']) != "add")
					echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>"; 
				else if($i == $_GET['pageno'])
					echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>"; 
				else
					echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>"; 
			}
		}
		else if(mysql_real_escape_string($_POST['action']) == "add" && $total_pages<5 && $total_pages > 1)
		{
			for ($i=1; $i<=$total_pages; $i++) 
			{
				if($i == $total_pages && mysql_real_escape_string($_POST['action']) == "add")
					echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=$total_pages'>".$total_pages."</a></li>";
				else if($i == $_GET['pageno'] && mysql_real_escape_string($_POST['action']) != "add")
					echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>";
				else if($i == $_GET['pageno'])
					echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>";
				else
					echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>";
			}
		}
		else if($total_pages<=5)
		{
			if($total_pages>1)
			{
				for ($i=1; $i<=$total_pages; $i++) 
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue ' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>";
				}
			}
		}
		else
		{
			if($_GET['pageno'] <= 3)
			{
				for ($i=1; $i<=5; $i++) 
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li>";
					else
						echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li> ";
				}
			}
			else if(($_GET['pageno']>3)&&($_GET['pageno']<($total_pages-2)))
			{
				for ($i=($_GET['pageno']-2); $i<=($_GET['pageno']+2); $i++)
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."' >".$i."</a></li> ";
					else
						echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li> ";
				} 
			}
			else
			{
				if(($total_pages - $_GET['pageno']) == 2)
					$limit = ($_GET['pageno']-2);
				else if(($total_pages - $_GET['pageno']) == 1)
					$limit = ($_GET['pageno']-3);
				else if(($total_pages - $_GET['pageno']) == 0)
					$limit = ($_GET['pageno']-4);
				for ($i=$limit; $i<=$total_pages; $i++) 
				{
					if($i == $_GET['pageno'])
						echo "<li class='page'><a class='button-blue current' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li> ";
					else
						echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$i."'>".$i."</a></li> ";
				}
			}
		}
		
		if($total_pages > 1)
		{
			if($total_pages != $_GET['pageno'] && mysql_real_escape_string($_POST['action']) == "update")
			{
				echo "<li class='next'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".($update+1)."'>&raquo;</a></li> ";
				echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$total_pages."'>Last</a></li>"; 
			}
		}
		/*else if($_GET['pageno']<$total_pages)
		{
			echo "<li class='next'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".($_GET['pageno']+1)."'>&raquo;</a></li> ";
			echo "<li class='page'><a class='button-blue' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$total_pages."'>Last</a></li>"; 
		}*/
	?>
</ul>