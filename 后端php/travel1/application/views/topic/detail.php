<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title></title>
    </head>
    <body>
        <h1>这是 topic detail 的页面！</h1>
        <a href="user/index">userIndex</a>
        <a href="topic/index">topicIndex</a>
        <h2>标题:<?php echo $topic -> topicTitle; ?></h2>
        <span>作者: <?php echo $author ?></span>
        <a href="letter/write?topicId=<?php echo $topic -> topicId ?>">给他发私信</a>
        <span>分类: <?php echo $boardName ?></span>
        <h3>内容:<?php echo $topic -> topicContent; ?></h3>
        <!-- <a href="topic/detail?topicId=<?php echo $pre_id ?>">上一页</a> -->

        <?php
            if ($pre_id) {
                $pre = $pre_id -> topicId;
                $pre_title = $pre_id -> topicTitle;
                echo "<a href=topic/detail?topicId=$pre>上一页：$pre_title</a>";
                // echo $pre_id -> topicTitle;
            }
            echo '</br>';
            if ($next_id) {
                $next = $next_id -> topicId;
                $next_title = $next_id -> topicTitle;
                echo "<a href=topic/detail?topicId=$next>下一页：$next_title</a>";
            }
         ?>
        <br>
        载入所有的回复:
        <hr>
        <?php foreach($replys as $reply) {
        ?>
            <?php echo $reply -> username; ?> 说:
            <?php echo $reply -> reply_content; ?>
            <br>
        <?php
            }
        ?>

        <hr>
        <form action="reply/add" method="post">
            <input type="hidden" name="topic_id" value="<?php echo $topic -> topicId; ?>">
            <textarea rows="8" cols="40" name='reply_content'></textarea>
            <button type="submit" name="button">发表回复</button>
        </form>
    </body>
</html>
