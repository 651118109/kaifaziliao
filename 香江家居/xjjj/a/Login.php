<?php
header("Content-Type: text/html;charset=utf-8");
require ("config/conn.php");//引入链接数据库
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=9" />
    <title>后台登陆</title>
    <style type="text/css">

    </style>
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
	<script src="js/login.js" type="text/javascript"></script>
</head>
<body>
<form action="LoginDo.php" id="LoginFrom" method="post">
<div class="bgggg" style="background: url(images/bggg.jpg) center no-repeat;">
    <div class="dl">
    <input type="text" name="user_name" id="user_name" class="dl1" />
    <input type="password" name="user_password" id="user_password" class="dl2" />
    <div style=" margin-top:2px; color:red; margin-left:250px;">
            <span id="TypeName"><span>
    </div>
    <div style=" margin-top:2px; color:red; margin-left:250px;">
            <span id="TypePwd"><span>
    </div>
    <input type="submit" name="btnLoginOn" id="btnLoginOn" value="登陆" class="dl3" >
    <input type="button" name="btnRe" id="btnRe" value="重置" class="dl4" >
    </div>
</div>

</form>
</body>
</html>
