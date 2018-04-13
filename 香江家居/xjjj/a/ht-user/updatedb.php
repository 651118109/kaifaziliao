<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    { 
        $user_id=$_REQUEST['user_id']; 
        $user_name=$_REQUEST['user_name']; 
        $password=$_REQUEST['user_password'];
        $user_power=$_REQUEST['user_power'];
        if(empty($user_name))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_USER.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_USER_NAME;
        }
        else
        {
	        ///////////查重//////
	        $cfsql="select * from user where user_name='$user_name' and user_id!=$user_id";
	        $chongfu=$db->query_list_id($cfsql);
	        if($chongfu)
	        {
	        ///////////
                $row=$db->query_list_id("select * from user where user_id=$user_id");
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_USER."“".$row["user_name"]."”".IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo EDIT_FAIL_USER_REPEAT;
	        }
	        else
	        {
                if(empty($password))
                {
                    $sql = "update user set user_name='$user_name',user_power='$user_power' where user_id='$user_id'";
                }
                else
                {
                    $user_add = "";
                    for($i=0;$i<4;$i++)
                    {
                        $user_add .= '&#'.rand(19968, 40869).';';
                    }
                    $user_encryption = "";
                    for($i=0;$i<4;$i++)
                    {
                        $user_encryption .= '&#'.rand(19968, 40869).';';
                    }
                    $user_password=$db->encryption($password,$user_add,$user_encryption);
                    $sql = "update user set user_name='$user_name',user_password='$user_password',user_add='$user_add',user_encryption='$user_encryption',user_power='$user_power' where user_id='$user_id'";
                }
	            // 获取影响的行数
	            $rows = $db->edit_list($sql);
	            // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	            if($rows >= 1)
	            {
	               ///////////
	               $Log_name=$_COOKIE['login'];
	               $Log_event=WORD_EDIT.WORD_USER."“".$user_name."”".IMPLEMENT_SUCCESS;
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
                    $Log_event=WORD_EDIT.WORD_USER."“".$user_name."”".IMPLEMENT_FAIL;
	               $db->edit_list("insert into log (Log_name,Log_event)"
	                       . "values('$Log_name','$Log_event')");
	               ////////////
	                echo "<script>alert('".EDIT_FAIL."');"
	                . "location.href=\"select.php\";</script>"; 
	            }
	        }
        }
    }