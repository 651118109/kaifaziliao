<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>权限管理</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/back.js"></script>
    <script type="text/javascript">
        function All(e, itemName)
		{
		var aa = document.getElementsByName(itemName);
		for (var i=0; i<aa.length; i++)
		   aa[i].checked = e.checked; //得到那个总控的复选框的选中状态
		}
		function Item(e, allName)
		{
			var all = document.getElementsByName(allName)[0];
			if(!e.checked) {
				all.checked = false;
			}else{
				var aa = document.getElementsByName(e.name);
				for (var i=0; i<aa.length; i++)
				 if(!aa[i].checked) return;
				all.checked = true;
			}
		}
    </script>
</head>
<body>
<?php
if(!empty($_REQUEST['id']))
{ 
    $power_id=$_REQUEST['id'];
    $sql = "select * from power where power_id='$power_id'";
    $powerrow =$db->query_list_id($sql);
    $arr = explode(",",$powerrow["power_content"]);
}
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="power_id" value="<?=$powerrow['power_id']?>" />
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="javascript:void(0);">首页</a></li>
            <li><a href="#">权限管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span>权限信息</span>
        </div>
        <ul class="forminfo">
            <li>
                <label>权限名称：</label>
                <input type="text" name="power_name" 
            value="<?=$powerrow['power_name']?>" id="power_name" class="dfinput" />
                <i>*必须填写</i>
            </li> 
            <li>
                <label>权限分配：</label>
                <i>*如果选择了子栏目，所对应的一级栏目也必须选择，否则视为无效</i>
<table class="tablelistq" width="60%" >
    <tr >
        <td colspan="2"  style="text-align:left; padding-left:3%;">
            <b><i>全选/取消</i></b>
            <input type="checkbox"  name="mmAll"
           <?=$powerrow['power_id']==1?"checked='checked' disabled='true'":""?>
            onclick="All(this, 'mm[]')">
        </td>
    </tr>
    <?php
    $sql="select * from backstage "
            . "where backstage_level=0 order by backstage_id asc";
    $rows=$db->query_lists($sql);
    foreach ($rows as $row){
    ?>
    <tr >
        <th style="text-align:left; padding-left:5%;" width="50%">
        <?=$row['backstage_title']?>
        </th>
        <th>
            <input type="checkbox"  name="mm[]"
           <?=$powerrow['power_id']==1?"checked='checked' disabled='true'":""?>       
             <?php 
            for ($i=0;$i<count($arr);$i++)
            {
                if($arr[$i]==$row['backstage_id'])
                {
                    echo "checked='checked'";
                }
            }
            ?>
            value="<?=$row['backstage_id']?>" onclick="Item(this, 'mmAll')">
        </th>
    </tr>
    <?php
            $level=$row['backstage_id'];
            $sql1="select * from  backstage "
                    . "where backstage_level=$level order by backstage_id asc";
            $errows=$db->query_lists($sql1);
            foreach ($errows as $errow){
    ?>
    <tr>
        <td style="text-align:left; padding-left:10%;">
            <img src="../images/clist.png" />
            &nbsp;&nbsp;<?=$errow['backstage_title']?>
        </td>
        <td>
            <input type="checkbox" name="mm[]"
           <?=$powerrow['power_id']==1?"checked='checked' disabled='true'":""?>
            <?php 
            for ($i=0;$i<count($arr);$i++)
            {
                if($arr[$i]==$errow['backstage_id'])
                {
                    echo "checked='checked'";
                }
            }     
             ?>
            value="<?=$errow['backstage_id']?>" 
            onclick="Item(this, 'mmAll')">
        </td>
    </tr>
            <?php }?>
    <?php }?>
</table>
            </li> 
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="btnEdit" id="btnAdd"  value="确认保存" class="btn" />
                <input type="button" name="btnSearch" id="btnSearch" onclick="fh()" value="返回" class="btn" />
            </li>
        </ul>
    </div>
</form>
</body>
</html>
