<?php
session_start();
?>


<head>
        <meta charset="utf-8">
        <title>广外表白墙</title>
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
<?php
$_COOKIE['from'] = "index";
include("sql.php");
$conn = new mysqli($SQLservername, $SQLusername, $SQLpassword, "whitewall");
if ($conn->connect_error)
    die("SqlErr: " . $conn->connect_error . '<br/>' . "请联系Jeffery(微信：jeffery_lui)并附上这条信息。这有助于解决问题。");
$sql = "SELECT * FROM White;";
$conn->query("set names 'utf-8'");
$result = $conn->query($sql);
try {
    if ($result->num_rows > 0) {
        // 锟斤拷锟斤拷锟斤拷锟?
        echo "<div id=\"lst\"  >";
        while ($row = $result->fetch_assoc()) {
            $_nickname = $row['nickname'];
            $_note = $row['note'];
            $_id = $row['id'];
            $_title = $row['title'];
            $_contact = $row['contact'];
            echo <<<EOF
            <tr>
                <div class="card" id="id$_id" style="min-width: 250px;max-width: 410px;margin:10px">
  <div class="card-body">
    <h5 class="card-title">$_title</h5>
    <h6 class="card-subtitle mb-2 text-muted"> $_nickname</h6>
    
    <p class="card-text overflow-auto">$_note</p>
    <a tabindex="0" class="btn btn-sm btn-primary lx" role="button" data-toggle="popover" data-trigger="focus" title=" Ta留下的联系方式 NoteId:$_id" data-content="$_contact">联系Ta</a>
    <!-- <a class="card-link">NoteID:$_id</a> -->
    <img src="./asses/like.png" class="likebtn" height=32px/>
  </div>
</div>
EOF;
        }
        echo <<<EOF

		<script type="text/javascript">
			var masonry = new Masonry($('#lst')[0],{
				itemSelector:'.card',
columnWidth: 1
			});
            $('.lx').popover('enable')
            $("#jol").mouseenter(function(){
            $('#jol').popover('show')
            });
            $("#jol").mouseleave(function(){
            $('#jol').popover('hide')
            });
            $("#jf").mouseenter(function(){
            $('#jf').popover('show')
            });
            $("#jf").mouseleave(function(){
            $('#jf').popover('hide')
            });
            $("#joi").mouseenter(function(){
            $('#joi').popover('show')
            });
            $("#joi").mouseleave(function(){
            $('#joi').popover('hide')
            });
            $("#xjs").mouseenter(function(){
            $('#xjs').popover('show')
            });
            $("#xjs").mouseleave(function(){
            $('#xjs').popover('hide')
            });
            $(".likebtn").click(function(){
                if($(this).attr("src")=="./asses/like.png")
                    $(this).attr("src","./asses/liked.png")
                else
                    $(this).attr("src","./asses/like.png")
            });
</script>
EOF;


    }
    else {
        echo "0 锟斤拷锟?";
    }
}
catch (Exception $e) 
{
    echo "ERR";
}
$conn->close();
?>
		</div>
</body>

</html>