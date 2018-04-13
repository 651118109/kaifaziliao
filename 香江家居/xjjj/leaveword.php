<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
require ("./config/conn.php");//引入链接数据库

$leaveword_name=empty($_REQUEST["leaveword_name"])?"匿名":$_REQUEST["leaveword_name"];
$leaveword_tel=$_REQUEST["leaveword_tel"];
$leaveword_code=$_REQUEST['leaveword_code'];

//判断来源
$SERVER_NAME=$_SERVER['SERVER_NAME'];
if($SERVER_NAME=="360.syxjhome.com")
{
    $leaveword_source="360-PC端";
}
else if($SERVER_NAME=="video.syxjhome.com")
{
    $leaveword_source="腾讯视网-PC端";
}
else if($SERVER_NAME=="qqmini.syxjhome.com")
{
    $leaveword_source="腾讯迷你页-PC端";
}
else if($SERVER_NAME=="qqnews.syxjhome.com")
{
    $leaveword_source="腾讯新闻app信息流";
}
else if($SERVER_NAME=="sina.syxjhome.com")
{
    $leaveword_source="新浪微博开屏";
}
else if($SERVER_NAME=="rabbit.syxjhome.com")
{
    $leaveword_source="土巴兔";
}
else if($SERVER_NAME=="himalayan.syxjhome.com")
{
    $leaveword_source="喜马拉雅";
}
else if($SERVER_NAME=="delivery.syxjhome.com")
{
    $leaveword_source="精准投放";
}
else if($SERVER_NAME=="tencent.syxjhome.com")
{
    $leaveword_source="腾讯新闻app开屏";
}
else if($SERVER_NAME=="youku.syxjhome.com")
{
    $leaveword_source="优酷视频PC端";
}
else if($SERVER_NAME=="ad.syxjhome.com")
{
    $leaveword_source="移动互动效果广告";
}
else if($SERVER_NAME=="netease.syxjhome.com")
{
    $leaveword_source="网易";
}
else
{
    $leaveword_source="百度-PC端";
}

if(md5($leaveword_code)==$_SESSION["verification"])
{
    $row=$db->edit_list("insert into leaveword (leaveword_name,leaveword_tel,leaveword_source)value('$leaveword_name','$leaveword_tel','$leaveword_source')");
    if($row>0)
    {
        $leaveword_deteil_row=$db->query_list_id("select leaveword_details_num from leaveword_details where leaveword_details_id=1");
        $leaveword_details_num=$leaveword_deteil_row["leaveword_details_num"]+1;
        $db->edit_list("update leaveword_details set leaveword_details_num='$leaveword_details_num' where leaveword_details_id=1");
        include ("./sms.php");
        //echo "SmsDemo::sendSms\n";
        $response = $demo->sendSms(
            "香江家居", // 短信签名
            "SMS_102310032", // 短信模板编号
            $leaveword_tel, // 短信接收者
            Array(  // 短信模板中字段的值
                //"title"=>"国庆家居展会",
                //"tel"=>"25614838"
            ),
            "123"
        );
        //print_r($response);
        echo "1";
    }
    else
    {
        echo "0";
    }
}
else
{
    echo 2;
}