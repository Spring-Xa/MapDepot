//从cookie中判断是否登录
const cookie = document.cookie;
if (cookie === "") {
    window.location.href = "login.html";
}

//input标签选择图片，预览在表格中
//页面加载完成后执行
window.onload = function () {
    const upload = document.getElementById('file-upload');
    upload.addEventListener('change', previewFile);
};

//预览图片
function previewFile() {
    //获取input标签
    const preview = document.querySelector('input[type=file]');
    //获取表格
    const table = document.querySelector('table');
    //获取input标签中的文件
    const files = preview.files;
    //获取表格中的行数
    const rows = table.rows.length;
    //遍历文件
    for (let i = 0; i < files.length; i++) {
        //获取文件
        const file = files[i];
        //获取文件名
        const fileName = file.name;
        //获取文件大小
        const fileSize = file.size;
        //获取文件类型
        const fileType = file.type;
        //判断文件类型
        if (fileType === "image/jpeg" || fileType === "image/png" || fileType === "image/gif") {
            //创建行
            const tr = document.createElement("tr");
            //创建列
            const td1 = document.createElement("td");
            const td2 = document.createElement("td");
            const td3 = document.createElement("td");
            const td4 = document.createElement("td");
            const td5 = document.createElement("td");
            const td6 = document.createElement("td");
            const td7 = document.createElement("td");
            const td8 = document.createElement("td");
            const td9 = document.createElement("td");
            //创建选择框
            const input1 = document.createElement("input");
            //创建序号
            const span1 = document.createElement("span");
            //创建图片
            const img = document.createElement("img");
            //创建文件名
            const span = document.createElement("span");
            //创建标题输入框
            const input2 = document.createElement("input");
            //创建描述输入框
            const input3 = document.createElement("input");
            //创建大小
            const span2 = document.createElement("span");
            //创建版式下拉框
            const select = document.createElement("select");
            //创建版式下拉框的选项
            const option1 = document.createElement("option");
            const option2 = document.createElement("option");
            //创建分类下拉框
            const select1 = document.createElement("select");
            //创建分类下拉框的选项
            const option3 = document.createElement("option");
            const option4 = document.createElement("option");
            const option5 = document.createElement("option");
            const option6 = document.createElement("option");
            const option7 = document.createElement("option");
            const option8 = document.createElement("option");
            const option9 = document.createElement("option");
            //设置选择框的属性
            input1.setAttribute("type", "checkbox");
            input1.setAttribute("class", "file");
            //设置序号的属性
            span1.setAttribute("class", "num");
            span1.innerText = (rows + i).toString();
            //设置图片的属性，预览图片，方便后期上传
            img.setAttribute("src", URL.createObjectURL(file));
            img.setAttribute("class", "preview");
            img.setAttribute("alt", fileName);
            //设置文件名的属性
            span.setAttribute("class", "filename");
            span.innerText = fileName;
            //设置标题输入框的属性
            input2.setAttribute("type", "text");
            input2.setAttribute("class", "title");
            //标题输入框的默认值为文件名，不包含后缀，后缀名转换为小写，去掉空格，必填
            input2.setAttribute("value", fileName.substring(0, fileName.lastIndexOf(".")).toLowerCase().replace(/\s+/g, ""));
            //设置描述输入框的属性
            input3.setAttribute("type", "text");
            input3.setAttribute("class", "description");
            //描述输入框的默认值为文件名，不包含后缀，后缀名转换为小写，去掉空格，必填
            input3.setAttribute("value", fileName.substring(0, fileName.lastIndexOf(".")).toLowerCase().replace(/\s+/g, ""));
            //设置大小的属性
            span2.setAttribute("class", "size");
            //将文件大小转换为KB或MB
            if (fileSize < 1024) {
                span2.innerText = fileSize + "B";
            } else if (fileSize < 1024 * 1024) {
                span2.innerText = (fileSize / 1024).toFixed(2) + "KB";
            } else {
                span2.innerText = (fileSize / 1024 / 1024).toFixed(2) + "MB";
            }
            //设置版式下拉框的属性
            select.setAttribute("class", "style");
            //设置版式下拉框的选项
            option1.setAttribute("value", "horizontal");
            option1.innerText = "横向";
            option2.setAttribute("value", "vertical");
            option2.innerText = "竖向";
            //设置分类下拉框的属性
            select1.setAttribute("class", "type");
            //设置分类下拉框的选项
            option3.setAttribute("value", "nature");
            option3.innerText = "自然";
            option4.setAttribute("value", "animal");
            option4.innerText = "动物";
            option5.setAttribute("value", "plant");
            option5.innerText = "植物";
            option6.setAttribute("value", "food");
            option6.innerText = "食物";
            option7.setAttribute("value", "building");
            option7.innerText = "建筑";
            option8.setAttribute("value", "portrait");
            option8.innerText = "人物";
            option9.setAttribute("value", "other");
            option9.innerText = "其他";
            //将选择框添加到选择列
            td1.appendChild(input1);
            //将序号添加到序号列
            td2.appendChild(span1);
            //将图片添加到图片列
            td3.appendChild(img);
            //将文件名添加到图片列
            td4.appendChild(span);
            //将标题输入框添加到标题列
            td5.appendChild(input2);
            //将描述输入框添加到描述列
            td6.appendChild(input3);
            //将大小添加到大小列
            td7.appendChild(span2);
            //将版式下拉框的选项添加到版式下拉框
            select.appendChild(option1);
            select.appendChild(option2);
            //将版式下拉框添加到版式列
            td8.appendChild(select);
            //将分类下拉框的选项添加到分类下拉框
            select1.appendChild(option3);
            select1.appendChild(option4);
            select1.appendChild(option5);
            select1.appendChild(option6);
            select1.appendChild(option7);
            select1.appendChild(option8);
            select1.appendChild(option9);
            //将分类下拉框添加到分类列
            td9.appendChild(select1);
            //将选择列添加到行
            tr.appendChild(td1);
            //将序号列添加到行
            tr.appendChild(td2);
            //将图片列添加到行
            tr.appendChild(td3);
            //将文件名列添加到行
            tr.appendChild(td4);
            //将标题列添加到行
            tr.appendChild(td5);
            //将描述列添加到行
            tr.appendChild(td6);
            //将大小列添加到行
            tr.appendChild(td7);
            //将版式列添加到行
            tr.appendChild(td8);
            //将分类列添加到行
            tr.appendChild(td9);
            //将行添加到表格
            table.appendChild(tr);
        }
    }
}

