<?php
// 通过 $_FILES 数组获取上传的文件信息
$file = $_FILES['file'];
$fileName = $_POST['fileName'];
$fileTitle = $_POST['fileTitle'];
$fileDescription = $_POST['fileDescription'];
$fileStyle = $_POST['fileStyle'];
$fileSize = $_POST['fileSize'];
$fileType = $_POST['fileType'];
// 获取文件的大小
$size = $file['size'];
// 若文件大小超过500KB，压缩图片
if ($size > 500000) {
    // 获取图片的宽高
    list($width, $height) = getimagesize($file['tmp_name']);
    // 计算缩放比例
    $ratio = $width / $height;
    // 计算缩放后的高度
    $new_height = 500;
    // 计算缩放后的宽度
    $new_width = $new_height * $ratio;
    // 创建原图的画布
    $src = imagecreatefromstring(file_get_contents($file['tmp_name']));
    // 创建缩放后的画布
    $dst = imagecreatetruecolor($new_width, $new_height);
    // 将原图缩放后复制到新画布上
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // 将缩放后的图片保存到临时目录
    imagepng($dst, $file['tmp_name']);
    // 获取压缩后的图片大小
    $size = $file['size'];
    // 释放画布资源
    imagedestroy($src);
    imagedestroy($dst);
}
// 保存文件的路径
$upload_dir = 'uploads/';
// 确保上传的目录存在
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
// 将文件重命名为时间戳+4位随机数+文件后缀名
$filename = time() . rand(1000, 9999) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

// 将文件从临时目录移动到上传的目录
move_uploaded_file($file['tmp_name'], $upload_dir . $filename);
//拼接图片的URL
$URL = 'https://qingsuo.top/' . $upload_dir . $filename;

//导入数据库连接文件
require 'includes/db_conn.php';
//将上传的图片路径存入数据库
$sql = "INSERT INTO `qingsuo_top`.`images` (`filename`, `title`, `description`, `style`, `filesize`, `type`, `URL`, `upload_time`) VALUES ('{$filename}', '{$fileTitle}', '{$fileDescription}', '{$fileStyle}', '{$size}', '{$fileType}', '{$URL}', now());";
$db_conn->query($sql);

//返回JSON数据
echo json_encode(array(
    'success' => true,
    'message' => '上传成功',
    'url' => $URL
));