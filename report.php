<head>
        <meta charset="utf-8">
        <script src="./js/jquery.js"></script>
        <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        </dev><script src="./masonry.pkgd.min.js"></script>
        <style>
            body{background:url('./bg.png') center no-repeat fixed; background-size:cover}
            .navbar{
                margin-bottom:20px
            }
            #lst{
                background-color:rgba(10,10,10,0.4);
                margin:30px;
                
            
            }
            .card{
                opacity: 0.6;
            }
            .navbar{
                opacity: 0.9;
                
            }
            
            </style>

    </head>
    <body>
<nav class="navbar navbar-default"></nav>
<nav class="navbar navbar-default"></nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top " >
            <a class="navbar-brand" href="#">GWhiteWall</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/">广外表白墙</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./add.php">写纸条</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link red-text" href="./report.php">举报滥用行为?</a>
        </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#42" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    关于作者
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" tabindex="0" id="jol" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="MCC_Sword">Jol888</a>
                    <a class="dropdown-item" tabindex="0" id="jf" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="???">Jeffery</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" tabindex="0" id="joi" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="MCC_Sword">加入我们</a>
                    <a class="dropdown-item" class="btn btn-sm btn-primary lx" href="#24">打赏</a>
                  </div>
                </li>
                
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="看看有咩有你的名字" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">检索</button>
              </form>
            </div>
          </nav>
          <form method="post" >
<div class="form-group">
    <label for="exampleBT1" class="text-light"">想要提交的noteID:</label>
    <input type="text" class="form-control bg-dark text-light" id="em" name="noteid" aria-describedby="BTHelp">
  <input name="report" type="submit" value="检举" />
  </div>
</br>
</form>
<?php

$preg = '/^[a-zA-Z\x{4e00}-\x{9fa5}]{6,20}$/u';
$preg2 = '/^[a-zA-Z]+$/u';
$preg3 = '/^[\x{4e00}-\x{9fa5}]+$/u';
$isInfoCanUse = false;
$email = "";
$emailErr = "必填项目";
$verifyErr = "必填项目";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
function dealInfo($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
function codestr()
{
    $arr = array_merge(range('a', 'b'), range('A', 'B'), range('0', '9'));
    shuffle($arr);
    $arr = array_flip($arr);
    $arr = array_rand($arr, 6);
    $res = '';
    foreach ($arr as $v) {
        $res .= $v;
    }
    return $res;
}
function email($code)
{
    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.qq.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jeffery.lyu@qq.com';
        $mail->Password = 'ripbxgbbtimfdcib';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->From = 'jeffery.lyu@qq.com';
        $mail->FromName = '滥用举报';
        $mail->addAddress('3510862791@qq.com', 'User');
        $mail->addReplyTo('jeffery.lui@qq.com', 'info');
        $yanzheng = $code;
        $mail->isHTML(true);
        $mail->Subject = '小纸条滥用行为举报';
        $mail->Body = '<h1>小纸条滥用行为举报</h1><h3>NoteID：<span>' . $yanzheng . '</span></h3>' . date('Y-m-d H:i:s');
        $mail->AltBody = '小纸条滥用行为举报，NoteID：' . $yanzheng . date('Y-m-d H:i:s');

        $mail->send();
    }
    catch (FFI\Exception $e) {
        echo '邮件发送失败: ', $mail->ErrorInfo;
    }
}
if(isset($_POST['report'])){
    email($_POST['noteid'],0,6);
    echo '<span style="color:red" for="exampleBT1" class="text-light" align="center"><h4>您已成功检举编号为</h4><h1>' . $_POST['noteid'] . '</h1><h4>的纸条，已通过邮箱发送给开发者jeffery.lui@foxmail.com!<h4>将在3秒后跳转回原始页面!</h4></h4></span>';
    sleep(3);
    if($_COOKIE['from']=="index"){
$url = "http://1.117.63.78:88/index.php";
echo <<<EOF
<script type='text'><a href="http://1.117.63.78:88/index.php" target="_blank"><strong class="keylink">javascript</strong></a>'>"
EOF;
echo "window.location.href='$url'";
echo "</script>"; 
    }else if($_COOKIE['from']=="add"){
        header("Location: add.php");
    }else{
        $url = "http://1.117.63.78:88/index.php";
echo <<<EOF
<script type='text'><a href="http://1.117.63.78:88/index.php" target="_blank"><strong class="keylink">javascript</strong></a>'>"
EOF;
echo "window.location.href='$url'";
echo "</script>"; 
    }

}
?>