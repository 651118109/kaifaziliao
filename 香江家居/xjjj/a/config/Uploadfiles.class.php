<?php
/**
 * 专门用于操作数据库的类
 */

class Uploadfiles
{
	/**
     * 
     * 上传图片
     * @param  $name:获取请求上传图片的文件域的名称
     * @param  $upload:上传地址
     * @param  $names:获取请求上传图片的文件域的内容为空时，默认的图片
     * @param  $width：要修改的图片宽度
     * @param  $height：要修改的图片高度
     * @param  $water：s水印图片
     * @param  $positon：水印的位置
     * @param  $alpha：水印的透明度
     */
    public  function upload_image($name,$upload,$names="",$width="",$height="",$water="",$positon=3,$alpha=50)
    {
        if (!empty($_FILES[$name]["name"])) 
        {
            //提取文件域内容名称，并判断
            $path = "../../$upload/"; //上传路径
//            //判断上传的图片大小
//            $filesize=$_FILES[$name]["size"];
//            if($filesize>2097152)
//            {
//                return "Out of size";
//                exit;
//            }
            $filetype = $_FILES[$name]['type'];
            if ($filetype == "image/jpeg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/jpg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/png")
            {
                $type = '.png';
            }
            else if ($filetype == "image/gif")
            {
                $type = '.gif';
            }
            else
            {
                return "error in type";
                exit;
            }
            $num=rand(1, 10000);
            $today = date("YmdHis").$num; //获取时间并赋值给变量
            $filename = $path . $today . $type; //图片的完整路径
            $imgongsi2 = $today . $type; //图片名称
            $editimg= "$upload".$imgongsi2;
            move_uploaded_file($_FILES[$name]["tmp_name"], $filename);
            if(!empty($names)&&file_exists("../../".$names))
            {
                unlink("../../".$names);
            }
            if($type==".png")
            {
                if(!empty($water)&&$water!="*")
                {
                    $format_array=explode(".",$water);
                    $format=$format_array[count($format_array)-1];
                    if($format!="png")
                    {
                        $this->img_water_nopng($filename,"../../".$water,$path,$imgongsi2,$positon,$alpha);
                    }
                    else
                    {
                        $this->img_water_png($filename,"../../".$water,$path,$imgongsi2,$positon,$alpha);
                    }

                    return $this->scal_pic($filename,$editimg,$width,$height);
                }
                else
                {
                    return $this->pngthumb($filename,$editimg,$width,$height);
                }
            }
            else
            {
                if(!empty($water)&&$water!="*")
                {
                    $format_array=explode(".",$water);
                    $format=$format_array[count($format_array)-1];
                    if($format!="png")
                    {
                        $this->img_water_nopng($filename,"../../".$water,$path,$imgongsi2,$positon,$alpha);
                    }
                    else
                    {
                        $this->img_water_png($filename,"../../".$water,$path,$imgongsi2,$positon,$alpha);
                    }
                    return $this->scal_pic($filename,$editimg,$width,$height);
                }
                else
                {
                    return $this->scal_pic($filename,$editimg,$width,$height);
                }
            }
        }
        else
        {
            $editimg=empty($names)?"":$names;
            return $editimg;
        }
    }

