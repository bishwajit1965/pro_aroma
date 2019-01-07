<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php'; ?>
    <body>
        <!-- Search -->
        <?php
        if (!isset($_GET['search']) || $_GET['search']== null) {
            header("Location: 404.php");
        } else {
            $search = $_GET['search'];
        }
        ?>
        <!-- /Search -->
        <div class="container-fluid">
            <?php include_once('partials/_header.php'); ?>
            <?php include('partials/_horizontal_bar.php'); ?>

            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
                    <div class="border" style="min-height:40px;background-color:#A8A8A8;"></div>
                    <?php include_once('partials/_slider.php'); ?>
                    <div class="border" style="min-height:40px;background-color:#A8A8A8;"></div>
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
                        $query = "SELECT * FROM tbl_article WHERE title LIKE '%$search%'
                        OR content LIKE '%$search%' AND published_at <= Now() AND status = 1";
                        $records_per_page = 4;
                        $newquery = $db->paging($query, $records_per_page);
                        $db->searchData($newquery);
                        ?>
                        <!-- Pagination -->
                        <div class="row justify-content-center">
                            <?php $db->paginglink($query, $records_per_page); ?>
                        </div>
                        <!-- /Pagination -->
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
