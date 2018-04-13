(function(root) {
    root._tt_config = true;
    var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;
    ta.src = document.location.protocol + '//' + 's3.pstatp.com/bytecom/resource/track_log/src/toutiao-track-log.js';
    ta.onerror = function () {
        var request = new XMLHttpRequest();
        var web_url = window.encodeURIComponent(window.location.href);
        var js_url  = ta.src;
        var url = '//ad.toutiao.com/link_monitor/cdn_failed?web_url=' + web_url + '&js_url=' + js_url + '&convert_id=59772517910';
        request.open('GET', url, true);
        request.send(null);
    }
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ta, s);
})(window);

(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https'){
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else{
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
function leaveword()
{
    var leaveword_name=$("#leaveword_name").val();
    var leaveword_tel=$("#leaveword_tel").val();
    if(leaveword_name=="")
    {
        alert("请输入您的姓名");
    }
    else if(!(/^1[34578]\d{9}$/.test(leaveword_tel)))
    {
        alert("请输入正确的手机号");
    }
    else
    {
        $.post("leaveword.html",{"leaveword_name":leaveword_name,"leaveword_tel":leaveword_tel},function(data){
            if(data==1)
            {
                location.href="success.html";
            }
            else
            {
                alert("网络忙！稍后请重试……");
            }
        })
    }
}
function leaveword_f()
{
    $("#label_name").css("display","none");
    $("#label_tel").css("display","none");
    var leaveword_name=$("#reserve_name").val();
    var leaveword_tel=$("#reserve_tel").val();
    if(leaveword_name=="")
    {
        alert("请输入您的姓名");
    }
    else if(!(/^1[34578]\d{9}$/.test(leaveword_tel)))
    {
        alert("请输入正确的手机号");
    }
    else
    {
        $("#label_name").css("display","none");
        $("#label_tel").css("display","none");
        $.post("leaveword.html",{"leaveword_name":leaveword_name,"leaveword_tel":leaveword_tel},function(data){
            if(data==1)
            {
                location.href="success.html";
            }
            else
            {
                alert("网络忙！稍后请重试……");
            }
        })
    }
}
