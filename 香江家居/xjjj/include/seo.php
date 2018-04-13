<?php
include_once 'include/allcommon.php';
if(empty($_REQUEST['tdhid']))
{
	$seo=$db->query_list_id("select * from menu where menu_id=$dhid");
}
else 
{
	$tdhid=$_REQUEST['tdhid'];
	$seo=$db->query_list_id("select * from menu where menu_id=$tdhid");
}
if(empty($seo['title']))
{
	$seo['title']=$company_row["company_name"];
}
if(empty($seo['keywords']))
{
	$seo['keywords']=$company_row["company_name"];
}
if(empty($seo['description']))
{
	$seo['description']=$company_row["company_name"];
}
?>
   	<title><?=$seo['title']?></title>
    <meta content="<?=$seo['keywords']?>" name="keywords" />
    <meta content="<?=$seo['description']?>" name="description" />
<?php
$script_rows=$db->query_lists("select * from script where script_level=1 ");
foreach($script_rows as $script_row)
{
    ?>
    <?=$script_row['script_content']?>
<?php
}
?>
<script type="text/JavaScript">
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        window.location.href = "/wap/"; //可以换成http地址
    }
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?437b8ead821bb897f5c680cfcffff50a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


	
