<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(empty($_REQUEST['mm']))
    {  
	    echo DELETE_FAIL_MORE;
	    exit;  
    }
    else
    {
        $level=$_REQUEST['level'];
        $mm = $_REQUEST["mm"];
        $id =implode(",",$mm);
        $coupon_rows=$db->query_lists("select * from coupon where coupon_id in (".$id.")");
        $coupon_images=array();
        foreach($coupon_rows as $k=>$coupon_row)
        {
            if(!empty($coupon_row["coupon_image"]))
            {
                $coupon_images[$k]=$coupon_row["coupon_image"];
            }
        }
        $sql = "delete from coupon where coupon_id in(".$id.")";
        $rows = $db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >= 1)
        {
            foreach($coupon_images as $coupon_image)
            {
                if(file_exists("../../".$coupon_image))
                {
                    unlink("../../".$coupon_image);
                }
            }
	        ///////////
	        $Log_name=$_COOKIE['login'];
	        $Log_event=WORD_BATCH_DELETE.WORD_COUPON.IMPLEMENT_SUCCESS;
	        $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
	        ////////////
	        echo "<script>alert('".DELETE_SUCCESS."');location.href=\"select.php?level=$level\";</script>";
        }
        else
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_BATCH_DELETE.WORD_COUPON.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".DELETE_FAIL."');location.href=\"select.php?level=$level\";</script>";
        }
    }