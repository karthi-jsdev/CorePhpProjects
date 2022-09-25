<br />
<?php
include("includes/Masters_Queries.php");
//if($_SESSION['SM_role'])
if(true)
{
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Configuration";
	//if($_SESSION['SM_roleid'] == 1 || $_SESSION['SM_roleid'] == 2)
	$subheaders = array("Configuration","General","Fees");
	for($i = 0; $i < count($subheaders); $i++)
	{
		$split = explode("_", $subheaders[$i]);
		for($j = 0; $j < count($split); $j++)
		{
			if($j == 0)
				$subpagename = $split[$j];
			else
				$subpagename = $subpagename." ".$split[$j];
		}
		if($_GET['subpage'] == $subheaders[$i])
			echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		else
			echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
	}
	
	$filename = "includes/".$_GET['page']." ".$_GET['subpage'].".php";
	if(file_exists($filename) && in_array($_GET['subpage'], $subheaders))
	{
		echo '<div class="columns">';
		include($filename);
		echo '</div>';
	}
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
	?>
	<div class="clear">&nbsp;</div>
<?php
}
else
{ ?>
	<div class="message info">
		<h3><font color="red">Note :</font></h3>
		<p>This page is only for Admins. If you have credentials of either, Please login to continue.</p>
	</div>
<?php
} ?>
	
<script>
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode >= 32)
			return true;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
		 if (charCode == 8 || charCode == 32) 
			return true;
		 if (charCode >= 44 && charCode <= 47) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	function deleterow(id)
	{
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&id="+id+"&action=Delete");
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 9 || charCode == 45 || charCode == 46 || (charCode >= 35 && charCode <= 40))
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 9 || charCode == 45 || charCode == 46 || (charCode >= 35 && charCode <= 40))
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("phone").value.length < 10)
			return true;
		else
			return false;
	}
	
</script>