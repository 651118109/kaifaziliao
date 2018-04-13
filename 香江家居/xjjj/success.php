<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>报名成功</title>
    <script src="./js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./css/repair.css" />
    <script type="text/javascript" async="" src="./js/repair.js"></script>
    <script type="text/javascript">
        var wait=5;
        function time() {
            if (wait == 0) {
                location.href="index.html";
            } else {
                $("#time").html(wait);
                wait--;
                setTimeout(function() {
                        time()
                    },
                    1000)
            }
        }
        $(document).ready(function(){
            time();
        })
    </script>
</head>
<body>
<div style="width:100%;">
    <div style="width:212px;margin:0px auto;margin-top:100px;text-align: center;">
        <img src="./images/success.jpg" />
    </div>
    <div style="width:212px;margin:10px auto;text-align: center;">
        正在为您跳转页面<b id="time">5</b>s
    </div>
</div>
</body>
</html>