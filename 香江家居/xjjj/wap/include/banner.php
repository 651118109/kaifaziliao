<?php
$image_banner_row=$db->query_list_id("select image_image from image where image_id=5 and image_show=1");
if($image_banner_row)
{
    ?>
    <div class="banner">
        <img src="<?=$image_banner_row["image_image"]?>" width="100%">

        <!-- 索票input框开始 -->
        <div class="list-block" id="J_TicketForm">
            <ul style="margin:0 0.5rem;">
                <li style="margin-top:0;">
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="请输入您的姓名" class="txt" name="leaveword_name" id="leaveword_name">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="tel" placeholder="请输入您的手机号码" class="txt" name="leaveword_tel" id="leaveword_tel" maxlength="11">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="ticket-btn repair-ticket-btn" style="margin:0.5rem;">
                <button class="btn" onclick="leaveword()" id="biaoming5">
                    <img src="./images/btn-bg.png">
                </button>
            </div>
        </div>
        <!-- 索票input框结束 -->
    </div>
    <?php
}
?>
