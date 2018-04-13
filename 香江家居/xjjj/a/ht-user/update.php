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
    <title>用户编辑</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/back.js"></script>
</head>
<body>
<?php
	if(!empty($_REQUEST['id'])){ 
		$user_id=$_REQUEST['id'];
		$sql = "select * from user where user_id ='".$user_id."'";
	    $row =$db->query_list_id($sql);
	}
?>
<form action="updatedb.php" method="post">
	<input type="hidden" name="user_id" value="<?=$row['user_id']?>" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">用户管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>用户信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>用户名：</label>
		<input type="text" name="user_name" id="TextUserName"
                       value="<?=$row['user_name'] ?>" class="dfinput" />
                <i>
                *必须填写
                </i>
            </li>
            <li>
                <label>密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
		        <input type="text" name="user_password" id="TextPwd"  class="dfinput" />
                <i>*如果为空，默认为原密码</i>
            </li>
            <li>
                <label>权&nbsp;&nbsp;&nbsp;&nbsp;限：</label>
                <select name="user_power" id="DropDownList1" class="dfinput">
                    <?php
                    if($row['user_power']==1)
                    {
                        $power_rows = $db->query_lists("select power_id,power_name from power");
                    }
                    else
                    {
                        $power_rows = $db->query_lists("select power_id,power_name from power where power_id>1");
                    }
                    foreach ($power_rows as $power_row)
                    {
                        $power_id= $power_row['power_id'];
                        $power_name = $power_row['power_name'];
                        ?>
                        <option value="<?=$power_id ?>" <?=$power_id==$row['user_power']?"selected":"" ?>><?=$power_name ?></option>
                    <?php
                    }
                    ?>
                </select>
            </li>
            <li>
                <label>&nbsp;</label>
		        <input type="submit" name="btnEdit" id="btnEdit" value="确认保存" class="btn" >
                <input type="button" name="btnSearch" id="btnSearch" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
