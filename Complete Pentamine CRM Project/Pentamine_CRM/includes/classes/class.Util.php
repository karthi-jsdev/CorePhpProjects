<?php
/***********************************************************************************************************
Utility class. Contains basic utility functions.

Interface includes the following functions:
@ isValidFieldsArray(fields_n_data) -> Validates array of database fields and values.
@ isValidCondition(condition) -------> Validates a condition to be applied on a database query.
@ isValidName(name) -----------------> Checks whether the argument is a valid name.
@ isValidEmail(email) ---------------> Checks whether the argument is a valid email.
@ isValidDOB(date_of_birth) ---------> Checks whether the argument is a valid date of birth.
@ isValidPassword(password) ---------> Checks whether the argument is a valid password.
@ isValidGender($gender) ------------> Checks whether the argument is a valid gender.

Author: Kiran
Date: 30 July 2008
***********************************************************************************************************/
class Util
{
  function dumpData($input = "NULL", $msg = "Stopped")
  {
  	if(is_array($input) or is_object($input) or is_null($input) or empty($input))
	{
		echo "<pre>";
		if(is_array($input)) print_r($input);
		else var_dump($input);
		echo "</pre>";
	}
	else echo $input."<br />";
	
	if(empty($msg)) $msg = "Stopped";
	die($msg);
  }
/*********************************************************************************/  
  function scaleImage($binary_image, $mime_type, $width = 102, $height = 108)
  { 
	$src = imagecreatefromstring($binary_image);	
	$original_width  = imagesx($src);
	$original_height = imagesy($src);		
	$aspect_ratio = 1;
	if($original_width > $width)   $aspect_ratio = $original_width/$width;
	if($original_height > $height) $aspect_ratio = max($aspect_ratio, ($original_height/$height));
	
	header("content-type: $mime_type");
	if($aspect_ratio > 1) 
	{			
		$new_width  = round(($original_width/$aspect_ratio), 0);
		$new_height = round(($original_height/$aspect_ratio), 0);	
		$img = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($img,$src,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
		imagedestroy($src);	
		if($mime_type == 'image/jpeg' or $mime_type == 'image/jpg' or $mime_type == 'image/pjpeg')
		{			
			imagejpeg($img);
		}
		elseif($mime_type == 'image/gif')
		{
			imagegif($img);
		}
		elseif($mime_type == 'image/png')
		{
			imagepng($img);
		}						
	}
	else echo $binary_image;	
  }  
/*********************************************************************************/  
  function resizeThumbnail($binary_image, $mime_type, $width = 150, $height = 150)
  { 
	$src = imagecreatefromstring($binary_image);	
	$original_width  = imagesx($src);
	$original_height = imagesy($src);		
	$aspect_ratio = 1;
	if($original_width > $width)   $aspect_ratio = $original_width/$width;
	if($original_height > $height) $aspect_ratio = max($aspect_ratio, ($original_height/$height));
	
	if($aspect_ratio > 1) 
	{			
		$new_width  = round(($original_width/$aspect_ratio), 0);
		$new_height = round(($original_height/$aspect_ratio), 0);
		$img = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($img,$src,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
		imagedestroy($src);

		$success = false;
		if($mime_type == 'image/jpeg' or $mime_type == 'image/jpg' or $mime_type == 'image/pjpeg')
		{
			if(imagejpeg($img, 'tempImage')) $success = true;
			else die("not created");
		}
		elseif($mime_type == 'image/gif')
		{
			if(imagegif($img, "tempImage")) $success = true;
		}
		elseif($mime_type == 'image/png')
		{
			if(imagepng($img, "tempImage")) $success = true;
		}
		else return false;
		if($success)
		{
			$resized_binary_image = file_get_contents("tempImage");
			@unlink("tempImage");
			return $resized_binary_image;
		}
		else return false;
	}
	else return $binary_image;
  }
/*********************************************************************************/  
  function isValidUrl($url)
  {
  	$url = trim($url);
	$rgx = '/^[(http|https):\/\/]?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}((:[0-9]{1,5})?\/.*)?$/i';
	if(preg_match($rgx, $url))return true;else return false;
	
  }
/*****************************************************************************
Function to validate the US-phone number.
*/
  function isValidPhoneNumber($phone_number)
  {
  	$rgx = '/^(?:\([2-9]\d{2}\)\ ?|[2-9]\d{2}[- \.]?)[2-9]\d{2}[- \.]?\d{4}[- \.]?(?:x|ext)?\.?\ ?\d{0,5}$/';
	if(preg_match($rgx, $phone_number)) return true;
	return false;
  }

/*****************************************************************************
Function to display a month dropdown list
*/
  function getMonthDropdown($month = 0, $name_prefix = '', $class = 'form-text')
  {
  	$month_dropdown = '<select name="month'.$name_prefix.'" class="'.$class.'"><option value="0">Month</option>';
	for($i=1; $i <= 12; $i++)
	{
		$monthName = date("F", mktime(0, 0, 0, $i, 1, 0));
		$month_dropdown .= '<option value="'.$i.'"';
		if($month == $i) $month_dropdown .= ' selected="selected"';
		$month_dropdown .= '>'.$monthName.'</option>';
	} 
	$month_dropdown .= '</select>';
	return $month_dropdown;
  }

/*****************************************************************************
Function to display an year dropdown list
*/
  function getYearDropdown($year = 0, $name_prefix = '')
  {
  	$year_lower_limit = date('Y') - 100;
	$year_upper_limit = date('Y');
  	$year_dropdown = '<select name="year'.$name_prefix.'" class="form-text"><option value="0">Year</option>';
	for($i=$year_upper_limit; $i >= $year_lower_limit; $i--)
	{ 
		$year_dropdown .= '<option value="'.$i.'"';
		if($year == $i)
			$year_dropdown .= ' selected="selected"';
		$year_dropdown .= '>'.$i.'</option>';
	}
	$year_dropdown .= '</select>';
	return $year_dropdown;
  }
/*****************************************************************************
Function to calculate the Age when the date of birth is supplied as parameter.
*/
  function calculateAge($date_of_birth)
  {
  	if(empty($date_of_birth)) return false;
	$date_parts = explode('-', $date_of_birth);
	list($year_of_birth, , ) = explode('-', $date_of_birth);
	$current_year = date('Y');
	return ($current_year - $year_of_birth);
  }
/***************************************************************
Function to validate array of field names and respective values.
Returns true if given fields and respective values are valid.
Else it returns false.
*/
  function isValidFieldsArray($fields_n_data)
  {
    if(!empty($fileds_n_data))
	{  
		foreach($fields_n_data as $key => $value)
	  	{
	    	if(empty($key) or is_null($value)) return false;		
	  	}
	}
	else return false;
	return true;
  }

/***************************************************************
Function to validate a condition to be implied on a DB query.
Returns true if given condition is valid. Else it returns false.
*/  
  function isValidCondition($condition)
  {
    if(!empty($condition))
	{
	  	$pos = strpos($condition, "=");
	  	if($pos === false or $pos < 1) return false;
	  	elseif((strlen($condition) - $pos) < 2) return false;
    }
	else return false;
	return true;
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
  
/***************************************************************
Function to validate date of birth. Returns true if given 
condition is valid. Else it returns false.
*/  
  function isValidDOB($date_of_birth)
  { 
  	if(!empty($date_of_birth))
	{
		list($year, $month, $day) = explode('-', $date_of_birth);
		if(checkdate($month,$day,$year))
		{
			$current_year = date('Y');
			if(($current_year - $year) >= 18) return true;
		}
    }
	return false;
  }

/**********************************************************************************
Function to validate password. minimum characters & maximum characters are optional
parameters. Returns true if given condition is valid. Else it returns false.
*/  
  function isValidPassword($password,$min_chars = 6,$max_chars = 12)
  {
    if(!empty($password) and !is_null($password))
	{
		$password_length = strlen($password);
	  	if(($password_length >= $min_chars) and ($password_length <= $max_chars))
		{
			if(preg_match('|^[a-zA-Z0-9]*$|',$password)) return true;		
		}
    }
	return false;
  }
  
/****************************************************************
Function to validate gender. A valid gender can either M or F.
If gender is valid,function returns true. Else it returns false.
*/  
  function isValidGender($gender)
  {
    if(!empty($gender) and !is_null($gender))
	{
	  	if(strlen($gender) == 1 and ($gender == 'M' or $gender == 'F')) return true;
		else return false;
    }
	return false;
  }
  
/************************************************************************
Function to decode an encoded parameter and to extract arguments from it.
It returns arguments and its value as an array.
*/  
  function decodeArgument($param)
  {
	$rawParams = base64_decode($param);
	$paramSeparated = explode("^",$rawParams);
	$arguments = array();
	
	foreach($paramSeparated as $argString)
	{
		$arg=explode("=",$argString);
		if(substr($arg[0],0,1) == '$')
		{
			$arg[1] = $this->decodeArgument($arg[1]);
			$arg[0] = substr($arg[0],1);
		}
		$arguments["$arg[0]"] = $arg[1];
	}
	return $arguments;
  }

/**********************************************************
Function to encode an argument array to a parameter string.
It returns an encoded string.
*/  
  function encodeArgument($args)
  {
	$argStrings = array();
	foreach($args as $key=>$value)
	{
		/*if(is_array($value)) $value = implode('|',$value);*/
		if(is_array($value))
		{
			$value = $this->encodeArgument($value);
			$key   ='$'.$key;
		}
		$argStrings[] = $key."=".$value;
	}
	$arg = implode("^",$argStrings); 
	$arg = base64_encode($arg);
	return $arg;	
  }

/*********************************************************
Function to format a message to formatted list.
*/  
  function convertToList($messages)
  {
  	if(is_null($messages)) return false;
	$formatted_message = '';
	foreach($messages as $single_message)
	{
		if(!empty($single_message)) /*#FF0000*/
		{ 
			$formatted_message .= '<li style="font-size:13px; color:black; line-height:10px; list-style:square">'.
								  $single_message.'</li>';				
		}
	}
	$formatted_message = '<ul>'.$formatted_message.'</ul>';
	return $formatted_message;
  }
  
/*********************************************************
Function to display an error message board.
*/
  function messageBoard($message,$width=50,$height=80)	/* #D5F2F9 $width=50,$height=80 */
  {
  	if(empty($message) or is_null($message)) echo '&nbsp;';
	else
	{
		if(is_array($message)) 		$message_list = $this->convertToList($message);
		elseif(is_string($message)) $message_list = nl2br($message);
		$message_board	= '<div align="left" class="response-text" style="width:'.$width.'%;height:'.$height.'%;'.
						  'padding-top:10px;padding-bottom:10px;padding-left:15px;background-color:#fdcea3;'.
						  'border:solid 1px; border-color:#ff9636;">';
		$message_board .= $message_list.'</div>';
		echo $message_board;		
	}
	return;
  }

/*********************************************************
Function to display an error message board.
*/
  function ErrorMsg($message,$width=50,$height=80)
  {
  	if(empty($message) or is_null($message)) echo '&nbsp;';
	else
	{
		if(is_array($message)) 		$message_list = $this->convertToList($message);
		elseif(is_string($message)) $message_list = $message;
		$message_board	= '<div align="left" class="textarea" style="width:'.$width.'%;height:'.$height.'%;'.
						  'padding-top:5px;padding-bottom:5px;padding-left:15px;background-color:#fdcea3;border:solid 1px; border-color:#ff9636;">';
		$message_board .= '<font size="+1">Please correct all of the required fields.</font><br>';
		$message_board .= $message_list.'</div>';
		echo $message_board;		
	}
	return;
  }
  
/*****************************************************************
Function to check whether a given date is valid. Returns true if
it is valid, else false is returned. Parameter format: yyyy-mm-dd.
*/ 
  function isValidDate($date)
  {
  	if(!empty($date))
	{
		list($year, $month, $day) = explode('-', $date);
		return checkdate($month,$day,$year);
    }
	return false;
  }
  
/***************************************************************************
Function to send email. It takes toAddress, subject & message as parameters.
It rerurns true if mail sent successfully; in case of failure it returns false.
*/  
  function sendMail($to, $subject, $message, $from='')
  {
  	$to		= trim($to);
	$subject= trim($subject);
	if($to == '' || $subject == '') { return false; }
  	$headers = "MIME-Version: 1.0\n".
			   "Content-type: text/html; charset=iso-8859-1\n";
	if($from != '') { $headers .= "From: ".$from." - ScheduleScape.com <service@schedulescape.com>\n"; }
	else			{ $headers .= "From: ScheduleScape.com <service@schedulescape.com>\n"; }
	$headers .= "Return-Path: service@schedulescape.com\n".
			    "Return-Receipt-To: service@schedulescape.com\n";
	$bounceString = '-f service@schedulescape.com';
	if(mail($to,$subject,$message,$headers,$bounceString)) { return true; }
	else { return false; }
  }

/************************************************
A function that deletes a dir that not empty:
Returns true on success, or false on faileure.
*/
  function advancedRmdir($path) { 
    $origipath = $path;
    $handler = opendir($path);
    while (true) {
        $item = readdir($handler);
        if ($item == "." or $item == "..") {
            continue;
        } elseif (gettype($item) == "boolean") {
            closedir($handler);
            if (!@rmdir($path)) {
                return false;
            }
            if ($path == $origipath) {
                break;
            }
            $path = substr($path, 0, strrpos($path, "/"));
            $handler = opendir($path);
        } elseif (is_dir($path."/".$item)) {
            closedir($handler);
            $path = $path."/".$item;
            $handler = opendir($path);
        } else {
            unlink($path."/".$item);
        }
    }
    return true;
  } 
/************************************************  
  Reverse of htmlentities
*/
  function unhtmlentities ($string)
  {
	$trans_tbl = get_html_translation_table(HTML_ENTITIES);
	$trans_tbl = array_flip ($trans_tbl);
	return strtr ($string, $trans_tbl);
  }
   function isValidPrice($price)
  {
   $price = trim($price);
	$rgx = "/^([0-9.])+$/";
	if(!preg_match($rgx, $price))
	 return true; else return false;
		
  }
} // END CLASS Util.


?>