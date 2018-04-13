<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
	if(empty($_POST['mm']))
	{  
        echo DELETE_FAIL_MORE;
        exit;  
    }
    else
    {
		$mm = $_POST["mm"];
		$id =implode(",",$mm);
		$sql = "delete from leaveword where leaveword_id in(".$id.")";
		$rows = $db->edit_list($sql);
		// 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
		if($rows >= 1)
		{
	        ///////////
	        $Log_name=$_COOKIE['login'];
	        $Log_event=WORD_BATCH_DELETE.WORD_MESSAGE.IMPLEMENT_SUCCESS;
	        $db->edit_list("insert into log (Log_name,Log_event)"
	                . "values('$Log_name','$Log_event')");
	        ////////////
			echo "<script>alert('".DELETE_SUCCESS."');location.href=\"select.php\";</script>";
		}
		else
		{
	        ///////////
	        $Log_name=$_COOKIE['login'];
            $Log_event=WORD_BATCH_DELETE.WORD_MESSAGE.IMPLEMENT_FAIL;
	        $db->edit_list("insert into log (Log_name,Log_event)"
	                . "values('$Log_name','$Log_event')");
	        ////////////
			echo "<script>alert('".DELETE_FAIL."');location.href=\"select.php\";</script>";
		}
	}