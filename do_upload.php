<?php
//获取xhr对象
$data = json_decode(file_get_contents('php://input'), true);
//获取数组中的数据
//$file = $data['file'];
 $file = $_POST['file'];

$filename = $data['fileName'];
$title = $data['fileTitle'];
$description = $data['fileDescription'];
$style = $data['fileStyle'];
$size = $data['fileSize'];
$type = $data['fileType'];

// 确定上传的目录和文件名
$upload_dir = 'uploads/';
// 确保上传的目录存在
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}





echo "<script>console.log('{$file}');</script>";
echo "<script>console.log('{$filename}');</script>";
echo "<script>console.log('{$title}');</script>";
echo "<script>console.log('{$description}');</script>";
echo "<script>console.log('{$style}');</script>";
echo "<script>console.log('{$size}');</script>";
echo "<script>console.log('{$type}');</script>";



//拼接图片的URL
$URL = 'https://qingsuo.top/' . $file;
echo "<script>console.log('{$URL}');</script>";

//导入数据库连接文件
require 'includes/db_conn.php';
//将上传的图片路径存入数据库
//$sql = "INSERT INTO `qingsuo_top`.`images` (`filename`, `title`, `description`, `style`, `filesize`, `type`, `URL`, `upload_time`) VALUES ('{$title}', '{$title}', '{$description}', '{$style}', '{$size}', '{$type}', '{$URL}', now());";
//$db_conn->query($sql);

//返回JSON格式的响应，指示上传结果
//echo json_encode([
//    'success' => true,
//    'url' => $title,
//]);