<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    { 
        $menu_id=$_REQUEST['menu_id'];		
        $title=$_REQUEST['title'];
        $keywords=$_REQUEST['keywords'];
        $description=$_REQUEST['description'];
        $row=$db->query_list_id("select * from menu where menu_id=$menu_id");
        $sql = "update menu set title='$title',keywords='$keywords',"
                . "description='$description' where menu_id='$menu_id'";
        // 获取影响的行数
        $rows = $db->edit_list($sql);
        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
        if($rows >= 1)
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT."“".$row["menu_title"]."”".WORD_SEO.IMPLEMENT_SUCCESS;
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
            $Log_event=WORD_EDIT."“".$row["menu_title"]."”".WORD_SEO.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
            echo "<script>alert('".EDIT_FAIL."');"
            . "location.href=\"select.php\";</script>"; 
        }
    }