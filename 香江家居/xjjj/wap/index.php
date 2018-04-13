<?php require_once 'config/conn.php';?>
<!DOCTYPE html>
<!-- saved from url=(0030)http://m.51jiabo.com/sy/ticket -->
<html class="pixel-ratio-1">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php require_once 'include/seo.php'; ?>
    <meta name="jbpro1" content="ci_csrf_token">
    <meta name="jbpro2" content="">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script src="./js/push.js"></script>
    <script type="text/javascript" async="" src="./js/toutiao-track-log.js"></script>
    <script type="text/javascript" async="" src="./js/vds.js"></script>
    <script src="./js/hm.js"></script>
    <script type="text/javascript">var baseUrl = "/",cityCode = "sy",local = 0;</script>
    <script type="text/javascript">var codeList = ["quanguo","sh","bj","gz","cq","tj","hz","sz","wx","ks","wh","cs","nc","zz","qd","sy"],nameList = ["\u5168\u56fd","\u4e0a\u6d77","\u5317\u4eac","\u5e7f\u5dde","\u91cd\u5e86","\u5929\u6d25","\u676d\u5dde","\u82cf\u5dde","\u65e0\u9521","\u6606\u5c71","\u6b66\u6c49","\u957f\u6c99","\u5357\u660c","\u90d1\u5dde","\u9752\u5c9b","\u6c88\u9633"];</script>
<!--    <link rel="shortcut icon" href="../favicon.ico">-->
    <link rel="stylesheet" href="./css/sm.min.css">
    <link rel="stylesheet" href="./css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="./css/iSlider.min.css">
    <link rel="stylesheet" type="text/css" href="./css/base.css">
    <!--        <link rel="shortcut icon" href="--><!--" />-->

    <link href="./css/ticket2017-06.css" rel="stylesheet" type="text/css" media="screen">
