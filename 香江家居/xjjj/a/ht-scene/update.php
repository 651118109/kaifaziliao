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
    <title>现场热图管理</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/preview-pictures.js"></script>
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
$id=$_REQUEST['id'];
$sql = "select * from scene where scene_id='$id'";
$row =$db->query_list_id($sql);
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="scene_id" value="<?=$_REQUEST['id']?>" 
       id="scene_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">现场热图管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>现场热图信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>标题：</label>
               <input type="text" name="scene_title" id="scene_name"
                value="<?=$row['scene_title']?>"  class="dfinput" />
                <i>*必须填写</i>
            </li>
            <li>
                <label>图片：</label>
                <input type="file" name="scene_image" id="scene_image" onchange="preview(this,'preview_scene')" />
                <i>*<?=$image_width ?>*<?=$image_height ?></i><br />
                <img src="../../<?=$row['scene_image']?>" width="<?=$image_width ?>px" height="<?=$image_height ?>px"/>
                <input type="hidden" name="scene_images" id="scene_image"
                       value="<?=$row['scene_image']?>" />
                <div id="preview_scene">预览区</div>
            </li>
        	<li>
                <label>排序：</label>
                <input type="text" name="scene_sort" id="scene_sort"
                value="<?=$row['scene_sort']?>"  class="dfinput" />
                <i>*如果为空或非数字默认为0</i>
            </li>  
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnEdit" 
                       value="确认保存" class="btn" /> 
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
