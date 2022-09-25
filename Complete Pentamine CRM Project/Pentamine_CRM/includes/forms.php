<?php
 
require_once("classes/manage_database.php");

require ("include/f_config.php");
require ("include/f_functions.php");
require ("include/functions.php");

error_reporting(0);
set_time_limit(0);
$db=new Database();
$maxrows	=	$_GET["maxrows"];
$keywords	=	$_GET["keywords"];
$display	=	$_GET["display"];				
$search		=	$_GET["search"];
$main		=	$_GET["main"];
$cat		=	base64_decode($_GET['cat']);	
$from=$_GET['from'];
if($_REQUEST['action'] == 'Edit')
{
	$id1=intval(base64_decode($_GET['video_id']));
	$cat=intval(base64_decode($_GET['cat']));
	$query = " WHERE category_id=$cat";
	$sql_faq="select * from  video where video_id=$id1";
	$result_faq= $db->select($sql_faq);
	foreach($result_faq as $key=>$data)
	{
		$faq_question=stripslashes($data['title']);
		$faq_answer=stripslashes($data['chrdesc']);
		$sortorder = $data['sort_order'];
		if ($data['type'] == 1) 
		{
			$faq_path = $data['thumb'];
			$video_code = $data['path'];
		} 
		else 
		{
			$faq_path = stripslashes($data['path']);
		}
		$faq_status=$data['status'];
		$videof	= $data['type'];
	}
}
$sql = "SELECT max(sort_order) AS sortorder FROM video $query";
$result = mysql_query($sql);

if (mysql_num_rows($result) > 0) 
{
	$max = mysql_fetch_assoc($result);
	$sort_max = $max['sortorder'] + 1;
} 
else 
{
	$sort_max = 0 + 1;
}

if($_REQUEST["Submit"])
{ //echo '<pre>'; print_r($_REQUEST); echo '</pre>'; exit;
	$faq_question=$_POST['faq_question'];

	$sql="select count(*) from video where title='$faq_question'";
	$res=mysql_query($sql);
	$tnt=mysql_result($res,0);
	if($tnt >0)
	{
		$error_Msg[] = "Title already exists";
	}
}

