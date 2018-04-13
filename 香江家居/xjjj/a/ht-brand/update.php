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
<?php
$id=$_REQUEST['id'];
$sql = "select * from brand where brand_id='$id'";
$row =$db->query_list_id($sql);
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="brand_id" value="<?=$_REQUEST['id']?>" 
       id="brand_id" class="dfinput" />
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
               <input type="text" name="brand_title" id="brand_name" value="<?=$row['brand_title']?>"  class="dfinput" />
                <i>*必须填写</i>
            </li>
            <li>
                <label>背景色值：</label>
                <input type="text" name="brand_color" id="brand_color" class="dfinput" value="<?=$row['brand_color']?>"  />
                <i>*例如：#000000 或 rgb(0,0,0) 或 black </i>
            </li>
            <li>
                <label>品牌LOGO：</label>
                <input type="file" name="brand_logo" id="brand_logo" onchange="preview(this,'preview_brand_logo')"  />
                <i>*<?=$logo_width ?>*<?=$logo_height ?></i><br />
                <img src="../../<?=$row['brand_logo']?>" width="<?=$logo_width ?>px" height="<?=$logo_height ?>px"/>
                <input type="hidden" name="brand_logos" id="brand_logo" value="<?=$row['brand_logo']?>" />
                <div id="preview_brand_logo">预览区</div>
            </li>
            <li>
                <label>图片：</label>
                <input type="file" name="brand_image" id="brand_image" onchange="preview(this,'preview_brand')" />
                <i>*<?=$image_width ?>*<?=$image_height ?></i><br />
                <img src="../../<?=$row['brand_image']?>" width="<?=$image_width ?>px" height="<?=$image_height ?>px"/>
                <input type="hidden" name="brand_images" id="brand_image"
                       value="<?=$row['brand_image']?>" />
                <div id="preview_brand">预览区</div>
            </li>
            <li>
                <label>位置：</label>
                <input type="text" name="brand_position" id="brand_position" class="dfinput" value="<?=$row['brand_position']?>" />
            </li>
            <li>
                <label>内容：</label>
                <textarea class="textarea" name="brand_content" id="brand_content"><?=$row['brand_content']?></textarea>
            </li>
        	<li>
                <label>排序：</label>
                <input type="text" name="brand_sort" id="brand_sort"
                value="<?=$row['brand_sort']?>"  class="dfinput" />
                <i>*如果为空或非数字默认为0</i>
            </li>
            <li>
                <label>是否显示：</label>
                <select name="brand_show" id="brand_show" class="dfinput">
                    <option  value="0" <?=$row['brand_show']==0?"selected":""?>>否</option>
                    <option  value="1" <?=$row['brand_show']==1?"selected":""?>>是</option>
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
