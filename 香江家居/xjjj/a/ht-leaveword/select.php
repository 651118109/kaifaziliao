<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
?>
<!DOCTYPE html PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>留言管理</title>
<link type="text/css" rel="stylesheet" href="../css/pager.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
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
<link type="text/css" rel="stylesheet" href="../css/jsmanage.css" />
</head>
<body>
<div class="rightinfo" style="border-top:10px solid red;">
    <form action="details-updatedb.php" method="post">
            <?php $leaveword_detials_row=$db->query_list_id("select * from leaveword_details where leaveword_details_id=1");?>
        已有<input type="text" name="leaveword_details_num" id="leaveword_details_num"
                           class="dfinput" style="width:200px;" value="<?=$leaveword_detials_row['leaveword_details_num']?>" />人报名
        <input type="submit" name="btnEdit" id="btnEdit" value="确认保存" class="btn" />
    </form>
</div>
<div class="rightinfo" style="border-top:10px solid red;">
 	<div class="tools" style="float:left; width:49%; margin-top:10px;">
		<form action="#" method="post">
            <div class="ss_kuang">
                <p>查找：</p>
			<input type="text" name="Searchname" id="Searchname" class="ss_wk" />
                <div class="ss_tu">
				<input type="submit" value="搜索" class="btn" > 
                </div>
            </div>
		</form>
	</div>
	<form action="deletepl.php" method="post">	      
	<div class="tools" style="float:right; width:49%">
            <ul class="float">
                <li style="float:left; padding-right:0px;">
					<input name="Submit" type="submit" value="删除选中" class="btn" />
                </li>
            </ul>
    </div>
	<?php 
	$Searchname=empty($_REQUEST['Searchname'])?'':$_REQUEST['Searchname'];
	$sql="select * from leaveword where leaveword_name like '%$Searchname%' order by leaveword_id desc";
	$rows=$db->query_lists($sql);
	?>
    <table class="tablelist" >
        <thead>
        <tr>
            <th width="5%"><input type="checkbox"  name="mmAll" onclick="All(this, 'mm[]')"></th>
            <th width="10%">姓名</th>
            <th width="10%">电话</th>
            <th width="10%">留言时间</th>
            <th width="10%">来源</th>
            <th width="10%">是否查看</th>
            <th width="10%">删除</th>
        </tr>
        </thead>
        <tbody>
            <?php
        foreach ($rows as $row){
        ?>
        <tr >
            <td><input type="checkbox" name="mm[]" value="<?=$row['leaveword_id']?>" onclick="Item(this, 'mmAll')"></td>
            <td><?=$row['leaveword_name']?></td>
            <td><?=$row['leaveword_tel']?></td>
            <td><?=$row['leaveword_time']?></td>
            <td><?=$row['leaveword_source']?></td>
            <td>
            <?php if($row['leaveword_read']==1)
            {echo "已查看";}
            else{ echo "未查看";
            ?>
            <a href="updatedb.php?id=<?=$row['leaveword_id']?>"><img src="../images/t02.png" ></a>
            <?php }?>
            </td>
            <td><a href="delete.php?id=<?=$row['leaveword_id']?>"><img src="../images/t03.png" ></a></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
</form>
</div>
</body>
</html>




