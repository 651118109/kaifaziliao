<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>背景色管理管理</title>
<link type="text/css" rel="stylesheet" href="../css/pager.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
<link type="text/css" rel="stylesheet" href="../css/jsmanage.css" />
</head>
<body>
<div class="rightinfo">
    <table class="tablelist" >
    <thead>
    <tr style="border-top:10px solid red;">
        <th colspan="7" style="align:center; font-size:18px;">背景色管理管理</th>
    </tr>
    <tr>
        <th width="10%">序号</th>
        <th width="30%">位置</th>
        <th width="30%">背景色</th>
        <th width="10%">修改</th>
    </tr>
    </thead>
    <tbody>
    <?php 	
    $sql="select * from color order by color_level asc,color_id asc";
    $rows=$db->query_lists($sql);
    foreach ($rows as $k=>$row){
    ?>
    <tr >
        <td><?=$k?></td>
        <td style="text-align:left; padding-left:2%;">
        	<?=$row['color_title']?>
        </td>
        <td style="background-color: <?=$row['color_content']?>">
            <?=$row['color_content']?>
        </td>
        <td>
            <a href="update.php?id=<?=$row['color_id']?>">
                <img src="../images/t02.png" >
            </a>
        </td>
    </tr>
    <?php }?>
    </tbody>
</table>
</div>
</body>
</html>




