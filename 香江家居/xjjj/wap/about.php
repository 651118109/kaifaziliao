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
            <h1 class="title">关于我们</h1>
        </header>
        <div class="content ticket-content native-scroll">
            <!-- Banner -->
            <?php require_once 'include/banner.php'; ?>
            <div class="main-wap" style='margin-top:10px;'>
                <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
                    关于我们
                </div>
                <div class="repair-about">
                    <?=$company_row["company_about"]?>
                </div>
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