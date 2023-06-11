<html>
<head>
<meta charset="utf-8" />
<title>登录</title><!–标题–>
<style>

{color:red;}
</style>
</head>
<body>
<?php
$isInfoCanUse = false;
$userName = $password = "";
$userNameErr = $passwordErr = "";
function dealInfo($data)
{

    
$data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $isInfoCanUse = true;
    if (empty($_POST['userName'])) {

        
$isInfoCanUse = false;
        $userNameErr = "用户名称不能为空";
    }
    else {
        $userName = dealInfo($_POST['userName']);

    
}
    if (empty($_POST['password'])) {
        $isInfoCanUse = false;
        $passwordErr = "密码不能为空";
    }
    else {
        $password = dealInfo($_POST['password']);

    
}
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $isInfoCanUse == true) {

    
$dbhost = '127.0.0.1';
    $dbuser = 'login';
    $dbpass = 'root';
    $dbname = 'whitewall';
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$link) {
        die('连接数据库失败<br/>');
    }
    if ($isInfoCanUse) {

        
$sql = "SELECt userName FROM account WHERe userName='$userName'";
        $result = mysqli_query($link, $sql);
        $test = mysqli_fetch_assoc($result);
        if ($test == false) {
            $userNameErr = "用户名称不存在";
        }
        else {
            $sql = "SELECt userName,password FROM account WHERe userName='$userName' and password = '$password'";
            $result = mysqli_query($link, $sql);
            $test = mysqli_fetch_assoc($result);
            if ($test == false) {
                $passwordErr = "密码错误";
            }
            else {
                session_start();
                $_SESSION['userName'] = $userName;
                echo "登录成功！";

                
echo '<a href =  ><input type = "button" value = "返回主页" /></ a>';
            }
        }
    }
}
?>