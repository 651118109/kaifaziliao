<?php
header("Content-Type: text/html;charset=utf-8");
require ("config/conn.php");//引入链接数据库
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
else
{
    if(!empty($_REQUEST['btnLoginOn']))
    {
        $user_name = addslashes($_REQUEST['user_name']);
        if (!$user_name)
        {
            echo "<script>alert('登录名称不能为空');"
            . "location.href=\"Login.php\";</script>"; 
            exit;
        }
        $user_password = addslashes($_REQUEST['user_password']);
        if (!$user_password)
        {
            echo "<script>alert('登录密码不能为空');"
            . "location.href=\"Login.php\";</script>"; 
            exit;
        }
        $sql="select * from user where user_name ='".$user_name."';" ;
        //echo $sql; 
        $row =$db->query_list_id($sql);
        if($row)  
        {  
              //将数据以索引方式储存在数组中
              $Verification=$db->encryption($user_password,$row['user_add'],$row['user_encryption']);
              if($row['user_password']!=$Verification)
              {
                  echo "<script>alert('登录失败,用户名或者密码输入有误');location.href=\"Login.php\";</script>";
                  exit;
              }
              //echo $row[0];
              setcookie('login',$row['user_name']);
              setcookie('roid',$row['user_power']);
              setcookie('uid',$row['user_id']);
              ///////////
              $Log_name=$user_name;
              $Log_event="登录成功";
              $db->edit_list("insert into log (Log_name,Log_event)"
                      . "values('$Log_name','$Log_event')");
              ////////////
              $db->edit_list(
                      "delete from log where datediff(curdate(), Log_time)>=10");
              echo "<script>alert('登录成功');"
              . "location.href=\"frame/main.php\";</script>";
        }  
        else  
        {  
                echo "<script>alert('登录失败,用户名或者密码输入有误');"
            . "location.href=\"Login.php\";</script>"; 
        }
    }
}
?> 