if($_REQUEST["Update"] || $_REQUEST["Submit"] || $_REQUEST["Save"])
{  //echo '<pre>'; print_r($_REQUEST); echo '</pre>'; exit;
	$maxrows	=	$_GET["maxrows"];
	$keywords	=	$_GET["keywords"];
	$display	=	$_GET["display"];				
	$search		=	$_GET["search"];
	$main		=	$_GET["main"];			
	
	
	//---------------stored posted data to the corresponding variable-----------------------
	$faq_id=intval(base64_decode($_REQUEST['faq_id']));
	$cat = intval(base64_decode($_POST['cat']));
	$cat = intval(base64_decode($_POST['category']));
	$faq_question=$_POST['faq_question'];
	$faq_answer=$_POST['faq_answer'];
	$video_code = trim($_POST['video_code']);
	$sortorder = trim($_POST['displayorder']);
	/* $day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	if (!is_numeric($day)) {
		$error_Msg[] = "Invalid date ... !";
	} else if(strlen($day) == 1 ) {
		$day = sprintf("%02s", $day);
	}
	if(!is_numeric($month)) {
		$error_Msg[] = "Invalid date ... !";
	}
	if(!is_numeric($year)) {
		$error_Msg[] = "Invalid date ... !";
	}

	$dt = $year . '-' . $month . '-' . $day;
	if (is_numeric($day) && is_numeric($month)  && is_numeric($year)) {
		if (checkdate($month, $day, $year) != 1) {
			$error_Msg[] = "Invalid date ... !";
		}
	} */
	if (strlen(trim($_POST["faq_path"])) > 0) 
	{ 
		$faq_path=trim($_POST['faq_path']);
	}
	$faq_status=$_POST['faq_status'];
	$video  = $_FILES['image']['name'];
	$videof=$_POST['videof'];//echo $videof;exit;
	if($videof=='1')
	{
		$faq_path=$faq_path;
	}
	else
	{
		$faq_path=$video;
	}
	
	if($from=='live')
	{
		$livestatus='1';
	}
	else
	{
		$livestatus='0';
	}
	//echo $videof;exit;
	//validation------------------------------	
	if(trim($faq_question) == "")
	{
		$error_Msg[] = "Title required";
	}
	if(trim($videof) == "0" && $_REQUEST['action']=='Edit')	
	{ 
		$sql = "SELECT * FROM video WHERE video_id=$faq_id";
		$result = mysql_query($sql);
		$info = mysql_fetch_assoc($result);
		if (strlen($faq_path) < 1) 
		{
			$thumbname = $info['thumb'];
			$path = $info['path'];
			$faq_status=$data['status'];
			$videof	= $data['type'];
		}	
	}
	if(trim($videof) == "0" && $_REQUEST['action']!='Edit')	
	{ 		
		if(trim($faq_path) == "")	
		{ 			
			$error_Msg[] = "Please upload Video"; 		
		}	
	}
	if(trim($videof) == "1")	
	{ 			
		if(trim($faq_path) == "")	
		{ 			
			$error_Msg[] = "Please Enter You Tube Image Url"; 		
		}
		if (strlen($video_code) < 1) 
		{
			$error_Msg[] = "Please Enter You Tube video code";
		}
		if(trim($faq_path)!='')
		{
			$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
			if (!eregi($urlregex, $faq_path)) 
			{
				$error_Msg[]	=	'Please enter a valid Url';	
			}
		}
	}
			
	/*if($video!="" and count($error_Msg)==0) 
	{
		if(trim($videof) == "0")
		{
			$fileName = $_FILES['image']['name'];
			$fileNameParts = explode( ".", $fileName ); 
			$fileExtension = end( $fileNameParts); 
			$fileExtension = strtolower($fileExtension ); 
			$fileSize = $_FILES['image']['size'];
			$random    = rand();	
			$path='./videos/video_';								
			$filenames  = $path.$random.".".$fileExtension;
			$file = "video_".$random.".".$fileExtension;
			$output = "./thumb/video_" . $random . "." . "jpg";
			$thumbname = "video_" . $random . "." . "jpg";
			if(!$fileExtension == "flv" ) 
			{
				$error_Msg[] = $fileName. "is not an flv file." ;
			} 
			else if( $fileSize == 0 ) 
			{
				$error_Msg[] = "Sorry. The upload of $fileName has failed. The file size is 0." ;
			} 
			else 
			{
				if (!move_uploaded_file( $_FILES['image']['tmp_name'], $filenames) ) 
				{
					$error_Msg[] ="Possible file upload attack!  Here's some debugging info:\n";
				} 
				else 
				{ 
					if (ftpLogin($ftpstream, $config['f_user'], $config['f_password'])) 
					{
						$upload = ftp_put($ftpstream, $destDir."/".$file, $filenames, FTP_BINARY);
						ftpClose($ftpstream);
						if (!$upload) 
						{
							$error_Msg[] = "File Cannot upload";
						} 
						else 
						{												
							// Start Get Duration 
							ob_start();
							passthru("ffmpeg -i \"". $filenames . "\" 2>&1");
							$duration = ob_get_contents();
							ob_end_clean();
							$search = '/Duration: (.*?)[.]/';
							$duration = preg_match($search, $duration, $matches, PREG_OFFSET_CAPTURE);
							$duration = $matches[1][0];
							list($hours, $mins, $secs) = split('[:]', $duration);
							$duration = $hours . ":" . $mins . ":" . $secs; 
							// End Get Duration
							
							$cmd = exec("ffmpeg -i $filenames $output");
							$msg = "File Upload completed";
							
							unlink($filenames) or die("Cannot delete uploaded filefrom working directory -- manual deletion recommended");
						}
					} 
					else 
					{
						$error_Msg[] = 'Cannot initiate connection to host';
					}
				}
			}
		}
		$path = "video_".$random.".".$fileExtension;
	}
	else if(trim($videof) == "1")
	{
		//$urlParts = explode( "=", $faq_path );
		$thumbname = $faq_path;
		$path = $video_code;
		/* if($urlParts[0]=="http://www.youtube.com/watch?v"){
			$path=end($urlParts);
		}else{
			$error_Msg[]	=	'Please enter a valid You Tube Url';	
		} */
	/*}*/
			
	// Start If Thumbnail Image upload
	if (is_uploaded_file($_FILES['thumb_image']['tmp_name'])) 
	{
		$imageName = $_FILES['thumb_image']['name'];
		$imageNameParts = explode( ".", $imageName ); 
		$imageExtension = end( $imageNameParts); 
		$imageExtension = strtolower($imageExtension ); 
		$random    = rand();
		$input = "images/videos/" . $random . "." . $imageExtension;
		$output = "images/videos/video_" . $random . "." . $imageExtension;
		$thumbname = "video_" . $random . "." . $imageExtension;
		if (move_uploaded_file($_FILES['thumb_image']['tmp_name'], $input)) 
		{
			fn_resize_image($input,320,240,$output,'100');
			unlink($input);
		}
	}
	// End If Thumbnail Image upload	
}

