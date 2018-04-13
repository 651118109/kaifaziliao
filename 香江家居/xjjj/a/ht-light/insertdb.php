<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_REQUEST['btnAdd']))
    { 
        $light_title=$_REQUEST['light_title'];
        $light_content=$_REQUEST['light_content'];
        $light_sort=$_REQUEST['light_sort'];
        if(empty($light_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_ADD.WORD_LIGHT.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
            ////////////
            echo ADD_FAIL_TITLE;
        }
        else
        {
            $light_img=$files->upload_image("light_image", $upload, "", $image_width, $image_height);
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
            if(empty($light_image))
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_LIGHT.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo ADD_LIGHT_IMAGE;
            }
            else
            {
                $sql="insert into light (light_title,light_content,"
                    . "light_image,light_sort,light_show) value ('$light_title','$light_content',"
                    . "'$light_image','$light_sort',1)" ;
                $rows=$db->edit_list($sql);
                // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
                if($rows >= 1)
                {
                    ///////////
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_ADD.WORD_LIGHT."“".$light_title."”".IMPLEMENT_SUCCESS;
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
                    $Log_event=WORD_ADD.WORD_LIGHT.IMPLEMENT_FAIL;
                    $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                    ////////////
                    echo "<script>alert('".ADD_FAIL."');"
                        . "location.href=\"select.php\";</script>";
                }
            }
        }
    }