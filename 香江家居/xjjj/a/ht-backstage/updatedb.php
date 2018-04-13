<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    { 
        $backstage_id=$_REQUEST['backstage_id'];
        $backstage_title=$_REQUEST['backstage_title'];
    	if(empty($backstage_title))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_BACKSTAGE.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_TITLE;
        }
        else 
        {
	        $sql = "update backstage set backstage_title='$backstage_title' "
	                . "where backstage_id='$backstage_id'";
	       
	        // 获取影响的行数
	        $rows =  $db->edit_list($sql);
	        // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	        if($rows >= 1)
	        {
	            ///////////
	            $Log_name=$_COOKIE['login'];
	            $Log_event=WORD_EDIT.WORD_BACKSTAGE."“".$backstage_title."”".IMPLEMENT_SUCCESS;
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
	            $Log_event=WORD_EDIT.WORD_BACKSTAGE."“".$backstage_title."”".IMPLEMENT_FAIL;
	            $db->edit_list("insert into log (Log_name,Log_event)"
	                    . "values('$Log_name','$Log_event')");
	            ////////////
	            echo "<script>alert('".EDIT_FAIL."');"
	            . "location.href=\"select.php\";</script>"; 
	        }
        }
    }