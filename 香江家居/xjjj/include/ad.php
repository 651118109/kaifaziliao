<script>
    function changing(){
        var checkpic="./checkcode.php?"+Math.random();
        document.getElementById('checkpic_1').src=checkpic;
        document.getElementById('checkpic_2').src=checkpic;
        document.getElementById('checkpic_3').src=checkpic;
    }
</script>
<div class="gain" id="J_BotSmBar" style="display: none;"></div>
<div class="get_tic" id="J_BotBar" style="display: none; width: 100%;">
    <?php
    $image_ad_left_row=$db->query_list_id("select image_image from image where image_id=8 and image_show=1");
    $image_ad_center_row=$db->query_list_id("select image_image from image where image_id=9 and image_show=1");
    $image_ad_right_row=$db->query_list_id("select image_image from image where image_id=10 and image_show=1");
    ?>
    <div class="get_in clearfix">
        <div class="get_in_l fl" style="background: url(<?=$image_ad_left_row["image_image"]?>) no-repeat;"></div>
        <div class="get_in_r_qr fr" style="background: url(<?=$image_ad_right_row["image_image"]?>) no-repeat;"></div>
        <div class="get_in_r fr" id="expo_botbar"  style="background: url(<?=$image_ad_center_row["image_image"]?>) no-repeat;">
            <div class="ipt_line">
                <div class="ipt-box">
                    <input type="text" placeholder="请输入您的姓名" class="ipnt_txt" name="leaveword_name" id="leaveword_name">
                </div>
            </div>
            <div class="ipt_line">
                <div class="ipt-box">
                    <input type="text" placeholder="请输入您的手机" class="ipnt_txt" name="leaveword_tel" id="leaveword_tel">
                </div>
            </div>
            <div class="ipt_line">
                <div class="ipt-box">
                    <input type="text" class="ipnt_txt2" placeholder="请输入图形验证码" id="leaveword_code">
                </div>
                <div class="test2"><img class="verify-image"  id="checkpic_2" src="./checkcode.php" height="27" width="90" onclick="changing();"></div>
            </div>
            <div class="mid_line"></div>
            <div class="ipt_btn">
                <button onclick="leaveword()" id="biaoming3">快速索票</button>
            </div>
            <div class="msg-box quick-msg-box">
                <div class="msg msg-error hide" id="J_MsgReserveSubmit">
                    <i></i>
                    <div class="msg-cnt"></div>
                </div>
            </div>
        </div>
        <div class="close fr" id="J_BotBarClose"><img src="./images/close.gif" /></div>
    </div>
</div>