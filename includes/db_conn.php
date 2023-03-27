<?php
$db_host = '120.25.160.68'; // 数据库主机名
$db_name = 'qingsuo_top';   // 数据库名
$db_user = 'qingsuo_top';      // 数据库用户名
$db_pass = 'HPACSta2Gtc2Btf2';  // 数据库密码
$db_charset = 'utf8mb4';// 数据库字符集

// 创建数据库连接
$db_conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_pass);

// 抛出异常
$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
