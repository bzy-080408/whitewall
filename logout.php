<?php
session_start();
if (isset($_SESSION['userName'])) 
{
    session_unset();
    session_destroy();
}
$_COOKIE['email'] = null;
?>
<html>
<head>
<meta charset="utf-8" />
<title>注销页面</title><!–标题–>
</head>
<body>
<a href = "index.php"><input type = "button" value = "返回主页" /></a>
</body>
</html>