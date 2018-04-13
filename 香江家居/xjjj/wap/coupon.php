<?php require_once 'config/conn.php';?>
<!DOCTYPE html>
<!-- saved from url=(0034)http://m.51jiabo.com/sy/brand.html -->
<html class="pixel-ratio-3 retina android android-5 android-5-0"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="./css/sm.min.css">
    <link rel="stylesheet" href="./css/sm-extend.min.css">
    <link rel="stylesheet" type="text/css" href="./css/iSlider.min.css">
    <link rel="stylesheet" type="text/css" href="./css/base.css">
    <link href="./css/brand.css" rel="stylesheet" type="text/css" media="screen">
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/repair.css">
    <script type="text/javascript" async="" src="./js/repair.js"></script>
    <link href="./css/ticket2017-06.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
</head>
<body>	<div class="page-group">
    <div class="page page-current" style="background: <?=$color_coupon["color_content"]?>">
        <header class="bar bar-nav">
            <a class="button button-link button-nav pull-left" href="index.html">
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title">优惠卷</h1>
        </header>
        <div class="content native-scroll">
            <!-- Banner -->
            <?php require_once 'include/banner.php'; ?>
            <a name="<?=$tdhid?>"></a>
            <script language="javascript">
                function Tab(num)
                {
                    var i;
                    for(i=1;i<=5;i++)
                    {
                        if(i==num)
                        {
                            $("#d_"+i).css("display","block");
                            $("#coupon_menu_"+i).attr("class", "col-25 active");
                        }
                        else
                        {
                            $("#d_"+i).css("display","none");
                            $("#coupon_menu_"+i).attr("class", "col-25");
                        }
                    }
                }
            </script>
            <div class="nav">
                <div class="nav-fo" id="my-nav" style="display: block;"  >
                    <div class="content-padded grid-demo">
                        <div class="nav-li content-inner">
                            <div class="row" style="width:auto;height:2.34rem;background: #d3d7d4;">
                                <?php
                                $coupon_menu_rows=$db->query_lists("select menu_title,menu_id from menu where menu_level=2 and menu_show=1 order by menu_sort asc,menu_id asc limit 0,5");
                                $tdhid=empty($tdhid)?$coupon_menu_rows[0]["menu_id"]:$tdhid;
                                foreach ($coupon_menu_rows as $k=>$coupon_menu_row)
                                {
                                    ?>
                                    <div class="col-25 <?=$tdhid==$coupon_menu_row["menu_id"]?"active":""?>" id="coupon_menu_<?=$k+1?>" style="height:2.34rem;line-height: 2.34rem;">
                                        <a href="javascript:void(0)" onclick="Tab(<?=$k+1?>)" style="color:#666;">
                                            <?=$coupon_menu_row["menu_title"]?>
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
            <div class="brand-list">
                <?php
                foreach ($coupon_menu_rows as $k=>$coupon_menu_row)
                {
                    $coupon_level=$coupon_menu_row["menu_id"];
                    ?>
                    <div class="content-padded grid-demo" id="d_<?=$k+1?>" <?=$k==0?"style='display:block;'":"style='display:none;'"?>>
                        <?php
                        $coupon_rows=$db->query_lists("select * from coupon where coupon_level=$coupon_level order by coupon_sort desc,coupon_id desc");
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
                                            <span  id="day_show_<?=$coupon_row["coupon_id"]?>"></span>
                                            <span  id="hour_show_<?=$coupon_row["coupon_id"]?>"></span><br />
                                            <span  id="minute_show_<?=$coupon_row["coupon_id"]?>"></span>
                                            <span  type="text" id="second_show_<?=$coupon_row["coupon_id"]?>"></span>
                                        </div>
                                        <script type="text/javascript">
                                            $(function(){
                                                show_time_<?=$coupon_row["coupon_id"]?>();
                                            });

                                            function show_time_<?=$coupon_row["coupon_id"]?>(){
                                                var time_start = new Date().getTime(); //设定当前时间

                                                var time_end =  new Date("<?=date("Y/m/d H:i:s",strtotime($coupon_row["coupon_time"]))?>").getTime(); //设定目标时间
                                                // 计算时间差
                                                var time_distance = Math.floor(time_end) - Math.floor(time_start);
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
                                </div>
                            </a>
                            <div class="clear"></div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- 服务保障 -->
            <?php require_once 'include/service.php'; ?>
            <!-- 服务保障 -->

            <!-- 分会场 -->
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
                                    <a href="javascript:void(0);" class="open-popup activity_click" data-id="0" data-popup=".rule">
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
<div></div></body>
