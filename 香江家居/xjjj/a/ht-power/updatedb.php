<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
    if(!empty($_REQUEST['btnEdit']))
    {
        $power_id=$_REQUEST['power_id'];
        $power_name=$_REQUEST['power_name'];
        if(empty($power_name))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_POWER.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)"
                    . "values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_POWER_NAME;
        }
        else 
        {
	        ///////////查重///////////
	        $cfsql="select * from power "
	                . "where power_name='$power_name' and power_id!=$power_id";
	        $chongfu=$db->query_list_id($cfsql);
	        if($chongfu)
	        {
	            ///////////
	            $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_POWER.IMPLEMENT_FAIL;
	            $db->edit_list("insert into log (Log_name,Log_event)"
	                    . "values('$Log_name','$Log_event')");
	            ////////////
	            echo EDIT_FAIL_POWER_REPEAT;
	        }
	        else
	        {
	            if($power_id==1)
	            {
	                $backstagerows=$db->query_lists("select * from backstage");
	                $arry = array();
	                foreach ($backstagerows as $k=>$backstagerow)
	                {
	                    $arry[$k]=$backstagerow["backstage_id"];
	                }
	                $power_content =implode(",",$arry);
	            }
	            else 
	            {
	                if(empty($_REQUEST['mm']))
	                {
	                    $power_content="";
	                }
	                else
	                {
	                    $mm = $_REQUEST["mm"];
	                    $power_content =implode(",",$mm);
	                }
	            }
	            $sql="update power set power_name='$power_name',"
	                  . "power_content='$power_content' where power_id=$power_id " ;
	            $rows=$db->edit_list($sql);
	            // 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
	            if($rows >= 1)
	            {
	                ///////////
	               $Log_name=$_COOKIE['login'];
	               $Log_event=WORD_EDIT.WORD_POWER."“".$power_name."”".IMPLEMENT_SUCCESS;
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
                    $Log_event=WORD_EDIT.WORD_POWER.IMPLEMENT_FAIL;
	                $db->edit_list("insert into log (Log_name,Log_event)"
	                        . "values('$Log_name','$Log_event')");
	                ////////////
	                echo "<script>alert('".EDIT_FAIL."');"
	                . "location.href=\"select.php\";</script>"; 
	            }
	        }
        }
    }