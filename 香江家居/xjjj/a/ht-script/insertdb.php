<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnAdd']))
    {
        $script_title=$_REQUEST['script_title'];
        $script_content=$_REQUEST['script_content'];
        $script_level=$_REQUEST['script_level'];
    	if(empty($script_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_INSTALL.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo ADD_FAIL_TITLE;
        }
        else 
        {
	        $sql="insert into script"
	        . "(script_title,script_content,script_level) "
	        . "value ('$script_title','$script_content','$script_level')" ;
	        $rows=$db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	        if($rows >= 1)
	        {
		        ///////////
		        $Log_name=$_COOKIE['login'];
		        $Log_event=WORD_INSTALL."“".$script_title."”".IMPLEMENT_SUCCESS;
		        $db->edit_list("insert into log (Log_name,Log_event)"
		                . "values('$Log_name','$Log_event')");
		        ////////////
		        echo "<script>alert('".ADD_SUCCESS."');location.href=\"select.php\";</script>";
	        }
	        else
	        {
		        ///////////
		        $Log_name=$_COOKIE['login'];
		        $Log_event=WORD_INSTALL.IMPLEMENT_FAIL;
		        $db->edit_list("insert into log (Log_name,Log_event)"
		                . "values('$Log_name','$Log_event')");
		        ////////////
		        echo "<script>alert('".ADD_FAIL."');"
		        . "location.href=\"select.php\";</script>";
	        }
        }
    }