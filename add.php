<html>
    <head>
        <meta charset="utf-8">
        <title>写纸条</title>
        <script src="./js/jquery.js"></script>
        <script src="./popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
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
            <meta name="viewport" content="width=device-width, user-scalable=no, 
initial-scale=1.0, maximumscale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">GWhintWall</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/">表白墙</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="add.php">写纸条</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link red-text" href="./report.php">举报滥用行为?</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    友链
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Jol888</a>
                    <a class="dropdown-item" href="#">DLL</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">加入我们</a>
                  </div>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="看看有咩有你的名字" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">查找</button>
              </form>
              <script>
function jump(){
 window.open("verify.php");
}
</script>
<button class="btn btn-outline-success my-2 my-sm-0" onclick = " jump() " >验证邮箱</button>
            </div>
          </nav>
            </div>
          </nav>
<?php
$_COOKIE['from'] = "add";
       

if (isset($_COOKIE['email'])) {
    $verifyemail = "<span style='color:red'><h1 align='center'>邮箱地址验证已完成，当前邮箱地址：" . $_COOKIE['email'] . "</h1></span>";
    echo $verifyemail;
}
else {
    $verifyemail = "<span style='color:red'><h1 align='center'>请点击右上角验证按钮验证邮箱!</h1></span>";
    echo $verifyemail;
}
//过滤sql命令
function post_check($value) {
    if(!get_magic_quotes_gpc()) {
        // 进行过滤 
        $value = addslashes($value);
    }
    $value = str_replace("_", "\_", $value);
    $value = str_replace("%", "\%", $value);
    $value = nl2br($value);
    $value = htmlspecialchars($value);
    return $value;
}
if (isset($_POST["ok"])) {
    if (isset($_POST['nickname'], $_POST['title'], $_POST['note'], $_COOKIE['email'], $_POST['passwd'], $_POST['contact'])) {
         class Sample {
    const API_KEY = "";
    const SECRET_KEY = "";

    public function run() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://aip.baidubce.com/rest/2.0/solution/v1/text_censor/v2/user_defined?access_token={$this->getAccessToken()}",
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            
            CURLOPT_POSTFIELDS => $_POST['note'],
    
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json'
            ),

        ));
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
    /**
     * 使用 AK，SK 生成鉴权签名（Access Token）
     * @return string 鉴权签名信息（Access Token）
     */
    private function getAccessToken(){
        $curl = curl_init();
        $postData = array(
            'grant_type' => 'client_credentials',
            'client_id' => self::API_KEY,
            'client_secret' => self::SECRET_KEY
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://aip.baidubce.com/oauth/2.0/token',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($postData)
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $rtn = json_decode($response);
        return $rtn->access_token;
    }
}
$rtn = (new Sample())->run();
print_r($result);
//if(strpos($rtn,'不合规') !== false){
 //   echo $rtn;
//}else{
        include("sql.php");
        $conn = new mysqli($SQLservername, $SQLusername, $SQLpassword, "whitewall");
        $conn->query("set names 'utf-8'");
        if ($conn->connect_error)
            die("连接失败: " . $conn->connect_error);
        $sql = "INSERT INTO White (nickname, title, note,email,contact,passwd)
VALUES (" . "'" . $_POST["nickname"] . '\',' . "'" . $_POST['title'] . '\',\'' . $_POST['note'] . '\',\'' . $_COOKIE['email'] . '\',\'' . $_POST['contact'] . '\', \'' . $_POST['passwd'] . '\')';
        
        if ($conn->query($sql) === TRUE) {
            setcookie("passwd", $_POST['passwd']);
            header ( "Location: success.php" );
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } 
    }else{
        echo "<div class=\"form-group\"><label id=\"a\" class=\"form-text \" style=\"color:red\">您还有字段尚未填写！</label></div>";
    }
 //   }
?>
<form style="margin:50px" action="./add.php" method="post">
  <div class="form-group">
    <label for="exampleBT1" class="text-light"">标题</label>
    <input class="form-control bg-dark text-light" id="exampleBT1" name="title" aria-describedby="BTHelp">
    <small id="BTHelp" class="form-text text-muted">这将显示在您纸条的最上方。搜索功能将检索此栏，建议将对象的名字写在此处。</small>
  </div>
  <div class="form-group">
    <label for="exampleZW1" class="text-light">正文</label>
    <textarea class="form-control bg-dark text-light" id="exampleZW1" name="note" aria-describedby="ZWHelp"  rows="10"></textarea>
    <small id="ZWHelp" class="form-text text-muted">这是纸条的内容。支持HTML。（请勿滥用）</small>
  </div>
  
  <div class="form-group">
    <label for="exampleSM1" class="text-light">署名</label>
    <input class="form-control bg-dark text-light" id="exampleSM1" name="nickname"aria-describedby="SMHelp">
    <small id="SMHelp" class="form-text text-muted">这将显示在标题下方。</small>
  </div>
<div class="form-group">
    <label for="exampleInputPassword1" class="text-light">密钥</label>
    <input type="password" class="form-control bg-dark text-light" name="passwd"id="exampleInputPassword1">
    <small id="passHelp" class="form-text text-muted">这是您认领纸条的凭据。拥有了凭据，您便可以删除、修改该张纸条。请妥善保管它。</small>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1" class="text-light">联系方式</label>
    <input class="form-control bg-dark text-light" id="exampleInputEmail1" name="contact" aria-describedby="emailHelp>
    <small id="emailHelp" class="form-text text-muted>
    每一个对这张纸条感兴趣的用户都可以看到您在此栏填写的联系方式。若您不愿公开您的联系方式，可在此栏填“#”。请注意：即使您在此栏填写“#”，您的电子邮件地址仍会被安全私密地储存在数据库中</small>
  </div>
  
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" name="ok" id="exampleCheck1">
    <label class="form-check-label text-light" for="exampleCheck1">已阅读并同意《用户条款》</label>
  </div>
  <input type="hidden" name="submit" value="233">
  <button type="submit" class="btn btn-primary">提交</button>
</form>
    </body>
</html>

