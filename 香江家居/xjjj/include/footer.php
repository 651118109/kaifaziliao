<div class="righ-nav" style="display: none;">
    <div class="right-nav-box">
        <div class="righ-nav-hd"></div>
        <div class="right-nav-menu">
            <?php
            $window_image_row=$db->query_list_id("select image_image from image where image_id=7 and image_show=1");
            if($window_image_row)
            {
                ?>
                <div class="qq"><img src="<?=$window_image_row["image_image"]?>" /></div>
                <?php
            }
            ?>
                <a href="index.html"><div class="ticket">首页</div></a>
            <?php
            $menu_rows=$db->query_lists("select menu_title,menu_id from menu where menu_show=1 and menu_level=3 order by menu_sort asc,menu_id asc");
            foreach ($menu_rows as $menu_row)
            {
                ?>
                <a href="product-<?=$menu_row["menu_id"]?>.html"><div class="ticket"><?=$menu_row["menu_title"]?></div></a>
                <?php
            }
            ?>
            <a href="http://p.qiao.baidu.com/cps/chat?siteId=11146976&userId=23090162" target="_blank"><div class="ticket">在线咨询</div></a>

            <!--返回顶部-->
<!--            <div class="go-top"></div>-->
            <!--返回顶部-->
        </div>
    </div>
</div>
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