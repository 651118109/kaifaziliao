<?php
$dhid=empty($_REQUEST['dhid'])?1:$_REQUEST['dhid'];
$company_row=$db->query_list_id("select * from company where company_id=1");
$dhid=empty($_REQUEST['dhid'])?1:$_REQUEST['dhid'];
//dhid所对应的一级栏目
$menu_one_list=$db->query_list_id("select * from menu where menu_id=$dhid");

//色值搭配
$color_index=$db->query_list_id("select color_content from color where color_id=3");
$color_product=$db->query_list_id("select color_content from color where color_id=4");
$color_coupon=$db->query_list_id("select color_content from color where color_id=12");
$color_font=$db->query_list_id("select color_content from color where color_id=6");
$color_more=$db->query_list_id("select color_content from color where color_id=10");
$tit_background=$db->query_list_id("select image_image from image where image_id=14");

$menu_wap_width=295;
$menu_wap_height=180;
?>