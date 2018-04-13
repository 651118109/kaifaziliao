<?php
//包含文件
require_once 'Mysqldb.class.php';
require_once 'Uploadfiles.class.php';
require_once 'Routine.class.php';
//实例化Mysqldb类
$db=new Mysqldb();
$files=new Uploadfiles();
$routine=new Routine();
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
?>