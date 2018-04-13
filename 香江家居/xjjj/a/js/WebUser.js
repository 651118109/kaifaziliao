function CheckWebUser() {
    function contain(str, charset)//   字符串包含测试函数
    {
        var i;
        for (i = 0; i < charset.length; i++)
            if (str.indexOf(charset.charAt(i)) >= 0)
                return true;
        return false;
    }

    if (document.getElementById("TextUserName").value == "") {
        alert("用户名不能为空");
        document.getElementById("TextUserName").focus();
        return false;
    }
    if ((contain(document.getElementById("TextUserName").value, "%\(\)><&*|")) || (contain(document.getElementById("TextUserName").value, "%\(\)><&*|"))) {
        alert("用户名输入了非法字符");
        document.getElementById("TextUserName").focus();
        return false;
    }

    if (document.getElementById("TextUserPwd").value == "") {
        alert("密码不能为空");
        document.getElementById("TextUserPwd").focus();
        return false;
    }

    if (document.getElementById("TextCardId").value == "") {
        alert("身份证不能为空");
        document.getElementById("TextCardId").focus();
        return false;
    }
    var regIdCard = /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
    if (regIdCard.test(document.getElementById("TextCardId").value) == false) {
        alert("身份证输入了非法字符");
        document.getElementById("TextCardId").focus();
        return false;
    }

    if (document.getElementById("TextPhone").value == "") {
        alert("手机号码不能为空");
        document.getElementById("TextPhone").focus();
        return false;
    }
    var pattern = /(^[0-9]{3,4}\-[0-9]{3,8}$)|(^[0-9]{3,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}1[3,5,7,8][0-9]{9}$)/;
    if (pattern.test(document.getElementById("TextPhone").value) == false) {
        alert("手机号码输入了非法字符");
        document.getElementById("TextPhone").focus();
        return false;
    }

    var obj = document.getElementById('DropDownListProvince');
    //alert(obj.value);
    if (obj.value == "" || obj.value == null) {
        alert("请您选择省份");
        document.getElementById('DropDownListProvince').focus();
        return false;
    }

    var obj = document.getElementById('DropDownListCity');
    if (obj.value == "" || obj.value == null) {
        alert("请您选择市区");
        document.getElementById('DropDownListCity').focus();
        return false;
    }

    var obj = document.getElementById('DropDownListDistrict');
    if (obj.value == "" || obj.value == null) {
        alert("请您选择区县");
        document.getElementById('DropDownListDistrict').focus();
        return false;
    }
}