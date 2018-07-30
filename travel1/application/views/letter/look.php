<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>"/>
        <title></title>
    </head>
    <body>
        <h1>这是信箱查看的页面！</h1>
        <a href="user/index">userIndex</a>
        <hr>
        <?php
            foreach ($letters as $letter) {
         ?>
            from: <a href="#"> <?php echo $letter -> username; ?></a>
            content: <?php echo $letter -> letterContent; ?>
            <br>
         <?php
            }
          ?>
    </body>
</html>
