<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    {
        $script_title=$_REQUEST['script_title'];
        $script_content=$_REQUEST['script_content'];
        $script_level=$_REQUEST['script_level'];
        $script_id=$_REQUEST['script_id'];
    	if(empty($script_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_MODIFY.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_TITLE;
        }
        else 
        {
	        $sql="update script set "
	        . "script_title='$script_title',script_content='$script_content',script_level='$script_level' where script_id='$script_id'";
	        $rows=$db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断修改成功,否则失败
	        if($rows >= 1)
	        {
	        ///////////
	        $Log_name=$_COOKIE['login'];
	        $Log_event=WORD_EDIT."“".$script_title."”".IMPLEMENT_SUCCESS;
	        $db->edit_list("insert into log (Log_name,Log_event)"
	                . "values('$Log_name','$Log_event')");
	        ////////////
	        echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
	        }
	        else
	        {
	        ///////////
	        $Log_name=$_COOKIE['login'];
	        $Log_event=WORD_MODIFY."“".$script_title."”".IMPLEMENT_FAIL;
	        $db->edit_list("insert into log (Log_name,Log_event)"
	                . "values('$Log_name','$Log_event')");
	        ////////////
	        echo "<script>alert('".EDIT_FAIL."');"
	        . "location.href=\"select.php\";</script>";
	        }
        }
    }