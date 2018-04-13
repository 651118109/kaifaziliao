$(document).ready(function () {
	var h;
	var w;
	if (isIE = navigator.userAgent.indexOf("MSIE") != -1) {
		h = $(window).height();
		w = $(window).width();
	}
	if (isFirefox = navigator.userAgent.indexOf("Firefox") != -1) {
		w = document.body.clientWidth;
		h = document.body.clientHeight;
	}
	if (isChrome = navigator.userAgent.indexOf("Chrome") != -1) {
		h = $(window).height();
		w = $(window).width();
	}
	if (isSafari = navigator.userAgent.indexOf("Safari") != -1) {
		h = $(window).height();
		w = $(window).width();
	}
	if (isOpera = navigator.userAgent.indexOf("Opera") != -1) {
		h = $(window).height();
		w = $(window).width();
	}


	var hh = (h - 328) / 2;
	var ww = (w - 739) / 2;
	$(".bgggg").css({ "width": w });
	$(".bgggg").css({ "height": h });
	$(".dl").css({ "top": hh });
	$(".dl").css({ "left": ww });
});

$(function () {
	$("#btnRe").click(function(){
	  $("#txtName").val("");
	  $("#txtPwd").val("");
	});
});

var flag = { 
	"LoginName":false, 
	"LoginPassWord":false 
}; 
function contain(str, charset)//   字符串包含测试函数
{
	var i;
	for (i = 0; i < charset.length; i++)
		if (str.indexOf(charset.charAt(i)) >= 0)
			return true;
	return false;
}
$(function(){ 
	$('#txtName').blur(function () {
		flag.LoginName = false;
		LoginName();
	});
	
	$('#txtPwd').blur(function () {
		flag.LoginPassWord = false;
		LoginPwd();
	});
	
	$("#LoginFrom").submit(function(){ 
		LoginName(); 
		LoginPwd();
		var ok = flag.LoginName&&flag.LoginPassWord; 
		if(ok==false){ 
			//alert("表单项正在检测或存在错误"); 
			//history.back(); 
			return false; 
		} 
		return true; 
	});  
}); 
		
function LoginName() {
	var Name=$("#txtName").val(); 
	if(Name == ""){ 
		$("#TypeName").html("登录名称不能为空"); 
		flag.LoginName = false; 
		return; 
	}
	if ((contain(Name, "%\(\)><&*|")) || (contain(Name, "%\(\)><&*|"))) {
		$("#TypeName").html("登录名称输入了非法字符"); 
		flag.LoginName = false;
		return; 
	}
	else{ 
		//$("#TypeName").html("登录名称输入正确"); 
		$("#TypeName").html(""); 
		flag.LoginName = true; 
		return; 
	}
};

function LoginPwd() {
	var Pwd=$("#txtPwd").val(); 
	if(Pwd == ""){ 
		$("#TypePwd").html("登录密码不能为空"); 
		flag.LoginPassWord = false; 
		return; 
	}
	if ((contain(Pwd, "%\(\)><&*|")) || (contain(Pwd, "%\(\)><&*|"))) {
		$("#TypePwd").html("登录密码输入了非法字符"); 
		flag.LoginPassWord = false;
		return; 
	}
	else{ 
		//$("#TypePwd").html("登录密码输入正确"); 
		$("#TypePwd").html(""); 
		flag.LoginPassWord = true; 
		return;
	}
};