<?php require_once 'config/conn.php';?>
<!DOCTYPE html>
<html class="pixel-ratio-1"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php require_once 'include/seo.php'; ?>
    <meta name="jbpro1" content="ci_csrf_token">
    <meta name="jbpro2" content="">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script src="./js/push.js"></script><script type="text/javascript" async="" src="./js/toutiao-track-log.js"></script>
    <script type="text/javascript" async="" src="./js/vds.js"></script>
    <script src="./js/hm.js"></script><script type="text/javascript">var baseUrl = "/",cityCode = "sy",local = 0;</script>
    <script type="text/javascript">var codeList = ["quanguo","sh","bj","gz","cq","tj","hz","sz","wx","ks","wh","cs","nc","zz","qd","sy"],nameList = ["\u5168\u56fd","\u4e0a\u6d77","\u5317\u4eac","\u5e7f\u5dde","\u91cd\u5e86","\u5929\u6d25","\u676d\u5dde","\u82cf\u5dde","\u65e0\u9521","\u6606\u5c71","\u6b66\u6c49","\u957f\u6c99","\u5357\u660c","\u90d1\u5dde","\u9752\u5c9b","\u6c88\u9633"];</script>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="./css/sm.min.css">
    <link rel="stylesheet" href="./css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="./css/base.css">
    <link rel="stylesheet" type="text/css" href="./css/iSlider.min.css">
    <link href="./css/ticket2017-06.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
    <script type="text/javascript">var _vds = _vds || [];window._vds = _vds;(function(){_vds.push(['setAccountId', '97f5cbef69849241']);(function() {var vds = document.createElement('script');vds.type='text/javascript';vds.async = true;vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(vds, s);})();})();</script>
    <script type="text/javascript">
    </script>
    <link rel="stylesheet" href="./css/repair.css">
    <script type="text/javascript" async="" src="./js/repair.js"></script>
    <script src="./js/jquery.min.js"></script>
