<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    { 
        $light_title=$_REQUEST['light_title'];
        $light_content=$_REQUEST['light_content'];
        $light_sort=$_REQUEST['light_sort'];
        $light_show=$_REQUEST['light_show'];
        $light_id=$_REQUEST['light_id'];
        if(empty($light_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_LIGHT.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
            ////////////
            echo EDIT_FAIL_TITLE;
        }
        else
        {
            $light_images=$_REQUEST['light_images'];
            $light_img=$files->upload_image("light_image", "upload/light/",$light_images);
            if($light_img=="Out of size")
            {
                echo IMAGE_SIZE;
                return;
            }
            else if($light_img=="error in type")
            {
                echo IMAGE_FORMAT;
                return;
            }
            else
            {
                $light_image=$light_img;
            }
            $sql = "update light set light_title='$light_title',"
                . "light_content='$light_content',light_image='$light_image',"
                . "light_sort='$light_sort',light_show='$light_show' where light_id='$light_id'";
            // 获取影响的行数
            $rows = $db->edit_list($sql);
            // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
            if($rows >= 1)
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_LIGHT."“".$light_title."”".IMPLEMENT_SUCCESS;
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
                $Log_event=WORD_EDIT.WORD_LIGHT."“".$light_title."”".IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_FAIL."');"
                    . "location.href=\"select.php\";</script>";
            }
        }
    }