<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
require_once ('../config/UploadfilesQiniu.class.php');  //引入七牛
$files_qiniu=new UploadfilesQiniu();

    if(!empty($_POST['btnEdit']))
    {
    	$image_title=$_REQUEST['image_title'];
        $image_show=$_REQUEST['image_show'];
        $image_id=$_REQUEST['image_id'];
    	if(empty($image_title))
        {
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_AD.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
        	echo EDIT_AD_ADVERTISING;
        }
        else
        {
            $image_images=$_REQUEST['image_images'];
            $image_image=$files_qiniu->upload_qiniu("image_image",$image_images);
            if(empty($image_image))
            {
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_AD.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                echo ADD_FAIL_IMAGE;
            }
            else
            {



                $sql = "update image set image_title='$image_title',image_image='$image_image',image_show='$image_show' where image_id='$image_id'";
                $rows = $db->edit_list($sql);
                if($rows >= 1)
                {
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_EDIT."“".$image_title."”".WORD_AD.IMPLEMENT_SUCCESS;
                    $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                    echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
                }
                else
                {
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_EDIT."“".$image_title."”".WORD_AD.IMPLEMENT_FAIL;
                    $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                    echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php\";</script>";
                }
            }
        }
    }