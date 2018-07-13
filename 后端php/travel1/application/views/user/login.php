<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是 user login 的页面！</h1>
        <form action="user/logining" method="post">
            <input type="hidden" name="next_url" value="<?php echo $next_url ?>">
            <input type="input" name="username">
            <input type="input" name="password">
            <input type="submit" name="sub" value="登录">
        </form>
    </body>
</html>
