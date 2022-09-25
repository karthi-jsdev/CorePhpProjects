<aside class="grid_2">
	<div id="rightmenu" class="panel">
		<header>
			<h2>Over All <font color="red">Status</font></h2>
		</header>
		<dl>
			<?php
			$Users = mysqli_query($_SESSION['connection'],"SELECT * FROM user");
			?>
			<dt>Users: <?php echo mysqli_num_rows($Users); ?></dt>
			<dd><div class="progress progress-orange"><span style="width: 10%;"><b><?php echo mysqli_num_rows($Users); ?></b></span></div></dd>
			<dt>Users: <?php echo mysqli_num_rows($Users); ?></dt>
			<dd><div class="progress progress-red"><span style="width: 100%;"><b><?php echo mysqli_num_rows($Users); ?></b></span></div></dd>
			<dt>Users: <?php echo mysqli_num_rows($Users); ?></dt>
			<dd><div class="progress progress-red"><span style="width: 100%;"><b><?php echo mysqli_num_rows($Users); ?></b></span></div></dd>
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
		$result = mysqli_query($_SESSION['connection'],"SELECT * FROM user");
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<dt>".$row['status']."</dt><dd>".$row['status']."</dd><hr />";
		} ?>
            </dl>
        </section>
    </div-->
</aside>