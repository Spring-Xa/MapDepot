<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>青锁后台</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
<!--导航栏-->
<div class="nav">
    <div class="nav-left">
        <img src="images/favicon.png" alt="logo">
    </div>
    <div class="nav-right">
        <ul>
            <li><a href="index.php">首页</a></li>
            <li>|</li>
            <li><a href="upload.html">上传</a></li>
            <li>|</li>
            <li><a href="admin.php">管理</a></li>
        </ul>
    </div>
    <!--系统信息-->
    <div class="nav-right-info">
        <ul>
            <li class="nav-right-info-name">系统管理员</li>
            <li>|</li>
            <li><a href="admin.php">退出</a></li>
        </ul>
    </div>
</div>
<!--主体-->
<div class="main">
    <div class="main-left">
        <ul>
            <li class="main-left-nav">用户管理</li>
            <li class="main-left-nav">文件管理</li>
            <li class="main-left-nav">日志管理</li>
        </ul>
    </div>
    <div class="main-right">
        <!--用户管理-->
        <div class="main-right-user">
            <div class="main-right-user-title">
                <strong>用户管理</strong>
            </div>
            <div class="main-right-user-content">
                <table>
                    <tr>
                        <th>序号</th>
                        <th>用户名</th>
                        <th>昵称</th>
                        <th>邮箱</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                        <?php
                        //导入数据库连接文件
                        require 'includes/db_conn.php';
                        //查询数据
                        $sql = "SELECT * FROM `qingsuo_top`.admins";
                        $result = $db_conn->query($sql);
                        //遍历数据
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['nickname'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['register_time'] . "</td>";
                            echo "<td><a href=''><button>编辑</button></a></td>";
                            echo "<td><a href=''><button>删除</button></a></td>";
                            echo "</tr>";
                        }
                        ?>
                </table>
            </div>
        </div>
        <!--文件管理-->
        <div class="main-right-file">
            <div class="main-right-file-title">
                <strong>文件管理</strong>
            </div>
            <div class="main-right-file-content">
                <table>
                    <tr>
                        <th>序号</th>
                        <th>缩略图</th>
                        <th>文件名</th>
                        <th>文件大小</th>
                        <th>上传时间</th>
                        <th>版式</th>
                        <th>分类</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM `qingsuo_top`.`images`";
                    $result = $db_conn->query($sql);
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td><img src='" . $row['url'] . "' alt=''></td>";
                        echo "<td>" . $row['filename'] . "</td>";
                        echo "<td>" . $row['filesize'] . "</td>";
                        echo "<td>" . $row['upload_time'] . "</td>";
                        echo "<td>" . $row['style'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td><a href=''><button>编辑</button></a></td>";
                        echo "<td><a href=''><button>删除</button></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <!--日志管理-->
        <div class="main-right-logs">
            <h1>日志管理</h1>
            <h3>敬请期待！</h3>
        </div>
    </div>
</div>
<!--底部-->
<div class="footer">
    <span>CopyRight@2023&ensp;青锁图库&ensp;</span>
    <a href="https://beian.miit.gov.cn/" class="beian">黔ICP备2021007007号-3</a>
</div>
</body>
<script>
    //从cookie中判断是否登录
    var cookie = document.cookie;
    if (cookie === "") {
        window.location.href = "login.php";
    }

    var user = document.getElementsByClassName("main-right-user")[0];
    var file = document.getElementsByClassName("main-right-file")[0];
    var logs = document.getElementsByClassName("main-right-logs")[0];
    //用户管理
    var userBtn = document.getElementsByClassName("main-left-nav")[0];
    userBtn.onclick = function () {
        user.style.display = "block";
        file.style.display = "none";
        logs.style.display = "none";
    }
    //文件管理
    var fileBtn = document.getElementsByClassName("main-left-nav")[1];
    fileBtn.onclick = function () {
        user.style.display = "none";
        file.style.display = "block";
        logs.style.display = "none";
    }
    //日志管理
    var logsBtn = document.getElementsByClassName("main-left-nav")[2];
    logsBtn.onclick = function () {
        user.style.display = "none";
        file.style.display = "none";
        logs.style.display = "block";
    }

</script>
</html>