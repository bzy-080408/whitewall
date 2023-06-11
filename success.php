<?php
session_start();
function df($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
?>



<head>
        <meta charset="utf-8">
        <title>添加成功！</title>
        <meta http-equiv="refresh" content="3;url=/#<?php echo('id' . df($_GET['id'])); ?>">
        <script src="./js/jquery.js"></script>
        <script src="./js/popper.min.js"></script>
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
                    <a tabindex="0" id="xjs" type="button" class="btn btn-danger lx" data-toggle="popover" title="联系我们" data-content="微信：MCC_Sword">巡检司</a>
        </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    关于作者
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" tabindex="0" id="jol" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="MCC_Sword">Jol888</a>
                    <a class="dropdown-item" tabindex="0" id="jf" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="jeffery_lui">Jeffery</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" tabindex="0" id="jf" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="jeffery_lui">加入我们</a>
                    <a class="dropdown-item" tabindex="0" id="jf" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的联系方式" data-content="jeffery_lui">打赏</a>
                  </div>
                </li>
                
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="看看有咩有你的名字" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">检索</button>
              </form>
            </div>
          </nav>
          <div id="lst h-100" >
              <?php
              if($_COOKIE['passwd']="已过期"){
              //Header("Location: index.php");
              }
              ?>
              <div class="alert alert-success w-75" role="alert" style="margin:12.5%;">
  <h4 class="alert-heading">完成！</h4>
  <p><br>你的秘钥是<h4><?php echo (df($_POST['passwd'])); ?></h4>请保管好你的密钥，如有疑问请<a tabindex="0" id="joi" class="lx" role="button" data-toggle="popover" data-trigger="focus" title="Ta留下的微信" data-content="jeffery_lui">联系Jeffery</a></p>
  <hr>
  <p class="mb-0">将在3秒后跳转主页……</p>
</div>";
?>
        </div>
<script>
    $('.lx').popover('enable')
    </script>
		</div>
</body>

</html>