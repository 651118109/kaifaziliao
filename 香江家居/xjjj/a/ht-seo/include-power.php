<?php
header("Content-Type: text/html;charset=utf-8");
//判断用户是否有访问此页面的权限
if(empty($_COOKIE['roid']))
{
	echo RELOGIN;
    exit() ;
}
else 
{
	$roidid=$_COOKIE['roid'];
	$roidrow=$db->query_list_id("select * from power where power_id=$roidid");
	$roidcontent=$roidrow["power_content"];
	$roids= explode(",", $roidcontent);
	$roidcount=0;
	foreach ($roids as $roid)
	{
	    if($roid==41)
	    {
	        $roidcount=1;
	    }
	}
	if($roidcount==0)
	{
	    echo RESTRICTION;
	    return;
	}
}
