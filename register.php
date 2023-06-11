<html>
<head>
<meta charset="utf-8">
<title>注册</title><!–标题–>
<style>
.error{color:red;}
</style>
</head>
<body>
<?php
$preg = '/^[a-zA-Z\x{4e00}-\x{9fa5}]{6,20}$/u';
$preg2 = '/^[a-zA-Z]+$/u';
$preg3 = '/^[\x{4e00}-\x{9fa5}]+$/u';
/* if(preg_match($preg2,$name) || preg_match($preg3,$name)){
 echo "错误"; }elseif(preg_match($preg,$name)){
 echo "OK"; }else{
 echo "错误"; }*/
$isInfoCanUse = false;
$userName = $password = $email = "";
$userNameErr = $passwordErr = $emailErr = "必填项目";
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
        if (preg_match($preg2, $_POST['userName']) || preg_match($preg3, $_POST['userName'])) {
            $userName = dealInfo($_POST['userName']);
        }
        elseif (preg_match($preg, $_POST['userName'])) {
            $userName = dealInfo($_POST['userName']);
        }
        else {
            $userNameErr = "只允许字母和数字";
        }
    }
    if (empty($_POST['password'])) {
        $isInfoCanUse = false;
        $passwordErr = "注册密码不能为空";
    }
    else {
        if (!preg_match("/(w{6,14})/", $_POST['password'])) {
            $passwordErr = "密码长度 6~14位";
            $isInfoCanUse = false;
        }
        else {
            $password = dealInfo($_POST['password']);
        }
    }
    if (empty($_POST['email'])) {
        $isInfoCanUse = false;
        $emailErr = "注册邮箱不能为空";
    }
    else {
        if (!preg_match("/([w-]+@[w-]+.[w-]+)/", $_POST['email'])) {
            $emailErr = "非法邮箱格式";

            
$isInfoCanUse = false;
        }
        else {
            $email = dealInfo($_POST['email']);
        }
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
    else {
    }
    $sql = "SELECt userName FROM account WHERe userName='$userName'";
    $result = mysqli_query($link, $sql);
    $test = mysqli_fetch_assoc($result);
    if ($test != false) {
        $userNameErr = "用户名称已经存在";
    }
    else {
        $sql = "INSERT INTO account(userName, password, email)
VALUES('$userName', '$password', '$email')";
        if (mysqli_query($link, $sql)) {
            echo "注册成功<br/>";

        
}
        else {
            echo "注册失败<br/>";
        }
        echo '<a href = "homepage.php"><input type = "button" value = "返回主页" /></a>';
    }
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
用户名称：<input type="text" name="userName" />
<?php echo "<span class=error>*" . $userNameErr . "</span>"; ?><br/>
注册密码：<input type="password" name="password" />
<?php echo "<span class=error>*" . $passwordErr . "</span>"; ?><br/>
注册邮箱：<input type="text" name="email" />
<?php echo "<span class=error>*" . $emailErr . "</span>"; ?><br/>
<input type="submit" value="注册" />
</form>
</body>
</html>