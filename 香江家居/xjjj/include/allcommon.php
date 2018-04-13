<?php
$dhid=empty($_REQUEST['dhid'])?1:$_REQUEST['dhid'];
$company_row=$db->query_list_id("select * from company where company_id=1");
$dhid=empty($_REQUEST['dhid'])?1:$_REQUEST['dhid'];
//dhid所对应的一级栏目
$menu_one_list=$db->query_list_id("select * from menu where menu_id=$dhid");


//色系搭配
$color_index=$db->query_list_id("select color_content from color where color_id=1");
$color_product=$db->query_list_id("select color_content from color where color_id=2");
$color_coupon=$db->query_list_id("select color_content from color where color_id=11");
$color_font=$db->query_list_id("select color_content from color where color_id=5");
$color_more=$db->query_list_id("select color_content from color where color_id=9");
$tit_background=$db->query_list_id("select image_image from image where image_id=13");
?>