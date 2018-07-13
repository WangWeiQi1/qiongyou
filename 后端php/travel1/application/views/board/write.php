<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是写分类的页面！</h1>
        <a href="user/index">userIndex</a>
        <form action="board/writing" method="post">
            <input type="input" name="boardName">
            <input type="submit" name="sub" value="添加板块">
        </form>
    </body>
</html>
