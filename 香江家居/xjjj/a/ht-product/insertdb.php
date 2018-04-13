<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_REQUEST['btnAdd']))
    {
        $product_title=$_REQUEST['product_title'];
        $product_price=$_REQUEST['product_price'];
        $product_sell=$_REQUEST['product_sell'];
//        $product_content=$_REQUEST['product_content'];
        $product_sort=$_REQUEST['product_sort'];
        $product_show=$_REQUEST['product_show'];
        $product_level=$_REQUEST['product_level'];
//        $product_time=empty($_REQUEST['product_time'])?date('y-m-d H:m',time()):$_REQUEST['product_time'];
        $product_end=empty($_REQUEST['product_end'])?date('y-m-d H:m',time()):$_REQUEST['product_end'];
    	if(empty($product_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_ADD.WORD_PRODUCT.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo ADD_FAIL_TITLE;
        }
        else
        {
            $img_product_logo=$files->upload_image("product_logo", $upload, "", $logo_width, $logo_height);
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
            if(empty($product_logo))
            {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_PRODUCT.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
                ////////////
                echo ADD_FAIL_IMAGE;
            }
            else
            {
                $img_product=$files->upload_image("product_image", $upload, "", $image_width, $image_height);
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
                if(empty($product_image))
                {
                    ///////////
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_ADD.WORD_PRODUCT.IMPLEMENT_FAIL;
                    $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                    ////////////
                    echo ADD_FAIL_IMAGE;
                }
                else
                {
                    $sql="insert into product"
                        . "(product_title,product_image,product_logo,product_price,product_sort,product_show,"
                        . "product_end,product_sell,product_level) "
                        . "value ('$product_title','$product_image','$product_logo','$product_price','$product_sort',"
                        . "'$product_show','$product_end','$product_sell','$product_level')" ;
                    $rows=$db->edit_list($sql);
                    // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
                    if($rows >= 1)
                    {
                        ///////////
                        $Log_name=$_COOKIE['login'];
                        $Log_event=WORD_ADD.WORD_PRODUCT."“".$product_title."”".IMPLEMENT_SUCCESS;
                        $db->edit_list("insert into log (Log_name,Log_event)"
                            . "values('$Log_name','$Log_event')");
                        ////////////
                        echo "<script>alert('".ADD_SUCCESS."');location.href=\"select.php?level=$product_level\";</script>";
                    }
                    else
                    {
                        ///////////
                        $Log_name=$_COOKIE['login'];
                        $Log_event=WORD_ADD.WORD_PRODUCT.IMPLEMENT_FAIL;
                        $db->edit_list("insert into log (Log_name,Log_event)"
                            . "values('$Log_name','$Log_event')");
                        ////////////
                        echo "<script>alert('".ADD_FAIL."');"
                            . "location.href=\"select.php?level=$product_level\";</script>";
                    }
                }
            }
        }
    }