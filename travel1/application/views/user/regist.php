<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是 user regist 的页面！</h1>
        <form action="user/registing" method="post">
            <input type="input" name="username">
            <input type="input" name="password">
            <input type="submit" name="sub" value="注册">
        </form>
    </body>
</html>
