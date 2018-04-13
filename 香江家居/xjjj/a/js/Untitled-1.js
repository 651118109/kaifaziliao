// JavaScript Document
function showDiv() {
 var winWidth;
 var winHeight;
	if (document.body && document.body.clientHeight && document.body.clientWidth)
		{
			winHeight = document.body.clientHeight;
			winWidth = document.body.clientWidth;
		}
    document.getElementById('show').style.display="block";
    document.getElementById('show_win').style.display="block";
	document.getElementById('show').style.width=winWidth+"px";
	document.getElementById('show').style.height=winHeight+"px";
}

function x()
{
if (document.getElementById("show_win").style.display=="block")
{
document.getElementById("show_win").style.display="none";
document.getElementById("show").style.display="none";
}
}
