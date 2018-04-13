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
<title>基本信息管理</title>
    <script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
<!--    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7GGWAsCn6aPGSc4h83fT8A80sklQQRke"></script>-->
    <link href="../css/preview-pictures.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/preview-pictures.js"></script>
    <script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="../ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        var editor = new UE.ui.Editor();
        editor.render("company_traffic");
        var editor_about = new UE.ui.Editor();
        editor_about.render("company_about");
    </script>
</head>
<body>
<?php
$sql = "select * from company where company_id=1";
$row =$db->query_list_id($sql);
?>
<form action="updatedb.php" method="post" enctype="multipart/form-data">
<div class="formbody">
    <div class="formtitle">
        <span>基本信息</span>
    </div>
    <ul class="forminfo">
        <li>
            <label>LOGO：</label>
            <input type="file" name="company_logo" id="company_logo" onchange="preview(this,'preview_logo')" />
            <i>*273*43</i><br />
            <img src="../../<?=$row['company_logo']?>" width="273px" height="43px"  />
            <input type="hidden" name="company_logos" id="company_logo" value="<?=$row['company_logo']?>" />
            <div id="preview_logo">预览区</div>
        </li>
        <li>
            <label>公司名称：</label>
            <input type="text" name="company_name" id="company_name" class="dfinput" value="<?=$row['company_name']?>" />
            <i>*必须填写</i>
        </li>
<!--        <li>-->
<!--            <label>客服QQ：</label>-->
<!--            <input type="text" name="company_qq" id="company_qq" class="dfinput" value="--><?//=$row['company_qq']?><!--" />-->
<!--        </li>-->
        <li>
            <label>服务热线：</label>
            <input type="text" name="company_tel" id="company_tel" class="dfinput" value="<?=$row['company_tel']?>" />
        </li>
        <li>
            <label>地址：</label>
            <input type="text" name="company_address" id="company_address" class="dfinput" value="<?=$row['company_address']?>" />
        </li>
