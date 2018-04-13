<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
	if(!empty($_REQUEST['id']))
	{ 
		$id = $_REQUEST['id'];
		////
        $row=$db->query_list_id(
                "select * from leaveword where leaveword_id='$id'");
        $eventname=$row['leaveword_name'];
        ////
		$sql = "delete from leaveword where leaveword_id='$id'";
		$rows=$db->edit_list($sql);
		if($rows >=1)
	    {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_DELETE."“".$eventname."”".WORD_MESSAGE.IMPLEMENT_SUCCESS;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
			echo "<script>alert('".DELETE_SUCCESS."');location.href=\"select.php\";</script>";
		}
		else
		{
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_DELETE."“".$eventname."”".WORD_MESSAGE.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
			echo "<script>alert('".DELETE_FAIL."');location.href=\"select.php\";</script>";
		}
	}