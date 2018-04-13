<?php
header("Content-Type: text/html;charset=utf-8"); 
require ("../config/conn.php");//引入链接数据库
if (!$db)
{
    die('连接失败: ' . mysqli_error($db));
}
else
{
	if(empty($_COOKIE['login'])){
		echo "<script>alert('您的登录密码已经过期，请您再次输入');location.href=\"../Login.php\";</script>"; 
	}
	
	$useragent=$useragent=$_SERVER['HTTP_USER_AGENT'];
	
	function getBrowser(){
		$agent=$_SERVER["HTTP_USER_AGENT"];
		if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
		return "ie";
		else if(strpos($agent,'Firefox')!==false)
		return "firefox";
		else if(strpos($agent,'Chrome')!==false)
		return "chrome";
		else if(strpos($agent,'Opera')!==false)
		return 'opera';
		else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
		return 'safari';
		else
		return 'unknown';
	}
	 
	function getBrowserVer(){
		if (empty($_SERVER['HTTP_USER_AGENT'])){    //当浏览器没有发送访问者的信息的时候
			return 'unknow';
		}
		$agent= $_SERVER['HTTP_USER_AGENT'];   
		if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif ((strpos($agent,'Chrome')==false)&&preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
			return $regs[1];
		else
			return 'unknow';
	}
	
	/*取得操作系统版本*/
	function os($ua) {
		$os = "";
		if (stripos($ua, "Googlebot")) {
			$os = "谷歌蜘蛛";
		}
		elseif(stripos($ua, "Baiduspider") !== false) {
			$os = "百度蜘蛛";
		}
		elseif(stripos($ua, "Yahoo!") !== false) {
			$os = "雅虎蜘蛛";
		}
		elseif(stripos($ua, "bingbot")) {
			$os = "必应蜘蛛";
		}
		elseif(stripos($ua, "YRSpider")) {
			$os = "云壤蜘蛛";
		}
		elseif(stripos($ua, "Yeti") !== false) {
			$os = "Naver蜘蛛";
		}
		elseif(stripos($ua, "Windows NT")) {
			switch (substr($ua, stripos($ua, "Windows NT") + 11, 3)) {
			case 5.0:
				{
					$os = "Windows 2000";
					break;
				}
			case 5.1:
				{
					$os = "Windows XP";
					break;
				}
			case 5.2:
				{
					$os = "Windows 2003";
					break;
				}
			case 6.0:
				{
					$os = "Windows Vista/2008";
					break;
				}
			case 6.1:
				{
					$os = "Windows 7";
					break;
				}
			case 6.2:
				{
					$os = "Windows 8";
					break;
				}
			default:
				{
					$os = "Windows";
					break;
				}
			}
			if (stripos($ua, "WOW64")) {
				$os.= "(X64)";
			} else {
				$os.= "(X86)";
			}
		}
		elseif(stripos($ua, "Android")) {
			$os = substr($ua, stripos($ua, "Android"), 11);
		}
		elseif(stripos($ua, "Linux")) {
			if (stripos($ua, "i686")) {
				$os = "Linux X86";
			} else {
				$os = "Linux";
			}
			if (stripos($ua, "X11")) {
				$os.= "(X Window)";
			}
		}
		elseif(stripos($ua, "Macintosh")) {
			$os = "Mac";
		}
		elseif(stripos($ua, "IOS")) {
			$os = "iOS";
		}
		elseif(stripos($ua, "ZTE")) {
			$os = "ZTE";
		}
		elseif(stripos($ua, "Windows 98")) {
			$os = "Windows 98";
		} else {
			$os = "未知系统";
		}
		return $os;
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>网站服务器环境资料</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){ //这个就是传说的ready      
            $(".stripe tr:even").addClass("old");  
        });  
    </script>
</head>
<body>
<form id="form1" runat="server">
    <div class="place">
        <span>位置：网站服务器环境资料</span>
        <ul class="placeul">
            <!--<li><a href="jvavscript:void(0);">网站服务器环境资料</a></li>-->
        </ul>
    </div>
    <div class="mainindex">
        <div class="welinfo">
            <span></span> 
            <div style="background-color:#ccc; height:42px; line-height:42px;"><b>服务器相关信息</b></div>
            <table width="100%" cellpadding="2" cellspacing="1" style="background-color:#f2f2f2;">
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务器名称：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["SERVER_SOFTWARE"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务端IP：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["SERVER_ADDR"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HTTPS：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["SERVER_PROTOCOL"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务端接受请求时间:</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["REQUEST_TIME"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请求Connection信息</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["HTTP_CONNECTION"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;使用的CGI脚本规范：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["GATEWAY_INTERFACE"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HTTP访问端口：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["SERVER_PORT"]; ?></td>
                    </tr>
            </table>
            <br />
        </div>
        <div class="welinfo">
            <span></span> 
            <div style="background-color:#ccc; height:42px; line-height:42px;"><b>浏览者相关信息</b></div>
            <table width="100%" cellpadding="2" cellspacing="1" style=" background-color:#f2f2f2;">
                    <tr>
                      <td width="15%" height="43" class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览者ip地址：</td>
                      <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["REMOTE_ADDR"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览器：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo getBrowser(); ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JavaScript：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;">3.0</td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;语言：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo $_SERVER["HTTP_ACCEPT_LANGUAGE"]; ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览者操作系统：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo os($useragent); ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览器版本：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;"><?php echo getBrowserVer(); ?></td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cookies：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;">True</td>
                    </tr>
                    <tr>
                        <td height="43"  class="forumrow" style=" font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frames(分栏)：</td>
                        <td class="forumrow" style=" text-align:left; padding-left:215px;">True</td>
                    </tr>
            </table>
            <br />
        </div>
        <div class="welinfo">
            <span></span> 
            <!--<div style="background-color:#ccc; height:42px; line-height:42px;"><b>执行效率相关情况</b></div>--> 
            
            <br />
        </div>
    </div>
    <script type="text/javascript">
        $('.welinfo tr:odd').addClass('odd');
    </script>
</form>
</body>
</html>
