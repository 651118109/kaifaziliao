<?php
$image_service_row=$db->query_list_id("select image_image,image_title from image where image_id=6 and image_show=1");
if($image_service_row)
{
    ?>
    <div class="service repair-service">
        <div class="tit" style="color:<?=$color_font["color_content"]?>;background: url('../<?=$tit_background['image_image']?>');background-size: 100%;">
            服务保障
        </div>
        <div class="service-in">
            <img src="../<?=$image_service_row['image_image']?>"/>
        </div>
    </div>
    <?php
}