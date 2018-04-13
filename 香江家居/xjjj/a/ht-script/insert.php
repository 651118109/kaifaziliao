<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加模块</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="../ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    //var editor = new UE.ui.Editor();
    //editor.render("news_content");
function fh()
{
    location.href="javascript:history.go(-1)";
}
</script>
</head>
<body>
<form action="insertdb.php" method="post" enctype="multipart/form-data">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">添加模块</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>标题：</label>
                <input type="text" name="script_title" id="script_title" class="dfinput" />
                <i>*必须填写</i>
            </li>
            <li>
            	<label>代码：</label>
                <textarea name="script_content" class="textarea"></textarea>
            </li>
            <li>
                <label>位置：</label>
                 <select name="script_level" id="script_level" class="dfinput">
                        <option  value="1">head之间</option>
                        <option  value="2">body之间</option>
                </select>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnAdd" id="btnAdd" value="确认保存" class="btn" /> 
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
