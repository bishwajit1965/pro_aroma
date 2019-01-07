<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php';?>
    <body>
        <!-- Go up button -->
        <button onclick="topFunction()" id="myBtn" title="Go to top">
            <img src="images/arrow28.png">
        </button>
        <!-- /Go up button -->
        <div class="container-fluid">
            <?php include_once('partials/_header.php');?>
            <?php include('partials/_horizontal_bar.php');?>
            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
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

                    <!-- Post Coming soon -->
                    <div class="coming-soon-blog-post" style="">
                        <div class="bgimg">
                            <div class="topleft">
                                <!-- <p>Logo</p> -->
                                <img src="images/logo.jpg"
                                alt="Coming soon loho" style="padding-top: 20px;
                                width:100px; height:100px;border-radius:50%;
                                padding-bottom: 20px;" class="img-responsive">
                            </div>
                            <div class="middle">
                                <h1>POST COMING SOON</h1>
                                <hr class="coming-soon">
                                <p id="demo" style="font-size:30px"></p>
                            </div>
                            <div class="bottomleft">
                                <h2>Timer: </h2>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Recusandae ducimus vitae numquam eius soluta ab nam
                                optio aliquam similique architecto veritatis.
                            </div>
                        </div>
                    </div>
                    <!-- /Post Coming soon -->
                    <div class="blog-posts">
                        <?php
                        $db = new FrontView;
                        $query = "SELECT * FROM tbl_article WHERE  published_at <= Now() AND status = 1";
                        $records_per_page = 25;
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
