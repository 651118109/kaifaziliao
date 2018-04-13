/**
 *  通用JS文件
 */
// $.init();
var SystemErrorMsg = "网络异常";

var STATUS_FAIL = 2;
var STATUS_OK = 1;
var STATUS_ERR = 0;
var STATUS_UNLOGIN = -1;

var SUFFIX = '.html';

var submitFlag = false;

var proName = $("meta[name=jbpro1]").attr("content");
var proValue = $("meta[name=jbpro2]").attr("content");

var commonCallback = function() {};

$(document).on("ajaxBeforeSend", function(e, xhr, options) {
    if (!/^(GET|HEAD|OPTIONS|TRACE)$/i.test(options.type)) {

        if (options.data == '') {
            options.data = proName + "=" + proValue;
        } else {
            options.data += "&" + proName + "=" + proValue;
        }
    }
});

var base = {
    // 带伪静态的链接
    siteUrl: function(url) {
        return baseUrl + url + SUFFIX;
    },
    // 发送验证码 type 0：通用验证码 1：注册  2：找回密码
    sendVerificationCode: function(mobile, type) {

        var sendResult = new Object();

        sendResult.status = STATUS_ERR;
        sendResult.msg = "请填写正确的手机号码";

        $.ajax({
            type: "post",
            url: base.siteUrl("verification/send_code"),
            data: {"mobile":mobile,"type":type},
            dataType: "json",
            async : false,
            success: function(data) {

                sendResult = data;
            }
        });

        return sendResult;
    },
    // 验证验证码 type 1 用户注册 2 密码找回 3 预约装修 4用户手机号更换 5微信绑定
    checkVerificationCode: function(mobile, captcha, type) {

        var sendResult = new Object();

        sendResult.status = STATUS_ERR;
        sendResult.msg = "请填写正确的手机号码";

        if (base.isMobile(mobile)) {
            $.ajaxSetup({async : false}); // 设置AJAX提交为同步

            $.post(base.siteUrl("verification/check_code"), {"mobile":mobile,"captcha":captcha,"type":type}, function(data){
                sendResult = data;
            }, "json");
        }

        return sendResult.status > 0 ? true : false;
    },
    // 验证是否为正确的手机号码
    isMobile: function(mobile) {
        var reg = /^1\d{10}$/;

        if (mobile.length === 11 && reg.test(mobile)) {
            return true;
        } else {
            return false;
        }
    },
    // 注销
    logout: function() {
        $.post(base.siteUrl("member/logout"), {"1":"1"}, function(){
            location.reload();
        });
    },
    // 验证密码
    checkPwd: function(v) {
        if(v.length < 6 || v.length > 16) {
            return false;
        } else {
            return true;
        }
    },
    // 获取值
    getValue: function(id) {
        return document.getElementById(id).value;
    },
    // 字符长度 汉字算2个字符
    strLen: function(value) {
        var len = 0;

        for (var i = 0; i < value.length; i++) {
           var length = value.charCodeAt(i);

           if(length >= 0 && length <= 128) {
               len += 1;
           } else {
               len += 2;
           }
        }

        return len;
    },
    closeDownloadBar: function() {
        $(".download-bar").remove();

        $.post(base.siteUrl("download_bar/close"), {"1":"1"}, function(){});
    },
    // 索票
    getTicket: function(formId, source, cityId, cityname) {
        if (submitFlag) return false;
        submitFlag = true;
        if(typeof(cityId) != "undefined" && cityId == 0) {
            $.alert('请选择城市');
            submitFlag = false;
        }

        $.showIndicator();

        if (source == 'user') {
            var truename = null;
            var mobile = null;
            var sex = 1;
            var address = null;
        }else if(source == 'ticket_2017-04'){
            var truename = null;
            var mobile = $(formId).find("#ticket_mobile").length >= 1 ? $(formId).find("#ticket_mobile").val() : '';
            var sex = 1;
            var address = null;
        }else {
            var truename = $(formId).find("#ticket_name").length >= 1 ? $(formId).find("#ticket_name").val() : '';
            var mobile = $(formId).find("#ticket_mobile").length >= 1 ? $(formId).find("#ticket_mobile").val() : '';
            var sex = $(formId).find("input[name=ticket_sex]:checked").length >= 1 ? $(formId).find("input[name=ticket_sex]:checked").val() : 1;
            var address = $(formId).find("#ticket_address").length >= 1 ? $(formId).find("#ticket_address").val() : '';
        }

        $.ajax({
            type: "post",
            url: base.siteUrl(cityCode + "/demand_ticket"), 
            data: {"truename":truename,"mobile":mobile,"sex":sex,"address":address,"source":source,"cityid":cityId},
            dataType: "json",
            success: function(data) {

                $.hideIndicator();

                if (data.status == STATUS_OK) {
                    if (source == 'user') {
                        location.reload();
                    } else if(source == 'old'){
                        window.location.href = base.siteUrl(cityCode + "/ticket_success_old") + "?k=" + data.data.k+"&user_id=" + data.data.uid;
                    }else if (source == 'city') {
                        window.location.href = base.siteUrl(cityname + "/ticket_success") + "?k=" + data.data.k+"&user_id=" + data.data.uid;
                    }else if(source == 'sz'){
                        window.location.href = base.siteUrl(cityCode + "/ticket_success_sz_lfgz") + "?k=" + data.data.k+"&user_id=" + data.data.uid +"&mobile=" + data.data.mobile;
                    }else{
                        window.location.href = base.siteUrl(cityCode + "/ticket_success") + "?k=" + data.data.k+"&user_id=" + data.data.uid;
                    }
                } else {
                    $.alert(data.msg);
                }

                submitFlag = false;
            },
            error: function(xhr, type) {

                $.hideIndicator();

                $.alert(SystemErrorMsg);

                submitFlag = false;
            }
        });
    },

    // 模态框
    openModal: function(url, title, width, height, noHeader) {
        if (typeof noHeader === "undefined") noHeader = false;

        var modalTpl =
            '<div class="jb-modal-blind"></div>' +
            '<div class="jb-modal-primary">';


        if ( noHeader === false) modalTpl += '<div class="jb-modal-header">' +
            '<span class="jb-modal-title"></span>' +
            '<a class="jb-modal-close" href="javascript:void(0);"></a>' +
            '</div>';

        modalTpl += '<div class="jb-modal-body">' +
            '<div class="jb-modal-loading"></div>' +
            '</div>' +
            '<div class="jb-modal-footer">' +

            '</div>' +
            '</div>';

        var tpl = document.createElement('div');

        tpl.innerHTML = modalTpl;

        document.body.appendChild( tpl );

        // 创建DOM
        modalDOM = { wrap : $( tpl ) },
            i = 0,
            elem = tpl.getElementsByTagName('*');
        elemLen = elem.length;

        for ( ; i < elemLen; i++ ){
            var name = elem[i].className.replace('jb-modal-', '');
            if ( name ) modalDOM[name] = $( elem[i] );
        }

        // 滚动条滚动
        scrollHeight = document.documentElement.scrollTop || document.body.scrollTop;
        scrollWidth = document.documentElement.scrollLeft || document.body.scrollLeft;

        // 设置标题
        if ( noHeader === false) modalDOM.title.html(title);

        // 设置样式
        width = width ? width : 300;
        height = height ? height: 200;

        modalDOM.primary.css({"width":width,"min-height":height,"margin-top":-(height/2),"margin-left":-(width/2)});

        // 头部被挡住了
        if (modalDOM.primary.offset().top < 20) {
            var hideHeight = 20 - parseInt(modalDOM.primary.offset().top);

            modalDOM.primary.css({"margin-top":-((height/2) - hideHeight)});
        }

        // 滚动到顶部
        window.scroll(0, 0);

        // 获取内容页面
        $.get(encodeURI(url), function(content) {
            modalDOM.body.html(content);

//          modalDOM.primary.css({"margin-top":-(modalDOM.primary.height()/2)});
        }, "html");

        // 绑定关闭事件
        if ( noHeader === false) modalDOM.close.bind("click", function() {

//          typeof(imageUe) !== 'undefined' && imageUe.destroy();

            modalDOM.wrap.remove();

            // 滚回原位
            window.scroll(scrollWidth, scrollHeight);
        });
    },
    // 关闭模态框
    closeModal: function() {
        if (modalDOM) modalDOM.wrap.remove();

        // 滚回原位
        window.scroll(scrollWidth, scrollHeight);
    },
    // 打开预约页面
    openReserve: function(srcId, sourceId, callback) {
        var url = base.siteUrl(cityCode + "/reserve") + "?src_id=" + srcId;

        if (typeof sourceId != "undefined") {
            url += "&source_id=" + sourceId;
        }

        commonCallback = callback;

        $.showIndicator();

        $.ajax({
            type: "post",
            url: base.siteUrl("member/auth_check"),
            dataType: "json",
            success: function(data) {
                if (data.status == STATUS_OK) {
                    $.ajax({
                        type: "post",
                        url: base.siteUrl(cityCode + "/reserve"),
                        data: {"source_id":sourceId,"src_id":srcId},
                        dataType: "json",
                        success: function(data) {
                            if (data.status = STATUS_OK) {
                                commonCallback();
                                if(srcId == 'company' || srcId == 'supplier' || srcId == 'sale' || srcId == 'Hotsale'){//装修公司预约
                                    $.closeModal();
                                    $('.preloader-indicator-modal').css('display','none');
                                    $('.preloader-indicator-overlay').css('display','none');
                                    base.reserveSuccess(srcId,sourceId);
                                }else{
                                    $.alert(data.msg, function() {
                                        $.closeModal();
                                    });
                                }


                            } else {
                                $.alert(data.msg);

                                submitFlag = false;
                            }
                        },
                        error: function(xhr, type) {

                            $.hideIndicator();

                            $.alert(SystemErrorMsg);

                            submitFlag = false;
                        }
                    });
                } else {
                    $.hideIndicator();

                    submitFlag = false;

                    $.get(encodeURI(url), function(content) {
                        $.popup(content);
                    }, "html");
                }
            },
            error: function(xhr, type) {

                $.hideIndicator();

                $.alert(SystemErrorMsg);

                submitFlag = false;
            }
        });
    },
    // 提交预约
    reserve: function(formId, srcId) {
        if (submitFlag) return false;
        submitFlag = true;

        var reserve_name = $(formId).find("input[name=reserve_name]").length == 1 ? $(formId).find("input[name=reserve_name]").val() : '';
        var reserve_mobile = $(formId).find("input[name=reserve_mobile]").length == 1 ? $(formId).find("input[name=reserve_mobile]").val() : '';
        var reserve_sex = $(formId).find("input[name=reserve_sex]").length > 1 ? $(formId).find("input[name=reserve_sex]:checked").val() : '';
        var source_id = $(formId).find("input[name=reserve_source]").length == 1 ? $(formId).find("input[name=reserve_source]").val() : '';
        var reserve_ticket = $(formId).find("input[name=reserve_ticket]").length == 1 ? $(formId).find($('input[name=reserve_ticket]:checked')).val() : '';

        $.ajax({
            type: "post",
            url: base.siteUrl(cityCode + "/reserve"),
            data: {"reserve_name":reserve_name,"reserve_mobile":reserve_mobile,"reserve_sex":reserve_sex,"reserve_ticket":reserve_ticket,"source_id":source_id,"src_id":srcId},
            dataType: "json",
            success: function(data) {
                if (data.status == STATUS_OK) {
                    commonCallback();

                    if(srcId == 'company'){
                        $.closeModal();
                        $('.preloader-indicator-modal').css('display','none');
                        $('.preloader-indicator-overlay').css('display','none');
                        base.reserveSuccess('company',srcId);
                    }else if(srcId == 'supplier'){
                        $.closeModal();
                        $('.preloader-indicator-modal').css('display','none');
                        $('.preloader-indicator-overlay').css('display','none');
                        base.reserveSuccess('supplier',source_id);
                    }else if(srcId == 'sale'){
                        $.closeModal();
                        $('.preloader-indicator-modal').css('display','none');
                        $('.preloader-indicator-overlay').css('display','none');
                        base.reserveSuccess('sale',source_id);
                    }else if(srcId == 'brand'){
                        $.closeModal();
                        $('.preloader-indicator-modal').css('display','none');
                        $('.preloader-indicator-overlay').css('display','none');
                        base.reserveSuccess('brand',source_id);
                    }else if(srcId == 'Hotsale'){
                        $.closeModal();
                        $('.preloader-indicator-modal').css('display','none');
                        $('.preloader-indicator-overlay').css('display','none');
                        base.reserveSuccess('Hotsale',source_id);
                    }
                    else{
                        $.alert(data.msg, function() {
                            $('.preloader-indicator-modal').css('display','none');
                            $('.preloader-indicator-overlay').css('display','none');
                            $.closeModal();
                        });
                    }
                } else {
                    $.alert(data.msg);
                    submitFlag = false;
                }
            },
            error: function(xhr, type) {

                $.hideIndicator();

                $.alert(SystemErrorMsg);

                submitFlag = false;
            }
        });
    },
    // 预约成功弹出层
    reserveSuccess: function(srcId, sourceId) {
        var url = base.siteUrl(cityCode + "/reserve/success/pp") + "?src_id=" + srcId + "&source_id=" + sourceId;
        $.get(encodeURI(url), function(content) {
            $.popup(content);
        }, "html");
    },
    // 点赞、收藏 type_id 1收藏案例 2收藏日记 3点赞日记 flag 1点赞或收藏 2取消
    doAction: function(sourceId, typeId, flag, callback) {
        if (submitFlag) return false;
        submitFlag = true;
        $.ajax({
            type: "post",
            url: base.siteUrl("member/auth_check"),
            dataType: "json",
            success: function(data) {
                if (data.status == STATUS_OK) {
                    $.ajax({
                        type: "post",
                        url: base.siteUrl(cityCode + "/do_action"),
                        data: {"source_id":sourceId,"type_id":typeId,"flag":flag},
                        dataType: "json",
                        success: function(data) {
                            if (data.status == STATUS_OK) {
                                submitFlag = false;

                                callback();
                            } else {
                                // $.alert(data.msg);

                                submitFlag = false;
                            }
                        },
                        error: function(xhr, type) {
                            $.alert(SystemErrorMsg);

                            submitFlag = false;
                        }
                    });
                } else {

                    submitFlag = false;
                    base.jLogin('shoucang', sourceId, function() {
                        base.doAction(sourceId, typeId, flag, callback)
                    });
                    
                }
            },
            error: function(xhr, type) {

                $.alert(SystemErrorMsg);

                submitFlag = false;
            }
        });
    },
    // 提交预约
    reserved: function(goodsId, type, formId, source, callback) {
        if (submitFlag) return false;
        submitFlag = true;

        $.showIndicator();

        var mobile;

        if (type != 1) {
            mobile = $(formId).find("#reserve_mobile").length >= 1 ? $(formId).find("#reserve_mobile").val() : '';
        }

        $.ajax({
            type: "post",
            url: base.siteUrl(cityCode + "/reserve"),
            data: {"goods_id":goodsId,"mobile":mobile,"source":source,"type":type},
            dataType: "json",
            success: function(data) {

                $.hideIndicator();

                if (data.status == STATUS_UNLOGIN) {
                    $.get(encodeURI(base.siteUrl(cityCode + "/reserve") + "?goods_id=" + goodsId + "&source=" + source), function(content) {
                        commonCallback = function() {callback();}

                        $.popup(content);
                    }, "html");
                } else if (data.status == STATUS_OK) {
                    $.alert(data.msg, function() {
                        $.closeModal();  // 关闭弹出层
                        callback();
                    });
                } else {
                    $.alert(data.msg);
                }

                submitFlag = false;
            },
            error: function(xhr) {

                $.hideIndicator();

                $.alert(SystemErrorMsg);

                submitFlag = false;
            }
        });
    },
    // 领取优惠券
    getCoupon: function(couponId, type, formId, source, callback) {
        if (submitFlag) return false;
        submitFlag = true;

        $.showIndicator();

        var mobile;

        if (type != 1) {
            mobile = $(formId).find("#coupon_mobile").length >= 1 ? $(formId).find("#coupon_mobile").val() : '';
        }

        $.ajax({
            type: "post",
            url: base.siteUrl(cityCode + "/get_coupon"),
            data: {"coupon_id":couponId,"mobile":mobile,"source":source,"type":type},
            dataType: "json",
            success: function(data) {

                $.hideIndicator();

                if (data.status == STATUS_UNLOGIN) {
                    $.get(encodeURI(base.siteUrl(cityCode + "/get_coupon") + "?coupon_id=" + couponId + "&source=" + source), function(content) {
                        commonCallback = function() {callback();}

                        $.popup(content);
                    }, "html");
                } else if (data.status == STATUS_OK) {
                    $.alert(data.msg, function() {
                        $.closeModal();  // 关闭弹出层
                        callback();
                    });
                } else {
                    $.alert(data.msg);
                }

                submitFlag = false;
            },
            error: function(xhr) {

                $.showIndicator();

                $.alert(SystemErrorMsg);

                submitFlag = false;
            }
        });
    },
    // js登录
    jLogin: function(srcId,sourceId,callback) {
        $.closeModal();

        $.get(encodeURI(base.siteUrl("login/pp")), function(content) {
            if (typeof callback !== "undefined") commonCallback = callback;

            $.popup(content);

            // 获取验证码
            var sendCodeFlag = false;
            $("#sendCode").on("click", function() {
                if (sendCodeFlag) return;

                var _this = $(this);
                var mobile = base.getValue("mobile");

                if (!base.isMobile(mobile)) {
                    $.alert("请输入11位有效手机号码");
                } else {
                    sendCodeFlag = true;
                    var sendResult = base.sendVerificationCode(mobile, 4); // 发送验证码
                    if (sendResult.status == STATUS_OK) { // 发送成功
                        _this.addClass("disabled");

                        // 设置倒计时定时器
                        var time = 60;
                        var codeIntval = setInterval(function(){ 
                            
                            time --;
                            
                            if (time < 1) {
                                sendCodeFlag = false;
                                clearInterval(codeIntval); // 清楚计时器
                                _this.removeClass("disabled").html("获取验证码");
                            } else {
                                var btnText = 'ts后重发';
                                
                                btnText = btnText.replace("t", time);
                                
                                _this.html(btnText);
                            }
                        }, 1000);
                    } else {
                        sendCodeFlag = false;

                        $.alert(sendResult.msg);
                    }
                }
            });

            var loginFlag = false;
            $("#plogin").on("click", function() {
                if (loginFlag) return;

                var mobile = base.getValue("mobile");
                var code = base.getValue("code");

                loginFlag = true;

                $.showIndicator();

                $.ajax({
                    type: "post",
                    url: base.siteUrl("login/pp"),
                    data: {"mobile":mobile,"code":code},
                    dataType: "json",
                    success: function(data) {
                        $.hideIndicator();

                        if (data.status == STATUS_OK) {
                            if (srcId != 'shoucang') {
                                $.ajax({
                                    type: "post",
                                    url: base.siteUrl(cityCode + "/reserve"),
                                    data: {"source_id":sourceId,"src_id":srcId},
                                    dataType: "json",
                                    success: function(data) {
                                        if (data.status = STATUS_OK) {
                                            commonCallback();
                                            if(srcId == 'company' || srcId == 'supplier' || srcId == 'sale'){//装修公司预约
                                                $.closeModal();
                                                $('.preloader-indicator-modal').css('display','none');
                                                $('.preloader-indicator-overlay').css('display','none');
                                                base.reserveSuccess(srcId,sourceId);
                                            }else{
                                                $.alert(data.msg, function() {
                                                    $.closeModal();
                                                });
                                            }


                                        } else {
                                            $.alert(data.msg);

                                            submitFlag = false;
                                        }
                                    },
                                    error: function(xhr, type) {

                                        $.hideIndicator();

                                        $.alert(SystemErrorMsg);

                                        submitFlag = false;
                                    }
                                });
                             }
                            $.closeModal(".popup-login");

                            commonCallback();
                        } else {
                            $.alert(data.msg);
                        }

                        loginFlag = false;
                    },
                    error: function() {
                        $.hideIndicator();

                        $.alert(SystemErrorMsg);

                        loginFlag = false;
                    }
                });
            });
        }, "html");
    }
}

