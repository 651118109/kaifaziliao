function preview(file,preview)
{
    var prevDiv = document.getElementById(preview);
    if (file.files && file.files[0])
    {
        var reader = new FileReader();
        reader.onload = function(evt){
            prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
        }
        reader.readAsDataURL(file.files[0]);
    }
    else
    {
        prevDiv.innerHTML = '<div style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
    }
}

function fh()
{
    location.href="javascript:history.go(-1)";
}