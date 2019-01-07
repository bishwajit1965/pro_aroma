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
                    <?php include_once('partials/_slider.php'); ?>
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <!-- Slider panel -->
                    <div id="flip">Click to slide the panel down or up</div>
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
                        <div class="404-page" style="background-color:#EDEFF0;">
                            
                            <h1 style="color:#CF1F27;text-align:center;
                            font-size:85px;text-shadow: 2px 2px 3px #000000">
                            404 ERROR !!!</h1>

                            <h1 style="color:#CF1F27;text-align:center;padding-top:30px;
                            font-size:52px;text-shadow: 2px 2px 3px #000000">
                            SEARCHED DATA NOT FOUND !!!</h1>

                            <h4 style="color:#CF1F27;text-align:center;padding-top:30px;
                            font-size:32px;text-shadow: 2px 2px 3px #000000">
                            Search input field remained blank ! Insert the key word !!!</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="index.php" class="btn btn-block btn-info">
                                        <i class="fa fa-fast-backward"></i> Go Home</a>
                                </div>
                            </div>
                        </div>
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