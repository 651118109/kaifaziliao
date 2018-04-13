<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    { 
        $scene_title=$_REQUEST['scene_title'];
        $scene_sort=$_REQUEST['scene_sort'];
        $scene_id=$_REQUEST['scene_id'];
        $scene_images=$_REQUEST['scene_images'];
        $scene_img=$files->upload_image("scene_image", $upload, $scene_images, $image_width, $image_height);
        if($scene_img=="Out of size")
        {
            echo IMAGE_SIZE;
            return;
        }
        else if($scene_img=="error in type")
        {
            echo IMAGE_FORMAT;
            return;
        }
        else
        {
            $scene_image=$scene_img;
        }
        $sql = "update scene set scene_title='$scene_title',"
        . "scene_image='$scene_image',"
        . "scene_sort='$scene_sort' "
        . "where scene_id='$scene_id'";
        // 获取影响的行数
        $rows = $db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >= 1)
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_SCENE."“".$scene_title."”".IMPLEMENT_SUCCESS;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".EDIT_SUCCESS."');"
            . "location.href=\"select.php\";</script>";
        }
        else
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_SCENE."“".$scene_title."”".IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".EDIT_FAIL."');"
            . "location.href=\"select.php\";</script>";
        }
    }