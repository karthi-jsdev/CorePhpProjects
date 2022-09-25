<?php
extract($_REQUEST);
// For escaping and trimming strings
function clean_data($data)
{
	if (!get_magic_quotes_gpc())
		{
			return addslashes(trim($data));
		}else{
			return $data;
		}
	
}

	function protect($entry)	//To protect the form fields from breaking, on entering HTML characters.
		{
			 return htmlspecialchars($entry);
		}	
	
// For printing data
function output($data)
{

	if (!get_magic_quotes_gpc())
		{
			return htmlspecialchars(stripslashes($data));
		}else{
			return stripslashes($data);
		}
}


 ////////////////////////////////////////////////////////////////////////////////////////////////
  // Function    : validate_email
  // Arguments   : email   email address to be checked
  // Return      : true  - valid email address
  //               false - invalid email address
  ////////////////////////////////////////////////////////////////////////////////////////////////
   function validate_email($email) { 
    $valid_address = true;
    $mail_pat = '^(.+)@(.+)$';
    $valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
    $atom = "$valid_chars+";
    $quoted_user='(\"[^\"]*\")';
    $word = "($atom|$quoted_user)";
    $user_pat = "^$word(\.$word)*$";
    $ip_domain_pat='^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
    $domain_pat = "^$atom(\.$atom)*$";

    if (eregi($mail_pat, $email, $components)) {
      $user = $components[1];
      $domain = $components[2];
      // validate user
      if (eregi($user_pat, $user)) {
        // validate domain
        if (eregi($ip_domain_pat, $domain, $ip_components)) {
          // this is an IP address
      	  for ($i=1;$i<=4;$i++) {
      	    if ($ip_components[$i] > 255) {
      	      $valid_address = false;
      	      break;
      	    }
          }
        }
        else {
          // Domain is a name, not an IP
          if (eregi($domain_pat, $domain)) {
            /* domain name seems valid, but now make sure that it ends in a valid TLD or ccTLD
               and that there's a hostname preceding the domain or country. */
            $domain_components = explode(".", $domain);
            // Make sure there's a host name preceding the domain.
            if (sizeof($domain_components) < 2) {
              $valid_address = false;
            } else {
              $top_level_domain = strtolower($domain_components[sizeof($domain_components)-1]);
              // Allow all 2-letter TLDs (ccTLDs)
              if (eregi('^[a-z][a-z]$', $top_level_domain) != 1) {
                $tld_pattern = '';
                // Get authorized TLDs from text file
               // $tlds = file(SITE_URL.'includes/tld.txt');
			   $tlds = file('./functions/tld.txt');
                while (list(,$line) = each($tlds)) {
                  // Get rid of comments
                  $words = explode('#', $line);
                  $tld = trim($words[0]);
                  // TLDs should be 3 letters or more
                  if (eregi('^[a-z]{3,}$', $tld) == 1) {
                    $tld_pattern .= '^' . $tld . '$|';
                  }
                }
                // Remove last '|'
                $tld_pattern = substr($tld_pattern, 0, -1);
                if (eregi("$tld_pattern", $top_level_domain) == 0) {
                    $valid_address = false;
                }
              }
            }
          }
          else {
      	    $valid_address = false;
      	  } 
      	}
      }
      else {
        $valid_address = false;
      }
    }
    else {
      $valid_address = false;
    }
  if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
      if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
        $valid_address = false;
      }
    } 
    return $valid_address;
  }
  



/* Function to check for duplicate Emails in Administrators tables.
 Argument: mail id  to check and optional user id
 Return type: true/false
*/

function isAdminEmailExist($email,$id='')
{
	$db = new Database();
	$sql = "SELECT COUNT(*) AS total FROM admin WHERE email = '$email'";
			if($id!='')
			$sql	.=	" and id !=".$id;
	$rsEmail	=	$db->select($sql);
	foreach($rsEmail as $key => $data);
	if($data['total'] > 0)
		return true;
}




function isUpdateAdminEmailExist($email,$user_id)
{
	$db = new Database();
	$sql = "SELECT COUNT(*) AS total FROM admin WHERE email = '$email' and id!=$user_id";
	$rsEmail	=	$db->select($sql);
	foreach($rsEmail as $key => $data);
	if($data['total'] > 0)
		return true;
			
}

