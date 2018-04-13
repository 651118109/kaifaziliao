<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    {
        $color_id=$_REQUEST['color_id'];
        $color_content=$_REQUEST['color_content'];
        $sql = "update color set color_content='$color_content' where color_id='$color_id'";
        $rows = $db->edit_list($sql);
        $color_row=$db->query_list_id("select color_title from color where color_id=$color_id");
        if($rows >= 1)
        {
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT."“".$color_row["color_title"]."”".IMPLEMENT_SUCCESS;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
            echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
        }
        else
        {
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT."“".$color_row["color_title"]."”".IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
            echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php\";</script>";
        }
    }