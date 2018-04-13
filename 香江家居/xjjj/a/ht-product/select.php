<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>产品管理</title>
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
<p style="margin-top: 10px;">
    <?php
    $menus=$db->query_lists("select * from menu where menu_level=3 order by menu_sort asc,menu_id asc");
    $menus[0]['menu_id']=empty($menus[0]['menu_id'])?-1:$menus[0]['menu_id'];
    $level=empty($_REQUEST['level'])?$menus[0]['menu_id']:$_REQUEST['level'];
    if($level!=-1)
    {
        foreach ($menus as $menu)
        {
            if($level==$menu['menu_id'])
            {?>
                <a href="?level=<?=$menu['menu_id']?>">
                    <input  style="color:red;" type="button" name="btnSearch" id="btnSearch"
                            value="<?=$menu['menu_title']?>" class="btn" >
                </a>
            <?php }
            else
            {
                ?>
                <a href="?level=<?=$menu['menu_id']?>">
                    <input type="button" name="btnSearch" id="btnSearch"
                           value="<?=$menu['menu_title']?>" class="btn" >
                </a>
            <?php
            }
        }
    }?>
</p>
<?php
if($level!=-1)
{
?>
<div class="rightinfo">
    <div class="tools" style="float:left; width:49%; margin-top:10px;">
        <form action="?p=1&level=<?=$level?>" method="post">
            <div class="ss_kuang">
                <p>查找：</p>
                <input type="text" name="Searchname" id="Searchname" class="ss_wk" />
                <div class="ss_tu">
                    <input type="submit" name="btnSearch" id="btnSearch" value="搜索" class="btn" >
                </div>
            </div>
        </form>
    </div>
    <form action="deletepl.php" method="post">
		<div class="tools" style="float:right; width:49%; margin-top:10px;">
            <ul class="float">
                <li class="click">
                    <a href="insert.php?level=<?=$level?>"  >
                        <img  src="../images/AddWZ.png" >
                    </a>
                </li>
                <li style="float:left; padding-right:0px;">
                    <input name="Submit" type="submit" value="删除选中" class="btn" />
            <input type="hidden" name="level" id="level" class="ss_wk" value="<?=$level?>" />
                </li>
            </ul>
        </div>
        <?php
        $p=empty($_REQUEST["p"])?1:$_REQUEST["p"];
        $Searchname=empty($_REQUEST['Searchname'])?'':$_REQUEST['Searchname'];
        $sql="select * from product where product_title like '%$Searchname%' and product_level=$level order by product_sort desc,product_id desc";
        $count=$db->page_count("select count(*) from product where product_title like '%$Searchname%' and product_level=$level order by product_sort desc,product_id desc", 10);
        $rows=$db->paging($sql, $p, 10);
        ?>
        <table class="tablelist" >
            <thead>
            <tr style="border-top:10px solid red;">
                    <th width="100px">
                       <input type="checkbox"  name="mmAll" onclick="All(this, 'mm[]')">
                    </th>
                    <th width="100px">序号</th>
                    <th>产品</th>
                    <th>品牌LOGO</th>
                    <th>图片</th>
                    <th width="100px">修改</th>
                    <th width="100px">删除</th>
            </tr>
            </thead>
            <tbody>
                <?php
            foreach ($rows as $k=>$row)
                {
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="mm[]"
                               value="<?= $row['product_id'] ?>" onclick="Item(this, 'mmAll')">
                    </td>
                    <td><?= $k + 1 ?></td>
                    <td style="text-align:left; padding-left:1%;">
                        <?= $row['product_title'] ?>
                        <?= $row['product_sort'] == 1 ? "<font color='red'><b>【置顶】</b></font>" : "" ?>
                        <?= $row['product_show'] == 1 ? "<font color='blue'><b>【推荐】</b></font>" : "" ?>
                    </td>
                    <td><img src="../../<?= $row['product_logo'] ?>" width="100px"/></td>
                    <td><img src="../../<?= $row['product_image'] ?>" width="100px"/></td>
                    <td>
                        <a href="update.php?id=<?=$row['product_id']?>&level=<?=$level?>">
                            <img src="../images/t02.png" >
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['product_id']?>&level=<?=$level?>">
                            <img src="../images/t03.png" >
                        </a>
                    </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
        <i>
            <b>
                <font color="red">
                </font>
            </b>
        </i>
        <ul class="fy">
            <li><span><a href="?p=<?=$p>1?$p-1:1?>&Searchname=<?=$Searchname?>&level=<?=$level?>"> 上一页</a></span></li>
            <?php
            for($i=1;$i<=$count;$i++)
            {
                if($i==$p)
                {
            ?>
                <li class="active"><a href="?p=<?=$p?>&Searchname=<?=$Searchname?>&level=<?=$level?>"><?=$i?></a></li>
                <?php }
                else
                {?>
                <li><a href="?p=<?=$i?>&Searchname=<?=$Searchname?>&level=<?=$level?>"><?=$i?></a></li>
            <?php }
            }?>
            <li><span><a href="?p=<?=$p<$count?$p+1:$count?>&Searchname=<?=$Searchname?>&level=<?=$level?>">下一页</a></span></li>
        </ul>
    </form>
</div>
<?php
}
else
{
    echo MODULE_SWITCH;
}
?>
</body>
</html>




