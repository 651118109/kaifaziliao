<?php
//因为360基础流量代码要放在body之间靠顶部，所以script模块中的代码遍历没有特殊要求的情况下暂时先放在了这个位置
$script_body_rows=$db->query_lists("select * from script where script_level=2 ");
foreach($script_body_rows as $script_body_row)
{
    ?>
    <?=$script_body_row['script_content']?>
    <?php
}
?>

<?php
$banner_row=$db->query_list_id("select image_image from image where image_id=1 and image_show=1");
if($banner_row)
{
    ?>
        <div class="t_banner">
            <a href="javascript:void(0);"  id="ClickMe" onclick="showpopup()">
                <div class="t_banner_bg" style="width:100%; height:585px; background:url('<?=$banner_row["image_image"]?>'); background-position:top center;background-repeat: no-repeat;" />
                    <div style="width:1200px;height:100%;margin: 0px auto; position: relative;">
                        <div style="width:410px; height:350px; position:absolute;right:0; top:15%;">
                            <div style="width:100%;color:red;font-size:32px;text-align: center;line-height: 70px; color:#fff;">
                                免费索票
                            </div>
                            <?php $leaveword_details_row=$db->query_list_id("select * from leaveword_details where leaveword_details_id=1"); ?>
                            <div class="tic_num" style="margin:10px auto; color:#fff;">已有<em style="color:yellow;"><?=$leaveword_details_row["leaveword_details_num"]?></em>人索票</div>
                            <div class="tic_input bg-white" style="margin:10px auto;">
                                <label class="ipt-label">姓名：</label>
                                <div class="ipt-box">
                                    <input type="text" class="ipt_txt" placeholder="请输入收件人姓名" id="reserve_name1">
                                </div>
                            </div>
                            <div class="tic_input bg-white" style="margin:10px auto;">
                                <label class="ipt-label">手机：</label>
                                <div class="ipt-box">
                                    <input type="text" class="ipt_txt" placeholder="请输入手机号码" id="reserve_tel1" maxlength="11">
                                </div>
                            </div>
                            <div class="tic_input bg-white" style="margin:10px auto;">
                                <label class="ipt-label">验证码：</label>
                                <div class="ipt-box">
                                    <input type="text" class="ipt_txt short" placeholder="请输入图形验证码" id="reserve_code1">
                                </div>
                                <div class="test" style="width:90px;">
                                    <img class="verify-image"  id="checkpic_1" src="./checkcode.php" height="37" width="90" onclick="changing();">
                                </div>
                            </div>
                            <div class="tic_btn" style="margin:10px auto;">
                                <button class="btn" id="baoming2" onclick="leaveword_f()" style="margin:10px auto;">
                                    <img src="./images/btn-bg.png">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    <?php
}
$round_row=$db->query_list_id("select image_image from image where image_id=12 and image_show=1");
$round_width=1920;
$round_height=235;
if($round_row)
{
    ?>
    <div class="t_banner" style="margin-top:10px;">
        <a href="javascript:void(0);"  id="ClickMe" onclick="showpopup()">
            <div class="t_banner_bg">
                <img src="<?=$round_row["image_image"]."?imageView2/2/w/".$round_width."/h/".$round_height ?>" style="width:100%;" />
            </div>
        </a>
    </div>
    <?php
}
?>
