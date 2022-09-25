<?php

/**
 *
 * This function converts a WKT string into a PHP array of polygonal coordinate pairs.
 *
 * @param string $wkt_str is the Well-Known-Text string representing one or more polygons
 *
 * @return array Returns an array of polygons with sub arrays of coordinate pairs
 *
 */ 

function convert_wkt_to_poly_arr($wkt_str)
{
  $ret_arr = array();
  $matches = array();

  preg_match('/\)\s*,\s*\(/', $wkt_str, $matches);
  
  if(empty($matches))
  {
    $polys = array(trim($wkt_str));
  }
  else
  {
    $polys = explode($matches[0], trim($wkt_str));
  }
//echo str_replace('(','',str_replace(')','',substr($polys[1], 0, stripos($polys[1],')')-2))); 
$count = 0;
  foreach($polys as $poly)
  {
if ($count == 0)
    $ret_arr[] = str_replace('(','',str_replace(')','',substr($poly, stripos($poly,'(')+2, stripos($poly,')')-2))); 
else
    $ret_arr[] = str_replace('(','',str_replace(')','',substr($poly, 0, stripos($poly,')')-2))); 

$count++;
  }

  return $ret_arr;

}
