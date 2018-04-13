<!-- 逛展指南 -->
<?php
$process_row=$db->query_list_id("select image_image,image_title from image where image_show=1 and image_id=3");
if($process_row)
{
    ?>
    <div class="directory" id="J_Eact3">
        <div class="t_hd"  style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');"><?=$process_row["image_title"]?></div>
        <div class="dir_img clearfix">
            <img src="<?=$process_row["image_image"]?>" />
        </div>
    </div>
    <?php
}
?>
<!-- 逛展指南 -->
<!-- 服务保障 -->
<?php
$service_row=$db->query_list_id("select image_image,image_title from image where image_show=1 and image_id=4");
if($service_row)
{
    ?>
    <div class="tic_se" id="J_Eact4">
        <div class="t_hd" style="color:<?=$color_font["color_content"]?>;background: url('<?=$tit_background['image_image']?>');"><?=$service_row["image_title"]?></div>
        <div class="hx-service-li clearfix">
            <img src="<?=$service_row["image_image"]?>" />
        </div>
    </div>
    <?php
}
?>
<!-- 服务保障 -->
<!-- 分会场 -->
<?php
$branch_menu_row=$db->query_list_id("select menu_title,menu_id from menu where menu_id=5 and menu_show=1");
$menu_width=380;
$menu_height=220;
if($branch_menu_row)
{
    ?>
    <div style="margin-top:20px;">
        <div class="t_hd" style="color:<?= $color_font["color_content"] ?>;background: url('<?=$tit_background['image_image']?>');"><?=$branch_menu_row["menu_title"]?></div>
        <ul class="hx-branch-li clearfix">
            <?php
            $branch_rows = $db->query_lists("select menu_id,menu_title,menu_image from menu where menu_level=3 and menu_show=1 order by menu_sort asc,menu_id asc");
            foreach ($branch_rows as $branch_row) {
                ?>
                <li>
                    <a href="product-<?= $branch_row["menu_id"] ?>.html">
                        <img data-original="<?= $branch_row["menu_image"] ?>" src="<?= $branch_row["menu_image"] ?>"
                             title="<?= $branch_row["menu_title"] ?>">
                    </a>
                </li>
                <?php
            }
            $free_ticket_row = $db->query_list_id("select menu_image from menu where menu_id=3");
            ?>
            <li>
                <a href="javascript:void(0);" id="ClickMe" onclick="showpopup()">
                    <img data-original="<?= $free_ticket_row["menu_image"] ?>"
                         src="<?= $free_ticket_row["menu_image"]."?imageView2/2/w/".$menu_width."/h/".$menu_height ?>" title="免费索票">
                </a>
            </li>
        </ul>
    </div>
    <?php
}
?>
<!-- 分会场 -->