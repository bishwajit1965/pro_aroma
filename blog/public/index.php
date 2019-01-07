<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php';?>
    <body>
        <div class="container-fluid">
            <?php include_once('partials/_header.php');?>
            <?php include('partials/_horizontal_bar.php');?>
            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
                    <div class="border" style="height:40px;
                    background-color:#DDD;"></div>
                    <?php include_once('partials/_slider.php'); ?>
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <?php include_once('partials/_slider_panel.php'); ?>
                    <!-- Post Coming soon -->
                        <div class="bgimg">
                            <?php
                            $db = new FrontViewComingSoon();
                            $query='SELECT * FROM tbl_coming_soon ORDER BY id DESC LIMIT 1';
                            $db->viewComingSoonPhoto($query);
                            ?>
                            <div class="topleft">
                            <!-- Logo view -->
                            <?php
                            $logo = new Logo();
                            $query = "SELECT * FROM tbl_logo ORDER BY id DESC LIMIT 1";
                            $logo->viewLogo($query);
                            ?>
                            <!-- /Logo view -->
                            </div>

                            <!-- Coming soon post -->
                            <?php
                            $db = new FrontViewComingSoon();
                            $query='SELECT * FROM tbl_coming_soon ORDER BY id DESC LIMIT 1';
                            $db->viewComingSoonData($query);
                            ?>
                            <!-- /Coming soon post -->
                        </div>
                    <!-- /Post Coming soon -->

                    <div class="blog-posts">
                        <?php
                        $db = new FrontView;
                        $query = "SELECT * FROM tbl_article WHERE  published_at <= Now() AND status = 1";
                        $records_per_page = 4;
                        $newquery = $db->paging($query, $records_per_page);
                        $db->viewData($newquery);
                        ?>
                        <!-- Parallax effect -->
                        <div class="parallax">
                            Parallax
                        </div>

                        <div class="parallax-description">
                            <p>Scroll Up and Down this page to see the parallax scrolling effect.
                            This div is just here to enable scrolling.
                            Tip: Try to remove the background-attachment property to remove the scrolling effect.</p>
                        </div>
                        <!-- /Parallax effect -->
                        <div class="row">
                            <div class="col-sm-4 text-bottom">
                                <img src="images/magpie - Copy.jpg" alt="" class="img-responsive img-fluid"
                                style="width:100%;height:130px;margin-bottom:15px;">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum saepe natus amet corrupti labore esse ut adipisci minus nemo modi. Laudantium aspernatur iste totam distinctio odit. Temporibus error maxime dolores.</p>
                                <a href="" class="btn btn-sm btn-primary">Button</a>

                            </div>
                            <div class="col-sm-4 text-bottom">
                                <img src="images/magpie - Copy.jpg" alt="" class="img-responsive img-fluid"
                                style="width:100%;height:130px;margin-bottom:15px;">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum saepe natus amet corrupti labore esse ut adipisci minus nemo modi. Laudantium aspernatur iste totam distinctio odit. Temporibus error maxime dolores.</p>
                                <a href="" class="btn btn-sm btn-primary">Button</a>
                            </div>
                            <div class="col-sm-4 text-bottom">
                                <img src="images/magpie - Copy.jpg" alt="" class="img-responsive img-fluid" style="width:100%;height:130px;margin-bottom:15px;">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum saepe natus amet corrupti labore esse ut adipisci minus nemo modi. Laudantium aspernatur iste totam distinctio odit. Temporibus error maxime dolores.</p>
                                <a href="" class="btn btn-sm btn-primary">Button</a>
                            </div>
                        </div><br><hr>
                        <!-- Pagination -->
                        <div class="row justify-content-center">
                            <?php $db->paginglink($query, $records_per_page); ?>
                        </div>
                        <!-- /Pagination -->
                    </div>
                </div>
                <?php include_once('partials/_right_sidebar.php');?>
            </div>
                <?php include('partials/_horizontal_bar-bottom.php'); ?>
            <?php include_once('partials/_footer.php'); ?>
        </div>
        <?php include_once('partials/_scripts.php'); ?>
    </body>
</html>
