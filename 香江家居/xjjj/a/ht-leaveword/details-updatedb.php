<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
	if(!empty($_POST['btnEdit']))	
	{
		$leaveword_details_num=$_REQUEST['leaveword_details_num'];
		$sql = "update leaveword_details set leaveword_details_num='$leaveword_details_num' where leaveword_details_id='1'";
		// 获取影响的行数
		$rows = $db->edit_list($sql);
		// 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
		if($rows >= 1)
	    {
	        ///////////
	        $Log_name=$_COOKIE['login'];
	        $Log_event="修改留言版块页面信息成功";
	        $db->edit_list("insert into log (Log_name,Log_event)"
	                . "values('$Log_name','$Log_event')");
	        ////////////
			echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
		}
		else
		{
	        ///////////
	        $Log_name=$_COOKIE['login'];
	        $Log_event="修改留言版块页面信息失败";
	        $db->edit_list("insert into log (Log_name,Log_event)"
	                . "values('$Log_name','$Log_event')");
	        ////////////
			echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php\";</script>";
		}
	}