<!--    <script type="text/javascript">var _vds = _vds || [];window._vds = _vds;(function(){_vds.push(['setAccountId', '97f5cbef69849241']);(function() {var vds = document.createElement('script');vds.type='text/javascript';vds.async = true;vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(vds, s);})();})();</script>-->
    <script type="text/javascript">
        /*$(function(){
            alert();
            location.reload();
        })*/
        (function(root) {
            root._tt_config = true;
            var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;
            ta.src = document.location.protocol + '//' + 's3.pstatp.com/bytecom/resource/track_log/src/toutiao-track-log.js';
            ta.onerror = function () {
                var request = new XMLHttpRequest();
                var web_url = window.encodeURIComponent(window.location.href);
                var js_url  = ta.src;
                var url = '//ad.toutiao.com/link_monitor/cdn_failed?web_url=' + web_url + '&js_url=' + js_url + '&convert_id=59772517910';
                request.open('GET', url, true);
                request.send(null);
            }
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ta, s);
        })(window);

        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https'){
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else{
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
    <link rel="stylesheet" href="./css/repair.css">
    <script type="text/javascript" async="" src="./js/repair.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/zepto.min.js" charset="utf-8"></script>
    <script type="text/javascript">$.config = {router: false}</script>
    <script type="text/javascript" src="./js/sm.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/sm-extend.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/base.js"></script>
    <script type="text/javascript" src="./js/iSlider.min.js"></script>
    <script type="text/javascript" src="./js/iSlider.plugin.dot.min.js"></script>
    <script src="./js/expo.js" rel="stylesheet" type="text/javascript"></script>
</head>
<body>
<div class="page-group" style="background:#d70c18;">
    <?php $color_index=$db->query_list_id("select color_content from color where color_id=3"); ?>
    <div class="page page-current" style="background:<?=$color_index["color_content"]?>;">
        <header class="bar bar-nav">
            <img class="ticket-logo" src="../<?=$company_row["company_logo"]?>">
<!--            <h1 class="title">--><?//=$company_row["company_name"]?><!--</h1>-->

        </header>
        <div class="content ticket-content native-scroll">
            <!-- Banner -->
            <?php require_once 'include/banner.php'; ?>
            <div class="main-wap" style='margin-top:0px;'>
				<!-- 产品展示 -->
                <script language="javascript">
                    function Tab(num)
                    {
                        var i;
                        for(i=1;i<=5;i++)
                        {
                            if(i==num)
                            {
                                $("#d_"+i).css("display","block");
                                $("#product_menu_"+i).attr("class", "col-25 active");
                                $("#product_menu_"+i).css("border-bottom", "#ce012e solid .08rem");
                            }
                            else
                            {
                                $("#d_"+i).css("display","none");
                                $("#product_menu_"+i).attr("class", "col-25");
                                $("#product_menu_"+i).css("border-bottom", "0");
                            }
                        }
                    }
                </script>
                <?php
                $product_menu_row=$db->query_list_id("select menu_title from menu where menu_id=3 and menu_show=1");
                if($product_menu_row)
                {
                    ?>
                    <div class="cooperate" style="margin-top:1.17rem;">
                        <div class="tit" style="color:<?= $color_font["color_content"] ?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                            <?=$product_menu_row["menu_title"]?>
                        </div>
                        <div class="nav" style="top:2.63rem;">
                            <div class="nav-fo" id="my-nav" style="display: block;"  >
                                <div class="content-padded grid-demo">
                                    <div class="nav-li content-inner" style="overflow:hidden;">
                                        <div class="row" style="width:auto;height:2.34rem;background: #d3d7d4;">
                                            <?php
                                            $menu_rows=$db->query_lists("select menu_title,menu_id from menu where menu_level=3 and menu_show=1 order by menu_sort asc,menu_id asc limit 0,5");
                                            $tdhid=empty($tdhid)?$menu_rows[0]["menu_id"]:$tdhid;
                                            foreach ($menu_rows as $k=>$menu_row)
                                            {
                                                ?>
                                                <div class="col-25 <?=$tdhid==$menu_row["menu_id"]?"active":""?>" style="height:2.34rem;line-height: 2.34rem;<?=$k==0?"border-bottom: #ce012e solid .08rem;":""?>" id="product_menu_<?=$k+1?>" style="height:2.34rem;line-height: 2.34rem;">
                                                    <a href="javascript:void(0)" onclick="Tab(<?=$k+1?>)" style="color:#666;">
                                                        <?=$menu_row["menu_title"]?>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nav-con" style="margin-top:.64rem;">
                            <?php
                            foreach ($menu_rows as $k => $menu_row) {
                                ?>
                                <a name="<?=$menu_row["menu_id"]?>"></a>
                                <ul class="nav-con-in clearfix" <?=$k==0?"style='display:block;'":""?>  id="d_<?=$k+1?>">
                                    <?php
                                    $product_level = $menu_row["menu_id"];
                                    $product_rows = $db->query_lists("select * from product where product_level=$product_level and product_show=1 order by product_sort desc,product_id asc limit 0,6");
                                    foreach ($product_rows as $k => $product_row) {
                                        ?>
                                        <li <?= $k % 2 == 0 ? "" : "style='float:right;'" ?>>
                                            <a href="javascript:void(0);" class="open-popup activity_click" data-id="0" data-popup=".rule">
                                                <div style="background:#fff;height:4rem;">
                                                    <div class="repair-product-logo">
                                                        <img src="../<?= $product_row["product_logo"] ?>"
                                                             class="repair-product-logo-d">
                                                    </div>
                                                    <div class="repair-product-image">
                                                        <img src="../<?= $product_row["product_image"] ?>"
                                                             class="repair-product-image-d">
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="repair-product-box">
                                                    <div class="repair-product-seat"></div>
                                                    <div class="repair-hidden color-black"><?= $product_row["product_title"] ?></div>
                                                    <div class="repair-hidden color-black">
                                                        工厂批发价：<?= $product_row["product_price"] ?></div>
                                                    <div class="repair-hidden color-red">
                                                        限时价：<b><?= $product_row["product_sell"] ?></b>&nbsp;
                                                    </div>
                                                    <div class="repair-hidden color-red"
                                                         id="product_time_<?= $product_row["product_id"] ?>">
                                                        <!--                                                    <span class="repair-product-span" style="color:red;">倒计时：</span>-->
                                                        <span class="repair-product-span font-weight" style="color:red;"
                                                              id="day_show_<?= $product_row["product_id"] ?>"></span>
                                                        <span class="repair-product-span font-weight" style="color:red;"
                                                              id="hour_show_<?= $product_row["product_id"] ?>"></span>
                                                        <span class="repair-product-span font-weight" style="color:red;"
                                                              id="minute_show_<?= $product_row["product_id"] ?>"></span>
                                                        <span class="repair-product-span font-weight" style="color:red;"
                                                              id="second_show_<?= $product_row["product_id"] ?>"></span>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(function () {
                                                            show_time_<?=$product_row["product_id"]?>();
                                                        });

                                                        function show_time_<?=$product_row["product_id"]?>() {
                                                            var time_start = new Date().getTime(); //设定当前时间

                                                            var time_end =  new Date("<?=date("Y/m/d H:i:s",strtotime($product_row["product_end"]))?>").getTime(); //设定目标时间
                                                            // 计算时间差
                                                            var time_distance = time_end - time_start;
                                                            /*判断活动是否结束*/
                                                            if (time_distance < 0) {

                                                                int_day = 0;
                                                                int_hour = 0;
                                                                int_minute = 0;
                                                                int_second = 0;
                                                                $("#product_time_<?=$product_row["product_id"]?>").html("<b>活动已结束</b>");
                                                            } else {
                                                                // 天
                                                                var int_day = Math.floor(time_distance / 86400000)
                                                                time_distance -= int_day * 86400000;
                                                                // 时
                                                                var int_hour = Math.floor(time_distance / 3600000)
                                                                time_distance -= int_hour * 3600000;
                                                                // 分
                                                                var int_minute = Math.floor(time_distance / 60000)
                                                                time_distance -= int_minute * 60000;
                                                                // 秒
                                                                var int_second = Math.floor(time_distance / 1000)
                                                                // 时分秒为单数时、前面加零
                                                                if (int_day < 10) {
                                                                    int_day = "0" + int_day;
                                                                }
                                                                if (int_hour < 10) {
                                                                    int_hour = "0" + int_hour;
                                                                }
                                                                if (int_minute < 10) {
                                                                    int_minute = "0" + int_minute;
                                                                }
                                                                if (int_second < 10) {
                                                                    int_second = "0" + int_second;
                                                                }
                                                            }
                                                            // 显示时间
                                                            $("#day_show_<?=$product_row["product_id"]?>").html(int_day + "天");
                                                            $("#hour_show_<?=$product_row["product_id"]?>").html(int_hour + "时");
                                                            $("#minute_show_<?=$product_row["product_id"]?>").html(int_minute + "分");
                                                            $("#second_show_<?=$product_row["product_id"]?>").html(int_second + "秒");
                                                            // 设置定时器
                                                            setTimeout("show_time_<?=$product_row["product_id"]?>()", 1000);
                                                        }
                                                    </script>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <a href="product-<?= $product_level ?>.html" style="background: none;color:#fff;">
                                        <li class="more more-2"
                                            style="width:100%;height:30px;background: none;line-height: 30px;background: <?= $color_more["color_content"] ?>;">
                                            查看更多&gt;&gt;
                                        </li>
                                    </a>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- 产品展示 -->

				<!-- 索票input框开始 -->
<!--                <div class="list-block" id="J_TicketForm" style="margin-top: 1.17rem;">-->
<!--                    <ul style="margin:0 0.5rem;">-->
<!--                        <li style="margin-top:0;">-->
<!--                            <div class="item-content">-->
<!--                                <div class="item-inner">-->
<!--                                    <div class="item-input">-->
<!--                                        <input type="text" placeholder="请输入您的姓名" class="txt" name="leaveword_name" id="leaveword_name">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="item-content">-->
<!--                                <div class="item-inner">-->
<!--                                    <div class="item-input">-->
<!--                                        <input type="tel" placeholder="请输入您的手机号码" class="txt" name="leaveword_tel" id="leaveword_tel" maxlength="11">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <div class="ticket-btn repair-ticket-btn" style="margin:0.5rem;">-->
<!--                        <button class="btn" onclick="leaveword()" id="biaoming5">-->
<!--                            <img src="./images/btn-bg.png">-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- 索票input框结束 -->
				
                <!-- 优惠券 -->
                <?php
                $coupon_menu_row=$db->query_list_id("select menu_title from menu where menu_id=2 and menu_show=1");
                if($coupon_menu_row)
                {
                    ?>
                    <div class="coupon">
                        <div class="tit"  style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                            <?=$coupon_menu_row["menu_title"]?>
                        </div>
                        <div class="brand-list">
                            <div class="content-padded grid-demo">
                                <?php
                                $coupon_rows=$db->query_lists("select * from coupon where coupon_show=1 order by coupon_sort desc,coupon_id desc limit 0,5");
                                foreach ($coupon_rows as $coupon_row)
                                {
                                    ?>
                                    <a href="javascript:void(0);" class="open-popup activity_click" data-id="0" data-popup=".rule">
                                        <div style="width:100%;margin:1rem auto;height:5.5rem;background: #fff;color:#666;">
                                            <div style="width:25%;float:left;">
                                                <img src="../<?=$coupon_row["coupon_logo"]?>" style="width:100%;" alt="<?=$coupon_row["coupon_title"]?>">
                                                <div style="width:100%;line-height: 2.5rem;text-align: center;margin-top:-0.3rem;">
                                                    <?=$coupon_row["coupon_title"]?>
                                                </div>
                                            </div>
                                            <div style="width:45%;float:left;text-align: center;">
                                                <div style="color:red;line-height: 2.5rem;font-size: 1.5rem;font-weight: bold;">
                                                    ￥<?=$coupon_row["coupon_price"]?>
                                                </div>
                                                <div style="line-height: 1.5rem;font-size: 0.6rem;">
                                                    <?=$coupon_row["coupon_content"]?>
                                                </div>
                                                <div style="line-height: 1rem;font-size: 0.5rem;">
                                                    <?=date("Y-m-d H:i",strtotime($coupon_row["coupon_time"]))?>-<?=date("H:i",strtotime($coupon_row["coupon_end"]))?>
                                                </div>
                                            </div>
                                            <div style="width:30%;float:left;background: #ef4136;height:100%;color:#fff;text-align: center;font-weight: bold;">
                                                <div style="line-height: 4rem;font-size:0.8rem;">
                                                    立即领取
                                                </div>
                                                <div style="font-size:0.6rem;margin-top:-1.5rem;" id="coupon_time_<?=$coupon_row["coupon_id"]?>">
                                                    <span  id="coupon_day_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                    <span  id="coupon_hour_show_<?=$coupon_row["coupon_id"]?>"></span><br />
                                                    <span  id="coupon_minute_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                    <span  id="coupon_second_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function(){
                                                        show_time_coupon_<?=$coupon_row["coupon_id"]?>();
                                                    });

                                                    function show_time_coupon_<?=$coupon_row["coupon_id"]?>(){
                                                        var time_start = new Date().getTime(); //设定当前时间

                                                        var time_end =  new Date("<?=date("Y/m/d H:i:s",strtotime($coupon_row["coupon_time"]))?>").getTime(); //设定目标时间
                                                        // 计算时间差
                                                        var time_distance = time_end - time_start;
                                                        /*判断活动是否结束*/
                                                        if(time_distance<0)
                                                        {
                                                            int_day=0;
                                                            int_hour=0;
                                                            int_minute=0;
                                                            int_second=0;
                                                            $("#coupon_time_<?=$coupon_row["coupon_id"]?>").html("<b style='line-height:2.25rem;'>活动已结束</b>");
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
                                                        $("#coupon_day_show_<?=$coupon_row["coupon_id"]?>").html(int_day+"天");
                                                        $("#coupon_hour_show_<?=$coupon_row["coupon_id"]?>").html(int_hour+"时");
                                                        $("#coupon_minute_show_<?=$coupon_row["coupon_id"]?>").html(int_minute+"分");
                                                        $("#coupon_second_show_<?=$coupon_row["coupon_id"]?>").html(int_second+"秒");
                                                        // 设置定时器
                                                        setTimeout("show_time_coupon_<?=$coupon_row["coupon_id"]?>()",1000);
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="clear"></div>
                                    <?php
                                }
                                ?>
                                <a href="coupon.html" style="background: none;color:#fff;">
                                    <li class="more more-2"
                                        style="width:100%;height:30px;background: none;line-height: 30px;background: <?= $color_more["color_content"] ?>;">
                                        查看更多&gt;&gt;
                                    </li>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- 优惠券 -->
                <!-- 活动亮点开始 -->
                <?php
                $light_rows=$db->query_lists("select light_title,light_image,light_content from light where light_show=1 order by light_sort asc,light_id asc");
                if($light_rows)
                {
                    ?>
                    <div class="activity" style="margin:0 0.5rem;">
                        <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">活动亮点</div>
                        <ul class="activity-list clearfix">
                            <?php
                            foreach ($light_rows as $k=>$light_row)
                            {
                                ?>
                                <li <?=$k%2==0?"style='margin-left:0;'":""?>>
                                    <a href="javascript:void(0);" class="open-popup activity_click" data-id="0" data-popup=".activity-rule" data-title="<?=$light_row["light_title"]?>" data-content="<?=$light_row["light_content"]?>">
                                        <img src="../<?=$light_row["light_image"]?>" width="100%" style="border-radius: .5rem;">
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                <!-- 活动亮点开始 -->

                

                <!-- 服务保障 -->
                <?php require_once 'include/service.php'; ?>
                <!-- 服务保障 -->

                <!-- 分会场 -->
                <?php
                $branch_menu_row=$db->query_list_id("select menu_title,menu_id from menu where menu_id=5 and menu_show=1");
                if($branch_menu_row)
                {
                    ?>
                    <div class="hot-pic repair-hot-pic">
                        <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                            分会场
                        </div>
                        <div class="hot-pic-in">
                            <div class="content-padded grid-demo">
                                <ul class="hot-pic-li clearfix">
                                    <?php
                                    $branch_rows=$db->query_lists("select menu_wap_image,menu_id from menu where menu_level=3 and menu_show=1 order by menu_sort asc,menu_id asc");
                                    foreach ($branch_rows as $k=>$branch_row)
                                    {
                                        $branch_id=$branch_row["menu_id"]
                                        ?>
                                        <li <?=$k%2==0?"style='margin-left:0;'":""?>>
                                            <a href="product-<?=$branch_id?>.html">
                                                <img src="<?=$branch_row["menu_wap_image"]."?imageView2/2/w/".$menu_wap_width."/h/".$menu_wap_height?>">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if(count($branch_rows)%2==1)
                                    {
                                        $main_row=$db->query_list_id("select menu_wap_image from menu where menu_id=3");
                                        ?>
                                        <li tyle='margin-left:0;'>
                                            <a href="javascript:void(0);" class="open-popup activity_click" data-id="0" data-popup=".rule">
                                                <img src="<?=$main_row["menu_wap_image"]."?imageView2/2/w/".$menu_wap_width."/h/".$menu_wap_height?>">
                                            </a>
                                        </li>
                                        <?php
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

                <!-- 现场热图 -->
                <div class="hot-pic repair-hot-pic">
                    <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                        现场热图
                    </div>
                    <div class="hot-pic-in">
                        <div class="content-padded grid-demo">
                            <ul class="hot-pic-li clearfix">
                                <?php
                                $scene_rows=$db->query_lists("select scene_image from scene order by scene_sort asc,scene_id asc");
                                foreach ($scene_rows as $k=>$scene_row)
                                {
                                    ?>
                                    <li <?=$k%2==0?"style='margin-left:0;'":""?>>
                                        <img src="../<?=$scene_row["scene_image"]?>">
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- 现场热图 -->
                <!-- 交通路线 -->
                <div class="route repair-route" >
                    <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                        交通路线
                    </div>
                    <div class="content-padded">
                        <input type="hidden" id="company_x" value="<?=$company_row['company_x']?>" />
                        <input type="hidden" id="company_y" value="<?=$company_row['company_y']?>" />
                        <div class="repair-map" id="allmap"></div>
                        <script>
                            var map = new BMap.Map("allmap");
                            var localSearch = new BMap.LocalSearch(map);
                            localSearch.enableAutoViewport(); //允许自动调节窗体大小
                            startmap();
                            function startmap()
                            {
                                var x=document.getElementById("company_x").value;
                                var y=document.getElementById("company_y").value;
                                map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
                                map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
                                map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
                                map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
                                map.clearOverlays();//清空原来的标注
                                var point =new BMap.Point(x,y);
                                map.centerAndZoom(point, 16);
                                var marker = new BMap.Marker(point);  // 创建标注，为要查询的地址对应的经纬度
                                map.addOverlay(marker);              // 将标注添加到地图中
                                marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                            }
                        </script>
                        <div class="repair-traffic">
                            <?=$company_row["company_traffic"]?>
                        </div>
                    </div>
                </div>

                <div class="hot-pic repair-hot-pic">
                    <a href="about.html">
                        <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                            关于我们
                        </div>
                    </a>
                </div>
                <div class="hot-line">
                    <a href="tel:<?=$company_row["company_tel"]?>">
                        <h3 style="color:#fff;">联系电话：<?=$company_row["company_tel"]?></h3>
                    </a>
                </div>
                <div class="copy repair-copy">
                    <?=$company_row["company_copyright"]?><br>
                    <?=$company_row["company_record"]?><br>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- 弹窗 -->
<?php require_once 'include/popup.php'; ?>
<!-- QQ -->
<?php require_once 'include/qq.php'; ?>

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

            /* $("#my-nav").css("visibility", "hidden");*/

            /* setTimeout(function() {
                 $("#my-nav").css("visibility", "visible");
             }, 10);*/
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
    $(function() {
        $('.nav-li .row .col-25').click(function(event) {
            var t = $(this).index();
            $('.nav-con .nav-con-in').eq(t).show().siblings().hide();
        });
    });
</script>
<!-- 合作品牌tab切换 -->
<script type="text/javascript">
    $(function() {
        //单击返回按钮时，让页面回到顶部
        $('.free-go').click(function(event) {
            $('.content').scrollTop(0);
        });
    });

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
