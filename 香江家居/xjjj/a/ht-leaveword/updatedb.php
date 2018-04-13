<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
	$id=$_REQUEST['id'];
	////
    $row=$db->query_list_id(
      "select * from leaveword where leaveword_id='$id'");
    $eventname=$row['leaveword_name'];
    ////
	$sql = "update leaveword set leaveword_read='1' where leaveword_id='$id'";
	// 获取影响的行数
	$rows = $db->edit_list($sql);
	// 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	if($rows >= 1)
    {
        ///////////
        $Log_name=$_COOKIE['login'];
        $Log_event=WORD_VIEWED."“".$eventname."”".WORD_MESSAGE;
        $db->edit_list("insert into log (Log_name,Log_event)"
                . "values('$Log_name','$Log_event')");
        ////////////
		echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
	}
	else
	{
		echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php\";</script>";
	}