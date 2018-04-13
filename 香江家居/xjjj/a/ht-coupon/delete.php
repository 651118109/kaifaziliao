<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
	if(!empty($_REQUEST['id']))
	{ 
		$id = $_REQUEST['id'];
        $level=$_REQUEST['level'];
		/////
		$row=$db->query_list_id("select * from coupon where coupon_id=$id");
		$eventname=$row['coupon_title'];
        $coupon_image=$row['coupon_image'];
		/////
		$sql = "delete from coupon where coupon_id='$id'";
		$rows=$db->edit_list($sql);
		if($rows >=1)
        {
            if(!empty($coupon_image)&&file_exists("../../".$coupon_image))
            {
                unlink("../../".$coupon_image);
            }
	        ///////////
			$Log_name=$_COOKIE['login'];
			$Log_event=WORD_DELETE.WORD_COUPON."“".$eventname."”".IMPLEMENT_SUCCESS;
			$db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
			////////////
			echo "<script>alert('".DELETE_SUCCESS."');location.href=\"select.php?level=$level\";</script>";
		}
		else
		{
			///////////
			$Log_name=$_COOKIE['login'];
			$Log_event=WORD_DELETE.WORD_COUPON."“".$eventname."”".IMPLEMENT_FAIL;
			$db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
			////////////
			echo "<script>alert('".DELETE_FAIL."');location.href=\"select.php?level=$level\";</script>";
		}
	}