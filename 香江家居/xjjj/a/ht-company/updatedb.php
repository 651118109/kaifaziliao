<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
	if(!empty($_POST['btnEdit']))
	{ 
		$company_name =$_REQUEST['company_name'];
//		$company_qq =$_REQUEST['company_qq'];
        $company_tel =$_REQUEST['company_tel'];
		$company_address =$_REQUEST['company_address'];
//		$company_map =$_REQUEST['company_map'];
//		$arry=  explode(",", $company_map);
//		$company_x =$arry[0];
//		$company_y =$arry[1];
		$company_traffic=$_REQUEST['company_traffic'];
        $company_about=$_REQUEST['company_about'];
		$company_copyright =$_REQUEST['company_copyright'];
		$company_record =$_REQUEST['company_record'];
		if(empty($company_name))
        {
            ///////////
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_COMPANY_NAME.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
            ////////////
        	echo EDIT_FAIL_COMPANY_NAME;
        }
        else 
        {
            $company_logos=$_REQUEST['company_logos'];
            $img=$files->upload_image("company_logo", "upload/company/",$company_logos);
            if($img=="Out of size")
            {
                echo IMAGE_SIZE;
                return ;
            }
            else if($img=="error in type")
            {
                echo IMAGE_FORMAT;
                return ;
            }
            else
            {
                $company_logo=$img;
            }
//			$sql = "update company set "
//			. "company_name='$company_name',company_qq='$company_qq',company_tel='$company_tel',"
//			. "company_address='$company_address',company_map='$company_map',"
//			. "company_x='$company_x',company_y='$company_y',"
//			. "company_copyright='$company_copyright',company_traffic='$company_traffic',"
//			. "company_record='$company_record',company_logo='$company_logo'"
//			. "where company_id=1";
            $sql = "update company set "
                . "company_name='$company_name',company_tel='$company_tel',"
                . "company_address='$company_address',company_about='$company_about',"
                . "company_copyright='$company_copyright',company_traffic='$company_traffic',"
                . "company_record='$company_record',company_logo='$company_logo'"
                . "where company_id=1";
			// 获取影响的行数
			$rows = $db->edit_list($sql);
			// 返回影响行数  如果影响行数>=1,则判断添加成功,否则失败
			if($rows >= 1)
			{
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_COMPANY_NAME.IMPLEMENT_SUCCESS;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_SUCCESS."');location.href=\"update.php\";</script>";
			}
			else
			{
                ///////////
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_COMPANY_NAME.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)"
                        . "values('$Log_name','$Log_event')");
                ////////////
                echo "<script>alert('".EDIT_FAIL."');location.href=\"update.php\";</script>";
			}
        }
	}