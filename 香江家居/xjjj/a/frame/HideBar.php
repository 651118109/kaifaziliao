<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
else
{
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>NavigationHide</title>
    <script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
    <meta http-equiv="x-ua-compatible" content="ie=S" />
    <script type="text/javascript">
        $(document).ready(function () {
            var height = $(document).height();
            var width = $(document).width();
            $("#Naheight").css("height", $(window).height() - 40);
        });
    </script>
</head>
<script language="JavaScript" type="text/javascript">
　　    function ChangeVisible() {
            if (parent.document.getElementById('MainFrame').cols != "0,8,*") {
                parent.document.getElementById('MainFrame').cols = "0,8,*";
                document.all.menuSwitch.innerHTML = "<a href='javascript:void(0);' onclick='ChangeVisible();'><img src='../images/sy-btn1.png' width='8' height='30' border='0' alt='点击显示菜单' title='点击显示菜单'></a>";
            }
            else {
                parent.document.getElementById('MainFrame').cols = "188,8,*";
                document.all.menuSwitch.innerHTML = "<a href='javascript:void(0);' onclick='ChangeVisible();'><img src='../images/sy-btn2.png' width='8' height='30' border='0' alt='点击隐藏菜单' title='点击隐藏菜单'></a>";
            }
        }
        function f1() {
            this.style.backgroundColor = '#efefef';
            document.getElementById("menuSwitch").style.display = "none";
        }
        function f2() {
            this.style.backgroundColor = '#D8D6CF';
            document.getElementById("menuSwitch").style.display = "";
        }
</script>

<body style="background-color:#efefef; margin-left:0;" >
    <table id="Naheight" width="8" height="500" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="middle" id="menuSwitch">
                <a href="javascript:void(0);" onclick="ChangeVisible();">
                    <img src="../images/sy-btn2.png" width="8" height="30" border="0" alt="点击隐藏菜单" title="点击隐藏菜单">
                </a>
            </td>
        </tr>
    </table>
</body>
</html>
