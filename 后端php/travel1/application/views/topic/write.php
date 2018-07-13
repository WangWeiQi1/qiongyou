<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是发表文章的页面！</h1>
        <a href="user/index">userIndex</a>
        <form action="topic/writing" method="post">
            <input type="input" name="topicTitle" placeholder="请输入文章的标题">
            <br>
            <textarea name="topicContent" rows="8" cols="40"></textarea>
            <select name="boardId">
                <?php foreach ($boards as $board) {
                 ?>

                    <option value="<?php echo $board -> boardId; ?>">
                        <?php echo $board -> boardName; ?>
                    </option>

                <?php
                    }
                 ?>
            </select>
            <input type="submit" name="sub" value="发表文章">
        </form>
    </body>
</html>