$(document).ready(function() {
    


    // 定位
    if (local == 1) getLocation();
    
    // 城市选择器
    if ($("#J_CitySelect").length > 0) {
        $("#J_CitySelect").picker({
            toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-left close-picker">关闭</button><button class="button button-link pull-right" onclick="pickerCity();">确定</button><h1 class="title">请选择城市</h1></header>',
            cols: [
                {
                    textAlign: "center",
                    values: codeList,
                    displayValues: nameList
                }
            ],
            rotateEffect: true,
            value: [cityCode]
        });
    }
});

/**
 * 选择城市
 */
function pickerCity() {
    var city = $(".picker-items .picker-selected").attr("data-picker-value");

    if (city == "quanguo") {
        window.location.href = base.siteUrl("city");

        return;
    }

    var url = "http://" + window.location.host + window.location.pathname;

    var index = url.indexOf("/" + cityCode);

    var params = getUrlArgStr();

    if (index > 0) {
        uri = url.replace("/" + cityCode, "/" + city);
    } else {
        uri = url + city;
    }

    if (params != '') uri += "?" + params;

    window.location.href = uri;
}

/**
 * 获取url参数
 */
function getUrlArgStr() {  

    var q = location.search.substr(1);  
    var qs = q.split('&');
    var argStr = ''; 

    if (qs.length > 0 && qs[0] != '') {  
        for(var i = 0; i < qs.length; i ++) {  
            argStr += qs[i].substring(0,qs[i].indexOf('='))+'='+qs[i].substring(qs[i].indexOf('=')+1);  

            if ( i != qs.length - 1) {
                argStr += '&';
            }
        }  
    }  

    return argStr;  
}

