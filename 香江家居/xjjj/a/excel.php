<?php
header("Content-Type: text/html;charset=utf-8");
require ("./config/conn.php");//引入链接数据库
//引入PHPExcel库文件（路径根据自己情况）
include './phpexcel/Classes/PHPExcel.php';
//创建对象
$excel = new PHPExcel();
//Excel表格式,这里简略写了8列
$letter = array('A','B','C','D','E','F','F','G');
//表头数组
$tableheader = array('编号','标题','图片','排序');
//填充表头信息
for($i = 0;$i < count($tableheader);$i++) {
    $excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
}
//表格数组
$rows=$db->query_lists("select cases_id,cases_title,cases_image,cases_sort from cases ");

$data=array();
foreach($rows as $k=>$row)
{
    $data[$k]=array($row['cases_id'],$row['cases_title'],$row['cases_image'],$row['cases_sort']);
}
//var_dump($data);
//填充表格信息
for ($i = 2;$i <= count($data) + 1;$i++) {
    $j = 0;
    foreach ($data[$i - 2] as $key=>$value) {
        $excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
        $j++;
    }
}
//创建Excel输入对象
$write = new PHPExcel_Writer_Excel5($excel);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="testdata.xls"');
header("Content-Transfer-Encoding:binary");
$write->save('php://output');
?>