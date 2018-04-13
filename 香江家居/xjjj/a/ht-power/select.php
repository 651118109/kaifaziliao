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
<title>权限管理</title>
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
    <div class="tools" style="float:right; width:49%; margin-top:10px;">
        <ul class="float">
            <li class="click">
                <a style="float:right;padding-right:30%;font-size:16px;"
                   href="insert.php">
                    <img style="vertical-align:middle;" src="../images/AddWZ.png" >
                </a>
            </li>
        </ul>
    </div>
    <table class="tablelist" >
        <thead>
            <tr>
                <th width="25%">序号</th>
                <th width="25%">名称</th>
                <th width="25%">修改</th>
                <th width="25%">删除</th>
            </tr>
	    </thead>
        <tbody >
        <?php
        $sql="select * from power";
        $rows=$db->query_lists($sql);
        foreach ($rows as $k=>$row)
        {
        ?>
            <tr >
                <td><?=$k+1?></td>
                <td><?=$row['power_name']?></td>
                <td>
                    <a href="update.php?id=<?=$row['power_id']?>">
                        <img src="../images/t02.png" >
                    </a>
                </td>
                <td>
                    <?php
                    if($row['power_id']==1)
                    {
                        echo "--";
                    }
                    else
                    {
                        ?>
                        <a href="delete.php?id=<?=$row['power_id']?>">
                            <img src="../images/t03.png" >
                        </a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
</body>
</html>