function getLocation() {
    if (navigator.geolocation) { // 浏览器支持定位
        navigator.geolocation.getCurrentPosition(showPosition, showError, {
            // 指示浏览器获取高精度的位置，默认为false
            enableHighAccuracy: true,
            // 指定获取地理位置的超时时间，默认不限时，单位为毫秒
            timeout: 5000,
            // 最长有效期，在重复获取地理位置时，此参数指定多久再次获取位置。
            maximumAge: 3000
        });
    }
}

function showPosition(position) {
    var lat = position.coords.latitude; //纬度 
    var lng = position.coords.longitude; //经度 

    var url = "http://api.map.baidu.com/geocoder/v2/?ak=oeziaO1kl6gemzpx4BVTZhmq&callback=renderReverse&location=" + lat + "," + lng + "&output=json&pois=1";

    $.ajax({
        type: "get",
        dataType: "jsonp",
        url: url,
        success: function(data) {
            getLocationCity(data.result.addressComponent.district) || getLocationCity(data.result.addressComponent.city) || getLocationCity("上海市");
        }
    });
}

function showError(error) { 
    switch(error.code) { 
        case error.PERMISSION_DENIED: 
            // 定位失败,用户拒绝请求地理定位
            break; 
        case error.POSITION_UNAVAILABLE: 
            // 定位失败,位置信息是不可用 
            getLocationCity("上海市");
            break; 
        case error.TIMEOUT: 
            // 定位失败,请求获取用户位置超时
            getLocationCity("上海市");
            break; 
        case error.UNKNOWN_ERROR: 
            // 定位失败,定位系统失效
            getLocationCity("上海市");
            break; 
    } 
}