//全选
function allSelect() {
    const all = document.getElementsByClassName("file");
    //全选事件
    for (let i = 0; i < all.length; i++) {
        all[i].checked = true;
    }
}

//反选
function reverseSelect() {
    const all = document.getElementsByClassName("file");
    //反选事件
    for (let i = 0; i < all.length; i++) {
        all[i].checked = !all[i].checked;
    }
}

//删除所选
function deleteImg() {
    //将选中的图片删除
    const all = document.getElementsByClassName("file");
    //若选中的图片数量为0，则不删除
    let count = 0;
    for (let i = 0; i < all.length; i++) {
        if (all[i].checked) {
            count++;
        }
    }
    if (count === 0) {
        alert("请选择要删除的图片！");
    } else {
        //弹出确认框
        if (confirm("确定要删除吗？")) {
            //若选中的图片数量不为0，则删除
            for (let i = 0; i < all.length; i++) {
                if (all[i].checked) {
                    //删除所选图片
                    all[i].parentNode.parentNode.remove();
                    //revokeObjectURL()方法释放一个用URL.createObjectURL()创建的对象URL
                    // const img = document.getElementsByClassName("preview");
                    // console.log(img[i].src);
                    // URL.revokeObjectURL(img[i].src);

                    //序号重新排序
                    const num = document.getElementsByClassName("num");
                    for (let j = i; j < num.length; j++) {
                        num[j].innerText = j + 1;
                    }
                    //序号减一
                    i--;
                }
            }
        }
    }
}

//上传所选
function uploadImg() {
    //将选中的图片上传
    const all = document.getElementsByClassName("file");
    const files = document.querySelector('input[type="file"]').files;
    //若选中的图片数量为0，则不上传
    let count = 0;
    for (let i = 0; i < all.length; i++) {
        if (all[i].checked) {
            count++;
        }
    }
    if (count === 0) {
        alert("请选择要上传的图片！");
    } else {
        //若选中的图片数量不为0，则上传
        for (let i = 0; i < all.length; i++) {
            if (all[i].checked) {
                //上传所选图片
                const filename = document.getElementsByClassName("filename");
                const title = document.getElementsByClassName("title");
                const description = document.getElementsByClassName("description");
                const style = document.getElementsByClassName("style");
                const type = document.getElementsByClassName("type");
                const size = document.getElementsByClassName("size");
                //获取选中的图片
                const file = files[i];
                // const file = document.querySelector('input[type="file"]').files[0];
                //创建FormData对象
                const formData = new FormData();
                formData.append("file", file);
                formData.append("fileName", filename[i].innerText);
                formData.append("fileTitle", title[i].value);
                formData.append("fileDescription", description[i].value);
                formData.append("fileStyle", style[i].value);
                formData.append("fileType", type[i].value);
                formData.append("fileSize", size[i].innerText);
                //将其提交到do_upload.php
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "do_upload.php", false);
                xhr.send(formData);
                //判断是否上传成功
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    console.log("上传成功！");
                } else {
                    console.log("上传失败！");
                }

            }
        }
    }
}
