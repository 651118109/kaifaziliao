<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnAdd']))
    {
        $menu_title=$_REQUEST['menu_title'];
        $menu_show=1;
        $menu_level=$_REQUEST['menu_level'];
        $menu_sort=$_REQUEST['menu_sort'];
        $title=$_REQUEST['menu_title'];
        $keywords=$_REQUEST['menu_title'];
        $description=$_REQUEST['menu_title'];
    	if(empty($menu_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_ADD.WORD_NAV.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo ADD_FAIL_TITLE;
        }
        else 
        {
            $sql="insert into menu"
            . "(menu_title,menu_show,menu_level,menu_sort,"
            . "title,keywords,description) "
            . "value ('$menu_title','$menu_show','$menu_level','$menu_sort',"
            . "'$title','$keywords','$description')" ;
	        $rows=$db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	        if($rows >= 1)
	        {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_NAV."“".$menu_title."”".IMPLEMENT_SUCCESS;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".ADD_SUCCESS."');location.href=\"select.php\";</script>";
	        }
	        else
	        {
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_ADD.WORD_NAV."“".$menu_title."”".IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".ADD_FAIL."');"
                . "location.href=\"select.php\";</script>";
	        }
        }
    }