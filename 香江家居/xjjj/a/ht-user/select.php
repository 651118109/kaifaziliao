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
<title>Insert title here</title>
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
    <div class="tools" style="float:left; width:49%">
        <form action="#" method="post">
            <div class="ss_kuang">
                <p>查找：</p>
                <input type="text" name="Searchname" id="Searchname" class="ss_wk" />
                <div class="ss_tu">
                    <input type="submit" value="搜索" class="btn" >
                </div>
            </div>
        </form>
    </div>
    <form action="deletepl.php" method="post">
        <div class="tools" style="float:right; width:49%">
            <ul class="float">
                <li class="click">
                <a href="insert.php">
                    <?php
                    if($_COOKIE['roid']==1)
                    { ?>
                    <img src="../images/AddWZ.png" alt="" Width="100" Height="35" />
                    <?php }?>
                </a>
                </li>
            </ul>
        </div>
        <table class="tablelist" >
            <thead>
                <tr>
                    <th width="10%">编号</th>
                    <th width="20%">用户名</th>
                    <th width="20%">密码</th>
                    <th width="10%">权限</th>
<!--                    <th width="10%">修改密码</th>-->
                    <th width="10%">修改信息</th>
                    <th width="10%">删除</th>
                </tr>
            </thead>
            <tbody >
            <?php
            $Searchname=empty($_REQUEST['Searchname'])?'':$_REQUEST['Searchname'];
            $sql="select * from user where user_name like '%".$Searchname."%' ";
            $rows=$db->query_lists($sql);
            foreach ($rows as $k=>$row)
            {
            ?>
            <tr>
                <td><?=$k+1?></td>
                <td><?=$row['user_name']?></td>
                <td>
                    <?php
                    if($_COOKIE['roid']==1)
                    {
                    ?>
                        <?=$row['user_password']?>
                    <?php
                    }
                     else
                    {
                     ?>
                        ***
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $power_id=$row['user_power'];
                    $powerrow=$db->query_list_id("select * from power where power_id=$power_id");
                    echo $powerrow["power_name"];
                    ?>
                </td>
<!--                <td>-->
<!--                    --><?php
//                    if($_COOKIE['roid']==1||$row['user_id']==$_COOKIE['uid'])
//                    {
//                        ?>
<!--                        <a href="password-update.php?id=--><?//=$row['user_id']?><!--">-->
<!--                            <input type="button" value="修改密码" class="btn" >-->
<!--                        </a>-->
<!--                        --><?php
//                    }
//                    else
//                    {
//                        ?><!------><?php
//                    }
//                    ?>
<!--                </td>-->
                <td>
                <?php
                if($_COOKIE['roid']==1)
                {

                ?>
                    <a href="update.php?id=<?=$row['user_id']?>">
                        <img src="../images/t02.png" >
                    </a>
                <?php
                 }
                else{
                    echo '--';

                }?>
                </td>
                <td>
                <?php
                if($row['user_power']==1)
                        echo '--';
                else
                {
                    if($_COOKIE['roid']==1)
                    {
                  ?>
                    <a href="delete.php?id=<?=$row['user_id']?>">
                        <img src="../images/t03.png" >
                    </a>
                <?php
                    }
                    else
                    {
                        echo '--';
                    }

                }
                ?>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
