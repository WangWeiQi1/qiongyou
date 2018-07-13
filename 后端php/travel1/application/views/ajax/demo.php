<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?php echo site_url(); ?>" />
        <title>ajax 测试页面</title>
        <!-- <script
          src="https://code.jquery.com/jquery-3.3.1.js"
          integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
          crossorigin="anonymous"></script> -->

          <script src='assets/js/jquery-3.3.1.min.js'></script>
          <!-- 如果没有 base site_url 那么也可以这么写 -->
          <!-- <script src='<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js'></script> -->


          <!--  下面是传统的引入方法， 肯定不会出错的方法 -->
          <!-- <script src='../assets/js/jquery-3.3.1.min.js'></script> -->
          <!-- 下面是当前路径，肯定不行 -->
          <!-- <script src='./assets/js/jquery-3.3.1.min.js'></script> -->
    </head>
    <body>
        <h1>这是 ajax 测试的页面！</h1>
        <a href="ajax/receive">ajax 接收页面</a>
        <form action="ajax/formPost" method="post">
            <input type="input" name="username" value="">
            <input type="submit" name="sub" value="form 提交">
        </form>

        <button type="button" class='ajax-btn' name="button">ajax 提交</button>
        <script>
            const log = console.log.bind()


            const test = () => {
                log('test Jnxy ', $('div'))
                $('.ajax-btn').on('click', function(e) {
                    log('被点击')
                    $.post('ajax/ajaxPost', {
                        username: '这是 ajax 发过来的 username',
                    }, function(res) {
                        log('发送成功,这是后面给出的响应:', res)
                        // log('转换以后的结果:', JSON.parse(res))
                        const data = JSON.parse(res)
                        log('得到的数据:', data)
                    })
                })
            }

            const __main = () => {
                test()
            }

            __main()
        </script>
    </body>
</html>
