<?php
//过滤sql命令

/*function post_check($value) {
 if(!get_magic_quotes_gpc()) {
 // 进行过滤 
 $value = addslashes($value);
 }
 $value = str_replace("_", "\_", $value);
 $value = str_replace("%", "\%", $value);
 $value = nl2br($value);
 $value = htmlspecialchars($value);
 return $value;
 }*/
$configs = array(
    'credentials' => array(
        'ak' => 'cG4GX8tToBbCFtirS9fPI6gG',
        'sk' => '98YfDSyFtURdZDTMDg3mfOfRfsOieqei',
    ));
$is_email_set;

$post_inf = "no";



/* function post($url,$data=[],$header=[]){
 $ch = curl_init();
 if(substr($url,0,5)=='https'){
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
 }
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 $response = curl_exec($ch);
 if($error=curl_error($ch)){
 die($error);
 }
 curl_close($ch);
 //var_dump($response);
 return $response; } */

function go($emaill)
{
    $post_inf = "yes";

    include("sql.php");

    $conn = new mysqli($SQLservername, $SQLusername, $SQLpassword, "whitewall");

    $conn->query("set names 'utf-8'");

    if ($conn->connect_error) {

        die("连接失败: " . $conn->connect_error);
    }
    //demo();
    //$ex_result = json_decode($res,true);
    //print($ex_result);
    //if()

    $sql = "INSERT INTO White (title, note, nickname , contact , passwd , email)VALUES (" . "'" . df($_POST["title"]) . '\',' . "'" . df($_POST['note']) . '\',\'' . df($_POST['nickname']) . '\',\'' . df($_POST['contact']) . '\',\'' . df($_POST['passwd']) . '\', \'' . $emaill . '\')';


    if ($conn->query($sql) === TRUE) {


        $result = $conn->query("SELECT MAX(id) FROM white");
        foreach ($result->fetch_assoc() as $aaaa)
            header('Location: /success.php?id=' . $aaaa);
    }

    else {

        echo "Error: " . $sql . "<br>" . $conn->error;

    }

    $conn->close();

}
function df($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
if (isset($_COOKIE['email'])) 
{
    //$is_email_set = "yes";
    //    echo "设置成功";
    if (isset($_POST["submit"])) {
        echo("233");
        if (isset($_POST['title'], $_POST['note'], $_POST['nickname'], $_POST['contact'], $_POST['passwd'], $_POST['email'], $_POST['yanzheng'])) {
            echo("233");
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $_POST['email'])) {
                echo("233");
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo("233");
                    if ($_POST['yanzheng'] == substr(hash('ripemd160', $_POST['email']), 0, 6)) {









































                        
$data = $_POST['note'];
                        $data = http_build_query($data);
                        $opts = array(
                            'http' => array(
                                'method' => 'POST',
                                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                                "Content-Length: " . strlen($data) . "\r\n",
                                'content' => $data
                            )
                        ); /*
  $context = stream_context_create($opts);
  $ex_result = file_get_contents('https://aip.baidubce.com/rest/2.0/solution/v1/text_censor/v2/user_defined?access_token=24.d333edcafdcee4ed92ffe38e0ef45d9a.2592000.1653045589.282335-26002857', false, $context);
  //$ex_result = post('https://aip.baidubce.com/rest/2.0/solution/v1/text_censor/v2/user_defined?access_token=24.d333edcafdcee4ed92ffe38e0ef45d9a.2592000.1653045589.282335-26002857', 'text = ' . $_POST['note'], 'Content-Type=application/x-www-form-urlencoded');
  print_r($ex_result);
  */
                        go(df($_POST['email']));
                    }
                }
                else {

                    $verifyErr = "验证码错误";
                }
            }
        }
    }
}



?>

<html>

    <head>

        <meta charset="utf-8">

        <script src="./js/jquery.js"></script>

        <script src="./popper.min.js"></script>

        <script src="./js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="./css/bootstrap.min.css">

        <style>

            body{background:url('./bg.png') center no-repeat fixed; background-size:cover}
            .navbar{
                margin-bottom:0px
            }
            #lst{
                background-color:rgba(10,10,10,0.4);
                margin:0px 30px 30px 30px ;
                
            
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

            <a class="navbar-brand" href="#">GWhiteWall</a>

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


            </div>

          </nav>

<?php

if ($post_inf == "yes") {

    echo "<span style=\"color:red\">正在提交信息……</span>";

}

