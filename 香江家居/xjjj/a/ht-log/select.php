<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>系统日志</title>
<link type="text/css" rel="stylesheet" href="../css/pager.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
<link type="text/css" rel="stylesheet" href="../css/jsmanage.css" />
</head>
<body>
<div class="rightinfo">
<i><b><font color="red">
*温馨提示：为了防止数据存储量过大，系统会自动删除10天之前的系统日志。
</font></b></i>
<table class="tablelist" >
    <thead>
    <tr>
            <th width="10%">序号</th>
            <th width="20%">用户</th>
            <th width="50%">事件</th>
            <th width="20%">时间</th>
    </tr>
    </thead>
    <tbody >
    <?php 
	$p=empty($_REQUEST["p"])?1:$_REQUEST["p"];
	$sql="select * from log order by Log_id desc";
        $countsql="select count(*) from log order by Log_id desc";
	$count=$db->page_count($countsql, 20);
	$rows=$db->paging($sql, $p, 20);
    foreach ($rows as $k=>$row)
    {
    ?>
    <tr >
    <td><?=$k+1?></td>
    <td><?=$row['Log_name']?></td>
    <td style="text-align:left; padding-left:2%;"><?=$row['Log_event']?></td>
    <td><?=$row['Log_time']?></td>
    </tr>
    <?php }?>
    </tbody>
</table>
<ul class="fy">
        <li><span><a href="?p=<?=$p>1?$p-1:1?>"> 上一页</a></span></li>
        <?php 
        for($i=1;$i<=$count;$i++)
        {
                if($i==$p)
                {
        ?>
                <li class="active"><a href="?p=<?=$p?>"><?=$i?></a></li>
                <?php }
                else 
                {?>
                <li><a href="?p=<?=$i?>"><?=$i?></a></li>
        <?php }
        }?>
        <li><span><a href="?p=<?=$p<$count?$p+1:$count?>">下一页</a></span></li>
</ul>
</div>
</body>
</html>
