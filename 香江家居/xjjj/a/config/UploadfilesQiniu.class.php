<?php

//引入常量配置文件
require '../qiniu/autoload.php';  //引入七牛
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

class UploadfilesQiniu
{
    /*
         * 七牛上传
         */
    public function upload_qiniu($image,$images){
        if(!empty($_FILES[$image]["name"]))
        {
            // 需要填写你的 Access Key 和 Secret Key
            $accessKey = 'JXanCoTnAoyJd4WclS-zPhA8JmWooPTqvK5RCHXb';
            $secretKey = 'ouc-dLEY42KijHeUaTzTBzFeM2Q1mKk_M_3vNpmT';
            $bucket = 'dsyy';
            $url='http://dsyy.isart.me/';

            // 构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);
            // 生成上传 Token
            $token = $auth->uploadToken($bucket);
            // 要上传文件的本地路径
            $filePath = $_FILES[$image]["tmp_name"];
            // 上传到七牛后保存的文件名
            $num=rand(1, 10000);
            $today = date("YmdHis").$num; //获取时间并赋值给变量
            //获取文件的扩展名
            $filetypes = explode(".", $_FILES[$image]["name"]);
            $count=count($filetypes);
            $filetype=$filetypes[$count-1];
            $type = '.'.$filetype;
            $editimg = $today.$type;


            // 初始化 UploadManager 对象并进行文件的上传。
            $uploadMgr = new UploadManager();

            // 调用 UploadManager 的 putFile 方法进行文件的上传。
            list($ret, $err) = $uploadMgr->putFile($token, $editimg, $filePath);
            return $url.$editimg;
        }
        else
        {
            $editimg=empty($images)?"":$images;
            return $editimg;
        }
    }
}