    /**
     * png的图片上传
     * @param $sourePic：需要修改的原图片（完整路径和图片名称）；
     * @param $editimg：要上传到数据库的图片路径；
     * @param $width：要修改的图片宽度；
     * @param $height：要修改的图片高度；
     * 1.如果宽高为空，按图片原大小上传
     * 2.如果宽非空，高为空，按输入的宽度等比例缩放
     * 3.如果宽高都非空，按输入的宽高缩放
     */
    public function pngthumb($sourePic,$editimg,$width="",$height="")
    {
        $image=imagecreatefrompng($sourePic);//PNG
        imagesavealpha($image,true);//这里很重要 意思是不要丢了$sourePic图像的透明色;
        $BigWidth=imagesx($image);//大图宽度
        $BigHeigh=imagesy($image);//大图高度
        //获取图片信息
        $pic_scal_arr = @getimagesize($sourePic); //另一种获取图片宽高的方法：$pic_scal_arr[0]=大图宽度 ；$pic_scal_arr[1]=大图高度

        if((empty($height)||$height=="*")&&(empty($width)||$width=="*"))
        {
            $re_width=$pic_scal_arr[0];
            $re_height=$pic_scal_arr[1];
        }
        else if((empty($height)||$height=="*")&&(!empty($width)||$width!="*"))
        {
            //判断/计算压缩大小
            $max_width = $width;//最大宽度,象素，高度不限制
            $min_width = 1;
            $min_heigth = 1;
            if($pic_scal_arr[0]<$min_width || $pic_scal_arr[1]<$min_heigth)
            {
                return false;
            }
            $re_scal = ($max_width / $pic_scal_arr[0]);  //缩放（放大）参数
            $re_width = round($pic_scal_arr[0] * $re_scal);
            $re_height = round($pic_scal_arr[1] * $re_scal);
        }
        else if((empty($width)||$width=="*")&&(!empty($width)||$width!="*"))
        {
            //判断/计算压缩大小
            $max_height = $height;//最大高度,象素，宽度不限制
            $min_width = 1;
            $min_heigth = 1;
            if($pic_scal_arr[0]<$min_width || $pic_scal_arr[1]<$min_heigth)
            {
                return false;
            }
            $re_scal = ($max_height / $pic_scal_arr[1]);  //缩放（放大）参数
            $re_width = round($pic_scal_arr[0] * $re_scal);
            $re_height = round($pic_scal_arr[1] * $re_scal);
        }
        else
        {
            //固定大小
            $re_width = $width;
            $re_height = $height;
        }
        $thumb = imagecreatetruecolor($re_width,$re_height);
        imagealphablending($thumb,false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;
        imagesavealpha($thumb,true);//这里很重要,意思是不要丢了$thumb图像的透明色;
        $smallFileName=$sourePic;  //新图片使用要改变大小的原图片的路径可以替换原图片，如果不想替换掉，可以另起名然后填写路径
        if(imagecopyresampled($thumb,$image,0,0,0,0,$re_width,$re_height,$BigWidth,$BigHeigh)){
            imagepng($thumb,$smallFileName);}
        return $editimg;//返回小图路径
    }
    /**
     * 除png以外的图片上传
     * 1.如果宽高为空，按图片原大小上传
     * 2.如果宽非空，高为空，按输入的宽度等比例缩放
     * 3.如果宽高都非空，按输入的宽高缩放
     */
    function scal_pic($sourePic,$editimg,$width="",$height="")
    {
        $smallFileName=$sourePic;
        //验证参数
        if(!is_string($sourePic) || !is_string($smallFileName))
        {
            return false;
        }
        //获取图片信息
        $pic_scal_arr = @getimagesize($sourePic);
        if(!$pic_scal_arr)
        {
            return false;
        }
        //获取图象标识符
        $pic_creat = '';
        switch($pic_scal_arr['mime'])
        {
            case 'image/jpeg':
                $pic_creat = @imagecreatefromjpeg($sourePic);
                break;
            case 'image/gif':
                $pic_creat = @imagecreatefromgif($sourePic);
                break;
            case 'image/png':
                $pic_creat = @imagecreatefrompng($sourePic);
                break;
            case 'image/wbmp':
                $pic_creat = @imagecreatefromwbmp($sourePic);
                break;
            default:
                return false;
                break;
        }
        if(!$pic_creat)
        {
            return false;
        }
        if((empty($height)||$height=="*")&&(empty($width)||$width=="*"))
        {
            $re_width=$pic_scal_arr[0];
            $re_height=$pic_scal_arr[1];
        }
        else if((empty($height)||$height=="*")&&(!empty($width)||$width!="*"))
        {
            //判断/计算压缩大小
            $max_width = $width;//最大宽度,象素，高度不限制
            $min_width = 1;
            $min_heigth = 1;
            if($pic_scal_arr[0]<$min_width || $pic_scal_arr[1]<$min_heigth)
            {
                return false;
            }
            $re_scal = ($max_width / $pic_scal_arr[0]);  //缩放（放大）参数
            $re_width = round($pic_scal_arr[0] * $re_scal);
            $re_height = round($pic_scal_arr[1] * $re_scal);
        }
        else if((empty($width)||$width=="*")&&(!empty($width)||$width!="*"))
        {
            //判断/计算压缩大小
            $max_height = $height;//最大高度,象素，宽度不限制
            $min_width = 1;
            $min_heigth = 1;
            if($pic_scal_arr[0]<$min_width || $pic_scal_arr[1]<$min_heigth)
            {
                return false;
            }
            $re_scal = ($max_height / $pic_scal_arr[1]);  //缩放（放大）参数
            $re_width = round($pic_scal_arr[0] * $re_scal);
            $re_height = round($pic_scal_arr[1] * $re_scal);
        }
        else
        {
            $re_width = $width;
            $re_height = $height;
        }
        //创建空图象
        $new_pic = @imagecreatetruecolor($re_width,$re_height);
        if(!$new_pic)
        {
            return false;
        }
        //复制图象
        if(!@imagecopyresampled($new_pic,$pic_creat,0,0,0,0,$re_width,$re_height,$pic_scal_arr[0],$pic_scal_arr[1]))
        {
            return false;
        }
        //输出文件
        switch($pic_scal_arr['mime'])
        {
            case 'image/jpeg':
                $out_file = @imagejpeg($new_pic,$smallFileName);
                break;
            case 'image/jpg':
                $out_file = @imagejpeg($new_pic,$smallFileName);
                break;
            case 'image/gif':
                $out_file = @imagegif($new_pic,$smallFileName);
                break;
            case 'image/bmp':
                $out_file = @imagebmp($new_pic,$smallFileName);
                break;
            default:
                return false;
                break;
        }
        if($out_file)
        {
            return $editimg;
        }
        else
        {
            return false;
        }
    }
    /**
     * 图片加水印（适用于jpg/gif格式）
     *
     * @author flynetcn
     *
     * @param $srcImg 原图片
     * @param $waterImg 水印图片
     * @param $savepath 保存路径
     * @param $savename 保存名字
     * @param $positon 水印位置
     * 1:顶部居左, 2:顶部居右, 3:居中, 4:底部局左, 5:底部居右
     * @param $alpha 透明度 -- 0:完全透明, 100:完全不透明
     *
     * @return 成功 -- 加水印后的新图片地址
     *          失败 -- -1:原文件不存在, -2:水印图片不存在, -3:原文件图像对象建立失败
     *          -4:水印文件图像对象建立失败 -5:加水印后的新图片保存失败
     */
    function img_water_nopng($srcImg, $waterImg, $savepath, $savename, $positon=3, $alpha=50)
    {
        $temp = pathinfo($srcImg);
        $name = $temp['basename'];
        $path = $temp['dirname'];
//        $exte = $temp['extension'];
        $savename = $savename ? $savename : $name;
        $savepath = $savepath ? $savepath : $path;
        $savefile = $savepath .'/'. $savename;
        $srcinfo = @getimagesize($srcImg);
        if (!$srcinfo) {
            return -1; //原文件不存在
        }
        $waterinfo = @getimagesize($waterImg);
        if (!$waterinfo) {
            return -2; //水印图片不存在
        }
        $srcImgObj = $this->image_create_from_ext($srcImg);
        if (!$srcImgObj) {
            return -3; //原文件图像对象建立失败
        }
        $waterImgObj = $this->image_create_from_ext($waterImg);
        if (!$waterImgObj) {
            return -4; //水印文件图像对象建立失败
        }
        switch ($positon) {
            //1顶部居左
            case 1: $x=$y=0; break;
            //2顶部居中
            case 2: $x = ($srcinfo[0]-$waterinfo[0])/2 ; $y = 0; break;
            //3顶部居右
            case 3: $x = $srcinfo[0]-$waterinfo[0] ; $y = 0; break;
            //4中部居左
            case 4: $x = 0; $y = ($srcinfo[1]-$waterinfo[1] )/2; break;
            //5中部居中
            case 5: $x = ($srcinfo[0]-$waterinfo[0] )/2; $y = ($srcinfo[1]-$waterinfo[1] )/2; break;
            //6中部居右
            case 6: $x = $srcinfo[0]-$waterinfo[0] ; $y = ($srcinfo[1]-$waterinfo[1] )/2; break;
            //7底部居左
            case 7: $x = 0; $y = $srcinfo[1]-$waterinfo[1] ; break;
            //8底部居中
            case 8: $x = ($srcinfo[0]-$waterinfo[0] )/2; $y = $srcinfo[1]-$waterinfo[1] ; break;
            //9底部居右
            case 9: $x = $srcinfo[0]-$waterinfo[0] ; $y = $srcinfo[1]-$waterinfo[1] ; break;
            //10随机位置
            case 10:
                $x = rand(0,($srcinfo[1]-$waterinfo[1]));
                $y = rand(0,($srcinfo[1]-$waterinfo[1]));
                break;
            default: $x=$y=0;
        }
        imagecopymerge($srcImgObj, $waterImgObj, $x, $y, 0, 0, $waterinfo[0], $waterinfo[1], $alpha);
        switch ($srcinfo[2]) {
            case 1: imagegif($srcImgObj, $savefile); break;
            case 2: imagejpeg($srcImgObj, $savefile); break;
            case 3: imagepng($srcImgObj, $savefile); break;
            default: return -5; //保存失败
        }
        imagedestroy($srcImgObj);
        imagedestroy($waterImgObj);
        return $savefile;
    }
    function image_create_from_ext($imgfile)
    {
        $info = getimagesize($imgfile);
        $im = null;
        switch ($info[2]) {
            case 1: $im=imagecreatefromgif($imgfile); break;
            case 2: $im=imagecreatefromjpeg($imgfile); break;
            case 3: $im=imagecreatefrompng($imgfile); break;
        }
        return $im;
    }

    /**
     * 图片加水印（适用于png格式）
     *
     * @author flynetcn
     *
     * @param $oldimage_name 原图片
     * @param $image_path 水印图片
     * @param $savepath 保存路径
     * @param $new_image_name 保存名字
     * @param $positon 水印位置
     * 1:顶部居左, 2:顶部居右, 3:居中, 4:底部局左, 5:底部居右
     *
     * @return 成功 -- 加水印后的新图片地址
     *          失败 -- -1:原文件不存在, -2:水印图片不存在, -3:原文件图像对象建立失败
     *          -4:水印文件图像对象建立失败 -5:加水印后的新图片保存失败
     */
    function img_water_png($oldimage_name,$image_path,$savepath,$new_image_name,$positon=3)
    {
        list($owidth,$oheight) = getimagesize($oldimage_name);
        $width = $owidth;
        $height = $oheight;
        $im = imagecreatetruecolor($width, $height);
        $format_array=explode(".",$oldimage_name);
        $format=$format_array[count($format_array)-1];
        if($format!="png")
        {
            $img_src = imagecreatefromjpeg($oldimage_name);
        }
        else
        {
            $img_src = imagecreatefrompng($oldimage_name);
        }
        imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
        $watermark = imagecreatefrompng($image_path);
        list($w_width, $w_height) = getimagesize($image_path);

        switch ($positon) {
            //1顶部居左
            case 1: $x=$y=0; break;
            //2顶部居中
            case 2: $x = ($width -$w_width)/2 ; $y = 0; break;
            //3顶部居右
            case 3: $x = $width -$w_width ; $y = 0; break;
            //4中部居左
            case 4: $x = 0; $y = ($height -$w_height )/2; break;
            //5中部居中
            case 5: $x = ($width -$w_width )/2; $y = ($height -$w_height )/2; break;
            //6中部居右
            case 6: $x = $width -$w_width ; $y = ($height -$w_height )/2; break;
            //7底部居左
            case 7: $x = 0; $y = $height -$w_height ; break;
            //8底部居中
            case 8: $x = ($width -$w_width )/2; $y = $height -$w_height ; break;
            //9底部居右
            case 9: $x = $width -$w_width ; $y = $height -$w_height ; break;
            //10随机位置
            case 10:
                $x = rand(0,($width -$w_width));
                $y = rand(0,($height -$w_height));
                break;
            default: $x=$y=0;
        }
        imagecopy($im, $watermark, $x, $y, 0, 0, $w_width, $w_height);
        $temp = pathinfo($oldimage_name);
        $name = $temp['basename'];
        $path = $temp['dirname'];
        $savepath = $savepath ? $savepath : $path;
        $savefile = $savepath .'/'. $new_image_name;
        imagejpeg($im, $savefile, 100);
        imagedestroy($im);
        return $new_image_name;
    }
    /**
     *
     * 上传水印
     * @param  $name:获取请求上传图片的文件域的名称
     * @param  $upload:上传地址
     * @param  $names:获取请求上传图片的文件域的内容为空时，默认的图片
     */
    public  function upload_waterimage($name,$names="",$upload="upload/company/")
    {
        if (!empty($_FILES[$name]["name"]))
        {
            //提取文件域内容名称，并判断
            $path = "../../$upload/"; //上传路径
            //判断上传的图片大小
            $filesize=$_FILES[$name]["size"];
            if($filesize>2097152)
            {
                return "Out of size";
                exit;
            }
            $filetype = $_FILES[$name]['type'];
            if ($filetype == "image/jpeg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/jpg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/png")
            {
                $type = '.png';
            }
            else if ($filetype == "image/gif")
            {
                $type = '.gif';
            }
            else
            {
                return "error in type";
                exit;
            }
            $today = "watermark";
            $filename = $path . $today . $type; //图片的完整路径
            $imgongsi2 = $today . $type; //图片名称
            $editimg= "$upload".$imgongsi2;
            $result = move_uploaded_file($_FILES[$name]["tmp_name"], $filename);
            if(!empty($names)&&file_exists("../../".$names))
            {
                unlink("../../".$names);
            }
            return $editimg;
        }
        else
        {
            $editimg=empty($names)?"":$names;
            return $editimg;
        }//END IF
    }
    /**
     *
     * 上传指定路径、指定名称
     * @param  $name:获取请求上传图片的文件域的名称
     * @param  $upload:上传地址
     * @param  $names:获取请求上传图片的文件域的内容为空时，默认的图片
     * @param  $names:指定名称
     * @param  $width:宽度
     * @param  $height:高度
     */
    public  function upload_cover($name,$names="",$upload="upload/company/",$title="",$width,$height)
    {
        if (!empty($_FILES[$name]["name"]))
        {
            //提取文件域内容名称，并判断
            $path = "../../$upload/"; //上传路径
            //判断上传的图片大小
            $filesize=$_FILES[$name]["size"];
            if($filesize>2097152)
            {
                return "Out of size";
                exit;
            }
            $filetype = $_FILES[$name]['type'];
            if ($filetype == "image/jpeg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/jpg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/png")
            {
                $type = '.png';
            }
            else if ($filetype == "image/gif")
            {
                $type = '.gif';
            }
            else
            {
                return "error in type";
                exit;
            }
            $today = $title;
            $filename = $path . $today . $type; //图片的完整路径
            $imgongsi2 = $today . $type; //图片名称
            $editimg= "$upload".$imgongsi2;
            $result = move_uploaded_file($_FILES[$name]["tmp_name"], $filename);
            if($type==".png")
            {
                return $this->pngthumb($filename,$editimg,$width,$height);
            }
            else
            {
                return $this->scal_pic($filename,$editimg,$width,$height);
            }
            return $editimg;
        }
        else
        {
            $editimg=empty($names)?"":$names;
            return $editimg;
        }
    }

    /**
     *
     * 普通上传图片
     * @param  $name:获取请求上传视频的文件域的名称
     * @param  $upload:上传地址
     * @param  $names:获取请求上传视频的文件域的内容为空时，默认的视频
     */
    public  function upload_picture($name,$upload,$names="")
    {
        if (!empty($_FILES[$name]["name"]))
        { //提取文件域内容名称，并判断
            $path = "../../$upload/"; //上传路径
            $filetype = $_FILES[$name]['type'];
            if ($filetype == "image/jpeg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/jpg")
            {
                $type = '.jpg';
            }
            else if ($filetype == "image/png")
            {
                $type = '.png';
            }
            else if ($filetype == "image/gif")
            {
                $type = '.gif';
            }
            else
            {
                return "error in type";
                exit;
            }
            $num=rand(1, 10000);
            $today = date("YmdHis").$num; //获取时间并赋值给变量
            $filename = $path . $today . $type; //图片的完整路径
            $imgongsi2 = $today . $type; //图片名称
            $editimg= "$upload/".$imgongsi2;
            $result = move_uploaded_file($_FILES[$name]["tmp_name"], $filename);
            if(!empty($names)&&file_exists("../../".$names))
            {
                unlink("../../".$names);
            }
            return $editimg;

        }
        else
        {
            $editimg=empty($names)?"":$names;
            return $editimg;
        }//END IF
    }

    /**
     * 
     * 上传视频
     * @param  $name:获取请求上传视频的文件域的名称
     * @param  $upload:上传地址
     * @param  $names:获取请求上传视频的文件域的内容为空时，默认的视频
     */
    public  function upload_video($name,$upload,$names="")
    {
        if (!empty($_FILES[$name]["name"])) 
        { //提取文件域内容名称，并判断
        $path = "../../$upload/"; //上传路径
        $filetype = $_FILES[$name]['type'];
        if ($filetype == "video/mp4") 
        {
            $type = '.mp4';
        }
        else
        {
            return "error in type";
            exit;
        }
        $num=rand(1, 10000);
        $today = date("YmdHis").$num; //获取时间并赋值给变量
        $filename = $path . $today . $type; //图片的完整路径
        $imgongsi2 = $today . $type; //图片名称
        $editvideo= "$upload/".$imgongsi2;
        $result = move_uploaded_file($_FILES[$name]["tmp_name"], $filename);
        return $editvideo;

        }
        else
        {
        $editvideo=empty($names)?"":$names;
        return $editvideo;
        }//END IF
    }
    
    /**
     * 
     * 上传文件（通用方法，以word为例）
     * @param  $name:获取请求上传文件的文件域的名称
     * @param  $upload:上传地址
     * @param  $names:获取请求上传文件的文件域的内容为空时，默认的文件
     */
    public  function upload_file($name,$upload,$names="")
    {
        if (!empty($_FILES[$name]["name"])) 
        {
            //提取文件域内容名称，并判断
            $path = "../../$upload/"; //上传路径
            //判断上传的文件大小
            $filesize=$_FILES[$name]["size"];
            if($filesize>2097152)
            {
                return "Out of size";
                exit;
            }
            //获取文件的扩展名
            $filetypes = explode(".", $_FILES[$name]["name"]);
            $count=count($filetypes);
            $filetype=$filetypes[$count-1];
            //判断扩展名
            if (strtolower($filetype) == "doc"||strtolower($filetype) == "docx")
            {
                $type = '.'.$filetype;
            }
            else
            {
                return "error in type";
                exit;
            }
            $num=rand(1, 10000);
            $today = date("YmdHis").$num; //获取时间并赋值给变量
            $filename = $path . $today . $type; //图片的完整路径
            $wordongsi2 = $today . $type; //图片名称
            $editword= "$upload/".$wordongsi2;
            $result = move_uploaded_file($_FILES[$name]["tmp_name"], $filename);
            $arry[0]=$editword;
            $arry[1]=$_FILES[$name]["name"];
            return $arry;

        }
        else
        {
        	return 2;
        }//END IF
    }

}
?>