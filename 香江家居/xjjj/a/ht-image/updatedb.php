<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
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
            if($image_id==1)
            {
                $image_width="";
                $image_height="";
            }
            else if($image_id==2)
            {
                $image_width=$image_width_2;
                $image_height=$image_height_2;
            }
            else if($image_id==3)
            {
                $image_width=$image_width_3;
                $image_height=$image_height_3;
            }
            else if($image_id==4)
            {
                $image_width=$image_width_4;
                $image_height=$image_height_4;
            }
            else if($image_id==5)
            {
                $image_width=$image_width_5;
                $image_height=$image_height_5;
            }
            else if($image_id==6)
            {
                $image_width=$image_width_6;
                $image_height=$image_height_6;
            }
            else if($image_id==7)
            {
                $image_width=$image_width_7;
                $image_height=$image_height_7;
            }
            else if($image_id==8)
            {
                $image_width=$image_width_8;
                $image_height=$image_height_8;
            }
            else if($image_id==9)
            {
                $image_width=$image_width_9;
                $image_height=$image_height_9;
            }
            else if($image_id==10)
            {
                $image_width=$image_width_10;
                $image_height=$image_height_10;
            }
            $image_images=$_REQUEST['image_images'];
            if($image_id==12)
            {
                $img=$files->upload_picture("image_image", $upload, $image_images);
            }
            else
            {
                $img=$files->upload_image("image_image", $upload, $image_images, $image_width, $image_height);
            }
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