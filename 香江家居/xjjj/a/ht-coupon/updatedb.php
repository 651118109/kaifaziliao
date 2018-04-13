<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_REQUEST['btnEdit']))
    {
        $coupon_title=$_REQUEST['coupon_title'];
        $coupon_price=$_REQUEST['coupon_price'];
        $coupon_content=$_REQUEST['coupon_content'];
        $coupon_sort=$_REQUEST['coupon_sort'];
        $coupon_show=$_REQUEST['coupon_show'];
        $coupon_time=empty($_REQUEST['coupon_time'])?date('Y-m-d H:m',time()):$_REQUEST['coupon_time'];
//        $coupon_start=empty($_REQUEST['coupon_start'])?date('y-m-d H:m',time()):$_REQUEST['coupon_start'];
        $coupon_end=empty($_REQUEST['coupon_end'])?date('Y-m-d H:m',time()):explode(" ",$coupon_time)[0]." ".$_REQUEST['coupon_end'];
        $coupon_id=$_REQUEST['coupon_id'];
        $coupon_level=$_REQUEST['coupon_level'];
    	if(empty($coupon_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_COUPON.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_TITLE;
        }
        else
        {
            $coupon_logos=$_REQUEST['coupon_logos'];
            $img_coupon_logo=$files->upload_image("coupon_logo", $upload, $coupon_logos, $logo_width, $logo_height);
            if($img_coupon_logo=="Out of size")
            {
                echo IMAGE_SIZE;
                return ;
            }
            else if($img_coupon_logo=="error in type")
            {
                echo IMAGE_FORMAT;
                return ;
            }
            else
            {
                $coupon_logo=$img_coupon_logo;
            }
	        $sql="update coupon set "
	        . "coupon_title='$coupon_title',coupon_price='$coupon_price',"
            . "coupon_content='$coupon_content',coupon_logo='$coupon_logo',"
	        . "coupon_sort='$coupon_sort',coupon_show='$coupon_show',"
	        . "coupon_time='$coupon_time',coupon_end='$coupon_end' where coupon_id='$coupon_id'";
	        $rows=$db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断修改成功,否则失败
	        if($rows >= 1)
	        {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_COUPON."“".$coupon_title."”".IMPLEMENT_SUCCESS;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php?level=$coupon_level\";</script>";
	        }
	        else
	        {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_COUPON."“".$coupon_title."”".IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php?level=$coupon_level\";</script>";
	        }
        }
    }