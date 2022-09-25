<aside class="grid_2">
	<div id="rightmenu" class="panel">
		<header>
			<h2>Over All <font color="red">Status</font></h2>
		</header>
		<dl>
			<?php
			$Users = mysql_query("SELECT * FROM user");
			?>
			<dt>Users: <?php echo mysql_num_rows($Users); ?></dt>
			<dd><div class="progress progress-orange"><span style="width: 10%;"><b><?php echo mysql_num_rows($Users); ?></b></span></div></dd>
			<dt>Users: <?php echo mysql_num_rows($Users); ?></dt>
			<dd><div class="progress progress-red"><span style="width: 100%;"><b><?php echo mysql_num_rows($Users); ?></b></span></div></dd>
			<dt>Users: <?php echo mysql_num_rows($Users); ?></dt>
			<dd><div class="progress progress-red"><span style="width: 100%;"><b><?php echo mysql_num_rows($Users); ?></b></span></div></dd>
		</dl>
		<br />
	</div>
	
    <!--div class="widget">
        <header>
            <h2>News & Updates</h2>
        </header>
        <section>
            <dl>
			<?php
			$result = mysql_query("SELECT * FROM user");
			while($row = mysql_fetch_assoc($result))
				echo "<dt>".$row['status']."</dt><dd>".$row['status']."</dd><hr />";
			?>
            </dl>
        </section>
    </div-->
</aside>