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
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
    <link rel="stylesheet" href="./css/repair.css" />
    <script type="text/javascript" async="" src="./js/repair.js"></script>
    <link href="./css/popup/Share.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container" style="background: <?=$color_product["color_content"]?>">
    <?php require_once 'include/banner.php'; ?>
    <div class="t_main">
        <div class="t_con">
            <!-- 产品展示 -->
            <?php
                $product_menu_id=$tdhid;
                ?>
                <div class="work_hx" id="J_Eact2">
                    <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');">产品展示</div>
                    <ul class="repair-product-pic-li clearfix">
                        <?php
                        $product_rows=$db->query_lists("select * from product where product_level=$product_menu_id order by product_sort desc,product_id desc");
                        foreach ($product_rows as $product_row)
                        {
                            ?>
                            <li>
                                <a href="javascript:void(0);"  id="ClickMe" onclick="showpopup()">
                                    <div class="repair-product-div">
                                        <div class="repair-product-logo">
                                            <img src="<?=$product_row["product_logo"]?>" class="repair-product-logo-d">
                                        </div>
                                        <div class="repair-product-image">
                                            <img src="<?=$product_row["product_image"]?>" class="repair-product-image-d">
                                        </div>
                                        <div class="clear"></div>
                                        <div class="repair-product-box">
                                            <!--                                            <div class="repair-product-seat"></div>-->
                                            <div class="repair-hidden color-black" style="font-size: 16px;"><?=$product_row["product_title"]?></div>
                                            <div class="repair-hidden repair-product-price color-black">工厂批发价：<?=$product_row["product_price"]?></div>
                                            <div style="font-size: 15px;">
                                                <div class="repair-hidden color-red" style="float:left;">限时价：<b><?=$product_row["product_sell"]?></b>&nbsp;</div>
                                                <div class="repair-hidden color-red" style="float:right;" id="product_time_<?=$product_row["product_id"]?>">
                                                    <span class="repair-product-span" style="color:red;">倒计时：</span>
                                                    <span class="repair-product-span font-weight" style="color:red;" id="day_show_<?=$product_row["product_id"]?>"></span>
                                                    <span class="repair-product-span font-weight" style="color:red;" id="hour_show_<?=$product_row["product_id"]?>"></span>
                                                    <span class="repair-product-span font-weight" style="color:red;" id="minute_show_<?=$product_row["product_id"]?>"></span>
                                                    <span class="repair-product-span font-weight" style="color:red;" type="text" id="second_show_<?=$product_row["product_id"]?>"></span>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <script type="text/javascript">
                                                $(function(){
                                                    show_time_<?=$product_row["product_id"]?>();
                                                });

                                                function show_time_<?=$product_row["product_id"]?>(){
                                                    var time_start = new Date().getTime(); //设定当前时间

                                                    var time_end =  new Date('<?=$product_row["product_end"]?>').getTime(); //设定目标时间
                                                    // 计算时间差
                                                    var time_distance = time_end - time_start;
                                                    /*判断活动是否结束*/
                                                    if(time_distance<0){

                                                        int_day=0;
                                                        int_hour=0;
                                                        int_minute=0;
                                                        int_second=0;
                                                        $("#product_time_<?=$product_row["product_id"]?>").html("<b>活动已结束</b>");
                                                    }else{
                                                        // 天
                                                        var int_day = Math.floor(time_distance/86400000)
                                                        time_distance -= int_day * 86400000;
                                                        // 时
                                                        var int_hour = Math.floor(time_distance/3600000)
                                                        time_distance -= int_hour * 3600000;
                                                        // 分
                                                        var int_minute = Math.floor(time_distance/60000)
                                                        time_distance -= int_minute * 60000;
                                                        // 秒
                                                        var int_second = Math.floor(time_distance/1000)
                                                        // 时分秒为单数时、前面加零
                                                        if(int_day < 10){
                                                            int_day = "0" + int_day;
                                                        }
                                                        if(int_hour < 10){
                                                            int_hour = "0" + int_hour;
                                                        }
                                                        if(int_minute < 10){
                                                            int_minute = "0" + int_minute;
                                                        }
                                                        if(int_second < 10){
                                                            int_second = "0" + int_second;
                                                        }
                                                    }
                                                    // 显示时间
                                                    $("#day_show_<?=$product_row["product_id"]?>").html(int_day+"天");
                                                    $("#hour_show_<?=$product_row["product_id"]?>").html(int_hour+"时");
                                                    $("#minute_show_<?=$product_row["product_id"]?>").html(int_minute+"分");
                                                    $("#second_show_<?=$product_row["product_id"]?>").html(int_second+"秒");
                                                    // 设置定时器
                                                    setTimeout("show_time_<?=$product_row["product_id"]?>()",1000);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
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