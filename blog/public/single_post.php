<!doctype html>
<html class="no-js" lang="">
    <?php include_once('partials/_head.php');?>
    <body>
        <!-- Facebook Javascript SDK -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1&appId=270756030089004&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <!-- /Facebook Javascript SDK -->
        <div class="container-fluid">
            <?php include_once('partials/_header.php');?>
            <?php include('partials/_horizontal_bar.php');?>
            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <?php include_once 'partials/_slider_panel.php';?>
                    <div class="blog-posts">
                        <?php
                        $id = $_GET['post_id'];
                        $db = new FrontView();
                        $query = "SELECT * FROM tbl_article WHERE art_id =:art_id";
                        $db->singleView($query);
                        ?>
                    </div>

                    <!--Post wise Facebook comments-->
                    <div class="facebook-post-comments">
                        <div class="borders">
                            <h5>Post comments:</h5>
                        </div>
                        <!-- Uri generator for each post -->
                        <?php
                        $url = (!empty($_SERVER['HTTPS'])) ? 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : 'http://' . $_SERVER['SERVER_NAME'] .
                         $_SERVER['REQUEST_URI'];
                        ?>
                        <!-- /Uri generator for each post -->
                        <div class="fb-comments" data-href="<?php echo $url; ?>"
                        data-numposts="5" data-width="80%"></div>
                    </div>
                    <!-- /Post wise Facebook comments -->
                </div>
                <?php include_once('partials/_right_sidebar.php');?>
            </div>
            <?php include('partials/_horizontal_bar-bottom.php'); ?>
            <?php include_once('partials/_footer.php'); ?>
        </div>
        <?php include_once('partials/_scripts.php'); ?>
    </body>
</html>
