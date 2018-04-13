<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    { 
        $menu_title=$_REQUEST['menu_title'];
        $menu_id=$_REQUEST['menu_id'];
        $menu_show=$menu_id==1?1:$_REQUEST['menu_show'];
        $menu_sort=$_REQUEST['menu_sort'];
    	if(empty($menu_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_NAV.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_TITLE;
        }
        else 
        {
	        $row=$db->query_list_id("select * from menu where menu_id=$menu_id");
            $sql = "update menu set menu_title='$menu_title',"
            . "menu_sort='$menu_sort',menu_show='$menu_show'"
            . " where menu_id='$menu_id'";
	        // 获取影响的行数
	        $rows = $db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	        if($rows >= 1)
	        {
	            ///////////
	            $Log_title=$_COOKIE['login'];
	            $Log_event=WORD_EDIT.WORD_NAV."“".$menu_title."”".IMPLEMENT_SUCCESS;
	            $db->edit_list("insert into log (log_name,log_event)"
	                    . "values('$Log_title','$Log_event')");
	            ////////////
	            echo "<script>alert('".EDIT_SUCCESS."');"
	            . "location.href=\"select.php\";</script>"; 
	        }
	        else
	        {
	            ///////////
	            $Log_title=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_NAV."“".$menu_title."”".IMPLEMENT_FAIL;
	            $db->edit_list("insert into log (log_name,log_event)"
	                    . "values('$Log_title','$Log_event')");
	            ////////////
	            echo "<script>alert('".EDIT_FAIL."');"
	            . "location.href=\"select.php\";</script>"; 
	        }
        }
    }