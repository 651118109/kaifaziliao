<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    {
    	$image_title=$_REQUEST['image_title'];
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
            if($image_id==13)
            {
                $image_width=$image_width_13;
                $image_height=$image_height_13;
//                $upload="images/";
            }
            else if($image_id==14)
            {
                $image_width=$image_width_14;
                $image_height=$image_height_14;
//                $upload="wap/images/";
            }
            $image_images=$_REQUEST['image_images'];
//            $img=$files->upload_cover("image_image", $image_images, $upload, "tit-bg", $image_width, $image_height);
            $img=$files->upload_image("image_image", $upload, $image_images, $image_width, $image_height);
            if($img=="Out of size")
            {
                echo IMAGE_SIZE;
                return;
            }
            else if($img=="error in type")
            {
                echo IMAGE_FORMAT;
                return;
            }
            else
            {
                $image_image=$img;
            }
            if(empty($image_image))
            {
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_AD.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                echo ADD_FAIL_IMAGE;
            }
            else
            {
                $sql = "update image set image_title='$image_title',image_image='$image_image' where image_id='$image_id'";
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
                    $Log_event=WORD_EDIT."“".$image_title."”".WORD_AD.IMPLEMENT_SUCCESS;
                    $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                    echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
                }
            }
        }
    }