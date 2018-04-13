<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_REQUEST['btnEdit']))
    {
        $product_title=$_REQUEST['product_title'];
        $product_price=$_REQUEST['product_price'];
        $product_sell=$_REQUEST['product_sell'];
//        $product_content=$_REQUEST['product_content'];
        $product_sort=$_REQUEST['product_sort'];
        $product_show=$_REQUEST['product_show'];
//        $product_time=empty($_REQUEST['product_time'])?date('y-m-d H:m',time()):$_REQUEST['product_time'];
        $product_end=empty($_REQUEST['product_end'])?date('y-m-d H:m',time()):$_REQUEST['product_end'];
        $product_id=$_REQUEST['product_id'];
        $product_level=$_REQUEST['product_level'];
    	if(empty($product_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_PRODUCT.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_TITLE;
        }
        else 
        {
            $product_logos=$_REQUEST['product_logos'];
            $img_product_logo=$files->upload_image("product_logo", $upload, $product_logos, $logo_width, $logo_height);
            if($img_product_logo=="Out of size")
            {
                echo IMAGE_SIZE;
                return ;
            }
            else if($img_product_logo=="error in type")
            {
                echo IMAGE_FORMAT;
                return ;
            }
            else
            {
                $product_logo=$img_product_logo;
            }
            $product_images=$_REQUEST['product_images'];
            $img_product=$files->upload_image("product_image", $upload, $product_images, $image_width, $image_height);
            if($img_product=="Out of size")
            {
                echo IMAGE_SIZE;
                return ;
            }
            else if($img_product=="error in type")
            {
                echo IMAGE_FORMAT;
                return ;
            }
            else
            {
                $product_image=$img_product;
            }
	        $sql="update product set "
	        . "product_title='$product_title',product_price='$product_price',product_sell='$product_sell',"
            . "product_image='$product_image',product_logo='$product_logo',"
	        . "product_sort='$product_sort',product_show='$product_show',"
	        . "product_end='$product_end' where product_id='$product_id'";
	        $rows=$db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断修改成功,否则失败
	        if($rows >= 1)
	        {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_PRODUCT."“".$product_title."”".IMPLEMENT_SUCCESS;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php?level=$product_level\";</script>";
	        }
	        else
	        {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_PRODUCT."“".$product_title."”".IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php?level=$product_level\";</script>";
	        }
        }
    }