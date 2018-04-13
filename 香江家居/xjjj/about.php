<?php require_once 'config/conn.php'; ?>
<!DOCTYPE html>
<html lang="en" class=" en"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php require_once 'include/seo.php'; ?>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="HfeUOYGVKhN8gGKzqrcZ0uW3OePYoIftHq3ZCEyh">
    <script type="text/javascript" async="" src="./js/vds.js"></script>
    <script src="./js/hm.js"></script>
    <script src="./js/push.js"></script>
    <link href="./css/base.css" rel="stylesheet" type="text/css">
    <link href="./css/ticket.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="./js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <![endif]-->
    <!--[if gte IE 9]>
    <script src="./js/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
    <![endif]-->
    <script src="./js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="./js/jquery.lazyload.min.js" type="text/javascript"></script>
    <script src="./js/jb.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./css/repair.css" />
    <script type="text/javascript" async="" src="./js/repair.js"></script>
    <link href="./css/popup/Share.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container" style="background-color:<?=$color_product['color_content']?>">
    <?php require_once 'include/banner.php'; ?>
    <div class="t_main">
        <div class="t_con">
            <!-- 产品展示 -->
            <div class="work_hx" id="J_Eact2">
                <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');">关于我们</div>
                <div class="repair-about">
                    <?=$company_row["company_about"]?>
                </div>
            </div>
            <!-- 产品展示 -->
            <!-- 逛展指南 -->
            <!-- 服务保障 -->
            <!-- 分会场 -->
            <?php require_once 'include/service.php'; ?>
            <!-- 分会场 -->
            <!-- 服务保障 -->
            <!-- 逛展指南 -->
            <!--底部辐条-->
            <?php require_once 'include/ad.php'; ?>
            <!--底部辐条-->
        </div>
    </div>
    <!--侧栏-->
    <?php require_once 'include/footer.php'; ?>
    <!--侧栏-->
    <!--弹窗-->
    <?php require_once 'include/popup.php'; ?>
    <!--弹窗-->
    <!-- 底部开始 -->
    <?php require_once 'include/copyright.php'; ?>
    <!-- 底部结束--></div>

<script type="text/javascript">
    $(document).ready(function() {
        // 底导航
        var windowheight=$(window).height();
        $(window).scroll(function(event) {
            //每次都要获取被浏览器卷去的高
            var myTop = $(window).scrollTop();
            //console.log(myTop);
            var myTop = parseFloat($(window).scrollTop());
            //做判断是为了被卷去的高度大于浏览器的高度时火箭显示
            if(myTop > 500){
                $('.get_tic').show();
                var mark = $('.gain').css('display');
                if (mark != 'block') {
                    $("#J_BotBar .get_in").show();
                    $("#J_BotBar").css('width','100%');
                }
            }else{
                $('.get_tic,.gain').hide()
            }
        });

        $("#J_BotBarClose").on("click", function() {
            botBarCloseFlag = true;
            $("#J_BotBar .get_in").hide();
            $("#J_BotBar").animate({width:"0"});
            $(".gain").stop().animate({width:"152px"}).css('display','block');
        });
    });
</script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>