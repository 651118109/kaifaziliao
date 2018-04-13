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
            echo "<script>alert('您的登录密码已经过期，请您再次输入');"
        . "location.href=\"../Login.php\";</script>"; 
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=S" />
    <title>Top</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<!--    <script type="text/javascript" src="../js/MessageAlerts.js"></script>-->
    <script type="text/javascript">
        $(function () {
            //顶部导航切换
            $(".nav li a").click(function () {
                $(".nav li a.selected").removeClass("selected")
                $(this).addClass("selected");
            })
        })
    </script>
</head>
<body style="background: url(../images/topbg.gif) repeat-x;">
    <form id="form1" runat="server">
        <div class="topleft">
            <a href="main.aspx" target="_parent">
                <img src="../images/loginlogo.png" title="系统首页" alt="" />
            </a>
        </div>
        <ul class="nav">
            <li>
                <a href="../lx-servervariables/lx-servervariables-list.php"
                   target="rightFrame">
                <img src="../images/ico01.png" width="45" height="45"
                     title="系统首页" alt="" /><h2>系统首页</h2>
            </a></li>
        </ul>

        <div class="topright">
            <ul>
                <li class="user"><span><?php echo $_COOKIE['login'];?></span></li>
                <li style="margin-top:18px;"><a href="../../index.php" target="_blank">网站首页</a></li>
                <li style="margin-top:18px;"><a href="../LoginOut.php" target="_parent">退出</a></li>
            </ul>
        </div>
    </form>
</body>
</html>
