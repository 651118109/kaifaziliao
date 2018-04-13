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
<title>SEO管理</title>
<link type="text/css" rel="stylesheet" href="../css/pager.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
<script type="text/javascript">
    function All(e, itemName)
    {
    var aa = document.getElementsByName(itemName);
    for (var i=0; i<aa.length; i++)
       aa[i].checked = e.checked; //得到那个总控的复选框的选中状态
    }
    function Item(e, allName)
    {
        var all = document.getElementsByName(allName)[0];
        if(!e.checked) {
            all.checked = false;
        }else{
            var aa = document.getElementsByName(e.name);
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
                    <th width="15%">对应导航</th>
                    <th width="15%">页面名称</th>
                    <th width="20%">网页关键字</th>
                    <th width="40%">网页描述</th>
                    <th width="10%">修改</th>
                </tr>
            </thead>
            <tbody >
            <?php
            $sql="select * from menu where menu_level=0 order by menu_sort asc,menu_id asc";
            $rows=$db->query_lists($sql);
            foreach ($rows as $row)
            {
            ?>
                <tr>
                    <td style="text-align:left; padding-left:1%;">
                    <?=$row['menu_title']?>
                    </td>
                    <td><?=$row['title']?></td>
                    <td><?=$row['keywords']?></td>
                    <td><?=$row['description']?></td>
                    <td>
                        <a href="update.php?id=<?=$row['menu_id']?>">
                            <img src="../images/t02.png" >
                        </a>
                    </td>
                </tr>
                <?php
                $level=$row['menu_id'];
                $errows=$db->query_lists("select * from  menu where menu_level=$level"
                        . " order by menu_sort asc,menu_id asc");
                foreach ($errows as $errow)
                {
                    ?>
                    <tr>
                        <td style="text-align:left; padding-left:2%;">
                           <img src="../images/clist.png" />&nbsp;&nbsp;<?=$errow['menu_title']?>
                        </td>
                        <td><?=$errow['title']?></td>
                        <td><?=$errow['keywords']?></td>
                        <td><?=$errow['description']?></td>
                        <td>
                            <a href="update.php?id=<?=$errow['menu_id']?>">
                                <img src="../images/t02.png" >
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php }?>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
