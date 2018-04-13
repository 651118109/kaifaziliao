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
    <title>后台导航管理</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script>
	function fh()
	{
		location.href="javascript:history.go(-1)";
	}
    </script>
</head>
<body>
<?php
	if(!empty($_REQUEST['id']))
	{ 
        $backstage_id=$_REQUEST['id'];
        $sql = "select * from backstage where backstage_id='$backstage_id'";
	    $row =$db->query_list_id($sql);
	}
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="backstage_id" value="<?=$_REQUEST['id']?>"
           id="backstage_id" class="dfinput" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">后台导航管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>后台导航信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>标题：</label>
                <input type="text" name="backstage_title" id="backstage_title" 
                       class="dfinput" value="<?=$row['backstage_title']?>" />
                <i>*必须填写</i>
            </li>
            <?php 
            if($row['backstage_level']!=0)
            {
            	?>
            	<li>
                    <label>跳转地址：</label>
                    <input type="text" name="backstage_link" id="backstage_link" 
                     class="dfinput" value="<?=$row['backstage_link']?>"
                     style=" color:#666" readonly />
                    <i>*不可更改</i>
            	</li>
            	<?php 
            }
            ?>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnEdit" 
                       value="确认保存" class="btn"  /> 
                <input type="button" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
