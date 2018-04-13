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
<!--    <script type="text/javascript">var baseUrl = "http://www.51jiabo.com/";var baseCityUrl = "http://www.51jiabo.com/sy/"</script>-->
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
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
<div class="container" style="background: <?=$color_index["color_content"]?>">
    <?php require_once 'include/banner.php'; ?>
    <div class="t_main">
        <div class="t_con">
            <!-- 活动亮点开始 -->
            <?php
            $light_rows=$db->query_lists("select light_image,light_content,light_title from light where light_show=1 order by light_sort asc,light_id asc");
            if($light_rows)
            {
                ?>
                <div class="activity" id="J_Eact1">
                    <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');">活动亮点</div>
                </div>
                <ul class="act_li clearfix">
                    <?php
                    $light_li_width=100/count($light_rows);
                    foreach ($light_rows as $light_row)
                    {
                        ?>
                        <li class="five" style="width:<?=$light_li_width?>%">
                            <div class="act_img"><img class="lazy" data-original="<?=$light_row["light_image"]?>" height="240" width="100%" alt="<?=$light_row["light_title"]?>" src="./<?=$light_row["light_image"]?>" style="display: block;"></div>
                            <div class="bottom_div">
                                <p><?=$light_row["light_content"]?></p>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
            <!-- 活动亮点结束 -->
            <!-- 优惠券开始 -->
            <?php
            $coupon_menu_row=$db->query_list_id("select menu_title,menu_id from menu where menu_id=2 and menu_show=1");
            if ($coupon_menu_row)
            {
                ?>
                <div class="work_hx" id="J_Eact2">
                    <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');"><?=$coupon_menu_row["menu_title"]?></div>
                    <div class="t_nav_out " style="margin-top:20px;">
                        <div id="tab_down">
                            <ul class="work_con clearfix" style="background: none;display: block;padding:0px;">
                                <?php
                                $coupon_rows=$db->query_lists("select * from coupon where coupon_show=1 order by coupon_sort desc,coupon_id desc limit 0,8");
                                foreach ($coupon_rows as $coupon_row)
                                {
                                    ?>
                                    <li style="width:295px;height:140px;background: #fff;border:none;margin:2px;">
                                        <a href="javascript:void(0);"  id="ClickMe" onclick="showpopup()">
                                            <div class="repair-coupon-logo" style="width:84px;">
                                                <div style="margin-top:10px;">
                                                    <img class="lazy" data-original="<?=$coupon_row["coupon_logo"]?>" width="100%" alt="<?=$coupon_row["coupon_title"]?>" src="<?=$coupon_row["coupon_logo"]?>" style="display: inline;">
                                                </div>
                                                <div style="margin-top:-5px;font-size: 14px;">
                                                    <?=$coupon_row["coupon_title"]?>
                                                </div>
                                            </div>
                                            <div class="repair-coupon-content" style="width:135px;">
                                                <div class="repair-coupon-price">
                                                    ￥<?=$coupon_row["coupon_price"]?>
                                                </div>
                                                <div class="line-height-20">
                                                    <?=$coupon_row["coupon_content"]?>
                                                </div>
                                                <div class="line-height-20">
                                                    <?=date("Y年m月d日",strtotime($coupon_row["coupon_time"]))?><br/>
                                                    <?=date("H:i",strtotime($coupon_row["coupon_time"]))?>-<?=date("H:i",strtotime($coupon_row["coupon_end"]))?>
                                                </div>
                                                <div class="repair-coupon-time" id="coupon_time_<?=$coupon_row["coupon_id"]?>" style="line-height: 20px;">
                                                    <div style="width:117px;margin:0 auto;">
                                                        <!--                                                    <span class="repair-product-span" style="font-size:xx-small;">倒计时：</span>-->
                                                        <span class="repair-product-span font-weight" id="day_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                        <span class="repair-product-span font-weight" id="hour_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                        <span class="repair-product-span font-weight" id="minute_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                        <span class="repair-product-span font-weight" type="text" id="second_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function(){
                                                        show_time_<?=$coupon_row["coupon_id"]?>();
                                                    });

                                                    function show_time_<?=$coupon_row["coupon_id"]?>(){
                                                        var time_start = new Date().getTime(); //设定当前时间

                                                        var time_end =  new Date('<?=$coupon_row["coupon_time"]?>').getTime(); //设定目标时间
                                                        // 计算时间差
                                                        var time_distance = time_end - time_start;
                                                        /*判断活动是否结束*/
                                                        if(time_distance<0){

                                                            int_day=0;
                                                            int_hour=0;
                                                            int_minute=0;
                                                            int_second=0;
                                                            $("#coupon_time_<?=$coupon_row["coupon_id"]?>").html("<b>活动已结束</b>");
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
                                                        $("#day_show_<?=$coupon_row["coupon_id"]?>").html(int_day+"天");
                                                        $("#hour_show_<?=$coupon_row["coupon_id"]?>").html(int_hour+"时");
                                                        $("#minute_show_<?=$coupon_row["coupon_id"]?>").html(int_minute+"分");
                                                        $("#second_show_<?=$coupon_row["coupon_id"]?>").html(int_second+"秒");
                                                        // 设置定时器
                                                        setTimeout("show_time_<?=$coupon_row["coupon_id"]?>()",1000);
                                                    }
                                                </script>
                                            </div>
                                            <div style="width:58px;height:140px;float:left;background:#f15b6c;color:#fff;line-height: 58px;letter-spacing:8px;">
                                                <div style="writing-mode:tb-rl;width:100%;height:100%;">
                                                    立即领取
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <a href="coupon.html">
                    <div style="width:100%;height:40px; line-height: 40px; text-align: center;color:#fff;margin-top: 20px;background:<?=$color_more["color_content"]?>;">
                        查看更多
                    </div>
                </a>
                <?php
            }
            ?>
            <!-- 优惠券结束 -->
            <!-- 产品展示 -->
            <?php
            $product_menu_list=$db->query_list_id("select menu_title,menu_id from menu where menu_id=3 and menu_show=1");
            if($product_menu_list)
            {
                $product_menu_rows=$db->query_lists("select menu_id,menu_title,menu_image from menu where menu_level=3 and menu_show=1 order by menu_sort asc,menu_id asc");
                foreach ($product_menu_rows as $product_menu_row)
                {
                    $product_menu_id=$product_menu_row["menu_id"];
                    ?>
                    <div class="work_hx" id="J_Eact2">
                        <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');"><?=$product_menu_row["menu_title"]?></div>
                        <ul class="repair-product-pic-li clearfix">
                            <?php
                            $product_rows=$db->query_lists("select * from product where product_level=$product_menu_id and product_show=1 order by product_sort desc,product_id desc limit 0,6");
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
                        <a href="product-<?=$product_menu_row["menu_id"]?>.html">
                            <div style="width:100%;height:40px; line-height: 40px; text-align: center;color:#fff;margin-top: 20px;background:<?=$color_more["color_content"]?>;">
                                查看更多
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
            <!-- 产品展示 -->
            <!-- 品牌活动 -->
            <?php
            $brand_menu_row=$db->query_list_id("select menu_title,menu_id from menu where menu_id=4 and menu_show=1");
            if($brand_menu_row)
            {
                ?>
                <div style="margin-top:20px;">
                    <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');"><?=$brand_menu_row["menu_title"]?></div>
                    <ul class="hx-branch-li clearfix">
                        <?php
                        $brand_rows=$db->query_lists("select * from brand where  brand_show=1 order by brand_sort asc,brand_id asc limit 0,9");
                        foreach ($brand_rows as $brand_row)
                        {
                            ?>
                            <li style="margin-bottom:25px;">
                                <a href="javascript:void(0);"  id="ClickMe" onclick="showpopup()">
                                    <div style="width:395px;height:220px;margin:0 auto;">
                                        <div  style="border-radius: 20px 20px 0 0;background: <?=$brand_row["brand_color"]?>;height:40%;padding: 20px;">
                                            <div style="float:left;width:50%;">
                                                <img src="<?=$brand_row["brand_logo"]?>"  style="width:100%;height:100%;" />
                                            </div>
                                            <div style="float:left;margin-left:10px;color:#000;line-height: 20px;color:#fff;">
                                                <span style="font-size:18px;">位置</span><br />
                                                <?=$brand_row["brand_position"]?>
                                            </div>
                                        </div>
                                        <div style="height:60%;background: #fff;">
                                            <div style="width:60%;float:left;">
                                                <div style="width:90%;margin:5px auto;">
                                                    <h3><?=$brand_row["brand_title"]?></h3><br />
                                                    <div class="text-line-3"><?=$brand_row["brand_content"]?></div>
                                                </div>
                                            </div>
                                            <div style="width:40%;float:left;">
                                                <img data-original="<?=$brand_row["brand_image"]?>" src="<?=$brand_row["brand_image"]?>" style="width:158px;height:132px;">
                                            </div>
                                        </div>
                                    </div>
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
            <!-- 品牌活动 -->
            <!-- 逛展指南 -->
            <!-- 服务保障 -->
            <!-- 分会场 -->
            <?php require_once 'include/service.php'; ?>
            <!-- 分会场 -->
            <!-- 服务保障 -->
            <!-- 逛展指南 -->
            <!--底部辐条-->
            <!--地图-->

            <div  style="margin-top:10px;">
                <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');">交通路线</div>
                <div>
                    <div style="margin-top:20px;">
                        <iframe border="0" frameborder="0" framespacing="0" height="415" hspace="0" id="mapbarframe" marginheight="0" marginwidth="0" scrolling="no" src="http://searchbox.mapbar.com/publish/template/template1010/index.jsp?CID=shizengying_0126&amp;tid=tid1010&amp;showSearchDiv=1&amp;cityName=%E6%B2%88%E9%98%B3%E5%B8%82&amp;nid=MAPBQNQBZPCBXITAXWHWX&amp;width=1200&amp;height=415&amp;infopoi=2&amp;zoom=10&amp;control=1" vspace="0" width="1200"></iframe>
                    </div>
                </div>
                <div class="repair-map" style="background-color: #fff; padding:20px;margin-top:-10px;border:#666 1px solid;" >
                    <?=$company_row["company_traffic"]?>
                </div>
            </div>
            <!--地图-->
            <!--关于我们-->
            <div >
                <a href="about.html">
                    <div class="t_hd" style="color:<?=$color_font["color_content"]?>;margin-top: 10px;background: url('<?=$tit_background['image_image']?>');">关于我们</div>
                </a>
            </div>
            <!--关于我们-->
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
    <!-- 底部结束-->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // 活动亮点
        $('.act_li li').hover(function() {
            $(this).children('.bottom_div').css('display', 'block');
        }, function() {
            $(this).children('.bottom_div').css('display', 'none');
        });
        // 特惠预约
        $('.be_r_in li').hover(function() {
            $(this).children('.bre_r_none').show().siblings('.bre_r_none').hide();
        }, function() {
            $('.be_r_in li').children('.bre_r_none').hide();
        });
        // 合作品牌
        $(document).ready(function() {
            $('#tab_up li').click(function(event) {
                $(this).addClass('work_now').siblings().removeClass('work_now');
                var num = $(this).index();
                $('#tab_down .work_con').eq(num).siblings('.work_con').hide();
                $('#tab_down .work_con').eq(num).show();
            });

            $('.work_con li a').hover(function() {
                $(this).children('.work_none').css('display', 'block');
            }, function() {
                $(this).children('.work_none').css('display', 'none');
            });
        });
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

        $("#J_BotSmBar").on("click", function() {
            botBarCloseFlag = false;
            $("#J_BotBar .get_in").show();
            $("#J_BotBar").animate({width:"100%"});
            $("#J_BotSmBar").animate({width:"0"});
        });

        $(".J_GetCoupon").on("click", function() {
            var _this = $(this);
            var srcld = 'coupon';
            base.getCoupon($(this).attr("data-id"),srcld, function() {
                // _this.removeClass('J_GetCoupon');
                _this.addClass('over');
                _this.html('已领取');
                // _this.removeAttr('data-id');
                // location.reload(); // 领取成功后执行的方法 需要调整
            });
        });
    });
</script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>