<?php
	function Announcements_Insert()
	{
		return mysql_query("INSERT INTO announcements (id,title,description,created_at) values ('','".$_POST['anouncementitle']."','".$_POST['content']."','".date("Y-m-d H:i:s")."')") ;
	}
	function Announcements_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM announcements WHERE title='".$_POST['anouncementitle']."' ");
	}
	function Announcements()
	{
		return mysql_query("SELECT * FROM announcements  order by created_at desc");
	}
	function Announcements_Select_ById()
	{
		return mysql_query("SELECT * FROM announcements WHERE id='".$_GET['id']."'");
	}
	function Announcements_Delete_ById()
	{
		return mysql_query("DELETE FROM announcements WHERE id='".$_GET['id']."'");
	}
	function Announcements_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM announcements WHERE title='".$_POST['anouncementitle']."' && id!='".$_POST['id']."'");
	}
	function Announcements_Update()
	{
		return mysql_query("UPDATE announcements SET title='".$_POST['anouncementitle']."', description='".$_POST['content']."' WHERE id='".$_GET['id']."'");
	}
?>
