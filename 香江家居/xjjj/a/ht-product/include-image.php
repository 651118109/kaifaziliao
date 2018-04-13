<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
$company_row=$db->query_list_id("select company_water_power,company_water_image,company_water_position,company_water_alpha from company where company_id=1");
$waterpower=$company_row["company_water_power"];
$water_powers= explode(",", $waterpower);
$water_id_count=0;
foreach ($water_powers as $water_power)
{
    if($water_power==100)
    {
        $water_id_count=1;
    }
}
$upload="upload/product/";
$logo_width=192;
$logo_height=102;
$image_width=384;
$image_height=288;
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