if(count($error_Msg)==0)
{
	$arFieldsValues=array();
	$arFieldsValues['title']=clean_data($faq_question);
	$arFieldsValues['chrdesc']=clean_data($faq_answer);
	$arFieldsValues['type']=clean_data($videof);
	$arFieldsValues['path']=clean_data($path);
	$arFieldsValues['thumb']=clean_data($thumbname);
	$arFieldsValues['status']=clean_data($faq_status);
	$arFieldsValues['category_id']=$cat;
	$arFieldsValues['live_status']=$livestatus;
	$catid=	base64_encode($cat);
	$enter_date=date( "Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
	$arFieldsValues['enterdate']=$enter_date;
	//$arFieldsValues['dt']=$dt;
	$arFieldsValues['sort_order'] = $sortorder;
	$arFieldsValues['duration'] = $duration;

   	if($_REQUEST["Save"])
   	{	
		
		$sql_sorting = "SELECT * FROM video WHERE sort_order='$sortorder' AND category_id='$cat'";
		$result_sorting= $db->select($sql_sorting);
		$count_sort=count($result_sorting);
		if($count_sort>0) 
		{ 	
			$sql_sorting_new = "SELECT * FROM  video WHERE sort_order>='$sortorder' AND category_id='$cat' ORDER BY photo_sortorder DESC";
			$result_sorting_new= $db->select($sql_sorting_new);
			foreach($result_sorting_new as $key=> $data) 
			{	
				 $arFieldsValuesz['sort_order'] = $data['sort_order'] + 1;
				 $resulter = $db->update('video',$arFieldsValuesz,'video_id='.$data['video_id']);
			}
		}
		
		$result = $db->insert('video',$arFieldsValues);
		
		// Email to Video Subscribers
		$id = md5($result);
		$videoid = base64_encode($result);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: sysadmin<livetv@christuniversity.in>' . "\r\n";
		$subject = 'Live TV@Christ University ';
	
		$sql = "SELECT * FROM video_subscribe WHERE status=1";
		$result = mysql_query($sql);
		while ($tmp = mysql_fetch_assoc($result)) 
		{
			$name = $tmp['name'];
			$email = $tmp['email'];
			$varify = md5($email);
			$video_path = base64_encode($path);
			$body = "Dear $name," . "\r\n";
			$body .= "<br>New video added" . "\r\n";
			$body .= "<br>http://www.christuniversity.in/videogallery/video_inner.php?videoid=$videoid" . "\r\n";
		#	$body .= "For unsubscribe click on the below link" . "\r\n";
		#	$body .= "http://www.christuniversity.in/videogallery/video_unsubscribe.php?v=$varify&ki=$id" . "\r\n";
			$body .= "<br>Thank You"  . "\r\n";
			$body .= "<br>Christ University";
			@mail($email, $subject, $body, $headers);
			//mailer($email, $subject, $body, 'sysadmin@christuniversity.in');
		}
		
		header("location:videos_list.php?action=update&maxrows=$maxrows&keywords=$keywords&display=$display&search=$search&main=$main&catid=$catid");
		exit;
	}	
	elseif($_REQUEST["Update"])
	{		
		$oldorder=$_REQUEST['oldsortorder'];
		if($sortorder>$oldorder) 
		{
		$sql_sorting_new1="SELECT * FROM  video  WHERE sort_order<='$sortorder' AND sort_order >='$oldorder' AND category_id='$cat'  ORDER BY sort_order DESC";
		$result_sorting_new1= $db->select($sql_sorting_new1);
			foreach($result_sorting_new1 as $key=> $data1) 
			{	
				$arFieldsValueszv['sort_order'] = $data1['sort_order'] - 1;
				$resulter1=$db->update('video',$arFieldsValueszv,'video_id='.$data1['video_id']);
			}
		} 
		else if($sortorder <= $oldorder) 
		{
			$sql_sorting_new1="SELECT * FROM  video WHERE sort_order>='$sortorder' AND sort_order <='$oldorder' AND category_id='$cat' ORDER BY sort_order DESC";
			$result_sorting_new1= $db->select($sql_sorting_new1);
			foreach($result_sorting_new1 as $key=> $data1) 
			{	
				$arFieldsValueszv['sort_order']=$data1['sort_order']+1;
				$resulter1=$db->update('video',$arFieldsValueszv,'video_id='.$data1['video_id']);
			}
		}
		
		$result=$db->update('video',$arFieldsValues,'video_id='.$id1);
		header("location:videos_list.php?action=update&maxrows=$maxrows&keywords=$keywords&display=$display&search=$search&main=$main&catid=$catid");
		exit;
	}
	elseif($_REQUEST["Submit"])
	{
		$result=$db->insert('video',$arFieldsValues);
		header("location:videos_list.php?action=insert&maxrows=$maxrows&keywords=$keywords&display=$display&search=$search&main=$main&catid=$catid");
		exit;
	}
}
?>
<script>
function loadVideo(val)
{
	if(val=='0')
	{
		if (document.getElementById('bfile').style.display=="none") document.getElementById('bfile').style.display="block";
		if (document.getElementById('ufile').style.display=="block") document.getElementById('ufile').style.display="none";
	}
	if(val=='1')
	{
		if (document.getElementById('bfile').style.display=="block") document.getElementById('bfile').style.display="none";
		if (document.getElementById('ufile').style.display=="none") document.getElementById('ufile').style.display="block";
	}
}
</script>
<script> 
$(document).ready(function(){
    // Regular Expression to test whether the value is valid
    $.tools.validator.fn("[type=time]", "Please supply a valid time", function(input, value) { 
    	return /^\d\d:\d\d$/.test(value);
    });
     
    $.tools.validator.fn("[data-equals]", "Value not equal with the $1 field", function(input) {
    	var name = input.attr("data-equals"),
    		 field = this.getInputs().filter("[name=" + name + "]"); 
    	return input.val() == field.val() ? true : [name]; 
    });
     
    $.tools.validator.fn("[minlength]", function(input, value) {
    	var min = input.attr("minlength");
    	
    	return value.length >= min ? true : {     
    		en: "Please provide at least " +min+ " character" + (min > 1 ? "s" : "")
    	};
    });
     
    $.tools.validator.localizeFn("[type=time]", {
    	en: 'Please supply a valid time'
    });
     
     
    $("#form").validator({ 
    	position: 'left', 
    	offset: [25, 10],
    	messageClass:'form-error',
    	message: '<div><em/></div>' // em element is the arrow
    });

/**
 * Modal Dialog Boxes Setup
 */

    var triggers = $(".modalInput").overlay({

        // some mask tweaks suitable for modal dialogs
        mask: {
            color: '#ebecff',
            loadSpeed: 200,
            opacity: 0.7
        },

        closeOnClick: false
    });

    /* Simple Modal Box */
    var buttons = $("#simpledialog button").click(function(e) {
	
        // get user input
        var yes = buttons.index(this) === 0;

        if (yes) {
            // do the processing here
        }
    });

    /* Yes/No Modal Box */
    var buttons = $("#yesno button").click(function(e) {
	
        // get user input
        var yes = buttons.index(this) === 0;

        // do something with the answer
        triggers.eq(0).html("You clicked " + (yes ? "yes" : "no"));
    });

    /* User Input Prompt Modal Box */
    $("#prompt form").submit(function(e) {

        // close the overlay
        triggers.eq(1).overlay().close();

        // get user input
        var input = $("input", this).val();

        // do something with the answer
        if (input) triggers.eq(1).html(input);

        // do not submit the form
        return e.preventDefault();
    });
});
    
</script> 

<!-- Left column/section -->

<section class="grid_6 first">

    <div class="columns">
        <div class="grid_6 first">
        	<form id="form" class="form panel" action="" method="post"  name="form" enctype="multipart/form-data">
                <header><h2>HTML5 form with validation</h2></header>
                <hr />
                 <?php
			if(count($error_Msg)!=0)
			{
				$alert=message_box($error_Msg);
				print $alert;
			}
		?>
                <fieldset>
                    <div class="clearfix">
                        <label>email *</label><input type="email" required="required" />
                    </div>
                    <div class="clearfix">
                        <label>username *</label><input type="text" name="username" required="required" />
                    </div>
                    <div class="clearfix">
                        <label>Password</label><input type="password" name="password" />
                    </div>
                    <div class="clearfix">
                        <label>Password check</label><input type="password" name="check" data-equals="password" />
                    </div>
                    <div class="clearfix">
                        <label>website *</label><input type="url" required="required" />
                    </div>
                    <div class="clearfix">
                        <label>name *</label><input type="text" name="name" required="required" />
                    </div>
                    <div class="clearfix">
                        <label>age</label><input type="number" name="age" value="0" />
                    </div>
                    <div class="clearfix">
                        <label>time *</label><input type="time" name="time" />
                    </div>
                    <div class="clearfix">
                        <label>Select</label><select><option>Lorem</option><option>Dolor</option><option>Sit amet</option></select>
                    </div>
                    <div class="clearfix">
                        <label>Textarea</label><textarea rows="5" cols="90"></textarea>
                    </div>
                    <div class="clearfix">
                        <label>datepicker</label><input type="date" name="date" />
                    </div>
                    <div class="clearfix">
                        <label>radio button</label><span class="radio-input"><input type="radio" name="radio" />Radio 1</span> <span class="radio-input"><input type="radio" name="radio" />Radio 2</span>
                    </div>
                    <div class="clearfix">
                        <label>Checkbox</label><input type="checkbox" checked="checked"/>
                    </div>
                </fieldset>
                <hr />
                <button class="button button-green" type="submit">Submit form</button>
                <button class="button button-gray" type="reset">Reset</button>
            </form>
        </div>
    </div>

    <div class="columns leading">
        <div class="grid_6 first">
            <h3>Tabs</h3>

            <hr />

            <!-- the tabs -->
            <div class="tabbed-pane">
                <ul class="tabs">
                    <li><a href="#">Tab 1</a></li>
                    <li><a href="#">Tab 2</a></li>
                    <li><a href="#">Tab 3</a></li>
                </ul>

                <!-- tab "panes" -->
                <div class="panes">
                    <div><h4>First tab content.</h4> Tab contents are called "panes"</div>
                    <div>Second tab content</div>
                    <div>Third tab content</div>
                </div>
            </div>

        </div>
    </div>
    <div class="columns leading">
        <div class="grid_6 first">
            <h3>Widgets</h3>
            <hr />

            <div class="widget">
                <header><h2>Widget</h2></header>
                <section>
                    <p>This is a normal widget</p>
                </section>
            </div>

            <div class="panel">
                <header><h2>Panel Widget</h2></header>
                <section>
                    <p>This is a panel widget</p>
                </section>
            </div>
        </div>
    </div>

    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->

                

<!-- Right column/section -->

<aside class="grid_2">

    <div class="accordion top">

        <h2 class="current">Modal Dialogs</h2>
        <div class="pane" style="display:block">
            <ul>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/overlay/modal-dialog.html">Creating Modal Dialogs with Overlay</a></li>
            </ul>
        </div>

        <h2>jQuery Tools Validator</h2>
        <div class="pane">
            <ul>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/index.html">Minimal setup</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/custom-validators.html">Custom input types and attributes</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/server-side.html">Combined server and client-side validation</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/custom-effect.html">Displaying all errors inside a single DIV</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/events.html">Validator events in action</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/validator/localize.html">Localizing the validator (Finnish)</a></li>
            </ul>
        </div>

        <h2>jQuery Tools Tabs</h2>
        <div class="pane">
            <ul>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/index.html">Minimal setup</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/anchors.html#second">Naming the tabs</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/skins.html">4 different skins with CSS</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/mouseover.html">Using mouseover to switch tabs</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/wizard.html">Making Wizards with the tabs</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/accordion.html">Making Accordions with the tabs</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/tabs/accordion-custom.html">Customizing the Accordion effect</a></li>
            </ul>
        </div>

        <h2>jQuery Tools Dateinput</h2>
        <div class="pane">
            <ul>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/index.html">Minimal setup</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/large-skin.html">Large skin for Dateinput</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/customize.html">Customizing Dateinput behaviour</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/flight.html">Prompting for start and end dates</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/static.html">Calendar that is always visible</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/demos/dateinput/localize.html">Localizing the Dateinput</a></li>
            </ul>
        </div>

        <h2>Documentation</h2>
        <div class="pane">
            <ul>
                <li><a target="_blank" href="http://www.jquery.org/">jQuery</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/overlay/index.html">jQuery Tools Overlay</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/validator/index.html">jQuery Tools Validator</a></li>
                <li><a target="_blank" href="http://flowplayer.org/tools/tabs/index.html">jQuery Tools Tabs</a></li>
            </ul>
        </div>

    </div>

</aside>

<!-- End of Right column/section -->
