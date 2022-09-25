<?php
	include("includes/MiscellaneousQueries.php");
	if($_POST['Submit'])
	{
		$category = implode($_POST['category'],'.');
		$amount = implode($_POST['amount'],'.');
		mysql_query("INSERT INTO miscellaneous_history values('','".$_POST['payto']."','".date('Y-m-d',strtotime($_POST['date']))."','".$category."','".$amount."')");
	}
?>
<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#date").datepicker({dateFormat: 'dd-mm-yy'});
		});
	</script>
</head>
<section role="main" id="main">
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" >
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Pay To <font color="red">*</font><br/>
						<input type="text" name="payto" id="payto">
					</label>
					<label>Payment Date <font color="red">*</font>
						<input type="text" name="date" id="date">
					</label>
				</div>
				<div id="AddFileInputBox">
					<div class="clearfix">
						<label>Category <font color="red">*</font>
							<select name="category[]" id="category">
								<option value="">Select</option>
							<?php
								$SelectCategory = Select_Category();
								while($FetchCategory = mysql_fetch_array($SelectCategory))
								{
									echo '<option value="'.$FetchCategory['name'].'">'.$FetchCategory['name'].'</option>';
								}
							?>
							</select>
						</label>
						<label>Amount <font color="red">*</font><br/>
							<input type="text" name="amount[]" id="amount">
						<a style="padding-left:20px" href="#" id="AddMoreFileBox" class="addmore"><img src="images/Add.PNG" title="Add Files"></a>
						</label>
					</div>
				</div>
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit" name="Submit" value="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		<?php
			if($_POST['Submit'])
			{
				echo '<div style="border:1px solid;border-radius:5px;width:500px">
				<table>
						<tr>
							<td style="width:150px;padding-left:40px;"><br/>
								<font size="2px"><strong> Pay To:'.$_POST['payto'].'</strong></font>
							</td>
							<td><br/>
								<font size="2px"><strong> Payment Date:'.$_POST['date'].'</strong></font>
							</td>
						</tr></table>';
				$i = 0;
				$Total = 0;
				echo '<br/><table><tr><td style="width:150px;padding-left:40px;"> <font size="2"><strong>Category</strong></font></td><td><font size="2px"><strong>Amount</strong></font></td></tr>';
				foreach($_POST['category'] as $Category)
				{
					echo '<tr><td style="width:150px;padding-left:40px;">'.$Category.'</td><td align="right">'.$_POST['amount'][$i].'</td></tr>';
					$Total += $_POST['amount'][$i];
					$i++;
				}
				echo '<tr><td><hr/></td><td><hr/></td></tr><tr><td style="width:130px;padding-left:120px;"><font size="2"><strong>Total:</strong></font></td><td style="padding-left:20px;"><strong>'.$Total.'</strong></td></table>
					<br/></div><br/>';
				echo '<div><a onclick="Download()" class="button button-gray">Print</a></div><br/>';
			}
		?>
		<br />
	</div>
</section>
<script>
	function Download()
	{
		window.open("includes/PrintMiscellaneous.php?export=1&Amount=<?php echo implode($_POST['amount'],","); ?>&Category=<?php echo implode($_POST['category'],","); ?>&PayTo=<?php echo $_POST['payto']; ?>&Date=<?php echo $_POST['date']; ?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
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
$(document).ready(function()
	{
		var FileInputsHolder = $('#AddFileInputBox');
		var MaxFileInputs = 10;
		var i = $('#AddFileInputBox div').size() + 1;
		$('#AddMoreFileBox').live('click', function() 
		{
			
			if(i < MaxFileInputs)
			{
				i++;
				$('<span style="padding-left:50px;"><br/><select name="category[]" id="category'+i+'"><option value="">Select</option><?php $Select = mysql_query("select * from miscellaneous"); while($Fetch = mysql_fetch_array($Select)) { ?><option value="<?php echo $Fetch['name']; ?>"><?php echo $Fetch['name']; ?></option><?php } ?></select><span style="" /><input type="text" name="amount[]" id="amount'+i+'"  class="addedInput" /><a href="#" id="removeFileBox"><img src="images/overlay/close.png" border="0" height="25" width="25"/></a></span>').appendTo(FileInputsHolder);
			}
			return false;
		});
		$('#removeFileBox').live('click', function()
		{
			if(i > 1)
			{
				$(this).parents('span').remove();
				i--;
			}
			return false;
		});
	});
</script>