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
<title>编辑产品</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="../ueditor/lang/zh-cn/zh-cn.js"></script>
<link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/preview-pictures.js"></script>
<script type="text/javascript" src="../js/back.js"></script>
<script type="text/javascript">
var editor = new UE.ui.Editor();
editor.render("product_content");
</script>
</head>
<body>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">编辑产品</a></li>
        </ul>
    </div>
    <?php
    $id=$_REQUEST["id"];
    $row=$db->query_list_id("select * from product where product_id=$id");
    ?>
    <div class="formbody">
        <div class="formtitle">
            <span>信息</span>
            <input type="hidden" name="product_id" value="<?=$row['product_id'] ?>" />
            <input type="hidden" name="product_level" value="<?=$_REQUEST['level']?>" />
        </div>
        <ul class="forminfo">
            <li>
                <label>产品：</label>
                <input type="text" name="product_title" id="product_title" class="dfinput" value="<?=$row['product_title']?>"  />
                <i>*必须填写</i>
            </li>
            <li>
                <label>品牌LOGO：</label>
                <input type="file" name="product_logo" id="product_logo" onchange="preview(this,'preview_product_logo')"  />
                <i>*<?=$logo_width ?>*<?=$logo_height ?></i><br />
                <img src="../../<?=$row['product_logo']?>" id="product_logo_show" width="<?=$logo_width ?>px" height="<?=$logo_height ?>px"  />
                <input type="hidden" name="product_logos" id="product_logos" value="<?=$row['product_logo']?>" />
                <div id="preview_product_logo">预览区</div>
            </li>
            <li>
                <label>产品图片：</label>
                <input type="file" name="product_image" id="product_image" onchange="preview(this,'preview_product')" />
                <i>*<?=$image_width ?>*<?=$image_height ?></i><br />
                <img src="../../<?=$row['product_image']?>" id="product_image_show" width="<?=$image_width ?>px" height="<?=$image_height ?>px"  />
                <input type="hidden" name="product_images" id="product_images" value="<?=$row['product_image']?>" />
                <div id="preview_product">预览区</div>
            </li>
            <li>
                <label>工厂批发价：</label>
                <input type="text" name="product_price" id="product_price" class="dfinput" value="<?=$row['product_price']?>" />
            </li>
            <li>
                <label>限时价：</label>
                <input type="text" name="product_sell" id="product_sell" class="dfinput" value="<?=$row['product_sell']?>" />
            </li>
<!--            <li>-->
<!--                <label>商品描述：</label>-->
<!--                <input type="text" name="product_content" id="product_content" class="dfinput" value="--><?//=$row['product_content']?><!--" />-->
<!--            </li>-->
<!--            <li>-->
<!--                <label>开始时间：</label>-->
<!--                <input type="text" name="product_time" id="product_time" class="dfinput"-->
<!--                       style="width:120px" value="--><?//=date("Y-m-d H:m",strtotime($row['product_time']))?><!--"-->
<!--                       class="Wdate"  onFocus="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm'})"/>-->
<!--                <i>*如果为空默认为当前时间</i>-->
<!--            </li>-->
            <li>
                <label>活动时间：</label>
                <input type="text" name="product_end" id="product_end" class="dfinput"
                       style="width:120px" value="<?=date("Y-m-d H",strtotime($row['product_end']))?>"
                       class="Wdate"  onFocus="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH'})"/>
                <i>*如果为空默认为当前时间</i>
            </li>
            <li>
                <label>是否置顶：</label>
                <select name="product_sort" id="product_sort" class="dfinput">
                   <option  value="0" <?=$row['product_sort']==0?"selected='selected'":""?>>否</option>
                   <option  value="1" <?=$row['product_sort']==1?"selected='selected'":""?>>是</option>
                </select>
            </li>  
            <li>
                <label>是否推荐到首页：</label>
                <select name="product_show" id="product_show" class="dfinput">
                    <option  value="0" <?=$row['product_show']==0?"selected='selected'":""?>>否</option>
                    <option  value="1" <?=$row['product_show']==1?"selected='selected'":""?>>是</option>
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
