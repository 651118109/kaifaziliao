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
<title>图片管理</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/preview-pictures.js"></script>
<script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
$id=$_REQUEST['id'];
if($id==1)
{
    $image_width=$image_width_1;
    $image_height=$image_height_1;
}
else if($id==5){
    $image_width=$image_width_5;
    $image_height=$image_height_5;
}
else{
    $image_width=$image_width_12;
    $image_height=$image_height_12;
}
$sql = "select * from image where image_id='$id'";
$row =$db->query_list_id($sql);
?>
<form action="external-updatedb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="image_id" value="<?=$_REQUEST['id']?>" 
       id="image_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">图片管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>图片信息</span>
        </div>
        <ul class="forminfo">
        	<li>
                <label>图片位：</label>
               	<input type="text" name="image_title" id="image_title" class="dfinput" value="<?=$row['image_title']?>" />
               	<i>*必须填写</i>
            </li>
            <li>
                <label>图片：</label>
                <input type="file" name="image_image" id="image_image" onchange="preview(this,'preview_image_<?=$id?>')" />
                <i>*<?=$image_width ?>*<?=$image_height?></i><br />
                <img src="<?=$row['image_image']?>" width="<?=$image_width/5 ?>" height="<?=$image_height/5 ?>"  />
                <input type="hidden" name="image_images" id="image_image" value="<?=$row['image_image']?>" />
                <div id="preview_image_<?=$id?>">预览区</div>
            </li>
            <li>
                <label>是否显示：</label>
				<select name="image_show" id="image_show" class="dfinput">
                    <option  value="1" <?=$row['image_show']==1?"selected='selected'":""?>>是</option>
                    <option  value="0" <?=$row['image_show']==0?"selected='selected'":""?>>否</option>
                </select>
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
