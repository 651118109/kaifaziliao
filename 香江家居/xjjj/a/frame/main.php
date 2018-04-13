<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
else
{
	if(empty($_COOKIE['login'])){
		echo "<script>alert('您的登录密码已经过期，请您再次输入');location.href=\"../Login.php\";</script>"; 
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=S" />
    <meta http-equiv="x-ua-compatible" content="ie=Q" />
    <title>信息管理系统界面</title>
</head>
<frameset rows="88,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset name="MainFrame" cols="188,8,*" frameborder="no" border="0" framespacing="0" id="MainFrame">
    <frame src="left.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="HideBar.php" name="stretchFrame" scrolling="No" noresize="noresize" id="stretchFrame" title="stretchFrame" />
    <frame src="../lx-servervariables/lx-servervariables-list.php" name="rightFrame" id="rightFrame" title="rightFrame" />
  </frameset>
</frameset>
<noframes>
    <body>
    </body>
</noframes>
</html>