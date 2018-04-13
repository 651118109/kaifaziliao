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
<title>分会场管理</title>
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
        <th colspan="7" style="align:center; font-size:18px;">分会场管理</th>
    </tr>
    <tr>
        <th width="10%">序号</th>
        <th width="30%">分会场</th>
        <th width="20%">PC端图片</th>
        <th width="20%">手机端图片</th>
        <th width="10%">修改</th>
    </tr>
    </thead>
    <tbody>
    <?php $ticket_row=$db->query_list_id("select * from menu where menu_id=3"); ?>
    <tr >
        <td>1</td>
        <td style="text-align:left; padding-left:2%;">免费索票</td>
        <td>
            <img src="<?=$ticket_row['menu_image']?>" height="100px" />
        </td>
        <td>
            <img src="<?=$ticket_row['menu_wap_image']?>" height="100px" />
        </td>
        <td>
            <a href="update.php?id=3">
                <img src="../images/t02.png" >
            </a>
        </td>
    </tr>
    <?php $main_row=$db->query_list_id("select * from image where image_id=11"); ?>
    <tr >
        <td>2</td>
        <td style="text-align:left; padding-left:2%;">主会场</td>
        <td>--</td>
        <td>
            <img src="../../<?=$main_row['image_image']?>" height="100px" />
        </td>
        <td>
            <a href="main-update.php?id=<?=$main_row["image_id"]?>">
                <img src="../images/t02.png" >
            </a>
        </td>
    </tr>
    <?php 	
    $sql="select * from menu where menu_level=3 order by menu_id asc";
    $rows=$db->query_lists($sql);
    foreach ($rows as $k=>$row){
    ?>
    <tr >
        <td><?=$k+3?></td>
        <td style="text-align:left; padding-left:2%;">
        	<?=$row['menu_title']?>
        </td>
        <td>
            <img src="<?=$row['menu_image']?>" height="100px" />
        </td>
        <td>
            <img src="<?=$row['menu_wap_image']?>" height="100px" />
        </td>
        <td>
            <a href="update.php?id=<?=$row['menu_id']?>">
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




