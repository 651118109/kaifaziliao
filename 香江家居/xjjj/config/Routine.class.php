<?php
/**
 * 专门用于操作数据库的类
 * @author LAOYANG
 *
 */
//引入常量配置文件
require_once 'config.php';

class Routine
{
    /**
     *
     * 去html标签并截取字符串
     * @param  $str:需要操作的字符串
     * @param  $count:限制的长度
     */
    public  function  restrict( $str, $count)
    {
       return mb_strlen(strip_tags(str_replace("&nbsp;","",$str)),ENCODE)>$count?mb_substr(strip_tags(str_replace("&nbsp;","",$str)),0,$count-2,ENCODE)."……":strip_tags(str_replace("&nbsp;","",$str));
    }
    /**
     *
     * 提取字符串中的图片
     * @param  $str:需要操作的字符串
     */
    public  function  getimage( $str)
    {
       	$match = array();
		preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', stripcslashes($str), $match); 
//		print_r($match); //这个打印数组里的 第2个元素 也就是 $match[1] 就是你要的
//		print_r($match[1]);
		return $match[1];
    }
}
?>