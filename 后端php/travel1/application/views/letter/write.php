<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>"/>
        <title></title>
    </head>
    <body>
        <h1>这是发送信息的页面！</h1>
        <form action="letter/writing" method="post">

            <input type="hidden" name="topicId" value="<?php echo $topicId; ?>">
            <input type="input" name="letterContent" placeholder="写下你想对他说的话！">
            <input type="submit" name="sub" value="发送给他">
        </form>
    </body>
</html>
