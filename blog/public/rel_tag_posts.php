<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php'; ?>
    <body>
        <div class="container-fluid">
            <?php include_once('partials/_header.php'); ?>
            <?php include('partials/_horizontal_bar.php'); ?>
            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <?php include_once('partials/_slider.php'); ?>
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <!-- Slider panel -->
                    <div id="flip"><i class="fa fa-caret-down"></i></div>
                    <div id="panel">
                        <h2>Hello world!</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil odit
                        quo ipsa culpa atque doloribus
                        repudiandae repellat, quibusdam sapiente deleniti mollitia
                        magnam quidem adipisci, laborum optio
                        assumenda pariatur repellendus iste? Vel sint necessitatibus repellat
                        aut ullam provident. Numquam,
                         voluptas saepe! Maxime at eius, molestiae accusamus fugiat impedit
                         consectetur vel repellat.</p>
                    </div>
                    <!-- /Slider panel -->
                    <div class="blog-posts">
                        <?php
                        $db = new FrontView;
                        $query = "SELECT * FROM tbl_article WHERE tag_id = :tag_id AND
                        published_at <= Now() AND status = 1";
                        $db->relatedtagPostView($query);
                        ?>
                    </div>
                </div>
                <?php include_once('partials/_right_sidebar.php'); ?>
            </div>
                <?php include('partials/_horizontal_bar-bottom.php'); ?>
            <?php include_once('partials/_footer.php'); ?>
        </div>
        <?php include_once('partials/_scripts.php'); ?>
    </body>
</html>
