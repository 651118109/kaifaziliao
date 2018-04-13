<?php
/**
 * 放所有数据操作需要用到的一些参数
 * 使用常量来存放这些可能会发生改变的参数
 * 常量 -> 不会被改变的量
 * 常量名默认都是大写
 * DEFINE("常量名","常量值");
 */

//主机地址
define("HOST", "localhost");
//数据库的用户名
define("USR", "root");
//数据库的密码
define("PWD","isart");
//数据库的名字
define("DBNAME","syxjhome");
//字符集编码
define("ENCODE","utf8");


////////通用///////////
//图片大小提示框
define("IMAGE_SIZE","<script>alert('为了保证您的网站正常运行，"
        . "请选择上传小于2M的图片');history.go(-1);</script>");
//图片格式提示框
define("IMAGE_FORMAT","<script>alert('请选择上传jpg，"
        . "png，gif格式的图片');history.go(-1);</script>");
//视频格式提示框
define("VIDEO_FORMAT","<script>alert('请选择上传MP4格式的视频');"
        . "history.go(-1);</script>");

//登录过期或已清除
define("RELOGIN","<script>alert('您的登录密码已被清理或已经过期，请您再次输入');"
    . "top.location.href='../Login.php';</script>");
//权限不够
define("RESTRICTION","<script>alert('您的权限不够，无法访问此页面');"
    . "top.location.href=\"../Login.php\";</script>");
//此模块没有二级模块，请到“网站模块管理”进行添加
define("MODULE_SWITCH","<script>alert('此模块没有二级模块，请到“网站模块管理”进行添加');"
    . "location.href=\"../ht-menu/select.php\";</script>");

//条件判断
//编辑-标题不能为空
define("EDIT_FAIL_TITLE","<script>alert('编辑失败,标题不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//添加-标题不能为空
define("ADD_FAIL_TITLE","<script>alert('添加失败,标题不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//添加-请上传图片
define("ADD_FAIL_IMAGE","<script>alert('添加失败,请上传图片');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//添加-请上传模块图片
define("ADD_FAIL_MODULAR_IMAGE","<script>alert('添加失败,请上传模块图片');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//批量删除-必须选择一个,才可以删除!
define("DELETE_FAIL_MORE","<script>alert('必须选择一个,才可以删除!');location.href=\"javascript:history.go(-1)\";</script>");


define("DELETE_SUCCESS","删除成功");//删除成功
define("DELETE_FAIL","删除失败");//删除失败
define("ADD_SUCCESS","添加成功");//添加成功
define("ADD_FAIL","添加失败");//添加失败
define("EDIT_SUCCESS","编辑成功");//编辑成功
define("EDIT_FAIL","编辑失败");//编辑失败
define("WORD_DELETE","删除");//删除
define("WORD_BATCH_DELETE","批量删除");//批量删除
define("WORD_ADD","添加");//添加
define("WORD_EDIT","编辑");//编辑
define("WORD_MENU","的模块");//模块
define("WORD_LIST","的列表");//列表
define("WORD_DETAIL","的信息");//信息
define("WORD_IMAGE","图片");//图片
define("WORD_BACKSTAGE","后台导航");//后台导航
define("WORD_NAV","导航");//导航
define("WORD_SEO","的SEO");//SEO
define("WORD_PASSWORD","的密码");//密码
define("IMPLEMENT_SUCCESS","成功");//执行成功
define("IMPLEMENT_FAIL","失败");//执行失败

//管理员管理
//添加-用户名不能为空
define("ADD_FAIL_USER_NAME","<script>alert('添加失败,用户名不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//添加-密码不能为空
define("ADD_FAIL_USER_PASSWORD","<script>alert('添加失败,密码不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//添加-用户名不能重复
define("ADD_FAIL_USER_REPEAT","<script>alert('添加失败,用户名不能重复');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//编辑-用户名不能为空
define("EDIT_FAIL_USER_NAME","<script>alert('编辑失败,用户名不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//编辑-密码不能为空
define("EDIT_FAIL_USER_PASSWORD","<script>alert('编辑失败,密码不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//编辑-用户名不能重复
define("EDIT_FAIL_USER_REPEAT","<script>alert('编辑失败,用户名不能重复');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
define("WORD_USER","管理员");//管理员

//权限管理
//添加-权限名称不能为空
define("ADD_FAIL_POWER_NAME","<script>alert('添加失败,权限名称不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//添加-权限分类名称不能重复
define("ADD_FAIL_POWER_REPEAT","<script>alert('添加失败,权限分类名称不能重复');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//编辑-权限名称不能为空
define("EDIT_FAIL_POWER_NAME","<script>alert('编辑失败,权限名称不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
//编辑-权限分类名称不能重复
define("EDIT_FAIL_POWER_REPEAT","<script>alert('编辑失败,权限分类名称不能重复');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
define("WORD_POWER","权限");//权限

//网站基本信息模块
//编辑-公司名称不能为空
define("EDIT_FAIL_COMPANY_NAME","<script>alert('编辑失败,公司名称不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
define("WORD_COMPANY_NAME","网站基本信息");//网站基本信息

//图片管理
//编辑-标题不能为空
define("EDIT_AD_ADVERTISING","<script>alert('添加失败,图片位不能为空');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
define("WORD_AD","图片");//图片

//模块安装管理
define("WORD_INSTALL","安装模块");//安装模块
define("WORD_UNINSTALL","卸载模块");//卸载模块
define("WORD_MODIFY","修改模块");//修改模块

//留言
define("WORD_MESSAGE","留言");//留言
define("WORD_VIEWED","查看了");//查看了

//分会场
define("WORD_BRANCH","分会场");//分会场

//产品管理
define("WORD_PRODUCT","产品");//产品

//优惠券
define("WORD_COUPON","优惠券");//优惠券

//品牌活动
define("WORD_BRAND","品牌活动");//品牌活动

//活动亮点
//添加-请上传图片
define("ADD_LIGHT_IMAGE","<script>alert('添加失败,请上传图片');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
define("WORD_LIGHT","活动亮点");//活动亮点

//现场热图
//添加-请上传图片
define("ADD_SCENE_IMAGE","<script>alert('添加失败,请上传图片');"
    . "location.href=\"javascript:history.go(-1)\";</script>");
define("WORD_SCENE","现场热图");//现场热图

define("BRANCH_MAIN","主会场");//主会场
define("FREE_TICKET","免费索票");//免费索票