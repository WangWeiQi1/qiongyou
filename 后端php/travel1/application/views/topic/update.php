<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是 topic update 的页面！</h1>


        <form action="topic/updating" method="post">
            <input type="hidden" name="topicId" value='<?php echo $topic -> topicId; ?>'>
            <input type="input" name="topicTitle" value='<?php echo $topic -> topicTitle; ?>' placeholder="请输入文章的标题">
            <br>
            <input type="input" name="topicContent" value="<?php echo $topic -> topicContent; ?>">
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
            <input type="submit" name="sub" value="提交修改">
        </form>

    </body>
</html>