<!--    <script type="text/javascript" src="./js/base.js"></script>-->
</head>
<body scroll="no">
<div class="page-group" style="background:#d70c18">
    <div class="page page-current repair-page" style="background: <?=$color_product["color_content"]?>">
        <header class="bar bar-nav">
            <script>
                function backindex(){
                    history.go(-1);
//                    location.href="index.html";
                }
            </script>
            <button class="button button-link button-nav pull-left" onclick="backindex()">
                <span class="icon icon-left"></span>
            </button>
            <?php $menu_row=$db->query_list_id("select menu_title from menu where menu_id=$tdhid"); ?>
            <h1 class="title"><?=$menu_row["menu_title"]?></h1>
        </header>
        <div class="content ticket-content native-scroll">
            <!-- Banner -->
            <?php require_once 'include/banner.php'; ?>
            <div class="main-wap" style='margin-top:10px;'>
                <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                    产品展示
                </div>
                <!-- 产品展示 -->
                <div class="activity" style="margin:0 0.5rem;">
                    <style>
                        .activity-list li{
                            background: #fff;
                            width:48%;
                        }
                    </style>
                    <ul class="activity-list clearfix">
                        <?php
                        $product_rows=$db->query_lists("select * from product where product_level=$tdhid order by product_sort desc,product_id");
                        foreach ($product_rows as $k=>$product_row)
                        {
                            ?>
                            <li <?=$k%2==0?"style='margin-left:0;'":""?> >
                                <a href="javascript:void(0);" class="open-popup activity_click" data-id="0" data-popup=".rule">
                                <div class="repair-product-logo">
                                    <img src="../<?=$product_row["product_logo"]?>" class="repair-product-logo-d">
                                </div>
                                <div class="repair-product-image">
                                    <img src="../<?=$product_row["product_image"]?>" class="repair-product-image-d">
                                </div>
                                <div class="clear"></div>
                                <div class="repair-product-box">
                                    <div class="repair-product-seat"></div>
                                    <div class="repair-hidden color-black"><?=$product_row["product_title"]?></div>
                                    <div class="repair-hidden repair-product-price color-black">工厂批发价：<?=$product_row["product_price"]?></div>
                                    <div class="repair-hidden color-red">限时价：<b><?=$product_row["product_sell"]?></b>&nbsp;</div>
                                    <div class="repair-hidden color-red" id="product_time_<?=$product_row["product_id"]?>">
<!--                                        <span class="repair-product-span" style="color:red;">倒计时：</span>-->
                                        <span class="repair-product-span font-weight" style="color:red;" id="day_show_<?=$product_row["product_id"]?>"></span>
                                        <span class="repair-product-span font-weight" style="color:red;" id="hour_show_<?=$product_row["product_id"]?>"></span>
                                        <span class="repair-product-span font-weight" style="color:red;" id="minute_show_<?=$product_row["product_id"]?>"></span>
                                        <span class="repair-product-span font-weight" style="color:red;" type="text" id="second_show_<?=$product_row["product_id"]?>"></span>
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            show_time_<?=$product_row["product_id"]?>();
                                        });

                                        function show_time_<?=$product_row["product_id"]?>(){
                                            var time_start = new Date().getTime(); //设定当前时间

                                            var time_end =  new Date("<?=date("Y/m/d H:i:s",strtotime($product_row["product_end"]))?>").getTime(); //设定目标时间
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
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- 服务保障 -->
            <?php require_once 'include/service.php'; ?>
            <!-- 分会场 -->
            <?php
            $branch_menu_row=$db->query_list_id("select menu_title,menu_id from menu where menu_id=5 and menu_show=1");
            if($branch_menu_row)
            {
            ?>
                <div class="hot-pic repair-hot-pic">
                    <div class="tit"
                         style="color:<?= $color_font["color_content"] ?>;background: url('../<?= $tit_background['image_image'] ?>');background-size: 100%;">
                        分会场
                    </div>
                    <div class="more-act" style="margin-top：1.17rem">
                        <div class="content-padded grid-demo">
                            <div class="row" style="margin-left: 0px;">
                                <ul class="more-act-top clearfix">
                                    <?php $main_branch_row = $db->query_list_id("select image_image from image where image_id=11"); ?>
                                    <li style="margin-left:0">
                                        <a href="index.html">
                                            <img src="../<?= $main_branch_row["image_image"] ?>" style="height:12rem;">
                                        </a>
                                    </li>
                                    <li>
                                        <?php
                                        $branch_rows = $db->query_lists("select menu_wap_image,menu_id from menu where menu_level=3 and menu_show=1 and menu_id!=$tdhid order by menu_sort asc,menu_id asc limit 0,2");
                                        foreach ($branch_rows

                                        as $k => $branch_row)
                                        {
                                        ?>
                                        <div class="li-top" <?= $k == 0 ? "style='margin-top:0;'" : "" ?>">
                                        <a href="product-<?= $branch_row['menu_id'] ?>.html">
                                            <img src="<?= $branch_row['menu_wap_image'] . "?imageView2/2/w/" . $menu_wap_width . "/h/" . $menu_wap_height ?>">
                                        </a>
                            </div>
                            <?php
                            }
                            ?>
                            </li>

                            </ul>
                            <ul class="more-act-bottom clearfix" style="margin-top:.41rem;">
                                <?php
                                if ($branch_rows) {
                                    $ids = "";
                                    foreach ($branch_rows as $k => $branch_row) {
                                        if ($k + 1 == count($branch_rows)) {
                                            $ids .= $branch_row['menu_id'];
                                        } else {
                                            $ids .= $branch_row['menu_id'] . ",";
                                        }
                                    }
                                    $branch_other_rows = $db->query_lists("select menu_wap_image,menu_id from menu where menu_level=3 and menu_show=1 and menu_id!=$tdhid and menu_id not in (" . $ids . ") order by menu_sort asc,menu_id asc");
                                    foreach ($branch_other_rows as $k => $branch_other_row) {
                                        ?>
                                        <li <?= $k % 2 == 0 ? "style='margin-left:0'" : "" ?>>
                                            <a href="product-<?= $branch_other_row['menu_id'] ?>.html">
                                                <img src="<?= $branch_other_row['menu_wap_image'] . "?imageView2/2/w/" . $menu_wap_width . "/h/" . $menu_wap_height ?>">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <!-- 分会场 -->
            </div>
        </div>
    </div>
<!-- 弹窗 -->
<?php require_once 'include/popup.php'; ?>
<!-- QQ -->
<?php require_once 'include/qq.php'; ?>
<script type="text/javascript" src="./js/zepto.min.js" charset="utf-8"></script>
<script type="text/javascript">$.config = {router: false}</script>
<script type="text/javascript" src="./js/sm.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/sm-extend.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/base.js"></script>
<script type="text/javascript" src="./js/iSlider.min.js"></script>
<script type="text/javascript" src="./js/iSlider.plugin.dot.min.js"></script>
<script src="./js/expo.js" rel="stylesheet" type="text/javascript"></script>
<img src="./wapstat.php" width="0" height="0">
<script type="text/javascript">
    $(function(){
        $('.activity_click').click(function(){
            var title = $(this).attr('data-title');
            var content = $(this).attr('data-content');
            $('.activity-rule .rule-title').html(title);
            $('.activity-rule .rule-list div').html(content);
        });

    });

</script>
<script type="text/javascript">
    $(document).on("click", "#J_reserve", function() {
        var _this = $(this);
        var id = _this.attr('data-id');
        base.openReserve('brand', id, function() {

        });
    })
</script>
<script type="text/javascript">
    var scroller = $("#navScroller");
    $(document).ready(function() {
        $(".root").css("opacity", .5);

        $(".nav-li .col-25").click(function(event) {
            var key = $(this).attr("data-id");

            $(".rank-list").find(".tbd-" + key).removeClass("hide").siblings("tbody").addClass("hide");
            $(this).addClass("active").siblings().removeClass("active");

            scroller.scrollLeft(scroller.find(".active").position().left + scroller.scrollLeft() - scroller.find(".active").offset().width);
            $($(".nav-in-li li")[key]).addClass("active").siblings().removeClass("active");
        });

        $(".nav-in-li li").click(function(event) {
            var key = $(this).attr("data-id");

            $(".rank-list").find(".tbd-" + key).removeClass("hide").siblings("tbody").addClass("hide");
            $(this).addClass("active").siblings().removeClass("active");

            $($(".nav-li .col-25")[key]).addClass("active").siblings().removeClass("active");

            setTimeout(function() {
                scroller.scrollLeft(scroller.find(".active").position().left + scroller.scrollLeft() - scroller.find(".active").offset().width);
            }, 100);
        });

        $(".nav-li").on("scrollLeft",function(){
            $(".nav-li").scrollLeft();
        });
    });

    function setNavWidth() {
        var col = $(".nav-li .col-25");
        var navWidth = 20;
        for (var i = 0; i < col.length; i ++) {
            navWidth += col[i].offsetWidth;
        }

        $(".nav-li .row").width(navWidth);
    }

</script>
<!-- 合作品牌tab切换 -->
<script type="text/javascript">
    // 领取优惠券
    $(document).on("click", ".coupon_btn", function() {
        var _this = $(this);

        if (_this.hasClass("grey")) return false;

        var couponId = _this.attr("data-id");

        base.openReserve('coupon',couponId, function() {
            _this.addClass("grey").html("<div class=\"sale-pink\">已领取</a>");
            _this.parents().find('.youhui-r').addClass('youhui-r-2');
            _this.addClass('ling-btn-2');
        });
    });
</script>
</body>
</html>