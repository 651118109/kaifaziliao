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
<div class="container" style="background: <?=$color_coupon["color_content"]?>">
    <?php require_once 'include/banner.php'; ?>
    <div class="t_main">
        <div class="t_nav_out" style="display: none;">
            <ul class="clearfix" id="J_TopBar">
                <li id="J_EactNav1" class="J_EactNav" data-id="1" style="width:238px"></li>
                <li id="J_EactNav2" class="J_EactNav" data-id="2" style="width:238px"></li>
                <li id="J_EactNav3" class="J_EactNav" data-id="3" style="width:238px"></li>
                <li id="J_EactNav4" class="J_EactNav" data-id="4" style="width:238px"></li>
                <li id="J_EactNav5" class="J_EactNav" data-id="5" style="width:238px"></li>
            </ul>
        </div>
        <div class="t_con">
            <div class="work_hx" id="J_Eact2">
                <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');">优惠卷</div>
                <div class="t_nav_out " style="margin-top:20px;">
                    <ul class="clearfix" id="tab_up">
                        <?php
                        $coupon_menu_rows=$db->query_lists("select menu_title,menu_id from menu where menu_level=2 and menu_show=1 order by menu_sort asc,menu_id asc limit 0,5");
                        foreach ($coupon_menu_rows as $k=>$coupon_menu_row)
                        {
                            ?>
                            <li <?=$k==0?"class='work_now'":""?> style="width:238px"><?=$coupon_menu_row["menu_title"]?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div id="tab_down">
                        <?php
                        foreach ($coupon_menu_rows as $k=>$coupon_menu_row)
                        {
                            ?>
                            <ul class="work_con clearfix" <?=$k==0?"style='display:block'":""?>>
                                <?php
                                $coupon_level=$coupon_menu_row["menu_id"];
                                $coupon_rows=$db->query_lists("select * from coupon where coupon_level=$coupon_level order by coupon_sort desc,coupon_id desc");
                                foreach ($coupon_rows as $coupon_row)
                                {
                                    ?>
                                    <li class="repair-coupon-li" style="width:370px;height:140px;background: none;border:1px #eee solid;">
                                        <a href="javascript:void(0);"  id="ClickMe" onclick="showpopup()">
                                            <div class="repair-coupon-logo">
                                                <div style="margin-top:10px;">
                                                    <img class="lazy" data-original="<?=$coupon_row["coupon_logo"]?>" width="100%" alt="<?=$coupon_row["coupon_title"]?>" src="<?=$coupon_row["coupon_logo"]?>" style="display: inline;">
                                                </div>
                                                <div style="margin-top:-15px;">
                                                    <?=$coupon_row["coupon_title"]?>
                                                </div>
                                            </div>
                                            <div class="repair-coupon-content">
                                                <div class="repair-coupon-price">
                                                    ￥<?=$coupon_row["coupon_price"]?>
                                                </div>
                                                <div class="line-height-20">
                                                    <?=$coupon_row["coupon_content"]?>
                                                </div>
                                                <div class="line-height-20" style="font-size:12px;">
                                                    <?=date("Y年m月d日 H:i",strtotime($coupon_row["coupon_time"]))?>-<?=date("H:i",strtotime($coupon_row["coupon_end"]))?>
                                                </div>
                                                <div class="repair-coupon-time" id="coupon_time_<?=$coupon_row["coupon_id"]?>">
                                                    <span class="repair-product-span" style="margin-left:5px;">倒计时：</span>
                                                    <span class="repair-product-span font-weight" id="day_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                    <span class="repair-product-span font-weight" id="hour_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                    <span class="repair-product-span font-weight" id="minute_show_<?=$coupon_row["coupon_id"]?>"></span>
                                                    <span class="repair-product-span font-weight" type="text" id="second_show_<?=$coupon_row["coupon_id"]?>"></span>
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
                                            <div style="width:56px;height:140px;float:left;background:#f15b6c;color:#fff;line-height: 57px;letter-spacing:8px;">
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
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <!-- 逛展指南 -->
            <!-- 服务保障 -->
            <!-- 分会场 -->
            <?php require_once 'include/service.php'; ?>
            <!-- 分会场 -->
            <!-- 服务保障 -->
            <!-- 逛展指南 -->
            <!--底部辐条-->
            <!--地图-->

            <div >
                <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');margin-top: 20px;">交通路线</div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            var h = $(window).height();
            $(window).scroll(function(event) {
                var s = $(window).scrollTop();
                if(s>=h){
                    $('.righ-nav').show();
                }else{
                    $('.righ-nav').hide();
                };
                $('.go-top').click(function(event) {
                    $('html,body').stop().animate({'scrollTop':0}, 500);
                });
            });
        });
    </script>
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


                $("html,body").animate({scrollTop:Math.round($("#J_Eact2").offset().top - 70)}, 100);
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

        /**
         * 导航栏
         */
        var topBarOffsetTop = $("#J_TopBar").offset().top;
        var navCount = parseInt(5);

        $(".J_EactNav").on("click", function(){var idx = $(this).attr("data-id");$("html,body").animate({scrollTop:Math.round($("#J_Eact" + idx).offset().top - 70)}, 100);});

        window.onscroll = function() {
            var t = document.documentElement.scrollTop || document.body.scrollTop;

            // 头部导航栏
            if (t >= 800) {
                $("#tab_up").addClass("move");
            } else {
                $("#tab_up").removeClass("move").find(".t_now").removeClass("t_now");
            }
        }

    });

    function addFavorite() {
        var url = window.location;
        var title = document.title;
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf("360se") > -1) {
            alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
        } else if (ua.indexOf("msie 8") > -1) {
            window.external.AddToFavoritesBar(url, title); //IE8
        } else if (document.all) {
            try {
                window.external.addFavorite(url, title);
            } catch(e) {
                alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
            }
        } else if (window.sidebar) {
            window.sidebar.addPanel(title, url, "");
        } else {
            alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
        }
    }
</script>
<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>