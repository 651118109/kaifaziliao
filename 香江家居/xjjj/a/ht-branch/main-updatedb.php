<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    {
        $image_id=$_REQUEST['image_id'];
        $image_images=$_REQUEST['image_images'];
//        $img_wap=$files->upload_image("image_image", $upload, $image_images, $image_main_width, $image_main_height);
        $img_wap=$files->upload_picture("image_image", $upload, $image_images);
        if($img_wap=="Out of size")
        {
            echo IMAGE_SIZE;
            return;
        }
        else if($img_wap=="error in type")
        {
            echo IMAGE_FORMAT;
            return;
        }
        else
        {
            $image_image=$img_wap;
        }
        if(empty($image_image))
        {
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.BRANCH_MAIN.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
            echo ADD_FAIL_IMAGE;
        }
        else
        {
            $sql = "update image set image_image='$image_image' where image_id='$image_id'";
            $rows = $db->edit_list($sql);
            if($rows >= 1)
            {
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT."“".BRANCH_MAIN."”".WORD_BRANCH.IMPLEMENT_SUCCESS;
                $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
            }
            else
            {
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT."“".BRANCH_MAIN."”".WORD_BRANCH.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php\";</script>";
            }
        }
    }