/* To Print Error messages
Argument: Message to print as array
*/
function message_box($arrError,$mode='error',$url='normal')
{
	global $config;
	//$url_to_use	=	($url == 'normal') ? $config[image_url] : $config['image_secure_url'];
	$url_to_use  = $config[image_url];
	//$path = $url_to_use."ValidationHeader.GIF";
	
//echo	$path = $url_to_use."ValidationHeader.GIF"; die();
    $path   = "images/ValidationHeader.GIF";
	if($mode=='error') {
		$html=<<<EOD
		<table cellpadding="0" cellspacing="0" border="0" width="98%"><tr><td class="alert">
		<img src="$path"><font style='color:#D50004;'> Please correct the following errors.</font><ul>
EOD;
		$html .="<font style='color:#D50004;font-size:12px'>";
		foreach($arrError as $key=>$value)
			$html .= "&raquo;  $value<br/>";
		$html .= "</td></tr></table>";
		$html .="</font>";		
	}
	else {
		$html=<<<EOD
		<table class="successMessage" cellpadding="0" cellspacing="0" border="0" width="95%"><tr><td>
EOD;
		foreach($arrError as $key=>$value)
			$html .= "<li> $value </li>";
		$html .= "</td></tr></table>";
	}
	
	return $html;
}
# Function to get browser Type
function getBrowserType() {
	if(stristr($_SERVER['HTTP_USER_AGENT'],"MSIE")) 
		return "IE";
	else
		return false;
	
}
function isValidURL($url)
{
 return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}  

/* To Print a messages
Argument: Message to print
*/
function messageBox($msgStr)
{
	$html=<<<EOD
	<table class="ValidationSummary" cellpadding="0" cellspacing="0" border="0" width="95%"><tr><td>
	<img src="images/ValidationHeader.GIF"> $msgStr </td></tr></table>
EOD;
	return $html;
}




//  Retrive the content management data
//   Argument : content type
//   Return   : Array contain name 
function print_content($title)
{
	$obj	=	new Database();
	$sql	=	"select * from contents where content_title='$title'";
	$res	=	$obj->select($sql);
	
	if(count($res)>0) {
		foreach($res as $data);
		$value	= 	stripslashes($data['content_desc']);
	}
	print $value;
}

//  Return first 200 character of the string
//   Argument : main data
//   Return   : 200 character from main data  
function desc_data($data)
{
		return substr($data,0,180);

}

//function for image resize
		function imageResize($image, $target, $alt=NULL) 
			{ 
			//Gets the width and height of the image 
			$theimage = getimagesize($image);
			$width = $theimage[0];
			$height = $theimage[1];

			//takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image 

			if ($width > $height)
			 { 
				$percentage = ($target / $width); 
			} 
			else 
			{ 
			$percentage = ($target / $height); 
			} 

			//gets the new value and applies the percentage, then rounds the value 
			$width = round($width * $percentage); 
			$height = round($height * $percentage); 

			//Returns the new sizes inside an image tag so you can call it with "imageResize("images/sock001.jpg", "Some alt text", $target)"

			echo "<img src=\"$image\" width=\"$width\" height=\"$height\" title=\"$alt\" border=\"0\" >"; 
			}
			
	
function calculate_age($dates)	//Pass date of birth to this function, the age will be returned.
	{
		$daters	=	array();
		$daters	=	explode('-',$dates);
		$yr		=	date('Y');
		$dob_yr	=	$daters[0];
		$age	=	$yr-$dob_yr;
		if(date('m',strtotime($dates))>date('m'))
		  {
			$age--; 
		  }
		else 
			if(date('m',strtotime($dates))==date('m')&& date('d',strtotime($dates))>date('d'))
			{   $age--;	  }	
		return $age;		
	 }
$nwords = array(  "", "one", "two", "three", "four", "five", "six", 
		  "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", 
		  "fourteen", "fifteen", "sixteen", "seventeen", "eightteen", 
		  "nineteen", "twenty", 30 => "thirty", 40 => "fourty",
				 50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eigthy",
				 90 => "ninety" );
	 
