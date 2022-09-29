<?php
	function Select_Category()
	{
		return mysqli_query($_SESSION['connection'],"Select * from miscellaneous");
	}
?>