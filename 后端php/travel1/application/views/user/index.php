<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是 user index 的页面！</h1>
        <a href="ajax/index">ajax 测试页面</a>
        <a href="user/regist">register</a>
        <a href="user/login">login</a>
        <a href="topic/index">topicIndex</a>
        <a href="board/write">写属于自己的板块</a>
        <a href="topic/write">发表自己的文章</a>
        <a href="letter/look">我的信箱</a>
        <hr>
        <span><?php echo $username; ?></span>
        <a href="user/logout">logout</a>

    </body>
</html>
