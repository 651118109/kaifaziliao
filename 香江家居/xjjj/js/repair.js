function leaveword()
{
    var leaveword_name=$("#leaveword_name").val();
    var leaveword_tel=$("#leaveword_tel").val();
    var leaveword_code=$("#leaveword_code").val();
    if(leaveword_code=="")
    {
        alert("请输入验证码");
    }
    else if(leaveword_name=="")
    {
        alert("请输入姓名");
    }
    else if(!(/^1[34578]\d{9}$/.test(leaveword_tel)))
    {
        alert("请输入正确的手机号");
    }
    else
    {
        $.post("leaveword.html",{"leaveword_name":leaveword_name,"leaveword_tel":leaveword_tel,"leaveword_code":leaveword_code},function(data){
            if(data==1)
            {
                location.href="success.html";
            }
            else if(data==2)
            {
                alert("验证码不正确");
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
    var leaveword_name=$("#reserve_name").val();
    var leaveword_tel=$("#reserve_tel").val();
    var leaveword_code=$("#reserve_code").val();
    if(leaveword_code=="")
    {
        alert("请输入验证码");
    }
    else if(leaveword_name=="")
    {
        alert("请输入您的姓名");
    }
    else if(!(/^1[34578]\d{9}$/.test(leaveword_tel)))
    {
        alert("请输入正确的手机号");
    }
    else
    {
        $.post("leaveword.html",{"leaveword_name":leaveword_name,"leaveword_tel":leaveword_tel,"leaveword_code":leaveword_code},function(data){
            if(data==1)
            {
                location.href="success.html";
            }
            else if(data==2)
            {
                alert("验证码不正确");
            }
            else
            {
                alert("网络忙！稍后请重试……");
            }
        })
    }
}