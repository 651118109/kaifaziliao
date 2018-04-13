<div id="goodcover"></div>
<?php $leaveword_details_row=$db->query_list_id("select * from leaveword_details where leaveword_details_id=1"); ?>
<div id="code">
    <div class="close1"><a href="javascript:void(0)" id="closebt"><img src="images/close.gif"></a></div>
    <div class="goodtxt">
        <div class="tic_login end" id="expo_home">
            <div class="tic_title">免费索票</div>
            <div class="tic_num">已有<em><?=$leaveword_details_row["leaveword_details_num"]?></em>人索票</div>
            <div class="tic_input">
                <label class="ipt-label">姓名：</label>
                <div class="ipt-box">
                    <input type="text" class="ipt_txt" placeholder="请输入收件人姓名" id="reserve_name">
                </div>
            </div>
            <div class="tic_input">
                <label class="ipt-label">手机：</label>
                <div class="ipt-box">
                    <input type="text" class="ipt_txt" placeholder="请输入手机号码" id="reserve_tel" maxlength="11">
                </div>
            </div>
            <div class="tic_input">
                <label class="ipt-label">验证码：</label>
                <div class="ipt-box">
                    <input type="text" class="ipt_txt short" placeholder="请输入图形验证码" id="reserve_code">
                </div>
                <div class="test">
                    <img class="verify-image"  id="checkpic_3" src="./checkcode.php" height="37" width="90" onclick="changing();">
                </div>
            </div>
            <div class="msg-box" style="margin-top:-10px;">
                <div class="msg msg-error hide" id="J_MsgReserveSubmit">
                    <i></i>
                    <div class="msg-cnt"></div>
                </div>
            </div>
            <div class="tic_btn"><button  id="baoming1" onclick="leaveword_f()">免费索票</button></div>

        </div>
    </div>
    <!--<div class="code-img"> <img id="ewmsrc"  src="images/code.jpg"></div>-->
</div>

<script>

    function showpopup() {
        $('#code').center();
        $('#goodcover').show();
        $('#code').fadeIn();
    }
    $(function() {
        $('#closebt').click(function() {
            $('#code').hide();
            $('#goodcover').hide();
        });
        $('#goodcover').click(function() {
            $('#code').hide();
            $('#goodcover').hide();
        });
        jQuery.fn.center = function(loaded) {
            var obj = this;
            body_width = parseInt($(window).width());
            body_height = parseInt($(window).height());
            block_width = parseInt(obj.width());
            block_height = parseInt(obj.height());

            left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
            if (body_width < block_width) {
                left_position = 0 + $(window).scrollLeft();
            };

            top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
            if (body_height < block_height) {
                top_position = 0 + $(window).scrollTop();
            };

            if (loaded) {

                obj.css({
                    'position': 'absolute'
                });
                obj.css({
                    'top': ($(window).height() - $('#code').height()) * 0.5,
                    'left': left_position
                });
                $(window).bind('resize', function() {
                    obj.center(!loaded);
                });
                $(window).bind('scroll', function() {
                    obj.center(!loaded);
                });

            } else {
                obj.stop();
                obj.css({
                    'position': 'absolute'
                });
                obj.animate({
                    'top': top_position,
                    'left': left_position
                }, 200, 'linear');
            }
        }

    })
</script>