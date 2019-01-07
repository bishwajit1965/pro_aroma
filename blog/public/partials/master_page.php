<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php'; ?>
    <body>
        <!-- Go up button -->
        <button onclick="topFunction()" id="myBtn" title="Go to top">
            <img src="images/arrow28.png">
        </button>
        <!-- /Go up button -->
        <div class="container-fluid">
            <?php include_once('partials/_header.php'); ?>
            <?php include('partials/_horizontal_bar.php'); ?>
            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <?php include_once('partials/_slider_panel.php'); ?>
                    <!-- Code below -->
                    <div class="blog-posts">

                    <h1>BLANK PAGE</h1>
                         
                    </div>
                    <!-- Code above -->
                </div>
                <?php include_once('partials/_right_sidebar.php'); ?>
            </div>
                <?php include('partials/_horizontal_bar-bottom.php'); ?>
            <?php include_once('partials/_footer.php'); ?>
        </div>
        <?php include_once('partials/_scripts.php'); ?>
    </body>
</html>