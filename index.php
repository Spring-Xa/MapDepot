<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>青锁图库</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
<h1>青锁图库</h1>
<span>注：①若显示异常，请刷新页面！！！</span>
<span>②未经授权，禁止转载！！！</span>
<span>③若有侵权行为，请联系作者删除！！！</span>
<!--图片分类-->
<div class="category">
    <!--选择版式(横向或纵向)-->
    <div class="style">
        <span>选择版式：</span>
        <label>
            <input type="radio" name="style" value="all" checked="checked">全部
        </label>
        <label>
            <input type="radio" name="style" value="horizontal">横向
        </label>
        <label>
            <input type="radio" name="style" value="vertical">纵向
        </label>
    </div>
    <!--选择分类-->
    <div class="type">
        <span>选择分类：</span>
        <label>
            <input type="radio" name="type" value="all" checked="checked">全部
        </label>
        <label>
            <input type="radio" name="type" value="nature">自然
        </label>
        <label>
            <input type="radio" name="type" value="animal">动物
        </label>
        <label>
            <input type="radio" name="type" value="people">人物
        </label>
        <label>
            <input type="radio" name="type" value="building">建筑
        </label>
        <label>
            <input type="radio" name="type" value="food">食物
        </label>
        <label>
            <input type="radio" name="type" value="other">其他
        </label>
    </div>
    <!--提交检索-->
    <div class="submit">
        <input class="submit_button" type="submit" value="检索">
    </div>
</div>
<!--加载动画-->
<div id="loading">
    <!-- 加载中的过渡动画 -->
    <div class="loading-animation">
        <div class="loading-text">正在加载中，请稍后...</div>
    </div>
</div>
<!--图片预览-->
<div id="preview" style="display: none"></div>
<!--分页-->
<div class="page">
    <span>
    <?php
    require 'includes/db_conn.php';
    //物理分页
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $pageSize = 8;
    $offset = ($page - 1) * $pageSize;
    //查询总记录数
    $sql = "SELECT COUNT(*) FROM `qingsuo_top`.`images`";
    $result = $db_conn->query($sql);
    $count = $result->fetchColumn();
    //查询当前页的数据
    $sql = "SELECT * FROM `qingsuo_top`.`images` LIMIT {$offset},{$pageSize}";
    $result = $db_conn->query($sql);
    // 遍历数据库中的图片路径
    foreach ($result as $row) {
        // 将图片路径存入数组
        $images[] = $row['url'];
    }

    //计算总页数
    $pageCount = ceil($count / $pageSize);
    echo "共{$count}条记录,共{$pageCount}页&ensp;";
    echo "当前是第{$page}页";
    echo "<br>";
    if ($page == 1) {
        echo "<a href='?page=1'>首页&ensp;</a>";
        echo "<a href='?page=" . ($page + 1) . "'>下一页&ensp;</a>";
        echo "<a href='?page=" . ($pageCount) . "'>尾页</a>";
    } else if ($page == $pageCount) {
        echo "<a href='?page=1'>首页&ensp;</a>";
        echo "<a href='?page=" . ($page - 1) . "'>上一页&ensp;</a>";
        echo "<a href='?page=" . ($pageCount) . "'>尾页</a>";
    } else {
        echo "<a href='?page=1'>首页&ensp;</a>";
        echo "<a href='?page=" . ($page - 1) . "'>上一页&ensp;</a>";
        echo "<a href='?page=" . ($page + 1) . "'>下一页&ensp;</a>";
        echo "<a href='?page=" . ($pageCount) . "'>尾页</a>";
    }
    //关闭数据库连接
    $db_conn = null;
    ?>
</div>
<div style="text-align: center;margin-top:10px">
    <span>CopyRight@2023&ensp;青锁图库&ensp;</span>
    <a href="https://beian.miit.gov.cn/" class="beian">黔ICP备2021007007号-3</a>
</div>
</body>
<script>
    //将图片路径存入数组
    const images = <?php echo json_encode($images); ?>;
    //调取JSON数据将其转换为JavaScript对象
    const preview = document.getElementById('preview');
    //遍历数组，将图片路径存入img标签
    for (let i = 0; i < images.length; i++) {
        const img = document.createElement('img');
        img.src = images[i];
        preview.appendChild(img);
    }
    //整个页面禁止右键
    document.oncontextmenu = function () {
        return false;
    }
    //整个页面禁止选择
    document.onselectstart = function () {
        return false;
    }
    //网页居中
    const body = document.querySelector('body');
    body.style.textAlign = 'center';

    //页面加载
    window.onload = function () {
        //获取加载动画
        const loading = document.getElementById('loading');
        //获取网页内容
        const content = document.getElementById('preview');
        //隐藏加载动画
        loading.style.display = 'none';
        //显示网页内容
        content.style.display = 'block';
        //获取页面中的所有img标签
        const imgs = document.querySelectorAll('img');
        //遍历img标签
        for (let i = 0; i < imgs.length; i++) {
            //设置图片的宽度
            imgs[i].style.width = '200px';
            //设置图片的间距
            imgs[i].style.margin = '5px';
            //设置图片的边框
            imgs[i].style.border = '1px solid #ccc';
            //设置图片的圆角
            imgs[i].style.borderRadius = '10px';
            //设置图片的阴影
            imgs[i].style.boxShadow = '0 0 10px #ccc';
            //图片禁止拖拽
            imgs[i].ondragstart = function () {
                return false;
            }
            //如果图片的宽高比大于1.5，则将图片的宽度设置为350px
            if (imgs[i].width / imgs[i].height > 1.5) {
                imgs[i].style.width = '350px';
            }
            //图片的悬停放大效果
            //设置定位属性
            imgs[i].style.position = 'relative';
            imgs[i].onmouseover = function () {
                imgs[i].style.transform = 'scale(1.2)';
                imgs[i].style.transition = 'all 0.5s';
                //设置图片的z-index属性
                imgs[i].style.zIndex = '999';
                //设置图片的边框
                imgs[i].style.border = null;
            }
            imgs[i].onmouseout = function () {
                imgs[i].style.transform = 'scale(1)';
                imgs[i].style.transition = 'all 0.5s';
                imgs[i].style.zIndex = '0';
                imgs[i].style.border = '1px solid #ccc';
            }
        }
    }
</script>
</html>