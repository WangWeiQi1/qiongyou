<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>"/>
        <!-- <base href="<?php echo base_url(); ?>"/> -->
        <title></title>
    </head>
    <body>
        <!-- http://127.0.0.1/phptest/myci1/user/index -->
        <!-- http://127.0.0.1/user/index -->
        <a href="user/index">user index</a>
        <h1>这是 topic index 的页面！</h1>
        <form action="topic/search" method="post">
            <input type="input" name="search" placeholder="请输入你要搜索的标题">
            <input type="submit" name="sub" value="搜索">
        </form>
        <?php foreach ($topics as $topic) {
         ?>
        <h2>
            <a href="topic/detail?topicId=<?php echo $topic -> topicId; ?>">
                <?php
                    echo $topic -> topicTitle;
                    // echo "<br>";
                 ?>
            </a>
        </h2>
        <?php
            if ($topic -> userId == $current_user_id) {
                // echo "是你写的";
                // echo "string";
                $topicId = $topic -> topicId;
                echo "<a href=topic/delete?topicId=$topicId>删除</a>";
                echo "<a href=topic/update?topicId=$topicId>修改</a>";
            }
         ?>
        <!-- <a href="topic/delete?topicId=<?php echo $topic -> topicId; ?>">删除</a>
        <a href="topic/update?topicId=<?php echo $topic -> topicId; ?>">修改</a> -->
        <?php
            }
         ?>
    </body>
</html>

<!--
"pages/homepage/homepage",
"pages/index/index",
"pages/addCgi/addCgi",
"pages/homepage/search",
"pages/community/community",
"pages/note/note"
"pages/me/me",
"pages/me/user",
"pages/homepage/passage1",
"pages/note/more",


"pages/me/credits",
"pages/me/help",
"pages/note/note1",
"pages/note/note2",
"pages/note/drafts",
"pages/note/recycle",
"pages/homepage/then",
"pages/community/topic/topic",
"pages/community/rank/rank",
"pages/community/involve/involve",



"pages/community/share/share",
"pages/community/topic/topicdetail/topicdetail",
"pages/community/topic/publish/publish",
"pages/community/sharedetail/sharedetail",
"pages/community/involve/involveshare/involveshare",
"pages/community/involve/involvetopic/involvetopic",
"pages/room/room"
"pages/me/rules",
"pages/me/rankrules", -->
