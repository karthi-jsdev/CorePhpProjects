<?php
function numlinks($pagenum, $maxpage, $pages_visible, $scriptname="", $get="") {

	echo '<table border="0" cellspacing="0" cellpadding="0" class="t-border"><tr>';
	if ($pagenum > 1) {
		echo '<td class="td-border"><a href="'.page_name(1, $scriptname, $get).'" class="numlinks">&laquo;</a></td>';   // first page
	 	echo '<td class="td-border"><a href="'.page_name(($pagenum-1), $scriptname, $get).'" class="numlinks">previous</a></td>';   // prev page
	} else {
		echo '<td class="td-border numlinks-inactive">&laquo;</td>';   // first page
	 	echo '<td class="td-border numlinks-inactive">previous</td>';   // prev page
	}	


	
	$i=1;
	while ($i <= $pages_visible){
		if ($pagenum-ceil($pages_visible/2) < 0) {  //wenn unterer Bereich
			if ($i == $pagenum) echo '<td class="td-border numhighlight">'.($pagenum).'</td>';
			else echo '<td class="td-border"><a href="'.page_name($i, $scriptname, $get).'" class="numlinks">'.($i).'</a></td>';
			
		} else if ($pagenum+floor($pages_visible/2) > $maxpage) {  // wenn oberer bereich
			if($maxpage > $pages_visible) $j = $maxpage-$pages_visible+$i;
			else $j = $i;
			
			if ($j == $pagenum) echo '<td class="td-border numhighlight">'.($pagenum).'</td>';
			else echo '<td class="td-border"><a href="'.page_name($j, $scriptname, $get).'" class="numlinks">'.$j.'</a></td>';

			
		} else {  // wenn mittlerer bereich
		    if ($i == ceil($pages_visible/2)) echo '<td class="td-border numhighlight">'.($pagenum).'</td>';
			else {
				$j = $pagenum-ceil($pages_visible/2)+$i;
				echo '<td class="td-border"><a href="'.page_name($j, $scriptname, $get).'" class="numlinks">'.$j.'</a></td>';
			}
		}
		if ($i == $maxpage) break;
		$i++;
	}
	

	
	
	if ($pagenum < $maxpage){
		echo '<td class="td-border"><a href="'.page_name(($pagenum+1), $scriptname, $get).'" class="numlinks">next</a></td>';  // next page
		echo '<td class="td-border"><a href="'.page_name($maxpage, $scriptname, $get).'" class="numlinks">&raquo;</a></td>';   // last page
	} else {
		echo '<td class="td-border numlinks-inactive">next</td>';   // first page
	 	echo '<td class="td-border numlinks-inactive">&raquo;</td>';   // prev page
	}	
	
	echo '</tr></table>';
}

function page_name($nr, $scriptname, $get="") {
	$scriptname.='?page='.$nr;
	if ($get != '') $scriptname.='&'.$get;
	return $scriptname;
}

?>