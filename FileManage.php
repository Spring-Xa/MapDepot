<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>青锁后台</title>
    <link rel="stylesheet" href="css/manage.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <script src="js/manage.js"></script>
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
            <li><a href="UserManage.php">管理</a></li>
        </ul>
    </div>
    <!--系统信息-->
    <div class="nav-right-info">
        <ul>
            <li class="nav-right-info-name">系统管理员</li>
            <li>|</li>
            <li><a href="UserManage.php">退出</a></li>
        </ul>
    </div>
</div>
<!--主体-->
<div class="main">
    <div class="main-left">
        <ul>
            <li class="main-left-nav"><a href="UserManage.php">用户管理</a></li>
            <li class="main-left-nav"><a href="FileManage.php">文件管理</a></li>
            <li class="main-left-nav"><a href="LogManage.php">日志管理</a></li>
        </ul>
    </div>
    <div class="main-right">
        <!--文件管理-->
        <div class="main-right-file">
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
                    //导入数据库连接文件
                    require 'includes/db_conn.php';
                    //物理分页
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $pageSize = 5;
                    $offset = ($page - 1) * $pageSize;
                    //查询总记录数
                    $sql = "SELECT COUNT(*) FROM `qingsuo_top`.`images`";
                    $result = $db_conn->query($sql);
                    $count = $result->fetchColumn();
                    //查询当前页的数据
                    $sql = "SELECT * FROM `qingsuo_top`.`images` LIMIT {$offset},{$pageSize}";
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
                <div class="main-right-file-content-page">
                    <?php
                    require 'includes/page.php';
                    //关闭数据库连接
                    $db_conn = null;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--底部-->
<div class="footer">
    <span>CopyRight@2023&ensp;青锁图库&ensp;</span>
    <a href="https://beian.miit.gov.cn/" class="beian">黔ICP备2021007007号-3</a>
</div>
</body>
</html>