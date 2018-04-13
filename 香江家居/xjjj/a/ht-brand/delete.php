<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['id']))
    { 
        $id = $_REQUEST['id'];
        ////
        $row=$db->query_list_id("select * from brand where brand_id='$id'");
        $eventname=$row['brand_title'];
        $brand_image=$row['brand_image'];
        ////
        $sql = "delete from brand where brand_id='$id'";
        $rows=$db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >=1)
        {
            if(!empty($brand_image)&&file_exists("../../".$brand_image))
            {
                unlink("../../".$brand_image);
            }
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_DELETE.WORD_BRAND."“".$eventname."”".IMPLEMENT_SUCCESS;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".DELETE_SUCCESS."');"
            . "location.href=\"select.php\";</script>"; 
        }
        else
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_DELETE.WORD_BRAND."“".$eventname."”".IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
            . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".DELETE_FAIL."');"
            . "location.href=\"select.php\";</script>"; 
        }
    }