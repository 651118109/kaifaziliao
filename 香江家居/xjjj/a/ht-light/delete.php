<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['id']))
    { 
        $id = $_REQUEST['id'];
        ////
        $row=$db->query_list_id("select * from light where light_id='$id'");
        $eventname=$row['light_title'];
        $light_image=$row['light_image'];
        ////
        $sql = "delete from light where light_id='$id'";
        $rows=$db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >=1)
        {
            if(!empty($light_image)&&file_exists("../../".$light_image))
            {
                unlink("../../".$light_image);
            }
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_DELETE.WORD_LIGHT."“".$eventname."”".IMPLEMENT_SUCCESS;
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
            $Log_event=WORD_DELETE.WORD_LIGHT."“".$eventname."”".IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
            . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".DELETE_FAIL."');"
            . "location.href=\"select.php\";</script>"; 
        }
    }