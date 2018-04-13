<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
$company_row=$db->query_list_id("select company_water_power,company_water_image,company_water_position,company_water_alpha from company where company_id=1");
$waterpower=$company_row["company_water_power"];
$water_powers= explode(",", $waterpower);
$water_id_count=0;
foreach ($water_powers as $water_power)
{
    if($water_power==80)
    {
        $water_id_count=1;
    }
}
$upload="upload/image/";
$image_width_1=1920;
$image_height_1=585;
$image_width_2=1200;
$image_height_2=200;
$image_width_3=1200;
$image_height_3=480;
$image_width_4=1200;
$image_height_4=240;
$image_width_5="640";
$image_height_5="550";
$image_width_6="640";
$image_height_6="141";
$image_width_7=150;
$image_height_7=50;
$image_width_8=396;
$image_height_8=159;
$image_width_9=450;
$image_height_9=134;
$image_width_10=332;
$image_height_10=134;
$image_width_12=1920;
$image_height_12=235;
$image_width_13=252;
$image_height_13=34;
$image_width_14=252;
$image_height_14=34;
if($water_id_count==1)
{
    $watermark=$company_row['company_water_image'];
    $positon=$company_row['company_water_position'];
    $alpha=$company_row['company_water_alpha'];
}
else
{
    $watermark="";
    $positon="";
    $alpha="";
}