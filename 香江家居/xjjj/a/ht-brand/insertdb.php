<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_REQUEST['btnAdd']))
    {
        $brand_title=$_REQUEST['brand_title'];
        $brand_color=$_REQUEST['brand_color'];
        $brand_position=$_REQUEST['brand_position'];
        $brand_content=$_REQUEST['brand_content'];
        $brand_sort=$_REQUEST['brand_sort'];
        $brand_show=$_REQUEST['brand_show'];
        if(empty($brand_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_ADD.WORD_BRAND.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
            ////////////
            echo ADD_FAIL_TITLE;
        }
        else
        {
            $brand_img_logo=$files->upload_image("brand_logo", $upload, "", $logo_width, $logo_height);
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
            if(empty($brand_logo))
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_BRAND.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo ADD_LIGHT_IMAGE;
            }
            else
            {
                $brand_img=$files->upload_image("brand_image", $upload, "", $image_width, $image_height);
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
                if(empty($brand_image))
                {
                    ///////////
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_ADD.WORD_BRAND.IMPLEMENT_FAIL;
                    $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                    ////////////
                    echo ADD_LIGHT_IMAGE;
                }
                else
                {
                    $sql="insert into brand (brand_title,brand_color,brand_position,brand_content,brand_logo,"
                        . "brand_image,brand_sort,brand_show) value ('$brand_title','$brand_color','$brand_position','$brand_content',"
                        . "'$brand_logo','$brand_image','$brand_sort','$brand_show')" ;
                    $rows=$db->edit_list($sql);
                    // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
                    if($rows >= 1)
                    {
                        ///////////
                        $Log_name=$_COOKIE['login'];
                        $Log_event=WORD_ADD.WORD_BRAND."“".$brand_title."”".IMPLEMENT_SUCCESS;
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
                        $Log_event=WORD_ADD.WORD_BRAND.IMPLEMENT_FAIL;
                        $db->edit_list("insert into log (Log_name,Log_event)"
                            . "values('$Log_name','$Log_event')");
                        ////////////
                        echo "<script>alert('".ADD_FAIL."');"
                            . "location.href=\"select.php\";</script>";
                    }
                }
            }
        }
    }