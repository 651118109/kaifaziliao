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
<title>后台导航管理</title>
<link type="text/css" rel="stylesheet" href="../css/pager.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
<script type="text/javascript">
    function All(e, itemmc)
    {
        var aa = document.getElementsBymc(itemmc);
        for (var i=0; i<aa.length; i++)
           aa[i].checked = e.checked; //得到那个总控的复选框的选中状态
        }
    function Item(e, allmc)
    {
        var all = document.getElementsBymc(allmc)[0];
        if(!e.checked) {
            all.checked = false;
        }else{
            var aa = document.getElementsBymc(e.mc);
            for (var i=0; i<aa.length; i++)
             if(!aa[i].checked) return;
            all.checked = true;
        }
    }
</script>
<link type="text/css" rel="stylesheet" href="../css/jsmanage.css" />
</head>
<body>
<div class="rightinfo">
<form action="deletepl.php" method="post">
<table class="tablelist" >
    <thead>
    <tr>
        <th width="30%">标题</th>
        <th width="40%">跳转地址</th>
        <th width="30%">修改</th>
    </tr>
    </thead>
    <tbody >
    <?php 
    $sql="select * from backstage "
            . "where backstage_level=0 order by backstage_id asc";
    $rows=$db->query_lists($sql);
    foreach ($rows as $row){
    ?>
    <tr >
        <td style="text-align:left; padding-left:5%;">
        <?=$row['backstage_title']?>
        </td>
        <td><?=$row['backstage_link']?></td>
        <td>
            <a href="update.php?id=<?=$row['backstage_id']?>">
                <img src="../images/t02.png" >
            </a>
        </td>
    </tr>
    <?php
            $level=$row['backstage_id'];
            $sql1="select * from  backstage "
                    . "where backstage_level=$level order by backstage_id asc";
            $errows=$db->query_lists($sql1);
            foreach ($errows as $errow){
    ?>
    <tr>
        <td style="text-align:left; padding-left:10%;">
            <img src="../images/clist.png" />
            &nbsp;&nbsp;<?=$errow['backstage_title']?>
        </td>
        <td><?=$errow['backstage_link']?></td>
        <td>
            <a href="update.php?id=<?=$errow['backstage_id']?>">
                <img src="../images/t02.png" >
            </a>
        </td>
    </tr>
            <?php }?>
    <?php }?>
    </tbody>
</table>
</form>
</div>
</body>
</html>
