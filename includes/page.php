<?php
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