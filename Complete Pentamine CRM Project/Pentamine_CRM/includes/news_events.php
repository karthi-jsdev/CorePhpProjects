<?php
ini_set("display_errors","0");
include("chk.php") ;
$db=new Database(); 

$maxrows	=	$_REQUEST["maxrows"];
$keywords	=	$_REQUEST["keywords"];
$display	=	$_REQUEST["display"];				
$search		=	$_REQUEST["search"];
$main		=	$_REQUEST["main"];			 
$id = base64_decode($_REQUEST['id']);

if($_REQUEST["Update"] || $_REQUEST["Submit"])
{	
	$id	= base64_decode($_REQUEST['id']);
	$news_events = $_REQUEST['news_events'];
        $enddate =$_REQUEST['enddate'];
	if(trim($news_events) == "")
		$error_Msg[] = "News Events required";	

}
if(count($error_Msg)==0)
{
	$arFieldsValues=array();
	$arFieldsValues['newsEvents']	= clean_data($news_events);
	$arFieldsValues['status']	=	clean_data($status);		
	$arFieldsValues['endDate']=$enddate;
	$arFieldsValues['clientId']=$_SESSION['clientId'];
	
	if($_REQUEST["Update"])
	{		
		$result=$db->update('news_events',$arFieldsValues,'id='.$id);
		header("location:index.php?page=news&action=update&maxrows=$maxrows&display=$display&keywords=$keywords&search=$search");
		exit;
	}
	
	if($_REQUEST["Submit"])
	{
		$result=$db->insert('news_events',$arFieldsValues);		
		header("location:index.php?page=news&action=insert&maxrows=$maxrows");
		exit;
	}
}
if($_REQUEST['action']=='Edit')
{
	$sql = "SELECT * FROM  news_events WHERE clientId='".$_SESSION['clientId']."' AND id=$id";
	$result = $db->select($sql);
	foreach($result as $key => $data)
	{	
		$news_events	=	stripslashes($data["newsEvents"]);		
		$status			=	$data["status"];
        $enddate        = 	$data["endDate"];
	}

}

?>
<script>
function check()
{
if(document.form1.txtcategory.value=="")
{
alert("Please Enter the Categoery Name");
document.form1.txtcategory.focus();
return false;
}
return true;
}
</script>

<!-- Left column/section -->

<section class="grid_6 first">
					
    <div class="columns">
        <div class="grid_6 first">
        	<form id="form" class="form panel" action="" method="post"  name="form" enctype="multipart/form-data">
				<header><h2>Fields marked <font color="red">*</font> are Mandatory </h2></header>
                <hr />
					<?php
						if(count($error_Msg)!=0){
						$alert=message_box($error_Msg);
						print "<div class='message error'>".$alert."</div>";
					} ?>
					
                <fieldset>
                    <div class="clearfix">
                        <label>News Events<font color="red">*</font></label>
						<textarea name="news_events" cols="41" rows="3" id="news_events"><?php echo $news_events; ?></textarea>
                    </div>
                    <div class="clearfix">
                        <label>End Date (yyyy-mm-dd)</label>
						<input type="text" name="enddate" value="<?php if(isset($enddate)){ echo $enddate;}?>">
                    </div>
                    <div class="clearfix">
						<?php
							if($_REQUEST['action']!='Edit'){
						?>                   
						<?php } ?>
                        <label>Status</label>
						<?php if($status==''){ $status=1;}?> 
						<span class="radio-input"><input name="status" type="radio" value="1" <? if($status==1){ echo "Checked"; } ?> />Active&nbsp;&nbsp;</span>
						<span class="radio-input"><input type="radio" name="status" value="0" <? if($status==0){ echo "Checked"; } ?> />Not Active</span>
                    </div>
                </fieldset>
                <hr />
					<div class="clearfix">
						<? if($_GET[action]=='Edit') { ?>
						<input class="button button-green" type="submit" name="Update" value="Update">
						<? } else {?>
						<input class="button button-green" type="submit" name="Submit" value="Submit">
						<? } ?>
						&nbsp;&nbsp;
						<button class="button button-gray" type="reset">Reset</button>
                    </div>
            </form>
        </div>
    </div>

    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->