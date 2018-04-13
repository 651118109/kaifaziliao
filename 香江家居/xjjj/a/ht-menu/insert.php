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
    <link href="css/css.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<form action="insertdb.php" method="post"  enctype="multipart/form-data">
<input type="hidden" name="menu_level" 
       value="<?=$_REQUEST['id']?>" id="menu_level" class="dfinput" />
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
                <input type="text" name="menu_title" 
                       id="menu_title" class="dfinput" />
                <i>*必须填写</i>
            </li>
            <li>
                <label>排序：</label>
                <input type="text" name="menu_sort" id="menu_sort" 
                       class="dfinput" />
                <i>*如果为空或非数字默认为0</i>
            </li> 
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnAdd" id="btnAdd" 
                       value="确认保存" class="btn"  /> 
                <input type="button" name="btnSearch" id="btnSearch" 
                       onclick="fh()" value="返回" class="btn" />  
            </li>
        </ul>
    </div>
</form>
</body>
</html>
