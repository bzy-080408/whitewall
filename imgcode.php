<?php
class Vcode

{

private $width = 80; /*验证码宽度*/

private $height = 40; /*验证码高度*/

private $codeNum = 4; /*验证码字符个数*/

private $checkCode; /*验证码字符*/

private $image; /*验证码资源*/

private $pixNum = 20; /*绘制干扰点的个数*/

private $lineNum = 0; /*绘制干扰线的条数*/

/*

*构造方法实例化验证码对象，并初始化数据

*@param int $width 设置默认宽度

*@param int $height 设置默认高度

*@param int $codeNum 设置验证码中的字符个数

*@param int $pixNum 设置干扰点的个数

*@param int $lineNum 设置干扰线的数量

*/

function __construct($width=80,$height=40,$codeNum=4,$pixNum=40,$lineNum=5)

{

$this->width = $width;

$this->height = $height;

$this->codeNum = $codeNum;

$this->pixNum = $pixNum;

$this->lineNum = $lineNum;

}

/*内部私有方法,创建图像资源*/

private function getCreateImage()

{

$this->image = imagecreatetruecolor($this->width, $this->height);

$white = imagecolorallocate($this->image,0xff,0xff,0xff);

imagefill($this->image, 0, 0, $white);

$black = imagecolorallocate($this->image,0,0,0);

imagerectangle($this->image, 0, 0, $this->width-1, $this->height-1, $black);

}

/*内部私有方法,绘制字符，去掉o0Llz和012*/

private function createCheckCode()

{

$code = '3456789abcdefghijkmnpqrstuvwxyABCDEFGHIJKMNPQRSTUVWXY';

$this->checkCode = "";

for($i=0; $icodeNum;$i++)

{

$char = $code{rand(0,strlen($code) - 1)};

$this->checkCode .= $char;

$fontColor = imagecolorallocate($this->image, rand(0,128), rand(0,128),rand(0,128));

$fontSize = rand(3,5);

$x = rand(0,$this->width-imagefontwidth($fontSize));

$y = rand(0,$this->height-imagefontheight($fontSize));

imagechar($this->image, $fontSize, $x, $y, $char, $fontColor);

}

}

/*内部私有方法设置干扰元素*/

private function setDisturbColor()

{

/*绘制干扰点*/

for($i=0; $ipixNum; $i++)

{

$color = imagecolorallocate($this->image, rand(0,255), rand(0,255), rand(0,255));

imagesetpixel($this->image, rand(1,$this->width-2), rand(1,$this->height-2), $color);

}

/*绘制干扰线*/

for($i=0; $ilineNum; $i++)

{

$color = imagecolorallocate($this->image, rand(0,255), rand(0,255), rand(0,255));

imageline($this->image, rand(1,$this->width / 2), rand(1,$this->height / 2), rand($this->width / 2,$this->width - 2), rand($this->height / 2,$this->height - 2), $color);

}

}

/*开启session保存 利用echo 输出图像*/

function __toString()

{

$_SESSION['code'] = strtoupper($this->checkCode);

$this->getCreateImage();

$this->createCheckCode();

$this->setDisturbColor();

$this->outputImg();

}

/*内部私有方法输出图像*/

private function outputImg()

{

header("content-type:image/png");

imagepng($this->image);

}

/*析构方法，释放对象*/

function __destruct()

{

imagedestroy($this->image);

}

}

?>