function getLocationCity(posCityName) {
    var posCityName = posCityName.substr(0, posCityName.length - 1);
    var city;

    for (var i = 0; i < nameList.length; i ++) {
        if (nameList[i] == posCityName) {
            city = codeList[i];

            $.modal({
                title: '我们为您定位到您所在的城市为：',
                text: posCityName,
                extraClass: 'location-modal',
                buttons: [
                    {
                        text: '切换城市',
                        onClick: function() {
                            window.location.href = base.siteUrl("city");
                        }
                    },
                    {
                        text: '确定',
                        onClick: function() {
                            window.location.href = base.siteUrl(city);
                        }
                    }
                ]
            });
            break;
        }
    }

    return city ? true : false;
}

/**
 * 后退按钮
 */
$(document).on("click", ".button-back", function() {
    history.go(-1);
});


// 领取优惠券
$(document).on("click", ".coupon-btn", function() {
    var _this = $(this);

    if (_this.hasClass("grey")) return false;

    var couponId = _this.attr("data-id");

    base.openReserve('coupon',couponId, function() {
        _this.addClass("grey").html("<div class=\"sale-pink\">已领取</a>");
    });
});


$(document).on('click','.modal-button',function(){
    // commonCallback();
    // $.closeModal();
    $('.preloader-indicator-modal').css('display','none');
    $('.preloader-indicator-overlay').css('display','none'); 
})

$(document).on("click", ".login-link", function() {
    var _this = $(this);
    var id = _this.attr('data-id');
    var src = _this.attr('data-src');
    base.jLogin(src, id, function() {
        if (src == 'coupon') {
            _this.text("已领取");
        }else{
            _this.text("已预约");
        }
      
    });
  });

$(document).on("click", "#J_Reserve_sale", function() {
    var _this = $(this);
    var id = _this.attr('data-id');
    base.openReserve('sale', id, function() {
      _this.text("已预约");
    });
});


$(document).on("click",".filter-overlay",function(){
    $('.item-list').hide();
    $(this).removeClass('filter-overlay-visible');
    $.closeModal();
})

$(document).on("click",".popup-overlay",function(){
    $.closeModal();
});

// $(document).on("click",'.islider-dot-wrap',function(){
//     var num = $('.islider-dot-wrap .islider-dot').length;
//     alert(num);
// })
$(document).ready(function(){  
    var num = $('.islider-dot-wrap .islider-dot').length;
    if (num == 1) {
        $('.islider-dot-wrap').hide();
    }
});

