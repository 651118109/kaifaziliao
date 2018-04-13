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
    <title>SEO管理</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
	if(!empty($_GET['id'])){ 
		$menu_id=$_GET['id'];
		$sql = "select * from menu where menu_id='$menu_id'";
	    $row =$db->query_list_id($sql);
	}
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="menu_id" value="<?=$_GET['id']?>" 
       id="menu_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">SEO管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>SEO信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>对应页面：</label>
                <span><?=$row['menu_title']?></span>
            </li>
            <li>
                <label>页面名称：</label>
                <input type="text" name="title" id="title" value="<?=$row['title']?>"  class="dfinput" style=" width: 700px;" />
            </li>
            <li>
                <label>网页关键字：</label>
                <textarea class="textarea" name="keywords"><?=$row['keywords']?></textarea>
                <i>*如果设置多个关键字，请用“，”分割</i>
            </li> 
            <li>
                <label>网页描述：</label><br/>
                <textarea class="textarea" name="description"><?=$row['description']?></textarea>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnEdit"
                       value="确认保存" class="btn" > 
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
