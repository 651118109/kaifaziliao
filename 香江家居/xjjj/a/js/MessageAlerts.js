$(function () {
    setInterval(function () {
        $.post("MessageAlerts.ashx", { Id: 16 }, function (result) {
            if (result != "") {
                if (parseInt(result) > parseInt($("#AlertLabel").text())) {
                    var browser = navigator.appName
                    var b_version = navigator.appVersion
                    var version = b_version.split(";");
                    var trim_Version = version[1].replace(/[ ]/g, "");
                    if (browser == "Microsoft Internet Explorer" && trim_Version == "MSIE6.0") {
                        $('#newMessageDIV').html('<embed src="2487.mp3"/>');
                    }
                    else if (browser == "Microsoft Internet Explorer" && trim_Version == "MSIE7.0") {
                        $('#newMessageDIV').html('<embed src="2487.mp3"/>');
                    }
                    else if (browser == "Microsoft Internet Explorer" && trim_Version == "MSIE8.0") {
                        $('#newMessageDIV').html('<embed src="2487.mp3"/>');
                    }else{ 
                        //IE9+,Firefox,Chrome均支持<audio/> 
                        $('#newMessageDIV').html('<audio autoplay="autoplay"><source src="system.wav"' 
                        + 'type="audio/wav"/><source src="2487.mp3" type="audio/mpeg"/></audio>');
                    } 

                    $("#AlertLabel").text(result);
                }
            }
            else {
                //alert(result);
            }
        });
    }, 3000);
});