<!--        <li>-->
<!--            <label>重新获取经纬度：</label>-->
<!--        <input id="company_map" name="company_map" class="ss_wk" value="--><?//=$row['company_map']?><!--" type="text" style="width:289px;"  />-->
<!---->
<!--     <input type="button" value="重新获取并查看地图" onclick="searchByStationName();" name="btnSearch" id="btnSearch" class="btn"/>-->
<!--        <br /><label>&nbsp;</label>-->
<!--            <i>*1、如果地址中的地理位置发生了改变，需重新获取经纬度；-->
<!--        2、如获取的经纬度不正确，请手动校准</i>-->
<!--        </li>-->
<!--        <li>-->
<!--            <label>手动校验：</label>-->
<!--          -->
<!--            经度：-->
<!--    <input id="company_x" name="company_x" class="dfinput" style="width:100px" value="--><?//=$row['company_x']?><!--" type="text"/>-->
<!--   -->
<!--    纬度：-->
<!--    <input id="company_y" name="company_y" class="dfinput" style="width:100px" value="--><?//=$row['company_y']?><!--" type="text"/>-->
<!--    <input type="button" value="手动校验并查看地图" onclick="startmap();" name="btnSearch" id="btnSearch" class="btn"/>-->
<!--        </li>-->
<!--        <li>-->
<!--            <label>参考地图：</label>-->
<!--        <div id="map" style="-->
<!--                margin-top:30px;-->
<!--                width: 700px;-->
<!--                height: 300px;-->
<!--                top: 50px;-->
<!--                border: 1px solid gray;-->
<!--                overflow:hidden;-->
<!--                display:block;">-->
<!--        </div>-->
<!--            <label>&nbsp;</label>-->
<!--            <i>*该地图仅供参考，如获取的经纬度不正确，请手动校准</i>-->
<!--        </li>-->
<!--<script>-->
<!--var address=document.getElementById("company_address").value;-->
<!--var map = new BMap.Map("map");-->
<!--var localSearch = new BMap.LocalSearch(map);-->
<!--localSearch.enableAutoViewport(); //允许自动调节窗体大小-->
<!--map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用-->
<!--map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用-->
<!--map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件-->
<!--map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件-->
<!--$(function(){-->
<!--    startmap();  //调用创建标注的方法-->
<!--    })-->
<!--function searchByStationName()-->
<!--{-->
<!--    map.clearOverlays();//清空原来的标注-->
<!--    var keyword = document.getElementById("company_address").value;-->
<!--    localSearch.setSearchCompleteCallback(function (searchResult) {-->
<!--    var poi = searchResult.getPoi(0);-->
<!--    document.getElementById("company_map").value-->
<!--    = poi.point.lng + "," + poi.point.lat; //获取经度和纬度，将结果显示在文本框中-->
<!--    document.getElementById("company_x").value=poi.point.lng;//单独获取经度-->
<!--    document.getElementById("company_y").value=poi.point.lat;//单独获取纬度-->
<!--    map.centerAndZoom(poi.point, 16);-->
<!--    var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地址对应的经纬度-->
<!--    map.addOverlay(marker);              // 将标注添加到地图中-->
<!--    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画-->
<!--//    addTextInfoWindow(map);  //调用创建信息窗口的方法-->
<!--    });-->
<!--    localSearch.search(keyword);-->
<!--}-->
<!--function startmap()-->
<!--{-->
<!--    map.clearOverlays();//清空原来的标注-->
<!--    var x=document.getElementById("company_x").value;-->
<!--    var y=document.getElementById("company_y").value;-->
<!--    var point =new BMap.Point(x,y);-->
<!--    map.centerAndZoom(point, 16);-->
<!--    var marker = new BMap.Marker(point);  // 创建标注，为要查询的地址对应的经纬度-->
<!--    map.addOverlay(marker);              // 将标注添加到地图中-->
<!--    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画-->
<!--    document.getElementById("company_map").value=x+","+y;-->
<!--//    addTextInfoWindow(map);  //调用创建信息窗口的方法-->
<!--}-->
<!--/*-->
<!-- * 添加纯文本信息窗口-->
<!-- */-->
<!--function addTextInfoWindow(map) {-->
<!--    var company = document.getElementById("company_name").value;-->
<!--    var keyword = document.getElementById("company_address").value;-->
<!--    var opts = {-->
<!--        width : 300, // 信息窗口宽度-->
<!--        height : 30, // 信息窗口高度-->
<!--        title : company, // 信息窗口标题-->
<!--        enableMessage : true //设置允许信息窗发送短息-->
<!--//        message : "欢迎..." // 信息内容-->
<!--    }-->
<!--    var infoWindow = new BMap.InfoWindow(keyword, opts); // 创建信息窗口对象-->
<!--    map.openInfoWindow(infoWindow, map.getCenter()); //开启信息窗口-->
<!--}-->
<!--</script>-->
        <li>
            <label>交通配套：</label>
            <textarea name="company_traffic" id="company_traffic" style="width:80%;float:left;"><?=$row['company_traffic']?></textarea>
        </li>
        <li>
            <label>关于我们：</label>
            <textarea name="company_about" id="company_about" style="width:80%;float:left;"><?=$row['company_about']?></textarea>
        </li>
        <li>
            <label>版权：</label>
            <input type="text" name="company_copyright" id="company_copyright" 
                   class="dfinput" value="<?=$row['company_copyright']?>"  />
        </li>
        <li>
            <label>备案号：</label>
            <input type="text" name="company_record" id="company_record" 
                   class="dfinput" value="<?=$row['company_record']?>" />
        </li>
        <li>
            <label>&nbsp;</label>
            <input type="submit" name="btnEdit" id="btnEdit" value="确认保存" 
                   class="btn" /> 
        </li>
    </ul>
</div>
</form>
</body>
</html>
