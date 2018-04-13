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
<title>分会场管理</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/preview-pictures.js"></script>
<script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
$id=$_REQUEST['id'];
$sql = "select * from image where image_id='$id'";
$row =$db->query_list_id($sql);
?>
<form action="main-updatedb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="image_id" value="<?=$_REQUEST['id']?>"
       id="image_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">分会场管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>分会场信息</span>
        </div>
        <ul class="forminfo">
        	<li>
                <label>主会场：</label>
               	<input type="text" name="image_title" id="image_title" class="dfinput" value="主会场" readonly />
            </li>
            <li>
                <label>手机端图片：</label>
                <input type="file" name="image_image" id="image_image" onchange="preview(this,'preview_main_menu')" />
                <i>*<?=$menu_main_width ?>*<?=$menu_main_height?></i><br />
                <img src="../../<?=$row['image_image']?>" width="<?=$menu_main_width ?>" height="<?=$menu_main_height ?>"  />
                <input type="hidden" name="image_images" id="image_image" value="<?=$row['image_image']?>" />
                <div id="preview_main_menu">预览区</div>
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
