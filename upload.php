<?php
// 确保文件上传时没有错误
if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => '上传文件时发生错误']);
    exit;
}

// 确保文件大小在合理范围内
//$max_file_size = 1024 * 1024; // 1 MB
//if ($_FILES['file']['size'] > $max_file_size) {
//    header('HTTP/1.1 400 Bad Request');
//    echo json_encode(['error' => '上传的文件太大了']);
//    exit;
//}

// 确定上传的目录和文件名
$upload_dir = 'uploads/';

// 为了防止文件名冲突，为文件重命名为日期和时间，加上随机的8数字字母组合
$upload_file = $upload_dir . date('YmdHis') . '_' . substr(md5($_FILES['file']['name']), 0, 8) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

// 确保上传的目录存在
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

//压缩图片
if ($_FILES['file']['size'] > 1500000) {
    //获取图片的宽高
    list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
    //计算图片的压缩比例
    $percent = 1500000 / $_FILES['file']['size'];
    //计算压缩后的宽高
    $new_width = $width * $percent;
    $new_height = $height * $percent;
    //创建一个新的图片
    $new_image = imagecreatetruecolor($new_width, $new_height);
    //获取原图的图片资源
    $old_image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
    //将原图的图片资源压缩后保存到新的图片资源中
    imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    //将新的图片资源保存到指定目录
    imagejpeg($new_image, $upload_file);
} else {
    // 将上传的文件保存到指定目录
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => '无法保存上传的文件']);
        exit;
    }
}


//// 将上传的文件保存到指定目录
//if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
//    header('HTTP/1.1 500 Internal Server Error');
//    echo json_encode(['error' => '无法保存上传的文件']);
//    exit;
//}

// 返回JSON格式的响应，指示上传结果
echo json_encode([
    'success' => true,
    'url' => $upload_file,
]);

//把图片路径存入数据库
require 'includes/db_conn.php';
//拼接图片的URL
$URL = 'http://qingsuo.top/' . $upload_file;
//将上传的图片路径存入数据库
$sql = "INSERT INTO `qingsuo_top`.`images` (`filename`) VALUES ('$URL')";
$db_conn->query($sql);
