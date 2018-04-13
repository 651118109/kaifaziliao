<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    { 
        $user_id=$_REQUEST['user_id'];
        $password=$_REQUEST['user_password'];
        $row=$db->query_list_id("select * from user where user_id=$user_id");
        ///////////查重//////
        if(empty($password))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_USER."“".$row['user_name']."”".WORD_PASSWORD.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".EDIT_FAIL."');"
                . "location.href=\"select.php\";</script>";
        }
        else
        {
            $user_add = "";
            for($i=0;$i<4;$i++)
            {
                $user_add .= '&#'.rand(19968, 40869).';';
            }
            $user_encryption = "";
            for($i=0;$i<4;$i++)
            {
                $user_encryption .= '&#'.rand(19968, 40869).';';
            }
            $user_password=$db->encryption($password,$user_add,$user_encryption);
            $sql = "update user set user_password='$user_password',user_add='$user_add',user_encryption='$user_encryption' where user_id='$user_id'";
        }
        // 获取影响的行数
        $rows = $db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >= 1)
        {
           ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_USER."“".$row['user_name']."”".WORD_PASSWORD.IMPLEMENT_SUCCESS;
            $db->edit_list("insert into log (Log_name,Log_event)"
                   . "values('$Log_name','$Log_event')");
           ////////////
            echo "<script>alert('".EDIT_SUCCESS."');"
            . "location.href=\"select.php\";</script>";
        }
        else
        {
           ///////////
           $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_USER."“".$row['user_name']."”".WORD_PASSWORD.IMPLEMENT_FAIL;
           $db->edit_list("insert into log (Log_name,Log_event)"
                   . "values('$Log_name','$Log_event')");
           ////////////
            echo "<script>alert('".EDIT_FAIL."');"
            . "location.href=\"select.php\";</script>";
        }
    }