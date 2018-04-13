<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
else
{
    function Cet_FatherMenu($id = 1) {
    $mysqli=mysqli_connect(HOST,USR,PWD,DBNAME);
    global $db;
    global $str;
//查找管理员的权限
$user_power=$_COOKIE['roid'];
$powerrow=$db->query_list_id("select * from power where power_id=$user_power");
$power_content=$powerrow["power_content"];
//$powerarr=  explode(",", $power_content);
if($user_power==1)
{
    $sql = "select * from backstage where "
            . "backstage_level=0 order by backstage_id asc";
}
 else 
{
    $sql = "select * from backstage where backstage_level=0"
            . " and backstage_id in(".$power_content.")";
}
    $result =$db->query_lists($sql);//查询pid的子类的分类

    if($result)
    {//如果有子类
    $str .= ''; 
    foreach ($result as $row) 
    { //循环记录集
    $a=$row['backstage_id'];
    if($user_power==1)
    {
    $sqlget = "select * from backstage where backstage_level=$a order by "
            . "backstage_id asc";
    }
    else
    {
    $sqlget = "select * from backstage where backstage_level=$a and  "
            . "backstage_id in(".$power_content.") order by backstage_id asc";
    }
    $resultget =$db->query_lists($sqlget);

    $str .= "<dd><div class=\"title\"><span>"
    . "<img src=\"../images/leftico01.png\" /></span>"
    .$row['backstage_title'] ."</div>
    <ul class=\"menuson\">";
    foreach ($resultget as $rowget) 
    {
        $str .= "<li>
        <cite></cite>
        <a href='". $rowget['backstage_link'] ."' target=\"rightFrame\">"
        . $rowget['backstage_title'] .
        "</a>
        <i></i>
        </li>";
    }
    $str .= "</ul></dd>";

    } 
    $str .= ''; 
    } 
    return $str; 
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=S" />
    <title>Left</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            //导航切换
            $(".menuson li").click(function () {
                $(".menuson li.active").removeClass("active")
                $(this).addClass("active");
            });

            $('.title').click(function () {
                var $ul = $(this).next('ul');
                $('dd').find('ul').slideUp();
                if ($ul.is(':visible')) {
                    $(this).next('ul').slideUp();
                } else {
                    $(this).next('ul').slideDown();
                }
            });
        })	
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            var height = $(document).height();
            var width = $(document).width();
            $(".leftmenu").css("height", $(window).height() - 40);
        });
    </script>
</head>
<body>
    <form id="form1" runat="server">
    <div class="lefttop">
        <span></span>功能导航
    </div>
    <dl class="leftmenu">
		<?php
			echo Cet_FatherMenu(1);
		?>
    </dl>
    </form>
</body>
</html>
