<?php
session_start(); 
    function makeCode()
    {
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for($i=0;$i<4;$i++){ // 个数
            $pos = rand(0,35);
            $str .= $string{$pos};
        }
        Session::put('img_number',$str);
        $img_handle = imagecreate(80, 40);  // 图片大小80X20
        $back_color = imagecolorallocate($img_handle, 255, 255, 255); // 背景颜色（白色）
        $txt_color = imagecolorallocate($img_handle, 0,0, 0);  //文本颜色（黑色）

        // 加入干扰线
        for($i=0;$i<3;$i++)
        {
            $line = imagecolorallocate($img_handle,rand(0,255),rand(0,255),rand(0,255));
            imageline($img_handle, rand(0,15), rand(0,15), rand(100,150),rand(10,50), $line);
        }

        imagefill($img_handle, 0, 0, $back_color); // 填充图片背景色
        imagestring($img_handle, 38, 30, 10, $str, $txt_color); // 水平填充一行字符串

        ob_clean();   // ob_clean()清空输出缓存区
        header("Content-type: image/png"); // 生成验证码图片
        imagepng($img_handle); // 显示图片
    }
    ?>