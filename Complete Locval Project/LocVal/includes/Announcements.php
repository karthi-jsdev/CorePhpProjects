<?php
	require("Config.php");
	require("Announcements_Queries.php");
?>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			 <font size="6">Announcements</font> 
		</div>
		<br /><br />
		<div class="section group">
			<?php
				$i = 1;
				$Announcements = Announcements();
				while($FetchAnnouncements = mysql_fetch_array($Announcements))
				{
					echo '<div style="float: left;font-weight: bold;">'.$FetchAnnouncements['title'].'</div><div style="float: right;">'.date('d/m/Y g:i:s a',strtotime($FetchAnnouncements['created_at'])).'</div><br /><br />';
					echo '<div style="float: left;">'.$FetchAnnouncements['description'].'</div><br /><br />';
					echo '<hr style="width:75%;border-bottom: dotted 1px #000";" />';
				}
			?>
		</div>
	</div>
</div>