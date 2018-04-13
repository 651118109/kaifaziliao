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
    <title>品牌活动管理</title>
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
            <li><a href="#">品牌活动管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>品牌活动信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>标题：</label>
                <input type="text" name="brand_title"  id="brand_title" class="dfinput" />
                <i>*必须填写</i>
            </li>
            <li>
                <label>背景色值：</label>
                <input type="text" name="brand_color" id="brand_color" class="dfinput"  />
                <i>*例如：#000000 或 rgb(0,0,0) 或 black </i>
            </li>
            <li>
                <label>品牌LOGO：</label>
                <input type="file" name="brand_logo" id="brand_logo" onchange="preview(this,'preview_brand_logo')"  />
                <i>*<?=$logo_width ?>*<?=$logo_height ?></i>
            </li>
            <li>
                <label>&nbsp;</label>
                <div id="preview_brand_logo">预览区</div>
            </li>
            <li>
                <label>图片：</label>
                <input type="file" name="brand_image" id="brand_image" onchange="preview(this,'preview_brand')" />
                <i>*<?=$image_width?>*<?=$image_height?></i>
            </li>
            <li>
                <label>&nbsp;</label>
                <div id="preview_brand">预览区</div>
            </li>
            <li>
                <label>位置：</label>
                <input type="text" name="brand_position" id="brand_position" class="dfinput" />
            </li>
            <li>
                <label>内容：</label>
                <textarea class="textarea" name="brand_content" id="brand_content"></textarea>
            </li>
        	<li>
                <label>排序：</label>
                <input type="text" name="brand_sort" 
                       id="brand_sort"  class="dfinput" />
                <i>*如果为空或非数字默认为0</i>
            </li>
            <li>
                <label>是否显示：</label>
                <select name="brand_show" id="brand_show" class="dfinput">
                    <option  value="0">否</option>
                    <option  value="1">是</option>
                </select>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnAdd" id="btnAdd" value="确认保存" class="btn" >
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
