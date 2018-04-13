<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['id']))
    { 
        $id = $_REQUEST['id'];
        ////
        $row=$db->query_list_id("select * from scene where scene_id='$id'");
        $eventname=$row['scene_title'];
        $scene_image=$row['scene_image'];
        ////
        $sql = "delete from scene where scene_id='$id'";
        $rows=$db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >=1)
        {
            if(!empty($scene_image)&&file_exists("../../".$scene_image))
            {
                unlink("../../".$scene_image);
            }
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_DELETE.WORD_SCENE."“".$eventname."”".IMPLEMENT_SUCCESS;
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
            $Log_event=WORD_DELETE.WORD_SCENE."“".$eventname."”".IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
            . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".DELETE_FAIL."');"
            . "location.href=\"select.php\";</script>"; 
        }
    }