
/**
 *  通用JS文件
 */
var IE = !!window.ActiveXObject||"ActiveXObject" in window; // IE浏览器
var SystemErrorMsg = "网络异常";

var STATUS_FAIL = 2;
var STATUS_ERR = 0;
var STATUS_OK = 1;

var modalDOM;

var submitFlag = false;
var clickFlag = false;

var jLoginCallback = function() {};

$.ajaxSetup({
   headers: {"X-CSRF-Token" : $("meta[name=_token]").attr("content") }
});

var scrollHeight = 0,scrollWidth = 0;

var base = {
    // 发送验证码 type 0：通用验证码 1：注册  2：找回密码
    sendVerificationCode: function(mobile, type) {

        var sendResult = new Object();

        sendResult.status = STATUS_ERR;
        sendResult.msg = "请填写正确的手机号码";

        if (base.isMobile(mobile)) {
            $.ajaxSetup({async : false}); //设置AJAX提交为同步

            $.post(baseUrl + "code/send", {"mobile":mobile,"type":type}, function(data) {
                sendResult = data;
            }, "json");
        }

        return sendResult;
    },
    // 验证验证码
    checkVerificationCode: function(mobile, code, type) {

        var sendResult = new Object();

        sendResult.status = STATUS_ERR;
        sendResult.msg = "请填写正确的手机号码";

        if (base.isMobile(mobile)) {
            $.ajaxSetup({async : false}); // 设置AJAX提交为同步

            $.post(baseUrl + "code/check", {"mobile":mobile,"code":code,"type":type}, function(data) {
                sendResult = data;
            }, "json");
        }

        return sendResult.status === STATUS_OK ? true : false;
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
    // 验证是否为正确的邮箱
    isEmail: function(email) {
        var reg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;

        if (reg.test(email)) {
            return true;
        } else {
            return false;
        }
    },
    // 手机号码是否已经注册
    isExistMobile: function(mobile) {

        var is_exist = STATUS_FAIL;

        $.ajaxSetup({async : false}); // 设置AJAX提交为异步

        $.post(baseCityUrl + "isExistMobile",{"mobile":mobile}, function(data){
            is_exist = data.status;
        }, "json");

        return is_exist;
    },
    // 省份三级联动
    getRegion: function(element, id, element2) {

        id = id || 1;
        element2 = element2 || '';
        $.ajaxSettings.async = false; // getJson 同步执行
        $.getJSON(baseCityUrl + 'getRegionList?id=' + id, function(data) {
            if (data.status === 1) {
                var li = [];
                $.each(data.data, function(index, val) {
                    li.push('<option value="' + val.id + '">' + val.name + '</option>');
                    if (index == 0 && element2.length > 0)
                        base.getRegion(element2, val.id);
                });

                element.html(li.join(''));
            } else
                console.log('请求失败');
        });
    },
    // 注销
    logout: function() {
        $.post(baseUrl + "member/logout",{},function(){
            location.reload();
        });
    },
    // 验证密码
    checkPwd: function(v) {
        if(v.length < 6) {
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
    //通用上传文件 - dmUploader
    uploaderFile:function(obj,appendobj,url,filemax,height,width){
        if(filemax==''){
            filemax = 1;
        }
        if(height ==''){
            height = 98;
        }
        if(width ==''){
            width = 98;
        }
        //上传图片
        obj.dmUploader({
            url: url,
            dataType: 'json',
            allowedTypes: 'image/*',
            maxFileSize: '5242880',
            /*extFilter: 'jpg;png;gif',*/
            onUploadSuccess: function(id, data) {
                if(data.infoMap.reason=='successes')
                {
                    var img_url = data.resultList[0].access_url;
                    if (appendobj.children("li").length ==filemax) {
                        //layer.msg("最多只能上传"+num+"张图片！",{time:4000});
                        //alert("最多只能上传"+num+"张图片！");
                        //return;

                    } else {
                        var li = '<li><img src="'+img_url+'" height="100%" width="100%">' +
                                    '<input type="hidden" class="image_urls" name="image_urls[]" value="'+img_url+'">'+
                                    '<i class="del-image" onclick="base.fileRemove(this)"></i></li>';
                            appendobj.append(li);

                    }

                }else{
                    //layer.msg('上传失败!',{time:1000});
                   // alert('上传失败!');
                    return;

                }

            },
            onBeforeUpload: function() {
                if(appendobj.children("li").length==filemax) {
                    layer.msg('最多只能上传'+filemax+'张图片', {time: 4000});
                    //alert('最多只能上传'+filemax+'张图片');
                   // return;
                }
            },

        });

    },
    fileRemove:function(obj){
        $(obj).parent('li').remove();
    },
    // 通用上传文件
    uploadFile: function(element, buttonText, url, type, width, height, callback) {

        var fileTypeDesc = 'All Files';
        var fileTypeExts = '*.*';

        if (type == 1) { // 图片上传
            fileTypeDesc = 'Image Files';
            fileTypeExts = '*.gif; *.jpg; *.png';
        }

        $(element).uploadify({
            //指定swf文件
            'swf': baseUrl + 'plugin/uploadify/uploadify.swf',
            //后台处理的路径
            'uploader': url,
            //服务器端脚本使用的文件对象的名称 $_FILES个['upload']
            'fileObjName':'upfile',
            //按钮显示的文字
            'buttonText': buttonText,
            // 按钮的样式
            'buttonClass' : 'upload-btn',
            //显示的高度和宽度，默认 height 30；width 120
            'height': height,
            'width': width,
            //上传文件的类型  默认为所有文件    'All Files'  ;  '*.*'
            //在浏览窗口底部的文件类型下拉菜单中显示的文本
            'fileTypeDesc': fileTypeDesc,
            //允许上传的文件后缀
            'fileTypeExts': fileTypeExts,
            //选择文件后自动上传
            'auto': true,
            //设置为true将允许多文件上传
            'multi': false,
            'onUploadStart' : function(file) {

            },
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);

                if (data.state == 'SUCCESS') {
                    callback(data.url);
                } else {
                    alert('上传失败');
                }
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {

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
        clickFlag = false;
        if (modalDOM) modalDOM.wrap.remove();

        // 滚回原位
        window.scroll(scrollWidth, scrollHeight);
    },
    editModal: function(url, title, width, height, noHeader) {
        // load
        modalDOM.body.html('<div class="jb-modal-loading"></div>');
        // 设置标题
        if ( noHeader == false) modalDOM.title.html(title);

        // 设置样式
        width = width ? width : 300;
        height = height ? height: 200;

        modalDOM.primary.css({"width":width,"min-height":height,"margin-top":-(height/2),"margin-left":-(width/2)});

        // 获取内容页面
        $.get(encodeURI(url), function(content) {
            modalDOM.body.html(content);

            modalDOM.primary.css({"margin-top":-(modalDOM.primary.height()/2)});

            // 头部被挡住了
            if (modalDOM.primary.offset().top < 20) {
                var hideHeight = 20 - parseInt(modalDOM.primary.offset().top);

                modalDOM.primary.css({"margin-top":-((modalDOM.primary.height()/2) - hideHeight)});
            }
        }, "html");
    },
    // 打开预约页面
    openReserve: function(srcId, sourceId) {
        if (clickFlag) return false;
        clickFlag = true;
    	var url = baseCityUrl + "reserve?srcId=" + srcId;

    	if (typeof sourceId != "undefined") {
    		url += "&sourceId=" + sourceId;
    	}

    	if (srcId == "Sale" || srcId == "SpecialSale" || srcId =="SpecialGoods" ||srcId=="BrandSpecialDetail" || srcId == "Brand" || srcId == "BrandDetail" || srcId == "Goods") { // 0元预约先验证是否登录
    		$.post(baseUrl + "member/authCheck", function(data) {
    			if (data.status == 1) {
    				$.post(baseCityUrl + "reserve", {"source_id":sourceId,"srcId":srcId}, function(data) {
    		            if (data.status == 1) {
    		            	var url = baseCityUrl + "reserve/success?" + data.data.link;
                            
    		                window.location.href = url;
    		            } else {
    		            	alert(data.msg);

    		                submitFlag = false;
    		            }
    		        }, "json").error(function() {submitFlag = false;})
    			} else {
                    if(srcId == "Sale"){
                        base.openModal(url, '免费预约', 502, 564, true);
                    }else if(srcId == "Goods"){
                        base.openModal(url, '免费预约', 502, 564, true);
                    }else if (srcId == "Brand") {
                        base.openModal(url, '免费预约', 502, 400, true);
                    }else if (srcId == "BrandDetail") {
                        base.openModal(url, '免费预约', 502, 460, true);
                    }else if(srcId == 'BrandSpecialDetail'){
                        base.openModal(url, '免费预约', 570, 460, true);
                    }else {
                        base.openModal(url, '免费预约', 900, 400, true);
                    }
    			}
    		}, "json");
    	} else {
            base.openModal(url, '免费预约', 502, 564, true);
    	}
    },
    // 提交预约
    reserve: function(formId, srcId, fromSource, fromSourceName) {
        if (submitFlag) return false;
        submitFlag = true;

        var msgBox = $(formId).find("#J_MsgReserveSubmit");

        msgBox.addClass("hide").find(".msg-cnt").text("");

        var reserve_name = $(formId).find("#reserve_name").length == 1 ? $(formId).find("#reserve_name").val() : '';
        var reserve_mobile = $(formId).find("#reserve_mobile").length == 1 ? $(formId).find("#reserve_mobile").val() : '';
        var reserve_code = $(formId).find("#reserve_code").length == 1 ? $(formId).find("#reserve_code").val() : '';
        var reserve_sex = $(formId).find("input[name=reserve_sex]").length > 1 ? $(formId).find("input[name=reserve_sex]:checked").val() : '';
        // var reserve_address = $(formId).find("#reserve_address").length == 1 ? $(formId).find("#reserve_address").val() : '';
        var source_id = $(formId).find("#source_id").length == 1 ? $(formId).find("#source_id").val() : '';
        var reserve_ticket = $(formId).find("input[name=reserve_ticket]").length == 1 ? $(formId).find($('#reserve_ticket')).val() : '';

        if (typeof fromSource == "undefined") {
            fromSource = "";
        }

        if (typeof fromSourceName == "undefined") {
            fromSourceName = "";
        }

        $.post(baseCityUrl + "reserve", {"reserve_name":reserve_name,"reserve_mobile":reserve_mobile,"reserve_sex":reserve_sex,"reserve_ticket":reserve_ticket,"reserve_code":reserve_code,"source_id":source_id,"srcId":srcId,"from_source":fromSource,"from_source_name":fromSourceName}, function(data) {
            if (data.status == 1) {
            	var url = baseCityUrl + "reserve/success?" + data.data.link;

                window.location.href = url;
            } else {
                msgBox.removeClass("hide").find(".msg-cnt").text(data.msg);

                if ($(formId).find(".verify-image").length == 1) {
                	$(formId).find(".verify-image").click();
                }

                submitFlag = false;
            }
        }, "json").error(function() {submitFlag = false;})

    },
    // 模拟ALERT框 type 1:正确提示2:错误提示 title:提示标题 content:提示内容 button:提示按钮内容
    alertBox: function(type, title, content, button, callback) {
        var alertTpl =
            '<div class="xj-alert-blind"></div>' +
            '<div class="xj-alert-primary">' +
                '<div class="xj-alert-header">' +
                    '<a class="xj-alert-close" href="javascript:void(0);"></a>' +
                '</div>' +
                '<div class="xj-alert-body">' +
                    '<div class="xj-alert-title{type}">{title}</div>' +
                    '<p class="xj-alert-content">{content}</p>' +
                '</div>' +
                '<div class="xj-alert-footer">' +
                    '<button class="xj-alert-button" type="button">{button}</button>' +
                '</div>' +
            '</div>';
        
        // 内容替换 
        alertTpl = alertTpl.replace('{type}', type == 1 ? '' : ' error').replace('{title}', title).replace('{content}', content).replace('{button}', button);
        
        var tpl = document.createElement('div');

        tpl.innerHTML = alertTpl;
        
        document.body.appendChild( tpl );
        
        // 创建DOM
        var alertDOM = { wrap : $( tpl ) },
            i = 0,
            elem = tpl.getElementsByTagName('*');
            elemLen = elem.length;

        for ( ; i < elemLen; i++ ){
            var name = elem[i].className.replace('xj-alert-', '');
            if ( name ) alertDOM[name] = $( elem[i] );
        }
        
        callback = callback || false;
        
        // 绑定关闭事件
        alertDOM.close.bind("click", function() {
            alertDOM.wrap.remove();
            
            return callback ? callback() : callback;
        });
        
        // 绑定关闭事件
        alertDOM.button.bind("click", function() {
            alertDOM.wrap.remove();
            
            return callback ? callback() : callback;
        });
    },
    // 领取优惠券
    getCoupon: function(couponId,srcId, callback) {
    	if (submitFlag) return false;
    	submitFlag = true;

    	$.post(baseUrl + 'member/authCheck', function(data) {
            if (data.status == 1) { // 已登录
                $.post(baseCityUrl + 'getCoupon', {"coupon_id":couponId}, function(data) {
                    if (data.status == 1) {
                        base.openModal(baseCityUrl + 'coupon/success?couponId=' + couponId, '领取成功', 500, 582, true);

                        callback();
                    } else {
                        alert(data.msg);
                    }
                })
            } else { // 未登录
                jLoginCallback = function() {base.getCoupon(couponId,srcId, callback);}
                if(srcId == 'coupons'){
                    base.openModal(baseCityUrl + 'getCoupon?couponId=' + couponId +'&srcId='+srcId, '领优惠券',500, 366,true);
                }else{
                    base.openModal(baseCityUrl + 'getCoupon?couponId=' + couponId +'&srcId='+srcId, '领优惠券', 570, 400, true);
                }
            }

    		submitFlag = false;
    	}, "json").error(function() {submitFlag = false;});
    },
    // 写日记
    writeDairy: function(callback) {
        if (submitFlag) return false;
        submitFlag = true;

        $.post(baseUrl + 'member/authCheck', function(data) {
            if (data.status == 1) { // 已登录
                base.openModal(baseCityUrl + 'member/addCase', '我的新家日记', 500, 660);
            } else { // 未登录
                
                jLoginCallback = function() {base.writeDairy(callback);}
                base.jLogin();
            }
            submitFlag = false;
        }, "json").error(function() {submitFlag = false;});  
    },
    //装修日记点赞
    thumbsUp: function(source_id, callback) {
        if (submitFlag) return false;
        submitFlag = true;
        $.post(baseUrl + 'member/authCheck', function(data) {
            if (data.status == 1) { // 已登录
                $.post(baseUrl + 'diary/thumbsup/'+source_id, function(data2) {
                    if (data2.status == 1) {
                        var action_count = $('.dairy_zan_'+source_id+' i').html();
                        if(data2.data.action == 'del') {
                            $('.dairy_zan_'+source_id+' img').attr('src', '/assets/img/design/zan.png');
                            $('.dairy_zan_'+source_id+' i').html(Number(action_count) - 1);
                        } else {
                            $('.dairy_zan_'+source_id+' img').attr('src', '/assets/img/design/red-zan.png');
                            $('.dairy_zan_'+source_id+' i').html(Number(action_count) + 1);
                        }
                    } else {
                        // alert(data2.msg);
                    }
                })

            } else { // 未登录
                
                jLoginCallback = function() {base.thumbsUp(callback);}
                base.jLogin();
            }
            submitFlag = false;
        }, "json").error(function() {submitFlag = false;});  
    },
    //装修日记收藏
    collectUp: function(source_id, callback) {
        if (submitFlag) return false;
        submitFlag = true;
        $.post(baseUrl + 'member/authCheck', function(data) {
            if (data.status == 1) { // 已登录
                $.post(baseUrl + 'diary/collectup/'+source_id, function(data2) {
                    if (data2.status == 1) {
                        var action_count = $('.dairy_cang_'+source_id+' i').html();
                        if(data2.data.action == 'del') {
                            $('.dairy_cang_'+source_id+' img').attr('src', '/assets/img/design/cang.png');
                            $('.dairy_cang_'+source_id+' i').html(Number(action_count) - 1);
                        } else {
                            $('.dairy_cang_'+source_id+' img').attr('src', '/assets/img/design/red-cang.png');
                            $('.dairy_cang_'+source_id+' i').html(Number(action_count) + 1);
                        }
                    } else {
                        // alert(data2.msg);
                    }
                })

            } else { // 未登录
                
                jLoginCallback = function() {base.collectUp(callback);}
                base.jLogin();
            }
            submitFlag = false;
        }, "json").error(function() {submitFlag = false;});  
    },
    commentLogin: function() {
        jLoginCallback = function() {window.location.reload();}
        base.jLogin();

    },
    //网友问答
    getQuestion:function(url){
        if (submitFlag) return false;
        submitFlag = true;

        $.post(baseUrl + 'member/authCheck', function(data) {
            if (data.status == 1) { // 已登录
                base.openModal(url,'我要提问',710,525);
            } else { // 未登录
                jLoginCallback = function() {base.openModal(url,'我要提问',710,525);}

                base.jLogin();
            }

            submitFlag = false;
        }, "json").error(function() {submitFlag = false;});

    },
    // 验证两位正小数
    checkDouble: function(val) {
        var reg = /^\d*(?:\.\d{0,2})?$/;

        if (reg.test(val)) {
            return true;
        } else {
            return false;
        }
    },
    // 日期选择
    datePicker: function(obj) {
        obj.datepicker({
            dateFormat: "yy-mm-dd",
            changeYear:true,
            changeMonth:true,
            firstDay: 1,
            monthNames: [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月" ],
            monthNamesShort: [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月" ],
            dayNames: [ "星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六" ],
            dayNamesMin : [ "日", "一", "二", "三", "四", "五", "六" ],
            showMonthAfterYear: true,
            yearSuffix: '年'

        });
    },
    // 弹框登录
    jLogin: function() {
        base.openModal(baseUrl + 'member/login', '欢迎登录', 450, 315, false);
    },
    // 加法
    jbAdd: function(arg1, arg2) {
        var r1, r2, m, c;

        try {
            r1 = arg1.toString().split(".")[1].length;
        } catch (e) {
            r1 = 0;
        }

        try {
            r2 = arg2.toString().split(".")[1].length;
        } catch (e) {
            r2 = 0;
        }

        c = Math.abs(r1 - r2);
        m = Math.pow(10, Math.max(r1, r2));

        if (c > 0) {
            var cm = Math.pow(10, c);
            if (r1 > r2) {
                arg1 = Number(arg1.toString().replace(".", ""));
                arg2 = Number(arg2.toString().replace(".", "")) * cm;
            } else {
                arg1 = Number(arg1.toString().replace(".", "")) * cm;
                arg2 = Number(arg2.toString().replace(".", ""));
            }
        } else {
            arg1 = Number(arg1.toString().replace(".", ""));
            arg2 = Number(arg2.toString().replace(".", ""));
        }

        return (arg1 + arg2) / m;
    },
    // 减法
    jbSub: function(arg1, arg2) {
        var r1, r2, m, n;

    　　 try{
            r1 = arg1.toString().split(".")[1].length;
        } catch (e) {
            r1 = 0;
        }

    　　 try{
            r2 = arg2.toString().split(".")[1].length;
        } catch (e) {
            r2 = 0;
        }

    　　 m = Math.pow(10, Math.max( r1, r2 ));
    　　 n = ( r1 >= r2 ) ? r1 : r2;

    　　 return ((arg1 * m - arg2 * m)/m).toFixed(n);
    },
    // 乘法
    jbMul: function(arg1, arg2) {
        var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

        try {
            m += s1.split(".")[1].length
            ;
        } catch (e) { }

        try {
            m += s2.split(".")[1].length;
        } catch (e) { }

        return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m);
    },
    // 除法
    jbDiv: function(arg1, arg2) {
        var t1 = 0, t2 = 0, r1, r2;

        try {
            t1 = arg1.toString().split(".")[1].length
        } catch (e) { }

        try {
            t2 = arg2.toString().split(".")[1].length
        } catch (e) { }

        with (Math) {
            r1 = Number(arg1.toString().replace(".", ""))
            r2 = Number(arg2.toString().replace(".", ""))

            return (r1 / r2) * pow(10, t2 - t1);
        }
    },
    // 价格格式化
    price: function(x) {

        var f_x = parseFloat(x);

        if (isNaN(f_x)) {
            return '0.00';
        }

        f_x = Math.round(f_x*100)/100;

        var s_x = f_x.toString();
        var pos_decimal = s_x.indexOf('.');

        if (pos_decimal < 0) {
            pos_decimal = s_x.length;
            s_x += '.';
        }

        while (s_x.length <= pos_decimal + 2) {
            s_x += '0';
        }

        return s_x;
    },
    // 多行文本超出省略 pDom：父级节点对象 cTagName 子节点标签名
    dotdot: function(pDom, cTagName) {
        // 超出高度省略号
        pDom.each(function(i){
            var divH = $(this).height();
            var $p = $(cTagName, $(this)).eq(0);
            while ($p.outerHeight() > divH) {
                $p.text($p.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/, "..."));
            };
        });
    }
}

$(document).ready(function() {
    // 图片延迟加载
    $(".lazy").lazyload({
        effect: "fadeIn",
        threshold: 100,
        failure_limit: 1000,
        skip_invisible: false
    });

    // 手机客户端
    $("#J_MoblieClient").hover(function() {
        $("#J_MoblieClient .code").css("display", "block");
    }, function() {
        $("#J_MoblieClient .code").css("display", "none");
    });

    /*城市选择*/    
    $(".up").click(function(event) {
        $(".city_list").toggle();
    });
    /*城市选择*/

    /*二级导航*/
    $(".drop-menu-effect").hover(function() {
        $(this).find(".two_nav").show().animate({width:"90px","margin-left":"-40px"}, 200).find("li").show();
    }, function() {
        $(this).find(".two_nav").animate({width:"0px","margin-left":"0px"}, 200).hide().find("li").hide();
    });


    $("#J_WxCode").hover(function() {
    	$("#J_WxCode .wx_code").show();
    }, function() {
    	$("#J_WxCode .wx_code").hide();
    });

    if ($(".hot").length > 0) {
        var top = $(".hot").position().top;
        var animate_top = top - 5;

        setInterval(function() {
            $(".hot").animate({top:animate_top + "px"}, 200).animate({top:top + "px"}, 200);
        }, 400);
    }
});

$(document).click(function(event) {
    if (!$(".up").is(event.target)) {
		$(".city_list").hide();
    }
});
