<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>活动亮点管理</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/preview-pictures.js"></script>
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<form action="insertdb.php" method="post" enctype="multipart/form-data">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">活动亮点管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>活动亮点信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>标题：</label>
                <input type="text" name="light_title"  id="light_title" class="dfinput" />
                <i>*必须填写</i>
            </li>
            <li>
                <label>图片：</label>
                <input type="file" name="light_image" id="light_image" onchange="preview(this,'preview_light')" />
                <i>*<?=$image_width?>*<?=$image_height?></i>
            </li>
            <li>
                <label>&nbsp;</label>
                <div id="preview_light">预览区</div>
            </li>
            <li>
                <label>内容：</label>
                <textarea class="textarea" name="light_content" id="light_content"></textarea>
            </li>
        	<li>
                <label>排序：</label>
                <input type="text" name="light_sort" 
                       id="light_sort"  class="dfinput" />
                <i>*如果为空或非数字默认为0</i>
            </li>    
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnAdd" id="btnAdd" 
                       value="确认保存" class="btn" > 
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
