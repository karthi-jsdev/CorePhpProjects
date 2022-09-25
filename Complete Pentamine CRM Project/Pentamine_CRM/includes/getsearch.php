<?php
	include('config.php');
	ini_set( "display_errors", "0" );
	
	if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') &&  ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead ORDER BY id DESC');
	}
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') && ($_GET['product'] == 'all') && $_GET['subproduct'])
	{
		if($_GET['followdate'] && $_GET['subproduct'] && ($_GET['assign']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype='".$_GET['subproduct']."' AND  ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else	
			$all_status = mysql_query('Select * FROM lead WHERE pstype="'.$_GET['subproduct'].'" ORDER BY id DESC');
	}
		
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') && ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'] && $_GET['product'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."'  AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE ptype="'.$_GET['product'].'" ORDER BY id DESC');
	}
		
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') && $_GET['product'] && $_GET['subproduct'])
	{
		if($_GET['followdate'] && $_GET['product'] && $_GET['subproduct'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."'  AND pstype='".$_GET['subproduct']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE ptype="'.$_GET['product'].'" AND pstype="'.$_GET['subproduct'].'" ORDER BY id DESC');
	}
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && ($_GET['status']) && ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if(($_GET['status'] == 'nostatus') && $_GET['startdate'] && $_GET['enddate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN (SELECT ptclid FROM comments) AND (ldate between '".$_GET['startdate']."' AND '".$_GET['enddate']."') ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else if($_GET['status'] == 'nostatus')	
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if($_GET['status'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else 
		{
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
			//$status = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE slno='".$_GET['status']."'"));
		}
	}
	
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && $_GET['status'] && ($_GET['product'] == 'all') && $_GET['subproduct'])
	{
		if(($_GET['status'] == 'nostatus') && $_GET['startdate'] && $_GET['enddate'] && $_GET['subproduct'])
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype = '".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) AND (ldate between '".$_GET['startdate']."' AND '".$_GET['enddate']."') ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else if($_GET['status'] == 'nostatus' && $_GET['subproduct'])	
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype = '".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if($_GET['status'] && $_GET['followdate'] && $_GET['subproduct'])
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype = '".$_GET['subproduct']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else
			$all_status = mysql_query('Select * FROM lead WHERE pstype="'.$_GET['subproduct'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	//7
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && $_GET['status'] && ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if(($_GET['status'] == 'nostatus') && $_GET['startdate'] && $_GET['enddate'] && $_GET['product'])
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND ptclid NOT IN (SELECT ptclid FROM comments) AND (ldate between '".$_GET['startdate']."' AND '".$_GET['enddate']."') ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else if($_GET['status'] == 'nostatus' && $_GET['product'])	
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if($_GET['status'] && $_GET['followdate'] && $_GET['product'])
			$all_status = mysql_query("SELECT * FROM lead WHERE  ptype='".$_GET['product']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else
			$all_status = mysql_query('Select * FROM lead WHERE ptype="'.$_GET['product'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	//8
	else if(($_GET['client'] == 'all') && ($_GET['assign'] == 'all') && ($_GET['status'] != 'all') && ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
	{
		if(($_GET['status'] == 'nostatus') && ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND pstype='".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else
			$all_status = mysql_query('Select * FROM lead WHERE ptype="'.$_GET['product'].'" AND pstype="'.$_GET['subproduct'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	} //9
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE  assign='".$_GET['assign']."' AND (ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."') ORDER BY id DESC");	
		else if($_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE assign="'.$_GET['assign'].'" ORDER BY id DESC');
	}
	//10
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product'] == 'all') && ($_GET['subproduct']))
	{
		if($_GET['followdate'] && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype ='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype ='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype ='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE pstype ="'.$_GET['subproduct'].'" AND assign="'.$_GET['assign'].'" ORDER BY id DESC');
	} //11
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'] && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE ptype ="'.$_GET['product'].'" AND assign="'.$_GET['assign'].'" ORDER BY id DESC');
	} //12
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product']) && ($_GET['subproduct']))
	{
		if($_GET['followdate'] && $_GET['assign'] && ($_GET['product'])  && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype ='".$_GET['subproduct']."' AND ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['product'])  && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype ='".$_GET['subproduct']."' AND ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['product'])  && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype ='".$_GET['subproduct']."' AND ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE pstype ="'.$_GET['subproduct'].'" AND ptype ="'.$_GET['product'].'" AND assign="'.$_GET['assign'].'" ORDER BY id DESC');
	} //13
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status']) &&  ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['assign'] && ($_GET['status'] == 'nostatus'))
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if(($_GET['status'] == 'nostatus') && $_GET['assign'] && $_GET['startdate'] && $_GET['enddate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments ) AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else if($_GET['status'] && $_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['status']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptclid IN(SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
	} //14
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status']) &&  ($_GET['product'] == 'all') && ($_GET['subproduct']))
	{
		if($_GET['assign'] && ($_GET['status'] == 'nostatus') && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if(($_GET['status'] == 'nostatus') && $_GET['assign'] && $_GET['startdate'] && $_GET['enddate'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments ) AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else if($_GET['status'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype='".$_GET['subproduct']."' AND  assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['status']) && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE pstype='".$_GET['subproduct']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND pstype='".$_GET['subproduct']."' AND ptclid IN(SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
	} //15
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status']) &&  ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['assign'] && ($_GET['status'] == 'nostatus') && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if(($_GET['status'] == 'nostatus') && $_GET['assign'] && $_GET['startdate'] && $_GET['enddate'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments ) AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else if($_GET['status'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND  assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['status']) && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptype='".$_GET['product']."' AND ptclid IN(SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
	} //16
	else if(($_GET['client'] == 'all') && ($_GET['assign'] != 'all') && ($_GET['status'] != 'all') &&  ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
	{
		if(($_GET['assign'] != 'all') && ($_GET['status'] == 'nostatus') && ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
			$all_status = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assign']."' AND ptype='".$_GET['product']."' AND pstype='".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else
			$all_status = mysql_query('Select * FROM lead WHERE ptype="'.$_GET['product'].'" AND pstype="'.$_GET['subproduct'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') &&  ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') && ($_GET['product'] == 'all') && $_GET['subproduct'])
	{
		if($_GET['followdate'] && $_GET['subproduct'] && ($_GET['assign']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype='".$_GET['subproduct']."' AND  ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else	
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And pstype="'.$_GET['subproduct'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') && ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'] && $_GET['product'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."'  AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And ptype="'.$_GET['product'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && ($_GET['status'] == 'all') && $_GET['product'] && $_GET['subproduct'])
	{
		if($_GET['followdate'] && $_GET['product'] && $_GET['subproduct'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."'  AND pstype='".$_GET['subproduct']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if(($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And ptype="'.$_GET['product'].'" AND pstype="'.$_GET['subproduct'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && ($_GET['status']) && ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if(($_GET['status'] == 'nostatus') && $_GET['startdate'] && $_GET['enddate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid NOT IN (SELECT ptclid FROM comments) AND (ldate between '".$_GET['startdate']."' AND '".$_GET['enddate']."') ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else if($_GET['status'] == 'nostatus')	
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if($_GET['status'] && $_GET['followdate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else 
		{
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
			//$status = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE slno='".$_GET['status']."'"));
		}
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && $_GET['status'] && ($_GET['product'] == 'all') && $_GET['subproduct'])
	{
		if(($_GET['status'] == 'nostatus') && $_GET['startdate'] && $_GET['enddate'] && $_GET['subproduct'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype = '".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) AND (ldate between '".$_GET['startdate']."' AND '".$_GET['enddate']."') ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else if($_GET['status'] == 'nostatus' && $_GET['subproduct'])	
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype = '".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if($_GET['status'] && $_GET['followdate'] && $_GET['subproduct'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype = '".$_GET['subproduct']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And pstype="'.$_GET['subproduct'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && $_GET['status'] && ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if(($_GET['status'] == 'nostatus') && $_GET['startdate'] && $_GET['enddate'] && $_GET['product'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND ptclid NOT IN (SELECT ptclid FROM comments) AND (ldate between '".$_GET['startdate']."' AND '".$_GET['enddate']."') ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else if($_GET['status'] == 'nostatus' && $_GET['product'])	
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if($_GET['status'] && $_GET['followdate'] && $_GET['product'])
			$all_status = mysql_query("SELECT * FROM lead WHERE  cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else
			$all_status = mysql_query('Select * FROM lead WHERE  cname="'.$_GET['client'].'" And ptype="'.$_GET['product'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign'] == 'all') && ($_GET['status'] != 'all') && ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
	{
		if(($_GET['status'] == 'nostatus') && ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND pstype='".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And ptype="'.$_GET['product'].'" AND pstype="'.$_GET['subproduct'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE  cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND (ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."') ORDER BY id DESC");	
		else if($_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And assign="'.$_GET['assign'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product'] == 'all') && ($_GET['subproduct']))
	{
		if($_GET['followdate'] && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype ='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype ='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype ='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And pstype ="'.$_GET['subproduct'].'" AND assign="'.$_GET['assign'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['followdate'] && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And ptype ="'.$_GET['product'].'" AND assign="'.$_GET['assign'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign']) && ($_GET['status'] == 'all') &&  ($_GET['product']) && ($_GET['subproduct']))
	{
		if($_GET['followdate'] && $_GET['assign'] && ($_GET['product'])  && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype ='".$_GET['subproduct']."' AND ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if($_GET['startdate'] && $_GET['enddate'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['product'])  && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype ='".$_GET['subproduct']."' AND ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['product'])  && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype ='".$_GET['subproduct']."' AND ptype ='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE fdate='".$_GET['followdate']."') OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And pstype ="'.$_GET['subproduct'].'" AND ptype ="'.$_GET['product'].'" AND assign="'.$_GET['assign'].'" ORDER BY id DESC');
	}
	else if(($_GET['client']) && ($_GET['assign']) && ($_GET['status']) &&  ($_GET['product'] == 'all') && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['assign'] && ($_GET['status'] == 'nostatus'))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if(($_GET['status'] == 'nostatus') && $_GET['assign'] && $_GET['startdate'] && $_GET['enddate'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments ) AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else if($_GET['status'] && $_GET['followdate'] && $_GET['assign'])
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['status']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And  assign='".$_GET['assign']."' AND ptclid IN(SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
	}
	else if(($_GET['client']) && ($_GET['assign']) && ($_GET['status']) &&  ($_GET['product'] == 'all') && ($_GET['subproduct']))
	{
		if($_GET['assign'] && ($_GET['status'] == 'nostatus') && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if(($_GET['status'] == 'nostatus') && $_GET['assign'] && $_GET['startdate'] && $_GET['enddate'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype='".$_GET['subproduct']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments ) AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else if($_GET['status'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype='".$_GET['subproduct']."' AND  assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['status']) && ($_GET['subproduct']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And pstype='".$_GET['subproduct']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND pstype='".$_GET['subproduct']."' AND ptclid IN(SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
	}
	else if(($_GET['client'] == 'all') && ($_GET['assign']) && ($_GET['status']) &&  ($_GET['product']) && ($_GET['subproduct'] == 'all'))
	{
		if($_GET['assign'] && ($_GET['status'] == 'nostatus') && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");
		else if(($_GET['status'] == 'nostatus') && $_GET['assign'] && $_GET['startdate'] && $_GET['enddate'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND assign='".$_GET['assign']."' AND ptclid NOT IN (SELECT ptclid FROM comments ) AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");	
		else if($_GET['status'] && $_GET['followdate'] && $_GET['assign'] && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND  assign='".$_GET['assign']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) ORDER BY id DESC");
		else if((($_GET['startdate'] && $_GET['enddate']) || $_GET['followdate']) && $_GET['assign'] && ($_GET['status']) && ($_GET['product']))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And ptype='".$_GET['product']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."' AND enable=1) OR ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."' ORDER BY id DESC");
		else
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptype='".$_GET['product']."' AND ptclid IN(SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."' AND enable=1) ORDER BY id DESC");
	}
	else if(($_GET['client'] != 'all') && ($_GET['assign'] != 'all') && ($_GET['status'] != 'all') &&  ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
	{
		if(($_GET['assign'] != 'all') && ($_GET['status'] == 'nostatus') && ($_GET['product'] != 'all') && ($_GET['subproduct'] != 'all'))
			$all_status = mysql_query("SELECT * FROM lead WHERE cname='".$_GET['client']."' And assign='".$_GET['assign']."' AND ptype='".$_GET['product']."' AND pstype='".$_GET['subproduct']."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY id DESC");// OR "); //WHERE status_id ='".$_GET['status']."' AND fdate='".$_GET['followdate']."') AND ldate between '".$_GET['startdate']."' and '".$_GET['enddate']."'");
		else
			$all_status = mysql_query('Select * FROM lead WHERE cname="'.$_GET['client'].'" And ptype="'.$_GET['product'].'" AND pstype="'.$_GET['subproduct'].'" AND ptclid IN(SELECT ptclid FROM comments WHERE status_id="'.$_GET['status'].'" AND enable=1) ORDER BY id DESC');
	}
	if(mysql_num_rows($all_status))
	{
		echo "<table><tr><td><h1>Lead Summary of Status and Product</h1></td></tr></table>#
		<table  border='1'  align='left' class='paginate sortable full'>
				
				<tr>
						<th align=''>Lead-ID</th>
						<!--th align='left'>Client-ID</th-->
						<th align=''>Company Name</th>
						<th align=''>Lead Description</th>
						<th align=''>Lead Date</th>
						<th align=''>Product Type</th>
						<!--th align='left'>Product Sub Type</th-->
						<th align=''>Assign</th>
						<th align=''>Status</th>
					</tr>";
						
				while($fetch_lead = mysql_fetch_array($all_status))
				{
					echo "<tr>
						<td align='center'><a href='?page=leadstatus&id=".$fetch_lead['ptclid']."&ptcid=".$fetch_lead['cname']."&product=".$_GET['product1']."' style='text-decoration:none;'>".$fetch_lead['ptclid']."</td>";
						$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$fetch_lead['cname']."'"));
						//echo	"<td>".$query['ptcid']."</td>
						echo	"<td align='center' style='width:150px'>".$query['cname']."</td>";
						$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$fetch_lead['ptclid']."'"));
						$var = $lead['ldesc'];
						$newtext = wordwrap($var,50, "\n",true);
						echo	"<td style='width:150px'>".$newtext."</td>";
						echo	"<td  align='center'>".$lead['ldate']."</td>";
						$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
						$row1 = mysql_fetch_array($query1);
						echo	"<td  align='center'>".$row1['type']."</td>";
						$query3 = mysql_query("SELECT * FROM assignee  where slno='".$lead['assign']."'");
						$row3=mysql_fetch_array($query3);
						echo	"<td  align='center'>".$row3['name']."</td>";
						$status = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$fetch_lead['ptclid']."' And enable=1"));
						$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status['status_id']."'"));
						if($status_id)
							echo "<td  align='center'>".$status_id['status']."</td>";
						else
							echo "<td  align='center'>Open</td>";
							
						echo 	"</tr>";	
				}	
				echo "</table>";
	}
	else
	{
		echo "#<table  border='1'  align='left' class='paginate sortable full'>
			<tr><td></td><td>";
			echo "No Leads</td></tr>
			</table>";
	}
	
?>