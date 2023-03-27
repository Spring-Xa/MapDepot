<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>图库登录页面</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login-container">
    <h2>欢迎来到我的图库</h2>
    <!--提交表单后，会跳转到login.php页面，然后在login.php页面中进行验证-->
    <form action="login.php" method="post">
        <label for="username">用户名</label>
        <input type="text" id="username" name="username" required>
        <label for="password">密码</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">登录</button>
    </form>
    <!--    <div class="extra-links">-->
    <!--        <a href="#">忘记密码？</a>-->
    <!--        <a href="#">注册</a>-->
    <!--    </div>-->
</div>
</body>
</html>

<?php
session_start();
//与数据库建立连接
require 'includes/db_conn.php';
//查询数据库中的用户名和密码
$sql = "SELECT * FROM `qingsuo_top`.`admins`";
$result = $db_conn->query($sql);
//判断是否有POST请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //遍历数据库中的用户名和密码
    foreach ($result as $row) {
        //判断用户名和密码是否正确
        if ($username === $row['username'] && $password === $row['password']) {
            // 验证通过，存储管理员ID在会话中
            $_SESSION['admin_id'] = $row['id'];
            // 重定向到图片上传页面,提示用户登录成功
            echo "<script>alert('登录成功！');location.href='upload.html';</script>";
        } else {
            // 验证失败，显示错误消息,并重定向到登录页面
            echo "<script>alert('用户名或密码错误！');location.href='login.php';</script>";
        }
    }
    exit;
}