/*
 if (isset($_POST["ok"])) {
 echo "<script> alert('所有字段已填写完成');";
 }else{
 echo "<script> alert('尚未填完所有字段或为验证邮箱');";
 }
 if($is_all_filled = "no"){
 echo "<span style=\"color:red\">您还有字段尚未填写！</span>";
 }else{
 echo "<span style=\"color:red\">所有字段已填写完成</span>";
 }*/

?>

<div id="lst">
<span class="text-light"><h1 align='center'>写纸条</h1></span>
<form style="margin:0px 50px" action="./add.php" method="post" id="nform">

  <div class="form-group">

    <label for="exampleBT1" class="text-light">标题</label>

    <input class="form-control bg-dark text-light" id="exampleBT1" name="title" aria-describedby="BTHelp" placeholder="不要出现班级信息。人名应用拼音首字母代替">

    <small id="BTHelp" class="form-text text-muted">这将显示在您纸条的最上方。搜索功能将检索此栏，建议将对象的名字写在此处。</small>

  </div>

  <div class="form-group">

    <label for="exampleZW1" class="text-light">正文</label>

    <textarea class="form-control bg-dark text-light" id="exampleZW1" name="note" aria-describedby="ZWHelp"  rows="10" placeholder="不要出现班级信息。人名应用拼音首字母代替"></textarea>

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

    <div class="form-group">

    <label for="exampleInputEmail1" class="text-light">联系方式</label>

    <input class="form-control bg-dark text-light" id="exampleInputEmail1" name="contact" aria-describedby="emailHelp">

    <small id="emailHelp" class="form-text text-muted">
        这是公开的联系方式。如果你不想公开，请填写"#"。
    </small>

  </div>
  </div>

    <div class="form-group">

    <label for="em" class="text-light">邮箱-必填</label><label id="err" class="text-light"></label>

    <input class="form-control bg-dark text-light" id="em" name="email" aria-describedby="emailHelp">
    <button type="button" class="btn btn-primary  bg-dark text-light" id="yz">发送验证码</button>
    <a class="btn btn-outline-danger my-2 my-sm-0" type="button" href="/spadd.php">没有邮箱？</a>
    <small id="emailHelp" class="form-text text-muted">

    </small>

  </div>

    <div class="form-group">

    <label for="exampleInputEmail1" class="text-light">验证码-必填</label>

    <input class="form-control bg-dark text-light" id="exampleInputEmail1" name="yanzheng" aria-describedby="emailHelp">

    <small id="emailHelp" class="form-text text-muted">
    </small>

  </div>

  

  <div class="form-group form-check">

    <input type="checkbox" class="form-check-input" name="ok" id="exampleCheck1">

    <label class="form-check-label  bg-dark text-light" for="exampleCheck1">已阅读并同意《用户条款》</label>

  </div>

  <input type="hidden" name="submit" value="233">

  <button type="submit" class="btn btn-primary  bg-dark text-light" id = "c">提交</button><span id="errmsg" class="text-danger"></span>

</form>

</div>
  </div>
  <script scr="./js/jquery.js">
      su=false;
      function ls(data){
                 console.log(data);
                if(data.indexOf("ok")!=-1)
                {
                    su=true;
                }else
                {
                    $("#errmsg").html(data);
                    alert(data);
                    su=false;
                }
             }

    $('#nform').submit(function(e){
        $("#errmsg").html('再点一下！');
        console.log("138091283102381029381023");
        if($('#exampleZW1').val().search(/[1234567890一二三四五六七八九十\s]+班(?<=[1234567890一二三四五六七八九十\s]?)|初?高?小?[1234567890一二三四五六七八九十\s]{2,3}班|[一二三四五六七八九十\s]年?[1234567890\s]{1,2}/gim))
        $.ajax({
             type: "POST",
             url: "/wjc.php",
             data:{msg:$('#exampleZW1').val()},
             dataType: "text",
             async:true,
             beforeSend: function(XMLHttpRequest) {
             },
             success: ls,
             error: function(XMLHttpRequest, textStatus, errorThrown) {
                  //请求出错处理操作
                  alert(XMLHttpRequest.status);
                  alert(XMLHttpRequest.readyState);
                  alert(textStatus);
                  alert(errorThrown);
             },
             complete: function(XMLHttpRequest, textStatus) {
                
                  this;
             }
         })
         if(!su){
            e.preventDefault();
            e.stopPropagation();
         }
         return su;
        
    })

</script>
    </body>

</html>



