<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    {
        $brand_title=$_REQUEST['brand_title'];
        $brand_color=$_REQUEST['brand_color'];
        $brand_position=$_REQUEST['brand_position'];
        $brand_content=$_REQUEST['brand_content'];
        $brand_sort=$_REQUEST['brand_sort'];
        $brand_show=$_REQUEST['brand_show'];
        $brand_id=$_REQUEST['brand_id'];
        if(empty($brand_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_BRAND.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
            ////////////
            echo EDIT_FAIL_TITLE;
        }
        else
        {
            $brand_logos=$_REQUEST['brand_logos'];
            $brand_img_logo=$files->upload_image("brand_logo", "upload/brand/",$brand_logos);
            if($brand_img_logo=="Out of size")
            {
                echo IMAGE_SIZE;
                return;
            }
            else if($brand_img_logo=="error in type")
            {
                echo IMAGE_FORMAT;
                return;
            }
            else
            {
                $brand_logo=$brand_img_logo;
            }
            $brand_images=$_REQUEST['brand_images'];
            $brand_img=$files->upload_image("brand_image", "upload/brand/",$brand_images);
            if($brand_img=="Out of size")
            {
                echo IMAGE_SIZE;
                return;
            }
            else if($brand_img=="error in type")
            {
                echo IMAGE_FORMAT;
                return;
            }
            else
            {
                $brand_image=$brand_img;
            }
            $sql = "update brand set brand_title='$brand_title',brand_color='$brand_color',"
                . "brand_position='$brand_position',brand_content='$brand_content',brand_logo='$brand_logo',brand_image='$brand_image',"
                . "brand_sort='$brand_sort',brand_show='$brand_show' where brand_id='$brand_id'";
            // 获取影响的行数
            $rows = $db->edit_list($sql);
            // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
            if($rows >= 1)
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_BRAND."“".$brand_title."”".IMPLEMENT_SUCCESS;
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
                $Log_event=WORD_EDIT.WORD_BRAND."“".$brand_title."”".IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_FAIL."');"
                    . "location.href=\"select.php\";</script>";
            }
        }
    }