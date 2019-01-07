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
                    <div class="border" style="height:40px;
                    background-color:#DDD;"></div>
                    <?php include_once('partials/_slider.php'); ?>
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <?php include_once('partials/_slider_panel.php'); ?>

                    <div class="blog-posts">
                    <!-- Fetching monthly archived post -->
                        <?php
                        $db = new FrontView;
                        $query = "SELECT * FROM tbl_article WHERE month = :month AND published_at <= Now() AND status = 1";
                        $records_per_page = 4;
                        $newquery = $db->paging($query, $records_per_page);
                        $db->searchArchived($newquery);
                        ?>
                    <!-- /  Fetching monthly archived post -->
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
