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
            echo "<script>alert('登录成功！');location.href='UserManage.php';</script>";
        } else {
            // 验证失败，显示错误消息,并重定向到登录页面
            echo "<script>alert('用户名或密码错误！');location.href='do_login.php';</script>";
        }
    }
    exit;
}