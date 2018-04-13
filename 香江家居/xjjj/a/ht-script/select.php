<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>模块管理</title>
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
    <div class="tools" style="float:left; width:49%; margin-top:10px;">
        <form action="?p=1" method="post">
            <div class="ss_kuang">
                <p>查找：</p>
                <input type="text" name="Searchname" id="Searchname" class="ss_wk" />
                <div class="ss_tu">
                    <input type="submit" name="btnSearch" id="btnSearch" value="搜索" class="btn" >
                </div>
            </div>
        </form>
</div>
    <div class="tools" style="float:right; width:49%; margin-top:10px;">
        <ul class="float">
            <li class="click">
                <a href="insert.php"  >
                    <img  src="../images/AddWZ.png" >
                </a>
            </li>
        </ul>
    </div>
	<?php
	$Searchname=empty($_REQUEST['Searchname'])?'':$_REQUEST['Searchname'];
	$sql="select * from script where script_title like '%$Searchname%' order by script_id desc";
	$rows=$db->query_lists($sql);
	?>
    <table class="tablelist" >
        <thead>
            <tr style="border-top:10px solid red;">
                <th width="10%">序号</th>
                <th width="30%">模块标题</th>
                <th width="30%">位置</th>
                <th width="10%">修改</th>
                <th width="10%">卸载</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rows as $k=>$row)
                {
                ?>
                <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= $row['script_title'] ?></td>
                    <td><?= $row['script_level']==1?"head之间":"body之间" ?></td>
                    <td>
                        <a href="update.php?id=<?=$row['script_id']?>">
                            <img src="../images/t02.png" >
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['script_id']?>">
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
            此模块是为手动安装百度统计、客服软件等代码形式的软件而设。由于不同软件的安装方式不同，请参考自己所需代码的安装指南中的“如何手动安装代码” 进行安装。
        </font>
    </b>
</i>
</div>
</body>
</html>




