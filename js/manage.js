//从cookie中判断是否登录
    var cookie = document.cookie;
    if (cookie === "") {
        window.location.href = "login.html";
    }