<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_REQUEST['btnAdd']))
    { 
        $scene_title=$_REQUEST['scene_title'];
        $scene_sort=$_REQUEST['scene_sort'];
        $scene_img=$files->upload_image("scene_image", $upload, "", $image_width, $image_height);
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
        if(empty($scene_image))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_ADD.WORD_SCENE.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
            ////////////
            echo ADD_SCENE_IMAGE;
        }
        else
        {
            $sql="insert into scene (scene_title,"
                . "scene_image,scene_sort) value ('$scene_title',"
                . "'$scene_image','$scene_sort')" ;
            $rows=$db->edit_list($sql);
            // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
            if($rows >= 1)
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_SCENE."“".$scene_title."”".IMPLEMENT_SUCCESS;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".ADD_SUCCESS."');"
                    . "location.href=\"select.php\";</script>";
            }
            else
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_SCENE.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".ADD_FAIL."');"
                    . "location.href=\"select.php\";</script>";
            }
        }
    }