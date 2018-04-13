<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>模块管理</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
	if(!empty($_REQUEST['id'])){ 
		$menu_id=$_REQUEST['id'];
		$sql = "select * from menu where menu_id='$menu_id'";
	    $row =$db->query_list_id($sql);
	}
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menu_id" value="<?=$_REQUEST['id']?>"
           id="menu_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">模块管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>模块信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>标题：</label>
                <input type="text" name="menu_title" id="menu_title" 
                       class="dfinput" value="<?=$row['menu_title']?>" />
                <i>*必须填写</i>
            </li>
            <?php
            if($row['menu_id']!=1)
            {
            ?>
                <li>
                    <label>是否显示：</label>
                    <select class="dfinput" name="menu_show" id="menu_subtitle">
                        <option value="1" <?=$row['menu_show']==1?"selected":""?>>显示</option>
                        <option value="0" <?=$row['menu_show']==0?"selected":""?>>隐藏</option>
                    </select>
                </li>
            <?php }?>
            <li>
            <label>排序：</label>
            <input type="text" name="menu_sort" id="menu_sort" class="dfinput"
                   value="<?=$row['menu_sort']?>" />
            <i>*如果为空或非数字默认为0</i>
            </li> 
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnEdit" 
                       value="确认保存" class="btn" /> 
                <input type="button" name="btnSearch" id="btnSearch"
                       onclick="fh()" value="返回" class="btn" />  
            </li>
        </ul>
    </div>
</form>
</body>
</html>
