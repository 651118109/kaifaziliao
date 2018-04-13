<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>背景色管理</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/preview-pictures.js"></script>
<script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
$id=$_REQUEST['id'];
$sql = "select * from color where color_id='$id'";
$row =$db->query_list_id($sql);
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="color_id" value="<?=$_REQUEST['id']?>"
       id="image_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">背景色管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>背景色信息</span>
        </div>
        <ul class="forminfo">
        	<li>
                <label>位置：</label>
               	<input type="text" name="color_title" id="color_title" class="dfinput" value="<?=$row['color_title']?>" readonly />
            </li>
            <li>
                <label>色值：</label>
                <input type="text" name="color_content" id="color_content" class="dfinput" value="<?=$row['color_content']?>"  />
                <i>*例如：#000000 或 rgb(0,0,0) 或 black </i>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnEdit" value="确认保存" class="btn" />
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