function number_to_words ($x)
{
    
	 global $nwords;
     if(!is_numeric($x))
     {
         $w = '#';
     }else if(fmod($x, 1) != 0)
     {
         $w = '#';
     }else{
         if($x < 0)
         {
             $w = 'minus ';
             $x = -$x;
         }else{
             $w = '';
         }
         if($x < 21)
         {
             $w .= $nwords[$x];
         }else if($x < 100)
         {
             $w .= $nwords[10 * floor($x/10)];
             $r = fmod($x, 10);
             if($r > 0)
             {
                 $w .= ' '. $nwords[$r];
             }
         } else if($x < 1000)
         {
		
             	$w .= $nwords[floor($x/100)] .' hundred';
             $r = fmod($x, 100);
             if($r > 0)
             {
                 $w .= ' '. number_to_words($r);
             }
         } else if($x < 1000000)
         {
         	$w .= number_to_words(floor($x/1000)) .' thousand';
             $r = fmod($x, 1000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $w .= ' ';
                 }
                 $w .= number_to_words($r);
             }
         } else {
             $w .= number_to_words(floor($x/1000000)) .' million';
             $r = fmod($x, 1000000);
             if($r > 0)
             {
                 $w .= ' ';
                 if($r < 100)
                 {
                     $word .= ' ';
                 }
                 $w .= number_to_words($r);
             }
         }
     }
     return $w;
}
/****************************Function for converting date format to dd/mm/yyyy***************************************/
function convert_date($date_format)
{
$date_exp=explode("-",$date_format);
$formatted_date=$date_exp[2]."/".$date_exp[1]."/".$date_exp[0];
return $formatted_date;
}
function dateDiff($dformat, $endDate, $beginDate)
{
$date_parts1=explode($dformat, $beginDate);
$date_parts2=explode($dformat, $endDate);
$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
return $end_date - $start_date;
}

/***************************************************************
Function to validate a name.Returns true if given condition is 
valid. Else it returns false.
*/
  function isValidName($name)
  {
    if(!empty($name) and !is_null($name))
	{
	  	if(preg_match('|^[a-zA-Z ]*$|',$name)) return true;
		else return false;
    }
	else return false;
  } 

/***************************************************************
Function to validate an email.Returns true if given condition is 
valid. Else it returns false.
*/  
  function isValidEmail($email)
  {
    if(!empty($email) and !is_null($email))
	{
		$reg_expression = '#^([a-zA-Z0-9_\\-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([a-zA-Z0-9\\-]'.
						  '+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$#';
	  	if(preg_match($reg_expression,$email)) return true;
		else return false;
    }
	return false;
  } 
  /*.......................................Function for uploading images...................................................*/
  function imageuploadfn($file_name,$path)
  {
        unset($img_array);
       $img_array = array();
	   if($_FILES[$file_name]['name'])
		{
		        if($_FILES[$file_name]['size']>0)
				 {
				      
				      if(checkuploadimage($_FILES[$file_name]['type']))
					  {
					  
					         $temp_name  = $_FILES[$file_name]['tmp_name'];
							$name      = str_replace(" ", "_", $_FILES[$file_name]['name']);
							$name      = time().$name;
							$file_name = $path.$name ; 
							if(upload_image($temp_name,$file_name))
							{
									   
									   
									   $img_array[] =1;
									    $img_array[] =$name ;
										return($img_array);
									   
									   
									   
							}
							else
							{
									   $img_array[] =0;
									   $img_array[] ="Error in uploading.Please check upload directory permission";
									   return($img_array); 
									  
							} 
							
					  }
					  else
					  {
					        $img_array[] =0;
							$img_array[] ="Invalid file format";
							 return($img_array); 
					        
					  }
				   
				 }
				 else
				 {
				            $img_array[] =0;
							$img_array[] ="File not exists";
							 return($img_array); 
				     
				 }
			  
		}
		else
		{
		    
			    $img_array[] =0;
				$img_array[] ="File required";
				return($img_array); 
			  
			
		}
		
	   
	   
  }
  
function date_ymdtomdy($date){
   $date  = explode(" ",$date);
   $date  = $date[0];
   $time  = $date[1];
   $date  = explode("-",$date);
   $year  = $date[0];
   $month = $date[1];
   $day   = $date[2];
   $date_new = $day."-".$month."-".$year; 
   return $date_new;
}
function date_mdytoymd($date){
   $date  = explode(" ",$date);
   $date  = $date[0];
   $time  = $date[1];
   $date  = explode("-",$date);
   $year  = $date[2];
   $month = $date[1];
   $day   = $date[0];
   $date_new = $year."-".$month."-".$day; 
   return $date_new;
}
function datedatabase($return_date)
{
$array_date=array();
$array_date=explode('/',$return_date);
$array_date_f=$array_date[2].'-'.$array_date[1].'-'.$array_date[0];
return $array_date_f;
}
?>
